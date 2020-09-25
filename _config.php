<?php

  define('ROOT', dirname(__FILE__));

  define('base_path', str_replace(dirname(__DIR__), '\Librarymanagementsystem',ROOT));

  include_once(ROOT . "/includes/_authentication_helpers.php");
  define('ADMIN', is_admin());
  define('AUTH', is_auth());

  include_once(ROOT . "/includes/_helpers.php");
  
