<?php
/*
 * Theme Name: Software Voip
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 25 september 2014
 * Email: dwi@globalxtreme.net
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data id customer");
    global $conn;
    global $conn_voip;
?>
<?php
    
$plugins = '<script type=\'text/javascript\'>
	function validepopupform(id){
		window.opener.document.myForm.card_id.value=id;
		self.close();
        }
</script>';
?>
<?php
$content = '
<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
							 			
				    <div class="box-header">
                                    <h3 class="box-title">List CDR Report</h3>
                                </div><!-- /.box-header -->
				<div class="box">
			    
				
		<table id="example2" class="table table-bordered table-hover">';
$content .='
		
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Account Number</th>
		    <th>LASTNAME</th>
		    <th>GROUP</th>
		    <th>BA</th>
		    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>';

$sql_card = "SELECT `id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date` FROM `cc_card`";
$query_card	= mysql_query($sql_card, $conn_voip);
$no = 1;

    while ($row_card = mysql_fetch_array($query_card)) {
	$content .='<tr>
                    <td>'.$row_card['id'].'</td>
                    <td>'.$row_card["username"].'</td>
                    <td>'.$row_card["lastname"].'</td>
		    <td>'.$row_card["id_group"].'</td>
		    <td>'.$row_card["credit"].'</td>
		    <td>
                      <a href="" onclick="validepopupform(\''.$row_card['id'].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';
	      
$content .= '
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

    $title	= 'input data rate';
    $submenu	= "Data Number rate";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
?>

<?php

	} else{
		header("location: index.php");
	}
} else{
    header("location: index.php");
}
?>