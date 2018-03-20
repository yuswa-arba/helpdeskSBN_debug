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
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    


	$sql_staff = mysql_query("SELECT *
			FROM `gx_pegawai`
			WHERE `gx_pegawai`.`kode_pegawai` = 'GX-000056' LIMIT 0,1;");
	
	$content ='';
while($row_staff = mysql_fetch_array($sql_staff))
{
    
    
    $sql_cabang = "SELECT *
		FROM `gx_cabang` 
                WHERE `id_cabang` = '".$row_staff["id_cabang"]."'
		AND `level` = '0'
		LIMIT 0,1;";
    $query_cabang = mysql_query($sql_cabang, $conn);
    $row_cabang = mysql_fetch_array($query_cabang);
    
    $content .='BEGIN:VCARD<br>
VERSION:4.0<br>
N:'.$row_staff["nama"].';;;;<br>
FN:'.$row_staff["nama"].'<br>
ORG:'.$row_cabang["nama_cabang"].'<br>
TITLE:'.$row_staff["jabatan"].'<br>
TEL;TYPE=mobile,voice;VALUE=uri:tel:'.$row_staff["hp"].'<br>
TEL;TYPE=work,voice;VALUE=uri:tel:'.$row_staff["hp"].'<br>
ADR;TYPE=home;LABEL="'.$row_staff["alamat"].'":;;'.$row_staff["alamat"].';;;;<br>
ADR;TYPE=work;LABEL="'.$row_staff["alamat"].'":;;'.$row_staff["alamat"].';;;;<br>
EMAIL:'.$row_staff["email"].'<br>
REV:20160106T092700Z<br>
END:VCARD<br>
<br>';
    
}


echo $content;


}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>