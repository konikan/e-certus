<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('insurance_rates/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('insurance_rates/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'insurance_rates/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['courier_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['courier_id']->renderError() ?>
          <?php echo $form['courier_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['amount_start']->renderLabel() ?></th>
        <td>
          <?php echo $form['amount_start']->renderError() ?>
          <?php echo $form['amount_start'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['amount_end']->renderLabel() ?></th>
        <td>
          <?php echo $form['amount_end']->renderError() ?>
          <?php echo $form['amount_end'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['price']->renderLabel() ?></th>
        <td>
          <?php echo $form['price']->renderError() ?>
          <?php echo $form['price'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
