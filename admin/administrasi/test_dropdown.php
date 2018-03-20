<?php
include ("../../config/configuration_admin.php");
global $conn;
$sql = " SELECT DISTINCT `kodepos` FROM `gx_master_kota` ORDER BY `kodepos`;";
$getComboJnsKendaraan = mysql_query($sql,$conn); ?>
<script type="text/javascript" src="jquery17.min.js"></script>
<script type="text/javascript">
		$(function() {
		     $("#cmbJnsKendaraan").change(function(){
		          $("img#imgLoad").show();
		          var idkota = $(this).val();
		 
		          $.ajax({
		             type: "POST",
		             dataType: "html",
		             url: "getkecamatan.php",
		             data: 'idkota='+idkota,
		             success: function(msg){
		                 if(msg == ''){
	                            $("select#cmbMerkKendaraan").html('<option value="">--Pilih Kecamatan--</option>');
		                 }else{
		                           $("select#cmbMerkKendaraan").html(msg);                                                       
		                 }
		                 $("img#imgLoad").hide();
		 
		                 getAjaxAlamat();                                                        
		             }
		          });                    
		     });
		  
		});
</script>
<form> 
<table width="500" border="0" id="tabelForm"> 
<tr> 
    <td width="120">Jenis Kendaraan</td> 
    <td>                     
        <select name="cmbJnsKendaraan" id="cmbJnsKendaraan"> 
            <option value="">--Pilih Jenis Kendaraan--</option> 
            <?php 
                while($data = mysql_fetch_array($getComboJnsKendaraan)){ 
                    echo '<option value="'.$data['kodepos'].'">'.$data['kodepos'].'</option>'; 
                } 
            ?>                                                 
        </select> 
        <img src="loading.gif" width="18" id="imgLoad" style="display:none;" />                     
    </td> 
</tr> 
<tr> 
    <td width="120">Merk Kendaraan</td> 
    <td>                     
        <select name="cmbMerkKendaraan" id="cmbMerkKendaraan"> 
            <option value="">--Pilih Merk Kendaraan--</option>                                                                         
        </select> 
        <img src="loading.gif" width="18" id="imgLoadMerk" style="display:none;" />                     
    </td> 
</tr> 
<tr> 
    <td width="120">Kendaraan</td> 
    <td>                     
        <select name="cmbKendaraan" id="cmbKendaraan"> 
            <option value="">--Pilih Kendaraan--</option>                                                                         
        </select>                     
    </td> 
</tr> 
</table>                     
</form>
