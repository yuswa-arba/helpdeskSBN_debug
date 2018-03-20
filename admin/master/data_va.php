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
                                    <h2 class="box-title">Data Virtual Account</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" >
		      <tr>
			<td>
			  <label>Nama Bank</label>
			</td>
			<td>
			 <select class="form-control" name="kode_bank">
			  <option value="">Semua Bank</option>';
					    
$sql_data = mysql_query("SELECT * FROM `gx_bank` WHERE `level` = '0' ORDER BY `id_bank` ASC", $conn);
while($row_data = mysql_fetch_array($sql_data)){
 $content .= '<option value="'.$row_data["kode_bank"].'">'.$row_data["nama"].'</option>';
    
}
						
						
						$content .= '
                                            </select>
			</td>
		     
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>';
	
        if(isset($_POST["save_search"])){
                
                $kode_bank	= isset($_POST['kode_bank']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_bank']))) : "";
                $sql_kode	= ($kode_bank != "") ? "AND `kode_bank` LIKE '".$kode_bank."%'": "";
                
                $sql_data	= "SELECT * FROM `gx_va`
                WHERE `level` = '0' AND `status` = '0'
                $sql_kode
                ORDER BY `id_va` ASC LIMIT 0,10;" ;
	}else{
		$sql_data	= "SELECT * FROM `gx_va`
                WHERE `level` = '0' AND `status` = '0'
                ORDER BY `id_va` ASC LIMIT 0,10;" ;
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
						    <th>No</th>
                            <th>Nomer Rekening VA</th>
                            <th>Kode Bank</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_data	= mysql_query($sql_data, $conn);
        $no = 1;
        
            while ($row_data = mysql_fetch_array($query_data)) {
               
                $content .='<tr>
							<td>'.$no.'.</td>
                            <td>'.$row_data["no_rek"].'</td>
							<td>'.$row_data["kode_bank"].'</td>
                            <td><a href="" onclick="validepopupform2(\''.$row_data["no_rek"].'\')">Select</a>
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
	function validepopupform2(uid){
                window.opener.document.'.$return_form.'.cNoRekVirtual.value=uid;
                
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

    $title	= 'Data Virtual Account';
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