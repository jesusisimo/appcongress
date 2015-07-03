                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Redes Sociales</h1>
                              </div>
                              <a href="./?action=redes_sociales&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Usuario</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Red Social</th>
                                <th>ID Red Social</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT redes.id, us.nombre as usuario, redes.red_social, redes.id_red_social FROM redes_sociales as redes INNER JOIN usuarios as us on redes.id_usuario=us.id";
                                $redes_sociales=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($redes_sociales as &$id_usuario) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($id_usuario[usuario])?></td>
                                    <td><?=($id_usuario[red_social])?></td>
                                    <td><?=($id_usuario[id_red_social])?></td>
                                    
                                    <td>
                                      <a href="./?action=redes_sociales&edit&id=<?=$id_usuario[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=redes_sociales&delete&id=<?=$id_usuario[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Redes Sociales
                              <a href="./?action=redes_sociales&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Redes Sociales</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-id_usuario" role="form" method="post" action="save.php?action=redes_sociales&add">
                                
                                <div class="form-group">
                                    <label for="id_usuario" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                      <select class="form-control" id="id_usuario" name="id_usuario" required>
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
                                    <label for="red_social" class="col-lg-2 col-sm-2 control-label">Red Social</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="red_social" name="red_social" placeholder="Red Social" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_red_social" class="col-lg-2 col-sm-2 control-label">Id Red Social</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="id_red_social" name="id_red_social" placeholder="" required>
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
                        $query="SELECT *FROM redes_sociales WHERE id=".$_GET[id];
                        $redes_sociales=$bd->ExecuteE($query);
                        foreach ($redes_sociales as &$id_usuario) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Usuario
                              <a href="./?action=redes_sociales&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Redes Sociales</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-id_usuario" role="form" method="post" action="save.php?action=redes_sociales&edit">
                                <div class="form-group">
                                    <label for="id_usuario" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                      <select class="form-control" id="id_usuario" name="id_usuario" required>
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
                                    <label for="red_social" class="col-lg-2 col-sm-2 control-label">Red Social</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="red_social" name="red_social" placeholder="Nombre de Red Social" value="<?=($id_usuario[red_social])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_red_social" class="col-lg-2 col-sm-2 control-label">Id Red Social</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="id_red_social" name="id_red_social" placeholder="Id de la Red Social" value="<?=($id_usuario[id_red_social])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$id_usuario[id]?>">
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