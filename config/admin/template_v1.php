<?php
/*
 * Theme Name: Software Globalxtreme ver. 1.0
 * Website: http://192.168.182.10/software/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 1.0  | 8 Agustus 2014
 * Email:
 * Theme for http://192.168.182.10/software/beta/
 */

function menu_sidebar($user_explode, $sub_menu, $id_group)
{
    global $conn;
    
    $sidebar_db ='<!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, '.$user_explode.'</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <div id="menu">
                    <div class="sidebar-form">
                        <div class="input-group">
                                <input type="text" class="search form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button data-sort="name" class="sort btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="list sidebar-menu ">';
                    
    $sql_menu 	= mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' AND `id_parent` = '0' AND `group_nama` = '".$id_group."' ORDER BY `order_number` ASC ;", $conn);
    
    $no = 1;
    while ($row_menu = mysql_fetch_array($sql_menu))
    {
        $sql_submenu 	= mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' AND `id_parent` = '".$row_menu["id_menu"]."' ORDER BY `order_number` ASC ;", $conn);
        $count_submenu  = mysql_num_rows($sql_submenu);
        
        if($count_submenu == 0)
        {
            $sidebar_db .='<li '.(($sub_menu == $row_menu["menu"] ) ? ' class="active"' : '').'>
                        <a   href="'.URL_ADMIN.$row_menu["file"].'">
                            <i class="'.$row_menu["icon"].'"></i> <span class="name">'.$row_menu["alias"].'</span>
                        </a>
                    </li>';
        }
        else
        {
            $sidebar_db .= '<li '.(($sub_menu == $row_menu["menu"] ) ? ' class="treeview active"' : ' class="treeview"').'>
                        <a href="">
                            <i class="'.$row_menu["icon"].'"></i> <span class="name" >'.$row_menu["alias"].'</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>';
                        
            $sidebar_db .= '<ul class=" subname treeview-menu">';
            
            while($row_submenu = mysql_fetch_array($sql_submenu))
            {
                $sidebar_db .='<li'.(($sub_menu == $row_submenu["menu"]) ? ' class="active"' : '').'>
                <a  href="'.URL_ADMIN.$row_submenu["file"].'">
                <i class="fa fa-angle-double-right"></i> <span  class=""> '.trim($row_submenu["alias"]).'</span></a></li>';
                //<i class="'.$row_submenu["icon"].'"></i>
            }
            $sidebar_db .= '</ul>
                </li>';
        }
        
    }
    
    $sidebar_db .='</ul>
    </div>';
    
    return $sidebar_db;
}

function admin_theme($title="",$content="",$plugins="",$user="",$sub_menu="",$group="")
{
    
    $user_explode = explode(' ', $user);
    $sidebar_db = menu_sidebar($user_explode[0], $sub_menu, $group);
                    
    $sidebar ='<!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, '.$user_explode[0].'</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <div class="sidebar-form">
                        <div class="input-group">
                                <input type="text" class="search form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button data-sort="name" class="sort btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li'.(($sub_menu=="dashboard") ? ' class="active"' : '').'>
                            <a href="'.URL_ADMIN.'home.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li'.(($sub_menu=="profile")
                       ? ' class="active"' : '').'>
                            <a href="'.URL_ADMIN.'profile.php">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>
			<li'.(($sub_menu=="customer" || $sub_menu=="pegawai" || $sub_menu=="paket"
                               || $sub_menu=="cabang" || $sub_menu=="master_gps" || $sub_menu=="kendaraan"
                               || $sub_menu=="master_staff" || $sub_menu=="master_dept" || $sub_menu=="voip_number")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Master</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/customer"><i class="fa fa-angle-double-right"></i> Customer</a></li>
                                <li'.(($sub_menu=="master_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/customer_tv_voip"><i class="fa fa-angle-double-right"></i> Customer TV/VOIP</a></li>
                                <li'.(($sub_menu=="master_staff") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/staff"><i class="fa fa-angle-double-right"></i> Staff</a></li>
                                <li'.(($sub_menu=="master_dept") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/bagian"><i class="fa fa-angle-double-right"></i> Department</a></li>
                                <li'.(($sub_menu=="master_cabang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_cabang"><i class="fa fa-angle-double-right"></i> Cabang</a></li>
                                <li'.(($sub_menu=="master_paket") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_paket"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <li'.(($sub_menu=="master_gps") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_gps"><i class="fa fa-angle-double-right"></i> GPS</a></li>
                                <!--<li'.(($sub_menu=="master_kendaraan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_kendaraan"><i class="fa fa-angle-double-right"></i> Kendaraan</a></li>-->
				<li'.(($sub_menu=="voip_number") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/voip_number"><i class="fa fa-angle-double-right"></i> VOIP Number</a></li>
                                <li'.(($sub_menu=="master_area") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_area"><i class="fa fa-angle-double-right"></i> Area</a></li>
                                
                                <li'.(($sub_menu=="master_agama") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_agama"><i class="fa fa-angle-double-right"></i> Agama</a></li>
                                <li'.(($sub_menu=="master_level") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_level"><i class="fa fa-angle-double-right"></i> Level</a></li>
                                <li'.(($sub_menu=="master_ptkp") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_ptkp"><i class="fa fa-angle-double-right"></i> PTKP</a></li>
                                <li'.(($sub_menu=="status_kolektibilitas") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'master/master_status"><i class="fa fa-angle-double-right"></i> Status Kolektibilitas</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_prospek" || $sub_menu=="master_formulir" || $sub_menu=="master_bank"
                               || $sub_menu=="spk_aktivasi" || $sub_menu=="spk_survey" || $sub_menu=="spk_pasang"
                               || $sub_menu=="master_aktivasi" || $sub_menu=="justifikasi" || $sub_menu=="control_justifikasi"
                               || $sub_menu=="acc_justifikasi" || $sub_menu=="bank_masuk"
                               || $sub_menu=="kas_keluar" || $sub_menu=="bank_keluar"
                               || $sub_menu=="kas_keluar" || $sub_menu=="kasir_cso"
                               || $sub_menu=="realisasi_link_budget"
                               )
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Administrasi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_satuan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_satuan"><i class="fa fa-angle-double-right"></i> Master Satuan</a></li>
                                <li'.(($sub_menu=="master_barang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_barang"><i class="fa fa-angle-double-right"></i> Master Barang</a></li>
                                
                                <li'.(($sub_menu=="master_prospek") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_prospek"><i class="fa fa-angle-double-right"></i> Master Prospek</a></li>
                                <li'.(($sub_menu=="master_formulir") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_formulir"><i class="fa fa-angle-double-right"></i> Master Formulir</a></li>
                                <li'.(($sub_menu=="master_bank") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_bank"><i class="fa fa-angle-double-right"></i> Master Bank</a></li>
                                <li'.(($sub_menu=="master_aktivasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_aktivasi.php"><i class="fa fa-angle-double-right"></i> Aktivasi Baru</a></li>
                                <li'.(($sub_menu=="cetak_formulir") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/cetak_formulir"><i class="fa fa-angle-double-right"></i> Cetak Formulir</a></li>
                                
                                
                                <li'.(($sub_menu=="spk_survey") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/spk_survey"><i class="fa fa-angle-double-right"></i> SPK Survey</a></li>
                                <li'.(($sub_menu=="spk_pasang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_spk_pasang_baru.php"><i class="fa fa-angle-double-right"></i> SPK Pasang</a></li>
                                <li'.(($sub_menu=="spk_aktivasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/spk_aktivasi.php"><i class="fa fa-angle-double-right"></i> SPK Aktifasi</a></li>
                                
                                <li'.(($sub_menu=="jawab_spk_survey") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/jawab_survey.php"><i class="fa fa-angle-double-right"></i> Jawab SPK Survey</a></li>
                                <li'.(($sub_menu=="jawab_spk_pasang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_jawaban_spk_pasang_baru.php"><i class="fa fa-angle-double-right"></i> Jawab SPK Pasang</a></li>
                                <li'.(($sub_menu=="jawab_spk_aktivasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_jawab_spk_aktivasi_baru.php"><i class="fa fa-angle-double-right"></i> Jawab SPK Aktifasi</a></li>
                                
                                <li'.(($sub_menu=="justifikasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_permohonan_justifikasi.php"><i class="fa fa-angle-double-right"></i> Permohonan Justifikasi</a></li>
                                <li'.(($sub_menu=="control_justifikasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_control_justifikasi.php"><i class="fa fa-angle-double-right"></i> Control Justifikasi</a></li>
                                <li'.(($sub_menu=="acc_justifikasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/persetujuan_justifikasi.php"><i class="fa fa-angle-double-right"></i> Persetujuan Justifikasi</a></li>
                                
                                <li'.(($sub_menu=="bank_masuk") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_bankmasuk.php"><i class="fa fa-angle-double-right"></i> Bank Masuk</a></li>
                                <li'.(($sub_menu=="kas_masuk") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_kasmasuk.php"><i class="fa fa-angle-double-right"></i> Kas Masuk</a></li>
                                
                                <li'.(($sub_menu=="bank_keluar") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_bankkeluar.php"><i class="fa fa-angle-double-right"></i> Bank Keluar</a></li>
                                <li'.(($sub_menu=="kas_keluar") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_kaskeluar.php"><i class="fa fa-angle-double-right"></i> Kas Keluar</a></li>
                                
                                <li'.(($sub_menu=="kasir_cso") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_kasircso.php"><i class="fa fa-angle-double-right"></i> Kasir CSO</a></li>
                                <li'.(($sub_menu=="invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li'.(($sub_menu=="template_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/setting_invoice.php"><i class="fa fa-angle-double-right"></i> Setting Invoice</a></li>
                                
                                <!--<li'.(($sub_menu=="link_budget") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/link_budget"><i class="fa fa-angle-double-right"></i> Link Budget</a></li>-->
                                <li'.(($sub_menu=="realisasi_link_budget") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/realisasi_linkbudget.php"><i class="fa fa-angle-double-right"></i> Realisasi Link Budget</a></li>
                                <li'.(($sub_menu=="account_statement") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/account_statement.php"><i class="fa fa-angle-double-right"></i> Account Statement</a></li>
                                
                                <li'.(($sub_menu=="topup_dompet") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_topup.php"><i class="fa fa-angle-double-right"></i> Topup Dompet</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_satuan")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Pembelian</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_satuan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_satuan"><i class="fa fa-angle-double-right"></i> Master Satuan</a></li>
                                <li'.(($sub_menu=="master_mu") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_matauang"><i class="fa fa-angle-double-right"></i> Master Mata Uang</a></li>
                                <li'.(($sub_menu=="master_barang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_barang"><i class="fa fa-angle-double-right"></i> Master Barang</a></li>
                                <li'.(($sub_menu=="master_supplier") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_supplier"><i class="fa fa-angle-double-right"></i> Master Supplier</a></li>
                                <li'.(($sub_menu=="master_shipping") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_shipping"><i class="fa fa-angle-double-right"></i> Master Shipping</a></li>
                                <li'.(($sub_menu=="master_gudang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_gudang"><i class="fa fa-angle-double-right"></i> Master Gudang</a></li>
                                <li'.(($sub_menu=="master_lemari") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_lemari"><i class="fa fa-angle-double-right"></i> Master Lemari</a></li>
                                <li'.(($sub_menu=="master_ruang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_ruang"><i class="fa fa-angle-double-right"></i> Master Ruang</a></li>
                                <li'.(($sub_menu=="stock") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/stock"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                
                                <li'.(($sub_menu=="master_permintaanbeli") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_permintaan_pembelian"><i class="fa fa-angle-double-right"></i> Permintaan Beli</a></li>
                                <li'.(($sub_menu=="master_periksa_pembelian") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_periksa_pembelian"><i class="fa fa-angle-double-right"></i> Periksa Pembelian</a></li>
                                <li'.(($sub_menu=="master_setuju_pembelian") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_setuju_pembelian"><i class="fa fa-angle-double-right"></i> Persetujuan Pembelian</a></li>
                                <li'.(($sub_menu=="master_order_beli") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_order_beli"><i class="fa fa-angle-double-right"></i> Order Beli</a></li>
                                <li'.(($sub_menu=="master_beli") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_beli"><i class="fa fa-angle-double-right"></i> Pembelian</a></li>
                                <li'.(($sub_menu=="master_returbeli") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_returbeli"><i class="fa fa-angle-double-right"></i> Retur Pembelian</a></li>
                                <li'.(($sub_menu=="cetak_barcode") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/cetak_barcode"><i class="fa fa-angle-double-right"></i> Cetak Barcode</a></li>
                                <li'.(($sub_menu=="pindah_ruang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/pindah_ruang"><i class="fa fa-angle-double-right"></i> Pindah Ruang</a></li>
                                <li'.(($sub_menu=="master_penjualan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_penjualan"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
                                <li'.(($sub_menu=="hpp") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_hpp"><i class="fa fa-angle-double-right"></i> Harga Pokok</a></li>
                                
                                <li'.(($sub_menu=="pinjam_barang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_pinjam"><i class="fa fa-angle-double-right"></i> Peminjaman Barang</a></li>
                                <li'.(($sub_menu=="retur_barang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_retur"><i class="fa fa-angle-double-right"></i> Pengembalian Barang</a></li>
                                <li'.(($sub_menu=="master_permintaan_pengeluaran_barang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_permintaan_pengeluaran_barang"><i class="fa fa-angle-double-right"></i> Permintaan Pengeluaran Barang</a></li>
                                <li'.(($sub_menu=="master_acc_pengeluaran_barang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/master_acc_pengeluaran_barang"><i class="fa fa-angle-double-right"></i> ACC Pengeluaran Barang</a></li>
                           
                            </ul>
                        </li>
                        <li'.(($sub_menu=="brosur" || $sub_menu=="penawaran" || $sub_menu=="proforma_invoice") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Penawaran</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="penawaran") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'penawaran/master_penawaran.php"><i class="fa fa-angle-double-right"></i> Master Penawaran</a></li>
                                <li'.(($sub_menu=="brosur") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'penawaran/master_brosur.php"><i class="fa fa-angle-double-right"></i> Brosur</a></li>
                                <li'.(($sub_menu=="proforma_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'penawaran/master_profoorma_invoice.php"><i class="fa fa-angle-double-right"></i>Proforma Invoice</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_va" || $sub_menu=="download_va_baru" || $sub_menu=="report_va" || $sub_menu=="upload_request" || $sub_menu=="download_va" || $sub_menu=="laporan_va" || $sub_menu=="generate_va" ) ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Virtual Account</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_va") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'va/master_va.php"><i class="fa fa-angle-double-right"></i> Master VA</a></li>
                                <!--<li'.(($sub_menu=="download_va_baru") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'va/master_download_va_baru.php"><i class="fa fa-angle-double-right"></i> Download VA Baru</a></li>
                                <li'.(($sub_menu=="report_va") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'va/master_report_va.php"><i class="fa fa-angle-double-right"></i> Report VA</a></li>-->
                                <li'.(($sub_menu=="upload_request") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'va/master_upload_request.php"><i class="fa fa-angle-double-right"></i> Upload Request</a></li>
                                <li'.(($sub_menu=="laporan_va") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'va/master_va_upload.php"><i class="fa fa-angle-double-right"></i> Form Cek VA</a></li>
                                <li'.(($sub_menu=="generate_va") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'va/generate_va.php"><i class="fa fa-angle-double-right"></i> Generate VA</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_pegawai_ftm" || $sub_menu=="att_log_ftm" ) ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Pegawai</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_gaji") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'pegawai/master_gaji.php"><i class="fa fa-angle-double-right"></i> Master Gaji</a></li>
                                <li'.(($sub_menu=="master_cuti") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'pegawai/master_cuti.php"><i class="fa fa-angle-double-right"></i> Master Cuti</a></li>
                                <li'.(($sub_menu=="master_pegawai_ftm") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'pegawai/master_pegawai_ftm.php"><i class="fa fa-angle-double-right"></i> Master Pegawai ftm</a></li>
                                <li'.(($sub_menu=="att_log_ftm") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'pegawai/att_log_ftm.php"><i class="fa fa-angle-double-right"></i> att log ftm</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_va" || $sub_menu=="download_va_baru" || $sub_menu=="report_va" || $sub_menu=="upload_request" || $sub_menu=="download_va" || $sub_menu=="laporan_va" || $sub_menu=="generate_va" ) ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Generate Bank Masuk</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_generate_va") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'generate_va/master_generate_va.php"><i class="fa fa-angle-double-right"></i> Data Generate Bank Masuk</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="no_accounting" || $sub_menu=="rab" || $sub_menu=="control_rab" || $sub_menu=="persetujuan_rab" ) ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Accounting</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="no_accounting") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'accounting/master_no_accounting.php"><i class="fa fa-angle-double-right"></i> Master No Accounting</a></li>
                                <li'.(($sub_menu=="rab") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'accounting/master_rab.php"><i class="fa fa-angle-double-right"></i> Master RAB</a></li>
                                <li'.(($sub_menu=="control_rab") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'accounting/master_control_rab.php"><i class="fa fa-angle-double-right"></i> Master Control RAB</a></li>
                                <li'.(($sub_menu=="persetujuan_rab") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'accounting/master_persetujuan_rab.php"><i class="fa fa-angle-double-right"></i> Master Persetujuan RAB</a></li>
                                <li'.(($sub_menu=="ekslarasi_rab") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'accounting/master_ekslarasi_rab.php"><i class="fa fa-angle-double-right"></i> Master Ekslarasi RAB</a></li>
                                <li'.(($sub_menu=="acc_ekslarasi_rab") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'accounting/master_acc_ekslarasi_rab.php"><i class="fa fa-angle-double-right"></i> Master ACC Ekslarasi RAB</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="add_on" || $sub_menu=="aktivasi_add_on" || $sub_menu=="jawab_spk_aktivasi_add_on" || $sub_menu=="jawab_spk_pasang_add_on" || $sub_menu=="spk_aktivasi_add_on" || $sub_menu=="spk_pasang_add_on" ) ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Add On</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="add_on") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'add_on/master_add_on.php"><i class="fa fa-angle-double-right"></i> Master Add On</a></li>
                                <li'.(($sub_menu=="spk_aktivasi_add_on") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'add_on/master_spk_aktivasi_add_on.php"><i class="fa fa-angle-double-right"></i> Master SPK Aktivasi</a></li>
                                <li'.(($sub_menu=="jawab_spk_aktivasi_add_on") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'add_on/master_jawab_spk_aktivasi_add_on.php"><i class="fa fa-angle-double-right"></i> Master Jawab SPK Aktivasi</a></li>
                                <li'.(($sub_menu=="spk_pasang_add_on") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'add_on/master_spk_pasang_add_on.php"><i class="fa fa-angle-double-right"></i> Master SPK Pasang</a></li>
                                <li'.(($sub_menu=="jawab_spk_pasang_add_on") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'add_on/master_jawab_spk_pasang_add_on.php"><i class="fa fa-angle-double-right"></i> Master Jawab SPK pasang</a></li>
                                <li'.(($sub_menu=="aktivasi_add_on") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'add_on/master_aktivasi_add_on.php"><i class="fa fa-angle-double-right"></i> Master Aktivasi Add On</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="surat" || $sub_menu=="send_mail" || $sub_menu=="cetak_surat" ) ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Surat</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="surat") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'surat/master_surat.php"><i class="fa fa-angle-double-right"></i> Master Surat</a></li>
                                <li'.(($sub_menu=="send_mail") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'surat/send_mail_surat.php"><i class="fa fa-angle-double-right"></i> Send Mail Surat</a></li>
                                <li'.(($sub_menu=="cetak_surat") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'surat/cetak_surat.php"><i class="fa fa-angle-double-right"></i> Cetak Surat</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Kontrak, Otorisasi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_kontrak") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kontrak/master_kontrak.php"><i class="fa fa-angle-double-right"></i> Master Kontrak</a></li>
                                <li'.(($sub_menu=="master_perpanjangan_kontrak") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kontrak/master_perpanjangan_kontrak.php"><i class="fa fa-angle-double-right"></i> Master Perpanjangan Kontrak</a></li>
                                <li'.(($sub_menu=="recycle_formulir") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kontrak/master_formulir.php"><i class="fa fa-angle-double-right"></i> Recycle Formulir</a></li>
                                <li'.(($sub_menu=="otorisasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kontrak/master_otorisasi.php"><i class="fa fa-angle-double-right"></i> Otorisasi</a></li>
                               
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_balik_nama" || $sub_menu=="master_invoice_balik_nama" || $sub_menu=="master_inactive"
                               || $sub_menu=="master_reaktivasi" || $sub_menu=="master_invoice_reaktivasi"
                               || $sub_menu == "master_list_barang_customer" || $sub_menu == "master_cek_list_barang_bongkar" )
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Fitur Customer</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_balik_nama") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_balik_nama"><i class="fa fa-angle-double-right"></i>Master Balik Nama</a></li>
                                <li'.(($sub_menu=="master_invoice_balik_nama") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_invoice_balik_nama"><i class="fa fa-angle-double-right"></i>Master Invoice Balik Nama</a></li>
                                <li'.(($sub_menu=="master_inactive") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_inactive"><i class="fa fa-angle-double-right"></i>Master Inactive</a></li>
                                <li'.(($sub_menu=="master_reaktivasi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_reaktivasi"><i class="fa fa-angle-double-right"></i>Master Reaktivasi</a></li>
                                <li'.(($sub_menu=="master_off_connection") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_off_connection"><i class="fa fa-angle-double-right"></i>Master Off Connection</a></li>
                                <li'.(($sub_menu=="master_spk_bongkar") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_spk_bongkar"><i class="fa fa-angle-double-right"></i>Master SPK Bongkar</a></li>
                                <li'.(($sub_menu=="master_list_barang_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_list_barang_customer"><i class="fa fa-angle-double-right"></i>Master List Barang</a></li>
                                <li'.(($sub_menu=="master_jawaban_spk_bongkar") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_jawaban_spk_bongkar"><i class="fa fa-angle-double-right"></i>Master Jawaban SPK Bongkar</a></li>
                                <li'.(($sub_menu=="master_cek_list_barang_bongkar") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_cek_list_barang_bongkar"><i class="fa fa-angle-double-right"></i>Master Cek List Gudang Bongkar</a></li>
                                <li'.(($sub_menu=="master_open_connection") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_open_connection"><i class="fa fa-angle-double-right"></i>Master Open Connection</a></li>
                                <li'.(($sub_menu=="master_spk_maintance") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_spk_maintance"><i class="fa fa-angle-double-right"></i>Master SPK Maintance</a></li>
                                <li'.(($sub_menu=="master_link_budget_maintance") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'fitur_customer/master_link_budget_maintance"><i class="fa fa-angle-double-right"></i>Master Link Budget Maintance</a></li>
                                 
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="master_gps" || $sub_menu=="master_kendaraan" || $sub_menu=="master_asuransi" || $sub_menu=="check_gps" || $sub_menu=="pemakaian_kendaraan")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Kendaraan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_gps") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kendaraan/master_gps"><i class="fa fa-angle-double-right"></i>Master GPS</a></li>
                                <li'.(($sub_menu=="master_kendaraan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kendaraan/master_kendaraan"><i class="fa fa-angle-double-right"></i>Master Kendaraan</a></li>
                                <li'.(($sub_menu=="master_asuransi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kendaraan/master_asuransi"><i class="fa fa-angle-double-right"></i>Master Asuransi</a></li>
                                <li'.(($sub_menu=="check_gps") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kendaraan/check_gps"><i class="fa fa-angle-double-right"></i>Check GPS</a></li>
                                <li'.(($sub_menu=="pemakaian_kendaraan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'kendaraan/pemakaian_kendaraan"><i class="fa fa-angle-double-right"></i>Pemakaian Kendaraan</a></li> 
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i>
                                <span>Menu Tambahan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="generate_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'system/generate_invoice.php"><i class="fa fa-angle-double-right"></i> Generate Invoice</a></li>
                                <li'.(($sub_menu=="grace_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_grace_customer.php"><i class="fa fa-angle-double-right"></i> Grace Customer</a></li>
                                <li'.(($sub_menu=="upgrade_downgrade") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_updown_connection.php"><i class="fa fa-angle-double-right"></i> Upgrade/Downgrade</a></li>
                                <li'.(($sub_menu=="konversi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_konversi.php"><i class="fa fa-angle-double-right"></i> Master Konversi</a></li>
                                <li'.(($sub_menu=="spk_pasang_konversi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_spk_pasang_konversi.php"><i class="fa fa-angle-double-right"></i> Spk Pasang Konversi</a></li>
                                <li'.(($sub_menu=="jawab_spk_pasang_konversi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_jawab_spk_pasang_konversi.php"><i class="fa fa-angle-double-right"></i> Jawab Spk Pasang Konversi</a></li>
                                <li'.(($sub_menu=="spk_aktivasi_konversi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_spk_aktivasi_konversi.php"><i class="fa fa-angle-double-right"></i> Spk Aktivasi Konversi</a></li>
                                <li'.(($sub_menu=="jawab_spk_aktivasi_konversi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_jawab_spk_aktivasi_konversi.php"><i class="fa fa-angle-double-right"></i> Jawab Spk Aktivasi Konversi</a></li>
                                <li'.(($sub_menu=="aktivasi_konversi") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'help_desk/master_aktivasi_konversi.php"><i class="fa fa-angle-double-right"></i> Aktivasi Konversi</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="link_budget")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i> <span>Network Administrator</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li'.(($sub_menu=="link_budget") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'network/link_budget"><i class="fa fa-angle-double-right"></i> Link Budget</a></li>-->
                                <li'.(($sub_menu=="master_bts") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'network/master_bts.php"><i class="fa fa-angle-double-right"></i> Master BTS</a></li>
                                <li'.(($sub_menu=="link_budget") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'administrasi/link_budget"><i class="fa fa-angle-double-right"></i> Link Budget</a></li>
                                
                            </ul>
                        </li>
                        <li'.(($sub_menu=="helpdesk_dashboard" || $sub_menu=="helpdesk_form_complaint" || $sub_menu=="helpdesk_troubleticket" || $sub_menu=="helpdesk_complaint" || $sub_menu=="helpdesk_prospek"
                               || $sub_menu=="helpdesk_nonprospek" || $sub_menu=="helpdesk_spktech" || $sub_menu=="helpdesk_spkmkt")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-desktop"></i> <span>Helpdesk</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="helpdesk_form_complaint") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/form_complaint.php"><i class="fa fa-angle-double-right"></i> Form Incoming</a></li>
                                <li'.(($sub_menu=="helpdesk_complaint") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/incoming.php?type=complaint"><i class="fa fa-angle-double-right"></i> Incoming</a></li>
                                <li'.(($sub_menu=="helpdesk_troubleticket") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/incoming.php?type=troubleticket"><i class="fa fa-angle-double-right"></i> Troubleticket</a></li>
                                <li'.(($sub_menu=="helpdesk_prospek") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/incoming.php?type=prospek"><i class="fa fa-angle-double-right"></i> Prospek</a></li>
                                <li'.(($sub_menu=="helpdesk_nonprospek") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/incoming.php?type=nonprospek"><i class="fa fa-angle-double-right"></i> Non-Prospek</a></li>
                                <li'.(($sub_menu=="helpdesk_spktech") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/incoming.php?type=spktech"><i class="fa fa-angle-double-right"></i> SPK Teknisi</a></li>
                                <li'.(($sub_menu=="helpdesk_spkmkt") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/incoming.php?type=spkmkt"><i class="fa fa-angle-double-right"></i> SPK Marketing</a></li>
                                <li'.(($sub_menu=="summary") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/summary.php"><i class="fa fa-angle-double-right"></i> Summary</a></li>
                                <li'.(($sub_menu=="graph") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/graph.php"><i class="fa fa-angle-double-right"></i> Graph</a></li>
				
                            </ul>
                        </li>
                        <li'.(($sub_menu=="compose" || $sub_menu=="mailbox" || $sub_menu=="setting") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-envelope"></i> <span>Email</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="compose") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/compose_email.php"><i class="fa fa-angle-double-right"></i> Compose</a></li>
                                <li'.(($sub_menu=="mailbox") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/mailbox.php"><i class="fa fa-angle-double-right"></i> Inbox</a></li>
                                <li'.(($sub_menu=="setting") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/setting_email.php"><i class="fa fa-angle-double-right"></i> Setting Email</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="Bali" || $sub_menu=="Balikpapan" || $sub_menu=="Samarinda" || $sub_menu=="Malang") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa  fa-comment"></i> <span>Chat</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="Bali") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/chat.php"><i class="fa fa-angle-double-right"></i> Bali</a></li>
                                <li'.(($sub_menu=="Balikpapan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/chat.php?locate=bpn"><i class="fa fa-angle-double-right"></i> Balikpapan</a></li>
                                <li'.(($sub_menu=="Malang") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/chat.php?locate=mlg"><i class="fa fa-angle-double-right"></i> Malang</a></li>
				<li'.(($sub_menu=="Samarinda") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/chat.php?locate=smd"><i class="fa fa-angle-double-right"></i> Samarinda</a></li>				
                            </ul>
                        </li>
                        <li'.(($sub_menu=="newsletter_add" || $sub_menu=="newsletter_list")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>Newsletter</span>
				<i class="fa fa-angle-left pull-right"></i>
                            </a>
			    <ul class="treeview-menu">
                                <li'.(($sub_menu=="newsletter_add") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/newsletter"><i class="fa fa-angle-double-right"></i> Add Newsletter</a></li>
                                <li'.(($sub_menu=="newsletter_list") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'helpdesk/list_newsletter"><i class="fa fa-angle-double-right"></i> List Newsletter</a></li>				
                            </ul>
                        </li>
                        
                        <li'.(($sub_menu=="inet_dashboard" || $sub_menu=="inet_invoice" || $sub_menu=="inet_detailinv"
                               || $sub_menu=="inet_payment" || $sub_menu=="inet_sesshistory"  || $sub_menu=="inet_telnet"
                               || $sub_menu == "inet_datausage" || $sub_menu == "inet_limiter" || $sub_menu == "inet_grouptime"
                               || $sub_menu == "inet_server_ras" || $sub_menu == "inet_command" || $sub_menu == "inet_multiple" )
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Internet/Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_ip") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'network/master_ip.php"><i class="fa fa-angle-double-right"></i> Master IP Inet</a></li>
                                <li'.(($sub_menu=="master_ip") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'network/ip_blokir.php"><i class="fa fa-angle-double-right"></i> Master IP Blokir</a></li>
                                <li'.(($sub_menu=="master_vlan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'network/master_vlan.php"><i class="fa fa-angle-double-right"></i> Master VLAN</a></li>
                                <li'.(($sub_menu=="inet_invoice") ? ' class="active"' : '').'><a href=""><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li'.(($sub_menu=="inet_payment") ? ' class="active"' : '').'><a href=""><i class="fa fa-angle-double-right"></i> Payment History</a></li>
                                <li'.(($sub_menu=="inet_sesshistory") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/session_history.php"><i class="fa fa-angle-double-right"></i> Session History</a></li>
                                <li'.(($sub_menu=="inet_telnet") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/form_telnet.php"><i class="fa fa-angle-double-right"></i> Telnet Command</a></li>
                                <li'.(($sub_menu=="inet_datausage") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/data_usage.php"><i class="fa fa-angle-double-right"></i> Data Usage</a></li>
                                <li'.(($sub_menu=="inet_grouptime") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_group.php"><i class="fa fa-angle-double-right"></i> Group Timer</a></li>
                                <li'.(($sub_menu=="inet_server_ras") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_server_ras.php"><i class="fa fa-angle-double-right"></i> List Server</a></li>
                                <li'.(($sub_menu=="inet_command") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_command.php"><i class="fa fa-angle-double-right"></i> List Command</a></li>
                                <li'.(($sub_menu=="inet_multiple") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_multiple_cmd.php"><i class="fa fa-angle-double-right"></i> List Multiple Command</a></li>
                                <li'.(($sub_menu=="inet_filter") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_filter.php"><i class="fa fa-angle-double-right"></i> List Filter Group </a></li>
                                <li'.(($sub_menu=="list_olt_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_olt_customer.php"><i class="fa fa-angle-double-right"></i> List OLT Customer</a></li>
                                <li'.(($sub_menu=="monitoring_onu") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/monitoring_onu.php"><i class="fa fa-angle-double-right"></i> Monitoring ONU </a></li>
                                <li'.(($sub_menu=="monitoring_olt") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/list_olt_inactive_customer.php"><i class="fa fa-angle-double-right"></i> Monitoring OLT (Inactive) </a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="voip_customers" ||$sub_menu=="voip_invoice" || $sub_menu=="voip_detinv" || $sub_menu=="voip_payment" || $sub_menu=="voip_group"
                               || $sub_menu=="voip_callhistory" || $sub_menu=="voip_refills" || $sub_menu=="voip_voucher" || $sub_menu=="voip_upgrade" || $sub_menu=="voip_cdrcustomer"
                               || $sub_menu=="voip_cdr" || $sub_menu=="voip_dnid" || $sub_menu=="voip_cdrreport" || $sub_menu=="voip_trunk" || $sub_menu=="voip_provider"
                               || $sub_menu=="callerid" || $sub_menu=="customer_balance")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-phone-square"></i>
                                <span>VOIP BALI</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="voip_customers") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/list_customer.php"><i class="fa fa-angle-double-right"></i> Customers</a></li>
                                <li'.(($sub_menu=="customer_balance") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/customer_balance.php"><i class="fa fa-angle-double-right"></i> Customers Balance</a></li>
                                <li'.(($sub_menu=="callerid") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/callerid.php"><i class="fa fa-angle-double-right"></i>Caller ID</a></li>
                                <li'.(($sub_menu=="voip_group") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/group.php"><i class="fa fa-angle-double-right"></i> Group</a></li>
                                <li'.(($sub_menu=="subscription") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/subscription.php"><i class="fa fa-angle-double-right"></i>Subscriptions Service</a></li>
                                <li'.(($sub_menu=="subscriber") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/subscriber.php"><i class="fa fa-angle-double-right"></i>Subscriber</a></li>
                                
                                <li'.(($sub_menu=="voip_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/vinvoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li'.(($sub_menu=="voip_payment") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/payment.php"><i class="fa fa-angle-double-right"></i> Payment</a></li>
                                <li'.(($sub_menu=="voip_callhistory") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/call_history.php"><i class="fa fa-angle-double-right"></i> Call History</a></li>
                                <li'.(($sub_menu=="voip_trunk") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/trunk.php"><i class="fa fa-angle-double-right"></i> Trunk</a></li>
                                <li'.(($sub_menu=="voip_provider") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/provider.php"><i class="fa fa-angle-double-right"></i> Provider</a></li>
                                <li'.(($sub_menu=="voip_refills") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/log_refill.php"><i class="fa fa-angle-double-right"></i> Refills</a></li>
                                <li'.(($sub_menu=="voip_voucher") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/vouchers.php"><i class="fa fa-angle-double-right"></i> Voucher</a></li>
                                <li'.(($sub_menu=="voip_dnid") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/dnid.php"><i class="fa fa-angle-double-right"></i> DNID</a></li>
                                <!--<li'.(($sub_menu=="voip_upgrade") ? ' class="active"' : '').'><a href=""><i class="fa fa-angle-double-right"></i> Up/DownGrade</a></li>-->
                                <li'.(($sub_menu=="voip_cdrcustomer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/cdrs.php"><i class="fa fa-angle-double-right"></i> CDRs Customer</a></li>
                                <li'.(($sub_menu=="voip_cdrreport") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/cdr_report.php"><i class="fa fa-angle-double-right"></i> CDR Report</a></li>
                                <li'.(($sub_menu=="voip_cdr") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/cdr_history.php"><i class="fa fa-angle-double-right"></i> Monitoring</a></li>
                                <li'.(($sub_menu=="audit_voip") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip/audit_voip.php"><i class="fa fa-angle-double-right"></i> Audit</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="voip_bpn_customers" ||$sub_menu=="voip_bpn_invoice" || $sub_menu=="voip_bpn_detinv" || $sub_menu=="voip_bpn_payment" || $sub_menu=="voip_bpn_group"
                               || $sub_menu=="voip_bpn_callhistory" || $sub_menu=="voip_bpn_refills" || $sub_menu=="voip_bpn_voucher" || $sub_menu=="voip_bpn_upgrade" || $sub_menu=="voip_bpn_cdrcustomer"
                               || $sub_menu=="voip_bpn_cdr" || $sub_menu=="voip_bpn_dnid" || $sub_menu=="voip_bpn_cdrreport" || $sub_menu=="voip_bpn_trunk" || $sub_menu=="voip_bpn_provider"
                               || $sub_menu=="bpn_callerid" || $sub_menu=="bpn_customer_balance")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-phone-square"></i>
                                <span>VOIP BPN</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="voip_bpn_customers") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/list_customer.php"><i class="fa fa-angle-double-right"></i> Customers</a></li>
                                <li'.(($sub_menu=="bpn_customer_balance") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/customer_balance.php"><i class="fa fa-angle-double-right"></i> Customers Balance</a></li>
                                <li'.(($sub_menu=="bpn_callerid") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/callerid.php"><i class="fa fa-angle-double-right"></i>Caller ID</a></li>
                                <li'.(($sub_menu=="bpn_voip_group") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/group.php"><i class="fa fa-angle-double-right"></i> Group</a></li>
                                <li'.(($sub_menu=="bpn_subscription") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/subscription.php"><i class="fa fa-angle-double-right"></i>Subscriptions Service</a></li>
                                <li'.(($sub_menu=="bpn_subscriber") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/subscriber.php"><i class="fa fa-angle-double-right"></i>Subscriber</a></li>
                                
                                <li'.(($sub_menu=="voip_bpn_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/vinvoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li'.(($sub_menu=="voip_bpn_payment") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/payment.php"><i class="fa fa-angle-double-right"></i> Payment</a></li>
                                <li'.(($sub_menu=="voip_bpn_callhistory") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/call_history.php"><i class="fa fa-angle-double-right"></i> Call History</a></li>
                                <li'.(($sub_menu=="voip_bpn_trunk") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/trunk.php"><i class="fa fa-angle-double-right"></i> Trunk</a></li>
                                <li'.(($sub_menu=="voip_bpn_provider") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/provider.php"><i class="fa fa-angle-double-right"></i> Provider</a></li>
                                <li'.(($sub_menu=="voip_bpn_refills") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/log_refill.php"><i class="fa fa-angle-double-right"></i> Refills</a></li>
                                <li'.(($sub_menu=="voip_bpn_voucher") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/vouchers.php"><i class="fa fa-angle-double-right"></i> Voucher</a></li>
                                <li'.(($sub_menu=="voip_bpn_dnid") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/dnid.php"><i class="fa fa-angle-double-right"></i> DNID</a></li>
                                
                                <li'.(($sub_menu=="voip_bpn_cdrcustomer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/cdrs.php"><i class="fa fa-angle-double-right"></i> CDRs Customer</a></li>
                                <li'.(($sub_menu=="voip_bpn_cdrreport") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/cdr_report.php"><i class="fa fa-angle-double-right"></i> CDR Report</a></li>
                                <li'.(($sub_menu=="voip_bpn_cdr") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/cdr_history.php"><i class="fa fa-angle-double-right"></i> Monitoring</a></li>
                                <li'.(($sub_menu=="audit_voip_bpn") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'voip_bpn/audit_voip.php"><i class="fa fa-angle-double-right"></i> Audit</a></li>
                            </ul>
                        </li>
                        <!--<li'.(($sub_menu=="vod_member" ||$sub_menu=="vod_invoice" || $sub_menu=="vod_topupsaldo" 
                               || $sub_menu=="vod_tvchannel" || $sub_menu=="vod_tvschedule")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-laptop"></i> <span>VOD</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="vod_member") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'vod/member.php"><i class="fa fa-angle-double-right"></i> Member</a></li>
                                <li'.(($sub_menu=="vod_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'vod/list_invoice.php"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Payment History</a></li>
				<li'.(($sub_menu=="vod_topupsaldo") ? ' class="active"' : '').'><a href="#"><i class="fa fa-angle-double-right"></i> Top Up Saldo</a></li>
                                <li'.(($sub_menu=="vod_tvchannel") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'vod/list_paket_tv.php"><i class="fa fa-angle-double-right"></i> TV Channel</a></li>
                                <li'.(($sub_menu=="vod_tvschedule") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'vod/schedule.php"><i class="fa fa-angle-double-right"></i> TV Schedule</a></li>
                            </ul>
                        </li>-->
                        <li'.(($sub_menu=="channel_provider" || $sub_menu=="master_paket" || $sub_menu=="stb_user" || $sub_menu=="log" || $sub_menu=="live_channel") ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-laptop"></i> <span>GX TV</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="master_paket") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'tv/paket.php"><i class="fa fa-angle-double-right"></i> Paket</a></li>
                                <li'.(($sub_menu=="stb_user") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'tv/stb_user.php"><i class="fa fa-angle-double-right"></i> STB User</a></li>
                                <li'.(($sub_menu=="belipaket") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'tv/list_logbeli.php"><i class="fa fa-angle-double-right"></i> List Log Beli</a></li>
                                <li'.(($sub_menu=="payment") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'tv/list_payment.php"><i class="fa fa-angle-double-right"></i> Payment</a></li>
                                <li'.(($sub_menu=="channel_provider") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'tv/master_provider.php"><i class="fa fa-angle-double-right"></i> Master Provider</a></li>
                                <li'.(($sub_menu=="channel_provider") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'tv/subscriber_channel.php"><i class="fa fa-angle-double-right"></i> Subscriber Management System</a></li>
                                <li'.(($sub_menu=="live_channel") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'live/channel.php"><i class="fa fa-angle-double-right"></i> Channel TV</a></li>
                                <li'.(($sub_menu=="live_channel") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'live/channel_epg.php"><i class="fa fa-angle-double-right"></i> Channel EPG</a></li>
                                <li'.(($sub_menu=="log") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'/tv/log"><i class="fa fa-angle-double-right"></i> Log</a></li>
                            </ul>
                        </li>
                        
                        <li'.(($sub_menu=="report_blokir" || $sub_menu=="report_voip" || $sub_menu=="report_helpdesk" || $sub_menu=="report_generate_invoice")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="report_blokir") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'report/report_blokir.php"><i class="fa fa-angle-double-right"></i>Report Blokir</a></li>
                                <li'.(($sub_menu=="report_voip") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'report/report_voip.php"><i class="fa fa-angle-double-right"></i>Report Voip</a></li>
                                <li'.(($sub_menu=="report_voip") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'report/billing_voip.php"><i class="fa fa-angle-double-right"></i>Billing Voip</a></li>
                                <li'.(($sub_menu=="report_helpdesk") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'report/report_helpdesk.php"><i class="fa fa-angle-double-right"></i>Report Helpdesk</a></li>
                                <li'.(($sub_menu=="report_generate_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'report/generate_invoice.php"><i class="fa fa-angle-double-right"></i>Generate Invoice</a></li>
                                <li'.(($sub_menu=="report_maintenance") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'report/maintenance.php"><i class="fa fa-angle-double-right"></i>Maintenance</a></li>
                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Setting Perusahaan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="setting_perusahaan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/setting_perusahaan.php"><i class="fa fa-angle-double-right"></i> Setting Perusahaan</a></li>
                                <li'.(($sub_menu=="report_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/report_customer.php"><i class="fa fa-angle-double-right"></i> Report Customer</a></li>
                                <li'.(($sub_menu=="setting_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/setting_invoice.php"><i class="fa fa-angle-double-right"></i> Setting Invoice</a></li>
                                <li'.(($sub_menu=="setting_jadwal_masuk") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/form_setting_jadwal_masuk.php"><i class="fa fa-angle-double-right"></i>Setting Jadwal Masuk</a></li>
                                <li'.(($sub_menu=="setting_reminder_intern") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/form_setting_reminder_intern.php"><i class="fa fa-angle-double-right"></i>Setting Reminder Intern</a></li>
                                <li'.(($sub_menu=="laporan_customer") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/form_laporan_customer.php"><i class="fa fa-angle-double-right"></i>Laporan Customer</a></li>
                                <li'.(($sub_menu=="laporan_keuangan") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/form_laporan_keuangan.php"><i class="fa fa-angle-double-right"></i>Laporan Keuangan</a></li>
                                <li'.(($sub_menu=="laporan_mrtg") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/form_laporan_mrtg.php"><i class="fa fa-angle-double-right"></i>Laporan MRTG</a></li>
                                <li'.(($sub_menu=="setting_generate_invoice") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/setting_generate_invoice.php"><i class="fa fa-angle-double-right"></i> Generate Invoice</a></li>
                                <li'.(($sub_menu=="setting_prioritas") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'setting/prioritas.php"><i class="fa fa-angle-double-right"></i> Prioritas</a></li>
                            </ul>
                        </li>
                        <li'.(($sub_menu=="template_email" || $sub_menu=="template_sms")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Notifikasi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="template_email") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'template/list_email.php"><i class="fa fa-angle-double-right"></i> Template Email</a></li>
                                <li'.(($sub_menu=="template_sms") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'template/list_sms.php"><i class="fa fa-angle-double-right"></i> Template SMS</a></li>
                                
                            
                            </ul>
                        </li>
                        <li'.(($sub_menu=="system_user" || $sub_menu=="logs")
                       ? ' class="treeview active"' : ' class="treeview"').'>
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>System</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li'.(($sub_menu=="system_user") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'system/role_management.php"><i class="fa fa-angle-double-right"></i> Role Management</a></li>
                                <li'.(($sub_menu=="system_user") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'system/user.php"><i class="fa fa-angle-double-right"></i> User Management</a></li>
                                <li'.(($sub_menu=="logs") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'log_detail.php"><i class="fa fa-angle-double-right"></i> Logs</a></li>
                            
                            </ul>
                        </li>
                    </ul>';
    //<li'.(($sub_menu=="inet_limiter") ? ' class="active"' : '').'><a href="'.URL_ADMIN.'data/setting_limiter.php"><i class="fa fa-angle-double-right"></i> Setting Limiter</a></li>
    $title = ($title != "") ? "Panel Customer (beta) - $title" : "Panel Customer (beta)";

    
    //MailBox
    //$sql_mailbox    = mysql_query("SELECT * FROM `gx_email` WHERE `kategori` = '' ORDER BY `DateE` DESC");
    //$sum_mailbox    = mysql_num_rows($sql_mailbox);
    
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title.'</title>
        
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/x-icon" href="'.URL.'img/favicon.ico" sizes="16x16" />
        <!-- bootstrap 3.0.2 -->
        <link href="'.URL.'css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="'.URL.'css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="'.URL.'css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="'.URL.'css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="'.URL.'css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="'.URL.'css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="'.URL.'css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="'.URL.'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="'.URL.'css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="'.URL.'js/html5shiv.js"></script>
          <script src="'.URL.'js/respond.min.js"></script>
        <![endif]-->
	
    </head>
    <body class="skin-black">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="'.URL_ADMIN.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GlobalXtreme</span></a>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        '.Email_notification().'
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        '.$user.'
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript: logout();" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    '.$sidebar.'
                    
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                '.$content.'
	    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div id="notification"></div>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="'.URL.'js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="'.URL.'js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="'.URL.'js/bootstrap.min.js" type="text/javascript"></script>
        
	<!-- AdminLTE App -->
        <script src="'.URL.'js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- JS list Search menu -->
        <script src="'.URL.'js/list.min.js" type="text/javascript"></script>
<script language="javascript">
//jslist
var options = {
    valueNames: [ \'name\', \'subname\' ]
};

var userList = new List(\'menu\', options);
</script>

	'.$plugins.'

<script language="javascript">
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {';
	if($group == "admin")
        {
            $template .='window.location.href = "'.URL_ADMIN.'logout.php";';
        }elseif($group == "cso")
        {
            $template .='window.location.href = "'.URL_CSO.'logout.php";';
        }
        
        
$template .='
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }

</script>
<!-- Growl Notification -->
<script src="'.URL.'js/plugins/growl/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#notification\').load(\''.URL_ADMIN.'ajax/notif.php\');
        }, 20000); 
    });
    
</script>
</body>
</html>';



return $template;

}


function admin_theme_popup($title="",$content="",$plugins="",$user="",$sub_menu="",$group="")
{
    
    $title = ($title != "") ? "Panel Administrator (beta) - $title" : "Panel Administrator (beta) ";
    $sidebar = '';
    $template ='<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>'.$title.'</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap 3.0.2 -->
        <link href="'.URL.'css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="'.URL.'css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="'.URL.'css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="'.URL.'css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
	
	
	
    </head>
    <body class="skin-blue">
	        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="'.URL_ADMIN.'home.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Logo" src="'.URL.'img/logo20.png"/> &nbsp;
                <span>GlobalXtreme</span></a>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="'.URL.'img/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        '.$user.'
                                        
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript: logout();" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            '.$sidebar.'

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                '.$content.'
	    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
        <div id="notification"></div>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="'.URL.'js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="'.URL.'js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="'.URL.'js/bootstrap.min.js" type="text/javascript"></script>
        
	<!-- AdminLTE App -->
        <script src="'.URL.'js/AdminLTE/app.js" type="text/javascript"></script>    
        
	'.$plugins.'


<script language="javascript">
//Added by dwi
//confirm message for logout.
function logout() {
    if (confirm("Anda yakin untuk keluar ?")) {
	   
       window.location.href = "'.URL_ADMIN.'logout.php";
    }
}
//open popup window
function valideopenerform(url,title){
	var popy= window.open(url,title,"toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
	if (window.focus) {popy.focus()}
	return false;
    }
</script>

<!-- Growl Notification -->
<script src="'.URL.'js/plugins/growl/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#notification\').load(\''.URL.'ajax/notif.php\');
        }, 20000); 
    });
    
</script>

</body>
</html>';

return $template;

}

function Email_notification()
{
    
    global $conn;
    
    $sql_email    = mysql_query("SELECT `customer_number`, `Subject`, `DateE`, `EmailFromP` FROM `gx_email` ORDER BY `DateE` DESC LIMIT 0,10;", $conn);
    $total_email  = mysql_num_rows($sql_email);
    
    
    $mail_notification = '<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">'.$total_email.'</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have '.$total_email.' messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">';
    while($row_email = mysql_fetch_array($sql_email))
    {
        if($row_email["customer_number"] != "")
        {
            $customer_number = $row_email["customer_number"];
            $sql_customer    = mysql_query("SELECT `cNama` FROM `tbCustomer` WHERE `cKode` = '".$customer_number."' LIMIT 0,1;", $conn);
            $row_customer    = mysql_fetch_array($sql_customer);
            
        }
        
        $mail_notification .= '<li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="'.URL.'img/avatar.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    '.(($row_email["customer_number"] != "") ? $row_customer["cNama"] : $row_email["EmailFromP"] ).'
                                                    <small><i class="fa fa-clock-o"></i>'.(date("H:i", strtotime($row_email["DateE"]))).'</small>
                                                </h4>
                                                <p>'.substr($row_email["Subject"], 0, 20).' ...</p>
                                            </a>
                                        </li><!-- end message -->';
    }
    
$mail_notification .='
                                    </ul>
                                </li>
                                <li class="footer"><a href="'.URL.'/helpdesk/mailbox.php">See All Messages</a></li>
                            </ul>
                        </li>';
                        
    return $mail_notification;
}