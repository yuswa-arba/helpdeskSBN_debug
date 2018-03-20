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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Mailbox");

    
    global $conn;
    global $conn_voip;
    
    
 //echo date("Y-m-d H:i:s");
    $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT `ID`, `EmailFrom`, `EmailFromP`, `EmailTo`, `DateE`, `DateDb`, `DateRead`, `DateRe`, `Subject`, `Message`, `Message_html`,`id_kategori`
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    $sql_parent = mysql_query("SELECT * FROM `gx_kat_mailbox` WHERE `id_parent` = '0';",$conn);
    $content ='<section class="content-header">
                    <h1>
                        MailBox
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_customer">Mailbox</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Mailbox</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
                                   <form action="form_mailbox.php" method="post" name="form_mailbox">
	  <input type="hidden" style="" name="ID" value="'.$email["ID"].'" />
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$email["EmailFromP"].'</span>
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Email:
		</td>
		<td width="37.5%">
		    '.$email["EmailFrom"].'
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["DateE"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Subject:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["Subject"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Body:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["Message_html"].'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Kategori:
		</td>
		<td width="37.5%" colspan="3">
		    <select name="id_kategori">';
		    if($email["id_kategori"] == "0"){
			    $content .='<option value="0" selected="">No Kategori</option>';
			}
		    while($row_parent = mysql_fetch_array($sql_parent)){
			
			$content .='<option value="'.$row_parent["id_kat_mailbox"].'" '.(($row_parent["id_kat_mailbox"]== $email["id_kategori"]) ? 'selected="selected"' :"") .'>'.$row_parent["nama_kat_mailbox"].'</option>';
			
		    }
			
			
		    $content .='</select>
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    </tbody>
	</table>
	<div class="actions">
	    <div class="button-well">
		<input type="submit" class="button button-primary" data-icon="v" name="update" value="Save">
	    </div>
	</div>
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$submit = isset($_POST["update"]) ? $_POST["update"] : "";

	if($submit == "Save"){
	    $ID = isset($_POST["ID"]) ? $_POST["ID"] : "";
	    $kategori = isset($_POST["id_kategori"]) ? $_POST["id_kategori"] : "";
	    
	    $update    = mysql_query("UPDATE `gx_email` SET `id_kategori` = '".$kategori."' WHERE `ID`='".$ID."'") or die(mysql_error());
	    echo "<script language='JavaScript'>
			alert('Data telah diupdate!');
			window.close();
            </script>";
	}
$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#mailbox\').dataTable({
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
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>