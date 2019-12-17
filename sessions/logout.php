<?php

  include_once(dirname(__DIR__) . '/_config.php');
  if (session_status() === PHP_SESSION_NONE) session_start();

  unset($_SESSION['user']);

  $_SESSION['flash'] = [];
  $_SESSION['flash']['success'][] = "You've logged out successfully";
  header('Location: ' . base_path . '/index.php');
  exit;