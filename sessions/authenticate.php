<?php

  include_once(dirname(__DIR__) . '/_config.php');
  include_once(ROOT . '/includes/_connect.php');
  $conn = connect();

  
  if (session_status() === PHP_SESSION_NONE) session_start();
  $_SESSION['flash'] = [];

  
  $valid_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

  
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  
  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(":email", $email, PDO::PARAM_STR); 
  $stmt->execute(); 
  $user = $stmt->fetch();

  
  if (!$user || !password_verify($_POST['password'], $user['password'])) { 
    $_SESSION['flash']['danger'][] = "The email or password is incorrect."; 
    $_SESSION['form_data']['email'] = $_POST['email'];
    header('Location: ' . base_path . '/sessions/login.php');
    exit; 
  }

  
  unset($user['password']);
  $_SESSION['user'] = $user;

  
  $_SESSION['flash']['success'][] = "You logged in successfully";
  header('Location: ' . base_path . '/index.php');
  exit; 