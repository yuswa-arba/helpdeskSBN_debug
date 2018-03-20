<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){


global $conn;
global $conn_voip;

//DATA Internet
$conn_soft = Config::getInstanceSoft();

$sql_data_user = $conn_soft->prepare("SELECT * FROM [dbo].[Users];");
$sql_data_user->execute();


    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
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
                                            <th><b>Customer Number</b></th>
                                            <th><b>Nama</b></th>
                                            <th><b>UserID</b></th>
                                            <th><b>NAS Name</b></th>
                                            <th><b>NAS Port</b></th>
                                            <th><b>Login Time</b></th>
                                            <th><b>Time Online</b></th>
                                            <th><b>IP</b></th>
                                            <th><b>Service</b></th>
                                            <th><b>In KB</b></th>
                                            <th><b>Out KB</b></th>
                                            <th><b>CallerID</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>';

$sess_time = 0;
$sess_kuota = 0;

while ($row_data_user = $sql_data_user->fetch()){
    
$sql_session_data = $conn_soft->prepare("SELECT SUM(DISTINCT([Accountinglog].[AcctInputOctets])), SUM(DISTINCT([Accountinglog].[AcctOutputOctets]))
  FROM [4RBSSQL].[dbo].[Users], [4RBSSQL].[dbo].[Accountinglog]
  WHERE [Users].[UserID] = [Accountinglog].[UserId]
  AND [Accountinglog].[UserId] = '".$row_data_user["UserID"]."';");

$sql_session_data->execute();
$row_session_data = $sql_session_data->fetch();

    $content .='<tr>
                <td>0.0.0.0</td>
                <td>'.tglSoft($row_session_data["AcctDate"]).'</td>
                <td>'.date("H:i:s", (strtotime($row_session_data["AcctDate"])-($row_session_data["AcctSessionTime"]))).'</td>
                <td>'.jamSoft($row_session_data["AcctDate"]).'</td>
                <td>'.detiktoTime($row_session_data["AcctSessionTime"]).'</td>
                <td>'.kuotaData($row_session_data["AcctInputOctets"] + $row_session_data ["AcctOutputOctets"]).'</td>
            </tr>';
            
            $sess_kuota = $sess_kuota + ($row_session_data["AcctInputOctets"] + $row_session_data ["AcctOutputOctets"]);
            $sess_time  = $sess_time + $row_session_data["AcctSessionTime"];
            
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
                            </div><!-- /.box -->
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
                    "bInfo": false,
                    "bAutoWidth": false
                });
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
	header("location: ".URL_ADMIN."logout.php");
    }

?>