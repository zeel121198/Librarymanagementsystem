

<?php include(__DIR__ . '/_config.php') ?>
<?php include(ROOT . '/partials/_header.php') ?>
<?php
  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  ?>

  <?php

  if (session_status() === PHP_SESSION_NONE) session_start();
  $_SESSION['flash'] = [];

  $errors = [];


  $required = ['ISBNNumber', 'number'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { 
      $formatted = ucfirst(str_replace("_", " ", $field)); 
      $errors[] = "{$formatted} cannot be empty."; 
    }
  }


  
  if (count($errors) > 0) { 
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/issue.php');
    exit; 
  }



  if (count($errors) > 0) { 
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/users/new.php'); 
    exit; 
  }

  $sql = "INSERT INTO issuedbookdetails (ISBNNumber,number) VALUES (
    :ISBNNumber,
    :number
  )"; 

  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':ISBNNumber', $_POST['ISBNNumber'], PDO::PARAM_STR); 
 $stmt->bindParam(':number', $_POST['number'], PDO::PARAM_STR);
 $stmt->execute();

  
  $conn = null;

  
  $_SESSION['flash']['success'][] = "Book issued successfully";
  header('Location: ./users/issuedbooks.php'); 
  exit; 

  
  