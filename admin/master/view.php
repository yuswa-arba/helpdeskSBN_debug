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
    

if(isset($_GET["t"]) AND isset($_GET["kode"]))
{
    $tabel	= isset($_GET['t']) ? strip_tags(trim($_GET['tabel'])) : '';
    $kode	= isset($_GET['kode']) ? strip_tags(trim($_GET['kode'])) : '';
    $query_data	= "SELECT * FROM `tbCustomer` WHERE `cKode`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "view detail data $tabel dengan kode $kode");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "view detail");
}


    
    $content ='<section class="content-header">
                    <h1>
                        Master Customer
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Resume Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
                                        <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_data" data-toggle="tab">Data</a></li>
                                    <li><a href="#tab_billing" data-toggle="tab">Billing</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_data">
                                        <div class="table-responsive">
					    <h4>SPK Survey</h4>
					    <table class="table table-bordered table-striped" style="width: 100%;">
						<tr>
						    <th>No.</th>
						    <th>Kode</th>
						    <th>Tanggal</th>
						    <th>Status</th>
						    <th>Last Updated by</th>
						    <th>Actions</th>
						</tr>';

$query_survey = mysql_query("SELECT * FROM `gx_survey` WHERE `kode_cust` = '".$cKode."' LIMIT 0,10;", $conn);
$nos = 1;
while($row_survey = mysql_fetch_array($query_survey))
{
    
    $content .='<tr>
		    <td>'.$nos.'.</td>
		    <td>'.$row_survey["no_spk_survey"].'</a></td>
		    <td>'.$row_survey["tanggal"].'</td>
		    <td></td>
		    <td>'.$row_survey["user_upd"].'</td>
		    <td><a href="'.URL_ADMIN.'administrasi/detail_survey.php?id_survey='.$row_survey["id_survey"].'"
		    onclick="return valideopenerform(\''.URL_ADMIN.'administrasi/detail_survey.php?id_survey='.$row_survey["id_survey"].'\',\'detail survey\');">Detail</a>
		</tr>';
    $nolb++;
}

$content .='
					    </table>
					    <h4>SPK Pasang Baru</h4>
					    <table class="table table-bordered table-striped" style="width: 100%;">
						<tr>
						    <th>No.</th>
						    <th>Kode</th>
						    <th>Tanggal</th>
						    <th>Status</th>
						    <th>Last Updated by</th>
						    <th>Actions</th>
						</tr>';

$query_pasang = mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_customer` = '".$cKode."' LIMIT 0,10;", $conn);
$nos = 1;
while($row_pasang = mysql_fetch_array($query_pasang))
{
    $sql_jawab_pasang = mysql_query("SELECT * FROM `gx_jawab_spkpasang` WHERE `kode_spk` = '".$row_pasang["kode_spk"]."' LIMIT 0,1;", $conn);
    $row_jawabpasang = mysql_fetch_array($sql_jawab_pasang);
    $content .='<tr>
		    <td>'.$nos.'.</td>
		    <td>'.$row_pasang["kode_spk"].'</a></td>
		    <td>'.$row_pasang["tanggal"].'</td>
		    <td>'.$row_jawabpasang["status"].'</td>
		    <td>'.$row_pasang["user_upd"].'</td>
		    <td><a href="'.URL_ADMIN.'administrasi/detail_spk_pasang_baru.php?id_spk_pasang_baru='.$row_pasang["id_spkpasang"].'"
		    onclick="return valideopenerform(\''.URL_ADMIN.'administrasi/detail_spk_pasang_baru.php?id_spk_pasang_baru='.$row_pasang["id_spkpasang"].'\',\'detail survey\');">Detail</a>
		</tr>';
    $nos++;
}

$content .='
					    </table>
					    <h4>SPK Aktivasi</h4>
					    <table class="table table-bordered table-striped" style="width: 100%;">
						<tr>
						    <th>No.</th>
						    <th>Kode</th>
						    <th>Tanggal</th>
						    <th>Status</th>
						    <th>Last Updated by</th>
						    <th>Actions</th>
						</tr>';

$query_aktivasi = mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `id_customer` = '".$cKode."' LIMIT 0,10;", $conn);
$noa = 1;
while($row_aktivasi = mysql_fetch_array($query_aktivasi))
{
    $sql_jawab_aktivasi = mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` WHERE `kode_spkaktivasi` = '".$row_aktivasi["kode_spkaktivasi"]."' LIMIT 0,1;", $conn);
    $row_jawabaktivasi = mysql_fetch_array($sql_jawab_aktivasi);
    $content .='<tr>
		    <td>'.$noa.'.</td>
		    <td>'.$row_aktivasi["kode_spkaktivasi"].'</a></td>
		    <td>'.$row_aktivasi["tanggal"].'</td>
		    <td>'.$row_jawabaktivasi["status"].'</td>
		    <td>'.$row_aktivasi["user_upd"].'</td>
		    <td><a href="'.URL_ADMIN.'administrasi/detail_spk_aktivasi_baru.php?id='.$row_aktivasi["id_spkaktivasi"].'"
		    onclick="return valideopenerform(\''.URL_ADMIN.'administrasi/detail_spk_aktivasi_baru.php?id_survey='.$row_aktivasi["id_spkaktivasi"].'\',\'detail survey\');">Detail</a>
		</tr>';
    $noa++;
}

$content .='
					    </table>
				
					</div>
					
                                    </div><!-- /.tab-pane -->
				    
				    <div class="tab-pane" id="tab_billing">
                                        <div class="table-responsive">
					    <h4>Invoice</h4>
					    <table class="table table-bordered table-striped" style="width: 100%;">
						<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Kode Invoice</th>
			<th>Customer Number</th>
			<th>Nama</th>
			<th>Deskripsi</th>
			<th>Paid Status</th>
			<th>Status</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_invoice` WHERE `customer_number` = '".$cKode."' AND `level` =  '0' ORDER BY `id_invoice` DESC;", $conn);
    $noi = 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$noi.'.</td>
			<td><a href="'.URL_ADMIN.'administrasi/detail_invoice?id='.$row_data["id_invoice"].'" onclick="return valideopenerform(\'detail_invoice.php?id='.$row_data["id_invoice"].'\',\'Detail Invoice '.$row_data["kode_invoice"].'\');">'.$row_data["kode_invoice"].'</a></td>
			<td>'.$row_data["customer_number"].'</td>
			<td>'.$row_data["nama_customer"].'</td>
			<td>'.$row_data["title"].'</td>
			<td>'.(($row_data["paid_status"] == "1") ? '<span class="label label-success">Paid</span>' : '<span class="label label-danger">Unpaid</span>').'</td>
			<td>'.(($row_data["status"] == "1") ? '<span class="label label-danger">Close</span>' : '<span class="label label-success">Open</span>').'</td>
			<td>'.(($row_data["status"] == "1") ? '<a href="pdf_invoice?id='.$row_data["id_invoice"].'" target="_blank"><span class="label label-info">PDF</span></a>
			    <a href="'.URL_ADMIN.'administrasi/manage_payment?id='.$row_data["id_invoice"].'" ><span class="label label-info">Payment</span></a>' : '<a href="'.URL_ADMIN.'administrasi/form_invoice_detail?c='.$row_data["kode_invoice"].'"><span class="label label-info">Detail</span></a>
			    <a href="'.URL_ADMIN.'administrasi/form_invoice?id='.$row_data["id_invoice"].'"><span class="label label-info">Edit</span></a>
			    <a href="'.URL_ADMIN.'administrasi/resume_customer.php?id='.$row_data["id_invoice"].'&action=lock"><span class="label label-info">Lock</span></a>
			    ').'
			</td>
		</tr>';
	$noi++;
    }

$content .='</tbody>
</table>
					</div>
					
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';
//onclick="return valideopenerform(\'../administrasi/data_paket.php?r=myForm&f=customer\',\'cabang\');"
$plugins = '
<!-- Colorbox -->
<link media="screen" rel="stylesheet" type="text/css" href="'.URL.'js/colorbox/example1/colorbox.css" />
  <script src="'.URL.'js/colorbox/jquery.colorbox.js"></script>
  <script type="text/javascript">
   $(document).ready(function(){
    //Examples of how to assign the ColorBox event to elements
    $(".lightbox").colorbox({width:"75%", height:"75%"});
    
   });

  </script>
  
';

//document.getElementById("id_cabang2").value = cport + (parseInt(result)+1);
    $title	= 'Detail Customer';
    $submenu	= "master_customer";
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