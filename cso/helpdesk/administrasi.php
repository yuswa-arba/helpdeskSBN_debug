<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: dwi@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */
include ("../../config/configuration_admin.php");


$title	= 'Administration';

if($loggedin = logged_inCSO()){ // Check if they are logged in 

$sql_log = mysql_query("Select u.user_index, s.ip, s.waktu, s.id from users u, sessions s WHERE u.user_index = s.uid AND u.user_index = '".$loggedin["username"]."' ORDER BY s.id DESC LIMIT 0,1") or (mysql_error());
$row_log = mysql_fetch_array($sql_log);
$message = '';

	if ($loggedin["group"] == "cso"){
		
		//1
		$sql_num_downgrade	= mysql_num_rows(mysql_query("SELECT * FROM  `upgrade` WHERE `level` = '0' AND `date_upgrade` LIKE '".date("Y-m-")."%';"));
		$sql_num_downgrade_clear = mysql_num_rows(mysql_query("SELECT * FROM  `upgrade` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `date_upgrade` LIKE '".date("Y-m-")."%';"));
		$sql_num_downgrade_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `upgrade` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `date_upgrade` LIKE '".date("Y-m-")."%';"));
		$sql_num_downgrade_pending = mysql_num_rows(mysql_query("SELECT * FROM  `upgrade` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `date_upgrade` LIKE '".date("Y-m-")."%';"));
		
		$sql_num_downgrade_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `upgrade` WHERE `level` = '0' AND `status` LIKE '' AND `date_upgrade` LIKE '".date("Y-m-")."%';"));
		
		//2
		$sql_num_inaktif = mysql_num_rows(mysql_query("SELECT * FROM  `inactive` WHERE `level` = '0' AND `inactivation_date` LIKE '".date("Y-m-")."%';"));
		$sql_num_inaktif_clear = mysql_num_rows(mysql_query("SELECT * FROM  `inactive` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `inactivation_date` LIKE '".date("Y-m-")."%';"));
		$sql_num_inaktif_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `inactive` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `inactivation_date` LIKE '".date("Y-m-")."%';"));
		$sql_num_inaktif_pending = mysql_num_rows(mysql_query("SELECT * FROM  `inactive` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `inactivation_date` LIKE '".date("Y-m-")."%';"));
		
		$sql_num_inaktif_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `inactive` WHERE `level` = '0' AND `status` LIKE '' AND `inactivation_date` LIKE '".date("Y-m-")."%';"));
		
		//3
		$sql_num_relocate = mysql_num_rows(mysql_query("SELECT * FROM  `relocate` WHERE `level` = '0' AND `date_relocate` LIKE '".date("Y-m-")."%';"));
		$sql_num_relocate_clear = mysql_num_rows(mysql_query("SELECT * FROM  `relocate` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `date_relocate` LIKE '".date("Y-m-")."%';"));
		$sql_num_relocate_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `relocate` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `date_relocate` LIKE '".date("Y-m-")."%';"));
		$sql_num_relocate_pending = mysql_num_rows(mysql_query("SELECT * FROM  `relocate` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `date_relocate` LIKE '".date("Y-m-")."%';"));
		
		$sql_num_relocate_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `relocate` WHERE `level` = '0' AND `status` LIKE '' AND `date_relocate` LIKE '".date("Y-m-")."%';"));
		
		//$sql_num_downgrade_clear = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `status` LIKE '%clear%';"));
		//$sql_num_downgrade_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `status` LIKE '%unclear%';"));
		
		//4
		$sql_num_terminate = mysql_num_rows(mysql_query("SELECT * FROM  `termination` WHERE `level` = '0' AND `date_terminasi` LIKE '".date("Y-m-")."%';"));
		$sql_num_terminate_clear = mysql_num_rows(mysql_query("SELECT * FROM  `termination` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `date_terminasi` LIKE '".date("Y-m-")."%';"));
		$sql_num_terminate_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `termination` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `date_terminasi` LIKE '".date("Y-m-")."%';"));
		$sql_num_terminate_pending = mysql_num_rows(mysql_query("SELECT * FROM  `termination` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `date_terminasi` LIKE '".date("Y-m-")."%';"));
		$sql_num_terminate_dismantled = mysql_num_rows(mysql_query("SELECT * FROM  `termination` WHERE `level` = '0' AND `status` LIKE 'dismantled%' AND `date_terminasi` LIKE '".date("Y-m-")."%';"));
		$sql_num_terminate_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `termination` WHERE `level` = '0' AND `status` LIKE '' AND `date_terminasi` LIKE '".date("Y-m-")."%';"));
		
		//5
		$sql_num_reactivasi = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `reactivasi_date` LIKE '".date("Y-m-")."%';"));
		$sql_num_reactivasi_clear = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `reactivasi_date` LIKE '".date("Y-m-")."%';"));
		$sql_num_reactivasi_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `reactivasi_date` LIKE '".date("Y-m-")."%';"));
		$sql_num_reactivasi_pending = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `reactivasi_date` LIKE '".date("Y-m-")."%';"));
		
		$sql_num_reactivasi_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `reactivasi` WHERE `level` = '0' AND `status` LIKE '' AND `reactivasi_date` LIKE '".date("Y-m-")."%';"));
		
		//6
                $sql_num_pemasangan = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_pemasangan` WHERE `level` = '0' AND `install_date` LIKE '".date("Y-m")."%';", $conn));
		$sql_num_pemasangan_clear = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_pemasangan` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `install_date` LIKE '".date("Y-m-")."%';", $conn));
		$sql_num_pemasangan_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_pemasangan` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `install_date` LIKE '".date("Y-m-")."%';", $conn));
		$sql_num_pemasangan_pending = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_pemasangan` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `install_date` LIKE '".date("Y-m-")."%';", $conn));
		$sql_num_pemasangan_dismantled = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_pemasangan` WHERE `level` = '0' AND `status` LIKE 'dismantled%' AND `install_date` LIKE '".date("Y-m-")."%';", $conn));
		$sql_num_pemasangan_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_pemasangan` WHERE `level` = '0' AND `status` LIKE '' AND `install_date` LIKE '".date("Y-m-")."%';", $conn));
		
		//7
		$sql_num_prospek = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_prospek` WHERE `level` = '0' AND `request_date` LIKE '".date("Y-m")."%';", $conn));
		$sql_num_prospek_clear = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_prospek` WHERE `level` = '0' AND `status` LIKE 'clear%' AND `request_date` LIKE '".date("Y-m-")."%';", $conn));
		$sql_num_prospek_unclear = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_prospek` WHERE `level` = '0' AND `status` LIKE 'unclear%' AND `request_date` LIKE '".date("Y-m-")."%';", $conn));
		$sql_num_prospek_pending = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_prospek` WHERE `level` = '0' AND `status` LIKE 'pending%' AND `request_date` LIKE '".date("Y-m-")."%';", $conn));
		
		$sql_num_prospek_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `gx_cso_prospek` WHERE `level` = '0' AND `status` LIKE '' AND `request_date` LIKE '".date("Y-m-")."%';", $conn));
		
                $sql_num_complaint = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `log_time` LIKE '".date("Y-m-")."%';"));
		$sql_num_complaint_open = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `status` LIKE 'open%' AND `log_time` LIKE '".date("Y-m-")."%';"));
		$sql_num_complaint_closed = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `status` LIKE 'closed%' AND `log_time` LIKE '".date("Y-m-")."%';"));
                $sql_num_complaint_reopen = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `status` LIKE 'reopen%' AND `log_time` LIKE '".date("Y-m-")."%';"));
                $sql_num_complaint_pending = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `action` LIKE 'pending%' AND `log_time` LIKE '".date("Y-m-")."%';"));
		$sql_num_complaint_today = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `action` LIKE 'today%' AND `log_time` LIKE '".date("Y-m-")."%';"));
                $sql_num_complaint_tommorow = mysql_num_rows(mysql_query("SELECT * FROM  `gx_complaint` WHERE `level` = '0' AND `action` LIKE 'tommorow%' AND `log_time` LIKE '".date("Y-m-")."%';"));
		
                //Konversi
                $sql_num_konversi = mysql_num_rows(mysql_query("SELECT * FROM  `konversi` WHERE `level` = '0' AND `date_activation` LIKE '".date("Y-m-")."%';"));
		$sql_num_konversi_open = mysql_num_rows(mysql_query("SELECT * FROM  `konversi` WHERE `level` = '0' AND `status` LIKE 'open%' AND `date_activation` LIKE '".date("Y-m-")."%';"));
		$sql_num_konversi_closed = mysql_num_rows(mysql_query("SELECT * FROM  `konversi` WHERE `level` = '0' AND `status` LIKE 'closed%' AND `date_activation` LIKE '".date("Y-m-")."%';"));
		
                
                //Renewal
                $sql_num_renewal = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `date_add` LIKE '".date("Y-m-")."%';"));
		$sql_num_renewal_renew = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `status` LIKE 'renew%' AND `date_add` LIKE '".date("Y-m-")."%';"));
		$sql_num_renewal_notrenew = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `status` LIKE 'notrenew%' AND `date_add` LIKE '".date("Y-m-")."%';"));
		$sql_num_renewal_terminate = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `status` LIKE 'terminate%' AND `date_add` LIKE '".date("Y-m-")."%';"));
                $sql_num_renewal_wifi = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `status` LIKE 'wifi%' AND `date_add` LIKE '".date("Y-m-")."%';"));
                $sql_num_renewal_downgrade = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `status` LIKE 'downgrade%' AND `date_add` LIKE '".date("Y-m-")."%';"));
                $sql_num_renewal_upgrade = mysql_num_rows(mysql_query("SELECT * FROM  `renewal` WHERE `level` = '0' AND `status` LIKE 'upgrade%' AND `date_add` LIKE '".date("Y-m-")."%';"));
                
		//$sql_num_prospek_nostatus = mysql_num_rows(mysql_query("SELECT * FROM  `prospek` WHERE `level` = '0' AND `status` LIKE '' AND `request_date` LIKE '".date("Y-m-")."%';"));
		
		$content = '
               <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
						
                        <small>Welcome, '. $loggedin["username"].''
    //Last log in '.$row_log["waktu"]
                        .'</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Summary</li>
                    </ol>
                </section>
						
                                                
                 <!-- Main content -->
                <section class="content">
		    <div class="row">
                     <div class="col-lg-12 col-xs-12">
                
                
                
                <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">                            
			    <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Summary Menu</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                
		<table style="width:100%">
		    <tr>
			<td style="width:25%">
                        <h3><a href="administration/list_prospek.php">Prospek</a></h3>
                        <span style="color:'.($sql_num_prospek_unclear <= 0 ? 'red' : 'black').'">Open: '.$sql_num_prospek_unclear.'</span><br>
                        <span style="color:'.($sql_num_prospek_clear <= 0 ? 'red' : 'black').'">Closed : '.$sql_num_prospek_clear.'</span><br>                        
                        <span style="color:'.($sql_num_prospek_pending <= 0 ? 'red' : 'black').'">Pending : '.$sql_num_prospek_pending.'</span><br>
                        <span style="color:'.($sql_num_prospek_nostatus <= 0 ? 'red' : 'black').'">Non Status : '.$sql_num_prospek_nostatus.'</span><br>
                        <span style="color:'.($sql_num_prospek <= 0 ? 'red' : 'black').'"><b>Total</b>: '.$sql_num_prospek.'</span>
                        <br><br>
                        </td>
		<td style="width:25%">
                    <h3><a href="administration/list_pemasangan.php">Pemasangan</a></h3>
                        <span style="color:'.($sql_num_pemasangan_unclear <= 0 ? 'red' : 'black').'">Open : '.$sql_num_pemasangan_unclear.'</span><br>
                        <span style="color:'.($sql_num_pemasangan_clear <= 0 ? 'red' : 'black').'">Closed: '.$sql_num_pemasangan_clear.'</span><br>
                        <span style="color:'.($sql_num_pemasangan_nostatus <= 0 ? 'red' : 'black').'">Non Status : '.$sql_num_pemasangan_nostatus.'</span><br>
                        <span style="color:'.($sql_num_pemasangan <= 0 ? 'red' : 'black').'"><b>Total</b>: '.$sql_num_pemasangan.'</span>
                        <br><br>
		</td>
		<td style="width:25%">
                    <h3><a href="administration/list_aktivasi.php">Aktivasi FO</a></h3>
                        Open : 0<br>
                        Closed: 0<br>
                        <b>Total</b>: 0
                        <br><br>
		</td>
		<td style="width:25%">
                <h3><a href="administration/list_downgrade.php">Downgrade/Upgrade</a></h3>
			Clear : '.$sql_num_downgrade_clear.'<br>
			<span style="color:red">Unclear: '.$sql_num_downgrade_unclear.'</span><br>
			Pending : '.$sql_num_downgrade_pending.'<br>
			Non Status : '.$sql_num_downgrade_nostatus.'<br>
		<b>Total</b>: '.$sql_num_downgrade.'
		<br><br>
		</td>
		</tr>
		
		<tr>
		<td>
                    <h3><a href="administration/list_relokasi.php">Relokasi</a></h3>
                    Clear : '.$sql_num_relocate_clear.'<br>
                    <span style="color:red">Unclear: '.$sql_num_relocate_unclear.'</span><br>
                    Pending : '.$sql_num_relocate_pending.'<br>
                    
                    Non Status : '.$sql_num_relocate_nostatus.'<br>
                    <b>Total</b>: '.$sql_num_relocate.'
                    <br><br>
		</td>
		<td>
                    <h3><a href="administration/list_reaktivasi.php">Reaktivasi</a></h3>
                    Clear : '.$sql_num_reactivasi_clear.'<br>
                    <span style="color:red">Unclear: '.$sql_num_reactivasi_unclear.'</span><br>
                    Pending : '.$sql_num_reactivasi_pending.'<br>
                    Non Status : '.$sql_num_reactivasi_nostatus.'<br>
                    <b>Total</b>: '.$sql_num_reactivasi.'
                    <br><br>
		</td>
		<td>
                
                    <h3><a href="administration/list_ubah_email.php">Perubahan Email</a></h3>
                    Clear : 0<br>
                    <span style="color:red">Unclear: 0</span>
                    <br><br>
		</td>
		<td>
                    <h3><a href="administration/list_inaktivasi.php">Inaktivasi</a></h3>
                    Clear : '.$sql_num_inaktif_clear.'<br>
                    <span style="color:red">Unclear: '.$sql_num_inaktif_unclear.'</span><br>
                    Pending : '.$sql_num_inaktif_pending.'<br>
                    
                    Non Status : '.$sql_num_inaktif_nostatus.'<br>
                    <b>Total</b>: '.$sql_num_inaktif.'
                    <br><br>
		</td>
		
		</tr>
                <tr>
                <td>
                    <h3><a href="administration/list_terminasi.php">Terminasi</a></h3>
                    Clear : '.$sql_num_terminate_clear.'<br>
                    <span style="color:red">Unclear: '.$sql_num_terminate_unclear.'</span><br>
                    Pending : '.$sql_num_terminate_pending.'<br>
                    Dismantled : '.$sql_num_terminate_dismantled.'<br>
                    Non Status : '.$sql_num_terminate_nostatus.'<br>
                    <b>Total</b>: '.$sql_num_terminate.'
                    <br><br>
                </td>
                <td>
                    <h3><a href="administration/list_konversi.php">Konversi</a></h3>
                    Open : '.$sql_num_konversi_open.'<br>
                    Closed: '.$sql_num_konversi_closed.'<br>
                    <b>Total</b>: '.$sql_num_konversi.'
                    <br><br>
                    
                </td>
                <td>
                    <h3><a href="administration/list_renewal.php">Renewal</a></h3>
                    Renewed: '.$sql_num_renewal_renew.'<br>
                    Not Renewed: '.$sql_num_renewal_notrenew.'<br>
                    Upgrade: '.$sql_num_renewal_upgrade.'<br>
                    Downgrade: '.$sql_num_renewal_downgrade.'<br>
                    Terminate: '.$sql_num_renewal_terminate.'<br>
                    Wireless: '.$sql_num_renewal_wifi.'<br>
                    
                    <b>Total</b>: '.$sql_num_renewal.'
                    <br><br>
                    
                </td>
                </tr>
		</table>
                
                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
                    </div><!-- /.row (main row) -->
                
                
                
		</div>
	</div>

                </section><!-- /.content -->';

//list_renewal.php
	}





$additional = $additional_klien;

$menu ="administrasi";

$template	= cso_theme($title,$content,$additional,$loggedin["username"],$menu,$loggedin["group"]);

echo $template;

    } else{
        header("location: logout.php");
    }


?>