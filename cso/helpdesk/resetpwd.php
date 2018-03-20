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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Reset Password");
    global $conn;

    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Reset Password
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Data Customer</h2>
                                </div>
				
                                <div class="box-body table-responsive">
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID</label>
			</td>
			<td>
			  <input class="form-control" name="user_id" placeholder="User ID" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Customer Number</label>
			</td>
			<td>
			  <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama</label>
			</td>
			<td>
			  <input class="form-control" name="name" placeholder="Name" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table><br><br>';
		
if(isset($_POST["save_search"])){
	$user_id	= isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
	$customer_number= isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$nama_ibu 	= isset($_POST['nama_ibu']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ibu']))) : "";
	$tgl_lahir 	= isset($_POST['tgl_lahir']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_lahir']))) : "";
	
	
	$sql_nama	= ($name != "") ? "AND `cNama` LIKE '".$name."%'": "";
	$sql_userid	= ($user_id != "") ? "AND `cUserID` LIKE '%".$user_id."%'": "";
	$sql_address	= ($address != "") ? "AND `cAlamat1` LIKE '%".$address."%'": "";
	$sql_email	= ($email != "") ? "AND `cEmail` LIKE '%".$email."%'" : "";
	$sql_phone	= ($phone != "") ? "AND `ctelp` LIKE '%".$phone."%'" : "";
	$sql_namaibu	= ($nama_ibu != "") ? "AND `cNamaIbu` LIKE '%".$nama_ibu."%'" : "";
	$sql_tgl_lahir	= ($tgl_lahir != "") ? "AND `dTglLahir` LIKE '%".$tgl_lahir."%'" : "";
	
    if($customer_number != "" OR $user_id != "" OR $name != "")
{    
	$sql_customer	= "SELECT * FROM `tbCustomer`
	WHERE `cKode` LIKE '".$customer_number."%'
	$sql_nama
	$sql_userid
	AND `id_cabang` = '".$loggedin["cabang"]."'
	ORDER BY `idCustomer` ASC LIMIT 0,10;";
	
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
		    <th>User ID</th>
		    <th>Nama</th>
		    
		    <th>Reset By Email</th>
			<th>Reset By SMS</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysql_query($sql_customer, $conn);
$no = 1;

    while ($row_customer = mysql_fetch_array($query_customer))
	{
		$time = date("Y-m-d H:i:s", strtotime ("+2 hour"));
        $token= MD5($time);
		
		$content .='<tr>
				<td>'.$no.'</td>
				<td>'.$row_customer["cKode"].'</td>
				<td>'.$row_customer["cUserID"].'</td>
				<td>'.$row_customer["cNama"].'</td>
		 
				<td>
				  <a href="" onclick="return valideopenerform(\'sendemail.php?r=sendemail&userid='.$row_customer["cUserID"].'&cust_number='.$row_customer["cKode"].'&token='.$token.'\',\'sendemail\');" class="label label-success">Send email</a>
				</td>
				<td>
				  Send SMS
				</td>
            </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';

}
}
$content .='
</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Data Customer';
    $submenu	= "helpdesk_customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>