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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Area");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
	 
	if(isset($_POST["aktif"]))
    {
        $id_data = array();
        $id_data = isset($_POST["id_va"]) ? $_POST["id_va"] : $id_data;
        
        foreach($id_data as $key => $value)
        {
            $query = "UPDATE `gx_va` SET `status` = '2', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_va` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: master_va_upload.php');
    }

$content = '<!-- Content Header (Page header) -->
                
                <!-- Main content -->
                <section class="content">
				<div class="row">
                    <div class="col-xs-12">
						<div class="box">
							<div class="box-body">
								<button type="submit" name="aktif" class="btn btn-primary">Aktif</button>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Virtual Account</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<form action="" method="POST" name="form_va">
<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			
			<th>No Rekening va</th>
			<th>Kode Bank</th>
			<th>Kode Perusahan</th>
			<th>Status</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_va` WHERE `level` =  '0' AND `status` = '9' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_va` WHERE `level` =  '0' AND `status` = '9';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			
			<td>'.$row_data["no_rek"].'</td>
			<td>'.$row_data["kode_bank"].'</td>
			<td>'.$row_data["kode_perusahaan"].'</td>
			<td>'.StatusVA($row_data["status"]).'</td>
			<td><input type="checkbox" name="id_va[]" value="'.$row_data["id_va"].'"></td>
		</tr>';
	$no++;
	
	/*<a href="detail_va.php?id='.$row_data["id_va"].'" onclick="return valideopenerform(\'detail_va.php?id='.$row_data["id_va"].'\',\'va\');">Details</a>  ||
			<a href="form_va.php?id='.$row_data["id_va"].'">edit</a>*/
    }

$content .='</tbody>
</table>
</div>
<br />
           
			<div class="box-footer">
				<div class="box-tools pull-right">
					'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
				</div>
				<br style="clear:both;">
				<button type="submit" name="aktif" class="btn btn-primary">Aktif</button>
			</div>
		</div>
		
		</form>
		
	</div>
</div>

</section><!-- /.content -->';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Virtual Account';
    $submenu	= "master_va";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>