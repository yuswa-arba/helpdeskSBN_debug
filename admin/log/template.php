<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("../../config/configuration_admin.php");

$plugins = '';

    $title	= 'Master Surat';
    $submenu	= "surat";
    //$plugins	= '';
    //$user	= ucfirst($loggedin["username"]);
    //$group	= $loggedin['group'];
	$user = "Dwi";
	$group = "admin";
	$content ='
    <!-- bootstrap datepicker -->
  
    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>';
	
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
