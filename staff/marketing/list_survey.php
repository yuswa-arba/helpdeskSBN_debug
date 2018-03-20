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
    
	$sql_supervisor = "SELECT `gxLogin_admin`.`supervisor` FROM `gxLogin_admin`, `gx_pegawai`
                WHERE `gxLogin_admin`.`id_employee` = `gx_pegawai`.`kode_pegawai`
				AND `gx_pegawai`.`id_employee` = '".$loggedin["id_employee"]."'
				AND `gx_pegawai`.`level` = '0' LIMIT 0,1;";
    $query_supervisor 	= mysql_query($sql_supervisor, $conn);
    $row_supervisor 	= mysql_fetch_array($query_supervisor);
	
    //paging
    $perhalaman = 1;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	$hal = "?";

$content ='<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        List Survey Dari Incoming CSO
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">

		    <div class="row">
                        <div class="col-xs-12">';

if($row_supervisor["supervisor"] != "1")
{
	$content .='<div class="box">
					<div class="box-header">
						<h3 class="box-title">List Survey Dari Incoming CSO</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive">
						Sorry, you dont have access this page. back to  <a href="'.URL_CSO.'">home</a>.
					</div>';
}
else
{

$type = isset($_GET['type']) ? $_GET['type'] : '';
$content .= '
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Survey Dari Incoming CSO</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				
 <table id="complaint" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="10%">CSO</th>
			<th width="10%">Cust ID</th>
			<th width="8%">User ID</th>
			<th width="8%">Tanggal</th>
			<th width="10%">Name</th>
			<th width="10%" style="text-align:center">Problem</th>
			<th width="10%">Status</th>
			<th width="15%">Action</th>
			
                  </tr>
                </thead>
                <tbody>';
				
	$sql_complaint = mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					 AND `date_add` LIKE '%".date("Y-m-d")."%' AND `action` = 'survey'
				       ORDER BY `gx_helpdesk_complaint`.`date_add`
				       DESC LIMIT $start, $perhalaman;", $conn);
	
	$sql_total_compliant = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_complaint`
				     WHERE `gx_helpdesk_complaint`.`level` = '0'
					 AND `date_add` LIKE '%".date("Y-m-d")."%' AND `action` = 'survey'
				       ORDER BY `gx_helpdesk_complaint`.`date_add`;", $conn));

    while($r_complaint = mysql_fetch_array($sql_complaint))
	{
	    $trouble_ticket ='';
	    if($r_complaint['trouble_ticket'] == 1){
		$trouble_ticket .= '<a href="detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_troubleticket.php?id_troubleticket='.$r_complaint["id_complaint"].'\',\'complaint\');">Detail TroubleTicket</a>';
	    
	    }else{
		$trouble_ticket .= '<a href="form_troubleticket.php?id_complaint='.$r_complaint["id_complaint"].'">Create TroubleTicket</a>';
	    }
		
		if($r_complaint["status"] == "open")
		{
			$status = '<span class="label label-danger">Open</span>';
		}elseif($r_complaint["status"] == "closed")
		{
			$status = '<span class="label label-success">Closed</span>';
		}elseif($r_complaint["status"] == "reopen")
		{
			$status = '<span class="label label-warning">Reopen</span>';
		}else
		{
			$status = '<span class="label label-info">No Status</span>';
		}
	    
	    $content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$r_complaint["created_by"].'</td>
		<td>'.$r_complaint["cust_number"].'</td>
		<td>'.$r_complaint["user_id"].'</td>
		<td>'.date("d-m-Y", strtotime($r_complaint["date_add"])).'</td>
		<td>'.$r_complaint["name"].'</td>
		<td><a href="detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'" onclick="return valideopenerform(\'detail_incoming.php?id_complaint='.$r_complaint["id_complaint"].'\',\'complaint\');">Details</a></td>
		<td>'.$status.'</td>
		<td>'.$trouble_ticket.' | 
		<a href="form_complaint.php?id_complaint='.$r_complaint["id_complaint"].'">edit</a></td>
		
	    </tr>';
	    $no++;
	}

$content .='</tbody>
</table>
</div>

<br />
            </div>
	    <div class="box-footer">
			<div class="box-tools pull-right">
				'.(halaman($sql_total_compliant, $perhalaman, 1, $hal)).'
			</div>
			<br style="clear:both;">
	     </div>';
}

$content .='
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';


$submenu	= "survey";
//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

$title	= 'List Survey';
    
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