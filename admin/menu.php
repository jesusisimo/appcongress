      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="<? if(!isset($_GET[action])){ echo 'active'; }?>" href="./">
                          <i class="glyphicon glyphicon-home"></i>
                          <span>Inicio</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='mensajes'){ echo 'active'; }?>" href="./?action=mensajes&view">
                          <i class="fa fa-envelope-o"></i>
                          <span>Mensajes</span>
                      </a>
                  </li>
                  
                  <li>
                      <a class="<? if($_GET[action]=='usuarios'){ echo 'active'; }?>" href="./?action=usuarios&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Usuarios</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='profesores'){ echo 'active'; }?>" href="./?action=profesores&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Profesores</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='coordinadores'){ echo 'active'; }?>" href="./?action=coordinadores&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Coordinadores</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='patrocinadores'){ echo 'active'; }?>" href="./?action=patrocinadores&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Patrocinadores</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='comite_organizador'){ echo 'active'; }?>" href="./?action=comite_organizador&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Comité Organizador</span>
                      </a>
                  </li>

                  <li>
                      <a class="<? if($_GET[action]=='categorias'){ echo 'active'; }?>" href="./?action=categorias&view">
                          <i class="glyphicon glyphicon-th-list"></i>
                          <span>Categorías</span>
                      </a>
                  </li>
                  
                  <li>
                      <a class="<? if($_GET[action]=='salones'){ echo 'active'; }?>" href="./?action=salones&view">
                          <i class="fa fa-home"></i>
                          <span>Salones</span>
                      </a>
                  </li>

                  <li>
                      <a class="<? if($_GET[action]=='conferencias'){ echo 'active'; }?>" href="./?action=conferencias&view">
                          <i class="glyphicon glyphicon-bullhorn"></i>
                          <span>Conferencias</span>
                      </a>
                  </li>
                  
                  <li>
                      <a class="<? if($_GET[action]=='actividades'){ echo 'active'; }?>" href="./?action=actividades&view">
                          <i class="glyphicon glyphicon-list-alt"></i>
                          <span>Actividades</span>
                      </a>
                  </li> 
                  
                  <li>
                      <a class="<? if($_GET[action]=='agendas'){ echo 'active'; }?>" href="./?action=agendas&view">
                          <i class="glyphicon glyphicon-calendar"></i>
                          <span>Agenda</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='logeos'){ echo 'active'; }?>" href="./?action=logeos&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Logeos</span>
                      </a>
                  </li>
                   <li>
                      <a class="<? if($_GET[action]=='redes_sociales'){ echo 'active'; }?>" href="./?action=redes_sociales&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Redes Sociales</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='sociedad'){ echo 'active'; }?>" href="./?action=sociedad&view">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Sociedad</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='ubicaciones'){ echo 'active'; }?>" href="./?action=ubicaciones&view">
                          <i class="glyphicon glyphicon-map-marker"></i>
                          <span>Ubicaciones</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='paises'){ echo 'active'; }?>" href="./?action=paises&view">
                          <i class="glyphicon glyphicon-flag"></i>
                          <span>Países</span>
                      </a>
                  </li>
                 
                  <li>
                      <a class="<? if($_GET[action]=='publicidades'){ echo 'active'; }?>" href="./?action=publicidades&view">
                          <i class="glyphicon glyphicon-th-large"></i>
                          <span>Publicidades</span>
                      </a>
                  </li>

                  <li>
                      <a class="<? if($_GET[action]=='votaciones' || $_GET[action]=='candidatos'){ echo 'active'; }?>" href="./?action=votaciones&view">
                          <i class="glyphicon glyphicon-th-large"></i>
                          <span>Preguntas rápidas</span>
                      </a>
                  </li>
                  <li>
                      <a class="<? if($_GET[action]=='examenes' || $_GET[action]=='preguntas'){ echo 'active'; }?>" href="./?action=examenes&view">
                          <i class="glyphicon glyphicon-certificate"></i>
                          <span>Examenes</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->