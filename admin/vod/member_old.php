<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;

$id_port    = isset($loggedin["port"]) ? $loggedin["port"] : '';

//$submit = isset($_POST["id_member"]) ? $_POST["id_member"] : "";
if(isset($_POST["id_member"])){
  $id_member = array();
  $id_member = isset($_POST["id_member"]) ? $_POST["id_member"] : $id_member;
  
  foreach($id_member as $key => $value){
    
    $sql_status = mysql_fetch_array(mysql_query("SELECT `member`.`level` FROM `member`
                            WHERE `member`.`id_member` = '".$value."'
                            LIMIT 0,1;"));
    
    if($sql_status["level"] == "1"){
      $status = 0;
    }elseif($sql_status["level"] == "0"){
      $status = 1;
    }
    
    //echo "UPDATE `member` SET level='$status' WHERE `id_member`='$value'";
    $update    = mysql_query("UPDATE `member` SET level='$status' WHERE `id_member`='$value'") or die(mysql_error());
  }
  header("location: member.php");
}


if(isset($_POST["filter_name"])){
  $filter_name = (isset($_POST["filter_name"])) ? $_POST["filter_name"] : "";
  $sql_member = mysql_query("SELECT `member`.*, `port`.`name_port` FROM `member`,`users`, `port`
                            WHERE `users`.`id_member` = `member`.`id_member` AND
                            `member`.`id_port` = `port`.`id_port` AND
                            `member`.`id_port` = '$id_port' AND
                            `users`.`group` = 'member' AND `member`.`first_name` LIKE '%".$filter_name."%'
                            ORDER BY  `member`.`level` ASC ,  `member`.`id_port` ASC ,  `member`.`first_name` ASC LIMIT $start, $perhalaman;");

  $sql_sum_member = mysql_num_rows(mysql_query("SELECT * FROM `member`,`users`, `port`
                            WHERE `users`.`id_member` = `member`.`id_member` AND
                            `member`.`id_port` = `port`.`id_port` AND
                            `member`.`id_port` = '$id_port' AND
                            `users`.`group` = 'member' AND `member`.`first_name` LIKE '%".$filter_name."%';"));
}else{
  if($loggedin["group"] == "sadmin"){
    
    $sql_member = mysql_query("SELECT `member`.*, `port`.`name_port` FROM `member`,`users`, `port`
                            WHERE `users`.`id_member` = `member`.`id_member` AND
                            `member`.`id_port` = `port`.`id_port` AND
                            
                            `users`.`group` = 'member'
                            ORDER BY  `member`.`level` ASC ,  `member`.`id_port` ASC ,  `member`.`first_name` ASC");

  $sql_sum_member = mysql_num_rows(mysql_query("SELECT * FROM `member`,`users`, `port`
                            WHERE `users`.`id_member` = `member`.`id_member` AND

                            `member`.`id_port` = `port`.`id_port` AND `users`.`group` = 'member'"));
  }elseif($loggedin["group"] == "admin"){
    $sql_member = mysql_query("SELECT `member`.*, `port`.`name_port` FROM `member`,`users`, `port`
                            WHERE `users`.`id_member` = `member`.`id_member` AND
                            `member`.`id_port` = `port`.`id_port` AND
                            `member`.`id_port` = '$id_port' AND
                            `users`.`group` = 'member'
                            ORDER BY  `member`.`level` ASC ,  `member`.`id_port` ASC ,  `member`.`first_name` ASC");

    $sql_sum_member = mysql_num_rows(mysql_query("SELECT * FROM `member`,`users`, `port`
                            WHERE `users`.`id_member` = `member`.`id_member` AND
                            `member`.`id_port` = `port`.`id_port` AND `users`.`group` = 'member'", $conn_voip));
    
    
  }
}

$content    = '
<section class="content-header">
                    <h1>
                        Home 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="system_user"> User Group</a></li>
                    </ol>
                </section>';
                        $content .= ' <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
                                    
				    Member  : 
				    
                                </div>
			    </div>
			    ';
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List TV</h2>
                                </div>';                            
$content .= '
    <form action="member.php" method="post" name="form" id="form">
      <h1><img src="image/customer.png" alt="" /></h1>
      <div class="buttons"><a href="form_member.php" onclick="" class="button">Insert New</a>
      <a onclick="$(\'#form\').submit();" class="button">Enabled/Disabled</a>
      </div>
    </div>
    <div class="box-body">
        <table id="member" class="table table-bordered table-striped">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$(\''."input[name*=\'id_member\']".'\').attr(\'checked\', this.checked);"/></td>
              <td class="left">No.</td>
              <td class="left">Member Name</td>
              <td class="left">Enable</td>
              <td class="left">Member of</td>
              <td class="left">Address</td>
              <td class="left">E-Mail</td>
              <td class="left">Phone</td>
              <td class="left">IP/MAC Address</td>
              <td class="left">Date Register</td>
              <td class="right">Action</td>
            </tr>
          </thead>
          <tbody>';
            
//<input type="text" name="filter_address" value="" />
//<input type="text" name="filter_email" value="" />

$no = 1;

while($row_member = mysql_fetch_array($sql_member)){

$content .= '<tr valign="top" >
              <td style="text-align: center;">
                <input type="checkbox" name="id_member[]" value="'.$row_member["id_member"].'" />
              </td>
              <td class="left">'.$no.'.</td>
              <td class="left"><a href="detail_member.php?id='.$row_member["id_member"].'">'.$row_member["first_name"].' '.$row_member["last_name"].'</a></td>
              <td class="left">'.($row_member["level"] == "1" ? '<img src="image/disable.gif" border="0">' : '<img src="image/enable.gif" border="0">').'</td>
              <td class="left">'.$row_member["name_port"].'</td>
              <td class="left">'.$row_member["address"].'</td>
              <td class="left">'.$row_member["email"].'</td>
              <td class="left">'.$row_member["phone"].'</td>
              <td class="left">'.$row_member["ip_address"].' / '.$row_member["mac_address"].'</td>
              <td class="left">'.$row_member["date_register"].'</td>
              <td class="left"><a href="form_member.php?id='.$row_member["id_member"].'">Edit</a>
                </td>
            </tr>';
            $no++;
}

$content .='</tbody>
        </table>';				
                               $content .= '</div><!-- /.box-body -->
				<div class="box-footer">
				    <input type="hidden" name="id_group" value="'.$id_group.'"/>
				    <button type="submit" name="save_role" class="btn btn-primary">Save</button>
				</div>
                            </div><!-- /.box -->
			    </form>
                        </div>
                    </div>
                </section><!-- /.content -->';







$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#paket\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>


    ';

    $title	= 'User Group';
    $submenu	= "system_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>