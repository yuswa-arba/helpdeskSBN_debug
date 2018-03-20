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

$userid = isset($_GET["userid"]) ? $_GET["userid"] : "";
$cust_number = isset($_GET["cust_number"]) ? $_GET["cust_number"] : "";
$token = isset($_GET["token"]) ? $_GET["token"] : "";

if(($userid != "") OR ($cust_number != "") OR ($token !=""))
{
	
//echo "SELECT * FROM `gx_resetpassword` WHERE `userid` = '".$userid."' AND `custnumber` = '".$cust_number."' AND `token` = '".$token."' LIMIT 0,1;";
$sql_resetpass = mysql_query("SELECT * FROM `gx_resetpassword` WHERE (`userid` = '".$userid."' OR `custnumber` = '".$cust_number."') AND `token` = '".$token."' LIMIT 0,1;", $conn);
$row_resetpass = mysql_fetch_array($sql_resetpass);


$content ='<div class="section-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="animated slideInLeft"><span>Reset Password</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">';
	  
	if($row_resetpass["expired"] >= date("Y-m-d H:i"))
	{
		$content .='<!-- Forgot Password form -->
        <form action="" method="post" name="form_newpass" id="form_newpass"  method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="col-sm-5">
	    <!-- Iforgot -->
          <h3 class="hl top-zero">Reset Password.</h3>
          <hr>
          <h5 class="hl top-zero">Customer Number : <b>'.$cust_number.'</b></h5>
			<input type="hidden" class="form-control" id="customer_number" name="customer_number" value="'.$cust_number.'"><br>
          <h5 class="hl top-zero">User ID : <b>'.$userid.'</b></h5>
			<input type="hidden" class="form-control" id="userid" name="userid" value="'.$userid.'"><br>
          <h5 class="hl top-zero">New Password</h5>
			<input type="password" class="form-control" id="newpass" name="newpass" maxlength="30" required value=""><br>
		<h5 class="hl top-zero">Retype New Password</h5>
			<input type="password" class="form-control" id="renewpass" name="renewpass" maxlength="30" required value=""><br>
          <span class="input-group-btn">
            <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
          </span>
          <hr>
        </div>
        </form>';
	}
	else	  
	{
	  $content .='<h4>Sorry, your link has expired time.</h4>';
	}
	  
$content .='
        <!-- Right column -->
        
      </div>
    </div>';
    
$submit = isset($_POST["submit"]) ? $_POST["submit"] : "";

	if($submit == "submit"){
	    $customer_number    = isset($_POST["customer_number"]) ? $_POST["customer_number"] : "";
	    $userid         	= isset($_POST["userid"]) ? $_POST["userid"] : "";
        $newpass            = isset($_POST["newpass"]) ? $_POST["newpass"] : "";
		
	    
	    $update    = mysql_query("UPDATE `gxLogin` SET `password`=MD5('".$newpass."'), `password_date`=NOW()
								 WHERE (`customer_number`='".$customer_number."' OR `username` = '".$userid."');", $conn) or die(mysql_error());
		
		//send_passwordchanged($customer_number, $user_id, "Password Changed");
	    echo "<script language='JavaScript'>
			alert('Success.');
			 location.href = 'home.php';
            </script>";
	}

    
    $title	= 'GlobalXtreme Customer Panel - Reset Password';
    $submenu	= "newpass";
    $plugins	= '';
    $user	= '';
    $group	= '';
    $template	= home_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
	
}
else
{
	header("location:home.php");
}
