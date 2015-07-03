                  <?
                  $query="SELECT *FROM usuarios as u INNER JOIN campos_visibles as c on c.usuario_id=u.id WHERE u.id=".$_SESSION['usuario']['id'];
                  $usuarios=$bd->ExecuteE($query);
                  foreach ($usuarios as &$usuario){
                    $query="SELECT *FROM estados WHERE id_estado=".$usuario['estado_id'];
                    $estados=$bd->ExecuteE($query);
                    foreach ($estados as &$estado) {
                      $usuario['estado']=$estado['estado'];
                    }
                    $query="SELECT *FROM countries WHERE id_pais=".$usuario['pais_id'];
                    $paises=$bd->ExecuteE($query);
                    foreach ($paises as &$pais) {
                      $usuario['pais']=$pais['pais'];
                    }
                    $usuario['facebook']="";
                    $query="SELECT * FROM redes_sociales WHERE id_usuario=".$_SESSION['usuario']['id'];
                    $redes_sociales=$bd->ExecuteE($query);
                    foreach ($redes_sociales as &$facebook) {
                      $usuario['facebook']="https://www.facebook.com/".$facebook['id_red_social'];
                    }
                  }
                  ?>
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?=$_SESSION['usuario']['foto']?>" alt="">
                              </a>
                              <h1> <?=$usuario['nombre']." ".$usuario['apellidos'];?></h1>
                              <p> <?=$usuario['usuario'];?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="./?action=changepic"> <i class="fa  fa-picture-o"></i> Cambiar foto</a></li>
                              <li><a href="./?action=descubrir&view"> <i class="fa fa-bell-o"></i> Notificaciones <?if($hay_mensajes!=0){?> <span class="label label-danger pull-right r-activity"><?=$hay_mensajes?></span> <?}?></a></li>
                              <li class="active"><a href="./?action=perfil"> <i class="fa fa-user"></i> Perfil</a></li>
                              <li><a href="./?action=edit-perfil"> <i class="fa fa-edit"></i> Editar perfil</a></li>
                              <li><a href="./?action=configuracion"> <i class="fa fa-cog"></i> Configuración</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                            <h3> <i class="fa fa-user"></i> Mi perfil</h3>
                            <p>Para hacer publico ó privado tus datos toca el ojito</p>
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1>Datos personales</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p>
                                        <a href="#">
                                          <?
                                            if($usuario['nombre_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                        <span>Nombre </span>: <?=$usuario['nombre'];?>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['apellidos_v']){ echo 'acciones.php?accion=apellidos_v&value=0';}else{ echo 'acciones.php?accion=apellidos_v&value=1';} ?>">
                                          <?
                                            if($usuario['apellidos_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                      <span>Apellidos </span>: <?=$usuario['apellidos'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['email_v']){ echo 'acciones.php?accion=email_v&value=0';}else{ echo 'acciones.php?accion=email_v&value=1';} ?>">
                                          <?
                                            if($usuario['email_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                      <span>Email </span>: <?=$usuario['email'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['telefono_v']){ echo 'acciones.php?accion=telefono_v&value=0';}else{ echo 'acciones.php?accion=telefono_v&value=1';} ?>">
                                          <?
                                            if($usuario['telefono_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                      <span>Telefono </span>: <?=$usuario['telefono'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['institucion_v']){ echo 'acciones.php?accion=institucion_v&value=0';}else{ echo 'acciones.php?accion=institucion_v&value=1';} ?>">
                                          <?
                                            if($usuario['institucion_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                      <span>Institución </span>: <?=$usuario['institucion'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['especialidad_v']){ echo 'acciones.php?accion=especialidad_v&value=0';}else{ echo 'acciones.php?accion=especialidad_v&value=1';} ?>">
                                          <?
                                            if($usuario['especialidad_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                      <span>Especialidad</span>: <?=$usuario['especialidad'];?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['pais_v']){ echo 'acciones.php?accion=pais_v&value=0';}else{ echo 'acciones.php?accion=pais_v&value=1';} ?>">
                                          <?
                                            if($usuario['pais_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                      </a>
                                      <span>Pais </span>: <?=$usuario['pais']?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['estado_v']){ echo 'acciones.php?accion=estado_v&value=0';}else{ echo 'acciones.php?accion=estado_v&value=1';} ?>">
                                          <?
                                            if($usuario['estado_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                        </a>
                                      <span>Estado </span>: <?=$usuario['estado'];?></p>
                                  </div>
                                  <?if($usuario['facebook']!=""){?>
                                  <div class="bio-row">
                                      <p>
                                      <a href="<? if($usuario['facebook_v']){ echo 'acciones.php?accion=facebook_v&value=0';}else{ echo 'acciones.php?accion=facebook_v&value=1';} ?>">
                                          <?
                                            if($usuario['facebook_v']){
                                          ?>
                                          <i class="fa fa-eye text-success" style="font-size: 18px;"></i>
                                          <?
                                            }else{
                                          ?>
                                          <i class="fa fa-eye-slash text-danger" style="font-size: 18px;"></i>
                                          <?
                                            }
                                          ?>
                                      </a>
                                      <span>Facebook </span>: <a target="_blank" class="btn btn-info btn-xs" href="<?=$usuario['facebook']?>">Ver</a></p>
                                  </div>
                                  <?}?>
                              </div>
                          </div>
                      </section>
                      
                  </aside>