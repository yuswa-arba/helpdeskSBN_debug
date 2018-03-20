<?php

use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Client;
use PEAR2\Net\RouterOS\Request;
use PEAR2\Net\RouterOS\Util; 
use PEAR2\Net\RouterOS\Response;

require_once '../../PEAR2_Net_RouterOS-1.0.0b5.phar';

$client = new RouterOS\Client('172.31.254.1', 'dwi', 'dwicoba');

$responses = $client->sendSync(new RouterOS\Request('/interface/print'));

foreach ($responses as $response) {
    if ($response->getType() === Response::TYPE_DATA) {
        echo 'IP: ', $response->getProperty('address'),
        ' MAC: ', $response->getProperty('mac-address'),
        "<br>";
    }
}
//Example output:
/*
IP: 192.168.0.100 MAC: 00:00:00:00:00:01
IP: 192.168.0.101 MAC: 00:00:00:00:00:02
 */
