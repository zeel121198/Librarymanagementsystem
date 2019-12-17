<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php
  
  if (!AUTH || (AUTH && $_GET['id'] !== $_SESSION['user']['id'] && !ADMIN)) {
    $_SESSION['flash']['warning'][] = "You are attempting an administrative action";
    redirect(base_path);
  }
?>

<?php
  if (session_status() === PHP_SESSION_NONE) session_start();

 include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  $sql = "SELECT * FROM users WHERE id=:id"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $_SESSION['form_data'] = $stmt->fetch();
?>
<?php
  $_title = "Edit " . $_SESSION['user']['name'];
  $_active = "users";
  $_action = base_path . "/users/update.php";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1><?= $_title ?></h1>
    <hr>
    <?php if (ADMIN): ?>
      <small>
        <a href="<?= base_path ?>/users"><i class="fa fa-chevron-left"></i>&nbsp;Back to users...</a>
      </small>
    <?php else: ?>
      <a href="<?= base_path ?>/users/show.php"><i class="fa fa-chevron-left"></i>&nbsp;Back to profile...</a>
    <?php endif ?>
  </header>


    <div class="col-sm-8 border">
      <?php include_once(ROOT . '/users/_form.php') ?>
    </div>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>