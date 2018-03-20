<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/payment
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi
 * Desc:
 *
 */
session_start();
ob_start();

//file configuration for database and create session.
include ("../../config/configuration_admin.php");

global $conn;

$cKode 		= isset($_GET['k']) ? mysql_real_escape_string(trim($_GET['k'])) : '';
$select_sum 	= "SELECT COUNT(*) AS `total` FROM `tbCustomer` WHERE `cKode` LIKE '%".$cKode."%';";
$query_sum	= mysql_query($select_sum, $conn);
$row_sum 	= mysql_fetch_array($query_sum);

echo $row_sum["total"];