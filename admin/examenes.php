                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Examenes y encuestas</h1>
                              </div>
                              <a href="./?action=examenes&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar</a>
                              <a href="./?action=stats_examen" class="btn btn-sm btn-info pull-right"><i class="fa fa-bar-chart-o"></i> Estadisticas</a>
                         
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Examen</th>
                                <th>Duracion (minutos)</th>
                                <th>Preguntas activas</th>
                                <th>instrucciones</th>
                                <th>Tipo</th>
                                 <th>Estatus</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM examenes ";
                                $examenes=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($examenes as &$examen) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($examen['nombreexamen'])?></td>
                                    <td><?=($examen['duracion'])?></td>
                                    <td><?=($examen['preguntasactivas'])?></td>
                                    <td><?=($examen['instrucciones'])?></td>
                                    <td><? if($examen['tipo']==1){?>Examen de conocimientos<?}else{?>Encuesta<?}?></td>
                                   
                                   
                                    <td><?if($examen[habilitado]==1){?><p class="text-success">Activo</p><?}else{?><p class="text-danger">Inactivo</p><?}?></td>                                    
                                    <td>
                                      <a href="./?action=preguntas&view&examen=<?=$examen[id]?>" class="btn btn-xs btn-success" ><i class="fa fa-list-ol"></i></a>  
                                      <a href="./?action=examenes&edit&id=<?=$examen[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=examenes&delete&id=<?=$examen[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                              <?
                              }
                              ?>
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->

                      <?
                      }elseif (isset($_GET[add])) {
                        ?>                              
                      <section class="panel">
                        <header class="panel-heading">
                              Crear examen
                              <a href="./?action=examenes&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver examenes</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-votacion" role="form" method="post" action="save.php?action=votaciones&add">
                                <div class="form-group">
                                    <label for="examen" class="col-lg-2 col-sm-2 control-label">Examen</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="examen" name="examen" placeholder="Nombre examen" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conferencia_id" class="col-lg-2 col-sm-2 control-label">Conferencia</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="conferencia_id"  name="conferencia_id" required>
                                          <option value="0">Elige conferencia</option>
                                          
                                             <?
                                                $query="SELECT * FROM conferencias";
                                                $conferencias=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($conferencias as &$conferencia) {
                                                $i++;
                                            ?>
                                            <option  value="<?=($conferencia[id])?>"> <?=($conferencia[conferencia])?> </option>
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
                                      <input type="checkbox" checked name="activo">
                                        Activo
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-danger" disabled>Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </section>
                        <?
                      }elseif (isset($_GET[edit])) {
                        $query="SELECT *FROM votaciones WHERE id=".$_GET[id];
                        $votaciones=$bd->ExecuteE($query);
                        foreach ($votaciones as &$votacion) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar pregunta
                              <a href="./?action=votaciones&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver votaciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-votacion" role="form" method="post" action="save.php?action=votaciones&edit">
                                <div class="form-group">
                                    <label for="titulo" class="col-lg-2 col-sm-2 control-label">Titulo</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="titulo" name="titulo" placeholder="Titulo de la votacion" value="<?=($votacion[titulo])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="conferencia_id" class="col-lg-2 col-sm-2 control-label">Conferencia</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="conferencia_id"  name="conferencia_id" required>
                                          <option value="">Elige conferencia</option>
                                          
                                             <?
                                                $query="SELECT * FROM conferencias ";
                                                $conferencias=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($conferencias as &$conferencia) {
                                                $i++;
                                            ?>
                                            <option <? if($votacion[conferencia_id]==$conferencia[id]){?> selected <?}?>  value="<?=($conferencia[id])?>"> <?=($conferencia[conferencia])?> </option>
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
                                      <input type="checkbox" <?if($votacion[activo]==1){?>checked <?}?>  name="activo">
                                        Activo
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$votacion[id]?>">
                                        <button type="submit" class="btn btn-danger" disabled>Guardar</button>
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

