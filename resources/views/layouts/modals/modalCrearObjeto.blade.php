<div id="modalCrearObjeto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b><span id="modalCrearObjetoHeader"></span></b></h4>
      </div>
      <form method="post" action="/crearObjeto">
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="tipo" id="inputTipoObjetoACrear">
          <input type="hidden" name="moduloId" value="{{$modulo->id}}">
          <div class="row">
            <div class="col-md-12">        

              <label class="control-label col-sm-3 " for="estado">Variable</label>

              <div class="input-group"> 
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
                <input class="form-control" name="variable" placeholder="Variable" aria-describedby="basic-addon1" > 
              </div> <br> 

              <label class="control-label col-sm-3 " for="objeto">Objeto</label>

              <div class="input-group"> 
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
                <input class="form-control" name="objeto" placeholder="Objeto" aria-describedby="basic-addon1" > 
              </div> <br> 

              <label class="control-label col-sm-3 " for="ruta">Ruta</label>

              <div class="input-group"> 
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
                <textarea class="form-control"  name="ruta" placeholder="Ruta" aria-describedby="basic-addon1" ></textarea>

              </div> <br> 


              <label class="control-label col-sm-3 " for="descripcion">Descripción</label>

              <div class="input-group"> 
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
                <textarea class="form-control" name="descripcion" placeholder="Descripción" aria-describedby="basic-addon1" ></textarea> 
              </div> <br>        


                <div class="alert alert-warning">
                  <strong>Ojo!</strong> La base de datos reconoce las aserciones y precondiciones por su <i>variable</i> y su <i> descripción</i>
                </div>

              </div>          
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" > 
              Crear y Asociar
              <span class="glyphicon glyphicon-floppy-saved"></span> 
            </button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>

    </div>
  </div>