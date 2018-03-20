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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;

$new_search = isset($_GET['search']) ? $_GET['search'] : '';
$id_ref = isset($_GET['id_ref']) ? $_GET['id_ref'] : '';
$del    = isset($_GET['del']) ? $_GET['del'] : '';



if($id_ref !== '' && $del=='true'){
   $sql_del = mysql_query("DELETE FROM `cc_vouchers` WHERE `id`='$id_ref'", $conn_voip);
   header('location:vouchers.php');
}

$new_search = isset($_POST['submit']) ? $_POST['submit'] : '';
$new_update = isset($_POST['update']) ? $_POST['update'] : '';




if($new_update == 'BATCH UPDATE VOUCHER'){
//$updateform             = isset($_POST['updateForm']) ? $_POST['updateForm'] : '';               
$batchupdate            = isset($_POST['batchupdate']) ? $_POST['batchupdate'] : '';
//$check_upd_used         = isset($_POST['check']['upd_used']) ? $_POST['check']['upd_used'] : '';
$upd_used               = isset($_POST['upd_used']) ? $_POST['upd_used'] : '';
//$check_upd_activated    = isset($_POST['check']['upd_activated']) ? $_POST['check']['upd_activated'] : '';
$upd_activated          = isset($_POST['upd_activated']) ? $_POST['upd_activated'] : '';
//$check_upd_credit       = isset($_POST['check']['upd_credit']) ? $_POST['check']['upd_credit'] : '';
//$mode_upd_credit        = isset($_POST['mode']['upd_credit']) ? $_POST['mode']['upd_credit'] : '';
$upd_credit             = isset($_POST['upd_credit']) ? $_POST['upd_credit'] : '';
//$type_upd_credit        = isset($_POST['type']['upd_credit']) ? $_POST['type']['upd_credit'] : '';
//$check_upd_currency     = isset($_POST['check']['upd_currency']) ? $_POST['check']['upd_currency'] : '';
$upd_currency           = isset($_POST['upd_currency']) ? $_POST['upd_currency'] : '';
//$check_upd_tag          = isset($_POST['check']['upd_tag']) ? $_POST['check']['upd_tag'] : '';
$upd_tag                = isset($_POST['upd_tag']) ? $_POST['upd_tag'] : '';
$update                 = isset($_POST['update']) ? $_POST['update'] : '';
//echo "<br>". $updateform;

$row_upd_used = $upd_used !='' ? ", `used`='$upd_used'" : ''; 
//echo "<br>". $check_upd_activated;
$row_upd_activated = $upd_activated !='' ? ", `activated`='$upd_activated'" : '';
//echo "<br>". $check_upd_credit;
//echo "<br>". $mode_upd_credit;
$row_upd_credit = $upd_credit !='' ? ", `credit`='$upd_credit'" : '';
//echo "<br>". $type_upd_credit;
//echo "<br>". $check_upd_currency;
$row_upd_currency = $upd_currency !='' ? ", `currency`='$upd_currency'" : '';
//echo "<br>". $check_upd_tag;
$row_upd_tag = $upd_tag !='' ? ", `tag`='$upd_tag'" : '';
//echo "<br>". $update;
    
    if($batchupdate == '1'){
        mysql_query("UPDATE `cc_voucher` SET `creationdate`=NOW() $row_upd_tag $row_upd_credit $row_upd_activated $row_upd_used $row_upd_currency", $conn_voip);    
    }
}
   


if($new_search == 'Search'){
//fromstatsday_sday, fromstatsmonth_sday, fromstatsday_hour, fromstatsday_min, tostatsday_sday, tostatsmonth_sday, tostatsday_hour, tostatsday_min, dst, Vouchers, choose_calltype, terminatecauseid, resulttype, choose_currency, image
//entercustomer, entercustomer_num, entertariffgroup, enterprovider, entertrunk, enterratecard

//posted_search, current_page, voucher, usedcardnumber, tag, credit1type, credit1, credit2, activated, used, currency

$posted_search                  = isset($_POST['posted_search ']) ? trim(strip_tags($_POST['posted_search'])) : '';
$current_page                   = isset($_POST['current_page']) ? trim(strip_tags($_POST['current_page'])) : '';
$voucher                        = isset($_POST['voucher']) ? trim(strip_tags($_POST['voucher'])) : '';
$usedcardnumber                 = isset($_POST['usedcardnumber']) ? trim(strip_tags($_POST['usedcardnumber'])) : '';
$tag                            = isset($_POST['tag']) ? trim(strip_tags($_POST['tag'])) : '';
$credit1type                    = isset($_POST['credit1type']) ? trim(strip_tags($_POST['credit1type'])) : '';
$credit2type                    = isset($_POST['credit2type']) ? trim(strip_tags($_POST['credit2type'])) : '';
$credit1                        = isset($_POST['credit1']) ? trim(strip_tags($_POST['credit1'])) : '';
$credit2                        = isset($_POST['credit2']) ? trim(strip_tags($_POST['credit2'])) : '';
$activated                      = isset($_POST['activated']) ? trim(strip_tags($_POST['activated'])) : '';
$used                           = isset($_POST['used']) ? trim(strip_tags($_POST['used'])) : '';
$currency                       = isset($_POST['currency']) ? trim(strip_tags($_POST['currency'])) : '';

if($credit1type == '4'){
    $c1t = '>';
}elseif($credit1type == '5'){
    $c1t = '>=';
}elseif($credit1type == '1'){
    $c1t = '=';
}elseif($credit1type == '2'){
    $c1t = '<=';
}elseif($credit1type == '3'){
    $c1t = '<';
}else{
    $c1t = '';
}
if($credit2type == '4'){
    $c2t = '>';
}elseif($credit2type == '5'){
    $c2t = '>=';
}elseif($credit2type == '2'){
    $c2t = '<=';
}elseif($credit2type == '3'){
    $c2t = '<';
}else{
    $c2t = '';
}

$input_voucher              = $voucher!='' ? "`voucher` LIKE '%$voucher%'" : "`voucher` LIKE '%$voucher%'";
$input_usedcardnumber       = $usedcardnumber!='' ? "AND `usedcardnumber`='$usedcardnumber'" : "";
$input_tag                  = $tag!='' ? "AND `tag` LIKE '%$tag%'" : "";
$input_credit1              = $c1t!='' ? "AND `credit` $c1t '$credit1'" : "";
$input_credit2              = $c2t!='' ? "AND `credit` $c2t '$credit2'" : "";
$input_activated            = $activated!='' ? "AND `activated` LIKE '%$activated%'" : "";
$input_used                 = $used!='' ? "AND `used` LIKE '%$used%'" : "";
$input_currency             = $currency!='' ? "AND `currency` LIKE '%$currency%'" : "";

$sql_vouchers= mysql_query("SELECT `id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency`
                           FROM `cc_voucher` WHERE $input_voucher $input_usedcardnumber $input_tag $input_credit1 $input_credit2 $input_activated $input_used $input_currency", $conn_voip);
                           
}else{
/*
$FG_VOUCHER_TABLE  = "cc_voucher";
$FG_VOUCHER_FIELDS = "voucher, credit, activated, tag, currency, expirationdate";
$FG_TABLE_CLAUSE_VOUCHER = "expirationdate >= CURRENT_TIMESTAMP AND activated='t' AND voucher='$voucher'";
$list_voucher = $instance_sub_table -> Get_list ($HD_Form -> DBHandle, $FG_TABLE_CLAUSE_VOUCHER, $order, $sens, null, null, $limite, $current_record);
if ($list_voucher[0][0]==$voucher) {
			if (!isset ($currencies_list[strtoupper($list_voucher[0][4])][2])) {
				$error_msg = '<font face="Arial, Helvetica, sans-serif" size="2" color="red"><b>'.gettext("System Error : the currency table is incomplete!").'</b></font><br><br>';
			} else {
				$add_credit = $list_voucher[0][1]*$currencies_list[strtoupper($list_voucher[0][4])][2];
				$QUERY = "UPDATE cc_voucher SET activated='f', usedcardnumber='".$_SESSION["pr_login"]."', usedate=now() WHERE voucher='".$voucher."'";
				$result = $instance_sub_table -> SQLExec ($HD_Form -> DBHandle, $QUERY, 0);
				$QUERY = "UPDATE cc_card SET credit=credit+'".$add_credit."' WHERE username='".$_SESSION["pr_login"]."'";
				$result = $instance_sub_table -> SQLExec ($HD_Form -> DBHandle, $QUERY, 0);
				$error_msg = '<font face="Arial, Helvetica, sans-serif" size="2" color="green"><b>'.gettext("The voucher").'('.$voucher.') '.gettext("has been used, We added").' '.$add_credit.' '.gettext("credit on your account!").'</b></font><br><br>';
			}
		}
*/
   
/*
SELECT `id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency` FROM `cc_voucher`
$content .= '<td>ID</td><td>VOUCHER</td><td>CREDIT</td><td>TAG</td><td>ACTIVATED</td><td>USED</td><td>ACCOUNT USED </td><td>CREATED DATE</td><td>USED DATE</td><td>CURRENCY</td><td>ACTION</td>';
voucher, credit, activated, tag, currency, expirationdate
<td>id</td><td>voucher</td><td>credit</td><td>tag</td><td>activated</td><td>used</td><td>1</td><td>2</td><td>3</td><td>currency</td>                                        
*/


//SELECT `id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency` FROM `cc_voucher`
    
$sql_vouchers= mysql_query("SELECT `id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency` FROM `cc_voucher`", $conn_voip);
}

         
    $content ='
                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Vouchers</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

/*   
$content .= '
	<center>
		<b>Define criteria to make a precise search</b>
		<table class="searchhandler_table1">';
              
$content .= '
<!-- ** ** ** ** ** Part for the research ** ** ** ** ** -->
<center>
<FORM METHOD="POST" name="myForm" ACTION="">
<TABLE class="bar-status" width="85%" border="0" cellspacing="1" cellpadding="2" align="center">
				<tr>
		<td align="left" valign="top" class="bgcolor_004"><font
			class="fontstyle_003">CUSTOMERS :</font>
		</td>
		<td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>		<td valign="top"> <INPUT TYPE="text" NAME="entercustomer_num" 
					value="" class="form_input_text" id="numb_cust"> 
                                        <a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_numb_cust.php\');">numb customer</a>
				</td>
				<td width="50%">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" class="fontstyle_searchoptions">CallPlan :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT TYPE="text" NAME="entertariffgroup" value="" size="4" id="numb_call_plan" class="form_input_text">&nbsp;<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_call_plan.php\');">id</a></td>
						<td align="left" class="fontstyle_searchoptions">Provider :
			
			<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="enterprovider"
							value="" size="4" class="form_input_text" id="data_provider">
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_provider.php\');">id</a></td>
					</tr>
					<tr>
						<td align="left" class="fontstyle_searchoptions">Trunk :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="entertrunk" value=""
							size="4" class="form_input_text" id="id_trunk">
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_trunk.php\');">id</a>
							</td>
                                                <td align="left" class="fontstyle_searchoptions">Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="enterratecard"
							value="" size="4"
							class="form_input_text" id="data_rate">
							<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_rate.php\');">id</a>
							</td>
                                         </tr>
                                         <tr>
                                                <td align="left" class="fontstyle_searchoptions">Buy Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="buyrate" value=""
							size="4" class="form_input_text" id="buyrate">&nbsp;
							</td>
                                                <td align="left" class="fontstyle_searchoptions">Sell Rate :</td>
						<td align="left" class="fontstyle_searchoptions"><INPUT
							TYPE="text" NAME="sellrate"
							value="" size="4"
							class="form_input_text" id="sellrate">&nbsp;
							</td>        
					</tr>
				</table>
				</td>
			</tr>

		</table>
		</td>
	</tr>			
			<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">DATE</font>
		</td>
		<td align="left" class="bgcolor_005">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="fontstyle_searchoptions">From :
				<select name="fromstatsday_sday" class="form_input_select">';
                                        
                                        $bil_tgl = isset($_POST['fromstatsday_sday']) ? $_POST['fromstatsday_sday'] : date("d") ;
                                        
                                        $content .= '<option value="00">-Select Day From-</option>';
                                        for($bil=1; $bil<=31; $bil++){
                                                if($bil == $bil_tgl){
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'" selected>'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }else{
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                                }
                                        }
					$content .= '
                                        </select>  <select name="fromstatsmonth_sday" class="form_input_select">
					';
                                            $time_H = date("H");
                                            $time_i = date("i");
                                            $time_s = date("s");
                                            $time_m = date("m");
                                            $time_d = date("d");
                                            $time_Y = date("Y");
                                            for($month_r=1; $month_r<=36; $month_r++){
                                                if($month_r == 1){
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }
                                            }
                                        $content .= '</select> <br />
					Time :				<select name="fromstatsday_hour" class="form_input_select">
					<option value="00" selected>00</option>';
				for($hour=1; $hour<=23; $hour++){
				    if($hour <= 9){
					$content .= '<option value="0'.$hour.'">0'.$hour.'</option>';
				    }else{
					$content .= '<option value="'.$hour.'">'.$hour.'</option>';										
				    }
				
				}
				$content .= '</select> : <select name="fromstatsday_min"
					class="form_input_select">
				<option value="00" selected>00</option>';
				for($min=1; $min<=11; $min++){
				    $minute_for = $min * 5;
				    if($minute_for<10){
					$content .= '<option value="0'.$minute_for.'">0'.$minute_for.'</option>';
				    }else{
					$content .= '<option value="'.$minute_for.'">'.$minute_for.'</option>';
				    }
				}
				$content .= '
				</select></td>
				<td class="fontstyle_searchoptions"> 
				To  :
				<select name="tostatsday_sday" class="form_input_select">
				<option value="00">-Select Day To-</option>';
                                $bil_tgl = isset($_POST['fromstatsday_sday']) ? $_POST['fromstatsday_sday'] : date("d") ;
				for($bil=1; $bil<=31; $bil++){
				    if($bil == $bil_tgl){
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'" selected>'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                    }else{
                                                    $content .= '<option value="'.($bil < 10 ? '0'.$bil  : $bil).'">'.($bil < 10 ? '0'.$bil  : $bil).'</option>';
                                    } 
				}
				
				$content .= '
				</select>
				<select name="tostatsmonth_sday" class="form_input_select">';
                                            $time_H = date("H");
                                            $time_i = date("i");
                                            $time_s = date("s");
                                            $time_m = date("m");
                                            $time_d = date("d");
                                            $time_Y = date("Y");
                                            for($month_r=1; $month_r<=36; $month_r++){
                                                if($month_r == 1){
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'"  selected>'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }else{
                                                    $content .= '<option value="'.(date("Y-m", mktime($time_H, $time_i, $time_s, ($time_m - $month_r + 1), $time_d, $time_Y))).'" >'.(date("F-Y", mktime($time_H,$time_i,$time_s,($time_m - $month_r + 1), $time_d, $time_Y))).'</option>';
                                                }
                                            }
                                $content .= '</select>
				<br />
				Time :	<select name="tostatsday_hour" class="form_input_select">
				<option value="00">00</option>';
				for($hour=1; $hour<=23; $hour++){
				    if($hour <= 9){
					$content .= '<option value="0'.$hour.'">0'.$hour.'</option>';
				    }else{
					$content .= '<option value="'.$hour.'">'.$hour.'</option>';										
				    }
				}
				
				$content .= '
				</select> : <select name="tostatsday_min" class="form_input_select">
				<option value="00">00</option>';
				for($min=1; $min<=11; $min++){
				    $minute_for = $min * 5;
				    if($minute_for<10){
					$content .= '<option value="0'.$minute_for.'">0'.$minute_for.'</option>';
				    }else{
					$content .= '<option value="'.$minute_for.'">'.$minute_for.'</option>';
				    }
				}
				$content .= '
				</select></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">Called Number</font>
		</td>
                <td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="called_number"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
                </tr>
                <tr>
                <td align="left" class="bgcolor_004"><font class="fontstyle_003">Source</font>
		</td>
                <td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="source"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
                </tr>
                <tr>
		<td align="left" class="bgcolor_004"><font class="fontstyle_003">Vouchers</font>
		<td class="bgcolor_005" align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="Vouchers"
					value="" class="form_input_text"></td>
			</tr>
		</table>
		</td>
	</tr>
	<!-- Select Calltype: -->
	<tr>
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">CALL TYPE</font></td>
		<td class="bgcolor_003" align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="fontstyle_searchoptions"><select NAME="choose_calltype"
					size="1" class="form_input_select">
					<option value=\'-1\'
												selected >ALL CALLS								</option>
															<option value=\'0\'
						>STANDARD								</option>
															<option value=\'1\'
						>SIP/IAX								</option>
															<option value=\'2\'
						>DIDCALL								</option>
															<option value=\'3\'
						>DID_VOIP								</option>
															<option value=\'4\'
						>CALLBACK								</option>
															<option value=\'5\'
						>PREDICT								</option>
															<option value=\'6\'
						>AUTO DIALER								</option>
															<option value=\'7\'
						>DID-ALEG								</option>
													</select></td>
			</tr>
		</table>
		</td>
	</tr>

	<!-- Select Option : to show just the Answered Calls or all calls, Result type, currencies... -->
	<tr>
		<td class="bgcolor_002" align="left"><font class="fontstyle_003">OPTIONS</font></td>
		<td class="bgcolor_003" align="center">
		<div align="left">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="20%" class="fontstyle_searchoptions">
					SHOW CALLS :  						
			   </td>
				<td width="80%" class="fontstyle_searchoptions"><select
					NAME="terminatecauseid" size="1" class="form_input_select">
					<option value=\'ANSWER\'
												selected >ANSWERED							</option>

					<option value=\'ALL\' >ALL							</option>

					<option value=\'INCOMPLET\'
						>NOT COMPLETED							</option>

					<option value=\'CONGESTION\'
						>CONGESTIONED							</option>

					<option value=\'BUSY\' >BUSIED							</option>

					<option value=\'NOANSWER\'
						>NOT ANSWERED							</option>

					<option value=\'CHANUNAVAIL\'
						>CHANNEL UNAVAILABLE							</option>

					<option value=\'CANCEL\' >CANCELED							</option>

				</select></td>
			</tr>
			<tr class="bgcolor_005">
				<td class="fontstyle_searchoptions">
					RESULT : 
			   </td>
				<td class="fontstyle_searchoptions">';
				
			    $content .= '<select name="resulttype">
					<option value="min">Min</option>
					<option value="sec">Sec</option>				
					</select>';
			    $content .= '</td>
			</tr>
			<tr>
				<td class="fontstyle_searchoptions">
					CURRENCY :
				</td>
				<td class="fontstyle_searchoptions"><select NAME="choose_currency" size="1" class="form_input_select">';
				$sql_currencies = mysql_query("SELECT `id`, `currency`, `name`, `value`, `lastupdate`, `basecurrency` FROM `cc_currencies`  ORDER BY `cc_currencies`.`name` ASC", $conn_voip);
				if((isset($_POST['choose_currency']) ? $_POST['choose_currency'] : 'IDR') == 'IDR'){
				    $data_cur = "IDR";
				}
				else{
				    $data_cur = $_POST['choose_currency'];
				}
				while($data_currencies = mysql_fetch_array($sql_currencies)){
				    if($data_cur == $data_currencies['currency']){
				    $content .= '<option value=\''.$data_currencies['currency'].'\' selected >'.$data_currencies['name'].' ('.$data_currencies['value'].') </option>';
				    }else{
				    $content .= '<option value="'.$data_currencies['currency'].'" >'.$data_currencies['name'].'('.$data_currencies['value'].')</option>';
				    }
				}
				$content .= '</select></td>
			</tr>
		</table>
		
		</td>
	</tr>
	<!-- Select Option : to show just the Answered Calls or all calls, Result type, currencies... -->

	<tr>
		<td class="bgcolor_004" align="left"></td>
		<td class="bgcolor_005" align="center"><input type="submit"
			name="search" align="top" border="0" value="search"></td>
	</tr>
</table>
</FORM>
</center>
';
*/

$content .= '<!-- ** ** ** ** ** Part for the research - ** ** ** ** ** -->
	<center>
		<b>Define criteria to make a precise search</b>
		<table class="searchhandler_table1">
		<FORM METHOD="POST" ACTION="">
		<INPUT TYPE="hidden" NAME="posted_search" value="1">
		<INPUT TYPE="hidden" NAME="current_page" value="0">
		
		<!-- compare with a value //-->
			<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;VOUCHER</font>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="voucher" value="" class="form_input_text"></td>
				</tr></table></td>
			</tr>

						<tr>
				<td class="bgcolor_002" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;ACCOUNT NUMBER</font>
				</td>
				<td class="bgcolor_003" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="usedcardnumber" value="" class="form_input_text"></td>
				</tr></table></td>
			</tr>
						<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;TAG</font>
				</td>
				<td class="bgcolor_005" align="left" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="tag" value="" class="form_input_text"></td>
				</tr></table></td>
			</tr>
			<!-- compare between 2 values //-->
			<tr>
				<td class="bgcolor_004" align="left">
					<font class="fontstyle_003">&nbsp;&nbsp;CREDIT</font>
				</td>
				<td class="bgcolor_005" align="left">
				<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
				<td class="fontstyle_searchoptions">&nbsp;&nbsp;<INPUT TYPE="text" NAME="credit1" size="10" value="" class="form_input_text"></td>
				<td><select NAME="credit1type" >
                                    <option value="">operator</option>
                                    <option value="4" >&gt;</option>
                                    <option value="5" >&gt; =</option>
                                    <option value="1" checked> = </option>
                                    <option value="2" >&lt; =</option>
                                    <option value="3" >&lt;</option>
                                </select></td>
				<td width="5%" class="fontstyle_searchoptions" align="center" ></td>
				<td>&nbsp;&nbsp;<INPUT TYPE="text" NAME="credit2" size="10" value="" class="form_input_text"></td>
				<td><select NAME="credit2type">
                                <option value="">operator</option>
                                <option value="4" >&gt;</option>
				<option value="5" >&gt; =</option>
				<option value="2" >&lt; =</option>
				<option value="3" >&lt;</option>
                                </select></td>
				</tr></table>
				</td>
			</tr>

									<!-- select box //-->
			<tr>
				<td class="bgcolor_002" align="left" >
					<font class="fontstyle_003">&nbsp;&nbsp;</font>
				</td>
				<td class="bgcolor_003" align="left" >

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td>
									<select NAME="activated" size="1" class="form_input_select">
						<option value=\'\'>SELECT STATUS</option>
										<option class=input value=\'t\'  >Active</option>
										<option class=input value=\'f\'  >Inactive</option>
									</select>
									<select NAME="used" size="1" class="form_input_select">
						<option value=\'\'>SELECT USED</option>
										<option class=input value=\'0\'  >NOT USED</option>
										<option class=input value=\'1\'  >USED</option>
									</select>
									<select NAME="currency" size="1" class="form_input_select">
						<option value=\'\'>SELECT CURRENCY</option>';
                                                $query_data_currencies = mysql_query("SELECT `id`, `currency`, `name`, `value`, `lastupdate`, `basecurrency` FROM `cc_currencies` ORDER BY `name` ASC", $conn_voip);
            					while($row_currencies = mysql_fetch_array($query_data_currencies)){
                                                    $content .= '<option value=\''.$row_currencies['currency'].'\'>'.$row_currencies['name'].'</option>';
                                                }
									$content .= '</select>
								</td>
				</tr>
				</table></td>
			</tr>
						<tr>
        		<td class="bgcolor_004" align="left"> </td>
				<td class="bgcolor_005" align="center">
					<input type="submit" name="submit" value="Search" />
						  			</td>
    		</tr>
		</tbody></table>
	</FORM>
</center>';

$content .= '<center>
<b>&nbsp;6 vouchers selected!&nbsp;Use the options below to batch update the selected vouchers.</b>
	   <table align="center" border="0" width="65%"  cellspacing="1" cellpadding="2">
        <tbody>
		<form name="updateForm" action="" method="post">
		<INPUT type="hidden" name="batchupdate" value="1">
		<tr>		
          		  <td align="left"  class="bgcolor_001" colspan="2">
				1)&nbsp;USED&nbsp;: 
				<select NAME="upd_used" size="1" class="form_input_select">
                                                                        <option value=\'\'>SELECT USED</option>
									<option value=\'0\'>NOT USED</option>
									<option value=\'1\'>USED</option>
                                </select>
		  </td>
		</tr>
		<tr>		

		  <td align="left" class="bgcolor_001" colspan="2">
			  	2)&nbsp;ACTIVATED&nbsp;:
				<select NAME="upd_activated" size="1" class="form_input_select">
											<option value=\'\' >Select Activated</option>
                                                                                        <option value=\'t\' >Active</option>
											<option value=\'f\' >Inactive</option>
									</select><br/>
		  </td>
		</tr>
		<tr>		

		<td align="left"  class="bgcolor_001" colspan="2">	
			  	3)&nbsp;CREDIT&nbsp;:
					<input class="form_input_text" name="upd_credit" size="10" maxlength="10"  value="">
		</td>
		</tr>
		<tr>		
          	  <td align="left"  class="bgcolor_001" colspan="2">
				4)&nbsp;CURRENCY&nbsp;:
				<select NAME="upd_currency" size="1" class="form_input_select">
                                <option value=\'\'>Select Currency</option>';
                                                $query_data_currencies = mysql_query("SELECT `id`, `currency`, `name`, `value`, `lastupdate`, `basecurrency` FROM `cc_currencies` ORDER BY `name` ASC", $conn_voip);
            					while($row_currencies = mysql_fetch_array($query_data_currencies)){
                                                    $content .= '<option value=\''.$row_currencies['currency'].'\'>'.$row_currencies['name'].'</option>';
                                                }
		$content .= '							
		    </select>
		  </td>
		</tr>
		<tr>		

		  <td align="left"  class="bgcolor_001" colspan="2">
				5)&nbsp;TAG&nbsp;: 
				<input class="form_input_text"  name="upd_tag" size="10" maxlength="6" value="">
				<br/>
		</td>
		</tr>
		<tr>		
		 	<td align="right"  class="bgcolor_001" colspan="2"><input class="form_input_button" name="update" value="BATCH UPDATE VOUCHER" type="submit"></td>
		</tr>
		</form>
		</table>
                <table align="right"><tbody><tr align="right"><td align="right"><a href="generate_voucher.php"> Generate Voucher </a></td><td><a href="add_voucher.php">  Add Voucher</a></td></tr></tbody></table><br></br>
</center>'; 

// ID 	ACCOUNT 	REFILL DATE 	REFILL AMOUNT 	REFILL TYPE 	ACTION	
// id 	creationdate 	firstusedate 	expirationdate 	enableexpire 	expiredays 	username 	useralias 	uipass 	credit 	tariff 	id_didgroup 	activated 	status 	lastname 	firstname 	address 	city 	state 	country 	zipcode 	phone 	email 	fax 	inuse 	simultaccess 	currency 	lastuse 	nbused 	typepaid 	creditlimit 	voipcall 	sip_buddy 	iax_buddy 	language 	redial 	runservice 	nbservice 	id_campaign 	num_trials_done 	vat 	servicelastrun 	initialbalance 	invoiceday 	autorefill 	loginkey 	mac_addr 	id_timezone 	tag 	voicemail_permitted 	voicemail_activated 	last_notification 	email_notification 	notify_email 	credit_notification 	id_group 	company_name 	company_website 	vat_rn 	traffic 	traffic_target 	discount 	restriction 	id_seria 	serial 	block 	lock_pin 	lock_date
$content .= '<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                            <th>ID</th><th>VOUCHER</th><th>CREDIT</th><th>TAG</th><th>ACTIVATED</th><th>USED</th><th>ACCOUNT USED </th><th>CREATED DATE</th><th>USED DATE</th><th>CURRENCY</th><th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					//t1.Vouchers ,count(*) as count,avg(rc.buyrate) as buyrate ,avg(rc.rateinitial) as calledrate, sum(t1.sessiontime) as sessiontime ,sum(t1.buycost) as buycost, sum(t1.sessionbill) as sessionbill
                                        //cc_call t1 LEFT OUTER JOIN cc_trunk t3 ON t1.id_trunk = t3.id_trunk LEFT OUTER JOIN  cc_ratecard as rc ON rc.id=t1.id_ratecard

					
					while($row_vouchers = mysql_fetch_array($sql_vouchers)){
					$content .= '
					    <tr>';
                                            /*
						<td>'.$row_Vouchers['Vouchers'].'</td>
						<td>'.$data_count_call['count'].'</td>
                                                <td>'.$data_avg_buyrate['buyrate'].'</td>
						<td>'.$data_avg_calledrate['calledrate'].'</td>
						<td>'.$data_duration['sessiontime'].'</td>
                                                <td>'.$data_buy['buycost'].'</td>
                                                <td>'.$data_sell['sessionbill'].'</td>
                                            */
                                            if($row_vouchers['activated'] == 't'){
                                                $data_field_activated = 'Active';
                                            }else{
                                                $data_field_activated = 'Inactive';
                                            }
                                            if($row_vouchers['used'] == '0'){
                                                $data_field_used = 'NOT USED';
                                            }else{
                                                $data_field_used = 'USED';
                                            }
                                            //SELECT `id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency` FROM `cc_voucher`
                                            $content .= '<td>'.$row_vouchers['id'].'</td><td>'.$row_vouchers['voucher'].'</td><td>'.$row_vouchers['credit'].'</td><td>'.$row_vouchers['tag'].'</td><td>'.$data_field_activated.'</td><td>'.$data_field_used.'</td><td>'.$row_vouchers['usedcardnumber'].'</td><td>'.$row_vouchers['creationdate'].'</td><td>'.$row_vouchers['usedate'].'</td><td>'.$row_vouchers['currency'].'</td><td><a href="edit_voucher.php?id='.$row_vouchers['id'].'">Edit</a></td>';
                                            
                                            $content .';    
                                            </tr>';
					}
					
$content .= '                           </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th><th>VOUCHER</th><th>CREDIT</th><th>TAG</th><th>ACTIVATED</th><th>USED</th><th>ACCOUNT USED </th><th>CREATED DATE</th><th>USED DATE</th><th>CURRENCY</th><th>ACTION</th>
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