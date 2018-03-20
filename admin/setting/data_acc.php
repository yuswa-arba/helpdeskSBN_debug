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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Accounting");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $f			= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Nomer Accounting</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search" id="form_search">
				 <table class="form" width="80%">
		      <tr>
			<td>
			  <label>Nama</label>
			</td>
			<td>
			  <input class="form-control" name="nama" type="text" value="">
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
 $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
 
 $sql_data	= "SELECT * FROM `gx_no_accounting` WHERE `nama` LIKE '%".$nama."%' AND `level` = '0'
		    ORDER BY `no_accounting` DESC;";
 
}else{
 $sql_data	= "SELECT * FROM `gx_no_accounting` WHERE `level` = '0'
		    ORDER BY `no_accounting` DESC;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No ACC</th>
		    <th>Nama</th>
		    <th>Level</th>
		    <th>Jenis</th>
			<th>Group</th>
			<th>Divisi</th>
			<th>#</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = 1;

while ($row_data = mysql_fetch_array($query_data)) {
   
    $content .='<tr>
		<td>'.$no.'</td>
		<td>'.$row_data["no_accounting"].'</td>
		<td>'.$row_data["nama"].'</td>
		<td>'.$row_data["level_accounting"].'</td>
		<td>'.$row_data["jenis"].'</td>
		<td>'.$row_data["group"].'</td>
		<td>'.$row_data["divisi"].'</td>
		<td>
		  <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["no_accounting"]).'\',\''.mysql_real_escape_string($row_data["nama"]).'\')">Select</a>
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

$plugins = '
<script type="text/javascript">
  
	function validepopupform2(noacc, nama){
                window.opener.document.'.$return_form.'.acc_biaya.value=noacc;
				window.opener.document.'.$return_form.'.acc_biaya.value=noacc;
                
		self.close();
        }
</script>';
	
	//window.opener.document.'.$return_form.'.title_invoice.value=namai;
	//window.opener.document.'.$return_form.'.nominal.value=hargai;
    $title	= 'Data Invoice';
    $submenu	= "master_invoice";
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