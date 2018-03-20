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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data marketing");
    global $conn;
    
    
  $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $content ='<section class="content-header">
                    <h1>
                        Data CSO
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data CSO</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td width="12.5%">
			  <label>ID Employee*</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="id_employee" placeholder="ID Employee" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td width="12.5%">
			  <label>Kode</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="cKode" placeholder="Ckode" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Nama</label>
			</td>
			<td>
			  <input class="form-control" name="cNama" placeholder="Name" type="text" value="">
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
                $id_employee	= isset($_POST['id_employee']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_employee']))) : "";
                $cNama		= isset($_POST['cNama']) ? mysql_real_escape_string(strip_tags(trim($_POST['cNama']))) : "";
                $cKode		= isset($_POST['cKode']) ? mysql_real_escape_string(strip_tags(trim($_POST['cKode']))) : "";
                
                $sql_nama	= ($cNama != "") ? "AND `cNama` LIKE '".$cNama."%'": "";
                $sql_kode	= ($cKode != "") ? "AND `cKode` LIKE '%".$cKode."%'": "";
                $sql_id		= ($id_employee != "") ? "AND `id_employee` LIKE '%".$id_employee."%'": "";
                
                $sql_employee	= "SELECT * FROM `tbPegawai2`
                WHERE `level` = '0'
                $sql_nama
                $sql_id
                $sql_kode

		ORDER BY `cNama` ASC LIMIT 0,10;" ;
	}else{
		$sql_employee	= "SELECT * FROM `tbPegawai2`
                WHERE `level` = '0'
                ORDER BY `cNama` ASC LIMIT 0,10;" ;
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>ID Employee</th>
			    <th>Nama CSO</th>
                            <th>Kode</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_employee	= mysql_query($sql_employee, $conn);
        $no = 1;
        
            while ($row_employee = mysql_fetch_array($query_employee)) {
               
                
                $content .='<tr>
                            <td>'.$row_employee["id_employee"].'</td>
                            <td>'.$row_employee["cNama"].'</td>
                            <td>'.$row_employee["cKode"].'</td>
                            <td>'.$row_employee["cNIP"].'</td>
                            <td>'.$row_employee["cAlamat1"].'</td>
                            <td><a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_employee["cKode"]).'\',\''.mysql_real_escape_string($row_employee["cNama"]).'\')">Select</a>
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
	function validepopupform2(ckode,  nama){
                window.opener.document.'.$return_form.'.kode_cso.value=ckode;
                window.opener.document.'.$return_form.'.request.value=nama;
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

    $title	= 'Form Data CSO';
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