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

include ("config/configuration.php");
include ("config/home/template_v1.php");

global $conn;

redirectToHTTPS();

$content ='<div class="section-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="animated slideInLeft"><span>Marketing</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <!-- Contact us form -->
        <div class="col-sm-8">
	    
        </div>
        <!-- Right column -->
        <div class="col-sm-4">
          
        </div>
      </div>
    </div>';

    
    $title	= 'GlobalXtreme Customer Panel';
    $submenu	= "home_marketing";
    $plugins	= '';
    $user	= '';
    $group	= '';
    $template	= home_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    