<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Paket VOD ");
    global $conn;
    global $conn_voip;

$q 	= isset($_GET["q"]) ? strip_tags($_GET["q"]) : "";  
$perhalaman = 20;
	
if (isset($_GET['page'])){
	$page = (int)$_GET['page'];
	$start=($page - 1) * $perhalaman;
}else{
	$start=0;
}

    $sql_mov = mysql_query("SELECT * FROM `gx_vod_movies` m WHERE `genre` LIKE '%$q%' AND `level` = '0' ORDER BY m.year DESC, m.id_movies DESC limit $start,$perhalaman;", $conn);
    $sql_jumlah_mov =mysql_num_rows( mysql_query("SELECT * FROM `gx_vod_movies` m WHERE `genre` LIKE '%$q%' AND `level` = '0' ORDER BY m.year DESC, m.id_movies DESC;", $conn));
    $hal = ($q != "") ? '?q='.$q.'&' : '?';
    $icon ='';

    $stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'stats.php\'+options[selectedIndex].value;">
	<option value="">- Select -</option>
	<option value="">This Week</option>
	<option value="?b='.date("m").'&t='.date("Y").'">This Month</option>
        
</select>
</form>
                <div class="block">
                    <div id="chart1">';
                    

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");


$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';

    $content ='<section class="content-header">
                   
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    
					
					
					
					
					<div class="row">
                        
			
		    
            ';
	    
	    
$sql_box_office = mysql_query("SELECT `gx_vod_movies`.*, COUNT( `gx_vod_log_view_movie`.`id_movie` ) AS total
				FROM `gx_vod_log_view_movie` , `gx_vod_movies`
				WHERE `gx_vod_log_view_movie`.`id_movie` = `gx_vod_movies`.`id_movies`
				AND `gx_vod_movies`.`level` = '0'
				AND `gx_vod_log_view_movie`.`type` = 'hd'
				GROUP BY `gx_vod_log_view_movie`.`id_movie`
				HAVING COUNT( `gx_vod_log_view_movie`.`id_movie` ) >1
				ORDER BY COUNT( `gx_vod_log_view_movie`.`id_movie` ) DESC
				LIMIT 0 , 56;", $conn);

	   $content .='<ul class="list_movies">';
            while ($row_box_office = mysql_fetch_array($sql_box_office)){
                $hd = '';
                $hd = '';
                $movie3d = '';
                
                if($row_box_office["url_hd"]!= "" AND $row_box_office["price_hd"]!= ""){
                    $hd = '<img border="0" src="'.URL_movies.'images/hd.png" alt="hd"  style="border:none;vertical-align:top;" />';
                }
                if($row_box_office["url_sd"]!= "" AND $row_box_office["price_sd"]!= ""){
                    $sd = '<img border="0" src="'.URL_movies.'images/sd.png" alt="sd"  style="border:none;vertical-align:top;" />';
                }
                if($row_box_office["url_3d"]!= "" AND $row_box_office["price_3d"]!= ""){
                    $movie3d = '<img border="0" src="'.URL_movies.'images/3d.png" alt="3d" style="border:none;vertical-align:top;" />';
                }
                $content .='<li class="highlightit">
                        
			<table style="margin-left: 6px;">
			<tr>
			<td > '.$hd.'  '.$sd.'  '.$movie3d.'</td>
			</tr>
			</table>
			<a href="detail_movie.php?id_movies='.$row_box_office["id_movies"].'" >
                            <img width="150" height="205" src="https://192.168.1.99/vod/'.$row_box_office["thumb"].'" alt="'.$row_box_office["title"].' " />
                        </a>
			<font class="small_title">'.$row_box_office["title"].'</font>
			</li>';
}

$content .='</ul>';
$plugins = '
	<style>
	ul.list_movies {
        margin: 0;
        padding: 0;
        list-style-type: none;
        font-size: 100%;
        cursor: default;
        text-align: center;
        /* width: 981px; */
        }
        ul.list_movies li {
        margin: 0;
        padding: 0;
        list-style-type: none;
        font-size: 100%;
        height: 280px;
        cursor: pointer;
        width: 160px;
        text-align: center;
        margin-left: 10px;
        float: left;
        }
        
	
	</style>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    ';

    $title	= 'List Movies';
    $submenu	= "vod_paket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"yellow");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>