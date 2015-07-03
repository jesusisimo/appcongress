                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Sociedad</h1>
                              </div>
                              <a href="./?action=sociedad&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Sociedad</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Sociedad</th>
                                <th>Prefijo</th>
                                <th>Sistema</th>
                                <th>Evento</th>
                                <th>Dirección</th>
                                <th>Telefonos</th>
                                <th>E-mail</th>
                                <th>Web</th>
                                <th>Correo de Envio</th>
                                <th>Nombre Correo Envio</th>
                                <th>Correo Respuesta</th>
                                <th>Correo Soporte</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM sociedad";
                                $sociedad=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($sociedad as &$sociedad) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($sociedad[sociedad])?></td>
                                    <td><?=($sociedad[prefijo])?></td>
                                    <td><?=($sociedad[nombre_sistema])?></td>
                                    <td><?=($sociedad[evento])?></td>
                                    <td><?=($sociedad[direccion])?></td>
                                    <td><?=($sociedad[telefonos])?></td>
                                    <td><?=($sociedad[email])?></td>
                                    <td><?=($sociedad[web])?></td>
                                    <td><?=($sociedad[correo_envio])?></td>
                                    <td><?=($sociedad[nombre_correo_envio])?></td>
                                    <td><?=($sociedad[correo_respuesta])?></td>
                                    <td><?=($sociedad[correo_soporte])?></td>
                                    
                                    <td>
                                      <a href="./?action=sociedad&edit&id=<?=$sociedad[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=sociedad&delete&id=<?=$sociedad[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Sociedad
                              <a href="./?action=sociedad&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Sociedad</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-sociedad" role="form" method="post" action="save.php?action=sociedad&add">
                                <div class="form-group">
                                    <label for="sociedad" class="col-lg-2 col-sm-2 control-label">Sociedad</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="sociedad" name="sociedad" placeholder="Nombre Sociedad" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="prefijo" class="col-lg-2 col-sm-2 control-label">Prefijo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="prefijo" name="prefijo" placeholder="Prefijo" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sistema" class="col-lg-2 col-sm-2 control-label">Nombre sistema</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="sistema" name="sistema"  required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="evento" class="col-lg-2 col-sm-2 control-label">Evento</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="evento" name="evento"  required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="direccion" class="col-lg-2 col-sm-2 control-label">Dirección</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="telefonos" class="col-lg-2 col-sm-2 control-label">Teléfono</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" id="telefonos" name="telefonos" placeholder="Teléfono" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Correo</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="web" class="col-lg-2 col-sm-2 control-label">Web</label>
                                    <div class="col-lg-10">
                                        <input type="url" class="form-control" id="web" name="web" placeholder="URL" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_envio" class="col-lg-2 col-sm-2 control-label">Correo de envio</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo_envio" name="correo_envio" placeholder="e-mail" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_correo_envio" class="col-lg-2 col-sm-2 control-label">Nombre de Correo de envio</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre_correo_envio" name="nombre_correo_envio" placeholder="Nombre" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_respuesta" class="col-lg-2 col-sm-2 control-label">Correo de Respuesta</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo_respuesta" name="correo_respuesta" placeholder="e-mail" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_soporte" class="col-lg-2 col-sm-2 control-label">Correo para Soporte</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo_soporte" name="correo_soporte" placeholder="e-mail" required>
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
                        $query="SELECT *FROM sociedad WHERE id=".$_GET[id];
                        $sociedad=$bd->ExecuteE($query);
                        foreach ($sociedad as &$sociedad) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Sociedad
                              <a href="./?action=sociedad&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Sociedad</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-sociedad" role="form" method="post" action="save.php?action=sociedad&edit">
                                <div class="form-group">
                                    <label for="sociedad" class="col-lg-2 col-sm-2 control-label">Sociedad</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="sociedad" name="sociedad" placeholder="Nombre de la Sociedad" value="<?=($sociedad[sociedad])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="prefijo" class="col-lg-2 col-sm-2 control-label">Prefijo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="prefijo" name="prefijo" placeholder="Prefijo" value="<?=($sociedad[prefijo])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sistema" class="col-lg-2 col-sm-2 control-label">Nombre sistema</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="sistema" name="sistema" value="<?=($sociedad[nombre_sistema])?>"  required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="evento" class="col-lg-2 col-sm-2 control-label">Evento</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="evento" name="evento" value="<?=($sociedad[evento])?>"  required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="direccion" class="col-lg-2 col-sm-2 control-label">Dirección</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="<?=($sociedad[direccion])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="telefonos" class="col-lg-2 col-sm-2 control-label">Teléfono</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" id="telefonos" name="telefonos" placeholder="Teléfono" value="<?=($sociedad[telefonos])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Correo</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?=($sociedad[email])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="web" class="col-lg-2 col-sm-2 control-label">Web</label>
                                    <div class="col-lg-10">
                                        <input type="url" class="form-control" id="web" name="web" placeholder="URL" value="<?=($sociedad[web])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_envio" class="col-lg-2 col-sm-2 control-label">Correo de envio</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo_envio" name="correo_envio" placeholder="e-mail" value="<?=($sociedad[correo_envio])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_correo_envio" class="col-lg-2 col-sm-2 control-label">Nombre de Correo de envio</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre_correo_envio" name="nombre_correo_envio" placeholder="Nombre" value="<?=($sociedad[nombre_correo_envio])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_respuesta" class="col-lg-2 col-sm-2 control-label">Correo de Respuesta</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo_respuesta" name="correo_respuesta" placeholder="e-mail" value="<?=($sociedad[correo_respuesta])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_soporte" class="col-lg-2 col-sm-2 control-label">Correo para Soporte</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo_soporte" name="correo_soporte" placeholder="e-mail" value="<?=($sociedad[correo_soporte])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$sociedad[id]?>">
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