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


if(isset($_POST["search"])){
  $filter_name = (isset($_POST["filter_name"])) ? strip_tags(trim($_POST["filter_name"])) : "";
  
  $sql_movies = mysql_query("SELECT * FROM `gx_vod_movies` WHERE `title` LIKE '".$filter_name."%' AND `level`='0' ORDER BY `id_movies` DESC", $conn);
  $sql_sum_movies = mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_movies` WHERE `title` LIKE '".$filter_name."%' AND `level`='0';", $conn));
  $hal = "?";
  
}elseif(isset($_POST["filter_name"]) || isset($_GET["name"])){
  $filter_name = (isset($_POST["filter_name"])) ? strip_tags(trim($_POST["filter_name"])) : "";
  $filter_name = (isset($_GET["filter_name"])) ? strip_tags(trim($_GET["filter_name"])) : "";
  
  
  $sql_movies = mysql_query("SELECT * FROM `gx_vod_movies` WHERE `title` LIKE '%".$filter_name."%' AND `level` = '0' ORDER BY `id_movies` DESC;", $conn);
  $sql_sum_movies = mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_movies` WHERE `title` LIKE '%".$filter_name."%' AND `level` = '0' ;", $conn));
  $hal = "?name=$filter_name&";
  
}else{
  
  $sql_movies = mysql_query("SELECT * FROM `gx_vod_movies` WHERE `level`='0' ORDER BY `id_movies` DESC", $conn);
  $sql_sum_movies = mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_movies` WHERE `level`='0'", $conn));
  $hal = "?";
}

$content    ='<section class="content-header">
                    <h1>
                        Member 
                        
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
  $content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Member</h2>
                                </div>
  <form action="movies.php" method="post" name="form" id="form">
      <h1><img src="image/customer.png" alt="" /></h1>
      <div class="buttons"><a href="form_movies.php" onclick="" class="button">Insert New</a>
      <a onclick="$(\'#form\').submit();" class="button">Delete</a></div>
   
    <!-- halamaan -->
    <!-- /halamaan -->
    <table border="0">
      <tr>
        <td><input type="text" name="filter_name" value=""></td>
        <td><input type="submit" name="search" value="Search"></td>
      </tr>
      
    </table>
    
    
        <table id="paket" class="table table-bordered table-striped">
                                        <thead>
                
            <tr>
              <td class="left">No.</td>
              <td class="left">Movies Name</td>
              <td class="left">Sinopsis</td>
              <!--<td class="left">URL Movies</td>-->
              <td class="left">Limit Viewed</td>
              <td class="left" style="width:120px;">Date Added</td>
              <td class="right">Action</td>
            </tr>
          </thead>
          <tbody>
            ';

$no =  1;

while($row_movies = mysql_fetch_array($sql_movies)){

$content .='<tr>
              <td class="left">'.$no.'.</td>
              <td class="left"><img width="100" src="../vod/'.$row_movies["thumb"].'" alt="'.$row_movies["title"].' " /><br><b>'.$row_movies["title"].'</b></td>
              <td class="left">'.$row_movies["sinopsis"].'</td>
              <!--<td class="left"><b>Movie HD</b>: '.$row_movies["url_hd"].'<br>
              <b>Movie SD</b>: '.$row_movies["url_sd"].'<br>
              <b>Movie 3D</b>: '.$row_movies["url_3d"].'<br>
              <b>Movie Trailer</b>: '.$row_movies["url_trailer"].'
              </td>-->
              <td class="left">'.$row_movies["view_limit"].'</td>
              <td class="left">'.$row_movies["date_added"].'</td>
              <td class="left"><a href="form_movies.php?id='.$row_movies["id_movies"].'" title="Edit '.$row_movies["title"].'">Edit</a><a href="?delete_id='.$row_movies["id_movies"].'" title="Delete '.$row_movies["title"].'">Delete</a>
                </td>
            </tr>';
            $no++;
}


$content .='</tbody>
        </table>
      </form>
      <!-- halamaan -->
    <!-- /halamaan -->
                           </div>
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
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>