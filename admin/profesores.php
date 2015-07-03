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
                      if(!isset($_GET[add]) && !isset($_GET[edit]) && !isset($_GET[stats])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Profesores</h1>
                              </div>
                              <a href="./?action=profesores&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Profesor</a>
                              <a href="./?action=profesores&stats" class="btn btn-sm btn-info pull-right"><i class="fa fa-bar-chart-o"></i> Estadisticas</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Calificación</th>
                                <th>Institución</th>
                                <th>Cargo</th>
                                <th>Curriculum</th>
                                <th>País</th>
                                <th>Foto</th>
                                <th>PDF</th>
                                <th class="text-right">Acciones</th>
                                <th></th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT pr.id, pr.nombre, pr.puesto, pr.curriculum,pr.email,pr.institucion, pr.emailpublico, pr.activo, p.pais FROM profesores as pr INNER JOIN paises as p on pr.pais_id=p.id";
                                $profesores=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($profesores as &$profesor) {
                                $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>
                                      <?if($profesor[activo]==1){?><i class="fa fa-circle text-success"></i><?}else{?><i class="fa fa-ban text-danger"></i><?}?>
                                      <?=($profesor[nombre])?>
                                    </td>
                                    <td><?=($profesor[email])?><?if($profesor[emailpublico]==1){?><i class="fa fa-eye text-primary"></i><?}else{?><i class="fa fa-eye-slash text-danger"></i><?}?></td>
                                    <td>
                                      <?
                                            $sql_calificaciones  = "SELECT sum(estrellas) as total, count(id_usuario) as votantes  FROM  calificaciones_profesor where id_profesor=".$profesor['id'];
                                            $res_calificaciones  = $bd->ExecuteE($sql_calificaciones);
                                            $estrellas=0;
                                            $votantes=0;
                                            foreach ($res_calificaciones as &$calificacion) { 
                                              if($calificacion['total']>0){
                                                $votantes=$calificacion['votantes'];
                                                $estrellas=$calificacion['total']/$calificacion['votantes'];
                                              }  

                                              }
                                            ?>
                                            <?

                                            if($estrellas==0){
                                            ?>
                                              <i class="fa text-warning fa-star-o "></i> | <i class="fa fa-user text-primary"></i> x <?=$calificacion['votantes']?>
                                            <?}elseif ($estrellas > 0 && $estrellas<=3) {?>
                                            <?=number_format($estrellas, 1, ',', '');?> <i class="fa text-warning  fa-star-half-o"></i> |  <i class="fa fa-user text-primary"></i> x <?=$calificacion['votantes']?>
                                            <?}elseif ($estrellas > 0 && $estrellas>3) {?>
                                            <?=number_format($estrellas, 1, ',', '');?> <i class="fa text-warning  fa-star"></i> |  <i class="fa fa-user text-primary"></i> x <?=$calificacion['votantes']?>
                                            <?}?>
                                    </td>
                                    <td><?=($profesor[institucion])?></td>
                                    <td><?=($profesor[puesto]); ?></td>
                                    <td><?=substr(($profesor[curriculum]), 0, 20)."..."; ?></td>
                                    <td><?=($profesor[pais])?></td>
                                    <td>
                                      <?
                                        if(file_exists("../foto_profesor/profesor_".$profesor[id].".png")){
                                      ?>
                                      <a href="../foto_profesor/profesor_<?=$profesor[id]?>.png" target="_blanck" class="btn btn-xs btn-white" ><i class="fa fa-picture-o"></i></a>
                                      <?
                                        }else{
                                      ?>
                                        <i class="fa fa-ban text-danger"></i>
                                      <?}?>
                                    </td>
                                    <td>
                                      <?
                                        if(file_exists("../cvs/cv_".$profesor[id].".pdf")){
                                      ?>
                                      <a href="../cvs/cv_<?=$profesor[id]?>.pdf" target="_blanck" class="btn btn-xs btn-white" ><i class="fa fa-file-text"></i></a>
                                       <?
                                        }else{
                                      ?>
                                        <i class="fa fa-ban text-danger"></i>
                                      <?}?>
                                    </td>
                                    <td class="text-right">
                                      <a href="./?action=profesores&edit&id=<?=$profesor[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=profesores&delete&id=<?=$profesor[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>              
                                    </td>
                                    <td>
                                      <?
                                        $query="SELECT count(*) as si FROM coordinadores WHERE profesor_id=".$profesor[id];
                                        $escoordindador=$bd->ExecuteE($query);
                                        foreach ($escoordindador as &$coordinador) {
                                          if($coordinador[si]==0){
                                            ?>
                                            <a href="save.php?action=coordinadores&add&profesor=<?=$profesor[id]?>" class="btn btn-xs btn-primary" onclick="return confirm('Deseas covertir como coordinador?');" ><i class="fa fa-share"></i></a>              
                                            <?
                                          }
                                        }
                                      ?>
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
                              Alta de profesores
                              <a href="./?action=profesores&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver profesores</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post" action="save.php?action=profesores&add" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Profesor" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="col-lg-2">
                                      <div class="checkbox">
                                        <label>
                                        <input type="checkbox" checked name="emailpublico">
                                          Visible
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="institucion" class="col-lg-2 col-sm-2 control-label">Institución</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="institucion" name="institucion" placeholder="" >
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="puesto" class="col-lg-2 col-sm-2 control-label">Cargo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="puesto" name="puesto" placeholder="" >
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="pais_id" class="col-lg-2 col-sm-2 control-label">País</label>
                                    <div class="col-lg-10">  
                                      <select class="form-control" id="pais_id" name="pais_id" required>
                                        <?
                                          $query="SELECT * FROM paises";
                                          $paises=$bd->ExecuteE($query);
                                          $i=0;
                                          foreach ($paises as &$pais) {
                                          $i++;
                                        ?>
                                         <option <? if($pais[id]==156){?> selected <?}?> value="<?=($pais[id])?>"> <?=($pais[pais])?> </option>
                                        <?
                                         }
                                        ?>
                                        <p class="help-block"></p>
                                      </select>      
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="curriculum" class="col-lg-2 col-sm-2 control-label">Curriculum</label>

                                    <div class="col-lg-10">
                                        <textarea class="wysihtml5 form-control" rows="10" id="curriculum" name="curriculum" ></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                  
                                  <div class="form-group">
                                          <label for="cv" class="col-lg-2 col-sm-2 control-label">Subir curriculum PDF</label>
                                          <div class="controls col-md-10">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecciona Archivo</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                                <input type="file" class="default" id="cv" name="cv" />
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                          </div>
                                   </div>

                                <div class="form-group">
                                          <label for="foto_profesor" class="col-lg-2 col-sm-2 control-label">Foto de perfil</label>                                     
                                          <div class="col-lg-10">
                                             <div class="fileupload fileupload-new" data-provides="fileupload">                                               
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=No+hay+imagen" alt="" />                                                   
                                                  </div>                                                  
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i>Subir Foto en .png</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar </span>
                                                   <input type="file" class="default" id="foto_profesor" name="foto_profesor"/>
                                                   </span>
                                                   <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover </a>
                                                  </div>
                                              </div>                                             
                                          </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                      <div class="checkbox">
                                        <label>
                                        <input type="checkbox" checked name="activo">
                                          Activado
                                        </label>
                                      </div>
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
                        $query="SELECT *FROM profesores WHERE id=".$_GET[id];
                        $profesores=$bd->ExecuteE($query);
                        foreach ($profesores as &$profesor) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Profesores
                              <a href="./?action=profesores&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver profesores</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-nombre" role="form" method="post"  enctype="multipart/form-data" action="save.php?action=profesores&edit">
                                <div class="form-group">
                                    <label for="nombre" class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Profesor" value="<?=($profesor[nombre])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?=($profesor[email])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="col-lg-2">
                                      <div class="checkbox">
                                        <label>
                                        <input type="checkbox" <? if($profesor[emailpublico]==1){?> checked <?}?> name="emailpublico">
                                          Visible
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="institucion" class="col-lg-2 col-sm-2 control-label">Institución</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="institucion" name="institucion" placeholder="" value="<?=($profesor[institucion])?>" >
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="puesto" class="col-lg-2 col-sm-2 control-label">Cargo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="puesto" name="puesto" placeholder="" value="<?=($profesor[puesto])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="pais_id" class="col-lg-2 col-sm-2 control-label">Pais</label>
                                    <div class="col-lg-10">  
                                      <select class="form-control" id="pais_id" name="pais_id" required>
                                        <?
                                          $query="SELECT * FROM paises";
                                          $paises=$bd->ExecuteE($query);
                                          $i=0;
                                          foreach ($paises as &$pais) {
                                          $i++;
                                        ?>
                                         <option <? if($profesor[pais_id]==$pais[id]){?> selected <?}?>  value="<?=($pais[id])?>"> <?=($pais[pais])?> </option>
                                        <?
                                         }
                                        ?>
                                        <p class="help-block"></p>
                                      </select>      
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="curriculum" class="col-lg-2 col-sm-2 control-label">Curriculum</label>

                                    <div class="col-lg-10">
                                        <textarea class="wysihtml5 form-control" rows="10" id="curriculum" name="curriculum"  required><?=($profesor[curriculum])?></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                          <label  for="cv" class="control-label col-md-2">Subir Curriculum en .pdf</label>
                                          <div class="controls col-md-10">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecciona Archivo</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                                <input type="file" class="default" id="cv" name="cv" />
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                          </div>
                                   </div>

                                <div class="form-group"> 
                                          <label for="foto_profesor" class="col-lg-2 col-sm-2 control-label">Foto de perfil</label>                                       
                                          <div class="col-lg-10">
                                             <div class="fileupload fileupload-new" data-provides="fileupload">                                               
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=No+hay+imagen" alt="" />                                                   
                                                  </div>                                                  
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i>Subir Foto en .png</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar </span>
                                                   <input type="file" class="default" id="foto_profesor" name="foto_profesor"/>
                                                   </span>
                                                   <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover </a>
                                                  </div>
                                              </div>                                             
                                          </div>
                                  </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                      <div class="checkbox">
                                        <label>
                                        <input type="checkbox" <? if($profesor[activo]){?> checked <?}?> name="activo">
                                          Activado
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$profesor[id]?>">
                                        <button type="submit" class="btn btn-danger">Guardar</button>
                                    </div>
                                </div>
                            </form>
                          
                        </div>
                      </section>
                        <?
                      }
                      }elseif (isset($_GET[stats])) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Estadisticas de puntuacion
                              <a href="./?action=profesores&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver profesores</a>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped table-hovered">
                              <thead>
                                <tr>
                                  <th>Profesor</th>
                                  <th>Puntuación </th>
                                  <th>Votantes </th>
                                </tr>
                              </thead>
                              <tbody>
                              <?
                              $query="SELECT * FROM profesores ";
                              $preofesores=$bd->ExecuteE($query);
                              foreach ($preofesores as &$profesor) {
                              ?>
                                <tr>
                                  <td><?=$profesor['nombre']?></td>
                                  
                                  <?
                                            $sql_calificaciones  = "SELECT sum(estrellas) as total, count(id_usuario) as votantes  FROM  calificaciones_profesor where id_profesor=".$profesor['id'];
                                            $res_calificaciones  = $bd->ExecuteE($sql_calificaciones);
                                            $estrellas=0;
                                            $votantes=0;
                                            foreach ($res_calificaciones as &$calificacion) { 
                                              if($calificacion['total']>0){
                                                $votantes=$calificacion['votantes'];
                                                $estrellas=$calificacion['total']/$calificacion['votantes'];
                                              }  

                                              }
                                            ?>
                                            
                                            <td><?=number_format($estrellas, 1, ',', '')?> </td><td> <?=$votantes?></td>
                                            
                                </tr>
                              <?}?>                              
                              </tbody>
                            </table>
                            <div class="flot-chart">
                                <script>
                              var data_r = [
                            <?
                              $query="SELECT date(fecha_hora) as fecha FROM logeos group by date(fecha_hora) ";
                              $fechas=$bd->ExecuteE($query);
                              foreach ($fechas as &$fecha) {
                                $query="SELECT count(*) as total FROM usuarios WHERE fecha_registro>='".$fecha['fecha']." 00:00:01' and fecha_registro<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                              ?>
                               { label: "<?=$fecha['fecha']?>, <?=$total['total']?>",  data: <?=$total['total']?>},
                              <?}
                                      }
                               ?>
                                         ];
                                </script> 
                              <div id="graph_r" class="chart"></div>
                            </div>
                        </div>
                      </section>
                        <?
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