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

        enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Bank Masuk"); // for create log in newfunction2.php

        global $conn;

        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        if (isset($_GET["id"]) & isset($_GET["action"])) {

            // menambil nilai/string yang ada pada url
            $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $action = isset($_GET['action']) ? $_GET['action'] : '';

            if (($id != "") AND ($action == "lock")) {

                $sql_update_lock = "UPDATE `gx_bank_masuk` SET `status`='1', `date_upd` = NOW(), `user_upd`= '" . $loggedin["username"] . "'
                    WHERE (`id_bankmasuk`='" . $id . "');";
                mysql_query($sql_update_lock, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_lock);
            }
            if (($id != "") AND ($action == "hapus")) {

                $sql_update_lock = "UPDATE `gx_bank_masuk` SET `level`='1', `date_upd` = NOW(), `user_upd`= '" . $loggedin["username"] . "'
			        WHERE (`id_bankmasuk`='" . $id . "');";
                mysql_query($sql_update_lock, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_lock);
            }

            header("location: master_bankmasuk.php");

        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
					<div class="col-xs-12">
			            <div class="box">
							<div class="box-header">
                                <h2 class="box-title">Search</h2>
                            </div>
				            <div class="box-body">
                                <form action="" method="post" name="form_search">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Kode Transaksi :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="id" type="text" placeholder="Kode Transaksi">
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
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
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
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-4">
                                                <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
                                            </div>
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-4"></div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
	
                                <form method ="POST" action="">
                                    <div class="box-header">
                                        <h3 class="box-title">List Bank Masuk</h3>
                                        <div class="box-tools pull-right">
                                            <a href="form_bankmasuk.php" class="btn bg-olive btn-flat margin">Create New</a>
                                            <a href="form_generate.php" class="btn bg-olive btn-flat margin">Upload txt</a>
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive">
                                        <table id="bankmasuk" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th style="width: 120px">No. Transaction</th>
                                                    <th>Date</th>
                                                    <th>Customer Number</th>
                                                    <th>Nama</th>
                                                    <th>Nomer VA</th>
                                                    <th>Bank Code</th>
                                                    <th>Posting</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

        if (isset($_GET["c"]) AND isset($_GET["n"])) {

            $cust_number = isset($_GET["c"]) ? trim(strip_tags($_GET["c"])) : "";
            $name = isset($_GET["n"]) ? trim(strip_tags($_GET["n"])) : "";
            $transaction_id = isset($_GET["id"]) ? trim(strip_tags($_GET["id"])) : "";

            $sql_cust_number = ($cust_number != "") ? "AND `id_customer` LIKE '%$cust_number%'" : "";
            $sql_name = ($name != "") ? "AND `nama` LIKE '%$name%'" : "";
            $sql_id = ($transaction_id != "") ? "AND `transaction_id` LIKE '%$transaction_id%'" : "";

            $sql_bankmasuk = mysql_query("SELECT * FROM `v_bankmasuk_sbn` WHERE `level` =  '0' $sql_cust_number $sql_name $sql_id ORDER BY `id_bankmasuk` DESC LIMIT $start, $perhalaman;", $conn);
            $sql_total_bankmasuk = mysql_num_rows(mysql_query("SELECT * FROM `v_bankmasuk_sbn` WHERE `level` =  '0' $sql_cust_number $sql_name $sql_id;", $conn));

            $hal = "?id=$transaction_id&c=$cust_number&n=$name&";


        }

        if (isset($_POST["search"])) {

            $cust_number = isset($_POST["cust_number"]) ? trim(strip_tags($_POST["cust_number"])) : "";
            $name = isset($_POST["name"]) ? trim(strip_tags($_POST["name"])) : "";
            $transaction_id = isset($_GET["id"]) ? trim(strip_tags($_GET["id"])) : "";

            $sql_cust_number = ($cust_number != "") ? "AND `id_customer` LIKE '%$cust_number%'" : "";
            $sql_name = ($name != "") ? "AND `nama` LIKE '%$name%'" : "";
            $sql_id = ($transaction_id != "") ? "AND `transaction_id` LIKE '%$transaction_id%'" : "";

            $sql_bankmasuk = mysql_query("SELECT * FROM `v_bankmasuk_sbn` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` =  '0' $sql_cust_number $sql_name $sql_id ORDER BY `id_bankmasuk` DESC LIMIT $start, $perhalaman;", $conn);
            $sql_total_bankmasuk = mysql_num_rows(mysql_query("SELECT * FROM `v_bankmasuk_sbn` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` =  '0' $sql_cust_number $sql_name $sql_id;", $conn));

            $hal = "?id=$transaction_id&c=$cust_number&n=$name&";
        } else {
            $sql_bankmasuk = mysql_query("SELECT * FROM `v_bankmasuk_sbn`
				WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' ORDER BY `id_bankmasuk` DESC LIMIT $start, $perhalaman;", $conn);
            $sql_total_bankmasuk = mysql_num_rows(mysql_query("SELECT * FROM `v_bankmasuk_sbn`
				WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' ORDER BY `id_bankmasuk` DESC;", $conn));
            $hal = "?";
        }

        $no = $start + 1;
        while ($row_bankmasuk = mysql_fetch_array($sql_bankmasuk)) {
            $content .= '
                <tr>
		            <td>' . $no . '.</td>
		            <td>' . $row_bankmasuk["transaction_id"] . '</td>
		            <td>' . date("d-m-Y", strtotime($row_bankmasuk["tgl_transaction"])) . '</td>
		            <td>' . $row_bankmasuk["id_customer"] . '</td>
		            <td>' . $row_bankmasuk["cNama"] . '</td>
		    	    <td>' . $row_bankmasuk["cNoRekVirtual"] . '</td>
		            <td>' . $row_bankmasuk["bank_code"] . '</td>
		    	    <td align="center">' . (($row_bankmasuk["posting"] == "1") ? '<span class="label label-success">OK</span>' : '<span class="label label-danger">X</span>') . '
		            </td>
		            <td align="center">' . (($row_bankmasuk["posting"] == "1") ? '<a href="detail_bankmasuk?bm=' . $row_bankmasuk["transaction_id"] . '"><span class="label label-info">View</span></a>' :
                            '<a href="form_bm_detail?bm=' . $row_bankmasuk["transaction_id"] . '"><span class="label label-info">Detail</span></a>
		    	        <a href="form_bankmasuk?id=' . $row_bankmasuk["id_bankmasuk"] . '"><span class="label label-info">Edit</span></a>
		    	    	<a href="#" onclick="hapus(' . $row_bankmasuk["id_bankmasuk"] . ');"><span class="label label-info">Delete</span></a>
		    	        
		    	        ') . '
		    	    
		    	    ' . (($row_bankmasuk["posting"] == "1" AND strtotime($row_bankmasuk["tgl_transaction"]) >= strtotime(date("2017-10-19"))) ? '<a href="#" onclick="batalposting(\'' . $row_bankmasuk["transaction_id"] . '\')"><span class="label label-danger">Batal posting</span></a>' : '') . '
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
                                            ' . (halaman($sql_total_bankmasuk, $perhalaman, 1, $hal)) . '
                                        </div>
                                        <br style="clear:both;">
                                    </div>
                                </div><!-- /.box -->
                            </form>
                        </div>
                    </div>
                </section><!-- /.content -->
                <!-- Modal -->
                <div class="modal fade" id="modalbatalposting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Batal Posting</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-success" role="alert" id="batalpostingSuccess" style="display:none;"></div>
                                <div class="alert alert-danger" role="alert" id="batalpostingFailed" style="display:none;"></div>
                            <div id="panel-batalposting">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                             <label>No Transaction</label>
                                        </div>
                                        <div class="col-xs-6">
                                             <input type="text" readonly class="form-control" value="" name="transaction_id" id="transaction_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                             <label>Supervisor Password</label>
                                        </div>
                                        <div class="col-xs-6">
                                             <input type="password" class="form-control" value="" name="passwordbatal" id="passwordbatal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="submitbatal" class="btn btn-primary" onclick="batalposting_proses();">Batal Posting</button>
                            </div>
                        </div>
                    </div>
                </div>';

        $plugins = '
            <link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />
            <!-- DataTable -->
            <script>
                 function hapus(id)
                 {
                      var r = confirm("yakin untuk dihapus? "+id);
                      if (r === true) {
                          window.location.href = "master_bankmasuk?id=" + id + "&action=hapus";
                      }
                 }
                 function batalposting(x)
                 {
                      document.getElementById("panel-batalposting").style.display = "block";
                      document.getElementById("batalpostingSuccess").style.display = "none";
                      document.getElementById("batalpostingFailed").style.display = "none";
                      document.getElementById("submitbatal").style.display = "inline-block";
                      
                      $("#transaction_id").val(x);
                      $("#passwordbatal").val("");
                      $("#modalbatalposting").modal("show");
                 }
            
                function batalposting_proses(){
                    id = $("#transaction_id").val();
                    pass = $("#passwordbatal").val();
                    $.ajax({
                        url     : "batal_posting",
                        data    : { "id":id, "passwordbatal":pass},
                        type    : "POST",
                        success :  function(result){
                            var obj = jQuery.parseJSON(result);
                            if(obj.success == true){
                                setTimeout(function(){
                                    
                                    batalpostingSuccess();
                                    $("#batalpostingSuccess").html(obj.message);
                                },200);
                                setTimeout(function(){
                                    $("#modalbatalposting").modal("hide");
                                    window.location.reload();
                                },500);
                            }else{
                                setTimeout(function(){
                                    
                                    batalpostingFailed();
                                    $("#batalpostingFailed").html(obj.message);
                                },200);
                                //setTimeout(function(){
                                //	$("#modalbatalposting").modal("hide");
                                //},1000);
                            }
                        }
                    });
                }
            
                function batalpostingSuccess(){
                    document.getElementById("panel-batalposting").style.display = "none";
                    document.getElementById("submitbatal").style.display = "none";
                    
                    document.getElementById("batalpostingFailed").style.display = "none";
                    document.getElementById("batalpostingSuccess").style.display = "block";
                }
            
                function batalpostingFailed(){
                    document.getElementById("batalpostingSuccess").style.display = "none";
                    document.getElementById("batalpostingFailed").style.display = "block";
                    
                    document.getElementById("panel-batalposting").style.display = "none";
                    document.getElementById("submitbatal").style.display = "none";
                }
            </script>';

        $title = 'Master Bank Masuk';
        $sumasukenu = "bankmasuk";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $sumasukenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>