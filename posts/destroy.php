<?php

  
  include_once(dirname(__DIR__) . '/_config.php');
  if (session_status() === PHP_SESSION_NONE) session_start();

  if (!AUTH || ($_GET['id'] !== $_SESSION['user']['id'] && !ADMIN)) redirect(base_path);


  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  $sql = "SELECT * FROM books WHERE ISBNNumber = :ISBNNumber"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':ISBNNumber', $_GET['ISBNNumber'], PDO::PARAM_INT);
  $stmt->execute(); 
  $user = $stmt->fetch();
  $stmt->closeCursor();

  if (ADMIN && $user['id'] === $_SESSION['user']['id']) redirect_with_errors(base_path . "/posts/show.php?ISBNNumber={$user['ISBNNumber']}", "NO KAMAKAZE!!!");

  $sql = "DELETE FROM dbdata.books WHERE ISBNNumber = :ISBNNumber";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':ISBNNumber', $user['ISBNNumber']);
  $stmt->execute();
  
  
 

  
  redirect_with_success(base_path . "/posts", "You have successfully deleted book. " . $user['BookName'] );