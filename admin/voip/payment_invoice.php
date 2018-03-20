<?php
/*
 * Theme Name: Software Voip
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 8 oktober 2014
 * Email: dwi@globalxtreme.net
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data card voip");
    global $conn;
    global $conn_voip;
    $return_form = isset($_GET["r"]) ? $_GET["r"] : "";
    $invoice 	= isset($_GET["invoice"]) ? (int)$_GET["invoice"] : "";


$plugins = '    
<script type=\'text/javascript\'>
	function addPayment(payment){
		
		window.opener.location.href= "manage_payment.php?id='.$invoice.'&addpayment="+payment;
		self.close();
        }
</script>';

/*
<!-- Begin
function sendValue(selvalue){
	 // redirect browser to the grabbed value (hopefully a URL)	  
	window.opener.location.href= "manage_payment.php?id=42&addpayment="+selvalue;
	self.location.href = "/a2billing/admin/Public/A2B_entity_payment_invoice.php?popup_select=1&invoice=42&card=16";
}
// End -->
*/
$content ='
<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                                <div class="box">
	
				<div class="box-header">
                                    <h3 class="box-title">List Payment</h3>
                                </div><!-- /.box-header -->

				<div class="box-body table-responsive">
			    
				    <!--<form action="" method="post" name="form_search" id="form_search">
					<table class="form" width="80%">
					    <tr>
					      <td><label>VOIP Number</label></td>
					      <td><input class="form-control" name="voip_number" type="text" value=""></td>
					    </tr>
					    <tr>
					      <td>&nbsp;</td>
					      <td><input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search"></td>
					    </tr>
					</table>
				    </form>-->
		<table id="data_payment" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
		    <th>Amount</th>
		    <th>Description</th>
		    <th>Type</th>
		    <th>Status</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';

if(isset($_POST["save_search"])){
    
}else{
    $sql_payment 	= "SELECT * FROM `cc_logpayment`;";
    $query_payment	= mysql_query($sql_payment, $conn_voip);
}
$no = 1;

    while ($row_payment = mysql_fetch_array($query_payment)) {
	
	$sql_invoice_payment = mysql_query("SELECT COUNT(*) as `total` FROM `cc_logpayment`, `cc_invoice_payment`
	WHERE `cc_logpayment`.`id` = `cc_invoice_payment`.`id_payment`
	AND `cc_logpayment`.`id` = '".$row_payment["id"]."'
	LIMIT 0,1;", $conn_voip);
	
	$total_invoice_payment = mysql_fetch_array($sql_invoice_payment);
	
	$content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_payment["date"].'</td>
		    <td>'.$row_payment["payment"].'</td>
                    <td>'.$row_payment["description"].'</td>
		    <td>'.$row_payment["payment_type"].'</td>
		    <td>'.(($total_invoice_payment["total"] == 0) ? "Available" : "Used").'</td>
		    <td>'.(($total_invoice_payment["total"] == 0) ? '<a href="javascript:;" onclick="addPayment(\''.$row_payment['id'].'\')">Add</a>' : "").'
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

    $title	= 'Data Payment';
    $submenu	= "data_payment";
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