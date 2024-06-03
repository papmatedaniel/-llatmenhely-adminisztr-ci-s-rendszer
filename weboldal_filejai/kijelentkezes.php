<?php

session_start();

var_dump($_POST);

if (isset($_POST['action']) && $_POST['action'] === 'logout') {
  session_destroy();
  header('Location: /index.php');
  exit;
}

?>
