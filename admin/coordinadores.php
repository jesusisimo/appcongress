                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Coordinadores</h1>
                              </div>
                              <a href="./?action=coordinadores&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Coordinador</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>ID Profesor</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT *FROM coordinadores ";
                                $coordinadores=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($coordinadores as &$coordinador) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($coordinador[nombre])?></td>
                                    <td>
                                      <?=($coordinador[profesor_id])?>
                                    </td>
                                    <td><?=($coordinador[correo])?></td>
                                    
                                    <td>
                                      <a href="./?action=coordinadores&edit&id=<?=$coordinador[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=coordinadores&delete&id=<?=$coordinador[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Coordinadores
                              <a href="./?action=coordinadores&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Coordinadores</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=coordinadores&add">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Coordinador" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="profesor_id" class="col-lg-2 col-sm-2 control-label">Profesor Coordinador</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="profesor_id"  name="profesor_id" required>
                                          <option value="0">Elige profesor</option>
                                          
                                             <?
                                                $query="SELECT * FROM profesores";
                                                $profesores=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($profesores as &$nombre) {
                                                $i++;
                                            ?>
                                            <option  value="<?=($nombre[id])?>"> <?=($nombre[nombre])?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="correo" class="col-lg-2 col-sm-2 control-label">Correo</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="e-mail" required>
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
                        $query="SELECT *FROM coordinadores WHERE id=".$_GET[id];
                        $coordinadores=$bd->ExecuteE($query);
                        foreach ($coordinadores as &$nombre) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar nombre
                              <a href="./?action=coordinadores&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Coordinadores</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=coordinadores&edit">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Coordinador" value="<?=($nombre[nombre])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo" class="col-lg-2 col-sm-2 control-label">Correo</label>
                                    <div class="col-lg-10">
                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="e-mail" value="<?=($nombre[correo])?>" required>
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