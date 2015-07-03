<?php
//header('content-type: application/json; charset=utf-8');
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$db = new DB_CONNECT();
 
//Obtencion de todos los votaciones de la tabla de votaciones
$result = mysql_query("SELECT * FROM votaciones  where activo=1") or die(mysql_error());
 
// Comprobando si hay resultado vacio
if (mysql_num_rows($result) > 0) {
    // Bucle a travez de todos los resultados
    // Nodo salones
   //este responde es para que no salga el sucess
   //$response = array();
    $response ["votaciones"]= array();
    $votacion= array();

    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        
        $votacion["id"] = utf8_encode ($row["id"]);
        $votacion["titulo"]= ($row["titulo"]);
        $result2 = mysql_query("SELECT * FROM opciones_votacion where votacion_id=".$row["id"]) or die(mysql_error());
        $opciones= array();

        while ($row2 = mysql_fetch_array($result2)) {
            $opciones[$row2["id"]] = array($row2["opcion"]);
            
        }
        $votacion["opciones"]= $opciones;
        //$votacion["puesto"] = ($row["puesto"]);
        //$votacion["institucion"] = ($row["institucion"]);
        //$votacion["correo"] = ($row["email"]);
        //$votacion["pais"] = ($row["pais_id"]);
        //$votacion["curriculum"] = ($row["curriculum"]);
        //$votacion["imagen"] = ("http://actualizacionmedica.net/appcongress/foto_votacion/votacion_".$row["id"].".png");
        //$votacion["url_foto"] = base64_encode ("../../foto_votacion/votacion_".$row["id"]."png");
        // push single profeso}r into final response array
        //este array push es para que no salga el sucess 
        //array_push($response, $votacion);
        array_push($response["votaciones"], $votacion);
    }

     //success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode ($response);
} else {
    // no votacions found
    $response["success"] = 0;
    $response["message"] = "No se encontro votacion";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
