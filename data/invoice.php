<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
    if($loggedin["group"] == 'customer'){
        
        enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Invoice Data");
        global $conn_voip;
    
        $perhalaman = 20;
        if (isset($_GET['page'])){
            $page = (int)$_GET['page'];
            $start=($page - 1) * $perhalaman;
        }else{
            $start=0;
        }
		$hal = "?";
        $content ='
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Invoice </h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    
									
									<table class="table table-hover">
                                        <tr>
                                            <th width="28">#</th>
                                            <th width="100" class="lrborder">Invoice Number</th>
                                            <th width="80" class="lrborder">Invoice Date</th>
                                            <th width="80" class="lrborder">Due Date</th>
                                            <th width="100" class="calign">Total</th>
                                            <th width="60" class="lrborder">Status</th>
                                            <th width="120">Actions</th>
                                        </tr>';
                                        
									$sql_data		= mysql_query("SELECT * FROM `gx_invoice` WHERE `customer_number` = '".$loggedin["customer_number"]."' AND `level` =  '0' ORDER BY `id_invoice` DESC LIMIT $start, $perhalaman;", $conn);
									$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_invoice` WHERE `customer_number` = '".$loggedin["customer_number"]."' AND `level` =  '0';", $conn));
									$no = $start + 1;
									while($row_data = mysql_fetch_array($sql_data))
									{
										$sql_total  = mysql_query("SELECT SUM(harga) AS total FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_data["kode_invoice"]."'", $conn);
										$row_total  = mysql_fetch_array($sql_total);    
										$content .='
										<tr>
											<td>'.$no.'.</td>
											<td>'.$row_data["kode_invoice"].'</td>
											<td>'.date("d-m-Y", strtotime($row_data["tanggal_tagihan"])).'</td>
											<td>'.date("d-m-Y", strtotime($row_data["tanggal_jatuh_tempo"])).'</td>
											<td>'.number_format($row_total["total"], 2, ',', '.').'</td>
											<td>'.StatusInvoice($row_data["paid_status"]).'</td>
											<td><a href="'.URL.'data/detail_invoice.php?id='.$row_data["id_invoice"].'" target="_blank">View detail</a> || <a href="'.URL.'data/inpdf.php?id='.$row_data["id_invoice"].'" target="_blank">View PDF</a></td>
										</tr>';
										$no++;
									}
									
									$content .='
									</table>
									<div class="box-footer clearfix">
                                    '.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
                                </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '
	
        <!-- Morris.js charts 
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
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

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>

    ';

    $title	= 'Invoice Internet';
    $submenu	= "inet_invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"green");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>