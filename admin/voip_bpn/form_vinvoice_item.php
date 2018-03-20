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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $id_invoice	= isset($_POST['id_invoice']) ? mysql_real_escape_string(trim($_POST['id_invoice'])) : '';
    $date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $price	= isset($_POST['price']) ? mysql_real_escape_string(trim($_POST['price'])) : '';
    $vat	= isset($_POST['vat']) ? mysql_real_escape_string(trim($_POST['vat'])) : '';
    $description= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $return_url	= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_invoice_item` (`id`, `id_invoice`, `date`,
    `price`, `VAT`, `description`, `id_ext`, `type_ext`)
    VALUES (NULL, '".$id_invoice."', '".$date."', '".$price."', '".$vat."', '".$description."', NULL, NULL);";
    
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW INVOICE ITEM CREATED', 'User added a new record in database',
    'id_invoice = ".$id_invoice."| date =  ".$date."| price =  ".$price."| vat =  ".$vat."| description =  ".$description."| Web Software GX (".$loggedin["username"].")',
    'cc_invoice_item', 'form_vinvoice_item.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    echo mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/".$return_url."';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_invoice	= isset($_POST['id_invoice']) ? mysql_real_escape_string(trim($_POST['id_invoice'])) : '';
    $date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $price	= isset($_POST['price']) ? mysql_real_escape_string(trim($_POST['price'])) : '';
    $vat	= isset($_POST['vat']) ? mysql_real_escape_string(trim($_POST['vat'])) : '';
    $description= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $return_url	= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_invoice_item` SET `id_invoice`='".$id_invoice."',
    `date`='".$date."', `price`='".$price."', `VAT`='".$vat."', `description`='".$description."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A INVOICE ITEM UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'id_invoice = ".$id_invoice." |description = ".$description." |price = ".$price." | date = ".$date." | vat = ".$vat." | Web Software GX (".$loggedin["username"].")',
    'cc_invoice_item', 'form_vinvoice_item.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/".$return_url."';
	</script>";
	
}

if(isset($_GET["id_invoice"]))
{
    $id_invoice		= isset($_GET['id_invoice']) ? $_GET['id_invoice'] : '';
    $query_invoice 	= "SELECT `cc_invoice`.* , `cc_card`.`firstname`, `cc_card`.`lastname`, `cc_card`.`username`,
			`cc_card`.`useralias`
			FROM `cc_invoice`, `cc_card`
			WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
			AND `cc_invoice`.`id` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn_voip);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
    $id			= isset($_GET['id']) ? $_GET['id'] : '';
    $query_invoice2	= "SELECT * FROM `cc_invoice_item` WHERE `id` ='".$id."' LIMIT 0,1;";
    $sql_invoice2	= mysql_query($query_invoice2, $conn_voip);
    $row_invoice2	= mysql_fetch_array($sql_invoice2);
    
    $return_url = 'form_vinvoice_item.php?id_invoice='.$id_invoice;
    
}


    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        
                                        <table style="width:100%;">
					<tbody>
					    <tr class="form_invoice_head">
						<td width="75%">INVOICE: <b>'.(isset($_GET['id_invoice']) ? $row_invoice["title"] : '').'</b></font></td>
						<td width="25%">REF: <font color="#EE6564"> '.(isset($_GET['id_invoice']) ? $row_invoice["reference"] : '').'</font></td>
					    </tr>
					    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
					    <tr>
						<td><font style="font-weight:bold; ">FOR : </font>   '.(isset($_GET['id_invoice']) ? $row_invoice["firstname"].' '.$row_invoice["lastname"].'('.$row_invoice["username"].')' : '').'</td>
						<td><font style="font-weight:bold; ">DATE : </font>   '.(isset($_GET['id_invoice']) ? $row_invoice["date"] : '').'</td>
					    </tr>
					    <tr>
						<td><font style="font-weight:bold;">STATUS : </font> <font style="color:#5FA631;">  '.((isset($_GET['id_invoice']) AND $row_invoice["status"] == "1") ? 'Close' : 'Open').'</font></td>
					    </tr>
					    <tr>
						<td colspan="2"><font style="font-weight:bold;">PAID STATUS : </font> <font style="color:#EE6564;"> '.((isset($_GET['id_invoice']) AND $row_invoice["paid_status"] == "1") ? 'Paid' : 'Unpaid').' </font></td>
					    </tr>
					    <tr>
						<td colspan="2">
						<br>
						<font style="font-weight:bold; ">DESCRIPTION : </font>  <br> '.(isset($_GET['id_invoice']) ? $row_invoice["description"] : '').'</td>
					    </tr>
					    <tr>
						<td colspan="2">&nbsp;</td>
					    </tr>
					    <tr>
						<td colspan="2">
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th width="10%">
								  No.
							      </th>
							      <th width="17%">
								  Date
							      </th>
							      <th width="35%">
								    Description
							      </th>
							      <th align="right" width="17%">
								    PRICE
							      </th>
							      <th align="right" width="10%">
								    VAT
							      </th>
							       <th align="right" width="17%">
								    PRICE INCL. VAT
							      </th>
							      <th width="10%">
							      #
							      </th>
							    </tr>';
if(isset($_GET["id_invoice"]))
{
    $id_invoice		= isset($_GET['id_invoice']) ? $_GET['id_invoice'] : '';
    $query_invoice_item	= "SELECT * FROM `cc_invoice_item` WHERE `id_invoice` ='".$id_invoice."';";
    $sql_invoice_item	= mysql_query($query_invoice_item, $conn_voip);
    
    $no = 1;
    $total_price = 0;
    $total_vat = 0;
    $total_price_vat = 0;
    
    while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
	<td>'.$row_invoice_item["description"].'</td>
	<td>'.$row_invoice_item["price"].'</td>
	<td>'.$row_invoice_item["VAT"].'</td>
	<td>'.($row_invoice_item["price"] + $row_invoice_item["VAT"]).'</td>
	<td><a href="form_vinvoice_item?id_invoice='.$row_invoice_item["id_invoice"].'&id='.$row_invoice_item["id"].'"><span class="label label-info">Edit</span></a></td>
	</tr>';
	$no++;
	$total_price = $total_price + $row_invoice_item["price"];
	$total_vat = $total_vat + $row_invoice_item["VAT"];
	$total_price_vat = $total_price_vat + ($row_invoice_item["price"] + $row_invoice_item["VAT"]);
	
    }
}else{
    
    $total_price = 0;
    $total_vat = 0;
    $total_price_vat = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='							    <tr>
							    <td colspan="3">
								    &nbsp;
							    </td>
							    <td colspan="2" align="right">
								    TOTAL EXCL. VAT&nbsp;:
							    </td>
							    <td colspan="2" align="right">
								    '.number_format($total_price, 2, ',', '.').' IDR
							    </td>
						    </tr>
								    <tr>
							    <td colspan="3">
								    &nbsp;
							    </td>
							    <td colspan="2" align="right">
								    TOTAL INCL. VAT&nbsp;:
							    </td>
							    <td colspan="2" align="right">
								    '.number_format($total_price_vat, 2, ',', '.').' IDR
							    </td>
							    
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM INVOICE ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_invoice_item" id="form_invoice_item" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="date" id="date" value="'.(isset($_GET['id']) ? $row_invoice2["date"] : date("Y-m-d H:i:s")).'">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_invoice2["id"] : '').'" readonly="">
						<input type="hidden" name="id_invoice" value="'.(isset($_GET['id_invoice']) ? $row_invoice["id"] : '').'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Amount</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="price" id="price" value="'.(isset($_GET['id']) ? $row_invoice2["price"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>VAT</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="vat" id="vat" value="'.(isset($_GET['id']) ? $row_invoice2["VAT"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Description</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="description" style="resize:none;">'.(isset($_GET['id']) ? $row_invoice2["description"] : "").'</textarea>
					    </div>
					    
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Invoice Item';
    $submenu	= "voip_invoice";
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