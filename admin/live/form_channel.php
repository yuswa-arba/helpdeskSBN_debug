<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../config/configuration_admin.php");
include("../../config/configuration_tv.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;
        $conn_ott = DB_TV();

        if (isset($_POST["save"])) {
            $channelName = isset($_POST['channelName']) ? mysql_real_escape_string(trim($_POST['channelName'])) : '';
            $islock = isset($_POST['islock']) ? mysql_real_escape_string(trim($_POST['islock'])) : '';
            $referencePrice = isset($_POST['referencePrice']) ? mysql_real_escape_string(trim($_POST['referencePrice'])) : '';
            $isPay = isset($_POST['isPay']) ? mysql_real_escape_string(trim($_POST['isPay'])) : '';
            $mediaCasterType = isset($_POST['mediaCasterType']) ? mysql_real_escape_string(trim($_POST['mediaCasterType'])) : 'rtp';
            $isShift = isset($_POST['isShift']) ? mysql_real_escape_string(trim($_POST['isShift'])) : '';
            $application = isset($_POST['application']) ? mysql_real_escape_string(trim($_POST['application'])) : '';
            $vport = isset($_POST['vport']) ? mysql_real_escape_string(trim($_POST['vport'])) : '';
            $lcontent = isset($_POST['lcontent']) ? mysql_real_escape_string(trim($_POST['lcontent'])) : '';
            $streamName = isset($_POST['streamName']) ? mysql_real_escape_string(trim($_POST['streamName'])) : '';
            $isRecording = isset($_POST['isRecording']) ? mysql_real_escape_string(trim($_POST['isRecording'])) : '';
            $isShift = isset($_POST['isShift']) ? mysql_real_escape_string(trim($_POST['isShift'])) : '';
            $channelUrl = isset($_POST['streamName']) ? '/live/_definst_/' . $streamName . '.stream/playlist.m3u8' : '';
            $channelIP = isset($_POST['channelIP']) ? mysql_real_escape_string(trim($_POST['channelIP'])) : '';
            $serviceId = isset($_POST['serviceID']) ? mysql_real_escape_string(trim($_POST['serviceID'])) : '';
            $serverId = isset($_POST['serverId']) ? mysql_real_escape_string(trim($_POST['serverId'])) : '';
            $isPlay = isset($_POST['isPlay']) ? mysql_real_escape_string(trim($_POST['isPlay'])) : '';
            $parameterUrl = isset($_POST['streamName']) ? '/live/_definst_/' . $streamName . '.stream/playlist.m3u8?DVR&wowzadvrplayliststart=0&wowzadvrplaylistduration=108000000' : '';
            $liveUrl = isset($_POST['streamName']) ? '/live/_definst_/' . $streamName . '.stream/playlist.m3u8' : '';
            $typeId = isset($_POST['typeId']) ? mysql_real_escape_string(trim($_POST['typeId'])) : '';
            $rserverId = isset($_POST['rserverId']) ? mysql_real_escape_string(trim($_POST['rserverId'])) : '';
            $reServerId = isset($_POST['reServerId']) ? mysql_real_escape_string(trim($_POST['reServerId'])) : '';
            $isReplay = isset($_POST['isReplay']) ? mysql_real_escape_string(trim($_POST['isReplay'])) : '';
            $acronym = isset($_POST['acronym']) ? mysql_real_escape_string(trim($_POST['acronym'])) : '';
            $streamCode = isset($_POST['streamCode']) ? mysql_real_escape_string(trim($_POST['streamCode'])) : '';
            $provider = isset($_POST['provider']) ? mysql_real_escape_string(trim($_POST['provider'])) : '';
            $createDate = date("Y/m/d H:i:s");


            if ($channelName != "") {

                //upload foto
                $target_dir = "/usr/local/OTTServer/apache-tomcat-7.0.50/webapps/ottserver/upload/";
                // Random number for both file, will be added after image name
                $RandomNumber = rand(0, 9999999999);

                $uploadOk = 1;
                $nama_file = str_replace(' ', '-', strtolower($_FILES['icon']['name']));
                $ImageName = pathinfo($nama_file, PATHINFO_FILENAME);
                $imageFileType = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));

                $NewImageName = $ImageName . '-' . $RandomNumber . '.' . $imageFileType;
                $target_file = $target_dir . $NewImageName;
                $target_file_upload = "../upload/" . $NewImageName;

                // Check if image file is a actual image or fake image
                if ($_FILES["icon"]["tmp_name"] != "") {
                    $check = getimagesize($_FILES["icon"]["tmp_name"]);
                    if ($check !== false) {
                        $error_msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $error_msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                } else {
                    $uploadOk = 0;
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $error_msg = "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["icon"]["size"] > 1000000) {
                    $error_msg = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    $error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $error_msg = "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
                        move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_upload);
                        //insert into gx_data
                        $sql_insert_data = "INSERT INTO `ott_livechannel` (`channelId`, `channelName`, `icon`, `islock`, `provider`,
                            `referencePrice`, `isPay`, `mediaCasterType`, `application`, `vport`, `lcontent`, `streamName`,
                            `isRecording`, `isShift`, `channelUrl`, `channelIP`, `serviceId`, `serverId`, `isPlay`,
                            `parameterUrl`, `liveUrl`, `typeId`, `rserverId`, `reServerId`, `isReplay`, `acronym`, `streamCode`)
                            VALUES (NULL, '" . $channelName . "', '/ottserver/upload/" . $NewImageName . "', '" . $islock . "', '" . $provider . "', '" . $referencePrice . "', '" . $isPay . "',
                            '" . $mediaCasterType . "', '" . $application . "', '" . $vport . "', '" . $lcontent . "', '" . $streamName . "',
                            '" . $isRecording . "', '" . $isShift . "', '" . $channelUrl . "', '" . $channelIP . "', '" . $serviceId . "', '" . $serverId . "', '" . $isPlay . "',
                            '" . $parameterUrl . "', '" . $liveUrl . "', '" . $typeId . "', '" . $rserverId . "', '" . $reServerId . "', '" . $isReplay . "',  NULL,  '" . $streamCode . "');";
                        mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());

                        enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_data); // for create log in newfunction2.php

                        //insert into gx_data
                        $sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
			                VALUES (NULL, '" . $createDate . "', 'Added a  " . $channelName . "', 'OTTWEB (" . $loggedin["username"] . ")', 'Master channel');";
                        mysqli_query($conn_ott, $sql_insert_log) or die (mysqli_error());

                        enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_log); // for create log in newfunction2.php

                        //create file .stream
                        $stream_file = "/home/OTTRaid/content/" . $streamName . ".stream";
                        if (!file_exists($stream_file)) {
                            $myfile2 = fopen($stream_file, "w") or die("Unable to open file!");
                            $txt = "udp://@" . $channelIP . ":" . $vport;
                            fwrite($myfile2, $txt);
                            fclose($myfile2);
                        }

                    }
                }

                $myFile = "/usr/local/WowzaStreamingEngine/conf/StartupStreams.xml";
                $fh = fopen($myFile, 'w') or die("can't open file");

                $rss_txt = '<?xml version="1.0" encoding="UTF-8"?>';
                $rss_txt .= '<Root version="1">';
                $rss_txt .= '<StartupStreams>';

                $query = mysqli_query("SELECT * FROM `ott_livechannel` LIMIT 0,3");
                while ($values_query = mysqli_fetch_assoc($query)) {
                    $rss_txt .= '<StartupStream>';
                    $rss_txt .= '<Application>live/_definst_</Application>';
                    $rss_txt .= '<StreamName>' . $values_query["streamName"] . '.stream</StreamName>';
                    $rss_txt .= '<MediaCasterType>' . $values_query["mediaCasterType"] . '</MediaCasterType>';
                    $rss_txt .= '</StartupStream>';
                }
                $rss_txt .= '</StartupStreams>';
                $rss_txt .= '</Root>';

                fwrite($fh, $rss_txt);
                fclose($fh);

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan. Wowza Streaming Engine perlu direstart terlebih dahulu.');
                        window.location.href='channel.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        } elseif (isset($_POST["update"])) {
            $channelId = isset($_POST['channelId']) ? mysql_real_escape_string(trim($_POST['channelId'])) : '';
            $channelName = isset($_POST['channelName']) ? mysql_real_escape_string(trim($_POST['channelName'])) : '';
            $islock = isset($_POST['islock']) ? mysql_real_escape_string(trim($_POST['islock'])) : '';
            $referencePrice = isset($_POST['referencePrice']) ? mysql_real_escape_string(trim($_POST['referencePrice'])) : '';
            $isPay = isset($_POST['isPay']) ? mysql_real_escape_string(trim($_POST['isPay'])) : '';
            $mediaCasterType = isset($_POST['mediaCasterType']) ? mysql_real_escape_string(trim($_POST['mediaCasterType'])) : 'rtp';
            $isShift = isset($_POST['isShift']) ? mysql_real_escape_string(trim($_POST['isShift'])) : '';
            $application = isset($_POST['application']) ? mysql_real_escape_string(trim($_POST['application'])) : '';
            $vport = isset($_POST['vport']) ? mysql_real_escape_string(trim($_POST['vport'])) : '';
            $lcontent = isset($_POST['lcontent']) ? mysql_real_escape_string(trim($_POST['lcontent'])) : '';
            $streamName = isset($_POST['streamName']) ? mysql_real_escape_string(trim($_POST['streamName'])) : '';
            $isRecording = isset($_POST['isRecording']) ? mysql_real_escape_string(trim($_POST['isRecording'])) : '';
            $isShift = isset($_POST['isShift']) ? mysql_real_escape_string(trim($_POST['isShift'])) : '';
            $channelUrl = isset($_POST['streamName']) ? '/live/_definst_/' . $streamName . '.stream/playlist.m3u8' : '';
            $channelIP = isset($_POST['channelIP']) ? mysql_real_escape_string(trim($_POST['channelIP'])) : '';
            $serviceId = isset($_POST['serviceID']) ? mysql_real_escape_string(trim($_POST['serviceID'])) : '';
            $serverId = isset($_POST['serverId']) ? mysql_real_escape_string(trim($_POST['serverId'])) : '';
            $isPlay = isset($_POST['isPlay']) ? mysql_real_escape_string(trim($_POST['isPlay'])) : '';
            $parameterUrl = isset($_POST['streamName']) ? '/live/_definst_/' . $streamName . '.stream/playlist.m3u8?DVR&wowzadvrplayliststart=0&wowzadvrplaylistduration=108000000' : '';
            $liveUrl = isset($_POST['streamName']) ? '/live/_definst_/' . $streamName . '.stream/playlist.m3u8' : '';
            $typeId = isset($_POST['typeId']) ? mysql_real_escape_string(trim($_POST['typeId'])) : '';
            $rserverId = isset($_POST['rserverId']) ? mysql_real_escape_string(trim($_POST['rserverId'])) : '';
            $reServerId = isset($_POST['reServerId']) ? mysql_real_escape_string(trim($_POST['reServerId'])) : '';
            $isReplay = isset($_POST['isReplay']) ? mysql_real_escape_string(trim($_POST['isReplay'])) : '';
            $acronym = isset($_POST['acronym']) ? mysql_real_escape_string(trim($_POST['acronym'])) : '';
            $streamCode = isset($_POST['streamCode']) ? mysql_real_escape_string(trim($_POST['streamCode'])) : '';
            $provider = isset($_POST['provider']) ? mysql_real_escape_string(trim($_POST['provider'])) : '';
            $createDate = date("Y/m/d H:i:s");


            if ($channelId != "" AND $channelName != "") {

                //upload foto
                $target_dir = "/usr/local/OTTServer/apache-tomcat-7.0.50/webapps/ottserver/upload/";
                // Random number for both file, will be added after image name
                $RandomNumber = rand(0, 9999999999);

                $uploadOk = 1;
                $nama_file = str_replace(' ', '-', strtolower($_FILES['icon']['name']));
                $ImageName = pathinfo($nama_file, PATHINFO_FILENAME);
                $imageFileType = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));

                $NewImageName = $ImageName . '-' . $RandomNumber . '.' . $imageFileType;
                $target_file = $target_dir . $NewImageName;
                $target_file_upload = "../upload/" . $NewImageName;

                // Check if image file is a actual image or fake image
                if ($_FILES["icon"]["tmp_name"] != "") {
                    $check = getimagesize($_FILES["icon"]["tmp_name"]);
                    if ($check !== false) {
                        $error_msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $error_msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                } else {
                    $uploadOk = 0;
                    //insert into gx_data
                    $sql_insert_data = "UPDATE `ott`.`ott_livechannel` SET `channelName`='" . $channelName . "', `islock`='" . $islock . "',
                        `referencePrice`='" . $referencePrice . "', `isPay`='" . $isPay . "', `mediaCasterType`='" . $mediaCasterType . "',
                        `application`='" . $application . "', `vport`='" . $vport . "', `lcontent`='" . $lcontent . "', `streamName`='" . $streamName . "',
                        `isRecording`='" . $isRecording . "', `isShift`='" . $isShift . "', `channelUrl`='" . $channelUrl . "', `channelIP`='" . $channelIP . "',
                        `serviceId`='" . $serviceId . "', `serverId`='" . $serverId . "', `isPlay`='" . $isPlay . "', `parameterUrl`='" . $parameterUrl . "',
                        `liveUrl`='" . $liveUrl . "', `typeId`='" . $typeId . "', `rserverId`='" . $rserverId . "', `reServerId`='" . $reServerId . "',
                        `isReplay`='" . $isReplay . "', `acronym`=NULL, `streamCode`='" . $streamCode . "', `provider`='" . $provider . "'
                        WHERE (`channelId`='" . $channelId . "');";
                    mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_data); // for create log in newfunction2.php

                    //insert into gx_data
                    $sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
			            VALUES (NULL, '" . $createDate . "', 'Added a  " . $channelName . "', 'OTTWEB (" . $loggedin["username"] . ")', 'Master channel');";
                    mysqli_query($conn_ott, $sql_insert_log) or die (mysqli_error());

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_log); // for create log in newfunction2.php

                    //create file .stream
                    $stream_file = "/home/OTTRaid/content/" . $streamName . ".stream";
                    if (!file_exists($stream_file)) {
                        $myfile2 = fopen($stream_file, "w") or die("Unable to open file!");
                        $txt = "udp://@" . $channelIP . ":" . $vport;
                        fwrite($myfile2, $txt);
                        fclose($myfile2);
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $error_msg = "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["icon"]["size"] > 1000000) {
                    $error_msg = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    $error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $error_msg = "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {

                        move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_upload);
                        //insert into gx_data
                        $sql_insert_data = "UPDATE `ott`.`ott_livechannel` SET `channelName`='" . $channelName . "', `islock`='" . $islock . "',
			                `referencePrice`='" . $referencePrice . "', `isPay`='" . $isPay . "', `mediaCasterType`='" . $mediaCasterType . "',
			                `application`='" . $application . "', `vport`='" . $vport . "', `lcontent`='" . $lcontent . "', `streamName`='" . $streamName . "',
			                `isRecording`='" . $isRecording . "', `isShift`='" . $isShift . "', `channelUrl`='" . $channelUrl . "', `channelIP`='" . $channelIP . "',
			                `serviceId`='" . $serviceId . "', `serverId`='" . $serverId . "', `isPlay`='" . $isPlay . "', `parameterUrl`='" . $parameterUrl . "',
			                `liveUrl`='" . $liveUrl . "', `typeId`='" . $typeId . "', `rserverId`='" . $rserverId . "', `reServerId`='" . $reServerId . "',
			                `isReplay`='" . $isReplay . "', `acronym`=NULL, `streamCode`='" . $streamCode . "', `provider`='" . $provider . "', 
			                `icon` = '/ottserver/upload/" . $NewImageName . "'
			                WHERE (`channelId`='" . $channelId . "');";
                        mysql_query($sql_insert_data, $conn_ott) or die (mysql_error());

                        enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_data); // for create log in newfunction2.php

                        //insert into gx_data
                        $sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
			                VALUES (NULL, '" . $createDate . "', 'Added a  " . $channelName . "', 'OTTWEB (" . $loggedin["username"] . ")', 'Master channel');";
                        mysql_query($sql_insert_log, $conn_ott) or die (mysql_error());

                        enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_log); // for create log in newfunction2.php

                        //create file .stream
                        $stream_file = "/home/OTTRaid/content/" . $streamName . ".stream";
                        if (!file_exists($stream_file)) {
                            $myfile2 = fopen($stream_file, "w") or die("Unable to open file!");
                            $txt = "udp://@" . $channelIP . ":" . $vport;
                            fwrite($myfile2, $txt);
                            fclose($myfile2);
                        }

                    }
                }

                $myFile = "/usr/local/WowzaStreamingEngine/conf/StartupStreams.xml";
                $fh = fopen($myFile, 'w') or die("can't open file");

                $rss_txt = '<?xml version="1.0" encoding="UTF-8"?>';
                $rss_txt .= '<Root version="1">';
                $rss_txt .= '<StartupStreams>';

                $query = mysqli_query("SELECT * FROM `ott_livechannel` LIMIT 0,3");
                while ($values_query = mysqli_fetch_assoc($query)) {
                    $rss_txt .= '<StartupStream>';
                    $rss_txt .= '<Application>live/_definst_</Application>';
                    $rss_txt .= '<StreamName>' . $values_query["streamName"] . '.stream</StreamName>';
                    $rss_txt .= '<MediaCasterType>' . $values_query["mediaCasterType"] . '</MediaCasterType>';
                    $rss_txt .= '</StartupStream>';

                }
                $rss_txt .= '</StartupStreams>';
                $rss_txt .= '</Root>';

                fwrite($fh, $rss_txt);
                fclose($fh);

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan. Wowza Streaming Engine perlu direstart terlebih dahulu.');
                        window.location.href='channel.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        if (isset($_GET["id"])) {
            $id_data = isset($_GET['id']) ? (int)$_GET['id'] : ''; // menambil nilai/string yang ada pada url

            $query_data = "SELECT * FROM `ott_livechannel` WHERE `channelId`='" . $id_data . "' LIMIT 0,1;";
            $sql_data = mysqli_query($conn_ott, $query_data);
            $row_data = mysqli_fetch_array($sql_data);
        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Live Channel</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form action="" role="form" method="post" enctype="multipart/form-data">
                                <div class="box-body">
					                <input type="hidden" name="channelId" value="' . (isset($_GET['id']) ? $row_data["channelId"] : "") . '" id="channelId">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Channel Name</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="channelName" required="" class="form-control" type="text" maxlength="50" id="channelName" value="' . (isset($_GET['id']) ? $row_data["channelName"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Program ID</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="serviceID" required="" class="form-control" type="text" maxlength="10" id="serviceID" value="' . (isset($_GET['id']) ? $row_data["serviceId"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Is Pay</label>
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isPay" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isPay"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isPay" id="isPay" type="radio" value="1" ' . ((isset($_GET['id']) AND $row_data["isPay"] == "1") ? 'checked="checked"' : '') . '>YES
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="referencePrice" ' . ((isset($_GET['id']) AND $row_data["isPay"] == "1") ? '' : 'style="display:none"') . '>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Reference price</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="referencePrice" class="form-control" type="text" maxlength="10" id="referencePrice" value="' . (isset($_GET['id']) ? $row_data["referencePrice"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Provider</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="provider" required="" class="form-control" type="text" maxlength="100" id="provider" value="' . (isset($_GET['id']) ? $row_data["provider"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Whether to record Live</label>
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isRecording" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isRecording"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isRecording" id="isRecording" type="radio" id="isRecording" value="1" ' . ((isset($_GET['id']) AND $row_data["isRecording"] == "1") ? 'checked="checked"' : "") . '>YES
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="rserverId" ' . ((isset($_GET['id']) AND $row_data["isRecording"] == "1") ? '' : 'style="display:none"') . '>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Live Server IP</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="rserverId">';

        $query_live = "SELECT * FROM `ott_server`";
        $sql_live = mysqli_query($conn_ott, $query_live);
        while ($row_live = mysqli_fetch_array($sql_live)) {
            $content .= '<option ' . ((isset($_GET['id']) AND $row_data["rserverId"] == $row_live["serverId"]) ? 'selected="selected"' : "") . ' value="' . $row_live["serverId"] . '">' . $row_live["serverIP"] . '</option>';
        }

        $content .= '		
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Whether to record DVR</label>
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isShift" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isShift"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isShift" type="radio" id="isShift" value="1" ' . ((isset($_GET['id']) AND $row_data["isShift"] == "1") ? 'checked="checked"' : "") . '>YES
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="serverId" ' . ((isset($_GET['id']) AND $row_data["isShift"] == "1") ? '' : 'style="display:none"') . '>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>DVRServer IP</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="serverId">';

        $query_dvr = "SELECT * FROM `ott_server`";
        $sql_dvr = mysqli_query($conn_ott, $query_dvr);
        while ($row_dvr = mysqli_fetch_array($sql_dvr)) {
            $content .= '<option ' . ((isset($_GET['id']) AND $row_data["serverId"] == $row_dvr["serverId"]) ? 'selected="selected"' : "") . ' value="' . $row_dvr["serverId"] . '">' . $row_dvr["serverIP"] . '</option>';
        }

        $content .= '		
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Whether the replay</label>
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isReplay" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isReplay"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                            </div>
                                            <div class="col-xs-1">
                                                <input name="isReplay" type="radio" id="isReplay" value="1" ' . ((isset($_GET['id']) AND $row_data["isReplay"] == "1") ? 'checked="checked"' : "") . '>YES
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="reServerId" ' . ((isset($_GET['id']) AND $row_data["isReplay"] == "1") ? '' : 'style="display:none"') . '>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Replay Server IP</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="reServerId">';

        $query_replay = "SELECT * FROM `ott_server`";
        $sql_replay = mysql_query($conn_ott, $query_replay);
        while ($row_replay = mysql_fetch_array($sql_replay)) {
            $content .= '<option ' . ((isset($_GET['id']) AND $row_data["reServerId"] == $row_replay["serverId"]) ? 'selected="selected"' : "") . ' value="' . $row_replay["serverId"] . '">' . $row_replay["serverIP"] . '</option>';
        }

        $content .= '		
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Channel Type</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="typeId">';

        $query_type = "SELECT * FROM `ott_movieclasss` WHERE `cid` = '9';";
        $sql_type = mysqli_query($conn_ott, $query_type);
        while ($row_type = mysqli_fetch_array($sql_type)) {
            $content .= '<option ' . ((isset($_GET['id']) AND $row_data["typeId"] == $row_type["classid"]) ? 'selected="selected"' : "") . ' value="' . $row_type["classid"] . '">' . $row_type["className"] . '</option>';
        }

        $content .= '		
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Channel Type</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="streamCode">';

        $query_stream = "SELECT * FROM `ott_moviecode`";
        $sql_stream = mysqli_query($conn_ott, $query_stream);
        while ($row_stream = mysqli_fetch_array($sql_stream)) {
            if ($row_stream["streamName"] == "code1") {
                $code = "SD";
            } elseif ($row_stream["streamName"] == "code2") {
                $code = "HD";
            }
            $content .= '<option ' . ((isset($_GET['id']) AND $row_data["streamCode"] == $row_stream["streamName"]) ? 'selected="selected"' : "") . ' value="' . $row_stream["streamName"] . '">' . $code . '</option>';
        }

        $content .= '

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Whether to channel lock</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="islock" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["islock"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                                <input name="islock" type="radio" value="1" ' . ((isset($_GET['id']) AND $row_data["islock"] == "1") ? 'checked="checked"' : "") . '>YES
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Is play</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="isPlay" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isPlay"] == "0") ? 'checked="checked"' : "") . '>NO&nbsp;&nbsp;
                                                <input name="isPlay" type="radio" value="1" ' . ((isset($_GET['id']) AND $row_data["isPlay"] == "1") ? 'checked="checked"' : 'checked="checked"') . '>YES
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>IP number</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="channelIP" class="form-control" type="text" maxlength="15" id="channelIP" value="' . (isset($_GET['id']) ? $row_data["channelIP"] : "224.10.10.1") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Port</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="vport" class="form-control" type="text" maxlength="10" id="vport" value="' . (isset($_GET['id']) ? $row_data["vport"] : "") . '">
                                            </div>
                                         </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Stream file name</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="streamName" required="" class="form-control" type="text" id="streamName" value="' . (isset($_GET['id']) ? $row_data["streamName"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Upload channel Logo</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="icon" class="form-control" type="file" value="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Channel description</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <textarea class="form-control" name="lcontent">' . (isset($_GET['id']) ? $row_data["lcontent"] : "") . '</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
				    
				   
                                 <div class="box-footer">
                                     <button type="submit" value="Submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                 </div>
                             </form>
                         </div><!-- /.box -->
                     </div>
                 </div>
             </section><!-- /.content -->';

        $plugins = '
            <script language="javascript">
                //ispay
                $(\'input#isPay\').on(\'ifChecked\', function(event){
                    document.getElementById("referencePrice").style.display = "";
                });
                $(\'input#isPay\').on(\'ifUnchecked\', function(event){
                    document.getElementById("referencePrice").style.display = "none";
                });
                //live
                $(\'input#isRecording\').on(\'ifChecked\', function(event){
                    document.getElementById("rserverId").style.display = "";
                });
                $(\'input#isRecording\').on(\'ifUnchecked\', function(event){
                    document.getElementById("rserverId").style.display = "none";
                });
                //recorddvr
                $(\'input#isShift\').on(\'ifChecked\', function(event){
                    document.getElementById("serverId").style.display = "";
                });
                $(\'input#isShift\').on(\'ifUnchecked\', function(event){
                    document.getElementById("serverId").style.display = "none";
                });
                //replay
                $(\'input#isReplay\').on(\'ifChecked\', function(event){
                    document.getElementById("reServerId").style.display = "";
                });
                $(\'input#isReplay\').on(\'ifUnchecked\', function(event){
                    document.getElementById("reServerId").style.display = "none";
                });
            </script>';

        $title = 'Form Live Channel';
        $submenu = "live_channel";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>