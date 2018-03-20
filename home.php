<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration_user.php");

redirectToHTTPS();

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Dashboard");
    
    global $conn;
    
	$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	$sql_customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$loggedin["customer_number"]."' LIMIT 0,1;", $conn);
	$row_customer = mysql_fetch_array($sql_customer);
	
	include("config/".$row_voip["voip_config"]);
	global $conn_voip;
	
    $content ='<!-- Main content -->
                <section class="content">
				<!--<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Info Tagihan </h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Anda tidak mempunyai tagihan <br>
									or
									<div class="box-body no-padding">
                                    <table class="table" width="70%">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Paket</th>
                                            <th>Bulan</th>
					    <th>Tagihan</th>
                                            <th style="width: 120px"> </th>
					    <th style="width: 120px"> </th>
                                        </tr>';
					
$sql_tipe = mysql_query("SELECT * FROM `gx_tipe`", $conn);
$no = 1;

while ($row_tipe = mysql_fetch_array($sql_tipe))
{
    if($row_tipe["id_type"] == 1)
    {
		$sql_ = "`tbCustomer`.`paket_voip` = `gx_paket2`.`id_paket` AND ";
		$url_ = URL."voip/paket.php";
    }elseif($row_tipe["id_type"] == 2)
    {
		$sql_ = "`tbCustomer`.`paket_data` = `gx_paket2`.`id_paket` AND ";
		$url_ = URL."data/paket.php";
    }elseif($row_tipe["id_type"] == 3)
    {
		$sql_ = "`tbCustomer`.`paket_video` = `gx_paket2`.`id_paket` AND ";
		$url_ = URL."vod/paket.php";
    }else{
		$sql_ = "";
		$url_ = "";
    }
    
    //$sql_paket = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
	//		     WHERE $sql_ `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
    //$row_paket = mysql_fetch_array($sql_paket);
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="'.$url_.'">'.$row_tipe["nama_type"].'</a></td>
		    <td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>';
    /*$content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="'.$url_.'">'.$row_tipe["nama_type"].'</a></td>
		    <td>'.$row_paket["nama_paket"].'</td>
		    <td>'.Rupiah($row_paket["harga_paket"]).'</td>
		    <td><a href="voip/invoice.php"><span>View Invoices</span></a></td>
		    <td><a href="voip/payment_history.php"><span>Payment History</span></a></td>
		</tr>';*/
    $no++;
}


// DATA INTERNET
/*$sql_paket_data = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_data` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_data = mysql_fetch_array($sql_paket_data);*/
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [dbo].[Users], [dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$loggedin["user_index"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();


//DATA VOIP
/*
$sql_paket_voip = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);*/



$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$sql_cust_voip_total = mysql_num_rows($sql_cust_voip);
$sql_cardid ="";
$status_voip ='';

if ($sql_cust_voip_total < 1)
{
	$status_voip .='<div class="box box-solid box-danger">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-phone-square"></i>  Status Voip/Telepon</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
					<div class="box-body"  style="min-height:200px;">
						<div style="font-size:20px;">Status <span class="label label-danger">Not Active</span></div><br>
						
					</div><!-- /.box-body -->
								</div><!-- /.box -->';
}
else
{
	while($row_cust_voip = mysql_fetch_array($sql_cust_voip))
	{
		$sql_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
		$row_voip = mysql_fetch_array($sql_voip);
		$view_id = $row_voip["id"];
		$sql_cardid .= " `card_id` = '".$view_id."' OR";
		
		$sql_saldo = mysql_query("SELECT `credit`, `useralias`, `expirationdate`, `status` FROM `cc_card` WHERE `useralias`  LIKE '%".$row_cust_voip["nomer_telpon"]."%' LIMIT 0,1;", $conn_voip);
		$row_saldo = mysql_fetch_array($sql_saldo);
		
		$status_voip .='<div class="box box-solid box-danger">
						<div class="box-header" >
							<h3 class="box-title"><i class="fa fa-phone-square"></i>  Status Voip/Telepon</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
					<div class="box-body"  style="min-height:200px;">
						<div style="font-size:20px;">Status  '.(($row_saldo["status"] == "1") ? '<span class="label label-success">'.ucfirst( StatusVOIP($row_saldo["status"])).'</span>' : '<span class="label label-danger">'.ucfirst(StatusVOIP($row_saldo["status"])).'</span>').'</div><br>
						
						Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
						Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
						Nama Paket :  <b>Abonemen</b><br>
						Expired Paket:  <b>'.date("d F Y", strtotime($row_saldo["expirationdate"])).'</b><br>
						Monthly fee:  <b>Rp 60.000,00</b><br><br>
						
						<br><br>
					</div><!-- /.box-body -->
								</div><!-- /.box -->';
		
	}

}


$sql_cardid = substr($sql_cardid, 0, -2);

$query_callhistory = "SELECT t1.starttime, t1.src, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 
                    AND `starttime`
					AND ($sql_cardid)
		    ORDER BY `starttime` DESC
		    LIMIT 0,4;";

$sql_callhistory = mysql_query($query_callhistory, $conn_voip);


	include("config/configuration_tv.php");
	$conn_tv   = DB_TV();
	
	//DATA TV
	
$sql_paket_tv = mysql_query("SELECT `gx_tv_customer`.* FROM `gx_tv_customer` WHERE `gx_tv_customer`.`id_customer` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_tv = mysql_fetch_array($sql_paket_tv);

$sql_data_tv	= mysqli_query($conn_tv,"SELECT `boss`.`t_account_cms`.* FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$row_paket_tv["id_stb"]."';");
$row_data_tv	= mysqli_fetch_array($sql_data_tv);
	
//$sql_tv_paket = mysql_query("SELECT * FROM `t_product` WHERE `id` = '".$row_paket_tv["id_paket"]."';", $conn_tv);
//$row_tv_paket = mysql_fetch_array($sql_tv_paket);
	

//DATA VIDEO
/*$sql_paket_video = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_video` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_video = mysql_fetch_array($sql_paket_video);

<div class="box-body">
				    <div style="font-size:20px;">Status  '.(($row_paket_voip["level"] == "0") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				    Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
                                    Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
				    Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
				    Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
				    
				    <br><br>
                                </div><!-- /.box-body -->*/

$content .='                                        
                                    </table>
                                </div>
                                </div>
                            </div>-->
                    
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-4 connectedSortable">                            
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>  Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body"  style="min-height:200px;">
                                    <div style="font-size:20px;">Status  '.StatusCustomer($row_customer["gx_status"]).'</div><br>
				    
				    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
				    Periode: <b>'.(($row_paket_data["UserActive"] == "1") ? "3 ".(date("M Y", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"))))." - "."3 ".(date("M Y", mktime(date("H"), date("i"), date("s"), (date("m")+1), date("d"), date("Y")))) : "Expire Date").'</b><br>
					Penyebab dari Status Customer: <br>
				    <br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><a href="data/invoice">Invoice</a></h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th width="28">#</th>
                                            <th width="100" class="lrborder">Invoice Number</th>
                                            <th width="80" class="lrborder">Invoice Date</th>
                                            <th width="100" class="calign">Total</th>
                                            <th width="60" class="lrborder">Status</th>
                                        </tr>';
                                        
									$sql_data		= mysql_query("SELECT * FROM `gx_invoice` WHERE `customer_number` = '".$loggedin["customer_number"]."' AND `level` =  '0' ORDER BY `id_invoice` DESC LIMIT 0,5;", $conn);
								
									$no = 1;
									while($row_data = mysql_fetch_array($sql_data))
									{
										$sql_total  = mysql_query("SELECT SUM(harga) AS total FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_data["kode_invoice"]."'", $conn);
										$row_total  = mysql_fetch_array($sql_total);    
										$content .='
										<tr>
											<td>'.$no.'.</td>
											<td><a href="'.URL.'data/detail_invoice?id='.$row_data["id_invoice"].'"
											onclick="return valideopenerform(\'data/detail_invoice.php?id='.$row_data["id_invoice"].'\',\'invoice\');">
											'.$row_data["kode_invoice"].'</a></td>
											<td>'.date("d-m-Y", strtotime($row_data["tanggal_tagihan"])).'</td>
											<td>'.number_format($row_total["total"], 2, ',', '.').'</td>
											<td>'.StatusInvoice($row_data["paid_status"]).'
											
											<a href="" title="send email" data-toggle="modal" data-invoice="'.$row_data["id_invoice"].'" data-custnumber="'.$row_data["customer_number"].'"
											data-target="#myModal"><span class="label label-info">Send Email</span></a>
											
											
											</td>
											
										</tr>';
										$no++;
									}
									
									$content .='
									</table>
									
									
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List Complaint History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><a href="data/complaint">Complaint History</a></h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Ticket</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>';
                                        
									$sql_data_complaint		= mysql_query("SELECT * FROM `gx_helpdesk_complaint`
																		  WHERE `cust_number` = '".$loggedin["customer_number"]."'
																		  AND (`problem_select` != 'IPTV issue' OR `problem_select` != 'Telephony issue')
																		  AND `level` =  '0' ORDER BY `id_complaint` DESC LIMIT 0,5;", $conn);
								
									$no = 1;
									while($row_data_complaint = mysql_fetch_array($sql_data_complaint))
									{
										$content .='
										<tr>
											<td>'.$no.'.</td>
											<td><a href="detail_incoming.php?id_complaint='.$row_data_complaint["id_complaint"].'"
											onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$row_data_complaint["id_complaint"].'\',\'complaint\');">
											'. $row_data_complaint["ticket_number"].'</a></td>
											<td>'.date("d-m-Y", strtotime($row_data_complaint["date_add"])).'</td>
											<td>'.($row_data_complaint["status"]).'</td>
											
										</tr>';
										$no++;
									}
									
									$content .='
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->
                        
                        <section class="col-lg-4 connectedSortable">
			    '.$status_voip.'
			    
                            
							<!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><a href="voip/call_history.php">Call History</a></h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Destination</th>
                                            <th>Duration</th>
                                            <th>Rate</th>
                                        </tr>';
$no = 1;
while ($row_callhistory = mysql_fetch_array($sql_callhistory)){
    
$content .='
<tr> 
    <td>'.$no.'</td>
    <td>'.$row_callhistory["calledstation"].'</td>
    <td>'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
    <td>'.Rupiah((int)$row_callhistory["sessionbill"]).'</td>
</tr>
';
$no++;
}
$content .='
                                        
					
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<!-- List Complaint History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><a href="data/complaint">Complaint History</a></h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Ticket</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>';
                                        
									$sql_data_complaint		= mysql_query("SELECT * FROM `gx_helpdesk_complaint`
																		  WHERE `cust_number` = '".$loggedin["customer_number"]."'
																		  AND `problem_select` = 'Telephony issue'
																		  AND `level` =  '0' ORDER BY `id_complaint` DESC LIMIT 0,5;", $conn);
								
									$no = 1;
									while($row_data_complaint = mysql_fetch_array($sql_data_complaint))
									{
										$content .='
										<tr>
											<td>'.$no.'.</td>
											<td><a href="detail_incoming.php?id_complaint='.$row_data_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint=26117\',\'complaint\');">
											'.$row_data_complaint["ticket_number"].'</a></td>
											<td>'.date("d-m-Y", strtotime($row_data_complaint["date_add"])).'</td>
											<td>'.($row_data_complaint["status"]).'</td>
											
										</tr>';
										$no++;
									}
									
									$content .='
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- right col -->
			
			<section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-laptop"></i>  Status TV</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-warning btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body" style="min-height:200px;">';
                                    $status_vod = $row_data_tv["STATUS"];
				    $content .= '<div style="font-size:20px;">Status  '.(($status_vod == "1") ? "<span class=\"label label-success\">ACTIVE</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				   
				    <!--Id User : <b>'.$row_data_tv["CLIENTID"].'</b><br>-->
				    Expired Date: '.(($row_data_tv["ENDDATE"]== "") ? '<b>-</b>' :'<b>'.date("d F Y", strtotime($row_data_tv["ENDDATE"])).'</b>') .'<br>
				    Saldo : <b>'.Rupiah((int)$row_data_tv["BALANCE"]).'</b><br>
				    Nama STB :  <b>'.$row_data_tv["CLIENTCODE"].'</b><br>
				    <!--Sewa STB:  <b>Rp 40.000,00</b><br><br><br><br><br>-->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
							
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><a href="tv/list_logbeli">History Pembelian</a></h3>
				    <div class="box-tools">
                                        
                                    </div>
                                </div><!-- /.box-header -->
								
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
											<th>No</th>
                                            <th>Title</th>
                                            <th>Date</th>
					    <th></th>
                                        </tr>';
										
	$sql_data_logtv		= mysqli_query($conn_tv, "SELECT * FROM `boss`.`t_consumerecord`, `boss`.`t_account_cms`
								   WHERE `boss`.`t_consumerecord`.`CLIENTID` = `boss`.`t_account_cms`.`CLIENTID`
								   AND `boss`.`t_consumerecord`.`CLIENTID` = '".$row_paket_tv["id_stb"]."'
								   ORDER BY `boss`.`t_consumerecord`.`RECORDID` DESC LIMIT 0,5;");

    while($row_data_logtv = mysqli_fetch_array($sql_data_logtv))
    {
		
		$content .='<tr>
				<td>'.$no.'.</td>
				<td>'.$row_data_logtv["PRODUCTNAME"].'</td>
				<td>'.$row_data_logtv["VALIDDATE"].'</td>				
				<td></td>
			</tr>';
		$no++;
    }
$content .=' 
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<!-- List Complaint History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><a href="data/complaint">Complaint History</a></h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Ticket</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>';
                                        
									$sql_data_complaint		= mysql_query("SELECT * FROM `gx_helpdesk_complaint`
																		  WHERE `cust_number` = '".$loggedin["customer_number"]."'
																		  AND `problem_select` = 'IPTV issue'
																		  AND `level` =  '0' ORDER BY `id_complaint` DESC LIMIT 0,5;", $conn);
								
									$no = 1;
									while($row_data_complaint = mysql_fetch_array($sql_data_complaint))
									{
										$content .='
										<tr>
											<td>'.$no.'.</td>
											<td><a href="detail_incoming.php?id_complaint='.$row_data_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint=26117\',\'complaint\');">
											'. $row_data_complaint["ticket_number"].'</a></td>
											<td>'.date("d-m-Y", strtotime($row_data_complaint["date_add"])).'</td>
											<td>'.($row_data_complaint["status"]).'</td>
											
										</tr>';
										$no++;
									}
									
									$content .='
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Email Invoice</h4>
      </div>
      <div class="modal-body">
		<form>
          <div class="form-group" hidden>
            <label for="recipient-name" class="control-label">Invoice:</label>
            <input type="text" class="form-control" id="invoice">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Customer Number:</label>
            <input type="text" class="form-control" id="custnumber">
          </div>
          
		  <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>

            ';

/*
 *<!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
*/
$plugins = '<script>
$(\'#myModal\').on(\'show.bs.modal\', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var invoice = button.data(\'invoice\') // Extract info from data-* attributes
  var custnumber = button.data(\'custnumber\') // Extract info from data-* attributes
  var modal = $(this)
  
  modal.find(\'.modal-body input#invoice\').val(invoice)
  modal.find(\'.modal-body input#custnumber\').val(custnumber)
})

</script>';

    $title	= 'Home';
    $submenu	= "Dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>