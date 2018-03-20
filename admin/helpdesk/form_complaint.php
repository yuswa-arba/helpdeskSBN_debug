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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox"); // for create log in newfunction2.php

        global $conn;
        global $conn_voip;

        $sql_last_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_add` LIKE '" . date("Y-m-d") . "%' ORDER BY `date_add` DESC", $conn)) + 1;

        if (isset($_GET['id_complaint'])) {
            $get_id = isset($_GET['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_complaint']))) : ""; // menambil nilai/string yang ada pada url

            $data_complaint = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				WHERE `gx_helpdesk_complaint`.`id_complaint` = '$get_id';", $conn));
        }
        $sql_last_data_spk = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE `date_add` LIKE '" . date("Y-m-d") . "%' ORDER BY `date_add` DESC", $conn)) + 1;
        $sql_last_data_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` ORDER BY `date_add` DESC", $conn)) + 1;
        $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;", $conn);

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="box">
                            <div class="box-body table-responsive">
                                <div class="box-header"></div><!-- /.box-header -->
                                
                                <form action="" method="post" name="form_complaint">
                                    <input type="hidden" style="" name="ID" value="' . (isset($_GET['id_complaint']) ? $_GET['id_complaint'] : "") . '" />
                                    
                                    <div >
                                        <fieldset>
                                            <legend>Data Customer</legend>
                                            
                                            <div class="table-container table-form">
                                                <a href="' . URL_ADMIN . 'helpdesk/data_cust.php?r=form_complaint" class="btn btn-sm bg-navy btn-flat margin pull-right"
                                                onclick="return valideopenerform(\'' . URL_ADMIN . 'helpdesk/data_cust.php?r=form_complaint\',\'complaint\');">Search Customer</a>
                                                <br>
                                                <table class="form" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td width="12.5%"><label>Complaint ID*</label></td>
                                                            <td width="37.5%">
                                                              <input type="text" readonly="" style="" name="troubleticket" value="GCT-' . date("dmy") . sprintf("%04d", $sql_last_data) . '" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="12.5%"><label>User ID*</label></td>
                                                            <td width="37.5%">
                                                              <input class="form-control" name="id_complaint" placeholder="ID Complaint" type="hidden" value="' . (isset($_GET["id_complaint"]) ? $_GET["id_complaint"] : "") . '" readonly="">
                                                              <input class="form-control required" readonly="" name="user_id" id="user_id" placeholder="User ID" type="text" value="' . (isset($_GET["id_complaint"]) ? $data_complaint['user_id'] : "") . '" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Customer Number*</label></td>
                                                            <td>
                                                              <input class="form-control" name="customer_number" readonly="" id="customer_number" placeholder="Customer Number" type="text" value="' . (isset($_GET["id_complaint"]) ? $data_complaint['cust_number'] : "") . '" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Name</label></td>
                                                            <td>
                                                              <input class="form-control" name="name" placeholder="Name" type="text" value="' . (isset($_GET["id_complaint"]) ? $data_complaint['name'] : "") . '" >
                                                            </td>
                                                        </tr>
                                                        <tr style="vertical-align: middle;">
                                                            <td style="vertical-align: middle;"><label>Address</label></td>
                                                            <td>
                                                              <textarea name="address" rows="3" cols="70" class="" style="resize: none;">' . (isset($_GET["id_complaint"]) ? $data_complaint['address'] : "") . '</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Phone</label></td>
                                                            <td>
                                                              <input class="form-control" name="phone" placeholder="Phone" type="text" value="' . (isset($_GET["id_complaint"]) ? $data_complaint['phone'] : "") . '" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Email</label></td>
                                                            <td>
                                                              <input class="form-control" name="email" placeholder="Email" type="text" value="' . (isset($_GET["id_complaint"]) ? $data_complaint['email'] : "") . '" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><legend>Data Complaint:</legend></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Media Complaint</label></td>
                                                            <td>
                                                                <select name="media" style="width:200px;">
                                                                    <option value="telephone" ' . ((isset($_GET["id_complaint"]) && $data_complaint["media"] == "telephone") ? 'selected="selected"' : "") . '>Telephone</option>
                                                                    <option value="email" ' . ((isset($_GET["id_complaint"]) && $data_complaint["media"] == "email") ? 'selected="selected"' : "") . '>Email</option>
                                                                    <option value="website" ' . ((isset($_GET["id_complaint"]) && $data_complaint["media"] == "website") ? 'selected="selected"' : "") . '>Website</option>
                                                                    <option value="sms" ' . ((isset($_GET["id_complaint"]) && $data_complaint["media"] == "sms") ? 'selected="selected"' : "") . '>SMS</option>
                                                                    <option value="walkin" ' . ((isset($_GET["id_complaint"]) && $data_complaint["media"] == "walkin") ? 'selected="selected"' : "") . '>Walk In</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Complaint Type</label></td>
                                                            <td>
                                                                <input class="required" type="radio" name="complaint_type" value="request" style="float:left;" ' . ((isset($_GET["id_complaint"]) && $data_complaint["complaint_type"] == "request") ? "checked" : "") . '>Request <a href="#" title="Hint." class="tooltip"><span title="Hint"> [?] </span></a>
                                                                <input class="required" type="radio" name="complaint_type" value="problem" style="float:left;" ' . ((isset($_GET["id_complaint"]) && $data_complaint["complaint_type"] == "problem") ? "checked" : "") . '>Problem
                                                            </td>
                                                        </tr>
                                                  
                                                        <tr>
                                                            <td><label>Which Side</label></td>
                                                            <td>
                                                              <input class="required" type="radio" name="which_side" value="wireless" style="float:left;" ' . ((isset($_GET["id_complaint"]) && $data_complaint["which_side"] == "wireless") ? "checked" : "") . '> Customer
                                                              <input class="required" type="radio" name="which_side" value="isp" style="float:left;"  ' . ((isset($_GET["id_complaint"]) && $data_complaint["which_side"] == "isp") ? "checked" : "") . '>  ISP 
                                                              <input class="required" type="radio" name="which_side" value="none" style="float:left;" ' . ((isset($_GET["id_complaint"]) && $data_complaint["which_side"] == "none") ? "checked" : "") . '>  None 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Status</label></td>
                                                            <td>
                                                                <select class="required" name="status" style="width:200px;">
                                                                <option value="">Choose one</option>
                                                                <option value="open" ' . ((isset($_GET["id_complaint"]) && $data_complaint["status"] == "open") ? 'selected="selected"' : "") . '>Open</option>
                                                                <option value="closed" ' . ((isset($_GET["id_complaint"]) && $data_complaint["status"] == "closed") ? 'selected="selected"' : "") . '>Closed</option>
                                                                <option value="reopen" ' . ((isset($_GET["id_complaint"]) && $data_complaint["status"] == "reopen") ? 'selected="selected"' : "") . '>Reopen</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Action</label></td>
                                                            <td>
                                                                <select name="action" style="width:200px;">
                                                                    <option value="">--</option>
                                                                    <option value="Handled by CSO" ' . ((isset($_GET["id_complaint"]) && $data_complaint["action"] == "Handled by CSO") ? 'selected="selected"' : "") . '>Handled by CSO</option>
                                                                    <option value="Request Trouble Ticket" ' . ((isset($_GET["id_complaint"]) && $data_complaint["action"] == "Request Trouble Ticket") ? 'selected="selected"' : "") . '>Request Trouble Ticket</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr style="vertical-align: middle;">
                                                            <td style="vertical-align: middle;"><label>Problem</label></td>
                                                            <td>
                                                              <textarea class="required" name="problem" rows="3" cols="70" style="resize: none;">' . (isset($_GET["id_complaint"]) ? $data_complaint['problem'] : "") . '</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr style="vertical-align: middle;">
                                                            <td style="vertical-align: middle;"><label>Note</label></td>
                                                            <td>
                                                              <input class="medium" name="id_ticket" placeholder="ID Ticket" type="hidden" value="' . (isset($_GET["id_complaint"]) ? $data_complaint['ticket_number'] : "") . '" readonly="">
                                                              <textarea name="note_" id="note_" rows="6" cols="40" style="resize: none;">' . (isset($_GET["id_complaint"]) ? $data_complaint['note_'] : "") . ' ' . (isset($_GET['threadid']) ? $data_note_chat : '') . ' </textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Create SPK ?</label></td>
                                                            <td>
                                                              <input class="required" type="radio" id="spk" name="spk" value="spk" style="float:left;" ' . ((isset($_GET["id_complaint"]) && $data_complaint["spk"] == "spk") ? "checked" : "") . '> Yes
                                                              <input class="required" type="radio" id="nonspk" name="spk" value="nonspk" style="float:left;" ' . ((isset($_GET["id_complaint"]) && $data_complaint["spk"] == "nonspk") ? "checked" : "") . '> No
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                                <div id="form_spk" style="display:none;">
                                                    <table class="form" width="100%">
                                                        <tr style="vertical-align: middle;">
                                                            <td style="vertical-align: middle;" width="12.5%">
                                                                  <label>Solusi</label>
                                                            </td>
                                                            <td width="37.5%">
                                                                  <input class="medium" name="id_ticket" placeholder="ID Ticket" type="hidden" value="" readonly="">
                                                                  <textarea name="solusi" id="note_" rows="3" cols="70" style="resize: none;">  </textarea>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div><br />
                                                
                                                <input class="form-control" name="id_complaint" placeholder="id complaint" type="hidden" value="' . $sql_last_data_complaint . '" readonly="">
                                                <input class="form-control" name="spk_number" placeholder="SPK Number" type="hidden" value="MCT-' . date("dmy") . sprintf("%04d", $sql_last_data_spk) . '" readonly="">
                                                <input name="created_by" value="' . $loggedin["username"] . '" type="hidden">
                                                <input name="id_employee" value="' . $loggedin["id_employee"] . '" type="hidden">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="actions">
                                        <div class="button-well">
                                            <input type="submit" class="button button-primary" data-icon="v" name="' . (isset($_GET["id_complaint"]) ? "update" : "save") . '" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $save = isset($_POST["save"]) ? $_POST["save"] : "";
        $update = isset($_POST["update"]) ? $_POST["update"] : "";

        if ($save == "Save") {

            $spk_number = isset($_POST['spk_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk_number']))) : "";
            $id_complaint = isset($_POST['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_complaint']))) : "";

            $ID = isset($_POST["ID"]) ? $_POST["ID"] : "";
            $troubleticket = isset($_POST["troubleticket"]) ? $_POST["troubleticket"] : "";
            $kategori = isset($_POST["id_kategori"]) ? $_POST["id_kategori"] : "";

            $user_id = isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
            $cust_number = isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
            $name = isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
            $address = isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
            $phone = isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
            $email = isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";

            $media = isset($_POST['media']) ? mysql_real_escape_string(strip_tags(trim($_POST['media']))) : "";
            $complaint_type = isset($_POST['complaint_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['complaint_type']))) : "";
            $which_side = isset($_POST['which_side']) ? mysql_real_escape_string(strip_tags(trim($_POST['which_side']))) : "";
            $status = isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
            $action = isset($_POST['action']) ? mysql_real_escape_string(strip_tags(trim($_POST['action']))) : "";
            $problem = isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
            $note_ = isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
            $spk = isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
            $solusi = isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";


            $insert_complaint = "INSERT INTO `gx_helpdesk_complaint` (`id_complaint`, `user_id`, `ticket_number`, `cust_number`,
				`name`, `email`, `address`, `phone`, `media`, `note_`, `type_client`, `problem`,
				`spk`, `solusi`, `status`, `action`, `which_side`, `complaint_type`,
				`id_cso`, `created_by`, `updated_by`, `date_add`, `date_upd`, `level`)
				VALUES ('', '$user_id', '$troubleticket', '$cust_number',
				'$name', '$email', '$address', '$phone', '$media', '$note_', 'client', '$problem',
				'$spk', '$solusi', '$status', '$action', '$which_side', '$complaint_type',
				'$loggedin[id_employee]', '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
            mysql_query($insert_complaint, $conn) or die ("<script language='JavaScript'>
                                                             alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                             window.history.go(-1);
                                                           </script>");

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Complaint = $insert_complaint"); // for create log in newfunction2.php

            if ($_POST['spk'] == "spk") {
                $query = "INSERT INTO `gx_helpdesk_spk` (`id_spk`, `spk_number`, `id_complaint`, `id_trouble_ticket`, `cust_number`, `name`, `address`, `problem`,
					`id_teknisi`, `date_add`, `date_upd`, `created_by`, `updated_by`, `level`)
					VALUES ('', '$spk_number', $id_complaint, '$troubleticket', '$cust_number', '$name', '$address', '$problem',
					'0', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";
                mysql_query($query, $conn) or die("<script language='JavaScript'>
                                                     alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                     window.history.go(-1);
                                                   </script>");
            }

            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'incoming.php';
                  </script>";
        } elseif ($update == "Save") {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : "";
            $troubleticket = isset($_POST["troubleticket"]) ? $_POST["troubleticket"] : "";
            $kategori = isset($_POST["id_kategori"]) ? $_POST["id_kategori"] : "";

            $user_id = isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
            $cust_number = isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
            $name = isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
            $address = isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
            $phone = isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
            $email = isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";

            $media = isset($_POST['media']) ? mysql_real_escape_string(strip_tags(trim($_POST['media']))) : "";
            $complaint_type = isset($_POST['complaint_type']) ? mysql_real_escape_string(strip_tags(trim($_POST['complaint_type']))) : "";
            $which_side = isset($_POST['which_side']) ? mysql_real_escape_string(strip_tags(trim($_POST['which_side']))) : "";
            $status = isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
            $action = isset($_POST['action']) ? mysql_real_escape_string(strip_tags(trim($_POST['action']))) : "";
            $problem = isset($_POST['problem']) ? mysql_real_escape_string(strip_tags(trim($_POST['problem']))) : "";
            $note_ = isset($_POST['note_']) ? mysql_real_escape_string(strip_tags(trim($_POST['note_']))) : "";
            $spk = isset($_POST['spk']) ? mysql_real_escape_string(strip_tags(trim($_POST['spk']))) : "";
            $solusi = isset($_POST['solusi']) ? mysql_real_escape_string(strip_tags(trim($_POST['solusi']))) : "";


            $insert_complaint = "UPDATE `gx_helpdesk_complaint` SET `user_id` = '$user_id', `cust_number` = '$cust_number', `name` = '$name', 
				`email` = '$email', `address` = '$address',`phone` = '$phone', `media` = '$media',`note_` = '$note_', `problem` = '$problem',
				`spk` = '$spk', `solusi` = '$solusi', `status` = '$status', `action` = '$action', `which_side` = '$which_side', `complaint_type` = '$complaint_type',
				`updated_by` = '$loggedin[username]', `date_upd` = NOW()
				WHERE `gx_helpdesk_complaint`.`id_complaint` = $ID;";
            mysql_query($insert_complaint, $conn) or die ("<script language='JavaScript'>
                                                             alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                             window.history.go(-1);
                                                           </script>");

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit Complaint = $insert_complaint"); // for create log in newfunction2.php

            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'incoming.php';
                  </script>";
        }

        $plugins = '';

        $title = 'Form Incoming';
        $submenu = "helpdesk_form_complaint";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>