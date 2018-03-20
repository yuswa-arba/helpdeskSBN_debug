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


$fields = array(
	'pendapatan_debet',
	'pendapatan_kredit',
	'biaya_debet',
	'biaya_kredit',
	'modal_debet',
	'modal_kredit',
	'ikthisar_debet',
	'ikthisar_kredit'
);

 
    $query_data	= "SELECT * FROM `gx_acc_penutup` WHERE `id`='1' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
	

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Tutup Laporan Keuangan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												
											</div>
											<div class="col-xs-4">
												<label>DEBET</label>
											</div>
											<div class="col-xs-4">
												<label>KREDIT</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Pendapatan Ikthisar L/R</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="pendapatan_debet" name="pendapatan_debet" required="" value="'.$row_data["pendapatan_debet"].'">
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="pendapatan_kredit" name="pendapatan_kredit" required="" value="'.$row_data["pendapatan_kredit"].'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Ikthisar Biaya L/R</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="biaya_debet" name="biaya_debet" required="" value="'.$row_data["biaya_debet"].'">
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="biaya_kredit" name="biaya_kredit" required="" value="'.$row_data["biaya_kredit"].'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Ikthisar Modal L/R</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="modal_debet" name="modal_debet" required="" value="'.$row_data["modal_debet"].'">
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="modal_kredit" name="modal_kredit" required="" value="'.$row_data["modal_kredit"].'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												
											</div>
											<div class="col-xs-4">
												<label>ATAU</label>
											</div>
											<div class="col-xs-4">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Modal Ikthisar L/R</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="ikthisar_debet" name="ikthisar_debet" required="" value="'.$row_data["ikthisar_debet"].'">
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="ikthisar_kredit" name="ikthisar_kredit" required="" value="'.$row_data["ikthisar_kredit"].'">
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

if(isset($_POST["save"]))
{
    foreach($fields as $value)
	{
		${$value}	   	= isset($_POST[$value]) ? mysql_real_escape_string(trim($_POST[$value])) : '';
	}
	
    $sql_update = "UPDATE `db_sbn`.`gx_acc_penutup` SET `pendapatan_debet`='".$pendapatan_debet."', `pendapatan_kredit`='".$pendapatan_kredit."',
	`biaya_debet`='".$biaya_debet."', `biaya_kredit`='".$biaya_kredit."',
	`modal_debet`='".$modal_debet."', `modal_kredit`='".$modal_kredit."',
	`ikthisar_debet`='".$ikthisar_debet."', `ikthisar_kredit`='".$ikthisar_kredit."' WHERE (`id`=1);";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."accounting/form_penutup.php';
			</script>";
			
}

$plugins = '';

    $title	= 'Form Penutup';
    $submenu	= "no_accounting";
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