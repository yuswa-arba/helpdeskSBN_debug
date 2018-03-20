<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");

if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
    
    if(isset($_GET["id"])){
		
	$id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
	$sql_email = mysql_query("SELECT `ID`, `EmailFrom`, `EmailFromP`, `EmailTo`, `DateE`, `DateDb`, `DateRead`, `DateRe`, `Subject`, `Message`, `Message_html`,`kategori`
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;");
        $email = mysql_fetch_array($sql_email);
		
    }
    $content ='<!-- Main content -->
                <section class="content">
		
		    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
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
		    <select name="kategori">
			<option value="Spam" '.(($email["kategori"]== "Spam") ? 'selected="selected"' :"") .'>Spam</option>
			<option value="Problem FO" '.(($email["kategori"]== "Problem FO") ? 'selected="selected"' :"") .'>Problem FO</option>
			<option value="Problem Wireless" '.(($email["kategori"]== "Problem Wireless") ? 'selected="selected"' :"") .'>Problem Wireless</option>
			<option value="Request" '.(($email["kategori"]== "Request") ? 'selected="selected"' :"") .'>Request</option>
			<option value="Billing" '.(($email["kategori"]== "Billing") ? 'selected="selected"' :"") .'>Billing</option>
			
		    </select>
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
				    <input type="submit" class="btn btn-success" name="update" value="Save">
				    <input type="submit" class="btn btn-success" href="#" onclick="javascript:window.close();" value="Close">
				  </div>
				  
				</div>
				</form>
			    </div>
			</div>
		    </div>
                </section><!-- /.content -->
                
            ';
$submit = isset($_POST["update"]) ? $_POST["update"] : "";

	if($submit == "Save"){
	    $ID = isset($_POST["ID"]) ? $_POST["ID"] : "";
	    $kategori = isset($_POST["kategori"]) ? $_POST["kategori"] : "";
	    
	    $update    = mysql_query("UPDATE `gx_email` SET `kategori` = '".$kategori."' WHERE `ID`='".$ID."'") or die(mysql_error());
	    echo "<script language='JavaScript'>
			alert('Data telah diupdate!');
			window.close();
            </script>";
	}
	
	
$plugins = '<!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>';

    $title	= 'Form Mailbox';
    $submenu	= "mailbox";
    $plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= bootstrap_theme3_popup($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: index.php");
    }

?>