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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data kendaraan");
    global $conn;
    
//SELECT `id_kendaraan`, `id_cabang`, `nama_kendaraan`, `nopol_kendaraan`, `jenis_kendaraan`, `tahun_kendaraan`, `keterangan_kendaraan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_kendaraan` WHERE 1    
  $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $content ='<section class="content-header">
                    <h1>
                        Data Kendaraan
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Kendaraan</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td width="12.5%">
			  <label>Nama Kendaraan</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="nama_kendaraan" placeholder="Nama Kendaraan" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>No Pol Kendaraan</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="nopol_kendaraan" placeholder="No Pol Kendaraan" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Jenis Kendaraan</label>
			</td>
			<td>
			  <input class="form-control" name="jenis_kendaraan" placeholder="Jenis Kendaraan" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
	
        if(isset($_POST["save_search"])){
                $nama_kendaraan	= isset($_POST['nama_kendaraan']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_kendaraan']))) : "";
                $nopol_kendaraan = isset($_POST['nopol_kendaraan']) ? mysql_real_escape_string(strip_tags(trim($_POST['nopol_kendaraan']))) : "";
                $jenis_kendaraan = isset($_POST['jenis_kendaraan']) ? mysql_real_escape_string(strip_tags(trim($_POST['jenis_kendaraan']))) : "";
                
                $sql_nama_kendaraan	= ($nama_kendaraan != "") ? "AND `nama_kendaraan` LIKE '".$nama_kendaraan."%'": "";
                $sql_nopol_kendaraan	= ($nopol_kendaraan != "") ? "AND `nopol_kendaraan` LIKE '%".$nopol_kendaraan."%'": "";
                $sql_jenis_kendaraan	= ($jenis_kendaraan != "") ? "AND `jenis_kendaraan` LIKE '%".$jenis_kendaraan."%'": "";
                
                $sql_kendaraan	= "SELECT * FROM `gx_kendaraan` WHERE
		`level` = '0'
                $sql_nama_kendaraan
                $sql_nopol_kendaraan
                $sql_jenis_kendaraan
		ORDER BY `nama_kendaraan` ASC LIMIT 0,10;" ;
	}else{
		$sql_kendaraan	= "SELECT * FROM `gx_kendaraan`
                WHERE `level` = '0'
                ORDER BY `nama_kendaraan` ASC LIMIT 0,10;" ;
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>No Pol Kendaraan</th>
			    <th>Nama Kendaraan</th>
                            <th>Jenis</th>
                            <th>Tahun</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_kendaraan	= mysql_query($sql_kendaraan, $conn);
        $no = 1;
        
            while($row_kendaraan = mysql_fetch_array($query_kendaraan)){
                $content .='<tr>
                            <td>'.$row_kendaraan["nopol_kendaraan"].'</td>
                            <td>'.$row_kendaraan["nama_kendaraan"].'</td>
                            <td>'.$row_kendaraan["jenis_kendaraan"].'</td>
                            <td>'.$row_kendaraan["tahun_kendaraan"].'</td>
                            <td>'.$row_kendaraan["keterangan_kendaraan"].'</td>
                            <td><a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_kendaraan["nopol_kendaraan"]).'\',\''.mysql_real_escape_string($row_kendaraan["nama_kendaraan"]).'\',\''.mysql_real_escape_string($row_kendaraan["jenis_kendaraan"]).'\')">Select</a>
                            </td>
                            </tr>';
                $no++;
            }
                        
                          $content .='
                          
                        </tbody>
                      </table>';
                      

		$content .='</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '

<script type=\'text/javascript\'>
	function validepopupform2(no_k, nama_k, jenis_k){
                window.opener.document.'.$return_form.'.no_pol.value=no_k;
                window.opener.document.'.$return_form.'.nama_kendaraan.value=nama_k;
                window.opener.document.'.$return_form.'.jenis_kendaraan.value=jenis_k;
		self.close();
        }
</script>

<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#tech\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
		    
	    });
	    
	   
        </script>
    
    ';

    $title	= 'Form Data Kendaraan';
    $submenu	= "master_inactive";
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