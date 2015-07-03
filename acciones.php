<?
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['usuario'])){
  header("location: login.php");
}
include('bd/mnpBD2.class.php');

if(isset($_GET['accion']) && isset($_GET['value'])){
      $campos=$_GET['accion'];
      $valores=array(
        $_GET['value']
        );
      $condicion=" usuario_id=".$_SESSION['usuario']['id'];
      $usr=new mnpBD('campos_visibles');
      if($usr->actualizar($campos,$valores,$condicion)){
        header("location: ./?action=perfil");
        exit;
      }
}
      

?>