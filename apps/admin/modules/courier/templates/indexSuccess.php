<h1>Couriers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Couriers as $Courier): ?>
    <tr>
      <td><a href="<?php echo url_for('courier/edit?id='.$Courier->getId()) ?>"><?php echo $Courier->getId() ?></a></td>
      <td><?php echo $Courier->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('courier/new') ?>">New</a>
