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
include ("../../config/configuration_voip_bali.php");

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

/*
voucher
credit
tag
activated

currency
expirationdate

VOUCHER 	 
AMOUNT 	 
TAG 	 
ACTIVATED   
CURRENCY 	 
EXPIRY DATE 
*/
$new_update 	= isset($_POST['submit']) ? $_POST['submit'] : '';
$bil_voucher    = rand(111111111111111, 999999999999999);
if($new_update == 'UPDATE'){
   

$row_creationdate_upd	= isset($_POST['creationdate']) ? $_POST['creationdate'] : '';
$row_usedate_upd		= isset($_POST['usedate']) ? $_POST['usedate'] : '';
$row_usedcardnumber_upd	= isset($_POST['usedcardnumber']) ? $_POST['usedcardnumber'] : '';
$row_used_upd		= isset($_POST['used']) ? $_POST['used'] : '';

$row_id_upd			 = isset($_GET['id']) ? $_GET['id'] : '';
$row_voucher_upd             = isset($_POST['voucher']) ? $_POST['voucher'] : '';
$row_credit_upd              = isset($_POST['credit']) ? $_POST['credit'] : '';
$row_tag_upd                 = isset($_POST['tag']) ? $_POST['tag'] : '';
$row_activated_upd           = isset($_POST['activated']) ? $_POST['activated'] : '';
$row_currency_upd            = isset($_POST['currency']) ? $_POST['currency'] : '';
$row_expirationdate_upd      = isset($_POST['expirationdate']) ? $_POST['expirationdate'] : '';
  
//4 	2014-10-24 17:22:47 	0000-00-00 00:00:00 	2024-10-20 08:17:11 	946286295256753 	NULL 	new bi 	1234 	t 	0 	IDR
mysql_query("UPDATE `cc_voucher` SET `creationdate`='$row_creationdate_upd', `usedate`='$row_usedate_upd', `expirationdate`='$row_expirationdate_upd', `voucher`='$row_voucher_upd', `usedcardnumber`='$row_usedcardnumber_upd', `tag`='$row_tag_upd', `credit`='$row_credit_upd', `activated`='$row_activated_upd', `used`='$row_used_upd', `currency`='$row_currency_upd' WHERE `id`='$row_id_upd'", $conn_voip);
header('location:vouchers.php');
}

$content = '';

$content .= '
                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Vouchers</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

$data_edit = mysql_fetch_array(mysql_query("SELECT * FROM `cc_voucher` WHERE `id`='$_GET[id]'", $conn_voip));

$row_id			= $data_edit['id'];
$row_creationdate	= $data_edit['creationdate'];
$row_usedate		= $data_edit['usedate'];
$row_expirationdate	= $data_edit['expirationdate'];
$row_voucher		= $data_edit['voucher'];
$row_usedcardnumber	= $data_edit['usedcardnumber'];
$row_tag		= $data_edit['tag'];
$row_credit		= $data_edit['credit'];
$row_activated		= $data_edit['activated'];
$row_used		= $data_edit['used'];
$row_currency		= $data_edit['currency'];
				
$content .= '<div align="center">  	  
	   
        <FORM action="" id="myForm" method="post" name="myForm">
	
	<TABLE cellspacing="2" class="addform_table1">
          <INPUT type="hidden" name="form_action" value="add">
		  <INPUT type="hidden" name="wh" value="">
		 	 <INPUT type="hidden" name="atmenu" value="">
			 <INPUT type="hidden" name="creationdate" value="'.$row_creationdate.'">
			 <INPUT type="hidden" name="usedate" value="'.$row_usedate.'">
			 <INPUT type="hidden" name="usedcardnumber" value="'.$row_usedcardnumber.'">
			 <INPUT type="hidden" name="used" value="'.$row_used.'">




			 
		 <TBODY>
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		VOUCHER 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="" class="text">
				
	                 <INPUT class="form_input_text" name=voucher  size=20 value="'.$row_voucher.'" readonly maxlength=40>
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		AMOUNT 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="" class="text">
				
	                 <INPUT class="form_input_text" name="credit"  size=30 maxlength=30 value="'.$row_credit.'">
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		TAG 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="" class="text">
				
	                 <INPUT class="form_input_text" name=tag  size=30 maxlength=30 value="'.$row_tag.'">
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		ACTIVATED 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="" class="text">
                        
<select name="activated" >				
	  <option value="t" '.($row_activated='t' ? 'checked' : '').'>Yes</option>
          <option value="f" '.($row_activated='f' ? '' : 'checked').'>No </option>
</select>          
          <span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		CURRENCY 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="" class="text">
				
			   <SELECT name="currency" class="form_input_select">';
                           
                                $sql_currencies = mysql_query("SELECT `id`, `currency`, `name`, `value`, `lastupdate`, `basecurrency` FROM `cc_currencies`  ORDER BY `cc_currencies`.`name` ASC", $conn_voip);
				if($row_currency == 'IDR'){
				    $data_cur = "IDR";
				}
				else{
				    $data_cur = $row_currency;
				}
				while($data_currencies = mysql_fetch_array($sql_currencies)){
				    if($data_cur == $data_currencies['currency']){
				    $content .= '<option value=\''.$data_currencies['currency'].'\' selected >'.$data_currencies['name'].' ('.$data_currencies['value'].') </option>';
				    }else{
				    $content .= '<option value="'.$data_currencies['currency'].'" >'.$data_currencies['name'].'('.$data_currencies['value'].')</option>';
				    }
				}
                                  
                           
		$content.= '</SELECT>
			<span class="liens">
	                         </span> 
	       </TD>
	</TR>
					
	               <TR>
			   			<TD width="%25" valign="middle" class="form_head"> 		EXPIRY DATE 		</TD>  
			<TD width="%75" valign="top" class="tableBodyRight" background="" class="text">
				
	                 <INPUT class="form_input_text" name=expirationdate  size=40 maxlength=40  value="'.(date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), (date("Y")+10)))).'">
			<span class="liens">
	                         </span> 
	<br/>Format YYYY-MM-DD HH:MM:SS. For instance,          </TD>
	</TR>
					
		
        </TBODY>
      </TABLE>
	  <TABLE cellspacing="0" class="editform_table8">
		<tr>
			<td width="50%" class="text_azul"><span class="tableBodyRight">Click Confirm Data to continue.</span></td>
                        <td width="50%" align="right" valign="top" class="text">
				
				<INPUT type="submit" name="submit" value="UPDATE">
				<!--
                                <a href="#" onClick="javascript:document.myForm.submit();" class="cssbutton_big">
				CONFIRM DATA </a>
				-->
			</td>
		</tr>
	  </TABLE>
	</FORM>
	  <br>';


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