<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Coordinadores</h3> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=coordinadores&view" ></i>Ver todos</a><?}?>
    <form class="pull-right position" action="" method="post">
      <div class="input-append">
        <input class="sr-input" type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar coordinador" >
        <button class="btn sr-btn" type="submit">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </form>
  </section>
</div>
<?
  $query="SELECT *FROM coordinadores WHERE activo=1 ";
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" and nombre like '%".$_POST['search']."%' ";
  }
  $coordinadores=$bd->ExecuteE($query);
  foreach ($coordinadores as &$coordinador){
?>
<div class="col-lg-4">
<!--widget start-->
  <div class="panel">
    <div class="panel-body">
      <div class="bio-desk text-center">
          <h3 class="terques" style="vertical-align: middle; display: inline-block;"><?=$coordinador['nombre']?> </h3>
      </div>
    </div>
  </div>
  <!--widget end-->
</div>
<?}?>