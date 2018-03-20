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
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail GPS");
     global $conn;

     $id_gps	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
     $sql_gps	= mysql_query("SELECT * FROM `gx_gps_device` WHERE `id_gps` = '$id_gps' LIMIT 0,1;", $conn);
     $row_gps 	= mysql_fetch_array($sql_gps);
     
     $sql_messagin = mysql_query("SELECT * FROM `MessageIn`
				 WHERE `MessageFrom` = '".$row_gps["no_sim"]."'
				 AND `isRead` = '0'
				 ORDER BY `ReceiveTime` DESC LIMIT 0,1;", $conn);
     $row_messagein  = mysql_fetch_array($sql_messagin);
     
     $gps = parsingTexttoGPS($row_messagein["MessageText"]);
     //print_r($gps);
     
if(isset($_POST["search"]))
{
    $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : date("Y-m-d");
    $tanggal_to  = isset($_POST['tanggal']) ? $_POST['tanggal'] : date("Y-m-d");
    $jam  = isset($_POST['tanggal']) ? $_POST['tanggal'] : date("H:i:s");
    $jam_to  = isset($_POST['tanggal']) ? $_POST['tanggal'] : date("H:i:s");
    
    $title_gps = "History GPS tanggal";
    
    $sql_messagin2 = mysql_query("SELECT * FROM `MessageIn`
				 WHERE `MessageFrom` = '".$row_gps["no_sim"]."'
				 AND `isRead` = '0'
				 AND `ReceiveTime` >= '".$tanggal." ".$jam."'
				 AND `ReceiveTime` <= '".$tanggal_to." ".$jam_to."'
				 ORDER BY `ReceiveTime` DESC;", $conn);

}else
{
     $sql_messagin2 = mysql_query("SELECT * FROM `MessageIn`
				 WHERE `MessageFrom` = '".$row_gps["no_sim"]."'
				 AND `isRead` = '0'
				 AND `ReceiveTime` LIKE '%".date("Y-m-d H")."%'
				 ORDER BY `ReceiveTime` DESC;", $conn);
     $title_gps = "History GPS Hari ini";

}
     
     $content ='
 
	       <!-- Main content -->
	       <section class="content">
		    <div class="row">
			 <div class="col-xs-12">
			     '.detail_gps($id_gps).'
			 </div>
		     </div>
		    <div class="row">
			 <div class="col-xs-6">
			     '.detail_pegawai($row_gps["id_employee"]).'
			 </div>
			 <div class="col-xs-6">
			     '.detail_kendaraan($row_gps["id_kendaraan"]).'
			 </div>
		    </div>
		    <div class="row">
			 <div class="col-xs-12">
			      <div class="box">
				   <div class="box-header">
				       <h2 class="box-title">Search History GPS</h2>
				   </div>
				    
				   <div class="box-body">
					<form role="form" method="POST" action="">
					     <div class="box-body">
						 
						 <div class="row">
						     <div class="col-xs-9">
							 Tanggal: <input type="text" readonly="" name="tanggal" id="datepicker" class="hasDatepicker"> Jam :<input type="text" value="" name="jam"><br>
							 Sampai Tanggal: <input type="text" readonly="" name="tanggal_to" id="datepicker2" class="hasDatepicker"> Jam: <input type="text" value="" name="jam_to">
						     </div>
						     
						 </div>
					     </div><!-- /.box-body -->
					     <div class="box-footer">
						 <button type="submit" name="search" class="btn btn-primary">Search</button>
					     </div>
				     </form>
				   </div>
                            </div>
			     '.detail_tracking($id_gps, $title_gps).'
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins = '
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
	       $(\'#complaint_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
	       $(\'#email_history\').dataTable({
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
	       });
            });
        </script>
	
     <!--Google MAPS-->
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="'.URL.'/config/gmaps/gmaps.js"></script>
        <link href="'.URL.'css/gmaps/examples.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript">
      var map;
      $(document).ready(function(){
        map = new GMaps({
          el: \'#map\',
          lat: '.$gps["lat"].',
          lng: '.$gps["long"].',
          click: function(e){
            console.log(e);
          }
        });
	
	';

     while($row_messagein2  = mysql_fetch_array($sql_messagin2))
     {
	  $gps2 = parsingTexttoGPS($row_messagein2["MessageText"]);
	  //print_r($gps2);
	  if($gps2["lat"] != "")
	  {
	       $plugins .='map.addMarker({
	       lat: '.$gps2["lat"].',
	       lng: '.$gps2["long"].',
	       title: \''.$row_gps["nama_gps"].'\',
	       infoWindow: {
	       content: \'<p><h5>Detail '.$row_gps["nama_gps"].'</h5><br>\' +
	       \'Imei: '.$row_gps["imei"].'<br>Nomer SIM: '.$row_gps["no_sim"].'<br><br>Lat: '.$gps["lat"].'\' +
	       \'<br>Long: '.$gps["long"].'<br>Course: '.$gps["course"].'<br>Speed: '.$gps["speed"].'<br>'.$gps["datetime"].'</p>\'
	       }
	       });
	       
	       ';
	  }
  }
        
        $plugins .='
      });
    </script>
    
<script>
     $(function() {
	 $("#datepicker").datepicker({format: "yyyy-mm-dd"});
     });
</script>

    ';
/*path = [[-12.044012922866312, -77.02470665341184],
                [-12.05449279282314, -77.03024273281858],
                [-12.055122327623378, -77.03039293652341],
                [-12.075917129727586, -77.02764635449216],
                [-12.07635776902266, -77.02792530422971],
                [-12.076819390363665, -77.02893381481931],
                [-12.088527520066453, -77.0241058385925],
                [-12.090814532191756, -77.02271108990476]];
  
        map.addMarker({
          lat: -12.044012922866312,
          lng: -77.02470665341184,
          title: \'Start\',
          infoWindow: {
            content: \'<p>HTML Content</p>\'
          }
        });
        map.addMarker({
          lat: -12.090814532191756,
          lng: -77.02271108990476,
          title: \'Finish\',
          infoWindow: {
            content: \'<p>HTML Content</p>\'
          }
        });
        //polylines
        map.drawPolyline({
          path: path,
          strokeColor: \'#dd0000\',
          strokeOpacity: 0.6,
          strokeWeight: 6
        });
        */
    $title	= 'Detail GPS';
    $submenu	= "master_gps";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>