<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}

    global $conn;
$start		= isset($_GET["start"]) ? trim(strip_tags($_GET["start"]))." 00:00:00" : date("Y-m-d 00:00:00");
$end		= isset($_GET["end"]) ? trim(strip_tags($_GET["end"]))." 23:59:59" : date("Y-m-d 23:59:59");

$sql_start 	= "AND `date_add` >= '$start'";
$sql_end 	= "AND `date_add` <= '$end'";

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Summary Complaint
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Summary</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
								
                                        <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th rowspan="2" width="3%">No.</th>
					<th rowspan="2">Tgl</th>
					<th rowspan="2">UID</th>
					<th rowspan="2">GNB</th>
					<th colspan="2">Time</th>
					<th colspan="4">Complaint By</th>
					<th colspan="3">Complaint</th>
					<th colspan="2">Status</th>
					
                  </tr>
				  <tr>
					<th>Start</th>
					<th>Finish</th>
					<th>Walk in</th>
					<th>Telp</th>
					<th>Email</th>
					<th>SMS Gateway</th>
					<th>Problem</th>
					<th>Solution</th>
					<th>Result</th>
                 </tr>
                </thead>
                <tbody>';
				
	$no = 1;
	$id_cso			= isset($_GET["id"]) ? (int)$_GET["id"]: $loggedin["id_employee"];
	$sql_complaint 	= mysql_query("SELECT * FROM `gx_helpdesk_complaint`
									WHERE `level` = '0' $sql_start $sql_end
									ORDER BY `date_add` ASC;", $conn);
	while($row_complaint = mysql_fetch_array($sql_complaint))
	{
		$sql_spk		= mysql_query("SELECT * FROM `gx_helpdesk_spk`
									WHERE `id_trouble_ticket` = '".$row_complaint["ticket_number"]."' AND `level` = '0' $sql_start $sql_end;", $conn);
		$row_spk = mysql_fetch_array($sql_spk);
		
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.date("d-m-Y", strtotime($row_complaint["date_add"])).'</td>
		<td>'.$row_complaint["user_id"].'</td>
		<td>'.$row_complaint["cust_number"].'</td>
		<td>'.date("H:i:s", strtotime($row_spk["date_add"])).'</td>
		<td>'.date("H:i:s", strtotime($row_spk["check_out"])).'</td>
		<td>'.($row_complaint["media"] == "walkin" ? "1" : "").'</td>
		<td>'.($row_complaint["media"] == "telephone" ? "1" : "").'</td>
		<td>'.($row_complaint["media"] == "email" ? "1" : "").'</td>
		<td>'.($row_complaint["media"] == "sms" ? "1" : "").'</td>
		<td>'.$row_complaint["problem"].'</td>
		<td>'.$row_complaint["solusi"].'</td>
		<td></td>
		<td>'.$row_complaint["status"].'</td>
		
		
	    </tr>';
	    $no++;
	}
//<td><input type="checkbox" name="id_complaint[]" value="'.$r_complaint["id_complaint"].'"></td>
$content .='</tbody>

</table>

    <br>
</div>
    <br />
            </div> 
       </div>';

$submenu	= "helpdesk_complaint";
$plugins	= '

        <!-- DATA TABLES -->
        <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
			});
        </script>';

    $title	= 'Helpdesk';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>