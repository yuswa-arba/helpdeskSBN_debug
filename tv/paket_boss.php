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
include("../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    enableLog($loggedin["id_user"], $loggedin["username"], "", "Open menu paket");
    
    global $conn;
    $sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);


$conn_tv   = DB_TV();

	//DATA TV
$sql_paket_tv = mysql_query("SELECT `gx_tv_customer`.* FROM `gx_tv_customer` WHERE `gx_tv_customer`.`id_customer` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_tv = mysql_fetch_array($sql_paket_tv);

$sql_data_tv	= mysqli_query($conn_tv,"SELECT `boss`.`t_account_cms`.* FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$row_paket_tv["id_stb"]."';");
$row_data_tv	= mysqli_fetch_array($sql_data_tv);

$sql_data_paket_tv	= mysqli_query($conn_tv,"SELECT `boss`.`t_product`.* FROM `boss`.`t_product` WHERE `id` = '".$row_paket_tv["id_paket"]."';");
$row_data_paket_tv	= mysqli_fetch_array($sql_data_paket_tv);
//echo "SELECT `boss`.`t_product`.* FROM `boss`.`t_product` WHERE `id` = '".$row_paket_tv["id_paket"]."'; ".$row_data_paket_tv["productname"];
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
				<h3 class="box-title">Current Status TV Packages</h3>
				<div class="box-tools pull-right">
				    <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				    <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			    </div>
			    <div class="box-body">
				<div style="font-size:20px;">Status  '.(($row_data_tv["STATUS"] == "1") ? '<span class="label label-success">ACTIVE</span>' : '<span class="label label-danger">Not Active</span>').'</div><br>
				
				
				Nama Paket :  <b>'.$row_data_paket_tv["productname"].'</b><br>
				Expired Paket:  <b>'.(($row_data_tv["ENDDATE"]== "") ? '<b>-</b>' :'<b>'.date("d F Y", strtotime($row_data_tv["ENDDATE"])).'</b>') .'</b><br>
				Sewa STB:  <b>Rp 40.000,00</b><br><br>
				
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
                    <div class="row">';
		    
$sql_list_paket = mysqli_query($conn_tv ,"SELECT `boss`.`t_product`.* FROM `boss`.`t_product` ;");
$no = 0;
while($row_list_paket = mysqli_fetch_array($sql_list_paket))
{
    
    $content .='
			<section class="col-lg-4">                            
			    <div class="box box-solid '.boxColor($no).'">
                                <div class="box-header">
                                    <h3 class="box-title">'.$row_list_paket["productname"].'</h3>
                                </div>
                                <div class="box-body">
                    Expired Paket: -  <br>
				    Sewa STB : Rp.40.000,00<br>
				    <br><br>
				    <br>
				    <br><br><br>
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
			
$content .='                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Paket TV';
    $submenu	= "tv_paket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"yellow");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>