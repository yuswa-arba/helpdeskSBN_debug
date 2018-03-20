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
                    <h1>
                        My Packages
                        <small>Movies On Demand</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    
					
					
					
					
					<div class="row">
                        <div class="col-md-4">
                            <!-- Default box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3  align="center">Daily</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><strong><h4>Rp. 15.000 </strong></h4></div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">Activate = 1 day</div></td>
  </tr>
  <tr>
    <td><div align="center">Limit View movies = 3 Movies</div></td>
  </tr>
  <tr>
    <td><div align="center">View movies / day = 3 Movies</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center"><button class="btn btn-primary btn-sm disabled">Active</button></div></td>
  </tr>
</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <!-- Primary box -->
                            <div class="box box-solid box-success">
                                <div class="box-header">
                                     <h3  align="center">Weekly</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><strong><h4>Rp. 60.000 </strong></h4></div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">Activate = 7 day</div></td>
  </tr>
  <tr>
    <td><div align="center">Limit View movies = 21 Movies</div></td>
  </tr>
  <tr>
    <td><div align="center">View movies / day = 3 Movies</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center"><button class="btn btn-success btn-sm">Change To This Package</button></div></td>
  </tr>
</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <!-- Info box -->
                            <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3  align="center">Monthly</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><strong><h4>Rp. 60.000 </strong></h4></div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">Activate = 30 day</div></td>
  </tr>
  <tr>
    <td><div align="center">Limit View movies = 90 Movies</div></td>
  </tr>
  <tr>
    <td><div align="center">View movies / day = 3 Movies</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center"><button class="btn btn-danger btn-sm">Change To This Package</button></div></td>
  </tr>
</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
		    <h4 class="page-header">
                        Popular Movies
                    </h4>
		    
            ';
	    
	    
$sql_box_office = mysql_query("SELECT `gx_vod_movies`.`id_movies` ,`gx_vod_movies`.`thumb` , `gx_vod_movies`.`title` , COUNT( `gx_vod_log_view_movie`.`id_movie` ) AS total
				FROM `gx_vod_log_view_movie` , `gx_vod_movies`
				WHERE `gx_vod_log_view_movie`.`id_movie` = `gx_vod_movies`.`id_movies`
				AND `gx_vod_movies`.`level` = '0'
				AND `gx_vod_log_view_movie`.`type` = 'hd'
				GROUP BY `gx_vod_log_view_movie`.`id_movie`
				HAVING COUNT( `gx_vod_log_view_movie`.`id_movie` ) >1
				ORDER BY COUNT( `gx_vod_log_view_movie`.`id_movie` ) DESC
				LIMIT 0 , 5;", $conn);

	    $content .='
	    <ul class="list_movies">';
	
	while ($movie = mysql_fetch_array($sql_box_office)){
			$content .='<li><a target="_blank" href="http://192.168.1.99/webtv/detail_movie.php?id_movies='.$movie["id_movies"].'" title="'.$movie["title"].'">
			<img width="150" height="240" alt="'.$movie["title"].'" src="http://192.168.1.99/vod/'.$movie["thumb"].'" /></a></li>';
        }
	$content .='
	</ul>
	    ';
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
	width: 19%;
	text-align: center;
	margin-right: 10px;
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

    $title	= 'Paket VOD';
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