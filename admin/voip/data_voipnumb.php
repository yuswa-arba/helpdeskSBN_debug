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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Voip Number");
    global $conn;
    global $conn_voip;
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Voip Number</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="voip_number" placeholder="Voip Number" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
		
if(isset($_POST["save_search"])){
	$voip_number	= isset($_POST['voip_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['voip_number']))) : "";
	
	
	$sql_voip_number	= ($voip_number != "") ? "AND `nomer_telpon` LIKE '".$voip_number."%'": "";
	
	
	$sql_voipnumber	= "SELECT * FROM `gx_voip_nomerTelpon` WHERE `status` = '2' AND `kode` = '0361' AND `level` = '0' $sql_voip_number ORDER BY `id` ASC LIMIT 0,10;";
}else{
 $sql_voipnumber	= "SELECT * FROM `gx_voip_nomerTelpon` WHERE `status` = '2' AND `kode` = '0361' AND `level` = '0' ORDER BY `id` ASC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Code</th>
		    <th>Voip Number</th>
		    <th>Status</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_voip_number	= mysql_query($sql_voipnumber, $conn);
$no = 1;

    while ($row_voip_number = mysql_fetch_array($query_voip_number)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_voip_number["kode"].'</td>
                    <td>'.$row_voip_number["nomer_telpon"].'</td>
		    <td>'.StatusNumberVOIP($row_voip_number["status"]).'</td>
		    <td>'.$row_voip_number["user_add"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.$row_voip_number["nomer_telpon"].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
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

<script type="text/javascript">
  
	function validepopupform2(voipnumber){
                window.opener.document.'.$return_form.'.useralias.value=voipnumber;
		
		
                self.close();
        }
</script>

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
    
    ';

    $title	= 'Data VOIP Number';
    $submenu	= "voip";
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