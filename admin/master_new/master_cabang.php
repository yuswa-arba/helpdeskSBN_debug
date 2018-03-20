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
        $id_cabang = array();
        $id_cabang = isset($_POST["id_cabang"]) ? $_POST["id_cabang"] : $id_cabang;
        
        foreach($id_cabang as $key => $value)
        {
            $query = "UPDATE `gx_cabang` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_cabang` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'master_cabang.php');
    }
    
    
    $content ='<section class="content-header">
                    <h1>
                        Master Cabang
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_cabang">Master Cabang</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Cabang</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 120px">Nama Cabang</th>
                                                <th style="width: 220px">Alamat Cabang</th>
                                                <th>Kota</th>
                                                <th>Phone</th>
						<th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_cabang = mysql_query("SELECT * FROM `gx_cabang`
				  WHERE `level` = '0' ORDER BY `nama_cabang` ASC;", $conn);
$no = 1;
while ($row_cabang = mysql_fetch_array($sql_cabang))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_cabang["nama_cabang"].'</td>
		    <td>'.$row_cabang["alamat_cabang"].'</td>
		    <td>'.$row_cabang["kota_cabang"].'</td>
		    <td>'.$row_cabang["telp_cabang"].'</td>
		    
		    <td align="center">
		    <span class="label label-info"><a href="form_cabang.php?id='.$row_cabang['id_cabang'].'">Edit</a></span> |
		    <span class="label label-info">Detail</span></td>
		    <td><input type="checkbox" name="id_cabang[]" value="'.$row_cabang["id_cabang"].'"></td>
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

    $title	= 'Master Cabang';
    $submenu	= "cabang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>