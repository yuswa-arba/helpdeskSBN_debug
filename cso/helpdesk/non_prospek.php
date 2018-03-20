<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */


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
    
    global $conn_helpdesk;
  
    
    $stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'stats.php\'+options[selectedIndex].value;">
	<option value="">- Select -</option>
	<option value="">This Week</option>
	<option value="?b='.date("m").'&t='.date("Y").'">This Month</option>
        
</select>
</form>
                <div class="block">
                    <div id="chart1">';
                    
//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

//Statistik Complaint
/*$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
$stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
$stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
$stat_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';"));
$stat_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';"));
$stat_spktech = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';"));
$stat_spkmkt = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';"));
*/

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");


$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';
            
    $content =' <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        List Newsletter
                        <small>advanced tables</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">List Newsletter</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <a href="newsletter.php">Add Newsletter</a>
                <a href="list_newsletter.php">List Newsletter</a>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Newsletter History</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>';
					/*
					 <tr>
					    <th>#</th>
					    <th>Subject</th>
					    <th>Message</th>
					    <th>Date add</th>
					    <th>To</th>
					    <th>Action</th>
					</tr>
					 */
$content .= '                               <tr>
                                                <th>#</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Date add</th>
						<th>To</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
					/*
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
					*/
					
					
					
                             $sql_newsletter 	= mysql_query("SELECT * FROM `newsletter` ORDER BY `id_newsletter` DESC", $conn_helpdesk);
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
                                          
$content .= '                       </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Rendering engine</th>
                                                <th>Browser</th>
                                                <th>Platform(s)</th>
                                                <th>Engine version</th>
                                                <th>CSS grade</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

/*
 *<!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
*/
$plugins = '
<!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $(\'#example2\').dataTable({
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
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ../logout.php");
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
if($loggedin["group"] == 'super_admin' || $loggedin["group"] == 'admin' || $loggedin["group"] == 'manager' || $loggedin["group"] == 'kabag' || $loggedin["group"] == 'na' || $loggedin["group"] == 'cso'){
        
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