<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('zones_services/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('zones_services/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'zones_services/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['zone_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['zone_id']->renderError() ?>
          <?php echo $form['zone_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['code']->renderLabel() ?></th>
        <td>
          <?php echo $form['code']->renderError() ?>
          <?php echo $form['code'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['short_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['short_name']->renderError() ?>
          <?php echo $form['short_name'] ?>
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
        <th><?php echo $form['service_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['service_id']->renderError() ?>
          <?php echo $form['service_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_public_access']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_public_access']->renderError() ?>
          <?php echo $form['is_public_access'] ?>
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
        <th><?php echo $form['show_in_calculate']->renderLabel() ?></th>
        <td>
          <?php echo $form['show_in_calculate']->renderError() ?>
          <?php echo $form['show_in_calculate'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['show_in_tariff']->renderLabel() ?></th>
        <td>
          <?php echo $form['show_in_tariff']->renderError() ?>
          <?php echo $form['show_in_tariff'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['cash_on_delivery']->renderLabel() ?></th>
        <td>
          <?php echo $form['cash_on_delivery']->renderError() ?>
          <?php echo $form['cash_on_delivery'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['commission']->renderLabel() ?></th>
        <td>
          <?php echo $form['commission']->renderError() ?>
          <?php echo $form['commission'] ?>
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
        <th><?php echo $form['insurance']->renderLabel() ?></th>
        <td>
          <?php echo $form['insurance']->renderError() ?>
          <?php echo $form['insurance'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['free_insurance_limit']->renderLabel() ?></th>
        <td>
          <?php echo $form['free_insurance_limit']->renderError() ?>
          <?php echo $form['free_insurance_limit'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['additional_amount']->renderLabel() ?></th>
        <td>
          <?php echo $form['additional_amount']->renderError() ?>
          <?php echo $form['additional_amount'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['notice']->renderLabel() ?></th>
        <td>
          <?php echo $form['notice']->renderError() ?>
          <?php echo $form['notice'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['type']->renderLabel() ?></th>
        <td>
          <?php echo $form['type']->renderError() ?>
          <?php echo $form['type'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['order_shipping_zones_services_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['order_shipping_zones_services_list']->renderError() ?>
          <?php echo $form['order_shipping_zones_services_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
