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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
	if($loggedin["group"] == 'admin'){
    
		global $conn;
		
		
		$fh = fopen('olt/script.exp', 'w');
		
		$result = mysql_query("SELECT * FROM `gx_inet_olt_script`;", $conn);
		$row = mysql_fetch_array($result);
		
		$result_olt_customer = mysql_query("SELECT * FROM `v_olt_customer` where userid = 'balialik' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		
		
		$replace = array( 
            '[username]' => $row_olt_customer["username"], 
            '[password]' => $row_olt_customer["password"],
			'[pon]' => $row_olt_customer["pon"],
			'[id]' => $row_olt_customer["id"]
        ); 
        $script = strReplaceAssoc($replace,$row["script"]);
			
		fwrite($fh, $script);
		fclose($fh);
		chmod("/var/www/software/beta/admin/data/olt/script.exp",0755);
		
		$old_path = getcwd();
		chdir('/var/www/software/beta/admin/data/olt/');
		$output = shell_exec('./script.exp');
		
		
		//$output = shell_exec("olt/script.exp");
		
$logFile = '/var/www/software/beta/admin/data/olt/power-onu.txt';
$lines = file($logFile); // Get each line of the file and store it as an array
$table = '<table border="1"><tr><td>Date</td></tr>'; // A variable $table, we'll use this to store our table and output it later !
$line_data =  count ($lines) - 2;
print_r ($lines[$line_data]);
foreach($lines as $line){ // We are going to loop through each line
    echo $line . "<br>";
	
	
	if (strpos($line, 'has bound 1 active ONUs') !== false) {
		echo 'active';
	}elseif (strpos($line, 'has bound 1 inactive ONUs') !== false) {
		echo 'inactive';
	}
	//$line_data = explode('\n', $line);
    // What explode basically does is it takes a delimiter, and a string. It will generate an array depending on those two parameters
    // To explain this I'll provide an example : $array = explode('.', 'a.b.c.d');
    // $array will now contain array('a', 'b', 'c', 'd');
    // We use list() to give them kind of a "name"
    // So when we use list($date, $time, $ip, $domain) = explode('.', 'a.b.c.d');
    // $date will be 'a', $time will be 'b', $ip will be 'c' and $domain will be 'd'
    // We could also do it this way:
    // $data = explode(' - ', $line);
    // $table .= '<tr><td>'.$data[0].'</td><td>'.$data[1].'</td><td>'.$data[2].'</td><td>'.$data[3].'</td></tr>';
    // But the list() technique is much more readable in a way
	
		//echo count($line_data);
		//echo "<pre>";
		//print_r($line_data[0]);
		//echo "</pre>";
	
	//$table .= "<tr><td>$line_data</td></tr>";
	
	//list($interface, $mac, $status, $oam, $status1, $distance, $rit, $LastRegTime, $LastDeregTime, $LastDeregReason, $Alivetime) = explode(' ', $line);
    //$table .= "<tr><td>$interface, $mac, $status, $oam, $status1, $distance, $rit, $LastRegTime, $LastDeregTime, $LastDeregReason, $Alivetime</td></tr>";
	
}



$table .= '</table>';
echo $table;

		//echo "<pre>$output</pre>";
    //echo phpinfo();
	}
} else{
	header('location: '.URL_ADMIN.'logout.php');
}

?>