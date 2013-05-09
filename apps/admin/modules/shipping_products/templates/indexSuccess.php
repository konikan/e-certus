<h1>ShippingProductss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Is active</th>
      <th>Weight from</th>
      <th>Weight to</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingProductss as $ShippingProducts): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_products/edit?id='.$ShippingProducts->getId()) ?>"><?php echo $ShippingProducts->getId() ?></a></td>
      <td><?php echo $ShippingProducts->getName() ?></td>
      <td><?php echo $ShippingProducts->getIsActive() ?></td>
      <td><?php echo $ShippingProducts->getWeightFrom() ?></td>
      <td><?php echo $ShippingProducts->getWeightTo() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_products/new') ?>">New</a>
