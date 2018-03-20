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
require_once '../helpdesk/mailer/class.phpmailer.php';
require_once '../helpdesk/mailer/class.smtp.php';
require_once 'po_pdf.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_setuju_pembelian	= isset($_POST['kode_setuju_beli']) ? mysql_real_escape_string(trim($_POST['kode_setuju_beli'])) : '';
    
    $kode_order_beli	= isset($_POST['kode_order_beli']) ? mysql_real_escape_string(trim($_POST['kode_order_beli'])) : '';
    $kode_supplier	= isset($_POST['kode_supplier']) ? mysql_real_escape_string(trim($_POST['kode_supplier'])) : '';
    $kode_shipping	= isset($_POST['kode_shipping']) ? mysql_real_escape_string(trim($_POST['kode_shipping'])) : '';
    $nama_shipping	= isset($_POST['nama_shipping']) ? mysql_real_escape_string(trim($_POST['nama_shipping'])) : '';
    $nama_supplier	= isset($_POST['nama_supplier']) ? mysql_real_escape_string(trim($_POST['nama_supplier'])) : '';
    $mu		 	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $ppn	 	= isset($_POST['ppn']) ? mysql_real_escape_string(trim($_POST['ppn'])) : '';
    $estimasi	 	= isset($_POST['estimasi']) ? mysql_real_escape_string(trim($_POST['estimasi'])) : '';
    $tgl_datang	 	= isset($_POST['tgl_datang']) ? mysql_real_escape_string(trim($_POST['tgl_datang'])) : '';
    $term_payment 	= isset($_POST['term_payment']) ? mysql_real_escape_string(trim($_POST['term_payment'])) : '';
    $shipping_remark 	= isset($_POST['shipping_remark']) ? mysql_real_escape_string(trim($_POST['shipping_remark'])) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    
    
    if($kode_setuju_pembelian != "" && $kode_order_beli !=""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_order_beli` (`id_order_beli`, `id_cabang`, `nama_cabang`, `tanggal`,
    `kode_order_beli`, `kode_setuju_pembelian`, `kode_supplier`, `nama_supplier`, `term_payment`, `keterangan`,
    `estimasi`, `tgl_datang`, `kode_shipping`, `nama_shipping`, `mu`, `shipping_remark`, `ppn`,
    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES ('', '".$id_cabang."', '".$nama_cabang."', '".$tanggal."', '".$kode_order_beli."', '".$kode_setuju_pembelian."',
    '".$kode_supplier."', '".$nama_supplier."', '".$term_payment."', '".$keterangan."',
    '".$estimasi."', '".$tgl_datang."', '".$kode_shipping."', '".$nama_shipping."', '".$mu."', '".$shipping_remark."', '".$ppn."',
    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";

    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
					    alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
					    window.history.go(-1);
					</script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
 
$pdf = generate_pdf($kode_order_beli);

$emailAttachment = '../upload/po/PO_'.$kode_order_beli.'.pdf';

$message = "Email otomatis";

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = false;                  // enable SMTP authentication
	$mail->Host 	  = "smtp.dps.globalxtreme.net";        // specify main and backup server
	$mail->Port       = 2505; 

	$mail->IsSendmail();  // tell the class to use Sendmail
	$mail->AddReplyTo("helpdesk@globalxtreme.net","Helpdesk");

	$mail->From       = "helpdesk@globalxtreme.net";
	$mail->FromName   = "Helpdesk";

	$to = "cindie@globalxtreme.net";

	$mail->AddAddress($to);
	$mail->AddCC("dwi@globalxtreme.net");

	$mail->Subject  = "PURCHASE ORDER $kode_order_beli";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($message);
	$mail->AddAttachment($emailAttachment);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	
	echo "<script language='JavaScript'>
	alert('Data telah dikirim ke email ".$to."');
	window.location.href='master_order_beli.php';
	</script>";
	//echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
    
   
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
    
    
}


if(isset($_GET["c"]))
{
    $kode_beli		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_data 	= "SELECT * FROM `gx_order_beli`
			    WHERE `kode_order_beli` = '".$kode_beli."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);

}
$selected_ppn	= isset($_GET["id"]) ? $row_data["ppn"] : "";


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Order Pembelian</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="" role="form" name="form_order_beli" id="form_order_beli" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["c"]) ? $row_data["nama_cabang"] : "").'"
						onclick="return valideopenerform(\'data_cabang.php?r=form_order_beli&f=order_beli\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET["c"]) ? $row_data["id_cabang"] : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal"  value="'.(isset($_GET["c"]) ? $row_data["tanggal"] : date("Y-m-d")).'" >
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Order Beli</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_order_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_order_beli"] : "").'" >
					    </div>
					    
					    <div class="col-xs-2">
						<label>No Persetujuan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_setuju_beli" id="kode_setuju_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_setuju_beli"] : "").'"
						onclick="return valideopenerform(\'data_setujubeli.php?r=form_order_beli&f=order_beli\',\'setuju_beli\');">
						<a id="linkk" name="linkk" href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(this);">Detail Barang</a>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Supplier</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control" readonly="" required="" name="kode_supplier" id="kode_supplier" value="'.(isset($_GET["c"]) ? $row_data["kode_supplier"] : "").'">
						
						<input type="text" class="form-control" readonly="" required="" name="nama_supplier" id="nama_supplier" value="'.(isset($_GET["c"]) ? $row_data["nama_supplier"] : "").'"
						onclick="return valideopenerform(\'data_supplier.php?r=form_order_beli&f=order_beli\',\'supplier\');">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<select name="mu" class="form-control">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'" '.((isset($_GET["c"]) AND $row_data['mu'] == $row_matauang['kode_matauang']) ? "select" : '').'>'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
					    </div>
					    <div class="col-xs-2">
						<label>Term Payment</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  maxlength="3" required="" name="term_payment" id="term_payment" value="'.(isset($_GET["c"]) ? $row_data["term_payment"] : "").'" Placeholder="dalam hari">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="keterangan" style="resize:none;">'.(isset($_GET['c']) ? $row_data["keterangan"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Estimasi Kedatangan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" maxlength="3" id="estimasi" name="estimasi" value="'.(isset($_GET["c"]) ? $row_data["estimasi"] : "").'" >
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal Datang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="tgl_datang" name="tgl_datang"  value="'.(isset($_GET["c"]) ? $row_data["tgl_datang"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping By</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_shipping" value="'.(isset($_GET["c"]) ? $row_data["kode_shipping"] : "").'">
						<input type="text" readonly="" class="form-control" required="" name="nama_shipping" value="'.(isset($_GET["c"]) ? $row_data["nama_shipping"] : "").'"
						onclick="return valideopenerform(\'data_shipping.php?r=form_order_beli&f=order_beli\',\'shipping\');">
					    </div>
					    
					    
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping Mark</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="shipping_remark" style="resize:none;">'.(isset($_GET['c']) ? $row_data["shipping_remark"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>PPN 10%</label>
					    </div>
					    <div class="col-xs-3">
						<input id="link" type="radio" name="ppn" value="yes" '.(($selected_ppn == "yes") ? ' checked=""' : "").' /> Yes &nbsp;
						<input id="link"  type="radio" name="ppn" value="no" '.(($selected_ppn == "no") ? ' checked=""' : "").' /> No &nbsp;
					    
					    </div>
                                        </div>
					</div>
                                        
                                    </div><!-- /.box-body -->
				    
				   <div class="box-footer">
					<button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0
	    });
        </script>
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
			
			// Correct
function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

// TEST
function formatDate(date) {
    return (date.getMonth() + 1) + \'/\' + date.getDate() + \'/\' + date.getFullYear();
}
			
			$(document).ready(function(){
		$("#estimasi").keyup(function(){
		    var data = parseInt($("#estimasi").val());
		    var date = new Date();
			var tgl = formatDate(addDays(date, data));
			
		    $("#tgl_datang").val(tgl);
		});
	    });
        </script>
';

    $title	= 'Form Order Beli';
    $submenu	= "master_order_beli";
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