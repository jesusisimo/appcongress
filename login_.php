<?
ini_set("display_errors", 1);
session_start();
if(isset($_SESSION['usuario'])){
  header("location: ./");
}
include('bd/mnpBD2.class.php');
include 'datos_sociedad.php';
if(isset($_POST['email']) && $_POST['password']){
  $query="SELECT * FROM usuarios WHERE usuario='".$_POST['email']."' and password='".$_POST['password']."' ";
  $usuarios=$bd->ExecuteE($query);
  foreach ($usuarios as &$usuario){
    $_SESSION['usuario']['nombre']=$usuario['nombre'];
    $_SESSION['usuario']['id']=$usuario['id'];
    $_SESSION['usuario']['foto']="http://www.actualizacionmedica.net/appcongress/fotos_usuario/avatar.jpg";
    header("location: ./");
    exit;
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

      <form class="form-signin" action="" method="post">
      <!--<h2 class="form-signin-heading">Ingresa ahora</h2>-->
      <br>
      <center><img src="img/user.png" class="img-responsive" width="180" min-width="174"></center>
      
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
                <!--<input type="checkbox" value="remember-me"> Recordarme-->
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> olvidaste tu contraseña?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Ingresar</button>
            <p>Ingresa con tus redes sociales</p>
            <div class="login-social-link">
                <a href="<?=$login?>" class="facebook">
                    <i class="fa fa-facebook"></i>
                    Facebook
                </a>
                <a href="#" class="twitter">
                    <i class="fa fa-twitter"></i>
                    Twitter
                </a>
            </div>
            <div class="registration">
                Aun no tienes cuenta?
                <a class="" href="registro.php">
                    Crear una cuenta
                </a>
            </div>

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
                                      <i class="fa fa-lock"></i><input type="text" name="email-r" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Recuperar</button>
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


  </body>
</html>
