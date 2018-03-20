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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data marketing");
    global $conn;
    
    
  $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  $return_file 	= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
  
  if($return_file == 'kenaikan_gaji'){
   $label = 'Data Kenaikan Gaji';
  }elseif($return_file == ''){
   $label = '';
  }
    $content ='<section class="content-header">
                    <h1>
                        '.$label.'
		    </h1>
               </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->';
		
if($return_file == 'kenaikan_gaji'){				
$content .= '				
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td width="12.5%">
			  <label>No Kenaikan gaji</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="id_employee" placeholder="No Kenaikan Gaji" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>Kode</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="kode" placeholder="Kode" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Tanggal</label>
			</td>
			<td>
			  <input class="form-control" name="tanggal" placeholder="Tanggal" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama</label>
			</td>
			<td>
			  <input class="form-control" name="nama" placeholder="Nama" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
	
        if(isset($_POST["save_search"])){
	 //SELECT `id`, `id_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
                $no_kenaikan_gaji	= isset($_POST['no_kenaikan_gaji']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_kenaikan_gaji']))) : "";
                $kode			= isset($_POST['kode']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode']))) : "";
                $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
		$nama			= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
		
                
                $sql_no_kenaikan_gaji	= ($no_kenaikan_gaji != "") ? "AND `no_kenaikan_gaji` LIKE '".$no_kenaikan_gaji."%'": "";
                $sql_kode		= ($kode != "") ? "AND `kode` LIKE '%".$kode."%'" : "";
                $sql_tanggal		= ($tanggal != "") ? "AND `tanggal` LIKE '%".$tanggal."%'": "";
		$sql_nama		= ($nama != "") ? "AND `nama` LIKE '%".$nama."%'": "";
                
                $sql_employee	= "SELECT * FROM `gx_master_kenaikan_gaji`
                WHERE `level` = '0'
                $sql_no_kenaikan_gaji
                $sql_kode
                $sql_tanggal
		$sql_nama
		ORDER BY `nama` ASC LIMIT 0,10;";
	}else{
		$sql_employee	= "SELECT * FROM `gx_master_kenaikan_gaji`
                WHERE `level` = '0'
                ORDER BY `nama` ASC LIMIT 0,10;";
	}
                
		
		
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>No Kenaikan Gaji</th>
			    <th>Kode Staff</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kenaikan Ke</th>
                            <th>Level</th>
                            <th>Selisih</th>
                            <th>Gaji Pokok Lama</th>
                            <th>Gaji Pokok Naik</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_employee	= mysql_query($sql_employee, $conn);
        $no = 1;
        
            while ($row_employee = mysql_fetch_array($query_employee)) {
                 $content .='<tr>
                            <td>'.$row_employee["no_kenaikan_gaji"].'</td>
                            <td>'.$row_employee["kode"].'</td>
                            <td>'.$row_employee["tanggal"].'</td>
                            <td>'.$row_employee["nama"].'</td>
                            <td>'.$row_employee["kenaikan_ke"].'</td>
                            <td>'.$row_employee["level"].'</td>
                            <td>'.$row_employee["selisih"].'</td>
                            <td>'.$row_employee["gaji_pokok_lama"].'</td>
                            <td>'.$row_employee["gaji_pokok_naik"].'</td>
			    
                            <td><a href="" onclick="validepopupform2(
					    \''.mysql_real_escape_string($row_employee["id_kenaikan_gaji"]).'\',
					    \''.mysql_real_escape_string($row_employee["no_kenaikan_gaji"]).'\',
					    \''.mysql_real_escape_string($row_employee["kode"]).'\',
					    \''.mysql_real_escape_string($row_employee["tanggal"]).'\',
					    \''.mysql_real_escape_string($row_employee["nama"]).'\',
					    \''.mysql_real_escape_string($row_employee["kenaikan_ke"]).'\',
					    \''.mysql_real_escape_string($row_employee["level_gaji"]).'\',
					    \''.mysql_real_escape_string($row_employee["selisih"]).'\',
					    \''.mysql_real_escape_string($row_employee["gaji_pokok_lama"]).'\',
					    \''.mysql_real_escape_string($row_employee["gaji_pokok_naik"]).'\',
					    \''.mysql_real_escape_string($row_employee["tunjangan_jabatan_lama"]).'\',
					    \''.mysql_real_escape_string($row_employee["tunjangan_jabatan_naik"]).'\',
					    \''.mysql_real_escape_string($row_employee["dana_pensiun_lama"]).'\',
					    \''.mysql_real_escape_string($row_employee["dana_pensiun_naik"]).'\',
					    \''.mysql_real_escape_string($row_employee["jamsostek_lama"]).'\',
					    \''.mysql_real_escape_string($row_employee["jamsostek_naik"]).'\',
					    \''.mysql_real_escape_string($row_employee["insentif_hadir_lama"]).'\',
					    \''.mysql_real_escape_string($row_employee["insentif_hadir_naik"]).'\',
					    \''.mysql_real_escape_string($row_employee["total_gaji_lama"]).'\',
					    \''.mysql_real_escape_string($row_employee["total_gaji_naik"]).'\',
					    \''.mysql_real_escape_string($row_employee["remarks"]).'\'
			    )">Select</a>
                            </td>
                            </tr>';
                $no++;
            }
                        
                          $content .='
                          
                        </tbody>
                      </table>';
                      

		$content .='</form>';
}
		
$content .= '		
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';
$plugins = '';		
if($return_form == 'form_acc_kenaikan_gaji'){	    
$plugins .= '<script type=\'text/javascript\'>
	function validepopupform2(input_id_kenaikan_gaji, input_no_kenaikan_gaji, input_kode, input_tanggal, input_nama, input_kenaikan_ke, input_level_gaji, input_selisih, input_gaji_pokok_lama, input_gaji_pokok_naik, input_tunjangan_jabatan_lama, input_tunjangan_jabatan_naik, input_dana_pensiun_lama, input_dana_pensiun_naik, input_jamsostek_lama, input_jamsostek_naik, input_insentif_hadir_lama, input_insentif_hadir_naik, input_total_gaji_lama, input_total_gaji_naik, input_remarks){
                
		window.opener.document.'.$return_form.'.no_kenaikan_gaji.value=input_no_kenaikan_gaji;
		window.opener.document.'.$return_form.'.kode.value=input_kode;
		window.opener.document.'.$return_form.'.tanggal.value=input_tanggal;
		window.opener.document.'.$return_form.'.nama.value=input_nama;
		window.opener.document.'.$return_form.'.kenaikan_ke.value=input_kenaikan_ke;
		window.opener.document.'.$return_form.'.level_gaji.value=input_level_gaji;
		window.opener.document.'.$return_form.'.selisih.value=input_selisih;
		window.opener.document.'.$return_form.'.gaji_pokok_lama.value=input_gaji_pokok_lama;
		window.opener.document.'.$return_form.'.gaji_pokok_naik.value=input_gaji_pokok_naik;
		window.opener.document.'.$return_form.'.tunjangan_jabatan_lama.value=input_tunjangan_jabatan_lama;
		window.opener.document.'.$return_form.'.tunjangan_jabatan_naik.value=input_tunjangan_jabatan_naik;
		window.opener.document.'.$return_form.'.dana_pensiun_lama.value=input_dana_pensiun_lama;
		window.opener.document.'.$return_form.'.dana_pensiun_naik.value=input_dana_pensiun_naik;
		window.opener.document.'.$return_form.'.jamsostek_lama.value=input_jamsostek_lama;
		window.opener.document.'.$return_form.'.jamsostek_naik.value=input_jamsostek_naik;
		window.opener.document.'.$return_form.'.insentif_hadir_lama.value=input_insentif_hadir_lama;
		window.opener.document.'.$return_form.'.insentif_hadir_naik.value=input_insentif_hadir_naik;
		window.opener.document.'.$return_form.'.total_gaji_lama.value=input_total_gaji_lama;
		window.opener.document.'.$return_form.'.total_gaji_naik.value=input_total_gaji_naik;
		window.opener.document.'.$return_form.'.remarks.value=input_remarks;		
		self.close();
        }
</script>';
}elseif($return_form == 'cek_daily_report'){	    
$plugins .= '<script type=\'text/javascript\'>
	function validepopupform2(ckode,  nstaff){
                window.opener.document.'.$return_form.'.kode_pegawai.value=ckode;
                window.opener.document.'.$return_form.'.nama_pegawai.value=nstaff;
		self.close();
        }
</script>';
}
else{
$plugins .= '
<script type=\'text/javascript\'>
	function validepopupform2(ckode,  nstaff){
                window.opener.document.'.$return_form.'.kode.value=ckode;
                window.opener.document.'.$return_form.'.nama.value=nstaff;
		self.close();
        }
</script>';
}

$plugins .= '
<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#tech\').dataTable({
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

    $title	= 'Form Data Teknisi';
    $submenu	= "master_inactive";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>