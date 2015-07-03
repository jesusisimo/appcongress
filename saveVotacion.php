<?
session_start();
if(isset($_SESSION['usuario']['id']) && isset($_POST['votacion_id']) && isset($_POST['eleccion'])){
  include('bd/mnpBD2.class.php');
//consultar si esta activo
  $query="SELECT * FROM votaciones  WHERE id=".$_POST['votacion_id']; 
  $votaciones=$bd->ExecuteE($query);
  $ok=0;
  foreach ($votaciones as &$votacion){
    if($votacion['activo']==1){
      $ok=1;
    }else{
      $ok=0;
    }
  }
  if($ok==1){
    $campos="usuario_id, votacion_id, eleccion";
    $datos=array(
      ($_SESSION['usuario']['id']),
      ($_POST['votacion_id']),
      ($_POST['eleccion'])
      );
    $usr=new mnpBD('resultados_votacion');
    if($usr->insertar($campos,$datos)){
      header("location: ./?action=votacion&id=".$_POST['votacion_id']."&success");
      exit;
    }else{
      header("location: ./?action=votacion&id=".$_POST['votacion_id']."&error");
      exit;
    }
  }else{
    $_SESSION['mensaje']="Lo sentimos, esta votación ya no se encuentra disponible";
    header("location: ./?action=votacion&id=".$_POST['votacion_id']."&timeout");
    exit;
  }
  
}else{
  header("location: ./");
  exit;
}
?>