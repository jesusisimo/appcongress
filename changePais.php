<?
  include('bd/mnpBD.class.php');
  //funciones para ontener datos-----------------------------------------------------------------------
    if(isset($_POST[id_pais])){
      class respuesta {
       public $success;
       public $html;
      }
      
      $query="SELECT *
              FROM estados
              WHERE id_pais=".$_POST[id_pais];
      $estados=$bd->ExecuteE($query);
      foreach ($estados as &$estado) {
        $codigo .="<option value='".$estado[id_estado]."' >".utf8_encode($estado[estado])."</option>";
      }
      $respuesta = new respuesta();
      $respuesta->success = true;
      $respuesta->html = utf8_encode($codigo);
      echo json_encode($respuesta);
    }
    
  //----------------------------------------------------------------------------------------------------
?>