<?php
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$db = new DB_CONNECT();
 
//Obtencion de todos los paises de la tabla de paises
$result = mysql_query("SELECT *FROM paises") or die(mysql_error());
 
// Comprobando si hay resultado vacio
if (mysql_num_rows($result) > 0) {
    // Bucle a travez de todos los resultados
    // Nodo salones
   $response = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        $pais= array();
        //$pais["id"] = utf8_encode ($row["id"]);
        $pais["pais"] =($row["pais"]);
        $pais["imagen"] =("http://actualizacionmedica.net/appcongress/banderas/bandera_".$row["id"].".png");
        //$pais["url_foto"] = base64_encode ("../../foto_pais/pais_".$row["id"]."png");
        // push single profeso}r into final response array
        array_push($response, $pais);
    }
    // success
   // $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no paiss found
   // $response["success"] = 0;
    $response["message"] = "No se encontro el pais";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
