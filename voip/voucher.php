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
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu Voucher");

	$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	
	include("../config/".$row_voip["voip_config"]);
	global $conn_voip;
	
$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$row_cust_voip = mysql_fetch_array($sql_cust_voip);
$sql_cust = mysql_query("SELECT * FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
$row_cust = mysql_fetch_array($sql_cust);


$save = isset($_POST["save"]) ? $_POST["save"] : "";
if($save == " Use Voucher "){
    $voucher	= isset($_POST['voucher']) ? mysql_real_escape_string(strip_tags(trim($_POST['voucher']))) : "";
    $username	= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : "";
	
    $sql_vouchers = "SELECT * FROM  `cc_voucher` WHERE `voucher` = '$voucher' ";
    $sql_voucher  = mysql_query($sql_vouchers);
    $row_voucher  = mysql_fetch_array($sql_voucher);
    $dvoucher	  = $row_voucher["voucher"];
    $used	  = $row_voucher["usedcardnumber"];
    $credit	  = $row_voucher["credit"];
    $expired	  = $row_voucher["expirationdate"];
    
    $sql_cards	  = "SELECT * FROM `cc_card` WHERE `username` = '$username'";
    $sql_card	  = mysql_query($sql_cards);
    $row_card	  = mysql_fetch_array($sql_card);
    $total_credit = $row_card["credit"] + $credit ;
   
    if($voucher == $dvoucher){
	 if($used == ""){
	    if($expired < date("Y-m-d h:i:s")){
		echo "<script language='JavaScript'>
			alert('Maaf, Voucher yang anda masukkan sudah tidak aktif!');
			window.history.go(-1);
		 </script>";
	    
	    }else{
		$query = "UPDATE `cc_voucher` SET `usedcardnumber` = '$username',`activated` = 'f',
							`usedate` = NOW()
							WHERE `voucher` = $voucher;";
		//echo $query;
	    $query2 = "UPDATE `cc_card` SET `credit` = '$total_credit.00000'  WHERE `cc_card`.`username` = '$username'";
	    
	     mysql_query($query2) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
		
		echo "<script language='JavaScript'>
				alert('The voucher('.$voucher.') has been used, We added '.$credit.' credit on your account!!');
				location.href = 'topup.php';
		    </script>";
		    enableLog($loggedin["id_user"], $loggedin["username"], "", "$query,$query2 ");
	    }
	 }else{
	    echo "<script language='JavaScript'>
			alert('Maaf, Voucher yang anda masukkan sudah digunakan!');
			window.history.go(-1);
            </script>";
	 }
    }else{
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf, Voucher yang anda masukkan salah!');
			window.history.go(-1);
            </script>");
    }
	
	

}
//echo $expired .''. date("Y-m-d h:i:s");
$sql_cust_voip = mysql_query("SELECT * FROM  `gx_voip_nomerTelpon` WHERE `customer_number` = '".$loggedin["customer_number"]."';", $conn);
$row_cust_voip = mysql_fetch_array($sql_cust_voip);
$sql_cust = mysql_query("SELECT * FROM  `cc_card` WHERE `useralias` LIKE '%".$row_cust_voip["nomer_telpon"]."%';", $conn_voip);
$row_cust = mysql_fetch_array($sql_cust);

$view_username = $row_cust["username"];

  $sql_topuphistory = "SELECT * FROM  `cc_voucher` 
                    WHERE `usedcardnumber` = '$view_username'";
//echo $customer;
    $sql_topup = mysql_query($sql_topuphistory);
   
    
   
            
    $content ='<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
				<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Topup Voucher </h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">


	    <form action="voucher.php" method="post" name="form_topup" id="form_topup">
                    
                    <table width="50%" border="0" cellspacing="1" cellpadding="2" align="center" class="gwlines arborder">
			<tbody>
			<tr>
				<td style="width:200px;" align="center" class="bgcolor_004">
					<font class="fontstyle_003">VOUCHER</font>
				</td>
				<td align="left" class="bgcolor_005">
				<input style="width:300px;"  type="text" name="voucher" required="" value="" class="form_input_text">
				<input style="width:300px;"  type="hidden" name="username" value="'.$view_username.'" class="form_input_text"></td>
			</tr>		
			
			<tr>
        		<td class="bgcolor_004" align="left"> </td>
				<td class="bgcolor_005" align="left">
					<input class="form_input_button" name="save" value=" Use Voucher " type="submit">
	  			</td>
    		</tr>
	</tbody></table>
            </form>

<br />
									<div class="box-body no-padding">
                                    <table class="table" width="70%">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Voucher</th>
                                            <th>Credit</th>
					    <th>Currency</th>
                                            <th style="width: 200px">Date Activate</th>
                                        </tr>';
		
					$no = 1;
					
					while ($row_topuphistory = mysql_fetch_array($sql_topup)){
			
					$content .='
                                        <tr>
                                            <td>'.$no.'</td>
                                            <td>'.$row_topuphistory["voucher"].'</td>
					    <td>'.$row_topuphistory["credit"].'</td>
                                            <td>'.$row_topuphistory["currency"].'</td>
                                            <td>'.$row_topuphistory["usedate"].'</td>
					
                                        </tr>';
					$no++;
					}
					
					$content .='
                                        
                                    </table>
                                </div>
                                </div><!-- /.box-body -->
                            </div>
                    
                    <!-- Main row -->
                    

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Voip';
    $submenu	= "Voucher";
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