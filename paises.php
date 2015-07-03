<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Paises participantes</h3> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=paises&view" ></i>Ver todos</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar pais">
    </form>
  </section>
</div>
<?
  $query="SELECT *FROM paises ";
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" WHERE pais like '%".$_POST['search']."%' ";
  }
  $paises=$bd->ExecuteE($query);
  foreach ($paises as &$pais){
?>
<div class="col-lg-4">
<!--widget start-->
  <div class="panel">
    <div class="panel-body">
      <div class="bio-chart">
        <a href="./?action=profesores&pais=<?=$pais['id']?>" >
          <img  src="banderas/bandera_<?=$pais['id']?>.png" alt="" style="width: 98%">
        </a>
      </div>
      <div class="bio-desk text-center" style="height: 100%">
          <h3 class="terques" ><a href="./?action=profesores&pais=<?=$pais['id']?>" ><?=$pais['pais']?></a> </h3>
          
          <a class="btn btn-primary btn-sm btn-block" href="./?action=profesores&pais=<?=$pais['id']?>" ><i class="fa fa-eye"></i> Ver profesores</a>
      </div>
    </div>
  </div>
  <!--widget end-->
</div>
<?}?>