<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */


function home_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group=""){
   
    $user_explode = explode(' ', $user);
    $sidebar ='';
    $title = ($title != "") ? "Panel Customer (beta) - $title" : "Panel Customer (beta)";
    
    if($loggedin = logged_in())
    {
        $user	= ucfirst($loggedin["username"]);
        $group	= $loggedin['group'];
    }else{
        $user	= '';
        $group	= '';
    }
    
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="GlobalXtreme Customer Panel">
        <meta name="author" content="GlobalXtreme Customer Panel">
        <link rel="shortcut icon" href="">
        
        <title>'.$title.'</title>

    

    <!-- Bootstrap core CSS -->
    <link href="'.URL.'css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="'.URL.'css/home/animate.css" />
    <link rel="stylesheet" type="text/css" href="'.URL.'css/home/elements.css" />
    <link rel="stylesheet" type="text/css" href="'.URL.'css/home/custom.css" />
    <link href="'.URL.'css/font-awesome.min.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="'.URL.'index">GlobalXtreme</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li'.(($sub_menu=="home") ? ' class="active"' : '').'>
              <a href="'.URL.'index.php" class="">Home</a>
                
            </li>
	    <li'.(($sub_menu=="home_paket") ? ' class="active"' : '').'>
              <a href="'.URL.'home_paket.php" class="">Paket</a>
                
            </li>
	    <li'.(($sub_menu=="home_marketing") ? ' class="active"' : '').'>
              <a href="'.URL.'home_marketing.php" class="">Marketing</a>
                
            </li>
	    <li'.(($sub_menu=="home_news") ? ' class="active"' : '').'>
              <a href="'.URL.'home_news.php" class="">News</a>
                
            </li>
	    <li'.(($sub_menu=="home_contact") ? ' class="active"' : '').'>
              <a href="'.URL.'home_contact.php" class="">Contact</a>
                
            </li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            ';

if($loggedin = logged_in())
{
    $template .='<li id="profile-menu" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="account">
                  <div class="avatar"><img src="'.URL.'img/avatar.png" class="avatar" alt="User Image"></div>
                  <p><b>'.$user.'</b></p>
                  <p><a href="'.URL.'home.php" target="_blank">Manage Billing</a> | <a href="javascript: logout();">Sign out</a></p>
                  <div class="clearfix"></div>
                </li>
              </ul>
            </li>';
}else{                  
    $template .='<!-- Sign in & Sign up -->
            <li id="profile-menu" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="account">
                    <form action="'.URL.'index" method="post">
			<div class="body bg-gray">
			    <div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="User ID"/>
			    </div>
			    <div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password"/>
			    </div>          
			    <div class="form-group">
				<input type="checkbox" name="remember_me"/> Remember me
			    </div>
			</div>
			<div class="footer">                                                               
			    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
			    
			    <p><a href="'.URL.'iforgot">I forgot my password</a></p>
			    
			    <!--<a href="register.html" class="text-center">Register a new membership</a>-->
			</div>
		    </form>
                <div class="clearfix"></div>
                </li>
              </ul>
            </li>';
                    
}

$template .='
          </ul>
        </div>
      </div>
    </div>
    
  <div class="wrapper">    
    
        '.$content.'
    
  </div>
    
<!-- Foooter
================== -->
  <footer>
    <div class="container">
      <div class="row">
        <!-- Contact Us 
        =================  -->
        <div class="col-sm-4">
          <div class="headline"><h3>Contact us</h3></div>
          <div class="content">
	    <h4>GlobalXtreme Office</h4>
            <p>
            Jl. Raya Kerobokan 388x Br. Semer<br>
	    Kuta, Bali (80361) Indonesia<br />
            telp.(0361) 736811<br />
	    fax. (0361) 736833<br />
	    SMS Gateway 085 637 329 48<br />
	    Email : <a href="#">info@globalxtreme.net</a>            
            </p>
          </div>
        </div>
        <!-- Social icons 
        ===================== -->
        <div class="col-sm-4">
          <div class="headline"><h3>Go Social</h3></div>
          <div class="content social">
            <p>Stay in touch with us:</p>
            <ul>
                <li><a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-youtube"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-github"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-vk"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- Subscribe 
        =============== -->
        <div class="col-sm-4">
          <div class="headline"><h3>Newsletter</h3></div>
          <div class="content">
            <p>Enter your e-mail below to subscribe to our free newsletter.<br />We promise not to bother you often!</p>
            <form class="form" role="form">
              <div class="row">
                <div class="col-sm-8">
                  <div class="input-group">
                    <label class="sr-only" for="subscribe-email">Email address</label>
                    <input type="email" class="form-control" id="subscribe-email" placeholder="Enter email">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default">OK</button>
                    </span>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Legal 
  ============= -->
  <div class="legal">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <p>&copy; <a href="globalxtreme.net" target="_blank">GlobalXtreme</a> 2014. <a href="">Privacy Policy</a> | <a href="">Terms of Service</a></p>
        </div>
      </div>
    </div>
  </div>
<a id="StickyChatWithUs" style="width: 163px; height: 87px;"  href="https://globalxtreme.net/bali/chat/client.php?locale=en" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf(\'opera\') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open(&#039;https://globalxtreme.net/bali/chat/client.php?locale=en&amp;url=&#039;+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), \'mibew\', \'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1\');this.newWindow.focus();this.newWindow.opener=window;return false;">
    <img src="https://globalxtreme.net/bali/chat/b.php?i=mibew&amp;lang=en" border="0" width="163" height="87" alt="" class="TransparentImages" style="bottom: 0; right: 0;">
    <span id="StickyChatWithUsText" style="left: 85px; top: 30px;">Chat With Us</span>
</a>

<style type="text/css">
#StickyChatWithUs {
position: fixed;
bottom: 0;
right: 0;
width: 150px;
height: 31px;
color: #FFF;
font-size: 13px;
font-weight: bold;
line-height: 31px;
text-align: justify;
text-decoration: none;
cursor: pointer;
}
</style>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/home/custom.js"></script>
    <script src="js/home/scrolltopcontrol.js"></script><!-- Scroll to top javascript -->

	'.$plugins.'

<script language="javascript">
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "logout.php";
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>
</body>
</html>';



return $template;

}