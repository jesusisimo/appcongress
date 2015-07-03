<!--header start-->
      <header class="header white-bg" style="position: fixed;">
            
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" ></div>
            </div>
              
              
            <!--logo start-->
            <a href="./" class="logo">APP <span>CONGRESS</span><? ($sociedad['nombre_sistema'])?></span></a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu ">
                    <!-- user login dropdown start-->
                    
                    <li class="dropdown notify-row" style="margin-top: 0px; ">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" >
                            <span id="notificacion-msg" class="<?if($hay_mensajes==0){?> hide <?}?> badge bg-important pull-left" style=" top: -5px; left: -10px; right: 90%;"> ! </span>
                            <img alt="" src="<?=$_SESSION['usuario']['foto']?>" style="width: 30px;">
                            <span class="username"><?=($_SESSION['usuario']['nombre']);?></span>
                            <b class="caret"></b>
                            
                        </a>
                            
                        <ul class="dropdown-menu extended logout ">
                            <div class="log-arrow-up"></div>
                            <li><a href="./?action=perfil"><i class="fa fa-user"></i> Perfil</a></li>
                            <li><a href="./?action=configuracion"><i class="fa fa-cog"></i> Configuración</a></li>
                            <li><a href="./?action=descubrir&view" ><i class="fa <?if($hay_mensajes!=0){?> fa-bell text-danger <?}else{?> fa-bell-o <?}?>"  ></i> Notificaciones</a></li>
                            
                            <li><a href="logout.php"><i class="fa fa-power-off"></i></a></li>
                        </ul>
                    </li>                    
                    <!-- user login dropdown end -->
                </ul>

                
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->