<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/mbayartagihanglobal
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi (10 Agustus 2014)
 * Desc: Update sistem login dan created expired session
 * 
 */
function protection($field, $encrypt = false)
{ // Start Of Function.
    if (empty($field)) // Checks if $field is empty.

    {
        $return["error"] = "Value Empty"; // If $field is found to be empty it will return an error message.
    } else {
        if (is_array($field)) // Checks if $field is an array or not.

        { // If it is an array then carry on.
            foreach ($field as $key => $value) { // Carry out the foreach on the $field assigning the key and value of the array to $key and $value.
                $key = strip_tags($key); // Remove any tags from the field
                $value = strip_tags($value); // Remove any tags from the field
                $return[$key] = htmlentities($value, ENT_QUOTES); // Convert all applicable characters to HTML entities
            }
        } else // If $field isnt an array carry out the following.

        {
            $field = strip_tags($field); // Remove any tags from the field.
            $return = htmlentities($field, ENT_QUOTES); // Convert all applicable characters to HTML entities.
        }
    }
    return $return; // Return $return
}

function logged_in()
{
    global $conn;
    $sess_id = (isset($_COOKIE["GXSOFTWARE"])!="") ? ($_COOKIE["GXSOFTWARE"]) : "";

    $sess_check = mysql_query("SELECT * FROM `gxSessions`, `gxLogin` WHERE `gxSessions`.`id_user` = `gxLogin`.`id_user`
                              AND `gxSessions`.`sess_id` = '" . $sess_id ."'
                              AND `gxSessions`.`logged` = '0';", $conn);
    // If there is no session in the table where they are not logged in, show them as not logged in

    if (mysql_num_rows($sess_check)) { // Check if there is a row in the table.
        $s = mysql_fetch_array($sess_check); // Retrieve the data from the tables.
        $uinfo = mysql_query("SELECT `gxLogin`.*, `tbCustomer`.`cNama`, `tbCustomer`.`cAlamat1`,
                             `tbCustomer`.`cEmail`, `tbCustomer`.`iuserIndex`, `tbCustomer`.`cUserID`,
                             `tbCustomer`.`gx_saldo`, `tbCustomer`.`id_cabang`
                             FROM `gxLogin`, `tbCustomer`
                             WHERE `gxLogin`.`customer_number` = `tbCustomer`.`cKode`  AND
                             `gxLogin`.`id_user` = '" . $s['id_user'] . "';", $conn); // Retrieve the users table where the uid matches the uid in the sessions table
        
        $u = mysql_fetch_array($uinfo); // Retrieve the data from the tables.
        
        
        // Put the data into an array to be returned.
        $return = array("session_id" => $s['id'],
                        "session_sessid" => $s['sess_id'],
                        "id_user" => $u['id_user'],
                        "user_index" => $u['iuserIndex'],
                        "userid" => $u['cUserID'],
                        "customer_number" => $u['customer_number'],
                        "bank_saldo" => $u['gx_saldo'],
                        "id_vod" => $u['id_vod'],
                        "email" => $u['cEmail'],
                        "alamat" => $u['cAlamat1'],
                        "username" => $u['cNama'],
                        "cabang" => $u['id_cabang'],
                        "ip" => $s['ip'],
                        "last_visit" => $u['lastvisit'], 
                        "group" => $u['group']);
        // Return the array
        return $return;
    } else {
        // Return nothing
        return false;
    }
}

/*
 *
 * Parsing data sms to detail gps data
 * contoh data: $string = "Normal Mode!Lat:S7.945897,Lon:E112.614540,Course:265.82,Speed:5.9356Km/h,DateTime:14-11-19 16:39:13";
 *
 *
 * dibuat oleh: dwi
 * tanggal: 21 november 2014
 */

function parsingTexttoGPS($string)
{
    //$data_return = array();
    
    $string = trim($string);
    $sub_str_1 = explode("!", $string);
    $sub_str_2 = explode(",", $sub_str_1[1]);
    
    if(strpos($sub_str_1[0],'Normal') !== false)
    {
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
    }else{
        $data_lat = '';
        $data_lon = '';
        $data_course = '';
        $data_speed = '';
        $data_date = '';
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

/*
 * Rename periode paket
 * Created by: Dwi
 * Date: 17 nov 2014
 *
 */
function periodePaket($periode_paket)
{
    $periode = "";
    if($periode_paket == 1)
    {
        $periode = "Harian";
    }elseif($periode_paket == 7)
    {
        $periode = "Mingguan";
    }elseif($periode_paket == 30)
    {
        $periode = "Bulanan";
    }elseif($periode_paket == 365)
    {
        $periode = "Tahunan";
    }
    
    return $periode;
}

/*
 * Fungsi Role permission group
 * Created by: Dwi
 * Date: 22 Sept 2014
 *
 * Start
 */
function checkRole($id_group="", $menu="")
{
    global $conn;
    
    $sql_role = mysql_query("SELECT count(*) AS `total`
                            FROM `gx_user_group_role`, `gx_role_menu`
                            WHERE `gx_user_group_role`.`id_menu` = `gx_role_menu`.`id_menu`
                            AND `gx_user_group_role`.`id_group` = '".$id_group."'
                            AND `gx_role_menu`.`menu_nama` = '".$menu."' LIMIT 0,1;", $conn);
    
    if($row_role = mysql_fetch_array($sql_role)){
        
        $total = $row_role["total"];
        return $total;
    
    }else{
        return false;
    }
}
 
 /*
  *Role Permission
  *End
  */

/*
 * Fungsi Logging auto insert database
 * Created by: Dwi
 * Date: 4 Sept 2014
 *
 * Start
 */
function enableLog($id_customer="", $nama_customer="", $id_admin="",$activity=""){
    
    global $conn;
    $ua = getBrowserNew();
    $ub = getOSnew();
    
    mysql_query("INSERT INTO `gx_log_detail` (`id_logs`, `id_customer`, `nama_customer`, `id_admin`,`activity`, `time`, `ip`, `browser_detail`)
		VALUES (NULL, '".mysql_real_escape_string($id_customer)."', '".mysql_real_escape_string($nama_customer)."', '".mysql_real_escape_string($id_admin)."',
                '".mysql_real_escape_string($activity)."', NOW(), '".$_SERVER['REMOTE_ADDR']."',
                'os:".$ub.";browser:".$ua["name"].";version:".$ua["version"].";');", $conn);
	
}
//end logging

/*
 * Fungsi pembulatan persentase
 * Created by: Dwi
 * Date: 10 oktober 2014
 *
 * Start
 */
function Persen($persen)
{
    $persen_return = number_format(round($persen, 2), 2) . " %";
    return $persen_return;
}

function Bulatdua($persen)
{
    //$persen_return = round($persen, 2);
    $persen = number_format($persen, 2, ',', '.');
    $persen_return = 'Rp. ' . $persen;
    return $persen_return;
}

/*
 * Fungsi Logging auto insert database
 * Created by: Dwi
 * Date: 4 Sept 2014
 *
 * Start
 */
function kuotaKB($kuota=""){
    $kuota = round($kuota/1024) . " KB";
    
    return $kuota;
}
function kuotaMB($kuota=""){
    $kuota = round($kuota/1024/1024). " MB";
    
    return $kuota;
}
function kuotaData($size, $precision = 0)
{
    if($size !=""){
    $base = log($size) / log(1024);
    $suffixes = array(' B', ' KB', ' MB', ' GB', ' TB');

    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }else{
        $size = 0;
        return $size;
    }
}

function detiktoTime($sec=""){
    return gmdate("H:i:s", $sec);
    //$f=':';
    //return sprintf("%02d%s%02d%s%02d", floor($sec/3600), $f, ($sec/60)%60, $f, $sec%60);
}

function tglSoft($tgl=""){
    return date("d-m-Y", strtotime($tgl));
}

function jamSoft($jam=""){
    return date("H:i:s", strtotime($jam));
}
//end logging

//fungsi paging
function halaman($tot,$perhal,$adj,$file="")
{
$adjacents = $adj;
    $total_pages =$tot;
    $targetpage = "$file";
    $limit = $perhal;  
    $page = isset($_GET['page']) ? (int)$_GET['page'] : "" ;
    if($page) 
        $start = ($page - 1) * $limit;
    else
        $start = 0;     

    if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
    $prev = $page - 1;                            //previous page is page - 1
    $next = $page + 1;                            //next page is page + 1
    $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                        //last page minus 1

    $pagination = "";
    if($lastpage > 1)
    {    
        $pagination .= "<div class=\"pagination\">";
        //previous button
        if ($page > 1) 
            $pagination.= "<a href=\"$targetpage"."page=$prev\"> &#171; previous</a>";
        else
            $pagination.= "<span class=\"disabled\"> &#171; previous</span>";    
        
        //pages    
        if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
        {    
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage"."page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage"."page=$lastpage\">$lastpage</a>";        
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage"."page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage"."page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage"."page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage"."page=$lastpage\">$lastpage</a>";        
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage"."page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage"."page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage"."page=$next\">next &#187; </a>";
        else
            $pagination.= "<span class=\"disabled\">next &#187; </span>";
        $pagination.= "</div>\n";        
    }
        return $pagination;
}


//paging halaman list software
function halaman_software($tot,$perhal,$adj,$file=""){
$adjacents = $adj;
    $total_pages =$tot;
    $targetpage = "$file";
    $limit = $perhal;  
    $page = isset($_GET['page']) ? (int)$_GET['page'] : "" ;
    if($page) 
        $start = ($page - 1) * $limit;
    else
        $start = 0;     

    if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
    $prev = $page - 1;                            //previous page is page - 1
    $next = $page + 1;                            //next page is page + 1
    $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                        //last page minus 1

    $pagination = "";
    if($lastpage > 1)
    {
        //<div class="dataTables_paginate paging_bootstrap"><ul class="pagination"><li class="prev disabled"><a href="#">? Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next ? </a></li></ul></div>
        //<li class="prev"><a href="#">? Previous</a></li><li><a href="#">1</a></li><li class="active"><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#">Next ? </a></li>
        //$pagination .= "<div class=\"pagination\">";
        $pagination .= '<div class="dataTables_paginate paging_bootstrap"><ul class="pagination">';
        //previous button
        if ($page > 1){ 
            $pagination.= '<li class="prev"><a href="'.$targetpage.'page='.$prev.'"> &#171; Previous</a></li>'; // <a href=\"$targetpage"."page=$prev\"> &#171; previous</a>
        }else{
            $pagination.= '<li class="prev disabled"><a href="#"> &#171; Previous</a></li>'; //$pagination.= "<span class=\"disabled\"> &#171; previous</span>";    
        }
        
        
        
        //pages    
        if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
        {    
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page){
                    $pagination .= '<li class="active"><a href="#">'.$counter.'</a></li>';//$pagination.= "<span class=\"current\">$counter</span>";
                }
                else{
                    $pagination .= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                }
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page){
                        $pagination .= '<li class="active"><a href="#">'.$counter.'</a></li>';//$pagination.= "<span class=\"current\">$counter</span>";
                    }
                    else{
                        $pagination .= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                    }
                }
                $pagination.= '<li class="disable"><a href="#">...</a></li>';
                $pagination .= '<li><a href="'.$targetpage.'page='.$lpm1.'">'.$lpm1.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$lpm1\">$lpm1</a>";
                $pagination .= '<li><a href="'.$targetpage.'page='.$lastpage.'">'.$lastpage.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$lastpage\">$lastpage</a>";        
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination .= '<li><a href="'.$targetpage.'page=1">1</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=1\">1</a>";
                $pagination .= '<li><a href="'.$targetpage.'page=2">2</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=2\">2</a>";
                $pagination.= '<li class="disable"><a href="#">...</a></li>';
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page){
                        $pagination .= '<li class="active"><a href="#">'.$counter.'</a></li>'; //$pagination.= "<span class=\"current\">$counter</span>";
                    }
                    else{
                        $pagination .= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                    }
                }
                $pagination.= '<li class="disable"><a href="#">...</a></li>';
                $pagination .= '<li><a href="'.$targetpage.'page='.$lpm1.'">'.$lpm1.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$lpm1\">$lpm1</a>";
                $pagination .= '<li><a href="'.$targetpage.'page='.$lastpage.'">'.$lastpage.'</a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$lastpage\">$lastpage</a>";        
            }
            //close to end; only hide early pages
            else
            {
                $pagination .= '<li><a href="'.$targetpage.'page=1">1</a></li>'; // $pagination.= "<a href=\"$targetpage"."page=1\">1</a>";
                $pagination .= '<li><a href="'.$targetpage.'page=2">2</a></li>'; // $pagination.= "<a href=\"$targetpage"."page=2\">2</a>";
                $pagination.= '<li class="disable"><a href="#">...</a></li>';
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page){
                        $pagination .= '<li class="active"><a href="#">'.$counter.'</a></li>'; // $pagination.= "<span class=\"current\">$counter</span>";
                    }
                    else{
                        $pagination .= '<li><a href="'.$targetpage.'page='.$counter.'">'.$counter.'</a></li>'; // $pagination.= "<a href=\"$targetpage"."page=$counter\">$counter</a>";                    
                    }
                }
            }
        }
        
        //next button
        if ($page < $counter - 1){ 
            $pagination .= '<li class="next"><a href="'.$targetpage.'page='.$next.'">Next &#187; </a></li>'; //$pagination.= "<a href=\"$targetpage"."page=$next\">next &#187; </a>";
        }
        else{
            $pagination .= '<li class="next disabled"><a href="#">Next &#187; </a></li>';//$pagination.= "<span class=\"disabled\">next &#187; </span>";
        }
        $pagination .= '</ul></div>';        
    }
        return $pagination;
}



function redirectToHTTPS()
{
  if($_SERVER['HTTPS']!="on")
  {
     $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     header("Location:$redirect");
  }
}

//Start GetBrowser
function userAgent()
	{
		$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$acceptLanguage = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
		
                return array(
                    'operating_system' => getOSnew(),
                    'web_browser' => getBrowser($userAgent),
                    'accept_language' => getLanguage($acceptLanguage),
                );
	}
        
function getBrowser($userAgent)
	{
		$browserArray = array(
			'Google Chrome' => 'Chrome/',
			'Safari' => 'Safari',
			'Firefox 3.x' => 'Firefox/3',
			'Firefox 2.x' => 'Firefox/2',
			'Opera' => 'Opera',
			'IE 8.x' => 'MSIE 8',
			'IE 7.x' => 'MSIE 7',
			'IE 6.x' => 'MSIE 6'
		);
		foreach ($browserArray as $k => $value)
			if (strstr($userAgent, $value))
			{
				$browserValue = $k;
				return $browserValue;
			}
		return NULL;
	}
function getLanguage($acceptLanguage)
	{
		// $langsArray is filled with all the languages accepted, ordered by priority
		$langsArray = array();
		preg_match_all('/([a-z]{2}(-[a-z]{2})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/', $acceptLanguage, $array);
		if (count($array[1]))
		{
			$langsArray = array_combine($array[1], $array[4]);
			foreach ($langsArray as $lang => $val)
				if ($val === '')
					$langsArray[$lang] = 1;
			arsort($langsArray, SORT_NUMERIC);
		}
		
		// Only the first language is returned
		return (sizeof($langsArray) ? key($langsArray) : '');
	}
        
function getOSnew()
{
    if (isset($_SERVER["HTTP_USER_AGENT"]) OR ($_SERVER["HTTP_USER_AGENT"] != "")) {
        $visitor_user_agent = $_SERVER["HTTP_USER_AGENT"];
    } else {
        $visitor_user_agent = "Unknown";
    }
    // Create list of operating systems with operating system name as array key 
    $oses = array(
        'Mac OS X(Apple)' => '(iPhone)|(iPad)|(iPod)|(MAC OS X)|(OS X)',
        'Apple\'s mobile/tablet' => 'iOS',
        'BlackBerry' => 'BlackBerry',
        'Android' => 'Android',
        'Java Mobile Phones (J2ME)' => '(J2ME\/MIDP)|(J2ME)',
        'Java Mobile Phones (JME)' => 'JavaME',
        'JavaFX Mobile Phones' => 'JavaFX',
        'Windows Mobile Phones' => '(WinCE)|(Windows CE)',
        'Windows 3.11' => 'Win16',
        'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', 
        'Windows 98' => '(Windows 98)|(Win98)',
        'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
        'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
        'Windows 2003' => '(Windows NT 5.2)',
        'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
        'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
        'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
        'Windows ME' => 'Windows ME',
        'Open BSD' => 'OpenBSD',
        'Sun OS' => 'SunOS',
        'Linux' => '(Linux)|(X11)',
        'Macintosh' => '(Mac_PowerPC)|(Macintosh)',
        'QNX' => 'QNX',
        'BeOS' => 'BeOS',
        'OS/2' => 'OS/2',
        'ROBOT' => '(Spider)|(Bot)|(Ezooms)|(YandexBot)|(AhrefsBot)|(nuhk)|
                    (Googlebot)|(bingbot)|(Yahoo)|(Lycos)|(Scooter)|
                    (AltaVista)|(Gigabot)|(Googlebot-Mobile)|(Yammybot)|
                    (Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)|
                    (Ask Jeeves/Teoma)|(Java/1.6.0_04)'
    );
    foreach ($oses as $os => $pattern) {
        if (preg_match("/$pattern/", $visitor_user_agent)) {
            return $os;
        }
    }
    return 'Unknown';
}

function getBrowserNew()
{
    if (isset($_SERVER["HTTP_USER_AGENT"]) OR ($_SERVER["HTTP_USER_AGENT"] != "")) {
        $visitor_user_agent = $_SERVER["HTTP_USER_AGENT"];
    } else {
        $visitor_user_agent = "Unknown";
    }
    $bname = 'Unknown';
    $version = "0.0.0";
 
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/', $visitor_user_agent) && !preg_match('/Opera/', $visitor_user_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/', $visitor_user_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/', $visitor_user_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/', $visitor_user_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/', $visitor_user_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/', $visitor_user_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } elseif (preg_match('/Seamonkey/', $visitor_user_agent)) {
        $bname = 'Seamonkey';
        $ub = "Seamonkey";
    } elseif (preg_match('/Konqueror/', $visitor_user_agent)) {
        $bname = 'Konqueror';
        $ub = "Konqueror";
    } elseif (preg_match('/Navigator/', $visitor_user_agent)) {
        $bname = 'Navigator';
        $ub = "Navigator";
    } elseif (preg_match('/Mosaic/', $visitor_user_agent)) {
        $bname = 'Mosaic';
        $ub = "Mosaic";
    } elseif (preg_match('/Lynx/', $visitor_user_agent)) {
        $bname = 'Lynx';
        $ub = "Lynx";
    } elseif (preg_match('/Amaya/', $visitor_user_agent)) {
        $bname = 'Amaya';
        $ub = "Amaya";
    } elseif (preg_match('/Omniweb/', $visitor_user_agent)) {
        $bname = 'Omniweb';
        $ub = "Omniweb";
    } elseif (preg_match('/Avant/', $visitor_user_agent)) {
        $bname = 'Avant';
        $ub = "Avant";
    } elseif (preg_match('/Camino/', $visitor_user_agent)) {
        $bname = 'Camino';
        $ub = "Camino";
    } elseif (preg_match('/Flock/', $visitor_user_agent)) {
        $bname = 'Flock';
        $ub = "Flock";
    } elseif (preg_match('/AOL/', $visitor_user_agent)) {
        $bname = 'AOL';
        $ub = "AOL";
    } elseif (preg_match('/AIR/', $visitor_user_agent)) {
        $bname = 'AIR';
        $ub = "AIR";
    } elseif (preg_match('/Fluid/', $visitor_user_agent)) {
        $bname = 'Fluid';
        $ub = "Fluid";
    } else {
        $bname = 'Unknown';
        $ub = "Unknown";
    }
 
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $visitor_user_agent, $matches)) {
        // we have no matching number just continue
    }
 
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($visitor_user_agent, "Version") < strripos($visitor_user_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }
 
    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }
 
    return array(
        'userAgent' => $visitor_user_agent,
        'name' => $bname,
        'version' => $version,
        'pattern' => $pattern
    );
}


function visit_country()
{
    $data = array();
    $remote  = $_SERVER['REMOTE_ADDR'];
    $url = 'http://ipinfo.io/'.$remote.'/json';
    $content = file_get_contents($url);
    $json = json_decode($content, true);
    
    
    //return $result;
    $data = array(
        'ip' => $json["ip"],
        'hostname' => $json["hostname"],
        'city' => $json["city"],
        'region' => $json["region"],
        'country' => $json["country"],
        'lists' => $json["lists"],
        'loc' => $json["loc"],
        'org' => $json["org"]
    );
    
    return $data;
}
 

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result_country = $ip_data->geoplugin_countryName;
        $result_city    = $ip_data->geoplugin_city;
        $result_region  = $ip_data->geoplugin_regionName;
        $result_coord   = $ip_data->geoplugin_latitude .', '.$ip_data->geoplugin_longitude;
    }

    //return $result;
    return array(
        'country' => $result_country,
        'city' => $result_city,
        'region' => $result_region,
        'coord' => $result_coord
    );
}

function greeting()
{
 $b = time(); 

 $hour = date("g",$b);
 $m = date ("A", $b);
 $greeting = "";
 
 if ($m == "AM") {
  if ($hour == 12){
    $greeting = "Good Evening";
  }elseif ($hour < 4){
    $greeting = "Good Evening";
  }elseif ($hour > 3){
    $greeting = "Good Morning";
  }
 }elseif ($m == "PM"){
  if ($hour == 12){
    $greeting = "Good Afternoon";
  }elseif ($hour < 7){
    $greeting = "Good Afternoon";
  }elseif ($hour > 6){
    $greeting = "Good Evening";
  }
 }
 
 return $greeting;

}

//remove .00000
function Nominal($nominal)
{
    return (int)$nominal;
}

function Rupiah($angka)
{
    $ang  = "";
    while (strlen($angka) > 3)
    {
        $ang    = "." . substr($angka, -3) . $ang;
        $lbr    = strlen($angka);
        $angka  = substr($angka,0,$lbr-3);
    }
    $ang = 'Rp. '.$angka.$ang.',00';
    
    
    return $ang;
}

function Angka($angka)
{
    $ang  = "";
    $angka = substr($angka,0, -3);
    while (strlen($angka) > 3)
    {
        $ang    = "." . substr($angka, -3) . $ang;
        $lbr    = strlen($angka);
        $angka  = substr($angka,0,$lbr-3);
    }
    $ang = $angka.$ang.',00';
    return $ang;
}


function AngkaSoft($angka)
{
    $ang = 'Rp. '.number_format($angka,2, ',','.');
    return $ang;
}
/*
 * Type billing dari software RBS
 *
 */
function typeBillSoft($type)
{
	switch ($type){
		case 1: 
			return "Account Cost";
			break;
		case 2:
			return "Usage";
			break;
		case 3:
			return "-";
			break;
		case 4:
			return "-";
			break;
		case 5:
			return "-";
			break;
		case 6:
			return "-";
			break;
		case 7:
			return "-";
			break;
		case 8:
			return "Setup Fee";
			break;
	}
}

function getBulan($bln)
{
	switch ($bln){
		case 01: 
			return "Januari";
			break;
		case 02:
			return "Februari";
			break;
		case 03:
			return "Maret";
			break;
		case 04:
			return "April";
			break;
		case 05:
			return "Mei";
			break;
		case 06:
			return "Juni";
			break;
		case 07:
			return "Juli";
			break;
		case 08:
			return "Agustus";
			break;
		case 09:
			return "September";
			break;
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function word_limiter( $text, $limit = 10, $chars = '0123456789' )
{
    if( strlen( $text ) > $limit ) {
        $words = str_word_count( $text, 2, $chars );
        $words = array_reverse( $words, TRUE );
        foreach( $words as $length => $word ) {
            if( $length + strlen( $word ) >= $limit ) {
                array_shift( $words );
            } else {
                break;
            }
        }
        $words = array_reverse( $words );
        $text = implode( " ", $words ) . '&hellip;';
    }
    return $text;
}


function DMStoDEC($deg,$min,$sec)
{

// Converts DMS ( Degrees / minutes / seconds ) 
// to decimal format longitude / latitude

    return $deg+((($min*60)+($sec))/3600);
}

function DMStoGPS($string)
{
    $string_explode = explode("`", trim($string));
    $deg            = $string_explode[0];
    $min            = $string_explode[1];
    $sec            = $string_explode[2];
    
// Converts DMS ( Degrees / minutes / seconds ) 
// to decimal format longitude / latitude

    return $deg+((($min*60)+($sec))/3600);
}

function DECtoDMS($dec)
{

// Converts decimal longitude / latitude to DMS
// ( Degrees / minutes / seconds ) 

// This is the piece of code which may appear to 
// be inefficient, but to avoid issues with floating
// point math we extract the integer part and the float
// part by using a string function.

    $vars = explode(".",$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
}

/*
 * Email Topup Pulsa
 * Parameter: $email, $kode_invoice
 *
 *
 *
 *
 */

function email_topup_pulsa($email="",$kode_invoice=""){
		if($email!='' && $kode_invoice!=''){
            
            
            
            $body = '
				<html>
						<body>
							<div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Topup</h3>
                                        </div><!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <h4><i class="icon fa fa-check"></i> Topup Pulsa </h4>
                                                Jumlah yang harus anda bayar adalah <b>Rp. '.number_format($nominal_topup, 0, '','.').'</b><br>
                                                Silahkan melakukan pembayaran sesuai dengan metode pembayaran yg dipilih.<br><br>
                                                
                                                Batas waktu anda melakukan pembayaran 3 jam dari sekarang ('.$expdate_topup.').<br><br>
                                                Note: Apabila transfer tidak sesuai dengan nominal diatas / melebihi batas, silahkan hubungi customer service kami.<br><br>
                                                
                                                
                                                Terima kasih.<br><br><br><br>
                                                Globalxtreme									
                                                
                                                
                                                
                                            </div>
                            
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </div>
                            </div>
						</body>
				</html>
        ';
        kirim_email($email,"", "","Topup Pulsa Helpdesk GlobalXtreme", $body, "");
    }	
		return '';
		
}

/*
 * Send Email
 * Parameter $to, $cc, $bcc, $subject, $body, $attachment
 *
 */
function kirim_email($to, $cc, $bcc, $subject, $body, $attachment)
{		
    $mail = new PHPMailer(true);

	$mail->IsSMTP();
	$mail->SMTPAuth   = false;
	$mail->Host 	  = "smtp.dps.globalxtreme.net";
	$mail->Port       = 2505; 

	$mail->IsSendmail();
	$mail->AddReplyTo("helpdesk@globalxtreme.net","Helpdesk GlobalXtreme");

	$mail->From       = "helpdesk@globalxtreme.net";
	$mail->FromName   = "Helpdesk GlobalXtreme";

	$mail->AddAddress($to);
	if ($cc !="") $mail->AddCC($cc);
    if ($bcc !="") $mail->AddBCC($bcc);

	$mail->Subject  = $subject;

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);
	$mail->AddAttachment($attachment);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
        
	return '';
}