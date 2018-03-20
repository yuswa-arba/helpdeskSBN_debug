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
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open call history");
	$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	include("../config/".$row_voip["voip_config"]);
	global $conn_voip;

$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$row_cust_voip = mysql_fetch_array($sql_cust_voip);
$sql_cust = mysql_query("SELECT * FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
$row_cust = mysql_fetch_array($sql_cust);

$view_username = $row_cust["username"];
$view_uipass = $row_cust["uipass"];
$view_id = $row_cust["id"];

$sql_history = "SELECT username, credit, lastname, firstname, address, city, state, country, zipcode, phone, email, fax, lastuse, activated, status, " .
"freetimetocall, label, packagetype, billingtype, startday, id_cc_package_offer, cc_card.id, currency,cc_card.useralias,UNIX_TIMESTAMP(cc_card.creationdate) creationdate  FROM cc_card " .
"LEFT JOIN cc_tariffgroup ON cc_tariffgroup.id=cc_card.tariff LEFT JOIN cc_package_offer ON cc_package_offer.id=cc_tariffgroup.id_cc_package_offer " .
"LEFT JOIN cc_card_group ON cc_card_group.id=cc_card.id_group WHERE username = '" . $view_username .
"' AND uipass = '" . $view_uipass . "'";

$row_home = mysql_fetch_array(mysql_query($sql_history, $conn_voip));

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
        

}else{
    $customer = $view_id;
   
    $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `card_id` = '$customer'
                    AND starttime ORDER BY t1.starttime DESC LIMIT 0,20;";
//echo $sql_callhistory;
   $sql_call = mysql_query($sql_callhistory, $conn_voip);

    //$row_callhistory = mysql_fetch_array(mysql_query($sql_callhistory));
}

 
   
            
    $content ='<!-- Main content -->
                <section class="content">
				<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">

				<form action="" method="post" name="form_callhistory" id="form_callhistory">
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="2" class="gwlines arborder">
			<tbody><tr>
        		<td align="left" class="bgcolor_002"> &nbsp;
					<font class="fontstyle_003">DATE</font>
				</td>
      			<td align="left" class="bgcolor_003">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tbody><tr><td class="fontstyle_searchoptions">
	  				<input type="checkbox" name="fromday" value=""> FROM :
					<select name="fromstatsday_sday" class="form_input_select">
					';
                                        $date_from = 01;
						for($f=$date_from;$f<=31; $f++){
							if($f==$date_from){
								$content .='<option value="'.sprintf('%02d', $f).'" selected="">'.sprintf('%02d', $f).'</option>';
							}else{
								$content .= '<option value="'.sprintf('%02d', $f).'">'.sprintf('%02d', $f).'</option>';
							}
						}
$content .='
					</select>
				 	<select name="fromstatsmonth_sday" class="form_input_select">
					';
                                        $fromstatsmonth_sday = date("Y-m");
                                       $year_actual = date("Y");
						for ($i=$year_actual;$i >= $year_actual-1;$i--) {		   
							$monthname = array( "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST",
                                                                           "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
							if ($year_actual==$i){
								$monthnumber = date("n")-1; // Month number without lead 0.
							}else{
								$monthnumber=11;
							}		   
							for ($j=$monthnumber;$j>=0;$j--){	
								$month_formated = sprintf("%02d",$j+1);
							   	if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
								$content.='<option value="'.$i.'-'.$month_formated.'" '.$selected.'>'.$monthname[$j].'-'.$i.'</option>';
							}
						}
                                        
$content.=' 
                                        </select>
					</td><td class="fontstyle_searchoptions">&nbsp;&nbsp;
					<input type="checkbox" name="today" value=""> TO :
					<select name="tostatsday_sday" class="form_input_select">
					';
                                        $date_to = 01;
						for($t=$date_to;$t<=31; $t++){
							if($t==date("d")){
								$content .='<option value="'.sprintf('%02d', $t).'" selected="">'.sprintf('%02d', $t).'</option>';
							}else{
								$content .= '<option value="'.sprintf('%02d', $t).'">'.sprintf('%02d', $t).'</option>';
							}
						}
$content .='
                                        
					</select>
				 	<select name="tostatsmonth_sday" class="form_input_select">';
                                        $fromstatsmonth_sday = date("Y-m");
                                       $year_actual = date("Y");
						for ($i=$year_actual;$i >= $year_actual-1;$i--) {		   
							$monthname = array( "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST",
                                                                           "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
							if ($year_actual==$i){
								$monthnumber = date("n")-1; // Month number without lead 0.
							}else{
								$monthnumber=11;
							}		   
							for ($j=$monthnumber;$j>=0;$j--){	
								$month_formated = sprintf("%02d",$j+1);
							   	if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
								$content.='<option value="'.$i.'-'.$month_formated.'" '.$selected.'>'.$monthname[$j].'-'.$i.'</option>';
							}
						}
                                        
$content.='                                        </select>
					</td></tr></tbody></table>
	  			</td>
    		</tr>
			<tr>
				<td align="left" class="bgcolor_004">
					<font class="fontstyle_003">&nbsp;&nbsp;PHONENUMBER</font>
				</td>
				<td align="left" class="bgcolor_005">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody><tr><td class="fontstyle_searchoptions"><input type="text" name="phonenumber" value="" class="form_input_text"></td>				
				</tr></tbody></table></td>
			</tr>		
			<!-- Select Calltype: -->
			<tr>
			  <td class="bgcolor_002" align="left"><font class="fontstyle_003">&nbsp;&nbsp;CALL TYPE</font></td>
			  <td class="bgcolor_003" align="center">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tbody><tr>
					<td class="fontstyle_searchoptions">
					<select name="choose_calltype" size="1" class="form_input_select">
						<option value="-1" selected="">ALL CALLS								</option>
						<option value="0">STANDARD</option>
						<option value="1">SIP/IAX</option>
						<option value="2">DIDCALL</option>
						<option value="3">DID_VOIP</option>
						<option value="4">CALLBACK</option>
						<option value="5">PREDICT</option>
						<option value="6">AUTO DIALER</option>
						<option value="7">DID-ALEG</option>
					</select>
					</td>
				</tr>				
				</tbody></table>
			  </td>
			  </tr>
	
			<!-- Select Option : to show just the Answered Calls or all calls, Result type, currencies... -
			<tr>
			  <td class="bgcolor_002" align="left"><font class="fontstyle_003">&nbsp;&nbsp;OPTIONS</font></td>
			  <td class="bgcolor_003" align="center">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody><tr>
					<td width="20%" class="fontstyle_searchoptions">
						SHOW :  						
				   </td>
				   <td width="80%" class="fontstyle_searchoptions">				   		
				 Answered Calls				  <input name="terminatecauseid" type="radio" value="ANSWER">
				  All Calls
				   <input name="terminatecauseid" type="radio" value="ALL" checked="">
					</td>
				</tr>
				<tr class="bgcolor_005">
					<td class="fontstyle_searchoptions">
						RESULT : 
				   </td>
				   <td class="fontstyle_searchoptions">
					Minutes<input type="radio" name="resulttype" value="min" checked=""> - Seconds <input type="radio" name="resulttype" value="sec">
					</td>
				</tr>
				<tr>
					<td class="fontstyle_searchoptions">
						CURRENCY :
					</td>
					<td class="fontstyle_searchoptions">
					<select name="choose_currency" size="1" class="form_input_select">
                                            <option value="IDR" selected="">Indonesian Rupiah (IDR) (1.00000)								</option>
                                            <option value="USD">U.S. Dollar (USD) (12018.08850)								</option>
															
													</select>
					</td>
				</tr>				
				</tbody></table>
			  </td>
			  </tr>-->
			<!-- Select Option : to show just the Answered Calls or all calls, Result type, currencies... -->
			
			<tr>
        		<td class="bgcolor_004" align="left"> </td>
				<td class="bgcolor_005" align="center">
					<input class="form_input_button" name="search" value=" Search " type="submit">
	  			</td>
    		</tr>
	</tbody></table>
	</form>
	<br />';
	
		if(isset($_POST["search"])){
	
		$content .='<center>
		    <h4>Number Of Calls : '.$total_callhistory.'</h4>
		    </center>';
		}else{
		    $content .='';
		}
              $content .='<table width="100%" id="callhistory" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
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
                    <td valign="top" align="center" class="tableBody">'.$row_callhistory["starttime"].'</td>
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
		
                </tbody></table>';
		
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
    ';

    $title	= 'Call History';
    $submenu	= "Call History";
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