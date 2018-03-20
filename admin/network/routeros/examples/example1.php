<?php

require('../routeros_api.class.php');

/*
$API = new RouterosAPI();

$API->debug = true;


if ($API->connect('10.252.252.101', 'admin', 'testing')) {

   $API->write('/ip/address/set', false);
   $API->write('=.id=*6', false);
   $API->write('=address=10.252.252.11/24');
   //$API->write('/ip/address/set', array('id' => '1', 'address' => '10.252.252.101/24'));
   
   
   $READ = $API->read(false);
   $ARRAY = $API->parseResponse($READ);
   
   //echo "<pre>";
   //print_r($ARRAY);
   //echo "</pre>";
   
   $API->disconnect();
   
}

*/

//$API = new RouterosAPI();
//
//$API->debug = true;
//
//$API->connect('10.252.252.11', 'admin', 'testing');
//$API->comm("/ip/address/set", array(".id"=>"*6", "address"=>"10.252.252.101/24"));
   
   //$API->write('/ip/address/set', false);
   //$API->write('=.id=*6', false);
   //$API->write('=address=10.252.252.101/24');
   
   //$ip_baru = $API->read();
   //print_r($ip_baru);
   //
  // $API->disconnect();

   
$API2 = new RouterosAPI();
$API2->debug = false;

//step2
if ($API2->connect('192.168.1.1', 'yuswa', 'password')) {

   //////fetch configuration file from server
   ////$API2->write('/tool/fetch', false);
   ////$API2->write('=address=10.252.252.252', false);
   ////$API2->write('=src-path=testing.rsc', false);
   ////$API2->write('=user=ftpvm', false);
   ////$API2->write('=mode=ftp', false);
   ////$API2->write('=port=21', false);
   ////$API2->write('=password=testing', false);
   ////$API2->write('=dst-path=test.rsc', false);
   ////$API2->write('=keep-result=yes');
   ////
   ////// import and execute configuration file
   ////sleep(10);
   ////$API2->write('/import', false);
   ////$API2->write('=file-name=test.rsc');
   ////sleep(2);
   
   $API2->write('/ip/address/print');
   
  
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   
   echo "<pre>";
   print_r($ARRAY);
   echo "</pre>";
   
   $API2->write('/ip/dhcp-server/lease/print');
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   echo "<pre>";
   print_r($ARRAY);
   echo "</pre>";
   
   $API2->write('/interface/pppoe-client/print');
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   
   echo 'id pppoe-client = '.$ARRAY[0][".id"];
   
   $API2->write('/ping', false);
   $API2->write('=address=192.168.5.1', false);
   $API2->write('=count=5');
   
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   echo "<pre>";
   print_r($ARRAY);
   echo "</pre>";
   
   
   //$API2->write('/ip/address/add', false);
   ////$API2->write('=.id=*7', false);
   //$API2->write('=address=10.252.252.101/24', false);
   //$API2->write('=interface=remote');
   //
   //
   //$READ = $API2->read(false);
   //$ARRAY = $API2->parseResponse($READ);
   //
   //echo "<pre>";
   //print_r($ARRAY);
   //echo "</pre>";
   
   
   //$API2->write('/ip/address/set', false);
   //$API2->write('=.id=*6', false);
   //$API2->write('=address=10.252.252.101/24');
   
   //$ip_baru = $API2->read();
   //print_r($ip_baru);
   //
   $API2->disconnect();
   
   

}


//step 3

if ($API2->connect('192.168.1.1', 'yuswa', 'password')) {

   
   $API2->write('/ip/address/print');
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   
   //echo "<pre>";
   //print_r($ARRAY);
   //echo "</pre>";
   echo '<table border="1">
   <tr>
      <td>.id</td>
      <td>address</td>
      <td>network</td>
      <td>interface</td>
      <td>actual-interface</td>
      <td>invalid</td>
      <td>dynamic</td>
      <td>disabled</td>
   </tr>
   
   ';
   
   foreach($ARRAY as $value)
   {
      if($value["address"] == "192.168.5.2/30")
      {
         $id_address = $value[".id"];
         echo $value[".id"];
      }
      
      echo '<tr>
         <td>'.$value[".id"].'</td>
         <td>'.$value["address"].'</td>
         <td>'.$value["network"].'</td>
         <td>'.$value["interface"].'</td>
         <td>'.$value["actual-interface"].'</td>
         <td>'.$value["invalid"].'</td>
         <td>'.$value["dynamic"].'</td>
         <td>'.$value["disabled"].'</td>
      </tr>';
   }
   
   echo '</table>';
   
   
   $API2->write('/ip/address/print');
   
  
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   
   echo "<pre>";
   print_r($ARRAY);
   echo "</pre>";
   
   $API2->write('/ip/address/disable', false);
   $API2->write("=.id=$id_address");
   
  
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   
   echo "<pre>";
   print_r($ARRAY);
   echo "</pre>";
   
   $API2->write('/ip/dhcp-server/lease/print');
   
  
   $READ = $API2->read(false);
   $ARRAY = $API2->parseResponse($READ);
   
   echo "<pre>";
   print_r($ARRAY);
   echo "</pre>";
   
   
   //$API2->write('/ip/address/set', false);
   //$API2->write('=.id=*6', false);
   //$API2->write('=address=10.252.252.101/24');
   
   //$ip_baru = $API2->read();
   //print_r($ip_baru);
   //
   $API2->disconnect();
   
   

}

