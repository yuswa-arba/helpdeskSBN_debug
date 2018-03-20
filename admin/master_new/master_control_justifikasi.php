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
    
    global $conn;

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_control_justifikasi.php" class="btn bg-maroon btn-flat margin">Add Control Justifikasi</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Control Justifikasi</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>	<th>no</th>
			<th>Tanggal</th>
			<th>Nama Customer</th>
			<th>Nama Paket</th>	
			<th>Kontrak</th>
			<th>Remarks</th>
			<th>Action</th>
                  </tr>
                </thead>
                <tbody>';


    $sql_control_justifikasi	= mysql_query("SELECT * FROM `gx_control_justifikasi`
			    WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC;", $conn);
    $no = 1;

    while($r_control_justifikasi = mysql_fetch_array($sql_control_justifikasi))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_control_justifikasi['tanggal'].'</td>
			<td>'.$r_control_justifikasi['nama_customer'].'</td>
			<td>'.$r_control_justifikasi['nama_paket'].'</td>
			<td>'.$r_control_justifikasi['kontrak'].'</td>
			<td>'.$r_control_justifikasi['remarks'].'</td>
			<td><a href="detail_control_justifikasi.php?id_control_justifikasi='.$r_control_justifikasi["id_control_justifikasi"].'"> View </a> || <a href="form_control_justifikasi.php?id_control_justifikasi='.$r_control_justifikasi["id_control_justifikasi"].'">edit</a></td>
			<!--<td><input type="checkbox" name="id_control_justifikasi[]" value="'.$r_control_justifikasi["id_control_justifikasi"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
				
                            </div><!-- /.box -->
                            </form>
                        </div>
                    </div>

                </section><!-- /.content -->';

}else{
    $content ='
    <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master Control Justifikasi
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    
				    <h2> Sorry, You don\'t have permission to access this Page</h2>
                
				</div>
			    </div>
			</div>
		    </div>
       </section><!-- /.content -->';
    
}

//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '

        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Master Control Justifikasi';
    $submenu	= "master_cjustifikasi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>