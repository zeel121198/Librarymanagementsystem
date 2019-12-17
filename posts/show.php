<?php include_once(dirname(__DIR__) . '/_config.php') ?>
<?php
  
 
?>
<?php include_once(ROOT . '/partials/_header.php') ?>

<?php include_once(ROOT . '/partials/_main-nav.php') ?>

<?php
  if (session_status() === PHP_SESSION_NONE) session_start();


  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  $sql = "SELECT * FROM books WHERE ISBNNumber = :ISBNNumber"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':ISBNNumber', $_GET['ISBNNumber'], PDO::PARAM_INT);
  $stmt->execute(); 
  $user = $stmt->fetch(); 
?>



<div class="container">
  <header class="mt-5">
    <h1>
      Book Name: <?= $user['BookName'] ?>
    </h1>
    <hr>

        <?php if (ADMIN): ?>
      <small>
        <a href="./"><i class="fa fa-chevron-left"></i>&nbsp;Back to books</a>
      </small>
    <?php endif ?>
  </header>
  
  
    <div class="col-4">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Book Name:</th>
            <td><?= $user['BookName'] ?> </td>
          </tr>
          <tr>
            <th>Category</th>
            <td><?= $user['Category'] ?></td>
          </tr>
          <tr>
            <th>Author</th>
            <td><?= $user['Author'] ?></td>
          </tr>
          <tr>
            <th>ISBN</th>
            <td><?= $user['ISBNNumber'] ?></td>
          </tr>

          <tr>
            <th>Created On:</th>
            <td>
              <?= date("d/m/Y", strtotime($user['RegDate'])) ?>
              <br>
              <?= date("g:i a", strtotime($user['RegDate'])) ?>
            </td>
          </tr>
          
        </tbody>
      </table>
      <div>
        <small>
          <a href="<?= base_path ?>/posts/edit.php?id=<?= ADMIN ? $_GET['ISBNNumber'] : $_SESSION['user']['id'] ?>">
            <i class="fa fa-pencil">&nbsp;</i>
            Edit book
          </a>
          &nbsp;|&nbsp;
          <a href="<?= base_path ?>/posts/destroy.php?id=<?= ADMIN ? $_GET['ISBNNumber'] : $_SESSION['user']['id'] ?>" onclick="return confirm('Are you sure you want to delete your own profile?')">
            <i class="fa fa-remove">&nbsp;</i>
            Delete book
          </a>
        </small>
      </div>
    </div>
  </div>
</div>

<?php include_once(ROOT . '/partials/_footer.php') ?>
