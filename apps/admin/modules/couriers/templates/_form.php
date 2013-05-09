<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('couriers/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('couriers/index') ?>">Wróć do listy kurierów</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Usuń', 'couriers/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Zapisz" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['available']->renderLabel() ?></th>
        <td>
          <?php echo $form['available']->renderError() ?>
          <?php echo $form['available'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['client_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['client_nr']->renderError() ?>
          <?php echo $form['client_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['api_key']->renderLabel() ?></th>
        <td>
          <?php echo $form['api_key']->renderError() ?>
          <?php echo $form['api_key'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['login']->renderLabel() ?></th>
        <td>
          <?php echo $form['login']->renderError() ?>
          <?php echo $form['login'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['pass']->renderLabel() ?></th>
        <td>
          <?php echo $form['pass']->renderError() ?>
          <?php echo $form['pass'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['petrol_charge']->renderLabel() ?></th>
        <td>
          <?php echo $form['petrol_charge']->renderError() ?>
          <?php echo $form['petrol_charge'] ?>
        </td>
      </tr>
       <tr>
        <th><?php echo $form['start_work_time']->renderLabel() ?></th>
        <td>
          <?php echo $form['start_work_time']->renderError() ?>
          <?php echo $form['start_work_time'] ?>
        </td>
      </tr>
       <tr>
        <th><?php echo $form['end_work_time']->renderLabel() ?></th>
        <td>
          <?php echo $form['end_work_time']->renderError() ?>
          <?php echo $form['end_work_time'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['desc']->renderLabel() ?></th>
        <td>
          <?php echo $form['desc']->renderError() ?>
          <?php echo $form['desc'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
