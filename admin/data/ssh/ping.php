<?php
function pingAddress($ip) {
    $pingresult = exec("/bin/ping -c 3 $ip", $outcome, $status);
    if (0 == $status) {
        $status = "alive";
    } else {
        $status = "dead";
    }
    //echo "The IP address, $ip, is  ".$status;
    return $status;
}

//pingAddress("127.0.0.1");
$status = pingAddress('192.168.5.2');

echo $status;

?>