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

    $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0
                    AND starttime ORDER BY t1.starttime DESC";
//echo $sql_callhistory;
   $sql_call = mysql_query($sql_callhistory, $conn_voip);


 
   
            
    $content ='<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Report VOIP
                        <small></small>
                    </h1>
                    
                </section><!-- Main content -->
                <section class="content">
				<div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Billing Voip Bulan '.date("m, Y").'</h3>                                    
                                </div>
                                <div class="box-body">
	<table width="100%" class="table table-bordered table-hover">
                <thead><tr>
                  <th>#</th>
                  <th>Customer Number</th>
                  <th>Nama</th>
                  <th>No. Telp</th>
                  <th>Total Tagihan(a2billing)</th>
		  <th>Total Tagihan(indosat)</th>
		  <th>Action</th>
                </tr>
		</thead>
		<tbody>';
		
		$no = 1;
		//$total = 0;
$sql_all_user_software = "SELECT `tbCustomer`.`cKode`, `tbCustomer`.`cNama`, `gxLogin`.`id_voip`
		FROM `tbCustomer`, `gxLogin`
		WHERE `tbCustomer`.`cKode` = `gxLogin`.`customer_number`
		AND `tbCustomer`.`cNonAktiv` = '0';";
$sql_all_user = "SELECT * FROM `cc_card` ORDER BY `useralias` ASC;";
		//echo $sql_all_user;
$query_all_user = mysql_query($sql_all_user, $conn_voip);
$grand_total = 0;

		while ($row_user = mysql_fetch_array($query_all_user)){
		    
		    
		    //$sql_cust_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` = '".$row_user["id_voip"]."'", $conn_voip);
		    //$row_cust_voip = mysql_fetch_array($sql_cust_voip);
		    //$card_id = $row_cust_voip["id"];
		    $card_id = $row_user["id"];
		    //echo $card_id."<br>";
		    
		    $sql_total = "SELECT SUM(`sessionbill`) AS `total`
                    FROM `cc_call`
                    WHERE `src` != 0
		    AND `card_id` = '".$card_id."'
                    AND `starttime` LIKE '%".date("Y-10")."%';";
		    //echo $sql_total."<br>";
		    $query_total = mysql_query($sql_total, $conn_voip);
		    $row_total	= mysql_fetch_array($query_total);
		    $total = $row_total["total"];
		    //<td>'.$row_user["cNama"].'</td>
		    //<td>'.$row_user["id_voip"].'</td>
		    $content .='
			<tr> 
			    <td>'.$no.'</td>
			    <td></td>
			    <td>'.$row_user["firstname"].' '.$row_user["lastname"].'</td>
			    <td>'.$row_user["useralias"].'</td>
			    <td class="text-right">'.Rupiah(Bulatdua($total)).'</td>
			    <td>detail</td>
			</tr>
			';
			
			//<td>'.$row_user["cKode"].'</td>
		    $grand_total += $total;
		    $no++;
		}
		
                $content .='
		
                </tbody>
		<tfooter>
		    <tr>
			<td colspan="4" class="text-right"><b>Grand Total</b></td>
			<td class="text-right">'.Rupiah(Bulatdua($grand_total)).'</td>
			<td>&nbsp;</td>
		    </tr>
		</tfooter>
		</table>
		
		
		';
		
		if(isset($_POST["search"])){
		    $row_toootal = mysql_fetch_array($sql_totaltime);
		    $content .='
		    <center>
		    <table border="0" cellspacing="0" cellpadding="0" width="80%"><tbody><tr><td align="left" height="30">
				   <table cellspacing="0" cellpadding="1" bgcolor="#000000" width="50%"><tbody><tr><td>
					   <table cellspacing="0" cellpadding="0" width="100%">
						   <tbody><tr><td class="callhistory_td1" align="left">SUMMARY</td></tr>
					   </tbody></table>
				   </td></tr></tbody></table>
		    </td></tr></tbody></table>
		   
		   <!-- FIN TITLE GLOBAL MINUTES //-->
		   
		   <table border="0" cellspacing="0" cellpadding="0" width="80%">
		   <tbody><tr><td bgcolor="#000000">			
			   <table border="1" cellspacing="1" cellpadding="2" width="100%">
			   <tbody><tr>
				   <td align="center" class="callhistory_td2"></td>
			   <td class="callhistory_td3" align="center" colspan="5">CALLING CARD MINUTES</td>
		       </tr>
			   <tr>
				   <td align="center" class="callhistory_td3">DATE</td>
			   <td align="center" class="callhistory_td2">DURATION</td>
				   <td align="center" class="callhistory_td2">GRAPHIC</td>
				   <td align="center" class="callhistory_td2">CALLS</td>
				   <td align="center" class="callhistory_td2"><acronym title="AVERAGE LENGTH OF CALL">ALOC</acronym></td>
				   <td align="center" class="callhistory_td2">TOTAL COST</td>
		   
				   <!-- LOOP -->
						   </tr><tr>
					   <td align="right" class="sidenav" nowrap="nowrap"><font class="callhistory_td5">'.$summary_fromday.' - '.$summary_today.' </font></td>
					   <td bgcolor="#F2F8FF" align="right" nowrap="nowrap" class="fontstyle_001">'. gmdate("H:i:s", $row_toootal['total_time']).'</td>
				   <td bgcolor="#F2F8FF" align="left" nowrap="nowrap" width="260">
					   <table cellspacing="0" cellpadding="0"><tbody><tr>
						   <td bgcolor="#e22424"><img src="./templates/default/images/spacer.gif" width="200" height="6"></td>
					   </tr></tbody></table>
				   </td>
				   <td bgcolor="#F2F8FF" align="right" nowrap="nowrap" class="fontstyle_001">'.$total_callhistory.'</td>
				   <td bgcolor="#F2F8FF" align="right" nowrap="nowrap" class="fontstyle_001">00:17 </td>
					   <td bgcolor="#F2F8FF" align="right" nowrap="nowrap" class="fontstyle_001">'.$row_toootal['total_bill'].' IDR</td>
						   
			   </tr>
		   
			   <!-- TOTAL -->
			   <tr class="callhistory_td2">
				   <td align="right" nowrap="nowrap" class="callhistory_td4">TOTAL</td>
				   <td align="center" nowrap="nowrap" colspan="2" class="callhistory_td4">'. gmdate("H:i:s", $row_toootal['total_time']).'</td>
				   <td align="center" nowrap="nowrap" class="callhistory_td4">'.$total_callhistory.'</td>
				   <td align="center" nowrap="nowrap" class="callhistory_td4">00:17</td>
				   <td align="center" nowrap="nowrap" class="callhistory_td4">'.$row_toootal['total_bill'].' IDR</td>
			   </tr>
			   
			   </tbody></table>
			     
		   </td></tr></tbody></table>
		   
		   </center><br />
		   <br />
		    ';
		}else{
		    $content .='';
		}
		
		$content .='
		
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