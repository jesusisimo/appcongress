                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                              <?
                                $query="SELECT * FROM preguntas WHERE id=".$_GET['pregunta'];
                                $preguntas=$bd->ExecuteE($query);
                                foreach ($preguntas as &$pregunta) {
                              ?>
                                  <h1><?=$pregunta['pregunta']?></h1>
                              <?}?>
                              </div>
                              <a href="./?action=opciones&add&pregunta=<?=$_GET['pregunta']?>" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i>Agregar opcion </a>
                              &nbsp;<a href="./?action=preguntas&view&examen=<?=$pregunta['examen_id']?>" class="btn btn-sm btn-info pull-right"> Volver a preguntas</a>
                  
                          </div>

                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Opcion</th>
                                <th>Votos</th>
                                <th></th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>

                              <?
                                $query="SELECT * FROM opciones WHERE pregunta_id=".$_GET['pregunta']." order by id asc";
                                $opciones=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($opciones as &$opcion) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($opcion[opcion])?></td>
                                    <td>
                                      <?
                                        $query="SELECT count(*) as total FROM resultados_votacion where eleccion=".$opcion[id];
                                        $totales=$bd->ExecuteE($query);
                                        foreach ($totales as &$total) {
                                          echo $total['total'];
                                        }
                                      ?>
                                    </td>
                                    <td><?if($opcion[correcta]==1){?><p class="text-success">Correcta</p><?}else{?><p class="text-danger">Incorrecta</p><?}?></td>                                    
                                    <td>
                                      <a href="./?action=opciones&edit&id=<?=$opcion[id]?>&pregunta=<?=$_GET['pregunta']?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=opciones&delete&id=<?=$opcion[id]?>&pregunta=<?=$_GET['pregunta']?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                              <?
                              }
                              ?>
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->
                      <div class="flot-chart">
                  <!-- page start-->
                  <?
                                $query="SELECT o.opcion, o.correcta, o.id FROM opciones as o INNER JOIN preguntas as p on p.id=o.pregunta_id WHERE p.id=".$_GET['pregunta'];
                                $opciones=$bd->ExecuteE($query);
                              ?>
                 <script>
                            var data = [
                              <?
                                foreach ($opciones as &$opcion) {
                                  
                                        $query="SELECT count(*) as total FROM resultados where opcion_id=".$opcion[id];
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
                  
                  
                  <div class="row">
                      <div class="col-lg-12">
                          <section class="panel">
                              <header class="panel-heading">
                                  Estadisticas
                              </header>
                              <div class="panel-body">
                                  <div id="graph2" class="chart"></div>
                              </div>
                          </section>
                      </div>
                  </div>
                  <!-- page end-->
              </div>
                      <?
                      }elseif (isset($_GET[add])) {
                        ?>                              
                      <section class="panel">
                        <header class="panel-heading">
                              Agregar opción
                              <a href="./?action=opciones&view&pregunta=<?=$_GET['pregunta']?>" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver opciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-opcion" role="form" method="post" action="save.php?action=opciones&add">
                                <div class="form-group">
                                    <label for="opcion" class="col-lg-2 col-sm-2 control-label">Opción</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="opcion" name="opcion" placeholder="" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pregunta_id" class="col-lg-2 col-sm-2 control-label">Pregunta</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="pregunta_id"  name="pregunta_id" required>
                                          <option value="">Elige pregunta</option>
                                          
                                             <?
                                                $query="SELECT * FROM preguntas";
                                                $preguntas=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($preguntas as &$pregunta) {
                                                $i++;
                                            ?>
                                            <option <?if($_GET['pregunta']==$pregunta[id]){?> selected <?}?>  value="<?=($pregunta[id])?>"> <?=($pregunta[pregunta])?> </option>
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
                                      <input type="checkbox"  name="correcta">
                                        Correcta
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
                        $query="SELECT *FROM opciones WHERE id=".$_GET[id];
                        $opciones=$bd->ExecuteE($query);
                        foreach ($opciones as &$opcion) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar opción
                              <a href="./?action=opciones&view&pregunta=<?=$_GET['pregunta']?>" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver opciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-opcion" role="form" method="post" action="save.php?action=opciones&edit">
                                <div class="form-group">
                                    <label for="opcion" class="col-lg-2 col-sm-2 control-label">Opcion</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="opcion" name="opcion" placeholder="" value="<?=($opcion[opcion])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pregunta_id" class="col-lg-2 col-sm-2 control-label">Pregunta</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="pregunta_id"  name="pregunta_id" required>
                                          <option value="">Elige pregunta</option>
                                          
                                             <?
                                                $query="SELECT * FROM preguntas";
                                                $preguntas=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($preguntas as &$pregunta) {
                                                $i++;
                                            ?>
                                            <option <? if($opcion[pregunta_id]==$pregunta[id]){?> selected <?}?>  value="<?=($pregunta[id])?>"> <?=($pregunta[pregunta])?> </option>
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
                                      <input type="checkbox" <?if($opcion[correcta]==1){?>checked <?}?>  name="correcta">
                                        Correcta
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$opcion[id]?>">
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
