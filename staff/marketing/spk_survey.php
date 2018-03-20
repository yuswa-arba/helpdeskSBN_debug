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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master SPK Survey");
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
                        Master SPK Survey
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="spk_survey">Master SPK Survey</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">List SPK Survey</h3>
				    <a href="form_survey" class="btn bg-olive btn-flat margin pull-right">Create SPK</a>
                                </div><!-- /.box-header -->
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. Survey</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. telp</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if($loggedin["id_level"] == "Kabag"){
	$sql_mastersurvey = mysql_query("SELECT * FROM `gx_survey` WHERE `cabang` = '".$loggedin["cabang"]."' AND `level` = '0' ORDER BY `id_survey` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_mastersurvey = mysql_num_rows(mysql_query("SELECT * FROM `gx_survey` WHERE `cabang` = '".$loggedin["cabang"]."' AND `level` = '0' ORDER BY `id_survey` DESC;",$conn));
}else{
	$sql_mastersurvey = mysql_query("SELECT * FROM `gx_survey` WHERE `id_marketing` = '".$loggedin["id_employee"]."' AND `level` = '0' ORDER BY `id_survey` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_mastersurvey = mysql_num_rows(mysql_query("SELECT * FROM `gx_survey` WHERE `id_marketing` = '".$loggedin["id_employee"]."' AND `level` = '0' ORDER BY `id_survey` DESC;",$conn));
}
$hal			= "?";
$no = 1;
while ($row_mastersurvey = mysql_fetch_array($sql_mastersurvey))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_mastersurvey['no_spk_survey'].'</td>
		    <td>'.$row_mastersurvey['nama_cust'].'</td>
		    <td>'.$row_mastersurvey['alamat'].'</td>
		    <td>'.$row_mastersurvey['no_telp'].'</td>
		    <td align="center">
		    <a href="detail_survey?id_survey='.$row_mastersurvey['id_survey'].'" onclick="return valideopenerform(\'detail_survey?id_survey='.$row_mastersurvey['id_survey'].'\',\'view\');"><span class="label label-info">View</span></a> ||
		    <a href="form_survey?id_survey='.$row_mastersurvey['id_survey'].'"><span class="label label-info">Edit</span></a> ||
			<a href="spk_survey_pdf?id_spk='.$row_mastersurvey['id_survey'].'" target="_BLANK"><span class="label label-info">View PDF</span></a> ||
			<a href="form_jawab_survey?id_survey='.$row_mastersurvey['id_survey'].'"><span class="label label-info">Jawab Survey</span></a>
			
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table> 
				    
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <div class="box-tools pull-right">
				    '.(halaman($sql_total_mastersurvey, $perhalaman, 1, $hal)).'
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

    $title	= 'Master SPK Survey';
    $submenu	= "spk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>