                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Comité Organizador</h1>
                              </div>
                              <a href="./?action=comite_organizador&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Comité</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM comite_organizador";
                                $comite_organizador=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($comite_organizador as &$nombre) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($nombre[nombre])?></td>
                                    <td><?=($nombre[puesto])?></td>
                                    
                                    <td>
                                      <a href="./?action=comite_organizador&edit&id=<?=$nombre[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=comite_organizador&delete&id=<?=$nombre[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Comité
                              <a href="./?action=comite_organizador&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Comité</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=comite_organizador&add">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="puesto" class="col-lg-2 col-sm-2 control-label">Puesto</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto" required>
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
                        $query="SELECT *FROM comite_organizador WHERE id=".$_GET[id];
                        $comite_organizador=$bd->ExecuteE($query);
                        foreach ($comite_organizador as &$nombre) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Comité Organizador
                              <a href="./?action=comite_organizador&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Comité</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=comite_organizador&edit">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?=($nombre[nombre])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="puesto" class="col-lg-2 col-sm-2 control-label">Puesto</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto" value="<?=($nombre[puesto])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$nombre[id]?>">
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