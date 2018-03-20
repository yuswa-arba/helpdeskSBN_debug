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
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
    
    global $conn;
    
    
    $content =' <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        List Newsletter
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Newsletter History</h3>
				    <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					    <a href="'.URL_STAFF.'helpdesk/newsletter.php">Add Newsletter</a>
					</div>
					<div class="btn bg-olive btn-flat margin">
					    <a href="'.URL_STAFF.'helpdesk/list_newsletter.php">List Newsletter</a>
					</div>
				    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="list_newsletter" class="table table-bordered table-striped">
                                        <thead>
					<tr>
                                                <th>#</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Date add</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
                             $sql_newsletter 	= mysql_query("SELECT * FROM `gx_vod_newsletter` ORDER BY `id_newsletter` DESC;", $conn);
					$no = 1;
					while($newsletter = mysql_fetch_array($sql_newsletter)){
						$content .= '<tr>
						<td>'.$no.'.</td>
						<td>'.$newsletter['subject'].'</td>
						<td><a href="javascript:load_url(\'view_message_listnewsletter.php?id_newsletter='.$newsletter['id_newsletter'].'\')">View Message</a></td>
						
						<td>'.$newsletter['date_add'].'</td>
						<td><a href="javascript:load_url(\'newsletter.php?id_newsletter='.$newsletter['id_newsletter'].'\')">Edit</a></td>
						</tr>';
						$no++;
						//<td>'.substr($email['Message'], 0, 300).'</td>
					}
                                          
$content .= '                       </tbody>
                                       
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '<!-- DATA TABLES -->
        <link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
        <!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
	<!-- page script -->
        <script type="text/javascript">
            $(function() {
                $(\'#list_newsletter\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
        <script Language="JavaScript">
	function load_url(link) {
	var link;
	var load_url = window.open(link,\'\',\'height=600,width=950,resizable=yes,scrollbars=yes\');
	}
	</script>
    ';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }


/*
include ("configuration/configuration.php");
    $perhalaman = 50;

    if (isset($_GET['page'])){
        $start=($page - 1) * $perhalaman;
    }else{
        $start=0;
    }
    $no = 1;
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'super_staff' || $loggedin["group"] == 'staff' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
        
        $title2 = 'List Newsletter';


$content ='

        <div class="box round first grid">
            <h2>Incoming - '.$title2.'</h2><br>
	    
		 <a href="newsletter.php" class="btn btn-blue">Add Newsletter</a>
                <a href="listnewsletter.php" class="btn btn-orange">List Newsletter</a>
		<div class="clear"></div>
		<br>
		<hr>
        
		<div class="block">
                    
        ';

$content .= '
<form action="" method="post" name="form_list_newsletter" >
	<div class="table-container">
              <table class="data display datatable" style="width: 100%;">
	      <thead>
	      <tr>
		<th>#</th>
		<th>Subject</th>
		<th>Message</th>
		<th>Date add</th>
		<th>To</th>
		<th>Action</th>
	    </tr>
	    </thead>
	    <tbody>';
	    
	    //<th>Message</th>


	
		
$sql_newsletter 	= mysql_query("SELECT * FROM `newsletter` ORDER BY `id_newsletter` DESC");
   


$no = 1;
while($newsletter = mysql_fetch_array($sql_newsletter)){
	$content .= '<tr>
	<td>'.$no.'.</td>
	<td>'.$newsletter['subject'].'</td>
	<td><a href="javascript:load_url(\'view_message_listnewsletter.php?id_newsletter='.$newsletter['id_newsletter'].'\')">View Message</a></td>
	
	<td>'.$newsletter['date_add'].'</td>
	<td>'.$newsletter['to'].'</td>
	
	<td><a href="javascript:load_url(\'newsletter.php?id_newsletter='.$newsletter['id_newsletter'].'\')">Edit</a></td>
	</tr>';
	$no++;
	//<td>'.substr($email['Message'], 0, 300).'</td>
}
$content .= '</tbody>

</table>
</div>
	
</form>';

 $content .='
            </div> 
       </div>

';

}else{
    $content ='
        <div class="box round first">
            <h2> Sorry, You don\'t have permission to access this Page</h2>
                <div class="block">
                   
                </div> 
       </div>';
}

//<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
//
$plugins = '<script type="text/javascript" src="'.URL_OLD.'js/jquery.js"></script>
<link rel="stylesheet" href="'.URL_OLD.'css/excite-bike/jquery.ui.all.css">


<style type="text/css">

select{
	width:80px;
}
#summary div,#summary div table, #summary h2{
    font-size:14px;
}
.button-well {
background-color: #97cefc;
display: inline-block;
line-height: 14px;
margin-right: 8px;
padding: 5px;
-webkit-background-clip: padding;
-moz-background-clip: padding;
background-clip: padding-box;
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #94b7ed), color-stop(100%, #dfeffe));
background-image: -webkit-linear-gradient(top, #94b7ed, #dfeffe);
background-image: -moz-linear-gradient(top, #94b7ed, #dfeffe);
background-image: -o-linear-gradient(top, #94b7ed, #dfeffe);
background-image: linear-gradient(top, #94b7ed, #dfeffe);
-webkit-border-radius: 25px;
-moz-border-radius: 25px;
-ms-border-radius: 25px;
-o-border-radius: 25px;
border-radius: 25px;
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1);
}
.button.button-primary {
background-color: #81b0ef;
border: 1px solid #4571b5;
color: white;
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #81b0ef), color-stop(100%, #345994));
background-image: -webkit-linear-gradient(top, #81b0ef, #345994);
background-image: -moz-linear-gradient(top, #81b0ef, #345994);
background-image: -o-linear-gradient(top, #81b0ef, #345994);
background-image: linear-gradient(top, #81b0ef, #345994);
-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.35);
-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.35);
box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.35);
text-shadow: 0 1px 0 #26497e;
}

.button {
background-color: #f3f3f3;
background-size: 1px 60px;
border: 1px solid silver;
color: #646464;
cursor: pointer;
display: inline-block;
font-weight: bold;
line-height: 14px;
padding: 8px 14px;
text-decoration: none;
-webkit-background-clip: padding;
-moz-background-clip: padding;
background-clip: padding-box;
background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f5f5f5), color-stop(100%, #cccccc));
background-image: -webkit-linear-gradient(top, #f5f5f5, #cccccc);
background-image: -moz-linear-gradient(top, #f5f5f5, #cccccc);
background-image: -o-linear-gradient(top, #f5f5f5, #cccccc);
background-image: linear-gradient(top, #f5f5f5, #cccccc);
-webkit-border-radius: 25px;
-moz-border-radius: 25px;
-ms-border-radius: 25px;
-o-border-radius: 25px;
border-radius: 25px;
-webkit-box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, 0.25);
-moz-box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, 0.25);
box-shadow: inset 0 1px 0 white, 0 1px 2px rgba(0, 0, 0, 0.25);
font-size: 12px;
font-size: 1.2rem;
text-shadow: 0 1px 0 white;
-webkit-transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
-moz-transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
-o-transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
transition: color 0.2s ease-out, background 0.2s ease-out, box-shadow 0.05s ease-out;
}
</style>





<style type="text/css">
		    .detail{
			margin:0;
			padding: 0;
			height: 200px;
                        overflow-y:scroll;
		    }
		    h4{
			margin-top: 5px;
			padding-left: 10px;
			font-size:14px;		    
		    }
		   </style>
<style>
  body {
    min-width: 520px;
  }
  .column {
    width: 50%;
    float: left;
    padding-bottom: 10px;
  }
  .custom {
    width: 100%;
    padding-bottom: 10px;
    position: relative;
  }  
  .portlet {
    margin: 0 1em 1em 0;
    padding: 0.3em;
  }
  .portlet-header {
    padding: 0.2em 0.3em;
    margin-bottom: 0.5em;
    position: relative;
  }
  .portlet-toggle {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: -8px;
  }
  .portlet-content {
    padding: 0.4em;
  }
  .portlet-placeholder {
    border: 1px dotted black;
    margin: 0 1em 1em 0;
    height: 50px;
  }
  </style>
<script Language="JavaScript">
function load_url(link) {
var link;
var load_url = window.open(link,\'\',\'height=600,width=950,resizable=yes,scrollbars=yes\');
}
</script>
';

    $title	= 'Newsletter';
    $submenu	= "List Newsletter";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= template_intranet($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header("location: index.php");
    }
*/


?>