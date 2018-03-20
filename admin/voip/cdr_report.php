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
enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List cdr Report");
global $conn;
global $conn_voip;
global $conn_voip_cdr;


	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}

if(isset($_POST["search"])){
    //$customer   		= $view_id;
    $fromstatsday_sday		= isset($_POST["fromstatsday_sday"]) ? trim(strip_tags($_POST["fromstatsday_sday"])) : "";
    $fromstatsmonth_sday	= isset($_POST["fromstatsmonth_sday"]) ? trim(strip_tags($_POST["fromstatsmonth_sday"])) : "";
    $tostatsday_sday		= isset($_POST["tostatsday_sday"]) ? trim(strip_tags($_POST["tostatsday_sday"])) : "";
    $tostatsmonth_sday		= isset($_POST["tostatsmonth_sday"]) ? trim(strip_tags($_POST["tostatsmonth_sday"])) : "";
    
    if(isset($_POST["fromday"])){
	    $sql_fromday = "AND t1.starttime >= '$fromstatsmonth_sday-$fromstatsday_sday'";
	    $summary_fromday = $fromstatsmonth_sday.'-'.$fromstatsday_sday;
    }else{
	    $sql_fromday = "";
	    $summary_fromday = '';
    }
    
    if(isset($_POST["today"])){
	    $sql_today = "AND t1.starttime <= '$tostatsmonth_sday-$tostatsday_sday 24:00:00' ";
	    $summary_today = $tostatsmonth_sday.'-'.$tostatsday_sday;
    }else{
	    $sql_today = "";
	    $summary_today = '';
    }
    
    if(isset($_POST["today"]) && isset($_POST["fromday"])){
	$date	= $summary_fromday.' - '.$summary_today;
    }elseif(isset($_POST["fromday"])){
	$date	= '>='.$summary_fromday;
    }elseif(isset($_POST["today"])){
	$date	= '<='.$summary_today;
    }else{
	$date	= '';
    }
    $sql_cdrs = "SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime != '' $sql_fromday $sql_today ORDER BY t1.starttime DESC
						  LIMIT $start, $perhalaman;";
	$sql_total_cdrs = "SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime != '' $sql_fromday $sql_today ORDER BY t1.starttime DESC;";
		    
    $sql_timetotal = "SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          sum(t4.buyrate) AS buyrate, sum(t4.rateinitial) AS sellrate, sum(t1.sessiontime) AS total_time, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, sum(t1.sessionbill) AS total_bill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime != ''$sql_fromday $sql_today ORDER BY t1.starttime DESC";
	
	$sql_total_data	= mysql_num_rows(mysql_query($sql_total_cdrs, $conn_voip));
    $hal		= "?";
	
 //echo $sql_timetotal;
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Search cdr report = $sql_cdrs");
    $sql_cdr = mysql_query($sql_cdrs, $conn_voip);
    $sql_totaltime = mysql_query($sql_timetotal, $conn_voip);
    $total_callhistory   = mysql_num_rows($sql_cdr);
    //$row_callhistory = mysql_fetch_array(mysql_query($sql_callhistory));

}else{
    $date_now   = gmdate("Y-m");
    $sql_cdr    = mysql_query("SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime LIKE '$date_now%' ORDER BY t1.starttime DESC
                          LIMIT $start, $perhalaman;", $conn_voip);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime LIKE '$date_now%' ORDER BY t1.starttime DESC;", $conn_voip));
    $hal		= "?";
    
    
}
            
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
				
				    <hr>
				
				    <div class="box-header">
                                    <h3 class="box-title">List CDR Report</h3>
                                </div><!-- /.box-header -->
				
				
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
              $content .='<table class="table table-bordered table-striped" style="width: 100%;" align="center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>CallerID</th>
                                                <th>DNID</th>
                                                <th>Phone Number</th>
                                                <th>Destination</th>
                                                <th>Buy Rate</th>
                                                <th>Sell Rate</th>
                                                <th>Duration</th>
                                                <th>Account</th>
                                                <th>Trunk</th>
                                                <th>TC</th>
                                                <th>CallType</th>
                                                <th>Buy</th>
                                                <th>Sell</th>
                                                <th>Margin</th>
                                                <th>Markup</th>
                                            </tr>
                                        </thead>
                                        <tbody>';


$no = $start + 1;
while ($row_cdr = mysql_fetch_array($sql_cdr)){
    $sql_country = mysql_query("SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '$row_cdr[dest]'", $conn_voip);
    $row_country = mysql_fetch_array($sql_country);
    
    $calltype	 = '';
    $calltype	 .= ($row_cdr["sipiax"]=="0") ? 'STANDARD' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="1") ? 'SIP/IAX' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="2") ? 'DIDCALL' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="3") ? 'DID_VOIP' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="4") ? 'CALLBACK' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="5") ? 'PREDICT' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="6") ? 'AUTO DIALER' : '';
    $calltype	 .= ($row_cdr["sipiax"]=="7") ? 'DID-ALEG' : '';
    
    $tc  ='';
    $tc	 .= ($row_cdr["terminatecauseid"]=="1") ? 'ANSWER' : '';
    $tc	 .= ($row_cdr["terminatecauseid"]=="2") ? '2' : '';
    $tc	 .= ($row_cdr["terminatecauseid"]=="3") ? '3' : '';
    $tc	 .= ($row_cdr["terminatecauseid"]=="4") ? '4' : '';
    
    if($row_cdr["dest"] == "628"){
	$destination = "Indonesian Mobile";
    }else{
	$destination = $row_country["countryname"];
    }
    
    $sql_username = mysql_query("SELECT * FROM  `cc_card` WHERE  `id` =  '$row_cdr[card_id]'", $conn_voip);
    $row_username = mysql_fetch_array($sql_username);
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_cdr["starttime"].'</td>
		    <td>'.$row_cdr["src"].'</td>
		    <td>'.$row_cdr["dnid"].'</td>
		    <td>'.$row_cdr["calledstation"].'</td>
                    <td>'.$destination.'</td>
                    <td>'.$row_cdr["buyrate"].' IDR</td>
		    <td>'.$row_cdr["rateinitial"].' IDR</td>
		    <td>'.gmdate("H:i:s", $row_cdr["sessiontime"]).'</td>
		    <td>'.$row_username["username"].'</td>
		    <td>'.$row_cdr["trunkcode"].'</td>
		    <td>'.$tc.'</td>
		    <td>'.$calltype.'</td>
		    <td>'.$row_cdr["buycost"].' IDR</td>
		    <td>'.$row_cdr["sessionbill"].' IDR</td>
		    <td>'.Persen($row_cdr["margin"]).'</td>
		    <td>'.Persen($row_cdr["markup"]).'</td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>';
		
		if(isset($_POST["search"])){
		    $row_toootal = mysql_fetch_array($sql_totaltime);
		    $content .='
		    <center>
		    <table border="0" cellspacing="0" cellpadding="0" width="70%">
	<tbody>
		<tr>
			<td bgcolor="#000000">
			<table border="1" cellspacing="1" cellpadding="2" width="100%">
				<tbody>
					<tr>
						<td align="center" class="bgcolor_019"></td>
						<td class="bgcolor_020" align="center" colspan="10"><font class="fontstyle_003">TRAFFIC SUMMARY</font></td>
					</tr>
					<tr class="bgcolor_019">
						<td align="center" class="bgcolor_020"><font class="fontstyle_003">DATE</font></td>
						<td align="center"><font class="fontstyle_003"><acronym title="DURATION">DUR</acronym></font></td>
						<td align="center"><font class="fontstyle_003">CALLS</font></td>
						<td align="center"><font class="fontstyle_003">SELL</font></td>
						<td align="center"><font class="fontstyle_003">BUY</font></td>

						<!-- LOOP -->
			</tr>
					<tr>
						<td align="right" class="sidenav" nowrap="nowrap"><font class="fontstyle_003">'.$date.'</font></td>
						<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">'.gmdate("H:i:s", $row_toootal["total_time"]).'</font></td>
						
						<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">'.$total_callhistory.'</font></td>
						<!-- SELL -->
						<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">'.$row_toootal["sellrate"].' IDR						</font></td>
						<!-- BUY -->
						<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">'.$row_toootal["buyrate"].' IDR						</font></td>
							
				</tr>
					<!-- END DETAIL -->

					<!-- END LOOP -->

					<!-- TOTAL -->
					<tr bgcolor="bgcolor_019">
						<td align="right" nowrap="nowrap"><font class="fontstyle_003">TOTAL</font></td>
						<td align="center" nowrap="nowrap"><font class="fontstyle_003">'.gmdate("H:i:s", $row_toootal["total_time"]).'</font></td>
						<td align="center" nowrap="nowrap"><font class="fontstyle_003">'.$total_callhistory.'</font></td>
						<td align="center" nowrap="nowrap"><font class="fontstyle_003">'.$row_toootal["sellrate"].' IDR</font></td>
						<td align="center" nowrap="nowrap"><font class="fontstyle_003">'.$row_toootal["buyrate"].' IDR	</font></td>
						
					</tr>
					<!-- END TOTAL -->

				</tbody>
			</table>
			<!-- END ARRAY GLOBAL //--></td>
		</tr>
	</tbody>
</table>
		   
		   </center><br />
		   <br />
		    ';
		}else{
		    $content .='';
		}
		
		$content .='
				    
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								</div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            ';

$plugins = '

<style>
.bgcolor_019{
background-color: #600101;
}
.bgcolor_020{
background-color: #b72222;
}
.fontstyle_003 {
font-weight: bold;
font-size: 10px;
color: #ffffff;
font-family: Verdana;
}
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
	
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
    ';


    $title	= 'CDR Reports';
    $submenu	= "voip_cdrreport";
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