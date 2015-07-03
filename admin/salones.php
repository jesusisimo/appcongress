                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Salones</h1>
                              </div>
                              <a href="./?action=salones&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Salón</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Salón</th>
                                <th>Instrucciones</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM salones";
                                $salones=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($salones as &$salon) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($salon[salon])?></td>
                                    <td><?=($salon[instrucciones])?></td>
                                    <td>
                                      <a href="./?action=salones&edit&id=<?=$salon[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=salones&delete&id=<?=$salon[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Salones
                              <a href="./?action=salones&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Salones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-salon" role="form" method="post" action="save.php?action=salones&add">
                                <div class="form-group">
                                    <label for="salon" class="col-lg-2 col-sm-2 control-label">Salón</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="salon" name="salon" placeholder="Nombre del salón" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="salon" class="col-lg-2 col-sm-2 control-label">Instrucciones</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="instrucciones" name="instrucciones" placeholder="Instrucciones para llegar al lugar" >
                                        </textarea>
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
                        $query="SELECT *FROM salones WHERE id=".$_GET[id];
                        $salones=$bd->ExecuteE($query);
                        foreach ($salones as &$salon) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Salón
                              <a href="./?action=salones&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Salones</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-salon" role="form" method="post" action="save.php?action=salones&edit">
                                <div class="form-group">
                                    <label for="salon" class="col-lg-2 col-sm-2 control-label">Salón</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="salon" name="salon" placeholder="Nombre del salón" value="<?=($salon[salon])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label for="salon" class="col-lg-2 col-sm-2 control-label">Instrucciones</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="instrucciones" name="instrucciones" placeholder="Instrucciones para llegar al lugar" >
                                          <?=($salon[instrucciones])?>
                                        </textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$salon[id]?>">
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