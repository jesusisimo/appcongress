<?php
 
// array for JSON response
$response = array();
 
// Include bd connect class
require_once __DIR__ . '/db_connect.php';

// Conectar con la BD
$bd = new DB_CONNECT();
 
// Obtencion de todos los actividades de la tabla de actividades
$query = mysql_query("SELECT * FROM actividades") or die(mysql_error());
 
// Comprobando si hay queryado vacio
if (mysql_num_rows($query) > 0) {
    // Bucle a travez de todos los queryados
    // Nodo actividades
    $response["actividades"] = array();
 
     $actividades=$bd->ExecuteE($query);
      $i=0;
      foreach ($actividades as &$actividad) {
      $i++;
        // temp user array
        
        $actividad = array();
        $actividad["id"] = utf8_encode ($row["id"]);
        $actividad["actividad"] = utf8_encode ($row["actividad"]);
        $query="SELECT * FROM coordinadores WHERE id in (".$actividad[coordinadores].")";
                                          $coordinadores=$bd->ExecuteE($query);
                                          foreach ($coordinadores as &$coordinador) {
                                            echo utf8_encode($coordinador[nombre]).", ";
                                          }
        $actividad["descripcion"] = utf8_encode  ($row["descripcion"]);
        $actividad["fecha_hora_inicio"] = utf8_encode  ($row["fecha_hora_inicio"]);
        $actividad["fecha_hora_fin"] = utf8_encode  ($row["fecha_hora_fin"]);
        $actividad["lugar"] = utf8_encode  ($row["lugar"]);
        $actividad["categoria_id"] = utf8_encode  ($row["categoria_id"]);
        $query="SELECT * FROM conferencias WHERE id in (".$actividad[conferencia_id].")";
                                          $conferencias=$bd->ExecuteE($query);
                                          foreach ($conferencias as &$conferencia) {
                                            echo utf8_encode($conferencia[conferencia]).", ";
                                          }
        $actividad["cupo"] = utf8_encode  ($row["cupo"]);
        $actividad["costo"] = utf8_encode  ($row["costo"]);

        
        
        
        // Poner un actividad al final de la respuesta de la matriz
        array_push($response["actividades"], $actividad);
    }
    // Exito
    $response["success"] = 1;
 
    // Haciendo echo de la respuesta JSON
    echo json_encode($response);
} else {
    // No se encontraron actividades
    $response["success"] = 0;
    $response["message"] = "No se encontro actividad";
 
    // Respuesta JSON  de no encontrados
    echo json_encode($response);
}
?>
