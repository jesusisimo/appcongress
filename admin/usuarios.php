                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET['add']) && !isset($_GET['edit'])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Usuarios</h1>
                              </div>
                              <a href="./?action=resultados" class="btn btn-sm btn-info pull-right"> Estadisticas resultados</a>
                              <a href="./?action=calificaciones" class="btn btn-sm btn-warning pull-right"> Estadisticas calificaciones</a>
                          
                              <a href="./?action=usuarios&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Usuario</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Password</th>
                                <th>Evaluaciones</th>
                                <th>Calificaciones</th>
                                <th>Fecha registro</th>
                                <th>Acciones</th>
                               
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM usuarios";
                                $usuarios=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($usuarios as &$nombre) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($nombre['nombre'])?></td>
                                    <td><?=($nombre['apellidos'])?></td>
                                    <td><?=($nombre['usuario'])?></td>
                                    <td><?=($nombre['password'])?></td>
                                    <td><a class="btn btn-xs btn-info" href="./?action=resultados&usuario=<?=$nombre['id']?>" title="">Evaluaciones</a></td>
                                    <td><a class="btn btn-xs btn-warning" href="./?action=calificaciones&usuario=<?=$nombre['id']?>" title="">Calificaciones</a></td>
                                    <td><?=($nombre['fecha_registro'])?></td>
                                    <td>
                                      <a href="./?action=usuarios&edit&id=<?=$nombre['id']?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=usuarios&delete&id=<?=$nombre['id']?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                      }elseif (isset($_GET['add'])) {
                        ?>                              
                      <section class="panel">
                        <header class="panel-heading">
                              Alta de usuarios
                              <a href="./?action=usuarios&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver usuarios</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=usuarios&add">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos" class="col-lg-2 col-sm-2 control-label">Apellidos</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="usuario" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-2 col-sm-2 control-label">Contraseña</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
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
                      }elseif (isset($_GET['edit'])) {
                        $query="SELECT *FROM usuarios WHERE id=".$_GET['id'];
                        $usuarios=$bd->ExecuteE($query);
                        foreach ($usuarios as &$nombre) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar nombre
                              <a href="./?action=usuarios&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver usuarios</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=usuarios&edit">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?=($nombre['nombre'])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos" class="col-lg-2 col-sm-2 control-label">Apellidos</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?=($nombre['apellidos'])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="usuario" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?=($nombre['usuario'])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-2 col-sm-2 control-label">Contraseña</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="<?=($nombre['password'])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$nombre['id']?>">
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