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
global $conn;

include ("config/configuration.php");
include ("config/home/template_v1.php");



redirectToHTTPS();

$content ='<div class="section-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="animated slideInLeft"><span>Forgot Password</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <!-- Forgot Password form -->
        <form action="" method="post" name="form_forgot" id="form_forgot">
            <div class="col-sm-5">
            <!-- Iforgot -->
              <h3 class="hl top-zero">Masukkan data anda.</h3>
              <hr>
              <h5 class="hl top-zero">Customer Number</h5>
              <input type="text" class="form-control" id="customernumber" name="customer_number" placeholder="Enter Customer Number"><br>
              <h5 class="hl top-zero">User ID</h5>
              <input type="text" class="form-control" id="userid" name="user_id" placeholder="Enter UserID"><br>
              <h5 class="hl top-zero">Sent To</h5>
              <select name="sentto" class="form-control">
                <option value="email">Email </option>
                <option value="phone">Phone </option>
              </select><br>
              <span class="input-group-btn">
                <button type="submit" name="sent" value="sentto" class="btn btn-default">Submit</button>
              </span>
              <hr>
            </div>
        </form>
        <!-- Right column -->
        
      </div>
    </div>';
   
$submit = isset($_POST["sent"]) ? $_POST["sent"] : "";

	if($submit == "sentto"){
	    $customer_number    = isset($_POST["customer_number"]) ? $_POST["customer_number"] : "";
	    $user_id            = isset($_POST["user_id"]) ? $_POST["user_id"] : "";
        $sentto             = isset($_POST["sentto"]) ? $_POST["sentto"] : "";
	    $time = date("Y-m-d H:i:s", strtotime ("+2 hour"));
        $token= MD5($time);
		
        if(($user_id == "") AND ($customer_number == "")){
                 echo "<script language='JavaScript'>
                alert('empty field!');
                window.history.go(-1);
                </script>";
            }else{
				$code_sms = generateRandomString(6);
                $insert   ="INSERT INTO `gx_resetpassword` (`id_resetpwd`, `userid`, `custnumber`, `token`, `sent_to`, `expired`, `code_sms`)
							VALUES ('', '".$user_id."', '".$customer_number."', MD5('$time'), '".$sentto."', '".$time."', '".$code_sms."')";
                
        mysql_query($insert, $conn) or die("<script language='JavaScript'>
				    alert('Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
		
        send_lupapassword($user_id, $customer_number, $token, $sentto, $code_sms);
		
		
		if($sentto == "email")
		{
			echo "<script language='JavaScript'>
				alert('success');
				location.href = 'home.php';
				</script>";
         
		}
		elseif($sentto == "phone")
		{
			echo "<script language='JavaScript'>
				alert('success');
				location.href = 'token.php';
				</script>";
		}
		    }
	    
    
	}

    
    $title	= 'GlobalXtreme Customer Panel';
    $submenu	= "forgot";
    $plugins	= '';
    $user	= '';
    $group	= '';
    $template	= home_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
