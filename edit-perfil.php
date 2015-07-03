                  <?
                    if(isset($_POST['nombre']) && $_POST['nombre']!="" && isset($_POST['email']) && $_POST['email']!=""){
                      //actualizamos
    
                      $campos="nombre, apellidos, email, usuario, telefono, pais_id, estado_id, especialidad, institucion, tipo";
                      $valores=array($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['email'], $_POST['telefono'], $_POST['pais'], $_POST['estado'], $_POST['especialidad'], $_POST['institucion'], 0);
                      $condicion=" id=".$_SESSION['usuario']['id'];
                      $usr=new mnpBD('usuarios');
                      if($usr->actualizar($campos,$valores,$condicion)){
                        $_SESSION['usuario']['tipo']=0;
                        $_SESSION['usuario']['nombre']=$_POST['nombre'];
                        $_SESSION['mensaje']="Datos actualizados conrrectamente";
                        ?>
                        <script>
                          window.location.href="./?action=edit-perfil&view";
                        </script>
                        <?
                      }else{
                        $_SESSION['mensaje']="No se pudo actualizar";
                      }
                    }
                  ?>

                  <?
                  $query="SELECT *FROM usuarios as u INNER JOIN campos_visibles as c on c.usuario_id=u.id WHERE u.id=".$_SESSION['usuario']['id'];
                  $usuarios=$bd->ExecuteE($query);
                  foreach ($usuarios as &$usuario){
            
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
                              <li class="active"><a href="./?action=edit-perfil"> <i class="fa fa-edit"></i> Editar perfil</a></li>
                              <li><a href="./?action=configuracion"> <i class="fa fa-cog"></i> Configuración</a></li>
                          </ul>

                      </section>
                  </aside>
                   <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              <h3><i class="fa fa-edit"></i> Editar mi perfil </h3>
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> Datos</h1>
                              <?if(isset($_SESSION['mensaje'])){?>
                              <div class="alert alert-success fade in">
                                <button class="close close-sm" type="button" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                                </button>
                                <strong>Mensaje!</strong>
                                <?=$_SESSION['mensaje'];
                                unset($_SESSION['mensaje']);
                                ?>
                              </div>
                                <?}?>
                              <form class="form-horizontal" role="form" action="" method="POST">
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Nombre</label>
                                      <div class="col-lg-6">
                                          <input type="text" autofocus class="form-control" name="nombre" <? if ($_SESSION['usuario']['tipo']==0){?> value="<?=$usuario['nombre'];?>" <?}?> >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Apellidos</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="apellidos" value="<?=$usuario['apellidos'];?>" required >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="email" class="form-control" name="email" <? if ($_SESSION['usuario']['tipo']==0){?> value="<?=$usuario['email'];?>" <?}?> required >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Telefono</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="telefono" value="<?=$usuario['telefono'];?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Pais</label>
                                      <div class="col-lg-6">
                                        <select class="form-control" name="pais" id="pais" required>
                                            <?
                                                $query="SELECT * FROM countries";
                                                $paises=$bd->ExecuteE($query);
                                                foreach ($paises as &$pais) {
                                            ?>
                                            <option <? if($pais['id_pais']==$usuario['pais_id']){ echo "selected";}?> value="<?=$pais['id_pais']?>"><?=($pais['pais'])?></option>
                                            <?
                                                }
                                            ?>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Estado</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="estado" id="estado" required>
                                              <?
                                                  $query="SELECT * FROM estados where id_pais=156";
                                                  $estados=$bd->ExecuteE($query);
                                                  foreach ($estados as &$estado) {
                                              ?>
                                              <option <? if($estado['id_estado']==$usuario['estado_id']){ echo "selected";}?> value="<?=$estado['id_estado']?>"><?=($estado['estado'])?></option>
                                              <?
                                                  }
                                              ?>
                                          </select>
                                      </div>
                                  </div>
                                  
                        
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Especialidad</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="especialidad" value="<?=$usuario['especialidad']?>">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Institución</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="institucion" value="<?=$usuario['institucion']?>">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success">Guardar</button>
                                          <button type="reset" class="btn btn-default">Cancelar</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      
                  </aside>
