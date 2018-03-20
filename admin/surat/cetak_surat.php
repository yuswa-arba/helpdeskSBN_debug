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
    enableLog("", $loggedin["username"], $loggedin["username"], "Cetak Surat");
    global $conn;
    global $conn_voip;
   
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">Cetak Surat</h3>
				</div>
				<form role="form" name="myForm" method="POST" action="" target="_blank">
				
				<div class="form-group">
				<div class="row">
				    <div class="col-xs-3">
					<label>Cabang</label>
				    </div>
				    <div class="col-xs-6">
					<input class="form-control" readonly="" type="text" id="nama_cabang" name="nama_cabang" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=cetak_surat\',\'cabang\');"  placeholder="cabang">
					<input class="form-control" readonly="" type="hidden" id="kode_cabang" name="kode_cabang"  placeholder="cabang">
				    </div>
				</div>
				</div>
				<div class="form-group">
				<div class="row">
				    <div class="col-xs-3">
					<label>Tanggal</label>
				    </div>
				    <div class="col-xs-6">
					<input class="form-control" type="text" readonly="" name="tanggal" value="'.date("Y-m-d").'" placeholder="tanggal">
				    </div>
				</div>
				</div>
				<div class="form-group">
				<div class="row">
				    <div class="col-xs-3">
					<label>Kode Cetak Surat</label>
				    </div>
				    <div class="col-xs-6">
					<input type="text" readonly="" class="form-control" required id="kode_cetak_surat" name="kode_cetak_surat" value="'.(isset($_GET['id']) ? $row_mastersurat["kode_cetak_surat"] : "").'">
				    </div>
				</div>
				</div>
				<div class="form-group">
				<div class="row">
				    <div class="col-xs-3">
					<label>Keperluan</label>
				    </div>
				    <div class="col-xs-6">
					<input type="text" class="form-control" required id="keperluan" name="keperluan" value="'.(isset($_GET['id']) ? $row_mastersurat["keperluan"] : "").'">
				    </div>
				</div>
				</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tbody>
			    <tr>
				<td class="fontstyle_searchoptions" width="60%"> 
				    <table id="formulir" class="table table-bordered table-striped">
					<thead>
					    <tr>
						
						<th>Kode Surat</th>
						<th>Nama Surat</th>
						<th> # </th>
						
					    </tr>
					</thead>
					<tbody>';
					$sql_mastersurat = mysql_query("SELECT * FROM `gx_surat` WHERE `level` = '0';",$conn);
					
					while ($row_mastersurat = mysql_fetch_array($sql_mastersurat)){
					$content .= '<tr>
							<td>'.$row_mastersurat['kode_surat'].'</td>
							<td>'.$row_mastersurat['nama_surat'].'</td>
							<td><input type="radio" name="id_surat" value="'.$row_mastersurat["kode_surat"].'"></td>
							
						    </tr>';
						    
					}
					$sql_mastersurat_detail = mysql_query("SELECT * FROM `gx_surat_detail` WHERE `level` = '0' AND `id_surat_detail` = '$row_mastersurat[id_surat]' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
					$row_mastersurat_detail = mysql_fetch_array($sql_mastersurat_detail);
					$content .= '
					    
					</tbody>
				    </table>
				</td>
				<td class="fontstyle_searchoptions" width="5%">
				    
				</td>
				<td class="fontstyle_searchoptions" width="35%">
				    <table border="0" >
					    <tr align="center">
					       <td align="center">
						
						<!--<a href="'.URL_ADMIN.''.$row_mastersurat_detail["lokasi_file"].''.$row_mastersurat_detail["nama_file"].'" target="_BLANK" class="btn bg-olive btn-flat margin">Print</a>-->
						<input class="form_input_text" type="hidden" name="id" value="'.$row_mastersurat_detail["id"].'">
						<input class="form_input_text" type="hidden" name="link" value="'.URL_ADMIN.''.$row_mastersurat_detail["lokasi_file"].''.$row_mastersurat_detail["nama_file"].'">
						<button type="submit" value="Print" name="save" class="btn btn-primary">Print</button>
						
						<br />
						<a href="'.URL_ADMIN.'surat/master_surat" class="btn bg-olive btn-flat margin ">Cancel</a>
					    
					       </td>
					    </tr>
				    </table>
				</form>
                                </div><!-- /.box-header -->
                                    
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    if(isset($_POST["save"])){
		
		$id_cabang	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
		$kode_cetak	= isset($_POST['kode_cetak_surat']) ? mysql_real_escape_string(trim($_POST['kode_cetak_surat'])) : '';
		$tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
		$id_surat	= isset($_POST['id_surat']) ? mysql_real_escape_string(trim($_POST['id_surat'])) : '';
		$keperluan	= isset($_POST['keperluan']) ? mysql_real_escape_string(trim($_POST['keperluan'])) : '';
		
		$sql_last_cetak  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cetak_surat` ORDER BY `id_cetak_surat` DESC", $conn));
		$last_data  = $sql_last_cetak["id_cetak_surat"] + 1;
			
			
			$sql_insert = "INSERT INTO `gx_cetak_surat`(`id_cetak_surat`, `kode_cabang`, `kode_cetak_surat`, `keperluan`, `tanggal`,
									`id_surat`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
								VALUES ('', '".$id_cabang."', '".$kode_cetak."', '".$keperluan."', '".$tanggal."',
									'".$id_surat."', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
			//echo $sql_insert;
			mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
									       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
									       window.history.go(-1);
									   </script>");
			
			echo header('location: print_surat.php?id='.$last_data.'');
			  
			    
	    }

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

    $title	= 'Cetak Surat';
    $submenu	= "surat";
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