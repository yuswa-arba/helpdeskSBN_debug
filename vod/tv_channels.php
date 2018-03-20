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
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Channels Vod ");
    
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
                        <small>TV Channels</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    
					
					
					
					
					<div class="row">
                        <div class="col-md-4">
                            <!-- Default box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3  align="center">YOUTH IDR 100K/month</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><h4>I. KIDS</h4></div></td>
  </tr>
  <tr>
    <td><div align="center">1 Xtreme Kids</div></td>
  </tr>
    <tr>
    <td><div align="center">2 Animax</div></td>
  </tr>
    <tr>
    <td><div align="center">3 Nickoledeon</div></td>
  </tr>
  
 

  <tr>
    <td><div align="center"><h4>II. LIFESTYLE</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">4 Animal Planet</div></td>
  </tr>
    <tr>
    <td><div align="center">5 Fashion TV</div></td>
  </tr>
    <tr>
    <td><div align="center">6 TLC</div></td>
  </tr>
    <tr>
    <td><div align="center">7  Asian Food Channel</div></td>
  </tr>
  



  <tr>
    <td><div align="center"><h4>III. MOVIES</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">8 Cinemayo</div></td>
  </tr>
    <tr>
    <td><div align="center">9 Star Chinese Movie </div></td>
  </tr>
  

  <tr>
    <td><div align="center"><h4>IV. ENTERTAINMENT</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">10 KBS World </div></td>
  </tr>
    <tr>
    <td><div align="center">11 E! Channel</div></td>
  </tr>
    <tr>
    <td><div align="center">12 Waku Waku</div></td>
  </tr>
  


  <tr>
    <td><div align="center"><h4>V. SPORT</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">13 ESPN</div></td>
  </tr>
    <tr>
    <td><div align="center">14 Xtreme Sports</div></td>
  </tr>
   

  <tr>
    <td><div align="center"><h4>VI. MUSIC</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">15 MTV</div></td>
  </tr>
    <tr>
    <td><div align="center">16 MTV Asia</div></td>
  </tr>
    <tr>
    <td><div align="center">17 V Channel</div></td>
  </tr>
  


  <tr>
    <td><div align="center"><h4>VII. NEWS</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">18 CNN</div></td>
  </tr>
  
    <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
<tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><button class="btn btn-primary btn-sm" onclick="window.open(\'#\', \'_blank\');">SELECT</button></div></td>
  </tr>
</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <!-- Primary box -->
                            <div class="box box-solid box-success">
                                <div class="box-header">
                                     <h3  align="center">EXECUTIVE IDR 130K/month</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><div align="center"><h4>I. LIFESTYLE</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">1 .Fashion TV</div></td>
  </tr>
    <tr>
    <td><div align="center">2. Discovery Channel</div></td>
  </tr>
    <tr>
    <td><div align="center">3. Life Inspired</div></td>
  </tr>
    <tr>
    <td><div align="center">4. History</div></td>
  </tr>
    <tr>
    <td><div align="center">5. National Geography</div></td>
  </tr>
    <tr>
    <td><div align="center">6. Discovery Channel</div></td>
  </tr>






  <tr>
    <td><div align="center"><h4>II. MOVIES</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">7. Fox Action </div></td>
  </tr>
    <tr>
    <td><div align="center">8. HBO</div></td>
  </tr>
    <tr>
    <td><div align="center">9. Xtreme Movies</div></td>
  </tr>



  
  <tr>
    <td><div align="center"><h4>III. ENTERTAINMENT</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">10. Star World </div></td>
  </tr>
    <tr>
    <td><div align="center">11. Xtreme Channel</div></td>
  </tr>
    <tr>
    <td><div align="center">12. Da Vinci</div></td>
  </tr>
    <tr>
    <td><div align="center">13. E! Channel </div></td>
  </tr>

 
 
  
  <tr>
    <td><div align="center"><h4>IV. SPORT</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">14. ESPN News</div></td>
  </tr>
    <tr>
    <td><div align="center">15. Golf Channel </div></td>
  </tr>
    <tr>
    <td><div align="center">16. Xtreme Sports </div></td>
  </tr>
    <tr>
    <td><div align="center">17. ESPN  </div></td>
  </tr>
 


 
  <tr>
    <td><div align="center"><h4>V. MUSIC</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">18. MTV</div></td>
  </tr>
    <tr>
    <td><div align="center">19. MTV Asia</div></td>
  </tr>
    <tr>
    <td><div align="center">20. V Channel  </div></td>
  </tr>



  <tr>
    <td><div align="center"><h4>VI. NEWS</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">21. CNN</div></td>
  </tr>
    <tr>
    <td><div align="center">22. BBC</div></td>
  </tr>
    <tr>
    <td><div align="center">23. Bloomberg</div></td>
  </tr>
    <tr>
    <td><div align="center">24. Channel News Asia </div></td>
  </tr>
    <tr>
    <td><div align="center">25. Russia Today </div></td>
  </tr>




   <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center"><button class="btn btn-success btn-sm" onclick="window.open(\'#\', \'_blank\');">SELECT</button></div></td>
  </tr>
</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <!-- Info box -->
                            <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3  align="center">FAMILY IDR 150K/month</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><h4>I. KIDS</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">1. KidsCo</div></td>
  </tr>
    <tr>
    <td><div align="center">2. Baby TV </div></td>
  </tr>
    <tr>
    <td><div align="center">3. Cartoon Network </div></td>
  </tr>
    <tr>
    <td><div align="center">4. Disney Channel </div></td>
  </tr>
    <tr>
    <td><div align="center">5. Disney Kids </div></td>
  </tr>
    <tr>
    <td><div align="center">6. Nick Jr.</div></td>
  </tr>
    <tr>
    <td><div align="center">7. Cinemayo Kids </div></td>
  </tr>
 




 
  
  <tr>
    <td><div align="center"><h4>II. LIFESTYLE</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">8. Life inspired </div></td>
  </tr>
    <tr>
    <td><div align="center">9. TLC </div></td>
  </tr>
    <tr>
    <td><div align="center">10. Fashion TV </div></td>
  </tr>
    <tr>
    <td><div align="center">11. National Geography </div></td>
  </tr>
    <tr>
    <td><div align="center">12. Asian Food Channel </div></td>
  </tr>
    <tr>
    <td><div align="center">13. Animal Planet </div></td>
  </tr>
    <tr>
    <td><div align="center">14. History </div></td>
  </tr>
    <tr>
    <td><div align="center">15. Discovery Channel </div></td>
  </tr>







 
  <tr>
    <td><div align="center"><h4>III. MOVIES</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">16. HBO </div></td>
  </tr>
    <tr>
    <td><div align="center">17. Cinemayo  </div></td>
  </tr>
    <tr>
    <td><div align="center">18. Star Chinese Movie </div></td>
  </tr>



  <tr>
    <td><div align="center"><h4>IV. ENTERTAINMENT</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">19. Star World </div></td>
  </tr>
    <tr>
    <td><div align="center">20. E! Channel </div></td>
  </tr>
    <tr>
    <td><div align="center">21. KBS (korean tv) World </div></td>
  </tr>
    <tr>
    <td><div align="center">22. Waku - Waku </div></td>
  </tr>




  <tr>
    <td><div align="center"><h4>V. SPORT</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">23. ESPN News </div></td>
  </tr>
    <tr>
    <td><div align="center">24. Golf Channel </div></td>
  </tr>
    <tr>
    <td><div align="center">25. ESPN </div></td>
  </tr>



  <tr>
    <td><div align="center"><h4>VI. MUSIC</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">26. MTV Asia </div></td>
  </tr>
    <tr>
    <td><div align="center">27. V Channel </div></td>
  </tr>
    <tr>
    <td><div align="center">28. MTV   </div></td>
  </tr>



  <tr>
    <td><div align="center"><h4>VII. NEWS</h4></div></td>
  </tr>
    <tr>
    <td><div align="center">29. CNN </div></td>
  </tr>
    <tr>
    <td><div align="center">30. BBC  </div></td>
  </tr>
    <tr>
    <td><div align="center">31. FOX</div></td>
  </tr>
    <tr>
    <td><div align="center">32. Channel News Asia </div></td>
  </tr>
    <tr>
    <td><div align="center">33. Russia Today </div></td>
  </tr>
    <tr>
    <td><div align="center">34. Bloomberg </div></td>
  </tr>
    <tr>
    <td><div align="center">35. ABC News  </div></td>
  </tr>








  <tr>
    <td><div align="center">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="center"><button class="btn btn-danger btn-sm" onclick="window.open(\'#\', \'_blank\');">SELECT</button></div></td>
  </tr>

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