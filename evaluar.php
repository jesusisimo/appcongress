<?
  session_start();
  if(isset($_SESSION['usuario']['id'])){

  }else{
    header("location:./");
    exit;
  }
  include('bd/mnpBD2.class.php');

  $sql_examenes  = "SELECT *FROM examenes where id=".$_POST['examen']." limit 1 ";
  $res_examenes  = $bd->ExecuteE($sql_examenes);
  $incremental=(1/$res_examenes['0']['preguntasactivas'])*100;
  $puntaje=0;
  $sql_intentos  = "SELECT max(intento) as intento FROM resultados where usuario_id=".$_SESSION['usuario']['id']." and examen_id=".$_POST['examen']." ";
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
  $campos='usuario_id, pregunta_id, opcion_id, intento, examen_id, extra'; 
  $error=0; 
  foreach ($res_preguntas as &$pregunta) {
    if(isset($_POST['pregunta_'.$pregunta['id']])){
      $datos=array($_SESSION['usuario']['id'],$_POST['pregunta_'.$pregunta['id']],$_POST['resultado_'.$pregunta['id']],$ultimo_intento,$_POST['examen'] , ($_POST['respuesta_open_'.$pregunta['id']]));
      $usr=new mnpBD('resultados');
      if($usr->insertar($campos,$datos)){
        }else{
          $error=1;
        }
      //evalua si la respuesta es correcta
      if($pregunta['tipo']==1){
        $sql_opciones  = "SELECT *FROM opciones where id=".$_POST['resultado_'.$pregunta['id']]." LIMIT 1";
        $res_opciones  = $bd->ExecuteE($sql_opciones);
        foreach ($res_opciones as &$opcion) {
          if($opcion['correcta']==1){
            $puntaje=$puntaje+$incremental;
          }
        }
      }
      
      //-------------------fin evaluacion
    }
  }
if($error==0){
    foreach ($res_examenes as &$examen) {
              //evaluar el porcentaje de aprobacion
              if($res_examenes['0']['tipo']==2) {
                 $_SESSION['mensaje']="Gracias por su respuesta";
              }else{
                $_SESSION['mensaje']="Su puntaje fue de ".$puntaje."%";
              }
                $campos='examen_id, usuario_id, tipo'; 
                $datos=array($examen['id'], $_SESSION['usuario']['id'],$examen['tipo']);
                $usr=new mnpBD('contestadas');
                $usr->insertar($campos,$datos);
        unset($_SESSION['examen']);
        if($res_examenes['0']['tipo']==1) {
                 header("location:./?action=evaluaciones");
              }else{
                header("location:./?action=comentarios");
              }
            exit;
      }
      }else{
        echo "Error al evaluar";
      }
    

?>