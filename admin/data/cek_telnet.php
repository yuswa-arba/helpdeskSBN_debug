<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */

//You may want to include a namespace declaration here
//require_once '/software/beta/config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';
//Use any PEAR2_Net_RouterOS class from here on
   $cmd = "
   /interface vlan1 remove [find name=vlan1]
   ";




$Server = "192.168.1.90";
$Username    = 'dwi';
$Pass       = 'dwi';




?>
<?php
use PEAR2\Net\RouterOS;
require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title>RouterOS log</title>
        <style type="text/css">
            table, td, th {border: 1px solid black;}
            td span {outline: 1px dotted black;}
        </style>
    </head>
    <body>
        <?php
        try {
            $client = new RouterOS\Client($Server, $Username, $Pass);
        } catch (Exception $e) {
        ?><div>Unable to connect to RouterOS.</div>
    <?php
        }
        
        if (isset($client)) {
        ?><table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>type</th>
                    <th>mac</th>
                    <th>uptime</th>
                </tr>
            </thead>
            <tbody><?php
                //$client->sendSync(new RouterOS\Request('/interface vlan remove tes_vlan'));
                $util = new RouterOS\Util($client);
                //$util->changeMenu('');
                /*$util->exec('
                    /interface vlan remove [find name=vlan12]
                    ');
                */
                $logEntries = $client->sendSync(
                    new RouterOS\Request('/interface pppoe-server print')
                )->getAllOfType(RouterOS\Response::TYPE_DATA);
                print_r($logEntries);
                foreach ($logEntries as $entry) {
                    ?>

                <tr>
                    <td><?php echo $entry('user'); ?></td>
                    <td><?php echo $entry('service'); ?></td>
                    <td><?php echo $entry('remote-address'); ?></td>
                    <td><?php echo $entry('uptime'); ?></td>
                </tr><?php } ?>

            </tbody>
        </table>
    <?php } ?></body>
</html>