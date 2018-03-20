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

redirectToHTTPS();

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Dashboard");
    
    global $conn;
    global $conn_voip;
    
    
    $content ='<!-- Main content -->
                <section class="content">
				<div class="box box-solid box-info">
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
					
$sql_tipe = mysql_query("SELECT * FROM `gxTipe`", $conn);
$no = 1;

while ($row_tipe = mysql_fetch_array($sql_tipe))
{
    if($row_tipe["id_type"] == 1)
    {
	$sql_ = "`tbCustomer`.`paket_voip` = `gxPaket`.`id_paket` AND ";
	$url_ = URL."voip/paket.php";
    }elseif($row_tipe["id_type"] == 2)
    {
	$sql_ = "`tbCustomer`.`paket_data` = `gxPaket`.`id_paket` AND ";
	$url_ = URL."data/paket.php";
    }elseif($row_tipe["id_type"] == 3)
    {
	$sql_ = "`tbCustomer`.`paket_video` = `gxPaket`.`id_paket` AND ";
	$url_ = URL."vod/paket.php";
    }else{
	$sql_ = "";
	$url_ = "";
    }
    
    $sql_paket = mysql_query("SELECT `gxPaket`.* FROM `gxPaket`, `tbCustomer`
			     WHERE $sql_ `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
    $row_paket = mysql_fetch_array($sql_paket);
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="'.$url_.'">'.$row_tipe["nama_type"].'</a></td>
		    <td>'.$row_paket["nama_paket"].'</td>
		    <td>'.Rupiah($row_paket["harga_paket"]).'</td>
		    <td><a href="voip/invoice.php"><span>View Invoices</span></a></td>
		    <td><a href="voip/payment_history.php"><span>Payment History</span></a></td>
		</tr>';
    $no++;
}


// DATA INTERNET
/*$sql_paket_data = mysql_query("SELECT `gxPaket`.* FROM `gxPaket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_data` = `gxPaket`.`id_paket`
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
$sql_paket_voip = mysql_query("SELECT `gxPaket`.* FROM `gxPaket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gxPaket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);
$sql_saldo = mysql_query("SELECT `credit`, `useralias` FROM `cc_card` WHERE `useralias` = '".$loggedin["id_voip"]."' LIMIT 0,1;", $conn_voip);
$row_saldo = mysql_fetch_array($sql_saldo);


$sql_cust_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` = '".$loggedin["id_voip"]."'", $conn_voip);
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
$sql_paket_video = mysql_query("SELECT `gxPaket`.* FROM `gxPaket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_video` = `gxPaket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_video = mysql_fetch_array($sql_paket_video);
                                        
$content .='                                        
                                    </table>
                                </div>
                                </div><!-- /.box-body -->
                            </div>
                    
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
                                <div class="box-body">
                                    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
				    
				    Status : '.(($row_paket_data["UserActive"] == "1") ? "Aktif" : "Nonaktif").'<br><br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Complaint History</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                        <tr>
                                            
                                            <td>Inet Putus</td>
                                            <td>20/07/2014</td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>Inet Putus</td>
                                            <td>15/06/2014</td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
					<tr>
                                            
                                            <td>Lemot</td>
                                            <td>28/04/2014</td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->
                        
                        <section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-phone-square"></i>  Status Voip/Telepon</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
				    Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				    Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
                                    Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
				    Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
				    Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
				    
				    Status : '.(($row_paket_voip["level"] == "0") ? "Aktif" : "Nonaktif").'<br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                    
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
                        </section><!-- right col -->
			
			<section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-laptop"></i>  Status Video/VOD</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-warning btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    OFF<br><br>
				    
				    <a href="" title="sign up">Sign up</a>
					<br><br><br><br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Last Movie Seen</h3>
									<div class="box-tools">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
								
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            
                                            <th>Title</th>
                                            <th>Date</th>
											<th></th>
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td></td>
                                            <td></td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td></td>
                                            <td></td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
					<tr>
                                          
                                            <td></td>
                                            <td></td>
                                            <td><span class="label label-primary">Detail</span></td>
                                        </tr>
					
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
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
$plugins = '
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
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