<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>
<?php

if(isset($form)){ ?>
<div class="std" style="padding-left: 5px;">
<form action="<?php echo url_for('user/info') ?>" method="POST">
    <?php echo $form->renderHiddenFields() ?>
    <div style="float: left;">
        <table width="300" class="std" cellpadding="0" cellspacing="0" style="border-left: 1px solid silver;">
      <tr>
          <td colspan="2" style="border-top: 1px solid silver;">
        Dane konta użytkownika:
      </td>
      <?php echo $form['email']->renderRow() ?>
      <?php echo $form['name']->renderRow() ?>
      <?php echo $form['surname']->renderRow() ?>
      <?php echo $form['postcode']->renderRow() ?>
      <?php echo $form['city']->renderRow() ?>
      <?php echo $form['street']->renderRow() ?>
      <?php echo $form['street_nr']->renderRow() ?>
      <?php echo $form['local_nr']->renderRow() ?>
      <?php echo $form['tel']->renderRow() ?>
    <tr>
    </table >
    </div>
    <div style="float: left;">
        <table width="300" class="std" style="background: none; border-left:1px solid silver; border-right: 1px solid silver; " cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2"  style="border-top: 1px solid silver;">
        Dane firmy (do Faktury):
      </td>
    </tr>
    <?php echo $form['is_company']->renderRow() ?>
    <?php echo $form['company_name']->renderRow() ?>
    <?php echo $form['company_post_code']->renderRow() ?>
    <?php echo $form['company_city']->renderRow() ?>
    <?php echo $form['company_street']->renderRow() ?>
    <?php echo $form['company_home_nr']->renderRow() ?>
    <?php echo $form['company_local_nr']->renderRow() ?>
    <?php echo $form['company_nip']->renderRow() ?>
    <tr>
        <tr>
            <td colspan="2"  >
       Konto bankowe:
      </td>
    </tr>
    <?php echo $form['bank_name']->renderRow() ?>
    <?php echo $form['bank_account']->renderRow() ?>
    <tr>
      <td colspan="2">
          <input type="image" value="Zapisz" src="<?php echo image_path("dane_uzytkownika\zapisz.jpg") ?>" />
      </td>
    </tr>
  </table>
    </div>
</form>
</div>
<?php } ?>
