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


//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open detail user");

global $conn;
$conn_soft = Config::getInstanceSoft();

$messages = '';
if(isset($_GET["uid"]))
{
    $uid            = isset($_GET['uid']) ? mysql_real_escape_string(strip_tags(trim($_GET['uid']))) : '';
    
    $sql_user = $conn_soft ->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
                                     AND [Users].[userActive] = '1'
                                     AND [Users].[UserID] = '".$uid."';");
    $sql_user->execute();
    $row_user = $sql_user->fetch(PDO::FETCH_ASSOC);
    
    
//total pemakaian
$sql_total_data = $conn_soft->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                                       ISNULL([AcctInputOctets], 0) AS totalout,
                                       ISNULL([AcctSessionTime], 0) AS totaltime
                        FROM [4RBSSQL].[dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$row_user["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");
$sql_total_data->execute();


$total_kuota = 0;
$totalin = 0;
$totalout = 0;
$totaltime = 0;

$row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);

foreach($row_total_data as $kuota){
    $totalin = $totalin + ($kuota["totalin"]);
    $totalout = $totalout + ($kuota["totalout"]);
    $totaltime = $totaltime + ($kuota["totaltime"]);
    $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
    
}


//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open detail user ".$row_user["UserID"]);
}



    $content ='<section class="content-header">
                    <h1>
                        Detail '.(isset($_GET["uid"]) ? $row_user["UserID"] : "").'
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Detail '.date("F, Y").'</h3>
                                    <div class="box-tools pull-right">
                                        <div class="btn bg-olive btn-flat margin"><a href="form_user.php?uid='.(isset($_GET["uid"]) ? $row_user["UserID"] : "").'">Update</a></div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>User ID</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <b>'.(isset($_GET["uid"]) ? $row_user["UserID"] : "").'</b>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Account Type</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <b>'.(isset($_GET["uid"]) ? $row_user["AccountName"] : "").'</b>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Group Name</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <b>'.(isset($_GET["uid"]) ? $row_user["GroupName"] : "").'</b>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>NASAttributes</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <b>'.(isset($_GET["uid"]) ? $row_user["NASAttributes"] : "").'</b>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Total Kuota bulan ini ('.date("F, Y").')</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <b>'.(isset($_GET["uid"]) ? kuotaMB($total_kuota)."(".kuotaMB($totalin)."/".kuotaMB($totalout).")" : "").'</b>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Time Online (Current)</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <b>'.(isset($_GET["uid"]) ? detiktoTime($totaltime).' ('.$totaltime.')' : "").'</b>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4>History Perubahan Bandwidth</h4>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table table-hover table-border">
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Download</th>
                                                        <th>Upload</th>
                                                        <th>Total Kuota</th>
                                                        <th>Time Online</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>';
if(isset($_GET["uid"]))
{
    $uid            = isset($_GET['uid']) ? mysql_real_escape_string(strip_tags(trim($_GET['uid']))) : '';
    $sql_bwhistory  = mysql_query("SELECT * FROM `gx_inet_bwhistory` WHERE `user_id` = '".$uid."' ORDER BY `date_upd` DESC LIMIT 0,10;", $conn);
    
}
$no = 1;

while($row_bwhistory = mysql_fetch_array($sql_bwhistory))
{
    $content .='<tr>
        <td>'.$no.'.</td>
        <td>'.$row_bwhistory["date_upd"].' by '.$row_bwhistory["user_upd"].'</td>
        <td>'.kuotaMB($row_bwhistory["session_in"]).'</td>
        <td>'.kuotaMB($row_bwhistory["session_out"]).'</td>
        <td>'.kuotaMB($row_bwhistory["total_session"]).'</td>
        <td>'.detiktoTime($row_bwhistory["session_time"]).' ('.$row_bwhistory["session_time"].')</td>
        <td>Action</td>
        
    </tr>';
    $no++;
}
    
$content .='</tbody></table>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    
                                
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';


    $title	= 'Detail User';
    $submenu	= "inet_grouptime";
    $plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>