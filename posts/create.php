<?php
  
  include_once(dirname(__DIR__) . '/_config.php');

  
  if (AUTH && !ADMIN) {
    redirect(base_path . '/users/show.php?id=' . $_SESSION['user']['id']);
  }

  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();


  if (session_status() === PHP_SESSION_NONE) session_start();
  $_SESSION['flash'] = [];

  
  $errors = [];

  
  $required = ['BookName', 'ISBNNumber', 'Category', 'Author'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { 
      $formatted = ucfirst(str_replace("_", " ", $field)); 
      $errors[] = "{$formatted} cannot be empty."; 
    }
  }

 
  
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/posts/index.php'); 
    exit; 
  }
  
  
  $sql = "SELECT ISBNNumber FROM books WHERE ISBNNumber = :ISBNNumber"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':ISBNNumber', $_POST['ISBNNumber'], PDO::PARAM_STR); 
  $stmt->execute(); 
  $exists = $stmt->fetch();
  $stmt->closeCursor(); 

  
  if ($exists) $errors[] = 'This book already exists.';

  
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/posts/index.php'); 
    exit; 
  }

  
  $sql = "INSERT INTO books (BookName,Category, Author, ISBNNumber) VALUES (
    :BookName,
    :Category,
    :Author,
    :ISBNNumber
  )"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':BookName', $_POST['BookName'], PDO::PARAM_STR);
  $stmt->bindParam(':Category', $_POST['Category'], PDO::PARAM_STR); 
  $stmt->bindParam(':Author', $_POST['Author'], PDO::PARAM_STR); 
  $stmt->bindParam(':ISBNNumber',$_POST['ISBNNumber'], PDO::PARAM_STR); 
  $stmt->execute(); 

  
  $conn = null;

  
  $_SESSION['flash']['success'][] = "Book added";
  header('Location: ' . base_path . '/posts/index.php'); 
  exit; 

  
  