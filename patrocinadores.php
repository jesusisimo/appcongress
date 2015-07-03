<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Patrocinadores</h3> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=patrocinadores&view" ></i>Ver todos</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar patrocinador">
    </form>
  </section>
</div>
<div class="col-lg-12 ">
  <div id="accordion" class="panel-group m-bot20">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="accordion-toggle collapsed " href="#collapseOne" data-parent="#accordion" data-toggle="collapse"> 
                Toca para ver plano expo comercial
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
            <div class="panel-body table-responsive"> 
            <?if(esMobil()){?>
              <img src="img/plano-vertical.jpg" style="width:100%;">
            <?}else{?>
            <img src="img/plano-horizontal.jpg" style="width:100%;">
            <?}?>
            </div>
          </div>
        </div>
      </div>
  </div>
<?
  $query="SELECT *FROM patrocinadores WHERE activo=1 ";
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" and patrocinador like '%".$_POST['search']."%' ";
  }
  $patrocinadores=$bd->ExecuteE($query);
  foreach ($patrocinadores as &$patrocinador){
?>
<div class="col-lg-4">
<!--widget start-->
  <div class="panel">
    <div class="panel-body">
      <div class="bio-chart">
        <a href="<?=$patrocinador['pagina']?>" target="_blank">
          <img  src="logo_patrocinadores/logo_<?=$patrocinador['id']?>.png" alt="" style="width: 98%">
        </a>
      </div>
      <div class="bio-desk text-center">
          <h3 class="terques" style="vertical-align: middle; display: inline-block;"><a href="<?=$patrocinador['pagina']?>" target="_blank"><?=$patrocinador['patrocinador']?></a> </h3>
      </div>
    </div>
  </div>
  <!--widget end-->
</div>
<?}?>