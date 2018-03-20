<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Brosur");
    global $conn;
    
    $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
  
    $content ='<section class="content-header">
                    <h1>
                        Data Brosur
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Data Brosur</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        <form action="" method="post" name="form_search" id="form_search">
		<!--<table class="form" width="80%">
		      <tr>
			<td>
			  <label>User ID *</label>
			</td>
			<td>
			  <input class="form-control" name="voip_number" placeholder="Voip Number" type="text" value="">
			</td>
		      </tr>
		      
		      <tr>
			<td>&nbsp;</td>
			<td>
			  <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
			</td>
		      </tr>
		</table>-->';
		
if(isset($_POST["save_search"])){
	
}else{
 $sql_brosur	= "SELECT * FROM `gx_brosur` WHERE `level` = '0' ORDER BY `id_brosur` ASC LIMIT 0,10;";
}
		$content .='<table class="table table-bordered table-striped" id="customer">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode brosur</th>
		    <th>Nama Brosur</th>
		    <th>Date Add</th>
		    <th>User Add</th>
		    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';


$query_brosur	= mysql_query($sql_brosur, $conn);
$no = 1;
if(isset($_GET["f"])){
 if($_GET["f"] == "proposal"){
  while ($row_brosur = mysql_fetch_array($query_brosur)) {
   $sql_brosur_d	= "SELECT * FROM `gx_brosur_detail`	WHERE `id_brosur` = '".$row_brosur["id_brosur"]."' AND `level` = '0';";
   $query_brosur_d	= mysql_query($sql_brosur_d, $conn);
   $row_brosur_d = mysql_fetch_array($query_brosur_d);
	 $content .='<tr>
		     <td>'.$no.'</td>
		     <td>'.$row_brosur["kode_brosur"].'</td>
		     <td><a class="ajax" href="'.URL_ADMIN.''.$row_brosur_d["lokasi_file"].''.$row_brosur_d["nama_file"].'" title="">'.$row_brosur["nama_brosur"].'</a></td>
		     <td>'.$row_brosur["date_add"].'</td>
		     <td>'.$row_brosur["user_add"].'</td>
		     <td>
		       <a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_brosur["kode_brosur"]).'\')">Select</a>
		     </td>
		   </tr>';
	 $no++;
     }
 }
}else{
   
}
		
                  $content .='
                  
                </tbody>
              </table>';


$content .='
</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
		<link rel="stylesheet" href="../../../js/colorbox/example1/colorbox.css" />
		<script src="../../../js/colorbox/jquery.colorbox.js"></script>
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
if(isset($_GET["f"])){
 if($_GET["f"] == "proposal"){
  $plugins .= '
 <script type="text/javascript">
   
	 function validepopupform2(kodebrosur){
		 window.opener.document.'.$return_form.'.kode_brosur.value=kodebrosur;
		 
		 self.close();
	 }
 </script>
 
     ';
 }
}else{

}


    $title	= 'Data Brosur';
    $submenu	= "proposal";
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