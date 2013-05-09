<h1>Zamówienia przesyłek</h1>
<div>
<?php echo $pager->getNbResults() ?> zamówień<br />
Wyniki od <?php echo $pager->getFirstIndice() ?> do  <?php echo $pager->getLastIndice() ?>
</div>
<div>
   <?php if ($pager->haveToPaginate()): ?>
  <?php echo link_to('&laquo;', 'orders/index?page='.$pager->getFirstPage()) ?>
  <?php echo link_to('&lt;', 'orders/index?page='.$pager->getPreviousPage()) ?>
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'orders/index?page='.$page) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo link_to('&gt;', 'orders/index?page='.$pager->getNextPage()) ?>
  <?php echo link_to('&raquo;', 'orders/index?page='.$pager->getLastPage()) ?>
<?php endif ?>

</div>
<table border="1" cellpadding="0" cellspacing="0" style="background-color: white;">
    <thead style="text-align: center;">
      <tr style="background-color: #B1C4EC; text-align: center;">
      <th>Numer zamówienia</th>
      <th>Nazwa użytkownika</th>
      
      <th>Data</th>
      
      <th>Status</th>
      <th>Zewnętrzny numer</th>
      <th>Numer listu</th>
      <th>Firma kurierska</th>
      <th>Szerokość</th>
      <th>Wysokość</th>
      <th>Długość</th>
      
      <th>Waga</th>
      <th>Type</th>
      <th>Rodzaj opakowania</th>
      
      <th>Zapłacono</th>
      
      <th>Ilość przesyłek</th>
      
      <th>Wartość brutto</th>
    </tr>
  </thead>
  <tbody style="text-align: center;">
    <?php foreach ($pager->getResults() as $OrderShipping): ?>
    <tr>
      <td><a href="<?php echo url_for('orders/edit?id='.$OrderShipping->getId()) ?>"><?php echo $OrderShipping->getId() ?></a></td>
      <td><?php echo ($OrderShipping->getUserId() !='')?$OrderShipping->getUsers():'' ?></td>
      
      <td><?php echo $OrderShipping->getCreatedAt() ?></td>
    
      <td><?php echo $OrderShipping->getStatus() ?></td>
      <td><?php echo $OrderShipping->getOutherOrderNumber() ?></td>
      <td><?php echo $OrderShipping->getListNumber() ?></td>
      <td><?php echo $OrderShipping->getCourier() ?></td>
      <td><?php echo $OrderShipping->getWidth() ?></td>
      <td><?php echo $OrderShipping->getHeight() ?></td>
      <td><?php echo $OrderShipping->getLength() ?></td>
   
      <td><?php echo $OrderShipping->getWeight() ?></td>
      <td><?php echo $OrderShipping->getShippingTypes() ?></td>
      <td><?php echo ($OrderShipping->getPackagingTypeId()!="")?$OrderShipping->getPackagingTypes():'' ?></td>
      
      <td><?php echo ($OrderShipping->getIsPaid()==1)?'Tak':'Nie' ?></td>
      
      <td><?php echo $OrderShipping->getNumberOfPackages() ?></td>
      
      <td style="font-weight: bold"><?php echo $OrderShipping->getTotalAmount() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

 
