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
                                  <h1>Conferencias</h1>
                              </div>
                              <a href="./?action=conferencias&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Conferencia</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Conferencia</th>
                                <th>Inicia</th>
                                <th>Finaliza</th>
                                <th>Actividad</th>
                                <th>Profesor</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT con.id, con.conferencia, con.fecha_hora_inicio, con.fecha_hora_fin, ac.actividad as actividad,  pr.nombre as profesor, con.descripcion FROM conferencias as con  INNER JOIN profesores as pr on con.profesor_id=pr.id INNER JOIN actividades as ac on con.actividad_id=ac.id";
                                $conferencias=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($conferencias as &$conferencia) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($conferencia[conferencia])?></td>
                                    <td><?=($conferencia[fecha_hora_inicio])?></td>
                                    <td><?=($conferencia[fecha_hora_fin])?></td>
                                    <td><?=($conferencia[actividad])?></td>
                                    <td><?=($conferencia[profesor])?></td>
                                    <td><?=substr(($conferencia[descripcion]), 0, 200)."..."; ?></td>
                                    
                                    <td>
                                      <a href="./?action=conferencias&edit&id=<?=$conferencia[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=conferencias&delete&id=<?=$conferencia[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Conferencias
                              <a href="./?action=conferencias&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Conferencias</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-conferencia" role="form" method="post" action="save.php?action=conferencias&add">
                                <div class="form-group">
                                    <label for="conferencia" class="col-lg-2 col-sm-2 control-label">Conferencia</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="conferencia" name="conferencia" placeholder="Nombre de la Conferencia" required>
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
                                    <label for="actividad" class="col-lg-2 col-sm-2 control-label">Actividad</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="actividad" name="actividad" required>
                                            <?
                                                $query="SELECT * FROM actividades";
                                                $actividades=$bd->ExecuteE($query);
                                                $i=0;
                                                foreach ($actividades as &$actividad) {
                                               $i++;
                                            ?>
                                            <option value="<?=($actividad[id])?>"><?=($actividad[actividad])?></option>
                                            <?
                                            }
                                            ?>
                                            <p class="help-block"></p>
                                        </select>   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="profesor_id" class="col-lg-2 col-sm-2 control-label">Profesor</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="profesor_id" name="profesor_id" required>
                                            <?
                                             $query="SELECT * FROM profesores";
                                             $profesores=$bd->ExecuteE($query);
                                             $i=0;
                                             foreach ($profesores as &$nombre) {
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
                        $query="SELECT *FROM conferencias WHERE id=".$_GET[id];
                        $conferencias=$bd->ExecuteE($query);
                        foreach ($conferencias as &$conferencia) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Conferencia
                              <a href="./?action=conferencias&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Conferencias</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-conferencia" role="form" method="post" action="save.php?action=conferencias&edit">
                                <div class="form-group">
                                    <label for="conferencia" class="col-lg-2 col-sm-2 control-label">Conferencia</label>
                                    <div class="col-lg-10">
                                        <input type="name" class="form-control" id="conferencia" name="conferencia" placeholder="Nombre de la Conferencia" value="<?=($conferencia[conferencia])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                      <label for="fecha_hora_inicio" class="control-label col-md-3">Fecha y hora de inicio</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="<?=($conferencia[fecha_hora_inicio])?>" id="fecha_hora_inicio" name="fecha_hora_inicio" readonly class="form_datetime form-control">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fecha_hora_fin" class="control-label col-md-3">Fecha y hora de termino</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="<?=($conferencia[fecha_hora_fin])?>" id="fecha_hora_fin" name="fecha_hora_fin" readonly class="form_datetime form-control">
                                      </div>
                                  </div> 
                               

                                <div class="form-group">
                                    <label for="profesor_id" class="col-lg-2 col-sm-2 control-label">Profesor</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="profesor_id" name="profesor_id" required>
                                            <?
                                             $query="SELECT * FROM profesores";
                                             $profesores=$bd->ExecuteE($query);
                                             $i=0;
                                             foreach ($profesores as &$nombre) {
                                             $i++;
                                            ?>
                                          <option <?if($nombre['id']==$conferencia['profesor_id']){?>selected<?}?> value="<?=($nombre['id'])?>"><?=($nombre['nombre'])?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="col-lg-2 col-sm-2 control-label">Descripción</label>

                                    <div class="col-lg-10">
                                        <textarea class=" form-control" rows="10" id="descripcion" name="descripcion" placeholder="Descripción" required><?=($conferencia['descripcion'])?></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$conferencia[id]?>">
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