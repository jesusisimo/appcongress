<?
if(isset($_GET['cat']) && $_GET['cat']!=""){
    $query="SELECT *FROM categorias WHERE id=".$_GET['cat'];
    $categorias=$bd->ExecuteE($query);
    foreach ($categorias as &$categoria){}
}
if(isset($_GET['profesor']) && $_GET['profesor']!=""){
    $query="SELECT *FROM profesores WHERE id=".$_GET['profesor'];
    $profesores=$bd->ExecuteE($query);
    foreach ($profesores as &$profesor){}
}
if(isset($_GET['lugar']) && $_GET['lugar']!=""){
    $query="SELECT *FROM salones WHERE id=".$_GET['lugar'];
    $lugares=$bd->ExecuteE($query);
    foreach ($lugares as &$lugar){}
}
    
?>
<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
  <a class="btn btn-white pull-left" href="./?action=categorias&view"><i class="fa fa-arrow-left"></i></a>&nbsp;
    <h3>Actividades <?if(isset($_GET['profesor'])){echo "de ".$profesor['nombre'];}?> <?if(isset($_GET['lugar'])){echo "en ".$lugar['salon'];}?></h3><? if(isset($_POST['search'])){?> <a class="btn btn-sm btn-white text-info" href="./?action=actividades&view&cat=<? if(isset($_GET['cat'])){echo $_GET['cat'];}?>" ></i>Ver todas</a><?}?>
    <form class="pull-right position user-head" action="" method="post">
      <input class="form-control search-btn2 "  type="search" name="search" value="<? if(isset($_POST['search'])){ echo $_POST['search'];}?>" placeholder="Buscar actividad">
    </form>
  </section>
</div>
<div class="col-lg-12">
  <div class="panel-group " >
    <div class="panel panel-default">
      <div  class="panel-body">
        <?
        if(isset($_GET['cat']) && $_GET['cat']){
            if($categoria['inicio']!="0000-00-00 00:00:00" && $categoria['fin']!="0000-00-00 00:00:00"){
            ?>
              <span  class="badge  pull-right  ">
                <i class="fa fa-clock-o"></i> 
                <?
                $fecha_inicio = date("Y-m-d", strtotime($categoria['inicio']));
                $fecha_fin = date("Y-m-d", strtotime($categoria['fin']));
                if($fecha_inicio==$fecha_fin){
                  ?>
                   <?=date("H:i", strtotime($categoria['inicio']));?> <strong>a</strong> <?=date("H:i", strtotime($categoria['fin']));?> <?=date("Y-m-d", strtotime($categoria['inicio']));?>
                  <?
                }else{
                ?>
                <?=$categoria['inicio']?> a <?=$categoria['fin']?>
                <?}?>
              </span>
            <?
            }
          ?>
        <h4 class="terques "><?=$categoria['categoria']?> </h4>
        <p><?=$categoria['descripcion']?></p>
        <?
        }else{
            ?>
        <h4 class="terques ">Actividades </h4>
            <?
          }
        ?>
      </div>
    </div>
  </div>
  <div class="panel-group m-bot20" id="accordion">
<?
  $query="SELECT min(date(fecha_hora_inicio)) as dia_inicio, max(date(fecha_hora_fin)) as dia_fin FROM actividades WHERE activo=1 ";
  if(isset($_GET['cat']) && $_GET['cat']!=""){
    $query.=" and categoria_id =".$_GET['cat'];
  }
  if(isset($_GET['lugar']) && $_GET['lugar']!=""){
    $query.=" and lugar =".$_GET['lugar'];
  }
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" and actividad like '%".$_POST['search']."%' ";
  }
  if(isset($_GET['profesor']) && $_GET['profesor']!=""){
    $query_p=" SELECT actividad_id FROM conferencias where profesor_id=".$_GET['profesor']." group by actividad_id";
    $res_query_p=$bd->ExecuteE($query_p);
    $idsactividades="0";
    foreach ($res_query_p as &$ids_actividades) {
      $idsactividades.=",".$ids_actividades['actividad_id'];
    }
    $query.=" and id in (".$idsactividades.") ";
  }
  $r_fechas=$bd->ExecuteE($query);
  $Rfecha_inicio;
  $Rfecha_fin;
  foreach ($r_fechas as &$r_fecha){
    $Rfecha_inicio=$r_fecha['dia_inicio'];
    $Rfecha_fin=$r_fecha['dia_fin'];
  }

  $interval = date_diff(date_create($Rfecha_inicio), date_create($Rfecha_fin));
  $dias=$interval->format('%R%a');
  $diaactual=$Rfecha_inicio;
  $fechas=array();
  for ($j=0; $j <= $dias ; $j++) { 
    //consultar que los dias tengan actividades, luego insertar en el array de fechas
    $qry="SELECT count(*) existen FROM actividades WHERE '".$diaactual."' BETWEEN date(fecha_hora_inicio) AND date(fecha_hora_fin) ";
     if(isset($_GET['cat']) && $_GET['cat']!=""){
        $qry.=" and categoria_id =".$_GET['cat'];
      }
    $res=$bd->ExecuteE($qry);
    foreach ($res as &$existencia) {
      if($existencia['existen']>0){
        array_push($fechas, $diaactual);
      }
    }
    
    //--------------------------------------------
    $diaactual = date ( 'Y-m-d' , strtotime ( '+1 day' , strtotime ( $diaactual ) ) );//sumar 1 dia

  }

  $i=0;
  foreach ($fechas as &$fecha){
    $i++;
?>
                          <div class="panel panel-default">
                             
                                  
                                <a class="accordion-toggle btn btn-xs btn-block btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$fecha?>">
                                  <h5 >
                                  <?
                                    setlocale(LC_ALL,"es_MX");
                                    echo ucfirst(utf8_encode(strftime("%A %d de %B del %Y",strtotime($fecha))));
                                  ?>
                                  </h5>
                                </a>
                              <? if($fecha==date('Y-m-d')){ $in="in"; }else{ $in="";}?>
                              <div id="collapse<?=$fecha?>" class="panel-collapse collapse <?=$in;?>">
                                  
                                <!--widget start-->
                                <aside class="panel-body profile-nav alt blue-border">
                                  <section class="panel ">
                                    <ul class="nav nav-pills nav-stacked ">
                                      <?
                                        $query="SELECT * FROM actividades WHERE '".$fecha."' BETWEEN date(fecha_hora_inicio) AND date(fecha_hora_fin) ";
                                        if(isset($_GET['cat']) && $_GET['cat']!=""){
                                          $query.=" and categoria_id =".$_GET['cat'];
                                        }
                                        if(isset($_GET['lugar']) && $_GET['lugar']!=""){
                                            $query.=" and lugar =".$_GET['lugar'];
                                          }
                                        if(isset($_POST['search']) && $_POST['search']!=""){
                                          $query.=" and actividad like '%".$_POST['search']."%' ";
                                        }
                                        if(isset($_GET['profesor']) && $_GET['profesor']!=""){
                                            $query_p=" SELECT actividad_id FROM conferencias where profesor_id=".$_GET['profesor']." group by actividad_id";
                                            $res_query_p=$bd->ExecuteE($query_p);
                                            $idsactividades="0";
                                            foreach ($res_query_p as &$ids_actividades) {
                                              $idsactividades.=",".$ids_actividades['actividad_id'];
                                            }
                                            $query.=" and id in (".$idsactividades.") ";
                                          }
                                        $query.=" order by fecha_hora_inicio asc";
                                        $actividades=$bd->ExecuteE($query);
                                        foreach ($actividades as &$actividad) {

                                        if(date("Y-m-d H:i")>=date("Y-m-d H:i", strtotime($actividad['fecha_hora_inicio'])) && date("Y-m-d H:i")<date("Y-m-d H:i", strtotime($actividad['fecha_hora_fin']))){
                                          $activo="active";
                                        }else{
                                          $activo="";
                                        }
                                        
                                        ?>
                                        <li class="<?=$activo?> ">
                                          <a href="./?action=actividad&id=<?=$actividad['id']?>&view&cat=<?=$actividad['categoria_id']?><?if(isset($_GET['profesor'])){?>&profesor=<?=$_GET['profesor']?><?}?>" >
                                            <span  class="badge  pull-right  ">
                                              <? if(date("Y-m-d", strtotime($actividad['fecha_hora_inicio'])) != date("Y-m-d", strtotime($actividad['fecha_hora_fin']))){?> <i class="fa fa-calendar"></i> <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_inicio']))));?> - <?=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_fin']))));?> <?}else{?> <i class="fa fa-clock-o"></i> <?=date("H:i a", strtotime($actividad['fecha_hora_inicio']));?> <?}?>
                                            </span>
                                            <i class="fa fa-calendar text-primary"></i>
                                            <?=$actividad['actividad']?>
                                          </a>
                                        </li>
                                        <?
                                        }
                                      ?>
                                    </ul>
                                  </section>
                                </aside>
                                <!--widget end-->
                                    
                              </div>
                          </div>
                      
<?}?></div>
 <?
if($i==0){
  ?>
<div class="col-lg-12">
<!--widget start-->
                              <section class="panel">
                                <div class="panel-body text-center">
                                  <h3>No se encontraron actividades que cumplan con su busqueda</h3>
                                </div>
                                  
                              </section>
                              <!--widget end-->
</div>
  <?
}
 ?>                     <!--collapse end-->
</div>