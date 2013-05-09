<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>
<?php if (isset($form)):?>
<h1>Podaj wymiary przesyłki</h1>
    <?php include_partial('shipping/dimensions_form',array('form'=>$form)) ?>
<?php endif;?>