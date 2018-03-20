<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("../../config/configuration_admin.php");
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open STB User");
    global $conn;
    $conn_ott   = DB_TV();
	

    $sql_data		= mysqli_query($conn_ott, "SELECT * FROM `ott`.`ott_livechannel`;");
    $content .= "INSERT INTO `ott_livechannel` (`channelId`, `channelName`, `icon`, `islock`, `referencePrice`, `isPay`, `mediaCasterType`,
		`application`, `vport`, `lcontent`, `streamName`, `isRecording`, `isShift`, `channelUrl`, `channelIP`, `serviceId`, `serverId`, `isPlay`,
		`parameterUrl`, `liveUrl`, `typeId`, `rserverId`, `reServerId`, `isReplay`, `acronym`, `streamCode`, `provider`, `outsideurl`, `isouturl`,
		`timeShift`)<br>";

    while($row_data = mysqli_fetch_array($sql_data))
    {
		$content .= "
		VALUES ('".$row_data["channelId"]."', '".$row_data["channelName"]."', '".$row_data["icon"]."', '".$row_data["islock"]."', '".$row_data["referencePrice"]."', '".$row_data["isPay"]."', '".$row_data["mediaCasterType"]."',
		'".$row_data["application"]."', '".$row_data["vport"]."', '".$row_data["lcontent"]."', '".$row_data["streamName"]."', '".$row_data["isRecording"]."', '".$row_data["isShift"]."', '".$row_data["channelUrl"]."',
		'".$row_data["channelIP"]."', '".$row_data["serviceId"]."', '".$row_data["serverId"]."', '".$row_data["isPlay"]."',
		'".$row_data["parameterUrl"]."', '".$row_data["liveUrl"]."', '".$row_data["typeId"]."', '".$row_data["rserverId"]."', '".$row_data["reServerId"]."', '".$row_data["isReplay"]."',
		'".$row_data["acronym"]."', '".$row_data["streamCode"]."', '".$row_data["provider"]."', '".$row_data["outsideurl"]."', '".$row_data["isouturl"]."',
		'".$row_data["timeShift"]."');<br>";
    }

				

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'ott_livechannel';
    $submenu	= "ott_livechannel";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>