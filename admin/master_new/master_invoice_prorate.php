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
/*if($loggedin["group"] == 'admin'){*/
    
    global $conn_helpdesk;
    global $conn;
$ttl  = "";

$ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "List Incoming Complaint" : "";
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Master Invoice Prorate
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <!--
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_prospek.php" class="btn bg-maroon btn-flat margin">Add Prospek</a>
				</div>
			    </div>
			</div>
		    </div>
		    -->

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$ttl.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				';

$type = isset($_GET['type']) ? $_GET['type'] : '';
// enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Helpdesk $type");

$content .='';

$content .= '
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th width="8%">Kode Invoice</th>
			<th width="10%">Kode Customer</th>
			<th width="10%">Nama Customer</th>
			<th width="8%">ID Paket</th>
			<th width="10%">Nama Paket</th>
			<th width="10%">Action</th>
			<!--<th width="2%">#</th>-->
                  </tr>
                </thead>
                <tbody>';

/*
 SELECT `idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`, `cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`, `cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`, `cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`, `cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`, `cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cKdProspek`, `cNoKTP`, `cLongi`, `cLati`, `cBulanan`, `cTahunan`, `id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `tbCustomer` WHERE 1
*/
/*
 SELECT `id_paket`, `id_cabang`, `kode_paket`, `nama_paket`, `jenis_paket`, `periode_start`, `periode_end`, `internet_type`, `internet_paket`, `voip`, `video`, `setup_fee`, `abonemen_voip`, `abonemen_video`, `monthly_fee`, `monthly_for`, `maintenance_free`, `acc_piutang`, `acc_um`, `group_rbs`, `account_index`, `bandwith_usage`, `bw_upload`, `bw_download`, `backbone_1`, `backbone_2`, `backbone_3`, `sla_paket`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_paket2` WHERE 1
*/
/*
 SELECT `id_invoice_prorate`, `kode_invoice`, `kode_customer`, `nama_customer`, `id_paket`, `npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`, `tanggal_tagihan`, `tanggal_jatuh_tempo`, `no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `printed_by`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_invoice_prorate` WHERE 1
*/
    $sql_invoice_prorate	= mysql_query("SELECT * FROM `gx_invoice_prorate`, `gx_paket2`, `tbCustomer`
			    WHERE `gx_invoice_prorate`.`id_paket`=`gx_paket2`.`id_paket` AND `gx_invoice_prorate`.`kode_customer`=`tbCustomer`.`idCustomer` AND `gx_invoice_prorate`.`level` = '0'
			    ORDER BY  `gx_invoice_prorate`.`date_add` DESC", $conn);
    $no = 1;

    while($r_ip = mysql_fetch_array($sql_invoice_prorate))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$r_ip["kode_invoice"].'</td>
			<td>'.$r_ip["kode_customer"].'</td>
			<td>'.$r_ip["nama_customer"].'</td>
			<td>'.$r_ip["id_paket"].'</td>
			<td>'.$r_ip["nama_paket"].'</td>
			<td><a href="invoice_prorate_pdf.php?id_invoice_prorate='.$r_ip["id_invoice_prorate"].'"> View PDF </a></td>
			<!--<td><input type="checkbox" name="id_prospek[]" value=""></td>-->
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>';

$submenu	= "master_invoice_prorate";



 
 $content .='<br />
            </div> 
       </div>';

/*
}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
    $submenu	= "master_dashboard";
}*/

//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '

        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
		   "bPaginate": true,
		   "bLengthChange": false,
		   "bFilter": false,
		   "bSort": false,
		   "bInfo": true,
		   "bAutoWidth": false
            });
        </script>';

    $title	= 'Master';
    
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
     else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>