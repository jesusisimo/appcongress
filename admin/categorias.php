    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/jquery-multi-select/css/multi-select.css" />


    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />
           <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Categorías</h1>
                              </div>
                              <a href="./?action=categorias&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Categoría</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Categoría</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                                
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM categorias";
                                $categorias=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($categorias as &$categoria) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($categoria[categoria])?></td>
                                    <td><?=($categoria[inicio])?></td>
                                    <td><?=($categoria[fin])?></td>
                                    <td><?=substr(($categoria[descripcion]), 0, 20)."..."; ?></td>
                                    
                                    <td>
                                      <a href="./?action=categorias&edit&id=<?=$categoria[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=categorias&delete&id=<?=$categoria[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Categorías
                              <a href="./?action=categorias&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Categorías</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-categoria" role="form" method="post" action="save.php?action=categorias&add">
                                <div class="form-group">
                                    <label for="categoria" class="col-lg-2 col-sm-2 control-label">Categoría</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Nombre de la categoría" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                      <label for="fecha_hora_inicio" class="control-label col-lg-2 col-sm-2">Fecha y hora de inicio</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="" id="fecha_hora_inicio" name="fecha_hora_inicio"  class="form_datetime form-control">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fecha_hora_fin" class="control-label col-lg-2 col-sm-2">Fecha y hora de termino</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="" id="fecha_hora_fin" name="fecha_hora_fin"  class="form_datetime form-control">
                                      </div>
                                  </div> 
                                  <div class="form-group">
                                    <label for="descripcion" class="col-lg-2 col-sm-2 control-label">Descripción</label>
                                    <div class="col-lg-10">
                                        <textarea class="wysihtml5 form-control" rows="10" id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
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
                        $query="SELECT *FROM categorias WHERE id=".$_GET[id];
                        $categorias=$bd->ExecuteE($query);
                        foreach ($categorias as &$categoria) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Categoría
                              <a href="./?action=categorias&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Categorías</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-categoria" role="form" method="post" action="save.php?action=categorias&edit">
                                <div class="form-group">
                                    <label for="categoria" class="col-lg-2 col-sm-2 control-label">Categoría</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Nombre de la categoría" value="<?=($categoria[categoria])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                               <div class="form-group">
                                      <label for="fecha_hora_inicio" class="control-label col-lg-2 col-sm-2">Fecha y hora de inicio</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" id="fecha_hora_inicio" name="fecha_hora_inicio" value="<?if($categoria[inicio]!="0000-00-00 00:00:00"){echo ($categoria[inicio]);}?>" class="form_datetime form-control">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fecha_hora_fin" class="control-label col-lg-2 col-sm-2">Fecha y hora de termino</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" id="fecha_hora_fin" name="fecha_hora_fin" value="<?if($categoria[fin]!="0000-00-00 00:00:00"){echo ($categoria[fin]);}?>" class="form_datetime form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="descripcion" class="col-lg-2 col-sm-2 control-label">Descripción</label>
                                    <div class="col-lg-10">
                                        <textarea class="wysihtml5 form-control" rows="10" id="descripcion" name="descripcion" placeholder="Descripción" required><?=$categoria[descripcion]?></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$categoria[id]?>">
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

              <!-- js placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../js/respond.min.js" ></script>
  
    <!--this page plugins-->

  <script type="text/javascript" src="../assets/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script type="text/javascript" src="../assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="../assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="../assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

  <!--common script for all pages-->
    <script src="../js/common-scripts.js"></script>
    <!--this page  script only-->
    <script src="../js/advanced-form-components.js"></script>