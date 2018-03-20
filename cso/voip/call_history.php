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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open detail Customer");
    
	global $conn;
    global $conn_voip;
	$id_customer	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";


/*
if(isset($_POST["search"])){
    $customer   		= $view_id;
    $fromstatsday_sday		= isset($_POST["fromstatsday_sday"]) ? trim(strip_tags($_POST["fromstatsday_sday"])) : "";
    $fromstatsmonth_sday	= isset($_POST["fromstatsmonth_sday"]) ? trim(strip_tags($_POST["fromstatsmonth_sday"])) : "";
    $tostatsday_sday		= isset($_POST["tostatsday_sday"]) ? trim(strip_tags($_POST["tostatsday_sday"])) : "";
    $tostatsmonth_sday		= isset($_POST["tostatsmonth_sday"]) ? trim(strip_tags($_POST["tostatsmonth_sday"])) : "";
    $phonenumber		= isset($_POST["phonenumber"]) ? trim(strip_tags($_POST["phonenumber"])) : "";
    
    
    if(isset($_POST["fromday"])){
	    $sql_fromday = "AND `starttime` >= '$fromstatsmonth_sday-$fromstatsday_sday'";
	    $summary_fromday = $fromstatsmonth_sday.'-'.$fromstatsday_sday;
    }else{
	    $sql_fromday = "";
	    $summary_fromday = '';
    }
    if($phonenumber != ''){
	    $sql_phonenumber = "AND `calledstation` LIKE '%$phonenumber%'";
    }else{
	    $sql_phonenumber = "";
    }
    
    if(isset($_POST["today"])){
	    $sql_today = "AND `starttime` <= '$tostatsmonth_sday-$tostatsday_sday 24:00:00' ";
	    $summary_today = $tostatsmonth_sday.'-'.$tostatsday_sday;
    }else{
	    $sql_today = "";
	    $summary_today = '';
    }
    
    $call_type2	 = '';
    $call_type2	 .= ($_POST["choose_calltype"]=="-1") ? "" : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="0") ? "AND `sipiax` = '0' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="1") ? "AND `sipiax` = '1' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="2") ? "AND `sipiax` = '2' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="3") ? "AND `sipiax` = '3' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="4") ? "AND `sipiax` = '4' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="5") ? "AND `sipiax` = '5' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="6") ? "AND `sipiax` = '6' " : '';
    $call_type2	 .= ($_POST["choose_calltype"]=="7") ? "AND `sipiax` = '7' " : '';
		    
    $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `card_id` = '$customer'
		    $sql_phonenumber
		    $sql_fromday
		    $sql_today
		    $call_type2
                    AND starttime ORDER BY t1.starttime DESC LIMIT 0,20;";
		    
    $sql_timetotal = "SELECT sum(t1.sessiontime) AS total_time ,sum(t1.sessionbill) AS total_bill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `card_id` = '$customer'
		    $sql_phonenumber
		    $sql_fromday
		    $sql_today
		    $call_type2
                    AND starttime ORDER BY t1.starttime DESC LIMIT 0,20;";
//echo $sql_timetotal;
enableLog($loggedin["id_user"], $loggedin["username"], "", "Search call history = $sql_callhistory");
    $sql_call = mysql_query($sql_callhistory, $conn_voip);
    $sql_totaltime = mysql_query($sql_timetotal, $conn_voip);
    $total_callhistory   = mysql_num_rows($sql_call);
    //$row_callhistory = mysql_fetch_array(mysql_query($sql_callhistory));
        

}else{*/
   
    $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `card_id` = '".$id_customer."'
					
                    AND starttime ORDER BY t1.starttime DESC LIMIT 0,20;";
//echo $sql_callhistory;
   $sql_call = mysql_query($sql_callhistory, $conn_voip);

    //$row_callhistory = mysql_fetch_array(mysql_query($sql_callhistory));
//}

 
   
            
    $content ='<!-- Main content -->
                <section class="content">
				<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                    
                                </div>
                                <div class="box-body">

				
	<br />
	<table width="100%" id="callhistory" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
                <thead><tr>
                  <th width="20">#</th>
                  <th >Date</th>
                  <th >CallerID</th>
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
		
		while ($row_callhistory = mysql_fetch_array($sql_call)){
		    $sql_country = mysql_query("SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '".$row_callhistory["destination"]."';");
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
		    $sql_ratecard = mysql_query("SELECT * FROM  `cc_tariffplan` WHERE  `id` =  '$row_callhistory[id_tariffplan]'");
		    $row_ratecard = mysql_fetch_array($sql_ratecard);
                $content .='
                <tr bgcolor="#F2F8FF" onmouseover="bgColor=\'#C4FFD7\'" onmouseout="bgColor=\'#F2F8FF\'"> 
                    <td align="" class="tableBody">'.$no.'</td>
                    <td valign="top" align="center" class="tableBody">'.date("d-m-Y H:i:s", strtotime($row_callhistory["starttime"])).'</td>
                    <td valign="top" align="center" class="tableBody">'.$row_callhistory["src"].'</td>
                    <td valign="top" align="center" class="tableBody">'.$row_callhistory["calledstation"].'</td>
                    <td valign="top" align="center" class="tableBody">'.$destination.'</td>
                    <td valign="top" align="center" class="tableBody">'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
                    <td valign="top" align="center" class="tableBody">'.$tc.'</td>
				    <td valign="top" align="center" class="tableBody">'.$row_ratecard["tariffname"].'</td>
                    <td valign="top" align="center" class="tableBody">'.$calltype.'</td>
                    <td valign="top" align="center" class="tableBody">'.number_format($row_callhistory["sessionbill"], 2, ',', '.').' IDR</td>
                </tr>
                ';
		$no++;
		}
		
                $content .='
		
                </tbody></table>
		
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
    ';

    $title	= 'Call History';
    $submenu	= "Call History";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
		header("location: ".URL_CSO."logout.php");
    }
	
?>