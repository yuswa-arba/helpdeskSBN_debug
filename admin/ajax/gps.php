<?php
include ("../../config/configuration_admin.php");

$string_sms = '
IMEI:358899050565475;GPRSInterval:10;TIMESET:20;SOS:085790937791,085790937791,085790937791;Center Number:085790937791;Sensor time Interval:10,180;Sensor Alarm time Interval:10;TimeZOne:E,8,0;ALM:ON,3,3;SVL:M;Speed:OFF; HBT:3;';

$sms = explode(";", trim(substr($string_sms, 0, -1)));
foreach($sms as $key => $value)
{
    $param = explode(":", trim($value));
    $nilai = $param[1];
    echo $nilai;
    echo"<br>";
}

$string = "Normal Mode!Lat:S7.945897,Lon:E112.614540,Course:265.82,Speed:5.9356Km/h,DateTime:14-11-19 16:39:13";
function parsingTexttoGPS($string)
{
    //$data_return = array();
    
    $string = trim($string);
    $sub_str_1 = explode("!", $string);
    $sub_str_2 = explode(",", $sub_str_1[1]);
    
    
    foreach($sub_str_2 as $key => $value)
    {
	if (strpos($value,'Lat') !== false) {
	    $sub_str_3 = explode(":", $value);
	    $data_lat = $sub_str_3[1];
	    $data_lat = preg_replace('/S/', '-', $data_lat, 1);
	    $data_lat = preg_replace('/N/', '', $data_lat, 1);
	}elseif (strpos($value,'Lon') !== false) {
	    $sub_str_3 = explode(":", $value);
	    $data_lon = $sub_str_3[1];
	    $data_lon = preg_replace('/W/', '-', $data_lon, 1);
	    $data_lon = preg_replace('/E/', '', $data_lon, 1);
	}elseif (strpos($value,'Course') !== false) {
	    $sub_str_3 = explode(":", $value);
	    $data_course = $sub_str_3[1];
	}elseif (strpos($value,'Speed') !== false) {
	    $sub_str_3 = explode(":", $value);
	    $data_speed = $sub_str_3[1];
	}else{
	    $data_date = $value;
	}
    }
    
    // Put the data into an array to be returned.
    $return = array("lat" => $data_lat,
		    "long" => $data_lon,
		    "course" => $data_course,
		    "speed" => $data_speed,
		    "datetime" => $data_date);
    // Return the array
    return $return;

}

echo parsingText($string);