<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>
<div class="std">

    <h1>Rejestracja</h1>

<form action="<?php echo url_for('register/index') ?>" method="POST">
  <?php echo $form->renderHiddenFields() ?>
    <?php echo $form->renderGlobalErrors(); ?>
    <div style="float: left;" >
        <style type="text/css"  >
            table input { border: 1px solid silver;}
        </style>
        <table class="reg">
        <tr>
        <th colspan="2" style="text-align: left;  background-color: lightgray; height: 30px;">
        Dane konta użytkownika:
        </th>
        </tr>
    <?php echo $form['email']->renderRow() ?>
      <?php echo $form['password']->renderRow() ?>
      <?php echo $form['password_rep']->renderRow() ?>
    <tr>
      <tr>
        <th colspan="2" style="text-align: left;  background-color: lightgray; height: 30px; ">
        Dane nadawcy:
        </th>
      
      <?php echo $form['name']->renderRow() ?>
      <?php echo $form['surname']->renderRow() ?>
      <?php echo $form['postcode']->renderRow() ?>
      <?php echo $form['city']->renderRow() ?>
      <?php echo $form['street']->renderRow() ?>
      <?php echo $form['street_nr']->renderRow() ?>
      <?php echo $form['local_nr']->renderRow() ?>
      <?php echo $form['tel']->renderRow() ?>
    <tr>
    </table>
    </div>
    <div style="float: left;">
        <table class="reg">
        <tr>
      <th colspan="2" style="text-align: left;  background-color: lightgray; height: 30px; ">
        Dane firmy (do Faktury):
      </th>
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
      <th colspan="2" style="text-align: left;  background-color: lightgray; height: 30px; ">
       Konto bankowe:
      </th>
    </tr>
    <?php echo $form['bank_name']->renderRow() ?>
    <?php echo $form['bank_account']->renderRow() ?>
    
  </table>
        
    </div>
    <div style="clear: both;"></div>
    <div style="float: right;">
        <input type="image" src="<?php echo image_path('dalej_1.jpg') ?>" />

        </div>
</form>

</div>