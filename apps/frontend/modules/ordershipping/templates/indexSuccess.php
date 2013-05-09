<h1>OrderShippings List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Number</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Status</th>
      <th>Courier</th>
      <th>Amount</th>
      <th>Vat</th>
      <th>Vat amount</th>
      <th>Total amount</th>
      <th>Outher order number</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($OrderShippings as $OrderShipping): ?>
    <tr>
      <td><a href="<?php echo url_for('ordershipping/edit?id='.$OrderShipping->getId()) ?>"><?php echo $OrderShipping->getId() ?></a></td>
      <td><?php echo $OrderShipping->getNumber() ?></td>
      <td><?php echo $OrderShipping->getCreatedAt() ?></td>
      <td><?php echo $OrderShipping->getUpdatedAt() ?></td>
      <td><?php echo $OrderShipping->getStatus() ?></td>
      <td><?php echo $OrderShipping->getCourierId() ?></td>
      <td><?php echo $OrderShipping->getAmount() ?></td>
      <td><?php echo $OrderShipping->getVat() ?></td>
      <td><?php echo $OrderShipping->getVatAmount() ?></td>
      <td><?php echo $OrderShipping->getTotalAmount() ?></td>
      <td><?php echo $OrderShipping->getOutherOrderNumber() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('ordershipping/new') ?>">New</a>
