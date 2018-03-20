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
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Detail Live Channel</h3>
                            </div><!-- /.box-header -->
                            
                            <div class="box-body">
					            <input type="hidden" name="channelId" value="' . (isset($_GET['id']) ? $row_data["channelId"] : "") . '" id="channelId">
					            <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Channel Name</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <input name="channelName" readonly="" class="form-control" type="text" maxlength="50" id="channelName" value="' . (isset($_GET['id']) ? $row_data["channelName"] : "") . '">
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Program ID</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <input name="serviceID" readonly="" class="form-control" type="text" maxlength="10" id="serviceID" value="' . (isset($_GET['id']) ? $row_data["serviceId"] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Is Pay</label>
                                        </div>
                                        <div class="col-xs-1">
                                            <input name="isPay" disabled="" type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isPay"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                        </div>
                                        <div class="col-xs-1">
                                            <input name="isPay" disabled="" id="isPay" type="radio" value="1" ' . ((isset($_GET['id']) AND $row_data["isPay"] == "1") ? 'checked="checked"' : '') . '>YES
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group" id="referencePrice" ' . ((isset($_GET['id']) AND $row_data["isPay"] == "1") ? '' : 'style="display:none"') . '>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Reference price</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <input name="referencePrice" readonly class="form-control" type="text" maxlength="10" id="referencePrice" value="' . (isset($_GET['id']) ? $row_data["referencePrice"] : "0") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Whether to record Live</label>
                                        </div>
                                        <div class="col-xs-1">
                                            <input name="isRecording" disabled type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isRecording"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                        </div>
                                        <div class="col-xs-1">
                                            <input name="isRecording" disabled id="isRecording" type="radio" id="isRecording" value="1" ' . ((isset($_GET['id']) AND $row_data["isRecording"] == "1") ? 'checked="checked"' : "") . '>YES
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group" id="rserverId" ' . ((isset($_GET['id']) AND $row_data["isRecording"] == "1") ? '' : 'style="display:none"') . '>
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <label>Live Server IP</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <select class="form-control" name="rserverId" disabled>';

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
                                            <input name="isShift" disabled type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isShift"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                        </div>
                                        <div class="col-xs-1">
                                            <input name="isShift" disabled type="radio" id="isShift" value="1" ' . ((isset($_GET['id']) AND $row_data["isShift"] == "1") ? 'checked="checked"' : "") . '>YES
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group" id="serverId" ' . ((isset($_GET['id']) AND $row_data["isShift"] == "1") ? '' : 'style="display:none"') . '>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>DVRServer IP</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <select class="form-control" name="serverId" disabled>';

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
                                            <input name="isReplay"disabled  type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isReplay"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                        </div>
                                        <div class="col-xs-1">
                                            <input name="isReplay" disabled type="radio" id="isReplay" value="1" ' . ((isset($_GET['id']) AND $row_data["isReplay"] == "1") ? 'checked="checked"' : "") . '>YES
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group" id="reServerId" ' . ((isset($_GET['id']) AND $row_data["isReplay"] == "1") ? '' : 'style="display:none"') . '>
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <label>Replay Server IP</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <select class="form-control" name="reServerId" disabled>';

        $query_replay = "SELECT * FROM `ott_server`";
        $sql_replay = mysqli_query($conn_ott, $query_replay);
        while ($row_replay = mysqli_fetch_array($sql_replay)) {
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
                                            <select class="form-control" name="typeId" disabled>';

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
                                            <select class="form-control" name="streamCode" disabled>';

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
                                            <input name="islock" disabled type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["islock"] == "0") ? 'checked="checked"' : 'checked="checked"') . '>NO&nbsp;&nbsp;
                                            <input name="islock" disabled type="radio" value="1" ' . ((isset($_GET['id']) AND $row_data["islock"] == "1") ? 'checked="checked"' : "") . '>YES
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Is play</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <input name="isPlay" disabled type="radio" value="0" ' . ((isset($_GET['id']) AND $row_data["isPlay"] == "0") ? 'checked="checked"' : "") . '>NO&nbsp;&nbsp;
                                            <input name="isPlay" disabled type="radio" value="1" ' . ((isset($_GET['id']) AND $row_data["isPlay"] == "1") ? 'checked="checked"' : 'checked="checked"') . '>YES
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>IP number</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <input name="channelIP" readonly class="form-control" type="text" maxlength="15" id="channelIP" value="' . (isset($_GET['id']) ? $row_data["channelIP"] : "224.10.10.1") . '">
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Port</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <input name="vport" readonly class="form-control" type="text" maxlength="10" id="vport" value="' . (isset($_GET['id']) ? $row_data["vport"] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Stream file name</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <input name="streamName" readonly="" class="form-control" type="text" id="streamName" value="' . (isset($_GET['id']) ? $row_data["streamName"] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Channel URL</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <input name="channelUrl" readonly="" class="form-control" type="text" id="channelUrl" value="' . (isset($_GET['id']) ? $row_data["channelUrl"] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Parameter URL</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <input name="parameterUrl" readonly="" class="form-control" type="text" id="parameterUrl" value="' . (isset($_GET['id']) ? $row_data["parameterUrl"] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Live URL</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <input name="liveUrl" readonly="" class="form-control" type="text" id="liveUrl" value="' . (isset($_GET['id']) ? $row_data["liveUrl"] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Upload channel Logo</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <img src="' . (isset($_GET['id']) ? str_replace("/ottserver/upload/", "/ott/upload/", $row_data["icon"]) : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Channel description</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <textarea class="form-control" disabled name="lcontent">' . (isset($_GET['id']) ? $row_data["lcontent"] : "") . '</textarea>
                                        </div>
                                    </div>
                                </div>
		                    </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Detail Live Channel';
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