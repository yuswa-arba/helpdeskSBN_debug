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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Voip Number");
    global $conn;
    
	$perhalaman = 20;
	 if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	 }else{
		$start=0;
	 }
	 
	 $hal = "?";
	
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
				<div class="box-header">
                                    <h3 class="box-title">List VOIP Number</h3>
				    <a href="'.URL_ADMIN.'master/form_voip_number" class="btn bg-olive btn-flat margin pull-right">Import CSV</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
						<th>Customer Number</th>
						<th>ID Pegawai</th>
						<th>Kode</th>
						<th>VOIP Number</th>
						<th>Status</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    $user_id		= isset($_POST["user_id"]) ? trim(strip_tags($_POST["user_id"])) : "";
    $cust_number	= isset($_POST["cust_number"]) ? trim(strip_tags($_POST["cust_number"])) : "";
    $name		= isset($_POST["name"]) ? trim(strip_tags($_POST["name"])) : "";
    $address		= isset($_POST["address"]) ? trim(strip_tags($_POST["address"])) : "";
    $email		= isset($_POST["email"]) ? trim(strip_tags($_POST["email"])) : "";
    
    $sql_userid		= ($user_id != "") ? "AND `cUserID` LIKE '%$user_id%'" : "";
    $sql_cust_number	= ($cust_number != "") ? "AND `cKode` LIKE '%$cust_number%'" : "";
    $sql_name		= ($name != "") ? "AND `cNama` LIKE '%$name%'" : "";
    $sql_address	= ($address != "") ? "AND `cAlamat1` LIKE '%$address%'" : "";
    $sql_email		= ($email != "") ? "AND `cEmail` LIKE '%$email%'" : "";
    
    
    $sql_masterCustomer = mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE 
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `cNama` ASC LIMIT 0,100;",$conn);
    $sql_total_data = mysql_num_rows(mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE 
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `cNama` ASC;", $conn));
    enableLog("", $loggedin["username"], $loggedin["username"], "Search Master Customer = SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE 
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `cNama` ASC;");
}else{
    $sql_voip_number = mysql_query("SELECT * FROM `gx_voip_nomerTelpon`
				  WHERE `level` = '0' LIMIT $start, $perhalaman;",$conn);
	
	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_voip_nomerTelpon`
				  WHERE `level` = '0';", $conn));
}


$no = $start + 1;
while ($row_voip_number = mysql_fetch_array($sql_voip_number))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="'.URL_ADMIN.'master/detail_customer?id='.$row_voip_number["customer_number"].'">'.$row_voip_number["customer_number"].'</a></td>
			<td><a href="'.URL_ADMIN.'master/detail_staff?id='.$row_voip_number["id_employee"].'">'.$row_voip_number["id_employee"].'</a></td>
		    <td>'.$row_voip_number["kode"].'</td>
		    <td>'.$row_voip_number["nomer_telpon"].'</td>
		    <td>'.StatusNumberVOIP($row_voip_number["status"]).'</td>
		    <td align="center"><!--<a href=""><span class="label label-info">Detail</span></a>
		    <a href=""><span class="label label-info">Edit</span></a>-->
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
								<div class="box-footer">
								   <div class="box-tools pull-right">
										'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
								   </div>
								   <br style="clear:both;">
							  </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

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