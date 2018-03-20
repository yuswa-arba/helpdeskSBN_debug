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
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu list invoice");

global $conn;
global $conn_voip;

$sql_invoice = "SELECT `gx_vod_invoice`.*, `gx_cabang`.`invoice_code` FROM `gx_vod_invoice`, `gxLogin`, `gx_cabang` 
                WHERE `gx_vod_invoice`.`id_vod` = `gxLogin`.`id_vod`
                AND `gxLogin`.`id_cabang` = `gx_cabang`.`id_cabang`
                AND `gx_vod_invoice`.`id_vod` = '".$loggedin["id_vod"]."' 
                AND `gx_vod_invoice`.`invoice_status` = 'unpaid' 
                AND `gx_vod_invoice`.`level` = '0' ;";
//echo $sql_invoice;
$query_invoice = mysql_query($sql_invoice, $conn);


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
                                            <th>No.</th>
                                            <th>Invoice Number</th>
                                            <th>Invoice Date</th>
                                            <th>Due Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>';

$no = 1;
while($row_invoice = mysql_fetch_array($query_invoice))
{
    if($row_invoice["invoice_status"] == "unpaid")
    {
        $status = '<span class="label label-danger">Unpaid</span>';
    }elseif($row_invoice["invoice_status"] == "paid")
    {
        $status = '<span class="label label-success">Paid</span>';
    }
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td><a href="'.URL.'vod/invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">
                    '.$row_invoice["invoice_code"].'-'.$row_invoice["invoice_number"].'</a></td>
                    <td>'.$row_invoice["invoice_date"].'</td>
                    <td>'.$row_invoice["invoice_duedate"].'</td>
                    <td>'.Rupiah($row_invoice["invoice_amount"]).'</td>
                    <td>'.$status.'</td>
                    <td><a href="'.URL.'vod/invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">Detail</a> | 
                    <a href="'.URL.'vod/detail_invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">PDF</a> | 
                    <a href="'.URL.'vod/detail_invoice.php?id='.$row_invoice["id_invoice"].'" target="_blank">Pay</a></td>
                </tr>';
    $no++;
}

$content .='
                                    </table>
				<div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
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

    $title	= 'Invoice TV';
    $submenu	= "tv_invoice";
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