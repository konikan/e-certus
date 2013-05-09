<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<form action="#" method="post">
	 <p><label for="city">City</label><br />
		 <input type="text" name="city" id="city" value="" /></p>
	 <p><label for="state">State</label><br />
		 <input type="text" name="state" id="state" value="" /></p>
	 <p><label for="zip">Zip</label><br />
	 	 <input type="text" name="zip" id="zip" value="" /></p>
         <input type="hidden" value=""  id="id" name="id"/>
</form>
<div id="content"></div>
<script type="text/javascript">


$(function() {
	
	$("#city").autocomplete('<?php echo url_for('user/searchSenderAjax') ?>', {
		
		dataType: "json",
		parse: function(data) {
			
var parsed = [];
for (var i=0; i < data.length; i++) {
var row = data[i];
parsed.push({
data: [ data[i]['city'], i],
value: row.city + ' ' + row.zip +
' [' + row.state + ']',
result: row.city + ' ' + row.zip +
' [' + row.state + ']'
});
}
return parsed;
		}
	}).result(function(e, data) {
		$("#content").append("<p>selected " + data[1] + "</p>");
	});
});


</script>