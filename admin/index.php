<?
  session_start();
  set_time_limit(0);

  if(!isset($_SESSION['admin']['id'])){
    header("location:login.php");
    exit;
  }
  if (isset($_GET['action']) && ($_GET['action']=="calificaciones" || $_GET['action']=="resultados" || $_GET['action']=="usuarios" || $_GET['action']=="stats_examen" || $_GET['action']=="stats_votacion") ) {
    ini_set("display_errors", 1);
  }
  include('../bd/mnpBD2.class.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Administración</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />
     <link rel="stylesheet" type="text/css" href="../assets/jquery-multi-select/css/multi-select.css" />
   
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
      .table-responsive{
          min-height: 0.01%;
    overflow-x: auto;
      }
    </style>
  </head>

  <body>

  <section id="container" >
<?
  include 'header.php';
  include 'menu.php';
?>
      <!--main content start-->
      <section id="main-content" style="min-height: 550px;">
          <section class="wrapper">
          <?
          if(!isset($_GET['action'])){
            $script="main.php";
          }elseif ($_GET['action']=="paises") {
            $script="paises.php";
          }elseif ($_GET['action']=="salones") {
            $script="salones.php";
          }elseif ($_GET['action']=="patrocinadores") {
            $script="patrocinadores.php";
          }elseif ($_GET['action']=="profesores") {
            $script="profesores.php";
          }elseif ($_GET['action']=="costos") {
            $script="costos.php";
          }elseif ($_GET['action']=="actividades") {
            $script="actividades.php";
          }elseif ($_GET['action']=="agendas") {
            $script="agendas.php";
          }elseif ($_GET['action']=="categorias") {
            $script="categorias.php";
          }elseif ($_GET['action']=="coordinadores") {
            $script="coordinadores.php";
          }elseif ($_GET['action']=="comite_organizador") {
            $script="comite_organizador.php";
          }elseif ($_GET['action']=="conferencias") {
            $script="conferencias.php";
          }elseif ($_GET['action']=="logeos") {
            $script="logeos.php";
          }elseif ($_GET['action']=="publicidades") {
            $script="publicidades.php";
          }elseif ($_GET['action']=="sociedad") {
            $script="sociedad.php";
          }elseif ($_GET['action']=="ubicaciones") {
            $script="ubicaciones.php";
          }elseif ($_GET['action']=="usuarios") {
            $script="usuarios.php";
          }elseif ($_GET['action']=="redes_sociales") {
            $script="redes_sociales.php";
          }elseif ($_GET['action']=="votaciones") {
            $script="votaciones.php";
          }elseif ($_GET['action']=="candidatos") {
            $script="candidatos.php";
          }elseif ($_GET['action']=="mensajes") {
            $script="mensajes.php";
          }elseif ($_GET['action']=="examenes") {
            $script="examenes.php";
          }elseif ($_GET['action']=="preguntas") {
            $script="preguntas.php";
          }elseif ($_GET['action']=="opciones") {
            $script="opciones.php";
          }elseif ($_GET['action']=="resultados") {
            $script="resultados.php";
          }elseif ($_GET['action']=="calificaciones") {
            $script="calificaciones.php";
          }elseif ($_GET['action']=="stats_examen") {
            $script="stats_examen.php";
          }elseif ($_GET['action']=="stats_votacion") {
            $script="stats_votacion.php";
          }else{
            $script="main.php";
          }
          include $script;
          ?>
          </section>
      </section>
      <!--main content end-->
<?
include 'footer.php';
?>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="../assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="../js/owl.carousel.js" ></script>
    <script src="../js/jquery.customSelect.min.js" ></script>
    <script src="../js/respond.min.js" ></script>
    <script type="text/javascript" src="../assets/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="../assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
  



    <script src="../assets/flot/jquery.flot.js"></script>
    <script src="../assets/flot/jquery.flot.resize.js"></script>
    <script src="../assets/flot/jquery.flot.pie.js"></script>
    <script src="../assets/flot/jquery.flot.stack.js"></script>
    <script src="../assets/flot/jquery.flot.crosshair.js"></script>

    <!--common script for all pages-->
    <script src="../js/common-scripts.js"></script>



  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
        autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });


    $('#coordinadores').multiSelect();
    $('#coordinadoresadd').multiSelect({
        selectableOptgroup: true
    });
  </script>
  <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
  <script src="../js/all-validaciones.js"></script>
  <!--------------------------------Funciones notificaciones, mensajes asctualizaciones------------------>
  <script src="../chat/fancywebsocket.js"></script>
  <script>
    var ultimo=null;
    var Server;
    var id_usuario=<?=$_SESSION['admin']['id']?>;
    
    function send( text, tipo ) {
      Server.send( 'message', '{"tx":"'+id_usuario+'", "rx":null, "message":"'+text+'", "type":"'+tipo+'"}');
      $("#mensaje").val("");
    }

    $(document).ready(function() {
      Server = new FancyWebSocket('ws://75.98.173.239:9300',id_usuario);
      //Let the user know we're connected
      Server.bind('open', function() {
        //console.log( "Conectado." );
      });

      //OH NOES! Disconnection occurred.
      Server.bind('close', function( data ) {
        //alert( "No soporta websocket." );
      });

      //Log any messages sent from server
      Server.bind('message', function( data ) {
        //console.log(data);
      });
      Server.connect();

    });
    $("#send-msg").click(function(event) {
      var tipo= $('input:radio[name=tipomsg]:checked').val();
      if($("#mensaje").val()!=""){
        //guardar en base y enviar------------------
        $( "#send-msg" ).addClass( "disabled" );
        $("#send-msg").html('Enviando...');
        var mensaje=$("#mensaje").val();
        if(tipo==1){
          mensaje=mensaje+"<a class='btn btn-danger btn-xs' href='./?action=votaciones&view'>Participar ahora</a>";
        }
          $.ajax({
              url : '../messenger.php',
              data : { mensaje:mensaje, tipo: tipo, action:"addAll", remitente_id:<?=$_SESSION['admin']['id']?>},
              type : 'POST',
              dataType : 'json',
              success : function(json) {
                if(json.success){
                  send( mensaje, tipo );
                  document.getElementById('mensaje').value="";
                  $( "#send-msg" ).removeClass( "disabled" );
                  $("#send-msg").html("Enviar"); 
                }else{
                  alert("Ocurrio un error, intente de nuevo");
                   $( "#send-msg" ).removeClass( "disabled" );
                  $("#send-msg").html("Enviar"); 
                }
              },
              error : function(jqXHR, status, error) {
                 alert('Disculpe, existió un problema, intente de nuevo');
              },
              complete : function(jqXHR, status) {
                 $( "#send-msg" ).removeClass( "disabled" );
                  $("#send-msg").html("Enviar"); 
              }
          }); 
        //------------------------------------------
      }
    });

</script>
<? 
if(isset($_GET['action']) && $_GET['action']=="candidatos" && isset($_GET['votacion'])){
?>
 <script>

    $(function () {
        // data
        

        // GRAPH 2
        $.plot($("#graph2"), data,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });


        



    });
 </script>
 <?}?>


<? 
if(isset($_GET['action']) && $_GET['action']=="preguntas" && isset($_GET['examen'])){
?>
 <script>

    $(function () {
        // data
        <?
                                $query="SELECT * FROM preguntas WHERE examen_id=".$_GET['examen'];
                                $preguntas=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($preguntas as &$pregunta) {
                                  $i++;
                              ?>
                              
        // GRAPH 2
        $.plot($("#graph<?=$i?>"), data_<?=$i?>,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });    
<?}?>


    });
 </script>
 <?}?>
 <? 
if(isset($_GET['action']) && $_GET['action']=="opciones" && isset($_GET['pregunta'])){
?>
 <script>

    $(function () {
        // data
        

        // GRAPH 2
        $.plot($("#graph2"), data,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });


        



    });
 </script>
 <?}?>
 <? 
if(isset($_GET['action']) && $_GET['action']=="logeos" && isset($_GET['stats'])){
?>
 <script>

    $(function () {
        // data
        

        // GRAPH 2
        $.plot($("#graph_l"), data_l,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
        $.plot($("#graph_r"), data_r,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });


        



    });
 </script>
 <?}?>


<? 
if(isset($_GET['action']) && $_GET['action']=="stats_examen"){
?>
 <script>
    $(function () {
        // data
        <?
                        $query="SELECT * FROM examenes WHERE id!=1 order by id asc";
                        $examenes=$bd->ExecuteE($query);
                        $e=0;
                        foreach ($examenes as &$examen) {
                          $e++;
                                $query="SELECT * FROM preguntas WHERE examen_id=".$examen['id'];
                                $preguntas=$bd->ExecuteE($query);
                                $i=0;
                                foreach ($preguntas as &$pregunta) {
                                  $i++;
                              ?>
                              
        // GRAPH 2
        $.plot($("#graph_<?=$e?>_<?=$i?>"), data_<?=$e?>_<?=$i?>,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });    
<?}}?>


    });
 </script>
 <?}?>



<? 
if(isset($_GET['action']) && $_GET['action']=="stats_votacion"){
?>
 <script>

    $(function () {
        // data
        
<?
                      $query="SELECT * FROM votaciones";
                      $votaciones=$bd->ExecuteE($query);
                      $v=0;
                      foreach ($votaciones as &$votacion) {
                        $v++;
                              
                      ?>
        // GRAPH 2
        $.plot($("#graph_<?=$v?>"), data_<?=$v?>,
            {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function(label, series){
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                            },
                            background: { opacity: 0.8 }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
<?}?>
    });
 </script>
 <?}?>

  </body>
</html>
