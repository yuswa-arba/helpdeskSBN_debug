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
    
    global $conn_helpdesk;
    global $conn;
$ttl  = "";

$ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "List Incoming Complaint" : "";
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master SPK Pasang Baru
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_spk_pasang_baru.php" class="btn bg-maroon btn-flat margin">Add SPK Pasang Baru</a>
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
                  <tr>	<th width="3%">no</th>
			<th width="5%">Tanggal</th>
			<th width="8%">Nama Customer</th>
			<th width="10%">Cabang</th>	
			<th width="8%">Paket Koneksi</th>
			<th>Pekerjaan</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';


    $sql_spk_pasang_baru	= mysql_query("SELECT * FROM `gx_spk_pasang`
			    WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC;", $conn);
    $no = 1;

    while($r_spk_pasang_baru = mysql_fetch_array($sql_spk_pasang_baru))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_spk_pasang_baru['tanggal'].'</td>
			<td>'.$r_spk_pasang_baru['nama_customer'].'</td>
			<td>'.$r_spk_pasang_baru['nama_cabang'].'</td>
			<td>'.$r_spk_pasang_baru['paket_koneksi'].'</td>
			<td>'.$r_spk_pasang_baru['pekerjaan'].'</td>
			<td><a href="detail_spk_pasang_baru.php?id_spk_pasang_baru='.$r_spk_pasang_baru["id_spkpasang"].'" onclick="return valideopenerform(\'detail_spk_pasang_baru.php?id_spk_pasang_baru='.$r_spk_pasang_baru["id_spkpasang"].'\',\'SPK Pasang Baru\');">Details</a>  || <a href="form_spk_pasang_baru.php?id_spk_pasang_baru='.$r_spk_pasang_baru["id_spkpasang"].'">edit</a>
			 || <a href="spk_pasang_baru_pdf?id_spk_pasang_baru='.$r_spk_pasang_baru["id_spkpasang"].'">PDF</a></td>
			 <!--<td><input type="checkbox" name="id_spk_pasang_baru[]" value="'.$r_spk_pasang_baru["id_spkpasang"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "master_spk_pasang_baru";



 
 $content .='<br />
            </div> 
       </div>';

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

    $title	= 'Master SPK Pasang Baru';
    
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