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

$id_cabang	= isset($_GET['k']) ? mysql_real_escape_string(trim($_GET['k'])) : '';
$nama		= isset($_GET['n']) ? mysql_real_escape_string(trim($_GET['n'])) : '';
$sql_cabang	= mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$id_cabang."' LIMIT 0,1;", $conn);
$row_cabang	= mysql_fetch_array($sql_cabang);

$cKode		= $row_cabang["kode_cabang"].'-'.strtoupper($nama);
//echo "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$id_cabang."' LIMIT 0,1;";
//echo $cKode;

$select_sum 	= "SELECT `cKode` FROM `tbCustomer` WHERE `cKode` LIKE '%".$cKode."%' ORDER BY `idCustomer` DESC LIMIT 0,1;";
$query_sum	= mysql_query($select_sum, $conn);
$row_sum 	= mysql_fetch_array($query_sum);
$last_number    = str_replace($cKode, "", $row_sum["cKode"]);
$return = $cKode . sprintf("%06d", ( $last_number+1));
//echo str_replace($cKode, "", $row_sum["cKode"]) +1;
echo $return;
