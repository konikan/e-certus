<h1>ZonesServicess List</h1>

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
    <?php foreach ($ZonesServicess as $ZonesServices): ?>
    <tr>
      <td><a href="<?php echo url_for('zones_services/edit?id='.$ZonesServices->getId()) ?>"><?php echo $ZonesServices->getId() ?></a></td>
      <td><?php echo $ZonesServices->getZoneId() ?></td>
      <td><?php echo $ZonesServices->getCode() ?></td>
      <td><?php echo $ZonesServices->getShortName() ?></td>
      <td><?php echo $ZonesServices->getName() ?></td>
      <td><?php echo $ZonesServices->getServiceId() ?></td>
      <td><?php echo $ZonesServices->getIsPublicAccess() ?></td>
      <td><?php echo $ZonesServices->getIsAvailable() ?></td>
      <td><?php echo $ZonesServices->getShowInCalculate() ?></td>
      <td><?php echo $ZonesServices->getShowInTariff() ?></td>
      <td><?php echo $ZonesServices->getCashOnDelivery() ?></td>
      <td><?php echo $ZonesServices->getCommission() ?></td>
      <td><?php echo $ZonesServices->getPrice() ?></td>
      <td><?php echo $ZonesServices->getInsurance() ?></td>
      <td><?php echo $ZonesServices->getFreeInsuranceLimit() ?></td>
      <td><?php echo $ZonesServices->getAdditionalAmount() ?></td>
      <td><?php echo $ZonesServices->getNotice() ?></td>
      <td><?php echo $ZonesServices->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zones_services/new') ?>">New</a>
