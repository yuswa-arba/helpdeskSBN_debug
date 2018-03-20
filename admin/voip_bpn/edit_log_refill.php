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
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Edit Log refill");

    global $conn_voip;
$id_edit = isset($_GET['id_edit']) ? $_GET['id_edit'] : '';
$action_form = isset($_POST['form_action'])  ? $_POST['form_action'] : '';   
if($action_form == 'edit'){
$data_id_edit 		= isset($_POST['data_id_edit']) ? $_POST['data_id_edit'] : '';    
$data_date		= isset($_POST['date']) ? $_POST['date'] : '';
$data_credit		= isset($_POST['credit']) ? $_POST['credit'] : '';
$data_card_id		= isset($_POST['card_id']) ? $_POST['card_id'] : '';
$data_description	= isset($_POST['description']) ? $_POST['description'] : '';
$data_refill_type	= isset($_POST['refill_type']) ? $_POST['refill_type'] : '';
$data_added_invoice	= isset($_POST['added_invoice']) ? $_POST['added_invoice'] : '';
$data_agent_id		= isset($_POST['agent_id']) ? $_POST['agent_id'] : '';

$sql_update_data_refill = "UPDATE `cc_logrefill` SET `date`='$data_date',`credit`='$data_credit',`card_id`='$data_card_id',`description`='$data_description',`refill_type`='$data_refill_type',`added_invoice`='$data_added_invoice',`agent_id`='$data_agent_id' WHERE `id`='$id_edit'";
enableLog("", $loggedin["username"], $loggedin["id_employee"], "Edit Log refill = $sql_update_data_refill");
mysql_query($sql_update_data_refill, $conn_voip);
header("location: log_refill.php");
}


    
    $content = '

                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Log Refill - Edit</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

$data_log_refill = mysql_fetch_array(mysql_query("SELECT `date`, `credit`, `card_id`, `description`, `refill_type`, `added_invoice`, `agent_id` FROM `cc_logrefill` WHERE `id`='$id_edit'", $conn_voip));
    $content .= '
    <FORM action="" id="myForm" method="post" name="myForm">
    <input type="hidden" name="data_id_edit" value="'.$id_edit.'">
	<TABLE cellspacing="2" class="addform_table1">
          <INPUT type="hidden" name="form_action" value="edit">
		  <INPUT type="hidden" name="wh" value="">
		 	 <INPUT type="hidden" name="atmenu" value="">
		 <TBODY>
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		ID CUSTOMER 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
			<INPUT type="text" name="card_id" id="card_id"  size=30 maxlength=50  value="'.$data_log_refill['card_id'].'">';
$content .= 'Select the Customer <a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_id_cust.php\');">id</a><br>';
		//<a id="linkk" name="linkk" href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform2(\'data_id_cust.php\');">id</a><br>
		//<a href="#" onclick="window.open(\'data_id_cust.php\' , \'CardNumberSelection\',\'width=550,height=330,top=20,left=100,scrollbars=1\');">insert id</a>
$content .= '<!--CAPTCHA IMAGE CODE START HERE-->
			<span class="liens">
	                         </span> 
	</TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		REFILL DATE 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">';
$date_now = mysql_fetch_array(mysql_query("SELECT NOW() AS `now`"));				
$content .= '	                 <INPUT class="form_input_text" name=date  size=40 maxlength=40 value=\''.$data_log_refill['date'].'\'>
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		REFILL AMOUNT 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
	                 <INPUT class="form_input_text" name=credit  value="'.$data_log_refill['credit'].'">
			<span class="liens">
	                         </span> 
	<br/>Enter the amount in the currency base : idr         </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		DESCRIPTION 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
	            <TEXTAREA class="form_input_textarea" name=description cols=50 rows=4>'.$data_log_refill['description'].'</TEXTAREA> 
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		REFILL TYPE 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
			   <SELECT name=\'refill_type\' class="form_input_select">';
	if($data_log_refill['refill_type'] == '0'){	
	$content .= '<OPTION  value=\'0\' selected> AMOUNT</OPTION>
	<OPTION  value=\'1\'> CORRECTION</OPTION>
	<OPTION  value=\'2\'> EXTRA FEE</OPTION>
	<OPTION  value=\'3\'> AGENT REFUND</OPTION>';
	}elseif($data_log_refill['refill_type'] == '1'){
	$content .= '<OPTION  value=\'0\'> AMOUNT</OPTION>
	<OPTION  value=\'1\' selected> CORRECTION</OPTION>
	<OPTION  value=\'2\'> EXTRA FEE</OPTION>
	<OPTION  value=\'3\'> AGENT REFUND</OPTION>';    
	}elseif($data_log_refill['refill_type'] == '2'){
	$content .= '<OPTION  value=\'0\'> AMOUNT</OPTION>
	<OPTION  value=\'1\'> CORRECTION</OPTION>
	<OPTION  value=\'2\' selected> EXTRA FEE</OPTION>
	<OPTION  value=\'3\'> AGENT REFUND</OPTION>';    
	}elseif($data_log_refill['refill_type'] == '3'){
	$content .= '<OPTION  value=\'0\'> AMOUNT</OPTION>
	<OPTION  value=\'1\'> CORRECTION</OPTION>
	<OPTION  value=\'2\'> EXTRA FEE</OPTION>
	<OPTION  value=\'3\' selected> AGENT REFUND</OPTION>';
	}
	
	$content .= '
	</SELECT>
			<span class="liens">
	                         </span> 
	<br/>Define type for payment and refill,if created.         </TD>
	</TR>			
		
        </TBODY>
      </TABLE>
	  <TABLE cellspacing="0" class="editform_table8">
		<tr>
			<td width="50%" class="text_azul"><span class="tableBodyRight">Click \'Confirm Data\' to continue.</span></td>
                        <td width="50%" align="right" valign="top" class="text">
				<a href="#" onClick="javascript:document.myForm.submit();" class="btn btn-primary btn-sm" >CONFIRM DATA</a>
				<!--
				<INPUT type="submit" title="Create a new Refill" alt="Create a new  Refill" border=0 hspace=0 id=submit4 name=submit2>
				-->
			</td>
		</tr>
	  </TABLE>
	</FORM>
    ';
		
$content .= '</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';	  				

$plugins = '
	<script type="text/javascript">
			function valideopenerform(){
			var popy= window.open("data_id_cust.php","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			if (window.focus) {popy.focus()}
			    return false;
			}
			function valideopenerform2(url){
			var popy= window.open(url,"history","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			if (window.focus) {popy.focus()}
			    return false;
			}
	</script>
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

    $title	= 'List Customer';
    $submenu	= "voip_customers";
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