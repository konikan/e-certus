<div class="payment">
<?php include_partial('shipping/steps', array('sel'=>4)) ?>

<?php if(isset($order)){
    $sender = $order->getSender();
    ?>

<div>
<div><h2>Dane dotyczące twojego zamówienia:</h2></div>
<form action="<?php echo url_for('payment/prepaid') ?>" method="post">
    <input type="hidden" name="order" value="<?php echo $order->getId() ?>" >
    <div style="float: right;"><input type="submit" value="Zapłać ze środków" style="width: 200px; height: 30px;"></div>
</form>
<?php include_partial('shipping/showOrder', array('order'=>$order)) ?>
</div>

<?php } ?>

</div>