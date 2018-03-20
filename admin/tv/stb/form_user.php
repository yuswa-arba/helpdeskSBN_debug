<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
	
        global $conn;
		include("../../../config/configuration_tv.php");
		$conn_tv   = DB_TV();

    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTNAME` LIKE 'BALITEST%' ORDER BY `boss`.`t_account_cms`.`CLIENTNAME` ASC LIMIT 0,30 ;";
    $query_data	= mysqli_query($conn_tv, $sql_data);
    //$row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open form user ");


    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
<div class="box-body">
                                <!-- form start -->
                                <form role="form" name="form_stb"  method="POST" action="">
								<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th>#</th>
			<th>Username</th>
			<th>SN</th>
			<th>MAC</th>
			<th>Password</th>
                  </tr>
                </thead>
                <tbody>';
								    
$no=1;
while($row_data = mysqli_fetch_array($query_data)){

$content .='

				<tr>
				<td>'.$no.'<input type="hidden" class="form-control" name="clientid[]" value="'.$row_data["CLIENTID"].'"></td>
			<td><input type="text" readonly="readonly" class="form-control" name="username[]" value="'.$row_data["CLIENTNAME"].'"></td>
			<td><input type="text" class="form-control" name="sn[]" value="'.substr($row_data["CLIENTCODE"], 0, 16).'"></td>
			<td><input type="text" class="form-control" required="" name="mac[]" value="'.$row_data["MACADDRESS"].'"></td>
			<td><input type="password" class="form-control" name="password[]" value=""></td>
			
		</tr>


			 ';
		$no++;			
}
								
                                    
								
                            $content .='    											</tbody>
</table> 
</div><!-- /.box-body --></div><!-- /.box -->
                                    <div class="box-footer">
                                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                                    </div>

                                </form>
                            
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
$save = isset($_POST["save"]) ? $_POST["save"] : "";
if($save == "Save"){
		$clientid 		= array();
		$clientid 		= isset($_POST['clientid']) ? $_POST['clientid'] : $clientid;
		$username 		= array();
		$username 		= isset($_POST['username']) ? $_POST['username'] : $username;
		$sn				= array();
		$sn				= isset($_POST['sn']) ? $_POST['sn'] : $sn;
		$mac			= array();
		$mac			= isset($_POST['mac']) ? $_POST['mac'] : $mac;
		
		
		for ($i = 0; $i < count($username); $i++) {

			$data_client_id	= $clientid[$i];
		    $data_username	= $username[$i];
		    $data_sn		= $sn[$i];
		    $data_mac		= $mac[$i];
			$clientcode		= strtoupper($data_sn.''.$data_mac);
			$query3 = "UPDATE `boss`.`t_account_cms` SET `boss`.`t_account_cms`.`CLIENTCODE` = '".$clientcode."',
				`boss`.`t_account_cms`.`MACADDRESS` = '".strtoupper($data_mac)."'
				WHERE `CLIENTID` = '".$data_client_id."'";
			//echo $query3.'<br />';
			
			
			mysqli_query($conn_tv,$query3) or die("<script language='JavaScript'>
					alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
					window.history.go(-1);
			    </script>");
		
		
		}
		
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
				location.href = 'form_user.php';
		    </script>";
	}	
$plugins = '';

    $title	= 'Form stb';
    $submenu	= "stb";
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