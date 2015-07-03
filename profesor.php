<?
  $query="SELECT p.id, p. nombre, p.email, p.curriculum, p.emailpublico, p.institucion, p.puesto, pa.pais, p.pais_id FROM profesores as p INNER JOIN paises as pa on pa.id=p.pais_id WHERE p.id=".$_GET['id'];
  $profesores=$bd->ExecuteE($query);
  foreach ($profesores as &$profesor){
?>
<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <a class="btn btn-white pull-left" href="./?action=profesores&view"><i class="fa fa-arrow-left"></i></a>&nbsp;
    <h3><?=$profesor['nombre']?></h3>
    <form class="pull-right position user-head" action="./?action=profesores&view" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar profesor">
    </form>
  </section>
</div>
<div class="col-lg-5">
<!--widget start-->
<aside class="profile-nav alt blue-border">
    <section class="panel">
        <div class="user-heading alt blue-bg">
          <a href="./?action=actividades&profesor=<?=$profesor['id']?>">
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
            <h1><?=$profesor['nombre']?></h1>
            <p>
              <?
                if($profesor['emailpublico']){
                ?>
                    <?=$profesor['email']?>
                <?
                  }
                ?>
                
            </p><span>
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
                if($estrellas==0){
                ?>
                  <i class="fa text-blanco fa-star-o "></i>
                <?}elseif ($estrellas > 0 && $estrellas<=3) {?>
                <?=number_format($estrellas, 1, ',', '');?> <i class="fa text-warning  fa-star-half-o"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-user text-blanco"></i> x <?=$calificacion['votantes']?> 
                <?}elseif ($estrellas > 0 && $estrellas>3) {?>
                <?=number_format($estrellas, 1, ',', '');?> <i class="fa text-warning  fa-star"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-user text-blanco"></i> x <?=$calificacion['votantes']?> 
                <?}?>
                
                  <!-- <i class="fa fa-star <? if($estrellas>=1){?> text-warning <?}else{?> text-blanco <?}?>"></i>
                  <i class="fa fa-star <? if($estrellas>=2){?> text-warning <?}else{?> text-blanco <?}?>"></i>
                  <i class="fa fa-star <? if($estrellas>=3){?> text-warning <?}else{?> text-blanco <?}?>"></i>
                  <i class="fa fa-star <? if($estrellas>=4){?> text-warning <?}else{?> text-blanco <?}?>"></i>
                  <i class="fa fa-star <? if($estrellas>=5){?> text-warning <?}else{?> text-blanco <?}?>"></i> -->
                </span>

        </div>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="./?action=actividades&profesor=<?=$profesor['id']?>"> <i class="fa fa-calendar"></i> Ver actividades</a></li>
        <?
          if($profesor['puesto']!=""){
        ?>  
            <li><a href="javascript:;"> <i class="fa fa-user-md"></i> Cargo <span class="  pull-right r-activity"><?=$profesor['puesto']?></span></a></li>
        <?
          }
        ?> 
        <?
          if($profesor['institucion']!=""){
        ?> 
            <li><a href="javascript:;"> <i class="fa fa-hospital-o"></i> Institución <span class="  pull-right r-activity"><?=$profesor['institucion']?></span></a></li>
        <?
          }
        ?> 
            <li><a href="javascript:;"> <i class="fa fa-globe"></i> Pais <span class="pull-right r-activity"><?=$profesor['pais']?>&nbsp;&nbsp; <img width="30px" src="banderas/bandera_<?=$profesor['pais_id']?>.png" alt="bandera"></span></a></li>
            <li>
              <a href="javascript:;"> 
              <i class="fa fa-certificate text-warning"></i> ¡Calificame!
              <span class="pull-right r-activity">
                <span class="rating">
                <?
                $sql_calificaciones  = "SELECT estrellas  FROM  calificaciones_profesor where id_profesor=".$profesor['id']." and id_usuario=".$_SESSION['usuario']['id'];
                $res_calificaciones  = $bd->ExecuteE($sql_calificaciones);
               $estrellas=0;
                foreach ($res_calificaciones as &$calificacion) { 
                 $estrellas=$calificacion['estrellas'];      
                  }
                ?> 
                  <span class="star  cal5 <? if($estrellas>=5){?> emitido <?}?>" onclick="calificar(5);"></span>
                  <span class="star  cal4 <? if($estrellas>=4){?> emitido <?}?>" onclick="calificar(4);"></span>
                  <span class="star  cal3 <? if($estrellas>=3){?> emitido <?}?>" onclick="calificar(3);"></span>
                  <span class="star  cal2 <? if($estrellas>=2){?> emitido <?}?>" onclick="calificar(2);"></span>
                  <span class="star  cal1 <? if($estrellas>=1){?> emitido <?}?>" onclick="calificar(1);"></span>
                </span>
              </span>
              
              </a>
            </li>
        
        </ul>
        <input type="hidden" name="profesor_id" id="profesor_id" value="<?=$profesor['id']?>">
    </section>
</aside>
</div>
<div class="col-lg-7">
  <section class="panel">
                          <header class="panel-heading">
                              Curriculum
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                              <?
                              if (file_exists("cvs/cv_".$profesor['id'].".pdf")) {
                              ?>
                                <a class="btn btn-primary btn-sm pull-right" target="_blank" href="cvs/cv_<?=$profesor['id']?>.pdf">Descargar PDF</a>
                               <!---- <a class="btn btn-primary btn-sm pull-right" href="dowloadCv.php?id=<?=$profesor['id']?>">Descargar PDF</a>-->
                              <?
                              }
                              ?>
                              
                          </header>
                          <div class="panel-body ">
                              
                              
                                  <?=html_entity_decode ($profesor['curriculum']); ?>
                              
                          </div>
                      </section>
</div>
<?}?>