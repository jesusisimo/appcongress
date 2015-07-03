<?

$query="SELECT *FROM usuarios as u INNER JOIN campos_visibles as c on c.usuario_id=u.id WHERE u.id=".$_SESSION['usuario']['id'];
$usuarios=$bd->ExecuteE($query);
foreach ($usuarios as &$usuario){}



  if(isset($_POST['password']) && isset($_POST['vpassword'])){
    $sql_passwords  = "SELECT password FROM usuarios where id=".$_SESSION['usuario']['id'];
    $res_passwords  = $bd->ExecuteE($sql_passwords);
    $password="";
    foreach ($res_passwords as &$passwordx) {
      $password=$passwordx['password'];
    }
    if($password==$_POST['vpassword']){
      $update  = "UPDATE usuarios SET password='".$_POST['password']."' where id=".$_SESSION['usuario']['id'];
      if($bd->ExecuteNonQuery($update)){
        $_SESSION['mensaje']="Contraseña actualizada correctamente";
      }else{
        $_SESSION['mensaje']="No se pudo cambiar su contraseña";
      }
    }else{
      $_SESSION['mensaje']="No puede cambiar su clave porque no ingreso su contraseña correcta";
    }
    
  }
?>

                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="./?action=changepic">
                                  <img src="<?=$_SESSION['usuario']['foto']?>" alt="">
                              </a>
                              <h1> <?=$usuario['nombre']." ".$usuario['apellidos'];?></h1>
                              <p> <?=$usuario['usuario'];?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="./?action=changepic"> <i class="fa  fa-picture-o"></i> Cambiar foto</a></li>
                              <li><a href="./?action=descubrir&view"> <i class="fa fa-bell-o"></i> Notificaciones <?if($hay_mensajes!=0){?> <span class="label label-danger pull-right r-activity"><?=$hay_mensajes?></span> <?}?></a></li>
                              <li ><a href="./?action=perfil"> <i class="fa fa-user"></i> Perfil</a></li>
                              <li ><a href="./?action=edit-perfil"> <i class="fa fa-edit"></i> Editar perfil</a></li>
                              <li class="active"><a href="./?action=configuracion"> <i class="fa fa-cog"></i> Configuración</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">                      
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Cambiar Contraseña</div>
                              <div class="panel-body">
                              <? if(isset($_SESSION['mensaje']) && $_SESSION['mensaje']!=""){?>
                              <div class="alert alert-info fade in">
                                <button class="close close-sm" type="button" data-dismiss="alert">
                                  <i class="fa fa-times"></i>
                                </button>
                                <strong>Mensaje!</strong>
                                  <?=$_SESSION['mensaje']?>&#10;
                              </div>
                              <? unset($_SESSION['mensaje']);}?>
                                  <form class="form-horizontal cmxform " id="signupForm" method="post" role="form">
                                      <div class="form-group">
                                          <label  class="col-lg-3 control-label">Contraseña Actual</label>
                                          <div class="col-lg-6">
                                              <input type="password" name="vpassword" id="vpassword" class="form-control" placeholder=" " required value="<?=$usuario['password']?>">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label  class="col-lg-3 control-label">Nueva Contraseña</label>
                                          <div class="col-lg-6">
                                              <input type="password" name="password" id="password" class="form-control" placeholder=" " required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label  class="col-lg-3 control-label"  >Repetir Nueva Contraseña</label>
                                          <div class="col-lg-6">
                                              <input type="password" id="confirm_password" name="confirm_password" class="form-control" data-match="#npassword" data-match-error="Correo no coincide con el anterior" placeholder=" " required>
                                              <span class="help-block with-errors"></span>
                                          </div>
                                      </div>


                                      <div class="form-group">
                                          <div class="col-lg-offset-3 col-lg-9">
                                              <input type="hidden" name="email" value="<?=$usuario['email']?>">
                                              <button type="submit" class="btn btn-info">Actualizar</button>
                                             
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>