<h1>Typy wysyłek/ceny</h1>
<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
  
      <th></th>
      <th>Grupa</th>
      <th>Rodzaj opakowania</th>
      <th>Nazwa</th>
      <th>Dostępny</th>
      
      <th>Cena netto</th>
      <th>Waga początkowa</th>
      <th>Waga końcowa</th>
      <th>Promocja</th>
      <th>Cena promocyjna</th>
      <th>Cena się zmienia</th>
      <th>Zmiana cena</th>
      <th>Warunek zmiany ceny</th>
      <th>Pokazuj</th>
      <th>Dostępne</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingTypess as $ShippingTypes): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_types/edit?id='.$ShippingTypes->getId()) ?>"><?php echo 'Edytuj' ?></a></td>
      <td><?php echo $ShippingTypes->getShippingTypesGroups() ?></td>
      <td><?php echo $ShippingTypes->getPackagingTypes() ?></td>
      <td><?php echo $ShippingTypes->getName() ?></td>
      <td><?php echo $ShippingTypes->getIsActive() ?></td>
     
      <td><?php echo $ShippingTypes->getPrice() ?></td>
      <td><?php echo $ShippingTypes->getInitialWeight() ?></td>
      <td><?php echo $ShippingTypes->getFinalWeight() ?></td>
      <td><?php echo $ShippingTypes->getIsProm() ?></td>
      <td><?php echo $ShippingTypes->getPromPrice() ?></td>
      <td><?php echo $ShippingTypes->getIsDynamicPrice() ?></td>
      <td><?php echo $ShippingTypes->getDynamicPrice() ?></td>
      <td><?php echo $ShippingTypes->getDynamicPriceWhatIf() ?></td>
      <td><?php echo $ShippingTypes->getShow() ?></td>
      <td><?php echo $ShippingTypes->getIsAvailable() ?></td>
      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_types/new') ?>">Nowy typ/cena</a>
