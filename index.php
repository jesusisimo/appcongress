<?
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['usuario'])){
  header("location: login.php");
}

include('bd/mnpBD2.class.php');
include 'datos_sociedad.php';

 function esMobil(){
  //buscar si esta abriendo desde la apliacion de android
  $buscar    = 'mobile';
  $cadena = $_SERVER['HTTP_USER_AGENT'];

  $es_mobil = stripos($cadena, $buscar);
  
  if(($es_mobil !== false)){ 
  //si es movil
    return true;
  }else{
    return false;
  }
}
 function esIphone(){
  //buscar si esta abriendo desde la apliacion de android
  $buscar    = 'iphone';
  $cadena = $_SERVER['HTTP_USER_AGENT'];

  $es_iphone = stripos($cadena, $buscar);
  
  if(($es_iphone !== false)){ 
  //si es iphone
    return true;
  }else{
    return false;
  }
}
 function esIpad(){
  //buscar si esta abriendo desde la apliacion de android
  $buscar    = 'ipad';
  $cadena = $_SERVER['HTTP_USER_AGENT'];

  $es_ipad = stripos($cadena, $buscar);
  
  if(($es_ipad !== false)){ 
  //si es movil
    return true;
  }else{
    return false;
  }
}

 function appNativa(){
  //buscar si esta abriendo desde la apliacion de android
  $buscar    = 'android';
  $buscar2    = 'chrome';
  $buscar3    = 'firefox';
  $buscar4    = 'ipad';
  $buscar5    = 'iphone';
  $buscar6    = 'safari';

  $cadena = $_SERVER['HTTP_USER_AGENT'];

  $es_android = stripos($cadena, $buscar);
  $es_chrome = stripos($cadena, $buscar2);
  $es_firefox = stripos($cadena, $buscar3);
  $es_ipad = stripos($cadena, $buscar4);
  $es_iphone = stripos($cadena, $buscar5);
  $es_safari = stripos($cadena, $buscar6);

  //if((($es_android !== false) && ($es_firefox === false) ) ||  (($es_iphone !== false) && ($es_firefox === false))  || (($es_ipad !== false) && ($es_safari === false) ) ){ 
  if((($es_android !== false) && ($es_firefox === false) )   ){ 
  
  //si es android y no es movile suponemos que es desde applicacion nativa
    return true;
  }else{
    return false;
  }
}
//revisar si hay mensajes---------------------------------------
$hay_mensajes=0;
$hay_votaciones=0;
if(!isset($_GET['action']) || (isset($_GET['action']) && $_GET['action']!="descubrir")){
  $sql_mensajes  = "SELECT * FROM mensajes where visto=0 and receptor_id=".$_SESSION['usuario']['id']."  group by remitente_id order by tipo desc ";
  $res_mensajes  = $bd->ExecuteE($sql_mensajes);
  foreach ($res_mensajes as $mensajes){
      $hay_mensajes++;
      if($mensajes['tipo']==1){
        $hay_votaciones=1;
      }
  }
}
function versionAndroid()
{
  $buscar    = 'android';
  $cadena = $_SERVER['HTTP_USER_AGENT'];
  $version = "4.4";
  $posicion=strripos($cadena, $buscar);
  if($posicion!="" && $posicion>0){
    $version=substr($cadena, $posicion+8, 5);
  }
  return $version;
}
//---------------------------------------------------------------
if(isset($_GET['action']) && $_GET['action']=="actividades" && isset($_GET['cat']) && $_GET['cat']==2){
  header("location: ./?action=actividad&id=51&view&cat=2&conf");
  exit;
}
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
    <?
    if(isset($_GET['action']) && $_GET['action']=="agenda"){
      ?>
    <link rel='stylesheet' type='text/css' href='http://www.smago.org.mx/diplomado2015/diplomado/estudiantes/assets/fullcalendar/demos/cupertino/theme.css' />
    <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <?}?>
    <?
    if(isset($_GET['action']) && $_GET['action']=="descubrir"){
      ?>
        <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
      <?}?>
        <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript"> 
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8100831-22']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

  </head>
  <audio id="audio_fb">
    <source type="audio/mpeg" src="sonidos/sonido_notificacion.mp3"></source>
    <source type="audio/ogg" src="sonidos/sonido_notificacion.ogg"></source>
    <source type="audio/wav" src="sonidos/sonido_notificacion.wav"></source>
</audio>
  <body>

  <section id="container" >
      <!--header start-->
      <!--header end-->
      <!--sidebar start-->
      <?
      
        include "header.php";
        include "menu.php";;
      
      ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content" <? if(esMobil()) {  ?> style="margin-left: 0px;" <?}?> >
          <section class="wrapper"  >
              <!--state overview start-->  
              <div class="row">
                      <!----------------Aqui todo el contenido-->
                      <?
                        $script="main.php";
                        if(isset($_GET['action'])){
                          if($_GET['action']=="perfil"){
                              $script="perfil.php";
                            }elseif ($_GET['action']=="edit-perfil") {
                              $script="edit-perfil.php";
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
                              $script="paises.php";
                            }elseif ($_GET['action']=="agenda") {
                              $script="agenda.php";
                            }elseif ($_GET['action']=="descubrir") {
                              $script="descubrir.php";
							             }elseif ($_GET['action']=="descubrir") {
                              $script="home.php";
                            }elseif ($_GET['action']=="profile") {
                              $script="profile.php";
                            }elseif ($_GET['action']=="votacion") {
                              $script="votacion.php";
                            }elseif ($_GET['action']=="votaciones") {
                              $script="votaciones.php";
                            }elseif ($_GET['action']=="evaluaciones") {
                              $script="evaluaciones.php";
                            }elseif ($_GET['action']=="evaluacion") {
                              $script="evaluacion.php";
                            }elseif ($_GET['action']=="resultados") {
                              $script="resultados.php";
                            }elseif ($_GET['action']=="comentarios") {
                              $script="comentarios.php";
                            }elseif ($_GET['action']=="changepic") {
                              $script="changepic.php";
                            }elseif ($_GET['action']=="minutoxminuto") {
                              $script="minutoxminuto.php";
                            }elseif ($_GET['action']=="programa") {
                              $script="programa.php";
                            }elseif ($_GET['action']=="acercade") {
                              $script="acercade.php";
                            }elseif ($_GET['action']=="configuracion") {
                              $script="configuracion.php";
                            }
                        }else{
                          $script="main.php";
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
      if(esMobil()) { 
         //ocultar el footer si es movil
      } else{
        include 'footer.php';
      }
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
  

      <?
    if(isset($_GET['action']) && $_GET['action']=="descubrir"){
  ?>
      <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    
    <?}?>
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/count.js"></script>
     <?
    if(isset($_GET['action']) && $_GET['action']=="descubrir"){
    ?>
    <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 1, "asc" ]]
              } );
          } );
      </script>
    <?}?>
     
<?
if(isset($_GET['action']) && $_GET['action']=="mapa"){
  ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

    <script type="text/javascript">

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
          },
          function error(err) {
            alert('ERROR(' + err.code + '): ' + err.message);
          },
          {enableHighAccuracy: true}
          );
        } else {
          alert("Este navegador no soporta geolocalización");
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
  if(isset($_GET['action']) && $_GET['action']=="actividad"){
  ?>
  <script>
  function addAgenda (id, tipo, existeconf) {
    var mensaje="Realmente deseas agregar a tus actividades?";
    if(existeconf>0){
      mensaje=mensaje+" Se agendaran todas las conferencias correspondientes";
    }

    $.ajax({
        url: 'verficarDisponibilidad.php',
        type: 'POST',
        dataType: 'json',
        data: {actividad_id: id, tipo: tipo, usuario: <?=$_SESSION['usuario']['id']?>},
      })
      .done(function(respuesta) {
        if(respuesta.disponible){
          //--------------------------------------------------
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
                      //alert("Actividad agendada");
                    }else{
                      alert("No se pudo agendar la actividad");
                    }
                  })
                  .fail(function() {
                    alert("Ocurrio un error intente de nuevo");
                  })
          //----------------------------------------------------
        }else{
          alert("Hay una actividad en su agenda que ocupa este horario");
        }
      });
    
    
  }
    function delAgenda (id, tipo, existeconf) {
    var mensaje="Realmente deseas quitar de tus actividades?";
    if(existeconf>0){
      mensaje=mensaje+" Se quitaran todas las conferencias correspondientes";
    }

    //if(confirm(mensaje)){
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
        //alert("Actividad borrada de agenda");
      }else{
        alert("No se pudo quitar la actividad");
      }
    })
    .fail(function() {
      alert("Ocurrio un error intente de nuevo");
    })
  //}
  }
    function verificarFechas(id, tipo, existeconf) {
      $.ajax({
        url: 'verficarDisponibilidad.php',
        type: 'POST',
        dataType: 'json',
        data: {actividad_id: id, tipo: tipo, usuario: <?=$_SESSION['usuario']['id']?>},
      })
      .done(function(respuesta) {
        if(respuesta.disponible==1){
          return true;
        }else{
          return false;
        }
      })      
    }
  </script>
  <?
  }
  ?>

  <?
  if(isset($_GET['action']) && $_GET['action']=="agenda"){
  ?>
  <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
  <?
  include "activities.php";
  }
  ?>
<!--------------------------------Funciones notificaciones, mensajes asctualizaciones------------------>
  <script src="chat/fancywebsocket.js"></script>
  <script>
    var ultimo=null;
    var Server;
    var id_usuario=<?=$_SESSION['usuario']['id']?>;
    
    function send( text ) {
      var rx = $("#receptor_id").val();
      Server.send( 'message', '{"tx":"'+id_usuario+'", "rx":"'+rx+'", "message":"'+text+'"}');

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
        console.log(data);
        var respuesta = jQuery.parseJSON(data);
        if(respuesta.tx==1){//mensajes del organizador---------------------------
          if(respuesta.tipo==2){//si es mensaje de texto
            if(respuesta.tx!=$("#receptor_id").val()){
              if($( "#chat-user-"+respuesta.tx).length){
                $( "#chat-user-"+respuesta.tx).html('<i class="fa fa-envelope text-danger"></i>');
              }else{//insertar como notificación
                $( "#notificacion-msg").removeClass('hide');
                $( "#notificacion-msg2").removeClass('hide');
              }
              //reproducir un sonido
              $('#audio_fb')[0].play();
              
            }else{
              var html="";
               html+='<div class="group-rom">';
               html+='    <div class="first-part">'+($("#receptor_nombre").val())+'</div>';
               html+='    <div class="second-part">'+respuesta.msg+'</div>';
               html+='    <div class="third-part">'+respuesta.hora+'</div>';
               html+='</div>';
              $( "#tablero" ).append(html);
              msgsVistos(respuesta.tx, id_usuario);
              $( "#tablero" ).scrollTop( $('#tablero').prop('scrollHeight') - $('#tablero').innerHeight() );        
            }
          }
        }else if(respuesta.tipo==2){ //mensages personales-----------------------------------------
          if(respuesta.tx!=$("#receptor_id").val()){
            if($( "#chat-user-"+respuesta.tx).length){
              $( "#chat-user-"+respuesta.tx).html('<i class="fa fa-envelope text-danger"></i>');
            }else{//insertar como notificación
              $( "#notificacion-msg").removeClass('hide');
              $( "#notificacion-msg2").removeClass('hide');
            }
            //reproducir un sonido
            $('#audio_fb')[0].play();
            
          }else{
            var html="";
             html+='<div class="group-rom">';0
             html+='    <div class="first-part">'+($("#receptor_nombre").val())+'</div>';
             html+='    <div class="second-part">'+respuesta.msg+'</div>';
             html+='    <div class="third-part">'+respuesta.hora+'</div>';
             html+='</div>';
            $( "#tablero" ).append(html);
            //marcar este mensaje como visto
            msgsVistos(respuesta.tx, id_usuario);
            $( "#tablero" ).scrollTop( ($('#tablero').prop('scrollHeight') - $('#tablero').innerHeight()) );
            
          }
       }else if(respuesta.tipo==1){
        $("#status-user-"+respuesta.tx).html('<i class="fa fa-circle text-success"></i>');       
       }else if(respuesta.tipo==3){
        $("#status-user-"+respuesta.tx).html('<i class="fa fa-circle text-muted"></i>');
       }else if(respuesta.tipo==4){
        <?
        if(isset($_GET['action']) and $_GET['action']=="descubrir"){
          ?>
          var ids_usuarios = (respuesta.msg).split(",");
          for (var i = 1; i < ids_usuarios.length;  i++) {
            //cambiar el estatus del usuario a activo
            $("#status-user-"+ids_usuarios[i]).html('<i class="fa fa-circle text-success"></i>');
          };
          <?
          }
          ?>
       }
      });
      <?
        if(versionAndroid()>=4.4){
      ?>
      if (id_usuario!=null) {
        Server.connect();
      };
      <?}?>

    });
  function msgsVistos(de, para) {
    $.ajax({
      url: 'msgVisto.php',
      type: 'POST',
      dataType: 'json',
      data: {de: de, para:para},
    })
    .done(function() {
      console.log("success");
    })    
  }
  function estableceChat (id_receptor, nombre) {
    if(ultimo!=null){
      clearTimeout(ultimo);
    }
    $("#receptor_id").val(id_receptor);
    $("#receptor_nombre").val(nombre);
    $("#tablero").html("");
    if(id_receptor==1){
      $("#nombre-chat").html(nombre);
    }else{
      $("#nombre-chat").html("<a  style='color:#fff;  text-decoration: underline;' href='./?action=profile&id="+id_receptor+"'>"+nombre+"</a>");
    }
    ultimo=setTimeout("actualizar('2015-01-01 00:00:00');",100); 
    $("#chat-user-"+id_receptor).html('');
    $(".right-side").addClass("hide");
    $(".mid-side").removeClass("hide");
    $(".camp-txt").removeClass("hide");
    $("#mensaje").focus();
  }
  <?if(isset($_GET['id']) && $_GET['id']!="" && isset($_GET['action']) && $_GET['action']=="descubrir"){
    ?>
    estableceChat (<?=$_GET['id']?>, '<?=$_GET["nom"]?>');
    <?
  }?>
  function verCongresistas(){
    $(".mid-side").addClass("hide");
    $(".camp-txt").addClass("hide");
    $(".right-side").removeClass("hide");
    $("#receptor_id").val(0);
  }

  function enviarMsg(mensaje, hora) {
        var html="";
            html+='<div class="group-rom">';
            html+='    <div class="first-part odd">'+($("#my_nombre").val())+'</div>';
            html+='    <div class="second-part">'+mensaje+'</div>';
            html+='    <div class="third-part">'+hora+'</div>';
            html+='</div>';
        send( mensaje );
        $("#tablero").append(html);
        $( "#tablero" ).scrollTop( $('#tablero').prop('scrollHeight') - $('#tablero').innerHeight() );
      }
  function preguntar () {
       
      var mensaje=document.getElementById('mensaje').value;
      if(mensaje!=""){
      var receptor_id = $("#receptor_id").val();
      $( "#btn-chat" ).addClass( "disabled" );
      $("#btn-chat").html('Enviando...');
        $.ajax({
            url : 'messenger.php',
            data : { mensaje:mensaje, action:"add", remitente_id:<?=$_SESSION['usuario']['id']?>, receptor_id: receptor_id},
            type : 'POST',
            dataType : 'json',
            success : function(json) {
              if(json.success){
                <?
                  if(versionAndroid()>=4.4){
                ?>
                enviarMsg(mensaje, json.hora);
                <?}?>
                document.getElementById('mensaje').value="";
                $( "#btn-chat" ).removeClass( "disabled" );
                $("#btn-chat").html("Enviar"); 
              }else{
                alert("Ocurrio un error, intente de nuevo");
                 $( "#btn-chat" ).removeClass( "disabled" );
                $("#btn-chat").html("Enviar"); 
              }
            },
            error : function(jqXHR, status, error) {
               alert('Disculpe, existió un problema, intente de nuevo');
            },
            complete : function(jqXHR, status) {
               $( "#btn-chat" ).removeClass( "disabled" );
                $("#btn-chat").html("Enviar"); 
            }
        }); 
      }
    }
        function actualizar (hora) {
          var receptor_id = $("#receptor_id").val();
        $.ajax({
            url : 'messenger.php',
            data : { hora:hora, remitente_id:<?=$_SESSION['usuario']['id']?>, receptor_id: receptor_id},
            type : 'POST',
            dataType : 'json',
           
            success : function(json) {
              if(json.success){
                $( "#tablero" ).append(json.html);
                $( "#tablero" ).scrollTop( $('#tablero').prop('scrollHeight') - $('#tablero').innerHeight() ); 
                <?
                  if(versionAndroid()<4.4){
                ?>
                ultimo=setTimeout("actualizar('"+json.horaserver+"');",5000);  
                <?}?>           
              }
            },
            error : function(jqXHR, status, error) {
                alert('Disculpe, existió un problema');
            },
            complete : function(jqXHR, status) {
            }
        }); 
    }


       //
       function preparar (hora) {
        setTimeout("actualizar('"+hora+"');",5000); 
       }
       function validateEnter(e) {
          var key=e.keyCode || e.which;
          if (key==13){ return true; } else { return false; }
        }
      //preparar('<?=date("Y-m-d H:i:s")?>');
      
  </script>
<!-------------------fin de comunicacion-------------->




  <!--funcion para deshabilitar cualquier boton-->
  <script>
  function deshabilitaBtn (btn) {
      $("#"+btn).addClass( "disabled" );
      $("#"+btn).val('Enviando...');
  }
  
  </script>

<?
if (isset($_GET['action']) && $_GET['action']=="evaluacion") {
  setlocale(LC_ALL,"en_US");
?>
        <script type="text/javascript">

<? if(isset($_SESSION['examen']['start'])){

  ?> 


  function ver_tiempo () {
          $.ajax({
            url: 'tiempo.php',
            type: 'POST',
            dataType: 'json',
            data: {hora_fin: '<?=$_SESSION["examen"]["hora_fin"]?>'},
          })
          .done(function(respuesta) {
            if(respuesta.success==0){
              terminar();
            }else{
              setTimeout("ver_tiempo()",30000);
            }
            
          })
          .fail(function() {
            console.log("error");
          })
        }
    function terminar () {
          $.ajax({
            url: 'cerrar_examen.php',
            type: 'POST',
            dataType: 'json',
            data: {salir: 'ok'},
          })
          .done(function(respuesta) {
            if(respuesta.success==1){
              <? if($examen['tipo']==1){$redirect="evaluaciones";}else{$redirect="comentarios";}?>
              window.location="./?action=<?=$redirect?>";
            }
          })
          .fail(function() {
            console.log("error");
          })
        }

        ver_tiempo();

  <?}?>
        </script>



 <script>

    <?
    if(isset($_SESSION['examen'])){
      $fecha_inicio=$_SESSION['examen']['fecha_inicio'];
      $hora_inicio=$_SESSION['examen']['hora_inicio'];
      //$fecha_hora_fin = strtotime ( '+'.$examen[duracion].' minute' , strtotime ( date("Y-m-d H:i:s") ) ) ;
      $fecha_fin = $_SESSION['examen']['fecha_fin'];
      $hora_fin = $_SESSION['examen']['hora_fin2'];
    ?>
    var fecha = '<?=ucwords(strftime("%A %d %B %Y",strtotime($fecha_inicio)));?>';
    var hora_inicio = '<?=$hora_inicio?>';
    var hora_fin = '<?=$hora_fin?>';
    var fin_eval = '<?=ucwords(strftime("%A %d %B %Y",strtotime($fecha_fin)));?>' + ' ' + '<?=$hora_fin?>';

      function HoraInicio(){
          now = new Date();
          inicio = now.getHours() + ":" + now.getMinutes();
          return inicio;
      }

      function HoraFin(){
          now = new Date();
          minutos = now.getMinutes();
          if(minutos<10){minutos='0'+minutos}
          fin = (now.getHours() + 1) + ":" + minutos;
          return fin;
      }

      function Fin_eval(){
          now = new Date();
          finexam = new Date( fin_eval );
          days = (finexam - now) / 1000 / 60 / 60 / 24;
          daysRound = Math.floor(days);
          hours = (finexam - now) / 1000 / 60 / 60 - (24 * daysRound);
          hoursRound = Math.floor(hours);
          minutes = (finexam - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
          minutesRound = Math.floor(minutes);
          seconds = (finexam - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
          secondsRound = Math.round(seconds);
          dy = (daysRound == 1)  ? " día" : " d&iacute;as, ";
          sec = " seg";
          min = " min, ";
          hr = " hrs, ";

          if( daysRound < 0 ){            
            $('.counter').html("Se ha terminado el tiempo" );
          }else{
            $('.counter').html("<div >Inicio: " + hora_inicio + " hrs. -  Término: " + hora_fin + "<br></div><div class='reloj'>Faltan: " + hoursRound + hr + minutesRound + min + secondsRound + sec + " para finalizar la evaluación</div>");
            setTimeout(Fin_eval, 1000); //Ciclo del reloj
          }
      }
          
      Fin_eval();     

      <?}?>
    </script>

<?
}
?>
<?
if (isset($_GET['action']) && $_GET['action']=="profesor") {
  setlocale(LC_ALL,"en_US");
?>
<script>
  function calificar (estrellas) {
     $.ajax({
            url: 'calificarProfesor.php',
            type: 'POST',
            dataType: 'json',
            data: {estrellas: estrellas, profesor:$("#profesor_id").val()},
          })
          .done(function(respuesta) {
              //
              if (respuesta.success) {
                for (var i = 1; i <=5; i++) {
                    if(i<=estrellas){
                      $(".cal"+i).addClass("emitido");
                    }else{
                      $(".cal"+i).removeClass("emitido");
                    }
                    };
                  }else{
                    alert("Ocurrio un error");
                  }
                  
              //
          })
          .fail(function() {
            console.log("error");
          })
  }
</script>
<?
}
?>
<?
if(isset($_GET['action']) && $_GET['action']=="edit-perfil"){
?>
<script >
    $( "#pais" ).change(function() {
      $.ajax({
          url: 'changePais.php',
          type: 'POST',
          dataType: 'json',
          data: {id_pais: $("#pais").val()},
      })
      .done(function(json) {
          if(json.success){
            $("#estado").html(json.html);
          }
      })
      .fail(function() {
          alert("Ups Ocurrio un error");
      })      
    });
</script>
<?
}
?>
     <?
    if(isset($_GET['action']) && $_GET['action']=="changepic" && !esMobil()){
  ?>
      <script type="text/javascript" src="js/jquery-pack.js"></script>
  <script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>

<?php
//Only display the javacript if an image has been uploaded
if( isset($large_photo_exists) && strlen($large_photo_exists)>0){
  $current_large_image_width = getWidth($large_image_location);
  $current_large_image_height = getHeight($large_image_location);?>
<script type="text/javascript">
function preview(img, selection) { 
  var scaleX = <?php echo $thumb_width;?> / selection.width; 
  var scaleY = <?php echo $thumb_height;?> / selection.height; 
  
  $('#thumbnail + div > img').css({ 
    width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
    height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
    marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
    marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
  });
  $('#x1').val(selection.x1);
  $('#y1').val(selection.y1);
  $('#x2').val(selection.x2);
  $('#y2').val(selection.y2);
  $('#w').val(selection.width);
  $('#h').val(selection.height);
} 

$(document).ready(function () { 
  $('#save_thumb').click(function() {
    var x1 = $('#x1').val();
    var y1 = $('#y1').val();
    var x2 = $('#x2').val();
    var y2 = $('#y2').val();
    var w = $('#w').val();
    var h = $('#h').val();
    if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
      alert("Necesitas seleccionar un area de la imagen");
      return false;
    }else{
      return true;
    }
  });
}); 

$(window).load(function () { 
  $('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 

});
$('#thumbnail').focus();
</script>
<?php }?>


  
    <?}?>
<?if(isset($_GET['action']) && $_GET['action']=="minutoxminuto" && isset($posicion) && $posicion!=""){
  ?>
  <script>
    $('html, body').animate({
                        scrollTop: ($(".<?=$posicion?>").offset().top)-65
                    }, 2000);
  </script>
   <?}?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.3&appId=431132157054056";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
   
  </body>
</html>
