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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Invoice");
    global $conn;
    
	$cKode	= isset($_GET['id']) ? $_GET['id'] : "";
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
    $f			= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
   
	$query_lokasi	= "SELECT * FROM `gx_galeri` WHERE `idcustomer_galeri`='".trim($cKode)."' AND `level` = '0' LIMIT 0,5;";
    $sql_lokasi		= mysql_query($query_lokasi, $conn);
    // echo $query_lokasi;
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Galeri</h2>
                                </div>
				
                                <div class="box-body table-responsive">';
while($row_lokasi = mysql_fetch_array($sql_lokasi))
{

 $content .='<img class="col-xs-3" src="../upload/customer/'.$row_lokasi["nama_file"].'">';
}
								
$content .='
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
    $title	= 'Galeri';
    $submenu	= "galeri";
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