<?php

  include_once(dirname(__DIR__) . '/_config.php');
  not_admin_redirect(base_path . '/posts');

  $errors = []; 
  foreach(['BookName','Category', 'Author'] as $field) {
    if (empty($_POST[$field])) {
      $formatted = str_replace("_", " ", $_POST[$field]);
      $formatted = ucwords($formatted);
      $errors[] = "{$formatted} is a required field.";
    }
  }

  
  if (count($errors) > 0) {
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    redirect(base_path . "/posts/new.php");
  }

  
  $_POST['BookName'] = filter_var($_POST['BookName'], FILTER_SANITIZE_STRING);
  $_POST['Category'] = filter_var($_POST['Category'], FILTER_SANITIZE_STRING);
  $_POST['Author'] = filter_var($_POST['Author'], FILTER_SANITIZE_STRING);

  
 

  
  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();

  
  $sql = "SELECT * FROM books WHERE ISBNNumber = :ISBNNumber";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':ISBNNumber', $_POST['ISBNNumber'], PDO::PARAM_INT);
  $stmt->execute();
  $post = $stmt->fetch();

  
  if (!$post) {
    $_SESSION['flash']['danger'][] = "Please provide a valid book id.";
  
    redirect(base_path . "/posts");
  }
$sql = "UPDATE books SET
    BookName = :BookName,
    Category = :Category,
    Author = :Author
    WHERE ISBNNumber = :ISBNNumber";


  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':BookName', $_POST['BookName'], PDO::PARAM_STR);
  $stmt->bindParam(':Category', $_POST['Category'], PDO::PARAM_STR);
  $stmt->bindParam(':Author', $_POST['Author'], PDO::PARAM_STR);
  $stmt->bindParam(':ISBNNumber', $_POST['ISBNNumber'], PDO::PARAM_INT);
  $stmt->execute();


  $_SESSION['flash']['success'][] = "You have successfully updated book.";
  redirect(base_path . "/posts/show.php?ISBNNumber={$_POST['ISBNNumber']}");
