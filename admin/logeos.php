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
                      if(!isset($_GET[add]) && !isset($_GET[edit])  && !isset($_GET[stats])){
                        ?>
                      <section class="panel table-responsive">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Logeos</h1>
                              </div>
                              <a href="./?action=logeos&stats" class="btn btn-sm btn-success pull-right"><i class="fa fa-bar-chart-o"></i> Estadisticas</a>
                          </div>
                          <table class="table table-hover table-advance">
                              <thead>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Fecha y Hora</th>
                                <th>Dirección IP</th>
                                <th>Dispositivo</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                              <?
                                $query="SELECT log.id, us.usuario as usuario, log.fecha_hora, log.ip, log.dispositivo FROM logeos as log INNER JOIN usuarios as us on log.usuario_id=us.id order by fecha_hora desc";
                                $logeos=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($logeos as &$usuario_id) {
                                  $i++;
                              ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=utf8_encode($usuario_id[usuario])?></td>
                                    <td><?=utf8_encode($usuario_id[fecha_hora])?></td>
                                    <td><?=utf8_encode($usuario_id[ip])?></td>
                                    <td><?=utf8_encode($usuario_id[dispositivo])?></td>
                                    
                                    <td>
                                      <a href="./?action=logeos&edit&id=<?=$usuario_id[id]?>" class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 
                                      <a href="save.php?action=logeos&delete&id=<?=$usuario_id[id]?>" class="btn btn-xs btn-danger" onclick="return confirm('Realmente desea eliminar?');" ><i class="fa fa-trash-o"></i></a>
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
                              Alta de Logeos
                              <a href="./?action=logeos&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Logeos</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-usuario_id" role="form" method="post" action="save.php?action=logeos&add">
                                
                                <div class="form-group">
                                    <label for="usuario_id" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                      <select class="form-control" id="usuario_id" name="usuario_id" required>
                                        <?
                                         $query="SELECT * FROM usuarios";
                                          $usuarios=$bd->ExecuteE($query);
                                          $i=0;
                                          foreach ($usuarios as &$nombre) {
                                          $i++;
                                        ?>          
                                        <option value="<?=utf8_encode($nombre[id])?>"><?=utf8_encode($nombre[nombre])?></option>
                                        <?
                                         }
                                        ?>
                                      </select>
                                      <p class="help-block"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                      <label for="fecha_hora" class="control-label col-md-3">Fecha y hora</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="2012-06-15 14:45" id="fecha_hora" name="fecha_hora" readonly class="form_datetime form-control">
                                      </div>
                                </div>
                                  
                                 <div class="form-group">
                                    <label for="ip" class="col-lg-2 col-sm-2 control-label">IP</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="ip" name="ip" placeholder="Direccion IP" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dispositivo" class="col-lg-2 col-sm-2 control-label">Dispositivo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="dispositivo" name="dispositivo" placeholder="Dispositivo" required>
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
                        $query="SELECT *FROM logeos WHERE id=".$_GET[id];
                        $logeos=$bd->ExecuteE($query);
                        foreach ($logeos as &$usuario_id) {
                        ?>
                      <section class="panel">
                        <header class="panel-heading">
                              Editar usuario
                              <a href="./?action=logeos&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Logeos</a>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" id="add-usuario_id" role="form" method="post" action="save.php?action=logeos&edit">
                                 <div class="form-group">
                                    <label for="usuario_id" class="col-lg-2 col-sm-2 control-label">Usuario</label>
                                    <div class="col-lg-10">
                                      <select class="form-control" id="usuario_id" name="usuario_id" required>
                                        <?
                                         $query="SELECT * FROM usuarios";
                                          $usuarios=$bd->ExecuteE($query);
                                          $i=0;
                                          foreach ($usuarios as &$nombre) {
                                          $i++;
                                        ?>          
                                        <option value="<?=utf8_encode($nombre[id])?>"><?=utf8_encode($nombre[nombre])?></option>
                                        <?
                                         }
                                        ?>
                                      </select>
                                      <p class="help-block"></p>
                                    </div>
                                </div>

                                 <div class="form-group">
                                      <label for="fecha_hora" class="control-label col-md-3">Fecha y hora</label>
                                      <div class="col-lg-10">
                                          <input size="16" type="text" value="<?=utf8_encode($usuario_id[fecha_hora])?>" id="fecha_hora" name="fecha_hora" readonly class="form_datetime form-control">
                                      </div>
                                  </div>

                                 <div class="form-group">
                                    <label for="ip" class="col-lg-2 col-sm-2 control-label">IP</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="ip" name="ip" placeholder="Direccion IP" value="<?=utf8_encode($usuario_id[ip])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dispositivo" class="col-lg-2 col-sm-2 control-label">Dispositivo</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="dispositivo" name="dispositivo" placeholder="Dispositivo" value="<?=utf8_encode($usuario_id[dispositivo])?>" required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="id" id="id" value="<?=$usuario_id[id]?>">
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
                              Estadisticas de registro
                              <a href="./?action=usuarios&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver usuarios</a>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped table-hovered">
                              <thead>
                                <tr>
                                  
                                  <th>Fecha</th>
                                  <th>Registrados </th>
                                </tr>
                              </thead>
                              <tbody>
                              <?
                              $total_u=0;
                              $query="SELECT date(fecha_hora) as fecha FROM logeos group by date(fecha_hora) ";
                              $fechas=$bd->ExecuteE($query);
                              foreach ($fechas as &$fecha) {
                              ?>
                                <tr>
                                  <td><?=$fecha['fecha']?></td>
                                  <td>
                                    <?
                                      $query="SELECT count(*) as total FROM usuarios WHERE fecha_registro>='".$fecha['fecha']." 00:00:01' and fecha_registro<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                                        echo $total['total'];
                                        $total_u=$total_u+$total['total'];
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <?}?>                              
                              </tbody>
                              <thead>
                                <tr>
                                  <th>Total</th>
                                  <th><?=$total_u?></th>
                                </tr>
                              </thead>
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
                      <section class="panel">
                        <header class="panel-heading">
                              Estadisticas de logeos
                              <a href="./?action=logeos&view" class="btn btn-success pull-right btn-sm"><i class="fa fa-eye"></i> Ver Logeos</a>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped table-hovered">
                              <thead>
                                <tr>
                                  
                                  <th>Fecha</th>
                                  <th>Android</th>
                                  <th>Iphone</th>
                                  <th>Ipad</th>
                                  <th>Web</th>
                                  <th>Total logeos</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?
                              $total_android=0;
                              $total_iphone=0;
                              $total_ipad=0;
                              $total_web=0;
                              $total_total=0;
                              $query="SELECT date(fecha_hora) as fecha FROM logeos group by date(fecha_hora) ";
                              $fechas=$bd->ExecuteE($query);
                              foreach ($fechas as &$fecha) {
                              ?>
                                <tr>
                                  <td><?=$fecha['fecha']?></td>
                                  <td>
                                    <?
                                      $query="SELECT count(*) as total FROM logeos WHERE dispositivo like '%android%'  and dispositivo not like '%ipad%'  and dispositivo not like '%iphone%' and fecha_hora>='".$fecha['fecha']." 00:00:01' and fecha_hora<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                                        echo $total['total'];
                                        $total_android=$total_android+$total['total'];
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?
                                      $query="SELECT count(*) as total FROM logeos WHERE dispositivo like '%iphone%'  and dispositivo not like '%ipad%' and dispositivo not like '%andorid%' and fecha_hora>='".$fecha['fecha']." 00:00:01' and fecha_hora<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                                        echo $total['total'];
                                        $total_iphone=$total_iphone+$total['total'];
                                      }
                                    ?>                                    
                                  </td>
                                  <td>
                                    <?
                                      $query="SELECT count(*) as total FROM logeos WHERE dispositivo like '%ipad%' and dispositivo not like '%iphone%'  and dispositivo not like '%android%' and fecha_hora>='".$fecha['fecha']." 00:00:01' and fecha_hora<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                                        echo $total['total'];
                                        $total_ipad=$total_ipad+$total['total'];
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?
                                      $query="SELECT count(*) as total FROM logeos WHERE (dispositivo not like '%android%' and dispositivo not like '%iphone%' and dispositivo not like '%ipad%' ) and fecha_hora>='".$fecha['fecha']." 00:00:01' and fecha_hora<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                                        echo $total['total'];
                                         $total_web=$total_web+$total['total'];
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?
                                      $query="SELECT count(*) as total FROM logeos WHERE fecha_hora>='".$fecha['fecha']." 00:00:01' and fecha_hora<'".$fecha['fecha']." 23:59:59' ";
                                      $totales=$bd->ExecuteE($query);
                                      foreach ($totales as &$total) {
                                        echo $total['total'];
                                        $total_total=$total_total+$total['total'];
                                      }
                                    ?>
                                  </td>
                                </tr>
                                
                              <?}?>
                                <thead>
                                  <tr>
                                    
                                    <th></th>
                                    <th><?=$total_android?></th>
                                    <th><?=$total_iphone?></th>
                                    <th><?=$total_ipad?></th>
                                    <th><?=$total_web?></th>
                                    <th><?=$total_total?> </th>
                                  </tr>
                                </thead>
                              
                              </tbody>
                            </table>
                            <div class="flot-chart">
                            <script>
                                          var data_l = [
                                         { label: "Android, <?=$total_android?>",  data: <?=$total_android?>},
                                         { label: "Iphone, <?=$total_iphone?>",  data: <?=$total_iphone?>},
                                         { label: "Ipad, <?=$total_ipad?>",  data: <?=$total_ipad?>},
                                         { label: "Web, <?=$total_web?>",  data: <?=$total_web?>},
                                         
                                         ];

                                </script> 
                              <div id="graph_l" class="chart"></div>
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