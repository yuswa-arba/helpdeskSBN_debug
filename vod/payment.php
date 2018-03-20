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
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Payment History VOD ");
global $conn_voip;

            
    $content ='
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Payment History </h3>
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
                                            <th>ID</th>
                                            <th>Invoices</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                        </tr>
                                        <tr>
                                            <td>183</td>
                                            <td>VoIP</td>
                                            <td>11-7-2014</td>
                                            <td><span class="label label-warning">Unpaid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>219</td>
                                            <td>Data Internet</td>
                                            <td>11-7-2014</td>
                                            <td><span class="label label-warning">Unpaid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>657</td>
                                            <td>VoIP</td>
                                            <td>11-6-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                        <tr>
                                            <td>175</td>
                                            <td>Data Internet</td>
                                            <td>11-6-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
										<tr>
                                            <td>645</td>
                                            <td>VoIP</td>
                                            <td>11-5-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
										<tr>
                                            <td>986</td>
                                            <td>Data Internet</td>
                                            <td>11-5-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
										<tr>
                                            <td>345</td>
                                            <td>VoIP</td>
                                            <td>11-4-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
										<tr>
                                            <td>870</td>
                                            <td>Data Internet</td>
                                            <td>11-4-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
										<tr>
                                            <td>278</td>
                                            <td>VoIP</td>
                                            <td>11-3-2014</td>
                                            <td><span class="label label-primary">Paid</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
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

    $title	= 'VOD Payment';
    $submenu	= "vod_payment";
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