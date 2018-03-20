<?php
include ("../config/configuration.php");

echo '[';
$time_zone = date_default_timezone_set("Asia/Jakarta");
	$posisi_tanggal = date('m/d/Y H:i:s');
        $pecah = explode(" ", $posisi_tanggal);
	
	$pecah_tanggal = explode("/", $pecah[0]);
	$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $pecah_tanggal[0], $pecah_tanggal[2]);
    $plugins2 = '';
    $plugins3 = '';
    
    //for($no=1; $no<=$jumlah_hari; $no++){
         
        $sql_spk = mysql_query("SELECT * FROM `gx_spk` WHERE  `level` = '0';");
        $jum_spk = mysql_num_rows($sql_spk);
        
        if($jum_spk >= 1){
        $items .= '';
            
        $noa = 1;
        while($row_spk = mysql_fetch_array($sql_spk)){
            //new Date('.date("Y,n,j,H", strtotime($row_spk["date_add"])).')
            $items   .= '{"id": '.$row_spk["id_spk"].',"title": "'.$row_spk["name"].'","start": "'.$row_spk["date_add"].'","url": "detail_info.php"},';
            
        }
            $data_json	= substr($items, 0, -1);
            
        }
    //}
/*    
$sql = mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-").$no."%' AND `level` = '0';");
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);
*/
        echo $data_json;
        echo ']';
?>