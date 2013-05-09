<h1>Rodzaje opakowań</h1>
<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
    
      <th></th>
      <th>Grupa</th>
      <th>Firma kurierska</th>
      <th>Nazwa</th>
      <th>identyfikator usługi</th>
      
      <th>Maksymalna szerokość</th>
      <th>Maksymalna wysokość</th>
      <th>Maksymalna długość</th>
      <th>Maksymalna waga</th>
      
      <th>Dostępna</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($PackagingTypess as $PackagingTypes): ?>
    <tr>
      <td><a href="<?php echo url_for('packaging_types/edit?id='.$PackagingTypes->getId()) ?>"><?php echo 'Edycja' ?></a></td>
      <td><?php echo $PackagingTypes->getPackagingGroups() ?></td>
      <td><?php echo $PackagingTypes->getCourier() ?></td>
      <td><?php echo $PackagingTypes->getName() ?></td>
      <td><?php echo $PackagingTypes->getServiceId() ?></td>
   
      <td><?php echo $PackagingTypes->getMaxWidth() ?></td>
      <td><?php echo $PackagingTypes->getMaxHeight() ?></td>
      <td><?php echo $PackagingTypes->getMaxLength() ?></td>
      <td><?php echo $PackagingTypes->getMaxWeight() ?></td>

      <td><?php echo $PackagingTypes->getAvailable() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('packaging_types/new') ?>">Dodaj nowe opakowanie</a>
