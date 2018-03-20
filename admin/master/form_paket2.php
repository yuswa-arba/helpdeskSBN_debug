<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */

?>
<!-- jQuery 2.0.2 -->
        <script src="https://172.16.79.194/software/beta/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="https://172.16.79.194/software/beta/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="https://172.16.79.194/software/beta/js/bootstrap.min.js" type="text/javascript"></script>
        
	
	<!-- datepicker -->
        <script src="https://172.16.79.194/software/beta/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        

<script>    
       $('#item_shipping_false').change(function() {
  $('#item_shipping_cost').prop('disabled', true);
});
$('#item_shipping_true').change(function() {
  $('#item_shipping_cost').prop('disabled', false);
});

      

      $(function() {
    var $inputs = $('input.rbutton');
    $inputs.change(function() {
        if ($('input.rbutton:checked').length == 2) {
            $inputs.not(':checked').prop('disabled', true);
        } else {
            $inputs.prop('disabled', false);
        }
    });
});
    </script>
<span>
  <input type="radio" value="false" name="item[shipping]" id="item_shipping_false" checked="checked">
  <label for="item_shipping_false" class="collection_radio_buttons">No</label>
</span>
<span>
  <input type="radio" value="true" name="item[shipping]" id="item_shipping_true">
  <label for="item_shipping_true" class="collection_radio_buttons">Yes</label>
</span>
<input id="item_shipping_cost" class="currency optional" type="text" size="30" name="item[shipping_cost]" disabled="disabled">
	                
			
			<ul>
    <li><input type="checkbox" class="rbutton"  name="radio[]" value="1" /></li>
    <li><input type="checkbox" class="rbutton"  name="radio[]" value="2" /></li>
    <li><input type="checkbox" class="rbutton"  name="radio[]" value="3"/></li>
    <li><input type="checkbox" class="rbutton"  name="radio[]" value="4" /></li>
</ul>