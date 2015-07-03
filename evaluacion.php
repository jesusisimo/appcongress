<?
  if (isset($_GET['id']) && $_GET['id']!="") {
    $_GET['id']=base64_decode($_GET['id']);
  }
  if (isset($_SESSION['examen']['id']) && $_SESSION['examen']['id']!="") {
    $_GET['id']=$_SESSION['examen']['id'];
  }
  $contestada=0;
  $habilitado=1;
  $sql_habilitado  = "SELECT habilitado FROM examenes where id=".($_GET['id'])." limit 1";
  $res_habilitado  = $bd->ExecuteE($sql_habilitado);
  foreach ($res_habilitado as &$res_habilitado) {
    if($res_habilitado['habilitado']==0){
      $habilitado=0;
    }
  }
  $sql_contestadas  = "SELECT count(*) as contestada FROM contestadas where usuario_id=".$_SESSION['usuario']['id']." and examen_id=".($_GET['id']);
  $res_contestadas = $bd->ExecuteE($sql_contestadas);
  foreach ($res_contestadas as &$res_contestada) {
    if($res_contestada['contestada']==1){
      $contestada=1;
    }
  }

  date_default_timezone_set('America/Mexico_City');
  if(isset($_POST['start']) && !isset($_SESSION['examen']['start'])){
    $_SESSION['examen']['start']=true;
    $_SESSION['examen']['id']=$_POST['examen'];

    $_SESSION['examen']['fecha_inicio']=date("Y-m-d");
    $_SESSION['examen']['hora_inicio']=date("H:i:s");

    $fecha_hora_fin = strtotime ( '+'.$_POST['duracion'].' minute' , strtotime ( date("Y-m-d H:i:s") ) ) ;
    $_SESSION['examen']['fecha_fin'] = date ( 'Y-m-d' , $fecha_hora_fin );
    $_SESSION['examen']['hora_fin2'] = date ( 'H:i:s' , $fecha_hora_fin );

    $_SESSION['examen']['hora_fin'] = date("Y-m-d H:i:s",strtotime ( '+'.$_POST['duracion'].' minute' , strtotime ( date("Y-m-d  H:i:s") ) ) );
  }

?>
  
         <div class="col-lg-12 ">
            <section class="panel panel-heading inbox-head header-profesores" >
            <?
                              $sql_examen  = "SELECT * FROM examenes where id=".($_GET['id']);
                              $res_examen  = $bd->ExecuteE($sql_examen);
                              $examen="";
                              foreach ($res_examen as &$exa) {
                                $examen=$exa;
                              }
                          ?>
                      
              <h4 class=""><a class="btn btn-white" href="./?action=evaluaciones"><i class="fa fa-arrow-left"></i></a> <?=($examen['nombreexamen'])?></h4>
            </section>
          </div>
          <div class="col-lg-12">

		            <section class="panel">
                        <header class="panel-heading color-headchat">
                          <?if(isset($_SESSION['examen']['start'])){?>
                          <a class="btn btn-xs btn-success pull-right" href="cancelarExamen.php">Contestar mas tarde</a>
                          <?}?>
                           Instrucciones
                        </header>
                        <div class="panel-body">                        
                        	<?=($examen['instrucciones'])?>
                          <hr>
                          <div>Número de preguntas: <?=($examen['preguntasactivas'])?></div>
                          <div>Duración: <?=($examen['duracion'])?> minutos.</div>
                          <?if(isset($_SESSION['examen']['start'])){?>
                          <p id="counter" class="counter text-danger"></p>
                          <?}?>
                        </div>
                        <?
                          if( !isset($_SESSION['examen']['start']) && $contestada==0 && $habilitado==1){
                        ?>
                        <div class="panel-body">
                        <form action="" method="post" data-toggle="validator"   >
                        	<input type="hidden" name="start" value="1">
                          <input type="hidden" name="duracion" value="<?=$examen['duracion']?>">
                          <input type="hidden" name="examen" value="<?=$examen['id']?>">
                          <button type="submit" class="btn btn-round btn-warning" style="width:100%; height:40px; font-size:16px">Comenzar Evaluación</button>
                        </form>
                        </div>
                        <?}?>
                    </section>
						            <?
                          if(isset($_SESSION['examen']['start']) && $contestada==0 && $habilitado==1){
                        ?>
					 <form role="form" action="evaluar.php" method="POST" >
          <?
          if(!isset($_SESSION['examen']['preguntas'])){
            $sql_preguntas  = "SELECT *FROM preguntas where activo=1 and examen_id=".($_GET['id'])."  ORDER BY RAND() LIMIT ".$examen['preguntasactivas'];
            $res_preguntas  = $bd->ExecuteE($sql_preguntas);
            $ids_preguntas="0";
            foreach ($res_preguntas as &$pregunta) {
              $ids_preguntas.=",".$pregunta['id'];
            }
            $_SESSION['examen']['preguntas']=$ids_preguntas;
          }
          $sql_preguntas  = "SELECT *FROM preguntas where activo=1 and id in (".$_SESSION['examen']['preguntas'].")";
          $res_preguntas  = $bd->ExecuteE($sql_preguntas);
          $i=0;
          foreach ($res_preguntas as &$pregunta) {
            $sql_profesor  = "SELECT *FROM profesores where id = ".$pregunta['profesor'];
            $res_profesor  = $bd->ExecuteE($sql_profesor);
            $elaboro="";
            foreach ($res_profesor as &$profesor) {$elaboro=$profesor['nombre'];}
            $i++;
          ?>
               		<section class="panel">
               			<header class="panel-heading color-headchat">
                           <h5 class="text-primary"> <?=$i?>) <?=($pregunta['pregunta'])?></h5>
                         </header>
                          <div class="panel-body">
								              <div class="radios">
                              <input type="hidden" name="pregunta_<?=$pregunta['id']?>" value="<?=$pregunta['id']?>">
                                    
                                <?
                                $sql_opciones  = "SELECT *FROM opciones where pregunta_id=$pregunta[id]";
                                $res_opciones  = $bd->ExecuteE($sql_opciones);
                                $incisos=array("a)","b)","c)","d)","e)","f)");
                                $j=0;
                                foreach ($res_opciones as &$opcion) { 
                                ?>
                                  
                                  <div class="radio">
                                    <label class="" for="resultado_<?=$pregunta['id']?>_<?=$opcion['id']?>">
                                      <input name="resultado_<?=$pregunta['id']?>" id="resultado_<?=$pregunta['id']?>_<?=$opcion['id']?>" value="<?=$opcion['id']?>" type="radio" required /> <?=$incisos[$j]?> <?=($opcion['opcion'])?> 
                                    </label>
                                  </div>
                                <? $j++;}?>
                              <?if($pregunta['tipo']==2){?>
                              <input type="text" class="form-control" placeholder="escribe tu respuesta aquí" name="respuesta_open_<?=$pregunta['id']?>" >
                              <?}?>
                              </div>

                                          
                          </div>                                       
                    </section> 
                    <?}?>
                     <input type="hidden" name="examen" value="<?=$_GET['id']?>">
                
             <?}else{
              ?>
            <section class="panel panel-info contador morado">
              <div class="panel-body">
              <h3 class="text-danger">
                     
                <?if($habilitado==0){
                  echo "Esta evaluacion no esta disponible";
                }?>
                <?if($contestada==1){
                  echo "<br>Ya constestaste este examen anteriormente";
                }?>
                </h3>
              </div>
            </section>
              <?
              }?>
             <?if(isset($_SESSION['examen']['start']) && $contestada==0 && $habilitado==1){?>
                

                	<section class="panel panel-info contador morado">
                      <div class="panel-body">
                          <p id="counter" class="counter text-danger"></p>
                      </div>
                    </section>

                    <input type="submit" class="btn btn-shadow btn-success" style="width:100%; height:95px; font-size:20px" value="Enviar Respuestas">
                
				          <?}?>   
          </form>
          </div>


   
