<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php
  if (isset($_action) && (!AUTH || ($_GET['id'] !== $_SESSION['user']['id'] && !ADMIN))) {
    redirect(base_path);
  } else if (!isset($_action) && AUTH && !ADMIN) { 
    redirect(base_path);
  }
?>

<?php $form_data = $form_data ?? null ?>

<form action="<?= $_action ?? base_path . "/users/create.php" ?>" method="post">
  <div class="row">
    <?php if (isset($_action)): ?>
      <input type="hidden" class="form-control" id="id" name="id" value="<?= $form_data['id'] ?>">
    <?php endif ?>

    <div class="form-group col">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?= $form_data['name'] ?? null ?>">
    </div>

    <div class="form-group col">
      <label for="number">Student id:</label>
      <input type="number" class="form-control" id="number" name="number" placeholder="Enter Student ID" value="<?= $form_data['number'] ?? null ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $form_data['email'] ?? null ?>">
  </div>
  
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
  </div>

  <div class="form-group">
    <label for="password_confirmation">Password Confirmation:</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter your Password.">
  </div>

  <button class="btn btn-primary" type="submit">Submit</button>
</form>

<?php include_once(ROOT . '/partials/_footer.php') ?>