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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Area");
    global $conn;
    
	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}
	
	if(isset($_POST["hapus"]))
    {
        $id_data = array();
        $id_data = isset($_POST["id_area"]) ? $_POST["id_area"] : $id_data;
        
        foreach($id_data as $key => $value)
        {
            $query = "UPDATE `gx_area` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_area` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: master_area.php');
    }

$content = '

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_area.php" class="btn bg-maroon btn-flat margin">Add Area</a>
					
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Area</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
									<form action="" method="POST" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Kode Area :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="kode_area" placeholder="Kode Area">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama Area :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="nama_area" type="text" placeholder="Nama Area">
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
			<th>Kode Area</th>
			<th>Nama</th>
			<th>Area</th>
			<th>Coverage</th>
			<th>Action</th>
			<th>#</th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_POST["search"])){
    $kode_area		= isset($_POST["kode_area"]) ? trim(strip_tags($_POST["kode_area"])) : "";
    $nama_area	= isset($_POST["nama_area"]) ? trim(strip_tags($_POST["nama_area"])) : "";
    
    $sql_kode	= ($kode_area != "") ? "AND `kode_area` LIKE '%".$kode_area."%'" : "";
    $sql_nama	= ($nama_area != "") ? "AND `nama_area` LIKE '%".$nama_area."%'" : "";
    
    $sql_data		= mysql_query("SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` =  '0'
								  $sql_kode
								  $sql_nama LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` =  '0'
												 $sql_nama
												 $sql_nama;", $conn));
	
    $hal= "?k=$kode_area&n=$nama_area&";
    
   
}else{
	$sql_data		= mysql_query("SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` =  '0' LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` =  '0';", $conn));
    $hal		= "?";
}

if(isset($_GET["k"])){
    $kode_area		= isset($_GET["k"]) ? trim(strip_tags($_POST["k"])) : "";
    $nama_area		= isset($_GET["n"]) ? trim(strip_tags($_POST["n"])) : "";
    
    $sql_kode	= ($kode_area != "") ? "AND `kode_area` LIKE '%".$kode_area."%'" : "";
    $sql_nama	= ($nama_area != "") ? "AND `nama_area` LIKE '%".$nama_area."%'" : "";
    
    $sql_data		= mysql_query("SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` =  '0'
								  $sql_kode
								  $sql_nama LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` =  '0'
												 $sql_nama
												 $sql_nama;", $conn));
	
    $hal= "?k=$kode_area&n=$nama_area&";
}


    
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_area"].'</td>
			<td>'.$row_data["nama_area"].'</td>
			<td>'.$row_data["provinsi"].'</td>
			<td>'.$row_data["kota"].'</td>
			<td><a href="detail_area.php?id='.$row_data["id_area"].'" onclick="return valideopenerform(\'detail_area.php?id='.$row_data["id_area"].'\',\'area\');">Details</a>  ||
			<a href="form_area.php?id='.$row_data["id_area"].'">edit</a></td>
			<td><input type="checkbox" name="id_area[]" value="'.$row_data["id_area"].'"></td>
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
		
		</div><!-- /.box -->
		</form>
	</div>
</div>

</section><!-- /.content -->';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Area';
    $submenu	= "master_area";
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