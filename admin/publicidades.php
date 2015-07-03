            
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
                                  <h1>Publicidades</h1>
                              </div>
                              <a href="./?action=publicidades&add" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus-square-o"></i> Agregar Publicidad</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Publicidad</th>
                                <th>Acciones</th>
                                <th>Ver Banner</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT * FROM publicidades";
                                $publicidades=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($publicidades as &$publicidad) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=($publicidad[publicidad])?></td>
                                    
                                    <td>
                                      <a href="./?action=publicidades&edit&id=<?=$publicidad[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=publicidades&delete&id=<?=$publicidad[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
                                      
                                    </td>
                                    <td>
                                      <a href="../banner_publicidad/banner_<?=$publicidad[id]?>.png" target="_blanck" class="btn btn-xs btn-success" ><i class="fa fa-eye"></i></a>
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
                              Alta de Publicidades
                              <a href="./?action=publicidades&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Publicidades</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-publicidad" role="form" method="post" action="save.php?action=publicidades&add" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="publicidad" class="col-lg-2 col-sm-2 control-label">Nombre de la Empresa</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="publicidades" name="publicidad" placeholder="Nombre" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                <label for="img_publicidad" class="col-lg-2 col-sm-2 control-label">Banner</label>                                    
                                          <div class="col-lg-10">

                                             <div class="fileupload fileupload-new" data-provides="fileupload">                                               
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=No+hay+imagen" alt="" />                                                   
                                                  </div>                                                  
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecciona Banner</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar </span>
                                                   <input type="file" class="default" id="img_publicidad" name="img_publicidad"/>
                                                   </span>
                                                   <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover </a>
                                                  </div>
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
                        $query="SELECT *FROM publicidades WHERE id=".$_GET[id];
                        $publicidades=$bd->ExecuteE($query);
                        foreach ($publicidades as &$publicidad) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar Publicidad
                              <a href="./?action=publicidades&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Publicidades</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-publicidad" role="form" method="post" action="save.php?action=publicidades&edit" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="publicidad" class="col-lg-2 col-sm-2 control-label">Nombre de la Empresa</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="publicidades" name="publicidad" placeholder="Nombre" value="<?=($publicidad[publicidad])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                          <label for="img_publicidad" class="col-lg-2 col-sm-2 control-label">Banner</label>                                     
                                          <div class="col-lg-10">
                                             <div class="fileupload fileupload-new" data-provides="fileupload">                                               
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=No+hay+imagen" alt="" />                                                   
                                                  </div>                                                  
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecciona Banner</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar </span>
                                                   <input type="file" class="default" id="img_publicidad" name="img_publicidad"/>
                                                   </span>
                                                   <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover </a>
                                                  </div>
                                              </div>                                             
                                          </div>
                                  </div>
                               
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$publicidad[id]?>">
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