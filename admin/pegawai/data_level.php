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
  
  if($return_file == 'data_level'){
   $label = 'Data Level';
  }elseif($return_file == ''){
   $label = '';
  }else{
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
		
if($return_file == 'data_level'){				
$content .= '				
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td width="12.5%">
			  <label>Kode Level</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="kode_level" placeholder="kode Level" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>Nama Level</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="nama_level" placeholder="nama level" type="text" value="">
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
                $kode_level	= isset($_POST['kode_level']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_level']))) : "";
                $nama_level	= isset($_POST['nama_level']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_level']))) : "";
		
                
                $sql_kode_level	= ($kode_level != "") ? "AND `kode_level` LIKE '".$kode_level."%'": "";
                $sql_nama_level	= ($nama_level != "") ? "AND `nama_level` LIKE '%".$nama_level."%'" : "";
                
                $sql_bagian	= "SELECT * FROM `gx_tblevel`
                WHERE `level` = '0'
                $sql_kode_level
                $sql_nama_level
		ORDER BY `nama_level` ASC LIMIT 0,10;";
	}else{
		$sql_bagian	= "SELECT * FROM `gx_tblevel`
                WHERE `level` = '0'
                ORDER BY `nama_level` ASC LIMIT 0,10;";
	}
                
		
		
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>Kode Level</th>
			    <th>Nama Level</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_bagian	= mysql_query($sql_bagian, $conn);
        $no = 1;
        
            while($row_bagian = mysql_fetch_array($query_bagian)){
                 $content .='<tr>
                            <td>'.$row_bagian["kode_level"].'</td>
                            <td>'.$row_bagian["nama_level"].'</td>
			    
                            <td><a href="" onclick="validepopupform2(
					    \''.mysql_real_escape_string($row_bagian["kode_level"]).'\',
					    \''.mysql_real_escape_string($row_bagian["nama_level"]).'\'
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
if($return_form == 'form_job_list'){	    
$plugins .= '<script type=\'text/javascript\'>
	function validepopupform2(input_kode_level, input_nama_level){
                window.opener.document.'.$return_form.'.level_master.value=input_nama_level;
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