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


$save_agenda = isset($_POST["save_agenda"]) ? $_POST["save_agenda"] : "";

$idagenda    	= isset($_POST["idagenda"]) ? $_POST["idagenda"] : "";
$iddetailagenda	= isset($_POST["iddetailagenda"]) ? $_POST["iddetailagenda"] : "";


if($idagenda == "id"){
	if($save_agenda == "Save"){
		$id		= isset($_POST['id_agenda']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_agenda']))) : "";
		$title		= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
		$agenda_id	= isset($_GET['id']) ? $_GET['id'] : "";
		
		$start_date 	= isset($_POST['start_date']) ? mysql_real_escape_string(strip_tags(trim($_POST['start_date']))) : "";
		$end_date 	= isset($_POST['end_date']) ? mysql_real_escape_string(strip_tags(trim($_POST['end_date']))) : "";
		$created_by 	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
		$id_employee 	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
		$assigned_to 	= isset($_POST['assigned_to']) ? mysql_real_escape_string(strip_tags(trim($_POST['assigned_to']))) : "";
		$desc 		= array();
		$desc 		= isset($_POST['desc']) ? $_POST['desc'] : $desc;
		$status		= array();
		$status		= isset($_POST['status']) ? $_POST['status'] : $status;
		$id_detagenda	= array();
		$id_detagenda	= isset($_POST['id_detagenda2']) ? $_POST['id_detagenda2'] : $id_detagenda;
		$priority	= array();
		$priority	= isset($_POST['priority']) ? $_POST['priority'] : $priority;
		$target		= array();
		$target		= isset($_POST['target']) ? $_POST['target'] : $target;
		$id_group	= array();
		$id_group	= isset($_POST['id_group']) ? $_POST['id_group'] : $id_group;
		$title_detagenda= array();
		$title_detagenda= isset($_POST['titledetagenda']) ? $_POST['titledetagenda'] : $title_detagenda;
		
		
		$sql_group	= "SELECT * FROM `gx_detAgenda2` ORDER BY `id_detagenda` DESC LIMIT 0, 1;";
		$query_group	= mysql_query($sql_group);
		$row_group 	= mysql_fetch_array($query_group);
		$plus_group	= ($row_group['id_group'])+1;
		
		for ($i = 0; $i < count($desc); $i++) {
		//echo $i;
		$sql_groups	= "SELECT * FROM `gx_detAgenda2` ORDER BY `id_detagenda` DESC LIMIT 0, 1;";
		$query_groups	= mysql_query($sql_groups);
		$row_groups	= mysql_fetch_array($query_groups);
		$plus_details	= ($row_groups['id_detagenda'])+1;
		
		$sql_agenda	= "SELECT * FROM `gx_agenda2` ORDER BY `id_agenda` DESC LIMIT 0, 1;";
		$query_agenda	= mysql_query($sql_agenda);
		$row_agenda 	= mysql_fetch_array($query_agenda);
		$last_id_agenda	= ($row_agenda['id_agenda'])+1;
	
		    $data_desc		= $desc[$i];
		    $data_status	= $status[$i];
		    $detagenda		= $id_detagenda[$i];
		    $data_priority	= $priority[$i];
		    $data_target	= $target[$i];
		    $data_group		= $id_group[$i];
		    $data_title		= $title_detagenda[$i];
		    
		if($detagenda == ""){
		   if($data_desc != ""){
			$query2 = "INSERT INTO `gx_detAgenda2` (`id_detagenda`, `id_agenda`, `id_group`, `id_parent_agenda`, `id_detail`, `title_detagenda`,
							 `desc_detagenda`, `status`, `priority`, `target`, `id_employee`, `create_by`, `updated_by`,
							 `date_add`, `date_upd`, `level`)
							VALUES ('', '$id', '$id', '0', '$last_id_agenda', '$data_desc',
							'', '$data_status', '$data_priority', '$data_target', '', '$created_by','$created_by',
							NOW(), NOW(), '0')";
		    
		    //echo $query2.'<br />';
		    
		    mysql_query($query2) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			</script>");
			
		   }
		}else{
			
			$query3 = "UPDATE `gx_detAgenda2` SET `title_detagenda` = '$data_desc',
				`status` = '$data_status', `priority`= '$data_priority', `target` = '$data_target',
				`updated_by` = '$created_by', `date_upd` = NOW(), `level` = '0'
				WHERE `id_detagenda` = '$detagenda'";
			//echo $query3.'<br />';
			
			
			mysql_query($query3) or die("<script language='JavaScript'>
					alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
					window.history.go(-1);
			    </script>");
		}
		
		}
		
		$query = "UPDATE `gx_agenda2` SET `title_agenda` = '$title',
			 `updated_by` = '$created_by', `date_upd` = NOW()
			WHERE `id_agenda` = '$id'";
		
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
		
		/*$query = "UPDATE `gx_agenda` SET `title_agenda` = '$title',
			`desc_agenda` = '$desc', `start_agenda` = '$start_date', `updated_by` = '$created_by', `date_upd` = NOW()
			WHERE `id_agenda` = '$id'";*/
			
		//echo $query;
		
		
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'agenda.php';
		    </script>";
	}
}elseif($iddetailagenda == "id_detail"){
	if($save_agenda == "Save"){
		$id		= isset($_POST['id_detlagenda']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_detlagenda']))) : "";
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
		$id_detagenda	= array();
		$id_detagenda	= isset($_POST['id_detagenda']) ? $_POST['id_detagenda'] : $id_detagenda;
		$priority	= array();
		$priority	= isset($_POST['priority']) ? $_POST['priority'] : $priority;
		$target		= array();
		$target		= isset($_POST['target']) ? $_POST['target'] : $target;
		$typpe		= array();
		$typpe		= isset($_POST['typpe']) ? $_POST['typpe'] : $typee;
		$id_parent	= array();
		$id_parent	= isset($_POST['id_parent']) ? $_POST['id_parent'] : $id_parent;
		$id_detail	= isset($_POST['iddetail']) ?  mysql_real_escape_string(strip_tags(trim($_POST['iddetail']))) : "";
		$title_detagenda= array();
		$title_detagenda= isset($_POST['titledetagenda']) ? $_POST['titledetagenda'] : $title_detagenda;
		
		
		$sql_group	= "SELECT * FROM `gx_detAgenda2` ORDER BY `id_detagenda` DESC LIMIT 0, 1;";
		$query_group	= mysql_query($sql_group);
		$row_group 	= mysql_fetch_array($query_group);
		$plus_group	= ($row_group['id_group'])+1;
		
		for ($i = 0; $i < count($desc); $i++) {
		//echo $i;
		$sql_agenda	= "SELECT * FROM `gx_agenda2` ORDER BY `id_agenda` DESC LIMIT 0, 1;";
		$query_agenda	= mysql_query($sql_agenda);
		$row_agenda 	= mysql_fetch_array($query_agenda);
		$last_id_agenda	= $row_agenda['id_agenda'];
		
		    $data_desc		= $desc[$i];
		    $data_status	= $status[$i];
		    $detagenda		= $id_detagenda[$i];
		    $data_priority	= $priority[$i];
		    $data_target	= $target[$i];
		    $data_typpe		= $typpe[$i];
		    $data_title		= $title_detagenda[$i];
		    $data_parent	= $id_parent[$i];
		    
		if($detagenda == ""){
		   if($data_desc != ""){	
			$query4 = "INSERT INTO `gx_detAgenda2` (`id_detagenda`, `id_agenda`, `id_group`, `id_parent_agenda`, `id_detail`, `title_detagenda`,
							     `desc_detagenda`, `type_detagenda`, `status`, `priority`, `target`,  `create_by`, `updated_by`,
							     `date_add`, `date_upd`, `level`)
							    VALUES ('', '', '', '$id_detail', '', '',
							    '$data_desc','$data_typpe', '$data_status', '$data_priority', '$data_target', '$created_by','$created_by',
							    NOW(), NOW(), '0')";
			
		    
		   // echo $query4.'<br />';
		    
		    mysql_query($query4) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			</script>");
		   }
		}else{
			
			$query3 = "UPDATE `gx_detAgenda2` SET `desc_detagenda` = '$data_desc', `type_detagenda` = '$data_typpe',
				`status` = '$data_status', `priority`= '$data_priority', `target` = '$data_target',
				`updated_by` = '$created_by', `date_upd` = NOW(), `level` = '0'
				WHERE `id_detagenda` = '$detagenda'";
			//echo $query3.'<br />';
			
			
			mysql_query($query3) or die("<script language='JavaScript'>
					alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
					window.history.go(-1);
			    </script>");
		}
		
		}
		
		$query = "UPDATE `gx_detAgenda2` SET `title_detagenda` = '$title',
			 `updated_by` = '$created_by', `date_upd` = NOW()
			WHERE `id_detagenda` = '$id'";
		
		mysql_query($query) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
		    </script>");
		
		/*$query = "UPDATE `gx_agenda` SET `title_agenda` = '$title',
			`desc_agenda` = '$desc', `start_agenda` = '$start_date', `updated_by` = '$created_by', `date_upd` = NOW()
			WHERE `id_agenda` = '$id'";*/
			
		//echo $query;
		
		
		echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'agenda.php';
		    </script>";
	}
}
if(isset($_GET["id"])){
    $id_agenda	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $sql_agenda= mysql_query("SELECT * FROM `gx_agenda2` WHERE `id_agenda` = '".$id_agenda."' AND
		    `level` = '0' LIMIT 0,1;");
    $row_agenda = mysql_fetch_array($sql_agenda);
    
}elseif(isset($_GET["id_detail"])){
    $id_detagenda2	= isset($_GET['id_detail']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_detail']))) : "";
    $sql_agenda= mysql_query("SELECT * FROM `gx_detAgenda2` WHERE `id_detagenda` = '".$id_detagenda2."' AND
		    `level` = '0' LIMIT 0,1;");
    $row_agenda = mysql_fetch_array($sql_agenda);
    
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
                                <form action="form_agenda_new.php" method="post" name="form_agenda" id="form_agenda"  method="post" enctype="multipart/form-data">
				<div class="table-container table-form">	    
				  <table class="form">
				    <tr>
				      <td  style="width: 10%;min-width: 25px;">
					<label>Title</label>
				      </td>
				      <td>';
				      if(isset($_GET["id"])){
					$content .='<input class="form-control" name="title" placeholder="title" type="text" value="'.(isset($_GET["id"]) ? $row_agenda["title_agenda"] : "") .'">';
				      }elseif(isset($_GET["id_detail"])){
					    if($row_agenda["type_detagenda"] == ""){
						    $content .='<input class="form-control" name="title" placeholder="title" type="text" value="'.(isset($_GET["id_detail"]) ? $row_agenda["title_detagenda"] : "") .'">';
					    }else{
						    $content .='<input class="form-control" name="title" placeholder="title" type="text" value="'.(isset($_GET["id_detail"]) ? $row_agenda["desc_detagenda"] : "") .'">';
					    }
					    
				      }
				      $content .='</td>
				    </tr>
				    
				    <tr>
				    <input class="large" name="iddetailagenda" placeholder="title" type="hidden" value="'.(isset($_GET["id_detail"]) ? "id_detail" : "") .'">
				    <input class="large" name="idagenda" placeholder="title" type="hidden" value="'.(isset($_GET["id"]) ? "id" : "") .'">
				      <td  style="width: 5%;min-width: 25px;">
					<label>Description</label>
				      </td>
				      <td>
				      <div id="addinput">
				      <p>
				      <a href="#" style="margin-left: 670px;" class="btn btn-success" id="addNew"><i style="margin:-5px 5px;" width="20" class="fa fa-plus"></i></a>
				      </p>';
				      if(isset($_GET['id'])){
					    $content .='<p style="margin-bottom: 10px;"><font style="margin:-5px 5px;padding-left: 205px;">Describe</font> <font style="margin:-5px 5px;padding-left: 282px;">status</font> <font style="margin:-5px 5px;padding-left: 60px;">Priority</font><font style="margin:-5px 5px;padding-left: 52px;">Target</font></p>
					';
				      }elseif(isset($_GET['id_detail'])){
					    $content .='<p style="margin-bottom: 10px;"><font style="margin:-5px 5px;padding-left: 155px;">Describe</font> <font style="margin:-5px 5px;padding-left: 185px;">status</font> <font style="margin:-5px 5px;padding-left: 26px;">Priority</font> <font style="margin:-5px 5px;padding-left: 26px;">Type</font> <font style="margin:-5px 5px;padding-left: 47px;">Target</font></p>
					';
				      }
				      
		    
		    if(isset($_GET['id'])){
				      $id_agenda		= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "" ;
				      
				      $sql_agenda2 		= mysql_query("SELECT  `gx_detAgenda2` . * ,  `gx_agenda2`.`updated_by` 
							    FROM  `gx_agenda2` ,  `gx_detAgenda2` 
							    WHERE  `gx_agenda2`.`id_agenda` =  `gx_detAgenda2`.`id_agenda` 
							    AND `gx_agenda2`.`id_agenda` = '$id_agenda'
							    AND `gx_detAgenda2`.`level` = '0'
							    ORDER BY  `gx_detAgenda2`.`id_agenda` DESC ");	
			    while($row_agenda2 = mysql_fetch_array($sql_agenda2)){	
			     
				      $content .='<p>
					<input placeholder="title agenda" name="titledetagenda[]" type="hidden" value="'.(isset($_GET["id"]) ?  $row_agenda2["title_detagenda"] : "").'">
					<input placeholder="Id group" name="id_group[]" type="hidden" value="'.(isset($_GET["id"]) ? $row_agenda2["id_group"] : "").'">
					<input placeholder="Id Detail Agenda" name="id_detagenda2[]" type="hidden" value="'.(isset($_GET["id"]) ? $row_agenda2["id_detagenda"] :"").'">
					<textarea name="desc[]" id="p_new" placeholder="Description" style="width: 500px; height: 27px;resize : none;margin-bottom: -12px;">'.(isset($_GET["id"]) ? $row_agenda2["title_detagenda"] : "").'</textarea>
					<select name="status[]">
						    <option value="on progress" '.((isset($_GET["id"]) && $row_agenda2["status"]== "on progress") ? 'selected="selected"' :"") .'>On progress</option>
						    <option value="reminder" '.((isset($_GET["id"]) && $row_agenda2["status"]== "reminder") ? 'selected="selected"' :"") .'>Reminder</option>
						    <option value="clear" '.((isset($_GET["id"]) && $row_agenda2["status"]== "clear") ? 'selected="selected"' :"") .'>Clear</option>
						  </select>
					<select name="priority[]">
						    <option value="1" '.((isset($_GET["id"]) && $row_agenda2["priority"]== "1") ? 'selected="selected"' :"") .'>High</option>
						    <option value="2" '.((isset($_GET["id"]) && $row_agenda2["priority"]== "2") ? 'selected="selected"' :"") .'>Medium</option>
						    <option value="3" '.((isset($_GET["id"]) && $row_agenda2["priority"]== "3") ? 'selected="selected"' :"") .'>Low</option>
						  </select> 
					<input data-datepicker placeholder="Target" name="target[]" style="width: 100px;" type="text"  Value="'.$row_agenda2["target"].'" >
					 <br />
				      ';
				      }
		    }elseif(isset($_GET['id_detail'])){
				      $id_detagenda		= isset($_GET['id_detail']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_detail']))) : "" ;
				      $sql_agenda23		= mysql_query("SELECT  * FROM `gx_detAgenda2` 
									    WHERE  `gx_detAgenda2`.`id_detagenda` =  '$id_detagenda' AND `level` = '0'
									    ORDER BY  `gx_detAgenda2`.`id_detagenda` DESC  ");
				      $row_agenda23 = mysql_fetch_array($sql_agenda23);
				      if(($row_agenda23['type_detagenda'] == "wsub") || ($row_agenda23['type_detagenda'] == "end")){
					    $id_detail	= $row_agenda23['id_detagenda'];
				      }else{
					    $id_detail	= $row_agenda23['id_detail'];
				      }
				      
				      $sql_agenda2 		= mysql_query("SELECT  * FROM `gx_detAgenda2` 
									    WHERE  `gx_detAgenda2`.`id_parent_agenda` =  '$id_detail' AND `level` = '0' AND `gx_detAgenda2`.`id_parent_agenda` !=  '0'
									    ORDER BY  `gx_detAgenda2`.`id_detagenda` DESC  ");
				      $content .='<input name="iddetail" type="hidden" value="'.(isset($_GET["id_detail"]) ?  $id_detail : "").'">	';
			    while($row_agenda2 = mysql_fetch_array($sql_agenda2)){	
			     
				      $content .='<p>
					<input placeholder="title agenda" name="titledetagenda[]" type="hidden" value="'.(isset($_GET["id_detail"]) ?  $row_agenda2["title_detagenda"] : "").'">	
					<input placeholder="title agenda" name="titledetagenda[]" type="hidden" value="'.(isset($_GET["id_detail"]) ?  $row_agenda2["title_detagenda"] : "").'">
					<input placeholder="Id parent" name="id_parent[]" type="hidden" value="'.(isset($_GET["id_detail"]) ? $_GET["id_detail"] : "").'">
					<input placeholder="Id Detail Agenda" name="id_detagenda[]" type="hidden" value="'.(isset($_GET["id_detail"]) ? $row_agenda2["id_detagenda"] :"").'">
					<input placeholder="Description" name="desc[]" id="p_new" style="width: 370px;" type="text" value="'.(isset($_GET["id_detail"]) ? $row_agenda2["desc_detagenda"] : "").'">
					<!--<textarea name="desc[]" id="p_new" placeholder="Description" style="width: 500px; height: 35px;margin-bottom: -12px;">'.(isset($_GET["id_detail"]) ? $row_agenda2["desc_detagenda"] : "").'</textarea>-->
					<select name="status[]">
						    <option value="on progress" '.((isset($_GET["id_detail"]) && $row_agenda2["status"]== "on progress") ? 'selected="selected"' :"") .'>On progress</option>
						    <option value="reminder" '.((isset($_GET["id_detail"]) && $row_agenda2["status"]== "reminder") ? 'selected="selected"' :"") .'>Reminder</option>
						    <option value="clear" '.((isset($_GET["id_detail"]) && $row_agenda2["status"]== "clear") ? 'selected="selected"' :"") .'>Clear</option>
						  </select>
					<select name="priority[]">
						    <option value="1" '.((isset($_GET["id_detail"]) && $row_agenda2["priority"]== "1") ? 'selected="selected"' :"") .'>High</option>
						    <option value="2" '.((isset($_GET["id_detail"]) && $row_agenda2["priority"]== "2") ? 'selected="selected"' :"") .'>Medium</option>
						    <option value="3" '.((isset($_GET["id_detail"]) && $row_agenda2["priority"]== "3") ? 'selected="selected"' :"") .'>Low</option>
						  </select>
					<select name="typpe[]">
						    <option value="wsub" '.((isset($_GET["id_detail"]) && $row_agenda2["type_detagenda"]== "wsub") ? 'selected="selected"' :"") .'>With Sub</option>
						    <option value="end" '.((isset($_GET["id_detail"]) && $row_agenda2["type_detagenda"]== "end") ? 'selected="selected"' :"") .'>End</option>
						  </select>
					<input data-datepicker placeholder="Target" name="target[]" style="width: 100px;" type="text"  Value="'.$row_agenda2["target"].'" >
					 <br />
				      ';
				      }
		    }
				      $content .='
				      </p>
				      </div>
				      </td>
				    </tr>
				    
				    <!--<tr>
				      <td>
					<label>Start Date</label>
				      </td>
				      <td>
					<input data-datepicker placeholder="Start Date" name="start_date" type="text" value="">
				      </td>
				    </tr>-->
				    
				  </table>
				  <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
				  <input name="id_agenda" value="'.(isset($_GET["id"]) ? (int)$_GET["id"] :"") .'" type="hidden">
				  <input name="id_detlagenda" value="'.(isset($_GET["id_detail"]) ? (int)$_GET["id_detail"] :"") .'" type="hidden">
				</div>
				<div class="actions">
				  <div class="button-well">
				  
				    <input type="submit" class="btn btn-success" name="save_agenda" data-icon="v" value="Save">
				  </div>';
				  if($_GET['id_detail']){
				    $content .='';
				  }else{
				    $content .='<a class="button button-link" data-icon="[" href="home.php">Go back to the index page</a>';
				  }
				  $content .='
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
	';
if(isset($_GET['id'])){
    $plugins	.= '

    
    <script type="text/javascript">
	var $jq = jQuery.noConflict();
	$jq(function() {
	var addDiv = $(\'#addinput\');
	var i = $(\'#addinput p\').size() + 1;
	 
	$jq(\'#addNew\').live(\'click\', function() {
	$jq(\'<p><input placeholder="Id Parent" name="id_parent[]" type="hidden" value=""><input placeholder="Id group" name="titledetagenda[]" type="hidden" value=""><input placeholder="Id group" name="id_group[]" type="hidden" value=""><input placeholder="Id Detail Agenda" name="id_detagenda2[]" type="hidden" value=""><textarea name="desc[]"  id="p_new" placeholder="Description" style="width: 500px; height: 27px;margin-bottom: -12px;resize : none;"></textarea>	<select name="status[]"><option value="on progress">On progress</option><option value="reminder">Reminder</option><option value="clear">Clear</option></select> <select name="priority[]"><option value="1">High</option><option value="2">Medium</option><option value="3">Low</option></select><input data-datepicker placeholder="Target" name="target[]" type="text" style="width: 100px;" ><a href="#" id="remNew" class="btn btn-success" style="margin-left: 5px;margin-top: -4px;"><i class="fa fa-times"></i></a> </p>\').appendTo(addDiv);
	i++;
	 
	return false;
	});
	 
	$jq(\'#remNew\').live(\'click\', function() {
	if( i > 1 ) {
	$jq(this).parents(\'p\').remove();
	i--;
	}
	return false;
	});
	});
 
	</script>';
}elseif(isset($_GET['id_detail'])){
    $plugins	.= '
    
    <script type="text/javascript">
	var $jq = jQuery.noConflict();
	$jq(function() {
	var addDiv = $(\'#addinput\');
	var i = $(\'#addinput p\').size() + 1;
	 
	$jq(\'#addNew\').live(\'click\', function() {
	$jq(\'<p><input placeholder="Id Parent" name="id_parent[]" type="hidden" value=""><input placeholder="Id group" name="titledetagenda[]" type="hidden" value=""><input placeholder="Id Detail Agenda" name="id_detagenda[]" type="hidden" value=""><input placeholder="Description" style="width: 370px;" name="desc[]" id="p_new" type="text" value=""> <select name="status[]"><option value="on progress">On progress</option><option value="reminder">Reminder</option><option value="clear">Clear</option></select> <select name="priority[]"><option value="1">High</option><option value="2">Medium</option><option value="3">Low</option></select>  <select name="typpe[]"><option value="wsub">With Sub</option><option value="end">End</option></select>  <input data-datepicker placeholder="Target" name="target[]" type="text" style="width: 100px;" ><a href="#" id="remNew" class="btn btn-success" style="margin-left: 5px;margin-top: -4px;"><i class="fa fa-times"></i></a> </p>\').appendTo(addDiv);
	i++;
	 
	return false;
	});
	 
	$jq(\'#remNew\').live(\'click\', function() {
	if( i > 1 ) {
	$jq(this).parents(\'p\').remove();
	i--;
	}
	return false;
	});
	});
 
	</script>';
}
	

    $title	= 'Agenda';
    $submenu	= "agenda";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
} else{
	header("location: index.php");
    }

?>