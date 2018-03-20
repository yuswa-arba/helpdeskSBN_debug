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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail complaint");
     global $conn;

     
     $content ='<section class="content-header">
		     <h1>
			 Setting Email
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			    <ul class="nav nav-tabs" role="tablist" id="myTab">
				<li role="presentation" class="active"><a href="#footer" aria-controls="footer" role="tab" data-toggle="tab">Footer Email</a></li>
				
				
			    </ul>
			    <div class="tab-content">
			    
			      <div role="tabpanel" class="tab-pane active" id="footer">
			    
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">List Footer</h2>
				   </div>
				 <a href="form_footer.php" class="btn bg-green btn-flat margin">Add Footer</a>
				   <div class="box-body">
				     <form action="" method="post" name="form_nonprospek" >
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th width="1%">No.</th>
		 <th width="50%">Footer</th>
		 <th width="10%">User Add</th>
		 <th width="12%">Date Add</th>
		 <th width="7%">status</th>
		 <th width="10%">Action</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 
$sql_email_footer	= "SELECT * FROM `gx_email_footer` WHERE `id_employee` = '$loggedin[id_employee]' ORDER BY `date_add` DESC;";
$query_email_footer	= mysql_query($sql_email_footer, $conn);


$no = 1;
while ($row_footer = mysql_fetch_array($query_email_footer)) {
     $status ="";
     $status .= ($row_footer["active"] == "0") ? "Active" : '';
     $status .= ($row_footer["active"] == "1") ? "-" : '';
	 $content .= '
	 <tr>
		     <td>'.$no.'</td>
		     <td>'.substr($row_footer["footer"], 0, 50).'</td>
		     <td>'.$row_footer["user_add"].'</td>
		     <td>'.$row_footer["date_add"].'</td>
		     <td>'.$status.'</td>
		     <td>View || <a href="form_footer.php?id_footer='.$row_footer["id_footer"].'">Edit</a></td>
		    
	 </tr>';
	 $no++;
	 //<td>'.substr($email['Message'], 0, 300).'</td>
 }

$sql_email_setting	= "SELECT * FROM `gx_email_setting` WHERE `level` = '0';";
$query_email_setting	= mysql_query($sql_email_setting, $conn);
$row_setting 		= mysql_fetch_array($query_email_setting);
 $content .= '</tbody>
 
 </table><br>
 </div>
	 
 </form>
				 </div><!-- /.box-body -->
			     </div><!-- /.box -->
			     </div>
			     
			     
			     
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
	       $(\'#complaint_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
	       $(\'#email_history\').dataTable({
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
	    $(function () {
	      $(\'#myTab a:first\').tab(\'show\')
	    })
	</script>

    ';

    $title	= 'Setting Email';
    $submenu	= "setting";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>