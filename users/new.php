<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php if (AUTH && !ADMIN) redirect(base_path) ?>

<?php
  $_title = ADMIN ? "Create a New User - Admin" : "Register";
  $_active = "users";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1><?= $_title ?></h1>
    <hr>
    <?php if (ADMIN): ?>
      <small>
        <a href="./"><i class="fa fa-chevron-left"></i>&nbsp;Back to users...</a>
      </small>
    <?php endif ?>
  </header>


    <div class="col-sm-8 border">
      <?php include_once(ROOT . '/users/_form.php') ?>
    </div>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>