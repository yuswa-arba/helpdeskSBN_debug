<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
	global $conn_voip;

enableLog("", $loggedin["username"], $loggedin["username"], "Open PDF CallHistory");


$email     	= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
$src     	= isset($_POST['src']) ? mysql_real_escape_string(trim($_POST['src'])) : '';

$start_date	= isset($_POST['s']) ? mysql_real_escape_string(trim($_POST['s'])) : '';
$end_date  	= isset($_POST['e']) ? mysql_real_escape_string(trim($_POST['e'])) : date("Y-m-d");

$sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
                    ORDER BY t1.starttime DESC;";

$sql_call = mysql_query($sql_callhistory, $conn_voip);
$sql_customer = mysql_fetch_array(mysql_query("SELECT `credit` FROM `cc_card` WHERE `useralias` = '".$src."' LIMIT 0,1;",  $conn_voip));
$sql_total = mysql_num_rows(mysql_query("SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
                    ORDER BY t1.starttime DESC"));
$sql_total_tagihan = mysql_fetch_array(mysql_query("SELECT SUM(t1.sessionbill) AS `total`
		FROM `cc_call` t1
		WHERE `src` != 0 AND `src` = '".$src."'
		AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
		
		ORDER BY t1.starttime DESC"));

    
$html = '<div>

				
	<h4>Pulsa Terakhir: Rp '.number_format($sql_customer["credit"], 2, ',', '.').'</h4>
	<h4>Total Panggilan: '.$sql_total.'</h4>
	<h4>Total Pemakaian: Rp '.number_format($sql_total_tagihan["total"], 2, ',', '.').'</h4>
	
	<table width="100%"  border="1" cellspacing="0" cellpadding="0" >
                <thead><tr>
                  <th width="20">#</th>
                  <th >Date</th>
                  <th >CallerID</th>
                  <th >PhoneNumber</th>
                  <th >Destination</th>
		  <th >Duration</th>
                  <th >TC</th>
		  <th >Rate Card</th>
                  <th >CallType</th>
                  <th >Cost</th>
                </tr>
		</thead>
		<tbody>';
		
	
		$no = 1;
		
		while ($row_callhistory = mysql_fetch_array($sql_call)){
		    $sql_country = mysql_query("SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '".$row_callhistory["destination"]."';");
		    $row_country = mysql_fetch_array($sql_country);
		    
		    $calltype	 = '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="0") ? 'STANDARD' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="1") ? 'SIP/IAX' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="2") ? 'DIDCALL' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="3") ? 'DID_VOIP' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="4") ? 'CALLBACK' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="5") ? 'PREDICT' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="6") ? 'AUTO DIALER' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="7") ? 'DID-ALEG' : '';
		    
		    $tc  ='';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="1") ? 'ANSWER' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="2") ? '2' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="3") ? '3' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="4") ? '4' : '';
		    
		    if($row_callhistory["destination"] == "628"){
			$destination = "Indonesian Mobile";
		    }else{
			$destination = $row_country["countryname"];
		    }
		    $sql_ratecard = mysql_query("SELECT * FROM  `cc_tariffplan` WHERE  `id` =  '$row_callhistory[id_tariffplan]'");
		    $row_ratecard = mysql_fetch_array($sql_ratecard);
                $html .='
                <tr > 
                    <td align="" >'.$no.'</td>
                    <td valign="top" align="center" >'.date("d-m-Y H:i:s", strtotime($row_callhistory["starttime"])).'</td>
                    <td valign="top" align="center">'.$row_callhistory["src"].'</td>
                    <td valign="top" align="center" >'.$row_callhistory["calledstation"].'</td>
                    <td valign="top" align="center" >'.$destination.'</td>
                    <td valign="top" align="center" >'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
                    <td valign="top" align="center" >'.$tc.'</td>
					<td valign="top" align="center" >'.$row_ratecard["tariffname"].'</td>
                    <td valign="top" align="center" >'.$calltype.'</td>
                    <td valign="top" align="center" >'.number_format($row_callhistory["sessionbill"], 2, ',', '.').' IDR</td>
                </tr>
                ';
		$no++;
		}
		
                $html .='
		
                </tbody></table>
				</div>';

//echo $html;

//==============================================================
//==============================================================
//==============================================================
include('../../pdf/mpdf.php');

$mpdf=new mPDF('c','A4','','',5,5,5,5,0,0); 

$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage','two');

// LOAD a stylesheet
//$stylesheet = file_get_contents('http://192.168.182.10/software/beta/css/bootstrap.min.css');

//$mpdf->WriteHTML($stylesheet4,1);
$mpdf->WriteHTML($html);

$mpdf->Output('pdf/callhistory_'.$src.'.pdf', 'F');
//exit;
//echo $html;

$filename = 'pdf/callhistory_'.$src.'.pdf';

$mail           = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
//$mail->SMTPDebug  = 2; // set mailer to use SMTP
$mail->Timeout  = 120;     // set longer timeout for latency or servers that take a while to respond

$mail->Host     = "202.58.203.26";        // specify main and backup server
$mail->Port     = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication


$mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');
$mail->AddAddress("$email", $email);
$mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');


$mail->Subject  = 'Call history VOIP';
$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML('Data Call History');
$mail->AddAttachment($filename);

$mail->Send();

echo '<script>
alert("email dikirim");
window.location.href="callhistory.php";
</script>
';

}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>