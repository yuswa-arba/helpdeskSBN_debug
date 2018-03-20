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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
	

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Jawab Survey marketing");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data survey
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data survey</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      
		      <tr>
			<td>
			  <label>Name</label>
			</td>
			<td>
			  <input class="form-control" name="name" placeholder="Name" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>
			  <label>Address</label>
			</td>
			<td>
			  <textarea name="address" rows="6" cols="40" style="resize: none;"></textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Phone</label>
			</td>
			<td>
			  <input class="form-control" name="phone" placeholder="Phone" type="text" value="">
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
	
	
	$name		= isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
	//$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	
	$sql_nama	= ($name != "") ? "AND `gx_jawab_spksurvey`.`nama` LIKE '".$name."%'": "";
	$sql_address	= ($address != "") ? "AND `gx_jawab_spksurvey`.`alamat` LIKE '%".$address."%'": "";
	$sql_phone	= ($phone != "") ? "AND `gx_jawab_spksurvey`.`no_telp` LIKE '%".$phone."%'" : "";
	
	$sql_jawabsurvey	= "SELECT `gx_jawab_spksurvey`.`no_jawab`, `gx_jawab_spksurvey`.`no_spksurvey`, `gx_jawab_spksurvey`.`nama`, `gx_jawab_spksurvey`.`alamat`, `gx_jawab_spksurvey`.`no_telp`, `gx_jawab_spksurvey`.`longitude`, `gx_jawab_spksurvey`.`latitude`, `gx_jawab_spksurvey`.`no_tiang` 
				   FROM `gx_jawab_spksurvey`, `gx_survey` 
				   WHERE `gx_jawab_spksurvey`.`no_spksurvey` = `gx_survey`.`no_spk_survey` 
				   AND `gx_jawab_spksurvey`.`check_justifikasi` = '1'
				   $sql_nama
				   $sql_address
				   $sql_phone
				   ORDER BY `gx_jawab_spksurvey`.`id_jawab_spksurvey` DESC LIMIT 0, 20;";
}else{
	$sql_jawabsurvey	= "SELECT `gx_jawab_spksurvey`.`no_jawab`, `gx_jawab_spksurvey`.`no_spksurvey`, `gx_jawab_spksurvey`.`nama`, `gx_jawab_spksurvey`.`alamat`, `gx_jawab_spksurvey`.`no_telp`, `gx_jawab_spksurvey`.`longitude`, `gx_jawab_spksurvey`.`latitude`, `gx_jawab_spksurvey`.`no_tiang` 
				   FROM `gx_jawab_spksurvey`, `gx_survey` 
				   WHERE `gx_jawab_spksurvey`.`no_spksurvey` = `gx_survey`.`no_spk_survey` 
				   AND `gx_jawab_spksurvey`.`check_justifikasi` = '1'
				   ORDER BY `gx_jawab_spksurvey`.`id_jawab_spksurvey` DESC;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
		    <th>No Jawab Survey</th>
		    <th>Name</th>
		    <th>Address</th>
                    <th>Phone</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_jawabsurvey	= mysql_query($sql_jawabsurvey, $conn);
$no = 1;

    while ($row_jawabsurvey = mysql_fetch_array($query_jawabsurvey)) {
    
	$content .='<tr>
                    <td>'.$no.'</td>
                    <td>'.$row_jawabsurvey["no_jawab"].'</td>
                    <td>'.$row_jawabsurvey["nama"].'</td>
					<td>'.$row_jawabsurvey["alamat"].'</td>
					<td>'.$row_jawabsurvey["no_telp"].'</td>
                    <td>
                      <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_jawabsurvey["nama"]).'\',\''.mysql_real_escape_string($row_jawabsurvey["no_jawab"]).'\',\''.mysql_real_escape_string($row_jawabsurvey["no_spksurvey"]).'\',\''.mysql_real_escape_string($row_jawabsurvey["longitude"]).'\',\''.mysql_real_escape_string($row_jawabsurvey["latitude"]).'\',\''.mysql_real_escape_string($row_jawabsurvey["no_tiang"]).'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';


$content .='
</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '

<script type="text/javascript">
  
	function validepopupform2(cnama, cnojawab, cnospksurvey, clongitude, clatitude, cnotiang){
		
        window.opener.document.'.$return_form.'.kode_survey.value=cnospksurvey;
		window.opener.document.'.$return_form.'.kode_jawab_survey.value=cnojawab;
		window.opener.document.'.$return_form.'.nama_customer.value=cnama;
		window.opener.document.'.$return_form.'.longitude.value=clongitude;
		window.opener.document.'.$return_form.'.latitude.value=clatitude;
		window.opener.document.'.$return_form.'.tiang_terdekat.value=cnotiang;
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
                $(\'#customer\').dataTable({
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

    $title	= 'Data Survey';
    $submenu	= "permohonan_justifikasi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>