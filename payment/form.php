<html>
<head>
<TITLE>Infinitium e-Payment - Payment Window API Test</TITLE>
<script src="js/sha1.js"></script>
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

		var day = (d < 10) ? '0' + d : d;
		var month = (m < 10) ? '0' + m : m;
		var year = (yy < 1000) ? yy + 2000 : yy;

		var hh = date.getHours();
		var mm = date.getMinutes();
		var ss = date.getSeconds();

		var hour = (hh<10)?'0'+hh:hh;
		var min = (mm<10)?'0'+mm:mm;
		var sec = (ss<10)?'0'+ss:ss;

		form.MERCHANT_TRANID.value = ''+year+month+day+'_'+hour+min+sec;
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
			tokenInd = ind+';'+tokenInd
		}
		if (cri==null || cri==""){
		}
		else{
			tokenCri = cri+';'+tokenCri
		}
		form.PYMT_IND.value = tokenInd;
		form.PYMT_CRITERIA.value = tokenCri;
	}
</script>
</head>

<body >
<p align="left"><b>This is the payment test page for integrating to Infinitium 
  e-Payment Payment Window:</b></p>

<form ACTION="https://dvlp.infinitium.com:443/payment/PaymentWindow.jsp" method="POST" name="theForm" content-type="application/x-www-form-urlencoded">
  <div align="center"><center>
    <table border="1" cellspacing="1" cellpadding="2">
      <tr>
          <td>Action URL</td>
          <td colspan="2"><input name="actionurl" size="100%" value="https://dvlp.infinitium.com:443/payment/PaymentWindow.jsp"></td>
      </tr>
      <tr bgcolor="#FFFF99"> 
        <td width="301"><b>Remarks</b></td>
        <td width="320"><b>Parameter Name</b></td>
        <td width="333"><b>Value</b></td>
      </tr>
      <tr>
          <td>Generate Hash</td>
          <td>GEN_HASH</td>
          <td><select name="GEN_HASH">
            <option value="Yes" selected>Yes</option>
            <option value="No">No</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Language Selection</td>
        <td>LANG</td>
        <td><select name="LANG">
            <option value="">Default</option>
            <option value="en">English</option>
            <option value="ms">Bahasa Melayu</option>
            <option value="zh-Hans">Simplified Chinese</option>
            <option value="zh-Hant">Traditional Chinese</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Merchant Id assigned by Infinitium e-Payment<font color="red"><b>**</b></font></td>
        <td>MERCHANTID</td>
        <td> <input name="MERCHANTID" size="30" value="test01"> </td>
      </tr>
      <tr>
        <td>Merchant Reference no (must be unique, max 100 characaters)<font color="red"><b>**</b></font></td>
        <td>MERCHANT_TRANID &nbsp;&nbsp <input type="button" value="Generate ID" onClick="generateTranID(document.theForm);"/> </td>
        <td> <input name="MERCHANT_TRANID" size="30" value=""> </td>
      </tr>
       <tr>
        <td>Payment method  <font color="red">&nbsp;</font></td>
        <td>PAYMENT METHOD</td>
        <td> <input name="PAYMENT_METHOD" size="30" value="1"></td>
      </tr>
	  <tr>
			<td>Tokenization Request</td>
			<td><input type="button" value="Registration" onClick="generateTokenizationRegistration(document.theForm);"/>&nbsp<input type="button" value="Payment" onClick="generateTokenizationPayment(document.theForm);"/></td>
			<td colspan="4"></td>
		</tr>
      <tr>
        <td>Payment Indicator (use symbol ; to delimit multiple indicators) <font color="red">&nbsp;</font></td>
        <td>PAYMENT INDICATOR</td>
        <td> <input name="PYMT_IND" type="text" size="30" value="">
          i.e. card_range_ind;3rd_party_ind</td>
      </tr>
      <tr>
        <td>Payment Criteria (use symbol ; to delimit multiple indicators) <font color="red">&nbsp;</font></td>
        <td>PAYMENT CRITERIA</td>
        <td> <input name="PYMT_CRITERIA" size="30" value="">
          i.e. pbb_only;yes</td>
      </tr>
	  <tr>
			<td>Payment Token</td>
			<td>PYMT_TOKEN</td>
			<td colspan="4"> <input type="text" name="PYMT_TOKEN" value=""></td>
		</tr>
      <tr> 
        <td>Currency<font color="red"><b>**</b></font></td>
        <td>CURRENCY_CODE</td>
        <td><select name="CURRENCYCODE" size="1">
			<option  value=""></option>
            <option  value="MYR" selected>MYR</option>
            <option  value="USD">USD</option>
            <option  value="SGD">SGD</option>
            <option  value="CNY">CNY</option>
            <option  value="EUR">EUR</option>
            <option  value="HKD">HKD</option>
			<option  value="IDR">IDR</option>
            <option  value="PHP">PHP</option>
          </select></td>
      </tr>
      <tr> 
        <td>Transaction amount (2 decimal, e.g. 54.20)<font color="red"><b>**</b></font></td>
        <td>AMOUNT</td>
        <td> <input name="AMOUNT" size="20" value="2.00"> </td>
      </tr>
    
      <tr> 
        <td>Description for transaction, maximum 100 characters</td>
        <td>DESCRIPTION</td>
        <td> <input name="DESCRIPTION" size="50" value=""> </td>
      </tr>
      <tr> 
        <td>Customer name<font color="red"><b>**</b></font></td>
        <td>CUSTNAME</td>
        <td><font face="Arial"> 
          <input type="text"  size="30" maxlength="50" value="Eason Tee" name="CUSTNAME">
          </font></td>
      </tr>      
      <tr> 
        <td>Customer email<font color="red"><b>**</b></font></td>
        <td>CUSTEMAIL</td>
        <td><font face="Arial"> 
          <input type="text"  size="30" maxlength="50" value="testfe556125@test.com" name="CUSTEMAIL">
          </font></td>
      </tr>
       <tr> 
        <td>Customer Phone Number</td>
        <td>PHONE_NO</td>
        <td><input name="PHONE_NO" size="10" ></td>
      </tr>      
      <tr> 
        <td>Indicate the return page</td>
        <td>RETURN_URL</td>
        <td> <input name="RETURN_URL" size="55" value="https://dvlp.infinitium.com:443/API2/PaymentWindowReturn.jsp"> </td>
      </tr>
      <tr>
        <td>Handshake URL</td>
        <td>handshake_url</td>
        <td> <input name="handshake_url" size="55" value="https://dvlp.infinitium.com:443/API2/TestApiReturn.jsp"> </td>
      </tr>
      <tr>
        <td>Handshake Param</td>
        <td>handshake_param</td>
        <td> <input name="handshake_param" size="55" value="jhsgiureg"> </td>
      </tr>

      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>      
      <tr> 
        <td colspan=2> <font color="#3300FF">Please enter your merchant transaction password </font>:
        <br>This is only required for testing with this page to generate your transaction signature. 
        <br>For production, you should never submit your transaction password.
        </td>
        <td> <input name="TXN_PASSWORD" size="50" value="password"> </td>
      </tr>      
 
      <tr> 
        <td>Transaction Signature <font color="#3300FF">(auto-generated on this test page)</font></td> 
        <td>SIGNATURE</td>       
        <td> <input name="SIGNATURE" size="50" value=""> </td>
      </tr>              
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td colspan=3> <strong><font color="#3300FF">For more acurate fraud analysis, 
          please provide the following details of your customer:</font></strong> 
        </td>
      </tr>
      <tr> 
        <td>Billing address (no and street only, max 200 characters)</td>
        <td>BILLING_ADDRESS</td>
        <td><input name="BILLING_ADDRESS" size="40" value="57, Jalan Sentosa"></td>
      </tr>
      <tr> 
        <td>Billing address city (max 50 characters)</td>
        <td>BILLING_ADDRESS_CITY</td>
        <td><input name="BILLING_ADDRESS_CITY" size="40" value="Petaling Jaya"></td>
      </tr>
      <tr> 
        <td>Billing address region (max 100 characters)</td>
        <td>BILLING_ADDRESS_REGION</td>
        <td><input name="BILLING_ADDRESS_REGION" size="40" value=""></td>
      </tr>
      <tr> 
        <td>Billing address state (max 100 characters)</td>
        <td>BILLING_ADDRESS_STATE</td>
        <td><input name="BILLING_ADDRESS_STATE" size="40" value="Selangor"></td>
      </tr>
      <tr> 
        <td>Billing address poscode (max 10 characters)</td>
        <td>BILLING_ADDRESS_POSCODE</td>
        <td><input name="BILLING_ADDRESS_POSCODE" size="40" value="47610"></td>
      </tr>
      <tr> 
        <td>Billing address country (coded)</td>
        <td>BILLING_ADDRESS_COUNTRY_CODE</td>
        <td><input name="BILLING_ADDRESS_COUNTRY_CODE" size="10" value="MY"></td>
      </tr>
      <tr> 
        <td>Receiver Name (max 100 characters)</td>
        <td>RECEIVER_NAME_FOR_SHIPPING</td>
        <td><input name="RECEIVER_NAME_FOR_SHIPPING" size="40" value="John Aims"></td>
      </tr>
      <tr> 
        <td>Shipping address (no and street only) (max 200 characters)</td>
        <td>SHIPPING_ADDRESS</td>
        <td><input name="SHIPPING_ADDRESS" size="40" value="57, Jalan Sentosa"></td>
      </tr>
      <tr> 
        <td>Shipping address city (max 50 characters)</td>
        <td>SHIPPING_ADDRESS_CITY</td>
        <td><input name="SHIPPING_ADDRESS_CITY" size="40" value="Petaling Jaya"></td>
      </tr>
      <tr> 
        <td>Shipping address region (max 100 characters)</td>
        <td>SHIPPING_ADDRESS_REGION</td>
        <td><input name="SHIPPING_ADDRESS_REGION" size="40" value=""></td>
      </tr>
      <tr> 
        <td>Shipping address state (max 100 characters)</td>
        <td>SHIPPING_ADDRESS_STATE</td>
        <td><input name="SHIPPING_ADDRESS_STATE" size="40" value="Selangor"></td>
      </tr>
      <tr> 
        <td>Shipping address poscode (max 10 characters)</td>
        <td>SHIPPING_ADDRESS_POSCODE</td>
        <td><input name="SHIPPING_ADDRESS_POSCODE" size="40" value="47610"></td>
      </tr>
      <tr> 
        <td>Shipping address country (coded)</td>
        <td>SHIPPING_ADDRESS_COUNTRY_CODE</td>
        <td><input name="SHIPPING_ADDRESS_COUNTRY_CODE" size="10" value="MY"></td>
      </tr>
      <tr> 
        <td>Shipping cost (2 decimal, e.g. 54.20)</td>
        <td>SHIPPINGCOST</td>
        <td><input name="SHIPPINGCOST" size="10" value="2.00"></td>
      </tr>
      <tr> 
        <td>Domicile address (no and street only, max 200 characters)</td>
        <td>DOMICILE_ADDRESS</td>
        <td><input name="DOMICILE_ADDRESS" size="40" value="57, Jalan Sentosa"></td>
      </tr>
      <tr> 
        <td>Domicile address city (max 50 characters)</td>
        <td>DOMICILE_ADDRESS_CITY</td>
        <td><input name="DOMICILE_ADDRESS_CITY" size="40" value="Petaling Jaya"></td>
      </tr>
      <tr> 
        <td>Domicile address region (max 100 characters)</td>
        <td>DOMICILE_ADDRESS_REGION</td>
        <td><input name="DOMICILE_ADDRESS_REGION" size="40" value=""></td>
      </tr>
      <tr> 
        <td>Domicile address state (max 100 characters)</td>
        <td>DOMICILE_ADDRESS_STATE</td>
        <td><input name="DOMICILE_ADDRESS_STATE" size="40" value="Selangor"></td>
      </tr>
      <tr> 
        <td>Domicile address poscode (max 10 characters)</td>
        <td>DOMICILE_ADDRESS_POSCODE</td>
        <td><input name="DOMICILE_ADDRESS_POSCODE" size="40" value="47610"></td>
      </tr>
      <tr> 
        <td>Domicile address country (coded)</td>
        <td>DOMICILE_ADDRESS_COUNTRY_CODE</td>
        <td><input name="DOMICILE_ADDRESS_COUNTRY_CODE" size="10" value="MY"></td>
      </tr>	  
      <tr> 
        <td>Domicile phone no (max 20 characters)</td>
        <td>DOMICILE_PHONE_NO</td>
        <td><input name="DOMICILE_PHONE_NO" size="40" value="+60-03-34567890"></td>
      </tr> 	  	  <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>       
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td colspan=3> <strong><font color="#3300FF">Additional Order Information to be stored in Infinitium e-Payment</font></strong> 
        </td>
      </tr>
      <tr> 
        <td>Item Description 1 (max 100 characters)</td>
        <td>MREF1</td>
        <td><input name="MREF1" size="100" ></td>
      </tr>
      <tr> 
        <td>Item Description 2 (max 100 characters)</td>
        <td>MREF2</td>
        <td><input name="MREF2" size="100" ></td>
      </tr>
      <tr> 
        <td>Item Description 3 (max 100 characters)</td>
        <td>MREF3</td>
        <td><input name="MREF3" size="100" ></td>
      </tr>
      <tr> 
        <td>Item Description 4 (max 100 characters)</td>
        <td>MREF4</td>
        <td><input name="MREF4" size="100" ></td>
      </tr>     
      <tr> 
        <td>Item Description 5 (max 100 characters)</td>
        <td>MREF5</td>
        <td><input name="MREF5" size="100" ></td>
      </tr>  
      <tr> 
        <td>Item Description 6 (max 100 characters)</td>
        <td>MREF6</td>
        <td><input name="MREF6" size="100" ></td>
      </tr>   
	   <tr> 
        <td>Item Description 7 (max 100 characters)</td>
        <td>MREF7</td>
        <td><input name="MREF7" size="100" ></td>
      </tr>
	   <tr> 
        <td>Item Description 8 (max 100 characters)</td>
        <td>MREF8</td>
        <td><input name="MREF8" size="100" ></td>
      </tr>
	   <tr> 
        <td>Item Description 9 (max 100 characters)</td>
        <td>MREF9</td>
        <td><input name="MREF9" size="100" ></td>
      </tr>
	   <tr> 
        <td>Item Description 10 (max 100 characters)</td>
        <td>MREF10</td>
        <td><input name="MREF10" size="100" ></td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td colspan=3> <strong><font color="#3300FF">Additional Parameter to be passed back in response (not stored)</font></strong> 
        </td>
      </tr>      
      <tr> 
        <td>MPARAM1 (max 50 characters)</td>
        <td>MPARAM1</td>
        <td><input name="MPARAM1" size="20" ></td>
      </tr>        
      <tr> 
        <td>MPARAM2 (max 50 characters)</td>
        <td>MPARAM2</td>
        <td><input name="MPARAM2" size="20" ></td>
      </tr>   
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td colspan=3> <strong><font color="#3300FF">Additional Parameter to be 
          passed back to bank (if applicable)</font></strong> </td>
      </tr>      
      <tr> 
        <td>Customer refereces by bank (max 50 characters, may get truncated by bank)</td>
        <td>CUSTOMER_REF</td>
        <td><input name="CUSTOMER_REF" size="20" ></td>
      </tr>    	 
	  <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
	  <tr> 
        <td colspan=6> <strong><font color="#3300FF">Additional Parameter to be 
          passed to FDS (if applicable)</font></strong> </td>
      </tr>
	  <tr> 
        <td>FRISK1 (max 50 characters)</td>
        <td>FRISK1</td>
        <td colspan="4"><input name="FRISK1" size="20" maxlength="50" ></td>
      </tr>
      <tr> 
        <td>FRISK2 (max 50 characters)</td>
        <td>FRISK2</td>
        <td colspan="4"><input name="FRISK2" size="20" maxlength="50" ></td>
      </tr>
	  <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr> 
        <td colspan="4" align="center"> 
        <input type="button" value="Generate Signature" onClick="generateHash(document.theForm);"> &nbsp;&nbsp;
        <input type="submit" value="Submit" onClick="generateHash(document.theForm);"> &nbsp;&nbsp;
          <input type="reset" value="Cancel"> </td>
      </tr>
    </table>    

  </div>
</form>

</body>
</html>
