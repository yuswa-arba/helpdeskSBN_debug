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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;
/*
getpost_ifset(array('choose_list', 'addcredit', 'gen_id', 'cardnum', 'choose_currency', 'expirationdate', 'addcredit','tag_list'));
$FG_ADITION_SECOND_ADD_TABLE  = "cc_voucher";		
$FG_ADITION_SECOND_ADD_FIELDS = "voucher, credit, activated, tag, currency, expirationdate";
$FG_ADITION_SECOND_ADD_VALUE  = "'$vouchernum', '$addcredit', 't', '$tag_list', '$choose_currency', '$expirationdate'";


*/
$new_generate = isset($_POST['generate']) ? $_POST['generate'] : '';


if($new_generate == 'GENERATE VOUCHER'){

$addcredit              = isset($_POST['addcredit']) ? $_POST['addcredit'] : '';
$choose_currency        = isset($_POST['choose_currency']) ? $_POST['choose_currency'] : '';
$expirationdate         = isset($_POST['expirationdate ']) ? $_POST['expirationdate '] : '';
$tag_list               = isset($_POST['tag_list']) ? $_POST['tag_list'] : '';

$row_addcredit          = $addcredit !='' ? $_POST['addcredit'] : ''; 
$row_choose_currency    = $choose_currency != '' ? $_POST['choose_currency'] : '';
$row_expirationdate     = $expirationdate != '' ? $_POST['expirationdate'] : '';
$row_tag_list           = $tag_list != '' ? $_POST['tag_list'] : '';


//4 	2014-10-24 17:22:47 	0000-00-00 00:00:00 	2024-10-20 08:17:11 	946286295256753 	NULL 	new bi 	1234 	t 	0 	IDR
$jml_data_generate = $_POST['choose_list'] != 0 ? $_POST['choose_list'] : 0;     
    
        for($for_num=1; $for_num<=$jml_data_generate; $for_num++){
            $row_voucher            = rand(111111111111111, 999999999999999);
            mysql_query("insert into `cc_voucher`(`id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency`) VALUES(NULL, NOW(), NULL, '$row_expirationdate', '$row_voucher', NULL, '$row_tag_list', '$row_addcredit', 't', '0', '$row_choose_currency')", $conn_voip);
        }
}


$content = '
                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Vouchers</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

$content .= '<div align="center">  	  
	   <table align="center" class="bgcolor_001" border="0" width="65%">
        <tbody><tr>
		<form method="POST" action="">
          <td align="left" width="75%">
           		
			  	<strong>1)</strong> 
				<select name="choose_list" size="1" class="form_input_select">
						<option value="">Choose the number of vouchers to create</option>
						<option class="input" value="5">5 Voucher</option>
						<option class="input" value="10">10 Vouchers</option>
						<option class="input" value="50">50 Vouchers</option>
						<option class="input" value="100">100 Vouchers</option>
						<option class="input" value="200">200 Vouchers</option>
						<option class="input" value="500">500 Vouchers</option>
					</select>
					<br/>

			  	<strong>2)</strong>
				Amount of credit : 	<input class="form_input_text" name="addcredit" size="10" maxlength="10" >
				<br/>

				
				<strong>3)</strong> 
				<select NAME="choose_currency" size="1" class="form_input_select">';
                                
                                $sql_currencies = mysql_query("SELECT `id`, `currency`, `name`, `value`, `lastupdate`, `basecurrency` FROM `cc_currencies`  ORDER BY `cc_currencies`.`name` ASC", $conn_voip);
				if((isset($_POST['choose_currency']) ? $_POST['choose_currency'] : 'IDR') == 'IDR'){
				    $data_cur = "IDR";
				}
				else{
				    $data_cur = $_POST['choose_currency'];
				}
				while($data_currencies = mysql_fetch_array($sql_currencies)){
				    if($data_cur == $data_currencies['currency']){
				    $content .= '<option value=\''.$data_currencies['currency'].'\' selected >'.$data_currencies['name'].' ('.$data_currencies['value'].') </option>';
				    }else{
				    $content .= '<option value="'.$data_currencies['currency'].'" >'.$data_currencies['name'].'('.$data_currencies['value'].')</option>';
				    }
				}
                                                                                
				   $content .= '</select>
				<br/>
				
				
								<strong>4)</strong>
				Expiration date : <input class="form_input_text"  name="expirationdate" size="40" maxlength="40" value="'.(date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), (date("Y")+10)))).'"> <br> (respect the format YYYY-MM-DD HH:MM:SS)				<br/>
				<strong>5)</strong>
				Tag : <input class="form_input_text"  name="tag_list" size="40" maxlength="40" > 
			
							
		</td>	
		<td align="left" valign="bottom"> 
				<input class="form_input_button" name="generate" value="GENERATE VOUCHER" type="submit"> 
        </td>
		 </form>
        </tr>
      </tbody></table>
	  <br>';
if($new_generate == 'GENERATE VOUCHER'){          
$sql_data_voucher = mysql_query("SELECT `id`, `creationdate`, `usedate`, `expirationdate`, `voucher`, `usedcardnumber`, `tag`, `credit`, `activated`, `used`, `currency` FROM `cc_voucher` WHERE `tag`='$_POST[tag_list]' ORDER BY `id` ASC", $conn_voip); 
$content .= (mysql_num_rows($sql_data_voucher)).' rows generate succesful!';
$content .= '<table>';
      $content .= '<tr><th>ID</th><th>VOUCHER</th><th>CREDIT</th><th>TAG</th><th>ACTIVATED</th><th>USED</th><th>ACCOUNT USED</th><th>CREATED DATE</th><th>USED DATE</th><th>CURRENCY</th></tr>';
       while($r_data = mysql_fetch_array($sql_data_voucher)){     
            $content .= '<tr><td>'.$r_data['id'].'</td><td>'.$r_data['voucher'].'</td><td>'.$r_data['credit'].'</td><td>'.$r_data['tag'].'</td><td>'.$r_data['activated'].'</td><td>'.$r_data['used'].'</td><td>'.$r_data['usedcardnumber'].'</td><td>'.$r_data['creationdate'].'</td><td>'.$r_data['usedate'].'</td><td>'.$r_data['currency'].'</td></tr>';
            }
      $content .= '</table>';
}
	$content .= '</div>    

<br>';
$content .= '</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';	 


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
	
		 
<script id="source" language="javascript" type="text/javascript">
  	
$(document).ready(function () {
var format = "";
var period_val="";
var x_format = "";
var width= Math.min($("#refills_graph").parent("div").width(),$("#refills_graph").parent("div").innerWidth());
$("#refills_graph").width(width-10);
$("#refills_graph").height(Math.floor(width/2));


$(\'.update_refills_graph\').click(function () {
    $.getJSON("modules/refills_lastmonth.php", { type: this.id , view_type : period_val},
		      function(data){
				<?php if($DEBUG_MODULE)echo "alert(data.query);alert(data.data);"?>
				var graph_max = data.max;
				var graph_data = new Array();
				for (i = 0; i < data.data.length; i++) {
				    graph_data[i] = new Array();
				    graph_data[i][0]= parseInt(data.data[i][0]);
				    graph_data[i][1]= data.data[i][1]
				 }
				format = data.format;
				plot_graph_refills(graph_data,graph_max);
			 });

   });
$(\'.period_refills_graph\').change(function () {
    period_val = $(this).val();
    if($(this).val() == "month" ) x_format ="%b";
    else x_format ="%d-%m";
    $(\'.update_refills_graph:checked\').click();
   });

$(\'#view_refill_day\').click();
$(\'#view_refill_day\').change();

function plot_graph_refills(data,max){
    var d= data;
    var max_data = (max+5-(max%5));
    var min_month = $mingraph_month."000";
    var max_month = $maxgraph_month."000";
    var min_day = $mingraph_day."000";
    var max_day = $maxgraph_day."000";
    if(period_val=="month"){
	var min_graph = min_month;
	var max_graph = max_month;
	var bar_width = 28*24 * 60 * 60 * 1000;
    }else{
	var min_graph = min_day;
	var max_graph = max_day;
	var bar_width = 24 * 60 * 60 * 1000;
    }

    $.plot($("#refills_graph"), [
				{
				    data: d,
				    bars: { show: true,
						barWidth: bar_width,
						align: "centered"
				    }
				}
				 ],
			    {   xaxis: {
				    mode: "time",
				    timeformat: x_format,
				    ticks :6,
					min : min_graph,
					max : max_graph
				  },
				  yaxis: {
				  max:max_data,
				  minTickSize: 1,
				  tickDecimals:0
				  },selection: { mode: "y" },
				 grid: { hoverable: true,clickable: true}
				  });

	}
 $(\'#refills_count\').click();
 
   function showTooltip(x, y, contents) {
        $(\'<div id="tooltip">\' + contents + \'</div>\').css( {
            position: \'absolute\',
            display: \'none\',
            top: y + 5,
            left: x + 5,
            border: \'1px solid #fdd\',
            padding: \'2px\',
            \'background-color\': \'#fee\',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $("#refills_graph").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;
                    
                    $("#tooltip").remove();
		    if(format=="money"){
                    	 var y = item.datapoint[1].toFixed(2);
                    	 showTooltip(item.pageX, item.pageY, y+" <?php echo $A2B->config["global"]["base_currency"];?>");
                    }else{
                    	var y = item.datapoint[1].toFixed(0);
                    	showTooltip(item.pageX, item.pageY, y);
                    }
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
    });

    
  
  
});
  
</script>';

    $title	= 'Home';
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ../logout.php");
    }

?>