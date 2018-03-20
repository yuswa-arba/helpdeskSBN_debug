<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
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
 $sql_prospek	= "SELECT * FROM `gx_proposal` WHERE `level` = '0' ORDER BY `id_proposal` DESC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode proposal</th>
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
 if($_GET["f"] == "reproposal"){
  while ($row_prospek = mysql_fetch_array($query_prospek)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_prospek["kode_proposal"].'</td>
		     <td>'.$row_prospek["nama_customer"].'</td>
		     <td>'.$row_prospek["date_add"].'</td>
		     <td>'.$row_prospek["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_prospek["id_proposal"]).'\', \''.mysql_real_escape_string($row_prospek["kode_proposal"]).'\', \''.mysql_real_escape_string($row_prospek["nama_customer"]).'\', \''.mysql_real_escape_string($row_prospek["nama_perusahaan"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
 if($_GET["f"] == "reproposalkabag"){
  while ($row_prospek = mysql_fetch_array($query_prospek)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_prospek["kode_proposal"].'</td>
		     <td>'.$row_prospek["nama_customer"].'</td>
		     <td>'.$row_prospek["date_add"].'</td>
		     <td>'.$row_prospek["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_prospek["id_proposal"]).'\', \''.mysql_real_escape_string($row_prospek["kode_proposal"]).'\', \''.mysql_real_escape_string($row_prospek["nama_customer"]).'\', \''.mysql_real_escape_string($row_prospek["nama_perusahaan"]).'\', \''.mysql_real_escape_string($row_prospek["id_marketing"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
 if($_GET["f"] == "jawabproposal"){
  while ($row_prospek = mysql_fetch_array($query_prospek)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_prospek["kode_proposal"].'</td>
		     <td>'.$row_prospek["nama_customer"].'</td>
		     <td>'.$row_prospek["date_add"].'</td>
		     <td>'.$row_prospek["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_prospek["id_proposal"]).'\', \''.mysql_real_escape_string($row_prospek["kode_proposal"]).'\', \''.mysql_real_escape_string($row_prospek["nama_customer"]).'\', \''.mysql_real_escape_string($row_prospek["nama_perusahaan"]).'\', \''.mysql_real_escape_string($row_prospek["id_marketing"]).'\')">Select</a>
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
 if($_GET["f"] == "reproposal"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(cid_prposal, ckode_proposal, cnama_customer, cnamapreusahaan){
		 window.opener.document.'.$return_form.'.id_proposal.value=cid_prposal;
		 window.opener.document.'.$return_form.'.kode_proposal.value=ckode_proposal;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnama_customer;
		 window.opener.document.'.$return_form.'.nama_perusahaan.value=cnamapreusahaan;
		 
		 self.close();
	 }
 </script>
 
     ';
 }if($_GET["f"] == "reproposalkabag"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(cid_prposal, ckode_proposal, cnama_customer, cnamapreusahaan, cmarketing){
		 window.opener.document.'.$return_form.'.id_proposal.value=cid_prposal;
		 window.opener.document.'.$return_form.'.kode_proposal.value=ckode_proposal;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnama_customer;
		 window.opener.document.'.$return_form.'.nama_perusahaan.value=cnamapreusahaan;
		 window.opener.document.'.$return_form.'.nama_marketing.value=cmarketing;
		 
		 self.close();
	 }
 </script>
 
     ';
 }if($_GET["f"] == "jawabproposal"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(cid_prposal, ckode_proposal, cnama_customer, cnamapreusahaan, cmarketing){
		 window.opener.document.'.$return_form.'.id_proposal.value=cid_prposal;
		 window.opener.document.'.$return_form.'.kode_proposal.value=ckode_proposal;
		 window.opener.document.'.$return_form.'.nama_customer.value=cnama_customer;
		 window.opener.document.'.$return_form.'.nama_perusahaan.value=cnamapreusahaan;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


    $title	= 'Data prospek';
    $submenu	= "proposal";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>