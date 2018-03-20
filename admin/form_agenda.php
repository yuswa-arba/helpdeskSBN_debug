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
	  
$save_project = isset($_POST["save_project"]) ? $_POST["save_project"] : "";

if($save_project == "Save"){
    
	$title		= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	
	
	$start_date 	= isset($_POST['start_date']) ? mysql_real_escape_string(strip_tags(trim($_POST['start_date']))) : "";
	$end_date 	= isset($_POST['end_date']) ? mysql_real_escape_string(strip_tags(trim($_POST['end_date']))) : "";
	$created_by 	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	$id_employee 	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
	$assigned_to 	= isset($_POST['assigned_to']) ? mysql_real_escape_string(strip_tags(trim($_POST['assigned_to']))) : "";
	$desc 		= array();
	$desc 		= isset($_POST['desc']) ? $_POST['desc'] : $desc;
	$status		= array();
	$status		= isset($_POST['status']) ? $_POST['status'] : $status;
	$priority	= array();
	$priority	= isset($_POST['priority']) ? $_POST['priority'] : $priority;
	$target		= array();
	$target		= isset($_POST['target']) ? $_POST['target'] : $target;
	$id_group	= array();
	$id_group	= isset($_POST['id_group']) ? $_POST['id_group'] : $id_group;
	$id_detail	= array();
	$id_detail	= isset($_POST['id_detail']) ? $_POST['id_detail'] : $id_detail;
	$title_detagenda= array();
	$title_detagenda= isset($_POST['titledetagenda']) ? $_POST['titledetagenda'] : $title_detagenda;
	
	
	
	$query = "INSERT INTO `gx_agenda2` (`id_agenda`, `title_agenda`, `date_add`,
					   `date_upd`,`updated_by`, `created_by`, `level`)
		  VALUES ('', '$title', NOW(), NOW(), '$created_by', '$created_by', '0')";
	
	$sql_group	= "SELECT * FROM `gx_detAgenda2` ORDER BY `id_detagenda` DESC LIMIT 0, 1;";
	$query_group	= mysql_query($sql_group);
	$row_group 	= mysql_fetch_array($query_group);
	$plus_group	= ($row_group['id_group'])+1;
	$plus_detail	= ($row_group['id_detagenda'])+1;
	
	for ($i = 0; $i < count($desc); $i++) {
	    
	$sql_groups	= "SELECT * FROM `gx_detAgenda2` ORDER BY `id_detagenda` DESC LIMIT 0, 1;";
	$query_groups	= mysql_query($sql_groups);
	$row_groups	= mysql_fetch_array($query_groups);
	$plus_details	= ($row_groups['id_detagenda'])+1;
	
	$sql_agenda	= "SELECT * FROM `gx_agenda2` ORDER BY `id_agenda` DESC LIMIT 0, 1;";
	$query_agenda	= mysql_query($sql_agenda);
	$row_agenda 	= mysql_fetch_array($query_agenda);
	$last_id_agenda	= ($row_agenda['id_agenda'])+1;
	
	
	
	if($desc[$i] !=""){
	
	    $data_desc		= $desc[$i];
	    $data_status	= $status[$i];
	    $data_priority	= $priority[$i];
	    $data_target	= $target[$i];
	    $data_group		= $id_group[$i];
	    $data_detail	= $id_detail[$i];
	    $data_title		= $title_detagenda[$i];
	    
	    if($data_group == ""){
	    $query2 = "INSERT INTO `gx_detAgenda2` (`id_detagenda`, `id_agenda`, `id_group`, `id_parent_agenda`, `id_detail`, `title_detagenda`,
						 `desc_detagenda`, `status`, `priority`, `target`, `id_employee`, `create_by`, `updated_by`,
						 `date_add`, `date_upd`, `level`)
						VALUES ('', '$last_id_agenda', '$last_id_agenda', '0', '$plus_details', '$data_desc',
						'', '$data_status', '$data_priority', '$data_target', '', '$created_by','$created_by',
						NOW(), NOW(), '0')";
	    
	    //echo $query2.'<br />';
	    
	    mysql_query($query2) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	    }else{
		$query3 = "INSERT INTO `gx_detAgenda2` (`id_detagenda`, `id_agenda`, `id_group`, `id_parent_agenda`, `id_detail`, `title_detagenda`,
						 `desc_detagenda`, `status`, `priority`, `target`, `id_employee`, `create_by`, `updated_by`,
						 `date_add`, `date_upd`, `level`)
						VALUES ('', '$last_id_agenda', '$data_group', '0', '$data_detail', '$data_desc',
						'', '$data_status', '$data_priority', '$data_target', '', '$created_by','$created_by',
						NOW(), NOW(), '0')";
	    
	    //echo $query2.'<br />';
	    
	    mysql_query($query3) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	    }
	}
	}
	
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	//echo $query;
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'agenda.php';
            </script>";
}
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

    $content =' <section class="content-header">
                    <h1>
                        Agenda
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Agenda</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">                               
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form action="form_agenda.php" method="post" name="form_project" id="form_project"  method="post" enctype="multipart/form-data">
				<div class="table-container table-form">	    
				  <table class="form">
				    <tr>
				      <td class="width" style="width: 10%;min-width: 25px;">
					<label>Title</label>
				      </td>
				      <td>
					<input class="form-control" name="title" placeholder="title" type="text" required>
				      </td>
				    </tr>
				    <tr>
				      <td style="width: 5%;min-width: 25px;">
					<label>Agenda</label>
				      </td>
				      <td><div id="addinput">
				      <p>
				      <a href="#" id="addNew" style="margin-left: 670px;" class="btn btn-success"><i style="margin:-5px 5px;" width="20" class="fa fa-plus"></i></a>
				      </p>
				      <p style="margin-bottom: 10px;"><font style="margin:-5px 5px;padding-left: 191px;">Describe</font> <font style="margin:-5px 5px;padding-left: 285px;">status</font> <font style="margin:-5px 5px;padding-left: 63px;">Priority</font> <font style="margin:-5px 5px;padding-left: 63px;">Target</font></p>
				      ';
				      $sql_id_agenda 	= mysql_query("SELECT * FROM `gx_agenda2` ORDER BY `id_agenda` DESC");
				      $row_id_agenda	= mysql_fetch_array($sql_id_agenda);
				      $id_agenda		= (isset($row_id_agenda['id_agenda'])) ? $row_id_agenda['id_agenda'] : "" ;
				      $sql_agenda 		= mysql_query("SELECT  `gx_detAgenda2` . * , `gx_agenda2`.`updated_by` 
							    FROM  `gx_agenda2` ,  `gx_detAgenda2` 
							    WHERE  `gx_agenda2`.`id_agenda` =  `gx_detAgenda2`.`id_agenda` 
							    AND  `gx_detAgenda2`.`status` !=  'clear'
							    AND `gx_agenda2`.`id_agenda` = '$id_agenda'
							    AND `gx_detAgenda2`.`level` = '0'
							    ORDER BY  `gx_detAgenda2`.`id_agenda` DESC ");	
			    while($row_agenda = mysql_fetch_array($sql_agenda)){	
			     
				      $content .='<p>
				      <input placeholder="Id group" name="titledetagenda[]" type="hidden" value="'.$row_agenda["title_detagenda"].'">
				      <input placeholder="Id group" name="id_group[]" type="hidden" value="'.$row_agenda["id_group"].'">
				      <input placeholder="Id Detail" name="id_detail[]" type="hidden" value="'.$row_agenda["id_detail"].'">
					<textarea name="desc[]" id="p_new" placeholder="Description" style="width: 500px; height: 27px;margin-bottom: -12px;resize : none;">'.$row_agenda["title_detagenda"].'</textarea>
					  <select name="status[]">
						    <option value="on progress" '.(($row_agenda["status"]== "on progress") ? 'selected="selected"' :"") .'>On progress</option>
						    <option value="reminder" '.(($row_agenda["status"]== "reminder") ? 'selected="selected"' :"") .'>Reminder</option>
						    <option value="clear" '.(($row_agenda["status"]== "clear") ? 'selected="selected"' :"") .'>Clear</option>
						  </select> 
					 <select name="priority[]">
						    <option value="1" '.(($row_agenda["priority"]== "1") ? 'selected="selected"' :"") .'>High</option>
						    <option value="2" '.(($row_agenda["priority"]== "2") ? 'selected="selected"' :"") .'>Medium</option>
						    <option value="3" '.(($row_agenda["priority"]== "3") ? 'selected="selected"' :"") .'>Low</option>
						  </select> 
					<input data-datepicker placeholder="Target" name="target[]" style="width: 100px;" type="text"  Value="'.$row_agenda["target"].'" >
					 <br />
				      </p>';
				      }
				      $content .='
				      
				      </div>
				      </td>
				    </tr>
				    <!--<tr>
				      <td>
					<label>Date</label>
				      </td>
				      <td>
					<input data-datepicker placeholder="Start Date" name="start_date" type="text" required>
				      </td>
				    </tr>-->
				    
				  </table>
				  <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
				  <input name="id_employee" value="'.$loggedin["id_user"].'" type="hidden">
				</div>
				<div class="actions">
				  <div class="button-well">
				    <input type="submit" class="btn btn-success" name="save_project" data-icon="v" value="Save">
				  </div>
				  <a class="button button-link" data-icon="[" href="home.php">Go back to the index page</a>
				</div>
				</form>
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
        </script>
	<script  src="../new/js/jquery.min.js"></script>
	<script type="text/javascript">
	var $jq = jQuery.noConflict();

	$jq(function() {
		var addDiv = $(\'#addinput\');
		var i = $(\'#addinput p\').size() + 1;
		 
		$jq(\'#addNew\').live(\'click\', function() {
		$jq(\'<p><input placeholder="Id Detail" name="id_detail[]" type="hidden" value=""><input placeholder="Id group" name="titledetagenda[]" type="hidden" value=""><input placeholder="Id group" name="id_group[]" type="hidden" value=""><textarea name="desc[]" id="p_new" placeholder="Description" style="width: 500px; height: 27px;margin-bottom: -12px;resize : none;"></textarea> <select name="status[]"><option value="on progress">On progress</option><option value="reminder">Reminder</option><option value="clear">Clear</option></select> <select name="priority[]"><option value="1" '.(($row_agenda["priority"]== "1") ? 'selected="selected"' :"") .'>High</option><option value="2" '.(($row_agenda["priority"]== "2") ? 'selected="selected"' :"") .'>Medium</option><option value="3" '.(($row_agenda["priority"]== "3") ? 'selected="selected"' :"") .'>Low</option></select> <input data-datepicker placeholder="Target" name="target[]" type="text" style="width: 100px;" ><a href="#" id="remNew" class="btn btn-success" style="margin-left: 5px;margin-top: -4px;"><i class="fa fa-times"></i></a> </p>\').appendTo(addDiv);
		i++;
		 
		return false;
		});
		 
		$jq(\'#remNew\').live(\'click\', function() {
		if( i > 1 ) {
		$(this).parents(\'p\').remove();
		i--;
		}
		return false;
		});
	});
 
	</script>';

    $title	= 'Agenda';
    $submenu	= "agenda";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>