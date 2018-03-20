<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form PDF Proposal");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_proposal` WHERE `id_proposal`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

$sql_cabang	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '$loggedin[cabang]' ORDER BY `id_cabang` ASC LIMIT 0,1;";
$query_cabang	= mysql_query($sql_cabang, $conn);
$row_cabang = mysql_fetch_array($query_cabang);
$sql_last_data = mysql_fetch_array(mysql_query("SELECT * FROM `gx_proposal` ORDER BY `id_proposal` DESC", $conn));
$last_data  = $sql_last_data["id_proposal"] + 1;
$tanggal    = date("d");
$kode_proposalll = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_proposal"].''.$tanggal.''.sprintf("%04d", $last_data);
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form PDF Proposal</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
														
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
											<label>PDF Content</label>
																</div>
											<div class="col-xs-10">
											<textarea name="pdf_content" rows="10" cols="80" id="editor1" cols="70" style="resize: none;"> '.(isset($_GET["id"]) ? $row_data['pdf_content'] :"").' </textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			
if(isset($_POST["update"]))
{
    //echo "update";
    $pdf_content	   	= isset($_POST['pdf_content']) ? $_POST['pdf_content'] : '';
	
	if($pdf_content != ""){
    $sql_update = "UPDATE `gx_proposal` SET `pdf_content` = '".$pdf_content."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_proposal` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_STAFF."marketing/proposal/proposal4.php?id=".$_GET["id"]."';
			</script>";
	}else{
		echo "<script language='JavaScript'>
			alert('Tidak Boleh Kosong');
			window.history.go(-1);
			  </script>";
	}
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
		 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>
		tinymce.init({
		  selector: \'#mytextarea\',
		   plugins: "paste",
  menubar: "edit",
  toolbar: "paste",
  paste_data_images: true
		});
		</script>
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

    $title	= 'Form PDF Proposal';
    $submenu	= "Proposal";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>