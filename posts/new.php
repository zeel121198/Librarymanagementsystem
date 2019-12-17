<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
  if (isset($_action) && (!AUTH || ($_GET['id'] !== $_SESSION['user']['id'] && !ADMIN))) {
    redirect(base_path);
  } else if (!isset($_action) && AUTH && !ADMIN) { 
    redirect(base_path);
  }
?>
<body>
<?php include_once(ROOT . '/partials/_header.php') ?>

<?php include_once(ROOT . '/partials/_main-nav.php') ?>


<?php $form_data = $form_data ?? null ?>

<form action="<?= $_action ?? base_path . "/posts/create.php" ?>" method="post">
  <div class="row">
    <?php if (isset($_action)): ?>
      <input type="hidden" class="form-control" id="b_id" name="b_id" value="<?= $form_data['b_id'] ?>">
    <?php endif ?>
</div>
    <div class="form-group ">
      <label for="BookName"> Book Name:</label>
      <input type="text" class="form-control" id="BookName" name="BookName" placeholder="Enter Book Name" value="<?= $form_data['BookName'] ?? null ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="ISBN">ISBN :</label>
      <input type="number" class="form-control" id="ISBNNumber" name="ISBNNumber" placeholder="Enter ISBN number" value="<?= $form_data['ISBNNumber'] ?? null ?>">
    
  </div>

  <div class="form-group">
    <label for="Author">Author:</label>
    <input type="text" class="form-control" id="Author" name="Author" placeholder="Enter Author" value="<?= $form_data['Author'] ?? null ?>">
  </div>

  <div class="form-group">
    <label for="Category">Category:</label>
    <input type="" class="form-control" id="Category" name="Category" placeholder="Enter Category" value="<?= $form_data['Category'] ?? null ?>">
  </div>
  <div>
  <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    $(".summernote").summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript', 'fontname', 'fontsize']],
        ['color', ['color']],
        ['para', ['style', 'ul', 'ol', 'paragraph']],
        ['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
      ],
      height: 300
    });
  });
</script>

<?php include_once(ROOT . '/partials/_footer.php') ?>