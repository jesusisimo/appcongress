<?php
session_start();
if(isset($_SESSION['usuario'])){
  header("location: ./");
  exit;
}
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
ini_set("display_errors", 1);
include('bd/mnpBD2.class.php');
      function get_real_ip()
    {
 
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
 
    }
if (isset($_GET['add']) && !isset($_SESSION['usuario'])) {
    $nombre = "Usuario";
    $email = "usuario";
    $password = "usuario";
    // generar anonimo
    $query="SELECT count(*) as registrados FROM usuarios";
    $usuarios=$bd->ExecuteE($query);
    foreach ($usuarios as &$usuario){
      $consecutivo=$usuario['registrados']+1;
      $nombre .= $consecutivo;
      $email .= $consecutivo."@grupolahe.com";
      $password .= $consecutivo;
    }
    //regitro--------------------------------------------
    $campos="nombre, apellidos, usuario, password, email, pais_id, estado_id, especialidad, telefono, institucion, tipo, fecha_registro";
    $datos=array(
      ($nombre),
      (""),
      ($email),
      ($password),
      ($email),
      (156),
      (2545),
      (""),
      (""),
      (""),
      2,
      date("Y-m-d H:i:s")
      );
    $usr=new mnpBD('usuarios');
    if($usr->insertar($campos,$datos)){
      $_SESSION['usuario']['id']=mysql_insert_id();
      $_SESSION['usuario']['nombre']=$nombre;
      $_SESSION['usuario']['tipo']="2";
      $_SESSION['usuario']['foto']="fotos_usuario/avatar.jpg";
      $campos="usuario_id, nombre_v, apellidos_v, email_v, telefono_v, especialidad_v, pais_v, estado_v, institucion_v";
      $datos=array($_SESSION['usuario']['id'],1,1,0,1,1,1,1,1);
      $usr=new mnpBD('campos_visibles');
      $usr->insertar($campos,$datos);
      //-------------establecemos cookie----------------------------------------------------
      mt_srand(time());
      $rand = mt_rand(1000000,9999999);
      setcookie("id", $_SESSION['usuario']['id'], time()+(60*60*24*365));
      setcookie("marca", $rand, time()+(60*60*24*365));
      $campos="cookie";
      $valores=array($rand);
      $condicion=" id=".$_SESSION['usuario']['id'];
      $usr=new mnpBD('usuarios');
      $usr->actualizar($campos,$valores,$condicion);
      //-------------------------------------------------------------------------------
      $campos='usuario_id, ip, dispositivo, fecha_hora'; 
      $datos=array($_SESSION['usuario']['id'],get_real_ip(),strtolower($_SERVER['HTTP_USER_AGENT']),date("Y-m-d H:i:s"));
      $usr=new mnpBD('logeos');
      $usr->insertar($campos,$datos);
      //--------------------------------------------------------------------------------
      header("location:./?action=edit-perfil");
      exit;
    //---------------------------------------------------
}
}
?>
