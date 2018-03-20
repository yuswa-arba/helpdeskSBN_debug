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
include ("../config/configuration.php");

if($loggedin = logged_in()){ // Check if they are logged in 
    header( 'Location: home.php' ) ;
} else { // If not logged in 



//was there a reCAPTCHA response?
if (isset($_POST['username']) && isset($_POST['password'])) { // Check if submit button has been pressed.#fdf1f1

	/** CHECK COOKIES **/
	echo check_phpsessid();

	$_POST = protection($_POST); // Protect the $_POST variable.
	$_GET = protection($_GET); // Protect the $_GET variable.

		if(empty($_POST['username']) || empty($_POST['password'])) { // Check if the form fields are empty or not.
			echo '<script language="JavaScript">
			  alert("Login failed. Check your username and/or password.");
			  window.location.href ="index.php";			  
			</script>'; // If there empty show error message.
		} else {
			
			//if($securimage->check($_POST['captcha_code']) == true) {
			//if(chk_crypt($_POST['captcha_code'])) {
			$chkuser = mysql_query("SELECT * FROM `users` WHERE `username` = '".$_POST['username']."'
					       AND `password` = '".md5($_POST['password'])."'

					       AND `level` = '0' LIMIT 0, 1;" ); // Check if the username and password are correct.
				if(mysql_num_rows($chkuser)) { // Check if they are correct
					$vcu = mysql_fetch_array($chkuser); // Get the information
                
                    
					$jam = date("H");
					$waktu = date("Y-m-d ").($jam-1).date(":i:s");
					
					
					$results = mysql_query("INSERT into `sessions` (`sess_id`, `uid`, `logged`, `ip`, `waktu`) values ('".$_COOKIE['PHPSESSID']."', '".$vcu['id_user']."', '0', '".$_SERVER['REMOTE_ADDR']."', '$waktu') ");
					// Insert the session id and user id into the sessions table to create the login.
					
					$sql = mysql_query("UPDATE `users` SET `user_active` = 'yes', `user_ip_lastvisit` = '".$_SERVER['REMOTE_ADDR']."'  WHERE `id_user` = '".$vcu['id_user']."' ");
					
						if($results) {
							if($sql) { // If it submitted it then success.
								if(empty($_GET['r'])) {
									$_SESSION['user'] = $_POST['username']; 
					login_validate();
                                    
					header("Location: home.php");
								} else {
									header("Location: ".$_GET['r']);
								}
							} else { // If couldnt submit into sessions table then show error message
									echo '<script language="JavaScript">
									  alert("Unknown Error sql.");
									  window.location.href ="index.php";
									</script>';
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
			/*} else{
				    echo '<script language="JavaScript">
							alert("Code Your Entered incorrect.");
							window.location.href ="index.php";
							
						      </script>';
				}*/
		}
		
	
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="initial-scale=1.0, user-scalable=no" name="viewport">
    <title>GlobalXtreme Intranet</title>
    <link href="http://202.58.203.27/~helpdesk/new3/stylesheets/style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="http://202.58.203.27/~helpdesk/new3/stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="http://202.58.203.27/~helpdesk/new3/javascripts/application.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body>
    <div id="login_wrapper">
      <div class="well">
        <h1>Intranet login</h1>
      </div>
      <form action="login.php" method="post" name="formlogin" id="formlogin" enctype="multipart/form-data">

        <div class="table-container">
          <table class="table table-form">
            <tbody>
              <tr>
                <td>
                  <label>Username</label>
                </td>
                <td>
                  <input name="username" placeholder="Username" type="text">
                </td>
              </tr>
              <tr>
                <td>
                  <label>Password</label>
                </td>
                <td>
                  <input name="password" placeholder="Password" type="password">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="actions">
          <div class="button-well">
            
            <input data-icon="K" class="button button-primary" type="submit"  name="login" value="Login" />
          </div>
        </div>
      </form>
    </div>
    <a href="http://globalxtreme.net" id="Globalxtreme" target="_blank">GlobalXtreme</a>
  </body>
</html>
<?php
}
