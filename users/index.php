<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  
  if (session_status() === PHP_SESSION_NONE) session_start();
  not_admin_redirect(base_path);
?>

<?php
  
  include_once(ROOT . '/includes/_connect.php');
  $conn = connect();
  
  $sql = "SELECT * FROM users ORDER BY created_at DESC"; 
  $users = $conn->query($sql)->fetchAll(); 
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      List All Users
    </h1>
    <hr>
    <small>
      <a href="<?= base_path ?>/users/new.php">
        <i class="fa fa-plus"></i>
        Create a New User
      </a>
    </small>
  </header>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Created On</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><a href="./show?id=<?= $user['id'] ?>"><?= $user['name'] ?> </a></td>
          <td><?= $user['email'] ?></td>
          <td>
            <?= date("d/m/Y", strtotime($user['created_at'])) ?>
            <br>
            <?= date("g:i a", strtotime($user['created_at'])) ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>