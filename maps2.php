<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
    global $conn;
    
    $id_customer = isset($_GET["id"]) ? strip_tags($_GET["id"]) : "";
    $sql_profile = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$id_customer."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_profile = mysql_fetch_array($sql_profile);

$content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Maps Customer Number '.$id_customer.'</h3>
                                </div><!-- /.box-header -->
				
				
                            
    			
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
		
		<div id="mapDetail" style="width:100%;height: 300px;"></div>';
    
    $plugins = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.

function initialize() {
  var myLatlng = new google.maps.LatLng(-'.DMStoGPS($row_profile["cLati"]).','.DMStoGPS($row_profile["cLongi"]).');
  var mapOptions = {
    zoom: 12,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById(\'mapDetail\'), mapOptions);

  var contentString = \'<div id="content">\'+
      \'<div id="siteNotice">\'+
      \'</div>\'+
      \'<h3 id="firstHeading" class="firstHeading">Alamat</h3>\'+
      \'<div id="bodyContent">\'+
      \'<p>Detail Maps Customer Number '.$id_customer.' \'+
      \'</p>\'+
      \'</div>\'+
      \'</div>\';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: \'Uluru (Ayers Rock)\'
  });
  google.maps.event.addListener(marker, \'click\', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, \'load\', initialize);

    </script>';
    
    $title	= 'Maps';
    $submenu	= "customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= map_popup($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>