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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Bank");
    global $conn;
    $perhalaman = 10;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $f			= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
  
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Accounting</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search" id="form_search">
				 <table class="form" width="80%">
		      <tr>
			<td>
			  <label>No Accounting</label>
			</td>
			<td>
			  <input class="form-control" name="no" type="text" value="">
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
 $no_accounting		= isset($_POST['no']) ? mysql_real_escape_string(strip_tags(trim($_POST['no']))) : "";
 
 $sql_data	= "SELECT * FROM `gx_no_accounting` WHERE `no_accounting` LIKE '%".$no_accounting."%' AND `level` = '0' ORDER BY `id_no_accounting` DESC;";
 $sql_total_kredit = mysql_num_rows(mysql_query("SELECT * FROM `gx_no_accounting` WHERE `no_accounting` LIKE '%".$no_accounting."%' AND `level` = '0' ORDER BY `id_no_accounting` DESC;", $conn));
}else{
 $sql_data	= "SELECT * FROM `gx_no_accounting` WHERE `level` = '0' ORDER BY `id_no_accounting` DESC LIMIT $start, $perhalaman;";
 $sql_total_kredit = mysql_num_rows(mysql_query("SELECT * FROM `gx_no_accounting` WHERE `level` = '0' ORDER BY `id_no_accounting` DESC;", $conn));
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No Accounting</th>
					<th>Nama</th>
					<th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_data	= mysql_query($sql_data, $conn);
$no = $start + 1;

  while ($row_data = mysql_fetch_array($query_data)) {
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_data["no_accounting"].'</td>
		     <td>'.$row_data["nama"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_data["no_accounting"]).'\',\''.mysql_real_escape_string($row_data["nama"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
                  $content .='
                  
                </tbody>
              </table>
			  <div class="box-footer">
				    <div class="box-tools pull-right">
				    '.(halaman($sql_total_kredit, $perhalaman, 1, "?r=$return_form&f=$f&")).'
				    </div>
				    <br style="clear:both;">
				</div>';


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
<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<script type="text/javascript">
  
	function validepopupform2(no_acc, acc){
                window.opener.document.'.$return_form.'.'.$f.'.value=no_acc;
		self.close();
        }
</script>

    ';
    $title	= 'Data kredit';
    $submenu	= "kasir";
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