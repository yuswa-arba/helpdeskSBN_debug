<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
	
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open list Survey");
    
    global $conn;
    
	$perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
     
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-header">
                                    <h3 class="box-title">List Brosur</h3>
				    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="brosur" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Kode Brosur</th>
                                                <th>Nama Brosur</th>
                                                <th>Lokasi Brosur</th>
                                                <th>Tanggal Update Terakhir</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_masterbrosur = mysql_query("SELECT * FROM `gx_brosur` WHERE `kode_cabang` = '".$loggedin["cabang"]."' AND `level` = '0' ORDER BY `id_brosur` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_masterbrosur = mysql_num_rows(mysql_query("SELECT * FROM `gx_brosur` WHERE `kode_cabang` = '".$loggedin["cabang"]."' AND `level` = '0' ORDER BY `id_brosur` DESC;",$conn));
$hal		    = "?";
$no = 1;
while ($row_masterbrosur = mysql_fetch_array($sql_masterbrosur))
{
    $sql_masterbrosur_detail = mysql_query("SELECT * FROM `gx_brosur_detail` WHERE `level` = '0' AND `id_brosur` = '$row_masterbrosur[id_brosur]' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
    $row_masterbrosur_detail = mysql_fetch_array($sql_masterbrosur_detail);
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterbrosur['kode_brosur'].'</td>
		    <td>'.$row_masterbrosur['nama_brosur'].'</td>
		    <td>'.$row_masterbrosur_detail['lokasi_file'].'</td>
		    <td>'.$row_masterbrosur['date_upd'].'</td>
		    <td align="center"><a class="ajax" href="'.URL_ADMIN.''.$row_masterbrosur_detail['lokasi_file'].''.$row_masterbrosur_detail['nama_file'].'"><span class="label label-info">View</span></a> || 
		    <a href="send_brosur?id='.$row_masterbrosur['id_brosur'].'"><span class="label label-info">Send</span></a>
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
				    '.(halaman($sql_total_masterbrosur, $perhalaman, 1, $hal)).'
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
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

		<link rel="stylesheet" href="../../js/colorbox/example1/colorbox.css" />
		<script src="../../js/colorbox/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:\'group1\'});
				$(".group2").colorbox({rel:\'group2\', transition:"fade"});
				$(".group3").colorbox({rel:\'group3\', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:\'group4\', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
					onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
					onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
					onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
					onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
				});

				$(\'.non-retina\').colorbox({rel:\'group5\', transition:\'none\'})
				$(\'.retina\').colorbox({rel:\'group5\', transition:\'none\', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
    ';

    $title	= 'Master Brosur';
    $submenu	= "brosur";
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}

    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>