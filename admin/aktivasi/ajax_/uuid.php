<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 * Last edited: dwi tgl 1 desember 2016
 * 
 */
include ("../../../config/configuration_admin.php");


//insert log aktivasi
$uuid = get_uuid('gx_log_aktivasi');
$uuid_detail = get_uuid('gx_log_aktivasi_detail');
echo $uuid.'<br>';
echo $uuid_detail;
		