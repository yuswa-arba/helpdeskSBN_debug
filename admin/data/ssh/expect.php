<?php

$output_show_vlan_esx = shell_exec('expect /usr/script/esx/show_vlan.exp');

$logFile = '/usr/script/esx/show-vlan-esx.txt';
$lines = file($logFile);
$line_data =  count ($lines) -2;

$id_esx = $lines[$line_data];
$id_esx = trim(substr($id_esx, 0, 6));
echo $id_esx."<br>";

print_r(nl2br($output_show_vlan_esx));