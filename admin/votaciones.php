                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Preguntas rápidas</h1>
                              </div>
                              <a href="./?action=votaciones&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Crear pregunta</a>
                              <a href="./?action=stats_votacion" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus-bar-chart-o"></i> Estadisticas</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Pregunta</th>
                                <th>Conferencia</th>
                                <th>Creado por</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT v.titulo, v.id, v.activo, c.conferencia, p.nombre as profesor FROM votaciones as v INNER JOIN conferencias as c on c.id=v.conferencia_id INNER JOIN profesores as p on p.id=v.profesor_id WHERE p.id!=0";
                                $votaciones=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($votaciones as &$votacion) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($votacion[titulo])?></td>
                                    <td>
                                      <?=($votacion[conferencia])?>
                                    </td>
                                    <td><?=($votacion[profesor])?></td>
                                    <td>
                                      <?if($votacion[activo]==1){?>
                                        <a class="btn btn-success btn-block" href="activaVotacion.php?votacion=<?=$votacion[id]?>&estatus=0">
                                          Desactivar
                                        </a>
                                        <?}else{?>
                                        <a class="btn btn-danger btn-block" href="activaVotacion.php?votacion=<?=$votacion[id]?>&estatus=1">
                                          Activar
                                        </a>
                                        <?}?>
                                    </td>                                    
                                    <td>
                                      <a href="./?action=candidatos&view&votacion=<?=$votacion[id]?>" class="btn btn-xs btn-success" ><i class="fa fa-list-ol"></i></a>  
                                      <a href="./?action=votaciones&edit&id=<?=$votacion[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=votaciones&delete&id=<?=$votacion[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Crear pregunta
                              <a href="./?action=votaciones&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver preguntas</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-votacion" role="form" method="post" action="save.php?action=votaciones&add">
                                <div class="form-group">
                                    <label for="titulo" class="col-lg-2 col-sm-2 control-label">Titulo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo para la votacion" required>
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
                                        <button type="submit" class="btn btn-danger">Guardar</button>
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

