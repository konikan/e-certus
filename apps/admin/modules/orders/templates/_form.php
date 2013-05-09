<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('orders/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div style="float: right;">
    <?php if ($form->hasErrors()): ?>
  <tr>
    <td colspan="4">
      <ul class="error_list">
        <?php foreach ($form->getErrors() as $name => $error): ?>
          <li><?php echo $name.': '.$error ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>
     <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('orders/index') ?>">Wróć do listyt</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php //echo link_to('Usuń zamówienie', 'orders/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Czy jesteś pewnien, że chcesz usunąć to zamówienie?')) ?>
            &nbsp;<?php echo (!$form->getObject()->isNew() && $form->getObject()->getIsPaid()==1 && $form->getObject()->getStatus()==1)?button_to('Wyślij list przewozowy', 'orders/sendShippingList?id='.$form->getObject()->getId()):'' ?>
            &nbsp;<?php echo (!$form->getObject()->isNew() && $form->getObject()->getIsPaid()==1 && $form->getObject()->getStatus()==0)?button_to('Zamów kuriera', 'orders/requestCourier?id='.$form->getObject()->getId().'&prepare=1'):'' ?>
        <?php endif; ?>
          <input type="submit" value="Zapisz" />

</div>
<div style="clear: both;"></div>
<div>
<div style="float: left;">
<table >
    <tfoot>
      <tr>
        <td colspan="2">

        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
        <tr>
        <th><?php echo $form['is_paid']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_paid']->renderError() ?>
          <?php echo $form['is_paid'] ?>
        </td>
      </tr>
       <tr>
        <th><?php echo $form['paid_type']->renderLabel() ?></th>
        <td>
          <?php echo $form['paid_type']->renderError() ?>
          <?php echo $form['paid_type'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['user_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['number']->renderLabel() ?></th>
        <td>
          <?php echo $form['number']->renderError() ?>
          <?php echo $form['number'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['status']->renderLabel() ?></th>
        <td>
          <?php echo $form['status']->renderError() ?>
          <?php echo $form['status'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['outher_order_number']->renderLabel() ?></th>
        <td>
          <?php echo $form['outher_order_number']->renderError() ?>
          <?php echo $form['outher_order_number'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['list_number']->renderLabel() ?></th>
        <td>
          <?php echo $form['list_number']->renderError() ?>
          <?php echo $form['list_number'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['courier_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['courier_id']->renderError() ?>
          <?php echo $form['courier_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['width']->renderLabel() ?></th>
        <td>
          <?php echo $form['width']->renderError() ?>
          <?php echo $form['width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['height']->renderLabel() ?></th>
        <td>
          <?php echo $form['height']->renderError() ?>
          <?php echo $form['height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['length']->renderLabel() ?></th>
        <td>
          <?php echo $form['length']->renderError() ?>
          <?php echo $form['length'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['normal_weight']->renderLabel() ?></th>
        <td>
          <?php echo $form['normal_weight']->renderError() ?>
          <?php echo $form['normal_weight'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['weight']->renderLabel() ?></th>
        <td>
          <?php echo $form['weight']->renderError() ?>
          <?php echo $form['weight'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['type_id']->renderError() ?>
          <?php echo $form['type_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['packaging_type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['packaging_type_id']->renderError() ?>
          <?php echo $form['packaging_type_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['date_of_receipt']->renderLabel() ?></th>
        <td>
          <?php echo $form['date_of_receipt']->renderError() ?>
          <?php echo $form['date_of_receipt'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['receipt_time_start']->renderLabel() ?></th>
        <td>
          <?php echo $form['receipt_time_start']->renderError() ?>
          <?php echo $form['receipt_time_start'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['receipt_time_end']->renderLabel() ?></th>
        <td>
          <?php echo $form['receipt_time_end']->renderError() ?>
          <?php echo $form['receipt_time_end'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['self_giving']->renderLabel() ?></th>
        <td>
          <?php echo $form['self_giving']->renderError() ?>
          <?php echo $form['self_giving'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['self_giving_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['self_giving_date']->renderError() ?>
          <?php echo $form['self_giving_date'] ?>
        </td>
      </tr>
     
      <tr>
        <th><?php echo $form['number_of_packages']->renderLabel() ?></th>
        <td>
          <?php echo $form['number_of_packages']->renderError() ?>
          <?php echo $form['number_of_packages'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['amount']->renderLabel() ?></th>
        <td>
          <?php echo $form['amount']->renderError() ?>
          <?php echo $form['amount'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['vat']->renderLabel() ?></th>
        <td>
          <?php echo $form['vat']->renderError() ?>
          <?php echo $form['vat'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['vat_amount']->renderLabel() ?></th>
        <td>
          <?php echo $form['vat_amount']->renderError() ?>
          <?php echo $form['vat_amount'] ?>
        </td>
      </tr>
      <tr>
        <th style="font-size: 14pt; "><?php echo $form['total_amount']->renderLabel() ?></th>
        <td >
          <?php echo $form['total_amount']->renderError() ?>
          <?php echo $form['total_amount'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['notes']->renderLabel() ?></th>
        <td>
          <?php echo $form['notes']->renderError() ?>
          <?php echo $form['notes'] ?>
        </td>
      </tr>
      <tr>
     
  </table>

</div>

<div style="float: left;">
    <?php echo $form['sender']->renderHiddenFields() ?>
<table>
    <thead>
      <tr>
        <th colspan="2">
        Nadawca:
        </th>
      </tr>
    </thead>
      <tr>
        <th><?php echo $form['sender']['sender_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['sender_name']->renderError() ?>
          <?php echo $form['sender']['sender_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['contact_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['contact_name']->renderError() ?>
          <?php echo $form['sender']['contact_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['postcode']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['postcode']->renderError() ?>
          <?php echo $form['sender']['postcode'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['city']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['city']->renderError() ?>
          <?php echo $form['sender']['city'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['street']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['street']->renderError() ?>
          <?php echo $form['sender']['street'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['street_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['street_nr']->renderError() ?>
          <?php echo $form['sender']['street_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['local_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['local_nr']->renderError() ?>
          <?php echo $form['sender']['local_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['email']->renderError() ?>
          <?php echo $form['sender']['email'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['tel']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['tel']->renderError() ?>
          <?php echo $form['sender']['tel'] ?>
        </td>
      </tr>
       <tr>
        <th><?php echo $form['sender']['is_company']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['is_company']->renderError() ?>
          <?php echo $form['sender']['is_company'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['company_nip']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['company_nip']->renderError() ?>
          <?php echo $form['sender']['company_nip'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['bank_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['bank_name']->renderError() ?>
          <?php echo $form['sender']['bank_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender']['bank_account']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender']['bank_account']->renderError() ?>
          <?php echo $form['sender']['bank_account'] ?>
        </td>
      </tr>
</table>
</div>

<div style="float: left;">
    <?php echo $form['recipient']->renderHiddenFields() ?>
<table>
<thead>
      <tr>
        <th colspan="2">
        Odbiorca:
        </th>
      </tr>
    </thead>
      <tr>
        <th><?php echo $form['recipient']['recipient_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['recipient_name']->renderError() ?>
          <?php echo $form['recipient']['recipient_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['recipient']['contact_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['contact_name']->renderError() ?>
          <?php echo $form['recipient']['contact_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['recipient']['postcode']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['postcode']->renderError() ?>
          <?php echo $form['recipient']['postcode'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['recipient']['city']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['city']->renderError() ?>
          <?php echo $form['recipient']['city'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['recipient']['address']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['address']->renderError() ?>
          <?php echo $form['recipient']['address'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['recipient']['tel']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['tel']->renderError() ?>
          <?php echo $form['recipient']['tel'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['recipient']['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['recipient']['email']->renderError() ?>
          <?php echo $form['recipient']['email'] ?>
        </td>
      </tr>
      
</table>


<?php $options = $form->getObject()->getOrderShippingOptionss();
if(count($options)>0) {
   ?>
    <table>
        <thead>
      <tr>
        <th colspan="2">
        Opcje:
        </th>
      </tr>
    </thead>
    </table>
    <?php foreach ($options as $option)
     { ?>
    <div style="font-weight: bold;"><?php echo $option->getShippingOptions()?></div>
     <?php echo $form['option_'.$option->getOptionId()] ?>
    <?php } ?>
    
   <?php } ?>

</div>

</div>
</form>
