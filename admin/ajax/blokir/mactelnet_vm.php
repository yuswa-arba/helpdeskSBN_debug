<?php
//echo shell_exec('sudo php -v');
//echo shell_exec('expect -f /usr/script/config-vm.exp.mac'); //spawn mactelnet 00:50:56:82:67:2D -u admin -p testing Connecting to 0:50:56:82:67:2d...done
echo shell_exec('expect -d /usr/script/aktivasi/mactelnet.exp'); //spawn mactelnet 00:50:56:82:67:2D -u admin -p testing Connecting to 0:50:56:82:67:2d...done
//sleep(20);
//echo "ok";
//echo shell_exec('mactelnet 00:50:56:82:67:2D -u admin -p testing'); //blank
//print_r($output_show_vlan_esx);
