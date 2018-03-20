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
    enableLog("", $loggedin["username"], $loggedin["username"], "Cetak Formulir");
    global $conn;
    global $conn_voip;
    $sql_masterformulir = mysql_query("SELECT * FROM `gx_formulir` WHERE `level` = '0' AND `id_formulir` = '$_GET[id]';",$conn);
    $row_masterformulir = mysql_fetch_array($sql_masterformulir);
    $content ='<section class="content-header">
                    <h1>
                        Cetak Formulir
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="cetak_formulir">Cetak Formulir</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">Cetak Formulir</h3>
				
				    <table width="100%" border="0" cellspacing="0" cellpadding="2" class="gwlines arborder">
					<tbody>
					    <tr>
						<td align="left" class="bgcolor_002">
						    <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
							    <td class="fontstyle_searchoptions" width="10%"> No. Formulir :
							    </td>
							    <td class="fontstyle_searchoptions" width="40%">
								<input class="form_input_text" type="text" name="id_formulir" value="'.$row_masterformulir["id_formulir"].'" placeholder="Id Formulir">
							    </td>
							    <td class="fontstyle_searchoptions" width="10%"> Cabang :
							    </td>
							    <td class="fontstyle_searchoptions" width="40%">
								<input class="form_input_text" type="text" name="cabang"  placeholder="cabang">
							    </td>
							</tr>
							</tbody>
						    </table>
						</td>
						<td align="left" class="bgcolor_003">
						</td>
					    </tr>
					    <tr>
						<td align="left" class="bgcolor_004">
						    <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
							    <td class="fontstyle_searchoptions" width="10%"> tanggal :
							    </td>
							    <td class="fontstyle_searchoptions" width="40%">
								<input class="form_input_text" type="text" name="tanggal" value="'.date("d-m-Y").'" placeholder="tanggal">
							    </td>
							    <td class="fontstyle_searchoptions" width="10%"> 
							    </td>
							    <td class="fontstyle_searchoptions" width="40%">
								
							    </td>
							</tr>
							</tbody>
						    </table>
						</td>
						
					    </tr>		
					    <tr>
						<td>
						<br />
						    <table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
							    <td class="fontstyle_searchoptions" width="60%"> 
								<table id="formulir" class="table table-bordered table-striped">
								    <thead>
									<tr>
									    
									    <th>Kode Formulir</th>
									    <th>Nama Formulir</th>
									    
									</tr>
								    </thead>
								    <tbody>';
								
								    $content .= '<tr>
										    
										    <td style="padding-top: 35px;" height="100px">'.$row_masterformulir['kode_formulir'].'</td>
										    <td style="padding-top: 35px;" height="100px">'.$row_masterformulir['nama_formulir'].'</td>
										    
										</tr>';
										
								    
								    $sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '$row_masterformulir[id_formulir]' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
								    $row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);
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
									     <form action="" role="form" method="post">
									    <!--<a href="'.URL_ADMIN.''.$row_masterformulir_detail["lokasi_file"].''.$row_masterformulir_detail["nama_file"].'" target="_BLANK" class="btn bg-olive btn-flat margin">Print</a>-->
									    <input class="form_input_text" type="hidden" name="id" value="'.$row_masterformulir_detail["id"].'">
									    <input class="form_input_text" type="hidden" name="link" value="'.URL_ADMIN.''.$row_masterformulir_detail["lokasi_file"].''.$row_masterformulir_detail["nama_file"].'">
									    <button type="submit" value="Print" name="save" class="btn btn-primary">Print</button>
									    
									    <br />
									    <a href="'.URL_ADMIN.'master_anyar/m_formulir" class="btn bg-olive btn-flat margin ">Cancel</a>
									      </form>
									   </td>
									</tr>
								</table>
							    </td>
							    
							</tr>
							</tbody>
						    </table>
						</td>
					    </tr>
					    
				    </tbody>
				    </table>
				
                                </div><!-- /.box-header -->
                                    
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    if(isset($_POST["save"])){
		
		$id_    = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
		$link   = isset($_POST['link']) ? mysql_real_escape_string(trim($_POST['link'])) : '';
		
		$sql_last_formulir_det  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_formulir_detail` ORDER BY `id` DESC", $conn));
		$last_data  = $sql_last_formulir_det["printed"] + 1;
			
			
			$sql_insert_file = "UPDATE `gx_formulir_detail` SET `printed` = '$last_data'  WHERE `id`='$id_'";
			
			mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
									       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
									       window.history.go(-1);
									   </script>");
			
			echo "<script language='JavaScript'>
				    alert('Data telah disimpan!');
				    location.href = '$link';
			    </script>";
			    
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Master Formulir';
    $submenu	= "formulir";
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