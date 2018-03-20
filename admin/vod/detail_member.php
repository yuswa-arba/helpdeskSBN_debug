<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;

/*  $sql_tv = mysql_query("SELECT *
				  FROM `gx_vod_stream`
				  WHERE `level` = '0'
				  ORDER BY `id` ASC;",$conn);   
if(isset($_POST["save_role"]))
{
    $role_menu 	= array();
    $role_menu	= isset($_POST["role_menu"]) ? $_POST["role_menu"] : $role_menu;
    $id_group	= isset($_POST["id_group"]) ? trim(strip_tags($_POST["id_group"])) : "";
    
    print_r ($role_menu);
    
    //$sql_menu = mysql_query("SELECT * FROM `gx_role_menu`", $conn);
    //delete all data first
    
    
    foreach($role_menu as $key => $value){
	$sql_menu = mysql_query("SELECT count(*) as `total` FROM `gx_vod_tvod_packages_det` WHERE `id_package` = '".$id_group."'
			    AND `id_tv` = '".$key."' LIMIT 0,1;", $conn);
	$row_menu = mysql_fetch_array($sql_menu);
	******************************************************
	  *  if($value != "on" AND $row_menu["total"] == 1){
		$sql_qroup_role = "DELETE FROM `gx_user_group_role`
		WHERE `id_group`= '".$id_group."' AND `id_menu` = '".$key."';";
		//echo "delete$key<br>";
	    }elseif($value == "on" AND $row_menu["total"] == 0){
		
		echo "Insert$key<br>";
	    }
	******************************************************
    }
    
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."system/group_role.php?id_group=".$id_group."';
	</script>";
    
//    $id_complaint = array();
//    $id_complaint = isset($_POST["id_complaint"]) ? $_POST["id_complaint"] : $id_complaint;
//    foreach($id_complaint as $key => $value){
//	    $update    = mysql_query("UPDATE `gx_complaint` SET level='1' WHERE `id_complaint`='$value'") or die(mysql_error());
//    }
//    header("location: incoming.php?type=complaint");
}
*/


if(isset($_GET["id"])){
  $id_member	= isset($_GET['id']) ? (int)$_GET['id'] : "";
  $query        = "SELECT * FROM `gx_vod_member`, `gx_vod_users` WHERE
                    `gx_vod_member`.`id_member` = `gx_vod_users`.`id_member` AND
		    `gx_vod_member`.`id_member` = '$id_member' AND
                    `gx_vod_users`.`group` = 'member' AND
		    `gx_vod_member`.`level` = '0' LIMIT 0,1";
  $hasil        = mysql_query($query, $conn);
  $data         = mysql_fetch_array($hasil);
  
  //SQL LAST TRANSAKSI
  $sql_last_transaksi = mysql_query("SELECT `gx_vod_transaksi`.*, `gx_vod_movies`.`title` FROM `gx_vod_transaksi`, `gx_vod_movies`
			WHERE `gx_vod_transaksi`.`id_movie` =  `gx_vod_movies`.`id_movies`
                        AND `gx_vod_transaksi`.`tgl_beli` LIKE '".date("Y-m-")."%'
			AND `gx_vod_transaksi`.`id_member` = '$id_member'
			AND `gx_vod_transaksi`.`level` = '0'
			ORDER BY `gx_vod_transaksi`.`id_transaksi` DESC LIMIT 0,5;", $conn);

  //SUMMARY SQL LAST TRANSAKSI
  $sum_thismonth_transaksi = mysql_num_rows(mysql_query("SELECT `gx_vod_transaksi`.*, `gx_vod_movies`.`title` FROM `gx_vod_transaksi`, `gx_vod_movies`
			WHERE `gx_vod_transaksi`.`id_movie` =  `gx_vod_movies`.`id_movies`
                        AND `gx_vod_transaksi`.`tgl_beli` LIKE '".date("Y-m-")."%'
			AND `gx_vod_transaksi`.`id_member` = '$id_member'
			AND `gx_vod_transaksi`.`level` = '0'", $conn));
  
  $sum_last_transaksi = mysql_num_rows($sql_last_transaksi);
  
  //SQL LOG VIEW
  $sql_log_view = mysql_query("SELECT `gx_vod_log_view_movie`.*, `gx_vod_movies`.`title` FROM `gx_vod_log_view_movie`, `gx_vod_movies`
			WHERE `gx_vod_log_view_movie`.`id_movie` =  `gx_vod_movies`.`id_movies`
                        AND `gx_vod_log_view_movie`.`date_view` LIKE '".date("Y-m-")."%'
			AND `gx_vod_log_view_movie`.`id_member` = '$id_member'
			AND `gx_vod_log_view_movie`.`level` = '0'
			ORDER BY `id_log_view_movie` DESC LIMIT 0,5;", $conn);
  $sum_log_view = mysql_num_rows($sql_log_view);
  
  //SQL TOPUP
  $sql_topup	= mysql_query("SELECT * FROM `gx_vod_topup` WHERE `id_member` = '$id_member'
		  AND `level` = '0' AND `date_added` LIKE '".date("Y-m-")."%'
		  LIMIT 0,5;", $conn);
  $sum_topup	= mysql_num_rows($sql_topup);
  $sum_thismonth_topup	= mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_topup` WHERE `id_member` = '$id_member'
		  AND `level` = '0' AND `date_added` LIKE '".date("Y-m-")."%'", $conn));
  
  //SQL PACKAGE
  $sql_package	= mysql_query("SELECT  `gx_vod_transaksi` . * ,  `gx_vod_packages` . * 
			FROM  `gx_vod_packages` ,  `gx_vod_member` ,  `gx_vod_transaksi` 
			WHERE  `gx_vod_transaksi`.`id_packages` =  `gx_vod_packages`.`id_packages` 
			AND `gx_vod_transaksi`.`id_member` =  `gx_vod_member`.`id_member`
			AND `gx_vod_transaksi`.`id_member` = '".$id_member."'
			AND  `gx_vod_transaksi`.`tgl_expired` >  '".date("Y-m-d H:i:s")."'
			LIMIT 0 , 1;", $conn);
  $row_package	= mysql_fetch_array($sql_package);
  
  //SQL LAST ACTIVITY
  $last_activity = mysql_fetch_array(mysql_query("SELECT * FROM `gx_vod_sessions` WHERE `uid` = '$id_member'
						 ORDER BY `id` DESC LIMIT 1,1", $conn));

  //SQL VIRTUAL ACCOUNT
  $sql_account = mysql_query("SELECT * FROM `gx_vod_virtual_account`, `gx_vod_member` WHERE `gx_vod_member`.`id_member` = `gx_vod_virtual_account`.`id_member`
                             AND `gx_vod_virtual_account`.`level`='0' AND `gx_vod_virtual_account`.`id_member` = '$id_member' LIMIT 0,1;", $conn);
  $row_account	= mysql_fetch_array($sql_account);

//$query_package  = mysql_query("SELECT * FROM `packages` WHERE `packages`.`level` = '0' ORDER BY `id_packages` ASC");



    $content ='<section class="content-header">
                    <h1>
                        Detail Member 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="system_user"> User Group</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    
			    ';

    $sql_member = mysql_query("SELECT * FROM `gx_vod_member`,`gx_vod_users`, `gx_vod_port`
                            WHERE `gx_vod_users`.`id_member` = `gx_vod_member`.`id_member` AND
                            `gx_vod_member`.`id_port` = `gx_vod_port`.`id_port` AND
                            `gx_vod_users`.`group` = 'member'",$conn);
    
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Member</h2>
                                </div>';
				
$content .= '<form action="" method="post" name="form_member" id="form_member">
        <table style="width:100%;">
        <tbody style="vertical-align:top;">
        <tr valig="top">
          <td style="width:60%;">
          
          <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Member Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <tbody><tr>
                <td>Name:</td>
                <td>'.(isset($_GET['id']) ? strip_tags(trim($data["first_name"])).' '.strip_tags(trim($data["last_name"])) : "").'</td>
		<td>Last activity:</td>
                <td>'.$last_activity["waktu"].'</td>
              </tr>
              <tr>
                <td>Address:</td>
                <td>'.(isset($_GET['id']) ? strip_tags(trim($data["address"])) : "").'</td>
		<td>Last Saldo:</td>
                <td>'.Rupiah($data["saldo"]).'</td>
              </tr>
              <tr>
                <td>E-Mail:</td>
                <td>'.(isset($_GET['id']) ? strip_tags(trim($data["email"])) : "").'</td>
		<td>Package:</td>
                <td>';
		if(mysql_num_rows($sql_package)){
		  $content .='<a href="detail_package.php?id='.$id_member.'" class="package">'.$row_package["name_package"].'</a> ( Expired: '.$row_package["tgl_expired"].' )';
		}else{
		  $content .=' No Pacakage';
		}
		$content .='</td>
              </tr>
	      <tr>
                <td>&nbsp;</td>
                <td><a href="form_member.php?id='.$data["id_member"].'">Edit</a></td>
              </tr>
	    </table>
            </div><!-- /.box-body -->
                            </div><!-- /.box -->
	    <div class="box-header">
            <h3 class="box-title">Data This Month</h3>
	    </div>
            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Last Transaction</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
             <span style="text-align:right;">Total Data: '.$sum_thismonth_transaksi.' '; /*( <a href="detail_package.php?id='.$id_member.'&transaksi=movie" class="package">view all</a> )*/ $content .= '</span>
	    <div style="text-align:right;margin:10px 0;">
	    ';
	    /*<a href="pdf.php?id_member='.$id_member.'" target="_blank">Generate pdf bulan ini</a></div>*/
	      $content.='<table class="table table-condensed">
	      <thead>
            <tr>
              <td class="left">No.</td>
              <td class="left">Movie</td>
              <td class="left">Tgl Beli</td>
              <td class="left">Tgl Expired</td>
              <td class="left">Type</td>
              <td class="left">Harga</td>
            </tr>
          </thead>
          ';

	  if($sum_last_transaksi > 0){
$noa = 1;
while($row_last_transaksi = mysql_fetch_array($sql_last_transaksi)){
  $content .='<tr>
              <td>'.$noa.'.</td>
              <td>'.$row_last_transaksi["title"].'</td>
              <td>'.$row_last_transaksi["tgl_beli"].'</td>
              <td>'.$row_last_transaksi["tgl_expired"].'</td>
              <td>'.$row_last_transaksi["type"].'</td>
              <td>'.Rupiah($row_last_transaksi["price"]).'</td>
              
            </tr>';
	    $noa++;
}
	  }else{
	    $content .='<tr>
              <td colspan="6">NO DATA</td>
	      </tr>';
	  }
$content .='

</table>
</div>
</div>
 <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Last View Movies</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
	      <table class="list">
	      <thead>
            <tr>
              <td class="left">No.</td>
              <td class="left">Movie</td>
              <td class="left">Tanggal</td>
              <td class="left">IP/MAC address</td>
            </tr>
          </thead>
          ';
$nob = 1;
	  if($sum_log_view > 0){
while($row_log_view = mysql_fetch_array($sql_log_view)){
  $content .='<tr>
              <td>'.$nob.'.</td>
              <td>'.$row_log_view["title"].'</td>
              <td>'.$row_log_view["date_view"].'</td>
              <td>'.$row_log_view["ip_address"].'/'.$row_log_view["mac_address"].'</td>
            </tr>';
	    $nob++;
}
	  }else{
	    $content .='<tr>
              <td colspan="4">NO DATA</td>
	      </tr>';
	  }
$content .='</table>
</div></div>
	       <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Last Topup saldo <!--( '.$sum_thismonth_topup.' )--></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <thead>
            <tr>
              <td class="left">No.</td>
              <td class="left">Method Payment</td>
              <td class="left">Nominal</td>
              <td class="left">Tanggal</td>
              <!--<td class="left">User Input<td>-->
            </tr>
          </thead>
          ';

$noc = 1;
	  if($sum_topup > 0){
while($row_topup = mysql_fetch_array($sql_topup)){
  $content .='<tr>
              <td>'.$noc.'.</td>
              <td>'.$row_topup["method_payment"].'</td>
              <td>'.Rupiah($row_topup["saldo"]).'</td>
              <td>'.$row_topup["date_added"].'</td>
            </tr>';
	    $noc++;
}
	  }else{
	    $content .='<tr>
              <td colspan="4">NO DATA</td>
	      </tr>';
	  }
$content .='
            <!--<span style="text-align:right;">Total Data: '.$sum_thismonth_topup.' ( view all )</span>-->
	      </table>
              
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
          </td>
          <td>
	  <div style="margin-left:30px;">
	                              <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Virtual Account info</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">              <tr>
                <td>Virtual Account:</td>
                <td>'.(isset($_GET['id']) ? strip_tags(trim($row_account["name_account"])) : "-").'</td>
              </tr>
	      <tr>
                <td>Virtual Account Number:</td>
                <td>'.(isset($_GET['id']) ? strip_tags(trim($row_account["norek_account"])) : "-").'</td>
              </tr>
	      <tr>
                <td>Virtual Account Bank:</td>
                <td>'.(isset($_GET['id']) ? strip_tags(trim($row_account["bank_name"])) : "-").'</td>
              </tr>';
/*	      <tr>
                <td></td>
                <td><a href="form_account.php?id='.$row_account["id_account"].'">Edit</a></td>
              </tr>
              */
$content .= '
	    </table>
            </div></div>
	    </div>
	  ';
	
        if(isset($_GET['id'])){
          $content .='<input type="hidden" name="id_member" value="'.(int)$_GET['id'].'">';
        }
$content .='</td>
        </tr></tbody>
        </table></form>';                                
$content .= '                        </div>
                    </div>

                </section><!-- /.content -->
            ';

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
}
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>