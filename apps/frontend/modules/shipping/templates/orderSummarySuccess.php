<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>
<?php
    $times  =   $courier->get_start_time_receipt();
    $dates  =   $courier->calculate_date_of_receipt();
    $self_giving_dates    =   $courier->get_self_giving_date_values();
    $arrLocales = array('pl_PL', 'pl','Polish_Poland.28592');
    setlocale( LC_ALL, $arrLocales );
?>
<?php if(isset($text_box1)){ ?>
<?php slot('box1') ?>
 <?php    echo $text_box1; ?>
<?php end_slot() ?>

<?php }?>

<?php include_partial('shipping/steps', array('sel'=>3)) ?>
<form action="<?php echo url_for('shipping/orderSummary') ?>" method="post">

<div style="color: green; margin: 20px 10px 20px 10px; padding: 5px 5px 5px 5px; font-size: 18px; border: 1px solid silver; font-weight: bold;">Zlecenie zamówienia kuriera zostanie wykonane po dokonaniu płatności.</div>

<div class="select_shipping">
<?php if(isset($order_values['recipient'])): ?>
<?php $values = $order_values['recipient'] ?>
<div style="float: left;">
<table class="order_summary" cellpadding="0" cellspacing="0">
    <tr><th style="background: silver; color: black; ">Informacje o odbiorcy</th></tr>

    <tr><th>Odbiorca:</th></tr>
    <tr><td><?php echo $values['recipient_name'] ?></td></tr>
    <tr><th>Osoba Kontaktowa:</th></tr>
    <tr><td><?php echo $values['contact_name'] ?></td></tr>
    <tr><th>Kod pocztowy:</th></tr>
    <tr><td><?php echo $values['postcode'] ?></td></tr>
    <tr><th>Miejscowość:</th></tr>
    <tr><td><?php echo $values['city'] ?></td></tr>
    <tr><th>Ulica:</th></tr>
    <tr><td><?php echo $values['address'] ?></td></tr>


    <tr><th>Telefon:</th></tr>
    <tr><td><?php echo $values['tel'] ?></td></tr>
    <tr><th>e-mail:</th></tr>
    <tr><td><?php echo $values['email'] ?></td></tr>

</table>
</div>
<?php endif; ?>


    <?php if(isset($order_values['sender'])): ?>
<?php $values = $order_values['sender'] ?>
<div style="float: left;">
    <table class="order_summary" style="border-right: 1px solid silver; border-left: 1px solid silver;" cellpadding="0" cellspacing="0">
    <tr><th style="background: silver; color: black;">Informacje o nadawcy</th></tr>

    <tr><th>Nadawca:</th></tr>
    <tr><td><?php echo $values['sender_name'] ?></td></tr>
    <tr><th>Osoba Kontaktowa:</th></tr>
    <tr><td><?php echo $values['contact_name'] ?></td></tr>
    <tr><th>Kod pocztowy:</th></tr>
    <tr><td><?php echo $values['postcode'] ?></td></tr>
    <tr><th>Miejscowość:</th></tr>
    <tr><td><?php echo $values['city'] ?></td></tr>
    <tr><th>Adres:</th></tr>
    <tr><td><?php echo $values['address'] ?></td></tr>
    <tr><th>Ulica:</th></tr>
    <tr><td><?php echo $values['street'] ?></td></tr>
    <tr><th>Nr domu:</th></tr>
    <tr><td><?php echo $values['street_nr'] ?></td></tr>
    <tr><th>Nr lokalu:</th></tr>
    <tr><td><?php echo $values['local_nr'] ?></td></tr>
    <tr><th>Telefon:</th></tr>
    <tr><td><?php echo $values['tel'] ?></td></tr>
    <tr><th>e-mail:</th></tr>
    <tr><td><?php echo $values['email'] ?></td></tr>
    <tr><th>Nazwa banku:</th></tr>
    <tr><td><?php echo $values['bank_name'] ?></td></tr>
    <tr><th>Numer rachunku:</th></tr>
    <tr><td><?php echo $values['bank_account'] ?></td></tr>

</table>

</div>
<?php endif; ?>
<div style="clear: both;"></div>
<div style="float: left;">

    <table class="order_summary" >
    <tr><th style="background: silver; color: black;">Informacje o wybranych uslugach:</th></tr>
    <tr><th>Rodzaj usługi:</th></tr>
    <?php if(isset($type)): ?>
    <tr><td><?php echo $type ?></td></tr>
    <?php elseif(isset($zones_prices)): ?>
    <tr><td><?php echo "Przesyłka międzynarodowa (".$zones_prices->getZones().",do ".$zones_prices->getFinalWeight()."kg)" ?></td></tr>
    <?php endif; ?>
    <?php if(isset ($options)): ?>
    <tr><th>Opcje:</th></tr>
    <?php foreach ($options as $option): ?>
    <?php if(is_object($option)): ?>
    <tr><td><?php echo $option->getName() ?> <?php if(isset ($options[$option->getId().'_amount'])): ?> kwota:  <?php echo $options[$option->getId().'_amount'] ?>  <?php endif; ?></td> </tr>
    <?php endif; ?>
    <?php endforeach; ?>
    
    <?php endif; ?>

    <?php if(isset($order_values['order_courier']) && $order_values['order_courier']=='on'){ ?>
    <tr>
        <th style="background: silver; color: black;">Data odbioru od nadawcy: </th>
    </tr>

    <tr>
        <td>
            <select name="summary[time_start]">
        <?php
        foreach($times['start'] as $start)
        {

            echo '<option value="'.$start.'">'.$start.'</option>';

        }
        ?>
    </select>
    <select name="summary[time_end]">
        <?php
        foreach($times['end'] as $end)
        {

            echo '<option value="'.$end.'">'.$end.'</option>';

        }
        ?>
    </select>

    <select name="summary[p_date]">
        <?php
        foreach($dates as $date)
        {

            echo '<option value="'.$date.'">'.$date.' '.iconv("UTF-8","UTF-8",ucfirst(strftime('%A',  strtotime($date)))).'</option>';

        }
        ?>
    </select>

        </td>

    </tr>
    <?php } else { ?>
        <tr>
        <th style="background: silver; color: black;">Data samodzielnego nadania: </th>
    </tr>

    <tr>
        <td>
            <select name="summary[self_giving_date]">
        <?php
        foreach($self_giving_dates as $date)
        {

            echo '<option value="'.$date.'">'.$date.'</option>';

        }
        ?>
        </select>
        </td>
    </tr>
    <?php } ?>

</table>
</div>


<?php if(isset($calculate_values)): ?>
<div style="float: left;">
    <table class="order_summary" >

    <tr><th style="background: silver; color: black;">Koszt wysyłki:</th></tr>
    <tr><th>Ilość paczek:</th></tr>
    <tr><td style="font-size:10pt;"><?php echo $package_dimension['ilosc_paczek'] ?> szt.</td></tr>
    <tr><th>netto:</th></tr>
    <tr><td style="font-size:10pt;"><?php echo $calculate_values[$courier->getName().'_price'] ?> zł</td></tr>
    <tr><th>brutto:</th></tr>
    <tr><td style="font-weight: bold; font-size: 14pt;"><?php echo $calculate_values[$courier->getName().'_price_vat'] ?> zł</td></tr>
    </table>


</div>
<?php endif; ?>

<div style="clear: both;"></div>
<div style="margin: 30px 30px 0px 0px;">
<div style="float: left;">

<?php echo link_to(image_tag('popraw_dane.jpg'),'shipping/order') ?>
</div>

   <div style="float: right; margin-bottom: 15px;">
       <div>
           Opcje płatności:
           <select name="summary[payment_type]">
               <option value="1">Płatość online</option>
               <?php if(isset($user) && $user->getIsPrepaid() == 1 && $user->getPrepaidBalance() > $calculate_values[$courier->getName().'_price_vat'] ) { ?>
               <option value="2">Zgromadzone środki (<?php echo $user->getPrepaidBalance()  ?>)</option>
               <?php } ?>
           </select>
       </div>
       <?php $graf = sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/images/zloz_zamowienie.jpg'; ?>
       <div style="float: right;margin-top: 10px;"><input type="submit"   name="send" style="border: none; width: 121px; height: 30px; background-image: url('<?php echo $graf ?>');" value="" /></div>
   </div>

</div>
</div>
</form>