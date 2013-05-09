<h1>Klienci</h1>

<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
   
      
      <th>Email</th>
      <th>Imię</th>
      <th>Nazwisko</th>
      <th>Nazwa firmy</th>
      
      <th>Zablokowany</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Userss as $Users): ?>
    <tr>
      <td><a href="<?php echo url_for('customers/edit?id='.$Users->getId()) ?>"><?php echo $Users->getEmail() ?></a></td>
     
      <td><?php echo $Users->getName() ?></td>
      <td><?php echo $Users->getSurname() ?></td>
      
      
      <td><?php echo $Users->getBlocked() ?></td>
      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('customers/new') ?>">New</a>
