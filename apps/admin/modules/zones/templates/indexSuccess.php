<h1>Zoness List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Courier</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Zoness as $Zones): ?>
    <tr>
      <td><a href="<?php echo url_for('zones/edit?id='.$Zones->getId()) ?>"><?php echo $Zones->getId() ?></a></td>
      <td><?php echo $Zones->getCourierId() ?></td>
      <td><?php echo $Zones->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('zones/new') ?>">New</a>
