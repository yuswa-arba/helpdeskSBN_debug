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
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open log Detail");
     global $conn;

     $content ='
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			   
			    <div class="tab-content">
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Advanced Search</h2>
				   </div>
				   
				   <div class="box-body">
					<form action="" method="post" name="form_search">
					     <table border="0" cellpadding="0" cellspacing="0" class="table">
					      
					      <tr>
						   <td width="10%"> id_cust. :</td>
						   <td width="30%">
							   <input class="form-control" type="text" name="id_cust" value="" />
						   </td>
						   <td width="10%"> id_admin :</td>
						   <td width="30%">
							   <input class="form-control" type="text" name="id_admin" value="" />
						   </td>
					      </tr>
					      <tr>
						   <td align="center" colspan="4">
						        <div class="input-group">
							    <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							    </div>
							    <input type="text" name="time" id="log" class="form-control">
							</div>
						   </td>
					      </tr>
					      <tr>
						   <td width="10%"> name :</td>
						   <td width="30%">
							   <input class="form-control" type="text" name="name" value="" />
						   </td>
						   <td width="10%"> IP :</td>
						   <td width="30%">
							   <input class="form-control" type="text" name="ip" value="" />
						   </td>
					      </tr>
					      <tr>
						   <td align="center" colspan="4"><input class="btn bg-green btn-flat margin" type="submit" name="search" value="Search" /></td>
					      </tr>
					     </table>
					 </form>
				   </div>
			      </div>
			      
			    
			      <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Log Detail</h2>
				   </div>
				   <div class="box-body">
				   
				   <div class="table-container">
					 <table class="table table-bordered table-striped" id="complaint_history" style="width: 100%;">
					 <thead>
					 <tr>
					   <th>No.</th>
					   <th>Id Cust.</th>
					   <th>Name</th>
					   <th>Id Admin</th>
					   <th>Activity</th>
					   <th>Date</th>
					   <th>IP</th>
					   <th>Browser</th>
					 </tr>
					 </thead>
					 <tbody>';
				       
				       //<th>Message</th>
			  $date		= date("Y-m-d");
			  if(isset($_POST["search"])){
			       $id_cust		= isset($_POST["id_cust"]) ? trim(strip_tags($_POST["id_cust"])) : "";
			       $name		= isset($_POST["name"]) ? trim(strip_tags($_POST["name"])) : "";
			       $id_admin	= isset($_POST["id_admin"]) ? trim(strip_tags($_POST["id_admin"])) : "";
			       $ip		= isset($_POST["ip"]) ? trim(strip_tags($_POST["ip"])) : "";
			       $time		= isset($_POST["time"]) ? trim(strip_tags($_POST["time"])) : "";
			       
			       $sql_idcust	= ($id_cust != "") ? "AND `gx_log_detail`.`id_customer` = '$id_cust'" : "";
			       $sql_name	= ($name != "") ? "AND `gx_log_detail`.`nama_customer` = '$name'" : "";
			       $sql_idadmin	= ($id_admin != "") ? "AND `gx_log_detail`.`id_admin` = '$id_admin'" : "";
			       $sql_ip		= ($ip != "") ? "AND `gx_log_detail`.`ip` = '$ip'" : "";
			       $sql_time	= ($time != "") ? "AND `gx_log_detail`.`time` LIKE '$time%'" : "";
			       
			       $sql_log	= "SELECT * FROM `gx_log_detail` WHERE `id_logs` != '' $sql_idcust $sql_name $sql_idadmin $sql_time $sql_ip ORDER BY `id_logs` DESC LIMIT 0,50;";
			  }else{
			       $sql_log	= "SELECT * FROM `gx_log_detail` WHERE `time` LIKE '$date%' ORDER BY `id_logs` DESC LIMIT 0,50;";
			       
			  }
			  
			  $query_log	= mysql_query($sql_log, $conn);
			  $no = 1;
			  while ($row_log = mysql_fetch_array($query_log)) {
				   $content .= '
				   <tr>
					       <td>'.$no.'</td>
					       <td>'.$row_log["id_customer"].'</td>
					       <td>'.$row_log["nama_customer"].'</td>
					       <td>'.$row_log["id_admin"].'</td>
					       <td>'.substr($row_log["activity"], 0, 50).'</td>
					       <td>'.$row_log["time"].'</td>
					       <td>'.$row_log["ip"].'</td>
					       <td>'.substr($row_log["browser_detail"], 0, 50).'</td>
				   </tr>';
				   $no++;
				   //<td>'.substr($email['Message'], 0, 300).'</td>
			   }
			  
			   $content .= '</tbody>
			   
			   </table><br>
			   </div>
	 

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
	<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $(\'#log\').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>

    ';

    $title	= 'Log Detail';
    $submenu	= "Log";
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