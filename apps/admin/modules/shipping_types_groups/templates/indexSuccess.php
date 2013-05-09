<h1>Grupy wysyłek</h1>

<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
      <th></th>
      <th>Firma kurierska</th>
      <th>Numer serwisowy</th>
      <th>Nazwa grupy</th>
      <th>Nazwa cennikowa</th>
      <th>Aktywna</th>
      <th>Typ</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingTypesGroupss as $ShippingTypesGroups): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_types_groups/edit?id='.$ShippingTypesGroups->getId()) ?>"><?php echo 'Edytuj' ?></a></td>
      <td><?php echo $ShippingTypesGroups->getCourier() ?></td>
      <td><?php echo $ShippingTypesGroups->getServiceId() ?></td>
      <td><?php echo $ShippingTypesGroups->getName() ?></td>
      <td><?php echo $ShippingTypesGroups->getNameTariff() ?></td>
      <td><?php echo $ShippingTypesGroups->getIsActive() ?></td>
      <td><?php echo $ShippingTypesGroups->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_types_groups/new') ?>">Dodaj nową grupę  wysyłki</a>
