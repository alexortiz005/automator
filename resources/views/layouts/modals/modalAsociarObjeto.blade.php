<div id="modalAsociarObjeto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b><span id="modalAsociarObjetoHeader"></span></b></h4>
      </div>
      <form method="post" action="/asociarObjeto">
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="tipo" id="inputTipoObjetoAAsociar">
          <input type="hidden" name="moduloId" value="{{$modulo->id}}">
          <p>asociar objeto</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success " > 
            Asociar
            <span class="glyphicon glyphicon-ok"></span> 
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>

  </div>
</div>