<?php
session_start();
include("bd/mnpBD2.class.php");
$id=$_POST['id'];
$tipo=$_POST['tipo'];

//-------------
class datos {
 public $success;
}

 $respuesta = new datos();
 $respuesta->success = false;
//------------
//
      $usr=new mnpBD('agendas');
      $condicion=" tipo=".$tipo." and usuario_id=".$_SESSION['usuario']['id']." and actividad_id=".$id;
      if($usr->delete($condicion)){
        //------------------------------------------------
        if($tipo==1){
          $query="SELECT * FROM conferencias WHERE actividad_id=".$id;
          $conferencias=$bd->ExecuteE($query);
          foreach ($conferencias as &$conferencia){
            $usr=new mnpBD('agendas');
            $condicion=" tipo=2 and usuario_id=".$_SESSION['usuario']['id']." and actividad_id=".$conferencia['id'];            
            $usr->delete($condicion);
          }
        }
        //------------------------------------------------
        $respuesta->success = true;
      }else{
          $respuesta->success = false;
        }
  

      

echo json_encode($respuesta);
?>