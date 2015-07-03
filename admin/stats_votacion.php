                <div class="row">
                  <div class="col-lg-12">
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Estadisticas de votaciones</h1>
                              </div>
                              <a href="./?action=votaciones&view" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Regresar</a>
                          </div>
                      </section>
                      <!--work progress end-->
                      <?
                      $query="SELECT * FROM votaciones";
                      $votaciones=$bd->ExecuteE($query);
                      $v=0;
                      foreach ($votaciones as &$votacion) {
                        $v++;
                              
                      ?>
                      <div class="flot-chart">
                  <!-- page start-->
                          <section class="panel">
                              <header class="panel-heading">
                                  <?=$v?>.- <?=$votacion['titulo']?>
                              </header>
                              <div class="panel-body">
                                  <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Opcion</th>
                                <th>Votos</th>
                              </thead>
                              <tbody>

                              <?
                                $query="SELECT ov.opcion, ov.correcta, ov.id FROM opciones_votacion as ov INNER JOIN votaciones as v on v.id=ov.votacion_id WHERE v.id=".$votacion['id'];
                                $opciones=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($opciones as &$opcion) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($opcion['opcion'])?></td>
                                    <td>
                                      <?
                                        $query="SELECT count(*) as total FROM resultados_votacion where eleccion=".$opcion['id'];
                                        $totales=$bd->ExecuteE($query);
                                        foreach ($totales as &$total) {
                                          echo $total['total'];
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
                          <?
                                $query="SELECT ov.opcion, ov.correcta, ov.id FROM opciones_votacion as ov INNER JOIN votaciones as v on v.id=ov.votacion_id WHERE v.id=".$votacion['id'];
                                $opciones=$bd->ExecuteE($query);
                              ?>
                 <script>
                            var data_<?=$v?> = [
                              <?
                                foreach ($opciones as &$opcion) {
                                  
                                        $query="SELECT count(*) as total FROM resultados_votacion where eleccion=".$opcion['id'];
                                        $totales=$bd->ExecuteE($query);
                                        $totalx=0;
                                        foreach ($totales as &$total) {
                                          $totalx= $total['total'];
                                        }
                                      
                              ?>
                               { label: "<?=$opcion['opcion']?>",  data: <?=$totalx?>},
                               <?}?>
                               ];

                          </script>
                                  <div id="graph_<?=$v?>" class="chart"></div>
                              </div>
                          </section>
                  </div>
                <?}?>     
            </div>
        </div>
  

   <!--script for this page only-->
