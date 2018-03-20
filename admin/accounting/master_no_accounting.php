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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master No Accounting");
    global $conn;
    
    $perhalaman = 50;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
	 
	 if(isset($_POST["hapus"]))
    {
        $id_data = array();
        $id_data = isset($_POST["no_accounting"]) ? $_POST["no_accounting"] : $id_data;
        
        foreach($id_data as $key => $value)
        {
            $query = "UPDATE `gx_no_accounting` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `no_accounting` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: master_no_accounting.php');
    }

$content = '<!-- Content Header (Page header) -->
               

                <!-- Main content -->
                <section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<a href="form_no_accounting.php" class="btn bg-maroon btn-flat margin">Create New</a>
								</div>
							</div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								<form action="" method="POST" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>No Accounting :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="no_accounting" placeholder="No Accounting">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="nama" type="text" placeholder="Nama">
					</div>
					
				    </div>
				    </div>
				    
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	
	<hr>

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>No Accounting</th>
			<th>Nama </th>
			<th>Level</th>
			<th>Jenis</th>
			<th>Group</th>
			<th>Divisi</th>
			<th>Action</th>
			<th>#</th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_POST["search"]))
{
    $no_accounting		= isset($_POST["no_accounting"]) ? trim(strip_tags($_POST["no_accounting"])) : "";
    $nama				= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_no		= ($no_accounting != "") ? "AND `no_accounting` LIKE '%".$no_accounting."%'" : "";
    $sql_nama	= ($nama != "") ? "AND `nama` LIKE '%".$nama."%'" : "";
    
    $sql_data	= mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` =  '0'
							  $sql_no
							  $sql_nama
								  ORDER BY `no_accounting` ASC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` =  '0'
												 $sql_no
												$sql_nama;", $conn));
    
    $hal= "?a=$no_accounting&n=$nama&";
    
   
}else{
    $sql_data		= mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` =  '0' ORDER BY `no_accounting` ASC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` =  '0';", $conn));
    $hal		= "?";
}

if(isset($_GET["a"])){
    $no_accounting		= isset($_GET["a"]) ? trim(strip_tags($_POST["a"])) : "";
    $nama				= isset($_GET["n"]) ? trim(strip_tags($_POST["n"])) : "";
    
    $sql_no		= ($no_accounting != "") ? "AND `no_accounting` LIKE '%".$no_accounting."%'" : "";
    $sql_nama	= ($nama != "") ? "AND `nama` LIKE '%".$nama."%'" : "";
    
    $sql_data	= mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` =  '0'
							  $sql_no
							  $sql_nama
								  ORDER BY `no_accounting` ASC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` =  '0'
												 $sql_no
												$sql_nama;", $conn));
    
    $hal= "?a=$no_accounting&n=$nama&";
}


    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["no_accounting"].'</td>
			<td>'.$row_data["nama"].'</td>
			<td>'.$row_data["level_accounting"].'</td>
			<td>'.$row_data["jenis"].'</td>
			<td>'.$row_data["group"].'</td>
			<td>'.$row_data["divisi"].'</td>
			<td><a href="form_no_accounting?id='.$row_data["id_no_accounting"].'"><span class="label label-info">Edit</span></a>
			</td>
			<td><input type="checkbox" name="no_accounting[]" value="'.$row_data["no_accounting"].'"></td>
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
            <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
	     </div>
		 </form>
       </div></section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master No Accounting';
    $submenu	= "no_accounting";
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