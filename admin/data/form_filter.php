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

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form filter internet");

//DATA Internet
$conn_soft = Config::getInstanceSoft();
$messages = '';


if(isset($_POST["save"]))
{
    
    $tipe_filter	= isset($_POST['tipe_filter']) ? mysql_real_escape_string(trim($_POST['tipe_filter'])) : '';
    $value_filter	= isset($_POST['value_filter']) ? mysql_real_escape_string(trim($_POST['value_filter'])) : '';
    
	if($tipe_filter !="" AND $value_filter != "")
	{
		//insert into gx_inet_grouptime
		$sql_insert = "INSERT INTO `db_sbn`.`gx_inet_filter` (`id_filter`, `tipe_filter`, `value`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES (NULL, '".$tipe_filter."', '".$value_filter."',
		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		mysql_query($sql_insert, $conn) or die (mysql_error());
		
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		
		echo "<script language='JavaScript'>
		alert('Data telah disimpan');
		window.location.href='".URL_ADMIN."data/list_filter.php';
		</script>";
		
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Ada data yang kosong.');
				window.history.go(-1);
			</script>";
        
	}
}elseif(isset($_POST["update"]))
{
    $id_filter       = isset($_POST['id_filter']) ? mysql_real_escape_string(trim($_POST['id_filter'])) : '';
    $tipe_filter	= isset($_POST['tipe_filter']) ? mysql_real_escape_string(trim($_POST['tipe_filter'])) : '';
    $value_filter	= isset($_POST['value_filter']) ? mysql_real_escape_string(trim($_POST['value_filter'])) : '';
    
	if($id_filter!= "" AND $tipe_filter !="" AND $value_filter != "")
	{
    //update gx_inet_grouptime
    $sql_update = "UPDATE `db_sbn`.`gx_inet_filter` SET `tipe_filter`='".$tipe_filter."', `value`='".$value_filter."', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_filter` = '".$id_filter."';";
                
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_filter.php';
	</script>";
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Ada data yang kosong.');
				window.history.go(-1);
			</script>";
	}
}


if(isset($_GET["id"]))
{
    $id_data = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_data = mysql_query("SELECT * FROM `gx_inet_filter` WHERE `id_filter` = '".$id_data."' LIMIT 0,1;", $conn);
    $row_data = mysql_fetch_array($sql_data);
    
}

    $content ='<section class="content-header">
                    <h1>
                        Form Filter Internet
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Filter Internet</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
                                    <form role="form" method="POST" action="">
									'.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_filter" value="'.$row_data["id_filter"].'">' : '').'
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Tipe Filter</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <select name="tipe_filter" id="tipe_filter" class="form-control">';
for($part=1; $part<=3; $part++){
    $selected = isset($_GET["id"]) ? $row_data["tipe_filter"] : "";
    $selected = ($selected == $part) ? ' selected=""' : "";
    $content .='<option value="'.$part.'" '.$selected.'>'.StatusFilter($part).'</option>';
}

$content .='                                    </select>
                                            </div>
                                        </div>
                                        </div>
										
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Value Filter</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="value_filter" value="'.(isset($_GET["id"]) ? $row_data["value"] : "").'">
                                                
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET["id"]) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Filter Internet';
    $submenu	= "inet_filter";
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