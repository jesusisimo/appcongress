  <?
    session_start();
  if(!isset($_SESSION['admin']['id'])){
    header("location:login.php");
    exit;
  }
  include('../bd/mnpBD2.class.php');
  if (isset($_GET['votacion']) && $_GET['votacion']!="" && isset($_GET['estatus']) ) {
        if($_GET['estatus']==1){
          $campos="activo";
          $valores=array(0);
          $condicion=" id!=".$_GET['votacion'];
          $usr=new mnpBD('votaciones');
          $usr->actualizar($campos,$valores,$condicion);
        }
        $campos="activo";
        $valores=array($_GET['estatus']);
        $condicion=" id=".$_GET['votacion'];
        $usr=new mnpBD('votaciones');
        $usr->actualizar($campos,$valores,$condicion);
        header("location:./?action=votaciones&view#".$_GET['votacion']);
        exit;
  }
  ?>