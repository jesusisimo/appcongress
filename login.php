<?
session_start();
if(isset($_SESSION['usuario'])){
  header("location: ./");
  exit;
}
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");
ini_set("display_errors", 1);
include('bd/mnpBD2.class.php');
include 'datos_sociedad.php';

//comprbamos si existe cookie logeamos
if(isset($_COOKIE['id']) && isset($_COOKIE['marca'])){
  if($_COOKIE['id']!="" || $_COOKIE['marca']!=""){
    $query="SELECT * FROM usuarios WHERE id=".$_COOKIE['id']." and cookie='".$_COOKIE['marca']."' AND cookie<>'' ";
    $usuarios=$bd->ExecuteE($query);
    foreach ($usuarios as &$usuario){
          $_SESSION['usuario']['nombre']=$usuario['nombre'];
          $_SESSION['usuario']['id']=$usuario['id'];
          $_SESSION['usuario']['tipo']="0";
          if(file_exists("fotos_usuario/".$usuario['id'].".jpg")){
            $_SESSION['usuario']['foto']="fotos_usuario/".$usuario['id'].".jpg";
          }else{
            $_SESSION['usuario']['foto']="fotos_usuario/avatar.jpg";
          }
          $campos='usuario_id, ip, dispositivo, fecha_hora'; 
          $datos=array($usuario['id'],get_real_ip(),strtolower($_SERVER['HTTP_USER_AGENT']),date("Y-m-d H:i:s"));
          $usr=new mnpBD('logeos');
          $usr->insertar($campos,$datos);

          header("location: ./");
          exit;
    }
  }
}
//----------------------------------------




if(isset($_POST['email']) && $_POST['password']){
  $query="SELECT * FROM usuarios WHERE usuario='".$_POST['email']."' and password='".$_POST['password']."' ";
  $usuarios=$bd->ExecuteE($query);
  foreach ($usuarios as &$usuario){
//----------------codigo para recordar contraseña-----------------------
    if(isset($_POST['remember'])){
    if($_POST['remember'] == "on"){
      mt_srand(time());
      $rand = mt_rand(1000000,9999999);
      setcookie("id", $usuario['id'], time()+(60*60*24*365));
      setcookie("marca", $rand, time()+(60*60*24*365));

      $campos="cookie";
      $valores=array($rand);
      $condicion=" id=".$usuario['id'];
      $usr=new mnpBD('usuarios');
      $usr->actualizar($campos,$valores,$condicion);
    }
  }
//-------------------------------------------------------------------
    $_SESSION['usuario']['nombre']=$usuario['nombre'];
    $_SESSION['usuario']['id']=$usuario['id'];
    $_SESSION['usuario']['tipo']="0";
    if(file_exists("fotos_usuario/".$usuario['id'].".jpg")){
      $_SESSION['usuario']['foto']="fotos_usuario/".$usuario['id'].".jpg";
    }else{
      $_SESSION['usuario']['foto']="fotos_usuario/avatar.jpg";
    }
    $campos='usuario_id, ip, dispositivo, fecha_hora'; 
    $datos=array($usuario['id'],get_real_ip(),strtolower($_SERVER['HTTP_USER_AGENT']),date("Y-m-d H:i:s"));
    $usr=new mnpBD('logeos');
    $usr->insertar($campos,$datos);

    header("location: ./");
    exit;
  }
}
      function get_real_ip()
    {
 
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
 
    }
include 'loginFacebook.php';
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

    <title>Login <?=($sociedad['evento'])?></title>

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

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="" method="post" style="margin: 10px auto 0;">
      <!--<h2 class="form-signin-heading">Ingresa ahora</h2>-->
      <br>
      <center><img src="img/eye_back.png" class="" width="180" min-width="174"></center>
      
      <div class="login-wrap">
            <div class="iconic-input">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" id="email" required class="form-control" placeholder="Correo" autofocus>
            </div>
            <div class="iconic-input">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" id="password" required class="form-control" placeholder="Contraseña">
            </div>
            <label class="checkbox">
                <input type="checkbox" name="remember" checked > <span class="text-primary">No cerrar sesión</span>
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> olvidaste tu contraseña?</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit"><i class="fa fa-unlock-alt" style="font-size: 20px; padding-right: 10px;"></i> Entrar</button>
            <p> O ingresa con</p>
            <a href="<?=$login?>" class="btn btn-lg btn-login-f btn-block" ><i class="fa fa-facebook" style="font-size: 20px; padding-right: 10px;"></i> Facebook</a>
            
            
            <div class="registration">
                Aun no tienes cuenta?
                <a class="" href="registro.php">
                    Crear una cuenta
                </a>
            </div>
            <br>
            <a href="addAnon.php?add" class="btn btn-default btn-block btn-anon" ><i class="fa  fa-user-md" style="font-size: 20px; padding-right: 10px;"></i> Entrar como invitado</a>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Olvidaste tu contraseña?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Ingrese su correo para recuperar su contraseña.</p>
                         <div class="iconic-input">
                                      <i class="fa fa-lock"></i><input type="text" name="email-r" id="email-r" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" data-dismiss="modal" type="button" id="recuperar" >Recuperar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
      $("#recuperar").click(function() {
          if($("#email-r").val()!=""){
          $.ajax({
            url: 'recuperarPass.php',
            type: 'POST',
            dataType: 'json',
            data: {email:$("#email-r").val() },
          })
          .done(function(respuesta) {
            alert(respuesta.mensaje);
          })
          .fail(function() {
            console.log("error");
          })
        }
      });

    </script>
  </body>
</html>
