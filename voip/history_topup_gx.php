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
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu History Topup");
global $conn_voip;
global $conn;

            
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">History Topup </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        
                <tbody><tr>
                  <th width="28">#</th>
                  <th width="100" class="lrborder">Customer Number</th>
                  <th width="80" class="lrborder">Nama</th>
                  <th width="80" class="lrborder">Nomer Telpon</th>
                  <th width="80" class="lrborder">Tanggal</th>
                  <th width="100" class="calign">Nominal</th>
		  <th width="60" class="lrborder">Tipe</th>
                  <th width="120">Actions</th>
                </tr>';

$sql_topup = mysql_query("SELECT `gx_voip_topup`.*, `tbCustomer`.`cNama` FROM `gx_voip_topup`, `tbCustomer`
			     WHERE `tbCustomer`.`cKode` = `gx_voip_topup`.`id_user`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."'
                             ORDER BY `gx_voip_topup`.`date_added` DESC
                             LIMIT 0,10;", $conn);
$no = 1;
while($row_topup = mysql_fetch_array($sql_topup))
{
    $content .='<tr>
                  <td>'.$no.'</th>
                  <td>'.$row_topup["id_user"].'</td>
                  <td>'.$row_topup["cNama"].'</td>
                  <td>'.$row_topup["id_voip"].'</td>
                  <td>'.$row_topup["date_added"].'</td>
		  <td>'.$row_topup["saldo"].'</td>
                  <td>'.$row_topup["method_payment"].'</td>
                  <td></td>
                </tr>';
                $no++;
}


                
$content .='                </tbody></table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">

                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'History Topup';
    $submenu	= "voip_topup";
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