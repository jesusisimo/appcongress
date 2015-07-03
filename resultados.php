          <div class="col-lg-12 ">
            <section class="panel panel-heading inbox-head header-profesores" >
              <?
                      $sql_examen  = "SELECT * FROM examenes where id=".base64_decode($_GET['id']);
                      $res_examen  = $bd->ExecuteE($sql_examen);
                      $examen="";
                      foreach ($res_examen as &$exa) {
                        $examen=$exa;
                      }
                  ?>
              <h3 class=""> <a class="btn btn-white" href="./?action=evaluaciones"><i class="fa fa-arrow-left"></i></a> Resultados <?=($examen['nombreexamen'])?></h3>
            </section>
          </div>
               

                <div class="col-lg-12">

                	<div class="border-head">
		                  
                      <section class="panel">
                        <header class="panel-heading color-headchat">
                           Instrucciones
                        </header>
                        <div class="panel-body">                        
                          <span class="btn-success">Elección correcta</span>
                          <span class="btn-danger">Elección incorrecta</span>
                          <span class="btn-info">Opción correcta</span>

                        </div>
		            </div>
                <?
                    $sql_resultados  = "SELECT *FROM resultados where examen_id=".base64_decode($_GET['id'])." and usuario_id=".$_SESSION['usuario']['id']." order by pregunta_id asc, intento desc";
                    $res_resultados  = $bd->ExecuteE($sql_resultados);
                    $i=0;
                    foreach ($res_resultados as &$resultado) {
                    $i++;
                  $sql_preguntas  = "SELECT *FROM preguntas where activo=1 and id=".$resultado['pregunta_id'];
                  $res_preguntas  = $bd->ExecuteE($sql_preguntas);
                  foreach ($res_preguntas as &$pregunta) {
                    
                  ?>

						      <section class="panel">
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
                             
                                  </div>
                                <? $j++;}?>

                                <?if($pregunta['tipo']==2){?>
                                    <input type="text" name="res" class="form-control" disabled value="<?=($resultado['extra'])?>" >
                                <?}?>
                              </div>

                                          
                          </div>                                       
                    </section>     

                <?
                  }}
                ?>
             </div>	