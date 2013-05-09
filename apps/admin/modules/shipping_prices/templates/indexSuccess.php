<h1>ShippingPricess List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Courier</th>
      <th>Group</th>
      <th>Name</th>
      <th>Weight from</th>
      <th>Weight to</th>
      <th>Service</th>
      <th>Price</th>
      <th>Prom price</th>
      <th>Is dynamic price</th>
      <th>Dynamic price</th>
      <th>Dynamic price what if</th>
      <th>Show</th>
      <th>Is default</th>
      <th>Is prom</th>
      <th>Is available</th>
      <th>Notice</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingPricess as $ShippingPrices): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_prices/edit?id='.$ShippingPrices->getId()) ?>"><?php echo $ShippingPrices->getId() ?></a></td>
      <td><?php echo $ShippingPrices->getCourierId() ?></td>
      <td><?php echo $ShippingPrices->getGroupId() ?></td>
      <td><?php echo $ShippingPrices->getName() ?></td>
      <td><?php echo $ShippingPrices->getWeightFrom() ?></td>
      <td><?php echo $ShippingPrices->getWeightTo() ?></td>
      <td><?php echo $ShippingPrices->getServiceId() ?></td>
      <td><?php echo $ShippingPrices->getPrice() ?></td>
      <td><?php echo $ShippingPrices->getPromPrice() ?></td>
      <td><?php echo $ShippingPrices->getIsDynamicPrice() ?></td>
      <td><?php echo $ShippingPrices->getDynamicPrice() ?></td>
      <td><?php echo $ShippingPrices->getDynamicPriceWhatIf() ?></td>
      <td><?php echo $ShippingPrices->getShow() ?></td>
      <td><?php echo $ShippingPrices->getIsDefault() ?></td>
      <td><?php echo $ShippingPrices->getIsProm() ?></td>
      <td><?php echo $ShippingPrices->getIsAvailable() ?></td>
      <td><?php echo $ShippingPrices->getNotice() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_prices/new') ?>">New</a>
