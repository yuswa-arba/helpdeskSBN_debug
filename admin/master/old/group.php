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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Customer");
    global $conn;
    global $conn_voip;
    
    $content ='<section class="content-header">
                    <h1>
                        Master Group
                        
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Search</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form action="" method="post" name="form_search">
	<table width="100%" border="1" cellspacing="0" cellpadding="2" class="gwlines arborder">
	    <tbody>
		<tr>
		    <td align="left" class="bgcolor_002">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tbody>
			    <tr>
				<td class="fontstyle_searchoptions" width="40%"> &nbsp;	User ID :
				    <input class="form_input_text" type="text" name="user_id" placeholder="User ID">
				</td>
				<td class="fontstyle_searchoptions" width="60%">Customer Number :
				    <input class="form_input_text" type="text" name="cust_number" placeholder="Customer Number">
				</td>
			    </tr>
			    </tbody>
			</table>
		    </td>
		    <td align="left" class="bgcolor_003">
		    </td>
    		</tr>
		<tr>
		    <td align="left" class="bgcolor_004">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tbody>
			    <tr>
				<td class="fontstyle_searchoptions" width="40%"> &nbsp; Name :
				    <input class="form_input_text" name="name" style="width:250px;" type="text" placeholder="Name">
				</td>
				<td class="fontstyle_searchoptions" width="60%">Address :
				    <input class="form_input_text" name="address" type="text" placeholder="Address" style="width:300px;">
				</td>
			    </tr>
			    </tbody>
			</table>
		    </td>
		    <td align="left" class="bgcolor_005">
		    </td>
		</tr>		
		<!-- Select Calltype: -->
		<tr>
		  <td class="bgcolor_002" align="left">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody>
			<tr>
			    <td class="fontstyle_searchoptions" width="40%"> &nbsp; Email :
				<input class="form_input_text" name="email" style="width:300px;" type="text" placeholder="Email">
			    </td>
			    <td class="fontstyle_searchoptions" width="60%">
			    </td>
			</tr>
			</tbody>
		    </table>
		  </td>
		  <td class="bgcolor_003" align="center">
		  
		  </td>
		</tr>
		<tr>
			  <!--<td class="bgcolor_002" align="left">
				<div class="checkbox">&nbsp;
					<label>
					    <input type="checkbox"/>Data/Internet
                                        </label> &nbsp;
					<label>
					    <input type="checkbox"/>VoIP/Telepon
                                        </label> &nbsp;
					<label>
					    <input type="checkbox"/>VOD/Video
                                        </label>
                                    </div>
			  </td>-->
			  <td class="bgcolor_003" align="center">
			  
			  </td>
		</tr>
			
		<tr>
		    <td class="bgcolor_004" align="center">
			<input class="btn btn-primary" name="search" value=" Search " type="submit">
		    </td>
		    <td class="bgcolor_005" align="center">
				
		    </td>
		</tr>
	</tbody>
	</table>
	</form>
	<hr>
				<div class="box-header">
                                    <h3 class="box-title">List Customer</h3>
				    <a href="'.URL_ADMIN.'master/form_group" class="btn bg-olive btn-flat margin pull-right">Create Group</a>
                                </div><!-- /.box-header -->
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
						<th>Tipe</th>
						<th>Cabang</th>
                                                <th>Desc</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					

if(isset($_POST["search"])){
    
}else{
    $sql_group = mysql_query("SELECT * FROM `gx_group`
				  WHERE `level` = '0' ORDER BY `group_name` ASC;",$conn);
}


$no = 1;
while ($row_group = mysql_fetch_array($sql_group))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_group["group_kode"].'</td>
		    <td>'.$row_group["group_name"].'</td>
		    <td>'.$row_group["id_tipe"].'</td>
		    <td>'.$row_group["id_cabang"].'</td>
		    <td>'.$row_group["group_desc"].'</td>
		    <td align="center"><a href=""><span class="label label-info">Detail</span></a>
		    <a href="form_group?id='.$row_group["Id_group"].'"><span class="label label-info">Edit</span></a>
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Master Customer';
    $submenu	= "customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>