<html>
  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="../img/favicon.png">

    <title></title>

    <!-- Bootstrap core CSS -->
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
                 
   </head>
        <body>
                <div class="row">
                  <div class="col-lg-12">
                      <!--work progress start-->
                      <?
                      if(!isset($_GET[add]) && !isset($_GET[edit])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Actividades</h1>
                              </div>
                              <a href="./?action=actividades&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Actividad</a>
                          </div>
                          <table class="table table-hover table-advance ">
                              <thead>
                                <th>#</th>
                                <th>Actividad</th>
                                <th>Descripción</th>
                                <th>Inicia</th>
                                <th>Finaliza</th>
                                <th>Lugar</th>
                                <th>Categoría</th>
                                <th>Temario</th>
                                <th>Cupo</th>
                                <th>Costo</th>
                                <th>Coordinadores</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM actividades";
                                if(isset($_GET[id_categoria]) && $_GET[id_categoria]!=""){
                                  $query.=" where categoria_id=".$_GET[id_categoria];
                                }
                                if(isset($_GET[lugar]) && $_GET[lugar]!=""){
                                  $query.=" where lugar=".$_GET[lugar];
                                }
                                $actividades=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($actividades as &$actividad) {
                                $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($actividad[actividad])?></td>
                                    <td><?=substr(($actividad[descripcion]), 0, 20)."..."; ?></td>
                                    <td><?=($actividad[fecha_hora_inicio])?></td>
                                    <td><?=($actividad[fecha_hora_fin])?></td>
                                    <td>
                                      <?
                                        $query="SELECT * FROM salones where id=".$actividad[lugar];
                                        $lugares=$bd->ExecuteE($query);
                                        foreach ($lugares as $lugar) {
                                      ?>
                                      <a href="./?action=actividades&view&lugar=<?=$lugar[id]?>"><?=($lugar[salon])?></a>
                                      <?
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <?
                                        $query="SELECT * FROM categorias where id=".$actividad[categoria_id];
                                        $categorias=$bd->ExecuteE($query);
                                        foreach ($categorias as $categoria) {
                                      ?>
                                      <a href="./?action=actividades&view&id_categoria=<?=$categoria[id]?>"><?=($categoria[categoria])?></a>
                                      <?
                                        }
                                      ?>
                                    </td>
                                    <td><?=substr(($actividad[temario]), 0, 20)."..."; ?></td>
                                    <td><? if($actividad[cupo]==0){ echo "No aplica";}else{echo $actividad[cupo];}?></td>
                                    <td><? if($actividad[costo]==0){ echo "No aplica";}else{echo $actividad[costo];}?></td>
                                    <td>
                                        <?
                                          $query="SELECT * FROM coordinadores WHERE id in (".$actividad[coordinadores].")";
                                          $coordinadores=$bd->ExecuteE($query);
                                          foreach ($coordinadores as &$coordinador) {
                                            echo ($coordinador[nombre]).", ";
                                          }
                                        ?>
                                    </td>
                                    <td>
                                      <a href="./?action=actividades&edit&id=<?=$actividad[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=actividades&delete&id=<?=$actividad[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Actividad
                              <a href="./?action=actividades&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Actividades</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-actividad" role="form" method="post" action="save.php?action=actividades&add">
                                <div class="form-group">
                                    <label for="actividad" class="col-lg-2 col-sm-2 control-label">Actividad</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Nombre de la actividad" required>
                                        <p class="help-block"></p>
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
                                      <label for="fecha_hora_inicio" class="control-label col-lg-2 col-sm-2">Fecha y hora de inicio</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="2015-07-01 14:45" id="fecha_hora_inicio" name="fecha_hora_inicio" readonly class="form_datetime form-control">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fecha_hora_fin" class="control-label col-lg-2 col-sm-2">Fecha y hora de termino</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="2015-07-01 14:45" id="fecha_hora_fin" name="fecha_hora_fin" readonly class="form_datetime form-control">
                                      </div>
                                  </div>                                 
                                                               
                                <div class="form-group">
                                    <label for="lugar" class="col-lg-2 col-sm-2 control-label">Lugar</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="lugar" name="lugar" required>
                                            <?
                                                $query="SELECT * FROM salones";
                                                $salones=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($salones as &$salon) {
                                               $i++;
                                            ?>
                                            <option value="<?=($salon[id])?>"><?=($salon[salon])?></option>
                                            <?
                                            }
                                            ?>
                                            <p class="help-block"></p>
                                        </select>   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="categoria_id" class="col-lg-2 col-sm-2 control-label">Categoría</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="categoria_id"  name="categoria_id" required>
                                             <?
                                                $query="SELECT * FROM categorias";
                                                $categorias=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($categorias as &$categoria) {
                                                $i++;
                                            ?>
                                            <option  value="<?=($categoria[id])?>"> <?=($categoria[categoria])?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conferencia" class="col-lg-2 col-sm-2 control-label">Temario</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control wysihtml5" id="temario" name="temario" placeholder="" ></textarea>
                                        <p class="help-block"></p>
                                     </div>
                                </div>


                                <div class="form-group">
                                    <label for="cupo" class="col-lg-2 col-sm-2 control-label">Cupo</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" id="cupo" name="cupo" placeholder="Cupo" >
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="costo" class="col-lg-2 col-sm-2 control-label">Costo</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" id="costo" name="costo" placeholder="$" >
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                


                                <div class="form-group">
                                    <label for="coordinadores" class="col-lg-2 col-sm-2 control-label">Coordinadores</label>
                                    <div class="col-lg-10">
                                            <select multiple="multiple" class="multi-select"  id="coordinadores" name="coordinadores[]" required>
                                                <?
                                                    $query="SELECT * FROM coordinadores";
                                                    $coordinadores=$bd->ExecuteE($query);
                                                    $i=0;
                                                    foreach ($coordinadores as &$nombre) {
                                                    $i++;
                                                ?>
                                                <option value="<?=($nombre[id])?>"> <?=($nombre[nombre])?> </option>
                                                <?
                                                }
                                                ?>
                                               
                                            </select><p class="help-block"></p>
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
                        $query="SELECT *FROM actividades WHERE id=".$_GET[id];
                        $actividades=$bd->ExecuteE($query);
                        foreach ($actividades as &$actividad) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Actividad
                              <a href="./?action=actividades&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Actividades</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-actividad" role="form" method="post" action="save.php?action=actividades&edit">
                                <div class="form-group">
                                    <label for="actividad" class="col-lg-2 col-sm-2 control-label">Actividad</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Nombre del actividad" value="<?=($actividad[actividad])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="col-lg-2 col-sm-2 control-label">Descripción</label>
                                    <div class="col-lg-10">
                                        <textarea class="wysihtml5 form-control" rows="10" id="descripcion" name="descripcion" placeholder="Descripción" required> <?=($actividad[descripcion])?> </textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                      <label for="fecha_hora_inicio" class="control-label col-lg-2 col-sm-2">Fecha y hora de inicio</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="<?=($actividad[fecha_hora_inicio])?>" id="fecha_hora_inicio" name="fecha_hora_inicio" readonly class="form_datetime form-control">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fecha_hora_fin" class="control-label col-lg-2 col-sm-2">Fecha y hora de termino</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="<?=($actividad[fecha_hora_fin])?>" id="fecha_hora_fin" name="fecha_hora_fin" readonly class="form_datetime form-control">
                                      </div>
                                  </div> 
                                
                                <div class="form-group">
                                    <label for="lugar" class="col-lg-2 col-sm-2 control-label">Lugar</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="lugar" name="lugar" required>
                                            <?
                                                $query="SELECT * FROM salones";
                                                $salones=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($salones as &$salon) {
                                               $i++;
                                            ?>
                                            <option <? if($actividad[lugar]==$salon[id]){ echo "selected";}?> value="<?=($salon[id])?>"><?=($salon[salon])?></option>
                                            <?
                                            }
                                            ?>
                                            <p class="help-block"></p>
                                        </select>   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="categoria_id" class="col-lg-2 col-sm-2 control-label">Categoría</label>
                                    <div class="col-lg-10">
                                       
                                        <select class="form-control"  id="categoria_id"  name="categoria_id" required>
                                             <?
                                                $query="SELECT * FROM categorias";
                                                $categorias=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($categorias as &$categoria) {
                                                $i++;
                                            ?>
                                            <option <? if($actividad[categoria_id]==$categoria[id]){ echo "selected";}?>  value="<?=($categoria[id])?>"> <?=($categoria[categoria])?> </option>
                                            <?
                                            }
                                            ?>
                                        <p class="help-block"></p>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="temario" class="col-lg-2 col-sm-2 control-label">Temario</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control wysihtml5" id="temario" name="temario" placeholder="" ><?=($actividad[temario])?></textarea>
                                        <p class="help-block"></p>
                                     </div>
                                </div>
                                <div class="form-group">
                                    <label for="cupo" class="col-lg-2 col-sm-2 control-label">Cupo</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" id="cupo" name="cupo" placeholder="Cupo" value="<?=($actividad[cupo])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="costo" class="col-lg-2 col-sm-2 control-label">Costo</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" id="costo" name="costo" placeholder="$"  value="<?=($actividad[costo])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="coordinadores" class="col-lg-2 col-sm-2 control-label">Coordinadores</label>
                                    <div class="col-lg-10">
                                            <select multiple="multiple" class="multi-select"  id="coordinadores" name="coordinadores[]" required>
                                                <?
                                                    $ids_coordinadores = explode(",", $actividad[coordinadores]);
                                                    $query="SELECT * FROM coordinadores";
                                                    $coordinadores=$bd->ExecuteE($query);
                                                    $i=0;
                                                    foreach ($coordinadores as &$coordinador) {
                                                    $i++;
                                                ?>
                                                <option <? if (in_array($coordinador[id], $ids_coordinadores)) {echo "selected";}?> value="<?=($coordinador[id])?>"> <?=($coordinador[nombre])?> </option>
                                                <?
                                                }
                                                ?>
                                               
                                            </select><p class="help-block"></p>
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$actividad[id]?>">
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


        </body>
    </html>