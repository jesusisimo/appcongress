<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Categorias</h3> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=categorias&view" ></i>Ver todas</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar categoria">
    </form>
  </section>
</div>
<?
  $query="SELECT *FROM categorias ";
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" WHERE categoria like '%".$_POST['search']."%' ";
  }
  $categorias=$bd->ExecuteE($query);
  foreach ($categorias as &$categoria){
?>
<div class="col-lg-4">
<!--widget start-->
  <div class="panel">
    <div class="panel-body">
      <h3 class="text-center">
        <a href="./?action=actividades&view&cat=<?=$categoria['id']?>"><?=$categoria['categoria']?></a> 
      </h3>
      <?
      if($categoria['inicio']!="0000-00-00 00:00:00" && $categoria['fin']!="0000-00-00 00:00:00"){
      ?>
        <div class="row col-lg-12">
        <span class="pull-right">
          <i class="fa fa-clock-o"></i> 
          <?
          $fecha_inicio = date("Y-m-d", strtotime($categoria['inicio']));
          $fecha_fin = date("Y-m-d", strtotime($categoria['fin']));
          if($fecha_inicio==$fecha_fin){
            ?>
            <?=date("Y-m-d", strtotime($categoria['inicio']));?> <?=date("H:i", strtotime($categoria['inicio']));?> <strong>a</strong> <?=date("H:i", strtotime($categoria['fin']));?>
            <?
          }else{
          ?>
          <?=$categoria['inicio']?> <strong>a</strong> <?=$categoria['fin']?>
          <?}?>
          </span>
        </div>
      <?
      }
      ?>
        <p><?=$categoria['descripcion'];?></p>
        <a href="./?action=actividades&view&cat=<?=$categoria['id']?>" class="btn btn-primary btn-sm btn-block" ><i class="fa fa-eye"></i> Ver actividades</a>
    </div>
  </div>
  <!--widget end-->
</div>
<?}?>