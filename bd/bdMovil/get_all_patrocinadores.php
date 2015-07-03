<?php
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$db = new DB_CONNECT();
 
//Obtencion de todos los patrocinadores de la tabla de patrocinadores
$result = mysql_query("SELECT * FROM patrocinadores") or die(mysql_error());
 
// Comprobando si hay resultado vacio
if (mysql_num_rows($result) > 0) {
    // Bucle a travez de todos los resultados
    // Nodo salones
   $response = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        $patrocinador= array();
        //$patrocinador["id"] = utf8_encode ($row["id"]);
        $patrocinador["patrocinador"] = ($row["patrocinador"]);
        $patrocinador["pagina"] = ($row["pagina"]);
        //$patrocinador["descripcion"] = utf8_encode  ($row["descripcion"]);
        $patrocinador["imagen"] = ("http://actualizacionmedica.net/appcongress/logo_patrocinadores/logo_".$row["id"].".png");
        //$patrocinador["url_foto"] = base64_encode ("../../foto_patrocinador/patrocinador_".$row["id"]."png");
        // push single profeso}r into final response array
        array_push($response, $patrocinador);
    }
    // success
   // $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no patrocinadors found
   // $response["success"] = 0;
    $response["message"] = "No se encontro el patrocinador";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
