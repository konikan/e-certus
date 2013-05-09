<h1>Opcje wysyłek</h1>

<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
        <th>  </th>
      <th>Firma kurierska</th>
      <th>Nazwa</th>
      <th>Numer serwisowy</th>
      <th>Dostępne</th>
      <th>Pokaż w kalkulatorze</th>
      <th>Pokaż w cenniku</th>
      <th>Pobranie</th>
      <th>Prowizja</th>
      <th>Cena</th>
      <th>Ubezpiecznie</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingOptionss as $ShippingOptions): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_options/edit?id='.$ShippingOptions->getId()) ?>"><?php echo "Edytuj" ?></a></td>
      <td><?php echo $ShippingOptions->getCourier() ?></td>
      <td><?php echo $ShippingOptions->getName() ?></td>
      <td><?php echo $ShippingOptions->getServiceId() ?></td>
      <td><?php echo $ShippingOptions->getIsAvailable() ?></td>
      <td><?php echo $ShippingOptions->getShowInCalculate() ?></td>
      <td><?php echo $ShippingOptions->getShowInTariff() ?></td>
      <td><?php echo $ShippingOptions->getCashOnDelivery() ?></td>
      <td><?php echo $ShippingOptions->getCommission() ?></td>
      <td><?php echo $ShippingOptions->getPrice() ?></td>
      <td><?php echo $ShippingOptions->getInsurance() ?></td>
      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_options/new') ?>">New</a>
