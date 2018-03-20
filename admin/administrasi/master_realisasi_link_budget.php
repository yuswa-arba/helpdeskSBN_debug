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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn_helpdesk;
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
     
$ttl  = "";

$ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "List Incoming Complaint" : "";
$content = '

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
                                    <h3 class="box-title">'.$ttl.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				';

$type = isset($_GET['type']) ? $_GET['type'] : '';
// enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Helpdesk $type");

$content .='';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="8%">No. Link Budget</th>
			<th width="10%">Kode Customer</th>
			<th width="8%">Nama Customer</th>
			<th width="10%">Nama Created</th>
			<th width="8%">Tanggal</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';


    $sql_realisasi_link_budget	= mysql_query("SELECT `id_realisasi_link_budget`, `no_realisasi_link_budget`, `tanggal`, `no_link_budget`, `kode_customer`, `nama_customer`, `latitude`, `longitude`, `tiang_terdekat`, `nama_created`, `power_budget`, `alat_yang_terpasang`, `foto_pemasangan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_realisasi_link_budget`				      
					      WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_realisasi_link_budget	= mysql_num_rows(mysql_query("SELECT `id_realisasi_link_budget`, `no_realisasi_link_budget`, `tanggal`, `no_link_budget`, `kode_customer`, `nama_customer`, `latitude`, `longitude`, `tiang_terdekat`, `nama_created`, `power_budget`, `alat_yang_terpasang`, `foto_pemasangan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_realisasi_link_budget`				      
					      WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC;", $conn));
    $hal	= "?";
    $no = 1;

    while($r_rlb = mysql_fetch_array($sql_realisasi_link_budget))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_rlb["no_realisasi_link_budget"].'</td>
			<td>'.$r_rlb["no_link_budget"].'</td>
			<td>'.$r_rlb["kode_customer"].'</td>
			<td>'.$r_rlb["nama_customer"].'</td>
			<td>'.$r_rlb["nama_created"].'</td>
			<td>'.$r_rlb[""].'</td>
			<td>'.$r_rlb[""].'</td>
			<td>'.$r_rlb[""].'</td>
			<td>'.$r_rlb[""].'</td>
			<td><a href="detail_prospek.php?id_realisasi_link_budget='.$r_rlb[""].'"> View </a> || <a href="form_realisasi_link_budget.php?id_realisasi_link_budget='.$r_rlb[""].'">edit</a></td>
			<!--<td><input type="checkbox" name="id_prospek[]" value="'.$r_prospek["id_prospek"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "master_prospek";



 
 $content .='
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_realisasi_link_budget, $perhalaman, 1, $hal)).'
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
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Master';
    
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