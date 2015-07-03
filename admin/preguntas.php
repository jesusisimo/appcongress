                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Preguntas</h1>
                              </div>
                              <a href="./?action=preguntas&add&examen=<?=$_GET['examen']?>" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar pregunta</a>
                              <a href="./?action=examenes&view" class="btn btn-sm btn-info pull-right"> Volver examenes</a>
                          </div>

                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Pregunta</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM preguntas WHERE examen_id=".$_GET['examen']."  order by id asc ";
                                $preguntas=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($preguntas as &$pregunta) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($pregunta[pregunta])?></td>
                                    <td><? if($pregunta[tipo]==1){?>Opcion multiple<?}else{?>Abierta<?}?></td>
                                    <td>
                                      <a href="./?action=opciones&view&pregunta=<?=$pregunta[id]?>" class="btn btn-xs btn-success" ><i class="fa fa-list-ol"></i></a>  
                                      <a href="./?action=preguntas&edit&id=<?=$pregunta[id]?>&examen=<?=$_GET['examen']?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=preguntas&delete&id=<?=$pregunta[id]?>&examen=<?=$_GET['examen']?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                               
                              <?
                              }
                              ?>
                              </tbody>
                          </table>
                      </section>
                      

                        <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Estadisticas</h1>
                              </div>
                          </div>

                          

                              <?
                                $query="SELECT * FROM preguntas WHERE examen_id=".$_GET['examen']." order by id asc";
                                $preguntas=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($preguntas as &$pregunta) {
                                  $i++;
                              ?>
                                <?
                                  $query="SELECT * FROM opciones WHERE pregunta_id=".$pregunta['id'];
                                  $opciones=$bd->ExecuteE($query);
                                ?>
                                 <!---------------------------------------------------------------------------------------->
                                                        <!--work progress end-->
                                <div class="flot-chart">
                                <!-- page start-->
                                
                               <script>
                                          var data_<?=$i?> = [
                                        <?
                                          foreach ($opciones as &$opcion) {
                                            
                                                  $query="SELECT count(*) as total FROM resultados where opcion_id=".$opcion[id];
                                                  $totales=$bd->ExecuteE($query);
                                                  $totalx=0;
                                                  foreach ($totales as &$total) {
                                                    $totalx= $total['total'];
                                                  }
                                                
                                        ?>
                                         { label: "<?=$opcion['opcion']?>, <?= $totalx?> votos",  data: <?=$totalx?>},
                                         <?}?>
                                         ];

                                    </script>
                            
                            
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <section class="panel">
                                                <header class="panel-heading">
                                                    <?=$i?> <?=$pregunta['pregunta']?>
                                                </header>
                                                <div class="panel-body">
                                                <!---------------------------------------------------->
                                                <table class="table table-hover table-advance">
                                                  <thead>
                                                    <th>#</th>
                                                    <th>Opcion</th>
                                                    <th>Votos</th>
                                                    <th></th>
                                                  </thead>
                                                  <tbody>

                                                  <?
                                                    $query="SELECT * FROM opciones WHERE pregunta_id=".$pregunta['id']." order by id asc";
                                                    $opciones=$bd->ExecuteE($query);
                                                    $o=0;
                                                    foreach ($opciones as &$opcion) {
                                                      $o++;
                                                  ?>
                                                    <tr>
                                                        <td><?=$o?></td>
                                                        <td><?=($opcion[opcion])?></td>
                                                        <td>
                                                          <?
                                                            $query="SELECT count(*) as total FROM resultados where opcion_id=".$opcion[id];
                                                            $totales_o=$bd->ExecuteE($query);
                                                            foreach ($totales_o as &$total_o) {
                                                              echo $total_o['total'];
                                                            }
                                                          ?>
                                                        </td>
                                                        <td><?if($opcion[correcta]==1){?><p class="text-success">Correcta</p><?}else{?><p class="text-danger">Incorrecta</p><?}?></td>                                    
                                                       
                                                    </tr>
                                                  <?
                                                  }
                                                  ?>
                                                  </tbody>
                                              </table>
                                                <!---------------------------------------------------->
                                                  <?
                                                    if( $pregunta['tipo']==2){
                                                  ?>
                                                  <table class="table">
                                                   
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Respuesta</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                      $query="SELECT * FROM resultados where pregunta_id=".$pregunta['id'];
                                                      $extras=$bd->ExecuteE($query);
                                                      $j=0;

                                                      $opcion_extra="";
                                                      foreach ($extras as &$extra) {
                                                        if($extra['extra']!=""){
                                                        $j++;
                                                        
                                                        if($extra['opcion_id']!=0){
                                                          $query="SELECT * FROM opciones WHERE id=".$extra['opcion_id'];
                                                          $opcionese=$bd->ExecuteE($query);
                                                          foreach ($opcionese as &$opcione) {
                                                            $opcion_extra=$opcione['opcion'].":";
                                                          }
                                                        }
                                                     ?>
                                                      <tr>
                                                        <td><?=$j;?></td>
                                                        <td><?=$opcion_extra." ".$extra['extra']?></td>
                                                      </tr>
                                                    <?}}?>
                                                    </tbody>
                                                  </table>
                                                  <?
                                                    }
                                                    
                                                  ?>
                                                    <div id="graph<?=$i?>" class="chart"></div>
                                              
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <!-- page end-->
                                </div>
                                  <!---------------------------------------------------------------------------------------->
                               
                              <?
                              }
                              ?>
                             
                      </section>






                      <?
                      }elseif (isset($_GET[add])) {
                        ?>                              
                      <section class="panel">
                        <header class="panel-heading">
                              Agregar pregunta
                              <a href="./?action=preguntas&view&examen=<?=$_GET['examen']?>" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver preguntas</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-pregunta" role="form" method="post" action="save.php?action=preguntas&add">
                                <div class="form-group">
                                    <label for="pregunta" class="col-lg-2 col-sm-2 control-label">Pregunta</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="pregunta" name="pregunta" placeholder="" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="examen_id" class="col-lg-2 col-sm-2 control-label">Examen</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="examen_id"  name="examen_id" required>
                                          <option value="">Elige examen</option>
                                          
                                             <?
                                                $query="SELECT * FROM examenes";
                                                $examenes=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($examenes as &$examen) {
                                                $i++;
                                            ?>
                                            <option <?if($_GET['examen']==$examen[id]){?> selected <?}?>  value="<?=($examen[id])?>"> <?=($examen[nombreexamen])?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profesor_id" class="col-lg-2 col-sm-2 control-label">Quien realiza la pregunta?</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="profesor_id"  name="profesor_id" required>
                                          <option value="0">Elige profesor</option>
                                          
                                             <?
                                                $query="SELECT * FROM profesores";
                                                $profesores=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($profesores as &$profesor) {
                                                $i++;
                                            ?>
                                            <option  value="<?=$profesor['id']?>"> <?=$profesor[nombre]?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-10">
                                    <div class="checkbox">
                                      <label>
                                      <input type="checkbox"  name="multiple" checked>
                                        Marca si es multiple / desmarca si es abierta
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-danger">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </section>
                        <?
                      }elseif (isset($_GET[edit])) {
                        $query="SELECT *FROM preguntas WHERE id=".$_GET[id];
                        $preguntas=$bd->ExecuteE($query);
                        foreach ($preguntas as &$pregunta) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar pregunta
                              <a href="./?action=preguntas&view&examen=<?=$_GET['examen']?>" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver preguntas</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-pregunta" role="form" method="post" action="save.php?action=preguntas&edit">
                                <div class="form-group">
                                    <label for="pregunta" class="col-lg-2 col-sm-2 control-label">Pregunta</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="pregunta" name="pregunta" placeholder="" value="<?=($pregunta[pregunta])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="examen_id" class="col-lg-2 col-sm-2 control-label">Examen</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="examen_id"  name="examen_id" required>
                                          <option value="">Elige examen</option>
                                          
                                             <?
                                                $query="SELECT * FROM examenes";
                                                $examenes=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($examenes as &$examen) {
                                                $i++;
                                            ?>
                                            <option <?if($pregunta['examen_id']==$examen[id]){?> selected <?}?>  value="<?=($examen[id])?>"> <?=($examen[nombreexamen])?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profesor_id" class="col-lg-2 col-sm-2 control-label">Quien realiza la pregunta?</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="profesor_id"  name="profesor_id" required>
                                          <option value="0">Elige profesor</option>
                                          
                                             <?
                                                $query="SELECT * FROM profesores";
                                                $profesores=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($profesores as &$profesor) {
                                                $i++;
                                            ?>
                                            <option <?if($pregunta['profesor']==$profesor[id]){?> selected <?}?>  value="<?=$profesor['id']?>"> <?=$profesor[nombre]?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-10">
                                    <div class="checkbox">
                                      <label>
                                      <input type="checkbox"  name="multiple" <?if($pregunta['tipo']==1){?> checked <?}?>>
                                        Marca si es multiple / desmarca si es abierta
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$pregunta[id]?>">
                                        <button type="submit" class="btn btn-danger">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </section>
                        <?
                      }
                      }
                      ?>
                  </div>
              </div>
  

   <!--script for this page only-->
