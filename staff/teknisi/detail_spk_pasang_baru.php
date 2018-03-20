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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail SPK Pasang Baru");
    global $conn;
    global $conn_voip;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
     
$sql_last_data  = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_pasang`", $conn)) + 1;
 //echo date("Y-m-d H:i:s");   
	    if(isset($_GET['id_spk_pasang_baru'])){
		$get_id = isset($_GET['id_spk_pasang_baru']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_spk_pasang_baru']))) : "";
		$data_spk_pasang_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_spkpasang` = '$get_id';", $conn));
		$data_spk_pasang_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_spk_pasang_baru[id_teknisi]'", $conn));
		$data_spk_pasang_baru_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$data_spk_pasang_baru[id_marketing]'", $conn));
	    }
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Form SPK Pasang Baru                        
                    </h1>
                    
                </section>
		<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				
        <form action="" role="form" name="myForm"  method="POST" >
	  
	  <input type="hidden" style="" name="id_spk_pasang_baru" value="'.(isset($_GET['id_spk_pasang_baru']) ? $_GET['id_spk_pasang_baru'] :"").'" />
          
	<div >
	    <fieldset>
		<legend>Data SPK Pasang Baru</legend>
		<div class="table-container table-form">		    
		    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="namecabang" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_cabang'] :"") .'">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_cabang'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>No. SPK Pasang Baru</label>
			</div>
					    <div class="col-xs-4">
						
			
			  <input type="text" readonly="" class="form-control required" style="" name="kode_spk" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru["kode_spk"] :"") .'" />
			 </div>
					    <div class="col-xs-2">
						
			  <label>Tanggal</label>
			</div>
					    <div class="col-xs-4">
					
			  <input class="form-control" name="id_spk_pasang_baru" type="hidden" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $_GET["id_spk_pasang_baru"] :"") .'" readonly="">
			  <input class="form-control required" readonly="" name="tanggal" id="tanggal" placeholder="Tanggal" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['tanggal'] : date("Y-m-d") ) .'" >
			  </div>
                                        </div>
					</div>
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Kode Customer</label>
			</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_customer'] :"") .'" >
			
			</div>
					    <div class="col-xs-2">
					
			
			  <label>Nama Customer</label>
			 </div>
					    <div class="col-xs-4">
					
			  <input class="form-control" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_customer'] : "") .'">

			
			
				</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
	 <div class="col-xs-2">
			  <label>No. Link Budget</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="id_linkbudget" readonly="" placeholder="No Link Budget" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_linkbudget'] :"") .'" >
	
	 </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Paket Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="paket_koneksi"  readonly="" placeholder="Paket Koneksi" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['paket_koneksi'] :"") .'" >
	 </div>
					    <div class="col-xs-2">
			  <label>Nama Koneksi</label>
	</div>
					    <div class="col-xs-4">
			  <input class="form-control" name="nama_koneksi"  readonly=""  placeholder="Nama Koneksi" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_koneksi'] :"") .'" >
	 </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>User ID</label>
			</div>
			<div class="col-xs-4">
			  <input class="form-control" name="user_id" readonly="" placeholder="User ID" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['user_id'] :"") .'">
			<!--<a href="data_paket.php?r=myForm"  onclick="return valideopenerform(\'data_paket.php?r=myForm\',\'paket\');">Search Paket</a>-->
			  
			
		</div>
					    <div class="col-xs-2">
	
			      <label>Telpon</label>
	</div>
	<div class="col-xs-4">
			    <input class="form-control" readonly="" name="telpon" placeholder="Telepon" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['telpon'] :"") .'">
		        
				</div></div></div>
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alamat</label>
	</div>
	<div class="col-xs-10">
			    <input class="form-control" readonly="" name="alamat" placeholder="alamat" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['alamat'] :"") .'">
		        </div>
			
			   </div></div>
	
	
	<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Teknisi</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_teknisi" type="hidden" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_teknisi'] :"") .'">
		        <input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru_teknisi['nama'] :"") .'">
		        
			</div>
			<div class="col-xs-2">
			  <label>Marketing</label>
	</div>
	<div class="col-xs-4">
			<input class="form-control" name="id_employee" type="hidden" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_marketing'] :"") .'">
		        <input class="form-control" readonly="" name="nama_marketing" placeholder="Nama Marketing" type="text" value="'.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru_marketing['nama'] :"") .'">
		        
			</div>
			   </div></div>
			   
			   
			
			<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Perkerjaan</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="pekerjaan" readonly="" class="form-control" placeholder="Pekerjaan" style="resize: none;"> '.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['pekerjaan'] :"").' </textarea>
			</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru["user_upd"]." ".$data_spk_pasang_baru["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
			
	    </fieldset>
	    </div>
	
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<div class="box">
                                <div class="box-body table-responsive">
							<legend>Data Jawab SPK Pasang</legend>
								  <table id="example1" class="table table-bordered table-striped">
												  <thead>
													<tr>	<th width="3%">no</th>
											  <th width="12%">Tanggal</th>
											  <th width="20%">No Jawab SPK Pasang</th>
											  <th>Solusi</th>
											  <th width="15%">Action</th>
													</tr>
												  </thead>
												  <tbody>';
								  
								  
									  $sql_jawab_spk_pasang_baru	= mysql_query("SELECT * FROM `gx_jawab_spkpasang`
												  WHERE `level` =  '0' AND `id_teknisi` = '$loggedin[id_employee]' AND
												  `kode_spk` = '$data_spk_pasang_baru[kode_spk]'
												  ORDER BY  `date_add` DESC LIMIT $start, $perhalaman;", $conn);
									  $sql_total_jawab_spk_pasang_baru	= mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_pasang`
												  WHERE `level` =  '0' AND `id_teknisi` = '$loggedin[id_employee]'  AND
												  `kode_spk` = '$data_spk_pasang_baru[kode_spk]'
												  ORDER BY  `date_add` DESC;", $conn));
									  $hal	="?";
									  $no = 1;
								  
									  while($r_spk_pasang_baru = mysql_fetch_array($sql_jawab_spk_pasang_baru))
									  {
									  $content .='<tr>
											  <td>'.$no.'.</td>
											  <td>'.$r_spk_pasang_baru['tanggal'].'</td>
											  <td>'.$r_spk_pasang_baru['kode_jawab_spk'].'</td>
											  <td>'.$r_spk_pasang_baru['solusi'].'</td>
											  <td><a href="detail_jawab_spk_pasang_baru.php?id_jawab_spk_pasang_baru='.$r_spk_pasang_baru["id_jawab_spkpasang"].'">Details</a>
										  </tr>';
									  $no++;
									  }
								  
								  $content .='</tbody>
								  </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail SPK Pasang Baru';
    $submenu	= "spk_pasang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;

    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>