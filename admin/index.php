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
ob_start();
include ("../config/configuration_admin.php");

global $conn;

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in 
    header( 'Location: home.php' ) ;
} else { // If not logged in 



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
	$chkuser = mysql_query("SELECT * FROM `gxLogin_admin` WHERE `username` = '".$_POST['username']."'
			       AND `password` = '".md5($_POST['password'])."'
			       AND `level` = '0' LIMIT 0, 1;", $conn );
	// Check if the username and password are correct.
	if(mysql_num_rows($chkuser))
	{ // Check if they are correct
	    
	    $vcu = mysql_fetch_array($chkuser);
	    // Get the information
	    
	    $results = mysql_query("INSERT into `gxSessions_admin` (`sess_id`, `id_employee`, `expired_session`, `logged`, `ip`, `waktu`)
			       VALUES ('".md5("GX".$vcu['id_employee'].date("Y-m-dH:i:s"))."', '".$vcu['id_employee']."', DATE_ADD(NOW(), INTERVAL 1 HOUR), '0',
			       '".$_SERVER['REMOTE_ADDR']."', NOW())", $conn);
	    //setcookie('GXSOFTWARE', md5("GX".date("Y-m-dH:i")), time()+3600, "/", "localhost");
	    
	    if($results)
	    {
			if(empty($_GET['r']))
			{
				// Insert the session id and user id into the sessions table to create the login.
				$sql = mysql_query("UPDATE `gxLogin_admin` SET `user_active` = 'yes',
						`user_ip_lastvisit` = '".$_SERVER['REMOTE_ADDR']."'
						WHERE `id_employee` = '".$vcu['id_employee']."' ", $conn);
				setcookie('GXSOFTWARE', md5("GX".$vcu['id_employee'].date("Y-m-dH:i:s")), time()+(3600*24));
				
				header("Location: home.php");
			} else {
				header("Location: ".$_GET['r']);
			}
	    } else { // If couldnt submit into sessions table then show error message
		echo '<script language="JavaScript">
			alert("Unknown Error result.");
			window.location.href ="index.php";
		      </script>';
	    }
	} else{
	    echo '<script language="JavaScript">
		alert("Incorrect Username Or Password.");
		window.location.href ="index.php";
	      </script>';
	}
    }

}

?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" type="image/x-icon" href="/sbn/beta/img/favicon.ico" sizes="16x16" />
        <!-- bootstrap 3.0.2 -->
        <link href="/sbn/beta/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/sbn/beta/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/sbn/beta/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="/sbn/beta/js/html5shiv.js"></script>
          <script src="/sbn/beta/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><img alt="GX Panel Customer Logo" src="/sbn/beta/img/gx-1111000.png" style="width:35px;"> Administrator Login</div>
            <form action="" method="post">
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
                    
                    <p><a href="#">I forgot my password</a></p>
                    
                    <!--<a href="register.html" class="text-center">Register a new membership</a>-->
                </div>
            </form>

            <!--<div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="/sbn/beta/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/sbn/beta/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>
<?php
}
