<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  $_title = "Login - Shaun McKinnon Portfolio";
  $_active = "login";
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>Login</h1>
  </header>

  <section>
    <form action="./authenticate.php" method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $form_data['email'] ?? null ?>">
      </div>

      <div class="form-group">
        <label for="email">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
      </div>
      <button class="btn btn-primary" type="submit">Submit</button>
    </form>
  </section>

  <div>
    <small>Don't have an account? No worries! <a href="<?= base_path ?>/users/new.php">Register now</a>!</small>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>