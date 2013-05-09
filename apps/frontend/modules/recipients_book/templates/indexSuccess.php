<h1>Odbiorcy</h1>
<?php echo link_to(image_tag('ksiazka_odbiorcow/nowy_odbiorca.jpg'),'recipients_book/new') ?>
<table cellpadding="0" cellspacing="0" class="std" style="border-top: 1px solid silver;">
  <thead>
    <tr>
      <th></th>
      
      <th>Nazwa obiorcy</th>
      <th>Osoba kontaktowa</th>
     
      <th>Kod pocztowy</th>
      <th>Miasto</th>
      <th>Adres</th>
     
      <th>Tel</th>
      

      <th></th>
 
    </tr>
  </thead>
  <tbody>
    <?php foreach ($UserRecipients as $UserRecipient): ?>
    <tr>
        <td><?php echo link_to(image_tag('ksiazka_odbiorcow/nadaj.jpg'),'shipping/index?rcpt='.$UserRecipient->getId()) ?></td>
      
      <td><?php echo $UserRecipient->getRecipientName() ?></td>
      <td><?php echo $UserRecipient->getContactName() ?></td>
     
      <td><?php echo $UserRecipient->getPostcode() ?></td>
      <td><?php echo $UserRecipient->getCity() ?></td>
      <td><?php echo $UserRecipient->getAddress() ?></td>
      
      <td><?php echo $UserRecipient->getTel() ?></td>
      
    
      <td style="border-right: 1px solid silver;"><?php echo link_to(image_tag('ksiazka_odbiorcow/edytuj.jpg'),'recipients_book/edit?id='.$UserRecipient->getId()) ?></td>
    
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


