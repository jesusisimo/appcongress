<?
include('bd/mnpBD2.class.php');
class respuesta {
 public $disponible;
}
$respuesta = new respuesta();
$respuesta->disponible=1;

if($_POST['tipo']==1){
    $query="SELECT * FROM actividades WHERE id=".$_POST['actividad_id'];
    $actividades=$bd->ExecuteE($query);
    foreach ($actividades as &$actividad){
            //buscar todas las actividades
            $query="SELECT ac.fecha_hora_inicio, ac.fecha_hora_fin  
                FROM agendas as ag INNER JOIN actividades as ac on ac.id=ag.actividad_id 
                WHERE usuario_id = ".$_POST['usuario']." and ag.tipo=1";
            $agendadas_a=$bd->ExecuteE($query);
            foreach ($agendadas_a as &$agendada){
                if(($actividad['fecha_hora_inicio']>=$agendada['fecha_hora_inicio']) && ($actividad['fecha_hora_inicio']<$agendada['fecha_hora_fin'])){
                   $respuesta->disponible=0; 
                }
            }
            //buscar todas las conferencias menos las conferencias de esta actividad
            $query="SELECT con.fecha_hora_inicio, con.fecha_hora_fin 
                    FROM agendas as ag INNER JOIN conferencias as con on con.id=ag.actividad_id 
                    WHERE usuario_id = ".$_POST['usuario']." and ag.tipo=2 and con.actividad_id!=".$actividad['id'];
            $agendadas_c=$bd->ExecuteE($query);
            foreach ($agendadas_c as &$agendada){
                if(($actividad['fecha_hora_inicio']>=$agendada['fecha_hora_inicio']) && ($actividad['fecha_hora_inicio']<$agendada['fecha_hora_fin'])){
                   $respuesta->disponible=0; 
                }
            }
    }
}elseif($_POST['tipo']==2){
    $query="SELECT con.id, con.actividad_id, con.fecha_hora_inicio, con.fecha_hora_fin FROM conferencias as con INNER JOIN actividades as ac on ac.id=con.actividad_id WHERE con.id=".$_POST['actividad_id'];
    $conferencias=$bd->ExecuteE($query);
    foreach ($conferencias as &$conferencia){
            //buscar todas las actividades
            $query="SELECT ac.fecha_hora_inicio, ac.fecha_hora_fin  
                FROM agendas as ag INNER JOIN actividades as ac on ac.id=ag.actividad_id 
                WHERE usuario_id = ".$_POST['usuario']." and ag.tipo=1 and ac.id!=".$conferencia['actividad_id'];
            $agendadas_a=$bd->ExecuteE($query);
            foreach ($agendadas_a as &$agendada){
                if(($conferencia['fecha_hora_inicio']>=$agendada['fecha_hora_inicio']) && ($conferencia['fecha_hora_inicio']<$agendada['fecha_hora_fin'])){
                   $respuesta->disponible=0; 
                }
            }
            //buscar todas las conferencias menos las conferencias de esta actividad
            $query="SELECT con.fecha_hora_inicio, con.fecha_hora_fin 
                    FROM agendas as ag INNER JOIN conferencias as con on con.id=ag.actividad_id 
                    WHERE usuario_id = ".$_POST['usuario']." and ag.tipo=2 ";
            $agendadas_c=$bd->ExecuteE($query);
            foreach ($agendadas_c as &$agendada){
                if(($conferencia['fecha_hora_inicio']>=$agendada['fecha_hora_inicio']) && ($conferencia['fecha_hora_inicio']<$agendada['fecha_hora_fin'])){
                   $respuesta->disponible=0; 
                }
            }
    }
}



echo json_encode($respuesta);
 
?>