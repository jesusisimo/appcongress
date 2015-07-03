<?php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
include('bd/mnpBD2.class.php');
if(isset($_POST['mensaje']) && isset($_POST['remitente_id']) && $_POST['action']=="add"){
$mensaje=$_POST['mensaje'];
$remitente_id=$_POST['remitente_id'];
$receptor_id=$_POST['receptor_id'];
$hora=date("Y-m-d H:i:s");
$hora2=ucfirst(utf8_encode(strftime("%b %e %H:%M:%S",strtotime($hora))));
class respuesta {
 public $success;
 public $hora;
}     
      $campos='remitente_id, receptor_id, fecha_hora, mensaje'; 
      $datos=array($remitente_id,$receptor_id,$hora, $mensaje);
      $usr=new mnpBD('mensajes');
      $id_pregunta=0;
      if($usr->insertar($campos,$datos)){
        $respuesta = new respuesta();
        $respuesta->success = true;
        $respuesta->hora = $hora2;
          }

}
//----------------------guardar mensajes para todos los usuarios de parte del organizador
if(isset($_POST['mensaje']) && isset($_POST['remitente_id']) && $_POST['action']=="addAll"){
$mensaje=$_POST['mensaje'];
$remitente_id=$_POST['remitente_id'];
$hora=date("Y-m-d H:i:s");
$hora2=ucfirst(utf8_encode(strftime("%b %e %H:%M:%S",strtotime($hora))));
class respuesta {
 public $success;
 public $hora;
}     
$sql_usuarios  = "SELECT *FROM usuarios where tipo!=1";
$res_usuarios  = $bd->ExecuteE($sql_usuarios);
  foreach ($res_usuarios as &$usuario){
    $campos='remitente_id, receptor_id, fecha_hora, mensaje, tipo'; 
    $datos=array($remitente_id,$usuario['id'],$hora, $mensaje, $_POST['tipo']);
    $usr=new mnpBD('mensajes');
    $usr->insertar($campos,$datos);         
  }
  $respuesta = new respuesta();
  $respuesta->success = true;
  $respuesta->hora = $hora2;
}
//------------------------------------------------------------------------------------------



if(isset($_POST['hora']) && isset($_POST['remitente_id']) && isset($_POST['receptor_id'])){
  $hora=$_POST['hora'];
  $horaservidor=date("Y-m-d H:i:s");
  class respuesta {
   public $success;
   public $html;
   public $horaserver;
   public $receptorid;
}
 $htmlx="";
                                          
                                              $sql_mensajes  = "SELECT *FROM mensajes where remitente_id in(".$_POST['remitente_id'].",".$_POST['receptor_id'].") and receptor_id in(".$_POST['remitente_id'].",".$_POST['receptor_id'].") and fecha_hora >= '".$_POST['hora']."' order by fecha_hora asc";
                                              $res_mensajes  = $bd->ExecuteE($sql_mensajes);
                                                 foreach ($res_mensajes as $mensaje){
                                                  $hora=$mensaje['fecha_hora'];
                                                  $horasend=ucfirst(utf8_encode(strftime("%b %e %H:%M:%S",strtotime($mensaje['fecha_hora']))));
                                                  if($mensaje['remitente_id']==$_POST['remitente_id']){
                                                    $sql_remitente  = "SELECT *FROM usuarios where id=".$_POST['remitente_id'];
                                                    $remitente  = $bd->ExecuteE($sql_remitente);
                                                    $htmlx.=' <div class="group-rom">
                                                                  <div class="first-part odd">'.$remitente['0']['nombre']." ".$remitente['0']['apellidos'].'</div>
                                                                  <div class="second-part">'.$mensaje['mensaje'].'</div>
                                                                  <div class="third-part pull-right">'.$horasend.'</div>
                                                              </div>';
                                                  }else{
                                                    $sql_receptor  = "SELECT *FROM usuarios where id=".$_POST['receptor_id'];
                                                    $receptor  = $bd->ExecuteE($sql_receptor);
                                                    if ($receptor['0']['tipo']==1) {
                                                        $receptor['0']['nombre']="Comite organizador";
                                                        $receptor['0']['apellidos']="";
                                                    }
                                                    $htmlx.=' <div class="group-rom">
                                                                  <div class="first-part">'.$receptor['0']['nombre']." ".$receptor['0']['apellidos'].'</div>
                                                                  <div class="second-part">'.$mensaje['mensaje'].'</div>
                                                                  <div class="third-part pull-right">'.$horasend.'</div>
                                                              </div>';
                                                  }
                                                }
                                              $sql_ver  = " remitente_id=".$_POST['receptor_id']." and receptor_id=".$_POST['remitente_id'];
                                              
                                              $campos="visto";
                                              $valores=array(1);
                                              $condicion=$sql_ver;
                                              $usr=new mnpBD('mensajes');
                                              $usr->actualizar($campos,$valores,$condicion);
                                                  

$respuesta = new respuesta();
$respuesta->success = true;
$respuesta->html = $htmlx;
$respuesta->receptorid = $_POST['receptor_id'];
$respuesta->horaserver = $horaservidor;
}

echo json_encode($respuesta);
?>