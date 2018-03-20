<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
//enableLog( "", $loggedin["username"], $loggedin["id_employee"], "Open Form TV Channel");   
    global $conn;
    global $conn_voip;

if(isset($_POST["save_channel"])){
    
    $targetf = "/var/www/html/tvmedia/images/TV/icon/";
    $target = $targetf . basename( $_FILES['image']['name']);
    
       $id_channel	= isset($_POST['id_channel']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_channel']))) : "";
       $channel_name	= isset($_POST['channel_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['channel_name']))) : "";
       $stream		= isset($_POST['stream']) ? mysql_real_escape_string(strip_tags(trim($_POST['stream']))) : "";
       $category	= isset($_POST['cattv']) ? mysql_real_escape_string(strip_tags(trim($_POST['cattv']))) : "";
       //$level		= isset($_POST['level']) ? mysql_real_escape_string(strip_tags(trim($_POST['level']))) : "";
       $image		= ($_FILES['image']['name']);
   
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
       $query = "INSERT INTO `gx_tv_stream` (`id`, `channel`, `cCategory`, `url_channel`, `url_thumb`, `level`)
				       VALUES ('', '$channel_name', '$category', '$stream', 'images/TV/icon/$image', '0')";
      
       
       mysql_query($query, $conn) or die("<script language='JavaScript'>
				   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				   window.history.go(-1);
		       </script>");
       echo "<script language=\"JavaScript\">
	       alert('Data telah disimpan!');
	       location.href = '".URL_ADMIN."tv/list_channel.php';
	   </script>";   
   }else{
       
       echo "<script language=\"JavaScript\">
	       alert('Sorry, there was a problem uploading your file');
	       window.history.go(-1);
	   </script>";
   } 

}elseif(isset($_POST["edit_channel"])){
       
 $targetf = "/var/www/html/tvmedia/images/TV/icon/";
 $target = $targetf . basename( $_FILES['image']['name']);
 
    $id_channel		= isset($_POST['id_channel']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_channel']))) : "";
    $channel_name	= isset($_POST['channel_name']) ? mysql_real_escape_string(strip_tags(trim($_POST['channel_name']))) : "";
    $stream		= isset($_POST['stream']) ? mysql_real_escape_string(strip_tags(trim($_POST['stream']))) : "";
    $category		= isset($_POST['cattv']) ? mysql_real_escape_string(strip_tags(trim($_POST['cattv']))) : "";
    //$level		= isset($_POST['level']) ? mysql_real_escape_string(strip_tags(trim($_POST['level']))) : "";
    $image		= isset($_FILES["image"]) ? $_FILES['image']['name'] : "";

    if( $image != ""){
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
	    
	    $url_image 	= "images/TV/icon/$image";
	    
	}else{
	    
	    echo "<script language=\"JavaScript\">
		    alert('Sorry, there was a problem uploading your file');
		    window.history.go(-1);
		</script>";
	}
    }else{
	$url_image 	= isset($_POST['url_image']) ? mysql_real_escape_string(strip_tags(trim($_POST['url_image']))) : "";
    }
    
$query = "UPDATE `gx_tv_stream` SET `channel` = '$channel_name', `cCategory` = '$category',
					    `url_channel` = '$stream', `url_thumb` = '$url_image', `level` = '0' WHERE `id` = '$id_channel'";
mysql_query($query, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			</script>");
	echo "<script language=\"JavaScript\">
		alert('Data telah disimpan!');
		location.href = '".URL_ADMIN."tv/list_channel.php';
	    </script>";   
}

if(isset($_GET["id_channel"])){
    
    $sql_tv_stream	= "SELECT * FROM `gx_tv_stream` WHERE `id` = '$_GET[id_channel]';";
    $query_tv_stream	= mysql_query($sql_tv_stream, $conn);
    $row_tv_stream	= mysql_fetch_array($query_tv_stream); 
    
}
    $content ='<section class="content-header">
                    <h1>
                        TV Channels 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="form_tvchannel"> Form TV Channel</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			<form role="form"  method="POST" action=""  enctype="multipart/form-data">
			    <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Form TV Channel</h2>
                                </div>
				<div class="box-body">
                                    <table width="100%" style="border-collapse: inherit;border-spacing: 3px;">
                                        <thead>
                                            <tr>
						
						<th width="15%">Channel Name  : </th>
						<th width="70%"><input type="text" class="form-control" name="channel_name" value="'.(isset($_GET['id_channel']) ? $row_tv_stream["channel"] : "").'" style="width : 53%;"></th>
                                            </tr>
					    <tr>
						<th width="15%">Stream  : </th>
						<th width="70%"><input type="text" class="form-control" name="stream" value="'.(isset($_GET['id_channel']) ? $row_tv_stream["url_channel"] : "").'" style="width : 75%;"></th>
                                            </tr>
					    <tr>
						<th width="15%">Category  : </th>
						<th width="70%">
						    <input type="radio" id="local" name="cattv" value="1" style="float:left;" '.(isset($_GET['id_channel']) && ($row_tv_stream["cCategory"] == '1') ? 'checked=""' :"").'> TV Local
						    <input type="radio" id="preimum" name="cattv" value="2" style="float:left;" '.(isset($_GET['id_channel']) && ($row_tv_stream["cCategory"] == '2') ? 'checked=""' :"").'> Premium
						</th>
                                            </tr>
					    <tr>
						<th width="15%">Image  : </th>
						<th width="70%">
						    <img id="preview" src="'.(isset($_GET['id_channel']) ? URL_IMG_TV.''.$row_tv_stream["url_thumb"] : "").'" width="100px" alt="Preview Image" />
							<br><input type="file" name="image" id="image" onchange="readURL(this);" />
						</th>
                                            </tr>
                                        </thead>
                                        </table>
					<div class="box-footer">
					    <input type="hidden" name="url_image" value="'.(isset($_GET['id_channel']) ? $row_tv_stream["url_thumb"] : "").'"/>
					    <input type="hidden" name="id_channel" value="'.(isset($_GET['id_channel']) ? $_GET["id_channel"] : "").'"/>
					    <button type="submit" name="'.(isset($_GET['id_channel']) ? "edit_channel" : "save_channel").'" class="btn btn-primary">Save</button>
					</div>
                                </div>
			    </div>
			    
			    </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script type="text/javascript">
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(\'#preview\')
                        .attr(\'src\', e.target.result)
                        .width(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
    ';

    $title	= 'Form TV Channel';
    $submenu	= "VOD";
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