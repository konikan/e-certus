<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('ordershipping/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div style="float: left;">
 <?php echo $form['sender'] ?>
</div>
<div style="float: left;">
 <?php echo $form['recipient'] ?>
</div>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('ordershipping/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'ordershipping/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
       
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
        <th><?php echo $form['courier_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['courier_id']->renderError() ?>
          <?php echo $form['courier_id'] ?>
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
        <th><?php echo $form['total_amount']->renderLabel() ?></th>
        <td>
          <?php echo $form['total_amount']->renderError() ?>
          <?php echo $form['total_amount'] ?>
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
        <th><?php echo $form['order_shipping_options_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['order_shipping_options_list']->renderError() ?>
          <?php echo $form['order_shipping_options_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
