                <div class="row">
                  <div class="col-lg-12">
                     
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Estadisticas de examenes</h1>
                              </div>
                              <a href="./?action=examenes&view" class="btn btn-sm btn-info pull-right"> Volver a examenes</a>
                          </div>
                      </section>
                      
                      <?
                        $query="SELECT * FROM examenes  WHERE id!=1 order by id asc";
                        $examenes=$bd->ExecuteE($query);
                        $e=0;
                        foreach ($examenes as &$examen) {
                          $e++;
                      ?>
                        <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1><?=$examen['nombreexamen']?></h1>
                              </div>
                          </div>

                          

                              <?
                                $query="SELECT * FROM preguntas WHERE examen_id=".$examen['id']." order by id asc";
                                $preguntas=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($preguntas as &$pregunta) {
                                  $i++;
                                  $opciones=null;
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
                                          var data_<?=$e?>_<?=$i?> = [
                                        <?
                                          foreach ($opciones as &$opcion) {
                                            
                                                  $query="SELECT count(*) as total FROM resultados where opcion_id=".$opcion['id'];
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
                                                        <td><?=($opcion['opcion'])?></td>
                                                        <td>
                                                          <?
                                                            $query="SELECT count(*) as total FROM resultados where opcion_id=".$opcion['id'];
                                                            $totales_o=$bd->ExecuteE($query);
                                                            foreach ($totales_o as &$total_o) {
                                                              echo $total_o['total'];
                                                            }
                                                          ?>
                                                        </td>
                                                        <td><?if($opcion['correcta']==1){?><p class="text-success">Correcta</p><?}else{?><p class="text-danger">Incorrecta</p><?}?></td>                                    
                                                       
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
                                                    <div id="graph_<?=$e?>_<?=$i?>" class="chart"></div>
                                              
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
                      <?}?>
                  </div>
              </div>
  

   <!--script for this page only-->
