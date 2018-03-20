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
if($loggedin["group"] == 'admin'){
    
    global $conn_helpdesk;
    global $conn;
$ttl  = "";

$ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "List Incoming Complaint" : "";
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_bank.php" class="btn bg-maroon btn-flat margin">Add bank</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$ttl.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				';

$type = isset($_GET['type']) ? $_GET['type'] : '';
// enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Helpdesk $type");

$content .='';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="8%">Kode Bank</th>
			<th width="10%">Nama</th>
			<th width="8%">No. Rekening</th>
			<th width="10%">No. Acc</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_bank	= mysql_query("SELECT `id_bank`, `kode_bank`, `nama`, `no_rek`, `no_acc`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_bank` WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC;", $conn);
    $no = 1;

    while($r_bank = mysql_fetch_array($sql_bank))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_bank["kode_bank"].'</td>
			<td>'.$r_bank["nama"].'</td>
			<td>'.$r_bank["no_rek"].'</td>
			<td>'.$r_bank["no_acc"].'</td>
			<td><a href="detail_bank.php?id_bank='.$r_bank["id_bank"].'" onclick="return valideopenerform(\'detail_bank.php?id_bank='.$r_bank["id_bank"].'\',\'bank\');">Details</a>  || <a href="form_bank.php?id_bank='.$r_bank["id_bank"].'">edit</a></td>
			<!--<td><a href="detail_bank.php?id_bank='.$r_bank["id_bank"].'"> View </a> || <a href="form_bank.php?id_bank='.$r_bank["id_bank"].'">edit</a></td>-->
			<!--<td><input type="checkbox" name="id_bank[]" value="'.$r_bank["id_bank"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "master_bank";



 
 $content .='<br />
            </div> 
       </div>';

}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
    $submenu	= "master_dashboard";
}

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

    $title	= 'Master';
    
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