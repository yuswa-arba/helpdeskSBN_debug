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
   
require_once '../../admin/helpdesk/mailer/class.phpmailer.php';

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Reply Email ");
	global $conn;
	
 
$id_email 	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";

$sql_email   	= mysql_fetch_array(mysql_query("select * FROM `gx_email` WHERE `ID` = '$id_email' ORDER BY `ID` DESC LIMIT 1", $conn));
//echo ''.$id_email.' hhhfhfhh'; 
 	
    
 //echo date("Y-m-d H:i:s");
    $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT *
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` WHERE `level` = '1';",$conn);
    $content ='<section class="content-header">
                    <h1>
                        History Reply
                    </h1>
                    
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
				
          <table style="width:80%;">
	    <tbody>
	    <tr>
		<td>
		    <label>ID</label>
		</td>
		<td>
		    ['.$email["id_complaint"].']
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Email From</label>
		</td>
		<td>
		    <span>'.$email["EmailFromP"].'</span> ('.$email["EmailFrom"].')
		</td>
		
	    </tr>
	    <tr>
		<td>
		    <label>Tanggal</label>
		</td>
		<td>
		    '.$email["DateE"].'
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Subject</label>
		</td>
		<td>
		    '.$email["Subject"].'
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Body</label>
		</td>
		<td>
		    '.$email["Message_html"].'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Kategori</label>
		</td>
		<td>
		    ';
		    if($email["id_kategori"] == "0"){
			    $content .='No Kategori';
			}
		    while($row_parent = mysql_fetch_array($sql_parent)){
			
			$content .=($row_parent["id_kategori"]== $email["id_kategori"]) ? $row_parent["nama_kategori"] :"";
			
		    }
			
		    $content .='
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    </tbody>
	</table>
	                        </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    <div class="box">
				   <div class="box-header">
					<h2 class="box-title">History Reply</h2>
				   </div>
				 
				   <div class="box-body">
	 <div class="table-container">
	       <table class="table table-bordered table-striped" id="email_history" style="width: 100%;">
	       <thead>
	       <tr>
		 <th>No.</th>
		 <th>Tanggal</th>
		 <th>Messagge</th>
		 <th>Replied by</th>
	       </tr>
	       </thead>
	       <tbody>';
	     
	     //<th>Message</th>
 

$sql_history_email	= "SELECT * FROM `gx_email_reply` WHERE `id_email` LIKE '%".$email["ID"]."%'
			 ORDER BY `date_add` DESC; ";
$query_history_email	= mysql_query($sql_history_email, $conn);

$noe = 1;
while ($row_email = mysql_fetch_array($query_history_email)) {
     
	 $content .= '
	 <tr>
	       <td>'.$noe.'</td>
	       <td>'.$row_email["date_add"].'</td>
	       <td>'.$row_email["message"].'</td>
	       <td>'.$row_email["user_add"].' ('.$row_email["date_add"].')</td>
	  </tr>
          
	 ';
	 $noe++;
	 //<td>'.substr($email['Message'], 0, 300).'</td>
 }


 $content .= '</tbody>

 </table><br>
 </div>
				 </div><!-- /.box-body -->
			     </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                
		CKEDITOR.replace(\'editor2\', {readOnly:true});
                
            });
        </script>';

    $title	= 'Form Reply';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>