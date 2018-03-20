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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Formulir");
    global $conn;
    
    
  $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Customer</h2>
                                </div>
				
                                <div class="box-body">
				
				
        <form action="" method="post" name="form_search" id="form_search">
		 <div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Kode Customer</label>
				</div>
				<div class="col-xs-3">
					<input class="form-control" name="kode" placeholder="Kode Customer" type="text" value="">
				</div>
				
				<div class="col-xs-3">
					<label>Nama Customer</label>
				</div>
				<div class="col-xs-3">
					<input class="form-control" name="nama" placeholder="Nama Customer" type="text" value="">
				</div>
				
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label>Userid</label>
				</div>
				<div class="col-xs-3">
					<input class="form-control" name="userid" placeholder="UserID" type="text" value="">
				</div>
				
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					
				</div>
				<div class="col-xs-3">
					<input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
				</div>
				
			</div>
		</div>
		 ';
	
        if(isset($_POST["save_search"])){
                $kode_data	= isset($_POST['kode']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode']))) : "";
                $nama_data	= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
				$user_data	= isset($_POST['userid']) ? mysql_real_escape_string(strip_tags(trim($_POST['userid']))) : "";
                
                $sql_kode	= ($kode_data != "") ? "AND `cKode` LIKE '".$kode_data."%'": "";
                $sql_nama	= ($nama_data != "") ? "AND `cNama` LIKE '%".$nama_data."%'": "";
				$sql_user	= ($user_data != "") ? "AND `cUserID` LIKE '%".$user_data."%'": "";
                
                $sql_execution	= "SELECT * FROM `tbCustomer`
                WHERE `level` = '0'
                $sql_kode
                $sql_nama
				$sql_user
                ORDER BY `idCustomer` DESC LIMIT 0,10;";
	}else{
		$sql_execution	= "SELECT * FROM `tbCustomer`
                WHERE `level` = '0'
                ORDER BY `idCustomer` DESC LIMIT 0,10;";
	}
                
                        $content .='<table class="table table-bordered table-striped" id="tech">
                        <thead>
                          <tr>
						  <th>No.</th>
                            <th>Kode Customer</th>
                            <th>Nama</th>
							<th>UserID</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>';
        
        
        $query_execution	= mysql_query($sql_execution, $conn);
        $no = 1;
        
        while ($row_execution = mysql_fetch_array($query_execution)) {
            $sql_olt = mysql_query("SELECT * FROM `v_olt_customer` WHERE `userid` = '".$row_execution["cUserID"]."' LIMIT 0,1;", $conn);
			$row_olt = mysql_fetch_array($sql_olt);
			
			$sql_vlan = mysql_query("SELECT * FROM `gx_data_vlan` WHERE `userid_vlan` = '".$row_execution["cUserID"]."' AND `level` = '0' LIMIT 0,1;", $conn);
			$row_vlan = mysql_fetch_array($sql_vlan);
			
			$sql_ip		= mysql_query("SELECT * FROM `gx_master_ip` WHERE `userid_ip` = '".$row_execution["cUserID"]."' AND `level` = '0' LIMIT 0,1;", $conn);
			$row_ip 	= mysql_fetch_array($sql_ip);
			//echo "SELECT * FROM `gx_data_vlan` WHERE `userid_vlan` = '".$row_execution["cUserID"]."' LIMIT 0,1;";
		  
		$content .='<tr>
                            <td>'.$no.'</td>
							<td>'.$row_execution["cKode"].'</td>
                            <td>'.$row_execution["cNama"].'</td>
							<td>'.$row_execution["cUserID"].'</td>
                            <td>';
                            $content .= '<a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_execution["cUserID"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_olt["nama_server"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_olt["id_server"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_olt["pon"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_olt["id"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_execution["cMacAdd"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_execution["cKode"]).'\',';
							$content .= '\''.mysql_real_escape_string($row_vlan["vlan"]).'\',';
							$content .= '\''.mysql_real_escape_string(long2ip($row_ip["ip_address"])).'\')">Select</a>'; 
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

 $plugins .= '<script type=\'text/javascript\'>
		      function validepopupform2(uid,  nama, ids, p, pid, mac, ckode, v, ip){
			      window.opener.document.'.$return_form.'.kode_customer.value=ckode;
				  window.opener.document.'.$return_form.'.userid.value=uid;
			      window.opener.document.'.$return_form.'.nama_olt.value=nama;
				  window.opener.document.'.$return_form.'.id_olt.value=ids;
				  window.opener.document.'.$return_form.'.pon.value=p;
				  window.opener.document.'.$return_form.'.id.value=pid;
				  window.opener.document.'.$return_form.'.mac_address.value=mac;
				  window.opener.document.'.$return_form.'.ip_inet.value=ip;
				  window.opener.document.'.$return_form.'.vlan.value=v;
			      self.close();
		      }
	      </script>
	      ';



    $title	= 'Data Customer';
    $submenu	= "data_customer";
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