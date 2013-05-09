<?php slot('login') ?>
<?php include_component('login', 'loginForm') ?>
<?php end_slot() ?>

<h1>Twoje zamówienia</h1>
<div>
   <?php if ($pager->haveToPaginate()): ?>
  <?php echo button_to('&laquo;', 'user/shippings?page='.$pager->getFirstPage()) ?>
  <?php echo button_to('&lt;', 'user/shippings?page='.$pager->getPreviousPage()) ?>
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? $page : button_to($page, 'user/shippings?page='.$page) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
  <?php endforeach ?>
  <?php echo button_to('&gt;', 'user/shippings?page='.$pager->getNextPage()) ?>
  <?php echo button_to('&raquo;', 'user/shippings?page='.$pager->getLastPage()) ?>
<?php endif ?>

</div>
<table class="std" cellpadding="0" cellspacing="0" style="border-top: 1px solid silver; border-left: 1px solid silver; border-right: 1px solid silver;">
    <thead style="text-align: center;">
      <tr >
    
     
      <th>Numer</th>
      <th>Data</th>
      <th>Nadawca</th>
      <th>Odbiorca</th>
      <th>Status</th>
      <th>Numer listu</th>
      <th>Waga</th>
      <th>Kurier</th>
      <th>Cena</th>
      <th>Akcje</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $OrderShipping): ?>
      <tr style="min-width: 20px;">
      <td><?php echo $OrderShipping->getId() ?></td>
      <td><?php echo $OrderShipping->getCreatedAt() ?></td>
       <td><?php echo $OrderShipping->getSender() ?></td>
       <td><?php echo $OrderShipping->getRecipient() ?></td>
      <td><?php echo $OrderShipping->getTextStatus() ?></td>
     
      <td><?php echo $OrderShipping->getListNumber() ?></td>
     
     
      <td><?php echo $OrderShipping->getWeight() ?></td>
      <td><?php echo $OrderShipping->getCourier() ?></td>
      
     

      <td><?php echo $OrderShipping->getTotalAmount() ?></td>
      <td>Zobacz</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>