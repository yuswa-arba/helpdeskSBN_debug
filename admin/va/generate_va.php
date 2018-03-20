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
    
if(isset($_POST["generate"]))
{
    //echo "update";
    
    $tgl_va    = isset($_POST['tgl_va']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_va']))) : '';
    
	$tgl_va	= str_replace('/', '-', $tgl_va);
	
    if($tgl_va != "")
	{
		
		header("location: ".URL_ADMIN."va/text.php?d=".date("Y-m-d", strtotime($tgl_va))."");
		//header("location: ".URL_ADMIN."va/history_generate.php");
		
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
}

    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Generate VA</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal VA</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" class="form-control" readonly="" name="tgl_va" value="'.date("d/m/Y").'">
						</div>
                                        </div>
					</div>
					
					<fieldset>
					<legend>Data Customer</legend>
					<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
						<button type="submit" name="search" class="btn btn-primary">Search</button>
                        </div>
						</div>
					</div>
					
<table id="customer" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Nama</th>
			<th>No VA</th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_POST["search"]))
{
    $tgl_va    		= isset($_POST['tgl_va']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_va']))) : '';
	$tgl_va2		= str_replace('/', '-', $tgl_va);
    $sql_data		= mysql_query("SELECT *
								  FROM `gx_va`,`tbCustomer`
								  WHERE `gx_va`.`no_rek` = `tbCustomer`.`cNoRekVirtual`
								  AND `gx_va`.`status` = '1'
								  AND `gx_va`.`level` = '0'
								  ;", $conn);
	
}


if(isset($_POST["search"]))
{
	$no = 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
		
			$content .='<tr>
					<td>'.$no.'.</td>
					<td>'.$row_data["cNama"].'</td>
					<td>'.$row_data["no_rek"].'</td>
				</tr>';
			$no++;
		
    }
}
$content .='</tbody>
</table>
</fieldset>
									</div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script language="javascript">
$(\'input#select_all\').on(\'ifChecked\', function(event){
	$("input.generate").iCheck("check");
});
$(\'input#select_all\').on(\'ifUnchecked\', function(event){
	$("input.generate").iCheck("uncheck");
});
</script>

<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "sScrollY":        "200px",
					"sScrollCollapse": true,
					"bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

<!-- datepicker -->
<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
    $(function() {
	$("[id=datepicker]").datepicker({format: "dd/mm/yyyy"});
	
    });
</script>';

    $title	= 'Generate VA';
    $submenu	= "generate_va";
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