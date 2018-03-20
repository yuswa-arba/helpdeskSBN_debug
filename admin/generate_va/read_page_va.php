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
include('../../config/admin/simplehtmldom/simple_html_dom.php');

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open link_budget");
    global $conn;
    

 

// Create DOM from URL or file
$html = file_get_html('http://www.bca.co.id/id/Individu/Sarana/Kurs-dan-Suku-Bunga/Kurs-dan-Kalkulator');

$content    = '<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                            
                                <div class="box-header">
                                    <h3>Kurs BCA</h3>
                                </div>
                                <div class="box-body">';
// Find all images 
foreach($html->find('div[class="table-responsive col-md-8 kurs-e-rate"]') as $element)
{
    $content .= $element. '<br>';
}

$content .='
            </div>
        </div>
		</div>
	</div>

</section>';

$plugins = '';

    $title	= 'Master IP Address';
    $submenu	= "master_ip";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }
