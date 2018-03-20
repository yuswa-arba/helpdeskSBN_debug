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
	'kode',
	'nomor',
	'tanggal',
	'keterangan',
	'cross_cek'
);

$fields_detail = array(
	'tipe',
	'kode',
	'no_acc',
	'nama_acc',
	'nominal',
);

if(isset($_GET['token']))
{
	$query_data	= "SELECT * FROM `gx_acc_penyesuaian` WHERE `kode`='".$_GET['token']."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
}
else
{
    $query_data	= "SELECT UUID() as `kode`;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
}	

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Penyesuaian</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>NOMOR</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="nomor" name="nomor" required="" value="'.((isset($_GET['token'])) ? $row_data["nomor"]: '').'">
												<input type="hidden" class="form-control" id="id" name="id" required="" value="'.((isset($_GET['token'])) ? $row_data["nomor"]: '').'">
												<input type="hidden" class="form-control" id="kode" name="kode" required="" value="'.((isset($_GET['token'])) ? $_GET['token'] : $row_data["kode"]).'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>KETERANGAN</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="keterangan" name="keterangan" required="" value="'.((isset($_GET['token'])) ? $row_data["keterangan"]: '').'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>TANGGAL</label>
											</div>
											<div class="col-xs-9">
												<input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="'.((isset($_GET['token'])) ? $row_data["tanggal"]: '').'">
											</div>
										</div>
										</div>

										<div class="form-group">
										<div class="row">
											<div class="col-xs-6">
												<label>DEBET</label>
											</div>
										</div>
										</div>
										
										<div class="row">
											<div class="col-xs-12">
												<table id="debet" class="table table-bordered table-responsive">
													<thead>
														<tr>
															<th>NO ACC</th>
															<th>NAMA ACC</th>
															<th>NOMINAL</th>
														</tr>
													</thead>
													<tbody>';
													$query_data_debet	= "SELECT * FROM `gx_acc_penyesuaian_detail` WHERE `kode`='".$_GET['token']."' AND `tipe`='debet';";
													$sql_data_debet	= mysql_query($query_data_debet, $conn);
													$total_debet = 0;
													while($row_data_debet	= mysql_fetch_array($sql_data_debet))
													{
														$content .='<tr>
															<td>'.$row_data_debet['no_acc'].'</td>
															<td>'.$row_data_debet['nama_acc'].'</td>
															<td>'.$row_data_debet['nominal'].'</td>
														</tr>';
														$total_debet += $row_data_debet['nominal'];
													}
										$content .='
													</tbody>
													<tfoot>
														<tr>
															<td colspan="2">TOTAL</td>
															<td>'.number_format($total_debet, 0).'</td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-6">
												<label>KREDIT</label>
											</div>
											
										</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<table id="kedit" class="table table-bordered table-responsive">
													<thead>
														<tr>
															<th>NO ACC</th>
															<th>NAMA ACC</th>
															<th>NOMINAL</th>
														</tr>
													</thead>
													<tbody>';
													$query_data_kredit	= "SELECT * FROM `gx_acc_penyesuaian_detail` WHERE `kode`='".$_GET['token']."' AND `tipe`='kredit';";
													$sql_data_kredit	= mysql_query($query_data_kredit, $conn);
													$total_kredit = 0;
													while($row_data_kredit	= mysql_fetch_array($sql_data_kredit))
													{
														$content .='<tr>
															<td>'.$row_data_kredit['no_acc'].'</td>
															<td>'.$row_data_kredit['nama_acc'].'</td>
															<td>'.$row_data_kredit['nominal'].'</td>
														</tr>';
														
														$total_kredit += $row_data_kredit['nominal'];
													}
										$content .='
													</tbody>
													<tfoot>
														<tr>
															<td colspan="2">TOTAL</td>
															<td>'.number_format($total_kredit, 0).'</td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>CROSS CEK</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="cross_cek" name="cross_cek" readonly="" placeholder="debet-kredit" value="'.number_format(($total_debet - $total_kredit), 0).'">
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
						
						<div class="col-xs-4">
							<div class="row">
								<div class="col-xs-12">
									<div class="box box-primary">
										<div class="box-header">
											<h3 class="box-title">Form</h3>
										</div><!-- /.box-header -->
										<!-- form start -->
										<form role="form" method="POST" name="formdetail" id="formdetail" action="" enctype="multipart/form-data" >
											<div class="box-body">
												<div class="form-group">
												<div class="row">
													<div class="col-xs-12">
														<label>Tipe</label>
													</div>
													<div class="col-xs-12">
														<select class="form-control" id="tipe" name="tipe">
															<option value="debet">Debet</option>
															<option value="kredit">Kredit</option>
														</select>
													</div>
												</div>
												</div>
												<div class="form-group">
												<div class="row">
													<div class="col-xs-12">
														<label>NO ACC</label>
													</div>
													<div class="col-xs-12">
														<input type="hidden" class="form-control" id="id" name="id" required="" value="">
														
														<input type="text" class="form-control" readonly="" id="no_acc" name="no_acc" value=""
														onclick="return valideopenerform(\'data_acc.php?r=formdetail&f=penyesuaian\',\'acc_cash\');">
														<input type="hidden" class="form-control" id="kode" name="kode" required="" value="'.$row_data["kode"].'">
													</div>
												</div>
												</div>
												<div class="form-group">
												<div class="row">
													<div class="col-xs-12">
														<label>NAMA ACC</label>
													</div>
													<div class="col-xs-12">
														<input type="text" class="form-control" id="nama_acc" name="nama_acc" required="" value="">
													</div>
												</div>
												</div>
												<div class="form-group">
												<div class="row">
													<div class="col-xs-12">
														<label>NOMINAL</label>
													</div>
													<div class="col-xs-12">
														<input type="text" class="form-control" id="nominal" name="nominal" required="" value="">
													</div>
												</div>
												</div>
												<div class="form-group">
												<div class="row">
													<div class="col-xs-12">
														<button type="submit" name="savedetail" class="btn btn-primary">Submit</button>
													</div>
												</div>
												</div>
											</div>
										</form>
									</div>
								</div>								
								
							</div>
							
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
	
	if($cross_cek == 0)
	{
		$total = mysql_num_rows(mysql_query("SELECT * FROM `gx_acc_penyesuaian` WHERE `kode` = '".$kode."' LIMIT 0,1;", $conn));
	
		if($total == 1)
		{
			$sql_update = "UPDATE `gx_acc_penyesuaian` SET `nomor`='".$nomor."', `tanggal`='".$tanggal."',
			`keterangan`='".$keterangan."', `cross_cek`='".$cross_cek."'
			WHERE (`kode`='".$kode."');";			
		}
		else
		{
			$sql_update = "INSERT INTO `gx_acc_penyesuaian` (`id`, `kode`, `nomor`, `tanggal`, `keterangan`, `cross_cek`)
			VALUES ('', '".$kode."', '".$nomor."', '".$tanggal."', '".$keterangan."', '".$cross_cek."');";
		}
		
		//echo $sql_update;
		mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
								   window.history.go(-1);
								   </script>");
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
		
		echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='".URL_ADMIN."accounting/master_penyesuaian.php';
				</script>";
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Maaf Data Crosscek belum 0');
				window.location.href='".URL_ADMIN."accounting/form_penyesuaian.php?token=$kode';
				</script>";
	}
}


if(isset($_POST["savedetail"]))
{
	foreach($fields as $value)
	{
		${$value}	   	= isset($_POST[$value]) ? mysql_real_escape_string(trim($_POST[$value])) : '';
	}
	
	$total = mysql_num_rows(mysql_query("SELECT * FROM `gx_acc_penyesuaian` WHERE `kode` = '".$kode."' LIMIT 0,1;", $conn));
	
	if($total == 1)
	{
		$sql_update = "UPDATE `gx_acc_penyesuaian` SET `nomor`='".$nomor."', `tanggal`='".$tanggal."',
		`keterangan`='".$keterangan."', `cross_cek`='".$cross_cek."'
		WHERE (`kode`='".$kode."');";
		mysql_query($sql_update, $conn);
	}
	else
	{
		$sql_update = "INSERT INTO `gx_acc_penyesuaian` (`id`, `kode`, `nomor`, `tanggal`, `keterangan`, `cross_cek`)
		VALUES ('', '".$kode."', '".$nomor."', '".$tanggal."', '".$keterangan."', '".$cross_cek."');";
		mysql_query($sql_update, $conn);
	}
	
    foreach($fields_detail as $value)
	{
		${$value.'_detail'}	   	= isset($_POST[$value]) ? mysql_real_escape_string(trim($_POST[$value])) : '';
	}
	
    $sql_update = "INSERT INTO `gx_acc_penyesuaian_detail` (`id`, `kode`, `tipe`, `no_acc`, `nama_acc`, `nominal`)
	VALUES ('', '".$kode_detail."', '".$tipe_detail."', '".$no_acc_detail."', '".$nama_acc_detail."', '".$nominal_detail."');";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."accounting/form_penyesuaian.php?token=$kode';
			</script>";
			
}

$plugins = '';

    $title	= 'Form Penyesuaian';
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