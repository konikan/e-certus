<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('customers/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('customers/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'customers/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['activity']->renderLabel() ?></th>
        <td>
          <?php echo $form['activity']->renderError() ?>
          <?php echo $form['activity'] ?>
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
        <th><?php echo $form['is_company']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_company']->renderError() ?>
          <?php echo $form['is_company'] ?>
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
        <th><?php echo $form['surname']->renderLabel() ?></th>
        <td>
          <?php echo $form['surname']->renderError() ?>
          <?php echo $form['surname'] ?>
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
        <th><?php echo $form['company_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_name']->renderError() ?>
          <?php echo $form['company_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company_nip']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_nip']->renderError() ?>
          <?php echo $form['company_nip'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company_post_code']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_post_code']->renderError() ?>
          <?php echo $form['company_post_code'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company_city']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_city']->renderError() ?>
          <?php echo $form['company_city'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company_street']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_street']->renderError() ?>
          <?php echo $form['company_street'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company_home_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_home_nr']->renderError() ?>
          <?php echo $form['company_home_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company_local_nr']->renderLabel() ?></th>
        <td>
          <?php echo $form['company_local_nr']->renderError() ?>
          <?php echo $form['company_local_nr'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['bank_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['bank_name']->renderError() ?>
          <?php echo $form['bank_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['bank_account']->renderLabel() ?></th>
        <td>
          <?php echo $form['bank_account']->renderError() ?>
          <?php echo $form['bank_account'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['blocked']->renderLabel() ?></th>
        <td>
          <?php echo $form['blocked']->renderError() ?>
          <?php echo $form['blocked'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_cash_on_delivery']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_cash_on_delivery']->renderError() ?>
          <?php echo $form['is_cash_on_delivery'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_prepaid']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_prepaid']->renderError() ?>
          <?php echo $form['is_prepaid'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['prepaid_balance']->renderLabel() ?></th>
        <td>
          <?php echo $form['prepaid_balance']->renderError() ?>
          <?php echo $form['prepaid_balance'] ?>
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
    </tbody>
  </table>
</form>
