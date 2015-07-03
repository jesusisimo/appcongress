<?
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
ini_set("display_errors", 0);
session_start();
if(!isset($_SESSION['usuario'])){
  header("location: login.php");
}
include('bd/mnpBD2.class.php');
include 'datos_sociedad.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="App congress">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>App Congress | <?=$sociedad['evento']?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <?
      include "header.php";
      ?>
      <!--header end-->
      <!--sidebar start-->
      <?
      include "menu.php";
      ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--state overview start-->  
              <div class="row">
              
              
              
                      <!----------------Aqui todo el contenido-->
                      <?
                        $script="main.php";
                        if(isset($_GET['action'])){
                          if($_GET['action']=="perfil"){
                              $script="perfil.php";
                            }elseif ($_GET['action']=="profesores") {
                              $script="profesores.php";
                            }elseif ($_GET['action']=="profesor") {
                              $script="profesor.php";
                            }elseif ($_GET['action']=="salones") {
                              $script="salones.php";
                            }elseif ($_GET['action']=="salon") {
                              $script="salon.php";
                            }elseif ($_GET['action']=="patrocinadores") {
                              $script="patrocinadores.php";
                            }elseif ($_GET['action']=="patrocindador") {
                              $script="patrocindador.php";
                            }elseif ($_GET['action']=="comite_organizador") {
                              $script="comite_organizador.php";
                            }elseif ($_GET['action']=="mapa") {
                              $script="mapa.php";
                            }elseif ($_GET['action']=="actividades") {
                              $script="actividades.php";
                            }elseif ($_GET['action']=="actividad") {
                              $script="actividad.php";
                            }elseif ($_GET['action']=="categorias") {
                              $script="categorias.php";
                            }elseif ($_GET['action']=="paises") {
                              $script="agenda.php";
                            }elseif ($_GET['action']=="agenda") {
                              $script="agenda.php";
                            }
                        }else{
                          $script="";
                        }
                        include $script;
                      ?>
                      <!----------------fin de contenido-------->
              </div>

          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <?
        include 'footer.php';
      ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <script src="js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/count.js"></script>
<?
if($_GET['action']=="mapa"){
  ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

    <script type="text/javascript">
// creamos un array con la información de todos los puntos:
// su nombre, latitud, longitud,
// el icono que le queramos asignar (ver más adelante)
// y un html totalmente personalizable a vuestro gusto, incluyendo imágenes y enlaces
//
function inicializaGoogleMaps() {
    // Coordenadas del centro de nuestro recuadro principal
    var myX=0;
    var myY=0;
    //-------------------------------------------------------------------
      // Try HTML5 geolocation
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            myX=position.coords.latitude;
            myY=position.coords.longitude;          
         

          var mapOptions = {
                zoom: 12,
                center: new google.maps.LatLng(19.425215, -99.130862),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            }
          
          var misPuntos = [
          <?
              $query  = "SELECT * FROM ubicaciones WHERE activo=1";
              $ubicaciones= $bd->ExecuteE($query);
            ?>
          <?
          foreach ($ubicaciones as &$ubicacion) {
          ?>
            ["<?=$ubicacion['ubicacion']?>", "<?=$ubicacion['latitud']?>", "<?=$ubicacion['longitud']?>", "icon_<?=$ubicacion['id']?>", "<div><?=$ubicacion['ubicacion']?></div>"],
          <?
          }
          ?>
            ["Mi ubicacion", myX, myY, "icon_yo", "<div>Me encuentro aqui</div>"],
          ];
          var map = new google.maps.Map(document.getElementById("gmap_marker"), mapOptions);
          setGoogleMarkers(map, misPuntos);
          });
        } else {
          var mapOptions = {
                zoom: 12,
                center: new google.maps.LatLng(0, 0),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
          var misPuntos = [
            <?
              $query  = "SELECT * FROM ubicaciones WHERE activo=1";
              $ubicaciones= $bd->ExecuteE($query);
            ?>
          <?
          foreach ($ubicaciones as &$ubicacion) {
          ?>
            ["<?=$ubicacion['ubicacion']?>", "<?=$ubicacion['latitud']?>", "<?=$ubicacion['longitud']?>", "icon_<?=$ubicacion['id']?>", "<div><?=$ubicacion['ubicacion']?></div>"],
          <?
          }
          ?>

          ];
          var map = new google.maps.Map(document.getElementById("gmap_marker"), mapOptions);
          setGoogleMarkers(map, misPuntos);
          alert("Este navegador no soporta geolocalizació");
        }


}

var markers = Array();
var infowindowActivo = false;
function setGoogleMarkers(map, locations) {
  var bounds = new google.maps.LatLngBounds();
    // Definimos los iconos a utilizar con sus medidas
     <?
              $query  = "SELECT * FROM ubicaciones WHERE activo=1";
              $ubicaciones= $bd->ExecuteE($query);
            ?>
          <?
          foreach ($ubicaciones as &$ubicacion) {
          ?>
      var icon_<?=$ubicacion['id']?> = new google.maps.MarkerImage(
        "<?=$ubicacion['icono']?>",
        null, /* size is determined at runtime */
        null, /* origin is 0,0 */
        null, /* anchor is bottom center of the scaled image */
        new google.maps.Size(40, 40)
      );        
          <?
          }
    ?>




    var icon_yo = new google.maps.MarkerImage(
        "<?=$_SESSION['usuario']['foto']?>",
        null, /* size is determined at runtime */
        null, /* origin is 0,0 */
        null, /* anchor is bottom center of the scaled image */
        new google.maps.Size(40, 40)
        );
    for(var i=0; i<locations.length; i++) {
        var elPunto = locations[i];
        var myLatLng = new google.maps.LatLng(elPunto[1], elPunto[2]);
        bounds.extend(myLatLng);
        markers[i]=new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: eval(elPunto[3]),
            title: elPunto[0]
        });
        markers[i].infoWindow=new google.maps.InfoWindow({
            content: elPunto[4]
        });
        google.maps.event.addListener(markers[i], 'click', function(){      
            if(infowindowActivo)
                infowindowActivo.close();
            infowindowActivo = this.infoWindow;
            infowindowActivo.open(map, this);
        });
    }
      map.setCenter(bounds.getCenter());
      map.fitBounds(bounds);
}

inicializaGoogleMaps();
</script>


  <?
}
?>
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

  </script>
  <?
  if($_GET['action']=="actividad"){
  ?>
  <script>
  function addAgenda (id, tipo, existeconf) {
    var mensaje="Realmente deseas agregar a tus actividades?";
    if(existeconf>0){
      mensaje=mensaje+" Se agendaran todas las conferencias correspondientes";
    }

    if(confirm(mensaje)){
    $.ajax({
      url: 'addAgenda.php',
      type: 'POST',
      dataType: 'json',
      data: {id: id, tipo: tipo},
    })
    .done(function(json) {
      if(json.success){
        $("#agendar"+tipo+"_"+id).html('<a href="javascript:;" onclick="delAgenda('+id+','+tipo+', '+existeconf+')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-ban"></i> Quitar de mi agenda</a>');
        if(tipo==1){
          $(".age-conf").html('<a href="javascript:;" class="btn btn-danger btn-sm pull-right"><i class="fa fa-ban"></i> Refresca para poder borrar</a>');
        }
        alert("Actividad agendada");
      }else{
        alert("No se pudo agendar la actividad");
      }
    })
    .fail(function() {
      alert("Ocurrio un error intente de nuevo");
    })
  }
    
  }
    function delAgenda (id, tipo, existeconf) {
    var mensaje="Realmente deseas quitar de tus actividades?";
    if(existeconf>0){
      mensaje=mensaje+" Se quitaran todas las conferencias correspondientes";
    }

    if(confirm(mensaje)){
    $.ajax({
      url: 'delAgenda.php',
      type: 'POST',
      dataType: 'json',
      data: {id: id, tipo: tipo},
    })
    .done(function(json) {
      if(json.success){
        $("#agendar"+tipo+"_"+id).html('<a href="javascript:;" onclick="addAgenda('+id+','+tipo+', '+existeconf+')" class="btn btn-primary btn-sm pull-right"><i class="fa fa-calendar"></i> Agendar</a>');
        if(tipo==1){
          $(".age-conf").html('<a href="javascript:;" class="btn btn-primary btn-sm pull-right"><i class="fa fa-calendar"></i> Refresca para poder agendar</a>');
        }
        alert("Actividad borrada de agenda");
      }else{
        alert("No se pudo quitar la actividad");
      }
    })
    .fail(function() {
      alert("Ocurrio un error intente de nuevo");
    })
  }
    
  }
  </script>
  <?
  }
  ?>
  </body>
</html>
