<?php
 
// array for JSON response
$response = array();
 
// Include db connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$db = new DB_CONNECT();
 
// Obtencion de todos los coordinadores de la tabla de coordinadores
$result = mysql_query("SELECT *FROM coordinadores") or die(mysql_error());
 
// Comprobando si hay resultado vacio
if (mysql_num_rows($result) > 0) {
    // Bucle a travez de todos los resultados
    // Nodo coordinadores
    $response["coordinadores"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        $coordinador = array();
        $coordinador["id"] = utf8_encode ($row["id"]);
        $coordinador["nombre"] = utf8_encode ($row["nombre"]);
        $coordinador["correo"] = utf8_encode  ($row["correo"]);
        
        
        // Poner un coordinador al final de la respuesta de la matriz
        array_push($response["coordinadores"], $coordinador);
    }
    // Exito
    $response["success"] = 1;
 
    // Haciendo echo de la respuesta JSON
    echo json_encode($response);
} else {
    // No se encontraron coordinadores
    $response["success"] = 0;
    $response["message"] = "No se encontro coordinador";
 
    // Respuesta JSON  de no encontrados
    echo json_encode($response);
}
?>
