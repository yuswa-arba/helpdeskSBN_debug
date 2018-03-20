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

redirectToHTTPS();
global $conn;


$content ='<div class="section-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="animated slideInLeft"><span>Verification Code</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
		<!-- Forgot Password form -->
        <form action="" method="post" name="form_newpass" id="form_newpass"  method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="col-sm-5">
	    <!-- Iforgot -->
          <h3 class="hl top-zero">Verification Code.</h3>
          <hr>
          <h5 class="hl top-zero">SMS Code : </h5>
			<input type="text" class="form-control" id="code_sms" name="code_sms" value="" maxlength="20"><br>
          
          <span class="input-group-btn">
            <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
          </span>
          <hr>
        </div>
        </form>
        <!-- Right column -->
        
      </div>
    </div>';
    
$submit = isset($_POST["submit"]) ? $_POST["submit"] : "";

	if($submit == "submit"){
	    $code_sms    = isset($_POST["code_sms"]) ? $_POST["code_sms"] : "";
	    
	    //echo "SELECT * FROM `gx_resetpassword` WHERE `userid` = '".$userid."' AND `custnumber` = '".$cust_number."' AND `token` = '".$token."' LIMIT 0,1;";
		$sql_resetpass = mysql_query("SELECT * FROM `gx_resetpassword` WHERE (`code_sms` = '".$code_sms."') AND `expired` >= NOW() LIMIT 0,1;", $conn);
		$row_resetpass = mysql_fetch_array($sql_resetpass);
		$count_resetpass = mysql_num_rows($sql_resetpass);

	//    $update    = mysql_query("UPDATE `gxLogin` SET `password`=MD5('".$newpass."'), `password_date`=NOW()
	//							 WHERE (`customer_number`='".$customer_number."' OR `username` = '".$userid."');", $conn) or die(mysql_error());
		if($count_resetpass == 1)
		{
			header("location: newpass.php?userid=".$row_resetpass["userid"]."&cust_number=".$row_resetpass["custnumber"]."&token=".$row_resetpass["token"]);
		}
		else
		{
			//send_passwordchanged($customer_number, $user_id, "Password Changed");
			echo "<script language='JavaScript'>
				alert('Code Expired.');
				 location.href = 'home.php';
				</script>";
		}
		
	}

    
    $title	= 'GlobalXtreme Customer Panel - Reset Password';
    $submenu	= "newpass";
    $plugins	= '';
    $user	= '';
    $group	= '';
    $template	= home_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
	