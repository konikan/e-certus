<h1>ShippingTypesPricess List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Type</th>
      <th>Packaging type</th>
      <th>Price</th>
      <th>Initial weight</th>
      <th>Final weight</th>
      <th>Is prom</th>
      <th>Prom price</th>
      <th>Is dynamic price</th>
      <th>Dynamic price</th>
      <th>Dynamic price what if</th>
      <th>Show</th>
      <th>Is available</th>
      <th>Notice</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ShippingTypesPricess as $ShippingTypesPrices): ?>
    <tr>
      <td><a href="<?php echo url_for('shipping_types_prices/edit?id='.$ShippingTypesPrices->getId()) ?>"><?php echo $ShippingTypesPrices->getId() ?></a></td>
      <td><?php echo $ShippingTypesPrices->getTypeId() ?></td>
      <td><?php echo $ShippingTypesPrices->getPackagingTypeId() ?></td>
      <td><?php echo $ShippingTypesPrices->getPrice() ?></td>
      <td><?php echo $ShippingTypesPrices->getInitialWeight() ?></td>
      <td><?php echo $ShippingTypesPrices->getFinalWeight() ?></td>
      <td><?php echo $ShippingTypesPrices->getIsProm() ?></td>
      <td><?php echo $ShippingTypesPrices->getPromPrice() ?></td>
      <td><?php echo $ShippingTypesPrices->getIsDynamicPrice() ?></td>
      <td><?php echo $ShippingTypesPrices->getDynamicPrice() ?></td>
      <td><?php echo $ShippingTypesPrices->getDynamicPriceWhatIf() ?></td>
      <td><?php echo $ShippingTypesPrices->getShow() ?></td>
      <td><?php echo $ShippingTypesPrices->getIsAvailable() ?></td>
      <td><?php echo $ShippingTypesPrices->getNotice() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('shipping_types_prices/new') ?>">Nowy typ/cena</a>
