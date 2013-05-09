<h1>SpecialOffers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Text</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($SpecialOffers as $SpecialOffer): ?>
    <tr>
      <td><a href="<?php echo url_for('special_offers/edit?id='.$SpecialOffer->getId()) ?>"><?php echo $SpecialOffer->getId() ?></a></td>
      <td><?php echo $SpecialOffer->getName() ?></td>
      <td><?php echo $SpecialOffer->getText() ?></td>
      <td><?php echo $SpecialOffer->getCreatedAt() ?></td>
      <td><?php echo $SpecialOffer->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('special_offers/new') ?>">New</a>
