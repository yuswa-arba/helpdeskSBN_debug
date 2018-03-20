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
enableLog("", $loggedin["username"], $loggedin["username"], "Open Report Voip");
global $conn;
global $conn_voip;


$sql_history = "SELECT username, credit, lastname, firstname, address, city, state, country, zipcode, phone, email, fax, lastuse, activated, status, " .
"freetimetocall, label, packagetype, billingtype, startday, id_cc_package_offer, cc_card.id, currency,cc_card.useralias,UNIX_TIMESTAMP(cc_card.creationdate) creationdate  FROM cc_card " .
"LEFT JOIN cc_tariffgroup ON cc_tariffgroup.id=cc_card.tariff LEFT JOIN cc_package_offer ON cc_package_offer.id=cc_tariffgroup.id_cc_package_offer " .
"LEFT JOIN cc_card_group ON cc_card_group.id=cc_card.id_group;";

$row_home = mysql_fetch_array(mysql_query($sql_history, $conn_voip));


    $card_id = isset($_GET["id"]) ? mysql_real_escape_string($_GET["id"]) : "";
    $m = isset($_GET["m"]) ? mysql_real_escape_string($_GET["m"]) : "";
    
    $sql_voip = "SELECT * FROM `cc_card` WHERE `id` = '".$card_id."' LIMIT 0,1;";
    $query_voip = mysql_query($sql_voip, $conn_voip);
    $row_voip = mysql_fetch_array($query_voip);
    //echo $sql_voip;
    
    $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0
		    AND `card_id` = '".$card_id."'
		    AND `starttime` LIKE '%".$m."%'
                    AND starttime ORDER BY t1.starttime DESC";
//echo $sql_callhistory;
   $sql_call = mysql_query($sql_callhistory, $conn_voip);

    //$row_callhistory = mysql_fetch_array(mysql_query($sql_callhistory));
    
    $sql_customer = "SELECT * FROM `gxLogin` WHERE `id_voip` = '".$row_voip["useralias"]."' LIMIT 0,1;";
    $query_customer = mysql_query($sql_customer, $conn);
    $row_customer = mysql_fetch_array($query_customer);
//echo $sql_customer;
 
   
            
    $content ='<!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">
		
		'.detail_customer($row_customer["customer_number"]).'
				<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">History call</h3>
                                    
                                </div>
                                <div class="box-body">
				
				<table width="100%" id="callhistory" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
                <thead><tr>
                  <th width="20">#</th>
                  <th >Date</th>
                  
                  <th >PhoneNumber</th>
                  <th >Destination</th>
		  <th >Duration</th>
                  <th >TC</th>
		  <th >Rate Card</th>
                  <th >CallType</th>
                  <th >Cost</th>
                </tr>
		</thead>
		<tbody>';
		
		$no = 1;
		$total = 0;
		
		while ($row_callhistory = mysql_fetch_array($sql_call)){
		    $sql_country = mysql_query("SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '$row_callhistory[destination]'", $conn_voip);
		    $row_country = mysql_fetch_array($sql_country);
		    
		    $calltype	 = '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="0") ? 'STANDARD' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="1") ? 'SIP/IAX' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="2") ? 'DIDCALL' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="3") ? 'DID_VOIP' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="4") ? 'CALLBACK' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="5") ? 'PREDICT' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="6") ? 'AUTO DIALER' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="7") ? 'DID-ALEG' : '';
		    
		    $tc  ='';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="1") ? 'ANSWER' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="2") ? '2' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="3") ? '3' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="4") ? '4' : '';
		    
		    if($row_callhistory["destination"] == "628"){
			$destination = "Indonesian Mobile";
		    }else{
			$destination = $row_country["countryname"];
		    }
		    
		    $sql_ratecard = mysql_query("SELECT * FROM  `cc_tariffplan` WHERE  `id` =  '$row_callhistory[id_tariffplan]'", $conn_voip);
		    $row_ratecard = mysql_fetch_array($sql_ratecard);
		    $content .='
			<tr bgcolor="#F2F8FF" onmouseover="bgColor=\'#C4FFD7\'" onmouseout="bgColor=\'#F2F8FF\'"> 
			    <td align="" class="tableBody">'.$no.'</td>
			    <td valign="top" align="center" class="tableBody">'.$row_callhistory["starttime"].'</td>
			    
			    <td valign="top" align="center" class="tableBody">'.$row_callhistory["calledstation"].'</td>
			    <td valign="top" align="center" class="tableBody">'.$destination.'</td>
			    <td valign="top" align="center" class="tableBody">'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
			    <td valign="top" align="center" class="tableBody">'.$tc.'</td>
			    <td valign="top" align="center" class="tableBody">'.$row_ratecard["tariffname"].'</td>
			    <td valign="top" align="center" class="tableBody">'.$calltype.'</td>
			    <td valign="top" align="center" class="tableBody">'.$row_callhistory["sessionbill"].' IDR</td>
			</tr>
			';
		    $total = $total + $row_callhistory["sessionbill"];
		    $no++;
		}
		
                $content .='
		
                </tbody></table>
		
		<div class="">
		    <p><b>Total: Rp '.$total.' <b></p>
		</div>
		
                                </div><!-- /.box-body -->
                            </div>
                    
                    <!-- Main row -->
                    

                </section><!-- /.content -->
            ';

$plugins = '

<style>
.callhistory_td1 {
background-color: #600101;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td2 {
background-color: #600101;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td3 {
background-color: #b72222;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td4 {
background-color: #b72222;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td5 {
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
</style>
	
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                
                $(\'#callhistory\').dataTable({
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

    $title	= 'Report VOIP';
    $submenu	= "report_voip";
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