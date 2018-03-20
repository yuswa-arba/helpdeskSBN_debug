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
		$conn_soft = Config::getInstanceSoft();
    
if(isset($_POST["save"]))
{
	require_once("generate_bm/insert_v2.php");
}

$sql_cabang	= mysql_query("SELECT `gx_cabang`.`kode_cabang`, `gx_cabang`.`kode_bm` FROM `gx_cabang`, `gx_pegawai`
		WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
		AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."' LIMIT 0,1;", $conn);
$row_cabang	= mysql_fetch_array($sql_cabang);

$sql_last_data 	= mysql_num_rows(mysql_query("SELECT `id_bankmasuk` FROM `gx_bank_masuk` WHERE `tgl_transaction` LIKE '%".date("Y-m-d")."%';", $conn));
$last_data  	= $sql_last_data + 1;
$tanggal    	= date("ymd");
$kode_data	= $row_cabang["kode_bm"].''.$tanggal.''.sprintf("%03d", $last_data);

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Bank Masuk</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
								<form action="" role="form" name="" id="form_generate" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
										<div class="row">
											<div class="col-xs-6">
												<label>Upload File txt</label>
											</div>
											<div class="col-xs-6">
												<input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="'.$loggedin["cabang"].'" >
						
												<input type="file" readonly="" class="form-control" required="" name="file">
											</div>
                                        </div>
										</div>
									</div>

                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Generate Bank Masuk';
    $submenu	= "bank_masuk";
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