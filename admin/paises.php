                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Paises</h1>
                              </div>
                              <a href="./?action=paises&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar pais</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Pais</th>
                                <th>Bandera</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM paises";
                                $paises=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($paises as &$pais) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($pais[pais])?></td>
                                    <td><a href="../banderas/bandera_<?=$pais[id]?>.png" target="_blank"><img src="../banderas/bandera_<?=$pais[id]?>.png" alt="<?=($pais[pais])?>" width="25px"></a></td>
                                    <td>
                                      <a href="./?action=paises&edit&id=<?=$pais[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=paises&delete&id=<?=$pais[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de paises
                              <a href="./?action=paises&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver paises</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-pais" role="form" method="post" action="save.php?action=paises&add" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="pais" class="col-lg-2 col-sm-2 control-label">Pais</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="pais" name="pais" placeholder="Nombre del pais" value="" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bandera" class="col-lg-2 col-sm-2 control-label">Bandera</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="file " id="bandera" name="bandera" required/>
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
                        $query="SELECT *FROM paises WHERE id=".$_GET[id];
                        $paises=$bd->ExecuteE($query);
                        foreach ($paises as &$pais) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar pais
                              <a href="./?action=paises&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver paises</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-pais" role="form" method="post" action="save.php?action=paises&edit" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="pais" class="col-lg-2 col-sm-2 control-label">pais</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="pais" name="pais" placeholder="Nombre del pais" value="<?=($pais[pais])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bandera" class="col-lg-2 col-sm-2 control-label">Bandera</label>
                                    <div class="col-lg-10">
                                        <input type="file" class="file " id="bandera" name="bandera" />
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$pais[id]?>">
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