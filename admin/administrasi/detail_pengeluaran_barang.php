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
 
if(isset($_GET["c"]))
{
    $kode_pengeluaran_barang		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    /*
    $query_pengeluaran_barang 	= "SELECT * FROM `gx_pengeluaran_barang`
			    WHERE `kode_pengeluaran` = '".$kode_pengeluaran_barang."'
			    LIMIT 0,1;";
    $sql_pengeluaran_barang	= mysql_query($query_pengeluaran_barang, $conn);
    $row_pengeluaran_barang	= mysql_fetch_array($sql_pengeluaran_barang);
   */
        
    //SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaan`, `nama_pemohon`, `nama_cabang`, `kode_divisi`, `nama_divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE 1
    $sql_pengeluaran_barang = "SELECT * FROM `gx_pengeluaran_barang` WHERE `kode_pengeluaran`='".$kode_pengeluaran_barang."'   LIMIT 0,1";
    $query_pengeluaran_barang = mysql_query($sql_pengeluaran_barang, $conn);
    $row_pengeluaran_barang = mysql_fetch_array($query_pengeluaran_barang);
        
    
    $return_url = 'form_pengeluaran_detail.php?c='.$kode_pengeluaran_barang;
    
}


//Data Form
//f = field, lbl = label, id = id node
$f_1_lbl= 'No Pengeluaran'; $f_1_n = ''; $f_1_id = ''; $f_1_v = $row_pengeluaran_barang['kode_pengeluaran']; 

$f_2_lbl= 'Tanggal'; $f_2_n = ''; $f_2_id = ''; $f_2_v = $row_pengeluaran_barang['tanggal']; 

$f_3_lbl= 'No ACC Permintaan Barang'; $f_3_n = ''; $f_3_id = ''; $f_3_v = $row_pengeluaran_barang['kode_acc_permintaan']; 

$f_4_lbl= 'Nama Pemohon'; $f_4_n = ''; $f_4_id = ''; $f_4_v = $row_pengeluaran_barang['nama_pemohon'];

$f_5_lbl= 'Divisi'; $f_5_n = ''; $f_5_id = ''; $f_5_v = $row_pengeluaran_barang['nama_divisi'];

$f_6_lbl= 'Nama ACC'; $f_6_n = ''; $f_6_id = ''; $f_6_v = $row_pengeluaran_barang['nama_acc'];



    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Pengeluaran Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					<form action="" role="form" name="form_pengeluaran" id="form_pengeluaran" method="post" enctype="multipart/form-data">
					    
					    <div class="col-xs-2">
							<label>'.$f_1_lbl.'</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="'.$f_1_n.'" id="'.$f_1_id.'" value="'.$f_1_v.'">
						
					    </div>
					    
					    <div class="col-xs-2">
							<label>'.$f_2_lbl.'</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="'.$f_2_n.'" id="'.$f_2_id.'" value="'.$f_2_v.'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>'.$f_3_lbl.'</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" required="" name="'.$f_3_n.'" id="'.$f_3_id.'" value="'.$f_3_v.'">
						
					    </div>

					    <div class="col-xs-2">
							<label>'.$f_4_lbl.'</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" readonly="" required="" name="'.$f_4_n.'" id="'.$f_4_id.'" value="'.$f_4_v.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>'.$f_5_lbl.'</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control"  required="" name="'.$f_5_n.'" id="'.$f_5_id.'" value="'.$f_5_v.'" >
					    </div>
					    
					    <div class="col-xs-2">
							<label>'.$f_6_lbl.'</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control"  required="" name="'.$f_6_n.'" id="'.$f_6_id.'" value="'.$f_6_v.'" >
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
							      <th width="10%">
								  No.
							      </th>
							      <th width="17%">
								  Kode Barang
							      </th>
							      <th width="35%">
								  Nama Barang
							      </th>
							      <th  width="17%">
								  Serial Number
							      </th>
							      <th width="35%">
								  Quantity
							      </th>
							      
							      <th width="35%">
								  Lemari
							      </th>
							      <th width="35%">
								  Check List
							      </th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_pengeluaran	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    //SELECT `id_pengeluaran_barang_detail`, `kode_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `kode_lemari`, `nama_lemari`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang_detail` WHERE 1
    
    
    $query_pengeluaran_item	= "SELECT * FROM `gx_pengeluaran_barang_detail` WHERE `kode_pengeluaran` ='".$kode_pengeluaran."';";
    $sql_pengeluaran	= mysql_query($query_pengeluaran_item, $conn);
    $id_detail_pengeluaran  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_pengeluaran_detail = "SELECT * FROM `gx_pengeluaran_barang_detail` WHERE `kode_pengeluaran` ='".$kode_pengeluaran."' AND `id_pengeluaran_barang_detail` = '".$id_detail_pengeluaran."' LIMIT 0,1;";
    //echo $query_pengeluaran_item;
    $sql_pengeluaran_detail   = mysql_query($query_pengeluaran_detail, $conn);
    $row_pengeluaran_detail = mysql_fetch_array($sql_pengeluaran_detail);

    $no = 1;
    $total_qty = 0;
    
    while($row_pengeluaran = mysql_fetch_array($sql_pengeluaran))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_pengeluaran["kode_barang"].'</td>
	<td>'.$row_pengeluaran["nama_barang"].'</td>
	<td>'.$row_pengeluaran["serial_number"].'</td>
	<td>'.$row_pengeluaran["qty"].'</td>
	<td>'.$row_pengeluaran["lemari"].'</td>
	<td>'.$row_pengeluaran["check_list"].'</td>
	
	</tr>';
	$no++;
	$total_qty = $total_qty + $row_pengeluaran["qty"];
    }
	$lemari = '';
}else{
    $lemari = '';
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="3" align="right">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
								    '.$total_qty.'
							    </td>
							    <td>
								    '.$lemari.'
							    </td>
							    <td>
							    </td>
							   
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                       
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0
	    });
        </script>
';

    $title	= 'Detail Permintaan Pengeluaran Item';
    $submenu	= "Permintaan_pengeluaran_barang";
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