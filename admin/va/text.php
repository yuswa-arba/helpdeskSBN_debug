<? //Generate text file on the fly
 include ("../../config/configuration_admin.php");
  global $conn;
if($loggedin = logged_inAdmin()){  
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=UPLREQ.txt");
 
  $sql_data		= mysql_query("SELECT *
								  FROM `gx_va`,`tbCustomer`
								  WHERE `gx_va`.`no_rek` = `tbCustomer`.`cNoRekVirtual`
								  AND `gx_va`.`status` = '1'
								  AND `gx_va`.`level` = '0'
								  ;", $conn);
  $no = 1;
print "
";
	   
    while($row_data = mysql_fetch_array($sql_data))
    {
	   
	   $sql_insert = "INSERT INTO `software`.`gx_va_log` (`id`, `no_va`, `tgl_generate`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	   VALUES (NULL, '".$row_data["no_rek"]."', NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	   //echo $sql_insert;
	   mysql_query($sql_insert, $conn) or die (mysql_error());
	   
	   $sql_update = "UPDATE `gx_va` SET `status` = '9',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `status` = '1';";
    
	   //echo $sql_update;
	   mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
print "1".$row_data["no_rek"]."".str_replace("-","",$row_data["cKode"])."".substr($row_data["cNama"], 0, 6)." QQ PTIMAM
";
	
    }
// do your Db stuff here to get the content into $content

}
?>