<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="std">
<form action="<?php echo url_for('senders_book/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp<?php echo button_to('Powrót do listy','senders_book/index') ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo button_to('Usuń', 'senders_book/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Zapisz" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      
     <tr>
        <th><?php echo $form['is_default']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_default']->renderError() ?>
          <?php echo $form['is_default'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_company']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_company']->renderError() ?>
          <?php echo $form['is_company'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sender_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['sender_name']->renderError() ?>
          <?php echo $form['sender_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['contact_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['contact_name']->renderError() ?>
          <?php echo $form['contact_name'] ?>
        </td>
      </tr>
      
      <tr>
        <th><?php echo $form['postcode']->renderLabel() ?></th>
        <td>
          <?php echo $form['postcode']->renderError() ?>
          <?php echo $form['postcode'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['city']->renderLabel() ?></th>
        <td>
          <?php echo $form['city']->renderError() ?>
          <?php echo $form['city'] ?>
        </td>
      </tr>
     
      <tr>
        <th><?php echo $form['street']->renderLabel() ?></th>
        <td>
          <?php echo $form['street']->renderError() ?>
          <?php echo $form['street'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['street_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['street_nr']->renderError() ?>
          <?php echo $form['street_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['local_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['local_nr']->renderError() ?>
          <?php echo $form['local_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tel']->renderLabel() ?></th>
        <td>
          <?php echo $form['tel']->renderError() ?>
          <?php echo $form['tel'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
        </td>
      </tr>
     
      <tr>
        <th><?php echo $form['company_nip']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_nip']->renderError() ?>
          <?php echo $form['company_nip'] ?>
        </td>
      </tr>
     
    </tbody>
  </table>
</form>
</div>