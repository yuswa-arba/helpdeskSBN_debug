<?php
/*
 * Theme Name: Software Voip
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 8 oktober 2014
 * Email: dwi@globalxtreme.net
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List data card voip");
    global $conn;
    global $conn_voip;
    $return_form = isset($_GET["r"]) ? $_GET["r"] : "";


$plugins = '    
<script type=\'text/javascript\'>
	function validepopupform(nLabel){
		window.opener.document.'.$return_form.'.id_cc_card.value=nLabel;
		self.close();
        }
</script>';
?>

<?php
$content ='
<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                                <div class="box">
	
				<div class="box-header">
                                    <h3 class="box-title">List VOIP Number</h3>
                                </div><!-- /.box-header -->

				<div class="box-body table-responsive">
			    
				    <form action="" method="post" name="form_search" id="form_search">
					<table class="form" width="80%">
					    <tr>
					      <td><label>VOIP Number</label></td>
					      <td><input class="form-control" name="voip_number" type="text" value=""></td>
					    </tr>
					    <tr>
					      <td>&nbsp;</td>
					      <td><input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search"></td>
					    </tr>
					</table>
				    </form>
		<table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Account Number</th>
		    <th>VOIP Number</th>
		    <th>LASTNAME</th>
		    <th>GROUP</th>
		    <th>BA</th>
		    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>';

if(isset($_POST["save_search"])){
    $voip_number	= isset($_POST['voip_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['voip_number']))) : "";
    
    $sql_card = "SELECT `cc_card`.`useralias`, `cc_card`.`id`, `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`,
		`cc_card`.`credit`, `cc_card_group`.`name`
		FROM `cc_card`, `cc_card_group`
		WHERE `cc_card`.`id_group` = `cc_card_group`.`id`
		AND `cc_card`.`useralias` LIKE '%".$voip_number."%';";
    $query_card	= mysql_query($sql_card, $conn_voip);
}else{
    $sql_card = "SELECT `cc_card`.`useralias`, `cc_card`.`id`, `cc_card`.`username`, `cc_card`.`firstname`, `cc_card`.`lastname`,
		`cc_card`.`credit`, `cc_card_group`.`name`
		FROM `cc_card`, `cc_card_group`
		WHERE `cc_card`.`id_group` = `cc_card_group`.`id`;";
    $query_card	= mysql_query($sql_card, $conn_voip);
}
$no = 1;

    while ($row_card = mysql_fetch_array($query_card)) {
	$content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_card["username"].'</td>
		    <td>'.$row_card["useralias"].'</td>
                    <td>'.$row_card["firstname"].' '.$row_card["lastname"].'</td>
		    <td>'.$row_card["name"].'</td>
		    <td>'.number_format($row_card["credit"], 2, ',','.').'</td>
		    <td>
                      <a href="" onclick="validepopupform(\''.$row_card['id'].'\')">Select</a>
                    </td>
                  </tr>';
	$no++;
    }
		
                  $content .='
                  
                </tbody>
              </table>';


$content .= '
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

    $title	= 'input data number customer';
    $submenu	= "Data Number customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
?>
<?php

	} else{
		header("location: index.php");
	}
} else{
    header("location: index.php");
}
?>