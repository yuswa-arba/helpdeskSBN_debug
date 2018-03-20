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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Generate Report");
     global $conn;
	 

if(isset($_GET["id"]) AND isset($_GET["tgl"])){
    
    
    

if($loggedin["group"] == "cso")
{
   
   if($loggedin['id_employee'] == "4" )
   {
		 
	   $date		= isset($_GET["tgl"]) ? trim(strip_tags($_GET["tgl"])) : "";
	   
	   if($date == ""){
	   $date = date("Y-m-d");
	   $date2 = date("d-m-Y");
	   }
	   
	   $sql_cso = mysql_query("SELECT `nama`, `id_employee`
				  FROM `gx_pegawai`
				  WHERE `level` = '0'
				  AND `aktif` = '0'
				  AND `id_bagian` = 'CSO'
				  AND `id_cabang` = '6'
				  AND `id_employee` != '1'
				  ORDER BY `nama` ASC;", $conn);
	   
	   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	   header("Cache-Control: no-cache");
	   header("Pragma: no-cache");
	   header("Content-disposition: attachment; filename=report.txt");
	   header("Content-type: text/plain");
	   
	   $jum_total = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			  `gx_helpdesk_complaint`.`trouble_ticket` = '1' AND
			   `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_incoming = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   
	   $jum_total_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'request' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			   `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
			 `gx_helpdesk_complaint`.`which_side` = 'customer' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
				 
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
			 `gx_helpdesk_complaint`.`which_side` = 'isp' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
			 
			 `gx_helpdesk_complaint`.`which_side` = 'customer' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
			 `gx_helpdesk_complaint`.`which_side` = 'isp' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_closed = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`status` = 'closed' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_open = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`status` = 'open' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_total_reopen = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`status` = 'reopen' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $stringData = "Laporan Harian Complaint ".$date."\r\n\r\n";
	   $stringData .= "Total Incoming: $jum_total_incoming\r\n";
	   $stringData .= "Total Trouble Ticket: $jum_total\r\n";
	   $stringData .= "Total Request: $jum_total_request;\r\nTotal Problem Wireless: $jum_total_problem_wifi; (Total ISP side: $jum_total_problem_wifi_isp; Total Customer side: $jum_total_problem_wifi_cust;)\r\nTotal Problem FO: $jum_total_problem_fo (Total ISP side: $jum_total_problem_fo_isp; Total Customer side: $jum_total_problem_fo_cust;)\r\nTotal Closed: $jum_total_closed;\r\nTotal Open: $jum_total_open;\r\nTotal Reopen: $jum_total_reopen;\r\n\r\n";
	   
	   $stringData .= "Dengan Detail tiap CSO sbb:\r\n\r\n";
	   $no = 1;
	   
	   while ($row_cso = mysql_fetch_array($sql_cso)){
	   
	   $id_cso	= $row_cso["id_employee"];
	   
	   $sql_report = "SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'";
			 
			 
	   
	   
	   $jum_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'Request' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
			 `gx_helpdesk_complaint`.`which_side` = 'customer' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
			 `gx_helpdesk_complaint`.`which_side` = 'isp' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
			 `gx_helpdesk_complaint`.`which_side` = 'customer' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
			 `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
			 `gx_helpdesk_complaint`.`which_side` = 'isp' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_closed = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_helpdesk_complaint`.`status` = 'closed' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_open = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_helpdesk_complaint`.`status` = 'open' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $jum_reopen = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
				 `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
			 `gx_pegawai`.`aktif` = '0' AND
			 `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
			 `gx_helpdesk_complaint`.`status` = 'reopen' AND
			 `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
			 `gx_helpdesk_complaint`.`level` = '0'", $conn));
	   
	   $query_report = mysql_query($sql_report, $conn);
	   $jum_report	  = mysql_num_rows($query_report);
	   
	   $stringData .= "$no. Nama CSO : ".$row_cso["nama"]."\r\n";
	   $stringData .= "Request: $jum_request; Problem Wireless: $jum_problem_wifi; (ISP side: $jum_problem_wifi_isp; Customer side: $jum_problem_wifi_cust;) Problem FO: $jum_problem_fo (ISP side: $jum_problem_fo_isp; Customer side: $jum_problem_fo_cust;) Closed: $jum_closed; Open: $jum_open; Reopen: $jum_reopen;\r\n\r\n";
	   //$stringData .= "Request: $jum_request; Problem : $jum_problem; Cleared: $jum_cleared; Uncleared: $jum_uncleared;\r\n\r\n";
	   
	   if($jum_report == 0){
		   //$stringData .= "Tidak ada laporan.\r\n\r\n";
	   }else{
		   
		   while($data_report  = mysql_fetch_array($query_report)){
		   
			   if($data_report["problem"]=="Others" || $data_report["problem"]==""){
			   $problem = $data_report["other_problem"];
		   }else{
			   $problem = $data_report["problem"];
		   }
				   
			   //$stringData .= "$no. Uid     : ".$data_report["user_id"]."\r\n   Jam     : ".$data_report["time"]."\r\n   Telp.   : ".$data_report["phone"]."\r\n   Masalah : ".$problem."\r\n   Solusi  : ".$data_report["solusi"]."\r\n   Status  : ".$data_report["status"]."\r\n\r\n";
		   
			   
		   }
	   }
	   $no++;
	   }
	  
	   echo $stringData;
	   
	   
   
}
else
{
    $date		= isset($_GET["tgl"]) ? trim(strip_tags($_GET["tgl"])) : "";
    $id_cso		= isset($_GET["id"]) ? trim(strip_tags($_GET["id"])) : $loggedin["id_employee"];
    
    if($date == ""){
	$date = date("Y-m-d");
	$date2 = date("d-m-Y");
    }
    
    $sql_report = "SELECT `gx_helpdesk_complaint`.*, `gx_pegawai`.`id_employee`, `gx_pegawai`.`nama` FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'";
    
    $jum_problem = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    
    $jum_request = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'request' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_problem_fo = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_problem_fo_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
		  `gx_helpdesk_complaint`.`which_side` = 'customer' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_problem_fo_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		 `gx_helpdesk_complaint`.`connection_type` = 'fo' AND
		  `gx_helpdesk_complaint`.`which_side` = 'isp' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_problem_wifi = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_problem_wifi_cust = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
		  `gx_helpdesk_complaint`.`which_side` = 'customer' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_problem_wifi_isp = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`complaint_type` = 'problem' AND
		  `gx_helpdesk_complaint`.`connection_type` = 'wl' AND
		  `gx_helpdesk_complaint`.`which_side` = 'isp' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_closed = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`status` = 'closed' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_open = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`status` = 'open' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    $jum_reopen = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`, `gx_pegawai` WHERE
	          `gx_helpdesk_complaint`.`id_cso` = `gx_pegawai`.`id_employee` AND
		  
		  `gx_helpdesk_complaint`.`id_cso` = '$id_cso' AND
		  `gx_helpdesk_complaint`.`status` = 'reopen' AND
		  `gx_helpdesk_complaint`.`date_add` LIKE '$date%' AND
		  `gx_helpdesk_complaint`.`level` = '0'", $conn));
    
    
    
    $query_report = mysql_query($sql_report, $conn);
    $no = 1;
    
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    header("Content-disposition: attachment; filename=report.txt");
    header("Content-type: text/plain");

    $stringData = "Laporan Harian Complaint ".$date."\r\n\r\n";
    
   
	$stringData .= "Request: $jum_request; Problem Wireless: $jum_problem_wifi; (ISP side: $jum_problem_wifi_isp; Customer side: $jum_problem_wifi_cust;) Problem FO: $jum_problem_fo (ISP side: $jum_problem_fo_isp; Customer side: $jum_problem_fo_cust;) Closed: $jum_closed; Open: $jum_open; Reopen: $jum_reopen;\r\n\r\n";
    
    
    while($data_report  = mysql_fetch_array($query_report)){
        
   if($data_report["problem_select"]==""){
	    $problem = $data_report["problem"];
	}else{
	    $problem = $data_report["problem_select"];
	}
    
    $stringData .= "$no. Uid     : ".$data_report["user_id"]."\r\n   Jam     : ".date("H:i", strtotime($data_report["date_add"]))."\r\n   Telp.   : ".$data_report["phone"]."\r\n   Masalah : ".$problem."\r\n   Note  : ".$data_report["note_"]."\r\n   Status  : ".$data_report["status"]."\r\n   Action  : ".$data_report["action"]."\r\n\r\n";
   
    $no++;
   
    }
   
   echo $stringData;
}

  }
}
}
} else{
	header('location: '.URL_CSO.'logout.php');
}

?>