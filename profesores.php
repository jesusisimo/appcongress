<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Profesores</h3> <? if(isset($_GET['pais']) or isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=profesores&view" ></i>Ver todos</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar profesor">
    </form>
  </section>
</div>
<?
  $query="SELECT p.id, p. nombre, p.email, p.emailpublico, p.institucion, p.puesto, pa.pais, p.pais_id FROM profesores as p INNER JOIN paises as pa on pa.id=p.pais_id WHERE p.activo=1 ";
  if(isset($_GET['pais']) && $_GET['pais']!=""){
    $query.=" and p.pais_id=".$_GET['pais'];
  }
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" and p.nombre like '%".$_POST['search']."%' ";
  }
  $query.=" order by orden asc ";
  
  $profesores=$bd->ExecuteE($query);
  $i=0;
  foreach ($profesores as &$profesor){
    $i++;
?>
<div class="col-lg-4">
<!--widget start-->
                              <section class="panel">
                                  <div class="twt-feed blue-bg" style="cursor: pointer;" onclick="javascrip:window.location.href='./?action=profesor&id=<?=$profesor['id']?>';">
                                      <h1>
                                         <?=$profesor['nombre']?>
                                      </h1>
                                      <p><?if($profesor['emailpublico']==1){echo $profesor['email'];}else{?>&nbsp;<?}?></p>
                                      <a href="./?action=profesor&id=<?=$profesor['id']?>">
                                          <?
                                          if(file_exists("foto_profesor/profesor_".$profesor['id'].".png")){
                                          ?>
                                          <img src="foto_profesor/profesor_<?=$profesor['id']?>.png" alt="foto">
                                          <?
                                          }else{
                                          ?>
                                          <img src="foto_profesor/sin-foto.png" alt="foto">
                                          <?}?>
                                      </a>
                                  </div>
                                  <div class="weather-category twt-category">
                                      <ul>
                                          <li class="li-2" style="cursor: pointer;" onclick="javascrip:window.location.href='./?action=profesor&id=<?=$profesor['id']?>';">
                                              <? if($profesor['puesto']!=""){echo $profesor['puesto'].", ";}?> <?=$profesor['institucion']?>
                                          <p>
                                          <?
                                            $sql_calificaciones  = "SELECT sum(estrellas) as total, count(id_usuario) as votantes  FROM  calificaciones_profesor where id_profesor=".$profesor['id'];
                                            $res_calificaciones  = $bd->ExecuteE($sql_calificaciones);
                                            $estrellas=0;
                                            $votantes=0;
                                            foreach ($res_calificaciones as &$calificacion) { 
                                              if($calificacion['total']>0){
                                                $votantes=$calificacion['votantes'];
                                                $estrellas=$calificacion['total']/$calificacion['votantes'];
                                              }  

                                              }
                                            ?>
                                            <?

                                            if($estrellas==0){
                                            ?>
                                              <i class="fa text-warning fa-star-o "></i> | <i class="fa fa-user text-primary"></i> x <?=$calificacion['votantes']?>
                                            <?}elseif ($estrellas > 0 && $estrellas<=3) {?>
                                            <?=number_format($estrellas, 1, ',', '');?> <i class="fa text-warning  fa-star-half-o"></i> |  <i class="fa fa-user text-primary"></i> x <?=$calificacion['votantes']?>
                                            <?}elseif ($estrellas > 0 && $estrellas>3) {?>
                                            <?=number_format($estrellas, 1, ',', '');?> <i class="fa text-warning  fa-star"></i> |  <i class="fa fa-user text-primary"></i> x <?=$calificacion['votantes']?>
                                            <?}?>
                                            <!-- <i class="fa text-warning <? if($estrellas>=1){?> fa-star <?}else{?>  fa-star-o <?}?> "></i>
                                            <i class="fa text-warning <? if($estrellas>=2){?> fa-star <?}else{?>  fa-star-o <?}?> "></i>
                                            <i class="fa text-warning <? if($estrellas>=3){?> fa-star <?}else{?>  fa-star-o <?}?> "></i>
                                            <i class="fa text-warning <? if($estrellas>=4){?> fa-star <?}else{?>  fa-star-o <?}?> "></i>
                                            <i class="fa text-warning <? if($estrellas>=5){?> fa-star <?}else{?>  fa-star-o <?}?> "></i> -->
                                          </p>
                                          </li>
                                          <li style="vertical-align: top;">
                                              <a href="./?action=profesores&pais=<?=$profesor['pais_id']?>">
                                                <img src="banderas/bandera_<?=$profesor['pais_id']?>.png" style="max-width: 35px; width: 100%;">
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
                              </section>
                              <!--widget end-->
</div>
<?}
if($i==0){
  ?>
<div class="col-lg-12">
<!--widget start-->
                              <section class="panel">
                                <div class="panel-body text-center">
                                  <h3>No se encontraron profesores que cumplan con su busqueda</h3>
                                </div>
                                  
                              </section>
                              <!--widget end-->
</div>
  <?
}
?>

