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
    
    global $conn_helpdesk;
    
    $stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'stats.php\'+options[selectedIndex].value;">
	<option value="">- Select -</option>
	<option value="">This Week</option>
	<option value="?b='.date("m").'&t='.date("Y").'">This Month</option>
        
</select>
</form>
                <div class="block">
                    <div id="chart1">';
                    
//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

//Statistik Complaint
/*$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
$stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
$stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
$stat_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';"));
$stat_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';"));
$stat_spktech = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';"));
$stat_spkmkt = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';"));
*/

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");


$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';
            
    $content =' <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Log Refill</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Log Refill</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';


$content .= '
	<center>
		<b>Define criteria to make a precise search</b>
		<table class="searchhandler_table1">
		<FORM METHOD=POST ACTION="/a2billing/admin/Public/A2B_entity_logrefill.php?s=&t=&order=&sens=&current_page=">
		<INPUT TYPE="hidden" NAME="posted_search" value="1">
		<INPUT TYPE="hidden" NAME="current_page" value="0">
		
		
		<tr>
        		<td align="left" class="bgcolor_002">
					&nbsp;&nbsp;<font class="fontstyle_003">DATE</font>
				</td>
      			<td align="left" class="bgcolor_003">
					<table  border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr><td class="fontstyle_searchoptions">
	  				<input type="checkbox" name="fromday" value="true" > From :					<select name="fromstatsday_sday" class="form_input_select">
						<option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>					</select>
				 	<select name="fromstatsmonth_sday" class="form_input_select">
					<OPTION value="2014-09" > September-2014 </option><OPTION value="2014-08" > August-2014 </option><OPTION value="2014-07" > July-2014 </option><OPTION value="2014-06" > June-2014 </option><OPTION value="2014-05" > May-2014 </option><OPTION value="2014-04" > April-2014 </option><OPTION value="2014-03" > March-2014 </option><OPTION value="2014-02" > February-2014 </option><OPTION value="2014-01" > January-2014 </option><OPTION value="2013-12" > December-2013 </option><OPTION value="2013-11" > November-2013 </option><OPTION value="2013-10" > October-2013 </option><OPTION value="2013-09" > September-2013 </option><OPTION value="2013-08" > August-2013 </option><OPTION value="2013-07" > July-2013 </option><OPTION value="2013-06" > June-2013 </option><OPTION value="2013-05" > May-2013 </option><OPTION value="2013-04" > April-2013 </option><OPTION value="2013-03" > March-2013 </option><OPTION value="2013-02" > February-2013 </option><OPTION value="2013-01" > January-2013 </option><OPTION value="2012-12" > December-2012 </option><OPTION value="2012-11" > November-2012 </option><OPTION value="2012-10" > October-2012 </option><OPTION value="2012-09" > September-2012 </option><OPTION value="2012-08" > August-2012 </option><OPTION value="2012-07" > July-2012 </option><OPTION value="2012-06" > June-2012 </option><OPTION value="2012-05" > May-2012 </option><OPTION value="2012-04" > April-2012 </option><OPTION value="2012-03" > March-2012 </option><OPTION value="2012-02" > February-2012 </option><OPTION value="2012-01" > January-2012 </option><OPTION value="2011-12" > December-2011 </option><OPTION value="2011-11" > November-2011 </option><OPTION value="2011-10" > October-2011 </option><OPTION value="2011-09" > September-2011 </option><OPTION value="2011-08" > August-2011 </option><OPTION value="2011-07" > July-2011 </option><OPTION value="2011-06" > June-2011 </option><OPTION value="2011-05" > May-2011 </option><OPTION value="2011-04" > April-2011 </option><OPTION value="2011-03" > March-2011 </option><OPTION value="2011-02" > February-2011 </option><OPTION value="2011-01" > January-2011 </option><OPTION value="2010-12" > December-2010 </option><OPTION value="2010-11" > November-2010 </option><OPTION value="2010-10" > October-2010 </option><OPTION value="2010-09" > September-2010 </option><OPTION value="2010-08" > August-2010 </option><OPTION value="2010-07" > July-2010 </option><OPTION value="2010-06" > June-2010 </option><OPTION value="2010-05" > May-2010 </option><OPTION value="2010-04" > April-2010 </option><OPTION value="2010-03" > March-2010 </option><OPTION value="2010-02" > February-2010 </option><OPTION value="2010-01" > January-2010 </option><OPTION value="2009-12" > December-2009 </option><OPTION value="2009-11" > November-2009 </option><OPTION value="2009-10" > October-2009 </option><OPTION value="2009-09" > September-2009 </option><OPTION value="2009-08" > August-2009 </option><OPTION value="2009-07" > July-2009 </option><OPTION value="2009-06" > June-2009 </option><OPTION value="2009-05" > May-2009 </option><OPTION value="2009-04" > April-2009 </option><OPTION value="2009-03" > March-2009 </option><OPTION value="2009-02" > February-2009 </option><OPTION value="2009-01" > January-2009 </option><OPTION value="2008-12" > December-2008 </option><OPTION value="2008-11" > November-2008 </option><OPTION value="2008-10" > October-2008 </option><OPTION value="2008-09" > September-2008 </option><OPTION value="2008-08" > August-2008 </option><OPTION value="2008-07" > July-2008 </option><OPTION value="2008-06" > June-2008 </option><OPTION value="2008-05" > May-2008 </option><OPTION value="2008-04" > April-2008 </option><OPTION value="2008-03" > March-2008 </option><OPTION value="2008-02" > February-2008 </option><OPTION value="2008-01" > January-2008 </option><OPTION value="2007-12" > December-2007 </option><OPTION value="2007-11" > November-2007 </option><OPTION value="2007-10" > October-2007 </option><OPTION value="2007-09" > September-2007 </option><OPTION value="2007-08" > August-2007 </option><OPTION value="2007-07" > July-2007 </option><OPTION value="2007-06" > June-2007 </option><OPTION value="2007-05" > May-2007 </option><OPTION value="2007-04" > April-2007 </option><OPTION value="2007-03" > March-2007 </option><OPTION value="2007-02" > February-2007 </option><OPTION value="2007-01" > January-2007 </option><OPTION value="2006-12" > December-2006 </option><OPTION value="2006-11" > November-2006 </option><OPTION value="2006-10" > October-2006 </option><OPTION value="2006-09" > September-2006 </option><OPTION value="2006-08" > August-2006 </option><OPTION value="2006-07" > July-2006 </option><OPTION value="2006-06" > June-2006 </option><OPTION value="2006-05" > May-2006 </option><OPTION value="2006-04" > April-2006 </option><OPTION value="2006-03" > March-2006 </option><OPTION value="2006-02" > February-2006 </option><OPTION value="2006-01" > January-2006 </option><OPTION value="2005-12" > December-2005 </option><OPTION value="2005-11" > November-2005 </option><OPTION value="2005-10" > October-2005 </option><OPTION value="2005-09" > September-2005 </option><OPTION value="2005-08" > August-2005 </option><OPTION value="2005-07" > July-2005 </option><OPTION value="2005-06" > June-2005 </option><OPTION value="2005-05" > May-2005 </option><OPTION value="2005-04" > April-2005 </option><OPTION value="2005-03" > March-2005 </option><OPTION value="2005-02" > February-2005 </option><OPTION value="2005-01" > January-2005 </option><OPTION value="2004-12" > December-2004 </option><OPTION value="2004-11" > November-2004 </option><OPTION value="2004-10" > October-2004 </option><OPTION value="2004-09" > September-2004 </option><OPTION value="2004-08" > August-2004 </option><OPTION value="2004-07" > July-2004 </option><OPTION value="2004-06" > June-2004 </option><OPTION value="2004-05" > May-2004 </option><OPTION value="2004-04" > April-2004 </option><OPTION value="2004-03" > March-2004 </option><OPTION value="2004-02" > February-2004 </option><OPTION value="2004-01" > January-2004 </option>					</select>
					</td><td class="fontstyle_searchoptions">&nbsp;&nbsp;
					<input type="checkbox" name="today" value="true" >To :					<select name="tostatsday_sday" class="form_input_select">
					<option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>					</select>
				 	<select name="tostatsmonth_sday" class="form_input_select">
					<OPTION value="2014-09" > September-2014 </option><OPTION value="2014-08" > August-2014 </option><OPTION value="2014-07" > July-2014 </option><OPTION value="2014-06" > June-2014 </option><OPTION value="2014-05" > May-2014 </option><OPTION value="2014-04" > April-2014 </option><OPTION value="2014-03" > March-2014 </option><OPTION value="2014-02" > February-2014 </option><OPTION value="2014-01" > January-2014 </option><OPTION value="2013-12" > December-2013 </option><OPTION value="2013-11" > November-2013 </option><OPTION value="2013-10" > October-2013 </option><OPTION value="2013-09" > September-2013 </option><OPTION value="2013-08" > August-2013 </option><OPTION value="2013-07" > July-2013 </option><OPTION value="2013-06" > June-2013 </option><OPTION value="2013-05" > May-2013 </option><OPTION value="2013-04" > April-2013 </option><OPTION value="2013-03" > March-2013 </option><OPTION value="2013-02" > February-2013 </option><OPTION value="2013-01" > January-2013 </option><OPTION value="2012-12" > December-2012 </option><OPTION value="2012-11" > November-2012 </option><OPTION value="2012-10" > October-2012 </option><OPTION value="2012-09" > September-2012 </option><OPTION value="2012-08" > August-2012 </option><OPTION value="2012-07" > July-2012 </option><OPTION value="2012-06" > June-2012 </option><OPTION value="2012-05" > May-2012 </option><OPTION value="2012-04" > April-2012 </option><OPTION value="2012-03" > March-2012 </option><OPTION value="2012-02" > February-2012 </option><OPTION value="2012-01" > January-2012 </option><OPTION value="2011-12" > December-2011 </option><OPTION value="2011-11" > November-2011 </option><OPTION value="2011-10" > October-2011 </option><OPTION value="2011-09" > September-2011 </option><OPTION value="2011-08" > August-2011 </option><OPTION value="2011-07" > July-2011 </option><OPTION value="2011-06" > June-2011 </option><OPTION value="2011-05" > May-2011 </option><OPTION value="2011-04" > April-2011 </option><OPTION value="2011-03" > March-2011 </option><OPTION value="2011-02" > February-2011 </option><OPTION value="2011-01" > January-2011 </option><OPTION value="2010-12" > December-2010 </option><OPTION value="2010-11" > November-2010 </option><OPTION value="2010-10" > October-2010 </option><OPTION value="2010-09" > September-2010 </option><OPTION value="2010-08" > August-2010 </option><OPTION value="2010-07" > July-2010 </option><OPTION value="2010-06" > June-2010 </option><OPTION value="2010-05" > May-2010 </option><OPTION value="2010-04" > April-2010 </option><OPTION value="2010-03" > March-2010 </option><OPTION value="2010-02" > February-2010 </option><OPTION value="2010-01" > January-2010 </option><OPTION value="2009-12" > December-2009 </option><OPTION value="2009-11" > November-2009 </option><OPTION value="2009-10" > October-2009 </option><OPTION value="2009-09" > September-2009 </option><OPTION value="2009-08" > August-2009 </option><OPTION value="2009-07" > July-2009 </option><OPTION value="2009-06" > June-2009 </option><OPTION value="2009-05" > May-2009 </option><OPTION value="2009-04" > April-2009 </option><OPTION value="2009-03" > March-2009 </option><OPTION value="2009-02" > February-2009 </option><OPTION value="2009-01" > January-2009 </option><OPTION value="2008-12" > December-2008 </option><OPTION value="2008-11" > November-2008 </option><OPTION value="2008-10" > October-2008 </option><OPTION value="2008-09" > September-2008 </option><OPTION value="2008-08" > August-2008 </option><OPTION value="2008-07" > July-2008 </option><OPTION value="2008-06" > June-2008 </option><OPTION value="2008-05" > May-2008 </option><OPTION value="2008-04" > April-2008 </option><OPTION value="2008-03" > March-2008 </option><OPTION value="2008-02" > February-2008 </option><OPTION value="2008-01" > January-2008 </option><OPTION value="2007-12" > December-2007 </option><OPTION value="2007-11" > November-2007 </option><OPTION value="2007-10" > October-2007 </option><OPTION value="2007-09" > September-2007 </option><OPTION value="2007-08" > August-2007 </option><OPTION value="2007-07" > July-2007 </option><OPTION value="2007-06" > June-2007 </option><OPTION value="2007-05" > May-2007 </option><OPTION value="2007-04" > April-2007 </option><OPTION value="2007-03" > March-2007 </option><OPTION value="2007-02" > February-2007 </option><OPTION value="2007-01" > January-2007 </option><OPTION value="2006-12" > December-2006 </option><OPTION value="2006-11" > November-2006 </option><OPTION value="2006-10" > October-2006 </option><OPTION value="2006-09" > September-2006 </option><OPTION value="2006-08" > August-2006 </option><OPTION value="2006-07" > July-2006 </option><OPTION value="2006-06" > June-2006 </option><OPTION value="2006-05" > May-2006 </option><OPTION value="2006-04" > April-2006 </option><OPTION value="2006-03" > March-2006 </option><OPTION value="2006-02" > February-2006 </option><OPTION value="2006-01" > January-2006 </option><OPTION value="2005-12" > December-2005 </option><OPTION value="2005-11" > November-2005 </option><OPTION value="2005-10" > October-2005 </option><OPTION value="2005-09" > September-2005 </option><OPTION value="2005-08" > August-2005 </option><OPTION value="2005-07" > July-2005 </option><OPTION value="2005-06" > June-2005 </option><OPTION value="2005-05" > May-2005 </option><OPTION value="2005-04" > April-2005 </option><OPTION value="2005-03" > March-2005 </option><OPTION value="2005-02" > February-2005 </option><OPTION value="2005-01" > January-2005 </option><OPTION value="2004-12" > December-2004 </option><OPTION value="2004-11" > November-2004 </option><OPTION value="2004-10" > October-2004 </option><OPTION value="2004-09" > September-2004 </option><OPTION value="2004-08" > August-2004 </option><OPTION value="2004-07" > July-2004 </option><OPTION value="2004-06" > June-2004 </option><OPTION value="2004-05" > May-2004 </option><OPTION value="2004-04" > April-2004 </option><OPTION value="2004-03" > March-2004 </option><OPTION value="2004-02" > February-2004 </option><OPTION value="2004-01" > January-2004 </option>					</select>
					</td></tr></table>
	  			</td>
    		</tr>
				
				
		
				
		
		<!-- compare with a value //-->
					<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;ACCOUNT NUMBER</font>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="username" value="" class="form_input_text"></td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="1" checked>Exact </td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="2" > Begins with</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="3" > Contains</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="usernametype" value="4" > Ends with</td>
				</tr></table></td>
			</tr>

						<tr>
				<td class="bgcolor_002" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;LASTNAME</font>
				</td>
				<td class="bgcolor_003" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="lastname" value="" class="form_input_text"></td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="1" checked>Exact </td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="2" > Begins with</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="3" > Contains</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="lastnametype" value="4" > Ends with</td>
				</tr></table></td>
			</tr>

						<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;FIRSTNAME</font>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="firstname" value="" class="form_input_text"></td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="1" checked>Exact </td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="2" > Begins with</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="3" > Contains</td>
				<td class="fontstyle_searchoptions" align="center" ><input type="radio" NAME="firstnametype" value="4" > Ends with</td>
				</tr></table></td>
			</tr>

						<!-- compare between 2 values //-->
									<tr>
        		<td class="bgcolor_004" align="left"> </td>
				<td class="bgcolor_005" align="center">
					<input type="image"  name="image16" align="top" border="0" src="../Public/templates/default/images/button-search.gif" />
						  			</td>
    		</tr>
		</tbody></table>
	</FORM>
</center>';


               
$content .= '	<table align="right"><tr align="right">
        <td align="right"> 
					<a href="A2B_entity_logrefill.php?form_action=ask-add&section=10"> Add Refill&nbsp;&nbsp;<img src="../Public/templates/default/images/time_add.png" border="0" title="Add Refill" alt="Add Refill"></a>
				&nbsp;
				  </td>
	 </tr></table>
<br>
    
    
	<br><br>
	<div align="center">
	<table width="80%" border="0" align="center">
		
		<tr>
			<td align="center">
				THERE IS NO REFILL CREATED!<br>
			</td>
		</tr>
	</table>
	</div>
	<br>';	       
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
    ';

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