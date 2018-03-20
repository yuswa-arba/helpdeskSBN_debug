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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Group RBS");
    global $conn;
    $conn_soft = Config::getInstanceSoft();
	
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $f			= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Group RBS</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search" id="form_search">
				 <table class="form" width="80%">
		      <tr>
			<td>
			  <label>GroupIndex</label>
			</td>
			<td>
			  <input class="form-control" name="GroupIndex" type="text" value="">
			</td>
		      </tr>
			  <tr>
			<td>
			  <label>GroupName</label>
			</td>
			<td>
			  <input class="form-control" name="GroupName" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="search" value="Search">
			</td>
		      </tr>
		</table>
				</form>
		';
		
if(isset($_POST["search"])){
 $GroupIndex	= isset($_POST['GroupIndex']) ? mysql_real_escape_string(strip_tags(trim($_POST['GroupIndex']))) : "";
 $GroupName		= isset($_POST['GroupName']) ? mysql_real_escape_string(strip_tags(trim($_POST['GroupName']))) : "";
 
  $sql = "SELECT TOP 10 GroupIndex, GroupName, NASAttributes FROM dbo.Groups
  WHERE dbo.Groups.GroupIndex = '".$GroupIndex."' OR
  dbo.Groups.GroupName LIKE '%".$GroupName."%'
  ORDER BY dbo.Groups.GroupName;";
 
}else{
 
 $sql = "SELECT TOP 10 GroupIndex, GroupName, NASAttributes FROM dbo.Groups ORDER BY dbo.Groups.GroupName;";
 
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>GroupIndex</th>
		    <th>GroupName</th>
		    <th>NASAttributes</th>
			<th>#</th>
                  </tr>
                </thead>
                <tbody>';


$sql_data = $conn_soft->prepare($sql);
$sql_data->execute();

$no = 1;

while ($row_data = $sql_data->fetch())
{
   
    $content .='<tr>
		<td>'.$no.'</td>
		<td>'.$row_data["GroupIndex"].'</td>
		<td>'.$row_data["GroupName"].'</td>
		<td>'.$row_data["NASAttributes"].'</td>
		<td>
		  <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["GroupIndex"]).'\',\''.mysql_real_escape_string($row_data["GroupName"]).'\')">Select</a>
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

$plugins = '';

$plugins .= '
<script type="text/javascript">
  
	function validepopupform2(noacc, nama){
                window.opener.document.'.$return_form.'.'.$f.'.value=nama;
                
		self.close();
        }
</script>

    ';
 

	//window.opener.document.'.$return_form.'.title_invoice.value=namai;
	//window.opener.document.'.$return_form.'.nominal.value=hargai;
    $title	= 'Data Group RBS';
    $submenu	= "master_paket";
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