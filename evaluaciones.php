          <div class="col-lg-12 ">
            <section class="panel panel-heading inbox-head header-profesores" >
            
              <h3 class="pull-left">Evaluaciones</h3>
            </section>
          </div>
         

            <div class="col-lg-12">
                <?
                  if(isset($_SESSION['mensaje']) && $_SESSION['mensaje']!=""){
                    ?>
                    <div class="alert alert-info fade in">
                        <button class="close close-sm" type="button" data-dismiss="alert">
                          <i class="fa fa-times"></i>
                        </button>
                        <strong>Mensaje</strong>
                          <?=$_SESSION['mensaje']; unset($_SESSION['mensaje']);?>&#10;
                      </div>
                    <?
                  }
                ?>
               
                      <?
                      $sql_examen  = "SELECT *FROM examenes where activo=1 and tipo=1";
                      $res_examen  = $bd->ExecuteE($sql_examen);
                      $i=0;
                      foreach ($res_examen as &$examen) {
                        $i++;
                      ?>
                      <section class="panel">
                        <div class="panel-body">
                            <div class="col-lg-6"><i class="fa fa-certificate" style="padding-right:10px; color:#FCB322"></i><?=($examen['nombreexamen'])?></div>
                            <div class="col-lg-2">Num. Preguntas: <?=$examen['preguntasactivas']?></div>
                            <div class="col-lg-2">Duración: <?=$examen['duracion']?> minutos.</div>
                            <?
                              $sql_contestada  = "SELECT *FROM contestadas where examen_id=".$examen['id']." and usuario_id=".$_SESSION['usuario']['id'];
                              $res_contestada  = $bd->ExecuteE($sql_contestada);
                              $contestada=0;
                              foreach ($res_contestada as &$contestadax) {
                                $contestada=1;
                              }
                              if($contestada==0){
                            ?>
                            <div class="col-lg-2"><a href="./?action=evaluacion&id=<?=base64_encode($examen['id'])?>"><button type="button" class="btn btn-success btn-sm" style="width:100%">Iniciar</button></a></div>
                            <?
                              }else{
                            ?>
                            <div class="col-lg-2"><a  href="./?action=resultados&id=<?=base64_encode($examen['id'])?>"><button type="button" class="btn btn-info btn-sm" style="width:100%">Resultados</button></a></div>
                            <?
                              }
                            ?>
                        </div> 
                      </section>
                      <?
                        }
                        if ($i==0) {
                      ?>
                      <div class="alert alert-warning fade in">
                        <button class="close close-sm" type="button" data-dismiss="alert">
                          <i class="fa fa-times"></i>
                        </button>
                        <strong>Ups!</strong>
                          No hay evaluaciones.&#10;
                      </div>
                      <?
                        }
                      ?>       
            </div>
                          
          

