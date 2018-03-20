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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Invoice");
    global $conn;
    
$content = '

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				
				<div class="box-header">
                                    <h2 class="box-title">Search</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
                    <div class="box-header">
						
                    </div><!-- /.box-header -->
                                
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Kode Customer</th>
			<th>Nama Customer</th>
			
			<th>Email</th>
			<th>PDF</th>
                  </tr>
                </thead>
                <tbody>';
//select data
    $sql_data		= mysql_query("SELECT * FROM `gx_invoice_email` ORDER BY `date` DESC ;", $conn);
	$hal		= "?";

    
    $no =  1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td><a href="'.$row_data["file_invoice"].'" target="_blank">'.$row_data["kode_customer"].'</a></td>
			<td>'.$row_data["nama_customer"].'</td>
			
			<td>'.$row_data["email_invoice"].'</td>
			<td><a href="'.$row_data["file_invoice"].'" target="_blank">PDF File</a></td>
		</tr>';
		
		//<td>'.(($row_data["status"] == "1") ? '<span class="label label-danger">Close</span>' : '<span class="label label-success">Open</span>').'</td>
			
	$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
            
	   
       </div>
	   
	</section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Email Invoice';
    $submenu	= "master_invoice";
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