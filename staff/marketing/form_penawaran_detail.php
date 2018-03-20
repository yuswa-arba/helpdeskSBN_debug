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
redirectToHTTPS();
if($loggedin = logged_inStaff()){ 

if($loggedin["group"] == 'staff'){
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Penawaran Detail");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_penawaran_detail` WHERE `kode_penawaran`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_penawaran_detail.php?c='.$row_data["kode_penawaran"];
	
}



    $content ='<section class="content-header">
                    <h1>
                        Form Penawaran Detail
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Penawaran Detail</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										
										<!--<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>No Ekslarasi RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_penawaran_detail" name="no_penawaran_detail" required="" value="">
											</div>
											<div class="col-xs-2">
												<label>No Persetujuan RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_persetujaun_penawaran" name="no_persetujuan_penawaran" required="" value="">
											</div>
										</div>
										</div>-->
										
										
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
    $kode_penawaran					 = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_penawaran_item	 = "SELECT * FROM `gx_penawaran_detail` WHERE `kode_penawaran` ='".$kode_penawaran."' AND `level` = '0';";
    $sql_penawaran_item	 = mysql_query($query_penawaran_item, $conn);
    $id_detail_penawaran 	 = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_penawaran_detail = "SELECT * FROM `gx_penawaran_detail` WHERE `kode_penawaran` ='".$kode_penawaran."' AND `level` = '0' AND `id_penawaran_detail` = '".$id_detail_penawaran."' LIMIT 0,1;";
    //echo $query_penawaran_item;
	$sql_penawaran_detail   = mysql_query($query_penawaran_detail, $conn);
    $row_penawaran_detail 	 = mysql_fetch_array($sql_penawaran_detail);
    $no = 1;
	$total_amount = 0;
    while($row_penawaran_item = mysql_fetch_array($sql_penawaran_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_penawaran_item["kode"].'</td>
	<td>'.$row_penawaran_item["keterangan"].'</td>
	<td>'.$row_penawaran_item["quantity"].'</td>
	<td align="right">'.number_format($row_penawaran_item["price"], 2, ',', '.').'</td>
	<td align="right">'.number_format($row_penawaran_item["amount"], 2, ',', '.').'</td>
	<td><a href="form_penawaran_detail?c='.$row_penawaran_item["kode_penawaran"].'&id='.$row_penawaran_item["id_penawaran_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>
	';
	$no++;
	$total_amount = $total_amount + $row_penawaran_item["amount"];
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
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM Barang Penawaran</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="kode_penawaran" value="'.(isset($_GET['c']) ? $kode_penawaran : "").'" readonly="">
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Kode</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly="" class="form-control" name="kode" id="kode" value="'.(isset($_GET['id']) ? $row_penawaran_detail["kode"] : "").'" onclick="return valideopenerform(\'data_barang.php?r=myForm&f=penawaran\',\'barang\');">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" required="" name="keterangan" id="keterangan" value="'.(isset($_GET['id']) ? $row_penawaran_detail["keterangan"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Quantity</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text"   maxlength="6"class="form-control" required="" name="quantity" id="quantity" value="'.(isset($_GET['id']) ? $row_penawaran_detail["quantity"] : "").'" >
					    </div>
                    </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>price</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" maxlength="20" class="form-control" required="" name="price" id="harga" value="'.(isset($_GET['id']) ? $row_penawaran_detail["price"] : "").'">
					    </div>
                    </div>
					</div>
					
					
                     
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_penawaran_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_penawaran_detail["user_upd"]." ".$row_penawaran_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a  href="master_penawaran.php" class="btn btn-primary">Back To Master</a>  <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

if(isset($_POST["save"]))
{
    //echo "save";
	
	$kode		= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    $keterangan	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$quantity   = isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
	$price		= isset($_POST['price']) ? str_replace(',', '',$_POST['price']) : '';
    $amount 	= ($price * $quantity);
	
	$sql_insert = "INSERT INTO `gx_penawaran_detail` (`id_penawaran_detail`, `kode_penawaran`, `kode`,
						  `keterangan`, `quantity`, `price`, `amount`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$_GET["c"]."', '".$kode."',
						  '".$keterangan."', '".$quantity."', '".$price."', '".$amount."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_STAFF."marketing/form_penawaran_detail.php?c=$kode_penawaran';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode		= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    $keterangan	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$quantity   = isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
	$price		= isset($_POST['price']) ? str_replace(',', '',$_POST['price']) : '';
    $amount 	= ($price * $quantity);
	
    $sql_update = "UPDATE `gx_penawaran_detail` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_penawaran_detail` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	=  "INSERT INTO `gx_penawaran_detail` (`id_penawaran_detail`, `kode_penawaran`, `kode`,
						  `keterangan`, `quantity`, `price`, `amount`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$_GET["c"]."', '".$kode."',
						  '".$keterangan."', '".$quantity."', '".$price."', '".$amount."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";     
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_STAFF."marketing/form_penawaran_detail.php?c=$kode_penawaran';
			</script>";
			
}

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
		';

    $title	= 'Form Penawaran Detail';
    $submenu	= "penawaran";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>