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
$query="SELECT count(*) as total FROM agendas WHERE tipo=".$tipo." and actividad_id=".$id." and usuario_id=".$_SESSION['usuario']['id'];
$totalact=$bd->ExecuteE($query);
foreach ($totalact as &$total){
  if($totala['total']==0){
      $campos="usuario_id, actividad_id,tipo";
      $datos=array($_SESSION['usuario']['id'],$id,$tipo);
      $usr=new mnpBD('agendas');
      if($usr->insertar($campos,$datos)){
        //------------------------------------------------
        if($tipo==1){
          $query="SELECT * FROM conferencias WHERE actividad_id=".$id;
          $conferencias=$bd->ExecuteE($query);
          foreach ($conferencias as &$conferencia){
            $query="SELECT count(*) as total FROM agendas WHERE tipo=2 and actividad_id=".$conferencia['id']." and usuario_id=".$_SESSION['usuario']['id'];
            $totalaconf=$bd->ExecuteE($query);
            foreach ($totalaconf as &$tconf){
              if($tconf['total']==0){
                $campos="usuario_id, actividad_id, tipo";
                $datos=array($_SESSION['usuario']['id'],$conferencia['id'],2);
                $usr=new mnpBD('agendas');
                $usr->insertar($campos,$datos);
              }
            }
          }
          
        }
        //------------------------------------------------
        $respuesta->success = true;
      }else{
          $respuesta->success = false;
        }
  }else{
    $respuesta->success = succcess;
  }
}
      

echo json_encode($respuesta);
?>