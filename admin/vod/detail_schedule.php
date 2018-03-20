<?php
session_start();
ob_start();


//file configuration for database and create session.
include ("../../config/configuration_admin.php");
redirectToHTTPS();

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
    
    global $conn;
    global $conn_voip;



$title      = "Detail Schedule";
$plugins    = '';

if(isset($_GET['id_detail'])){
  unset($_SESSION['id_detail']);
  $_SESSION['id_detail'] = $_GET['id_detail'];
  }

  $id_schedule = isset($_GET['id_detail']) ? $_GET['id_detail'] : $_SESSION['id_detail'];

  $data_dateadd = mysql_fetch_array(mysql_query("SELECT `dateadd` FROM `gx_vod_schedule` WHERE `id_schedule`='$id_schedule'", $conn));

  $sql_schedule = mysql_query("SELECT * FROM `gx_vod_schedule`,`gx_tv_stream` WHERE `gx_vod_schedule`.`id_stream` = `gx_tv_stream`.`id` AND `gx_vod_schedule`.`dateadd`='$data_dateadd[dateadd]' ORDER BY `gx_vod_schedule`.`id_schedule` ASC", $conn);

  $sql_sum_schedule = mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_schedule`,`gx_tv_stream` WHERE `gx_vod_schedule`.`id_stream` = `gx_tv_stream`.`id` AND `gx_vod_schedule`.`dateadd`='$data_dateadd[dateadd]' ORDER BY `gx_vod_schedule`.`id_schedule` DESC;", $conn));

$content    ='
<section class="content-header">
                    <h1>
                        '.$title.' 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="member.php">'.$title.'</a></li>
                    </ol>
                </section>';

$content .= '                <!-- Main content -->
                <section class="content">
		     <div class="row">
                        <div class="col-xs-12">';

$content .= '<div class="box">
    <div class="box-header">
    <form action="member.php" method="post" name="form" id="form">
      <div class="buttons"><a href="form_schedule.php?act=insert" onclick="" class="button">Insert New</a>
      </div>
    </div>
    <div class="box-body">
        <table id="paket" class="table table-bordered table-striped">
          <thead>
            <tr>
              <td class="left">No.</td>
			  <td class="left">Log Insert</td>
              <td class="left">Jam</td>
              <td class="left">Acara</td>
              <td class="left">Channel</td>
              <td class="right">Action</td>
            </tr>
          </thead>
          <tbody>';
            
//<input type="text" name="filter_address" value="" />
//<input type="text" name="filter_email" value="" />

$no = 1;

while($row_schedule = mysql_fetch_array($sql_schedule)){
$data_stream_channel = mysql_fetch_array(mysql_query("SELECT `channel` FROM `gx_tv_stream` WHERE `id`='$row_schedule[id_stream]'", $conn));
$content .='<tr>
              <td class="left">'.$no.'.</td>
              <td class="left">'.$row_schedule["dateadd"].'</td>
              <td class="left">'.$row_schedule["jam"].'</td>
              <td class="left">'.$row_schedule["schedule_acara"].'</td>
              <td class="left">'.$data_stream_channel["channel"].'</td>
              <td class="left"><a href="form_schedule.php?act=edit&id='.$row_schedule["id_schedule"].'">Edit</a></td>
            </tr>';
            $no++;
}

$content .='</tbody>
        </table>
      </form>
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
    $title	= 'User Group';
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