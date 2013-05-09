<h1>Edycja użytkownika - <?php echo $form->getObject() ?></h1>
<div style="float: left">
<?php include_partial('form', array('form' => $form)) ?>
</div>
<div style="float: left;">
<?php echo link_to('Rabaty','discounts/index?user='.$form->getObject()->getId()) ?>
</div>
