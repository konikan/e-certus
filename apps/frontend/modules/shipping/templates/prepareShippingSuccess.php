<div class="std" style="width: 675px;">
<?php if($status=='ok'){?>
}
<div style="font-weight: bold; color: green; margin: 10px 10px 10px 10px;">
    <center>Twoje zamówienie zostało przekazanie do realizacji w firmie kurierskiej.</center>
    
</div>
<div style="margin: 10px 10px 10px 10px;"><?php echo link_to(image_tag('nadaj_kolejna_paczke.jpg'), 'shipping/order') ?></div>
<div style="margin: 10px 10px 10px 10px;"><?php echo button_to('Przygotuj nową przesyłkę', 'shipping/packageDimensions?new=true') ?></div>
<?php } else { ?>
  <div style="font-weight: bold; color: red; margin: 10px 10px 10px 10px;">
    <center>Przepraszamy ale wystapił błąd podczas przetwarzania Twojego zamówienia. <?php if(isset($error_code)) echo 'Kod błędu ('.$error_code.')' ?><br/>
        Prosimy o kontakt z działem obsługi klienta.</center>

</div>
<?php } ?>

</div>

