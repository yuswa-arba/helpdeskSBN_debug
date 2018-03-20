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
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail bank");
     global $conn;

     if(isset($_GET['id'])){
	  $id   	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
	  $sql_detail	= mysql_query("SELECT * FROM `gx_kasir_cso` WHERE `id_kasir_cso` = '$id' LIMIT 0,1;", $conn);
	  $row_detail 	= mysql_fetch_array($sql_detail);
	  
	  /*
	  $sql_user	= mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$row_detail["kode_cust"]."' AND `cNonAktiv` = '0' AND `level` = '0' LIMIT 0,1;", $conn);
	  $row_user 	= mysql_fetch_array($sql_user);
	  $user_id	= $row_user["cUserID"];
          $user_index = $row_user["iuserIndex"];
	  */
     
     }
     
     //echo $user_id;
     //Data RBS
     /*$conn_soft2 = Config::getInstanceSoft();
     $sql_user_soft = $conn_soft2->prepare("SELECT [Users].*
					FROM [DRBSISP].[dbo].[Users]
					WHERE [Users].[UserIndex] = '".$user_index."';");

     $sql_user_soft->execute();
     $row_user_soft = $sql_user_soft->fetch();
     */
     /*SELECT `id_kasir_cso`, `transaction_id`, `tgl_transaction`, `acc_kasir`, `mu`, `rate`, `remarks`, `tunai`, `bg_check`, `no_creditcard`, `no_debitcard`, `bank`, `no_edc`, `bukti_bayar`, `total`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_kasir_cso` WHERE 1*/
     
      

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
				   <table style="margin-bottom: 0;width:60%">
				     <tbody>
				     <tr>
					 <td>ID Transaction</td>
					 <td>'.$row_detail["transaction_id"].'</td>
				     </tr>
				     <tr>
					 <td>Tanggal Transaction</td>
					 <td>'.$row_detail["tgl_transaction"].'</td>
				     </tr>
				     <tr>
					 <td>ACC Kasir</td>
					 <td>'.$row_detail["acc_kasir"].'</td>
				     </tr>
				     <tr>
					 <td>MU</td>
					 <td>'.$row_detail["mu"].'</td>
				     </tr>
				     <tr>
					 <td>Rate</td>
					 <td>'.$row_detail["rate"].'</td>
				     </tr>
				     <tr>
					 <td>Remarks</td>
					 <td>'.$row_detail["remarks"].'</td>
				     </tr>
				     <tr>
					 <td>Tunai</td>
					 <td>'.$row_detail["tunai"].'</td>
				     </tr>
				     <tr>
					 <td>BG Check</td>
					 <td>'.$row_detail["bg_check"].'</td>
				     </tr>
				     <tr>
					 <td>No Credit Card</td>
					 <td>'.$row_detail["no_creditcard"].'</td>
				     </tr>
				     <tr>
					 <td>No EDC</td>
					 <td>'.$row_detail["no_edc"].'</td>
				     </tr>
				     <tr>
					 <td>Tanggal Buat</td>
					 <td>'.$row_detail["date_add"].'</td>
				     </tr>
                                     <tr>
					 <td>Tanggal Pembaruan</td>
					 <td>'.$row_detail["date_upd"].'</td>
				     </tr>
                                     <tr>
					 <td>User yang membuat</td>
					 <td>'.$row_detail["user_add"].'</td>
				     </tr>
                                     <tr>
					 <td>User yang memperbarui</td>
					 <td>'.$row_detail["user_upd"].'</td>
				     </tr>
				          
     
				   
				   <tr><td colspan="2" width="100%" align="center" >
				   <!--<br><a href="javascript:history.go(-1)"> go back</a><br>-->
				   </td></tr>
				     </tbody>
				 </table>
				 </div>
			      </div>
			      </div>
			      
			     
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
	       $(\'#bank_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
	       $(\'#email_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
            });
        </script>
	<script>
	    $(function () {
	      $(\'#myTab a:first\').tab(\'show\')
	    })
	</script>

    ';

    $title	= 'Mailbox';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>