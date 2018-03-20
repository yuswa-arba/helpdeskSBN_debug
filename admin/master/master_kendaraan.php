<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Kendaraan");
     global $conn;
    
     if(isset($_POST["hapus"]))
     {
	  $id_kendaraan = array();
	  $id_kendaraan = isset($_POST["id_kendaraan"]) ? $_POST["id_kendaraan"] : $id_kendaraan;
	
	  foreach($id_kendaraan as $key => $value)
	  {
	       $query = "UPDATE `gx_kendaraan` SET `level` = '2', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		    WHERE `id_kendaraan` = '".$value."';";
	       $sql_update = mysql_query($query, $conn) or die (mysql_error());
	       //log
	       enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
	  }
	  header('location: '.URL_ADMIN.'master/master_kendaraan.php');
     }
    
    
     $content ='

		<!-- Main content -->
		<section class="content">
		    <div class="row">
			<div class="col-xs-12">
			    <form method ="POST" action="">
			    <div class="box">
				<div class="box-header">
				   <h3 class="box-title">List Kendaraan</h3>
				   <div class="box-tools pull-right">
					
					     <a href="'.URL_ADMIN.'master/form_kendaraan.php" class="btn bg-olive btn-flat margin">Tambah Kendaraan</a>
					
				   </div>
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
				    <table id="customer" class="table table-bordered table-striped">
					<thead>
					    <tr>
						<th>#</th>
						<th>Nama Kendaraan</th>
						<th>Cabang</th>
						<th>NOPOL</th>
						<th>Jenis</th>
						<th>Tahun</th>
						<th>Action</th>
						<th>#</th>
					    </tr>
					</thead>
					<tbody>';
$sql_kendaraan = mysql_query("SELECT * FROM `gx_kendaraan`
			 WHERE `level` = '0' ORDER BY `id_kendaraan` ASC;", $conn);
$no = 1;
while ($row_kendaraan = mysql_fetch_array($sql_kendaraan))
{
     $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_kendaraan["nama_kendaraan"].'</td>
		    <td>'.$row_kendaraan["id_cabang"].'</td>
		    <td>'.$row_kendaraan["nopol_kendaraan"].'</td>
		    <td>'.$row_kendaraan["jenis_kendaraan"].'</td>
		    <td>'.$row_kendaraan["tahun_kendaraan"].'</td>
		    <td>
		    <a href="form_kendaraan.php?id='.$row_kendaraan['id_kendaraan'].'"><span class="label label-info">Edit</span></a> |
		    <span class="label label-info">Detail</span></td>
		    <td><input type="checkbox" name="id_kendaraan[]" value="'.$row_kendaraan["id_kendaraan"].'"></td>
		</tr>';
		$no++;
}
$content .= '
					    
					</tbody>
				    </table>
				    
				</div><!-- /.box-body -->
				<div class="box-footer">
				    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
				</div>
			    </div><!-- /.box -->
			    </form>
			</div>
		    </div>

		</section><!-- /.content -->
	    ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
	<script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
	    $(function() {
		$(\'#customer\').dataTable({
		    "bPaginate": true,
		    "bLengthChange": false,
		    "bFilter": false,
		    "bSort": false,
		    "bInfo": true,
		    "bAutoWidth": false
		});
	    });
	</script>

	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

	<!-- AdminLTE for demo purposes -->
	<script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Master Kendaraan';
    $submenu	= "master_kendaraan";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>