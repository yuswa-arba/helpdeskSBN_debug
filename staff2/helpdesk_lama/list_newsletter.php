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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open list newsletter");
    global $conn_helpdesk;
    
            
    $content =' <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Newsletter
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Newsletter</h3>
				    <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					    <a href="'.URL_CSO.'helpdesk/newsletter.php">Add Newsletter</a>
					</div>
					<div class="btn bg-olive btn-flat margin">
					    <a href="'.URL_CSO.'helpdesk/list_newsletter.php">List Newsletter</a>
					</div>
				    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="list_newsletter" class="table table-bordered table-striped">
                                        <thead>
					    <tr>
                                                <th>#</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Date add</th>
						<th>To</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
                             $sql_newsletter 	= mysql_query("SELECT * FROM `newsletter` ORDER BY `id_newsletter` DESC", $conn_helpdesk);
					$no = 1;
					while($newsletter = mysql_fetch_array($sql_newsletter)){
						$content .= '<tr>
						<td>'.$no.'.</td>
						<td>'.$newsletter['subject'].'</td>
						<td><a href="javascript:load_url(\'view_message_listnewsletter.php?id_newsletter='.$newsletter['id_newsletter'].'\')">View Message</a></td>
						
						<td>'.$newsletter['date_add'].'</td>
						<td>'.$newsletter['to'].'</td>
						
						<td><a href="javascript:load_url(\'newsletter.php?id_newsletter='.$newsletter['id_newsletter'].'\')">Edit</a></td>
						</tr>';
						$no++;
						//<td>'.substr($email['Message'], 0, 300).'</td>
					}
                                          
$content .= '                       </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '
        <!-- DATA TABLES -->
        <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
        <!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
	<!-- page script -->
        <script type="text/javascript">
            $(function() {
                $(\'#list_newsletter\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
        <script Language="JavaScript">
	function load_url(link) {
	var link;
	var load_url = window.open(link,\'\',\'height=600,width=950,resizable=yes,scrollbars=yes\');
	}
	</script>
    ';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }
?>