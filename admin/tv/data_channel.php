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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Channel");
    global $conn;
    $conn_tv   = DB_TV();
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
	$id_provider	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
  
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Channel</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">';
		
if(isset($_POST["save_search"])){
	
}else{
 


	//echo "SELECT * FROM `ott_livechannel` WHERE `channelId` = '".$row_data["id_channel"]."';";
 
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Channel</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$no = 1;
    /*$query_data		= "SELECT * FROM `gx_tv_channel_provider`;";
	$sql_data		= mysql_query($query_data, $conn);
	while ($row_data	= mysql_fetch_array($sql_data)) {
	$id_channel= $row_data["id_channel"];
	 
	}*/
	$sql_data_tv	= mysqli_query($conn_tv, "SELECT * FROM `ott_livechannel` WHERE `channelId` != '$id_channel' AND `referencePrice` != '0';");
  while ($row_data_tv	= mysqli_fetch_array($sql_data_tv)) {
	$query_data		= "SELECT * FROM `gx_tv_channel_provider` WHERE `id_channel` = '".$row_data_tv["channelId"]."' AND `id_provider` = '".$id_provider."';";
	$sql_data		= mysql_query($query_data, $conn);
	$row_data		= mysql_num_rows($sql_data);
   
	 if($row_data == 0)
	 {
	   $content .='<tr>
			  <td>'.$no.'</td>
			  <td>'.$row_data_tv["channelName"].'</td>
			  <td>
				<a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data_tv["channelId"]).'\',\''.mysql_real_escape_string($row_data_tv["channelName"]).'\')">Select</a>
			  </td>
			</tr>';
			$no++;
	 }
   
   
	 
     }

		
                  $content .='
                  
                </tbody>
              </table>';


$content .='
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
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
		    
	    });
	    
	   
        </script>

 <script type="text/javascript">
   
	 function validepopupform2(id_channel,nama){
		 window.opener.document.'.$return_form.'.nama.value=nama;
		 window.opener.document.'.$return_form.'.id_channel.value=id_channel;
		 
		 self.close();
	 }
 </script>
 
     ';



    $title	= 'Data Channel';
    $submenu	= "channel_provider";
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