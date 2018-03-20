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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    
    $nama   	= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $customer_number  	= isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
    $tagihan_bulan	= isset($_POST['tagihan_bulan']) ? mysql_real_escape_string(trim($_POST['tagihan_bulan'])) : '';
    $total_billing	= isset($_POST['total_billing']) ? mysql_real_escape_string(trim($_POST['total_billing'])) : '';
    $total_billing_indosat	= isset($_POST['total_billing_indosat']) ? mysql_real_escape_string(trim($_POST['total_billing_indosat'])) : '';
    $id_voip	= isset($_POST['id_voip']) ? mysql_real_escape_string(trim($_POST['id_voip'])) : '';
    
    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_voip_billing` (`id_billing`, `id_voip`, `customer_number`,
		    `nama`, `total_billing`, `total_billing_indosat`, `tagihan_bulan`,
		    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		    VALUES (NULL, '".$id_voip."', '".$customer_number."', '".$nama."', '".$total_billing."',
		    '".$total_billing_indosat."', '".$tagihan_bulan."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."/report/billing_voip.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    
    $id_billing 	= isset($_POST['id_billing']) ? mysql_real_escape_string(trim($_POST['id_billing'])) : '';
    $nama   	= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $customer_number  	= isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
    $tagihan_bulan	= isset($_POST['tagihan_bulan']) ? mysql_real_escape_string(trim($_POST['tagihan_bulan'])) : '';
    $total_billing	= isset($_POST['total_billing']) ? mysql_real_escape_string(trim($_POST['total_billing'])) : '';
    $total_billing_indosat	= isset($_POST['total_billing_indosat']) ? mysql_real_escape_string(trim($_POST['total_billing_indosat'])) : '';
    $id_voip	= isset($_POST['id_voip']) ? mysql_real_escape_string(trim($_POST['id_voip'])) : '';
    

    $sql_update = "UPDATE `gx_voip_billing` SET `total_billing_indosat`='".$total_billing_indosat."',
		    `user_upd`='".$loggedin["username"]."', `date_upd`= NOW(), `level`='0'
		    WHERE `id_billing`='".$id_billing."';";
    
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."report/billing_voip.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_voip	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $m		= isset($_GET['m']) ? $_GET['m'] : '';
    
    $sql_all_user = "SELECT * FROM `cc_card` WHERE `useralias` = '".$id_voip."' LIMIT 0,1;";
    $query_all_user = mysql_query($sql_all_user, $conn_voip);
    $row_user = mysql_fetch_array($query_all_user);
    
    $sql_customer = mysql_query("SELECT * FROM `gxLogin` WHERE `id_voip` = '".$row_user["useralias"]."' LIMIT 0,1;", $conn);
    $row_customer = mysql_fetch_array($sql_customer);
    
    $sql_cust_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` = '".$row_user["useralias"]."'", $conn_voip);
    $row_cust_voip = mysql_fetch_array($sql_cust_voip);
    //$card_id = $row_cust_voip["id"];
    $card_id = $row_user["id"];
    //echo $card_id."<br>";
    
    $sql_total = "SELECT SUM(`sessionbill`) AS `total`
    FROM `cc_call`
    WHERE `src` != 0
    AND `card_id` = '".$card_id."'
    AND `starttime` LIKE '%".date("Y-m")."%';";
    //echo $sql_total."<br>";
    $query_total = mysql_query($sql_total, $conn_voip);
    $row_total	= mysql_fetch_array($query_total);
    $total = $row_total["total"];

    $customer_number 	= $row_customer["customer_number"];
    $nama 		= $row_user["firstname"].' '.$row_user["lastname"];
    $useralias		= $row_user["useralias"];
    $total_billing	= Rupiah(Bulatdua($total));
    
    $sql_billing = mysql_query("SELECT * FROM `gx_voip_billing`
			       WHERE `id_voip` = '".$id_voip."'
			       AND `tagihan_bulan` = '".$m."' LIMIT 0,1;", $conn);
    if($sql_billing)
    {
	$row_billing 	= mysql_fetch_array($sql_billing);
	$id_billing 	= $row_billing["id_billing"];
	$total_billing_indosat 	= $row_billing["total_billing_indosat"];
    }else
    {
	$id_billing = "";
	$total_billing_indosat = "";
    }
    
    

}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Billing</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="" id="form_billing" name="form_billing">
                                    <div class="box-body">
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Customer Number</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" readonly="" name="customer_number" value="'.(isset($_GET['id']) ? $customer_number : "").'">
						    <input type="hidden" class="form-control" readonly="" name="id_billing" value="'.(isset($_GET['id']) ? $id_billing : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nama </label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" readonly="" name="nama" value="'.(isset($_GET['id']) ? $nama : "").'">
						    
						</div>
					    </div>
                                        </div>
                                        <div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nomer Telpon </label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" readonly="" name="id_voip" value="'.(isset($_GET['id']) ? $id_voip : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Tagihan Bulan </label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" readonly="" name="tagihan_bulan" value="'.(isset($_GET['m']) ? $m : "").'">
						    
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Total Tagihan (a2billing)</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" readonly="" name="total_billing" value="'.(isset($_GET['id']) ? $total : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Total Tagihan (Indosat)</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="total_billing_indosat" value="'.(isset($_GET['id']) ? $total_billing_indosat : "").'">
						</div>
					    </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(($id_billing != "") ? 'name="update"' : 'name="save"').' class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Billing';
    $submenu	= "report_voip";
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