<h1>Countriess List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Short</th>
      <th>Currency</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Countriess as $Countries): ?>
    <tr>
      <td><a href="<?php echo url_for('countries/edit?id='.$Countries->getId()) ?>"><?php echo $Countries->getId() ?></a></td>
      <td><?php echo $Countries->getName() ?></td>
      <td><?php echo $Countries->getShort() ?></td>
      <td><?php echo $Countries->getCurrency() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('countries/new') ?>">New</a>
