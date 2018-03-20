<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
    
    global $conn;
    
    //<a href="'.URL.'form_topup.php" class="small-box-footer">
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Topup</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
				    <div class="row">
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-aqua">
						<div class="inner">
						    <h4>
							Transfer to Virtual Account
						    </h4>
						    <p>
							&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a href="#" class="small-box-footer">
						    Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-green">
						<div class="inner">
						    <h4>
							Credit Card
						    </h4>
						    <p>
							&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a target="_blank" href="https://globalxtreme.net/new/billing/form_topup.php" class="small-box-footer">
						    Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-yellow">
						<div class="inner">
						    <h4>
							Gift Card
						    </h4>
						    <p>
							&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a href="#" class="small-box-footer">
						    Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					    <!-- small box -->
					    <div class="small-box bg-red">
						<div class="inner">
						    <h4>
							SOF (Auto Debet)
						    </h4>
						    <p>
							&nbsp;
						    </p>
						</div>
						<div class="icon">
						    <i class="fa fa-credit-card"></i>
						</div>
						<a href="#" class="small-box-footer">
						    Topup <i class="fa fa-arrow-circle-right"></i>
						</a>
					    </div>
					</div><!-- ./col -->
				    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '';

    $title	= 'Topup';
    $submenu	= "topup";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>