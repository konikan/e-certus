<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('packaging_types/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('packaging_types/index') ?>">Wróć do listy opakowań</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Usuń', 'packaging_types/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Zapisz" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['group_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['group_id']->renderError() ?>
          <?php echo $form['group_id'] ?>
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
        <th><?php echo $form['desc']->renderLabel() ?></th>
        <td>
          <?php echo $form['desc']->renderError() ?>
          <?php echo $form['desc'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['max_width']->renderLabel() ?></th>
        <td>
          <?php echo $form['max_width']->renderError() ?>
          <?php echo $form['max_width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['max_height']->renderLabel() ?></th>
        <td>
          <?php echo $form['max_height']->renderError() ?>
          <?php echo $form['max_height'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['max_length']->renderLabel() ?></th>
        <td>
          <?php echo $form['max_length']->renderError() ?>
          <?php echo $form['max_length'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['max_weight']->renderLabel() ?></th>
        <td>
          <?php echo $form['max_weight']->renderError() ?>
          <?php echo $form['max_weight'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['max_lenght']->renderLabel() ?></th>
        <td>
          <?php echo $form['max_lenght']->renderError() ?>
          <?php echo $form['max_lenght'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['available']->renderLabel() ?></th>
        <td>
          <?php echo $form['available']->renderError() ?>
          <?php echo $form['available'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
