<h1>ZonesOptionss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Zone</th>
      <th>Code</th>
      <th>Short name</th>
      <th>Name</th>
      <th>Service</th>
      <th>Is public access</th>
      <th>Is available</th>
      <th>Show in calculate</th>
      <th>Show in tariff</th>
      <th>Cash on delivery</th>
      <th>Commission</th>
      <th>Price</th>
      <th>Insurance</th>
      <th>Free insurance limit</th>
      <th>Additional amount</th>
      <th>Notice</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ZonesOptionss as $ZonesOptions): ?>
    <tr>
      <td><a href="<?php echo url_for('zones_options/edit?id='.$ZonesOptions->getId()) ?>"><?php echo $ZonesOptions->getId() ?></a></td>
      <td><?php echo $ZonesOptions->getZoneId() ?></td>
      <td><?php echo $ZonesOptions->getCode() ?></td>
      <td><?php echo $ZonesOptions->getShortName() ?></td>
      <td><?php echo $ZonesOptions->getName() ?></td>
      <td><?php echo $ZonesOptions->getServiceId() ?></td>
      <td><?php echo $ZonesOptions->getIsPublicAccess() ?></td>
      <td><?php echo $ZonesOptions->getIsAvailable() ?></td>
      <td><?php echo $ZonesOptions->getShowInCalculate() ?></td>
      <td><?php echo $ZonesOptions->getShowInTariff() ?></td>
      <td><?php echo $ZonesOptions->getCashOnDelivery() ?></td>
      <td><?php echo $ZonesOptions->getCommission() ?></td>
      <td><?php echo $ZonesOptions->getPrice() ?></td>
      <td><?php echo $ZonesOptions->getInsurance() ?></td>
      <td><?php echo $ZonesOptions->getFreeInsuranceLimit() ?></td>
      <td><?php echo $ZonesOptions->getAdditionalAmount() ?></td>
      <td><?php echo $ZonesOptions->getNotice() ?></td>
      <td><?php echo $ZonesOptions->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zones_options/new') ?>">New</a>
