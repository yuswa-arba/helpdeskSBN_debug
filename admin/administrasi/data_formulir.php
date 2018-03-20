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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Formulir");
    global $conn;
    
    
  $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $content ='<section class="content-header">
                    <h1>
			Data Formulir                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Formulir</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td>
			  <label>Kode Formulir</label>
			</td>
			<td>
			  <input class="form-control" name="kode_formulir" placeholder="Kode Formulir" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama Formulir</label>
			</td>
			<td>
			  <input class="form-control" name="nama_formulir" placeholder="Nama Formulir" type="text" value="">
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
                $kode_formulir	= isset($_POST['kode_formulir']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_formulir']))) : "";
                $nama_formulir	= isset($_POST['nama_formulir']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_formulir']))) : "";
                
                $sql_kode	= ($kode_formulir != "") ? "AND `kode_cetak_formulir` LIKE '".$kode_formulir."%'": "";
                $sql_nama	= ($nama_formulir != "") ? "AND `nama_formulir` LIKE '%".$nama_formulir."%'": "";
                
                $sql_execution	= "SELECT * FROM `v_cetakformulir`
                WHERE `level` = '0'
                $sql_kode
                $sql_nama
                ORDER BY `id_formulir` ASC LIMIT 0,10;";
	}else{
		$sql_execution	= "SELECT * FROM `v_cetakformulir`
                WHERE `level` = '0'
                ORDER BY `id_formulir` ASC LIMIT 0,10;";
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>Kode Cetak Formulir</th>
                            <th>Nama Formulir</th>
							<th>User Print</th>
                            <th>Tanggal Cetak</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_execution	= mysql_query($sql_execution, $conn);
        $no = 1;
        
            while ($row_execution = mysql_fetch_array($query_execution)) {
               
		  
		$content .='<tr>
                            <td>'.$row_execution["kode_cetak_formulir"].'</td>
                            <td>'.$row_execution["nama_formulir"].'</td>
							<td>'.$row_execution["nama"].'</td>
                            <td>'.date("Y-m-d", strtotime($row_execution["date_add"])).'</td>
                            <td>';
                            $content .= '<a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_execution["kode_cetak_formulir"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_execution["nama_formulir"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_execution["nama"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_execution["id_marketing"]).'\',';
							$content .= '\''.mysql_real_escape_string(date("Y-m-d", strtotime($row_execution["date_add"]))).'\')">Select</a>'; 
                            $content .= '</td>
                            </tr>';
                $no++;
            }
                        
                          $content .='
                          
                        </tbody>
                      </table>';
                      

		$content .='</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
if(isset($_GET["f"])){
 if($_GET["f"] == "data_formulir"){
  $plugins .= '<script type=\'text/javascript\'>
		      function validepopupform2(kodeFormulir, nf, n, idm, tgl){
			      window.opener.document.'.$return_form.'.kode_formulir.value=kodeFormulir;
				  window.opener.document.'.$return_form.'.nama_formulir.value=nf;
				  window.opener.document.'.$return_form.'.user_print.value=n;
				  window.opener.document.'.$return_form.'.id_marketing.value=idm;
				  window.opener.document.'.$return_form.'.tgl_cetak.value=tgl;
			      self.close();
		      }
	      </script>';
 }
}else{
 $plugins .= '<script type=\'text/javascript\'>
		      function validepopupform2(uid,  nama){
			      window.opener.document.'.$return_form.'.id_teknisi.value=uid;
			      window.opener.document.'.$return_form.'.nama_teknisi.value=nama;
			      self.close();
		      }
	      </script>
	      ';
}


    $title	= 'Data teknisi';
    $submenu	= "data_teknisi";
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