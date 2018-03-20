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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open link_budget");
    global $conn;
    

 

$content    = '<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
 
<iframe src="http://www.klikbca.com/" width="100%" height="800" id="frameDemo"></iframe>
                        </div>
                    </div>
                </section>
 
<script>

</script>';
//$( "#frameDemo" ).contents().find( "a" ).css( "background-color", "#BADA55" );
$plugins = '';

    $title	= 'Iframe BCA';
    $submenu	= "iframe_bca";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }
