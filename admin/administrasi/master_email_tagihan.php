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
			<th width="8%">Nama Customer</th>
			<th width="10%">Alamat</th>
			<th width="8%">No Telp</th>
			<th width="10%">Email</th>
			<th width="8%">Tanggal</th>
			<th width="20%">Marketing</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';


    $sql_prospek	= mysql_query("SELECT `id_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek`
			    WHERE `level` =  '0'
			    ORDER BY  `date_add` DESC;", $conn);
    $no = 1;

    while($r_prospek = mysql_fetch_array($sql_prospek))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_prospek["nama_cust"].'</td>
			<td>'.$r_prospek["alamat"].'</td>
			<td>'.$r_prospek["no_telp"].'</td>
			<td>'.$r_prospek["email"].'</td>
			<td>'.$r_prospek["tanggal"].'</td>
			<td>'.$r_prospek['marketing'].'</td>
			<td><a href="detail_prospek.php?id_prospek='.$r_prospek["id_prospek"].'"> View </a> || <a href="form_prospek.php?id_prospek='.$r_prospek["id_prospek"].'">edit</a></td>
			<!--<td><input type="checkbox" name="id_prospek[]" value="'.$r_prospek["id_prospek"].'"></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>
</section>';

$submenu	= "master_prospek";



 
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