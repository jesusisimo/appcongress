<?
session_start();
date_default_timezone_set('America/Mexico_City');
$fecha=$_POST[fecha];

class respuesta {
 public $success;
 public $nombre;
}
$respuesta = new respuesta();
$respuesta->success = 0;



if($_POST[hora_fin]<date("Y-m-d H:i:s")){
	$respuesta->success = 0;
}else{
	$respuesta->success = 1;
}

	


echo json_encode($respuesta);






?>