              <?
              if(isset($_GET['usuario'])){
                $sql_usuarios  = "SELECT *FROM usuarios where id=".$_GET['usuario'];
              }else{
                $sql_usuarios  = "SELECT *FROM usuarios where id!=1 and id>=1<100";
              }
                 
                      $res_usuarios  = $bd->ExecuteE($sql_usuarios);
                      foreach ($res_usuarios as &$usuario) {
              ?>
                <div class="col-lg-12">
                   <section class="panel">
                    <div class="border-head">
                        <header class="panel-heading">
                           <h1 class="title">Evaluaciones de <?=$usuario['nombre']?> <?=$usuario['apellidos']?></h1>
                        </header>
                    </div>
                  </section>
                </div>
                 
                  <?
                      $sql_contestadas  = "SELECT * FROM contestadas where usuario_id=".$usuario['id'];
                      $res_contestadas  = $bd->ExecuteE($sql_contestadas);
                      foreach ($res_contestadas as &$contestada) {
                     
                      $sql_examenes  = "SELECT *FROM examenes where id=".$contestada['examen_id'];
                      $res_examenes  = $bd->ExecuteE($sql_examenes);
                      foreach ($res_examenes as &$examen) {}
                  ?>
               
                <div class="col-lg-12">
                
                <section class="panel">
                	<div class="border-head">
		                  
                        <header class="panel-heading color-headchat">
                           <h1 class="btn btn-success btn-lg btn-block"><?=$examen['nombreexamen']?></h1>
                        </header>
                        <div class="panel-body">                        
                          <span class="btn-success">Elección correcta</span>
                          <span class="btn-danger">Elección incorrecta</span>
                          <span class="btn-info">Opción correcta</span>
                        </div>
		            </div>
                <?
                    $sql_resultados  = "SELECT *FROM resultados where examen_id=".$examen['id']." and usuario_id=".$usuario['id']." order by pregunta_id asc, intento desc";
                    $res_resultados  = $bd->ExecuteE($sql_resultados);
                    $i=0;
                    foreach ($res_resultados as &$resultado) {
                    $i++;
                  $sql_preguntas  = "SELECT *FROM preguntas where activo=1 and id=".$resultado['pregunta_id'];
                  $res_preguntas  = $bd->ExecuteE($sql_preguntas);
                  foreach ($res_preguntas as &$pregunta) {
                    
                  ?>
                        <header class="panel-heading color-headchat">
                            Pregunta <?=$i?> | Intento <?=$resultado['intento']?>
                         </header>
                          <div class="panel-body">
                              <div class="preg-mod"><?=($pregunta['pregunta'])?></div>
                              <div class="radios">
                              <input type="hidden" name="pregunta_<?=$pregunta['id']?>" value="<?=$pregunta['id']?>">
                                    
                                <?
                                $sql_opciones  = "SELECT *FROM opciones where pregunta_id=".$pregunta['id'];
                                $res_opciones  = $bd->ExecuteE($sql_opciones);
                                $incisos=array("a)","b)","c)","d)","e)","f)");
                                $j=0;
                                foreach ($res_opciones as &$opcion) { 
                                ?>
                                  
                                  <div class="radio">
                                    <span class="<? if($resultado['opcion_id']==$opcion['id'] and $opcion['correcta']==0 ){ ?>btn-danger<?}    if($opcion['correcta']==1){ if($resultado['opcion_id']==$opcion['id']){ ?>btn-success<?}else{    ?> btn-info   <?}}?>  " ><?=$incisos[$j]?> <?=($opcion['opcion'])?></span>
                                    <? if($resultado['opcion_id']==$opcion['id'] and $opcion['correcta']==0 ){ ?>(Incorrecta)<?}    if($opcion['correcta']==1){ if($resultado['opcion_id']==$opcion['id']){ ?>(Correcta)<?}}?>
                                  </div>
                                <? $j++;}?>

                                <?if($pregunta['tipo']==2){?>
                                    <input type="text" name="res" class="form-control" disabled value="<?=($resultado['extra'])?>" >
                                <?}?>
                              </div>

                                          
                          </div>                                       
                      

                <?
                  }}
                ?>
                </section>   
             </div>	
        <?}
      }?>