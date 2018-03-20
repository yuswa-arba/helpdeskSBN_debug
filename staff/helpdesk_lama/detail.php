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
    
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail complaint");

     global $conn;
     global $conn_voip;
    


    $id_mailbox		= isset($_GET['complaint_id']) ? mysql_real_escape_string(strip_tags(trim($_GET['complaint_id']))) : "";
    $sql_mailbox	= mysql_query("SELECT * FROM `gx_email` WHERE `ID` = '$id_mailbox' LIMIT 0,1;");
    $row_mailbox 	= mysql_fetch_array($sql_mailbox);
    $user_email		= $row_mailbox["EmailFrom"];
    
    $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cEmail` = '".$user_email."' AND `level` = '0' LIMIT 0,1;");
    $row_user 	= mysql_fetch_array($sql_user);
    $user_id	= $row_user["cUserID"];
    
    $content ='<section class="content-header">
                    <h1>
                        Detail Complaint
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="detail">Detail Complaint</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Mailbox</h2>
                                </div>
				
				 
		    <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="table footable" cellspacing="0" style="margin-bottom: 0;width:100%">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Id Customer:
		</td>
		<td width="37.5%">
		    '.$row_user["cKode"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    user ID:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$row_user["cUserID"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Phone:
		</td>
		<td width="37.5%">
		   '.$row_user["ctelp"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    '.$row_user["cNama"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Address:
		</td>
		<td width="37.5%">
		   '.$row_user["cAlamat1"].'
		</td>
		
	    </tr>
	    
	    </tbody>
	</table>
	</div>
                                
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
                                    <form action="" method="post" name="form_nonprospek" >
	<div class="table-container">
              <table class="table table-bordered table-striped" id="mailbox" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>CSO</th>
		<th>Problem</th>
		<th>Date</th>
	      </tr>
	      </thead>
	      <tbody>';
	    
	    //<th>Message</th>


$sql_review		= "SELECT `gx_complaint`.* FROM `gx_complaint` WHERE `user_id` = '$user_id' ";

$query_review		= mysql_query($sql_review);
$no = 1;
    while ($row_review = mysql_fetch_array($query_review)) {

	$content .= '
	<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_review["created_by"].'</td>
		    <td>'.$row_review["problem"].'</td>
		    <td>'.$row_review["date_upd"].'</td>
		    
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table><br>
</div>
	
</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#mailbox\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Mailbox';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>