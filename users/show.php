<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php
  
  if (!AUTH || (AUTH && $_GET['id'] !== $_SESSION['user']['id'] && !ADMIN)) {
    redirect(base_path);
  }
?>

<?php
  if (session_status() === PHP_SESSION_NONE) session_start();

  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  $sql = "SELECT * FROM users WHERE id = :id"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute(); 
  $user = $stmt->fetch(); 
?>


<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      User - <?= $user['name'] ?>
    </h1>
    <hr>

        <?php if (ADMIN): ?>
      <small>
        <a href="./"><i class="fa fa-chevron-left"></i>&nbsp;Back to users...</a>
      </small>
    <?php endif ?>
  </header>
  
  
    <div class="col-4">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Name:</th>
            <td><?= $user['name'] ?> </td>
          </tr>
          <tr>
            <th>Email:</th>
            <td><?= $user['email'] ?></td>
          </tr>
          <tr>
            <th>Student Id:</th>
            <td><?= $user['number'] ?></td>
          </tr>

          <tr>
            <th>Created On:</th>
            <td>
              <?= date("d/m/Y", strtotime($user['created_at'])) ?>
              <br>
              <?= date("g:i a", strtotime($user['created_at'])) ?>
            </td>
          </tr>
          <?php if (ADMIN): ?>
            <tr>
              <th>Role:</th>
              <td><?= $user['role'] ?></td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
      <div>
        <small>
          <a href="<?= base_path ?>/users/edit.php?id=<?= ADMIN ? $_GET['id'] : $_SESSION['user']['id'] ?>">
            <i class="fa fa-pencil">&nbsp;</i>
            Edit your profile...
          </a>
          &nbsp;|&nbsp;
          <a href="<?= base_path ?>/users/destroy.php?id=<?= ADMIN ? $_GET['id'] : $_SESSION['user']['id'] ?>" onclick="return confirm('Are you sure you want to delete your own profile?')">
            <i class="fa fa-remove">&nbsp;</i>
            Delete your profile...
          </a>
        </small>
      </div>
    </div>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>
