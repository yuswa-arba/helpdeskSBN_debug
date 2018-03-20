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
    
if(isset($_POST["save"]))
{
    $kode       	= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    
	/*if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		//echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		//echo "<h2>Displaying contents:</h2>";
		//readfile($_FILES['filename']['tmp_name']);
	}*/

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$import = "INSERT INTO `software`.`gx_voip_nomerTelpon` (`id`, `customer_number`, `id_voip`, `kode`,
		`nomer_telpon`, `date_add`, `date_upd`, `user_add`, `user_upd`, `status`, `level`)
		VALUES (NULL, '', '', '".$kode."', '".$data[0]."', NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '2', '0');";
		mysql_query($import, $conn) or die(mysql_error());
	}
	fclose($handle);

	//view upload form

    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master/voip_number.php';
	</script>";
    
}

if(isset($_GET["id"]))
{
    $id_group		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_group 	= "SELECT * FROM `gx_group` WHERE `id_group`='".$id_group."' AND `level` = '0' LIMIT 0,1;";
    $sql_group		= mysql_query($query_group, $conn);
    $row_group		= mysql_fetch_array($sql_group);
    
}


    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form VOIP Number</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" maxlength="6" required="" name="kode" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>File</label>
					    </div>
					    <div class="col-xs-8">
						<input type="file" name="filename" id="filename" />
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Customer';
    $submenu	= "master_customer";
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