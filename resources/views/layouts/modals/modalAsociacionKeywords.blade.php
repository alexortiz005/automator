		<!-- Inicio Modal Asociar keywords -->

		<div id="modalAsociacionKeywords" class="modal fade" role="dialog">
	      	<div class="modal-dialog">

	      		<!-- Modal content-->
	      		<form method="post" action="/asociarOtrosKeywords">
		      		<div class="modal-content">

		      			<form method="post" action="/asociarKeyword">

		      				<div class="modal-header">
		      					<button type="button" class="close" data-dismiss="modal">&times;</button>
		      					<h4 class="modal-title"><b>Asociar Keyword</b></h4>
		      				</div>
		      				<div class="modal-body">
		      					{{csrf_field()}}
		      					<input type="hidden" id="idObjetoAsociarKeyword" name="idObjeto" value="">
			              		<input type="hidden" id="tipoObjetoAsociarKeyword" name="tipo" value="">	      					
		      					<label for="select_keywords">Otros keywords (presione ctrl para seleccionar mas de uno):</label>
							      <select multiple class="form-control" id="select_keywords" name="otros_keywords[]" size={{$sizeSelectKeywords}}>
							      	@foreach($keywords as $index=>$keyword)
							        <option value="{{$keyword->id}}">{{$keyword->nombre}}</option>
							        @endforeach

							      </select>
		      				</div>
		      				<div class="modal-footer">
		      					<button type="submit" class="btn btn-success " > 
							    		Asociar
							    		<span class="glyphicon glyphicon-ok"></span> 
							    	</button>

		      					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		      				</div>
		      			</form>

		      		</div>

	      		</form>  

	      

	      	</div>
     	</div>

     	 <!-- Fin Modal Asociar keywords -->