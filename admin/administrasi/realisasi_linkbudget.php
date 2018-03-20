<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 21 February 2015
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     


$content = '

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
                  <tr>	<th>No</th>
			<th>Tanggal</th>
			<th>No. Link Budget</th>
			<th>No. SPK Pasang</th>
			<th>No. SPK Aktifasi</th>
			<th>Kode Customer</th>
			<th>Nama Customer</th>	
			<th>Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';


    $sql_data	= mysql_query("SELECT DISTINCT(`gx_alat_pasang`.`no_linkbudget`), `gx_alat_pasang`.`kode_spk_aktivasi`, gx_alat_pasang.kode_spk_pasang,
						    `gx_link_budget`.`kode_cust`, `gx_link_budget`.`nama_cust`,`gx_link_budget`.`tanggal`
						    FROM `gx_alat_pasang`, `gx_link_budget`
						      WHERE `gx_link_budget`.`id_cabang` = '".$loggedin['cabang']."'
							  AND `gx_alat_pasang`.`no_linkbudget`=`gx_link_budget`.`no_linkbudget`
						      AND `gx_alat_pasang`.`level` =  '0'
			    ORDER BY  `gx_alat_pasang`.`date_add` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT DISTINCT(`gx_alat_pasang`.`no_linkbudget`), `gx_alat_pasang`.`kode_spk_aktivasi`, gx_alat_pasang.kode_spk_pasang,
						    `gx_link_budget`.`kode_cust`, `gx_link_budget`.`nama_cust`,`gx_link_budget`.`tanggal`
						    FROM `gx_alat_pasang`, `gx_link_budget`
						      WHERE `gx_link_budget`.`id_cabang` = '".$loggedin['cabang']."'
							  AND `gx_alat_pasang`.`no_linkbudget`=`gx_link_budget`.`no_linkbudget`
						      AND `gx_alat_pasang`.`level` =  '0';", $conn));
    $hal	= "?";
    $no = 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data['tanggal'].'</td>
			<td>'.$row_data['no_linkbudget'].'</td>
			<td>'.$row_data['kode_spk_pasang'].'</td>
			<td>'.$row_data['kode_spk_aktivasi'].'</td>
			<td>'.$row_data['kode_cust'].'</td>
			<td>'.$row_data['nama_cust'].'</td>
			<td><a href="" onclick="return valideopenerform(\'detail_realisasi.php?id='.$row_data["no_linkbudget"].'&spk='.$row_data["kode_spk_pasang"].'&aktivasi='.$row_data["kode_spk_aktivasi"].'\',\'Realisasi Link Budget\');">View</a>
			</td>

		    </tr>';
	$no++;
    }

$content .='</tbody>
</table>
';

$submenu	= "master_jawaban_spk_pasang_baru";

 $content .='<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	    </div>
       </div>
	   
</section>';

}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
    $submenu	= "master_dashboard";
}

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
                $("#example1").dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Realisasi Link Budget';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>