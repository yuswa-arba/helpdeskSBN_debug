<?php
include ("../../config/configuration_admin.php");
global $conn;
  
  if(isset($_REQUEST['username'])) 
  {
      $username     = strip_tags($_REQUEST['username']);
      
    $query_data = mysql_query("SELECT username FROM `gx_login_provider` WHERE username='".$username."';", $conn);
    $count      = mysql_num_rows($query_data);
      
   if($count>0)
   {
    echo "<span style='color:brown;'>Sorry username already taken !!!</span>";
   }
   else
   {
    echo "<span style='color:green;'>available</span>";
   }
  }
?>