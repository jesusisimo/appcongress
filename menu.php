      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse " <? if(esMobil()) {  ?> style="margin-left: -210px;" <?}?>>
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion" <? if(esMobil()) {  ?> style="display: none;" <?}?> >
                  <li>
                      <a class="<? if(!isset($_GET['action'])){ echo 'active'; }?>" href="./">
                          <i class="glyphicon glyphicon-home"></i>
                          <span>Inicio</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='agenda'){ echo 'active'; }?>" href="./?action=agenda&view">
                          <i class="fa fa-calendar"></i>
                          <span>Mi agenda</span>
                      </a>
                   </li>
                   <li>
                      <a class="<? if($_GET['action']=='actividades' || $_GET['action']=='actividad' || $_GET['action']=='categorias'){ echo 'active'; }?>" href="./?action=categorias&view">
                          <i class="glyphicon glyphicon-list-alt"></i>
                          <span>Actividades</span>
                      </a>
                   </li>
                   <li>
                      <a class="<? if($_GET['action']=='minutoxminuto'){ echo 'active'; }?>" href="./?action=minutoxminuto&view">
                          <i class="fa fa-clock-o"></i>
                          <span>Minuto a minuto</span>
                      </a>
                   </li>
                   <li>
                      <!-- <a target="_blank" href="programa.php"> -->
                      <a target="_blank" href="programa/programa3ercurso.pdf">
                      
                          <i class="fa fa-file-text"></i>
                          <span>Programa en PDF</span>
                      </a>
                  </li>
                   <?if(isset($_SESSION['usuario']['tipo']) && $_SESSION['usuario']['tipo']==0){?>
                   <li>
                      <a class="<? if($_GET['action']=='descubrir'){ echo 'active'; }?>" href="./?action=descubrir&view">
                          <i class="fa  fa-envelope-o"></i>
                          <span>Mensajes</span>
                          <span id="notificacion-msg2" class="<?if($hay_mensajes==0){?> hide <?}?> label-danger pull-right badge">!</span>
                      </a>
                   </li>
                   <?}?>
                  <li>
                      <a class="<? if($_GET['action']=='profesores' || $_GET['action']=='profesor'){ echo 'active'; }?>" href="./?action=profesores&view">
                          <i class="fa fa-users"></i>
                          <span>Profesores</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='evaluaciones' || $_GET['action']=='evaluacion'){ echo 'active'; }?>" href="./?action=evaluaciones&view">
                          <i class="fa fa-certificate"></i>
                          <span>Exámenes</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='votaciones' || $_GET['action']=='votacion'){ echo 'active'; }?>" href="./?action=votaciones&view">
                          <i class="fa  fa-toggle-down"></i>
                          <span>Votación</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='comentarios' || $_GET['action']=='comentarios'){ echo 'active'; }?>" href="./?action=comentarios&view">
                          <i class="fa  fa-pencil-square-o"></i>
                          <span>Evaluaciones</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='actividad' || $_GET['id']=='51'){ echo 'active'; }?>" href="./?action=actividad&id=51&view&cat=2&conf">
                          <i class="fa  fa-video-camera"></i>
                          <span>Congreso virtual</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='paises'){ echo 'active'; }?>" href="./?action=paises&view">
                          <i class="fa fa-globe"></i>
                          <span>Países participantes</span>
                      </a>
                  </li>
                  <!-- <li>
                      <a class="<? if($_GET['action']=='coordinadores'){ echo 'active'; }?>" href="./?action=coordinadores&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Coordinadores</span>
                      </a>
                  </li> -->
                  <li>
                      <a class="<? if($_GET['action']=='patrocinadores'){ echo 'active'; }?>" href="./?action=patrocinadores&view">
                          <i class="glyphicon glyphicon-star"></i>
                          <span>Patrocinadores</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='comite_organizador'){ echo 'active'; }?>" href="./?action=comite_organizador&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Comité Organizador</span>
                      </a>
                  </li>                  
                  <li>
                      <a class="<? if($_GET['action']=='salones'){ echo 'active'; }?>" href="./?action=salones&view">
                          <i class="fa fa-home"></i>
                          <span>Salones</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET['action']=='mapa'){ echo 'active'; }?>" href="./?action=mapa&view">
                          <i class="fa fa-map-marker"></i>
                          <span>Ubicación</span>
                      </a>
                  </li>
                  
                  <li>
                      <a class="<? if($_GET['action']=='acercade'){ echo 'active'; }?>" href="./?action=acercade&view">
                          <i class="fa fa-question"></i>
                          <span>Acerca de</span>
                      </a>
                  </li>
                  <li>
                      <a class="" href="logout.php">
                          <i class="fa fa-power-off"></i>
                          <span>Cerrar sesión</span>
                      </a>
                  </li>
                  
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->