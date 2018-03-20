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
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Paket");
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
    if(isset($_POST["hapus"]))
    {
        $id_paket = array();
        $id_paket = isset($_POST["id_paket"]) ? $_POST["id_paket"] : $id_paket;
        
        foreach($id_paket as $key => $value)
        {
            $query = "UPDATE `gx_paket2` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_paket` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: setting_persentase.php');
    }
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    
                            <div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">Setting Persentase</h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
									<div class="box-tools pull-right">
										  <a href="form_settingpersen.php" class="btn bg-olive btn-flat margin">Add New</a>
										  <button type="submit" name="hapus" class="btn btn-danger btn-flat margin">Hapus</button>
									</div>
                                    <!--<form action="" method="POST" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Kode Paket :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="kode_paket" placeholder="Kode Paket">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama Paket :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="nama_paket" type="text" placeholder="Nama Paket">
					</div>
					
				    </div>
				    </div>
				    
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	
	<hr>-->
									<table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>#</th>
												<th>Bulan</th>
                                                <th>Tahun</th>
												<th>ACC Paket Switched</th>
                                                <th>ACC ISP</th>
                                                <th>ACC Arba</th>
												<th>Action</th>
												<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
//if(isset($_POST["search"])){
//    $kode_paket		= isset($_POST["kode_paket"]) ? trim(strip_tags($_POST["kode_paket"])) : "";
//    $nama_paket	= isset($_POST["nama_paket"]) ? trim(strip_tags($_POST["nama_paket"])) : "";
//    
//    $sql_kode	= ($kode_paket != "") ? "AND `kode_paket` LIKE '%".$kode_paket."%'" : "";
//    $sql_nama	= ($nama_paket != "") ? "AND `nama_paket` LIKE '%".$nama_paket."%'" : "";
//    
//    $sql_masterPaket = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`level` = '0'
//								   $sql_kode
//								   $sql_nama
//								   LIMIT $start, $perhalaman;", $conn);
//	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`level` = '0'
//												 $sql_kode
//												$sql_nama;",$conn));
//    
//    $hal= "?k=$kode_paket&n=$nama_paket&";
//    
//   
//}else{
$sql_data = mysql_query("SELECT * FROM `gx_setting_persentase` WHERE `level` = '0' LIMIT $start, $perhalaman;", $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_setting_persentase` WHERE `level` = '0';",$conn));
$hal = "?";
//}

//if(isset($_GET["k"])){
//    $kode_paket		= isset($_GET["k"]) ? trim(strip_tags($_POST["k"])) : "";
//    $nama_paket		= isset($_GET["n"]) ? trim(strip_tags($_POST["n"])) : "";
//    
//    $sql_kode	= ($kode_paket != "") ? "AND `kode_paket` LIKE '%".$kode_paket."%'" : "";
//    $sql_nama	= ($nama_paket != "") ? "AND `nama_paket` LIKE '%".$nama_paket."%'" : "";
//    
//    $sql_masterPaket = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`level` = '0'
//								   $sql_kode
//								   $sql_nama
//								   LIMIT $start, $perhalaman;", $conn);
//	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`level` = '0'
//												 $sql_kode
//												$sql_nama;",$conn));
//    
//    $hal= "?k=$kode_paket&n=$nama_paket&";
//}

$no = $start + 1;
while ($row_data = mysql_fetch_array($sql_data))
{

     $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["bulan"].'</td>
			<td>'.$row_data["tahun"].'</td>
		    <td>'.$row_data["acc_paket_switched"].'</td>
		    <td>'.$row_data["acc_isp"].'</td>
			<td>'.$row_data["acc_arba"].'</td>
		    <td align="center">
		    <a href="form_settingpersen.php?id='.$row_data['id_settingpersen'].'"><span class="label label-info">Edit</span></a> |
		    <a href="detail_settingpersen.php?id='.$row_data['id_settingpersen'].'"><span class="label label-info">Detail</span></a></td>
		    <td><input type="checkbox" name="id_settingpersen[]" value="'.$row_data["id_settingpersen"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            <div class="box-footer">
								<div class="box-tools pull-right">
									'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
								</div>
								<br style="clear:both;">
                                
                            </div>
							
                            </div><!-- /.box -->
                            </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Setting Persentase';
    $submenu	= "setting";
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