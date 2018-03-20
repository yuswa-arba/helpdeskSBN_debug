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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open detail Customer");
    
	global $conn;
    global $conn_voip;
	$id_customer	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";

//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }

 
   
            
    $content ='<!-- Main content -->
                <section class="content">
				
				<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Search</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table">
									<form action="callhistory" method="post" name="form_search">
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Nama Customer</label>
										</div>
										<div class="col-xs-4">
											<input class="form-control" type="text" name="nama" placeholder="Nama Customer">
										</div>
										
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Nomer Telepon/VOIP</label>
										</div>
										<div class="col-xs-4">
											<input class="form-control" type="text" name="src" placeholder="Nomer Telepon/VOIP">
										</div>
										
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Tanggal </label>
										</div>
										<div class="col-xs-2">
											<input class="form-control" readonly id="datepicker" name="start_date" type="text" placeholder="Tanggal Awal" value="'.date("Y-m-01").'">
											
										</div>
										<div class="col-xs-2">
											<label>s/d </label>
										</div>
										<div class="col-xs-2">
											<input class="form-control" readonly id="datepicker" type="text" name="end_date" placeholder="Tanggal Akhir" value="'.date("Y-m-d").'">
										</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											
										</div>
										<div class="col-xs-4">
											<input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
										</div>
										<div class="col-xs-2">
											
										</div>
										<div class="col-xs-4">
											
										</div>
										</div>
										</div>
						</form>
						</div>
										</div>
										</div>
										</div>';
										
										
if(isset($_POST["search"]))
	{
	  $src     	= isset($_POST['src']) ? mysql_real_escape_string(trim($_POST['src'])) : '';
	  
	  $start_date     	= isset($_POST['start_date']) ? mysql_real_escape_string(trim($_POST['start_date'])) : '';
	  $end_date     	= isset($_POST['end_date']) ? mysql_real_escape_string(trim($_POST['end_date'])) : date("Y-m-d");
	  
	  $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
					
                    ORDER BY t1.starttime DESC LIMIT $start, $perhalaman;";
		//echo $sql_callhistory;
		$sql_call = mysql_query($sql_callhistory, $conn_voip);
		
		$sql_customer = mysql_fetch_array(mysql_query("SELECT `credit` FROM `cc_card` WHERE `useralias` = '".$src."' LIMIT 0,1;",  $conn_voip));
		
		$sql_total = mysql_num_rows(mysql_query("SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
                    ORDER BY t1.starttime DESC"));
		$sql_total_tagihan = mysql_fetch_array(mysql_query("SELECT SUM(t1.sessionbill) AS `total`
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
					
                    ORDER BY t1.starttime DESC"));
		$hal = '?src='.$src.'&s='.$start_date.'&e='.$end_date.'&';
	 
	}
	
	if(isset($_GET["src"]))
	{
	  $src     	= isset($_GET['src']) ? mysql_real_escape_string(trim($_GET['src'])) : '';
	  
	  $start_date     	= isset($_GET['s']) ? mysql_real_escape_string(trim($_GET['s'])) : '';
	  $end_date     	= isset($_GET['e']) ? mysql_real_escape_string(trim($_GET['e'])) : date("Y-m-d");
	  
	  $sql_callhistory = "SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
					
                    ORDER BY t1.starttime DESC LIMIT $start, $perhalaman;";
		//echo $sql_callhistory;
		$sql_call = mysql_query($sql_callhistory, $conn_voip);
		
		$sql_customer = mysql_fetch_array(mysql_query("SELECT `credit` FROM `cc_card` WHERE `useralias` = '".$src."' LIMIT 0,1;",  $conn_voip));
		
		$sql_total = mysql_num_rows(mysql_query("SELECT t1.starttime, t1.src, t1.id_tariffplan, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
					
                    ORDER BY t1.starttime DESC"));
		
		$sql_total_tagihan = mysql_fetch_array(mysql_query("SELECT SUM(t1.sessionbill) AS `total`
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `src` = '".$src."'
					AND `starttime` BETWEEN '".$start_date."' AND '".$end_date."'
					
                    ORDER BY t1.starttime DESC"));
		
		$hal = '?src='.$src.'&s='.$start_date.'&e='.$end_date.'&';
	 
	}
	
	if(isset($_POST["search"]) OR isset($_GET["src"]))
	{
	 $content .='
				
				<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Call History</h3>
                                    
                                </div>
                                <div class="box-body">

				
	<h4>Pulsa Terakhir: Rp '.number_format($sql_customer["credit"], 2, ',', '.').'</h4>
	<h4>Total Panggilan: '.$sql_total.'</h4>
	<h4>Total Pemakaian: Rp '.number_format($sql_total_tagihan["total"], 2, ',', '.').'</h4>
	
	
	<form action="pdf_callhistory" method="post" name="form_sendemail">
	<div class="row">
	 <div class="col-xs-6">
	 </div>
	 <div class="col-xs-6">
	
	
	 <div class="form-group">
	 <div class="row">
	 <div class="col-xs-4">
	 </div>
	 <div class="col-xs-4">
		 <input class="form-control" type="text" name="email" placeholder="Email" value="">
		 <input class="form-control" type="hidden" name="src" value="'.$src.'">
		 <input class="form-control" type="hidden" name="s" value="'.$start_date.'">
		 <input class="form-control" type="hidden" name="e" value="'.$end_date.'">
	 </div>
	 
	 <div class="col-xs-4">
		 <input class="btn bg-olive btn-flat" name="send" value="Send" type="submit">
	 </div>
	 </div>
	 </div>
	 
	 </div>
	
	 
	 
	 </div>
	</form>
	
	<table width="100%" id="callhistory" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
                <thead><tr>
                  <th width="20">#</th>
                  <th >Date</th>
                  <th >CallerID</th>
                  <th >PhoneNumber</th>
                  <th >Destination</th>
		  <th >Duration</th>
                  <th >TC</th>
		  <th >Rate Card</th>
                  <th >CallType</th>
                  <th >Cost</th>
                </tr>
		</thead>
		<tbody>';
		
	
	
		
		
		
		
		$no = $start +1;
		
		while ($row_callhistory = mysql_fetch_array($sql_call)){
		    $sql_country = mysql_query("SELECT * FROM  `cc_country` WHERE  `countryprefix` =  '".$row_callhistory["destination"]."';");
		    $row_country = mysql_fetch_array($sql_country);
		    
		    $calltype	 = '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="0") ? 'STANDARD' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="1") ? 'SIP/IAX' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="2") ? 'DIDCALL' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="3") ? 'DID_VOIP' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="4") ? 'CALLBACK' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="5") ? 'PREDICT' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="6") ? 'AUTO DIALER' : '';
		    $calltype	 .= ($row_callhistory["sipiax"]=="7") ? 'DID-ALEG' : '';
		    
		    $tc  ='';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="1") ? 'ANSWER' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="2") ? '2' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="3") ? '3' : '';
		    $tc	 .= ($row_callhistory["terminatecauseid"]=="4") ? '4' : '';
		    
		    if($row_callhistory["destination"] == "628"){
			$destination = "Indonesian Mobile";
		    }else{
			$destination = $row_country["countryname"];
		    }
		    $sql_ratecard = mysql_query("SELECT * FROM  `cc_tariffplan` WHERE  `id` =  '$row_callhistory[id_tariffplan]'");
		    $row_ratecard = mysql_fetch_array($sql_ratecard);
                $content .='
                <tr bgcolor="#F2F8FF" onmouseover="bgColor=\'#C4FFD7\'" onmouseout="bgColor=\'#F2F8FF\'"> 
                    <td align="" class="tableBody">'.$no.'</td>
                    <td valign="top" align="center" class="tableBody">'.date("d-m-Y H:i:s", strtotime($row_callhistory["starttime"])).'</td>
                    <td valign="top" align="center" class="tableBody">'.$row_callhistory["src"].'</td>
                    <td valign="top" align="center" class="tableBody">'.$row_callhistory["calledstation"].'</td>
                    <td valign="top" align="center" class="tableBody">'.$destination.'</td>
                    <td valign="top" align="center" class="tableBody">'.gmdate("H:i:s", $row_callhistory["sessiontime"]).'</td>
                    <td valign="top" align="center" class="tableBody">'.$tc.'</td>
					<td valign="top" align="center" class="tableBody">'.$row_ratecard["tariffname"].'</td>
                    <td valign="top" align="center" class="tableBody">'.$calltype.'</td>
                    <td valign="top" align="center" class="tableBody">'.number_format($row_callhistory["sessionbill"], 2, ',', '.').' IDR</td>
                </tr>
                ';
		$no++;
		}
		
                $content .='
		
                </tbody></table>
		
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($sql_total, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								 </div>
                            </div>
                    
                    <!-- Main row -->';
                    
	}
					$content .='

                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />

    <!-- bootstrap datepicker -->
    <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
$(function() {
    $("[id=datepicker]").datepicker({format: "yyyy-mm-dd",autoclose: true});
});
</script>

<style>
.callhistory_td1 {
background-color: #600101;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td2 {
background-color: #600101;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td3 {
background-color: #b72222;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td4 {
background-color: #b72222;
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
.callhistory_td5 {
font-family: Verdana;
font-size: 10px;
font-weight: bold;
color: #FFFFFF;
}
</style>
    ';

    $title	= 'Call History';
    $submenu	= "Call History";
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