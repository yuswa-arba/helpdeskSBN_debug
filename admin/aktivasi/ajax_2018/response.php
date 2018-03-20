<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");
include '../../../config/telnet/routeros_api.class.php';

redirectToHTTPS();

global $conn;
$loggedin = logged_inAdmin();

$content	= '';

if(isset($_REQUEST["idspk_aktivasi"]))
{
	$id_spk     = isset($_REQUEST['idspk_aktivasi']) ? mysql_real_escape_string(trim($_REQUEST['idspk_aktivasi'])) : '';
	//$chat       = isset($_REQUEST['chat']) ? mysql_real_escape_string(trim($_REQUEST['chat'])) : '';
	$id_teknisi	= isset($_REQUEST['idteknisi']) ? mysql_real_escape_string(trim($_REQUEST['idteknisi'])) : '';
	
	if($id_spk != "")
	{
		//script add alias ip vlan
		$query_data = mysql_query("SELECT * FROM `v_chat_aktivasi`
								   WHERE (`idpengirim_aktivasi` = '".$id_teknisi."' OR `idpenerima_aktivasi` = '".$id_teknisi."')
								   AND `idspk_aktivasi` = '".$id_spk."'
								   ORDER BY `date_aktivasi` ASC;", $conn);
		
		
		while($row_data = mysql_fetch_array($query_data))
		{
			if($loggedin["id_employee"] == $row_data["idpengirim_aktivasi"])
			{
				$status = '';
			}
			else
			{
				$status = 'right';	
			}
			
			$content .= '<!-- Message. Default to the right -->
				<div class="direct-chat-msg '.$status.'">
				  <div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-left">'.$row_data["nama_pengirim"].'</span>
					<span class="direct-chat-timestamp pull-right">'.date("d-m-Y H:i", strtotime($row_data["date_aktivasi"])).'</span>
				  </div>
				  <!-- /.direct-chat-info -->
				  <img class="direct-chat-img" src="/staff/assets/dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
				  <div class="direct-chat-text">
					'.$row_data["pesan_aktivasi"].'
				  </div>
				  <!-- /.direct-chat-text -->
				</div>
				<!-- /.direct-chat-msg -->'; 
		}
	}
}
echo $content;
