<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
	$sql_data = "SELECT * FROM `gx_service_plan` WHERE `level` = '0' LIMIT $start, $perhalaman;";
	//echo $sql_staff;
	$query_data = mysql_query($sql_data, $conn);
	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_service_plan` WHERE  `level` = '0';", $conn));
	$hal = "?";

    $content ='<section class="content-header">
                    <h1>
                        Service Plan
                        
                    </h1>
                    
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
						
							<div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">PRODUCT METRO DEDICATED LINK</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Specification
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body">
                          <table class="table table-striped">
								<tr>
								  <th style="width: 10px">No</th>
								  <th>Description</th>
								  <th>Home</th>
								  <th>Pro</th>
								  <th>Premium</th>
								</tr>
								<tr>
								  <td>1.</td>
								  <td>Type of Service</td>
								  <td colspan="3" align="center">Metro Dedicated Link</td>
								</tr>
								<tr>
								  <td>2.</td>
								  <td>Package Names</td>
								  <td>Xtreme Home</td>
								  <td>Xtreme Pro</td>
								  <td>Xtreme Premium</td>
								</tr>
								<tr>
								  <td>3.</td>
								  <td>Bandwidth</td>
								  <td>DL 6 Mbps</td>
								  <td>DL 8 Mbps</td>
								  <td>DL 12 Mbps</td>
								</tr>
								<tr>
								  <td>4.</td>
								  <td>Market Segment</td>
								  <td colspan="3" align="center">Home User, Small Office, Home Office, Budget Hotel</td>
								</tr>
								<tr>
								  <td>5.</td>
								  <td>Ratio UP-DOWN Link</td>
								  <td colspan="3" align="center">1:1</td>
								</tr>
								<tr>
								  <td>6.</td>
								  <td>Bandwidth Guarantee</td>
								  <td colspan="3" align="center">50% from packets purchased</td>
								</tr>
								<tr>
								  <td>7.</td>
								  <td>SLA</td>
								  <td colspan="3" align="center">98%</td>
								</tr>
								<tr>
								  <td>8.</td>
								  <td>Type of Bandwidth</td>
								  <td colspan="3" align="center">Unlimited</td>
								</tr>
								<tr>
								  <td>9.</td>
								  <td>Type of IP Address (Managed by GX)</td>
								  <td>Private</td>
								  <td>Public</td>
								  <td>Public</td>
								</tr>
								<tr>
								  <td>10.</td>
								  <td>Network in Used</td>
								  <td colspan="3" align="center">Double Link</td>
								</tr>
								<tr>
								  <td>11.</td>
								  <td>Specifically for Xtreme Home</td>
								  <td colspan="3" align="center">IP Public 200.000 for additional fee (Managed by GlobalXtreme)</td>
								</tr>
								<tr>
								  <td>12.</td>
								  <td>Maintenance Fee</td>
								  <td colspan="3" align="center">2 times per month free of charge,  3rd Pay 100.000 for 1 hour first, and 50.000 for next 30 minutes</td>
								</tr>
								<tr>
								  <td>13.</td>
								  <td>Bayar diawal bulanan</td>
								  <td colspan="3" align="center">Monthly Fee bulan ke 1 dan bulan ke 12</td>
								</tr>
								<tr>
								  <td>14.</td>
								  <td>Perlakuan untuk bulanan ke 12</td>
								  <td colspan="3" align="center">Akan terus begeser di tahun berikutnya, tahun ke 2 akan menjadi dibulan 24</td>
								</tr>
								<tr>
								  <td>15.</td>
								  <td>Kontrak</td>
								  <td colspan="3" align="center">12 bulan, ada lebih, karena bayarnya di awal sistem prorate</td>
								</tr>
								<tr>
								  <td>16.</td>
								  <td>Perpanjangan Kontrak</td>
								  <td colspan="3" align="center">Perpanjangan secara otomatis apabila tidak ada pemberitahuan paling lambat 1 bulan sebelum jatuh tempo</td>
								</tr>
								<tr>
								  <td>17.</td>
								  <td>Kualitas Streaming<br>
								  Telephone<br>
								  Aktivasi Telp</td>
								  <td colspan="3" align="center">HD 80%<br>
								  On Demand<br>
								  SIP Phone : 350.000 , Dompet : 100.000, Abonemen : 60.000 
								  </td>
								</tr>
								<tr>
								  <td>18.</td>
								  <td>Customer Service</td>
								  <td colspan="3" align="center">Bilingual</td>
								</tr>
								<tr>
								  <td>19.</td>
								  <td>Setup Fee</td>
								  <td colspan="3" align="center">Rp 3.000.000,-</td>
								</tr>
								<tr>
								  <td>20.</td>
								  <td>Monthly Fee</td>
								  <td>Rp 1.000.000,-</td>
								  <td>Rp 1.600.000,-</td>
								  <td>Rp 2.500.000,-</td>
								</tr>
								<tr>
								  <td>21.</td>
								  <td>Harga Non Kontrak</td>
								  <td colspan="3" align="center">Harga ditambah 20% harus lewat masa kontrak 1 tahun. Tidak ada prorate. Bayar full</td>
								</tr>
								<tr>
								  <td>22.</td>
								  <td>Bonus Paket</td>
								  <td colspan="3" align="center">Free 20 Channel, Biaya langganan TV Cable</td>
								</tr>
								<tr>
								  <td>23.</td>
								  <td>Aktivasi TV</td>
								  <td colspan="3" align="center">Aktivasi : 100.000, Dompet : 100.000, Sewa STB per bulan : 60.000 </td>
								</tr>
								<tr>
								  <td>24.</td>
								  <td>PPN dan Faktur Pajak</td>
								  <td colspan="3" align="center">Enable</td>
								</tr>
								<tr>
								  <td>25.</td>
								  <td>Biaya Terminasi</td>
								  <td colspan="3" align="center">2-4 bulan : 3.000.000 ; 5-7 bulan : 2.000.000 ; 8-11 bulan : 1.000.000</td>
								</tr>
							  </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            TOS (Term of Service)
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
                          <p>Berikut ini adalah syarat dan ketentuan antara Pelanggan dan PT. Internet Madju Abad Milenindo, yang akan disebut sebagai GlobalXtreme dari awal hingga akhir. Pelanggan dan GlobalXtreme telah sampai pada kesepakatan sesuai dengan syarat dan ketentuan berikut.</p><br><br>
																										
Harap membaca syarat dan ketentuan ini dengan teliti.<br><br>
																										
<b>I.	TAGIHAN DAN PEMBAYARAN</b><br>
	1.	Pelanggan setuju untuk membayar Biaya Instalasi koneksi internet sesuai dengan paket koneksi sesuai dengan paket yang dipilih, dan pembayaran yang sudah diterima GlobalXtreme tidak dapat ditarik kembali dengan alasan apapun. Biaya Instalasi tersebut tidak termasuk perangkat tambahan (misal: access point, kabel LAN, switch hub, dll) dan tidak termasuk biaya koneksi internet awal pada saat aktivasi. Perijinan dan Biaya Perijinan untuk kawasan, area, dan/atau gedung tempat Pelanggan, menjadi tanggung jawab Pelanggan.																								<br>
	2.	Pada saat regristrasi Pelanggan diwajibkan untuk membayar bulan ke 1 dan bulan ke 12. Dimana untuk bulan ke 1 sisa dari prorate akan diakui sebagai uang muka di bulan ke 2.																								<br>
	3.	Jangka waktu kontrak berlangganan layanan koneksi Fiber Optik selama 12 (dua belas) bulan terhitung sejak ditandatanganinya Berita Acara Aktivasi dengan ketentuan sebagai berikut:																								<br>
		a.	Pelanggan wajib berlangganan tanpa putus selama 12 (dua belas) bulan masa kontrak.						<br>
		b.	Pelanggan yang akan habis masa kontraknya, jika tidak ingin berlangganan lagi, maka wajib memberikan informasi minimal 1 bulan sebelum habis masa kontrak. Apabila pelanggan tidak memberikan informasi 1 bulan sebelumnya, maka secara otomatis akan diperpanjang masa kontrak pelanggan. Apabila pelanggan meneruskan untuk berlangganan di tahun ke 2, maka secara otomatis monthly fee bulan ke 12 menjadi monthly fee bulan ke 24, demikian seterusnya.																							<br>
		c.	Bagi pelanggan lama yang masih dalam masa kontrak, berkehendak untuk pindah ke paket baru, dikenakan biaya sebesar Rp 300.000. Dan harus melakukan renew kontrak, sesuai dengan peraturan baru dengan melakukan pembayaran di depan untuk bulan ke 1 dan bulan ke 12																							<br>
		d.	Apabila Pelanggan mengajukan Relokasi (di dalam area /di luar area) maka Pelanggan tersebut harus membayar biaya instalasi seperti Pelanggan Baru.																							<br>
		e.	Pada alamat yang sama, pelanggan dapat mengajukan reposisi perangkat dengan membayar biaya material dan jasa.																							<br>
	5.	Pelanggan baru setuju membayar biaya registrasi sebesar 100% dari total biaya instalasi. Pada waktu registrasi pelanggan diwajibkan untuk membayar bulan pertama dan bulan ke dua belas di depan.				<br>																				
		Cara Pembayaran:																								<br>
		a.	Pindah buku ke GlobalXtreme virtual account 																	<br>						
		b.	Membayar secara langsung di kantor GlobalXtreme secara tunai atau memakai kartu kredit.								<br>															
		Semua uang muka yang telah dibayarkan oleh Pelanggan kepada GlobalXtreme tidak dapat ditarik kembali dengan alasan apapun.	<br>																							
	6.	Pelanggan baru harus melakukan pembayaran atau pelunasan sisa biaya instalasi dalam waktu 2 (dua) hari setelah ditandatanganinya berita acara aktivasi.																								<br>
	7.	GlobalXtreme akan mengirimkan e-mail tagihan otomatis tanpa diperlukan tanda tangan (Automatic Generated Billing By System) kepada Pelanggan, setiap tanggal 1 (satu) di awal bulan ke alamat email yang tercantum pada formulir registrasi. Jangka waktu untuk melakukan pembayaran adalah selambat-lambatnya tanggal 3 (tiga) setiap bulannya.  Kegagalan dalam penerimaan email tagihan tidak menyebabkan perpanjangan masa pembayaran.																								<br>
	8.	GlobalXtreme hanya menyediakan paket koneksi bulanan yang tidak dapat dihitung secara harian dan menggunakan sistem prabayar. Keterlambatan penerimaan pembayaran setelah tanggal 3, menyebabkan sistim tagihan otomatis, memutuskan koneksi internet.																								<br>
	9.	Pelanggan baru maupun pelanggan lama harus melakukan pembayaran/pelunasan seluruh transaksi yang ada dalam waktu maksimum 3 hari untuk transaksi pembelian alat/jasa maintenance, dan 3 hari  untuk masa pembayaran koneksi setiap bulan. Harap diingat pembayaran yang belum dilakukan lebih dari tempo yang sudah ditentukan akan menyebabkan automatic biiling system memutuskan koneksi internet.																								<br>
	10.	Metode Pembayaran GlobalXtreme																								<br>
		a.	Pindah buku langsung pada BCA Virtual Account (detail harap lihat tagihan bulanan). Pemindahan buku beda bank memerlukan waktu 2 (dua) sampai 3 (tiga) hari kerja.																							<br>
		b.	Secara tunai debit BCA atau kartu kredit di kantor GlobalXtreme (detail alamat lihat pada lampiran data informasi pelanggan).																							<br>
		c.	Pembayaran online dengan menggunakan merchant kartu kredit visa dan master melalui website resmi Globalxtreme:https://globalxtreme.net/new/payment/login.php (silakan masuk ke website Globalxtreme dan pilih tab online payment).																							<br>
																										<br>
<b>II.	SIKLUS PEMBAYARAN	</b>																					<br>			
	1.	Tagihan dikirimkan secara otomatis melalui email pada tanggal 1 (satu) setiap bulannya ke alamat email pelanggan. Kegagalan dalam penerimaan email tagihan tidak menyebabkan perpanjangan masa pembayaran.																								<br>
	2.	Pengingat akan dikirimkan melalui email pada tanggal 2 (dua) setiap bulannya kepada pelanggan yang belum melakukan pembayaran atau sudah melakukan pembayaran tetapi belum teridentifikasi.																								<br>
	3.	Pengingat terakhir akan dikirimkan melalui email pada tanggal 3 (tiga) dibulan tersebut kepada pelanggan yang belum melakukan pembayaran.																								<br>
	4.	Pelanggan yang belum melakukan pembayaran sampai dengan tanggal 3 (tiga) atau sudah melakukan pembayaran tetapi dana belum efektif diterima pada rekening perusahaan, maka system tagihan otomatis, akan memutus koneksi internet pelanggan pada tanggal 4 di bulan tersebut. Koneksi internet akan otomatis tersambung kembali dalam jangka waktu maksimum 1 x 24 jam setlah pembayaran  diterima efektif pada rekening perusahaan.																								<br>
	5.	Bila pembayaran tidak diterima selama tiga bulan berturut-turut, maka pelanggan dianggap melakukan terminasi dini sesuai dengan pasal berhenti berlangganan point 1.																								<br>
	6.	Untuk berlangganan kembali dengan Globalxtreme, pelanggan harus melakukan pembayaran biaya terminasi dini apabila belum lunas dan melakukan registrasi baru.																								<br>
																										<br>
<b>III.	PERANGKAT KERAS		</b>																				<br>			
	System pemakaian perangkat adalah sebagai berikut:																		<br>							
	1.	Peralatan yang terpasang di pelanggan adalah milik Globalxtreme dan dijelaskan lebih terperinci di formulir instalasi. Apabila terjadi kerusakan pada alat tersebut akibat kelalaian dari pelanggan, (misal : rusak akibat jatuh, terpukul, kabel pigtail putus termasuk barang hilang dan lain-lain), maka pelanggan akan dikenakan biaya penggantian/perbaikan alat tersebut.																								<br>
	2.	GlobalXtreme dapat mengambil perangkat (sesuai dengan form instalasi). Setiap saat, apabila pelanggan tidak lagi berlangganan.																								<br>
	3.	Pelanggan bersedia membayar biaya instalasi kelebihan kabel  dan atau tiang yang ditambahkan adalah hak milik perusahaan (Globalxtreme).																						<br>		
																										<br>
<b>IV.	HAK DAN TANGGUNG JAWAB PELANGGAN</b>																									<br>
	Peningkatan dan penurunan kapasitas bandwidth dan fasilitas koneksi.																									<br>
	1.	Pelanggan masih dalam masa kontrak 12 bulan pertama hanya dapat meminta penambahan kapasitas bandwidth sesuai dengan paket yang tersedia. 																								<br>
																										<br>
<b>V.	GANTI NAMA			</b>																					<br>	
	1.	Apabila pelanggan akan merubah nama ataupun pergantian register untuk nama akun internetnya maka harus atas persetujuan dan pengetahuan dari pelanggan yang melakukan register pertama kali, dan untuk pergantian nama akun internet akan dikenakan biaya Rp.100.000,- dengan syarat:																								<br>
		a.	Koneksi internet dalam status aktif																							<br>
		b.	Tidak ada piutang																							<br>
		c.	Koneksi berada di lokasi yang sama																							<br>
		d.	Customer bersedia untuk melakukan kontrak baru dengan GlobalXtreme dan menandatangani term and condition baru (dengan periode kontrak berlangganan 1 tahun). Akan tetapi pergantian contact dan telephone ataupun alamat email yang sewaktu-waktu pelanggan akan mengalami perubahan, pelanggan hanya cukup menginformasikan kepada pihak Globalxtreme mengenai perubahan contact tersebut.																							<br>
																										<br>
<b>VI.	BERHENTI BERLANGGANAN	</b>																								<br>
	1.	Jika pelanggan berhenti berlangganan sebelum masa kontrak berakhir, maka pelanggan diwajibkan membayar biaya penalty sebagai berikut:																								<br>
		a.	Berhenti di bulan ke 2-4 : Rp 3,000,000																							<br>
		b.	Berhenti di bulan ke 5-7 : Rp 2,000,000																							<br>
		c.	Berhenti di bulan ke 8-11 : Rp 1,000,000																							<br>
	2.	Jika pelanggan berhenti berlangganan setelah masa kontrak, maka harus mengisi formulir berhenti berlangganan di kantor Globalxtreme.																								<br>
	3.	GlobalXtreme dapat memutuskan koneksi secara sepihak apabila:																								<br>
		a.	Permintaan dari pihak yang berwajib (misal kepolisian, permintaan HAKI, instansi pemerintah, dan para pemegang regulasi internet)							<br>																
		b.	Pelanggan melakukan penyerangan dan spaming pada server atau institusi lain.																					<br>		
																										<br><br>
<b>VII.	PERJANJIAN LAYANAN	</b>																					<br>			
	1.	Koneksi fiber optic ini adalah paket Dedicated Link. Sesuai dengan paket bandwidth yang telah dipilih.		<br>																						
	2.	GlobalXtreme bertanggung jawab terhadap koneksi dari perangkat ONU Pelanggan sampai dengan gateway internasional (Singapura). 																								<br>
	3.	Minimum bandwidth yang didapat rata-rata adalah sebesar 50% dari paket yang dipilih.																								<br>
	4.	Pelanggan bertanggung jawab terhadap jaringan LAN (Local area network) di sisi Pelanggan (apabila ada) yang termasuk wireless access point, server, PC, laptop/notebook, router, ip camera dan mobile phone dll.																								<br>
	5.	Pelanggan  dapat meminta GlobalXtreme  untuk datang membantu memperbaiki permasalahan dengan koneksi LAN sesuai dengan ketersediaan jadwal tim perawatan (GlobalXtreme)  dan bersedia untuk membayar biaya jasa perbaikan.																								<br>
		Perusahaan (GlobalXtreme)  tidak bertanggung jawab atas segala klaim kerusakan atau gagal fungsi dari perangkat LAN, serta kehilangan barang dalam bentuk apapun, setelah teknisi meninggalkan tempat Pelanggan.																								<br>
	6.	Free kunjungan teknisi akan diberikan kepada Pelanggan setiap bulan maksimal 2x kunjungan. Apabila lebih dari 2x maka akan dikenakan biaya per kunjungan Rp 100.000 pada 1 jam pertama dan 50.000 pada kelipatan 30 menit berikutnya.																								<br>
	7.	GlobalXtreme akan memberikan restitusi kepada Pelanggan apabila mengalami downtime lebih dari 24 (dua puluh empat)  jam setiap kejadian (kejadian tidak bisa diakumulasikan dalam 1 bulan). Restitusi akan diberikan dalam bentuk bandwidth.  Sebagai contoh : jika Pelanggan  mengalami downtime selam 50 (lima puluh) jam, GlobalXtreme akan memberikan Pelanggan double bandwidth selama 50 (lima puluh) jam. Misalnya jika Pelanggan  berlangganan paket up to 1024 kbps, maka Pelanggan akan mendaptkan paket up to 2048 kbps selama 50 jam.																								<br>
																										<br><br>
<b>VIII.	PENGAKUAN	</b>																							<br>	
	1.	Pelanggan mengakui bahwa LAN (Local Area Network) menjadikan tanggung jawab Pelanggan sepenuhnya.							<br>																	
	2.	Perusahaan GlobalXtreme mengakui bahwa koneksi dari ONU sampai ke jaringan GlobalXtreme  menjadi tanggung jawab perusahaan (GlobalXtreme)  sepenuhnya.		<br><br>																						
																										
<b>IX.	PENOLAKAN		</b>																							<br>
	1.	Perushaan (GlobalXtreme)  tidak bertanggung jawab atas segala penggunaan illegal terhadap jasa layanan internet (download/upload illegal/copyrighted content)		<br>																						
	2.	Perusahaan (GlobalXtreme)  tidak bertanggung jawab atas kerugian, kehilanggan atau pengeluaran yang timbul dari kemampuan pelanggan atau ketidakmampuan untuk menggunakan layanan internet GlobalXtreme.																								<br>
																										<br>
<b>X.	BENCANA ALAM</b>																							<br>		
	1.	Bencana Alam adalah kejadian yang tidak dapat diduga dan tidak dapat dihindarkan. Dengan ketentuan bahwa masing-masing pihak yang bersangkutan telah mengambil langkah yang diperlukan guna menghindari atau memperkecil kerusakan dan kerugian.																								<br>
	2.	Pelanggan dan Perusahaan (GlobalXtreme)  tidak bertanggung jawab atas terhentinya atau tertundanya pemenuhan perjanjian dalam hal terjadinya keadaan kahar antara lain bencana alam (termasuk gempa bumi, tanah longsor, banjir, badai, angin topan, kebakaran, perang, huru-hara, pemogokan, pemberotakan dan epidemic, perudang-undangan pemerintah yang secara langsung mempengaruhi kontrak ini)																								<br>
	3.	Pihak yang terkena Bencana Alam wajib memberitahukan secara tertulis kepada pihak lainnya paling lambat dalam jangka waktu 7 (tujuh) hari kalender sejak saat terjadinya dan saat berakhirnya kejadian tersebut.																								<br>
	4.	Kerugian yang diderita salah satu pihak akibat Bencana Alam bukan merupakan tanggung jawab pihak lainnya.																								<br>
																										<br><br>
<b>XI.	PENUTUP		</b>																							<br>
	1.	Syarat dan ketentuan ini menjadi satu bagian yang tidak terpisahkan dan tidak dapat berdiri sendiri serta saling berkaitan dengan form registrasi, berita acara aktivasi, form pembayaran uang muka, form perubahan paket koneksi, form perubahan alamat email, surat pernyataan, form data informasi pelanggan, form perpanjangan kontrak dan form berhenti berlangganan yang disesuaikan dengan setiap perubahan yang terjadi di dalamnya selama masa kontrak.																								<br>
<br>
<br>
<hr></hr>
<br>
<p>The following are the terms and conditions between Customer and PT. Internet Madju Abad Milenindo, which will be referred to as GlobalXtreme from beginning to end. Customers and GlobalXtreme have come to an agreement in accordance with the following terms and conditions.</p><br><br>
																										
Please read these terms and conditions carefully.<br><br>
																										
<b>I.	BILLING AND PAYMENT</b><br>
	1.	Customer agrees to pay the installation fee Internet connection in accordance with connection packages according to the package selected, and the payment has been received GlobalXtreme can not be withdrawn for any reason. Installation costs are not included enhancements (eg, access point, LAN cables, switch hub, etc.) and do not include the cost of internet connections beginning upon activation. Permitting and licensing fees for the region, area, and / or the building in which the Customer, the responsibility of the customer.																							<br>
	2.	At the time of registration Customers are required to pay the 1st month and the 12th month. Where\'s the rest of the 1st month prorate will be recognized as an advance in the 2nd month.																								<br>
	3.	The term of the subscription contract Fibre Optic connection service for twelve (12) months from the signing of the Minutes Activation with the following conditions:																							<br>
		a.	Subscriber must subscribe without interruption for twelve (12) months of the contract period.						<br>
		b.	Customers who will be out of contract, if you do not want to subscribe again, it shall provide at least 1 month prior to expiry of the contract. Where the customer provides information one month earlier, it will automatically be extended term customer contracts. If customers continue to subscribe in the second year, then automatically the monthly fee 12 months to become a monthly fee for 24 months, and so on.																							<br>
		c.	For existing customers who are still in the contract period, intends to move to the new package, pay 300,000 IDR. And must renew the contract, in accordance with the new regulations to make a payment up front for month 1 and month 12																						<br>
		d.	When customers apply for relocation (in the area / outside area) then the customer must pay the cost of installation as New Customers.																							<br>
		e.	At the same address, customers can apply for the repositioning of the device by paying the cost of materials and services.																							<br>
	5.	New customers agree to pay a registration fee of 100% of the total cost of installation. At the time of registration the customer is required to pay the first month and the twelfth month ahead.				<br>																				
		Payment method:																								<br>
		a.	Move the book to the virtual account GlobalXtreme 																	<br>						
		b.	Pay directly at the office GlobalXtreme in cash or use a credit card.								<br>															
		All the advances that have been paid by the Customer to GlobalXtreme can not be withdrawn for any reason.	<br>																							
	6.	New customers must make payment or repayment of the rest of the installation cost within 2 (two) days after the signing of the minutes of activation.																							<br>
	7.	GlobalXtreme will email an automatic charge without the required signature (Automatic Generated By Billing System) to Customer, any date 1 (one) at the beginning of the month to the email address listed on the registration form. The time period for making a payment is not later than 3 (three) every month. Failure in email reception bill did not cause an extension of the payment period.																							<br>
	8.	GlobalXtreme only provide a package of monthly connections that can not be calculated daily and use a prepaid system. Delays in the receipt of payment after the third, causing the automatic charge system, disconnect the Internet connection.																						<br>
	9.	New customers and old customers to make the payment / repayment of all existing transactions within a maximum of 3 days for the purchase of equipment / maintenance services, and three days for payment connections every month. Please remember that payment has not been made over a specified tempo will cause the automatic disconnect system billing internet connection.																								<br>
	10.	Payment Methods GlobalXtreme																								<br>
		a.	Move book directly on the BCA Virtual Account (detail please see the monthly bill). The transfer books bank depending takes two (2) to three (3) working days.																						<br>
		b.	BCA cash debit or credit card at GlobalXtreme office (see address details in annex customer information data).																							<br>
		c.	Online payments using a credit card merchant visa and master through Globalxtreme official website: https: //globalxtreme.net/new/payment/login.php (please go to the website and select the tab Globalxtreme online payment).																							<br>
																										<br>
<b>II.	CYCLE PAYMENT	</b>																					<br>			
	1.	The bill sent automatically by email on 1 (one) per month to the customer\'s email address. Failure in email reception bill did not cause an extension of the payment period.																							<br>
	2.	Reminders will be sent via email on the 2nd (two) each month to customers who have not made a payment or have made a payment but have not been identified.																								<br>
	3.	Last reminder will be sent via email on the date 3 (three) of the month to customers who have not made a payment.																							<br>
	4.	Customers who do not make payment until the date 3 (three) or have made a payment but the funds have not been effectively received on account of the company, then the automatic billing system, will cut a customer\'s internet connection on the 4th of the month. The internet connection will automatically reconnect within a period of a maximum of 1 x 24 hours setlah effective payment received on account of the company.																								<br>
	5.	If payment is not received for three consecutive months, then the customer is considered early terminated in accordance with clause unsubscribe point 1.																								<br>
	6.	To subscribe again with Globalxtreme, customers must pre-pay an early termination fee if not paid off and a new registration.																								<br>
																										<br>
<b>III.	HARDWARE		</b>																				<br>			
	System use of the device is as follows:																		<br>							
	1.	Equipment installed at the customer are the property Globalxtreme and described in more detail in the form of installation. If there is damage to the appliance due to the negligence of the customer, (for example: damaged due to fall, hit, dropping pigtail cable including missing items, etc.), then the customer will be charged the cost of replacement / repair the equipment.																							<br>
	2.	GlobalXtreme can take the device (in accordance with the installation form). At any time, if the customer is no longer subscribe.																							<br>
	3.	Customers are willing to pay the excess cable and installation costs are added or pole is proprietary (Globalxtreme).																					<br>		
																										<br>
<b>IV.	RIGHTS AND RESPONSIBILITIES OF THE CUSTOMER</b>																									<br>
	Increases and decreases in bandwidth capacity and connection facilities.																									<br>
	1.	Customers are still in the first 12 months of the contract may only request additional bandwidth capacity in accordance with available packages. 																								<br>
																										<br>
<b>V.	CHANGE NAME			</b>																					<br>	
	1.	If the customer will change the name or register for an account name change of its Internet then it must be with the consent and knowledge of the customer to register first, and for a change of name of the internet account will be charged 100,000,- IDR provided that:																							<br>
		a.	The internet connection is active																						<br>
		b.	No receivables																							<br>
		c.	Connections are in the same location																							<br>
		d.	Customer is willing to undertake a new contract with GlobalXtreme and sign the new terms and conditions (with a contract period of 1 year subscription). But the turn of contact and telephone or email address at any time the customer will change, customers just simply inform the Globalxtreme about changes that contact.																							<br>
																										<br>
<b>VI.	UNSUBSCRIBE	</b>																								<br>
	1.	If the customer unsubscribes before the contract expires, the customer is required to pay a penalty fee as follows:																								<br>
		a.	Stopped in 2-4 months: 3,000,000 IDR																					<br>
		b.	Stopped in 5-7 months: 2,000,000 IDR																					<br>
		c.	Stopped in months 8-11: 1,000,000 IDR																						<br>
	2.	If customer unsubscribe after the contract period, it must fill out a form in the office Globalxtreme unsubscribe.																								<br>
	3.	GlobalXtreme can disconnect unilaterally if:																								<br>
		a.	Demand from the authorities (eg police, request IPR, government agencies, and the holders of internet regulation)							<br>																
		b.	Customers attack and spoofing the server or other institutions.																					<br>		
																										<br><br>
<b>VII.	SERVICE AGREEMENT	</b>																					<br>			
	1.	The fiber optic connection is Dedicated Link package. In accordance with the bandwidth packages that have been selected.		<br>																						
	2.	GlobalXtreme responsible for the connection of devices to the gateway ONU Customers International (Singapore).																								<br>
	3.	Minimum bandwidth obtained on average is 50% of the package selected.																								<br>
	4.	Customer is responsible for the LAN (Local area network) at the side of the customer (if any) that includes a wireless access point, server, PC, laptop / notebook, router, ip camera and mobile phone etc.																								<br>
	5.	Customers may request GlobalXtreme to come help fix problems with a LAN connection in accordance with the availability schedule maintenance team (GlobalXtreme) and are willing to pay the cost of repair services.																							<br>
		Companies (GlobalXtreme) is not responsible for any claims of damage or malfunction of the LAN device, as well as the loss of goods in any form, after the technician leaves a customer.																								<br>
	6.	Free visits of technicians will be given to customers every month up to 2x the visit. If more than 2x will be charged per visit 100,000 IDR in the first 1 hour and 50,000 in increments of 30 minutes.																								<br>
	7.	GlobalXtreme will give refunds to customers when experiencing downtime more than 24 (twenty four) hours each occurrence (incidence can not be accumulated in one month). Restitution will be provided in the form of bandwidth. For example: if customers experience downtime subs 50 (fifty) hours, GlobalXtreme will give customers double the bandwidth for 50 (fifty) hours. For example if customers subscribe to packages up to 1024 kbps, then the Customer will mendaptkan package up to 2048 kbps for 50 hours.																								<br>
																										<br><br>
<b>VIII.	RECOGNITION	</b>																							<br>	
	1.	Customer acknowledges that the LAN (Local Area Network) to make the responsibility of the customer fully.						<br>																	
	2.	GlobalXtreme companies recognize that the connection of the ONU to the network GlobalXtreme be the responsibility of the company (GlobalXtreme) completely.		<br><br>																						
																										
<b>IX.	DENIAL		</b>																							<br>
	1.	Companies (GlobalXtreme) is not responsible for any illegal use of the internet service (download / upload illegal / copyrighted content)		<br>																						
	2.	Companies (GlobalXtreme) is not responsible for any damage, loss or expense arising from the customer\'s ability or inability to use the internet service GlobalXtreme.																								<br>
																										<br>
<b>X.	NATURAL DISASTERS</b>																							<br>		
	1.	Natural disasters are events that are unpredictable and unavoidable. Provided that each of the parties concerned have taken the necessary steps to avoid or minimize damage and loss.																								<br>
	2.	Customer and Company (GlobalXtreme) is not responsible for the stoppage or delay the fulfillment of agreements in the event of force majeure include natural disasters (including earthquakes, landslides, floods, storms, hurricanes, fires, wars, riots, strikes, rebellion and epidemic, perudang government regulations which directly affect this contract)																								<br>
	3.	Natural disasters affected party shall notify in writing to the other party no later than within 7 (seven) calendar days from the time of the occurrence and the end of the incident.																								<br>
	4.	The losses suffered by one of the parties due to Natural Disasters is not the responsibility of other parties.																							<br>
																										<br><br>
<b>XI.	COVER		</b>																							<br>
	1.	These terms and conditions become an integral part and can not stand alone and interconnected with the registration form, the minutes of activation, the form of advance payments, the form changes to the package connection, form email address changes, affidavit, form data customer information, form a contract extension and unsubscribe form adapted to any changes that occur in it during the contract period.																								<br>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Pricing and Fee
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                          Pricing and Fee
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                            
			  
							
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List CSO';
    $submenu	= "cso";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>