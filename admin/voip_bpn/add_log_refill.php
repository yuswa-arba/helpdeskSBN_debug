<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    enableLog($id_customer="", $nama_customer= $loggedin["username"], $id_admin=$loggedin["id_employee"],$activity="Open Form Log Refill");

    global $conn_voip;
$action_form = isset($_POST['form_action'])  ? $_POST['form_action'] : '';   
if($action_form == 'add'){
$data_date		= isset($_POST['date']) ? $_POST['date'] : '';
$data_credit		= isset($_POST['credit']) ? $_POST['credit'] : '';
$data_card_id		= isset($_POST['card_id']) ? $_POST['card_id'] : '';
$data_description	= isset($_POST['description']) ? $_POST['description'] : '';
$data_refill_type	= isset($_POST['refill_type']) ? $_POST['refill_type'] : '';
$data_added_invoice	= isset($_POST['added_invoice']) ? $_POST['added_invoice'] : '';
$data_agent_id		= isset($_POST['agent_id']) ? $_POST['agent_id'] : '';

//26 	2014-09-23 15:23:18 	1000.00000 	8 	[BLOB - NULL] 	0 	1 	NULL
$sql_insert_data_refill = "INSERT INTO `cc_logrefill`(`id`, `date`, `credit`, `card_id`, `description`, `refill_type`, `added_invoice`, `agent_id`) VALUES ('','$data_date','$data_credit','$data_card_id','$data_description','$data_refill_type','$data_added_invoice','$data_agent_id')";
    enableLog($id_customer="", $nama_customer= $loggedin["username"], $id_admin=$loggedin["id_employee"],$activity="Insert Data Form Log Refill = $sql_insert_data_refill");
mysql_query($sql_insert_data_refill, $conn_voip);
header("location: log_refill.php");
}
/*
	$HD_Form -> AddEditElement (gettext("REFILL DATE"),
				   "date",		
				   '$value',	
				   "INPUT",	
				   "size=40 maxlength=40 $comp_date",	
				   "10",	
				   gettext("Insert the current date"),
				   "" , "", "",	"", "", "", "", "" );
	
	$HD_Form -> AddEditElement (gettext("REFILL AMOUNT"),
				   "credit",		
				   '$value',	
				   "INPUT",	
				   "size=60 maxlength=10",	
				   "12",	
				   gettext("Insert the credit amount"),
				   "" , "", "",	"", "" , "", "", gettext("Enter the amount in the currency base : ").BASE_CURRENCY );
	
	$HD_Form -> AddEditElement (gettext("DESCRIPTION"),
					"description",
					'',
					"TEXTAREA",
					"cols=50 rows=4",
					"",
					gettext("Insert the description"),
					"" , "", "", "", "" , "", "", "");
				   
	$HD_Form -> AddEditElement (gettext("REFILL TYPE"),
	               "refill_type",
	               '$value',
	               "SELECT",
	               "",
	               "",
	               "",
	               "list" , "", "",     "", $list_refill_type, "%1", "", gettext("Define type for payment and refill,if created.") );

	id 	date 	credit 	card_id 	description 	refill_type 	added_invoice 	agent_id	       
 */    
    
/*
if(isset($_POST["submit2"])){
    $card_id		= isset($_POST["card_id"]) ? trim(strip_tags($_POST["card_id"])) : "";
    $date		= isset($_POST["date"]) ? trim(strip_tags($_POST["date"])) : "";
    $credit		= isset($_POST["credit"]) ? trim(strip_tags($_POST["credit"])) : "";
    $description	= isset($_POST["description"]) ? trim(strip_tags($_POST["description"])) : "";
    $refill_type	= isset($_POST["refill_type"]) ? trim(strip_tags($_POST["refill_type"])) : "";
    $added_invoice	= isset($_POST["added_invoice"]) ? trim(strip_tags($_POST["added_invoice"])) : "";
   
    $sql_card_id	= '';
    $sql_date		= '';
    $sql_credit		= '';
    $sql_description	= '';
    $sql_refill_type	= '';
    $sql_added_invoice	= ($card_id != "") ? "AND `cEmail` LIKE '%$card_id%'" : "";
   

    
    
    $sql_insert_refill = mysql_query("",$conn);
}*/

    
    $content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Log Refill - Add</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

    $content .= '
    <FORM action="" id="myForm" method="post" name="myForm">

	<TABLE cellspacing="2" class="addform_table1">
          <INPUT type="hidden" name="form_action" value="add">
		  <INPUT type="hidden" name="wh" value="">
		 	 <INPUT type="hidden" name="atmenu" value="">
		 <TBODY>
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		ID CUSTOMER 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
			<INPUT type="text" name="card_id" id="card_id"  size=30 maxlength=50  value="">';
$content .= '<a href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(\'data_id_cust.php\');">id</a><br>';
		//<a id="linkk" name="linkk" href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform2(\'data_id_cust.php\');">id</a><br>
		//<a href="#" onclick="window.open(\'data_id_cust.php\' , \'CardNumberSelection\',\'width=550,height=330,top=20,left=100,scrollbars=1\');">insert id</a>
$content .= '<!--CAPTCHA IMAGE CODE START HERE-->
			<span class="liens">
	                         </span> 
	<br/>Select the Customer ID         </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		REFILL DATE 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">';
$date_now = mysql_fetch_array(mysql_query("SELECT NOW() AS `now`"));				
$content .= '	                 <INPUT class="form_input_text" name=date  size=40 maxlength=40 value=\''.$date_now['now'].'\' value="">
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		REFILL AMOUNT 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
	                 <INPUT class="form_input_text" name=credit  size=60 maxlength=10 value="">
			<span class="liens">
	                         </span> 
	<br/>Enter the amount in the currency base : idr         </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		DESCRIPTION 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
	            <TEXTAREA class="form_input_textarea" name=description cols=50 rows=4></TEXTAREA> 
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		REFILL TYPE 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
			   <SELECT name=\'refill_type\' class="form_input_select"   >
		<OPTION  value=\'0\' 
	> AMOUNT</OPTION>	<OPTION  value=\'1\' 
	> CORRECTION</OPTION>	<OPTION  value=\'2\' 
	> EXTRA FEE</OPTION>	<OPTION  value=\'3\' 
	> AGENT REFUND</OPTION>        </SELECT>
			<span class="liens">
	                         </span> 
	<br/>Define type for payment and refill,if created.         </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		CREATE ASSOCIATE INVOICE 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="../Public/templates/default/images/background_cells.gif" class="text">
				
	Yes  <input type="radio" name="added_invoice" value="1" checked> - No <input type="radio" name="added_invoice" value="0" >		<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
		
        </TBODY>
      </TABLE>
	  <TABLE cellspacing="0" class="editform_table8">
		<tr>
			<td width="50%" class="text_azul"><span class="tableBodyRight">Click \'Confirm Data\' to continue.</span></td>
                        <td width="50%" align="right" valign="top" class="text">
				<a href="#" onClick="javascript:document.myForm.submit();" class="btn btn-primary btn-sm" > CONFIRM DATA </a>
				<!--
				<INPUT type="submit" title="Create a new Refill" alt="Create a new  Refill" border=0 hspace=0 class="btn btn-primary btn-sm" name=submit2>
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