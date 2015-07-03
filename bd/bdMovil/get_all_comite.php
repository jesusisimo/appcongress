<?php
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$db = new DB_CONNECT();
 
//Obtencion de todos los comitees de la tabla de comitees
$result = mysql_query("SELECT * FROM comite_organizador") or die(mysql_error());
 
// Comprobando si hay resultado vacio
if (mysql_num_rows($result) > 0) {
    // Bucle a travez de todos los resultados
    // Nodo comitees
   $response = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        $comite= array();
        //$comite["id"] = utf8_encode ($row["id"]);
        $comite["nombre"] =($row["nombre"]);
        $comite["puesto"] =($row["puesto"]);
 
        //$comite["url_foto"] = base64_encode ("../../foto_comite/comite_".$row["id"]."png");
        // push single profeso}r into final response array
        array_push($response, $comite);
    }
    // success
   // $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no comites found
   // $response["success"] = 0;
    $response["message"] = "No se encontro el comite";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
