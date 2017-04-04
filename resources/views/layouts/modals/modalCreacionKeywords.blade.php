		<!-- Inicio Modal Crear keywords -->
		<div id="modalCreacionKeywords" class="modal fade" role="dialog">
		  <div class="modal-dialog">


		    <!-- Modal content-->

		    <form method="post" action="/crearKeyword" id="formCrearKeyword">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title"><b>Crear nuevo keyword</b></h4>
			      </div>
			      <div class="modal-body">
			      	 {{csrf_field()}}	              
		              <input type="hidden" id="idObjetoCrearKeyword" name="idObjeto" value="">
		              <input type="hidden" id="tipoObjetoCrearKeyword" name="tipo" value="">
		       

		              <div class="form-group">
		                <label class="control-label" for="nombre">Nombre *</label>
		              
		                <div class="input-group" id="inputGroupNombreCrearKeyword"> 
		                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
		                  <input class="form-control" id="nombreInputCrearKeyword" oninput="nombreInputCrearKeywordFunction();" name="nombre" placeholder="Nombre del keyword" aria-describedby="basic-addon1" required> 
		                  <span class="glyphicon glyphicon-warning-sign form-control-feedback" id="spanWarningCrearKeyword" style="display: none"></span>
		                </div> <br>
		                <p class="text-danger" id="textoAlertaCrearKeyword" style="display: none"><b>El nombre de keyword ya existe</b> </p>
		              

		                <script type="text/javascript">
		                  var request= new XMLHttpRequest();
		                  var formCrearKeyword = document.getElementById('formCrearKeyword');

		                  function nombreInputCrearKeywordFunction(){

		                    valor= $('#nombreInput').val();
		                    var formDataCrearKeyword = new FormData(formCrearKeyword);            

		                    request.open('post','/validarNombreKeyword');
		                    request.addEventListener("load",transferCompleteCrearKeyword);
		                    request.send(formDataCrearKeyword);                    

		                  }

		                  function transferCompleteCrearKeyword(data){                    

		                    if(data.currentTarget.response=='false'){
		                      $('#nombreInputCrearKeyword').addClass('has-warning');
		                      $('#inputGroupNombreCrearKeyword').addClass('has-warning');
		                      $('#spanWarningCrearKeyword').show();
		                      $('#textoAlertaCrearKeyword').show();
		                      $('#botonCrearYAsociar').prop( "disabled", true );

		                    }else{
		                      $('#nombreInputCrearKeyword').removeClass('has-warning');
		                      $('#inputGroupNombreCrearKeyword').removeClass('has-warning');
		                      $('#spanWarningCrearKeyword').hide();
		                      $('#textoAlertaCrearKeyword').hide();
		                      $('#botonCrearYAsociar').prop( "disabled", false );
		                    }                   
		                              
		                   
		                  }
		                </script>
		                

		                <label class="control-label " for="argumentos">Argumentos *</label>
		                
		                <div class="input-group"> 
		                  <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-pencil"></span></span>
		                  <input class="form-control"  id="tokenfield" name="argumentos" placeholder="Argumentos" aria-describedby="basic-addon2"> 
		                </div> 
		                 <p class="text-info"><strong><small>Debe ingresar al menos un argumento o no podra continuar</small> </strong> </p>

		                <script type="text/javascript">
		                  $('#tokenfield').tokenfield({
		                     delimiter:[' ','|',',']
		                  });                
		                </script>

		                <label class="control-label" for="source">Source</label>
		              
		                <div class="input-group"> 
		                  <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-pencil"></span></span>
		                  <textarea class="form-control"   id="sourceInput" name="source" placeholder="Código Fuente del Keyword (Opcional)" aria-describedby="basic-addon3" ></textarea>            
		                </div> <br>
		                
		              </div>


		              <div class="alert alert-info">
		                <strong>Nota:</strong> puede ingresar los argumentos con el formato <i>"${}"</i> o sin el. <b>Separados por espacios</b>
		              </div>

			      </div>
			      <div class="modal-footer">
			      	<button type="submit" class="btn btn-success" id="botonCrearYAsociar" > 
					    		Crear y Asociar
					    		<span class="glyphicon glyphicon-floppy-saved"></span> 
					    	</button>					
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
			    </div>

			</form>

		  </div>
		</div>

		<!-- Fin Modal Crear keywords -->