<h1>ZonesPricess List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Zone</th>
      <th>Is active</th>
      <th>Initial weight</th>
      <th>Final weight</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ZonesPricess as $ZonesPrices): ?>
    <tr>
      <td><a href="<?php echo url_for('zones_prices/edit?id='.$ZonesPrices->getId()) ?>"><?php echo $ZonesPrices->getId() ?></a></td>
      <td style="font-weight: bold;"><?php echo $ZonesPrices->getZones() ?></td>
      <td><?php echo $ZonesPrices->getIsActive() ?></td>
      <td><?php echo $ZonesPrices->getInitialWeight() ?></td>
      <td><?php echo $ZonesPrices->getFinalWeight() ?></td>
      <td><?php echo $ZonesPrices->getPrice() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zones_prices/new') ?>">New</a>
