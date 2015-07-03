<?
session_start();
  include('bd/mnpBD2.class.php');
//Inserta resultados
  if (isset($_SESSION['usuario']['id']) && isset($_POST['profesor']) && isset($_POST['estrellas'])) {
  
  $sql_calificaciones  = "SELECT count(*) as calificado FROM  calificaciones_profesor where id_profesor=".$_POST['profesor']." and id_usuario=".$_SESSION['usuario']['id'];
  $res_calificaciones  = $bd->ExecuteE($sql_calificaciones);
 
  foreach ($res_calificaciones as &$calificacion) {
    if($calificacion['calificado']==0){
      $campos='id_usuario, id_profesor, estrellas'; 
      $datos=array($_SESSION['usuario']['id'],$_POST['profesor'],$_POST['estrellas']);
      $usr=new mnpBD('calificaciones_profesor');
      $usr->insertar($campos,$datos);
    }else{

      $campos="estrellas";
      $valores=array($_POST['estrellas']);
      $condicion=" id_profesor=".$_POST['profesor']." and id_usuario=".$_SESSION['usuario']['id'];
      $usr=new mnpBD('calificaciones_profesor');
      $usr->actualizar($campos,$valores,$condicion);

    }
  }

class respuesta {
 public $success;
}
$respuesta = new respuesta();
$respuesta->success = 1;
}else{
  class respuesta {
 public $success;
}
$respuesta = new respuesta();
$respuesta->success = 0;
}
echo json_encode($respuesta);
?>