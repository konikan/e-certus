<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<?php include_partial('shipping/steps', array('sel'=>2)) ?>

<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>
<?php if(isset($text_box1)){ ?>
<?php slot('box1') ?>
 <?php    echo $text_box1; ?>
<?php end_slot() ?>

<?php }?>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<?php //print_r($sender_values) ?>

<?php if($sf_user->getAttribute('user',null) != null || !is_null($sender_values)){ ?>

<form action="<?php echo url_for('shipping/order') ?>" method="POST">
    
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form->renderHiddenFields(); ?>
    <div class="order1">
    <div class="sender" style="float: left;">
      <table class="shipping_order" cellpadding="0" cellspacing="0">
      <tr>
          <th class="address" colspan="2" style="text-align: left;   ">Nadawca:</th>
          
      </tr>

      <?php echo ($sf_user->getAttribute('user',null) != null)?$form['search_sender']->renderRow():"" ?>

      <?php echo $form['sender']['sender_name']->renderRow() ?>
      <?php echo $form['sender']['contact_name']->renderRow() ?>
      <?php echo $form['sender']['postcode']->renderRow() ?>
      <?php echo $form['sender']['city']->renderRow() ?>
      <?php echo $form['sender']['street']->renderRow() ?>
      <?php echo $form['sender']['street_nr']->renderRow() ?>
      <?php echo $form['sender']['local_nr']->renderRow() ?>
      <?php echo $form['sender']['tel']->renderRow() ?>
      <?php echo $form['sender']['email']->renderRow() ?>
      <?php echo $form['sender']['is_company']->renderRow() ?>
      <?php echo $form['sender']['company_nip']->renderRow() ?>
      <?php if(isset($req_bank)){ ?>
      <?php echo $form['sender']['bank_name']->renderRow() ?>
       <?php echo $form['sender']['bank_account']->renderRow() ?>
     
      <?php } ?>
      <?php echo ($sf_user->getAttribute('user',null) != null)?$form['sender_save']->renderRow():"" ?>
       
     <?php  //secho $form ?>
      </table>
    </div>
    <div class="recipient" style="float: left;">
        <table class="shipping_order" cellpadding="0" cellspacing="0">
      <tr>
          <th class="address" colspan="2"style="text-align: left; ">Odbiorca:</th>

      </tr>
       <?php echo ($sf_user->getAttribute('user',null) != null)? $form['search_recipient']->renderRow():""; ?>
      <?php echo $form['recipient']['recipient_name']->renderRow() ?>
      <?php echo $form['recipient']['contact_name']->renderRow() ?>
      <?php echo (isset($calculate_values['international']) && $calculate_values['international'] == true)?$form['recipient']['country']->renderRow():"" ?>
      <?php echo $form['recipient']['postcode']->renderRow() ?>
      <?php echo $form['recipient']['city']->renderRow() ?>
      <?php echo $form['recipient']['address']->renderRow() ?>
      <?php echo $form['recipient']['tel']->renderRow() ?>
      <?php echo $form['recipient']['email']->renderRow() ?>
       <?php echo ($sf_user->getAttribute('user',null) != null)? $form['recipient_save']->renderRow():""; ?>
      <tr>
    <td colspan="2" align="right" style="width: 500px;">
        <div>
        <?php  echo $form['order_courier']->renderLabel() ?>
          <?php  echo $form['order_courier'] ?>
        </div>
        <div>
            <?php  echo $form['accept_courier_rules']->renderError() ?>
         <?php  echo $form['accept_courier_rules']->renderLabel() ?>
          <?php  echo $form['accept_courier_rules'] ?>
             
        </div>
      </td>

  </tr>

      </table>
    </div>
    <div style="clear: both;"></div>
     <div style="clear: both; line-height: 10px;"></div>
           <div style="float: right; margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
        <?php $graf = sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/dalej.jpg'; ?>
        
    </div>

    <div style="float: left; margin: 10px 10px 10px 10px;">
        <?php echo link_to(image_tag('cofnij.jpg'),'shipping/calculate') ?>
    </div>
     <div style="float: right; margin: 10px 10px 10px 10px;">
         <input type="image" value="Dalej -->"   src="<?php echo $graf; ?>"/>
     </div>
    </div>

</form>




<script type="text/javascript" >
function hide_show_company_sender()
{

}
document.getElementById('<?php echo $form->getName().'_accept_courier_rules' ?>').checked=false;
</script>
<script type="text/javascript">


$(function() {
	$("#order_search_sender").autocomplete('<?php echo url_for('user/searchSenderAjax') ?>', {

		dataType: "json",
		parse: function(data) {
                    var parsed = [];
                    for (var i=0; i < data.length; i++) {
                    var row = data[i];
                    parsed.push({
                    data: [ data[i]['sender_name'], data[i]['id'], data[i]['city'], data[i]['street'], data[i]['street_nr'], data[i]['postcode'], data[i]['contact_name'], data[i]['tel'], data[i]['email'] ],
                    value: row.sender_name,
                    result: row.sender_name
                    });
                    }
                    return parsed;
		}
	}).result(function(e, data) {
		$("#order_sender_sender_name").val(data[0]);
                $("#order_sender_city").val(data[2]);
                $("#order_sender_street").val(data[3]);
                $("#order_sender_street_nr").val(data[4]);
                $("#order_sender_postcode").val(data[5]);
                $("#order_sender_contact_name").val(data[6]);
                $("#order_sender_tel").val(data[7]);
                $("#order_sender_email").val(data[8]);
	});
});


$(function() {
	$("#order_search_recipient").autocomplete('<?php echo url_for('user/searchRecipientAjax') ?>', {

		dataType: "json",
		parse: function(data) {
                    var parsed = [];
                    for (var i=0; i < data.length; i++) {
                    var row = data[i];
                    parsed.push({
                    data: [ data[i]['sender_name'], data[i]['id'], data[i]['city'], data[i]['address'], data[i]['street_nr'], data[i]['postcode'], data[i]['contact_name'], data[i]['tel'], data[i]['email'] ],
                    value: row.sender_name,
                    result: row.sender_name
                    });
                    }
                    return parsed;
		}
	}).result(function(e, data) {
		$("#order_recipient_recipient_name").val(data[0]);
                $("#order_recipient_city").val(data[2]);
                $("#order_recipient_address").val(data[3]);
                $("#order_recipient_street_nr").val(data[4]);
                $("#order_recipient_postcode").val(data[5]);
                $("#order_recipient_contact_name").val(data[6]);
                $("#order_recipient_tel").val(data[7]);
                $("#order_recipient_email").val(data[8]);
	});
});

</script>

<?php } else { ?>
  <?php include_partial('shipping/noLoginOrder', array('login_form' => $login_form, 'sender_form'=>$sender_form)) ?>
<?php } ?>