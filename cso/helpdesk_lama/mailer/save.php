<?php
/*
 * Theme Name: IPTV VOD Template
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Februari 2013
 * Email: 
 * Theme for http://202.58.200.70/iptv
 */
session_start();
ob_start();

//file configuration for database and create session.
include ("config/configuration.php");
require_once('../billing/plugins/phpmailer/class.phpmailer.php');

if($loggedin = auto_logged()){ // Check if they are logged in 
/*
if(isset($_POST["name"])){
	$first_name	= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	$last_name	= isset($_POST['lastname']) ? mysql_real_escape_string(strip_tags(trim($_POST['lastname']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email   	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$id_package 	= isset($_POST['package']) ? mysql_real_escape_string(strip_tags(trim($_POST['package']))) : "";
	$ip_address 	= isset($_POST['ip_address']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_address']))) : "";
	$mac_address 	= isset($_POST['mac_address']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac_address']))) : "";
        $saldo		= isset($_POST['saldo']) ? mysql_real_escape_string(strip_tags(trim($_POST['saldo']))) : "";
	
	$query = mysql_query("INSERT INTO `member` (`id_member`, `first_name`, `last_name`, `address`, `phone`, `email`, `package`,
					`ip_address`, `mac_address`, `saldo`, `last_visit`, `date_register`, `date_upd`, `level`)
		  VALUES ('', '$first_name', '$last_name', '$address', '$phone', '$email', '$id_package',
			  '$ip_address', '$mac_address', '$saldo', '', now(), now(), '0');");
        
	
}else*/


$mail             = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.globalxtreme.net"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "dwi@xtremewebsolution.net";  // GMAIL username
$mail->Password   = "global@123";            // GMAIL password

//send_mail
/*try {

  $body    = template_mail("1");
  $body    = preg_replace("[\\\]",'',$body);

  $mail->SetFrom('noreply@xtremewebsolution.net', 'Globalvideo');
  $mail->AddAddress("dwi@globalxtreme.net");
  $mail->SetFrom('noreply@xtremewebsolution.net', 'Globalvideo');
  
  $mail->Subject  = "Test Email";
  $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
  $mail->MsgHTML($body);

  $mail->Send();
  echo "Your Email was sent...<br>";
  
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer

} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
$date_now2 = date("Y-m-d H:", strtotime("+1 day"));
echo $date_now2;
*/
if(isset($_POST["id_member"]) AND isset($_POST["id_movie"]) AND isset($_POST["saldo"]) AND isset($_POST["price"])){
  $id_movie	= isset($_POST['id_movie']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_movie']))) : "";
  $id_member 	= isset($_POST['id_member']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_member']))) : "";
  $saldo	= isset($_POST['saldo']) ? mysql_real_escape_string(strip_tags(trim($_POST['saldo']))) : "";
  $type		= isset($_POST['type']) ? mysql_real_escape_string(strip_tags(trim($_POST['type']))) : "";
  $price	= isset($_POST['price']) ? mysql_real_escape_string(strip_tags(trim($_POST['price']))) : "";
  
  //sql transaksi
  $query = mysql_query("INSERT INTO `transaksi` (`id_transaksi`, `id_member`, `tgl_beli`,
		       `tgl_expired`, `id_movie`, `id_packages`, `price`, `type`, `level`)
		  VALUES ('', '".$id_member."', NOW(), NOW() + INTERVAL 1 DAY, '$id_movie',
			  '0', '".$price."', '".$type."', '0');");
  
  //update saldo member
  $query_saldo = mysql_query("UPDATE `member` SET `saldo` = '$saldo' WHERE `id_member` = '".$id_member."';");

//select id transaksi
  $date_now = date("Y-m-d H:");
  $date_now2 = date("Y-m-d H:", strtotime("+1 day"));
  $sql_transaksi = mysql_query("SELECT `id_transaksi` FROM `transaksi` WHERE `id_member` = '$id_member' AND `tgl_beli` LIKE '$date_now%'
			     AND `tgl_expired` LIKE '$date_now2%' AND `id_movie` = '$id_movie'
			     AND `id_packages` = '0' AND `price` = '$price'
			     AND `type` ='$type' AND `level`='0' LIMIT 0,1;");
  /*echo "SELECT `id_transaksi` FROM `transaksi` WHERE `id_member` = '$id_member' AND `tgl_beli` LIKE '$date_now%'
			     AND `tgl_expired` LIKE '$date_now2%' AND `id_movie` = '$id_movie'
			     AND `id_packages` = '0' AND `price` = '$price'
			     AND `type` ='$type' AND `level`='0' LIMIT 0,1;";*/
  $row_transaksi = mysql_fetch_array($sql_transaksi);
  
//send_mail
try {

  $body    = template_mail($row_transaksi["id_transaksi"]);
  $body    = preg_replace("[\\\]",'',$body);

  $mail->SetFrom('noreply@xtremewebsolution.net', 'Globalvideo');
  $mail->AddAddress($loggedin["email"]);
  $mail->SetFrom('noreply@xtremewebsolution.net', 'Globalvideo');
  
  $mail->Subject  = "Rent Movie";
  $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
  $mail->MsgHTML($body);

  $mail->Send();
  echo "Your Email was sent...<br>";
  
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer

} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
  
  
  
}elseif(isset($_POST["id_movie"]) AND isset($_POST["id_member"]) AND isset($_POST["tgl_reservasi"])){
  $id_movie	= isset($_POST['id_movie']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_movie']))) : "";
  $id_member 	= isset($_POST['id_member']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_member']))) : "";
  $tgl_reservasi= isset($_POST['tgl_reservasi']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_reservasi']))) : "";
  $type	= isset($_POST['type']) ? mysql_real_escape_string(strip_tags(trim($_POST['type']))) : "";
  
  //sql transaksi
  $query = mysql_query("INSERT INTO `reservasi_jadwal` (`id_reservasi`, `id_member`, `date_reservasi`,
		       `id_movie`, `type`, `level`)
		  VALUES ('', '".$id_member."', '".$tgl_reservasi."', '".$id_movie."', '".$type."', '0');");
  /*echo "INSERT INTO `reservasi_jadwal` (`id_reservasi`, `id_member`, `date_reservasi`,
		       `id_movie`, `type`, `level`)
		  VALUES ('', '".$id_member."', '".$tgl_reservasi."', '".$id_movie."', '".$type."', '0');";*/
  //send_mail
 
}elseif(isset($_POST["id_member"]) AND isset($_POST["id_movie"])){
  $id_member 	= isset($_POST['id_member']) ? (int)$_POST['id_member'] : "";
  $id_movie	= isset($_POST['id_movie']) ? (int)$_POST['id_movie'] : "";
  $type		= isset($_POST['type']) ? mysql_real_escape_string(strip_tags(trim($_POST['type']))) : "";
  
  //sql wishlist
  $query = mysql_query("INSERT INTO `playlist` (`id_playlist`, `id_member`, `id_movie`, `type`,
		       `date_add`, `date_upd`, `level`, `user_index_add`) 
			VALUES ('', '$id_member', '$id_movie', '$type', NOW(), NOW(), '0', '$id_member');"); 
 
}else{
  header("location: index.php");
  //echo 'save.php';
}

}else{
  
  header("location: index.php");
}
