<?
session_start();
  include('bd/mnpBD2.class.php');
  $puntaje=0;
  $sql_intentos  = "SELECT max(intento) as intento FROM resultados where usuario_id=".$_SESSION['usuario']['id']." and examen_id=".$_SESSION['examen']['id']." ";
  $res_intentos  = $bd->ExecuteE($sql_intentos);
  $ultimo_intento=0;
  foreach ($res_intentos as &$intento) {
    if($intento['intento']==""){
      $ultimo_intento=1;
    }else{
      $ultimo_intento=$intento['intento']+1;
    }
      }  
//Inserta resultados
  $sql_preguntas  = "SELECT *FROM preguntas where activo=1 and id in (".$_SESSION['examen']['preguntas'].")";
  $res_preguntas  = $bd->ExecuteE($sql_preguntas);
  $campos='usuario_id, pregunta_id, opcion_id, intento, examen_id'; 
  $error=0; 
  foreach ($res_preguntas as &$pregunta) {
      $datos=array($_SESSION['usuario']['id'],$pregunta['id'],0,$ultimo_intento,$_SESSION['examen']['id']);
      $usr=new mnpBD('resultados');
      if($usr->insertar($campos,$datos)){
        }else{
          $error=1;
        }
      //-------------------fin evaluacion
        $_SESSION['mensaje']="Su tiempo se agotó";
  }













unset($_SESSION['examen']);
class respuesta {
 public $success;
}
$respuesta = new respuesta();
$respuesta->success = 1;
echo json_encode($respuesta);
?>