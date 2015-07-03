<?php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
include('bd/mnpBD2.class.php');
if(isset($_POST['de']) && isset($_POST['para'])){
class respuesta {
 public $success;
}     
$sql_ver  = " remitente_id=".$_POST['de']." and receptor_id=".$_POST['para'];                                        
$campos="visto";
$valores=array(1);
$condicion=$sql_ver;
$usr=new mnpBD('mensajes');
$usr->actualizar($campos,$valores,$condicion);
                                                  
$respuesta = new respuesta();
$respuesta->success = true;
}
echo json_encode($respuesta);
?>