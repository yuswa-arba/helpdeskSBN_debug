<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/mbayartagihanglobal
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: 
 * Desc: 
 *
 */
function login_validate() {
    $timeout = 3600;
    $_SESSION["expires_by"] = time() + $timeout;
}

function login_check() {
    $exp_time = isset($_SESSION["expires_by"]) ? $_SESSION["expires_by"] : "";
    if (time() < $exp_time)    {
        login_validate();
        return true;
    }else{
        unset($_SESSION["expires_by"]);
        return false;
    }
} 