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
                        Data Teknisi
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Teknisi</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td width="12.5%">
			  <label>ID Teknisi*</label>
			</td>
			<td width="37.5%">
			  <input class="form-control" name="id_staff" placeholder="ID Marketing" type="text" value="">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" name="nama_staff" placeholder="Name" type="text" value="">
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
                $user_id	= isset($_POST['id_staff']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_staff']))) : "";
                $name		= isset($_POST['nama_staff']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_staff']))) : "";
                
                $sql_nama	= ($name != "") ? "AND `cNama` LIKE '".$name."%'": "";
                $sql_userid	= ($user_id != " ") ? "AND `id_employee` LIKE '%".$user_id."%'": "";
                
                $sql_employee	= "SELECT * FROM `tbPegawai`
                WHERE `id_employee` != '1'
                AND `level` = '0'
                $sql_nama
                $sql_userid
                ORDER BY `cNama` ASC LIMIT 0,10;" ;
	}else{
		$sql_employee	= "SELECT * FROM `tbPegawai`
                WHERE `id_employee` != '1'
                AND `level` = '0'
                ORDER BY `cNama` ASC LIMIT 0,10;" ;
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>ID Teknisi</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_employee	= mysql_query($sql_employee, $conn);
        $no = 1;
        
            while ($row_employee = mysql_fetch_array($query_employee)) {
               
                $jml_spk = mysql_num_rows(mysql_query("SELECT  * FROM `gx_helpdesk_spk` WHERE `date_add` = CURDATE() AND `id_teknisi`='$row_employee[id_employee]'", $conn));
                $ttl_spk = mysql_num_rows(mysql_query("SELECT  * FROM `gx_helpdesk_spk` WHERE `id_teknisi`='$row_employee[id_employee]'", $conn));
                
                $content .='<tr>
                            <td>'.$row_employee["id_employee"].'</td>
                            <td>'.$row_employee["cNama"].'</td>
                            <td>'.$jml_spk.'</td>
                            <!--<td>'.$ttl_spk.'</td>-->
                            <td>';
                              if($jml_spk < 8){ $content .= '<a href="" onclick="validepopupform2(\''.$row_employee["id_employee"].'\',\''.$row_employee["cNama"].'\')">Select</a>'; } else { $content .= '( SPK penuh )'; }
                            $content .= '</td>
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
	function validepopupform2(uid,  nama){
                window.opener.document.'.$return_form.'.id_teknisi.value=uid;
                window.opener.document.'.$return_form.'.nama_teknisi.value=nama;
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

    $title	= 'Data teknisi';
    $submenu	= "data_teknisi";
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