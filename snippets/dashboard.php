<?php include('includes/auth.php'); ?>

<h2>Welcome, <?= $_SESSION['user'] ?></h2>
<a href="logout.php">Logout</a>

<form action="crud.php" method="post">
  <input type="hidden" name="action" value="create" />
  <input type="text" name="username" placeholder="Username" required />
  <input type="email" name="email" placeholder="Email" required />
  <button type="submit">Add User</button>
</form>

<hr>

<h3>Users List</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Actions</th>
  </tr>
  <?php
  $xml = simplexml_load_file("users.xml");
  foreach ($xml->User as $user):
  ?>
    <tr>
      <td><?= $user->ID ?></td>
      <td><?= $user->Username ?></td>
      <td><?= $user->Email ?></td>
      <td>
        <form action="crud.php" method="post" style="display:inline;">
          <input type="hidden" name="action" value="delete" />
          <input type="hidden" name="id" value="<?= $user->ID ?>" />
          <button type="submit">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
