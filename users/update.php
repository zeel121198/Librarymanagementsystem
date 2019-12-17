<?php

 
  if (session_status() === PHP_SESSION_NONE) session_start();
  include_once(dirname(__DIR__) . '/_config.php');

  if (!AUTH || (AUTH && $_POST['id'] !== $_SESSION['user']['id'] && !ADMIN)) {
    redirect(base_path);
  }

  include_once(ROOT . "/includes/_connect.php");
  $conn = connect();

  $errors = [];
 $required = ['name', 'number', 'email'];
  foreach ($required as $field) {
    if (empty($_POST[$field])) { 
      $formatted = ucfirst(str_replace("_", " ", $field)); 
      $errors[] = "{$formatted} cannot be empty."; 
    }
  }

  
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Your email is not in a valid format";

  
  if (count($errors) > 0) { 
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . "/users/edit.php?id=" . $_POST['id'], $errors, 'danger');
  }
  $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

 
  foreach(['name'] as $field) $_POST[$field] = filter_var($_POST[$field], FILTER_SANITIZE_STRING);
 
  $sql = "SELECT * FROM users WHERE id = :id"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR); 
  $stmt->execute(); 
  $user = $stmt->fetch(); 


  if ($_POST['email'] !== $user['email'] && !ADMIN) {
    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    if (!empty($stmt->fetch())) $errors[] = "This email is unavailable";
  }

  $stmt->closeCursor(); 

  if (count($errors) > 0) { 
    $_SESSION['form_data'] = $_POST;
    redirect_with_errors(base_path . "/users/edit?id=" . $_POST['id'], $errors);
  }

  
  $sql = "UPDATE users SET name = :name, email = :email, number = :number";
  if (!empty($_POST['password'])) {
    if ($_POST['password'] === $_POST['password_confirmation']) {
      $sql = $sql . ", password = :password";
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
      $errors[] = "You're password must match password confirmation";
      redirect_with_errors(base_path . "/users/edit.php?id=" . $_POST['id']);
    }
  }
  $sql = $sql . " WHERE id = :id";

  
  $stmt = $conn->prepare($sql); 
  $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR); 
  
  $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
  $stmt->bindParam(':number', $_POST['number'], PDO::PARAM_STR); 
  $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
  if (isset($password)) $stmt->bindParam(':password', $password, PDO::PARAM_STR);
  $stmt->execute(); 

  
  $conn = null;

  
  unset($_POST['password']);
  if ($_POST['id'] === $_SESSION['user']['id']) {
    $_SESSION['user'] = array_merge($_SESSION['user'], $_POST);
  }
  
  redirect_with_success(base_path . "/users/show.php?id=" . $_POST['id'], "User was updated successfully");
  
  