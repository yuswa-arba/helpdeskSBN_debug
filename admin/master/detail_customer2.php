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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;
    
    $id_customer = isset($_GET["id"]) ? strip_tags($_GET["id"]) : "";
    $sql_profile = mysql_query("SELECT `tbCustomer`.*, `gxLogin`.`id_voip`,`gxLogin`.`id_vod`
							   FROM `tbCustomer`,`gxLogin`
							   WHERE `tbCustomer`.`cKode` = `gxLogin`.`customer_number`
							   AND `tbCustomer`.`cKode` = '".$id_customer."' LIMIT 0,1;", $conn);
    $row_profile = mysql_fetch_array($sql_profile);
    
    
    
// DATA INTERNET
/*$sql_paket_data = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_data` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_data = mysql_fetch_array($sql_paket_data);*/
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [dbo].[Users], [dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$row_profile["iuserIndex"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();


//DATA VOIP
$sql_paket_voip = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$row_profile["cKode"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);
$sql_saldo = mysql_query("SELECT `credit`, `useralias` FROM `cc_card` WHERE `useralias` = '".$row_profile["id_voip"]."' LIMIT 0,1;", $conn_voip);
$row_saldo = mysql_fetch_array($sql_saldo);


$sql_cust_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` = '".$row_profile["id_voip"]."'", $conn_voip);
$row_cust_voip = mysql_fetch_array($sql_cust_voip);

$view_id = $row_cust_voip["id"];

$query_callhistory = "SELECT t1.starttime, t1.src, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `card_id` = '$view_id'
                    AND `starttime`
		    ORDER BY `starttime` DESC
		    LIMIT 0,4";

$sql_callhistory = mysql_query($query_callhistory, $conn_voip);


//DATA VIDEO
$sql_paket_video = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_video` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$row_profile["cKode"]."';", $conn);
$row_paket_video = mysql_fetch_array($sql_paket_video);
   
    
    
    $content ='<section class="content-header">
                    <h1>
                        Customer
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="customer">Customer</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-7 connectedSortable"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Customer</h3>
                                </div><!-- /.box-header -->
				
				<div class="box-body">
				    <section class="content no-padding">
				    <div class="col-5 no-padding">

					    <img src="../img/avatar2.png" class="img-square" alt="User Image" />
				    </div>
				    <div class="col-7 no-padding">
					<table class="table no-border" width="70%">
					    <tr>
						<td>Nama </td>
						<td>'.$row_profile["cNama"].'</td>
					    </tr>
					    <tr>
						<td>Alamat</td>
						<td>'.$row_profile["cAlamat1"].'</td>
					    </tr>
					    <tr>
						<td>No. Telpon</td>
						<td>'.$row_profile["ctelp"].'</td>
					    </tr>
					    <tr>
						<td>Email</td>
						<td>'.str_replace(";", "<br>", $row_profile["cEmail"]).'</td>
					    </tr>
					    <tr>
						<td>Lat, Long</td>
						<td>'. (($row_profile["cLati"] !="") ? '<a href="maps.php?id='.$row_profile["cKode"].'"
						onclick="return valideopenerform(\'maps.php?id='.$row_profile["cKode"].'\',\'maps'.$row_profile["idCustomer"].'\');">
						-'.DMStoGPS($row_profile["cLati"]).','.DMStoGPS($row_profile["cLongi"]).'</a>' : "-").'</td>
					    </tr>
					</table>
				    </div>
				    </section>
				</div>
				<div class="box-footer">
				</div>
				
                            </div><!-- /.box -->
                        </section>
			<section class="col-lg-5 connectedSortable"> 
                            <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Data/Internet</h3>
                                </div><!-- /.box-header -->
				<div class="box-body">
                                    Tes data body
                                </div><!-- /.box-header -->
				<div class="box-body">
                                <div style="font-size:20px;">Status  '.(($row_paket_data["UserActive"] == "1") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
				    Periode: <b>'.(($row_paket_data["UserActive"] == "1") ? "3-".(date("M-Y", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"))))." - "."3-".(date("M-Y", mktime(date("H"), date("i"), date("s"), (date("m")+1), date("d"), date("Y")))) : "Expire Date").'</b><br>
				    <br><br><br>
                                </div>
                            </div><!-- /.box -->
			    <div class="box  box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">VOIP</h3>
                                </div><!-- /.box-header -->
				<div class="box-body">
				    <div style="font-size:20px;">Status  '.(($row_paket_voip["level"] == "0") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				    Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
                                    Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
				    Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
				    Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
				    
				    <br><br>
                                </div>
                            </div><!-- /.box -->
			    <div class="box  box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Video</h3>
                                </div><!-- /.box-header -->
				 <div class="box-body">';
                                    $status_vod = 'OFF';
				    $content .= '<div style="font-size:20px;">Status  '.(($status_vod != "OFF") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				   <br><br>
				    
				    <button class="btn btn-default"  title="sign up" onclick="window.location.href=\'vod/paket.php\'">Sign up</button>
					<br><br><br><br><br>
                                </div>
                            </div><!-- /.box -->
			    <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Complaint</h3>
                                </div><!-- /.box-header -->
                            </div><!-- /.box -->
                        </section>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
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

    $title	= 'Master Customer';
    $submenu	= "customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>