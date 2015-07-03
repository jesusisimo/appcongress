
<?php
 
/*
 * Following code will list all the profes
 */
 
// array for JSON response
$response = array();
 
// include db connect class

require_once __DIR__ . '/db_connect.php';


 
// connecting to db
$db = new DB_CONNECT();
 
// get all profesors from profesors table
$result = mysql_query("SELECT *FROM profesores") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // profesors node
    $response["profesores"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        
        $profesor = array();
        $profesor["id"] = utf8_encode ($row["id"]);
        $profesor["img"] = utf8_encode ($row["email"]);
        $profesor["nombre"] = utf8_encode ($row["nombre"]);
        $profesor["puesto"] = utf8_encode  ($row["puesto"]);
        // push single profesor into final response array
        array_push($response["profesores"], $profesor);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no profesors found
    $response["success"] = 0;
    $response["message"] = "No se encontro profesor";
 
    // echo no users JSON
    echo json_encode($response);
}
?>

