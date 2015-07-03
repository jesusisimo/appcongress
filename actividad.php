<style type="text/css">

        .flex-video {

position: relative;

padding-top: 25px;

padding-bottom: 67.5%;

height: 0;

margin-bottom: 16px;

overflow: hidden;

}

 

.flex-video.widescreen { padding-bottom: 57.25%; }

.flex-video.vimeo { padding-top: 0; }

 

.flex-video iframe,

.flex-video object,

.flex-video embed {

position: absolute;

top: 0;

left: 0;

width: 100%;

height: 100%;

}

@media only screen and (max-device-width: 800px), only screen and (device-width: 1024px) and (device-height: 600px), only screen and (width: 1280px) and (orientation: landscape), only screen and (device-width: 800px), only screen and (max-width: 767px) {

.flex-video { padding-top: 0; }

}
</style>
<?
    $query="SELECT s.salon, s.id as id_salon, a.id, a.actividad, a.descripcion, a.fecha_hora_inicio, a.fecha_hora_fin, a.lugar, a.categoria_id, a.cupo, a.costo, a.coordinadores, a.profesor_id, a.temario, a.temario, a.patrocinadores, a.activo FROM actividades as a INNER JOIN salones as s on s.id=a.lugar WHERE a.id=".$_GET['id'];
    $actividades=$bd->ExecuteE($query);
    foreach ($actividades as &$actividad){


    if(isset($_GET['profesor']) && $_GET['profesor']!=""){
    $query="SELECT *FROM profesores WHERE id=".$_GET['profesor'];
    $profesores=$bd->ExecuteE($query);
        foreach ($profesores as &$profesor){}
    }

?>
<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h4 class=""><?if(isset($_GET['cat'])){?> <a class="btn btn-white" href="./?action=actividades&cat=<?=$_GET['cat']?>&view"><i class="fa fa-arrow-left"></i></a><?}?> <?=$actividad['actividad'];?> </h4> <? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=actividad&id=<?=$_GET['id']?>&view&cat=<?=$_GET['cat']?>" ></i>Ver completa</a><?}?>
  </section>
</div>
<div class="col-lg-12">
  <section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue">
      <ul class="nav nav-tabs ">
        <li class="<?if(isset($_GET['profesor']) || isset($_GET['conf'])){}else{?>active<?}?>">
          <a href="#general" data-toggle="tab">
            <i class="fa fa-list-alt"></i>
          </a>
        </li>
        <?if($actividad['temario']!=""){?>
        <li class="">
          <a href="#temario" data-toggle="tab">
            <i class="fa fa-list-ul"></i>
            Programa
          </a>
        </li>
        <?}?>
        <?
          $query="SELECT count(*) as total FROM conferencias WHERE actividad_id=".$_GET['id'];
          $totalc=$bd->ExecuteE($query);
          $existen=0;
          foreach ($totalc as &$total){
            $existen=$total['total'];
          }
        ?>
        <?if($existen>0){?>
        <li class="<?if(isset($_GET['profesor']) || isset($_GET['conf'])){?>active<?}?>">
          <a href="#conferencias" data-toggle="tab">
            <i class="fa fa-bullhorn"></i>
            Conferencias
          </a>
        </li>
        <?}?>
      </ul>
    </header>
    <div class="panel-body">
      <div class="tab-content">
        <div id="general" class="tab-pane <?if(!isset($_GET['profesor']) && !isset($_GET['conf'])){?>active<?}?>">
        <?
          $query="SELECT count(*) as total FROM agendas WHERE tipo=1 and actividad_id=".$_GET['id']." and usuario_id=".$_SESSION['usuario']['id'];
          $totalact=$bd->ExecuteE($query);
          $existea=0;
          foreach ($totalact as &$totala){
            $existea=$totala['total'];
          }
         if(isset($_SESSION['usuario']['tipo']) && $_SESSION['usuario']['tipo']==0){
        ?>
          <?if($existea==0){?>
            <div id="agendar1_<?=$_GET['id']?>">
              <a href="javascript:;" onclick="addAgenda(<?=$_GET['id']?>,1, <?=$existen?>)" class="btn btn-primary btn-sm pull-right">
                <i class="fa fa-calendar"></i> Agendar
              </a>
            </div>
            <?}else{?>
             <div id="agendar1_<?=$_GET['id']?>">
              <a href="javascript:;" onclick="delAgenda(<?=$_GET['id']?>,1, <?=$existen?>)" class="btn btn-danger btn-sm pull-right">
                <i class="fa fa-ban"></i> Quitar de mi agenda
              </a>
            </div>
            <?}?>
          <?}?>
          <h3 class=""><?=$actividad['actividad']?></h3>
          <p>
            <? if($actividad['coordinadores']!="0"){?>
            <i class="fa fa-group"></i>Coordinadores :
            <?
              $query="SELECT * FROM coordinadores WHERE id in (".$actividad['coordinadores'].")";
              $coordinadores=$bd->ExecuteE($query);
              $lcoordinadores="";
              foreach ($coordinadores as &$coordinador) {
                if($coordinador['profesor_id']!=0){
                  $lcoordinadores.="<a href='./?action=profesor&id=".$coordinador['profesor_id']."'>".$coordinador['nombre']."</a>, ";
                }else{
                                    $lcoordinadores.=$coordinador['nombre'].", ";
                } 
              }
              echo substr($lcoordinadores, 0, -2);
            ?> |
            <?}?>
            <? if(date("Y-m-d", strtotime($actividad['fecha_hora_inicio'])) != date("Y-m-d", strtotime($actividad['fecha_hora_fin']))){?>  
               <i class="fa fa-calendar"></i>
                <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_inicio']))));?> -
                <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_fin']))));?> 
            <?}else{?>
                <i class="fa fa-clock-o"></i>
                <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_inicio']))));?> -
                <?=date("H:i a", strtotime($actividad['fecha_hora_fin']));?>
            <?}?>
            |
            <i class="fa fa-map-marker"></i>
            <a href="./?action=actividades&lugar=<?=$actividad['id_salon']?>"><?=$actividad['salon']?></a>
          </p>

          <p><?=$actividad['descripcion']?></p>
          <?
          if ($actividad['patrocinadores']!="") {
          ?>
          <!--carousel start-->
            <section class="panel">
              <?  
                $query="SELECT * FROM patrocinadores WHERE id in (".$actividad['patrocinadores'].")";
                $patrocinadores=$bd->ExecuteE($query);
                $patrocinadores1=$patrocinadores;
              ?>
                <div id="c-slide" class="carousel slide auto panel-body">
                
                    <ol class="carousel-indicators out">
                      <?
                      $p=0;
                      foreach ($patrocinadores as &$patrocinador) {
                        
                      ?>
                        <li class="<? if($p==0){echo 'active'; }?>" data-slide-to="<?=$p?>" data-target="#c-slide"></li>
                      <?$p++;}?>
                    </ol>
                    <div class="carousel-inner">
                      <?
                      $p=0;
                      foreach ($patrocinadores as &$patrocinador) {
                        $p++;
                      ?>
                        <div class="item text-center <? if($p==1){echo 'active'; }?>">
                            <h3 class="text-primary"><?=$patrocinador['patrocinador']?></h3>
                            <small class="text-muted">
                                <img src="logo_patrocinadores/logo_<?=$patrocinador['id']?>.png">
                            </small>
                        </div>
                    <?}?>
                    </div>
                    <a data-slide="prev" href="#c-slide" class="left carousel-control">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a data-slide="next" href="#c-slide" class="right carousel-control">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </section>
          <!--carousel end-->
          <?}?>
        </div>
        <?if($actividad['temario']!=""){?>
        <div id="temario" class="tab-pane">
            <?=$actividad['temario']?>
        </div>
        <?}?>
        <?if($existen>0){?>
        <div id="conferencias" class="tab-pane <?if(isset($_GET['profesor']) || isset($_GET['conf'])){?>active<?}?>">
          <?
          $query="SELECT c.id, c.conferencia, c.fecha_hora_inicio, c.fecha_hora_fin, c.profesor_id, c.descripcion FROM conferencias as c  WHERE c.activo=1 and c.actividad_id=".$_GET['id'];
          
          if(isset($_GET['profesor']) && $_GET['profesor']!=""){
            $query.=" and c.profesor_id=".$_GET['profesor'];
          }
          $conferencias=$bd->ExecuteE($query);
          $i=0;
          foreach ($conferencias as &$conferencia){
            $conferencia['profesor']="";
          if($conferencia['profesor_id']!=0){
            $query_p="SELECT * FROM profesores WHERE id=".$conferencia['profesor_id'];
            $res_profe=$bd->ExecuteE($query_p);
            foreach ($res_profe as &$profesor){
              $conferencia['profesor']=$profesor['nombre'];
            }
          }
            $i++
          ?>
              <div class="room-box">
                        <?
                          $query="SELECT count(*) as total FROM agendas WHERE tipo=2 and actividad_id=".$conferencia['id']." and usuario_id=".$_SESSION['usuario']['id'];
                          $totalact=$bd->ExecuteE($query);
                          $existea=0;
                          foreach ($totalact as &$totala){
                            $existea=$totala['total'];
                          }
                        if(isset($_SESSION['usuario']['tipo']) && $_SESSION['usuario']['tipo']==0){
                        ?>
                          <?if($existea==0){?>
                            <div id="agendar2_<?=$conferencia['id']?>" class="age-conf">
                              <a href="javascript:;" onclick="addAgenda(<?=$conferencia['id']?>,2, 0)" class="btn btn-primary btn-sm pull-right">
                                <i class="fa fa-calendar"></i> Agendar
                              </a>
                            </div>
                            <?}else{?>
                            <div id="agendar2_<?=$conferencia['id']?>" class="age-conf">
                              <a href="javascript:;" onclick="delAgenda(<?=$conferencia['id']?>,2, 0)" class="btn btn-danger btn-sm pull-right">
                                <i class="fa fa-ban"></i> Quitar de mi agenda
                              </a>
                            </div>
                            <?}?>
                        <?}?>
                <h5 class="text-primary">
                  <a href="javascript:;"><?=$conferencia['conferencia']?></a>
                </h5>
                <p>
                <?
                if($conferencia['profesor_id']!=0){
                ?>
                  <i class="fa fa-user-md text-muted"></i>
                  <a href="./?action=profesor&id=<?=$conferencia['profesor_id']?>" ><?=$conferencia['profesor']?></a> |
                <?}?>
                  <? if(date("Y-m-d", strtotime($conferencia['fecha_hora_inicio'])) != date("Y-m-d", strtotime($conferencia['fecha_hora_fin']))){?>  
                     <i class="fa fa-calendar"></i>
                      <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($conferencia['fecha_hora_inicio']))));?> -
                      <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($conferencia['fecha_hora_fin']))));?> 
                  <?}else{?>
                      <i class="fa fa-clock-o"></i>
                      <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($conferencia['fecha_hora_inicio']))));?> -
                      <?=date("H:i a", strtotime($conferencia['fecha_hora_fin']));?>
                  <?}?>
                  |
                  <i class="fa fa-map-marker text-muted"></i>
                  <a href="./?action=actividades&lugar=<?=$actividad['id_salon']?>"><?=$actividad['salon']?></a>
                </p>
                <p ><?=$conferencia['descripcion']?></p>
                <?
                  $query="SELECT * FROM votaciones WHERE conferencia_id=".$conferencia['id'];
                  $preguntas_rapidas=$bd->ExecuteE($query);
                  if(count($preguntas_rapidas)>0){
                  ?>
                  <!-- <div class="col-lg-12">
                    <h6 class="text-warning">Preguntas rápidas / Votaciones</h6> -->
                  <?
                    foreach ($preguntas_rapidas as &$pregunta) {
                    ?>
                    <!-- <div class="col-lg-4">
                      <a class="btn btn-block btn-xs btn-success" href="./?action=votacion&id=<?=$pregunta['id']?>"><i class="fa fa-question-circle"></i> <?=$pregunta['titulo']?></a>
                    </div> -->
                      <?}?>
                  <!-- </div> -->
                <?}?>
              </div>
          <?}?>
          
        </div>
        <?}?>
      </div>
    </div>
  </section>
</div>

</div>
<?}?>