<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_tv.php");
//include ("config/configuration_ott.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Paket");
    global $conn;
    $conn_ott   = DB_TV();
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <form action="" role="form" name="form_product" id="form_product" method="post" enctype="multipart/form-data">
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_paket.php" class="btn bg-maroon btn-flat margin">Add Paket</a>
					<button type="submit" name="hapus" class="btn btn-flat btn-primary">Hapus</button>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Paket</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Nama Paket</th>
					<th>Valid (Hari)</th>
					<th>Harga</th>
					<th>description</th>
					<th width="15%">Action</th>
					<th width="5%">#</th>
                  </tr>
                </thead>
                <tbody>';
//select data
//echo 4%3;

    $sql_data		= mysqli_query($conn_ott ,"SELECT * FROM `ott_product` LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysql_query($conn_ott ,"SELECT * FROM `ott_product`;"));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysqli_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["proName"].'</td>
			<td>'.$row_data["viewDate"].'</td>
			<td>'.$row_data["price"].'</td>
			<td>'.$row_data["description"].'</td>
			<td><a href="detail_paket_ott.php?id='.$row_data["proID"].'" onclick="return valideopenerform(\'detail_paket_ott.php?id='.$row_data["proID"].'\',\'satuan\');">Details</a>  ||
			<a href="form_paket.php?id='.$row_data["proID"].'">edit</a></td>
			<td><input type="checkbox" name="proID[]" value="'.$row_data["proID"].'"></td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>

	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>
	</div>
</div>
</section>
</form>';


if(isset($_POST["hapus"]))
{
	$id_data = array();
	$id_data = isset($_POST["proID"]) ? $_POST["proID"] : $id_data;
	
	foreach($id_data as $key => $value)
	{
		$sql_delete = "DELETE FROM `ott_product` WHERE `proID`= '".$value."';";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott ,$sql_delete) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_delete);
		
		//delete product service
		$sql_delete2 = "DELETE FROM `ott_productservice` WHERE `proId`= '".$value."';";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott ,$sql_delete2) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_delete2);
	}
	header('location: '.URL_OTT.'paket.php');
}

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Paket';
    $submenu	= "master_paket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>