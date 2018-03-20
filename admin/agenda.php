<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){

$submit = isset($_POST["deldetagenda"]) ? $_POST["deldetagenda"] : "";
	if($submit == "Hapus"){
		$id_detagendat = array();
		$id_detagendat = isset($_POST["id_detagnda"]) ? $_POST["id_detagnda"] : $id_detagendat;
		foreach($id_detagendat as $key => $value){
			$update    = mysql_query("UPDATE `gx_detAgenda2` SET level='1' WHERE `id_detagenda`='$value'") or die(mysql_error());
		}
	//echo $query;
	
	echo "<script language='JavaScript'>
			alert('Data telah dihapus!');
			location.href = 'agenda.php';
            </script>";
	}

    $content =' <section class="content-header">
                    <h1>
                        Agenda
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Agenda</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                
                                <a href="form_agenda.php" class="btn btn-app" style="margin-top: 10px;margin-bottom: 0px;"><span class="badge bg-yellow">+</span><i class="glyphicon glyphicon-file" style="margin:0 auto; font-size:23px;"></i> New Agenda</a>
                                <hr style="border-top: 2px solid #edd;">
                                <div class="box-body table-responsive">
                                <!--<form action="agenda.php" method="post" name="form_search_agenda">
                                <table border="0" cellpadding="0" cellspacing="0" class="table">
                                        <tr>
                                                <td width="15%">Tanggal :</td>
                                                <td colspan="5" width="40%">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input style="width:200px" name="search_date" type="text" class="form-control" data-inputmask="\'alias\': \'dd/mm/yyyy\'" data-mask="">
                                                </div>
                                                           
                                                </td>
                                        </tr>
                                        <tr>
                                                <td width="15%">Title :</td>
                                                <td colspan="4" width="40%">
                                                        <input style="width:350px" type="text" placeholder="Title" name="search_title" value="" />
                                                </td>
                                                <td>
                                                
                                                <div class="button-well">
                                                        <input type="submit" class="btn btn-primary" data-icon="v" name="search_agenda" value="Search" />
                                                </div>
                                                </td>
                                        </tr>
                                </table>
                                </form>-->
                                
';

if(isset($_POST["search_agenda"])){

	$title_search		= isset($_POST["search_title"]) ? trim(strip_tags($_POST["search_title"])) : "";
	$date_search		= isset($_POST["search_date"]) ? trim(strip_tags($_POST["search_date"])) : "";

	
	if($title_search == ""){
		$sql_title_search = "";
		
	}else{
		$sql_title_search = "AND `gx_agenda2`.`title_agenda` LIKE '%$title_search%'";
		
	}
	
	if($date_search == ""){
		$sql_date_search = "";
		
	}else{
		$sql_date_search = "AND `gx_agenda2`.`date_add` LIKE '%$date_search%'";
		
	}
	
	
	/*if($date == ""){
		$date = date("Y-m-d");
	}*/
$sql_project	= "SELECT * FROM `gx_agenda2` WHERE `level` = '0' $sql_date_search $sql_title_search  ORDER BY `date_add` DESC;";
$jum_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_agenda2` WHERE `level` = '0' $sql_date_search $sql_title_search  ORDER BY `date_add` DESC;"));
}else{
    $sql_project	= "SELECT * FROM `gx_agenda2` WHERE `level` = '0' ORDER BY `date_add` DESC;";
$jum_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_agenda2` WHERE `level` = '0' ORDER BY `date_add` DESC;"));
}
$query_project	= mysql_query($sql_project);
$content .='
                                    <form action="" method="post" name="form_delagenda">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Title</th>
                                                <th>Agenda</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = $start + 1;
while ($row_project = mysql_fetch_array($query_project)) {
$content .='
                                            <tr>
                                                <td>'.$no.'</td>
                                                <td><a style="color : #4571b5;" href="detail_.php?id_detagenda='.$row_project["id_agenda"].'" onclick="return valideopenerform2(\'detail_.php?id_detagenda='.$row_project["id_agenda"].'\',\'idagenda'.$row_project["id_agenda"].'\');" title="'.$row_project["title_agenda"].'">'.$row_project["title_agenda"].'</a></td>
                                                <td>';
		   
                    $sql_agenda		= "SELECT DISTINCT (`id_group`) FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_agenda` = '$row_project[id_agenda]' ORDER BY `date_add` ASC;";
                    $query_agenda	= mysql_query($sql_agenda);
                    while ($row_agenda = mysql_fetch_array($query_agenda)) {
                        $sql_last_agenda = mysql_query("SELECT `title_agenda` FROM `gx_agenda2` WHERE `id_agenda` = '".$row_agenda["id_group"]."' LIMIT 0,1;");
                        $row_last_agenda = mysql_fetch_array($sql_last_agenda);
                        
                        $content .= '<h6>'.$row_last_agenda["title_agenda"].'</h6>';
                        
                        $sql_detagenda		= "SELECT * FROM `gx_detAgenda2` WHERE `level` = '0' AND `id_agenda` = '$row_project[id_agenda]' AND `id_group` = '".$row_agenda["id_group"]."' ORDER BY `date_add`,`priority`,`status` ASC;";
                        $query_detagenda	= mysql_query($sql_detagenda);
                        while ($row_detagenda = mysql_fetch_array($query_detagenda)){
                        
                            $content .='<input type="checkbox" name="id_detagnda[]" value="'.$row_detagenda["id_detagenda"].'"> <a href="detail_.php?id_detailgenda='.$row_detagenda["id_detagenda"].'" onclick="return valideopenerform2(\'detail_.php?id_detailgenda='.$row_detagenda["id_detagenda"].'\',\'iddetagenda'.$row_detagenda["id_detagenda"].'\');" ><font style="color :#072;">'.nl2br($row_detagenda["title_detagenda"]).'</font></a> <a href="form_agenda_new.php?id_detail='.$row_detagenda["id_detagenda"].'" onclick="return valideopenerform2(\'form_agenda_new.php?id_detail='.$row_detagenda["id_detagenda"].'\',\'iddetagenda'.$row_detagenda["id_detagenda"].'\');" ><font style=" color : #4571b5;font-weight: bolder;">('.$row_detagenda["status"].')</font></a> <br />';
                        }
                    }
$content .='
                                                </td>
                                                <td>
                                                <a class="button button-plain" href="detail.php?id_detagenda='.$row_project["id_agenda"].'">Detail</a> ||
                                                <a class="button button-plain" href="form_agenda_new.php?id='.$row_project["id_agenda"].'">Edit</a>
                                                </td>
                                            </tr>';
	$no++;
    }                  
$content .= '
                                        </tbody>
                                    </table>
                                    <input type="submit" class="btn btn-primary" data-icon="v" name="deldetagenda" value="Hapus">
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
            ';


$plugins = '
    <script type="text/javascript">

    function valideopenerform2(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=921")
	if (window.focus) {popy.focus()}
	return false;
    }
    
</script>
        <!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
         <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();
            });
        </script>
        
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $(\'#example2\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>';

    $title	= 'Agenda';
    $submenu	= "agenda";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>