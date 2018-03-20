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
    if($loggedin["group"] == 'admin')
    {
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Surat");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_surat` WHERE `id_surat`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-11">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Surat</h3>
                                </div><!-- /.box-header -->
								<div class="box-body table-responsive">
                                <!-- form start -->
                                <form action="" method="post" name="form_forgot" id="form_forgot">
									<div class="col-sm-5">
									<!-- Iforgot -->
									  <h3 class="hl top-zero"></h3>
									  <hr>
									  <h5 class="hl top-zero">Kode Surat</h5>
									  <input type="text" class="form-control" id="kode_surat" name="kode_surat" placeholder="'.$row_data["kode_surat"].'"><br>
									  <h5 class="hl top-zero">Nama Surat</h5>
									  <input type="text" class="form-control" id="nama_surat" name="nama_surat" placeholder="'.$row_data["nama_surat"].'"><br>
									  <h5 class="hl top-zero">Tgl Expired</h5>
									  <input type="text" class="form-control" id="tgl_expired" name="tgl_expired" placeholder="'.$row_data["exp_date"].'"><br>
									  <input type="hidden" class="form-control" id="no_hp" name="no_hp" placeholder="'.$row_data["no_hp"].'">
									  <span class="input-group-btn">
										<button type="submit" name="sent" value="sentto" class="btn btn-default">Submit</button>
									  </span>
									  <hr>
									</div>
								</form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

$submit = isset($_POST["sent"]) ? $_POST["sent"] : "";

	if($submit == "sentto"){
	    $kode_surat	   		= isset($_POST['kode_surat']) ? mysql_real_escape_string(trim($_POST['kode_surat'])) : '';
		$nama_surat   		= isset($_POST['nama_surat']) ? mysql_real_escape_string(trim($_POST['nama_surat'])) : '';
		$tgl_expired    	= isset($_POST['tgl_expired']) ? mysql_real_escape_string(trim($_POST['tgl_expired'])) : '';
		$no_hp		 		= isset($_POST['no_hp']) ? mysql_real_escape_string(trim($_POST['no_hp'])) : '';
		
		$mail_to = '';
		$mail_name = '';
		$mail_subject = '';
		$mail_body = '';
		
        send_mail($mail_to,$mail_name,$mail_subject, $mail_body);
		
			echo "<script language='JavaScript'>
				alert('success');
				location.href = 'master_surat.php';
				</script>";
		
		    }
	    
    
	}
		

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		';

    $title	= 'Form Surat';
    $submenu	= "surat";
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