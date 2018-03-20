<?php
//include('ssh/Net/SSH2.php');
//
////$ssh = new Net_SSH2('172.17.9.51');
//$server = "172.17.9.51";
//$username = "root";
//$password = "globalesx";
//$command = "vim-cmd vmsvc/getallvms |grep vlan2606";
//
//$ssh = new Net_SSH2($server);
//if (!$ssh->login($username, $password)) {
//    exit('Login Failed');
//}
//
//echo $ssh->exec($command);

echo shell_exec('expect /usr/script/aktivasi/mactelnet.exp');
?>