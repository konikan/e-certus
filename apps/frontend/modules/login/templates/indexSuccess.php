<?php slot('login') ?>
<?php include_component('login', 'loginForm',array('form'=>$form)) ?>
<?php end_slot() ?>

<?php if(isset($error)) echo $error ?>