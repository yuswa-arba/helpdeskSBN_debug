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
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Incoming");
    global $conn;
    
$userid = isset($_GET["userid"]) ? $_GET["userid"] : "";
$cust_number = isset($_GET["cust_number"]) ? $_GET["cust_number"] : "";
$token = isset($_GET["token"]) ? $_GET["token"] : "";

	    if(($userid != "") OR ($cust_number != "") OR ($token !="")){
            send_lupapassword($userid, $cust_number, $token);
	    }
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
	<div >
	    <fieldset>
		
		<div class="table-container table-form">
		
		    SUCCESS
	      
            </div>
	    </fieldset>
	    </div>
	
	
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
<script type="text/javascript">
			function customer(){
			    var popy= window.open("data_cust.php","popup_form","toolbar=no, scrollbars=yes, resizable=no, location=no,menubar=no,status=no,top=50%,left=50%,height=550,width=850")
			}
			
</script>
    
    ';

    $title	= '';
    $submenu	= "";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>