<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
ob_start();
include ("config/configuration.php");
include ("config/home/template_v1.php");

global $conn;

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in 
    header( 'Location: home' ) ;
} else { // If not logged in 

$content ='<div class="section-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="animated slideInLeft"><span>Contact Us</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <!-- Contact us form -->
        <div class="col-sm-8">
	    <!-- Out Address -->
          <h3 class="hl top-zero">Our Address</h3>
          <hr>
          <p>
            Jl. Raya Kerobokan 388x Br. Semer<br>
	    Kuta, Bali (80361) Indonesia<br />
            telp.(0361) 736811<br />
	    fax. (0361) 736833<br />
	    SMS Gateway 085 637 329 48<br />
	    Email : <a href="#">info@globalxtreme.net</a>            
            </p>
          <hr>
        </div>
        <!-- Right column -->
        <div class="col-sm-4">
          <!-- Google Maps -->
          <h4>Google Maps</h4>
          <hr>
          <div class="google-maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15777.478165988126!2d115.16295933068847!3d-8.656359891774724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2475d16b69f7f%3A0xff8857cc8313af8c!2sGlobalxtreme.net+ISP!5e0!3m2!1sid!2sid!4v1409796442252" width="400" height="300" frameborder="0" style="border:0"></iframe>
          </div>
        </div>
      </div>
    </div>';

    
    $title	= 'GlobalXtreme Customer Panel';
    $submenu	= "home";
    $plugins	= '';
    $user	= '';
    $group	= '';
    $template	= home_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}