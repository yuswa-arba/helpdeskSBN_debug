<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Home");
    
    global $conn;
    
    
//Statistik Helpdesk
$sum_complaint  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
                                             WHERE `log_time` LIKE '%".date("Y-m-")."%';", $conn));
$sum_ticket     = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
                                             WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';", $conn));
$sum_nonticket  = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
                                             WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';", $conn));
$sum_prospek    = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
                                             WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';", $conn));
$sum_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
                                             WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';", $conn));
$sum_spktech    = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk`
                                             WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';", $conn));
$sum_spkmkt     = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk`
                                             WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';", $conn));

//Statistik Mailbox
$sum_all            = mysql_num_rows(mysql_query("SELECT * FROM `gx_email`, `gx_email_kategori`
                                                 WHERE `gx_email`.`id_kategori` = `gx_email_kategori`.`id_kategori`;", $conn));
//AND `gx_email`.`date_add` LIKE '%".date("Y-m-")."%'
    $content ='<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        15 <sup style="font-size: 20px">Movies</sup>
                                    </h3>
                                    <p>
                                        VOD Movie Shop
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        53<sup style="font-size: 20px">Call</sup>
                                    </h3>
                                    <p>
                                        Rate VoIP Calls
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        0<sup style="font-size: 20px">% Downtime</sup>
                                    </h3>
                                    <p>
                                        SLA Internet
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
							<div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        0<sup style="font-size: 20px">Khusus Admin</sup>
                                    </h3>
                                    <p>
                                        VoIP User Registrations
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                    
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-4 connectedSortable">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Helpdesk</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Summary</th>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/helpdesk.php?type=complaint">Incoming</a></td>
                                            <td>'.$sum_complaint.'</td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/helpdesk.php?type=prospek">Prospek</a></td>
                                            <td>'.$sum_prospek.'</td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/helpdesk.php?type=nonprospek">Non Prospek</a></td>
                                            <td>'.$sum_nonprospek.'</td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/helpdesk.php?type=spktech">SPK Teknisi</a></td>
                                            <td>'.$sum_spktech.'</td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/helpdesk.php?type=spkmkt">SPK Marketing</a></td>
                                            <td>'.$sum_spkmkt.'</td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->';
							if(($loggedin["id_bagian"]) == "Marketing")  { 
							$content .='
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Prospek</h3>
                                    <div class="box-tools">
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>No Prospek</th>
                                            <th>Nama Cust</th>
											<th>Tanggal</th>
                                            
                                        </tr>';
										$no=1;
										$sql_survey 	= mysql_query("SELECT  `gx_prospek`.`no_prospek`, `gx_prospek`.`nama_cust`, `gx_prospek`.`id_prospek` FROM `gx_prospek`, `gx_survey`
																	  WHERE `gx_prospek`.`no_prospek` = `gx_survey`.`no_prospek` ORDER BY `gx_prospek`.`id_prospek` DESC;", $conn);
										 $survey 		= mysql_fetch_array($sql_survey);
											$sql_prospek 		= mysql_query("SELECT * FROM `gx_prospek` WHERE `gx_prospek`.`no_prospek` != '".$survey["no_prospek"]."'  ORDER BY `gx_prospek`.`id_prospek` DESC LIMIT 0,5;", $conn);
											while($prospek 		= mysql_fetch_array($sql_prospek)){
												
											$content .='<tr>
												<td>'.$no.'.</td>
												<td>'.$prospek['no_prospek'].'</td>
												<td>'.$prospek['nama_cust'].'</td>
												<td>'.date("d-m-Y", strtotime($prospek['date_add'])).'</td>
											</tr>';
											$no++;
											}
										 
                                    $content .='</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->';
							}else{
								
							}
							$content .='
                        </section><!-- /.Left col -->
                        
                        <section class="col-lg-4 connectedSortable">
			<div class="box box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Mailbox</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-warning btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
				    <table class="table">
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Summary</th>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/mailbox.php">All</a></td>
                                            <td>'.$sum_all.'</td>
                                        </tr>';
$kategori   = mysql_query("SELECT * FROM `gx_email_kategori` WHERE `level` = '1';", $conn);

while ($row_kategori = mysql_fetch_array($kategori))
{
    $sum_kategori      = mysql_num_rows(mysql_query("SELECT * FROM `gx_email`, `gx_email_kategori`
                                                 WHERE `gx_email`.`id_kategori` = `gx_email_kategori`.`id_kategori`
                                                 
                                                 AND `gx_email`.`id_kategori` = '".$row_kategori["id_kategori"]."';", $conn));
    //AND `gx_email`.`date_add` LIKE '%".date("Y-m-")."%'
    $content .='<tr>
                    <td><a href="'.URL_STAFF.'helpdesk/mailbox.php?type='.$row_kategori["id_kategori"].'">'.$row_kategori["nama_kategori"].'</a></td>
                    <td>'.$sum_kategori.'</td>
                </tr>';
}

$content .='                       </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->';
							if(($loggedin["id_bagian"]) == "Marketing")  { 
							$content .='
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Prospek Pending</h3>
                                    <div class="box-tools">
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Kode SPK Survey</th>
                                            <th>Nama Cust</th>
											<th>Tanggal</th>
										</tr>';
										$no=1;
											$sql_prospekpending 		= mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `gx_jawab_spksurvey`.`check_pending` = '1'  ORDER BY `gx_jawab_spksurvey`.`id_jawab_spksurvey` ASC LIMIT 0,5;", $conn);
											while($prospekpending 		= mysql_fetch_array($sql_prospekpending)){
												
											$content .='<tr>
												<td>'.$no.'.</td>
												<td>'.$prospekpending['no_spksurvey'].'</td>
												<td>'.$prospekpending['nama'].'</td>
												<td>'.date("d-m-Y", strtotime($prospekpending['date_add'])).'</td>
											</tr>';
											$no++;
											}
										 
                                    $content .='
                                        				
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->';
							}else{
								
							}
							$content .='
                        </section><!-- right col -->
			
			<section class="col-lg-4 connectedSortable">
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Live Chat</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <th>Cabang</th>
                                            <th>Summary</th>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/chat.php">Bali</a></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/chat.php?locate=mlg">Malang</a></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/chat.php?locate=bpn">Balikpapan</a></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="'.URL_STAFF.'helpdesk/chat.php?locate=smd">Samarinda</a></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    
                            <!-- List History -->';
							if(($loggedin["id_bagian"]) == "Marketing")  { 
							$content .='
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Status Aktivasi Customer</h3>
                                    <div class="box-tools">
                                        
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama </th>
                                            <th>status</th>
                                            <th>Tanggal</th>
                                        </tr>';
										$no=1;
										
											$sql_aktivasi 		= mysql_query("SELECT  `gx_jawab_spkaktivasi`.`kode_spkaktivasi`, `gx_jawab_spkaktivasi`.`nama_customer`, `gx_jawab_spkaktivasi`.`status` FROM `gx_spk_aktivasi`, `gx_jawab_spkaktivasi` WHERE `gx_spk_aktivasi`.`kode_spkaktivasi` = `gx_jawab_spkaktivasi`.`kode_spkaktivasi` AND `gx_jawab_spkaktivasi`.`status` = 'cleared' AND `gx_jawab_spkaktivasi`.`id_marketing` = '".$loggedin["id_employee"]."'  ORDER BY `gx_jawab_spkaktivasi`.`id_jawab_spkaktivasi` ASC LIMIT 0,5;", $conn);
											while($aktivasi 		= mysql_fetch_array($sql_aktivasi)){
												
											$content .='<tr>
												<td>'.$no.'.</td>
												<td>'.$aktivasi['nama_customer'].'</td>
												<td>'.$aktivasi['status'].'</td>
												<td>'.date("d-m-Y", strtotime($aktivasi['tanggal'])).'</td>
											</tr>';
											$no++;
											}
										 
                                    $content .='
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->';
							}else{
								
							}
							$content .='
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
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$loggedin["id_bagian"]);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>