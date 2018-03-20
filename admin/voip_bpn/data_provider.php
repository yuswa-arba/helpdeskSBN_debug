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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data provider");
    global $conn;
    global $conn_voip;
?>
<?php
 $plugins = '   
<script type=\'text/javascript\'>
	function validepopupform(num_provider){
		    window.opener.document.myForm.data_provider.value=num_provider;
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
				<div class="box">';
$content .= '
		<table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th>ID</th><th>PROVIDER NAME</th><th>CREATIONDATE</th><th>DESCRIPTION</th><th>ACTION</th>
                  </tr>
                </thead>
                <tbody>';

$sql_provider	= "SELECT `id`, `provider_name`, `creationdate`, `description` FROM `cc_provider`";
$query_provider	= mysql_query($sql_provider, $conn_voip);
$no = 1;

    while ($row_provider = mysql_fetch_array($query_provider)) {
	$content .='<tr>
                    <td>'.$row_provider["id"].'</td>
                    <td>'.$row_provider["provider_name"].'</td>
                    <td>'.$row_provider["creationdate"].'</td>
		    <td>'.$row_provider['description'].'</td>
		    <td>
                      <a href="" onclick="validepopupform(\''.$row_provider['id'].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		

$content .= '
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

    $title	= 'input data provider';
    $submenu	= "Data Number Provider";
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