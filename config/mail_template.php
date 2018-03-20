<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 * Email Template
 */
/*
 *<table style="background-image: url('.URL.'img/mail_template/header-lines.jpg); background-position: bottom; background-repeat: repeat-x;" bgcolor="#1d3952" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table id="top" width="578" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="top" align="center" height="60">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                    </table>
                                    <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #4484b5; margin: 0; padding: 0;">Youre receiving this nnotification because you are our customer</p>
                                    <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #4484b5; margin: 0; padding: 0;">Having trouble reading this email?
                                        <webversion style="color:#6aacdf; text-decoration: underline;">View it in your browser.</webversion>
                                        <unsubscribe style="color:#6aacdf; text-decoration: underline;">Click here to unsubscribe.</unsubscribe>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <!--footer 1-->
            <table width="578" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="578" border="0" cellpadding="20" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <table width="200" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><img style="margin: 0; padding: 0; display: block;" src="'.URL.'img/mail_template/foward.png" width="29" height="24" alt="foward"></td>
                                            <td>
                                                <forwardtoafriend style="font-family: Helvetica, Arial, sans-serif; font-weight: bold; font-size: 16px; margin: 0px; padding: 0px; text-shadow: 1px 1px 1px #000; color: #62b6ee">Foward to friend</forwardtoafriend>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center">
                                    <table width="200" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><img style="margin: 0; padding: 0; display: block;" src="'.URL.'img/mail_template/unsubscribe.png" width="29" height="26" alt="unsubscribe"></td>
                                            <td>
                                                <unsubscribe style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; margin: 0px; padding: 0px; text-shadow: 1px 1px 1px #000; color: #62b6ee">Unsubscribe</unsubscribe>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/footer 1-->
            */

function mail_template($content=""){
    $content = '';
    $email_template ='<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="case" bgcolor="#234865" style="background-color: #234865; background-image: url('.URL.'img/mail_template/body-bg.jpg); background-repeat: repeat;">
            <!--header-->
            
            <!--/header-->
            <!--Welcome -->
            <table width="578" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td valign="top" height="20"></td>
                </tr>
                <tr>
                    <td background="'.URL.'img/mail_template/header-bg.jpg" bgcolor="#c6d2db" valign="top" height="79">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="22" width="68%"></td>
                                <td height="20" width="32%"></td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <table width="82%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" valign="bottom" width="7%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="15"></td>
                                                        <td width="10"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td valign="middle" width="93%">
                                                <h1 style="font-family: Helvetica, Arial, sans-serif; font-size: 24px; margin: 0px; padding: 0px; text-shadow: 1px 1px 1px #FFFFFF; color: #244a67">GlobalXtreme<span style=" font-weight: normal;"> Information</span></h1>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td valign="top">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                    </table>
                                    <p style=" font-family:Helvetica, Arial, sans-serif; font-weight: bold; font-size: 12px; margin: 0px; padding: 0px; text-shadow: 1px 1px 1px #FFFFFF; color: #336791">
                                        '.date("l, d F Y").'
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" height="20"></td>
                </tr>
            </table>
            <!--/welcome-->
            <!--content-->
            <table width="576" border="0" align="center" cellpadding="20" cellspacing="0">
                <tr>
                    <td valign="top" bgcolor="#1c3851" background="'.URL.'img/mail_template/content-bg.jpg" style="border: solid 1px #193044; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; -khtml-border-radius: 8px;">
                        <h2 style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; margin: 0px; padding: 0px; text-shadow: 1px 1px 1px #333333; color: #62b6ee">Dear, Bejo Marpaung</h2>
                        <!--title content welcome-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="10"></td>
                            </tr>
                        </table>
                        
                        <p style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">Through this email, we want to convey that you\'ve just managed to do a topup on your bank balance.</p>
                        <!--/title content welcome-->
                        <!--bg line-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="middle" height="40"> <img src="'.URL.'img/mail_template/line.jpg" width="533" height="11"></td>
                            </tr>
                        </table>
                        <!--/bg line-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="top">
                                    <h2 style="font-family: Helvetica, Arial, sans-serif; font-size: 18px; margin: 0px; padding: 0px; text-shadow: 1px 1px 1px #333333; color: #62b6ee">Detail Transaction</h2>
                                    <!--br-->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                    </table>
                              <!--/brr-->
                                  <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="23%"><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">Credit Card Number </span></td>
                                      <td width="2%">&nbsp;</td>
                                      <td width="75%"><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6"><strong>001xxxxxxxxxxxx</strong></span></td>
                                    </tr>
                                    <tr>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">Credit Card Type </span></td>
                                      <td>&nbsp;</td>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6"><strong>Visa</strong></span></td>
                                    </tr>
                                    <tr>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">Name On Card </span></td>
                                      <td>&nbsp;</td>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6"><strong>Alik Yuswanto </strong></span></td>
                                    </tr>
                                    <tr>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">ID Customer </span></td>
                                      <td>&nbsp;</td>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6"><strong>Alik101 </strong></span></td>
                                    </tr>
                                    <tr>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">Amount</span></td>
                                      <td>&nbsp;</td>
                                      <td><span style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6"><strong>Rp. 100.000,00 </strong></span></td>
                                    </tr>
                                  </table>
                              <p style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 0px; color: #e7eff6">&nbsp;</p></td>
                            </tr>
                        </table>
						<!--bg line-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="middle" height="40"> <img src="'.URL.'img/mail_template/line.jpg" width="533" height="11"></td>
                            </tr>
                        </table>
                    <!--/bg line-->
                    </td>
                </tr>
            </table>
            <!--/content-->
            
            <!--footer-->
            <table style="background-image: url('.URL.'img/mail_template/footer-lines.jpg); background-position: top; background-repeat: repeat-x;" bgcolor="#1c293b" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="578" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="top" align="center" height="60">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td height="15"></td>
                                        </tr>
                                    </table>
                                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin: 0px; padding: 0px; color: #30648d; text-shadow: 1px 1px 1px #000;">GlobalXtreme - The Best Internet Service Provider</p>
                                    <p style="font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin: 0px; padding: 0px; color: #30648d; text-shadow: 1px 1px 1px #000;">http://globalxtreme.net - info@globalxtreme.net</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/footer-->
        </td>
    </tr>
</table>';

return $email_template;
}




function mail_invoice($customer_number = "", $id_invoice ="")
{
    global $conn;
    
    $sql_cust = mysql_query("SELECT `tbCustomer`.* FROM `tbCustomer`
			     WHERE `tbCustomer`.`cKode` = '".$customer_number."';", $conn);
    $row_cust = mysql_fetch_array($sql_cust);


    //$id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_invoice 	= "SELECT `gx_invoice`.* , `tbCustomer`.*
			FROM `gx_invoice`, `tbCustomer`
			WHERE `gx_invoice`.`customer_number` = `tbCustomer`.`cKode`
			AND `gx_invoice`.`id_invoice` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
    $query_invoice_item	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_invoice["kode_invoice"]."' AND `desc` = 'INTERNET';";
    $sql_invoice_item	= mysql_query($query_invoice_item, $conn);
    
    $content = '';
    $email_invoice ='<!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>GlobalXtreme Malang</strong><br>
                                Ruko Istana Dinoyo E4-E5<br>
                                Jl. MT Haryono 1A, Malang<br>
                                Phone: (0341) 573 222<br/>
                                Email: info@globalxtreme.net
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <span class="inv3">'.$row_cust['cNama'].'</span><br>
                                <span class="inv2">'.$row_cust['cAlamat1'].'<br>
                                '.$row_cust['cKota'].'<br>
                                Phone: '.$row_cust['ctelp'].'<br/>
                                Email: '.$row_cust['cEmail'].'</span>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #'.$row_invoice["id_invoice"].'</b><br/>
                            <b>Date:</b> '.date("d-m-Y", strtotime($row_invoice["tanggal_tagihan"])).'<br/>
                            <b>Order ID:</b> '.$row_invoice["kode_invoice"].'<br/>
                            <b>Payment Due:</b> '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).'<br/>
                            <b>Account:</b> 
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>';
                                $no = 1;
                                $total_price = 0;
                                while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
                                {
                            $content .='
                                <tbody>
                                    <tr>
                                        <td>'.$no.'.</td>
                                        <td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
                                        <td>'.$row_invoice_item["desc"].'</td>
                                        <td>'.Rupiah($row_invoice_item["harga"]).'</td>
                                        </tr>
                                    </tr>
                                </tbody>';
                                        $no++;
                                        $total_price = $total_price + $row_invoice_item["harga"];
                                }
                            $content .='
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="'.URL.'img/credit/visa.png" alt="Visa"/>
                            <img src="'.URL.'img/credit/mastercard.png" alt="Mastercard"/>
                            
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Amount Due '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).'</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>'.Rupiah($total_price).'</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (10%)</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>'.Rupiah($total_price).'</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->';
$count_email = count(explode(';', $row_cust["cEmail"]));
//$count_email = count(explode(';', "lutfi@globalxtreme.net; handaru@globalxtreme.net; dwi@globalxtreme.net"));

if($count_email > 1){
    foreach (explode(';', $row_cust["cEmail"]) as $emails)
    {
      //foreach (explode(';', "lutfi@globalxtreme.net; handaru@globalxtreme.net; dwi@globalxtreme.net") as $emails) {
  
  
      //$mail->AddAddress(trim("$emails"), trim($loggedin["nama"]));
      send_mail(trim("$emails"), $row_cust["cNama"], "[GlobalXtreme Helpdesk] Reset Password", $body);
    }
}
elseif($count_email == 1)
{
    send_mail(trim($row_customer["cEmail"]), $row_cust["cNama"], "[GlobalXtreme Helpdesk] Reset Password", $body);
}
//return $email_invoice;
}


function mail_topup()
{
    
}

function send_lupapassword($userid, $cust_number, $token, $method, $code_sms){
    
    global $conn;
    
	if($userid!='' OR $cust_number!=''){
        
        $sql_customer = mysql_query("SELECT * FROM `tbCustomer` WHERE (`cUserID` = '".$userid."' OR `cKode` = '".$cust_number."') LIMIT 0,1;", $conn);
        $row_customer = mysql_fetch_array($sql_customer);
        
        $sql_template_email = mysql_query("SELECT * FROM `gx_template_notif` WHERE (`kategori` = 'forgot_pass_email') LIMIT 0,1;", $conn);
        $row_template_email = mysql_fetch_array($sql_template_email);
        
        $sql_template_sms = mysql_query("SELECT * FROM `gx_template_notif` WHERE (`kategori` = 'forgot_pass_sms') LIMIT 0,1;", $conn);
        $row_template_sms = mysql_fetch_array($sql_template_sms);
        
        $replace = array( 
            '[link]' => 'https://172.16.79.194/software/beta/newpass.php?userid='.$userid.'&cust_number='.$cust_number.'&token='.$token, 
            '[code]' => 'orange'
        ); 
        
        if($method == "email")
        {
            $body = strReplaceAssoc($replace,$row_template_email["isi"]);
            
            $count_email = count(explode(';', $row_customer["cEmail"]));
            //$count_email = count(explode(';', "lutfi@globalxtreme.net; handaru@globalxtreme.net; dwi@globalxtreme.net"));
        
            if($count_email > 1){
                foreach (explode(';', $row_customer["cEmail"]) as $emails)
                {
                  //foreach (explode(';', "lutfi@globalxtreme.net; handaru@globalxtreme.net; dwi@globalxtreme.net") as $emails) {
              
              
                  //$mail->AddAddress(trim("$emails"), trim($loggedin["nama"]));
                  send_mail(trim("$emails"), $row_customer["cNama"], "[GlobalXtreme Helpdesk] Reset Password", $body);
                }
            }
            elseif($count_email == 1)
            {
                send_mail(trim($row_customer["cEmail"]), $row_customer["cNama"], "[GlobalXtreme Helpdesk] Reset Password", $body);
            }
        }
        elseif($method == "phone")
        {
            //create random password temporary
            $random_pass= generateRandomString(8);
            
            $update    = mysql_query("UPDATE `gxLogin` SET `password`=MD5('".$random_pass."'), `password_date`=NOW()
						WHERE (`customer_number`='".$cust_number."' OR `username` = '".$userid."');", $conn) or die(mysql_error());
            
            $body_sms = strReplaceAssoc($replace,$row_template_sms["isi"]);
            
            //$body       = "[GlobalXtreme Helpdesk - Info Login] Username: ".$row_customer["cUserID"]." Password: ".$random_pass;
            $body       = "[GX Verification] Your Code is : $code_sms Expired in 2 Hours. Or just click this link ";
            $body      .= "https://172.16.79.194/software/beta/newpass.php?userid=$userid&cust_number=$cust_number&token=$token";
            
            if($row_customer["cNoHp1"] !="") send_mail("sms-gateway@dps.globalxtreme.net", $row_customer["cNama"], $row_customer["cNoHp1"], $body_sms);
            if($row_customer["cNoHp2"] !="") send_mail("sms-gateway@dps.globalxtreme.net", $row_customer["cNama"], $row_customer["cNoHp2"], $body_sms);
            //if($row_customer["cNoHp3"] !="") send_mail("sms-gateway@dps.globalxtreme.net", $row_customer["cNama"], $row_customer["cNoHp3"], $body);
            
        }
        
    }		
		return '';
		
}

function send_mail($to,$email_name,$subject, $body)
{	
    
    $mail           = new PHPMailer(); // defaults to using php "mail()"
    $mail->IsSMTP();
    //$mail->SMTPDebug  = 1; // set mailer to use SMTP
    $mail->Timeout  = 120;     // set longer timeout for latency or servers that take a while to respond
    
    $mail->Host     = "202.58.203.26";        // specify main and backup server
    $mail->Port     = 2505; 
    $mail->SMTPAuth = false;    // turn on or off SMTP authentication
    
    
    $mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');
    $mail->AddAddress("$to", $email_name);
    $mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');
    
    
    $mail->Subject  = $subject;
    $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->MsgHTML($body);
    
    $mail->Send();
    return "";
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function strReplaceAssoc(array $replace, $subject) { 
   return str_replace(array_keys($replace), array_values($replace), $subject);    
} 