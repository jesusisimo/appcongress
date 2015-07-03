<?php
//header('content-type: application/json; charset=utf-8');
header('Content-Type: text/html; charset=utf-8');
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$db = new DB_CONNECT();
 
//Obtencion de todos los profesores de la tabla de profesores
$result = mysql_query("SELECT pr.id, pr.nombre, pr.puesto, pr.institucion, pr.email, p.pais FROM profesores  as pr INNER JOIN paises as p on p.id=pr.pais_id") or die(mysql_error());
 
// Comprobando si hay resultado vacio
if (mysql_num_rows($result) > 0) {
    // Bucle a travez de todos los resultados
    // Nodo salones
   //este responde es para que no salga el sucess
     $response = array();
    //$response ["profesores"]= array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        $profesor= array();
        $profesor["id"] = ($row["id"]);
        $profesor["nombre"]= ($row["nombre"]);
        $profesor["puesto"] = ($row["puesto"]);
        $profesor["institucion"] = ($row["institucion"]);
        $profesor["correo"] = ($row["email"]);
        $profesor["pais"] = ($row["pais"]);
        //$profesor["curriculum"] = ($row["curriculum"]);
        $profesor["imagen"] = ("http://actualizacionmedica.net/appcongress/foto_profesor/profesor_".$row["id"].".png");
        //$profesor["url_foto"] = base64_encode ("../../foto_profesor/profesor_".$row["id"]."png");
        // push single profeso}r into final response array
        //este array push es para que no salga el sucess 
        array_push($response, $profesor);
        //array_push($response["profesores"], $profesor);
    }
     //success
    //$response["success"] = 1;
 
    // echoing JSON response
    echo json_encode ($response);
} else {
    // no profesors found
    //$response["success"] = 0;
    $response["message"] = "No se encontro profesor";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
