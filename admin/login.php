<?
  session_start();
  if(isset($_SESSION['admin']['id'])){
    header("location:./");
    exit;
  }
  include('../bd/mnpBD.class.php');
  $query="SELECT *FROM usuarios WHERE usuario='".$_POST[usuario]."' and password='".$_POST[password]."' ";
  $usuarios=$bd->ExecuteE($query);
  foreach ($usuarios as &$usuario) {
    $_SESSION[admin][id]=$usuario[id];
    $_SESSION[admin][nombre]=$usuario[nombre];
    header("location:./");
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
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
    <div class="container">
      <form class="form-signin" action="" method="post" name="form1">
        <h2 class="form-signin-heading">Ingresar</h2>
        <div class="login-wrap">
            <input type="text" name="usuario" class="form-control" placeholder="usuario" autofocus required>
            <input type="password" name="password" class="form-control" placeholder="********" required>
            
            <button class="btn btn-lg btn-login btn-block" type="submit">Entrar</button>        

        </div>
      </form>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
