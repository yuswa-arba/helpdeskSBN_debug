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
include ("../config/configuration_2016.php");

global $conn;

redirectToHTTPS();
if($loggedin = logged_inGlobal()){ // Check if they are logged in 
    header( 'Location: home_v2.php' ) ;
} else { // If not logged in 



//was there a reCAPTCHA response?
if (isset($_POST['username']) && isset($_POST['password'])) { // Check if submit button has been pressed.#fdf1f1

    /** CHECK COOKIES **/
    

    $_POST = protection($_POST); // Protect the $_POST variable.
    $_GET = protection($_GET); // Protect the $_GET variable.

    if(empty($_POST['username']) || empty($_POST['password'])) // Check if the form fields are empty or not.
    { 
	$error = '<script type="text/javascript">
        $.growl.warning({ message: "Username atau password anda salah" });
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
		    
		    header("Location: home_v2.php");
		} else {
		    header("Location: ".$_GET['r']);
		}
	    } else { // If couldnt submit into sessions table then show error message
		$error = '<script type="text/javascript">
        $.growl.warning({ message: "Username atau password anda salah" });
    </script>';
	    }
	} else{
		
	    $error = '<script type="text/javascript">
        $.growl.warning({ message: "Username atau password anda salah" });
    </script>';
	}
    }

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GlobalXtreme Helpdesk beta 2.0 | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/software/beta/assets/adminlte2/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/software/beta/assets/adminlte2/plugins/font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/software/beta/assets/adminlte2/plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/software/beta/assets/adminlte2/dist/css/AdminLTE.min.css">
    <!-- Growl style -->
    <link href="/software/beta/assets/adminlte2/plugins/jquery.growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css" />

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>GlobalXtreme</b>Helpdesk</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to Dashboard</p>
        <form method="post" action="" autocomplete="off">
          <div class="form-group has-feedback">
            <input type="text" maxlength="50" name="username" class="form-control" placeholder="Username" required="">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" maxlength="50" name="password" class="form-control" placeholder="Password" required="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="/software/beta/assets/adminlte2/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/software/beta/assets/adminlte2/bootstrap/js/bootstrap.min.js"></script>
    <!-- Jquery Growl -->
    <script src="/software/beta/assets/adminlte2/plugins/jquery.growl/javascripts/jquery.growl.js" type="text/javascript"></script>
	
	<?php
		if(isset($_POST["submit"]))
		{
			echo $error;
		}
	
	?>
	
<!-- iCheck -->
<script src="/software/beta/assets/adminlte2/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
  </body>
</html>
<?php
}
