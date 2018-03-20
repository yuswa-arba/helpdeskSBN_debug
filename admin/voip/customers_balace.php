<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
 
 /* pure data cdrs
    //The variable FG_TABLE_NAME define the table name to use
    $FG_TABLE_NAME = "cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id";

    // This Variable store the argument for the SQL query
    $FG_COL_QUERY = 't1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest, t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode, t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill, case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup';

    select id from cc_card where username=".$entercustomer_num
    
    $QUERY = "SELECT DATE(t1.starttime) AS day, sum(t1.sessiontime) AS calltime, sum(t1.sessionbill) AS cost, count(*) as nbcall,
            sum(t1.buycost) AS buy, sum(case when t1.sessiontime>0 then 1 else 0 end) as success_calls
        	FROM $FG_TABLE_NAME WHERE $FG_TABLE_CLAUSE GROUP BY day ORDER BY day"; //extract(DAY from calldate)
*/

/*
 * ID   	CardNumber 	ALIAS		FIRSTNAME 	LASTNAME 	CREDIT 	INVOICE 	PAYMENT 	TO PAY 	ACTION
 */

/*
        $QUERY_INVOICE_ENOUGH_PAID = "SELECT DATE_FORMAT(sub.date,'%c'),SUM(sub.test) FROM( SELECT cc_invoice.date date,IF(IFNULL(SUM(CEIL(cc_invoice_item.price*(1+(cc_invoice_item.vat/100))*100)/100),0) <= IFNULL(SUM(CEIL(cc_logpayment.payment*100)/100),0),1,0) test FROM cc_invoice LEFT JOIN cc_invoice_item on cc_invoice_item.id_invoice=cc_invoice.id LEFT JOIN cc_invoice_payment on cc_invoice_payment.id_invoice = cc_invoice.id  LEFT JOIN cc_logpayment on cc_invoice_payment.id_payment = cc_logpayment.id WHERE cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by cc_invoice.id ) AS sub group by MONTH(sub.date) ORDER BY  sub.date DESC";
	$result_invoice_enough_paid = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_ENOUGH_PAID);
	$QUERY_INVOICE_PAID = "SELECT DATE_FORMAT(date,'%c'),COUNT(*) FROM cc_invoice WHERE paid_status = 1 AND cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by MONTH(date) ORDER BY date DESC";
	$result_invoice_paid = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_PAID);
	$QUERY_INVOICE_UNPAID = "SELECT DATE_FORMAT(date,'%c'),COUNT(*) FROM cc_invoice WHERE paid_status = 0 AND cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by MONTH(date) ORDER BY date DESC";
	$result_invoice_unpaid = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_UNPAID);
	$QUERY_INVOICE_COUNT = "SELECT DATE_FORMAT(date,'%c'),COUNT(*) FROM cc_invoice WHERE cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by MONTH(date) ORDER BY date DESC";
	$result_invoice_count = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_COUNT);
	$list_month = Constants :: getMonth();

    sql 1 cc_call = "SELECT `id`, `sessionid`, `uniqueid`, `card_id`, `nasipaddress`, `starttime`, `stoptime`, `sessiontime`, `calledstation`, `sessionbill`, `id_tariffgroup`, `id_tariffplan`, `id_ratecard`, `id_trunk`, `sipiax`, `src`, `id_did`, `buycost`, `id_card_package_offer`, `real_sessiontime`, `dnid`, `terminatecauseid`, `destination` FROM `cc_call` WHERE 1";
    sql 2 SELECT `id`, `creationdate`, `firstusedate`, `expirationdate`, `enableexpire`, `expiredays`, `username`, `useralias`, `uipass`, `credit`, `tariff`, `id_didgroup`, `activated`, `status`, `lastname`, `firstname`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `fax`, `inuse`, `simultaccess`, `currency`, `lastuse`, `nbused`, `typepaid`, `creditlimit`, `voipcall`, `sip_buddy`, `iax_buddy`, `language`, `redial`, `runservice`, `nbservice`, `id_campaign`, `num_trials_done`, `vat`, `servicelastrun`, `initialbalance`, `invoiceday`, `autorefill`, `loginkey`, `mac_addr`, `id_timezone`, `tag`, `voicemail_permitted`, `voicemail_activated`, `last_notification`, `email_notification`, `notify_email`, `credit_notification`, `id_group`, `company_name`, `company_website`, `vat_rn`, `traffic`, `traffic_target`, `discount`, `restriction`, `id_seria`, `serial`, `block`, `lock_pin`, `lock_date` FROM `cc_card` WHERE 1
    sql 3 cc_trunk = "SELECT `id_trunk`, `trunkcode`, `trunkprefix`, `providertech`, `providerip`, `removeprefix`, `secondusedreal`, `secondusedcarrier`, `secondusedratecard`, `creationdate`, `failover_trunk`, `addparameter`, `id_provider`, `inuse`, `maxuse`, `status`, `if_max_use` FROM `cc_trunk` WHERE 1
    sql 4 cc_ratecard = "SELECT `id`, `idtariffplan`, `dialprefix`, `buyrate`, `buyrateinitblock`, `buyrateincrement`, `rateinitial`, `initblock`, `billingblock`, `connectcharge`, `disconnectcharge`, `stepchargea`, `chargea`, `timechargea`, `billingblocka`, `stepchargeb`, `chargeb`, `timechargeb`, `billingblockb`, `stepchargec`, `chargec`, `timechargec`, `billingblockc`, `startdate`, `stopdate`, `starttime`, `endtime`, `id_trunk`, `musiconhold`, `id_outbound_cidgroup`, `rounding_calltime`, `rounding_threshold`, `additional_block_charge`, `additional_block_charge_time`, `tag`, `disconnectcharge_after`, `is_merged`, `additional_grace`, `minimal_cost`, `announce_time_correction`, `destination` FROM `cc_ratecard` WHERE 1";
    data => 1.  	2014-10-02 08:38:07 	1701 	584488 	584488 	Indonesia 	110.000 IDR 	110.000 IDR 	01:50 	75816 	TELKOM-573222 	ANSWER 	STANDARD 	220.000 IDR 	220.000 IDR 	0.00% 	0.00% 	
 		
Date	=> cc_call.starttime
CallerID => cc_card.useralias -> src
DNID => cc_call.dnid
Phone Number => cc_card.calledstation
Destination => cc_call_destination -> card.destination
Buy Rate => cc_ratecard.buyrate
Sell Rate => cc_ratecard.rateinitial
Duration =>  stoptime -	starttime -> cc_card.sessiontime
Account => cc_card.card_id
Trunk => cc_trunk.trunkcode
TC => cc_card.terminatecauseid
CallType => cc_card.sipiax
Buy => cc_card.buycost
Sell => cc_card.buycost
Margin => margin
Markup => markup


cc_invoice.date
cc_invoice_item.price
cc_invoice_item
cc_invoice.id
cc_invoice_payment
cc_invoice.id
cc_logpayment
cc_invoice_payment.id_payment

$table = new Table();
$result_nb_card = $table->SQLExec($HD_Form->DBHandle, "SELECT COUNT(*) from cc_card");

if ($result_nb_card[0][0] > 0) {

	$temp = date("Y-m-01");
	$now_month = date("m");
	$nb_month = 5;
	$datetime = new DateTime($temp);
	$datetime->modify("-$nb_month month");
	$checkdate = $datetime->format("Y-m-d");
	$QUERY_INVOICE_ENOUGH_PAID = "SELECT DATE_FORMAT(sub.date,'%c'),SUM(sub.test) FROM( SELECT cc_invoice.date date,IF(IFNULL(SUM(CEIL(cc_invoice_item.price*(1+(cc_invoice_item.vat/100))*100)/100),0) <= IFNULL(SUM(CEIL(cc_logpayment.payment*100)/100),0),1,0) test FROM cc_invoice LEFT JOIN cc_invoice_item on cc_invoice_item.id_invoice=cc_invoice.id LEFT JOIN cc_invoice_payment on cc_invoice_payment.id_invoice = cc_invoice.id  LEFT JOIN cc_logpayment on cc_invoice_payment.id_payment = cc_logpayment.id WHERE cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by cc_invoice.id ) AS sub group by MONTH(sub.date) ORDER BY  sub.date DESC";
	$result_invoice_enough_paid = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_ENOUGH_PAID);
	$QUERY_INVOICE_PAID = "SELECT DATE_FORMAT(date,'%c'),COUNT(*) FROM cc_invoice WHERE paid_status = 1 AND cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by MONTH(date) ORDER BY date DESC";
	$result_invoice_paid = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_PAID);
	$QUERY_INVOICE_UNPAID = "SELECT DATE_FORMAT(date,'%c'),COUNT(*) FROM cc_invoice WHERE paid_status = 0 AND cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by MONTH(date) ORDER BY date DESC";
	$result_invoice_unpaid = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_UNPAID);
	$QUERY_INVOICE_COUNT = "SELECT DATE_FORMAT(date,'%c'),COUNT(*) FROM cc_invoice WHERE cc_invoice.date >= TIMESTAMP('$checkdate') AND cc_invoice.date <= CURRENT_TIMESTAMP group by MONTH(date) ORDER BY date DESC";
	$result_invoice_count = $table->SQLExec($HD_Form->DBHandle, $QUERY_INVOICE_COUNT);
	$list_month = Constants :: getMonth();
	
	

        cc_invoice.date, cc_invoice_item.price, cc_invoice_item.vat, cc_logpayment.payment, cc_invoice, cc_invoice_item, cc_invoice_item.id_invoice, cc_invoice.id, cc_invoice_payment, cc_invoice_payment.id_invoice, cc_invoice.id, cc_logpayment, cc_invoice_payment.id_payment, cc_logpayment.id, cc_invoice.date
        cc_invoice.date, cc_invoice.id
	cc_invoice, paid_status, cc_invoice.date, cc_invoice.date
	cc_invoice, paid_status, cc_invoice.date, cc_invoice.date
	cc_invoice, cc_invoice.date, cc_invoice.date 
	

*/
 
include ("../../config/configuration_admin.php");


redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;



//cc_card => id, sername, useralias, firstname, lastname, credit, (invoice), (payment), to pay
$sql_customers_balance = mysql_query("SELECT id, username, useralias, firstname, lastname, credit FROM `cc_card`", $conn_voip);    
            
    $content ='
                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Log Refill</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';
               
$content .= '<table align="right"><tr align="right">
        <td align="right"> &nbsp; </td>
	 </tr></table>

	<br><br>';

$content .= '<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th><th>CardNumber</th><th>ALIAS</th><th>FIRSTNAME</th><th>LASTNAME</th><th>CREDIT</th><th>INVOICE</th><th>PAYMENT</th><th>TO PAY</th><th>ACTION</th>   
                                            </tr>
                                        </thead>
                                        <tbody>';
// ID   	CardNumber 	ALIAS		FIRSTNAME 	LASTNAME 	CREDIT 	INVOICE 	PAYMENT 	TO PAY 	ACTION
// 2 		24414		1700 	Satulapandua 	Lopez 	15,060.000 IDR 	25000.00 		-25000 	INVOICE PAYMENT
/*
cc_card => id, sername, useralias, firstname, lastname, credit, (invoice), (payment), to pay
"cc_card","Card"
ID, "id"
CardNumber, "username"
ALIAS, "useralias"
"FIRSTNAME", "firstname"
"LASTNAME", "lastname"
"CREDIT", "credit"
"INVOICE", "invoice", "cc_invoice LEFT JOIN cc_invoice_item ON cc_invoice_item.id_invoice=cc_invoice.id", "TRUNCATE(SUM(CEIL(cc_invoice_item.price*(1+(cc_invoice_item.vat/100))*100)/100),2)", "cc_invoice.id_card='%id' GROUP BY cc_invoice.id_card"
"PAYMENT", "payment", "cc_logpayment as t2", "TRUNCATE(SUM(t2.payment),2),t2.card_id", "t2.card_id='%id' GROUP BY t2.card_id"
"TO PAY", "to pay"

$HD_Form -> FieldViewElement ('id, username, useralias, firstname, lastname, credit, id, id, id');
*/
$no = 1;
					while($row_customers_balance = mysql_fetch_array($sql_customers_balance)){
					    
						    
						    $content .= '<tr>';
						    $data_invoice_customers_balance = mysql_fetch_array(mysql_query("SELECT TRUNCATE(SUM(CEIL(cc_invoice_item.price*(1+(cc_invoice_item.vat/100))*100)/100),2) AS invoice FROM cc_invoice LEFT JOIN cc_invoice_item ON cc_invoice_item.id_invoice=cc_invoice.id WHERE cc_invoice.id_card='$row_customers_balance[id]'", $conn_voip));
						    $data_payment_customers_balance = mysql_fetch_array(mysql_query("SELECT TRUNCATE(SUM(t2.payment),2),t2.card_id AS payment FROM cc_logpayment as t2 WHERE t2.card_id='$row_customers_balance[id]' GROUP BY t2.card_id", $conn_voip));
						    $data_topay_customers_balance = $data_payment_customers_balance['payment'] - $data_invoice_customers_balance['invoice'];
						    $content .= '<td>'.$row_customers_balance['id'].'</td>
						    <td>'.$row_customers_balance['username'].'</td><td>'.$row_customers_balance['useralias'].'</td><td>'.$row_customers_balance['firstname'].'</td><td>'.$row_customers_balance['lastname'].'</td><td>'.$row_customers_balance['credit'].'</td><td>'.$data_invoice_customers_balance['invoice'].'</td><td>'.$data_payment_customers_balance['payment'].'</td><td>'.$data_topay_customers_balance.'</td><td>ACTION</td>';
						    
						    
						    /*
						    $content .= '<td>'.$no.'</th>
						    <td>'.$row_cdrs['starttime'].'</th>
						    <td>'.$row_cdrs['src'].'</th>
						    <td>'.$row_cdrs['dnid'].'</th>
						    <td>'.$row_cdrs['calledstation'].'</th>
						    <td>';
						    
						    $data_array_prefix = mysql_fetch_array(mysql_query("SELECT  `cc_prefix`.`destination` FROM `cc_prefix` WHERE `cc_prefix`.`prefix`='$row_cdrs[dest]'", $conn_voip));
												    
						    $content .= '
						    '.$data_array_prefix['destination'].'
						    </td>';

						    $content .= '
						    <td>'.(isset($_POST['choose_currency']) ? ($row_cdrs['buyrate'] / $data_pembagi_nilai_currency['value']) : $row_cdrs['buyrate']).' '.$data_choose_cur.'</td>
						    <td>'.(isset($_POST['choose_currency']) ? ($row_cdrs['rateinitial'] / $data_pembagi_nilai_currency['value']) : $row_cdrs['rateinitial']).' '.$data_choose_cur.'</td>
						    <td>'.((isset($_POST['resulttype']) ? $_POST['resulttype'] : '') == 'min' ? date("i:s", $row_cdrs['sessiontime']) : date("s", $row_cdrs['sessiontime'])).'</td>
						    <td>';
						    $data_array_username = mysql_fetch_array(mysql_query("SELECT `username` FROM `cc_card` WHERE `id`='$row_cdrs[card_id]'", $conn_voip));
						    $content .= ''.$data_array_username['username'].'</td>
						    <td>'.$row_cdrs['trunkcode'].'</td>
						    <td>';
						    if ($row_cdrs['terminatecauseid'] == 1 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "ANSWER";
						    }
						    elseif ($row_cdrs['terminatecauseid'] != 1 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "INCOMPLET";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 5 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "CONGESTION";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 3 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "NOANSWER";	
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 2 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "BUSY";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 6 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "CHANUNAVAIL";
						    }
						    elseif ($row_cdrs['terminatecauseid'] == 4 && $row_cdrs['terminatecauseid'] > 0 ) {
							$content .= "CANCEL";	
						    }
						    */
						    
						    /*
						    $content .= '</td>
						    <td>'.$row_cdrs['sipiax'].'</td>
						    <td>'.$row_cdrs['buycost'].'</td>
						    <td>'.$row_cdrs['sessionbill'].'</td>
						    <td>'.($row_cdrs['margin'] != 0 ? $row_cdrs['margin'] ."%" : "" ).'</td>
						    <td>'.($row_cdrs['markup'] != 0 ? $row_cdrs['markup'] ."%" : "" ).'</td>';
						    */
						    
						    
						    $content .= '
						    </tr>';
						    $no++;
					   
					    
					}
					
$content .= '                           </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th><th>CardNumber</th><th>ALIAS</th><th>FIRSTNAME</th><th>LASTNAME</th><th>CREDIT</th><th>INVOICE</th><th>PAYMENT</th><th>TO PAY</th><th>ACTION</th>   
                                            </tr>
                                        </tfoot>
                                    </table>';	
	
$content .= '</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';	        
$plugins = '
<!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $(\'#example2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
        <script Language="JavaScript">
	function load_url(link) {
	var link;
	var load_url = window.open(link,\'\',\'height=600,width=950,resizable=yes,scrollbars=yes\');
	}
	</script>
	
		 
<script id="source" language="javascript" type="text/javascript">
  	
$(document).ready(function () {
var format = "";
var period_val="";
var x_format = "";
var width= Math.min($("#refills_graph").parent("div").width(),$("#refills_graph").parent("div").innerWidth());
$("#refills_graph").width(width-10);
$("#refills_graph").height(Math.floor(width/2));


$(\'.update_refills_graph\').click(function () {
    $.getJSON("modules/refills_lastmonth.php", { type: this.id , view_type : period_val},
		      function(data){
				<?php if($DEBUG_MODULE)echo "alert(data.query);alert(data.data);"?>
				var graph_max = data.max;
				var graph_data = new Array();
				for (i = 0; i < data.data.length; i++) {
				    graph_data[i] = new Array();
				    graph_data[i][0]= parseInt(data.data[i][0]);
				    graph_data[i][1]= data.data[i][1]
				 }
				format = data.format;
				plot_graph_refills(graph_data,graph_max);
			 });

   });
$(\'.period_refills_graph\').change(function () {
    period_val = $(this).val();
    if($(this).val() == "month" ) x_format ="%b";
    else x_format ="%d-%m";
    $(\'.update_refills_graph:checked\').click();
   });

$(\'#view_refill_day\').click();
$(\'#view_refill_day\').change();

function plot_graph_refills(data,max){
    var d= data;
    var max_data = (max+5-(max%5));
    var min_month = $mingraph_month."000";
    var max_month = $maxgraph_month."000";
    var min_day = $mingraph_day."000";
    var max_day = $maxgraph_day."000";
    if(period_val=="month"){
	var min_graph = min_month;
	var max_graph = max_month;
	var bar_width = 28*24 * 60 * 60 * 1000;
    }else{
	var min_graph = min_day;
	var max_graph = max_day;
	var bar_width = 24 * 60 * 60 * 1000;
    }

    $.plot($("#refills_graph"), [
				{
				    data: d,
				    bars: { show: true,
						barWidth: bar_width,
						align: "centered"
				    }
				}
				 ],
			    {   xaxis: {
				    mode: "time",
				    timeformat: x_format,
				    ticks :6,
					min : min_graph,
					max : max_graph
				  },
				  yaxis: {
				  max:max_data,
				  minTickSize: 1,
				  tickDecimals:0
				  },selection: { mode: "y" },
				 grid: { hoverable: true,clickable: true}
				  });

	}
 $(\'#refills_count\').click();
 
   function showTooltip(x, y, contents) {
        $(\'<div id="tooltip">\' + contents + \'</div>\').css( {
            position: \'absolute\',
            display: \'none\',
            top: y + 5,
            left: x + 5,
            border: \'1px solid #fdd\',
            padding: \'2px\',
            \'background-color\': \'#fee\',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#refills_graph").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;
                    
                    $("#tooltip").remove();
		    if(format=="money"){
                    	 var y = item.datapoint[1].toFixed(2);
                    	 showTooltip(item.pageX, item.pageY, y+" <?php echo $A2B->config["global"]["base_currency"];?>");
                    }else{
                    	var y = item.datapoint[1].toFixed(0);
                    	showTooltip(item.pageX, item.pageY, y);
                    }
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
    });

    
  
  
});
  
</script>';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ../logout.php");
    }

?>