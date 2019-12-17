<?php


  function redirect ($path) {
    header("Location: {$path}");
    exit;
  }

  
  function redirect_with_flash ($path, $flash, $type = 'success') {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (is_array($flash)) {
      foreach($flash as $f) $_SESSION['flash'][$type][] = $f;
    } else {
      $_SESSION['flash'][$type][] = $flash;
    }

    redirect($path);
  }

  function redirect_with_success($path, $flash) {
    redirect_with_flash($path, $flash);
  }

  function redirect_with_errors($path, $flash) {
    redirect_with_flash($path, $flash, 'danger');
  }