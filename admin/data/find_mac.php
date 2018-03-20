<?php
use PEAR2\Net\RouterOS;
require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>telnet</title>
    </head>
    <body>
     
            <?php
try {
    //Adjust RouterOS IP, username and password accordingly.
    $client = new RouterOS\Client('172.16.182.101', 'admin', 'global');

    $util = new RouterOS\Util($client);
    $util->changeMenu('/interface vlan');
    $util->exec('
                remove tes_vlan
                ');
    //echo $util->get(0, 'name');//echoes "192.168.0.1", assuming we had the previous example executed under an empty ARP list
    /*echo $util->find(function ($response) {
        return preg_match('/vlan1/i', $response->getArgument('name'));//Matches any entry who's comment starts with two digits
    });
    
    $util->set(
        $util->find(
            function ($response) {
                return preg_match('/^\d\d/', $response->getArgument('comment'));//Matches any entry who's comment starts with two digits
            }
        ),
        array(
            'address' => '192.168.0.103'
        );
    */
    
    $logEntries = $client->sendSync(
                    new RouterOS\Request('/interface vlan print')
                )->getAllOfType(RouterOS\Response::TYPE_DATA);
                print_r($logEntries);
} catch(Exception $e) {
    echo "We're sorry, but we can't determine your MAC address right now.";
}
?>
        
    </body>
</html>