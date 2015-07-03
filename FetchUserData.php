<?php
include('bd/mnpBD2.class.php');
$user = array();
if (isset($_POST["username"]) && $_POST["username"]!="" && isset($_POST["password"]) && $_POST["password"]!="") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $query="SELECT * FROM usuarios WHERE usuario='".$username."' and password='".$password."' ";
    $usuarios=$bd->ExecuteE($query);
    foreach ($usuarios as &$usuario){
        $user["name"] = $usuario['nombre'];
        $user["username"] = $usuario['email'];
        $user["password"] = $usuario['password'];
    }
}
    echo json_encode($user);
?>
