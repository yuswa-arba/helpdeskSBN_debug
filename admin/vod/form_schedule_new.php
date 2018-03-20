<?php
session_start();
ob_start();

//No. 	Log Insert=> 	Jam 	Acara 	Channel 	Action
// data => di tampilkan 1 berdasarkan channel dan tgl hari ini
// paging didasarkan pada tanggal

/*
SELECT *
FROM `gx_vod_schedule`
GROUP BY `dateadd`
ORDER BY `gx_vod_schedule`.`datetime` ASC
LIMIT 30 , 30

SELECT NOW() AS `tgl_skrg` 

SELECT *
FROM `gx_vod_schedule`
ORDER BY `dateadd` ASC
LIMIT 1 



$tanggal_skrg_sql = explode(" ", $tgl_skrg);
$ex_tanggal_skrg_sql_tgl =  explode("-", $tanggal_skrg_sql[0]);
$ex_tanggal_skrg_sql_jam =  explode(":", $tanggal_skrg_sql[1]);
$tanggal_skrg_sql_d = $ex_tanggal_skrg_sql_tgl[2];
$tanggal_skrg_sql_m = $ex_tanggal_skrg_sql_tgl[1];
$tanggal_skrg_sql_y = $ex_tanggal_skrg_sql_tgl[0];
$tanggal_skrg_sql_h = $ex_tanggal_skrg_sql_jam[0];
$tanggal_skrg_sql_i = $ex_tanggal_skrg_sql_jam[1];
$tanggal_skrg_sql_s = $ex_tanggal_skrg_sql_jam[2];

$detik_now = mktime($tanggal_skrg_sql_h, $tanggal_skrg_sql_i, $tanggal_skrg_sql_s, $tanggal_skrg_sql_m, $tanggal_skrg_sql_d, $tanggal_skrg_sql_y);


$tanggal_lama_db = explode(" ", $tgl_db);
$ex_tanggal_lama_db_tgl =  explode("-", $tanggal_lama_db[0]);
$ex_tanggal_lama_db_jam =  explode(":", $tanggal_skrg_sql[1]);
$tanggal_lama_db_d = $ex_tanggal_skrg_sql_tgl[2];
$tanggal_lama_db_m = $ex_tanggal_skrg_sql_tgl[1];
$tanggal_lama_db_y = $ex_tanggal_skrg_sql_tgl[0];
$tanggal_lama_db_h = $ex_tanggal_skrg_sql_jam[0];
$tanggal_lama_db_i = $ex_tanggal_skrg_sql_jam[1];
$tanggal_lama_db_s = $ex_tanggal_skrg_sql_jam[2];

$detik_lama = mktime($tanggal_lama_db_h, $tanggal_lama_db_i, $tanggal_lama_db_s, $tanggal_lama_db_m, $tanggal_lama_db_d, $tanggal_lama_db_y);


$selisih_waktu = $detik_now - $detik_lama;
$jumlah_data = floor($selisih_waktu / (60 * 60 * 24 * 30 * 12));

*/

//file configuration for database and create session.
include ("../../config/configuration_admin.php");
redirectToHTTPS();

date_default_timezone_set('asia/jakarta');
if ($loggedin = logged_inAdmin()) //session expired time.
{ 
  if ($loggedin["group"] != 'admin')  
  { 
    echo "<script language=javascript>
            alert('Your Session Expired.');
            window.location.href='logout.php';
          </script>"; 
    exit(0); 
  } 
  else  
  {

    if($loggedin = logged_inAdmin()){ // Check if they are logged in 
      if($loggedin["group"] == "admin"){


$data_tgl_skrg = mysql_fetch_array(mysql_query("SELECT NOW() AS `tgl_skrg`", $conn));
$tgl_skrg = $data_tgl_skrg['tgl_skrg'];
$tanggal_skrg_sql = explode(" ", $tgl_skrg);
$ex_tanggal_skrg_sql_tgl =  explode("-", $tanggal_skrg_sql[0]);
$ex_tanggal_skrg_sql_jam =  explode(":", $tanggal_skrg_sql[1]);
$tanggal_skrg_sql_d = $ex_tanggal_skrg_sql_tgl[2];
$tanggal_skrg_sql_m = $ex_tanggal_skrg_sql_tgl[1];
$tanggal_skrg_sql_y = $ex_tanggal_skrg_sql_tgl[0];
$tanggal_skrg_sql_h = $ex_tanggal_skrg_sql_jam[0];
$tanggal_skrg_sql_i = $ex_tanggal_skrg_sql_jam[1];
$tanggal_skrg_sql_s = $ex_tanggal_skrg_sql_jam[2];

$detik_now = mktime($tanggal_skrg_sql_h, $tanggal_skrg_sql_i, $tanggal_skrg_sql_s, $tanggal_skrg_sql_m, $tanggal_skrg_sql_d, $tanggal_skrg_sql_y);


$data_tgl_db = mysql_fetch_array(mysql_query("SELECT * FROM `gx_vod_schedule` ORDER BY `dateadd` ASC LIMIT 1 ", $conn));
$tgl_db = $data_tgl_db['dateadd'];
$tanggal_lama_db = explode(" ", $tgl_db);
$ex_tanggal_lama_db_tgl =  explode("-", $tanggal_lama_db[0]);
$ex_tanggal_lama_db_jam =  explode(":", $tanggal_lama_db[1]);
$tanggal_lama_db_d = $ex_tanggal_lama_db_tgl[2];
$tanggal_lama_db_m = $ex_tanggal_lama_db_tgl[1];
$tanggal_lama_db_y = $ex_tanggal_lama_db_tgl[0];
$tanggal_lama_db_h = $ex_tanggal_lama_db_jam[0];
$tanggal_lama_db_i = $ex_tanggal_lama_db_jam[1];
$tanggal_lama_db_s = $ex_tanggal_lama_db_jam[2];

$detik_lama = mktime($tanggal_lama_db_h, $tanggal_lama_db_i, $tanggal_lama_db_s, $tanggal_lama_db_m, $tanggal_lama_db_d, $tanggal_lama_db_y);


$selisih_waktu = $detik_now - $detik_lama;
$jumlah_data = floor($selisih_waktu / (60 * 60 * 24));





//function for paging
$perhalaman = 1;

if (isset($_GET['page'])){
  $page = (int)$_GET['page'];
}else{
  $page=1;
}


//file configuration for database and create session.

$save = isset($_POST["insert"]) ? $_POST["insert"] : "";
$edit = isset($_POST["update"]) ? $_POST["update"] : "";


$insert_schedule = isset($_POST['insert']) ? $_POST['insert'] : '';

if($insert_schedule == 'insert'){


$data_kode_tv = 'tvsctv';



//schedule acara

$acara_jam_0_00 = isset($_POST['acara_jam_0_00']) ? $_POST['acara_jam_0_00'] : '';
$acara_jam_0_30 = isset($_POST['acara_jam_0_30']) ? $_POST['acara_jam_0_30'] : '';
$acara_jam_1_00 = isset($_POST['acara_jam_1_00']) ? $_POST['acara_jam_1_00'] : '';
$acara_jam_1_30 = isset($_POST['acara_jam_1_30']) ? $_POST['acara_jam_1_30'] : '';

$acara_jam_2_00 = isset($_POST['acara_jam_2_00']) ? $_POST['acara_jam_2_00'] : '';
$acara_jam_2_30 = isset($_POST['acara_jam_2_30']) ? $_POST['acara_jam_2_30'] : '';
$acara_jam_3_00 = isset($_POST['acara_jam_3_00']) ? $_POST['acara_jam_3_00'] : '';
$acara_jam_3_30 = isset($_POST['acara_jam_3_30']) ? $_POST['acara_jam_3_30'] : '';

$acara_jam_4_00 = isset($_POST['acara_jam_4_00']) ? $_POST['acara_jam_4_00'] : '';
$acara_jam_4_30 = isset($_POST['acara_jam_4_30']) ? $_POST['acara_jam_4_30'] : '';
$acara_jam_5_00 = isset($_POST['acara_jam_5_00']) ? $_POST['acara_jam_5_00'] : '';
$acara_jam_5_30 = isset($_POST['acara_jam_5_30']) ? $_POST['acara_jam_5_30'] : '';

$acara_jam_6_00 = isset($_POST['acara_jam_6_00']) ? $_POST['acara_jam_6_00'] : '';
$acara_jam_6_30 = isset($_POST['acara_jam_6_30']) ? $_POST['acara_jam_6_30'] : '';
$acara_jam_7_00 = isset($_POST['acara_jam_7_00']) ? $_POST['acara_jam_7_00'] : '';
$acara_jam_7_30 = isset($_POST['acara_jam_7_30']) ? $_POST['acara_jam_7_30'] : '';


$acara_jam_8_00 = isset($_POST['acara_jam_8_00']) ? $_POST['acara_jam_8_00'] : '';
$acara_jam_8_30 = isset($_POST['acara_jam_8_30']) ? $_POST['acara_jam_8_30'] : '';
$acara_jam_9_00 = isset($_POST['acara_jam_9_00']) ? $_POST['acara_jam_9_00'] : '';
$acara_jam_9_30 = isset($_POST['acara_jam_9_30']) ? $_POST['acara_jam_9_30'] : '';

$acara_jam_10_00 = isset($_POST['acara_jam_10_00']) ? $_POST['acara_jam_10_00'] : '';
$acara_jam_10_30 = isset($_POST['acara_jam_10_30']) ? $_POST['acara_jam_10_30'] : '';
$acara_jam_11_00 = isset($_POST['acara_jam_11_00']) ? $_POST['acara_jam_11_00'] : '';
$acara_jam_11_30 = isset($_POST['acara_jam_11_30']) ? $_POST['acara_jam_11_30'] : '';

$acara_jam_12_00 = isset($_POST['acara_jam_12_00']) ? $_POST['acara_jam_12_00'] : '';
$acara_jam_12_30 = isset($_POST['acara_jam_12_30']) ? $_POST['acara_jam_12_30'] : '';
$acara_jam_13_00 = isset($_POST['acara_jam_13_00']) ? $_POST['acara_jam_13_00'] : '';
$acara_jam_13_30 = isset($_POST['acara_jam_13_30']) ? $_POST['acara_jam_13_30'] : '';

$acara_jam_14_00 = isset($_POST['acara_jam_14_00']) ? $_POST['acara_jam_14_00'] : '';
$acara_jam_14_30 = isset($_POST['acara_jam_14_30']) ? $_POST['acara_jam_14_30'] : '';
$acara_jam_15_00 = isset($_POST['acara_jam_15_00']) ? $_POST['acara_jam_15_00'] : '';
$acara_jam_15_30 = isset($_POST['acara_jam_15_30']) ? $_POST['acara_jam_15_30'] : '';


$acara_jam_16_00 = isset($_POST['acara_jam_16_00']) ? $_POST['acara_jam_16_00'] : '';
$acara_jam_16_30 = isset($_POST['acara_jam_16_30']) ? $_POST['acara_jam_16_30'] : '';
$acara_jam_17_00 = isset($_POST['acara_jam_17_00']) ? $_POST['acara_jam_17_00'] : '';
$acara_jam_17_30 = isset($_POST['acara_jam_17_30']) ? $_POST['acara_jam_17_30'] : '';

$acara_jam_18_00 = isset($_POST['acara_jam_18_00']) ? $_POST['acara_jam_18_00'] : '';
$acara_jam_18_30 = isset($_POST['acara_jam_18_30']) ? $_POST['acara_jam_18_30'] : '';
$acara_jam_19_00 = isset($_POST['acara_jam_19_00']) ? $_POST['acara_jam_19_00'] : '';
$acara_jam_19_30 = isset($_POST['acara_jam_19_30']) ? $_POST['acara_jam_19_30'] : '';

$acara_jam_20_00 = isset($_POST['acara_jam_20_00']) ? $_POST['acara_jam_20_00'] : '';
$acara_jam_20_30 = isset($_POST['acara_jam_20_30']) ? $_POST['acara_jam_20_30'] : '';
$acara_jam_21_00 = isset($_POST['acara_jam_21_00']) ? $_POST['acara_jam_21_00'] : '';
$acara_jam_21_30 = isset($_POST['acara_jam_21_30']) ? $_POST['acara_jam_21_30'] : '';

$acara_jam_22_00 = isset($_POST['acara_jam_22_00']) ? $_POST['acara_jam_22_00'] : '';
$acara_jam_22_30 = isset($_POST['acara_jam_22_30']) ? $_POST['acara_jam_22_30'] : '';
$acara_jam_23_00 = isset($_POST['acara_jam_23_00']) ? $_POST['acara_jam_23_00'] : '';
$acara_jam_23_30 = isset($_POST['acara_jam_23_30']) ? $_POST['acara_jam_23_30'] : '';


//jam acara
$jam_0_00 = isset($_POST['jam_0_00']) ? $_POST['jam_0_00'] : '';
$jam_0_30 = isset($_POST['jam_0_30']) ? $_POST['jam_0_30'] : '';
$jam_1_00 = isset($_POST['jam_1_00']) ? $_POST['jam_1_00'] : '';
$jam_1_30 = isset($_POST['jam_1_30']) ? $_POST['jam_1_30'] : '';

$jam_2_00 = isset($_POST['jam_2_00']) ? $_POST['jam_2_00'] : '';
$jam_2_30 = isset($_POST['jam_2_30']) ? $_POST['jam_2_30'] : '';
$jam_3_00 = isset($_POST['jam_3_00']) ? $_POST['jam_3_00'] : '';
$jam_3_30 = isset($_POST['jam_3_30']) ? $_POST['jam_3_30'] : '';

$jam_4_00 = isset($_POST['jam_4_00']) ? $_POST['jam_4_00'] : '';
$jam_4_30 = isset($_POST['jam_4_30']) ? $_POST['jam_4_30'] : '';
$jam_5_00 = isset($_POST['jam_5_00']) ? $_POST['jam_5_00'] : '';
$jam_5_30 = isset($_POST['jam_5_30']) ? $_POST['jam_5_30'] : '';

$jam_6_00 = isset($_POST['jam_6_00']) ? $_POST['jam_6_00'] : '';
$jam_6_30 = isset($_POST['jam_6_30']) ? $_POST['jam_6_30'] : '';
$jam_7_00 = isset($_POST['jam_7_00']) ? $_POST['jam_7_00'] : '';
$jam_7_30 = isset($_POST['jam_7_30']) ? $_POST['jam_7_30'] : '';


$jam_8_00 = isset($_POST['jam_8_00']) ? $_POST['jam_8_00'] : '';
$jam_8_30 = isset($_POST['jam_8_30']) ? $_POST['jam_8_30'] : '';
$jam_9_00 = isset($_POST['jam_9_00']) ? $_POST['jam_9_00'] : '';
$jam_9_30 = isset($_POST['jam_9_30']) ? $_POST['jam_9_30'] : '';

$jam_10_00 = isset($_POST['jam_10_00']) ? $_POST['jam_10_00'] : '';
$jam_10_30 = isset($_POST['jam_10_30']) ? $_POST['jam_10_30'] : '';
$jam_11_00 = isset($_POST['jam_11_00']) ? $_POST['jam_11_00'] : '';
$jam_11_30 = isset($_POST['jam_11_30']) ? $_POST['jam_11_30'] : '';

$jam_12_00 = isset($_POST['jam_12_00']) ? $_POST['jam_12_00'] : '';
$jam_12_30 = isset($_POST['jam_12_30']) ? $_POST['jam_12_30'] : '';
$jam_13_00 = isset($_POST['jam_13_00']) ? $_POST['jam_13_00'] : '';
$jam_13_30 = isset($_POST['jam_13_30']) ? $_POST['jam_13_30'] : '';

$jam_14_00 = isset($_POST['jam_14_00']) ? $_POST['jam_14_00'] : '';
$jam_14_30 = isset($_POST['jam_14_30']) ? $_POST['jam_14_30'] : '';
$jam_15_00 = isset($_POST['jam_15_00']) ? $_POST['jam_15_00'] : '';
$jam_15_30 = isset($_POST['jam_15_30']) ? $_POST['jam_15_30'] : '';


$jam_16_00 = isset($_POST['jam_16_00']) ? $_POST['jam_16_00'] : '';
$jam_16_30 = isset($_POST['jam_16_30']) ? $_POST['jam_16_30'] : '';
$jam_17_00 = isset($_POST['jam_17_00']) ? $_POST['jam_17_00'] : '';
$jam_17_30 = isset($_POST['jam_17_30']) ? $_POST['jam_17_30'] : '';

$jam_18_00 = isset($_POST['jam_18_00']) ? $_POST['jam_18_00'] : '';
$jam_18_30 = isset($_POST['jam_18_30']) ? $_POST['jam_18_30'] : '';
$jam_19_00 = isset($_POST['jam_19_00']) ? $_POST['jam_19_00'] : '';
$jam_19_30 = isset($_POST['jam_19_30']) ? $_POST['jam_19_30'] : '';

$jam_20_00 = isset($_POST['jam_20_00']) ? $_POST['jam_20_00'] : '';
$jam_20_30 = isset($_POST['jam_20_30']) ? $_POST['jam_20_30'] : '';
$jam_21_00 = isset($_POST['jam_21_00']) ? $_POST['jam_21_00'] : '';
$jam_21_30 = isset($_POST['jam_21_30']) ? $_POST['jam_21_30'] : '';

$jam_22_00 = isset($_POST['jam_22_00']) ? $_POST['jam_22_00'] : '';
$jam_22_30 = isset($_POST['jam_22_30']) ? $_POST['jam_22_30'] : '';
$jam_23_00 = isset($_POST['jam_23_00']) ? $_POST['jam_23_00'] : '';
$jam_23_30 = isset($_POST['jam_23_30']) ? $_POST['jam_23_30'] : '';


//id stream
$id_stream = isset($_POST['id_stream']) ? $_POST['id_stream'] : '';

//datenow
$data_datetimenow_1 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_1`", $conn));
$ex_data_datetimenow_1 = explode(" ", $data_datetimenow_1['datetimenow_1']);
$datenow_1 = $ex_data_datetimenow_1[0];

$data_datetimenow_2 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_2`", $conn));
$ex_data_datetimenow_2 = explode(" ", $data_datetimenow_2['datetimenow_2']);
$datenow_2 = $ex_data_datetimenow_2[0];

$data_datetimenow_3 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_3`", $conn));
$ex_data_datetimenow_3 = explode(" ", $data_datetimenow_3['datetimenow_3']);
$datenow_3 = $ex_data_datetimenow_3[0];

$data_datetimenow_4 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_4`", $conn));
$ex_data_datetimenow_4 = explode(" ", $data_datetimenow_4['datetimenow_4']);
$datenow_4 = $ex_data_datetimenow_4[0];

$data_datetimenow_5 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_5`", $conn));
$ex_data_datetimenow_5 = explode(" ", $data_datetimenow_5['datetimenow_5']);
$datenow_5 = $ex_data_datetimenow_5[0];

$data_datetimenow_6 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_6`", $conn));
$ex_data_datetimenow_6 = explode(" ", $data_datetimenow_6['datetimenow_6']);
$datenow_6 = $ex_data_datetimenow_6[0];

$data_datetimenow_7 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_7`", $conn));
$ex_data_datetimenow_7 = explode(" ", $data_datetimenow_7['datetimenow_7']);
$datenow_7 = $ex_data_datetimenow_7[0];

$data_datetimenow_8 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_8`", $conn));
$ex_data_datetimenow_8 = explode(" ", $data_datetimenow_8['datetimenow_8']);
$datenow_8 = $ex_data_datetimenow_8[0];

$data_datetimenow_9 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_9`", $conn));
$ex_data_datetimenow_9 = explode(" ", $data_datetimenow_9['datetimenow_9']);
$datenow_9 = $ex_data_datetimenow_9[0];

$data_datetimenow_10 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_10`", $conn));
$ex_data_datetimenow_10 = explode(" ", $data_datetimenow_10['datetimenow_10']);
$datenow_10 = $ex_data_datetimenow_10[0];

$data_datetimenow_11 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_11`", $conn));
$ex_data_datetimenow_11 = explode(" ", $data_datetimenow_11['datetimenow_11']);
$datenow_11 = $ex_data_datetimenow_11[0];

$data_datetimenow_12 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_12`", $conn));
$ex_data_datetimenow_12 = explode(" ", $data_datetimenow_12['datetimenow_12']);
$datenow_12 = $ex_data_datetimenow_12[0];

$data_datetimenow_13 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_13`", $conn));
$ex_data_datetimenow_13 = explode(" ", $data_datetimenow_13['datetimenow_13']);
$datenow_13 = $ex_data_datetimenow_13[0];

$data_datetimenow_14 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_14`", $conn));
$ex_data_datetimenow_14 = explode(" ", $data_datetimenow_14['datetimenow_14']);
$datenow_14 = $ex_data_datetimenow_14[0];

$data_datetimenow_15 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_15`", $conn));
$ex_data_datetimenow_15 = explode(" ", $data_datetimenow_15['datetimenow_15']);
$datenow_15 = $ex_data_datetimenow_15[0];

$data_datetimenow_16 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_16`", $conn));
$ex_data_datetimenow_16 = explode(" ", $data_datetimenow_16['datetimenow_16']);
$datenow_16 = $ex_data_datetimenow_16[0];

$data_datetimenow_17 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_17`", $conn));
$ex_data_datetimenow_17 = explode(" ", $data_datetimenow_17['datetimenow_17']);
$datenow_17 = $ex_data_datetimenow_17[0];

$data_datetimenow_18 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_18`", $conn));
$ex_data_datetimenow_18 = explode(" ", $data_datetimenow_18['datetimenow_18']);
$datenow_18 = $ex_data_datetimenow_18[0];


$data_datetimenow_19 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_19`", $conn));
$ex_data_datetimenow_19 = explode(" ", $data_datetimenow_19['datetimenow_19']);
$datenow_19 = $ex_data_datetimenow_19[0];

$data_datetimenow_20 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_20`", $conn));
$ex_data_datetimenow_20 = explode(" ", $data_datetimenow_20['datetimenow_20']);
$datenow_20 = $ex_data_datetimenow_20[0];

$data_datetimenow_21 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_21`", $conn));
$ex_data_datetimenow_21 = explode(" ", $data_datetimenow_21['datetimenow_21']);
$datenow_21 = $ex_data_datetimenow_21[0];

$data_datetimenow_22 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_22`", $conn));
$ex_data_datetimenow_22 = explode(" ", $data_datetimenow_22['datetimenow_22']);
$datenow_22 = $ex_data_datetimenow_22[0];

$data_datetimenow_23 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_23`", $conn));
$ex_data_datetimenow_23 = explode(" ", $data_datetimenow_23['datetimenow_23']);
$datenow_23 = $ex_data_datetimenow_23[0];

$data_datetimenow_24 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_24`", $conn));
$ex_data_datetimenow_24 = explode(" ", $data_datetimenow_24['datetimenow_24']);
$datenow_24 = $ex_data_datetimenow_24[0];

$data_datetimenow_25 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_25`", $conn));
$ex_data_datetimenow_25 = explode(" ", $data_datetimenow_25['datetimenow_25']);
$datenow_25 = $ex_data_datetimenow_25[0];

$data_datetimenow_26 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_26`", $conn));
$ex_data_datetimenow_26 = explode(" ", $data_datetimenow_26['datetimenow_26']);
$datenow_26 = $ex_data_datetimenow_26[0];

$data_datetimenow_27 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_27`", $conn));
$ex_data_datetimenow_27 = explode(" ", $data_datetimenow_27['datetimenow_27']);
$datenow_27 = $ex_data_datetimenow_27[0];

$data_datetimenow_28 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_28`", $conn));
$ex_data_datetimenow_28 = explode(" ", $data_datetimenow_28['datetimenow_28']);
$datenow_28 = $ex_data_datetimenow_28[0];

$data_datetimenow_29 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_29`", $conn));
$ex_data_datetimenow_29 = explode(" ", $data_datetimenow_29['datetimenow_29']);
$datenow_29 = $ex_data_datetimenow_29[0];

$data_datetimenow_30 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_30`", $conn));
$ex_data_datetimenow_30 = explode(" ", $data_datetimenow_30['datetimenow_30']);
$datenow_30 = $ex_data_datetimenow_30[0];

$data_datetimenow_31 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_31`", $conn));
$ex_data_datetimenow_31 = explode(" ", $data_datetimenow_31['datetimenow_31']);
$datenow_31 = $ex_data_datetimenow_31[0];

$data_datetimenow_32 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_32`", $conn));
$ex_data_datetimenow_32 = explode(" ", $data_datetimenow_32['datetimenow_32']);
$datenow_32 = $ex_data_datetimenow_32[0];

$data_datetimenow_33 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_33`", $conn));
$ex_data_datetimenow_33 = explode(" ", $data_datetimenow_33['datetimenow_33']);
$datenow_33 = $ex_data_datetimenow_33[0];

$data_datetimenow_34 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_34`", $conn));
$ex_data_datetimenow_34 = explode(" ", $data_datetimenow_34['datetimenow_34']);
$datenow_34 = $ex_data_datetimenow_34[0];

$data_datetimenow_35 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_35`", $conn));
$ex_data_datetimenow_35 = explode(" ", $data_datetimenow_35['datetimenow_35']);
$datenow_35 = $ex_data_datetimenow_35[0];

$data_datetimenow_36 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_36`", $conn));
$ex_data_datetimenow_36 = explode(" ", $data_datetimenow_36['datetimenow_36']);
$datenow_36 = $ex_data_datetimenow_36[0];

$data_datetimenow_37 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_37`", $conn));
$ex_data_datetimenow_37 = explode(" ", $data_datetimenow_37['datetimenow_37']);
$datenow_37 = $ex_data_datetimenow_37[0];

$data_datetimenow_38 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_38`", $conn));
$ex_data_datetimenow_38 = explode(" ", $data_datetimenow_38['datetimenow_38']);
$datenow_38 = $ex_data_datetimenow_38[0];

$data_datetimenow_39 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_39`", $conn));
$ex_data_datetimenow_39 = explode(" ", $data_datetimenow_39['datetimenow_39']);
$datenow_39 = $ex_data_datetimenow_39[0];

$data_datetimenow_40 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_40`", $conn));
$ex_data_datetimenow_40 = explode(" ", $data_datetimenow_40['datetimenow_40']);
$datenow_40 = $ex_data_datetimenow_40[0];

$data_datetimenow_41 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_41`", $conn));
$ex_data_datetimenow_41 = explode(" ", $data_datetimenow_41['datetimenow_41']);
$datenow_41 = $ex_data_datetimenow_41[0];

$data_datetimenow_42 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_42`", $conn));
$ex_data_datetimenow_42 = explode(" ", $data_datetimenow_42['datetimenow_42']);
$datenow_42 = $ex_data_datetimenow_42[0];

$data_datetimenow_43 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_43`", $conn));
$ex_data_datetimenow_43 = explode(" ", $data_datetimenow_43['datetimenow_43']);
$datenow_43 = $ex_data_datetimenow_43[0];

$data_datetimenow_44 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_44`", $conn));
$ex_data_datetimenow_44 = explode(" ", $data_datetimenow_44['datetimenow_44']);
$datenow_44 = $ex_data_datetimenow_44[0];

$data_datetimenow_45 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_45`", $conn));
$ex_data_datetimenow_45 = explode(" ", $data_datetimenow_45['datetimenow_45']);
$datenow_45 = $ex_data_datetimenow_45[0];

$data_datetimenow_46 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_46`", $conn));
$ex_data_datetimenow_46 = explode(" ", $data_datetimenow_46['datetimenow_46']);
$datenow_46 = $ex_data_datetimenow_46[0];

$data_datetimenow_47 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_47`", $conn));
$ex_data_datetimenow_47 = explode(" ", $data_datetimenow_47['datetimenow_47']);
$datenow_47 = $ex_data_datetimenow_47[0];

$data_datetimenow_48 = mysql_fetch_array(mysql_query("SELECT NOW() as `datetimenow_48`", $conn));
$ex_data_datetimenow_48 = explode(" ", $data_datetimenow_48['datetimenow_48']);
$datenow_48 = $ex_data_datetimenow_48[0];


//datetime acara
$ex_post_tanggal_acara = isset($_POST['tanggal_acara']) ? explode("/", $_POST['tanggal_acara']) : "";
$post_tanggal_acara = $ex_post_tanggal_acara != '' ? implode("-", array($ex_post_tanggal_acara[2], $ex_post_tanggal_acara[0], $ex_post_tanggal_acara[1])) : '';

$datetime_jam_0_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_0_00)) : implode(" ", array($datenow_1, $jam_0_00));
$datetime_jam_0_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_0_30)) : implode(" ", array($datenow_2, $jam_0_30));
$datetime_jam_1_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_1_00)) : implode(" ", array($datenow_3, $jam_1_00));
$datetime_jam_1_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_1_30)) : implode(" ", array($datenow_4, $jam_1_30));

$datetime_jam_2_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_2_00)) : implode(" ", array($datenow_5, $jam_2_00));
$datetime_jam_2_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_2_30)) : implode(" ", array($datenow_6, $jam_2_30));
$datetime_jam_3_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_3_00)) : implode(" ", array($datenow_7, $jam_3_00));
$datetime_jam_3_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_3_30)) : implode(" ", array($datenow_8, $jam_3_30));

$datetime_jam_4_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_4_00)) : implode(" ", array($datenow_9, $jam_4_00));
$datetime_jam_4_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_4_30)) : implode(" ", array($datenow_10, $jam_4_30));
$datetime_jam_5_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_5_00)) : implode(" ", array($datenow_11, $jam_5_00));
$datetime_jam_5_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_5_30)) : implode(" ", array($datenow_12, $jam_5_30));

$datetime_jam_6_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_6_00)) : implode(" ", array($datenow_13, $jam_6_00));
$datetime_jam_6_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_6_30)) : implode(" ", array($datenow_14, $jam_6_30));
$datetime_jam_7_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_7_00)) : implode(" ", array($datenow_15, $jam_7_00));
$datetime_jam_7_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_7_30)) : implode(" ", array($datenow_16, $jam_7_30));


$datetime_jam_8_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_8_00)) : implode(" ", array($datenow_17, $jam_8_00));
$datetime_jam_8_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_8_30)) : implode(" ", array($datenow_18, $jam_8_30));
$datetime_jam_9_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_9_00)) : implode(" ", array($datenow_19, $jam_9_00));
$datetime_jam_9_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_9_30)) : implode(" ", array($datenow_20, $jam_9_30));

$datetime_jam_10_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_10_00)) : implode(" ", array($datenow_21, $jam_10_00));
$datetime_jam_10_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_10_30)) : implode(" ", array($datenow_22, $jam_10_30));
$datetime_jam_11_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_11_00)) : implode(" ", array($datenow_23, $jam_11_00));
$datetime_jam_11_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_11_30)) : implode(" ", array($datenow_24, $jam_11_30));

$datetime_jam_12_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_12_00)) : implode(" ", array($datenow_25, $jam_12_00));
$datetime_jam_12_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_12_30)) : implode(" ", array($datenow_26, $jam_12_30));
$datetime_jam_13_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_13_00)) : implode(" ", array($datenow_27, $jam_13_00));
$datetime_jam_13_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_13_30)) : implode(" ", array($datenow_28, $jam_13_30));

$datetime_jam_14_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_14_00)) : implode(" ", array($datenow_29, $jam_14_00));
$datetime_jam_14_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_14_30)) : implode(" ", array($datenow_30, $jam_14_30));
$datetime_jam_15_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_15_00)) : implode(" ", array($datenow_31, $jam_15_00));
$datetime_jam_15_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_15_30)) : implode(" ", array($datenow_32, $jam_15_30));


$datetime_jam_16_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_16_00)) : implode(" ", array($datenow_33, $jam_16_00));
$datetime_jam_16_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_16_30)) : implode(" ", array($datenow_34, $jam_16_30));
$datetime_jam_17_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_17_00)) : implode(" ", array($datenow_35, $jam_17_00));
$datetime_jam_17_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_17_30)) : implode(" ", array($datenow_36, $jam_17_30));

$datetime_jam_18_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_18_00)) : implode(" ", array($datenow_37, $jam_18_00));
$datetime_jam_18_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_18_30)) : implode(" ", array($datenow_38, $jam_18_30));
$datetime_jam_19_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_19_00)) : implode(" ", array($datenow_39, $jam_19_00));
$datetime_jam_19_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_19_30)) : implode(" ", array($datenow_40, $jam_19_30));

$datetime_jam_20_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_20_00)) : implode(" ", array($datenow_41, $jam_20_00));
$datetime_jam_20_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_20_30)) : implode(" ", array($datenow_42, $jam_20_30));
$datetime_jam_21_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_21_00)) : implode(" ", array($datenow_43, $jam_21_00));
$datetime_jam_21_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_21_30)) : implode(" ", array($datenow_44, $jam_21_30));

$datetime_jam_22_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_22_00)) : implode(" ", array($datenow_45, $jam_22_00));
$datetime_jam_22_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_22_30)) : implode(" ", array($datenow_46, $jam_22_30));
$datetime_jam_23_00 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_23_00)) : implode(" ", array($datenow_47, $jam_23_00));
$datetime_jam_23_30 = isset($_POST['tanggal_acara']) && $_POST['tanggal_acara']!='' ? implode(" ", array($post_tanggal_acara, $jam_23_30)) : implode(" ", array($datenow_48, $jam_23_30));


	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_0_00', '$jam_0_00', '$datetime_jam_0_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_0_30', '$jam_0_30', '$datetime_jam_0_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_1_00', '$jam_1_00', '$datetime_jam_1_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_1_30', '$jam_1_30', '$datetime_jam_1_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_2_00', '$jam_2_00', '$datetime_jam_2_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_2_30', '$jam_2_30', '$datetime_jam_2_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_3_00', '$jam_3_00', '$datetime_jam_3_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_3_30', '$jam_3_30', '$datetime_jam_3_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_4_00', '$jam_4_00', '$datetime_jam_4_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_4_30', '$jam_4_30', '$datetime_jam_4_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_5_00', '$jam_5_00', '$datetime_jam_5_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_5_30', '$jam_5_30', '$datetime_jam_5_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_6_00', '$jam_6_00', '$datetime_jam_6_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_6_30', '$jam_6_30', '$datetime_jam_6_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_7_00', '$jam_7_00', '$datetime_jam_7_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_7_30', '$jam_7_30', '$datetime_jam_7_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_8_00', '$jam_8_00', '$datetime_jam_8_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_8_30', '$jam_8_30', '$datetime_jam_8_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_9_00', '$jam_9_00', '$datetime_jam_9_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_9_30', '$jam_9_30', '$datetime_jam_9_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_10_00', '$jam_10_00', '$datetime_jam_10_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_10_30', '$jam_10_30', '$datetime_jam_10_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_11_00', '$jam_11_00', '$datetime_jam_11_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_11_30', '$jam_11_30', '$datetime_jam_11_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_12_00', '$jam_12_00', '$datetime_jam_12_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_12_30', '$jam_12_30', '$datetime_jam_12_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_13_00', '$jam_13_00', '$datetime_jam_13_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_13_30', '$jam_13_30', '$datetime_jam_13_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_14_00', '$jam_14_00', '$datetime_jam_14_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_14_30', '$jam_14_30', '$datetime_jam_14_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_15_00', '$jam_15_00', '$datetime_jam_15_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_15_30', '$jam_15_30', '$datetime_jam_15_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_16_00', '$jam_16_00', '$datetime_jam_16_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_16_30', '$jam_16_30', '$datetime_jam_16_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_17_00', '$jam_17_00', '$datetime_jam_17_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_17_30', '$jam_17_30', '$datetime_jam_17_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_18_00', '$jam_18_00', '$datetime_jam_18_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_18_30', '$jam_18_30', '$datetime_jam_18_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_19_00', '$jam_19_00', '$datetime_jam_19_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_19_30', '$jam_19_30', '$datetime_jam_19_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_20_00', '$jam_20_00', '$datetime_jam_20_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_20_30', '$jam_20_30', '$datetime_jam_20_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_21_00', '$jam_21_00', '$datetime_jam_21_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_21_30', '$jam_21_30', '$datetime_jam_21_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_22_00', '$jam_22_00', '$datetime_jam_22_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_22_30', '$jam_22_30', '$datetime_jam_22_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_23_00', '$jam_23_00', '$datetime_jam_23_00', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	mysql_query("INSERT INTO `gx_vod_schedule`(`id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream`, `file_m3u8`, `kode_tv`) VALUES (NULL, '$acara_jam_23_30', '$jam_23_30', '$datetime_jam_23_30', NOW(), '$id_stream',  '', '$data_kode_tv')", $conn);
	
	
	
	
//data_save_m3u8

$dir = 'tvod/tvsctv/';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        $data_folder = array();
		while (($file = readdir($dh)) !== false) {
				//time modified
				
			if (file_exists($dir.$file)) {
			$data_folder[] = $file;
			}
        }
        closedir($dh);
    }
}

$data_akhir = end($data_folder);
$data_channel =  substr($data_akhir, 0, 6);
$data_ekstensi = substr($data_akhir, -3, 3);

$no_data_akhir = substr($data_akhir, 6, -3);

$no_data_sebelumnya = $no_data_akhir - 1;
$data_sebelumnya = $data_channel . $no_data_sebelumnya . $data_ekstensi ;

$tgl_data_akhir = date("Y-m-d H:i:s", filemtime($dir.$data_akhir));
$ex_tgl_data_akhir = explode(" ", $tgl_data_akhir);
$ex_jam_data_akhir = explode(":", $ex_tgl_data_akhir[1]);
$ex_cal_data_akhir = explode("-", $ex_tgl_data_akhir[0]);

$tgl_data_sebelumnya = date("Y-m-d H:i:s", filemtime($dir.$data_sebelumnya));
$ex_tgl_data_sebelumnya = explode(" ", $tgl_data_sebelumnya);
$ex_jam_data_sebelumnya = explode(":", $ex_tgl_data_sebelumnya[1]);
$ex_cal_data_sebelumnya = explode("-", $ex_tgl_data_sebelumnya[0]);


$mktime_data_akhir = mktime($ex_jam_data_akhir[0], $ex_jam_data_akhir[1], $ex_jam_data_akhir[2], $ex_cal_data_akhir[1], $ex_cal_data_akhir[0], $ex_cal_data_akhir[2]);
$mktime_data_akhir_m1 = mktime($ex_jam_data_sebelumnya[0], $ex_jam_data_sebelumnya[1], $ex_jam_data_sebelumnya[2], $ex_cal_data_sebelumnya[1], $ex_cal_data_sebelumnya[0], $ex_cal_data_sebelumnya[2]);

$data_jeda = $mktime_data_akhir - $mktime_data_akhir_m1;
$data_jeda_pas = round($data_jeda / 60) * 60;


$data_input_sblm_terakhir = mysql_fetch_array(mysql_query("SELECT `id_schedule` FROM `gx_vod_schedule` ORDER BY `id_schedule` DESC LIMIT 48,1", $conn));
$data_input_terakhir		= mysql_query("SELECT `id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream` FROM `gx_vod_schedule` WHERE `id_schedule`>'$data_input_sblm_terakhir[id_schedule]' ORDER BY `id_schedule` ASC LIMIT 48", $conn);
$data_perhitungan = array();
while($r_data = mysql_fetch_array($data_input_terakhir)){
if($r_data['schedule_acara'] != ''){

$jam_schedule		= $r_data['jam'];
$datetime_schedule	= $r_data['datetime'];
$explode_datetime 	= explode(" ", $r_data['datetime']); 
$datetime_pas_schedule = implode(" ", array($explode_datetime[0], $jam_schedule));

$ex_datetime_pas_schedule = explode(" ", $datetime_pas_schedule);
$ex_calendar_pas_schedule = explode("-", $ex_datetime_pas_schedule[0]);
$ex_jam_pas_schedule = explode(":", $ex_datetime_pas_schedule[1]);
$h_ps = $ex_jam_pas_schedule[0];
$i_ps = $ex_jam_pas_schedule[1];
$s_ps = $ex_jam_pas_schedule[2];
$d_ps = $ex_calendar_pas_schedule[2];
$m_ps = $ex_calendar_pas_schedule[1];
$y_ps = $ex_calendar_pas_schedule[0];
$mktime_dps = mktime($h_ps, $i_ps, $s_ps, $m_ps, $d_ps, $y_ps);

$data_selanjutnya = mysql_fetch_array(mysql_query("SELECT `id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream` FROM `gx_vod_schedule` WHERE `id_schedule`>'$r_data[id_schedule]' AND `schedule_acara`!='' ORDER BY `id_schedule` ASC LIMIT 1", $conn));
$jam_schedule_selanjutnya		= $data_selanjutnya['jam'];
$datetime_schedule_selanjutnya	= $data_selanjutnya['datetime'];
$explode_datetime_selanjutnya 	= explode(" ", $data_selanjutnya['datetime']); 
$datetime_pas_schedule_selanjutnya = implode(" ", array($explode_datetime_selanjutnya[0], $jam_schedule_selanjutnya));

if($jam_schedule_selanjutnya == ''){

$data_selanjutnya = mysql_fetch_array(mysql_query("SELECT `id_schedule`, `schedule_acara`, `jam`, `datetime`, `dateadd`, `id_stream` FROM `gx_vod_schedule` WHERE `id_schedule`>'$data_input_sblm_terakhir[id_schedule]'  AND `schedule_acara`!='' ORDER BY `id_schedule` ASC LIMIT 1", $conn));
$jam_schedule_selanjutnya		= $data_selanjutnya['jam'];


$explode_data_selanjutnya = explode(" ", $data_selanjutnya['datetime']);
$explode_calendar_data_selanjutnya = explode("-", $explode_data_selanjutnya[0]);
$explode_jam_data_selanjutnya = explode(":", $explode_data_selanjutnya[1]);
$datetime_schedule_selanjutnya	= date("Y-m-d H:i:s", mktime($explode_jam_data_selanjutnya[0], $explode_jam_data_selanjutnya[1], $explode_jam_data_selanjutnya[2], $explode_calendar_data_selanjutnya[1], ($explode_calendar_data_selanjutnya[2] + 1), $explode_calendar_data_selanjutnya[0]));


$explode_datetime_selanjutnya 	= explode(" ", $datetime_schedule_selanjutnya); 
$datetime_pas_schedule_selanjutnya = implode(" ", array($explode_datetime_selanjutnya[0], $jam_schedule_selanjutnya));

$ex_datetime_pas_schedule_selanjutnya = explode(" ", $datetime_pas_schedule_selanjutnya);
$ex_calendar_pas_schedule_selanjutnya = explode("-", $ex_datetime_pas_schedule_selanjutnya[0]);
$ex_jam_pas_schedule_selanjutnya = explode(":", $ex_datetime_pas_schedule_selanjutnya[1]);
$h_pss = $ex_jam_pas_schedule_selanjutnya[0];
$i_pss = $ex_jam_pas_schedule_selanjutnya[1];
$s_pss = $ex_jam_pas_schedule_selanjutnya[2];
$d_pss = $ex_calendar_pas_schedule_selanjutnya[2];
$m_pss = $ex_calendar_pas_schedule_selanjutnya[1];
$y_pss = $ex_calendar_pas_schedule_selanjutnya[0];
$mktime_dpss = mktime($h_pss, $i_pss, $s_pss, $m_pss, $d_pss, $y_pss);

}
else{
$ex_datetime_pas_schedule_selanjutnya = explode(" ", $datetime_pas_schedule_selanjutnya);
$ex_calendar_pas_schedule_selanjutnya = explode("-", $ex_datetime_pas_schedule_selanjutnya[0]);
$ex_jam_pas_schedule_selanjutnya = explode(":", $ex_datetime_pas_schedule_selanjutnya[1]);
$h_pss = $ex_jam_pas_schedule_selanjutnya[0];
$i_pss = $ex_jam_pas_schedule_selanjutnya[1];
$s_pss = $ex_jam_pas_schedule_selanjutnya[2];
$d_pss = $ex_calendar_pas_schedule_selanjutnya[2];
$m_pss = $ex_calendar_pas_schedule_selanjutnya[1];
$y_pss = $ex_calendar_pas_schedule_selanjutnya[0];
$mktime_dpss = mktime($h_pss, $i_pss, $s_pss, $m_pss, $d_pss, $y_pss);
}





$tgl_jam_start = $datetime_pas_schedule; //start sebagai awal nominal video
$tgl_jam_next = $datetime_pas_schedule_selanjutnya ; // untuk pelengkap perhitungan durasi waktu
$durasi_waktu = $mktime_dpss - $mktime_dps; // hitung waktu durasi
$durasi_pas = round($durasi_waktu / 60) * 60;
$data_jumlah_file_streaming = $durasi_pas / $data_jeda_pas;



//tentukan jarak streaming terakhir dengan tgl_jam_start
//mktime data start schedule
$ex_data_akhir_streaming = explode(" ", $tgl_data_akhir);
$ex_data_jam_akhir_streaming = explode(":", $ex_data_akhir_streaming[1]);
$ex_data_calendar_akhir_streaming = explode("-", $ex_data_akhir_streaming[0]);
$h_as = $ex_data_jam_akhir_streaming[0];
$i_as = $ex_data_jam_akhir_streaming[1];
$s_as = $ex_data_jam_akhir_streaming[2];
$y_as = $ex_data_calendar_akhir_streaming[0];
$m_as = $ex_data_calendar_akhir_streaming[1];
$d_as = $ex_data_calendar_akhir_streaming[2];
$mktime_data_akhir_streaming = mktime($h_as, $i_as, $s_as, $m_as, $d_as, $y_as);
$mktime_data_akhir_streaming_pas = round($mktime_data_akhir_streaming / 60) * 60;
$selisih_streaming_akhir_dgn_tgl_start_schedule = $mktime_dps - $mktime_data_akhir_streaming_pas;

//cari no awal file schedule
$dir_m3u8 = 'tvod/m3u8/';
$no_awal_file_m3u8 = $no_data_akhir + ($selisih_streaming_akhir_dgn_tgl_start_schedule / $data_jeda_pas);

$my_file = $dir_m3u8 . $data_channel . $no_awal_file_m3u8 . '.m3u8';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
$data = '#EXTM3U
#EXTINF:'.$no_awal_file_m3u8.',
' . $data_channel . $no_awal_file_m3u8 .  $data_ekstensi ;

//echo "data no file awal schedule : ". $no_awal_file_m3u8 ."<br>";
for($isi_m3u8=1; $isi_m3u8<=$data_jumlah_file_streaming; $isi_m3u8++){
//echo "" . $data_channel . ($no_awal_file_m3u8 + $isi_m3u8) .  $data_ekstensi . "<br>";
	$data .= '
	#EXTINF:'.($no_awal_file_m3u8 + $isi_m3u8).',
'. $data_channel . ($no_awal_file_m3u8 + $isi_m3u8) .  $data_ekstensi;
}


fwrite($handle, $data);

$file_m3u8_input = $data_channel .$no_awal_file_m3u8 . '.m3u8';
mysql_query("UPDATE `gx_vod_schedule` SET `file_m3u8`='$file_m3u8_input' WHERE `id_schedule`='$r_data[id_schedule]'", $conn);



//$data_video_file_m3u8[] = array(''=>,''=>);

}
}

//tutup save m3u8
	
	
	
	
	}
	
	
	
	
$content = '';
		
$content .= '                <!-- Main content -->
                <section class="content">
		     <div class="row">
                        <div class="col-lg-12">';
			          
		
$content .= '
 <link rel="stylesheet" href="demos/jquery-ui.css">
<script src="demos/external/jquery/jquery.js"></script>
<script src="demos/jquery-ui.js"></script>
<link rel="stylesheet" href="demos/style.css">
<script>
$(function() {
$( "#datepicker" ).datepicker();
});
</script>
      <div class="box">
    <div class="box-header">
    </div>
    
    <div class="box-body">
      <div id="tab-general" style="display: block;">
      <form action="" method="post" name="form_schedule" id="form_schedule"  method="post" enctype="multipart/form-data">
<table>
<tr><td>Tanggal</td><td><input type="text" name="tanggal_acara" id="datepicker"></td></tr>
<tr><td>Channel</td><td>
<select name="id_stream">';
$sql_stream = mysql_query("SELECT `id`,`channel` FROM `gx_tv_stream` ORDER BY `channel` ASC;", $conn);
while($row_stream = mysql_fetch_array($sql_stream)){
$content .= '<option value="'.$row_stream['id'].'">'.$row_stream['channel'].'</option>';
}
$content .= '
</select>
</td></tr>
</table>
<table>
<tr><td>no</td><td>jam</td><td>acara</td></tr>
<tr><td>1</td><td><input type="text" name="jam_0_00" value="00:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_0_00" value=""></td></tr>
<tr><td>2</td><td><input type="text" name="jam_0_30" value="00:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_0_30" value=""></td></tr>
<tr><td>3</td><td><input type="text" name="jam_1_00" value="01:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_1_00" value=""></td></tr>
<tr><td>4</td><td><input type="text" name="jam_1_30" value="01:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_1_30" value=""></td></tr>
<tr><td>5</td><td><input type="text" name="jam_2_00" value="02:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_2_00" value=""></td></tr>
<tr><td>6</td><td><input type="text" name="jam_2_30" value="02:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_2_30" value=""></td></tr>
<tr><td>7</td><td><input type="text" name="jam_3_00" value="03:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_3_00" value=""></td></tr>
<tr><td>8</td><td><input type="text" name="jam_3_30" value="03:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_3_30" value=""></td></tr>
<tr><td>9</td><td><input type="text" name="jam_4_00" value="04:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_4_00" value=""></td></tr>
<tr><td>10</td><td><input type="text" name="jam_4_30" value="04:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_4_30" value=""></td></tr>
<tr><td>11</td><td><input type="text" name="jam_5_00" value="05:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_5_00" value=""></td></tr>
<tr><td>12</td><td><input type="text" name="jam_5_30" value="05:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_5_30" value=""></td></tr>
<tr><td>13</td><td><input type="text" name="jam_6_00" value="06:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_6_00" value=""></td></tr>
<tr><td>14</td><td><input type="text" name="jam_6_30" value="06:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_6_30" value=""></td></tr>
<tr><td>15</td><td><input type="text" name="jam_7_00" value="07:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_7_00" value=""></td></tr>
<tr><td>16</td><td><input type="text" name="jam_7_30" value="07:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_7_30" value=""></td></tr>
<tr><td>17</td><td><input type="text" name="jam_8_00" value="08:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_8_00" value=""></td></tr>
<tr><td>18</td><td><input type="text" name="jam_8_30" value="08:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_8_30" value=""></td></tr>
<tr><td>19</td><td><input type="text" name="jam_9_00" value="09:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_9_00" value=""></td></tr>
<tr><td>20</td><td><input type="text" name="jam_9_30" value="09:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_9_30" value=""></td></tr>
<tr><td>21</td><td><input type="text" name="jam_10_00" value="10:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_10_00" value=""></td></tr>
<tr><td>22</td><td><input type="text" name="jam_10_30" value="10:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_10_30" value=""></td></tr>
<tr><td>23</td><td><input type="text" name="jam_11_00" value="11:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_11_00" value=""></td></tr>
<tr><td>24</td><td><input type="text" name="jam_11_30" value="11:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_11_30" value=""></td></tr>
<tr><td>25</td><td><input type="text" name="jam_12_00" value="12:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_12_00" value=""></td></tr>
<tr><td>26</td><td><input type="text" name="jam_12_30" value="12:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_12_30" value=""></td></tr>
<tr><td>27</td><td><input type="text" name="jam_13_00" value="13:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_13_00" value=""></td></tr>
<tr><td>28</td><td><input type="text" name="jam_13_30" value="13:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_13_30" value=""></td></tr>
<tr><td>29</td><td><input type="text" name="jam_14_00" value="14:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_14_00" value=""></td></tr>
<tr><td>30</td><td><input type="text" name="jam_14_30" value="14:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_14_30" value=""></td></tr>
<tr><td>31</td><td><input type="text" name="jam_15_00" value="15:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_15_00" value=""></td></tr>
<tr><td>32</td><td><input type="text" name="jam_15_30" value="15:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_15_30" value=""></td></tr>
<tr><td>33</td><td><input type="text" name="jam_16_00" value="16:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_16_00" value=""></td></tr>
<tr><td>34</td><td><input type="text" name="jam_16_30" value="16:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_16_30" value=""></td></tr>
<tr><td>35</td><td><input type="text" name="jam_17_00" value="17:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_17_00" value=""></td></tr>
<tr><td>36</td><td><input type="text" name="jam_17_30" value="17:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_17_30" value=""></td></tr>
<tr><td>37</td><td><input type="text" name="jam_18_00" value="18:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_18_00" value=""></td></tr>
<tr><td>38</td><td><input type="text" name="jam_18_30" value="18:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_18_30" value=""></td></tr>
<tr><td>39</td><td><input type="text" name="jam_19_00" value="19:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_19_00" value=""></td></tr>
<tr><td>40</td><td><input type="text" name="jam_19_30" value="19:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_19_30" value=""></td></tr>
<tr><td>41</td><td><input type="text" name="jam_20_00" value="20:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_20_00" value=""></td></tr>
<tr><td>42</td><td><input type="text" name="jam_20_30" value="20:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_20_30" value=""></td></tr>
<tr><td>43</td><td><input type="text" name="jam_21_00" value="21:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_21_00" value=""></td></tr>
<tr><td>44</td><td><input type="text" name="jam_21_30" value="21:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_21_30" value=""></td></tr>
<tr><td>45</td><td><input type="text" name="jam_22_00" value="22:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_22_00" value=""></td></tr>
<tr><td>46</td><td><input type="text" name="jam_22_30" value="22:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_22_30" value=""></td></tr>
<tr><td>47</td><td><input type="text" name="jam_23_00" value="23:00:00"></td><td><input type="text" placeholder="acara" name="acara_jam_23_00" value=""></td></tr>
<tr><td>48</td><td><input type="text" name="jam_23_30" value="23:30:00"></td><td><input type="text" placeholder="acara" name="acara_jam_23_30" value=""></td></tr>
<tr><td colspan="3"><input type="submit" name="insert" value="insert"></td></tr>
</form>
</tr></tbody>
        </table>
</div>
      
      
    </div>
  </div>
               </section><!-- /.content -->';




    $title	= 'User Group';
    $submenu	= "system_user";
    $plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
      
echo $template;
      }else{
        header("location: index.php");
      }
    }else{
        header("location: logout.php");
    }
  }

}else{
    header("location: logout.php");
}

?>