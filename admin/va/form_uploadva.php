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
    $kode1       	= isset($_POST['kode_bank1']) ? mysql_real_escape_string(trim($_POST['kode_bank1'])) : '';
	$kode2       	= isset($_POST['kode_bank2']) ? mysql_real_escape_string(trim($_POST['kode_bank2'])) : '';
    $kode_perusahaan  	= isset($_POST['kode_perusahaan']) ? mysql_real_escape_string(trim($_POST['kode_perusahaan'])) : '';
    
	
	$target_dir = "../upload/va/";
	$target_file = $target_dir . date("YmdHis").'_'.basename($_FILES["filename"]["name"]);
	
	if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
        
    

	//Import uploaded file to Database
	$handle = fopen($target_file, "r");
	//$handle = fopen($target_dir."va_db.txt", "r");
	
	while(! feof($handle))
	{
		$data = fgetcsv($handle);
		$va_data 	= explode(" ", $data[0]);
		
		$jumlah = count($va_data);
		//echo $va_data[2];
		
		for($i=1;$i<=$jumlah;$i++)
		//foreach ($va_data as $key => $column)
		 {
			
			//echo $va_data[$i-1]."<br>";
			
			//echo $key ." >> ". $column;
            if((isset($va_data[$i-1])) && $va_data[$i-1] != "")
			{
				$import = "INSERT INTO `software`.`gx_va` (`id_va`, `nama_va`, `nama_rekening`, `kode_bank`,
				`no_rek`, `kode_perusahaan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
				VALUES (NULL, '', '', '".$kode1."',
				'".trim($va_data[$i-1])."', '".$kode_perusahaan."', NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
				mysql_query($import, $conn) or die(mysql_error());
				//echo $import;
				
			}
			
			
        }
	}
	
	fclose($handle);

	
	}
	
	echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."va/master_va.php';
	</script>";
    
}

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "open form upload va");

    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Upload VA</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_upload_va"  method="POST" action="" enctype="multipart/form-data">
                                    <div class="box-body">
					
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kode Bank </label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="kode_bank1" value="" onclick="return valideopenerform(\'data_bank.php?r=form_upload_va&f=va\',\'bank\');">
					    
						<input type="hidden" class="form-control" required="" name="kode_bank2" value="">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kode Perusahaan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="kode_perusahaan" value="">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>File</label>
					    </div>
					    <div class="col-xs-8">
							<input type="file" name="filename" id="filename">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_add'] : $loggedin["username"]).'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>last Updated By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_upd'].' ( '.$row_data['date_upd'].' )' : "").'
					    </div>
                    </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="save" value="Upload" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
$plugins = '';

    $title	= 'Form Upload VA';
    $submenu	= "master_va";
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