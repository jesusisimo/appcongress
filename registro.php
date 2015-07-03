<?
session_start();
if(isset($_SESSION['usuario'])){
  header("location: ./");
  exit;
}
ini_set("display_errors", 1); 
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_MX");

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
include('bd/mnpBD2.class.php');
include 'datos_sociedad.php';
include 'loginFacebook.php'; 
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

    <title>Registro <?=($sociedad['evento'])?></title>

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

      <form class="form-signin" action="addUser.php?action=usuarios&add" method="POST" style="margin: 10px auto 0;">
        <h2 class="form-signin-heading">Registrate ahora</h2>
        <div class="login-wrap">
        <?
            if (isset($_GET['duplicate'])) {
        ?>
            <div class="alert alert-block alert-danger fade in">
                <button class="close close-sm" type="button" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Ups!</strong>
                Ya existe una cuenta con registrada con el mismo correo electronico.&#10;
            </div>
        <?}?>
        <?
            if (isset($_GET['error'])) {
        ?>
            <div class="alert alert-block alert-danger fade in">
                <button class="close close-sm" type="button" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong>
                Faltaron datos, por favor rellene el formulario.&#10;
            </div>
        <?}?>
            <h4 class="text-primary text-center">Ingresa tus datos personales</h4>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"  required>
            <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos"  required>
            <input type="text" name="especialidad" id="especialidad" class="form-control" placeholder="Especialidad" >
            <input type="text" name="institucion" id="institucion" class="form-control" placeholder="Institucion donde labora" >
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Num. Celular" >
            <select class="form-control" name="pais" id="pais"  required>
                <?
                    $query="SELECT * FROM countries";
                    $paises=$bd->ExecuteE($query);
                    foreach ($paises as &$pais) {
                ?>
                <option <? if($pais['id_pais']==156){ echo "selected";}?> value="<?=$pais['id_pais']?>"><?=($pais['pais'])?></option>
                <?
                    }
                ?>
            </select>
            <select class="form-control" name="estado" id="estado"  required>
                <?
                    $query="SELECT * FROM estados where id_pais=156";
                    $estados=$bd->ExecuteE($query);
                    foreach ($estados as &$estado) {
                ?>
                <option <? if($estado['id_estado']==2545){ echo "selected";}?> value="<?=$estado['id_estado']?>"><?=($estado['estado'])?></option>
                <?
                    }
                ?>
            </select>

            <h4 class="text-primary text-center"> Ingresa datos para tu cuenta</h4>
            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu correo"  required>
            <input type="password" name="password" id="password" class="form-control" placeholder="ingresa una contraseña" required>
            <label class="checkbox">
                <input type="checkbox" value="acepto condiciones" required> Acepto terminos y condiciones
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Registrarme</button>
            <p>O registrate con</p>

            <a href="<?=$login?>" class="btn btn-lg btn-login-f btn-block" type="submit"><i class="fa fa-facebook" style="font-size: 20px; padding-right: 10px;"></i> Facebook</a>


            <div class="registration">
                Ya estas registrado?
                <a class="" href="login.php">
                    Ingresa aquí
                </a>
            </div>

        </div>

      </form>

    </div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
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

  </body>
</html>
