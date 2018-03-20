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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Customer");
    global $conn;
	$conn_ott   = DB_TV();
    
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
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<table class="form" width="80%">
		      <tr>
			<td>
			  <label>STB User *</label>
			</td>
			<td>
			  <input class="form-control" name="CLIENTNAME" placeholder="CLIENTNAME" type="text" value="">
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
	$CLIENTNAME	= isset($_POST['CLIENTNAME']) ? mysql_real_escape_string(strip_tags(trim($_POST['CLIENTNAME']))) : "";
	
	$sql_customer	= "SELECT * FROM `boss`.`t_account_cms`
	WHERE `CLIENTNAME` LIKE '%".$CLIENTNAME."%'
	ORDER BY `CLIENTNAME` DESC LIMIT 0,10;";
	//echo $sql_customer;
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Customer Number</th>
					<th>CLIENTCODE</th>
					<th>Name</th>
					<th>Address</th>
					
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_customer	= mysqli_query($conn_ott, $sql_customer);
$no = 1;

  while ($row_customer = mysqli_fetch_array($query_customer)) {

	 $content .='<tr>
		     <td>'.$no.'</td>
			 <td></td>
		     <td>'.$row_customer["CLIENTCODE"].'</td>
		     <td>'.$row_customer["CLIENTNAME"].'</td>
		     <td>'.$row_customer["ADDRESS"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_customer["CLIENTID"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 
    
		
                  $content .='
                  
                </tbody>
              </table>';

}
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

  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(cid){
		 window.opener.document.'.$return_form.'.CLIENTID.value=cid;
		 self.close();
	 }
 </script>
 
     ';



    $title	= 'Data Customer';
    $submenu	= "helpdesk";
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