<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  
  if (session_status() === PHP_SESSION_NONE) session_start();
  not_admin_redirect(base_path);
?>

<?php
  
  include_once(ROOT . '/includes/_connect.php');
  $conn = connect();
  
  $sql = "SELECT * FROM books ORDER BY author ASC"; 
  $books = $conn->query($sql)->fetchAll(); 
?>

<?php include_once(ROOT . '/partials/_header.php') ?>

<?php include_once(ROOT . '/partials/_main-nav.php') ?>

<div class="container">
  <header class="mt-5">
    <h1>
      All Books
    </h1>
    <hr>
    <small>
      <a href="<?= base_path ?>/posts/new.php">
        <i class="fa fa-plus"></i>
        Add a New Book
      </a>
    </small>
  </header>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>BookName</th>
        <th>Category</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($books as $book): ?>
        <tr>
          <td><a href="./show?ISBNNumber=<?= $book['ISBNNumber'] ?>"><?= $book['BookName'] ?> </a></td>
          <td><?= $book['Category'] ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>