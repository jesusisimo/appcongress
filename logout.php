<?
  session_start();
  if (isset($_COOKIE['id'])) {
    unset($_COOKIE['id']);
    setcookie('id', '', time() - 3600); // empty value and old timestamp
  }
  if (isset($_COOKIE['marca'])) {
    unset($_COOKIE['marca']);
    setcookie('marca', '', time() - 3600); // empty value and old timestamp
  }

  unset($_SESSION['usuario']);
  unset($_SESSION['fb_token']);
  unset($_SESSION['examen']);
  header("location: login.php");
  exit;
 ?>