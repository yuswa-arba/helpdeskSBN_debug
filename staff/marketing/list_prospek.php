<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open list Prospek marketing");
    
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$type = isset($_GET['type']) ? $_GET['type'] : '';
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master Prospek
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_prospek.php" class="btn bg-maroon btn-flat margin">Add Prospek</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Prospek</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="8%">Nama Customer</th>
			<th width="10%">Alamat</th>
			<th width="8%">No Telp</th>
			<th width="10%">Email</th>
			<th width="13%">Tanggal</th>
			<th width="15%">Marketing</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';

if($loggedin["id_level"] == "Kabag"){
	$sql_prospek	= mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `id_marketing`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek`
			    WHERE `level` =  '0' AND `cabang` = '$loggedin[cabang]'
				ORDER BY  `date_add` DESC LIMIT $start,$perhalaman;", $conn);
    $sql_total_prospek	= mysql_num_rows(mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `id_marketing`,  `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek`
			    WHERE `level` =  '0' AND `cabang` = '$loggedin[cabang]'
			    ORDER BY  `date_add` DESC;", $conn));
}else{
	$sql_prospek	= mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `id_marketing`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek`
			    WHERE `level` =  '0' AND `id_marketing` = '$loggedin[id_employee]'
				ORDER BY  `date_add` DESC LIMIT $start,$perhalaman;", $conn);
    $sql_total_prospek	= mysql_num_rows(mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `id_marketing`,  `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek`
			    WHERE `level` =  '0' AND `id_marketing` = '$loggedin[id_employee]'
			    ORDER BY  `date_add` DESC;", $conn));
}
    
    $hal = "?";
    $no =  $start +1;

    while($r_prospek = mysql_fetch_array($sql_prospek))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_prospek["nama_cust"].'</td>
			<td>'.$r_prospek["alamat"].'</td>
			<td>'.$r_prospek["no_telp"].'</td>
			<td>'.$r_prospek["email"].'</td>
			<td>'.date("Y-m-d H:i", strtotime($r_prospek["tanggal"])).'</td>
			<td>'.$r_prospek['marketing'].'</td>
			<td><a href="detail_prospek.php?id_prospek='.$r_prospek["id_prospek"].'" onclick="return valideopenerform(\'detail_prospek.php?id_prospek='.$r_prospek["id_prospek"].'\',\'prospek\');">Details</a> || <a href="form_prospek.php?id_prospek='.$r_prospek["id_prospek"].'">edit</a></td>
			<!--<td><a href="detail_prospek.php?id_prospek='.$r_prospek["id_prospek"].'"> View </a> || <a href="form_prospek.php?id_prospek='.$r_prospek["id_prospek"].'">edit</a></td>-->
			<!--<td><input type="checkbox" name="id_prospek[]" value="'.$r_prospek["id_prospek"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "prospek";



 
 $content .='<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_prospek, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>';



//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '
	<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'List Prospek';
    
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