<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('shipping_prices/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('shipping_prices/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'shipping_prices/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
        <th><?php echo $form['group_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['group_id']->renderError() ?>
          <?php echo $form['group_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['weight_from']->renderLabel() ?></th>
        <td>
          <?php echo $form['weight_from']->renderError() ?>
          <?php echo $form['weight_from'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['weight_to']->renderLabel() ?></th>
        <td>
          <?php echo $form['weight_to']->renderError() ?>
          <?php echo $form['weight_to'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['service_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['service_id']->renderError() ?>
          <?php echo $form['service_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['price']->renderLabel() ?></th>
        <td>
          <?php echo $form['price']->renderError() ?>
          <?php echo $form['price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['prom_price']->renderLabel() ?></th>
        <td>
          <?php echo $form['prom_price']->renderError() ?>
          <?php echo $form['prom_price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_dynamic_price']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_dynamic_price']->renderError() ?>
          <?php echo $form['is_dynamic_price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['dynamic_price']->renderLabel() ?></th>
        <td>
          <?php echo $form['dynamic_price']->renderError() ?>
          <?php echo $form['dynamic_price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['dynamic_price_what_if']->renderLabel() ?></th>
        <td>
          <?php echo $form['dynamic_price_what_if']->renderError() ?>
          <?php echo $form['dynamic_price_what_if'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['show']->renderLabel() ?></th>
        <td>
          <?php echo $form['show']->renderError() ?>
          <?php echo $form['show'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_default']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_default']->renderError() ?>
          <?php echo $form['is_default'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_prom']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_prom']->renderError() ?>
          <?php echo $form['is_prom'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_available']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_available']->renderError() ?>
          <?php echo $form['is_available'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['notice']->renderLabel() ?></th>
        <td>
          <?php echo $form['notice']->renderError() ?>
          <?php echo $form['notice'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
