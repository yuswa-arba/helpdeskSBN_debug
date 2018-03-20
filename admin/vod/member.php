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

  $sql_tv = mysql_query("SELECT *
				  FROM `gx_vod_stream`
				  WHERE `level` = '0'
				  ORDER BY `id` ASC;",$conn);   
if(isset($_POST["save_role"]))
{
    $role_menu 	= array();
    $role_menu	= isset($_POST["role_menu"]) ? $_POST["role_menu"] : $role_menu;
    $id_group	= isset($_POST["id_group"]) ? trim(strip_tags($_POST["id_group"])) : "";
    
    print_r ($role_menu);
    
    //$sql_menu = mysql_query("SELECT * FROM `gx_role_menu`", $conn);
    //delete all data first
    
    
    foreach($role_menu as $key => $value){
	$sql_menu = mysql_query("SELECT count(*) as `total` FROM `gx_vod_member` WHERE `id_member` = '".$key."' LIMIT 0,1;", $conn);
	$row_menu = mysql_fetch_array($sql_menu);
	
	  /*  if($value != "on" AND $row_menu["total"] == 1){
		$sql_qroup_role = "DELETE FROM `gx_user_group_role`
		WHERE `id_group`= '".$id_group."' AND `id_menu` = '".$key."';";
		//echo "delete$key<br>";
	    }elseif($value == "on" AND $row_menu["total"] == 0){
		
		echo "Insert$key<br>";
	    }
	*/
    }
    
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."system/group_role.php?id_group=".$id_group."';
	</script>";
    
//    $id_complaint = array();
//    $id_complaint = isset($_POST["id_complaint"]) ? $_POST["id_complaint"] : $id_complaint;
//    foreach($id_complaint as $key => $value){
//	    $update    = mysql_query("UPDATE `gx_complaint` SET level='1' WHERE `id_complaint`='$value'") or die(mysql_error());
//    }
//    header("location: incoming.php?type=complaint");
}

    $content ='<section class="content-header">
                    <h1>
                        Member 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="system_user"> User Group</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
		     <div class="row">
                        <div class="col-xs-12">
			    
			    ';

    $sql_member = mysql_query("SELECT * FROM `gx_vod_member`,`gx_vod_users`, `gx_vod_port`
                            WHERE `gx_vod_users`.`id_member` = `gx_vod_member`.`id_member` AND
                            `gx_vod_member`.`id_port` = `gx_vod_port`.`id_port` AND
                            `gx_vod_users`.`group` = 'member'",$conn);
    
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Member</h2>
                                </div>
				<form role="form"  method="POST" action="">
				<div class="box-body">
				   <button class="btn btn-primary" align="right" onclick="window.open(\'form_member.php\');">Insert</button>
                <table id="paket" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
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

$id_group	= isset($_GET["id_group"]) ? trim(strip_tags($_GET["id_group"])) : "";

$no = 1;
while ($row_member = mysql_fetch_array($sql_member))
{
    
    $sql_role = mysql_query("SELECT `gx_vod_member`.*, `gx_vod_port`.`name_port` FROM `gx_vod_member`,`gx_vod_users`, `gx_vod_port`
                            WHERE `gx_vod_users`.`id_member` = `gx_vod_member`.`id_member` AND
                            `gx_vod_member`.`id_port` = `gx_vod_port`.`id_port` AND
                            `gx_vod_users`.`group` = 'member'
                            ORDER BY  `gx_vod_member`.`level` ASC ,  `gx_vod_member`.`id_port` ASC ,  `gx_vod_member`.`first_name` ASC LIMIT 0,1;", $conn);
    $total_role = mysql_numrows($sql_role);
	
	if($total_role == 1){
	    $row_role = mysql_fetch_array($sql_role);
	    $selected_role = '<input type="checkbox" name="role_menu['.$row_member["id_member"].']" '.(($row_member["id_member"] == $row_role["id_member"]) ? 'checked=""' : '').' >';
	}else{
	    $selected_role = '<input type="checkbox" name="role_menu['.$row_member["id_member"].']">';
	}
    
    $content .= '<tr>
              <td class="left">'.$no.'.</td>
              <td class="left"><a href="detail_member.php?id='.$row_member["id_member"].'">'.$row_member["first_name"].' '.$row_member["last_name"].'</a></td>
              <td class="left">'.($row_member["level"] == "1" ? 'disable' : 'enable').'</td>
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
$content .= '
                                        </tbody>
                                    </table>
				    
				
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <input type="hidden" name="id_group" value="'.$id_group.'"/>
				</div>
                            </div><!-- /.box -->
			    </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

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