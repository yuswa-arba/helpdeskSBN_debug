<?php
include ("../../../config/configuration_admin.php");
global $conn;
if(isset($_REQUEST['userid']))
{
    
    $userid             = isset($_REQUEST['userid']) ? mysql_real_escape_string(strip_tags(trim($_REQUEST['userid']))) : '';
    
    $query_customer 	= "SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$userid."';";
    $sql_customer	= mysql_query($query_customer, $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
    $total_customer	= mysql_num_rows($sql_customer);
    
    if($total_customer >= 1)
    {
        echo '<span class="text-red">userid sudah ada</span>';
    }
}
?>