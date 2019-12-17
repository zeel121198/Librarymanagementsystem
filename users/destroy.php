<?php

  
  include_once(dirname(__DIR__) . '/_config.php');
  if (session_status() === PHP_SESSION_NONE) session_start();

  if (!AUTH || ($_GET['id'] !== $_SESSION['user']['id'] && !ADMIN)) redirect(base_path);

  
  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  $sql = "SELECT * FROM users WHERE id=:id"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute(); 
  $user = $stmt->fetch();
  $stmt->closeCursor();

  if (ADMIN && $user['id'] === $_SESSION['user']['id']) redirect_with_errors(base_path . "/users/show.php?id={$user['id']}", "NO KAMAKAZE!!!");


  $sql = "DELETE FROM users WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $user['id']);
  $stmt->execute();
  
  if ($user['id'] === $_SESSION['user']['id']) {
    unset($_SESSION['user']);
    redirect_with_success(base_path . "/", "You have successfully deleted yourself");
  }

  
  redirect_with_success(base_path . "/users", "You have successfully deleted " . $user['name'] );