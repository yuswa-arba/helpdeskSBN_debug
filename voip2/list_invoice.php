<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_user.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu list invoice");

	global $conn;
    
	$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	include("../config/".$row_voip["voip_config"]);
	global $conn_voip;

$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$sql_cardid = '';
while($row_cust_voip = mysql_fetch_array($sql_cust_voip))
{
	$sql_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
	$row_voip = mysql_fetch_array($sql_voip);
	$view_id = $row_voip["id"];
	$sql_cardid .= " `cc_invoice`.`id_card` = '".$view_id."' OR";
	
	
}
$sql_cardid = substr($sql_cardid, 0, -2);
//invoice mya2billing
$sql_invoice = "SELECT `cc_invoice`.*, `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`
				  FROM `cc_invoice`, `cc_card`
				  WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
				  AND ($sql_cardid)
				  ORDER BY `cc_invoice`.`id` DESC;";
//				  echo $sql_invoice;
$query_invoice = mysql_query($sql_invoice, $conn_voip);
/*
 *
 *	invoice database 193
$sql_invoice = "SELECT `gx_voip_invoice`.*, `gx_cabang`.`invoice_code` FROM `gx_voip_invoice`, `gxLogin`, `gx_cabang` 
                WHERE `gx_voip_invoice`.`id_voip` = `gxLogin`.`id_voip`
                AND `gxLogin`.`id_cabang` = `gx_cabang`.`id_cabang`
                AND `gx_voip_invoice`.`id_voip` = '".$loggedin["id_voip"]."' 
                AND `gx_voip_invoice`.`invoice_status` = 'unpaid' 
                AND `gx_voip_invoice`.`level` = '0' ;";
//echo $sql_invoice;
$query_invoice = mysql_query($sql_invoice, $conn);
*/

    $content ='
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Invoice </h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            
						<th>No.</th>
                                                <th>Reference</th>
						<th>Account</th>
						<th>Date</th>
						<th>Title</th>
						<th>Paid Status</th>
						<th>Status</th>
						<th>Amount Incl VAT</th>
						
                                           
                                        </tr>';

$no = 1;
while ($row_invoice = mysql_fetch_array($query_invoice))
{
    
    $sql_invoice_item = mysql_query("SELECT SUM(`price`) as `total`, SUM(`VAT`) as `total_vat` FROM `cc_invoice_item` WHERE `id_invoice` = '".$row_invoice["id"]."';", $conn_voip);
    $row_invoice_item = mysql_fetch_array($sql_invoice_item);
    
    $total_amount = $row_invoice_item["total"] + $row_invoice_item["total_vat"];
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="detail_vinvoice?id='.$row_invoice["id"].'">'.$row_invoice["reference"].'</a></td>
		    <td>'.$row_invoice["username"].'</td>
		    <td>'.date("d-m-Y", strtotime($row_invoice["date"])).'</td>
		    <td>'.$row_invoice["title"].'</td>
		    <td>'.(($row_invoice["paid_status"] == "1") ? '<span class="label label-success">Paid</span>' : '<span class="label label-danger">Unpaid</span>').'</td>
		    <td>'.(($row_invoice["status"] == "1") ? '<span class="label label-danger">Close</span>' : '<span class="label label-success">Open</span>').'</td>
		    <td>'.number_format($total_amount, 2, ',','.').' IDR</td>
		    
		   
		</tr>';
		$no++;
}
$content .= '
                                    </table>
				<div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '
	
        <!-- Morris.js charts 
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>

    ';

    $title	= 'Voip';
    $submenu	= "Invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>