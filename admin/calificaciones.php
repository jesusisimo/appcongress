              <?
              if(isset($_GET['usuario'])){
                $sql_usuarios  = "SELECT *FROM usuarios where id=".$_GET['usuario'];
              }else{
                $sql_usuarios  = "SELECT *FROM usuarios where id!=1 and id>=501";
              }
                 
              $res_usuarios  = $bd->ExecuteE($sql_usuarios);
              foreach ($res_usuarios as &$usuario) {
              ?>
            <div class="col-lg-12">
              <section class="panel">
                <div class="border-head">
                    <header class="panel-heading">
                       <h1 class="title">Evaluaciones de <?=$usuario['nombre']?> <?=$usuario['apellidos']?></h1>
                    </header>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Examen</th>
                        <th>Preguntas</th>
                        <th>Correctas</th>
                        <th>Incorrectas</th>
                        <th>Calificación</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?
                      $sql_contestadas  = "SELECT * FROM contestadas where usuario_id=".$usuario['id'];
                      $res_contestadas  = $bd->ExecuteE($sql_contestadas);
                      $e=0;
                      foreach ($res_contestadas as &$contestada) {
                     $e++;
                      $sql_examenes  = "SELECT *FROM examenes where id=".$contestada['examen_id'];
                      $res_examenes  = $bd->ExecuteE($sql_examenes);
                      foreach ($res_examenes as &$examen) {
                  ?>

                      <tr>
                        <td><?=$e;?></td>
                        <td><?=$examen['nombreexamen'];?></td>
                        <td><?=$examen['preguntasactivas'];?></td>
                        <?
                            $buenas=0;
                            $malas=0;
                            $sql_resultados  = "SELECT *FROM resultados where examen_id=".$examen['id']." and usuario_id=".$usuario['id']." order by pregunta_id asc, intento desc";
                            $res_resultados  = $bd->ExecuteE($sql_resultados);
                            foreach ($res_resultados as &$resultado) {
                              $sql_preguntas  = "SELECT *FROM preguntas where activo=1 and id=".$resultado['pregunta_id'];
                              $res_preguntas  = $bd->ExecuteE($sql_preguntas);
                              foreach ($res_preguntas as &$pregunta) {
                                $sql_opciones  = "SELECT *FROM opciones where pregunta_id=".$pregunta['id'];
                                $res_opciones  = $bd->ExecuteE($sql_opciones);
                                foreach ($res_opciones as &$opcion) {
                                  if($resultado['opcion_id']==$opcion['id'] and $opcion['correcta']==0 ){ $malas++;} 
                                  if($opcion['correcta']==1){ if($resultado['opcion_id']==$opcion['id']){ $buenas++;}}
                                }
                              }
                            }
                            
                          ?>
                        <td><?=$buenas?></td>
                        <td><?=$malas?></td>
                        <td><?=number_format((($buenas/$examen['preguntasactivas'])*100), 2, '.', '');?>%</td>
                      </tr>
                  <?
                      }
                    }
                ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
              <?
                  }
                ?>