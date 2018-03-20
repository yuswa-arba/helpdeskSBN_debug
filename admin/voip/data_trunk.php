<?php
/*
 * Theme Name: Software Voip
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 8 oktober 2014
 * Email: dwi@globalxtreme.net
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data trunk");
    global $conn;
    global $conn_voip;

$plugins = '    
<script type=\'text/javascript\'>
	function validepopupform(n_cust){
		window.opener.document.myForm.id_trunk.value=n_cust;
		self.close();
        }
</script>';
?>



<?php
$content = '<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
							 			
				    <div class="box-header">
                                    <h3 class="box-title">List CDR Report</h3>
                                </div><!-- /.box-header -->
				<div class="box">
			    ';
$content .='
		<table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th>ID</th><th>LABEL</th><th>PROVIDER</th><th>ACTION</th>
                  </tr>
                </thead>
                <tbody>';

$sql_trunk	= "SELECT `id_trunk`, `trunkcode`, `trunkprefix`, `providertech`, `providerip`, `removeprefix`, `secondusedreal`, `secondusedcarrier`, `secondusedratecard`, `creationdate`, `failover_trunk`, `addparameter`, `id_provider`, `inuse`, `maxuse`, `status`, `if_max_use` FROM `cc_trunk`";
$query_trunk	= mysql_query($sql_trunk, $conn_voip);
$no = 1;

    while ($row_trunk = mysql_fetch_array($query_trunk)) {
	$content .='<tr>
                    <td>'.$row_trunk["id_trunk"].'</td>
                    <td>'.$row_trunk["trunkcode"].'</td>
                    <td>';
		    $data_provider = mysql_fetch_array(mysql_query("SELECT `id`, `provider_name`, `creationdate`, `description` FROM `cc_provider` WHERE `id`='$row_trunk[id_provider]'", $conn_voip));
		    $content .= $data_provider['provider_name'];
		    $content .= '</td>
		    <td>
                      <a href="" onclick="validepopupform(\''.$row_trunk['id_trunk'].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';
	      
$content .= '
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

    $title	= 'input data trunk';
    $submenu	= "Data number trunk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

?>

<?php

	} else{
		header("location: index.php");
	}
} else{
    header("location: index.php");
}
?>