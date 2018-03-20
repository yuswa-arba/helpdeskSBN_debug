<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");


if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer' ){

global $conn;
    
    $q = isset($_GET["q"]) ? mysql_real_escape_string($_GET["q"]) : "";
    if(isset($_GET["q"])){
	
	$kategori	= isset($_GET["q"]) ? mysql_real_escape_string($_GET["q"]) : "";
	
	
	$sql_mailbox 	= mysql_query("SELECT * FROM `gx_email` WHERE `kategori` LIKE '%".$kategori."%' ORDER BY `DateE` DESC;", $conn);
    }else{
	$sql_mailbox 	= mysql_query("SELECT * FROM `gx_email` ORDER BY `DateE` DESC;", $conn);
    }
    
    $sql_mailbox_all 	= mysql_query("SELECT * FROM `gx_email` ORDER BY `DateE` DESC;", $conn);
    
    $sql_mailbox_spam 	= mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = 'Spam' ORDER BY `DateE` DESC;", $conn);
    $sql_mailbox_fo 	= mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = 'Problem FO' ORDER BY `DateE` DESC;", $conn);
    $sql_mailbox_wifi 	= mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = 'Problem Wireless' ORDER BY `DateE` DESC;", $conn);
    $sql_mailbox_request= mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = 'Request' ORDER BY `DateE` DESC;", $conn);
    $sql_mailbox_billing= mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = 'Billing' ORDER BY `DateE` DESC;", $conn);
    
    
    $sum_mailbox	= mysql_num_rows($sql_mailbox_all);
    $sum_mailbox_spam	= mysql_num_rows($sql_mailbox_spam);
    $sum_mailbox_fo 	= mysql_num_rows($sql_mailbox_fo);
    $sum_mailbox_wifi 	= mysql_num_rows($sql_mailbox_wifi);
    $sum_mailbox_request= mysql_num_rows($sql_mailbox_request);
    $sum_mailbox_billing= mysql_num_rows($sql_mailbox_billing);
    
    $content ='<section class="content">
                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">INBOX</h3>
                                            </div>
                                            <!-- compose message btn
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Message</a>
					    
					     -->
                                            <!-- Navigation - folders-->
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Kategori</li>
                                                    <li'.(($q=="") ? ' class="active"' : '').'><a href="mailbox.php"><i class="fa fa-inbox"></i> Inbox ('.$sum_mailbox.')</a></li>
                                                    <li'.(($q=="spam") ? ' class="active"' : '').'><a href="mailbox.php?q=spam"><i class="fa fa-pencil-square-o"></i> Spam ('.$sum_mailbox_spam.')</a></li>
                                                    <li'.(($q=="fo") ? ' class="active"' : '').'><a href="mailbox.php?q=fo"><i class="fa fa-mail-forward"></i> Problem FO ('.$sum_mailbox_fo.')</a></li>
                                                    <li'.(($q=="wireless") ? ' class="active"' : '').'><a href="mailbox.php?q=wireless"><i class="fa fa-star"></i> Problem Wireless ('.$sum_mailbox_wifi.')</a></li>
                                                    <li'.(($q=="request") ? ' class="active"' : '').'><a href="mailbox.php?q=request"><i class="fa fa-folder"></i> Request('.$sum_mailbox_request.')</a></li>
						    <li'.(($q=="billing") ? ' class="active"' : '').'><a href="billing"><i class="fa fa-folder"></i> Billing ('.$sum_mailbox_billing.')</a></li>
						    <li'.(($q=="noncat") ? ' class="active"' : '').'><a href="mailbox.php?q=noncat"><i class="fa fa-folder"></i> Uncategories ('.$sum_mailbox.')</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                                <div class="col-sm-6">
                                                    <!--<label style="margin-right: 10px;">
                                                        <input type="checkbox" id="check-all"/>
                                                    </label>
                                                    Action button
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Mark as read</a></li>
                                                            <li><a href="#">Mark as unread</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Move to junk</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Delete</a></li>
                                                        </ul>
                                                    </div>-->

                                                </div>
                                                <div class="col-sm-6 search-form">
                                                    <!--<form action="#" class="text-right">
                                                        <div class="input-group">                                                            
                                                            <input type="text" class="form-control input-sm" placeholder="Search">
                                                            <div class="input-group-btn">
                                                                <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>                                                     
                                                    </form>-->
                                                </div>
                                            </div><!-- /.row -->
					    
					    <div class="table-responsive">
                                                <!-- THE MESSAGES -->
                                                <table id="tableMailbox" class="table table-bordered table-hover table-mailbox">
						<thead>
						<tr>
						    <th>#</th>
						    <th>Nama</td>
						    <th>Subject</td>
						    <th>Log</td>
						</tr>
						</thead>
						<tbody>';
					    


$no = 1;
while($row_mailbox = mysql_fetch_array($sql_mailbox)){
    $content .= '<tr '.(($row_mailbox["kategori"] == "") ? ' class="unread"' : '').'>
		    <td class="small-col">'.$no.'.</td>
		    <td><a href="form_mailbox.php?id='.$row_mailbox["ID"].'" onclick="return valideopenerform(\'form_mailbox.php?id='.str_replace(' ', '', $row_mailbox["ID"]).'\',\'mailbox'.$row_mailbox["ID"].'\');">'.$row_mailbox["EmailFromP"].'</a></td>
		    <td><a href="form_mailbox.php?id='.$row_mailbox["ID"].'" onclick="return valideopenerform(\'form_mailbox.php?id='.str_replace(' ', '', $row_mailbox["ID"]).'\',\'mailbox'.$row_mailbox["ID"].'\');">'.$row_mailbox["Subject"].'</a></td>
		    <td>'.date("d/m/Y H:i", strtotime($row_mailbox["DateE"])).'</td>
		</tr>';
		$no++;
}

					$content .= '</tbody>
					</table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <!--<div class="pull-right">
                                        <small>Showing 1-12/1,240</small>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>
                                    </div>-->
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->
            ';

$plugins = '<!-- iCheck for checkboxes and radio inputs -->
        <link href="'.URL.'css/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
        
	<!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	
	<!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Page script -->
        <script type="text/javascript">
            $(function() {

                "use strict";

                //iCheck for checkbox and radio inputs
                $(\'input[type="checkbox"]\').iCheck({
                    checkboxClass: \'icheckbox_minimal-blue\',
                    radioClass: \'iradio_minimal-blue\'
                });

                //When unchecking the checkbox
                $("#check-all").on(\'ifUnchecked\', function(event) {
                    //Uncheck all checkboxes
                    $("input[type=\'checkbox\']", ".table-mailbox").iCheck("uncheck");
                });
                //When checking the checkbox
                $("#check-all").on(\'ifChecked\', function(event) {
                    //Check all checkboxes
                    $("input[type=\'checkbox\']", ".table-mailbox").iCheck("check");
                });
                //Handle starring for glyphicon and font awesome
                $(".fa-star, .fa-star-o, .glyphicon-star, .glyphicon-star-empty").click(function(e) {
                    e.preventDefault();
                    //detect type
                    var glyph = $(this).hasClass("glyphicon");
                    var fa = $(this).hasClass("fa");

                    //Switch states
                    if (glyph) {
                        $(this).toggleClass("glyphicon-star");
                        $(this).toggleClass("glyphicon-star-empty");
                    }

                    if (fa) {
                        $(this).toggleClass("fa-star");
                        $(this).toggleClass("fa-star-o");
                    }
                });

                //Initialize WYSIHTML5 - text editor
                $("#email_message").wysihtml5();
            });
        </script>
	
	<!-- DATA TABLES -->
        <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $("#tableMailbox").dataTable();
                
            });
        </script>
	';

    $title	= 'MailBox';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"");
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>