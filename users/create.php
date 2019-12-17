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


  $required = ['name', 'number', 'email', 'password', 'password_confirmation'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { 
      $formatted = ucfirst(str_replace("_", " ", $field)); 
      $errors[] = "{$formatted} cannot be empty."; 
    }
  }

  
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Your email is not in a valid format";
  
  
  if ($_POST['password'] !== $_POST['password_confirmation']) $errors[] = "Your password and password confirmation must match";

  
  if (count($errors) > 0) { 
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/users/new.php');
    exit; 
  }
  
  $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  
  foreach(['name'] as $field) $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
  
  $sql = "SELECT email FROM users WHERE email = :email"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
  $stmt->execute(); 
  $exists = $stmt->fetch(); 
  $stmt->closeCursor(); 

  if ($exists) $errors[] = 'This user already exists.';

  if (count($errors) > 0) { 
    $_SESSION['flash']['danger'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: ' . base_path . '/users/new.php'); 
    exit; 
  }

  $sql = "INSERT INTO users (name,number, email, password) VALUES (
    :name,
    :number,
    :email,
    :password
  )"; 

  
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR); 
 $stmt->bindParam(':number', $_POST['number'], PDO::PARAM_STR); 
 $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
 $stmt->bindParam(':password', $password, PDO::PARAM_STR); 
 $stmt->execute();

  
  $conn = null;

  
  $_SESSION['flash']['success'][] = "User was registered successfully";
  header('Location: ' . base_path . '/index.php'); 
  exit; 

  
  