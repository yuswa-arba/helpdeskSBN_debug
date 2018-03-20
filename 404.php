<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer' || $loggedin["group"] == 'admin'){
    
    
    $content ='<!-- Main content -->
                <section class="content">
                 
                    <div class="error-page">
                        <h2 class="headline text-info"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                            <p>
                                We could not find the page you were looking for. 
                                Meanwhile, you may <a href="home.php">return to dashboard</a> or try using the search form.
                            </p>
                            
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            
                
            ';

$plugins = '';

    $title	= '404 Error Page';
    $submenu	= "";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>