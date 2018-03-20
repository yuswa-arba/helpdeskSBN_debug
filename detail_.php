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

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){

$submit = isset($_POST["deldetagenda"]) ? $_POST["deldetagenda"] : "";
	if($submit == "Hapus"){
		$id_detagendat = array();
		$id_detagendat = isset($_POST["id_detagnda"]) ? $_POST["id_detagnda"] : $id_detagendat;
		foreach($id_detagendat as $key => $value){
			$update    = mysql_query("UPDATE `gx_detAgenda2` SET level='1' WHERE `id_detagenda`='$value'") or die(mysql_error());
		}
	//echo $query;
	
	echo "<script language='JavaScript'>
			alert('Data telah dihapus!');
			location.href = 'agenda.php';
            </script>";
	}

    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">                               
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';
				if(isset($_GET["id_project"])){
    $title	= 'Staff';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "todolist";
    //echo date("Y-m-d H:i:s");
    $id_project	= isset($_GET['id_project']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_project']))) : "";
    $sql_project= mysql_query("SELECT * FROM `gx_todolist` WHERE `id_todolist` = '".$id_project."' AND `level` = '0' LIMIT 0,1;");
    $row_project = mysql_fetch_array($sql_project);


    $content .='<section id="content" style="margin-left:0px;" >
	  	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$row_project["title_todolist"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Status:
		</td>
		<td width="37.5%">
		    '.$row_project["status_todolist"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Start Date:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="estimated_start_date">'.$row_project["start_todolist"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Priority:
		</td>
		<td width="37.5%">
		    '.$row_project["priority_todolist"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    End Date:
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="estimated_end_date">'.$row_project["end_todolist"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Description:
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="description">'.$row_project["desc_todolist"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	<div id="detailpanel_1" class="detail">
	<table id="LBL_PANEL_ASSIGNMENT" class="table footable" cellspacing="0" style="margin-bottom: 0;">
	    <tbody><tr>
		<td width="12.5%" scope="col">
		    Assigned to:
		</td>
		<td width="37.5%">
		    <span id="assigned_user_id" class="sugar_field" data-id-value="32432825-c06f-90f9-1402-5295aab86f04">'.$row_project["assigned_to"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Date Modified:
		</td>
		<td width="37.5%">
		    <span id="modified_by_name" class="sugar_field">'.$row_project["date_upd"].' by '.$row_project["updated_by"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Created:
		</td>
		<td width="37.5%" colspan="3">
		    <span id="created_by_name" class="sugar_field">'.$row_project["date_add"].' by '.$row_project["updated_by"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	<!--REVIEW-->
	<h4>Review</h4>
	<div id="detailpanel_1" class="detail">
	<div class="table-container">
              <table class="table footable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Title</th>
		    <th>Description</th>
		    
		    <th>Date</th>
		    
                  </tr>
                </thead>
                <tbody>';

$sql_review	= "SELECT `gx_review`.*, `gx_employee`.`first_name`,`gx_employee`.`last_name` FROM `gx_review`, `gx_employee`
		WHERE `gx_review`.`id_employee` = `gx_employee`.`id_employee`
		AND `gx_review`.`id_project` = '$id_project'
		AND `gx_review`.`level` = '0' ORDER BY `gx_review`.`date_review` ASC LIMIT 0,5;";

$query_review	= mysql_query($sql_review);
$norev = 1;

    while ($row_review = mysql_fetch_array($query_review)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_review["first_name"].' '.$row_review["last_name"].'</td>
                    <td>'.$row_review["assigned_to"].'</td>
		    <td>'.$row_review["title_review"].'</td>
		    <td>'.$row_review["desc_review"].'</td>
		    <td>'.$row_review["date_review"].'</td>
		    </tr>';
	$no++;
    }                  

$content .= '</tbody>
              </table>
            </div>
	</div>
	</div>
	</section>';
}elseif(isset($_GET["id_report"])){
    $title	= 'Staff';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "Report";
    
    $id_report	= isset($_GET['id_report']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_report']))) : "";
    
    if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
	$sql_report= mysql_query("SELECT `gx_report`.*, `gx_employee`.`first_name`, `gx_employee`.`last_name` FROM `gx_report`, `gx_employee`
			    WHERE `gx_report`.`id_employee` = `gx_employee`.`id_employee`
			    AND  `gx_report`.`id_report` = '".$id_report."'
			    AND `gx_report`.`level` = '0' LIMIT 0,1;");
	$row_report = mysql_fetch_array($sql_report);
    }elseif($loggedin["group"] == 'staff' || $loggedin["group"] == 'marketing' || $loggedin["group"] == 'riset' || $loggedin["group"] == 'teknisi' || $loggedin["group"] == 'cso'){
	$sql_report= mysql_query("SELECT `gx_report`.*, `gx_employee`.`first_name`, `gx_employee`.`last_name` FROM `gx_report`, `gx_employee`
			    WHERE `gx_report`.`id_employee` = `gx_employee`.`id_employee`
			    AND  `gx_report`.`id_report` = '".$id_report."'
			    AND `gx_report`.`level` = '0'
			   AND `gx_report`.`id_employee` = '".$loggedin["id_user"]."' LIMIT 0,1;");
	
	$row_report = mysql_fetch_array($sql_report);
    }


    $content .='<section id="content">
	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Staff Name:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_report["first_name"].' '.$row_report["last_name"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Title:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_report["title_report"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    No SPK:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_report["no_spk"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Report:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_report["date_report"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Daily Report:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_report["desc_report"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Created
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_report["date_add"].', by: '.$row_report["created_by"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	
	</div>
	</div>
	</section>';
}elseif(isset($_GET["id_agenda"])){
    $title	= 'Agenda';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "Agenda";
    
    $id_agenda	= isset($_GET['id_agenda']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_agenda']))) : "";
    
    if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT `gx_agenda`.*, `gx_employee`.`first_name`, `gx_employee`.`last_name` FROM `gx_agenda`, `gx_employee`
			    WHERE `gx_agenda`.`id_employee` = `gx_employee`.`id_employee`
			    AND  `gx_agenda`.`id_agenda` = '".$id_agenda."'
			    AND `gx_agenda`.`level` = '0' LIMIT 0,1;");
	$row_agenda = mysql_fetch_array($sql_agenda);
    }elseif($loggedin["group"] == 'staff' || $loggedin["group"] == 'marketing' || $loggedin["group"] == 'riset' || $loggedin["group"] == 'teknisi' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT `gx_agenda`.*, `gx_employee`.`first_name`, `gx_employee`.`last_name` FROM `gx_agenda`, `gx_employee`
			    WHERE `gx_agenda`.`id_employee` = `gx_employee`.`id_employee`
			    AND  `gx_agenda`.`id_agenda` = '".$id_agenda."'
			    AND `gx_agenda`.`level` = '0'
			   AND `gx_report`.`id_employee` = '".$loggedin["id_user"]."' LIMIT 0,1;");
	
	$row_agenda = mysql_fetch_array($sql_agenda);
    }


    $content .='<section id="content">
	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    
	    <tr>
		<td width="12.5%" scope="col">
		    Title:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["title_agenda"].'</span>
		</td>
	    </tr>
	    <tr valign="top">
		<td width="12.5%" scope="col">
		    Agenda
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">
		    
		    ';
		    $sql_agenda2	= "SELECT * FROM `gx_detagenda` WHERE `level` = '0' AND `id_agenda` = '$row_agenda[id_agenda]' ORDER BY `date_add` ASC";
		    $query_agenda2	= mysql_query($sql_agenda2);
		    while ($row_agenda2 = mysql_fetch_array($query_agenda2)) {
		    $content .=''.nl2br($row_agenda2["desc_agenda"]).' <font style="font-weight: bolder;">('.$row_agenda2["status"].')</font> <br />';
		    }
		    $content .='
		    
		    </span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Agenda:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["start_agenda"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Created by:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["created_by"].' on '.$row_agenda["date_add"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Updated by:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["updated_by"].' on '.$row_agenda["date_upd"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	
	</div>
	</div>
	</section>';
	
}elseif(isset($_GET["id_staff"])){
    
    $title	= 'Staff';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "";
    
    $save_staff = isset($_POST["save_staff"]) ? $_POST["save_staff"] : "";

if($save_staff == "Save"){
	$id_employee	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
	$first_name	= isset($_POST['first_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['first_name']))) : "";
	$last_name	= isset($_POST['last_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['last_name']))) : "";
	$department	= isset($_POST['department']) ? mysql_real_escape_string(strip_tags(trim($_POST['department']))) : "";
	$title		= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone_home 	= isset($_POST['phone_home']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone_home']))) : "";
	$phone_work 	= isset($_POST['phone_work']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone_work']))) : "";
	$phone_fax 	= isset($_POST['phone_fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone_fax']))) : "";
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$created_by 	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	$report_to 	= isset($_POST['report_to']) ? mysql_real_escape_string(strip_tags(trim($_POST['report_to']))) : "";
	$date_in 	= isset($_POST['date_in']) ? mysql_real_escape_string(strip_tags(trim($_POST['date_in']))) : "";
	$id_port 	= isset($_POST['id_port']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_port']))) : "";
	$im_active 	= isset($_POST['im_active']) ? mysql_real_escape_string(strip_tags(trim($_POST['im_active']))) : "";
	$skype_active 	= isset($_POST['skype_active']) ? mysql_real_escape_string(strip_tags(trim($_POST['skype_active']))) : "";
	
	
	$query = "UPDATE `gx_employee` SET `first_name` = '$first_name', `last_name` = '$last_name', `title` = '$title',
			  `department` = '$department', `address` = '$address', `phone_fax` = '$phone_fax',
			  `phone_home` = '$phone_home', `phone_work` = '$phone_work', `email` = '$email',
			  `report_to` = '$report_to', `date_in` = '$date_in', `skype_active` = '$skype_active',
			  `im_active` = '$im_active', `date_upd` = NOW() 
		WHERE `id_employee` = '".$id_employee."';";
		
	//echo $query;
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'detail_staff.php?id_staff=$id_employee';
            </script>";
}
	    $id_staff		= isset($_GET['id_staff']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_staff']))) : "";
	    $sql_employee	= "SELECT * FROM `gx_employee` WHERE `level` = '0' AND `id_employee` = '$id_staff' ORDER BY `id_employee` ASC LIMIT $start, $perhalaman;";
	    $query_employee	= mysql_query($sql_employee);
	    $row_employee = mysql_fetch_array($query_employee);
    //echo date("Y-m-d H:i:s");
    $content .='
        <section id="content">
	  
	  <div class="tab-content" id="form_staff">
            <form action="detail_staff.php" method="post" name="form_staff" id="form_staff"  method="post" enctype="multipart/form-data">
	    <div class="table-container table-form">	    
              <table class="form">
                <tr>
                  <td>
                    <label>First Name</label>
                  </td>
                  <td>
                    <input class="large" name="first_name" placeholder="First Name" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["first_name"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Last Name</label>
                  </td>
                  <td>
                    <input class="large" name="last_name" placeholder="Last Name" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["last_name"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Department</label>
                  </td>
                  <td>
                    <input class="large" name="department" placeholder="Department" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["department"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Title</label>
                  </td>
                  <td>
                    <input class="large" name="title" placeholder="Title" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["title"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Port</label>
                  </td>
                  <td>
                    <div class="select">
                      <select name="port" title="" style="width:150px;">';
$sql_port = mysql_query("SELECT * FROM `gx_port` WHERE `level` = '0';");

while($row_port = mysql_fetch_array($sql_port)){
    $content .='<option label="'.$row_port["name_port"].'" value="'.$row_port["id_port"].'" '.((isset($_GET["id_staff"]) && $row_employee["id_port"]== $row_port["id_port"] )? 'selected="selected"' :"") .'>'.$row_port["name_port"].'</option>';
}
                  $content .='</td>
                </tr>
		<tr>
                  <td>
                    <label>Address</label>
                  </td>
                  <td>
		    <textarea name="address" placeholder="Description">'.(isset($_GET["id_staff"]) ? $row_employee["address"] :"") .'</textarea>
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Phone Home</label>
                  </td>
                  <td>
                    <input class="large" name="phone_home" placeholder="Phone Home" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["phone_home"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Phone Work</label>
                  </td>
                  <td>
                    <input class="large" name="phone_work" placeholder="Phone Work" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["phone_work"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Phone FAX</label>
                  </td>
                  <td>
                    <input class="large" name="phone_fax" placeholder="Phone FAX" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["phone_fax"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Email</label>
                  </td>
                  <td>
                    <input class="large" name="email" placeholder="Email" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["email"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Yahoo! Messenger</label>
                  </td>
                  <td>
                    <input class="large" name="im_active" placeholder="Yahoo! Messenger" type="text"  value="'.(isset($_GET["id_staff"]) ? $row_employee["im_active"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Skype Account</label>
                  </td>
                  <td>
                    <input class="large" name="skype_active" placeholder="Skype Account" type="text"  value="'.(isset($_GET["id_staff"]) ? $row_employee["skype_active"] :"") .'">
                  </td>
                </tr>
		<tr>
                  <td>
                    <label>Report To</label>
                  </td>
                  <td>
                    <input class="large" name="report_to" placeholder="Report To" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["report_to"] :"") .'">
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Date in</label>
                  </td>
                  <td>
                    <input data-datepicker placeholder="Date in" name="date_in" type="text" value="'.(isset($_GET["id_staff"]) ? $row_employee["date_in"] :"") .'">
                  </td>
                </tr>
              </table>
	      <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
	      <input name="id_employee" value="'.(isset($_GET["id_staff"]) ? (int)$_GET["id_staff"] :"") .'" type="hidden">
            </div>
            <div class="actions">
              <div class="button-well">
                <input type="submit" class="button button-primary" name="save_staff" data-icon="v" value="Save">
              </div>
              <a class="button button-link" data-icon="[" href="staff.php">Go back to the index page</a>
            </div>
	    </form>
          </div>
	  
          <div class="tab-content active" id="footable">
	    <div id="detailpanel_1" class="detail">
	    <table id="" class="form" cellspacing="0" style="margin-bottom: 0;">
		<tbody>
		    <tr>
			<td width="12.5%" scope="col">
			    Employee Status:
			</td>
			<td width="37.5%" colspan="3">
			    <span id="employee_status_span">
			    Active
			    </span>
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Name:
			</td>
			<td width="37.5%" colspan="3">
			    <span id="first_name" class="sugar_field">'.$row_employee["first_name"].' '.$row_employee["last_name"].'</span>
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Title:
			</td>
			<td width="37.5%">
			    <span class="sugar_field" id="title">'.$row_employee["title"].'</span>
			</td>
			<td width="12.5%" scope="col">
			    Work Phone:
			</td>
			<td width="37.5%" class="phone">
			     '.$row_employee["phone_work"].'
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Department:
			</td>
			<td width="37.5%">
			    <span class="sugar_field" id="department">'.$row_employee["department"].'</span>
			</td>
			<td width="12.5%" scope="col">
			    Fax:
			</td>
			<td width="37.5%" class="phone">
			    '.$row_employee["phone_fax"].'
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Reports to:
			</td>
			<td width="37.5%">
			    <span id="reports_to_name" class="sugar_field">'.$row_employee["report_to"].'</span>
			</td>
			<td width="12.5%" scope="col">
			    Mobile Phone:
			</td>
			<td width="37.5%" class="phone">
			    '.$row_employee["phone_home"].'
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    YM Active:
			</td>
			<td width="37.5%" colspan="3">
			    '.$row_employee["im_active"].'
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Skype Active:
			</td>
			<td width="37.5%" colspan="3">
			    <span class="sugar_field" id="messenger_id">'.$row_employee["skype_active"].'</span>
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Address:
			</td>
			<td width="37.5%" colspan="3">
			    <span id="address_country" class="sugar_field">'.$row_employee["address"].'</span>
			</td>
		    </tr>
		    <tr>
			<td width="12.5%" scope="col">
			    Email Address:
			</td>
			<td width="37.5%" colspan="3">
			    <span id="email1_span">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				    <tbody>
					<tr>
					    <td style="border:none;">
						<b>
						<a >'.$row_employee["email"].'</a>
						</b>&nbsp;<i>(Primary)&lrm;</i>
					    </td>
					</tr>
				    </tbody>
				</table>
			    </span>
		    </td>
		    </tr>
		    </tbody>
		</table>
	    </div>
          </div>
        </section>
        
      ';

//detail Complaint    
}elseif(isset($_GET["id_complaint"])){
    $title	= 'Customer';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "Complaint";
    //echo date("Y-m-d H:i:s");

    $id_complaint	= isset($_GET['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_complaint']))) : "";
    $sql_complaint	= mysql_query("SELECT * FROM `gx_complaint` WHERE `id_complaint` = '".$id_complaint."' AND `level` = '0' LIMIT 0,1;");
    $row_complaint 	= mysql_fetch_array($sql_complaint);
    $ticket		= $row_complaint["ticket_number"];

    $content .='<section id="content" style="margin-left:0px;" >
	  	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Ticket Number:
		</td>
		<td width="37.5%">
		    '.$row_complaint["ticket_number"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$row_complaint["name"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Status:
		</td>
		<td width="37.5%">
		    '.$row_complaint["status"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="estimated_start_date">'.$row_complaint["log_time"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Action:
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="estimated_end_date">'.$row_complaint["action"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Problem:
		</td>
		<td width="37.5%">
		    '.$row_complaint["problem"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Solusi:
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="description">'.$row_complaint["solusi"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Created:
		</td>
		<td width="37.5%" colspan="3">
		    <span id="created_by_name" class="sugar_field">'.$row_complaint["date_add"].' by '.$row_complaint["created_by"].'</span>
		</td>
	     </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Modified:
		</td>
		<td width="37.5%">
		    <span id="modified_by_name" class="sugar_field">'.$row_complaint["date_upd"].' by '.$row_complaint["updated_by"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	
	<!--REVIEW-->
	<h4>Detail Update</h4>
	<div id="detailpanel_1" class="detail">
	<div class="table-container">
              <table class="data display datatable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>CSO</th>
                    <th>Problem</th>
		    <th>Date</th>
		    
                  </tr>
                </thead>
                <tbody>';

$sql_review	= "SELECT `gx_detComplaint`.*, `gx_complaint`.`id_complaint`, `gx_complaint`.`log_time` FROM `gx_detComplaint`, `gx_complaint`
		    WHERE `gx_complaint`.`ticket_number` = `gx_detComplaint`.`trouble_ticket`
		    AND `gx_complaint`.`ticket_number` = '$ticket'
		    AND `gx_detComplaint`.`level` = '0' ORDER BY `gx_detComplaint`.`date_created` ASC LIMIT 0,5";

$query_review	= mysql_query($sql_review);
$norev = 1;

    while ($row_review = mysql_fetch_array($query_review)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_review["created_by"].'</td>
		    <td>'.$row_review["problem"].'</td>
		    <td>'.$row_review["date_upd"].'</td>
		    
                    
                  </tr>';
	$no++;
    }                  

$content .= '</tbody>
              </table>
            </div>
	</div>
	</div>
	</section>';
	
//detail Prospek  
}elseif(isset($_GET["id_prospek"])){
    
    $title	= 'Customer';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "Complaint";
    //echo date("Y-m-d H:i:s");

    $id_prospek		= isset($_GET['id_prospek']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_prospek']))) : "";
    $sql_prospek	= mysql_query("SELECT * FROM `gx_complaint` WHERE `id_complaint` = '".$id_prospek."' AND `type_client` = 'nonclient' AND `level` = '0' LIMIT 0,1;");
    $row_prospek 	= mysql_fetch_array($sql_prospek);
    $ticket		= $row_prospek["ticket_number"];

    $content .='<section id="content" style="margin-left:0px;" >
	  	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$row_prospek["name"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Status:
		</td>
		<td width="37.5%">
		    '.$row_prospek["status_prospek"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Address:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="estimated_start_date">'.$row_prospek["address"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Phone:
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="estimated_end_date">'.$row_prospek["phone"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Note:
		</td>
		<td width="37.5%">
		    '.$row_prospek["note_nclient"].'
		</td>
		
	    </tr>
	    
	    <tr>
		<td width="12.5%" scope="col">
		    Date Created:
		</td>
		<td width="37.5%" colspan="3">
		    <span id="created_by_name" class="sugar_field">'.$row_prospek["date_add"].' by '.$row_prospek["created_by"].'</span>
		</td>
	     </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Modified:
		</td>
		<td width="37.5%">
		    <span id="modified_by_name" class="sugar_field">'.$row_prospek["date_upd"].' by '.$row_prospek["updated_by"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	</section>';
	
//detail SPK Teknisi 
}elseif(isset($_GET["id_spk"])){
    $title	= 'Customer';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "Complaint";
    //echo date("Y-m-d H:i:s");

    $id_spk	= isset($_GET['id_spk']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_spk']))) : "";
    $sql_spk	= mysql_query("SELECT `gx_spk`.*, `gx_complaint`.`user_id`, `gx_complaint`.`action`, `gx_complaint`.`name`, `gx_complaint`.`address`,
                                      `gx_complaint`.`phone`, `gx_complaint`.`connection_type`, `gx_complaint`.`solusi`,
                                      `gx_complaint`.`status`, `user_details`.`first_name`, `user_details`.`last_name` FROM `gx_spk`, `gx_complaint`,`user_details`
                                      WHERE `gx_spk`.`id_trouble_ticket` = `gx_complaint`.`ticket_number`
                                      AND `gx_spk`.`id_teknisi` = `user_details`.`id_user`
                                      AND `gx_spk`.`id_spk` = '$id_spk';");
    $row_spk    = mysql_fetch_array($sql_spk);
    $ticket		= $row_spk["id_trouble_ticket"];
    
    $pisah_tanggal_jam = explode(" ",$row_spk['date_add']);
    $pisah_tanggal = explode("-",$pisah_tanggal_jam[0]);
    $str_pisah_tanggal=array($pisah_tanggal['2'],$pisah_tanggal['1'],$pisah_tanggal['0']);
    $tanggal = implode("/",$str_pisah_tanggal);
    
    $content .='<section id="content" style="margin-left:0px;" >
	  	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    No. SPK :
		</td>
		<td width="37.5%">
		    '.$row_spk["spk_number"].'
		</td>
		<td width="12.5%" scope="col">
		    Ticket Number :
		</td>
		<td width="37.5%">
		    '.$row_spk["id_trouble_ticket"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		   Maintenance By :
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name_tech">'.$row_spk['first_name'].' '.$row_spk['last_name'].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Customer Name :
		</td>
		<td width="37.5%">
		    '.$row_spk["name"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		   Maintenance Date :
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="estimated_start_date">'.$tanggal.'</span>
		</td>
		<td width="12.5%" scope="col">
		    Customer Address :
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="estimated_end_date">'.$row_spk["address"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		   
		</td>
		<td width="37.5%">
		    
		</td>
		<td width="12.5%" scope="col">
		    Phone Number :
		</td>
		<td width="37.5%" >
		    <span class="sugar_field" id="estimated_end_date">'.$row_spk["phone"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Complaint :
		</td>
		<td width="37.5%" colspan="3">
		    '.$row_spk["problem"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Solusi :
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="description">'.$row_spk["solusi"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Created :
		</td>
		<td width="37.5%">
		    <span id="created_by_name" class="sugar_field">'.$row_spk["date_add"].' by '.$row_spk["created_by"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Status :
		</td>
		<td width="37.5%">
		    '.$row_spk["status"].'
		</td>
	     </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Modified :
		</td>
		<td width="37.5%">
		    <span id="modified_by_name" class="sugar_field">'.$row_spk["date_upd"].' by '.$row_spk["updated_by"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	
	<!--REVIEW
	<h4>Detail Update</h4>
	<div id="detailpanel_1" class="detail">
	<div class="table-container">
              <table class="table footable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>CSO</th>
                    <th>Problem</th>
		    <th>Date</th>
		    
                  </tr>
                </thead>
                <tbody>';

$sql_review	= "SELECT `gx_detComplaint`.*, `gx_complaint`.`id_complaint`, `gx_complaint`.`log_time` FROM `gx_detComplaint`, `gx_complaint`
		    WHERE `gx_complaint`.`ticket_number` = `gx_detComplaint`.`trouble_ticket`
		    AND `gx_complaint`.`ticket_number` = '$ticket'
		    AND `gx_detComplaint`.`level` = '0' ORDER BY `gx_detComplaint`.`date_created` ASC LIMIT 0,5";

$query_review	= mysql_query($sql_review);
$norev = 1;

    while ($row_review = mysql_fetch_array($query_review)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_review["created_by"].'</td>
		    <td>'.$row_review["problem"].'</td>
		    <td>'.$row_review["date_upd"].'</td>
		    
                    
                  </tr>';
	$no++;
    }                  

$content .= '</tbody>
              </table>
            </div>
	</div>-->
	</div>
	</section>';
	
//detail SPK Survey Marketing  
}elseif(isset($_GET["id_spk_survey"])){
    $title	= 'Customer';
    $user	= ucfirst($loggedin["username"]);
    $submenu	= "Complaint";
    //echo date("Y-m-d H:i:s");

    $id_spk	= isset($_GET['id_spk_survey']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_spk_survey']))) : "20";
    $sql_spk	= mysql_query("SELECT  `gx_spk` . * ,  `gx_complaint`.`user_id` ,  `gx_complaint`.`note_nclient` ,  `gx_complaint`.`action` ,  `gx_complaint`.`name` ,  `gx_complaint`.`address` ,  `gx_complaint`.`phone` ,  `gx_complaint`.`connection_type` , `gx_complaint`.`solusi` ,  `gx_complaint`.`status` ,  `user_details`.`first_name` ,  `user_details`.`last_name` 
					FROM  `gx_spk` ,  `gx_complaint` ,  `user_details` 
					WHERE  `gx_spk`.`id_complaint` =  `gx_complaint`.`id_complaint` 
					AND  `gx_spk`.`id_marketing` =  `user_details`.`id_user` 
                                        AND `gx_spk`.`id_spk` = '$id_spk';");
    $row_spk    = mysql_fetch_array($sql_spk);
    $ticket		= $row_spk["id_trouble_ticket"];
    
    /*$pisah_tanggal_jam = explode(" ",$row_spk["date_add"]);
    $pisah_tanggal = explode("-",$pisah_tanggal_jam[0]);
    $str_pisah_tanggal=array($pisah_tanggal['2'],$pisah_tanggal['1'],$pisah_tanggal['0']);
    $tanggal = implode("/",$str_pisah_tanggal);
    */
    $content .='<section id="content" style="margin-left:0px;" >
	  	  
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    No. SPK :
		</td>
		<td width="37.5%">
		    '.$row_spk["spk_number"].'
		</td>
		<td width="12.5%" scope="col">
		    
		</td>
		<td width="37.5%">
		    
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		   S By :
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name_tech">'.$row_spk['first_name'].' '.$row_spk['last_name'].'</span>
		</td>
		<td width="12.5%" scope="col">
		    Customer Name :
		</td>
		<td width="37.5%">
		    '.$row_spk["name"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		   Survey Date :
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="estimated_start_date"></span>
		</td>
		<td width="12.5%" scope="col">
		    Customer Address :
		</td>
		<td width="37.5%" colspan="3">
		    <span class="sugar_field" id="estimated_end_date">'.$row_spk["address"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		   
		</td>
		<td width="37.5%">
		    
		</td>
		<td width="12.5%" scope="col">
		    Phone Number :
		</td>
		<td width="37.5%" >
		    <span class="sugar_field" id="estimated_end_date">'.$row_spk["phone"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Note :
		</td>
		<td width="37.5%" colspan="3">
		    '.$row_spk["note_nclient"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Created :
		</td>
		<td width="37.5%">
		    <span id="created_by_name" class="sugar_field">'.$row_spk["date_add"].' by '.$row_spk["created_by"].'</span>
		</td>
		<td width="12.5%" scope="col">
		    
		</td>
		<td width="37.5%">
		    
		</td>
	     </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date Modified :
		</td>
		<td width="37.5%">
		    <span id="modified_by_name" class="sugar_field">'.$row_spk["date_upd"].' by '.$row_spk["updated_by"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	
	<!--REVIEW
	<h4>Detail Update</h4>
	<div id="detailpanel_1" class="detail">
	<div class="table-container">
              <table class="table footable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>CSO</th>
                    <th>Problem</th>
		    <th>Date</th>
		    
                  </tr>
                </thead>
                <tbody>';

$sql_review	= "SELECT `gx_detComplaint`.*, `gx_complaint`.`id_complaint`, `gx_complaint`.`log_time` FROM `gx_detComplaint`, `gx_complaint`
		    WHERE `gx_complaint`.`ticket_number` = `gx_detComplaint`.`trouble_ticket`
		    AND `gx_complaint`.`ticket_number` = '$ticket'
		    AND `gx_detComplaint`.`level` = '0' ORDER BY `gx_detComplaint`.`date_created` ASC LIMIT 0,5";

$query_review	= mysql_query($sql_review);
$norev = 1;

    while ($row_review = mysql_fetch_array($query_review)) {
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_review["created_by"].'</td>
		    <td>'.$row_review["problem"].'</td>
		    <td>'.$row_review["date_upd"].'</td>
		    
                    
                  </tr>';
	$no++;
    }                  

$content .= '</tbody>
              </table>
            </div>
	</div>-->
	</div>
	</section>';
}elseif(isset($_GET["id_detagenda"])){
    $title	= 'Agenda';
    $user	= ucfirst($loggedin["username"]);
    //$submenu	= "Agenda";
    
    $id_agenda	= isset($_GET['id_detagenda']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_detagenda']))) : "";
    
    if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT * FROM `gx_agenda2`
			    WHERE `gx_agenda2`.`id_agenda` = '$id_agenda'
			    AND `gx_agenda2`.`level` = '0' LIMIT 0,1;");
	$row_agenda = mysql_fetch_array($sql_agenda);
    }elseif($loggedin["group"] == 'staff' || $loggedin["group"] == 'marketing' || $loggedin["group"] == 'riset' || $loggedin["group"] == 'teknisi' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT `gx_agenda2`.*, `gx_employee`.`first_name`, `gx_employee`.`last_name` FROM `gx_agenda2`, `gx_employee`
			    WHERE `gx_agenda2`.`id_employee` = `gx_employee`.`id_employee`
			    AND  `gx_agenda2`.`id_agenda` = '".$id_agenda."'
			    AND `gx_agenda2`.`level` = '0'
			   AND `gx_report`.`id_employee` = '".$loggedin["id_user"]."' LIMIT 0,1;");
	
	$row_agenda = mysql_fetch_array($sql_agenda);
    }


    $content .='<section id="content">
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    
	    <tr>
		<td width="12.5%" scope="col">
		    Title:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["title_agenda"].'</span>
		</td>
	    </tr>
	    <tr valign="top">
		<td width="12.5%" scope="col">
		    Agenda
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">
		    
		    ';
		    $sql_agenda2	= "SELECT * FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_agenda` = '$row_agenda[id_agenda]' ORDER BY `date_add` ASC";
		    $query_agenda2	= mysql_query($sql_agenda2);
		    while ($row_agenda2 = mysql_fetch_array($query_agenda2)) {
		    $content .='<a href="form_agenda_new.php?id_detail='.($row_agenda2["id_detagenda"]).'" title="'.nl2br($row_agenda2["title_detagenda"]).'">'.nl2br($row_agenda2["title_detagenda"]).'</a> <font style="font-weight: bolder;">('.$row_agenda2["status"].')</font> <br />';
		    }
		    $content .='
		    
		    </span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name"></span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Created by:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["created_by"].' on '.$row_agenda["date_add"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Updated by:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">'.$row_agenda["updated_by"].' on '.$row_agenda["date_upd"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
	</div>
	
	
	</div>
	</div>
	</section>';
	
}elseif(isset($_GET["id_detailgenda"])){
    $title	= 'Agenda';
    $user	= ucfirst($loggedin["username"]);
    //$submenu	= "Agenda";
    
    $id_detagenda2	= isset($_GET['id_detailgenda']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_detailgenda']))) : "";
    $id_agenda		= isset($_GET['id_detailgenda']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_detailgenda']))) : "";
    
    if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT * FROM `gx_detAgenda2` WHERE `id_detagenda` = '".$id_detagenda2."' AND
		    `level` = '0' LIMIT 0,1;");
	$row_agenda = mysql_fetch_array($sql_agenda);
    }elseif($loggedin["group"] == 'staff' || $loggedin["group"] == 'marketing' || $loggedin["group"] == 'riset' || $loggedin["group"] == 'teknisi' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT * FROM `gx_detAgenda2` WHERE `id_detagenda` = '".$id_detagenda2."' AND
		    `level` = '0' LIMIT 0,1;");
	
	$row_agenda = mysql_fetch_array($sql_agenda);
    }

    $submit = isset($_POST["deldetagenda"]) ? $_POST["deldetagenda"] : "";
	if($submit == "Hapus"){
		$id_detagendat = array();
		$id_detagendat = isset($_POST["id_detagnda"]) ? $_POST["id_detagnda"] : $id_detagendat;
		foreach($id_detagendat as $key => $value){
			$update    = mysql_query("UPDATE `gx_detAgenda2` SET level='1' WHERE `id_detagenda`='$value'") or die(mysql_error());
		}
		
	
	//echo $query;
	
	echo "<script language='JavaScript'>
			alert('Data telah dihapus!');
			location.href = 'detail_.php?id_detailgenda=$id_detagenda2';
            </script>";
	}

    $content .='<section id="content">
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
	  <form action="" method="post" name="form_delagenda">
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    
	    <tr>
		<td width="12.5%" scope="col">
		    Title:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name"> '.$row_agenda["title_detagenda"].'</span>
		</td>
	    </tr>
	    <tr valign="top">
		<td width="12.5%" scope="col">
		    Agenda
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name">
		    
		    ';
		    if(($row_agenda['type_detagenda'] == "wsub") || ($row_agenda['type_detagenda'] == "end")){
			$sql_agenda2	= "SELECT * FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_parent_agenda` = '$row_agenda[id_detagenda]' AND `id_parent_agenda` != '0' ORDER BY `date_add` ASC";
		    }else{
			$sql_agenda2	= "SELECT * FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_parent_agenda` = '$row_agenda[id_detail]' AND `id_parent_agenda` != '0' ORDER BY `date_add` ASC";
		    }
		    
		    
		    $query_agenda2	= mysql_query($sql_agenda2);
		    while ($row_agenda2 = mysql_fetch_array($query_agenda2)) {
			if($row_agenda2["priority"]  == "1"){
			    $priority 	= "High";    
			}elseif($row_agenda2["priority"]  == "2"){
			    $priority 	= "Medium";    
			}elseif($row_agenda2["priority"]  == "3"){
			    $priority 	= "Low";    
			}
		if($row_agenda2["type_detagenda"] == "wsub"){
			    $content .='<input type="checkbox" name="id_detagnda[]" value="'.$row_agenda2["id_detagenda"].'"> <a style="color : #025;" href="detail_.php?id_detailgenda='.($row_agenda2["id_detagenda"]).'"  title="'.nl2br($row_agenda2["desc_detagenda"]).'" onclick="return valideopenerform2(\'detail_.php?id_detailgenda='.($row_agenda2["id_detagenda"]).'\',\'iddesc'.$row_agenda2["id_detagenda"].'\');">'.nl2br($row_agenda2["desc_detagenda"]).'</a> <a href="form_agenda_new.php?id_detail='.$row_agenda2["id_detagenda"].'"><font style="font-weight: bolder;">('.$row_agenda2["status"].')</font></a> <font style="font-weight: bolder;float : right;">Priority : '.$priority.'</font> <font style="font-weight: bolder;float: right;padding-right: 20px;">Target : '.$row_agenda2["target"].'</font> <br />';
			}else{
			    $content .='<input type="checkbox" name="id_detagnda[]" value="'.$row_agenda2["id_detagenda"].'"> <a style="color : #025;" href="detail_.php?id_descagenda='.($row_agenda2["id_detagenda"]).'"  title="'.nl2br($row_agenda2["desc_detagenda"]).'" onclick="return valideopenerform2(\'detail_.php?id_descagenda='.($row_agenda2["id_detagenda"]).'\',\'iddesc'.$row_agenda2["id_detagenda"].'\');">'.nl2br($row_agenda2["desc_detagenda"]).'</a> <a href="desc_detail_agenda.php?id_desc='.($row_agenda2["id_detagenda"]).'"><font style="font-weight: bolder;">('.$row_agenda2["status"].')</font></a> <font style="font-weight: bolder;float : right;">Priority : '.$priority.'</font> <font style="font-weight: bolder;float: right;padding-right: 20px;">Target : '.$row_agenda2["target"].'</font> <br />';
			}
		    }
		    $content .='
		    
		    </span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name"></span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Created by:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name"> '.$row_agenda["create_by"].' on '.$row_agenda["date_add"].'</span>
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Updated by:
		</td>
		<td width="77.5%">
		    <span class="sugar_field" id="name"> '.$row_agenda["updated_by"].' on '.$row_agenda["date_upd"].'</span>
		</td>
	    </tr>
	    </tbody>
	</table>
		  <div class="actions">
			<div class="button-well">
	  
			  <input type="submit" class="button button-primary" data-icon="v" name="deldetagenda" value="Hapus">
			</div>
			
		  </div>
		  </form>
	</div>
	
	
	</div>
	</div>
	</section>';
	
}elseif(isset($_GET["id_descagenda"])){
    $title	= 'Agenda';
    $user	= ucfirst($loggedin["username"]);
    //$submenu	= "Agenda";
    
    $id_detagenda2	= isset($_GET['id_descagenda']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_descagenda']))) : "";
    $id_agenda		= isset($_GET['id_descagenda']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_descagenda']))) : "";
    
    if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT * FROM `gx_detAgenda2` WHERE `id_detagenda` = '".$id_detagenda2."' AND
		    `level` = '0' LIMIT 0,1;");
	$row_agenda = mysql_fetch_array($sql_agenda);
    }elseif($loggedin["group"] == 'staff' || $loggedin["group"] == 'marketing' || $loggedin["group"] == 'riset' || $loggedin["group"] == 'teknisi' || $loggedin["group"] == 'cso'){
	$sql_agenda= mysql_query("SELECT * FROM `gx_detAgenda2` WHERE `id_detagenda` = '".$id_detagenda2."' AND
		    `level` = '0' LIMIT 0,1;");
	
	$row_agenda = mysql_fetch_array($sql_agenda);
    }

    $submit = isset($_POST["deldetagenda"]) ? $_POST["deldetagenda"] : "";
	if($submit == "Hapus"){
		$id_detagendat = array();
		$id_detagendat = isset($_POST["id_detagnda"]) ? $_POST["id_detagnda"] : $id_detagendat;
		foreach($id_detagendat as $key => $value){
			$update    = mysql_query("UPDATE `gx_detAgenda2` SET level='1' WHERE `id_detagenda`='$value'") or die(mysql_error());
		}
		
	
	//echo $query;
	
	echo "<script language='JavaScript'>
			alert('Data telah dihapus!');
			location.href = 'detail_.php?id_detailgenda=$id_detagenda2';
            </script>";
	}
	    $id_desc		= isset($_GET["id_descagenda"]) ? mysql_real_escape_string(strip_tags(trim($_GET["id_descagenda"]))) : "";
	    $sql_desc		= "SELECT * FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_detagenda` = '$id_desc' ORDER BY `id_detagenda` ASC ;";
	    $query_desc		= mysql_query($sql_desc);
	    $row_desc 		= mysql_fetch_array($query_desc);
    $content .='<section id="content">
	  <div class="tab-content active" id="footable">
	  <div id="detail_todolist" class="detail view  detail508     expanded">
	  <form action="" method="post" name="form_delagenda">
          <table id="" class="table footable" cellspacing="0" style="margin-bottom: 0;">
		<tbody>
		    <tr>
			<td width="5.5%" scope="col">
			    Sub Agenda :
			</td>
			<td width="37.5%" colspan="3">
			    <span id="employee_status_span">
			    '.(isset($_GET["id_descagenda"]) ? $row_desc['desc_detagenda'] :"").'
			    </span>
			</td>
		    </tr>
		    <tr>
			<td width="5.5%" scope="col">
			    Describe :
			</td>
			<td width="37.5%" colspan="3">
			    <span id="first_name" class="sugar_field">
			    '.(isset($_GET["id_descagenda"]) ? $row_desc['detail_desc'] :"").'
			    </span>
			</td>
		    </tr>
		    <tr>
			<td width="5.5%" scope="col">
			    resource :
			</td>
			<td width="37.5%" colspan="3">
			
			
			';
			$sql_resource		= "SELECT * FROM `resource` WHERE `level` = '0' AND `id_detagenda` = '$id_desc' ORDER BY `id_detagenda` ASC ;";
			$query_resource		= mysql_query($sql_resource);
			//$row_resource		= mysql_fetch_array($query_resource);
			while ($row_resource 	= mysql_fetch_array($query_resource)) {
			$content .='<a style="float: left;" href="'.(isset($_GET["id_descagenda"]) ? $row_resource['url_resource'] :"").'" onclick="return valideopenerform2(\''.(isset($_GET["id_descagenda"]) ? $row_resource['url_resource'] :"").'\',\'iddesc'.(isset($_GET["id_descagenda"]) ? $row_resource["url_resource"] :"").'\');">';
			if($row_resource['extension'] == "mp3"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/mp3.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" />';
			}elseif($row_resource['extension'] == "zip"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/zip.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "rar"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/rar.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "png" || $row_resource['extension'] == "jpg" || $row_resource['extension'] == "jpeg" || $row_resource['extension'] == "gif" || $row_resource['extension'] == "bmp"){
			    $content .='<img style="margin:-5px 5px;" width="60" height="60" src="'.(isset($_GET["id_desc"]) ? $row_resource['url_resource'] :"").'" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "pdf"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/pdf.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "mp4" || $row_resource['extension'] == "flv" || $row_resource['extension'] == "avi" ){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/movie.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "htm" || $row_resource['extension'] == "html"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/html.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "doc"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/doc.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "docx"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/docx.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "xls"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/xls.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "xlsx"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/xlsx.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "php"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/php.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "js"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/js.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "css"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/css.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}elseif($row_resource['extension'] == "txt"){
			    $content .='<img style="margin:-5px 5px;" width="60" src="images/txt.png" title="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'" alt="'.(isset($_GET["id_descagenda"]) ? $row_resource['file_name'] :"").'"/>';
			}
			$content .='
			<br />
			<font style="width: 60px;" align="center">'.(isset($_GET["id_descagenda"]) ? word_limiter($row_resource['file_name']) :"").'</font>
			</a>';
			}
			$content .='
			</td>
		    </tr>
		    <tr>
			<td width="5.5%" scope="col">
			    Reports BY :
			</td>
			<td width="37.5%" colspan="3">
			    <span id="reports_to_name" class="sugar_field">';
		    $id_employee 	= (isset($_GET["id_descagenda"]) ? $row_desc['id_employee'] :"");
		    $sql_employee2	= "SELECT * FROM `gx_employee` WHERE `department` = 'Riset' AND `id_employee` = '$id_employee' ORDER BY `id_employee` ASC ;";
		    $query_employee2	= mysql_query($sql_employee2);
		    $row_employee2 	= mysql_fetch_array($query_employee2);
			    
			   $content .=''.(isset($_GET["id_descagenda"]) ? $row_employee2['first_name'].' '.$row_employee2['last_name'] :"").'</span>
			</td>
			
		    </tr>
		    <tr>
			<td width="5.5%" scope="col">
			    Date Update :
			</td>
			<td width="37.5%" colspan="3">
			    '.(isset($_GET["id_descagenda"]) ? $row_desc['date_upd'] :"").' By '.(isset($_GET["id_descagenda"]) ? $row_desc['updated_by'] :"").'
			</td>
		    </tr>
		    
		    </tbody>
		</table>
		  <div class="actions">
			<div class="button-well">
	  
			  <input type="submit" class="button button-primary" data-icon="v" name="deldetagenda" value="Hapus">
			</div>
			
		  </div>
		  </form>
	</div>
	
	
	</div>
	</div>
	</section>';
	
}
   $content.='
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
            ';


$plugins = '
        <!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
         <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();
            });
        </script>
        
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $(\'#example2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>';

    $title	= 'Agenda';
    $submenu	= "agenda";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3_popup($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>