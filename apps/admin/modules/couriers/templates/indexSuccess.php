<h1>Firmy kurierskie</h1>

<table>
  <thead>
    <tr>
      
      <th>Nazwa</th>
      <th>Dostępna</th>
      <th>Numer klienta</th>
      <th>Klucz API</th>
    
      <th>Opłata paliwowa</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Couriers as $Courier): ?>
    <tr>
      <td><a href="<?php echo url_for('couriers/edit?id='.$Courier->getId()) ?>"><?php echo $Courier->getName() ?></a></td>
      <td><?php echo $Courier->getAvailable() ?></td>
      <td><?php echo $Courier->getClientNr() ?></td>
      <td><?php echo $Courier->getApiKey() ?></td>
     
      <td><?php echo $Courier->getPetrolCharge() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('couriers/new') ?>">Dodaj nową firmę kurierską</a>
