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

global $conn;

$sql_voip = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
	$row_voip = mysql_fetch_array($sql_voip);
	

            
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
                  <th width="80" class="lrborder">Name</th>
                  <th width="80" class="lrborder">Id STB</th>
                  <th width="80" class="lrborder">Date</th>
                  <th width="100" class="calign">Nominal</th>
				  <th width="60" class="lrborder">Payment Method</th>
                  
                </tr>';

$sql_topup = mysql_query("SELECT *FROM `gx_tv_topup`
			     WHERE `gx_tv_topup`.`id_user` = '".$loggedin["customer_number"]."' ORDER BY `gx_tv_topup`.`date_added` DESC
                             LIMIT 0,10;", $conn);

$no = 1;
while($row_topup = mysql_fetch_array($sql_topup))
{
    $content .='<tr>
                  <td>'.$no.'</th>
                  <td>'.$loggedin["customer_number"].'</td>
                  <td>'.$loggedin["username"].'</td>
                  <td>'.$row_topup["id_stb"].'</td>
                  <td>'.date("d-m-Y", strtotime($row_topup["date_added"])).'</td>
		  <td>'.number_format($row_topup["saldo"], 2, ',','.').'</td>
                  <td>'.$row_topup["method_payment"].'</td>
                  
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
    $submenu	= "tv_topup";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"yellow");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>