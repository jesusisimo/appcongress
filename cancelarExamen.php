<?
session_start();
unset($_SESSION['examen']);
header("location: ./?action=evaluaciones");
exit;


?>