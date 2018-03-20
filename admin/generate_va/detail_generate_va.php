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
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "va";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `va` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "va";
    $redirect_action_lock = "master_generate_va.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail VA";
    $judul_table = "detail vs";
    
    //id web
    $title_header = 'Detail VA';
    $submenu_header = 'detail_va';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail VA");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `va` WHERE `id_table`='".$c_d."' AND `level`='0' ORDER BY `id_table` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);
    
        
    
    $id_table			= $data_d['id_table'];
    $retensi			= $data_d['retensi'];
    $frekuensi			= $data_d['frekuensi'];
    $laporan			= $data_d['laporan'];
    $tanggal			= $data_d['tanggal'];
    $cabang			= $data_d['cabang'];
    $jam			= $data_d['jam'];
    $kd_perusahaan		= $data_d['kd_perusahaan'];
    $halaman			= $data_d['halaman'];
    $total_transaksi		= $data_d['total_transaksi'];
    $jumlah			= $data_d['jumlah'];
    $komisi			= $data_d['komisi'];
    $check_sum_perusahaan	= $data_d['check_sum_perusahaan'];
    $date_add			= $data_d['date_add'];
    $date_upd			= $data_d['date_upd'];
    $user_add			= $data_d['user_add'];
    $user_upd			= $data_d['user_upd'];
    $level			= $data_d['level'];
    
    /*
    $id_table			= $data_r['id_table'];
    $id_foreign_key		= $data_r['id_foreign_key'];
    $nomor_urut			= $data_r['nomor_urut'];
    $nomor_pegawai		= $data_r['nomor_pegawai'];
    $nama			= $data_r['nama'];
    $nilai_transaksi		= $data_r['nilai_transaksi'];
    $tgl			= $data_r['tgl'];
    $waktu			= $data_r['waktu'];
    $lokasi			= $data_r['lokasi'];
    $berita_1			= $data_r['berita_1'];
    $berita_2			= $data_r['berita_2'];
    $date_add			= $data_r['date_add'];
    $date_upd			= $data_r['date_upd'];
    $user_add			= $data_r['user_add'];
    $user_upd			= $data_r['user_upd'];
    $level			= $data_r['level'];
    */
  
/*
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			';
			foreach($data_field as $field){
			    $content .= "<th>".$field."</th>";
			}
			
			$content .= '
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("".$select_all_data_valid." ".$urutan." LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query($select_all_data_valid, $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {	
	$content .= '<tr>
			<td></td>
			<td></td>
		    </tr>';
	$no++;
    }

$content .='</tbody>
</table>
*/  
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		     

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <!-- <h3 class="box-title">'.$judul_table.'</h3>     -->                               
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				 <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						 <label><center><h3>LAPORAN TRANSAKSI VIRTUAL ACCOUNT</h3></center>						
					    </div>
					    <div class="col-xs-6"><div class="col-xs-3">Retensi</div><div class="col-xs-9">'.$retensi.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">Frekuensi</div><div class="col-xs-9">'.$frekuensi.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">Laporan</div><div class="col-xs-9">'.$laporan.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">Tanggal</div><div class="col-xs-9">'.$tanggal.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">Cabang</div><div class="col-xs-9">'.$cabang.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">Jam</div><div class="col-xs-9">'.$jam.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">KD Perusahaan</div><div class="col-xs-9">'.$kd_perusahaan.'</div></div>
					    <div class="col-xs-6"><div class="col-xs-3">Halaman</div><div class="col-xs-9">'.$halaman.'</div></div>
					   
                                        </div>
				</div>
			    </div>
			</div>
		
		
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Va Detail</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				 <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<table id="example1" class="table table-bordered table-striped">
						<tr><th>Nomor Urut</th><th>Nomor Pengenal</th><th>Nama</th><th>Nilai Transaksi</th><th>Tgl</th><th>Waktu</th><th>Lokasi</th><th>Berita 1</th><th>Berita 2</th></tr>';
						$sql_va_detail = "SELECT * FROM `va_detail` WHERE `id_foreign_key`='".$c_d."' AND `level`='0'";
						$query_va_detail = mysql_query($sql_va_detail, $conn);
						while($r=mysql_fetch_array($query_va_detail)){
						    $nomor_urut = $r['nomor_urut'];
						    $nomor_pegawai = $r['nomor_pegawai'];
						    $nama = $r['nama'];
						    $nilai_transaksi = $r['nilai_transaksi'];
						    $tgl = $r['tgl'];
						    $waktu = $r['waktu'];
						    $lokasi = $r['lokasi'];
						    $berita_1 = $r['berita_1'];
						    $berita_2 = $r['berita_2'];
						    
						    $content .= '
							<tr><th>'.$nomor_urut.'</th><th>'.$nomor_pegawai.'</th><th>'.$nama.'</th><th>'.$nilai_transaksi.'</th><th>'.$tgl.'</th><th>'.$waktu.'</th><th>'.$lokasi.'</th><th>'.$berita_1.'</th><th>'.$berita_2.'</th></tr>
						    ';
						}
						$content .= '
						</table>
					    </div>
                                        </div>
				  </div>
				</div>
			    </div>
			    
			    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-body table-responsive">
				 <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						    <div class="col-xs-6"><div class="col-xs-3">Total Transaksi</div><div class="col-xs-3">'.$total_transaksi.'</div><div class="col-xs-3">Jumlah</div><div class="col-xs-3">'.$jumlah.'</div></div>
						    <div class="col-xs-6"><div class="col-xs-3">Komisi</div><div class="col-xs-3">'.$komisi.'</div></div>
						    <div class="col-xs-12"><div class="col-xs-3">Check Sum Perusahaan</div><div class="col-xs-9">'.$check_sum_perusahaan.'</div></div>
					    </div>
                                        </div>
				  </div>
				</div>
			    </div>
			     
		</div>
		';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>