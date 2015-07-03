<?
$query="SELECT * FROM sociedad";
$sociedades=$bd->ExecuteE($query);
foreach ($sociedades as &$sociedad) {}
?>