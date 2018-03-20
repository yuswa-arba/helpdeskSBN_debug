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
include ("config/home/template_v1.php");

//echo "index coy";
global $conn;

redirectToHTTPS();

$content ='';

//was there a reCAPTCHA response?
if (isset($_POST['username']) && isset($_POST['password'])) { // Check if submit button has been pressed.#fdf1f1

    /** CHECK COOKIES **/
    

    $_POST = protection($_POST); // Protect the $_POST variable.
    $_GET = protection($_GET); // Protect the $_GET variable.

    if(empty($_POST['username']) || empty($_POST['password'])) // Check if the form fields are empty or not.
    { 
	echo '<script language="JavaScript">
	  alert("Login failed. Check your username and/or password.");
	  window.location.href ="index.php";			  
	</script>'; // If there empty show error message.
    } else {
	//if($securimage->check($_POST['captcha_code']) == true) {
	//if(chk_crypt($_POST['captcha_code'])) {
	$chkuser = mysql_query("SELECT * FROM `gxLogin` WHERE `username` = '".$_POST['username']."'
			       AND `password` = '".md5($_POST['password'])."'
			       AND `level` = '0' LIMIT 0, 1;", $conn );
	// Check if the username and password are correct.
	if(mysql_num_rows($chkuser))
	{ // Check if they are correct
	    
	    $vcu = mysql_fetch_array($chkuser);
	    // Get the information
	    
	    $results = mysql_query("INSERT into `gxSessions` (`sess_id`, `id_user`, `expired_session`, `logged`, `ip`, `waktu`)
			       VALUES ('".md5("GX".$vcu['id_employee'].date("Y-m-dH:i:s"))."', '".$vcu['id_user']."', DATE_ADD(NOW(), INTERVAL 1 HOUR), '0',
			       '".$_SERVER['REMOTE_ADDR']."', NOW()) ", $conn);
	    //setcookie('GXSOFTWARE', md5("GX".date("Y-m-dH:i")), time()+3600, "/", "localhost");
	    
	    if($results)
	    {
		if(empty($_GET['r']))
		{
		    // Insert the session id and user id into the sessions table to create the login.
		    $sql = mysql_query("UPDATE `gxLogin` SET `user_active` = 'yes',
				       `user_ip_lastvisit` = '".$_SERVER['REMOTE_ADDR']."'
					WHERE `id_user` = '".$vcu['id_user']."' ", $conn);
		    setcookie('GXSOFTWARE', md5("GX".$vcu['id_employee'].date("Y-m-dH:i:s")), time()+(3600*4));
		    enableLog($vcu['customer_number'], $_POST['username'], "","Login Success");
		    
		    header("Location: home.php");
		} else {
		    header("Location: ".$_GET['r']);
		}
	    } else { // If couldnt submit into sessions table then show error message
		enableLog("",$_POST['username'], "","Login Error (Unknown Error result).");
		echo '<script language="JavaScript">
			alert("Unknown Error result.");
			window.location.href ="index.php";
		      </script>';
	    }
	} else{
	    enableLog("",$_POST['username'], "","Login Error (Incorrect Username Or Password).");
	    echo '<script language="JavaScript">
		alert("Incorrect Username Or Password.");
		window.location.href ="index.php";
	      </script>';
	}
    }

}



$content .='<!-- Showcase
    ================ -->
    <div id="wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <h1 class="animated slideInDown" style="color:#000;">GlobalXtreme Customer Panel</h1>
            <div class="list">
              <ul>
                <li class="animated slideInLeft first"><span><i class="fa fa fa-laptop"></i> Internet FO</span></li>
                <li class="animated slideInLeft second"><span><i class="fa fa-phone"></i> VOIP</span></li>
                <li class="animated slideInLeft third"><span><i class="fa fa-film"></i> VOD</span></li>
              </ul>
            </div>
          </div>
          <!--<div class="col-md-6 hidden-sm hidden-xs">
            <div class="showcase">
              <img src="img/home/iMac.png" alt="..." class="iMac animated fadeInDown">
              <img src="img/home/iPad.png" alt="..." class="iPad animated fadeInLeft">
              <img src="img/home/iPhone.png" alt="..." class="iPhone animated fadeInRight">
            </div>
          </div>-->
        </div>
      </div>
    </div>
    <div class="container">
      <!-- Services
        ================ -->
      <div class="row">
        <div class="col-md-12">
          <div class="services">
            <ul>
                <li>
                  <i class="fa fa-laptop fa-3x"></i>
                  <p>Internet<br /><a href="#">Details...</a></p>
                </li>
                <li>
                  <i class="fa fa-phone fa-3x"></i>
                  <p>VOIP<br /><a href="#">Details...</a></p>
                </li>
                <li>
                  <i class="fa fa-film fa-3x"></i>
                  <p>VOD<br /><a href="#">Details...</a></p>
                </li>
            </ul>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Welcome message
            ================= -->
        <div class="col-md-8">
        <div class="block-header">
          <h2>
            <span class="title">GlobalXtreme Customer Panel</span><span class="decoration"></span><span class="decoration"></span><span class="decoration"></span>
          </h2>
        </div>
          <img src="img/home/about.jpg" class="img-about img-responsive" alt="About">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Nullam id ipsum varius, tincidunt odio nec, placerat enim. 
            Sed sit amet auctor augue, nec dignissim ligula. 
            Nullam euismod quis odio eu commodo. Duis vitae dignissim eros.
            <br /><br />
            Nunc in neque nec arcu vulputate ullamcorper. Ut id orci ac arcu consectetur fringilla. 
            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. 
            Duis hendrerit enim id arcu lacinia, id commodo ante semper. 
            Sed vel ante nec nisi vestibulum congue. Pellentesque non lacus in tortor rutrum tristique. 
          </p>
          <div class="info-board info-board-blue">
            <h4>Important info</h4>
            <p>Nunc in neque nec arcu vulputate ullamcorper. Ut id orci ac arcu consectetur fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
          </div>
        </div>
        <!-- Last updated
            ================== -->
        <div class="col-md-4">
        <div class="block-header">
          <h2>
            <span class="title">Last Updates</span><span class="decoration"></span><span class="decoration"></span><span class="decoration"></span>
          </h2>
        </div>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#blog" data-toggle="tab">Internet</a></li>
          <li><a href="#comments" data-toggle="tab">VOIP</a></li>
          <li><a href="#events" data-toggle="tab">VOD</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="blog">
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="img/blog-1.jpg" alt="Blog Message">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="#">Story title</a></h4>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius, tincidunt odio nec, placerat enim.
              </div>
            </div>
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="img/blog-2.jpg" alt="Blog Message">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="#">Story title</a></h4>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius, tincidunt odio nec, placerat enim.
              </div>
            </div>
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="img/blog-3.jpg" alt="Blog Message">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="#">Story title</a></h4>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius, tincidunt odio nec, placerat enim.
              </div>
            </div>
            <a href="#" class="read-more">Read more stories...</a>
          </div>
          <div class="tab-pane" id="comments">
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="img/face1.jpg" alt="Blog Message">
              </a>
              <div class="media-body">
                <a href="#">Alex Smith</a> <span class="text-muted">20 minutes ago</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius...</p>
              </div>
            </div>
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="img/face2.jpg" alt="Blog Message">
              </a>
              <div class="media-body">
                <a href="#">Dan Smith</a> <span class="text-muted">1 hour ago</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius...</p>
              </div>
            </div>
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="img/face3.jpg" alt="Blog Message">
              </a>
              <div class="media-body">
                <a href="#">David Smith</a> <span class="text-muted">11/10/2013</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id ipsum varius...</p>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="events">
            <h5>Moblie Web+DevCon San Francisco 2014 <small>January 28, 2014</small></h5>
            <p class="text-muted"><i class="fa fa-map-marker"></i> Kuala Lumpur, Malaysia</p>
            <hr>
            <h5>2013 The 2nd International Conference on Information and Intelligent Computing(ICIIC 2013) <small>December 29, 2013</small></h5>
            <p class="text-muted"><i class="fa fa-map-marker"></i> San Francisco, California, United States</p>
            <hr>
            <h5>International Conference on Cloud Computing and eGovernances 2014 <small>November 20, 2013</small></h5>
            <p class="text-muted"><i class="fa fa-map-marker"></i> Saigon, Ho Chi Minh, Vietnam</p>
          </div>
        </div>
        </div>
      </div>
      <!-- ===== Paket ===== -->';


$sql_paket_data = mysql_query("SELECT * FROM `gx_paket2` WHERE `id_type` = '2' AND `level` = '0' LIMIT 0,4;", $conn);
$sql_paket_voip = mysql_query("SELECT * FROM `gx_paket2` WHERE `id_type` = '1' AND `level` = '0' LIMIT 0,4;", $conn);
$sql_paket_vod = mysql_query("SELECT * FROM `gx_paket2` WHERE `id_type` = '3' AND `level` = '0' LIMIT 0,4;", $conn);

$content .='
      <div class="row">
        <div class="col-md-12 block-header">
          <h2 class="green">
            <span class="title">Paket Internet</span><span class="decoration"></span><span class="decoration"></span><span class="decoration"></span>
          </h2>
        </div>
      </div>
      <div class="row">';
/*
while ($row_paket_data = mysql_fetch_array($sql_paket_data))
{
    $content .= '<div class="col-md-3 col-sm-6">
          <div class="thumbnail">
            <img src="" class="img-responsive" alt="Image">
            <div class="visit"><a href="#"><i class="fa fa-question-circle"></i> More details...</a></div>
            <div class="caption">
              <h4>'.$row_paket_data["nama_paket"].'</h4>
                
            </div>
          </div>
        </div>';
}*/
$content .='
      </div>
      
      <div class="row">
        <div class="col-md-12 block-header">
          <h2 class="red">
            <span class="title">Paket VOIP</span><span class="decoration"></span><span class="decoration"></span><span class="decoration"></span>
          </h2>
        </div>
      </div>
      <div class="row">';
/*
while ($row_paket_voip = mysql_fetch_array($sql_paket_voip))
{
    $content .= '<div class="col-md-3 col-sm-6">
          <div class="thumbnail">
            <img src="" class="img-responsive" alt="Image">
            <div class="visit"><a href="#"><i class="fa fa-question-circle"></i> More details...</a></div>
            <div class="caption">
              <h4>'.$row_paket_voip["nama_paket"].'</h4>
                
            </div>
          </div>
        </div>';
}*/
$content .='
      </div>
      
      <div class="row">
        <div class="col-md-12 block-header">
          <h2 class="yellow">
            <span class="title">Paket VOD</span><span class="decoration"></span><span class="decoration"></span><span class="decoration"></span>
          </h2>
        </div>
      </div>
      <div class="row">';
/*
while ($row_paket_vod = mysql_fetch_array($sql_paket_vod))
{
    $content .= '<div class="col-md-3 col-sm-6">
          <div class="thumbnail">
            <img src="" class="img-responsive" alt="Image">
            <div class="visit"><a href="#"><i class="fa fa-question-circle"></i> More details...</a></div>
            <div class="caption">
              <h4>'.$row_paket_vod["nama_paket"].'</h4>
                
            </div>
          </div>
        </div>';
}*/

$content .='
      </div>
    </div>';
    
    $title	= 'GlobalXtreme Customer Panel';
    $submenu	= "home";
    $plugins	= '';
    $user	= '';
    $group	= '';
    $template	= home_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
