<?
  session_start();
  include('bd/mnpBD2.class.php');
    //funciones para CRUD usuarios----------------------------------------------------------------------
  if($_GET['action']=="usuarios"){
    if(isset($_GET['add']) && isset($_POST['nombre']) && $_POST['nombre']!="" && isset($_POST['email']) && $_POST['email']!="" && isset($_POST['password']) && $_POST['password']!=""){
      $query="SELECT count(*) as registrado FROM usuarios where email='".$_POST['email']."'";
      $usuarios=$bd->ExecuteE($query);
      foreach ($usuarios as &$usuario){
        if($usuario['registrado']==0){
                $campos="nombre, apellidos, usuario, password, email, pais_id, estado_id, especialidad, telefono, institucion, fecha_registro";
                $datos=array(
                  ($_POST['nombre']),
                  ($_POST['apellidos']),
                  ($_POST['email']),
                  ($_POST['password']),
                  ($_POST['email']),
                  ($_POST['pais']),
                  ($_POST['estado']),
                  ($_POST['especialidad']),
                  ($_POST['telefono']),
                  ($_POST['institucion']),
                  date("Y-m-d H:i:s")
                  );
                $usr=new mnpBD('usuarios');
                if($usr->insertar($campos,$datos)){
                  $_SESSION['usuario']['id']=mysql_insert_id();
                  $_SESSION['usuario']['nombre']=$_POST['nombre'];
                  $_SESSION['usuario']['tipo']="0";
                  $_SESSION['usuario']['foto']="fotos_usuario/avatar.jpg";
                  $campos="usuario_id, nombre_v, apellidos_v, email_v, telefono_v, especialidad_v, pais_v, estado_v, institucion_v";
                  $datos=array($_SESSION['usuario']['id'],1,1,0,1,1,1,1,1);
                  $usr=new mnpBD('campos_visibles');
                  $usr->insertar($campos,$datos);

                  //-------------establecemos cookie----------------------------------------------------
                  mt_srand(time());
                  $rand = mt_rand(1000000,9999999);
                  setcookie("id", $_SESSION['usuario']['id'], time()+(60*60*24*365));
                  setcookie("marca", $rand, time()+(60*60*24*365));

                  $campos="cookie";
                  $valores=array($rand);
                  $condicion=" id=".$_SESSION['usuario']['id'];
                  $usr=new mnpBD('usuarios');
                  $usr->actualizar($campos,$valores,$condicion);
                  //---------------------------------------------------------------------------------------
                  $campos='usuario_id, ip, dispositivo, fecha_hora'; 
                  $datos=array($_SESSION['usuario']['id'],get_real_ip(),strtolower($_SERVER['HTTP_USER_AGENT']),date("Y-m-d H:i:s"));
                  $usr=new mnpBD('logeos');
                  $usr->insertar($campos,$datos);
                  //------------------------------------------------------------------------------------------
                  //------------envio correo de registro---------------
                  include 'envioRegistro.php';
                  //----------- end cenvio de correo-------------------
                  header("location:./");
                  exit;
                }else{
                  echo "ocurrio un error";
                  exit;
                }
        }else{
              header("location:registro.php?duplicate");
        }
      }
    }else{
       header("location:registro.php?error");
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
?>