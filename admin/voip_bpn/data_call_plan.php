<?php
/*
 * Theme Name: Software Voip
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 8 oktober 2014
 * Email: dwi@globalxtreme.net
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data Call plan");
    global $conn;
    global $conn_voip;

$plugins = '    
<script type=\'text/javascript\'>
	function validepopupform(n_call_plan){
		window.opener.document.myForm.numb_call_plan.value=n_call_plan;
		self.close();
        }
</script>';
 ?>   

<?php
$content ='
<!-- Main content -->
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
			    
				
		<table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th>ID</th><th>NAME</th><th>LC TYPE</th><th>PACKAGE</th><th>INTER PREFIX</th><th>ACTION</th> 
                  </tr>
                </thead>
                <tbody>';

$sql_tariffgroup= "SELECT `id`, `iduser`, `idtariffplan`, `tariffgroupname`, `lcrtype`, `creationdate`, `removeinterprefix`, `id_cc_package_offer` FROM `cc_tariffgroup`";
$query_tariffgroup	= mysql_query($sql_tariffgroup, $conn_voip);
$no = 1;

    while ($row_tariffgroup = mysql_fetch_array($query_tariffgroup)) {
	$content .='<tr>
                    <td>'.$row_tariffgroup["id"].'</td>
                    <td>'.$row_tariffgroup["tariffgroupname"].'</td>
                    <td>'.($row_tariffgroup["lcrtype"] == 0 ? "LCR : buyer price" : "").'</td>
		    <td>';
                    $data_package = mysql_fetch_array(mysql_query("SELECT `label` FROM `cc_package_offer` WHERE `id`='$row_tariffgroup[id_cc_package_offer]'", $conn_voip));
                    $content .= $data_package["label"];
                    $content .= '</td>
		    <td>'.($row_tariffgroup["removeinterprefix"] == 1  ? "Remove prefix " : "").'</td>
		    <td>
                      <a href="" onclick="validepopupform(\''.$row_tariffgroup['id'].'\')">Select</a>
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

    $title	= 'input data number call plan';
    $submenu	= "Data Number Call Plan";
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