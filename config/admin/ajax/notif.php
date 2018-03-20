<?php
include ("../config/configuration.php");
global $conn;
global $conn_voip;
?>

<script type="text/javascript">
    $(function() {
       
<?php

/*
$(\'<audio id="chatAudio"><source src="pages/notify.ogg" type="audio/ogg"><source src="pages/notify.mp3" type="audio/mpeg"><source src="pages/notify.wav" type="audio/wav"></audio>\').appendTo(\'body\');
	   $(\'#chatAudio\')[0].play();
	   
	   */
date_default_timezone_set("Asia/Jakarta");
	$jam = date("Y-m-d H:i");
	$new_jam = mysql_fetch_array(mysql_query("SELECT NOW() as `waktu`", $conn));
	$waktu = $new_jam['waktu'];
	$pecah_waktu = explode(" ", $waktu);
	$pecah_waktu_tgl = explode("-", $pecah_waktu[0]);
	$pecah_waktu_jam = explode(":", $pecah_waktu[1]);
	$det_waktu = mktime($pecah_waktu_jam[0],$pecah_waktu_jam[1],$pecah_waktu_jam[2],$pecah_waktu_tgl[1],$pecah_waktu_tgl[2],$pecah_waktu_tgl[0]);
	$mins_20_second = $det_waktu - 20;
	$waktu_mins = date("Y-m-d H:i:s", $mins_20_second);
	$jumlah = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `date_add` >= '$waktu_mins' AND `date_add` <= '$waktu';", $conn));
	

	if($jumlah > 0){
	$t = '';    
	
	$data_gx_complaint = mysql_query("SELECT * FROM `gx_complaint` WHERE  `date_add`>='$waktu_mins'", $conn);	
	while($d = mysql_fetch_array($data_gx_complaint)){
            
            //$t .='setTimeout(function() {
            $t .='$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$d['id_complaint'].'">incoming - '.$d['name'].' - '.$d['problem'] . $d['other_problem'].' <br> by ';
	   $np =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$d[id_cso]'", $conn));
	   $t .= ''.$np['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	echo $t;

}

	$date_update = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));

if($date_update > 0){
	$du = '';    
	
	$data_gx_complaint_upd = mysql_query("SELECT * FROM `gx_complaint` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($u = mysql_fetch_array($data_gx_complaint_upd)){
	   //$du .= 'setTimeout(function() {
            $du .='$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$u['id_complaint'].'">Update - '.$u['ticket_number'].' - '.$u['problem'] . $u['other_problem'].' <br> by ';
	   $sp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$u[id_cso]'", $conn));
	   $du .= ''.$sp['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
        $du;
}

	$date_update = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));

if($date_update > 0){
	$du = '';    
	
	$data_gx_complaint_upd = mysql_query("SELECT * FROM `gx_complaint` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($u = mysql_fetch_array($data_gx_complaint_upd)){
	   //$du .= 'setTimeout(function() {
            $du .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$u['id_complaint'].'">Update - '.$u['ticket_number'].' - '.$u['problem'] . $u['other_problem'].' <br> by ';
	   $sp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$u[id_cso]'", $conn));
	   $du .= ''.$sp['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	
        $du;
}      

      //table trouble ticket
$jumlah_table_trouble_ticket = mysql_num_rows(mysql_query("SELECT * FROM `trouble_ticket` WHERE `date_add`>='$waktu_mins' AND `date_add`<='$waktu'", $conn));
	

	if($jumlah_table_trouble_ticket > 0){
	$tt = '';    
	
	$data_trouble_ticket = mysql_query("SELECT * FROM `trouble_ticket` WHERE  `date_add`>='$waktu_mins'", $conn);	
	while($dt = mysql_fetch_array($data_trouble_ticket)){
	   //$tt .= 'setTimeout(function() {
            $tt .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">Trouble Ticket - '.$dt['judul_ticket'].', by ';
	   $tp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dt[user_index]'", $conn));
	   $du .= ''.$tp['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	
        echo $tt;
}

    
$jumlah_table_trouble_ticket_upd = mysql_num_rows(mysql_query("SELECT * FROM `trouble_ticket` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));
	

	if($jumlah_table_trouble_ticket_upd > 0){
	$ttu = '';    
	
	$data_trouble_ticket_upd = mysql_query("SELECT * FROM `trouble_ticket` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($dt = mysql_fetch_array($data_trouble_ticket)){
	   //$tt .= 'setTimeout(function() {
            $tt .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">Trouble Ticket - '.$dt['judul_ticket'].', by ';
	   $tp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dt[user_index]'", $conn));
	   $du .= ''.$tp['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	echo $tp;

}    
      
      
      
      //table spk
$jumlah_table_spk = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add`>='$waktu_mins' AND `date_add`<='$waktu'", $conn));
	

	if($jumlah_table_spk > 0){
	$tspk = '';    
	
	$data_spk = mysql_query("SELECT * FROM `gx_spk` WHERE  `date_add`>='$waktu_mins'", $conn);	
	while($dspk = mysql_fetch_array($data_spk)){
	   //$tspk .= 'setTimeout(function() {
            $tspk .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">GX SPK - '.$dspk['name'].' - '.$dspk['problem'].', by '.$dspk['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	echo $tspk;
}

    
$jumlah_table_spk_upd = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));
	

	if($jumlah_table_spk_upd > 0){
	$tspku = '';    
	
	$data_spk_upd = mysql_query("SELECT * FROM `gx_spk` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($dspku = mysql_fetch_array($data_spk_upd)){
	   //$tspku .= 'setTimeout(function() {
            $tspku .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">GX SPK - '.$dspku['name'].' - ';
	   if($dspku['id_marketing'] = '0'){
	   $tptspku =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dspku[id_teknisi]'", $conn));
	   $tspku .= ''.$tptspku['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	   }
	   elseif($dspku['id_teknisi'] = '0'){
	   $tptspku =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dspku[id_marketing]'"));
	   $tspku .= ''.$tptspku['username'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	   }
	   else{
	    $tspku .= '<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	   }
	}
	echo $tspku;
}    
      
      
      
      

$jam_8 = "".$pecah_waktu[0]." 08:00:00";
$batas_jam_8 = "".$pecah_waktu[0]." 08:00:15";
if($waktu >= $jam_8 AND $waktu <= $batas_jam_8){
    $sql_tampil_jam_8 = mysql_query("SELECT * FROM `gx_complaint` WHERE `status`='uncleared' ORDER BY `date_upd` DESC LIMIT 5", $conn);
    $tj = '';
    
    while($b = mysql_fetch_array($sql_tampil_jam_8)){
	//$tj .= 'setTimeout(function() {
            $tj .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$b['id_complaint'].'">Troubleticket '.$b['ticket_number'].' - Uncleared </a><br>\', { type: \'warning\' });';
          // }, 1000);';
    }

    echo $tj;
}


?>
                       
    });
</script>