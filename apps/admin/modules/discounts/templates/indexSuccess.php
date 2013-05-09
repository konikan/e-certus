<h1>Rabaty - <?php echo $user ?></h1>

<table border="1">
  <thead>
    <tr>
     
      <th>Usługa</th>
      <th>Rabat</th>
      <th>Aktywny</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Discountss as $Discounts): ?>
    <tr>
     
      <td><a href="<?php echo url_for('discounts/edit?user_id='.$Discounts->getUserId().'&type_id='.$Discounts->getTypeId()) ?>"><?php echo $Discounts->getShippingTypes() ?></a></td>
      <td><?php echo $Discounts->getDiscount() ?></td>
      <td><?php echo $Discounts->getActive() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('discounts/new?user='.$user_id) ?>">Dodaj rabat</a>
  <a href="<?php echo url_for('customers/edit?id='.$user_id) ?>">Powrót do użytkownika</a>
