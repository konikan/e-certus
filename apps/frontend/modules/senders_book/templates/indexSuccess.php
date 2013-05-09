<h1>Nadawcy</h1>
<?php echo link_to(image_tag('ksiazka_nadawcow/nowy_nadawca.jpg'),'senders_book/new') ?>
<table class="std" cellspacing="0" cellpadding="0" style="margin-top: 10px; width: 675px; border-top: 0px solid silver;">
  <thead>
      <tr >
      <th style="border-top: 1px solid silver;"></th>
      
      
      <th style="border-top: 1px solid silver; width: 200px;">Nazwa Nadawcy</th>
      <th style="border-top: 1px solid silver;">Osoba kontaktowa</th>
      
      <th style="border-top: 1px solid silver;">Kod pocztowy</th>
      <th style="border-top: 1px solid silver;">Miasto</th>
      
      <th style="border-top: 1px solid silver;">Ulica</th>
      <th style="border-top: 1px solid silver;">Numer domu</th>
      <th style="border-top: 1px solid silver;">Numer loakalu</th>
      <th style="border-top: 1px solid silver;">Tel</th>
     
     
    </tr>
  </thead>
  <tbody >
    <?php foreach ($UserSenders as $UserSender): ?>
    <tr>
        <td><?php echo link_to(image_tag('ksiazka_nadawcow/edytuj.jpg'),'senders_book/edit?id='.$UserSender->getId()) ?></td>
    
      
        <td style="width: 200px;"><?php echo $UserSender->getSenderName() ?></td>
      <td><?php echo $UserSender->getContactName() ?></td>
 
      <td><?php echo $UserSender->getPostcode() ?></td>
      <td><?php echo $UserSender->getCity() ?></td>
     
      <td><?php echo $UserSender->getStreet() ?></td>
      <td><?php echo $UserSender->getStreetNr() ?></td>
      <td><?php echo $UserSender->getLocalNr() ?></td>
      <td style="border-right: 1px solid silver;"><?php echo $UserSender->getTel() ?></td>
     
   
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  
