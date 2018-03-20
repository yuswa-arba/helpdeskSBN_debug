<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;
        global $conn_voip;

        $content = '<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" target="_blank" role="form" name="form_account" id="form_account" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Customer Number</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" readonly="" class="form-control" required="" name="customer_number" value="" placeholder="Search Customer"
                                                    onclick="return valideopenerform(\'data_cust.php?r=form_account&f=account\',\'account\');">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Name Customer</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" readonly="" class="form-control" required="" name="name_customer" value="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>From Date</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" required="" name="from_date"  value="' . (date("d-m-Y")) . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                
                                                <div class="col-xs-3">
                                                    <label>To Date</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control hasDatepicker" id="datepicker2" readonly="" required="" name="to_date" value="' . (date("31-m-Y")) . '">
                                                </div>
                                            </div>
                                        </div>
					
                                    </div><!-- /.box-body -->
				    
                                    <div class="box-footer">
                                        <button type="submit" value="Generate" name="generate" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

        $plugins = '';

        /** ========================================
         * akan dijalankan jika tombol submit diklik
         * ========================================= */
        if (isset($_POST["generate"])) {

            /** =======================================================
             * data-data yang akan dikirim ke account_statement_pdf.php
             * ===================================================== */
            $customer_number = isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $from_date = isset($_POST['from_date']) ? mysql_real_escape_string(trim($_POST['from_date'])) : '';
            $to_date = isset($_POST['to_date']) ? mysql_real_escape_string(trim($_POST['to_date'])) : '';

            // akan mengirim url jika customer number tidak kosong
            if ($customer_number != "") {
                $url = "account_statement_pdf.php?c=" . $customer_number . "&f=" . $from_date . "&t=" . $to_date;
                header("location: $url");
            }

        }

        $title = 'Account Statement';
        $submenu = "account_statement";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>