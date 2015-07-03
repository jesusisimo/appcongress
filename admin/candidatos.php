                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Opciones</h1>
                              </div>
                              <a href="./?action=candidatos&add&votacion=<?=$_GET['votacion']?>" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar opcion</a>
                          </div>

                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Opcion</th>
                                <th>Votos</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>

                              <?
                                $query="SELECT ov.opcion, ov.correcta, ov.id FROM opciones_votacion as ov INNER JOIN votaciones as v on v.id=ov.votacion_id WHERE v.id=".$_GET['votacion'];
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
                                      <a href="./?action=candidatos&edit&id=<?=$opcion[id]?>&votacion=<?=$_GET['votacion']?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=candidatos&delete&id=<?=$opcion[id]?>&votacion=<?=$_GET['votacion']?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                                $query="SELECT ov.opcion, ov.correcta, ov.id FROM opciones_votacion as ov INNER JOIN votaciones as v on v.id=ov.votacion_id WHERE v.id=".$_GET['votacion'];
                                $opciones=$bd->ExecuteE($query);
                              ?>
                 <script>
                            var data = [
                              <?
                                foreach ($opciones as &$opcion) {
                                  
                                        $query="SELECT count(*) as total FROM resultados_votacion where eleccion=".$opcion[id];
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
                                  Pie Chart
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
                              <a href="./?action=candidatos&view&votacion=<?=$_GET['votacion']?>" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver opciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-cadidato" role="form" method="post" action="save.php?action=candidatos&add">
                                <div class="form-group">
                                    <label for="opcion" class="col-lg-2 col-sm-2 control-label">Opción</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="opcion" name="opcion" placeholder="" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="votacion_id" class="col-lg-2 col-sm-2 control-label">Pregunta</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="votacion_id"  name="votacion_id" required>
                                          <option value="">Elige pregunta</option>
                                          
                                             <?
                                                $query="SELECT * FROM votaciones";
                                                $votaciones=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($votaciones as &$votacion) {
                                                $i++;
                                            ?>
                                            <option <?if($_GET['votacion']==$votacion[id]){?> selected <?}?>  value="<?=($votacion[id])?>"> <?=($votacion[titulo])?> </option>
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
                        $query="SELECT *FROM opciones_votacion WHERE id=".$_GET[id];
                        $opciones=$bd->ExecuteE($query);
                        foreach ($opciones as &$opcion) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar opción
                              <a href="./?action=candidatos&view&votacion=<?=$_GET['votacion']?>" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver opciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-votacion" role="form" method="post" action="save.php?action=candidatos&edit">
                                <div class="form-group">
                                    <label for="opcion" class="col-lg-2 col-sm-2 control-label">Opcion</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="opcion" name="opcion" placeholder="" value="<?=($opcion[opcion])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="votacion_id" class="col-lg-2 col-sm-2 control-label">Pregunta</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="votacion_id"  name="votacion_id" required>
                                          <option value="">Elige pregunta</option>
                                          
                                             <?
                                                $query="SELECT * FROM votaciones";
                                                $votaciones=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($votaciones as &$votacion) {
                                                $i++;
                                            ?>
                                            <option <? if($opcion[votacion_id]==$votacion[id]){?> selected <?}?>  value="<?=($votacion[id])?>"> <?=($votacion[titulo])?> </option>
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
