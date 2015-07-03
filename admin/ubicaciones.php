                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Ubicaciones</h1>
                              </div>
                              <a href="./?action=ubicaciones&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Ubicación</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Ubicación</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Icono</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM ubicaciones";
                                $ubicaciones=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($ubicaciones as &$ubicacion) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($ubicacion[ubicacion])?></td>
                                    <td><?=($ubicacion[latitud])?></td>
                                    <td><?=($ubicacion[longitud])?></td>
                                    <td><a href="<?=($ubicacion[icono])?>" target="_blank">Ver</a></td>
                                    <td>
                                      <a href="./?action=ubicaciones&edit&id=<?=$ubicacion[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=ubicaciones&delete&id=<?=$ubicacion[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Ubicaciones
                              <a href="./?action=ubicaciones&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Ubicaciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-ubicacion" role="form" method="post" action="save.php?action=ubicaciones&add">
                                <div class="form-group">
                                    <label for="ubicacion" class="col-lg-2 col-sm-2 control-label">Ubicación</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="latitud" class="col-lg-2 col-sm-2 control-label">Latitud</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="longitud" class="col-lg-2 col-sm-2 control-label">Longitud</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="icono" class="col-lg-2 col-sm-2 control-label">Url de icono</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icono" name="icono" placeholder="" required>
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
                        $query="SELECT *FROM ubicaciones WHERE id=".$_GET[id];
                        $ubicaciones=$bd->ExecuteE($query);
                        foreach ($ubicaciones as &$ubicacion) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Ubicación
                              <a href="./?action=ubicaciones&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Ubicaciones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-ubicacion" role="form" method="post" action="save.php?action=ubicaciones&edit">
                                
                                 <div class="form-group">
                                    <label for="ubicacion" class="col-lg-2 col-sm-2 control-label">Ubicación</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" value="<?=($ubicacion[ubicacion])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="latitud" class="col-lg-2 col-sm-2 control-label">Latitud</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud" value="<?=($ubicacion[latitud])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="longitud" class="col-lg-2 col-sm-2 control-label">Longitud</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="<?=($ubicacion[longitud])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="icono" class="col-lg-2 col-sm-2 control-label">Url de icono</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icono" name="icono" placeholder="" value="<?=($ubicacion[icono])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$ubicacion[id]?>">
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