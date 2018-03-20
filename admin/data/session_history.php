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


global $conn;
global $conn_voip;

    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">Search</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form role="form" method="POST" action="">
                                        <div class="box-body">
                                            
                                            <div class="row">
                                                <div class="col-xs-9">
                                                    <p>UserID: <input type="text" name="userid" value="" required=""></p>
                                                </div>
                                                <div class="col-xs-9">
                                                    <p>Start Date: <input type="text" readonly="" name="start_tanggal" id="datepicker" class="hasDatepicker"> &nbsp;To Date: <input type="text" readonly="" name="to_tanggal" id="todatepicker" class="hasDatepicker"></p>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>';

if(isset($_POST["search"]))
{
    $userid	    = isset($_POST['userid']) ? $_POST['userid'] : "";
    $start_tanggal  = isset($_POST['start_tanggal']) ? $_POST['start_tanggal'] : date("Y-m-d");
    $to_tanggal	    = isset($_POST['to_tanggal']) ? $_POST['to_tanggal'] : date("Y-m-d");
    
    $sql_user       = ($userid != "") ? "AND [Accountinglog].[UserId] = '".$userid."'" : "";
    if(($_POST["start_tanggal"] == "") AND ($_POST["to_tanggal"] == ""))
    {
        $sql_date = "";
    }else
    {
        $sql_date = "AND [Accountinglog].[AcctDate] BETWEEN '".$start_tanggal." 00:00:00' AND '".$to_tanggal." 23:00:00'";
    }
    //DATA Internet
$conn_soft = Config::getInstanceSoft();
$sql_session_data = $conn_soft->prepare("SELECT TOP 50 [Accountinglog].*
  FROM [dbo].[Users], [dbo].[Accountinglog]
  WHERE [Users].[UserID] = [Accountinglog].[UserId]
  ".$sql_user."
  ".$sql_date."
  ORDER BY [Accountinglog].[AcctDate] DESC;");

$sql_session_data->execute();
                            
$content .= '                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Session</h3>
                                    <!--<div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>-->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover table-border" id="sess_history">
                                        <thead>
                                        <tr>
                                            <th><b>No.</b></th>
                                            <th><b>UserID</b></th>
                                            <th><b>NAS Name</b></th>
                                            <th><b>NAS Port</b></th>
                                            <th><b>IP Address</b></th>
                                            <th><b>Date</b></th>
                                            <th><b>From</b></th>
                                            <th><b>To</b></th>
                                            <th><b>Session Time</b></th>
                                            <th><b>In</b></th>
                                            <th><b>Out</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>';

$sess_time = 0;
$sess_kuota = 0;
$no = 1;

while ($row_session_data = $sql_session_data->fetch()){
    $content .='<tr>
                <td>'.$no.'.</td>
                <td><a href="detail_user.php?uid='.$row_session_data["UserId"].'">'.$row_session_data["UserId"].'</a></td>
                <td>RAS-Oprek2</td>
                <td>'.$row_session_data["NASPort"].'</td>
                <td>0.0.0.0</td>
                <td>'.tglSoft($row_session_data["AcctDate"]).'</td>
                <td>'.date("H:i:s", (strtotime($row_session_data["AcctDate"])-($row_session_data["AcctSessionTime"]))).'</td>
                <td>'.jamSoft($row_session_data["AcctDate"]).'</td>
                <td>'.detiktoTime($row_session_data["AcctSessionTime"]).'</td>
                <td>'.kuotaData($row_session_data["AcctInputOctets"]).'</td>
                <td>'.kuotaData($row_session_data ["AcctOutputOctets"]).'</td>
                <td></td>
            </tr>';
            
            $sess_kuota = $sess_kuota + ($row_session_data["AcctInputOctets"] + $row_session_data ["AcctOutputOctets"]);
            $sess_time  = $sess_time + $row_session_data["AcctSessionTime"];
            $no ++;
}

$content .='
                                        
                                        
                                        </tbody>
                                    </table>
                                    
                                    <b>Total Session Time = '.detiktoTime($sess_time).'</b><br>
                                    <b>Total Session Kuota = '.kuotaData($sess_kuota).'</b>
                                        
                                
				<div class="box-footer clearfix">
                                    <!--<ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>-->
                                </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->';
}

$content .= '
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
        
        <!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                $(\'#sess_history\').dataTable(
                {
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#todatepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>

    ';

    $title	= 'Session History';
    $submenu	= "inet_sesshistory";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>