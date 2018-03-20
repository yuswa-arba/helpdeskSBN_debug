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

if ($loggedin = logged_inAdmin()) //session expired time.
{ 
  if($loggedin["group"] != 'admin') 
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
  
    $title	= 'Schedule TVOD';  
    global $conn;
    global $conn_voip;

$data_tgl_skrg = mysql_fetch_array(mysql_query("SELECT NOW() AS `tgl_skrg`"));
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

$date_page  	= date("Y-m-d", mktime($tanggal_skrg_sql_h, $tanggal_skrg_sql_i, $tanggal_skrg_sql_s, $tanggal_skrg_sql_m, ($tanggal_skrg_sql_d-$page+1), $tanggal_skrg_sql_y));

  $sql_schedule = mysql_query("SELECT * FROM `gx_vod_schedule`,`gx_tv_stream` WHERE `gx_vod_schedule`.`id_stream` = `gx_tv_stream`.`id` AND `gx_vod_schedule`.`dateadd` LIKE '%$date_page%' GROUP BY `gx_vod_schedule`.`dateadd` ORDER BY `gx_vod_schedule`.`id_schedule` ASC",  $conn);

  $sql_sum_schedule = mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_schedule`,`gx_tv_stream` WHERE `gx_vod_schedule`.`id_stream` = `gx_tv_stream`.`id` ORDER BY `gx_vod_schedule`.`id_schedule` DESC;",  $conn));

$content    ='
<section class="content-header">
                    <h1>
                        '.$title.' 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="schedule.php">'.$title.'</a></li>
                    </ol>
                </section>';

$content .= '                <!-- Main content -->
                <section class="content">
		     <div class="row">
                        <div class="col-xs-12">';
			          
      
$content .= '<div class="box">
    <div class="box-header">
                                   </div>
    <div class="box-body">
  
   
      <a href="form_schedule.php?act=insert" onclick="" class="button">Insert New</a>
     
 <form action="member.php" method="post" name="form" id="form">
      <table id="paket" class="table table-bordered table-striped">
          <thead>
            <tr>
              <td class="left">No.</td>
	      <td class="left">Log Insert</td>
              <td class="left">Channel</td>
              <td class="left">Detail</td>
            </tr>
          </thead>
          <tbody>';
            
//<input type="text" name="filter_address" value="" />
//<input type="text" name="filter_email" value="" />

$no = 1;

while($row_schedule = mysql_fetch_array($sql_schedule)){
$data_stream_channel = mysql_fetch_array(mysql_query("SELECT `channel` FROM `gx_tv_stream` WHERE `id`='$row_schedule[id_stream]'",  $conn));
$content .='<tr valign="top" >
              <td class="left">'.$no.'.</td>
              <td class="left">'.$row_schedule["dateadd"].'</td>
              <td class="left">'.$data_stream_channel["channel"].'</td>
              <td class="left"><a href="detail_schedule.php?id_detail='.$row_schedule["id_schedule"].'" target="_blank">detail</a>
                </td>
            </tr>';
            $no++;
}

$content .='</tbody>
        </table>
      </form>
      '.(halaman($jumlah_data, $perhalaman, 1, "?")).'
      
      </div>
      
    </div>
  </div>

                </section><!-- /.content -->';

    
$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#paket\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
    ';


    $submenu	= "system_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
  
echo $template;
      }else{
        header("location: ../index.php");
      }
    }else{
        header("location: ../index.php");
    }
  }

}else{
    header("location: ../index.php");
}

?>