<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('shipping_types_prices/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('shipping_types_prices/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'shipping_types_prices/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
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
        <th><?php echo $form['packaging_type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['packaging_type_id']->renderError() ?>
          <?php echo $form['packaging_type_id'] ?>
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
        <th><?php echo $form['initial_weight']->renderLabel() ?></th>
        <td>
          <?php echo $form['initial_weight']->renderError() ?>
          <?php echo $form['initial_weight'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['final_weight']->renderLabel() ?></th>
        <td>
          <?php echo $form['final_weight']->renderError() ?>
          <?php echo $form['final_weight'] ?>
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
