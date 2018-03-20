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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    global $conn_voip;
    
    
    //paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
						<div class="box-header">
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body">
							
							<form action="" method="post" name="form_search">
							<div class="form-group">
								<div class="row">
									<div class="col-xs-3">
										<label>UserID</label>
									</div>
									<div class="col-xs-6">
										<input class="form-control" name="UserID" value="" type="text" maxlength="30">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs-3">
										
									</div>
									<div class="col-xs-6">
										<input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
									</div>
								
								</div>
							</div>
							</form>';
							
if(isset($_POST['search']))
{
	$UserID = isset($_POST["UserID"]) ? $_POST["UserID"] : "";
	//echo "SELECT * FROM view_billing WHERE UserID = '".$UserID."' ORDER BY CreateDate ASC;";
	
	$conn_soft = Config::getInstanceSoft();

	$sql_data = $conn_soft->prepare("SELECT * FROM view_billing WHERE UserID = '".$UserID."' ORDER BY CreateDate ASC;");
	//  AND dbo.Users.UserIndex = '6418'
	$sql_data->execute();
$content .='<h4> Data Accounting '.$UserID.'</h4>
                            <table id="listdata" class="table-responsive table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Record</th>
										<th>Date</th>
										<th>Credit</th>
										<th>Debit</th>
										<th>Balance</th>
									</tr>
								</thead>
								<tbody>';
								


$no = 1;
$balance = 0;
while ($row_data = $sql_data->fetch())
{
	if($row_data['TransType'] == 1)
	{
		$credit = $row_data["Total"];
		$debet = 0;
	}
	elseif($row_data['TransType'] == 2)
	{
		$credit = 0;
		$debet = $row_data["Total"];
	}
	
	$total = (Rupiah(str_replace("-", "", $row_data["Total"])));
	$balance += $credit - $debet;
$content .= '<tr>
			<td>'.$no.'</td>
			<td>'.(($row_data['TransType'] == 1) ? 'Invoice' : 'Payment').' # '.(($row_data['TransType'] == 1) ? $row_data["BillIndex"] : $row_data["PaymentNumber"]).'</td>
			<td>'.date("d-m-Y H:i:s", strtotime($row_data["CreateDate"])).'</td>
			<td>'.(($row_data['TransType'] == 1) ? $total : '').'</td>
			<td>'.(($row_data['TransType'] == 2) ? $total : '').'</td>
			<td>'.(($balance)).'</td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>';
}

$content .='
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#listdata\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false,
					"iDisplayLength": 50
                });
            });
        </script>
    ';

    $title	= 'Accounting';
    $submenu	= "group_rbs";
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