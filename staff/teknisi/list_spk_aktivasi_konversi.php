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
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List SPK Aktivasi Konversi");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master SPK Aktivasi Konversi
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Tanggal</th>
			<th>No. SPK Aktivasi</th>
			<th>No. SPK Pasang</th>
			<th>Nama Customer</th>
			<th>Alamat</th>
			<th width="18%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_spk_aktivasi_konversi` WHERE `level` =  '0' AND `id_teknisi` = '$loggedin[id_employee]' ORDER BY `id_spk_aktivasi_konversi` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_aktivasi_konversi` WHERE `level` =  '0' AND `id_teknisi` = '$loggedin[id_employee]';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["tanggal"].'</td>
			<td>'.$row_data["kode_spk_aktivasi_konversi"].'</td>
			<td>'.$row_data["kode_spk_pasang"].'</td>
			<td>'.$row_data["nama_customer"].'</td>
			<td>'.$row_data["alamat"].'</td>
			<td align="center"><a href="detail_spk_aktivasi_konversi?id='.$row_data["id_spk_aktivasi_konversi"].'" onclick="return valideopenerform(\'detail_spk_aktivasi_konversi?id='.$row_data["id_spk_aktivasi_konversi"].'\',\'SPK aktivasi konversi\');"><span class="label label-info"> Detail </span></a> |
				<a href="form_jawab_spk_aktivasi_konversi?id_spk='.$row_data["id_spk_aktivasi_konversi"].'"><span class="label label-info"> Jawab SPK </span></a> |
				<a href="spk_aktivasi_konversi_pdf?id='.$row_data["id_spk_aktivasi_konversi"].'" target="_BLANK"><span class="label label-info"> View PDF </span></a>
			</td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master SPK Aktivasi Konversi';
    $submenu	= "spk_aktivasi_konversi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
    
    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>