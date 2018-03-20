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

global $conn;
global $conn_voip;
global $conn_voip_cdr;

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
	    
    $sql_cdrs = "SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          t4.buyrate, t4.rateinitial, t1.sessiontime, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, t1.sessionbill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime != '' $sql_fromday $sql_today ORDER BY t1.starttime DESC";
		    
    $sql_timetotal = "SELECT t1.starttime, t1.src, t1.dnid, t1.calledstation, t1.destination AS dest,
                          t4.buyrate, t4.rateinitial, sum(t1.sessiontime) AS total_time, t1.card_id, t3.trunkcode,
                          t1.terminatecauseid, t1.sipiax, t1.buycost, sum(t1.sessionbill) AS total_bill,
                          case when t1.sessionbill!=0 then ((t1.sessionbill-t1.buycost)/t1.sessionbill)*100 else NULL end as margin,case when t1.buycost!=0 then ((t1.sessionbill-t1.buycost)/t1.buycost)*100 else NULL end as markup
                          FROM cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN cc_ratecard t4 ON t1.id_ratecard = t4.id WHERE t1.starttime != ''$sql_fromday $sql_today ORDER BY t1.starttime DESC";
 //echo $sql_timetotal;
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
                          ", $conn_voip);
    
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
					<tbody><tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;
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
					</td></tr>
					</tbody></table>
	  			</td>
    		</tr>
		<tr>
        		<td align="left" class="bgcolor_002"> &nbsp;
					<font class="fontstyle_003">CalledNumber </font>
				</td>
      			<td align="left" class="bgcolor_003">
					<input name="callednumber" value="" type="text">
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
			<tbody>
			<tr>
				<td bgcolor="#000000">			
					<table border="0" cellspacing="1" cellpadding="2" width="100%">
						<tbody>
						<tr>	
							<td align="center" class="bgcolor_019"></td>
							<td class="bgcolor_020" align="center" colspan="4"><font class="fontstyle_003">ASTERISK MINUTES</font></td>
						</tr>
						<tr class="bgcolor_019">
							<td align="right" class="bgcolor_020"><font class="fontstyle_003">DATE</font></td>
							<td align="center"><font class="fontstyle_003">DURATION</font></td>
							<td align="center"><font class="fontstyle_003">GRAPHIC</font></td>
							<td align="center"><font class="fontstyle_003">CALLS</font></td>
							<td align="center"><font class="fontstyle_003"><acronym title="Average Connection Time">ACT</acronym> </font></td>

		<!-- LOOP -->
						</tr>
						<tr>
							<td align="right" class="sidenav" nowrap="nowrap"><font class="fontstyle_003">2014-10-08</font></td>
							<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">11:38 </font></td>
							<td bgcolor="#F2F8FF" align="left" nowrap="nowrap" width="260">
								<table cellspacing="0" cellpadding="0"><tbody><tr>
									<td bgcolor="#e22424"><img src="images/spacer.gif" width="200" height="6"></td>
								</tr></tbody></table>
							</td>
							<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">13</font></td>
							<td bgcolor="#F2F8FF" align="right" nowrap="nowrap"><font class="fontstyle_006">00:53 </font></td>
									
						</tr>
		<!-- END DETAIL -->		
	
		<!-- END LOOP -->

		<!-- TOTAL -->
						<tr class="bgcolor_019">
							<td align="right" nowrap="nowrap"><font class="fontstyle_003">TOTAL</font></td>
							<td align="center" nowrap="nowrap" colspan="2"><font class="fontstyle_003">11:38</font></td>
							<td align="center" nowrap="nowrap"><font class="fontstyle_003">13</font></td>
							<td align="center" nowrap="nowrap"><font class="fontstyle_003">00:53</font></td>                        
						</tr>
	<!-- END TOTAL -->

					</tbody></table>
	<!-- Fin Tableau Global //-->

				</td>
			</tr></tbody>
		</table>
		   
		   </center><br />
		   <br />
		    ';
		}else{
		    $content .='';
		}
		
		$content .='
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            ';

$plugins = '

<style>
.bgcolor_019 {
background-color: #600101;
}
.bgcolor_020 {
background-color: #b72222;
}
.fontstyle_003 {
font-weight: bold;
font-size: 10px;
color: #ffffff;
font-family: Verdana;
}
table {
font-family: Arial,Verdana;
font-size: 7px;
}
.fontstyle_006 {
font-size: 11px;
color: #333333;
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';


    $title	= 'CDR Reports';
    $submenu	= "voip_cdr";
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