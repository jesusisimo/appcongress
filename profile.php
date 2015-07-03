                  <?
                  $query="SELECT *FROM usuarios as u INNER JOIN campos_visibles as c on c.usuario_id=u.id WHERE u.id=".$_GET['id'];
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
                    $query="SELECT * FROM redes_sociales WHERE id_usuario=".$_GET['id'];
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
                                  <?
                                  $foto="fotos_usuario/avatar.jpg";
                                  if(file_exists('fotos_usuario/'.$usuario['usuario_id'].'.jpg')){
                                    $foto='fotos_usuario/'.$usuario['usuario_id'].'.jpg'.'?'.date('H:i');
                                    }elseif($usuario['url_foto_fb']!=""){
                                       $foto=$usuario['url_foto_fb'];
                                     }?>
                                  <img src="<?=$foto?>" alt="">
                              </a>
                              <h1> <?=$usuario['nombre'];?></h1>
                              
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="./?action=descubrir&id=<?=$usuario['usuario_id'];?>&nom=<?=$usuario['nombre'].' '.$usuario['apellidos'];?>"> <i class="fa fa-envelope"></i> Enviar mensaje rápido</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                            <h1>Biografia</h1>
                          </div>
                          <div class="panel-body bio-graph-info">
                              
                              <div class="row">
                                  <div class="bio-row">
                                      <p>
                                        <a href="#">
                                         
                                          <span>Nombre </span>: <?=$usuario['nombre'];?>
                                      
                                        </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['apellidos_v']){
                                          ?>
                                          <span>Apellidos </span>: <?=$usuario['apellidos'];?></p>
                                          <?
                                            }else{
                                          ?>
                                          <span>Apellidos </span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['email_v']){
                                          ?>
                                         <span>Email </span>: <?=$usuario['email'];?>
                                          <?
                                            }else{
                                          ?>
                                          <span>Email </span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['telefono_v']){
                                          ?>
                                          <span>Telefono </span>: <?=$usuario['telefono'];?>
                                          <?
                                            }else{
                                          ?>
                                          <span>Telefono </span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['institucion_v']){
                                          ?>
                                          <span>Institución </span>: <?=$usuario['institucion'];?>
                                          <?
                                            }else{
                                          ?>
                                          <span>Institución </span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['especialidad_v']){
                                          ?>
                                          <span>Especialidad</span>: <?=$usuario['especialidad'];?>
                                          <?
                                            }else{
                                          ?>
                                          <span>Especialidad</span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['pais_v']){
                                          ?>
                                          <span>Pais </span>: <?=$usuario['pais']?>
                                          <?
                                            }else{
                                          ?>
                                          <span>Pais </span>: privado
                                          <?
                                            }
                                          ?>
                                      </a>
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['estado_v']){
                                          ?>
                                          <span>Estado </span>: <?=$usuario['estado'];?>
                                          <?
                                            }else{
                                          ?>
                                          <span>Estado </span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <?if($usuario['facebook']!=""){?>
                                  <div class="bio-row">
                                      <p>
                                      <a href="javascript:;">
                                          <?
                                            if($usuario['facebook_v']){
                                          ?>
                                          <span>Facebook </span>: <a target="_blank" class="btn btn-info btn-xs" href="<?=$usuario['facebook']?>">Ver</a>
                                          <?
                                            }else{
                                          ?>
                                          <span>Facebook </span>: privado
                                          <?
                                            }
                                          ?>
                                        </a>
                                      </p>
                                  </div>
                                  <?}?>
                              </div>
                          </div>
                      </section>
                      
                  </aside>