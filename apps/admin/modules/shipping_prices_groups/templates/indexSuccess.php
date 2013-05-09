<h1>ShippingPricesGroupss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Is active</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingPricesGroupss as $ShippingPricesGroups): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_prices_groups/edit?id='.$ShippingPricesGroups->getId()) ?>"><?php echo $ShippingPricesGroups->getId() ?></a></td>
      <td><?php echo $ShippingPricesGroups->getName() ?></td>
      <td><?php echo $ShippingPricesGroups->getIsActive() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_prices_groups/new') ?>">New</a>
