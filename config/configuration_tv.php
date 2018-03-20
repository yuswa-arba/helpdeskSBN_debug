<?php
/*
 * Project Name: Globalxtreme Web Intranet Template
 * Project URI: https://192.168.182.10/intra
 * Author: GlobalXtreme.net
 * Version: 1.0  | 26 maret 2014
 * Email: dafi@xtremewebsolution.net
 * Project for Web Intra & Helpdesk
 * Last edited: Dafi
 * Desc: 
 * 
 */

//VOIP Bali 
define("DATABASE_LOCATION_TV", "192.168.223.11");
define("DATABASE_USERNAME_TV", "sbn");
define("DATABASE_PASSWORD_TV", "b4ckupw3b");
define("DATABASE_NAME_TV", "ott");


function myErrorHandler($errno, $errstr, $errfile, $errline){
    // Do something other than output message.
    $exp = explode(" ", $errstr);
    if($exp[0] == 'mysqli_connect():' || $exp[0] == 'mysqli_ping()'){
        if($exp[0] == 'mysqli_connect():')
		{
			//echo $errstr . " in line " . $errline . "<br>";
			//echo $errstr . "<br>";
        }
    }
	else
	{
     
		/*echo $errno;
		echo"<br/>";
		echo $errstr;
		echo"<br/>";
		echo $errfile;
		echo"<br/>";
		echo $errline;
		echo"<br/>";*/
       
    }
    return true;
  }

  $old_error_handler = set_error_handler("myErrorHandler");
  
/** CONNECT TO DATABASE **/
function DB_TV()
{
    $conn_ott = mysqli_connect(DATABASE_LOCATION_TV,DATABASE_USERNAME_TV,DATABASE_PASSWORD_TV);
    mysqli_set_charset($conn_ott, 'utf8');
	if(mysqli_ping($conn_ott))
	{
		mysqli_select_db($conn_ott,DATABASE_NAME_TV);
	}
	else
	{
		echo "Database OTT Putus";
	}
    return $conn_ott;
}
