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
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Proposal");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_proposal_barang` WHERE `kode_proposal`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_proposal_detail.php?c='.$row_data["kode_proposal"];
	
	
    $query_data1	= "SELECT * FROM `gx_proposal` WHERE `kode_proposal`='$kode_data' ORDER BY `id_proposal` DESC LIMIT 0,1;";
    $sql_data1		= mysql_query($query_data1, $conn);
    $row_data1		= mysql_fetch_array($sql_data1);
	$sql_brosur		= "SELECT * FROM `gx_brosur` WHERE `kode_brosur` = '".$row_data1["kode_brosur"]."';";
	$query_brosur	= mysql_query($sql_brosur, $conn);
    $row_brosur		= mysql_fetch_array($query_brosur);
	$sql_brosur_d	= "SELECT * FROM `gx_brosur_detail`	WHERE `id_brosur` = '".$row_brosur["id_brosur"]."' AND `level` = '0';";
    $query_brosur_d	= mysql_query($sql_brosur_d, $conn);
    $row_brosur_d	= mysql_fetch_array($query_brosur_d);
}



    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Proposal</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_cabang"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['c']) ? $row_data1["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Proposal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_proposal" name="kode_proposal" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_proposal"] : "").'" >
											</div>
											<div class="col-xs-3">
												<label>No Prospek</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_prospek" name="no_prospek" required="" value="'.(isset($_GET['c']) ? $row_data1["no_prospek"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="marketing" name="marketing" required="" value="'.(isset($_GET['c']) ? $row_data1["id_marketing"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_customer" name="nama_customer" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Perusahaan</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_perusahaan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="alamat" name="alamat" required="" value="'.(isset($_GET['c']) ? $row_data1["alamat"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kelurahan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kelurahan" name="kelurahan" required="" value="'.(isset($_GET['c']) ? $row_data1["kelurahan"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kecamatan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kecamatan" name="kecamatan" required="" value="'.(isset($_GET['c']) ? $row_data1["kecamatan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kota</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kota" name="kota" required="" value="'.(isset($_GET['c']) ? $row_data1["kota"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Pos</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_pos" name="kode_pos" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_pos"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Telp</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="telp" name="telp" required="" value="'.(isset($_GET['c']) ? $row_data1["no_telp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No HP 1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp1" name="no_hp1" required="" value="'.(isset($_GET['c']) ? $row_data1["no_hp1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No HP 2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp2" name="no_hp2" required="" value="'.(isset($_GET['c']) ? $row_data1["no_hp2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Contact Person</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="contact_person" name="contact_person" required="" value="'.(isset($_GET['c']) ? $row_data1["contac_person"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Email</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="email" name="email" required="" value="'.(isset($_GET['c']) ? $row_data1["email"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jangka Waktu Penawaran</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="jangka_waktu_penawaran" name="jangka_waktu_penawaran" required="" value="'.(isset($_GET['c']) ? $row_data1["jangka_waktu"] : "").'">
											</div>
											<div class="col-xs-1">
												<label>Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jasa</label>
											</div>
											<div class="col-xs-4">
												Internet
												VOIP
												VOD
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Setup Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text"  readonly="" class="form-control" id="harga" name="setup_fee" required="" value="'.(isset($_GET['c']) ? $row_data1["setup_fee"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket1" name="kode_paket1" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_paket1"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket1" name="nama_paket1" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_paket1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee1" required="" value="'.(isset($_GET['c']) ? $row_data1["monthly_fee1"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket2" name="kode_paket2" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_paket2"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket2" name="nama_paket2" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_paket2"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee2" required="" value="'.(isset($_GET['c']) ? $row_data1["monthly_fee2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket3" name="kode_paket3" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_paket3"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket3" name="nama_paket3" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_paket3"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee3" required="" value="'.(isset($_GET['c']) ? $row_data1["monthly_fee3"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket4" name="kode_paket4" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_paket4"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket4" name="nama_paket4" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_paket4"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee4" required="" value="'.(isset($_GET['c']) ? $row_data1["monthly_fee4"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket5" name="kode_paket5" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_paket5"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket5" name="nama_paket5" required="" value="'.(isset($_GET['c']) ? $row_data1["nama_paket5"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee5" required="" value="'.(isset($_GET['c']) ? $row_data1["monthly_fee5"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>keterangan</label>
											</div>
											<div class="col-xs-9">
												<textarea name="keterangan" readonly="" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['c']) ? $row_data1['keterangan'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Brosur</label>
											</div>
											<div class="col-xs-2">
												<a class="ajax" href="'.URL_ADMIN.''.$row_brosur_d["lokasi_file"].''.$row_brosur_d["nama_file"].'" title=""><input type="text" readonly="" class="form-control" id="kode_brosur" name="kode_brosur" required="" value="'.(isset($_GET['c']) ? $row_data1["kode_brosur"] : "").'"></a>
											</div>
										</div>
										</div>
										
										<table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td>Barang</td>
					    </tr>
					    <tr>
						<td>
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th width="1%">
								  No.
							      </th>
								   <th width="15%">
								  Kode
							      </th>
							      <th width="15%">
								  Keterangan
							      </th>
							      <th width="25%">
								  Quantity
							      </th>
							      <th width="20%">
								  Price
							      </th>
								  <th width="20%">
								  Amount
							      </th>
								  <th width="10%">
							      #
							      </th>
								 ';
if(isset($_GET["c"]))
{
    $kode_proposal					 = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_proposal_item	 = "SELECT * FROM `gx_proposal_barang` WHERE `kode_proposal` ='".$kode_proposal."' AND `level` = '0';";
    $sql_proposal_item	 = mysql_query($query_proposal_item, $conn);
    $id_detail_proposal 	 = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_proposal_detail = "SELECT * FROM `gx_proposal_barang` WHERE `kode_proposal` ='".$kode_proposal."' AND `level` = '0' AND `id_proposal_barang` = '".$id_detail_proposal."' LIMIT 0,1;";
    //echo $query_proposal_item;
	$sql_proposal_detail   = mysql_query($query_proposal_detail, $conn);
    $row_proposal_detail 	 = mysql_fetch_array($sql_proposal_detail);
    $no = 1;
	$total_amount = 0;
    while($row_proposal_item = mysql_fetch_array($sql_proposal_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_proposal_item["kode_barang"].'</td>
	<td>'.$row_proposal_item["keterangan"].'</td>
	<td>'.$row_proposal_item["qty"].'</td>
	<td align="right">'.number_format($row_proposal_item["price"], 2, ',', '.').'</td>
	<td align="right">'.number_format($row_proposal_item["amount"], 2, ',', '.').'</td>
	<td><a href="form_proposal_detail?c='.$row_proposal_item["kode_proposal"].'&id='.$row_proposal_item["id_proposal_barang"].'"><span class="label label-info">Edit</span></a></td>
	</tr>
	';
	$no++;
	$total_amount = $total_amount + $row_proposal_item["amount"];
	}
}else{
	
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}

	

$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td align="right" colspan="4">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
									'.number_format($total_amount, 2, ',', '.').'
							    </td>
								
							   
						    </tr>
					     
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
		<script type="text/javascript">
			<!--
			function confirmation() {
				var answer = confirm("Are You Sure ?")
				if (answer){
					alert("Bye bye!")
					window.location = "google.com";
				}
				else{
					alert("Thanks for sticking around!")
				}
			}
			//-->
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

    $title	= 'Detail Proposal';
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