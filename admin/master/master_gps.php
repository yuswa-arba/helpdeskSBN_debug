<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Cabang");
    global $conn;
    
    if(isset($_POST["hapus"]))
    {
        $id_gps = array();
        $id_gps = isset($_POST["id_gps"]) ? $_POST["id_gps"] : $id_gps;
        
        foreach($id_gps as $key => $value)
        {
            $query = "UPDATE `gx_gps_device` SET `level` = '2', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_gps` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'master/master_gps.php');
    }
    
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form method ="POST" action="">
                            <div class="box">
			      <div class="box-header">
                                   <h3 class="box-title">List GPS</h3>
				   <div class="box-tools pull-right">
					
					     <a href="'.URL_ADMIN.'master/form_gps.php" class="btn bg-olive btn-flat margin">Tambah Data</a>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama GPS</th>
                                                <th>IMEI</th>
                                                <th>No. SIM</th>
                                                <th>Kendaraan</th>
						<th>Karyawan</th>
						<th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_gps = mysql_query("SELECT `gx_gps_device`.*, `gx_pegawai`.`nama`, `gx_kendaraan`.`nama_kendaraan`
			 FROM `gx_gps_device`, `gx_pegawai`, `gx_kendaraan`
			 WHERE `gx_gps_device`.`id_employee` = `gx_pegawai`.`id_employee`
			 AND `gx_gps_device`.`id_kendaraan` = `gx_kendaraan`.`id_kendaraan`
			 AND `gx_gps_device`.`level` = '0'
			 ORDER BY `gx_gps_device`.`id_gps` ASC;", $conn);
$no = 1;
while ($row_gps = mysql_fetch_array($sql_gps))
{
     $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_gps["nama_gps"].'</td>
		    <td>'.$row_gps["imei"].'</td>
		    <td>'.$row_gps["no_sim"].'</td>
		    <td>'.$row_gps["nama_kendaraan"].'</td>
		    <td>'.$row_gps["nama"].'</td>
		    
		    <td align="center">
		    <a href="form_gps.php?id='.$row_gps['id_gps'].'"><span class="label label-info">Edit</span></a> |
		    <a href="detail_gps.php?id='.$row_gps['id_gps'].'"><span class="label label-info">Detail</span></a></td>
		    <td><input type="checkbox" name="id_gps[]" value="'.$row_gps["id_gps"].'"></td>
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
	
    ';

    $title	= 'Master GPS';
    $submenu	= "master_gps";
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