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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Area");
    global $conn;
    
    
  $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Area</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td>
			  <label>Nama Area</label>
			</td>
			<td>
			  <input class="form-control" name="nama_area" type="text" value="">
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
                
                $nama_area	= isset($_POST['nama_area']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_area']))) : "";
                $sql_nama	= ($nama_area != "") ? "AND `nama_area` LIKE '".$nama_area."%'": "";
                
                $sql_data	= "SELECT * FROM `gx_area`
                WHERE `level` = '0'
                $sql_nama
                ORDER BY `nama_area` ASC LIMIT 0,10;" ;
	}else{
		$sql_data	= "SELECT * FROM `gx_area`
                WHERE `level` = '0'
                ORDER BY `nama_area` ASC LIMIT 0,10;" ;
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
                            <th>Kode Area</th>
                            <th>Nama Area</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_data	= mysql_query($sql_data, $conn);
        $no = 1;
        
            while ($row_data = mysql_fetch_array($query_data)) {
               
                $content .='<tr>
                            <td>'.$row_data["kode_area"].'</td>
                            <td>'.$row_data["nama_area"].'</td>
                            <td><a href="" onclick="validepopupform2(\''.$row_data["kode_area"].'\',\''.$row_data["nama_area"].'\')">Select</a>
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
	function validepopupform2(uid,  nama){
                window.opener.document.'.$return_form.'.id_area.value=uid;
                window.opener.document.'.$return_form.'.nama_area.value=nama;
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

    $title	= 'Data Area';
    $submenu	= "";
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