<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_tv.php");
$conn_tv   = DB_TV();

if(!empty($_GET["SN_STB"])) {
    $result = mysqli_query($conn_tv, "SELECT COUNT(`boss`.`t_account_cms`.`CLIENTCODE`) FROM `boss`.`t_account_cms`
                           WHERE `boss`.`t_account_cms`.`CLIENTCODE` LIKE '".$_GET["SN_STB"]."%';");
    $row = mysqli_fetch_row($result);
    $user_count = $row[0];
    if($user_count>0)
    {
        echo "<p class='text-red'><b>SN Exist.<b></p>";
    }
    

}


if(!empty($_GET["MACADDRESS"])) {
    $result = mysqli_query($conn_tv, "SELECT COUNT(`boss`.`t_account_cms`.`MACADDRESS`) FROM `boss`.`t_account_cms`
                           WHERE `boss`.`t_account_cms`.`MACADDRESS` LIKE '".strip_tags($_GET["MACADDRESS"])."%';");
    $row = mysqli_fetch_row($result);
    $user_count = $row[0];
    if($user_count>0)
    {
        echo "<p class='text-red'><b>Mac Address Exist.</b></p>";
    }
    
}
