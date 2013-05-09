<h1>Questionss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Question</th>
      <th>Reply</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Questionss as $Questions): ?>
    <tr>
      <td><a href="<?php echo url_for('questions/edit?id='.$Questions->getId()) ?>"><?php echo $Questions->getId() ?></a></td>
      <td><?php echo $Questions->getQuestion() ?></td>
      <td><?php echo $Questions->getReply() ?></td>
      <td><?php echo $Questions->getCreatedAt() ?></td>
      <td><?php echo $Questions->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('questions/new') ?>">New</a>
