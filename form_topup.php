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

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
    
    global $conn;
    global $conn_voip;
            
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Topup</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">MerchantID</label>
                                            <input type="text" class="form-control" readonly="" name="username" value="GXCC_'.date("dmyHis").'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Nama</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="'.$loggedin["username"].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" value="'.$loggedin["alamat"].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="text" class="form-control" name="email" value="'.$loggedin["email"].'">
                                        </div>
					<div class="form-group">
                                            <label for="exampleInputEmail1">Nominal</label>
                                            <select class="form-control" name="nominal">
						<option value="100000">Rp 100.000</option>
						<option value="200000">Rp 200.000</option>
						<option value="500000">Rp 500.000</option>
						<option value="1000000">Rp 1.000.000</option>
					    </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="send" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->';

$plugins = '<script src="'.URL.'js/payment/sha1.js"></script>
<script language="JavaScript">
	function generateHash(form) {
	  var actionurl = form.actionurl.value;
	  form.action = actionurl;

	  if(form.GEN_HASH.value == "Yes"){
		var str = "##" + form.MERCHANTID.value.toUpperCase() + "##" + form.TXN_PASSWORD.value.toUpperCase() + "##" + form.MERCHANT_TRANID.value.toUpperCase() + "##" + form.AMOUNT.value.toUpperCase() + "##0##";
		form.SIGNATURE.value = hex_sha1(str);
		alert (str);
	  }
	}
	function generateTranID(form){
		var date = new Date();

		var yy = date.getFullYear();
		var m = date.getMonth() + 1;
		var d  = date.getDate();

		var day = (d < 10) ? \'0\' + d : d;
		var month = (m < 10) ? \'0\' + m : m;
		var year = (yy < 1000) ? yy + 2000 : yy;

		var hh = date.getHours();
		var mm = date.getMinutes();
		var ss = date.getSeconds();

		var hour = (hh<10)?\'0\'+hh:hh;
		var min = (mm<10)?\'0\'+mm:mm;
		var sec = (ss<10)?\'0\'+ss:ss;

		form.MERCHANT_TRANID.value = \'\'+year+month+day+\'_\'+hour+min+sec;
	}
	function generateTokenizationRegistration(form){
		var tokenCri = "registration";
		generateTokenINDCRI(form,tokenCri);
	}
	function generateTokenizationPayment(form){
		var tokenCri = "payment";
		generateTokenINDCRI(form,tokenCri);
		form.CARDNO.value = "";
		form.CARDNAME.value = "";
		form.CARDTYPE.value = "";
		form.EXPIRYMONTH.value = "";
		form.EXPIRYYEAR.value = "";
		form.CARD_ISSUER_BANK.value = "";
		form.CARD_ISSUER_BANK_COUNTRY_CODE.value = "";
	}
	function generateTokenINDCRI(form, tokenCri){
		var ind = form.PYMT_IND.value;
		var cri = form.PYMT_CRITERIA.value;
		var tokenInd = "tokenization";
		if (ind==null || ind==""){
		}
		else{
			tokenInd = ind+\';\'+tokenInd
		}
		if (cri==null || cri==""){
		}
		else{
			tokenCri = cri+\';\'+tokenCri
		}
		form.PYMT_IND.value = tokenInd;
		form.PYMT_CRITERIA.value = tokenCri;
	}
</script>';

    $title	= 'Form Kartu Kredit';
    $submenu	= "topup";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>