<div class="payment">
<?php include_partial('shipping/steps', array('sel'=>4)) ?>
<div class="select_shipping">
<?php if(isset($order)){
    $sender = $order->getSender();
    ?>


<div><h2>Dane dotyczące twojego zamówienia:</h2></div>
<?php
$id_sprzed  =   '';
$kwota      =   $order->getTotalAmount();
$crc        =   '';
$kod        =   $order->getId();
$md5 = md5($id_sprzed.$kwota.$crc.$kod);

?>
<form action="https://secure.transferuj.pl" method="post">
 <!--
<input type="hidden" name="md5sum" value="<?php echo $md5 ?>">
 -->
<input type="hidden" name="id" value="<?php echo $id_sprzed ?>">
<input type="hidden" name="kwota" value="<?php echo $order->getTotalAmount(); ?>">
<input type="hidden" name="opis" value="e-certus zamowienie nr: <?php echo $order->getId() ?>">
<input type="hidden" name="crc" value="">
<input type="hidden" name="wyn_url" value="Adres URL powaiadomienia">
<input type="hidden" name="wyn_email" value="ecertus@interia.pl">
<input type="hidden" name="opis_sprzed" value="e-certus">
<input type="hidden" name="pow_url" value="<?php echo url_for('payment/success?order='.$order->getId(),true) ?>">
<input type="hidden" name="pow_url_blad" value="<?php echo url_for('payment/fail?order='.$order->getId(),true) ?>">
<input type="hidden" name="pow_tekst" value="Wróć">
<input type="hidden" name="email" value="<?php echo $sender->getEmail() ?>">
<input type="hidden" name="nazwisko" value="<?php echo $sender->getSenderName() ?>">
<input type="hidden" name="imie" value="">
<input type="hidden" name="adres" value="">
<input type="hidden" name="miasto" value="">
<input type="hidden" name="kod" value="">
<input type="hidden" name="kraj" value="">
<input type="hidden" name="telefon" value="">
<div style="float: right; margin-right: 30px;">
    <input size="30" type="image" src="<?php echo image_path('zaplac.jpg') ?>" name="Przejdź do płatności" value="Zapłać" style="width: 71px; height: 30px;">
</div>
</form>
<?php include_partial('shipping/showOrder', array('order'=>$order)) ?>


</div>
<?php }?>

</div>