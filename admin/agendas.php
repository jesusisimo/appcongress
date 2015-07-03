                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Agendas</h1>
                              </div>
                              <a href="./?action=agendas&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Agenda</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Actividad</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT age.id, us.nombre as usuario, ac.actividad as actividad FROM agendas as age INNER JOIN usuarios as us on age.usuario_id=us.id INNER JOIN actividades as ac on age.actividad_id=ac.id";
                                $agendas=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($agendas as &$usuario_id) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($usuario_id[usuario])?></td>
                                    <td><?=($usuario_id[actividad])?></td>
                                    <td>
                                      <a href="./?action=agendas&edit&id=<?=$usuario_id[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=agendas&delete&id=<?=$usuario_id[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Agendas
                              <a href="./?action=agendas&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Agendas</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-usuario_id" role="form" method="post" action="save.php?action=agendas&add">

                                <div class="form-group">
                                    <label for="usuario_id" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">                                        
                                        <select class="form-control" id="usuario_id" name="usuario_id" required>
                                        <?
                                          $query="SELECT * FROM usuarios";
                                          $usuarios=$bd->ExecuteE($query);
                                          $i=0;
                                          foreach ($usuarios as &$nombre) {
                                          $i++;
                                        ?>
                                          <option value="<?=($nombre[id])?>"><?=($nombre[nombre])?></option>
                                            <?
                                            }
                                            ?>
                                        </select>                                        
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="usuario_id" class="col-lg-2 col-sm-2 control-label">Actividad</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="usuario_id" name="usuario_id" required>
                                            <?
                                             $query="SELECT * FROM actividades";
                                              $actividades=$bd->ExecuteE($query);
                                              $i=0;
                                              foreach ($actividades as &$actividad) {
                                              $i++;
                                            ?>
                                          <option value="<?=($actividad[id])?>"><?=($actividad[actividad])?></option>
                                            <?
                                            }
                                            ?>
                                        </select>                                       
                                        <p class="help-block"></p>
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
                        $query="SELECT *FROM agendas WHERE id=".$_GET[id];
                        $agendas=$bd->ExecuteE($query);
                        foreach ($agendas as &$usuario_id) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Agenda de Usuario
                              <a href="./?action=agendas&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Agendas</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-usuario_id" role="form" method="post" action="save.php?action=agendas&edit">
                                <div class="form-group">
                                    <label for="usuario_id" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="usuario_id" name="usuario_id" placeholder="Nombre del Usuario" value="<?=($usuario_id[usuario_id])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="usuario_id" class="col-lg-2 col-sm-2 control-label">Actividad</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="usuario_id" name="usuario_id" placeholder="Nombre de la actividad" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$usuario_id[id]?>">
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