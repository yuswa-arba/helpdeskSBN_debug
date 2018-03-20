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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
global $conn;
$perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
    
    $content ='<section class="content-header">
                    <h1>
                        Master Jawab SPK Survey
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">List Jawab SPK Survey</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				<table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. Jawab Survey</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. telp</th>
						<th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if($loggedin["id_level"] == "Kabag"){
	$sql_master_jawabsurvey 		= mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `level` = '0' ORDER BY `id_jawab_spksurvey` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_master_jawabsurvey	= mysql_num_rows(mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `level` = '0' ORDER BY `id_jawab_spksurvey` DESC;", $conn));
}else{
	$sql_master_jawabsurvey 		= mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `level` = '0' AND `user_add` = '$loggedin[username]' ORDER BY `id_jawab_spksurvey` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_master_jawabsurvey	= mysql_num_rows(mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `level` = '0'  AND `user_add` = '$loggedin[username]' ORDER BY `id_jawab_spksurvey` DESC;", $conn));
}

$hal = "?";
$no =  $start + 1;
while ($row_master_jawabsurvey = mysql_fetch_array($sql_master_jawabsurvey))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td><a href="detail_jawab_survey.php?id='.$row_master_jawabsurvey['id_jawab_spksurvey'].'"
			onclick="return valideopenerform(\'detail_jawab_survey?id='.$row_master_jawabsurvey['id_jawab_spksurvey'].'\',\'viewjawab\');">'.$row_master_jawabsurvey['no_jawab'].'</a></td>
		    <td>'.$row_master_jawabsurvey['nama'].'</td>
		    <td>'.$row_master_jawabsurvey['alamat'].'</td>
		    <td>'.$row_master_jawabsurvey['no_telp'].'</td>
		    <td>'.$row_master_jawabsurvey['date_add'].'</td>
		    
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    <div class="box-footer" align="center">
                            <div class="box-tools pull-right">
								'.(halaman($sql_total_master_jawabsurvey, $perhalaman, 1, $hal)).'
							</div>
								<br style="clear:both;">
                                    </div>
		
                            </div><!-- /.box -->
                        </div>
						
                    </div>

                </section><!-- /.content -->
            ';
	    
$plugins = '
	<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
    ';

    $title	= 'List Jawab SPK Survey';
    $submenu	= "jawab_survey";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
	
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>