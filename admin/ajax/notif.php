<?php
/*
 *
 *update 3 juni 2015 by dwi
 * update creatd by yg sebelum username
 */
include ("../../config/configuration_admin.php");
global $conn;
global $conn_voip;

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
	$jumlah = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_add` >= '$waktu_mins' AND `date_add` <= '$waktu';", $conn));
	//echo "SELECT * FROM `gx_helpdesk_complaint` WHERE `date_add` >= '$waktu_mins' AND `date_add` <= '$waktu';";
//echo $jumlah;
if($jumlah > 0){
	$t = '<script type="text/javascript">
	    $(function() {
	    ';
	
	$data_gx_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE  `date_add`>='$waktu_mins';", $conn);
	//echo "SELECT * FROM `gx_helpdesk_complaint` WHERE  `date_add`>='$waktu_mins';";
	while($d = mysql_fetch_array($data_gx_complaint)){
            
            //$t .='setTimeout(function() {
            $t .='$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$d['id_complaint'].'">incoming - '.$d["name"].' - '.$d["problem"] . $d["other_problem"].' <br> by ';
	   //$np =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='".$d["id_cso"]."';", $conn));
	   $t .= $d['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	
	$t .= '});
	</script>';
	echo $t;

}

	$date_update = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));

if($date_update > 0){
	$du = '<script type="text/javascript">
	    $(function() {
	    ';
	    
	$data_gx_complaint_upd = mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($u = mysql_fetch_array($data_gx_complaint_upd)){
	   //$du .= 'setTimeout(function() {
            $du .='$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$u['id_complaint'].'">Update - '.$u['ticket_number'].' - '.$u['problem'] . $u['other_problem'].' <br> by ';
	   //$sp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$u[id_cso]'", $conn));
	   $du .= ''.$u['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	$du .= '});
	</script>';
	echo $du;
}

	$date_update = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));

if($date_update > 0){
	$du = '<script type="text/javascript">
	    $(function() {
	    ';    
	
	$data_gx_complaint_upd = mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($u = mysql_fetch_array($data_gx_complaint_upd)){
	   //$du .= 'setTimeout(function() {
            $du .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$u['id_complaint'].'">Update - '.$u['ticket_number'].' - '.$u['problem'] . $u['other_problem'].' <br> by ';
	   //$sp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$u[id_cso]'", $conn));
	   $du .= ''.$u['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	
        $du .= '});
	</script>';
	echo $du;
}      

      
    
$jumlah_table_trouble_ticket_upd = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `trouble_ticket` = '1' AND `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));
	

	if($jumlah_table_trouble_ticket_upd > 0){
	$ttu = '<script type="text/javascript">
	    $(function() {
	    ';    
	
	$data_trouble_ticket_upd = mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($dt = mysql_fetch_array($data_trouble_ticket_upd)){
	   //$tt .= 'setTimeout(function() {
            $ttu .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">Trouble Ticket - '.$dt['ticket_number'].', by ';
	   //$tp =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dt[user_index]'", $conn));
	   $ttu .= ''.$dt['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	$ttu .= '});
	</script>';
	echo $ttu;

}    
      
      
      
      //table spk
$jumlah_table_spk = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE `date_add`>='$waktu_mins' AND `date_add`<='$waktu'", $conn));
	

	if($jumlah_table_spk > 0){
	$tspk = '<script type="text/javascript">
	    $(function() {
	    ';    
	
	$data_spk = mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE  `date_add`>='$waktu_mins'", $conn);	
	while($dspk = mysql_fetch_array($data_spk)){
	   //$tspk .= 'setTimeout(function() {
            $tspk .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">GX SPK - '.$dspk['name'].' - '.$dspk['problem'].', by '.$dspk['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	}
	$tspk .= '});
	</script>';
	
	echo $tspk;
}

    
$jumlah_table_spk_upd = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn));
	

	if($jumlah_table_spk_upd > 0){
	$tspku = '<script type="text/javascript">
	    $(function() {
	    ';    
	
	$data_spk_upd = mysql_query("SELECT * FROM `gx_helpdesk_spk` WHERE  `date_upd`>='$waktu_mins' AND `date_upd`<='$waktu' AND `date_add` != `date_upd`", $conn);	
	while($dspku = mysql_fetch_array($data_spk_upd)){
	   //$tspku .= 'setTimeout(function() {
            $tspku .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php">GX SPK - '.$dspku['name'].' - ';
	   if($dspku['id_marketing'] = '0'){
	   //$tptspku =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dspku[id_teknisi]'", $conn));
	   $tspku .= ''.$dspku['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	   }
	   elseif($dspku['id_teknisi'] = '0'){
	   //$tptspku =  mysql_fetch_array(mysql_query("SELECT `username` FROM `users` WHERE `id_user`='$dspku[id_marketing]'"));
	   $tspku .= ''.$dspku['created_by'].'<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	   }
	   else{
	    $tspku .= '<br></a>\', { type: \'warning\' });';
           //}, 1000);';
	   }
	}
	
	$tspku .= '});
	</script>';
	echo $tspku;
}    
      
      
      
      

$jam_8 = "".$pecah_waktu[0]." 08:00:00";
$batas_jam_8 = "".$pecah_waktu[0]." 08:00:15";
if($waktu >= $jam_8 AND $waktu <= $batas_jam_8){
    $sql_tampil_jam_8 = mysql_query("SELECT * FROM `gx_helpdesk_complaint` WHERE `status`='uncleared' ORDER BY `date_upd` DESC LIMIT 5", $conn);
    $tj = '<script type="text/javascript">
	    $(function() {
	    ';
    
    while($b = mysql_fetch_array($sql_tampil_jam_8)){
	//$tj .= 'setTimeout(function() {
            $tj .= '$.bootstrapGrowl(\'<a target="_blank" href="detail.php?id_complaint='.$b['id_complaint'].'">Troubleticket '.$b['ticket_number'].' - Uncleared </a><br>\', { type: \'warning\' });';
          // }, 1000);';
    }
    $tj .= '});
	</script>';

    echo $tj;
}


?>
                       
