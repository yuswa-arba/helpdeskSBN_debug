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
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Cabang");
	 global $conn;
    
	 $perhalaman = 20;
	 if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	 }else{
		$start=0;
	 }
	 
	 $hal = "?";
	
	 if(isset($_POST["hapus"]))
	 {
		 $id_cabang = array();
		 $id_cabang = isset($_POST["id_cabang"]) ? $_POST["id_cabang"] : $id_cabang;
		 
		 foreach($id_cabang as $key => $value)
		 {
			 $query = "UPDATE `gx_cabang` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
					 WHERE `id_cabang` = '".$value."';";
			 $sql_update = mysql_query($query, $conn) or die (mysql_error());
			 //log
			 enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		 }
		 header('location: master_cabang.php');
	 }
    
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form action="" method="post" name="form_cabang" id="form_cabang">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Cabang</h3>
				    <div class="box-tools pull-right">
					
					     <a class="btn bg-olive btn-flat margin" href="form_cabang.php">Add New</a>
						 <button type="submit" name="hapus" class="btn bg-olive btn-flat margin">Hapus</button>
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 120px">Nama Cabang</th>
                                                <th style="width: 220px">Alamat Cabang</th>
                                                <th>Kota</th>
                                                <th>Phone</th>
						<th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_cabang 	= mysql_query("SELECT * FROM `gx_cabang`
				  WHERE `level` = '0' ORDER BY `nama_cabang` ASC LIMIT $start, $perhalaman;", $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_cabang`
				  WHERE `level` = '0' ORDER BY `nama_cabang` ASC;", $conn));
$no = $start + 1;
while ($row_cabang = mysql_fetch_array($sql_cabang))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_cabang["nama_cabang"].'</td>
		    <td>'.$row_cabang["alamat_cabang"].'</td>
		    <td>'.$row_cabang["kota_cabang"].'</td>
		    <td>'.$row_cabang["telp_cabang"].'</td>
		    
		    <td align="center">
		    <a href="form_cabang.php?id='.$row_cabang['id_cabang'].'"><span class="label label-info">Edit</span></a> |
		    <a href="" onclick="return valideopenerform(\'detail_cabang.php?id='.$row_cabang["id_cabang"].'\',\'cabang\');"><span class="label label-info">Details</span></a></td>
		    <td><input type="checkbox" name="id_cabang[]" value="'.$row_cabang["id_cabang"].'"></td>
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
/*<div class="box-footer">
                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                                </div>*/
$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Cabang';
    $submenu	= "cabang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $cabang	= get_nama_cabang($loggedin['cabang']);
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group,$cabang);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>