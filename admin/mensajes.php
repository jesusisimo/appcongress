<div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                             Enviar mensaje a todos los congresistas
                          </header>
                          <div class="panel-body">
                              
                                  <div class="form-group">
                                      <label for="mensaje">Mensaje</label>
                                      <textarea class="form-control" id="mensaje" name="mensaje"></textarea>
                                      
                                  </div>
                                  <div class="form-group">
                                    <div class="radio">
                                      <label>
                                      <input type="radio" checked="" value="0"  name="tipomsg">
                                      Mensaje normal
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label>
                                      <input type="radio" value="1" name="tipomsg">
                                      Notificacion de votación
                                      </label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="archivo">Adjuntar archivo</label>
                                      <input type="file" disbaled id="archivo" name="archivo">
                                      <p class="help-block">si deseas enviar un archivo adjuntalo aqui.</p>
                                  </div>
                                  
                                  <button type="submit" id="send-msg" class="btn btn-info">Enviar</button>
                             

                          </div>
                      </section>
                  </div>
        </div>
      