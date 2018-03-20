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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
	
	//paging
    $perhalaman = 50;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }

	
if(isset($_GET["userid"]))
{

    $userid 			= isset($_GET["userid"]) ? strip_tags(trim($_GET["userid"])) : '';

    $queryList = "SELECT * FROM `gx_maintenance` WHERE `user_id` LIKE '%$userid%'
    AND `level` = '0' ORDER BY `id_monitoring` ASC";
    $result = mysql_query($queryList) or die ("Error on Query List.data: ".mysql_error());
    $total = mysql_num_rows($result);
    

}

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        History Maintenance
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                
								<div class="box-header">
                                    <h3 class="box-title">History Maintenance '.$result['user_id'].'</h3>

                                </div><!-- /.box-header -->
								
								<div class="box-body">

<table id="maintenance" class="table table-bordered table-striped">
	<thead>
		<tr>
				<th width="50">No</th>
                <th>CSO</th>
                <th>Last Upd</th>
                <th>User ID</th>
                <th>Nama</th>
                <th>Alamat</th>
				<th>Jenis Pekerjaan</th>
                <th>Status</th>
                <th>Teknisi</th>
                <th>C/in</th>
                <th>C/out</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>';

       
		$no = 1;
        while ($data = mysql_fetch_array($result)) {
				
				$query_teknisi	= mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee` = '".$data["id_teknisi"]."' AND `level` = '0' LIMIT 0,1;", $conn);
				$row_teknisi	= mysql_fetch_array($query_teknisi);
				
                $content .=" <tr><td align='center'>".$no."</td>
                <td>".$data["updated_by"]."</td>
                <td>".date("H:i A", strtotime($data["date_upd"]))."</td>
				<td>".$data["user_id"]."</td>
                <td>".$data["nama"]."</td>
                <td>".$data["alamat"]."</td>
				<td>".$data["jenis_kerjaan"]."</td>
                <td>".$data["status"]."</td>
                <td>".$row_teknisi["nama"]."</td>
				<td>".$data["check_in"]."</td>
                <td>".$data["check_out"]."</td>
                
			<td align='center'>
			<a href='detail_maintenance.php?id=".$data["id_monitoring"]."'
			onclick=\"return valideopenerform('detail_maintenance.php?id=".$data["id_monitoring"]."','maintenance');\">view</a> |
			<a href='form_maintenance.php?id=".$data["id_monitoring"]."' >Edit</a>
		</td>";

		

                $content .= '</tr>';
                $no++;

            
		}


$content .='

        </tbody>

</table><br>

<br>
</div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= 'History Maintenance';
    $submenu	= "maintenance";	
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
}
     else{
	header("location: ".URL_CSO."logout.php");
    }

?>