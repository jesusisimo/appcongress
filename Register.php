<?php
include('bd/mnpBD2.class.php');
if (isset($_POST["name"]) && $_POST["name"]!="" && isset($_POST["password"]) && $_POST["password"]!="") {
    $nombre = $_POST["name"];
    $email = $_POST["username"];
    $password = $_POST["password"];
    
    $campos="nombre, usuario, email, password";
    $datos=array(
      $nombre,
      $email,
      $email,
      $password
      );
    $usr=new mnpBD('usuarios');
    $usr->insertar($campos,$datos);
}
?>
