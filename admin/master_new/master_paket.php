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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Paket");
    global $conn;
    
    if(isset($_POST["hapus"]))
    {
        $id_paket = array();
        $id_paket = isset($_POST["id_paket"]) ? $_POST["id_paket"] : $id_paket;
        
        foreach($id_paket as $key => $value)
        {
            $query = "UPDATE `gx_paket2` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_paket` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'master_paket.php');
    }
    
    $content ='<section class="content-header">
                    <h1>
                        Master Paket
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                   <h3 class="box-title">List Paket</h3>
				   <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'master_paket.php">Semua Paket</a>
					</div>
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'form_paket.php">Tambah Paket</a>
					</div>
					<!--<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'master_paket.php?q=bundling">Paket Bundling</a>
					</div>
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'form_paket_bundling.php">Tambah Paket Bundling</a>
					</div>-->
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Paket</th>
						<th>Cabang</th>
                                                <th>Periode Paket</th>
                                                <th>Harga</th>
                                                
						<th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_masterPaket = mysql_query("SELECT * FROM `gx_paket2`
				  WHERE `gx_paket2`.`level` = '0';", $conn);
$no = 1;
while ($row_masterPaket = mysql_fetch_array($sql_masterPaket))
{
     $sql_cabang = mysql_query("SELECT `nama_cabang` FROM `gx_cabang`
			      WHERE `id_cabang` = '".$row_masterPaket["id_cabang"]."'
			      AND `gx_cabang`.`level` = '0';", $conn);
     $row_cabang = mysql_fetch_array($sql_cabang);
     
     $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterPaket["nama_paket"].'</td>
		    <td>'.(($row_masterPaket["id_cabang"] == "0") ? "Semua Cabang" : $row_cabang["nama_cabang"]).'</td>
		    <td>'.$row_masterPaket["periode_start"].' s/d '.$row_masterPaket["periode_end"].'</td>
		    <td>'.Rupiah($row_masterPaket["monthly_fee"]).' / '.$row_masterPaket["monthly_for"].' bulan</td>
		    <td align="center">
		    <a href="form_paket.php?id='.$row_masterPaket['id_paket'].'"><span class="label label-info">Edit</span></a> |
		    <a href="master/detail_paket.php?id='.$row_masterPaket['id_paket'].'"><span class="label label-info">Detail</span></a></td>
		    <td><input type="checkbox" name="id_paket[]" value="'.$row_masterPaket["id_paket"].'"></td>
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

    $title	= 'Master Paket';
    $submenu	= "paket";
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