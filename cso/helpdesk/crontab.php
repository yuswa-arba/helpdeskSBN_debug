<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("/var/www/software/beta/config/configuration_admin.php");

global $conn;

        
$query = "INSERT INTO `dwi` (`id`, `nama`, `date`) VALUES (NULL, 'dwi', NOW());";
mysql_query($query) or die("not save sql.");

echo "ok";

//*/10 * * * * php -f /var/www/software/beta/cso/helpdesk/crontab.php >> /var/log/crontab_invoice.log 2>&1
?>