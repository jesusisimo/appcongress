
<div class="col-lg-12">
<style>
  .panelchat-body

{

    overflow-y: scroll;
    height: auto;
    min-height: 150px;
    max-height: 360px;

}

::-webkit-scrollbar-track

{

    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);

    background-color: #F5F5F5;

}



::-webkit-scrollbar

{

    width: 12px;

    background-color: #F5F5F5;

}



::-webkit-scrollbar-thumb

{

    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);

    background-color: #555;

}
</style>
<?
if(isset($_GET['id']) && $_GET['id']!=""){
  $receptor_id=$_GET['id'];
}else{
  $receptor_id=0;
}
?>
              <div class="col-lg-12 site-min-height chat-room">
                    <aside class="mid-side">
                      <div class="chat-room-head user-head"> 
                          <a href="javascript:;" onclick="verCongresistas();" class="btn-ver  text-blanco pull-right" ><i class="fa fa-list"></i></a>
                     
                          <i class="fa fa-comments-o"></i>
                          <h3 id="nombre-chat">Chat</h3>
                      </div>
                      <div class="panelchat-body panel-body " id="tablero">
                        <?php 
                        if($receptor_id>0){
                        $sql_mensajes  = "SELECT *FROM mensajes where remitente_id in(".$_SESSION['usuario']['id'].",".$receptor_id.") and receptor_id in(".$_SESSION['usuario']['id'].",".$receptor_id.")  order by fecha_hora asc";
                        $res_mensajes  = $bd->ExecuteE($sql_mensajes);
                                              
                           foreach ($res_mensajes as $mensaje){
                            $hora=$mensaje['fecha_hora'];
                            if($mensaje['remitente_id']==$_SESSION['usuario']['id']){
                              $sql_remitente  = "SELECT *FROM usuarios where id=".$_SESSION['usuario']['id'];
                              $remitente  = $bd->ExecuteE($sql_remitente);
                      ?>
                            <div class="group-rom">
                                <div class="first-part odd"><?=$remitente['0']['nombre']?></div>
                                <div class="second-part"><?=$mensaje['mensaje']?></div>
                                <div class="third-part"><?=$mensaje['fecha_hora']?></div>
                            </div>
                      <?     }else{
                              $sql_receptor  = "SELECT *FROM usuarios where id=".$receptor_id;
                              $receptor  = $bd->ExecuteE($sql_receptor);
                      ?>
                              <div class="group-rom">
                                  <div class="first-part"><?=$receptor['0']['nombre']?></div>
                                  <div class="second-part"><?=$mensaje['mensaje']?></div>
                                  <div class="third-part pull-right"><?=$mensaje['fecha_hora']?></div>
                              </div>
                      <?
                            }
                          }
                        }else{
                          ?>
                        <!--Bienvenida------>
                        
                        <div class="col-md-12 heading-inbox row">
                          <h4 class="text-center">Bienvenido al chat </h4>
                          
                        </div>
                        <div class="col-md-12 ">
                          <h5 class="title text-primary"> Instrucciones</h5>
                          <p>
                            - Toca el nombre de un congresista para iniciar una conversación<br><br>
                            - Los estatus de los congresistas son<br>
                            <span><i class="fa fa-circle text-muted"></i></span> Desconectado<br>
                            <span><i class="fa fa-circle text-success"></i></span> Conectado<br><br>
                            - Para ver el perfil del congresista inicia una conversación y da clic en el nombre que aparecera en la parte superior de la conversacion<br>
                          </p>


                        </div>
                        
                          <?
                        }

                        ?> 
                      </div>
                      
                      <footer class="hide camp-txt">
                          <div class="chat-txt">
                              <input type="text" name="mensaje" id="mensaje" class="form-control" onkeyup="if(validateEnter(event) == true) { preguntar(); }">
                          </div>
                          
                          <button class="btn btn-danger" id="btn-chat" onclick="preguntar();" >Enviar</button>
                      </footer>
                      <input name="receptor_id" type="hidden" id="receptor_id" value="<?if(isset($_GET['id']) && $_GET['id']!='' && isset($_GET['action']) && $_GET['action']=='descubrir'){ echo $_GET['id'];}else{?>0<?}?>">
                      <input name="receptor_nombre" type="hidden" id="receptor_nombre" value="<?if(isset($_GET['id']) && $_GET['id']!='' && isset($_GET['action']) && $_GET['action']=='descubrir'){ echo $_GET['nom'];}?>">
                      <input name="my_nombre" type="hidden" id="my_nombre" value="<?=$_SESSION['usuario']['nombre']?>">
                  </aside>
                  <aside class="right-side" >
                                <div class="adv-table">
                                    <table  class="display table table-hover" id="example">
                                      <thead>
                                      <tr>
                                          <th>Toca aqui para ordenar</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                    <?php 
                                    $query="SELECT *FROM usuarios WHERE  id!=".$_SESSION['usuario']['id']." order by tipo asc, nombre asc, apellidos asc";
                                    $usuarios=$bd->ExecuteE($query); 
                                    foreach ($usuarios as &$usuario){
                                      if ($usuario['tipo']==1) {
                                        $usuario['nombre']=" Comite organizador";
                                      }
                                      if ($usuario['tipo']==2) {
                                        $usuario['nombre']="z".$usuario['nombre'];
                                      }
                                    $sql_mensajes  = "SELECT count(*) as sin_leer FROM mensajes where visto=0 and remitente_id=".$usuario['id']." and receptor_id=".$_SESSION['usuario']['id'];
                                    $res_mensajes  = $bd->ExecuteE($sql_mensajes);
                                    $mensajes_sin_leer=0;
                                    foreach ($res_mensajes as $mensajes){
                                      $mensajes_sin_leer=$mensajes['sin_leer'];
                                    }
                                    ?>
                                      <tr style="cursor: pointer;" class="gradeC" onclick="estableceChat(<?=$usuario['id']?>,'<?=$usuario['nombre']." ".$usuario['apellidos'] ?>');">
                                          <td>
                                              <span><?=$usuario['nombre']." ".$usuario['apellidos'] ?></span>
                                              <span class="pull-right" id="status-user-<?=$usuario['id']?>"><i class="fa fa-circle text-muted"></i></span>
                                              <span id="chat-user-<?=$usuario['id']?>"><? if($mensajes_sin_leer>0){?><i class="fa fa-envelope text-danger"></i><?}?></span>
                                          </td>
                                      </tr>
                                    <?}?>
                                      </tbody>
                          </table>
                                </div>
                         
                  </aside>
              </div>
</div>

              <!-- page end