
<div class="col-lg-12 ">
  <section class="panel panel-heading inbox-head header-profesores" >
    <h3>Actividades minuto a minuto </h3>
    
  </section>
</div>
<div class="col-lg-12">
  <div class="panel-group m-bot20" id="accordion">
<?
  $query="SELECT min(date(fecha_hora_inicio)) as dia_inicio, max(date(fecha_hora_fin)) as dia_fin FROM actividades WHERE activo=1 ";
  if(isset($_POST['search']) && $_POST['search']!=""){
    $query.=" and actividad like '%".$_POST['search']."%' ";
  }
  $fecha_hora_actual=date("Y-m-d H:i:s");
  $posicion="";
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
                              <div class="panel-heading ">
                                  
                                <a class="accordion-toggle btn-large" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$fecha?>">
                                  <h3 class="panel-title ">
                                  <?
                                    setlocale(LC_ALL,"es_MX");
                                    echo ucfirst(utf8_encode(strftime("%A %d de %B del %Y",strtotime($fecha))));
                                  ?>
                                  </h3>
                                </a>
                              </div>
                              <? if($fecha==date('Y-m-d')){ $in="in"; }else{ $in="";}?>
                              <div id="collapse<?=$fecha?>" class="panel-collapse collapse in">
                                  
                                <!--widget start-->
                                <aside class="panel-body profile-nav alt blue-border">
                                  <section class="panel ">
                                    <ul class="nav nav-pills nav-stacked ">
                                      <?
                                        $query="SELECT * FROM actividades WHERE '".$fecha."' BETWEEN date(fecha_hora_inicio) AND date(fecha_hora_fin) ";
                                        
                                        if(isset($_POST['search']) && $_POST['search']!=""){
                                          $query.=" and actividad like '%".$_POST['search']."%' ";
                                        }
                                        $array_actividades = array();
                                        $query.=" order by fecha_hora_inicio asc";
                                        $actividades=$bd->ExecuteE($query);

                                        foreach ($actividades as &$actividad) {

                                        if( $fecha_hora_actual>=date("Y-m-d H:i", strtotime($actividad['fecha_hora_inicio'])) &&  $fecha_hora_actual<date("Y-m-d H:i", strtotime($actividad['fecha_hora_fin']))){
                                          $activo="active";
                                        }else{
                                          $activo="";
                                        }
                                        


                                      $html_actividad="";
                                        ?>
                                        <?
                                          $html_actividad.='<a href="./?action=actividad&id='.$actividad['id'].'&view&cat='.$actividad['categoria_id'].'" >';
                                          $html_actividad.='  <span  class="badge  pull-right  ">';
                                              if(date("Y-m-d", strtotime($actividad['fecha_hora_inicio'])) != date("Y-m-d", strtotime($actividad['fecha_hora_fin']))){?>
                                                <?$html_actividad.='<i class="fa fa-calendar"></i>'; ?>
                                                <?$html_actividad.=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_inicio']))));?>
                                                 <?$html_actividad.=' - '; ?>
                                                <?$html_actividad.=ucfirst(utf8_encode(strftime("%a %H:%M %P",strtotime($actividad['fecha_hora_fin']))));?> 
                                                <?}else{?> 
                                                  <?$html_actividad.='<i class="fa fa-clock-o"></i>';?> 
                                                  <?$html_actividad.=' '.date("H:i a", strtotime($actividad['fecha_hora_inicio']));?> 
                                                  <?}?>
                                          <?$html_actividad.='  </span>';
                                          $html_actividad.='  <i class="fa fa-calendar text-primary"></i>';
                                            $html_actividad.=$actividad["actividad"];
                                            
                                          $actividad['salon']="";
                                          if($actividad['lugar']!=0){
                                            $query_s="SELECT * FROM salones WHERE id=".$actividad['lugar'];
                                            $res_salon=$bd->ExecuteE($query_s);
                                            foreach ($res_salon as &$salon){
                                              $actividad['salon']=$salon['salon'];
                                            }
                                          }
                                          ?>
                                          <?
                                          $html_actividad.='<span  class="text-primary">';
                                          $html_actividad.='&nbsp;<i class="fa fa-map-marker text-muted"></i> ';
                                          $html_actividad.=' '.$actividad['salon'];
                                          $html_actividad.='</span>';
                                          $html_actividad.='</a>';
                                        $html_actividad.='</li>';
                                        
                                        $key=verificar($array_actividades, strtotime($actividad['fecha_hora_inicio']));
                                        $html_actividad='<li class="f'.$key.' '.$activo.'">'.$html_actividad;
                                        $array_actividades=$array_actividades+array($key=>$html_actividad); 
                                        if ($activo=="active") {
                                              $posicion="f".$key;
                                          }
                                        //echo $html_actividad;
                                        ?>
                                        <!---------conferencias------------>
                                        
                                        <?
                                        $query="SELECT c.id, c.conferencia, c.fecha_hora_inicio, c.fecha_hora_fin, c.profesor_id, c.descripcion FROM conferencias as c  WHERE c.activo=1 and c.actividad_id=".$actividad['id'];
                
                                        $conferencias=$bd->ExecuteE($query);
                                        $i=0;
                                        foreach ($conferencias as &$conferencia){
                                          $html_conferencia="";
                                          $conferencia['profesor']="";
                                        if($conferencia['profesor_id']!=0){
                                          $query_p="SELECT * FROM profesores WHERE id=".$conferencia['profesor_id'];
                                          $res_profe=$bd->ExecuteE($query_p);
                                          foreach ($res_profe as &$profesor){
                                            $conferencia['profesor']=$profesor['nombre'];
                                          }
                                        }
                                        if( $fecha_hora_actual>=date("Y-m-d H:i", strtotime($conferencia['fecha_hora_inicio'])) &&  $fecha_hora_actual<date("Y-m-d H:i", strtotime($conferencia['fecha_hora_fin']))){
                                          $activo="active";
                                        }else{
                                          $activo="";
                                        }
                                        
                                              $html_conferencia.='<a href="./?action=actividad&id='.$actividad['id'].'&view&cat='.$actividad['categoria_id'].'&conf">';
                                              $html_conferencia.='&nbsp;&nbsp;<span  class="badge  pull-right  ">';
                                              $html_conferencia.='      <i class="fa fa-clock-o"></i> ';
                                              $html_conferencia.=' '.date("H:i a", strtotime($conferencia['fecha_hora_inicio']));

                                              $html_conferencia.='</span> ';
                                              $html_conferencia.='  <i class="fa fa-bullhorn text-primary"></i>';
                                              $html_conferencia.=' '.$conferencia['conferencia'];
                                              $html_conferencia.=' <span  class="text-primary">';
                                               
                                                if($conferencia['profesor_id']!=0){
                                               
                                              $html_conferencia.='    &nbsp;<i class="fa fa-user-md text-muted"></i>';
                                              $html_conferencia.=' '.$conferencia['profesor'].' | ';
                                                }
                                              $html_conferencia.='    &nbsp;<i class="fa fa-map-marker text-muted"></i>';
                                              $html_conferencia.=' '.$actividad['salon'];
                                              $html_conferencia.='</span>';
                                              
                                            $html_conferencia.='</a>';
                                          $html_conferencia.='</li> ';                                 
                                        

                                        $key=verificar($array_actividades, strtotime($conferencia['fecha_hora_inicio']));
                                        $html_conferencia='<li  class="f'.$key.' '.$activo.'">'.$html_conferencia;
                                          
                                        $array_actividades=$array_actividades+array($key=>$html_conferencia); 
                                        if ($activo=="active") {
                                              $posicion="f".$key;
                                          }
                                        //echo $html_conferencia;
                                        }?>
                                        
                                        <!---------fin conferencias---------->
                                        
                                        <?
                                        }
                                        ksort($array_actividades);
                                        
                                        foreach ($array_actividades as $key => $actividadx) {
                                          echo $actividadx;
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
//funcion para ver si hay fechas repeditas
                                        function verificar($arrray, $key)
                                        {
                                          if (array_key_exists($key, $arrray)) {
                                              $key=$key+1;
                                              $key=verificar($arrray, $key);
                                          }
                                            return $key;
                                          

                                        }
                                        //----------------------------------------
 ?>                     <!--collapse end-->
</div>

