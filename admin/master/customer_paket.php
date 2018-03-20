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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Customer");
    global $conn;
    global $conn_voip;
    
    
    //paging
    $perhalaman = 100;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     
    $content ='<section class="content-header">
                    <h1>
                        Master Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_customer">Master Customer</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Search</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>User ID :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="user_id" placeholder="User ID">
					</div>
					<div class="col-xs-2">
					    <label>Customer Number :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="cust_number" placeholder="Customer Number">
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama Customer :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="name" type="text" placeholder="Nama Customer">
					</div>
					<div class="col-xs-2">
					    <label>Alamat :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="address" placeholder="Alamat">
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Email :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="email" type="text" placeholder="Email">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
				<div class="box-header">
                                    <h3 class="box-title">List Customer</h3>
				    <a href="'.URL_ADMIN.'master/form_customer" class="btn bg-olive btn-flat margin pull-right">Create Account</a>
                                </div><!-- /.box-header -->
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 70px">User ID</th>
												<th>User Index</th>
                                                <th style="width: 120px">Cust. Number</th>
                                                <th>Name</th>
                                                <th>inet</th>
                                                <th>voip</th>
						<th>video</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					


    $sql_masterCustomer = mysql_query("SELECT `cUserID`, `iuserIndex`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`, `gx_paket2`.`kode_paket`, `gx_paket2`.`abonemen_voip`, `gx_paket2`.`abonemen_video`, `gx_paket2`.`monthly_fee`
				  FROM `tbCustomer`, `gx_paket2`
				  WHERE  `tbCustomer`.`cKdpaket` = `gx_paket2`.`kode_paket` AND
				  `tbCustomer`.`cUserID` != '' AND
				  `tbCustomer`.`cNama` != '' AND
				  `tbCustomer`.`level` = '0' AND
					`gx_paket2`.`level` = '0' ORDER BY `tbCustomer`.`cNama` ASC LIMIT $start, $perhalaman;",$conn);
    
    $sql_total_customer = mysql_num_rows(mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE 
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0' ORDER BY `cNama` ASC;",$conn));
    
    $hal = "?";


$no = $start + 1;
while ($row_masterCustomer = mysql_fetch_array($sql_masterCustomer))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterCustomer["cUserID"].'</td>
		    <td>'.$row_masterCustomer["iuserIndex"].'</td>
			<td>'.$row_masterCustomer["cKode"].'</td>
		    <td>'.$row_masterCustomer["cNama"].'</td>
			<td>'.$row_masterCustomer["kode_paket"].'</td>
		    <td>'.$row_masterCustomer["monthly_fee"].'</td>
		    <td>'.$row_masterCustomer["abonemen_voip"].'</td>
			<td>'.$row_masterCustomer["abonemen_video"].'</td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
				<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_customer, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
	
    ';

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