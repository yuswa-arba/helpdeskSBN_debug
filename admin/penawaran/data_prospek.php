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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data prospek");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Prospek</h2>
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
 $sql_prospek	= "SELECT * FROM `gx_prospek` WHERE `level` = '0' ORDER BY `id_prospek` DESC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Prospek</th>
		    <th>nama Customer</th>
		    <th>Date Add</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_prospek	= mysql_query($sql_prospek, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "penawaran"){
  while ($row_prospek = mysql_fetch_array($query_prospek)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_prospek["no_prospek"].'</td>
		     <td>'.$row_prospek["nama_cust"].'</td>
		     <td>'.$row_prospek["date_add"].'</td>
		     <td>'.$row_prospek["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_prospek["no_prospek"]).'\', \''.mysql_real_escape_string($row_prospek["kode_cust"]).'\', \''.mysql_real_escape_string($row_prospek["marketing"]).'\', \''.mysql_real_escape_string($row_prospek["nama_cust"]).'\', \''.mysql_real_escape_string($row_prospek["alamat"]).'\', \''.mysql_real_escape_string($row_prospek["kelurahan"]).'\', \''.mysql_real_escape_string($row_prospek["kecamatan"]).'\', \''.mysql_real_escape_string($row_prospek["kota"]).'\', \''.mysql_real_escape_string($row_prospek["kode_pos"]).'\', \''.mysql_real_escape_string($row_prospek["no_telp"]).'\', \''.mysql_real_escape_string($row_prospek["no_hp_1"]).'\', \''.mysql_real_escape_string($row_prospek["no_hp_2"]).'\', \''.mysql_real_escape_string($row_prospek["contact_person"]).'\', \''.mysql_real_escape_string($row_prospek["email"]).'\')">Select</a>
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
 if($_GET["f"] == "penawaran"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(ckode_prospek, ckode_customer, cmarketing, cnama_customer, calamat, ckelurahan, ckecamatan, ckota, ckode_pos, cno_telp, cno_hp1, cno_hp2, ccontact_person, cemail){
		 window.opener.document.'.$return_form.'.kode_prospek.value=ckode_prospek;
		 window.opener.document.'.$return_form.'.kode_customer.value=ckode_customer;
		 window.opener.document.'.$return_form.'.marketing.value=cmarketing;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnama_customer;
		 window.opener.document.'.$return_form.'.alamat.value=calamat;
		 window.opener.document.'.$return_form.'.kelurahan.value=ckelurahan;
		 window.opener.document.'.$return_form.'.kecamatan.value=ckecamatan;
		 window.opener.document.'.$return_form.'.kota.value=ckota;
		 window.opener.document.'.$return_form.'.kode_pos.value=ckode_pos;
		 window.opener.document.'.$return_form.'.telp.value=cno_telp;
		 window.opener.document.'.$return_form.'.no_hp1.value=cno_hp1;
		 window.opener.document.'.$return_form.'.no_hp2.value=cno_hp2;
		 window.opener.document.'.$return_form.'.contact_person.value=ccontact_person;
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
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>