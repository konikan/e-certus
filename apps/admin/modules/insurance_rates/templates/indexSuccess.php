<h1>Stawki ubezpieczeń</h1>

<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
      <th>Akcje</th>
      <th>Kurier</th>
      <th>Kwota od</th>
      <th>Kwota do</th>
      <th>Cena</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($InsuranceRatess as $InsuranceRates): ?>
    <tr>
      <td><a href="<?php echo url_for('insurance_rates/edit?id='.$InsuranceRates->getId()) ?>"><?php echo 'Edycja' ?></a></td>
      <td><?php echo $InsuranceRates->getCourier() ?></td>
      <td><?php echo $InsuranceRates->getAmountStart() ?></td>
      <td><?php echo $InsuranceRates->getAmountEnd() ?></td>
      <td><?php echo $InsuranceRates->getPrice() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('insurance_rates/new') ?>">New</a>
