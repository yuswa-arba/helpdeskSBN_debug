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

    
$updir = 'upload';     // sets the folder
$max_size = 50000;       // maximum file size allowed (in KB)

// file types allowed
$allowtype = array('bmp', 'flv', 'gif', 'jpg', 'jpeg', 'mp3', 'pdf', 'png', 'rar', 'zip', 'css', 'mp4' , 'avi', 'html', 'html', 'js', 'php', 'txt', 'doc', 'docx', 'xls', 'xlsx');

$rezultat = array();     // Variable to store the messages that will be returned by the script

// If the folder from $updir not exists, attempts to create it (with CHMOD 0777)
if (!is_dir($updir)) mkdir($updir, 0777);
    
    
$save_desc = isset($_POST["save_desc"]) ? $_POST["save_desc"] : "";

if($save_desc == "Save"){
	$id_desc_agenda	= isset($_POST['id_desc']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_desc']))) : "";
	$detagenda	= isset($_POST['sub_agenda']) ? mysql_real_escape_string(strip_tags(trim($_POST['sub_agenda']))) : "";
	$desc		= isset($_POST['describe']) ? $_POST['describe'] : "";
	$report_by	= isset($_POST['report_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['report_by']))) : "";
	$created_by	= isset($_POST['created_by']) ? mysql_real_escape_string(strip_tags(trim($_POST['created_by']))) : "";
	
	$query = "UPDATE `gx_detAgenda2` SET `desc_detagenda` = '$detagenda', `detail_desc` = '$desc', `id_employee` = '$report_by',
			  `updated_by` = '$created_by', `date_upd` = NOW()
		  WHERE `id_detagenda` = '$id_desc_agenda';";
		
	//echo $query;
	mysql_query($query) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	// Traverse the array elements, with data from the form fields with name="file_up[]"
   // Check the files received for upload
  
  $file = array();

  for($f=0; $f<count($_FILES['file_up']['name']); $f++) {
    $nume_f = $_FILES['file_up']['name'][$f];     // get the name of the current file

    // if the name has minimum 4 characters
    if (strlen($nume_f)>3) {
      // get and checks the file type (its extension)
      $type = end(explode('.', strtolower($nume_f)));
      if (in_array($type, $allowtype)) {
        // check the file size
        if ($_FILES['file_up']['size'][$f]<=$max_size*1000) {
          // if there aren't errors in the copying process
          if ($_FILES['file_up']['error'][$f]==0) {
            // Set location and name for uploading file on the server
            $thefile = $updir . '/'. $nume_f;
            // if the file can't be uploaded, returns a message
            if (!move_uploaded_file ($_FILES['file_up']['tmp_name'][$f], $thefile)) {
              $rezultat[$f] = 'The file '. $nume_f. ' could not be copied, try again';
            }
            else {
              // stores the name of the file
              $rezultat[$f] = '<b>'.$nume_f.'</b>';
            }
          }
        }
        else { $rezultat[$f] = 'The file <b>'. $nume_f. '</b> exceeds the maximum permitted size, <i>'. $max_size. 'KB</i>'; }
      }
      else { $rezultat[$f] = 'The file <b>'. $nume_f. '</b> is not an allowed file type'; }
      
    }
    

       $file2 = $updir . '/'. $nume_f;
       if($nume_f != ""){
      $query_resource ="INSERT INTO `resource` (`id_resource`, `id_detagenda`, `file_name`, `url_resource`, `extension`, `created_by`, `edited_by`, `date_add`, `date_upd`, `level`)
			VALUES ('', '$id_desc_agenda', '$nume_f', '$file2', '$type', '$created_by', '$created_by', NOW(), NOW(), '0');";
      //echo $query_resource;
      mysql_query($query_resource) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan! '.$rezultat.'');
			window.history.go(-1);
            </script>");
       }
  }
	
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'desc_detail_agenda.php?id_desc=$id_desc_agenda';
            </script>";
}
	    $id_desc		= isset($_GET["id_desc"]) ? mysql_real_escape_string(strip_tags(trim($_GET["id_desc"]))) : "";
	    $sql_desc		= "SELECT * FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_detagenda` = '$id_desc' ORDER BY `id_detagenda` ASC ;";
	    $query_desc		= mysql_query($sql_desc);
	    $row_desc 		= mysql_fetch_array($query_desc);
            
    $content =' <section class="content-header">
                    <h1>
                        Detail Agenda
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Detail Agenda</li>
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
                                <form action="desc_detail_agenda.php" method="post" name="form_desc_detagenda" id="form_desc_detagenda"  method="post" enctype="multipart/form-data">
                                <div class="table-container table-form">	    
                                  <table class="form">
                                    <tr>
                                      <td style="width: 8%;min-width: 115px;">
                                        <label>Sub Agenda</label>
                                      </td>
                                      <td>
                                        <input class="form-control" name="sub_agenda" placeholder="Sub Agenda" type="text" value="'.(isset($_GET["id_desc"]) ? $row_desc['desc_detagenda'] :"").'">
                                      </td>
                                    </tr>
                                    <tr style="vertical-align : middle;">
                                      <td style="vertical-align : middle;width: 8%;min-width: 115px;">
                                        <label>Description</label>
                                      </td>
                                      <td>
                                      <textarea name="describe" id="editor1" cols="70" placeholder="Description" rows="10" style="width:600px; height:250px" class="text_area">'.(isset($_GET["id_desc"]) ? $row_desc['detail_desc'] :"").'</textarea>
                                        
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="width: 8%;min-width: 115px;">
                                        <label>Resource</label>
                                      </td>
                                      <td>
                                        <div id="addinput">
                                           <p>
                                           <a href="#" id="addNew"><img style="margin:-5px 5px;padding-left: 670px;" width="20" src="images/plus.png"/></a>
                                           </p>
                                           <p style=" margin-bottom: 0px;"><input type="file" class="file_up" style="float : left;" name="file_up[]" /><a href="#" id="remNew"><img style="margin:4px 5px;" width="20" src="images/close.png"/></a> </p><br />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="width: 8%;min-width: 115px;">
                                        <label>Report By</label>
                                      </td>
                                      <td>
                                          <select name="report_by">
                                            <option value="0" '.((isset($_GET["id_desc"]) && $row_desc["id_employee"]== "0") ? 'selected="selected"' :"") .'>Choose Employe</option>';
                                        
                                        $sql_employee		= "SELECT * FROM `gx_employee` WHERE `department` = 'Riset' ORDER BY `id_employee` ASC ;";
                                        $query_employee		= mysql_query($sql_employee);
                                        
                                         while ($row_employee 	= mysql_fetch_array($query_employee)) {
                                         
                                            $content .='<option value="'.$row_employee['id_employee'].'" '.((isset($_GET["id_desc"]) && $loggedin['id_user'] == $row_employee['id_employee']) ? 'selected="selected"' :"") .'>'.$row_employee['first_name'].' '.$row_employee['last_name'].'</option>';
                                        
                                         }
                                            
                                            
                                            
                                          $content .='</select>
                                      </td>
                                    </tr>
                                  </table>
                                  <input name="created_by" value="'.$loggedin["username"].'" type="hidden">
                                  <input name="id_desc" value="'.(isset($_GET["id_desc"]) ? $_GET['id_desc'] :"").'" type="hidden">
                                </div>
                                <div class="actions">
                                  <div class="button-well">
                                    <input type="submit" class="button button-primary" name="save_desc" data-icon="v" value="Save">
                                  </div>
                                  
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
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
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
        <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
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
	 <!-- CK Editor -->
        <script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
	';

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