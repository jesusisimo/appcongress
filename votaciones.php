<?
    if(isset($_GET['id'])){
      $query="SELECT v.id, v.titulo, v.activo, a.id as actividad_id, a.categoria_id FROM votaciones as v INNER JOIN conferencias as c on c.id=v.conferencia_id INNER JOIN actividades as a on a.id=c.actividad_id WHERE v.id=".$_GET['id'];
    }else{
       $query="SELECT v.id, v.titulo, v.activo, a.id as actividad_id, a.categoria_id FROM votaciones as v INNER JOIN conferencias as c on c.id=v.conferencia_id INNER JOIN actividades as a on a.id=c.actividad_id WHERE v.activo";
    }


    $votaciones=$bd->ExecuteE($query);
    $exist=0;
    foreach ($votaciones as &$votacion){
     $exist++;
?>
<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <a class="btn btn-white pull-right" href="./?action=votaciones">
    <i class="fa  fa-refresh"></i>
    </a>
    
    <a class="btn btn-white pull-left" href="./?action=actividad&id=<?=$votacion['actividad_id']?>&view&cat=<?=$votacion['categoria_id']?>">
      <i class="fa fa-arrow-left"></i>
    </a><h4 class="">Pregunta rápida / votación</h4> 
  </section>
</div>
<div class="col-lg-12">
  <section class="panel">
    <header class="panel-heading">
      <span class="tools pull-right">
        <a class="fa fa-chevron-down" href="javascript:;"></a>
        <a class="fa fa-times" href="javascript:;"></a>
      </span>
      <h4 class="text-primary "><?=$votacion['titulo']?></h4>
      
    </header>
    <div class="panel-body" style="display: block;">
      <?
        if($votacion['activo']==1){
        $query="SELECT count(*) as evaluado FROM resultados_votacion WHERE votacion_id=".$votacion['id']." and usuario_id=".$_SESSION['usuario']['id'];
        $evaluados=$bd->ExecuteE($query);
        foreach ($evaluados as &$evaluado){
          if($evaluado['evaluado']==0){
      ?>

      <form class="form-horizontal tasi-form" method="post" action="saveVotacion.php" onsubmit="deshabilitaBtn('votar')">
       <?
        $query="SELECT * FROM opciones_votacion WHERE votacion_id=".$votacion['id'];
        $opciones=$bd->ExecuteE($query);
        foreach ($opciones as &$opcion){
       ?>
          <div class="form-group">
            <div class="col-lg-12">
              <div class="checkbox">
                <label>
                  <input type="radio" name="eleccion" value="<?=$opcion['id']?>" required>
                  <strong><?=$opcion['opcion']?></strong>
                </label>
              </div>
            </div>
          </div>
       <?}?>
        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
            <input type="hidden" name="votacion_id" value="<?=$votacion['id']?>">
            <button class="btn btn-danger" id="votar" type="submit">Enviar</button>
          </div>
        </div>
      </form>
      <?
        }else{
        ?>
        <h5 class="text-danger">Gracias por su voto.</h5>
        <?
        }
      }
    }else{
      ?>
      <h5 class="text-danger">Votación fuera de tiempo.</h5>
      <?
    }
  ?>
    </div>  
  </section>
</div>
<?}
if ($exist==0) {
?>
<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h4 class="pull-left">
    Pregunta rápida / votación</h4> 
  </section>
</div>
<div class="col-lg-12">
  <section class="panel">
    <header class="panel-heading">
      <span class="tools pull-right">
        <a class="fa fa-chevron-down" href="javascript:;"></a>
        <a class="fa fa-times" href="javascript:;"></a>
      </span>
      <h4 class="text-danger ">No hay votaciones disponibles</h4>
    </header>
  </section>
</div>
<?
}
?>