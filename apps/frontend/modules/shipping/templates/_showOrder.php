  <?php

    if($order->getIsInternational()==1)
        $options = $order->getOrderShippingZonesServicess();
    else
        $options = $order->getOrderShippingOptionss();
  
    $sender = $order->getOrderShippingSenders();
    $sender = $sender[0];

    $recipient = $order->getOrderShippingRecipients();
    $recipient = $recipient[0];
  ?>

<table class="std" cellpadding="0" cellspacing="0">
      <tr>
          <th colspan="2" style="border-top: 1px solid silver;">Nadawca:</th>
          <th colspan="2" style="border-top: 1px solid silver;">Odbiorca:</th>
      </tr>

      <tr>
          <th align="right">Nazwa:</th>
          <td><?php echo $sender->getSenderName(); ?></td>
          <th align="right">Nazwa:</th>
          <td><?php echo $recipient->getRecipientName(); ?> </td>
      </tr>
      <tr>
          <th align="right">Osoba kontaktowa:</th>
          <td><?php echo $sender->getContactName(); ?></td>
          <th align="right">Osoba kontaktowa:</th>
          <td><?php echo $recipient->getContactName(); ?> </td>
      </tr>
      <tr>
          <th align="right">Kod pocztowy:</th>
          <td><?php echo $sender->getPostcode(); ?></td>
          <th align="right">Kod pocztowy:</th>
          <td><?php echo $recipient->getPostcode(); ?> </td>
      </tr>
      <tr>
          <th align="right">Miejscowość:</th>
          <td><?php echo $sender->getCity(); ?></td>
          <th align="right">Miejscowość:</th>
          <td><?php echo $recipient->getCity(); ?> </td>
      </tr>
      <tr>
          <th align="right">Ulica:</th>
          <td><?php echo $sender->getStreet(); ?></td>
          <th align="right">Ulica:</th>
          <td><?php echo $recipient->getAddress(); ?> </td>
      </tr>
      <tr>
          <th align="right">Numer domu:</th>
          <td><?php echo $sender->getStreetNr(); ?></td>
          <th align="right">Telefon:</th>
          <td><?php echo $recipient->getTel(); ?> </td>
      </tr>
      <tr>
          <th align="right">Numer lokalu:</th>
          <td><?php echo $sender->getLocalNr(); ?></td>
          <th align="right">E-mail:</th>
          <td><?php echo $recipient->getEmail(); ?> </td>
      </tr>
      <tr>
          <th align="right">Telefon:</th>
          <td><?php echo $sender->getTel(); ?></td>
          <th colspan="2"></th>
      </tr>
      <tr>
          <th align="right">Email:</th>
          <td><?php echo $sender->getEmail(); ?></td>
          <th colspan="2"></th>
          
      </tr>
      <tr>
          <th align="right">Firma:</th>
          <td><?php echo ($sender->getIsCompany()==1)?"Tak":"Nie"; ?></td>
          <th colspan="2"></th>
      </tr>
      <tr>
          <th align="right">NIP:</th>
          <td><?php echo $sender->getCompanyNip(); ?></td>
          <th colspan="2"></th>
      </tr>

  </table>
<table border="1" cellpadding="0" cellspacing="0"  class="std" style="width: 670px;">
  <thead>
    <tr>

      <th>Numer</th>
      <th>Data</th>
      <th>Usługa</th>
      <th>Wartość zamówienia</th>

      <th>Status</th>

      <th>Wys.</th>
      <th>Szer.</th>
      <th>Dł.</th>
      <th>Waga</th>
      <?php if($order->getSelfGiving() == 1){ ?>
      <th>Data nadania samodzielnego</th>
      <?php } else { ?>
      <th> Czas odbioru</th>
      <?php } ?>



    </tr>
  </thead>
  <tbody>

    <tr>
      <td><?php echo $order->getId() ?></td>
      <td><?php echo $order->getCreatedAt() ?></td>
      <td style="width: 35px;"><?php echo $order->getShippingTypes() ?></td>



      <td><?php echo $order->getTotalAmount() ?></td>
      <td><?php echo $order->getTextStatus() ?></td>


      <td><?php echo $order->getHeight() ?></td>
      <td><?php echo $order->getWidth() ?></td>
      <td><?php echo $order->getLength() ?></td>
      <td><?php echo $order->getWeight() ?></td>
      <td ><?php echo ($order->getSelfGiving() == 1)?$order->getSelfGivingDate():''.$order->getReceiptTimeStart().'-'.$order->getReceiptTimeEnd().'<br/>'.$order->getDateOfReceipt(); ?></td>

    </tr>

  </tbody>
</table>



 <?php if(isset ($options)): ?>
<table>
    <tr><th>Opcje:</th></tr>
    <?php foreach ($options as $option): ?>
    <?php if(is_object($option)): ?>
    <?php 
        $obj=null;
        if($order->getIsInternational()==1)
        {
            $obj = $option->getZonesServices();
        }
        else
        {
            $obj = $option->getShippingOptions();
        }
    ?>
    <tr><td><?php echo $obj->getName() ?> <?php if($obj->getAdditionalAmount() == 1): ?> kwota:  <?php echo $option->getAmount() ?>  <?php endif; ?></td> </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table>
    <?php endif; ?>