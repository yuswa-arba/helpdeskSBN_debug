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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `gx_faq` WHERE `id_faq`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
	$kategori = $row_data["kategori_faq"];
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form FAQ</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Title</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="judul_faq" name="judul_faq" required="" value="'.(isset($_GET['id']) ? $row_data["judul_faq"] : "").'">
					    <input type="hidden" name="id_faq" value="'.(isset($_GET['id']) ? $row_data["id_faq"] : "").'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kategori</label>
					    </div>
					    <div class="col-xs-3">
							<select class="form-control" name="kategori_faq">
								<option value="billing" '.((isset($_GET['id']) AND $kategori== "billing") ? 'selected=""' : "").'>Billing</option>
								<option value="helpdesk" '.((isset($_GET['id']) AND $kategori== "helpdesk") ? 'selected=""' : "").'>Helpdesk</option>
								<option value="cso" '.((isset($_GET['id']) AND $kategori== "cso") ? 'selected=""' : "").'>CSO</option>
								<option value="marketing" '.((isset($_GET['id']) AND $kategori== "marketing") ? 'selected=""' : "").'>Marketing</option>
								<option value="other" '.((isset($_GET['id']) AND $kategori== "other") ? 'selected=""' : "").'>Other</option>
							</select>
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Tanya</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="tanya_faq" value="'.(isset($_GET['id']) ? $row_data["tanya_faq"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jawab</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea  id="editor" class="form-control"  name="jawab_faq">'.(isset($_GET['id']) ? $row_data["jawab_faq"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					

                                    </div><!-- /.box-body -->

                                    
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>';

    $title	= 'FAQ';
    $submenu	= "faq";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>