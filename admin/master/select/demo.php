<?php
include ("../../../config/configuration_admin.php");
global $conn;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
 $(".kota").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;
 
  $.ajax
  ({
   type: "GET",
   url: "fetch_kecamatan.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
      $(".kecamatan").html(html);
   } 
   });
  });
 
 
 $(".kecamatan").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;
 
  $.ajax
  ({
   type: "GET",
   url: "fetch_kelurahan.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
    $(".kelurahan").html(html);
   } 
   });
  });
 
 $(".kelurahan").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;
 
  $.ajax
  ({
   type: "GET",
   url: "fetch_kodepos.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
    $(".kodepos").html(html);
   } 
   });
  });
 
});
</script>

<div>
<label>Kota :</label> 
<select name="kota" class="kota">
<option selected="selected">--Select Country--</option>
<?php
$data_kota = mysql_query("SELECT DISTINCT(`kabupaten`) FROM `gx_master_kota` ORDER BY `kabupaten` ASC;", $conn);
while($row_kota = mysql_fetch_array($data_kota))
{
	echo '<option value="'.$row_kota["kabupaten"].'">'.$row_kota["kabupaten"].'</option>';
} 
?>
</select>

<label>Kecamatan :</label> <select name="kecamatan" class="kecamatan">
<option selected="selected">Pilih Kecamatan</option>
</select>

<label>Kelurahan :</label> <select name="kelurahan" class="kelurahan">
<option selected="selected">Pilih Kelurahan</option>
</select>

<label>Kode Pos :</label> <select name="kodepos" class="kodepos">
<option selected="selected">Pilih Kodepos</option>
</select>


</div>