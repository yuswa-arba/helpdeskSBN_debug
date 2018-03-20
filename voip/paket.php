<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_user.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    enableLog($loggedin["id_user"], $loggedin["username"], "", "Open menu paket");
    
    global $conn;
    $sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	include("../config/".$row_voip["voip_config"]);
	global $conn_voip;

$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$row_cust_voip = mysql_fetch_array($sql_cust_voip);
$sql_cust = mysql_query("SELECT * FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
$row_cust = mysql_fetch_array($sql_cust);

//DATA VOIP
$sql_paket_voip = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);
$sql_saldo = mysql_query("SELECT `credit`, `useralias`, `expirationdate`, `status` FROM `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%' LIMIT 0,1;", $conn_voip);
$row_saldo = mysql_fetch_array($sql_saldo);


//edit date 2-2-2015
//Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
//Status : '.(($row_paket_voip["level"] == "0") ? "Aktif" : "Nonaktif").'<br><br>

    $content ='<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
		    <!-- Main row -->
		    <div class="row">
			<section class="col-lg-6">
			<div class="box box-solid box-danger">
			    <div class="box-header">
				<h3 class="box-title">Current Status Voip/Telepon</h3>
				<div class="box-tools pull-right">
				    <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				    <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			    </div>
			    <div class="box-body">
				<div style="font-size:20px;">Status  '.(($row_saldo["status"] == "1") ? '<span class="label label-success">'.ucfirst( StatusVOIP($row_saldo["status"])).'</span>' : '<span class="label label-danger">'.ucfirst(StatusVOIP($row_saldo["status"])).'</span>').'</div><br>
				
				Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
				Nama Paket :  <b>'.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'</b><br>
				Expired Paket:  <b>'.date("d-m-Y H:i", strtotime($row_saldo["expirationdate"])).'</b><br>
				Monthly fee:  <b>'.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'</b><br><br>
				
				<br><br>
			    </div><!-- /.box-body -->
			</div><!-- /.box -->
			</section>
			<section class="col-lg-6">
			<div class="box box-solid box-info">
                                
                                <div class="box-body">
                                    <img src="'.URL.'img/voip/promo_voip.jpg">
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
		    </div>
                    <!--<div class="row">';
		    
$sql_list_paket = mysql_query("SELECT * FROM gx_paket, gx_tipe
			    WHERE gx_paket.id_type = gx_tipe.id_type
			    AND gx_paket.id_type = '1';", $conn);
$no = 0;
while($row_list_paket = mysql_fetch_array($sql_list_paket))
{
    
    $content .='
			<section class="col-lg-4">                            
			    <div class="box box-solid '.boxColor($no).'">
                                <div class="box-header">
                                    <h3 class="box-title">'.$row_list_paket["nama_paket"].'</h3>
                                </div>
                                <div class="box-body">
                                    
				    Masa Aktif : '.$row_list_paket["periode_paket"].' Hari<br>
				    Harga Paket : '.Rupiah($row_list_paket["harga_paket"]).'<br><br>
				    Dengan rincian sbb:<br>
				    Abonemen : '.Rupiah($row_list_paket["abonemen_paket"]).'<br>
				    Saldo/pulsa : '.Rupiah($row_list_paket["pulsa_paket"]).'<br><br><br><br><br>
				    <a href=""><span class="label label-warning">Beli Paket</span></a>
                                </div>
                            </div>
                        </section>
			';
			$no++;
			/*<section class="col-lg-4">                            
			    <div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Monthly Xtreme</h3>
                                </div>
                                <div class="box-body">
                                    
				    Masa Aktif : 1 Bulan<br>
				    Harga Paket : Rp. 150.000,00<br><br>
				    Dengan rincian sbb:<br>
				    Abonemen : Rp. 60.000,00<br>
				    Saldo/pulsa : Rp. 90.000,00<br><br><br><br><br>
				    <a href=""><span class="label label-warning">Beli Paket</span></a>
                                </div>
                            </div>
                        </section>
			<section class="col-lg-4">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Monthly Regular</h3>
                                </div>
                                <div class="box-body">
                                    
				    Masa Aktif : 1 Bulan<br>
				    Harga Paket : Rp. 100.000,00<br><br>
				    Dengan rincian sbb:<br>
				    Abonemen : Rp. 60.000,00<br>
				    Saldo/pulsa : Rp. 40.000,00<br><br><br><br><br>
				    <a href=""><span class="label label-warning">Beli Paket</span></a>
                                </div>
                            </div>
                        </section>';*/
		    }
$content .='                    </div>-->

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Paket VOIP';
    $submenu	= "paket_voip";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"red");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>