<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div style="color: red;"><?php echo $sf_user->getFlash('error') ?></div>
<div style="color: green;"><?php echo $sf_user->getFlash('notice') ?></div>
<form action="<?php echo url_for('discounts/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?user_id='.$form->getObject()->getUserId().'&type_id='.$form->getObject()->getTypeId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('discounts/index?user='.$form->getObject()->getUserId()) ?>">Powrót</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'discounts/delete?user_id='.$form->getObject()->getUserId().'&type_id='.$form->getObject()->getTypeId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Zapisz rabat" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['type_id']->renderError() ?>
          <?php echo $form['type_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['discount']->renderLabel() ?></th>
        <td>
          <?php echo $form['discount']->renderError() ?>
          <?php echo $form['discount'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['discount_amount']->renderLabel() ?></th>
        <td>
          <?php echo $form['discount_amount']->renderError() ?>
          <?php echo $form['discount_amount'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['discount_type']->renderLabel() ?></th>
        <td>
          <?php echo $form['discount_type']->renderError() ?>
          <?php echo $form['discount_type'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['active']->renderLabel() ?></th>
        <td>
          <?php echo $form['active']->renderError() ?>
          <?php echo $form['active'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
