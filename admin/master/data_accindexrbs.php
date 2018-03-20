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
                                    <h2 class="box-title">Data Account Types RBS</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search" id="form_search">
				 <table class="form" width="80%">
		      <tr>
			<td>
			  <label>AccountIndex</label>
			</td>
			<td>
			  <input class="form-control" name="AccountIndex" type="text" value="">
			</td>
		      </tr>
			  <tr>
			<td>
			  <label>AccountName</label>
			</td>
			<td>
			  <input class="form-control" name="AccountName" type="text" value="">
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
 $AccountIndex	= isset($_POST['AccountIndex']) ? mysql_real_escape_string(strip_tags(trim($_POST['AccountIndex']))) : "";
 $AccountName		= isset($_POST['AccountName']) ? mysql_real_escape_string(strip_tags(trim($_POST['AccountName']))) : "";
 
  $sql = "SELECT TOP 10 * FROM dbo.AccountTypes 
  WHERE dbo.AccountTypes.AccountIndex = '".$AccountIndex."' OR
  dbo.AccountTypes.AccountName LIKE '%".$AccountName."%'
  ORDER BY dbo.AccountTypes.AccountName;";
 
}else{
 
 $sql = "SELECT TOP 10 * FROM dbo.AccountTypes ORDER BY dbo.AccountTypes.AccountName;";

}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Account Index</th>
					<th>Account Name</th>
					<th>Description</th>
					<th>Cost</th>
					<th>Setup Fee</th>
					<th>Time</th>
					<th>Kuota</th>
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
		<td>'.$row_data["AccountIndex"].'</td>
		<td>'.$row_data["AccountName"].'</td>
		<td>'.$row_data["AccountDescription"].'</td>
		<td>'.$row_data["AccountCost"].'</td>
		<td>'.$row_data["AccountSetupFee"].'</td>
		<td>'.$row_data["AccountTimeBank"].'</td>
		<td>'.$row_data["AccountKbBank"].'</td>
		<td>
		  <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["AccountIndex"]).'\',\''.mysql_real_escape_string($row_data["AccountName"]).'\')">Select</a>
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
                window.opener.document.'.$return_form.'.'.$f.'.value=noacc;
                
		self.close();
        }
</script>

    ';
 

	//window.opener.document.'.$return_form.'.title_invoice.value=namai;
	//window.opener.document.'.$return_form.'.nominal.value=hargai;
    $title	= 'Data Account Types RBS';
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