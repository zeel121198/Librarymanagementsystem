<?php
  
  include_once(dirname(__DIR__) . "/_config.php");

  if (session_status() === PHP_SESSION_NONE) session_start();

  $flash_data = $_SESSION['flash'] ?? null;
  $form_data = $_SESSION['form_data'] ?? null;

  
  unset($_SESSION['flash']);
  unset($_SESSION['form_data']);
?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
  
    <title><?= $_title ?? "Library Managment system" ?></title>
  </head>

  <body>
    <?php include(ROOT . '/partials/_main-nav.php') ?>
    <?php include(ROOT . '/partials/_flash.php') ?> </body>