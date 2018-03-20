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
    if($loggedin["group"] == 'admin')
    {
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Surat Detail");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_surat` WHERE `kode_surat`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_surat_detail.php?c='.$row_data["kode_surat"];
	
}



    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Surat Detail</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Cabang</label>
											</div>
											<div class="col-xs-2">
												<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['c']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['c']) ? $row_data["nama_cabang"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Tgl Update terakhir</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['c']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
											<div class="col-xs-1">
												<label>Exp Date</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="datepicker" name="exp_date" required="" value="'.(isset($_GET['c']) ? $row_data["exp_date"] : date("Y-m-d",mktime(0, 0, 0, date("m")+1, date("d"), date("Y")))).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Kode Surat</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_surat" name="kode_surat" required="" value="'.(isset($_GET['c']) ? $row_data["kode_surat"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Nama Surat</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" id="nama_surat" name="nama_surat" required="" value="'.(isset($_GET['c']) ? $row_data["nama_surat"] : "").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Penerbit Surat</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="penerbit_surat" name="penerbit_surat" required="" value="'.(isset($_GET['c']) ? $row_data["penerbit_surat"] : $loggedin["username"]).'">
											</div>
										</div>
										</div>
										
										<table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td colspan="2">&nbsp;</td>
					    </tr>
					    <tr>
						<td colspan="2">
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th width="1%">
								  No.
							      </th>
								   <th width="15%">
								  Kode Formulir
							      </th>
							      <th width="15%">
								  Nama Formulir
							      </th>
							      <th width="25%">
								  Lokasi File
							      </th>
							      <th  width="20%">
								  Tanggal Update Terakhir
							      </th>
								  <th width="20%">
								  Exp Date
							      </th>
								 
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_data			= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_data_item	= "SELECT * FROM `gx_surat_detail` WHERE `kode_surat` ='".$kode_data."' AND `level` = '0';";
    $sql_data_item	 	= mysql_query($query_data_item, $conn);
    $id_detail_data 	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data_detail 	= "SELECT * FROM `gx_surat_detail` WHERE `kode_surat` ='".$kode_data."' AND `level` = '0' AND `id_surat_detail` = '".$id_detail_data."' LIMIT 0,1;";
    //echo $query_data_item;
	$sql_data_detail   	= mysql_query($query_data_detail, $conn);
    $row_data_detail 	= mysql_fetch_array($sql_data_detail);
    $no = 1;
	
    while($row_data_item = mysql_fetch_array($sql_data_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_data_item["kode_formulir"].'</td>
	<td>'.$row_data_item["nama_formulir"].'</td>
	<td>'.$row_data_item["lokasi_file"].'</td>
	<td>'.$row_data_item["tanggal_update_terakhir"].'</td>
	<td>'.$row_data_item["exp_date"].'</td>
	</tr>
	';
	$no++;
    }
}else{
	
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}


$content .='							    
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        
            ';
			


$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		';

    $title	= 'Detail Surat Detail';
    $submenu	= "surat";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>