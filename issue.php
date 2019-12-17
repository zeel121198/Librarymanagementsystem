<?php include(__DIR__ . '/_config.php') ?>
<?php include(ROOT . '/partials/_header.php') ?>
<?php
  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  

?>

<?php $form_data = $form_data ?? null ?>

<form action="<?= $_action ?? base_path . "/contact.php" ?>" method="post">
  <div class="row">
    <?php if (isset($_action)): ?>
      <input type="hidden" class="form-control" id="id" name="id" value="<?= $form_data['id'] ?>">
    <?php endif ?>

    <div class="form-group col">
      <label for="ISBNnumber">ISBN:</label>
      <input type="text" class="form-control" id="ISBNNumber" name="ISBNNumber" placeholder="Enter ISBN" value="<?= $form_data['ISBNNumber'] ?? null ?>">
    </div>

    <div class="form-group col">
      <label for="number">Student id:</label>
      <input type="number" class="form-control" id="number" name="number" placeholder="Enter Student ID" value="<?= $form_data['number'] ?? null ?>">
    </div>
  </div>


  <button class="btn btn-primary" type="submit">Submit</button>
</form>
<?php include(ROOT . '/partials/_footer.php') ?>