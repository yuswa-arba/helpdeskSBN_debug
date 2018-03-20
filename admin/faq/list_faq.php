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
if($loggedin["group"] == 'admin'){
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Bank Masuk");
    global $conn;

    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

     
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
					
                        <div class="col-xs-12">
			   
                            <div class="box">
							
							<div class="box-header">
                                    <h2 class="box-title">Search</h2>
                                </div>
				
                                <div class="box-body">
				<form action="" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Title</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="judul_faq" type="text" placeholder="Title">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Kategori</label>
					</div>
					<div class="col-xs-4">
					    <select class="form-control" name="kategori_faq">
						 <option value="billing">Billing</option>
						 <option value="helpdesk">Helpdesk</option>
						 <option value="cso">CSO</option>
						 <option value="marketing">Marketing</option>
						 <option value="other">Other</option>
						</select>
					</div>
					
				    </div>
				    </div>
				  
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
	
	 <form method ="POST" action="">
				<div class="box-header">
                                    <h3 class="box-title">List Data</h3>
				    <div class="box-tools pull-right">
					
					     <a href="form_faq.php" class="btn bg-olive btn-flat margin">Create New</a>
					     
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="bankmasuk" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											    <th>No.</th>
                                                <th>Title</th>
												<th>Kategori</th>
                                                <th>Tanya</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
										
if(isset($_GET["j"]) AND isset($_GET["k"]))
{
	
    $judul_faq		= isset($_GET["j"]) ? trim(strip_tags($_GET["j"])) : "";
    $kategori_faq	= isset($_GET["k"]) ? trim(strip_tags($_GET["k"])) : "";
    
    
    $sql_judul_faq	= ($judul_faq != "") ? "AND `judul_faq` LIKE '%$judul_faq%'" : "";
    $sql_kategori_faq	= ($kategori_faq != "") ? "AND `kategori_faq` = '$kategori_faq'" : "";
   
    $sql_data		= mysql_query("SELECT * FROM `gx_faq` WHERE `level` =  '0' $sql_judul_faq $sql_kategori_faq ORDER BY `id_faq` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_faq` WHERE `level` =  '0' $sql_judul_faq $sql_kategori_faq;", $conn));

    $hal= "?j=$judul_faq&k=$kategori_faq&";
    

}

if(isset($_POST["search"]))
{
    $judul_faq		= isset($_POST["judul_faq"]) ? trim(strip_tags($_POST["judul_faq"])) : "";
    $kategori_faq	= isset($_POST["kategori_faq"]) ? trim(strip_tags($_POST["kategori_faq"])) : "";
    
    
    $sql_judul_faq	= ($judul_faq != "") ? "AND `judul_faq` LIKE '%$judul_faq%'" : "";
    $sql_kategori_faq	= ($kategori_faq != "") ? "AND `kategori_faq` = '$kategori_faq'" : "";
   
    $sql_data		= mysql_query("SELECT * FROM `gx_faq` WHERE `level` =  '0' $sql_judul_faq $sql_kategori_faq ORDER BY `id_faq` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_faq` WHERE `level` =  '0' $sql_judul_faq $sql_kategori_faq;", $conn));
echo "SELECT * FROM `gx_faq` WHERE `level` =  '0' $sql_judul_faq $sql_kategori_faq ORDER BY `id_faq` DESC LIMIT $start, $perhalaman;";
    $hal= "?j=$judul_faq&k=$kategori_faq&";
    
}
else
{
	 $sql_data = mysql_query("SELECT * FROM `gx_faq`
					   WHERE `level` = '0' ORDER BY `kategori_faq` DESC LIMIT $start, $perhalaman;", $conn);
	 $sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_faq`
					   WHERE `level` = '0' ORDER BY `id_faq` DESC;", $conn));
	 $hal	="?";
}

$no = $start + 1;
while ($row_data = mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["judul_faq"].'</td>
			<td>'.ucfirst($row_data["kategori_faq"]).'</td>
		    <td>'.$row_data["tanya_faq"].'</td>
		   
		    <td align="center">
			   <a href="form_faq.php?id='.$row_data["id_faq"].'" data-toggle="modal"><span class="label label-success">Edit</span></a>
			   <a href="view_faq.php?id='.$row_data["id_faq"].'" data-toggle="modal"><span class="label label-warning">Detail</span></a>
		    </td>
		    
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>


                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <div class="box-tools pull-right">
				    '.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
				    </div>
				    <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                            </form>
                        </div>
                    </div>

                </section><!-- /.content -->
';

$plugins = '
        <link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
	<!-- DataTable -->
    ';

    $title	= 'FAQ';
    $sumasukenu	= "faq";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$sumasukenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>