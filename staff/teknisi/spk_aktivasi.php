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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List SPK Aktivasi");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">List SPK Aktivasi</h3>
                                </div><!-- /.box-header -->
                                    <table id="persetujuan" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. SPK Aktivasi</th>
                                                <th>No. SPK Pasang</th>
                                                <th>Nama Cust</th>
                                                <th>Alamat</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_employee = mysql_query("SELECT * FROM `gx_pegawai` WHERE `id_employee` = '$loggedin[id_employee]';",$conn);
$row_employee = mysql_fetch_array($sql_employee);
$sql_spk_aktivasi = mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `level` = '0' AND `id_teknisi` = '$row_employee[kode_pegawai]' ORDER BY `id_spkaktivasi` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_spk_aktivasi = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `level` = '0' AND `id_teknisi` = '$row_employee[kode_pegawai]' ORDER BY `id_spkaktivasi` DESC;",$conn));
$hal	= "?";
$no = 1 + $start;
while ($row_spk_aktivasi= mysql_fetch_array($sql_spk_aktivasi))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_spk_aktivasi['kode_spkaktivasi'].'</td>
		    <td>'.$row_spk_aktivasi['kode_spkpasang'].'</td>
		    <td>'.$row_spk_aktivasi['nama_customer'].'</td>
		    <td>'.$row_spk_aktivasi['alamat'].'</td>
		    <td align="center">
		    <a href="spk_aktivasi_pdf?id_spk='.$row_spk_aktivasi['id_spkaktivasi'].'" target="_blank">View PDF</a>
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table> 
				    
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <div class="box-tools pull-right">
				    '.(halaman($sql_total_spk_aktivasi, $perhalaman, 1, $hal)).'
				    </div>
				    <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '
			<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
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

    $title	= 'Master SPK Aktivasi';
    $submenu	= "spk_aktivasi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
    
    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>