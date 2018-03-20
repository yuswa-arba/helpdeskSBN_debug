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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
        
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Trouble Ticket
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Helpdesk</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				
				';

    $sql_cso = mysql_query("SELECT `u`.`username`, `ud`.`first_name`, `ud`.`last_name`, `ud`.`id_employee` FROM `gx_employee` ud, `users` u WHERE `ud`.`id_employee` = `u`.`id_user` AND `ud`.`level` = '0' AND `u`.`group` = 'cso';", $conn_helpdesk);
    
    $content .= '<hr>
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
			<th width="15%">Action</th>
			<th width="2%">#</th>
                  </tr>
                </thead>
                <tbody>';


	
	$no = 1;
	$id_cso		= $loggedin["id_employee"];
	$sql_troubleticket = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0' AND `gx_helpdesk_complaint`.`trouble_ticket` = '1'
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT 100;", $conn);
	while($r_troubleticket = mysql_fetch_array($sql_troubleticket))
	{
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_troubleticket["created_by"].'</td>
		<td>'.$r_troubleticket["cust_number"].'</td>
		<td>'.$r_troubleticket["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_troubleticket["date_add"])).'</td>
		<td>'.$r_troubleticket["name"].'</td>
		<td><a href="detail_troubleticket.php?id_troubleticket='.$r_troubleticket["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_troubleticket["id_complaint"].'\',\'toubleticket\');">Details</a></td>
		<td>'.$r_troubleticket["status"].'</td>
		<td><!--<a href="form_troubleticket.php?id_troubleticket='.$r_troubleticket["id_complaint"].'">edit</a>--></td>
		<td><input type="checkbox" name="id_troubleticket[]" value="'.$r_troubleticket["id_complaint"].'"></td>
	    </tr>';
	    
	    $no++;
	}

$content .='</tbody>

</table><br>
</div>';

$submenu	= "helpdesk_troubleticket";	
 
 $content .='<br />
            </div> 
       </div>';


//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '

        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Trouble Ticket';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
}
     else{
	header("location: ".URL_CSO."logout.php");
    }

?>