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
if($loggedin["group"] == 'staff'){

     global $conn;
     $conn_soft = Config::getInstanceSoft();
     
     $tipe	= isset($_GET['tipe']) ? mysql_real_escape_string(strip_tags(trim($_GET['tipe']))) : "";
     $return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Select $tipe");
     
     $plugins ='';

     if($tipe == "account_index")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select = $conn_soft ->prepare("SELECT [AccountIndex], [AccountName], [AccountDescription]
						  FROM [dbo].[AccountTypes]
						  WHERE [AccountName] LIKE '%".$nama."%';");
	       $sql_select->execute();
	  }else
	  {
	       $sql_select = $conn_soft ->prepare("SELECT [AccountIndex], [AccountName], [AccountDescription]
						  FROM [dbo].[AccountTypes];");
	       $sql_select->execute();
	  }
	  
	  $plugins .='<script type="text/javascript">
	  function selectdata(uid,  nama){
	       window.opener.document.'.$return_form.'.account_index.value=uid;
	       window.opener.document.'.$return_form.'.account_name.value=nama;
	       self.close();
	       }
	  </script>';
	  
       
     }elseif($tipe == "group_name")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select = $conn_soft ->prepare("SELECT [GroupIndex], [GroupName], [NASAttributes],
					     [AccountIndex], [TimeBank], [KBBank], [Active]
					     FROM [dbo].[Groups]
					     WHERE [GroupName] LIKE '%".$nama."%';");
	       $sql_select->execute();
	  }else
	  {
	       $sql_select = $conn_soft ->prepare("SELECT [GroupIndex], [GroupName], [NASAttributes],
					     [AccountIndex], [TimeBank], [KBBank], [Active]
					     FROM [dbo].[Groups];");
	       $sql_select->execute();
	  }
	  $plugins .='<script type="text/javascript">
	  function selectdata(uid,  nama){
	       window.opener.document.'.$return_form.'.group_index.value=uid;
	       window.opener.document.'.$return_form.'.group_name.value=nama;
	       self.close();
	       }
	  </script>';
		
     }elseif($tipe == "kendaraan")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select 	= mysql_query("SELECT `gx_kendaraan`.*, `gx_cabang`.`nama_cabang` FROM `gx_kendaraan`,`gx_cabang`
					      WHERE `gx_kendaraan`.`nama_kendaraan` LIKE '%".$nama."%'
					      AND `gx_kendaraan`.`id_cabang` = `gx_cabang`.`id_cabang`
					      AND `gx_kendaraan`.`level`='0' LIMIT 0,10;", $conn);
	  }else
	  {
	       $sql_select	= mysql_query("SELECT `gx_kendaraan`.*, `gx_cabang`.`nama_cabang` FROM `gx_kendaraan`,`gx_cabang`
					      WHERE `gx_kendaraan`.`id_cabang` = `gx_cabang`.`id_cabang`
					      AND `gx_kendaraan`.`level`='0' LIMIT 0,10;", $conn);

	  }
	  $plugins .='<script type="text/javascript">
	  function selectdata(uid,  nama){
	       window.opener.document.'.$return_form.'.id_kendaraan.value=uid;
	       window.opener.document.'.$return_form.'.nama_kendaraan.value=nama;
	       self.close();
	       }
	  </script>     ';
	  
     }elseif($tipe == "pegawai")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select 	= mysql_query("SELECT `gx_kendaraan`.*, `gx_cabang`.`nama_cabang` FROM `gx_kendaraan`,`gx_cabang`
					      WHERE `gx_kendaraan`.`nama_kendaraan` LIKE '%".$nama."%'
					      AND `gx_kendaraan`.`id_cabang` = `gx_cabang`.`id_cabang`
					      AND `gx_kendaraan`.`level`='0' LIMIT 0,10;", $conn);
	  }else
	  {
	       $sql_select	= mysql_query("SELECT * FROM `tbPegawai`
					      WHERE `level`='0' LIMIT 0,10;", $conn);
	  }
	  $plugins .='<script type="text/javascript">
	  function selectdata(uid,  nama){
	       window.opener.document.'.$return_form.'.id_employee.value=uid;
	       window.opener.document.'.$return_form.'.nama_employee.value=nama;
	       self.close();
	       }
	  </script>     ';
     }elseif($tipe == "tvchannel")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select 	= mysql_query("SELECT * FROM `gx_tv_packages`
					      WHERE `name_package` LIKE '%".$nama."%'
					      AND `level` = '0'
					      LIMIT 0,10;", $conn);
	  }else
	  {
	       $sql_select	= mysql_query("SELECT * FROM `gx_tv_packages`
					      WHERE `level` = '0'
					      LIMIT 0, 10;", $conn);
	  }
	  $plugins .='<script type="text/javascript">
	  function selectdata(uid,  nama){
	       window.opener.document.'.$return_form.'.id_pakettv.value=uid;
	       window.opener.document.'.$return_form.'.nama_pakettv.value=nama;
	       self.close();
	       }
	  </script>     ';
     }
     
     $content ='<section class="content-header">
		     <h1>
			 Data '.$tipe.'
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			     <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data '.$tipe.'</h2>
				   </div>
				 
				   <div class="box-body">
					<div class="row">
					     <div class="col-xs-8 margin">
						  <form action="" method="post" name="form_search" id="form_search">
						       <table class="form" >
							    <tr>
								 <td><label>Nama</label></td>
								 <td><input class="form-control" name="nama" placeholder="Nama" type="text" value=""></td>
								 <td>&nbsp;</td>
								 <td><input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search"></td>
							    </tr>
						       </table>
						  </form>
					     </div>
					</div>
					<div class="row">
					     <div class="col-xs-12">';
if($tipe == "account_index")
{
     $content .='<table class="table table-bordered table-striped" id="tabel-select">
	       <thead>
		 <tr>
		   <th>#</th>
		   <th>AccountIndex</th>
		   <th>Account Name</th>
		   <th>Account Description</th>
		   <th>Action</th>
		 </tr>
	       </thead>
	       <tbody>';
     $no = 1;

     while ($row_select = $sql_select->fetch(PDO::FETCH_ASSOC))
     {
	  $content .='<tr>
	       <td>'.$no.'.</td>
	       <td>'.$row_select["AccountIndex"].'</td>
	       <td>'.$row_select["AccountName"].'</td>
	       <td>'.$row_select["AccountDescription"].'</td>
	       <td><a href="" onclick="selectdata(\''.$row_select["AccountIndex"].'\',\''.$row_select["AccountName"].'\')">Select</a></td>
	       </tr>';
	  $no++;
     }
     
     $content .='
                        </tbody>
                      </table>';
                      
}elseif($tipe == "group_name")
{
     $content .='<table class="table table-bordered table-striped" id="tabel-select">
               <thead>
		    <tr>
			 <th>#</th>
			 <th>GroupIndex</th>
			 <th>GroupName</th>
			 <th>NASAttributes</th>
			 
			 <th>TimeBank</th>
			 <th>KBBank</th>
			 <th>Action</th>
                    </tr>
               </thead>
               <tbody>';
     $no = 1;
     while ($row_select = $sql_select->fetch(PDO::FETCH_ASSOC))
     {
	  $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["GroupIndex"].'</td>
		    <td>'.$row_select["GroupName"].'</td>
		    <td>'.$row_select["NASAttributes"].'</td>
		    <td>'.$row_select["TimeBank"].'</td>
		    <td>'.$row_select["KBBank"].'</td>
		    <td><a href="" onclick="selectdata(\''.$row_select["GroupIndex"].'\',\''.$row_select["GroupName"].'\')">Select</a></td>
		    </tr>';
	  $no++;
     }
     $content .='
                        </tbody>
                      </table>';
		      
}elseif($tipe == "kendaraan")
{
     $content .='<table id="tabel-select" class="table table-bordered table-striped">
		    <thead>
			 <tr>
			     <th>#</th>
			     <th>Nama Kendaraan</th>
			     <th>Cabang</th>
			     <th>NOPOL</th>
			     <th>Jenis</th>
			     <th>Tahun</th>
			     <th>Action</th>
			 </tr>
		    </thead>
		    <tbody>';
     $no = 1;
     while ($row_select = mysql_fetch_array($sql_select))
     {
	  $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["nama_kendaraan"].'</td>
		    <td>'.$row_select["nama_cabang"].'</td>
		    <td>'.$row_select["nopol_kendaraan"].'</td>
		    <td>'.$row_select["jenis_kendaraan"].'</td>
		    <td>'.$row_select["tahun_kendaraan"].'</td>
		    <td><a href="" onclick="selectdata(\''.$row_select["id_kendaraan"].'\',\''.$row_select["nama_kendaraan"].'\')">Select</a></td>
		    </tr>';
	  $no++;
     }
     $content .='
                        </tbody>
                      </table>';
     
}elseif($tipe == "pegawai")
{
     $content .='<table id="tabel-select" class="table table-bordered table-striped">
		    <thead>
			 <tr>
			     <th>#</th>
			     <th>ID Pegawai</th>
			     <th>Nama</th>
			     <th>Bagian</th>
			     <th>Action</th>
			 </tr>
		    </thead>
		    <tbody>';
     $no = 1;
     while ($row_select = mysql_fetch_array($sql_select))
     {
	  $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["cKode"].'</td>
		    <td>'.$row_select["cNama"].'</td>
		    <td>'.$row_select["cBagian"].'</td>
		    <td><a href="" onclick="selectdata(\''.$row_select["id_employee"].'\',\''.$row_select["cNama"].'\')">Select</a></td>
		    </tr>';
	  $no++;
     }
     $content .='
                        </tbody>
                      </table>';
     
}elseif($tipe == "tvchannel")
{
     $content .='<table id="tabel-select" class="table table-bordered table-striped">
		    <thead>
			 <tr>
			     <th>#</th>
			     <th>Nama Paket</th>
			     <th>Deskripsi</th>
			     <th>Action</th>
			 </tr>
		    </thead>
		    <tbody>';
     $no = 1;
     while ($row_select = mysql_fetch_array($sql_select))
     {
	  $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["name_package"].'</td>
		    <td>'.$row_select["detail"].'</td>
		    <td><a href="" onclick="selectdata(\''.$row_select["id_package"].'\',\''.$row_select["name_package"].'\')">Select</a></td>
		    </tr>';
	  $no++;
     }
     $content .='
                        </tbody>
                      </table>';
     
}
		$content .='		</div>
			           </div>
			      </div>
			 </div>
			      
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins .= '
	  <!-- DataTable -->
	  <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	  <!-- DATA TABES SCRIPT -->
	  <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	  <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	  <script type="text/javascript">
	      $(function() {
		  $(\'#tabel-select\').dataTable({
		      "bPaginate": true,
		      "bLengthChange": false,
		      "bFilter": false,
		      "bSort": false,
		      "bInfo": true,
		      "bAutoWidth": false
		  });
		      
	      });
	      
	     
	  </script>

    ';

    $title	= 'Select';
    $submenu	= "";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>