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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Report Helpdesk");
    global $conn;

    $content ='
                <!-- Main content -->
                <section class="content">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h4 class="box-title">Search</h4>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form role="form" method="POST" action="" id="report_helpdesk" name="report_helpdesk">
                                        <div class="box-body">
                                            <div class="row">                                                
                                                <div class="col-xs-9">
						    <table style="width:80%">
						    <tr>
							<td>Date</td>
							<td><input  class="form-control" type="text" readonly="" name="tanggal" id="datepicker" class="hasDatepicker"></td>
						    </tr>
						    <tr>
							<td>Type</td>
							<td><input class="required" type="radio" name="complaint_type" value="daily" style="float:left;">Daily</a>
							<input class="required" type="radio" name="complaint_type" value="weekly" style="float:left;">Weekly</a>
							<input class="required" type="radio" name="complaint_type" value="monthly" style="float:left;">Monthly</a></td>
						    </tr>
						    <tr>
							<td>CSO</td>
							<td><input name="id_employee"  type="hidden" value="" readonly="" style="width:150px;">
							<input name="name_technician" type="text" value="" readonly="" style="width:350px;">
				
							<a href="'.URL_ADMIN.'helpdesk/data_tech.php?r=report_helpdesk" class="btn btn-sm bg-navy btn-flat margin pull-right"
						onclick="return valideopenerform(\''.URL_ADMIN.'helpdesk/data_tech.php?r=report_helpdesk\',\'report_helpdesk\');">Search CSO</a>
							</td>
						    </tr>
						    </table>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';

if(isset($_POST["search"]))
{
    $content .='<div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Report</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">CSO</th>
			<th width="10%">Cust ID</th>
			<th width="8%">User ID</th>
			<th width="8%">Tanggal</th>
			<th width="10%">Name</th>
			<th width="10%" style="text-align:center">Problem</th>
			<th width="10%">Status</th>
			
                  </tr>
                </thead>
                <tbody>';


	
	$no = 1;
	$id_cso		= $loggedin["id_employee"];
	$tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	$complaint_type	= isset($_POST['complaint_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['complaint_type']))) : "";
	$cso		= isset($_POST['name_technician']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_technician']))) : "";
	
	$sql_tanggal	= ($tanggal != "") ? " AND `date_add` LIKE '%".$tanggal."%'" : "";
	//$sql_complaint_type	= isset($complaint_type != "") ? " AND `date_add` LIKE '%".$tanggal."%'" : "";
	$sql_complaint_type	=  "";
	$sql_cso	= ($cso != "") ? " AND `created_by` LIKE '%".$cso."%'" : "";
	
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
				     $sql_tanggal
				     $sql_complaint_type
				     $sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add` DESC;", $conn);
	/*echo "SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
				     $sql_tanggal
				     $sql_complaint_type
				     $sql_cso
				       ORDER BY `gx_helpdesk_complaint`.`date_add` DESC;";*/
	while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_complaint["created_by"].'</td>
		<td>'.$r_complaint["cust_number"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["date_add"])).'</td>
		<td>'.$r_complaint["name"].'</td>
		<td><a href="'.URL_ADMIN.'helpdesk/detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\''.URL_ADMIN.'helpdesk/detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">Details</a></td>
		<td>'.$r_complaint["status"].'</td>
		
	    </tr>';
	    $no++;
	}

$content .='</tbody>

</table><br>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</div>';
			    
}
$content .='
                    </div>
                </section><!-- /.content -->
            ';

$plugins = '<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                $(\'#cdr_history\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
    ';


    $title	= 'Report Helpdesk';
    $submenu	= "report_helpdesk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>