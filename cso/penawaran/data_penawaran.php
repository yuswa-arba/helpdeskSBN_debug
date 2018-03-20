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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data penawaran");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Penawaran
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Penawaran</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<!--<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="voip_number" placeholder="Voip Number" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>-->';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_penawaran	= "SELECT * FROM `gx_penawaran` WHERE `level` = '0' ORDER BY `id_penawaran` DESC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Penawaran</th>
		    <th>nama Customer</th>
		    <th>Date Add</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_penawaran	= mysql_query($sql_penawaran, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "proforma"){
  while ($row_penawaran = mysql_fetch_array($query_penawaran)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_penawaran["kode_penawaran"].'</td>
		     <td>'.$row_penawaran["nama_customer"].'</td>
		     <td>'.$row_penawaran["date_add"].'</td>
		     <td>'.$row_penawaran["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_penawaran["kode_penawaran"]).'\', \''.mysql_real_escape_string($row_penawaran["nama_customer"]).'\', \''.mysql_real_escape_string($row_penawaran["alamat"]).'\', \''.mysql_real_escape_string($row_penawaran["kota"]).'\', \''.mysql_real_escape_string($row_penawaran["no_telp"]).'\', \''.mysql_real_escape_string($row_penawaran["no_hp1"]).'\', \''.mysql_real_escape_string($row_penawaran["email"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
   
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
if(isset($_GET["f"])){
 if($_GET["f"] == "proforma"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(ckode_penawaran, cnama_customer, calamat, ckota, cno_telp, cno_hp1, cemail){
		 window.opener.document.'.$return_form.'.kode_penawaran.value=ckode_penawaran;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnama_customer;
		 window.opener.document.'.$return_form.'.alamat.value=calamat;
		 window.opener.document.'.$return_form.'.kota.value=ckota;
		 window.opener.document.'.$return_form.'.telp.value=cno_telp;
		 window.opener.document.'.$return_form.'.hp.value=cno_hp1;
		 window.opener.document.'.$return_form.'.email.value=cemail;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


    $title	= 'Data prospek';
    $submenu	= "penawaran";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>