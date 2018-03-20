<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");
include ("config/upload.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu Profile");  
    global $conn;
    
	$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	include("config/".$row_voip["voip_config"]);
	global $conn_voip;
	
    $sql_profile = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_profile = mysql_fetch_array($sql_profile);
    $sql_foto_profile = mysql_query("SELECT * FROM `gxFoto_Profile` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` ='0' LIMIT 0,1;", $conn);
    $row_foto_profile = mysql_fetch_array($sql_foto_profile);
    
    // DATA INTERNET
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [dbo].[Users], [dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$loggedin["user_index"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();


//DATA VOIP
$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$sql_cardid ="";
$status_voip ='';

while($row_cust_voip = mysql_fetch_array($sql_cust_voip))
{
	$sql_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
	$row_voip = mysql_fetch_array($sql_voip);
	$view_id = $row_voip["id"];
	$sql_cardid .= " `card_id` = '".$view_id."' OR";
	
	$sql_saldo = mysql_query("SELECT `credit`, `useralias`, `expirationdate`, `status` FROM `cc_card` WHERE `useralias`  LIKE '%".$row_cust_voip["nomer_telpon"]."%' LIMIT 0,1;", $conn_voip);
	$row_saldo = mysql_fetch_array($sql_saldo);
	
	$status_voip .='<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-phone-square"></i>  Status Voip/Telepon</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
				<div class="box-body">
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


//DATA VIDEO
/*$sql_paket_video = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_video` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_video = mysql_fetch_array($sql_paket_video);*/

//DATA TV
include("config/configuration_tv.php");
$conn_tv   = DB_TV();
	
$sql_paket_tv = mysql_query("SELECT `gx_tv_customer`.* FROM `gx_tv_customer` WHERE `gx_tv_customer`.`id_customer` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_tv = mysql_fetch_array($sql_paket_tv);

$sql_data_tv	= mysqli_query($conn_tv,"SELECT `boss`.`t_account_cms`.* FROM `boss`.`t_account_cms` WHERE `CLIENTID` = '".$row_paket_tv["id_stb"]."';");
$row_data_tv	= mysqli_fetch_array($sql_data_tv);
	

    $content ='<!-- Main content -->
                <section class="content">
		    <div class="row">
			<section class="col-lg-7"> 
			    <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Profile </h3>
                                    
                                </div>
                                <div class="box-body">
                                    <div class="box-body no-padding">
					<table class="table no-border" width="70%">
					    <tr>
						<td rowspan="8"><img src="'.URL.'img/profile/customer/'.$row_foto_profile['file_foto'].'" width="160px" class="img-square" alt="User Image" />
						</td>
						<td>Nama </td>
						<td>'.$row_profile["cNama"].'</td>
					    </tr>
					    <tr>
						<td>Alamat</td>
						<td>'.$row_profile["cAlamat1"].'<br>
						Kota: '.$row_profile["cKota"].'<br>
						Lihat peta '. (($row_profile["cLati"] !="") ? '<a href="maps.php?id='.$row_profile["cKode"].'"
						onclick="return valideopenerform(\'maps.php?id='.$row_profile["cKode"].'\',\'maps'.$row_profile["idCustomer"].'\');">Klik</a>' : "-").'
						</td>
					    </tr>
					    <tr>
						<td>
					    </tr>
					    <tr>
						<td>No. Telpon</td>
						<td>'.$row_profile["ctelp"].'</td>
					    </tr>
					    <tr>
						<td>Fax</td>
						<td>'.$row_profile["cfax"].'</td>
					    </tr>
					    <tr>
						<td>Nama Perusahaan</td>
						<td>'.$row_profile["cNamaPers"].'</td>
					    </tr>
					    <tr>
						<td>User Id</td>
						<td>'.$row_profile["cUserID"].'</td>
					    </tr>
					    <tr>
						<td>Email</td>
						<td>'.$row_profile["cEmail"].'</td>
					    </tr>
						<tr>
						  <td></td>
						  <td colspan="2">
							<a href="form_profile.php" class="btn btn-primary btn-flat margin">Update Avatar</a>
							<!--<a href="form_ganti_password.php" class="btn btn-primary btn-flat margin">Ganti Password</a>-->
							
						  </td>
					    </tr>
					</table>
				    </div>
				</div><!-- /.box-body -->
			    </div>
			</section>
			<section class="col-lg-5"> 
			    
			    <div class="box box-solid box-success">
				  <div class="box-header">
					  <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>  Status Data/Internet</h3>
					  <div class="box-tools pull-right">
						  <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						  <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
				  </div>
				  <div class="box-body">
					  Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
					  Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
					  Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
					  
					  Status : '.(($row_paket_data["UserActive"] == "1") ? "Aktif" : "Nonaktif").'<br><br><br><br>
				  </div><!-- /.box-body -->
			  </div><!-- /.box -->
			  
			  '.$status_voip.'
			    
			    <div class="box box-solid box-warning">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-laptop"></i>  VOD</h3>
				    
				</div>
				<div class="box-body">
				    <div class="box-body no-padding">
					<div style="font-size:20px;">Status  '.(($row_data_tv["STATUS"] == "1") ? '<span class="label label-success">ACTIVE</span>' : '<span class="label label-danger">Not Active</span>').'</div><br>
				    Expired Date: '.(($row_data_tv["ENDDATE"]== "") ? '<b>-</b>' :'<b>'.date("d F Y", strtotime($row_data_tv["ENDDATE"])).'</b>') .'<br>
				    Saldo : <b>'.Rupiah((int)$row_data_tv["BALANCE"]).'</b><br>
				    Nama STB :  <b>'.$row_data_tv["CLIENTNAME"].'</b><br>
				    Monthly fee:  <b>Rp 40.000,00</b>
				    </div>
				</div><!-- /.box-body -->
			    </div>
			</section>
		    </div>
		</section><!-- /.content -->
            ';

/*
 *
 *<div class="box box-solid box-info">
				<div class="box-header">
				    <h3 class="box-title">Saldo anda Rp. 100.000,00 </h3>
				    
				</div>
				
			    </div>
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
$plugins = '
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    ';

    $title	= 'Profile';
    $submenu	= "profile";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>