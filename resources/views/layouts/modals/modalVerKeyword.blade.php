		<!-- Inicio Modal editar keyword -->
		<div id="modalVerKeyword" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="editarKeywordHeader"></h4>
					</div>
					<form method="post" action="/editarKeyword" id="formEditarKeyword">
						<div class="modal-body">						
						
							{{csrf_field()}}  

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">

										<input type="hidden" class="inputIdModalEditarKeyword" name="id">
										<label class="control-label " for="estado">Id en BD</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1">#</span>
											<input  class="form-control inputIdModalEditarKeyword" name="id" placeholder="Id" aria-describedby="basic-addon1" value="" disabled>
										</div> <br> 
										<label class="control-label" for="nombre">Nombre *</label>

										<div class="input-group" id="inputGroupNombreEditarKeyword"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
											<input class="form-control" id="nombreInputEditarKeyword" oninput="nombreInputEditarKeywordFunction();" name="nombre" placeholder="Nombre del keyword" aria-describedby="basic-addon1" required> 
											<span class="glyphicon glyphicon-warning-sign form-control-feedback" id="spanWarningEditarKeyword" style="display: none"></span>
										</div>

										<p class="text-danger" id="textoAlertaEditarKeyword" style="display: none"><b>El nombre de keyword ya existe</b> </p>
										<br>

										<label class="control-label " for="argumentos">Argumentos *</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-pencil"></span></span>
											<input class="form-control"  id="tokenfield_editar_keyword" name="argumentos" placeholder="Argumentos" aria-describedby="basic-addon2">
										</div>
										<p class="text-info"><strong><small>Debe ingresar al menos un argumento</small> </strong> </p>

										<script type="text/javascript">

											$('#tokenfield_editar_keyword').tokenfield({
												delimiter:[' ','|',',']
											}); 

											function nombreInputEditarKeywordFunction(){

												valor= $('#nombreInput').val();
												var formDataEditarKeyword = new FormData(formEditarKeyword);            

												request.open('post','/validarNombreKeyword');
												request.addEventListener("load",transferCompleteEditarKeyword);
												request.send(formDataEditarKeyword);                    

											}

											function transferCompleteEditarKeyword(data){      

												console.log(data.currentTarget.response);             

												if(data.currentTarget.response=='false'){
													$('#nombreInputEditarKeyword').addClass('has-warning');
													$('#inputGroupNombreEditarKeyword').addClass('has-warning');
													$('#spanWarningEditarKeyword').show();
													$('#textoAlertaEditarKeyword').show();
													$('#botonEditar').prop( "disabled", true );

												}else{
													$('#nombreInputEditarKeyword').removeClass('has-warning');
													$('#inputGroupNombreEditarKeyword').removeClass('has-warning');
													$('#spanWarningEditarKeyword').hide();
													$('#textoAlertaEditarKeyword').hide();
													$('#botonEditar').prop( "disabled", false );
												}                   


											}               
										</script>

										<label class="control-label" for="source">Source</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-pencil"></span></span>
											<textarea class="form-control"   id="sourceInputEditarKeyword" name="source" placeholder="Código Fuente del Keyword (Opcional)" aria-describedby="basic-addon3" ></textarea>            
										</div> <br>
										<div class="alert alert-info">
											<strong>Nota:</strong> puede ingresar los argumentos con el formato <i>"${}"</i> o sin el. <b>Separados por espacios</b>
										</div>	
									</div>
								</div>
							</div> 					
						</div>
						<div class="modal-footer">
							<button id="botonEditar" type="submit" class="btn btn-success" >Guardar <span class="glyphicon glyphicon-floppy-disk"></span></button>										
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>

			</div>
		</div>
		<!-- Fin Modal ver keyword -->

		