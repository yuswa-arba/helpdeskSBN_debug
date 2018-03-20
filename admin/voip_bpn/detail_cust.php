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
    
    $cust_number	= $_GET["cust_numb"];
    
    $sql_masterCustomer = mysql_query("SELECT * FROM `cc_card` WHERE `username` = '$cust_number' ;",$conn_voip);
    $row_masterCustomer = mysql_fetch_array($sql_masterCustomer);
    $id_cust		= $row_masterCustomer["id"];
    
    $sql_getgroup = mysql_query("SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."';",$conn_voip);
    $row_getgroup = mysql_fetch_array($sql_getgroup);
    $sql_gettariffplan  = mysql_query("SELECT * FROM `cc_tariffgroup` WHERE `id` = '".$row_masterCustomer["tariff"]."';",$conn_voip);
    $row_gettariffplan  = mysql_fetch_array($sql_gettariffplan);
    $sql_callerid	= mysql_query("SELECT * FROM  `cc_callerid` WHERE `cid` = '$row_masterCustomer[useralias]';", $conn_voip);
    $row_callerid	= mysql_fetch_array($sql_callerid);
   //echo $row_callerid["activated"];
    
    $status	= '';
    $status 	.= ($row_masterCustomer["status"] == "0") ? "CANCEL" : "";
    $status	.= ($row_masterCustomer["status"] == "1") ? "ACTIVE" : "";
    $status	.= ($row_masterCustomer["status"] == "2") ? "NEW" : "";
    $status	.= ($row_masterCustomer["status"] == "3") ? "WAITING" : "";
    $status	.= ($row_masterCustomer["status"] == "4") ? "RESERV" : "";
    $status	.= ($row_masterCustomer["status"] == "5") ? "EXPIRED" : "";
    $status	.= ($row_masterCustomer["status"] == "6") ? "SUS-PAY" : "";
    $status	.= ($row_masterCustomer["status"] == "7") ? "SUS-LIT" : "";
    $status	.= ($row_masterCustomer["status"] == "8") ? "WAIT-PAY" : "";
    
    
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"],"Open Detail Customer Number ".$cust_number."");
    
    
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>
				
				
                                
                                <div class="box-body table-responsive">
				<table width="95%" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">	
	<tbody><tr>		
		<td valign="top" width="50%">
			<table width="100%" class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
			   <tbody><tr>
			   		<th colspan="2" bgcolor="#F5F5F5">
			   			ACCOUNT INFO			   		</th>	
			   </tr>
			   <tr height="20px">
					<td class="form_head">
						STATUS :
					</td>
					<td class="tableBodyRight" width="70%">
						PREPAID CARD 
					</td>
			   </tr>
			   <tr height="20px">
					<td class="form_head">
						ACCOUNT NUMBER :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["username"].'
					</td>
			   </tr>
			   <tr height="20px">
					<td class="form_head">
						SERIAL NUMBER :
					</td>
					<td class="tableBodyRight" width="70%">
					'.(($row_masterCustomer["serial"] == "") ? "0000000" : $row_masterCustomer["serial"]).'
						
					</td>
			   </tr>
			   <tr height="20px">
					<td class="form_head">
						WEB ALIAS :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["useralias"].'
					</td>
			   </tr>
			   <tr height="20px">
					<td class="form_head">
						WEB PASSWORD :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["uipass"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						LANGUAGE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["language"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						STATUS :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$status.'
					</td>
				</tr>
			   	<tr height="20px">	
					<td class="form_head">
						CREATION DATE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["creationdate"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						EXPIRATION DATE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["expirationdate"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						FIRST USE DATE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["firstusedate"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						LAST USE DATE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["lastuse"].'
					</td>
				</tr>
	  			<tr height="20px">
					<td class="form_head">
						CALLBACK :
					</td>
					<td class="tableBodyRight" width="70%">
						 
					</td>
				</tr>
	  			<tr height="20px">
					<td class="form_head">
						LOCK :
					</td>
					<td class="tableBodyRight" width="70%">
						'.($row_masterCustomer['block'] ? "LOCK" : "UNLOCK").'
					</td>
				</tr>
	  			<tr height="20px">
					<td class="form_head">
						LOCK PIN :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["lock_pin"].'
					</td>
				</tr>
	  			<tr height="20px">
					<td class="form_head">
						LOCK DATE :
					</td>
					<td class="tableBodyRight" width="70%">
						 '.$row_masterCustomer["lock_date"].'
					</td>
				</tr>
			 </tbody></table>
		</td>
	
		<td valign="top" width="50%">
			<table width="100%" class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
				<tbody><tr>
					<th colspan="2" bgcolor="#F5F5F5">
				 		CUSTOMER INFO				 	</th>
				 
				</tr>
				<tr height="20px">
					<td class="form_head">
						LAST NAME :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["lastname"].'
					</td>
					
					
				</tr>
				<tr height="20px">
					<td class="form_head">
						FIRST NAME :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["firstname"].'
					</td>
					
					
				
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						ADDRESS :
					</td>
					<td class="tableBodyRight" width="70%">
						&nbsp;'.$row_masterCustomer["address"].'
					</td>
					
					
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						ZIP CODE :
					</td>
					<td class="tableBodyRight" width="70%">
						&nbsp;'.$row_masterCustomer["zipcode"].'
					</td>
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						CITY :
					</td>
					<td class="tableBodyRight" width="70%">
						&nbsp;'.$row_masterCustomer["city"].'
					</td>
					
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						STATE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["state"].'
					</td>
					
					
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						COUNTRY :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["country"].' 
					</td>
					
				</tr>
				<tr height="20px">
					<td class="form_head">
						EMAIL :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["email"].'
					</td>
					
				</tr>
				<tr height="20px">
					<td class="form_head">
						PHONE :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["phone"].'
					</td>
				</tr>
				<tr height="20px">
					<td class="form_head">
						FAX :
					</td>
					<td class="tableBodyRight" width="70%">
						'.$row_masterCustomer["fax"].'
					</td>
				</tr>
			</tbody></table>
		</td>
	
	</tr>
</tbody></table>
<br />
<table width="95%" >	
	<tbody><tr>
		
		<td valign="top" width="50%">
			<table width="100%" class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">	
			   <tbody><tr>
			   		<th colspan="2"  bgcolor="#F5F5F5">
			   			ACCOUNT STATUS			   		</th>	
			   </tr>
			   <tr height="20px">
					<td class="form_head">
						BALANCE :
					</td>
					<td class="tableBodyRight"  width="70%">
						&nbsp;'.Nominal($row_masterCustomer["credit"]).'
					</td>
				</tr>
				<tr height="20px">
					<td class="form_head">
						CURRENCY :
					</td>
					<td class="tableBodyRight"  width="70%">
						'.$row_masterCustomer["country"].'
					</td>
			  	</tr>
			   <tr height="20px">
					<td class="form_head">
						CREDIT LIMIT :
					</td>
					<td class="tableBodyRight"  width="70%">
						 '.$row_masterCustomer["creditlimit"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						AUTOREFILL :
					</td>
					<td class="tableBodyRight"  width="70%">
						'.$row_masterCustomer["autorefill"].'
					</td>
				</tr>
			   	<tr height="20px">
					<td class="form_head">
						INVOICE DAY :
					</td>
					<td class="tableBodyRight"  width="70%">
						'.$row_masterCustomer["invoiceday"].'
					</td>
				</tr>
			 </tbody></table>
		</td>
		
		<td valign="top" width="50%">
			<table width="100%" class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
				<tbody><tr>
					<th colspan="2"  bgcolor="#F5F5F5">
				 		COMPANY INFO				 	</th>
				 
				</tr>
				<tr height="20px">
					<td class="form_head">
						COMPANY NAME :
					</td>
					<td class="tableBodyRight"  width="70%">
						&nbsp;'.$row_masterCustomer["company_name"].'
					</td>
				</tr>
				<tr height="20px">
					<td class="form_head">
						COMPANY WEBSITE :
					</td>
					<td class="tableBodyRight"  width="70%">
						&nbsp;'.$row_masterCustomer["company_website"].'
					</td>
				
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						VAT REGISTRATION NUMBER :
					</td>
					<td class="tableBodyRight"  width="70%">
						&nbsp; '.$row_masterCustomer["vat_rn"].'
					</td>
					
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						TRAFFIC PER MONTH :
					</td>
					<td class="tableBodyRight"  width="70%">
						&nbsp;'.$row_masterCustomer["traffic"].'
					</td>
				</tr>
				
				<tr height="20px">
					<td class="form_head">
						TARGET TRAFIC :
					</td>
					<td class="tableBodyRight"  width="70%">
						&nbsp; '.$row_masterCustomer["traffic_target"].'
					</td>
					
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>
<br />
<table width="95%">
	<tbody><tr>
	 <td valign="top" width="50%">
        	      <table width="100%" class="editform_table1" style="display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
		<tbody><tr>
		   <th colspan="2"  bgcolor="#F5F5F5">
					CALLER-ID LIST 		   </th>
		</tr>
                <tr class="form_head">
                   <td class="tableBody" width="15%" align="center" style="padding: 2px;">
                    			CID                   </td>
                   <td class="tableBody" width="20%" align="center" style="padding: 2px;">
                			ACTIVATED                   </td>
               </tr>
		   			<tr bgcolor="#fcfbfb">
				<td class="tableBodyRight" width="70%" align="center">
				  '.$row_masterCustomer["useralias"].'				</td>

				<td class="tableBodyRight" width="70%" align="center">
				'. (($row_callerid["activated"] == "t") ? "Active" : "Inactive").'
				 </td>
			</tr>
		   		</tbody></table>
				</td>

		<td valign="top" width="50%">
				</td>
	</tr>
</tbody></table>
	<hr>
				<div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                </div><!-- /.box-header -->
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th style="width: 1%;">#</th>
                                                <th style="width: 10%;">Call Date</th>
                                                <th style="width: 10%;">Called Number</th>
                                                <th style="width: 10%;">Destination</th>
                                                <th style="width: 10%;">Duration</th>
                                                <th style="width: 10%;">Terminate Cause</th>
						<th style="width: 10%;">Buy</th>
						<th style="width: 10%;">Sell</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					


    $sql_callhistory = mysql_query("SELECT * FROM `cc_call` WHERE `card_id` = '$id_cust' ORDER BY `starttime` DESC LIMIT 0,10  ;",$conn_voip);
    
$no = 1;
while ($row_callhistory = mysql_fetch_array($sql_callhistory)){
    
    $sql_country = mysql_query("SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '$row_callhistory[destination]'",$conn_voip);
    $row_country = mysql_fetch_array($sql_country);
    //echo "SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '$row_callhistory[destination]'";
    
    if($row_callhistory["destination"] == "628"){
	$destination = "Indonesian Mobile";
    }else{
	$destination = $row_country["countryname"];
    }
	$tc  	  = '';
	$tc	 .= ($row_callhistory["terminatecauseid"]=="1") ? 'ANSWER' : '';
	$tc	 .= ($row_callhistory["terminatecauseid"]=="2") ? '2' : '';
	$tc	 .= ($row_callhistory["terminatecauseid"]=="3") ? '3' : '';
	$tc	 .= ($row_callhistory["terminatecauseid"]=="4") ? 'Cancel' : '';
		    
    
    //echo "SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."'";
    $content .= '<tr>
		    <td align="center">'.$no.'.</td>
		    <td align="center">'.$row_callhistory["starttime"].'</td>
		    <td align="center">'.$row_callhistory["calledstation"].'</td>
		    <td align="center">'.$destination.'</td>
		    <td align="center">'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
		    <td align="center">'.$tc.'</td>
		    <td align="center">'.number_format($row_callhistory["buycost"], 2, ',', '.').' IDR</td>
		    <td align="center"> '.number_format($row_callhistory["sessionbill"], 2, ',', '.').' IDR </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    <div align="right">
				    <a href="list_customer.php" class="btn bg-navy btn-flat margin" >list Customers</a>
				    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<style>
	    .editform_table1 {
	    border-right: 0px;
	    padding-right: 3px;
	    border-top: 0px;
	    padding-left: 3px;
	    padding-bottom: 3px;
	    border-left: 0px;
	    width: 95%;
	    padding-top: 3px;
	    border-bottom: 0px;
	    background-color: #eaeaea;
	    margin-left: auto;
	    margin-right: auto;
	    }
	    .form_head {
	    font-family: Arial, Helvetica, sans-serif;
	    font-weight: bold;
	    text-transform: uppercase;
	    color: #FFFFFF;
	    background-color: #666666;
	    width: auto;
	    }
	    .tableBodyRight {
	    PADDING-BOTTOM: 4px;
	    PADDING-LEFT: 4px;
	    PADDING-RIGHT: 4px;
	    PADDING-TOP: 4px;
	    background-color: #F5F5F5;
	    }
	    th {
text-align: -webkit-center;
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

    $title	= 'List Customer';
    $submenu	= "voip";
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