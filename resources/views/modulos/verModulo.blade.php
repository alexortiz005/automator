<!DOCTYPE html>
<html>
<head>
	<title>MODULO {{$modulo->nombre}}</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="{{ URL::asset('css/bootstrap-tokenfield.min.css') }}" media="all" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('css/tokenfield-typeahead.min.css') }}" media="all" rel="stylesheet" type="text/css" />
  	<script src="{{ URL::asset('js/bootstrap-tokenfield.js') }}" type="text/javascript"></script>


  <script type="text/javascript">


  	$(function() {


  		var request= new XMLHttpRequest();
		var formEditarKeyword = document.getElementById('formEditarKeyword');
		var formObtenerKeyword = document.getElementById('formObtenerKeyword');
		       

  		$('.boton-crear-keyword').click(function(evt) {  			
  			$('#idObjetoCrearKeyword').val((this).dataset.id);
  			$('#tipoObjetoCrearKeyword').val((this).dataset.tipo);  	
  		});

  		$('.boton-asociar-keyword').click(function(evt) {  			
  			$('#idObjetoAsociarKeyword').val((this).dataset.id);
  			$('#tipoObjetoAsociarKeyword').val((this).dataset.tipo);  	
  		});

  		$('.boton-editar-keyword').click(function(evt) {
  			keyword_id= (this).dataset.keyword;  		
  			$('.inputIdModalEditarKeyword').val(keyword_id);

  			var formDataObtenerKeyword = new FormData(formObtenerKeyword);

  			request.open('post','/obtenerKeywordJSON');
            request.addEventListener("load",transferCompleteObtenerKeyword);
            request.send(formDataObtenerKeyword); 	
  		});

  		function transferCompleteObtenerKeyword(data){

  			response= JSON.parse(data.currentTarget.response);
  			keyword= response.keyword;
  			argumentos= response.argumentos;

  			$('#editarKeywordHeader').html("<a href=\"{{ URL::to('/keyword') }}/"+keyword.id+"\">Keyword "+keyword.nombre+"</a>");
  			$('#nombreInputEditarKeyword').val(keyword.nombre);
  			$('#sourceInputEditarKeyword').val(keyword.source);

  			$('#tokenfield_editar_keyword').tokenfield('setTokens', argumentos);


  		}


		$('input.precondicion-checkbox').on('change', function(evt) {

			var checkboxes=$('input.precondicion-checkbox:checked');	

			if(checkboxes.length>2){
				this.checked = false;
			}else{
				var valor= new Array();
				checkboxes.each(function( index ) {
				  valor.push((this).value);
				});
				console.log(valor);
				$('#precondicionesToMerge').val(valor);
			}
							  
		});

		
		$('input.asercion-checkbox').on('change', function(evt) {

			var checkboxes=$('input.asercion-checkbox:checked');	

			if(checkboxes.length>2){
				this.checked = false;
			}else{
				var valor= new Array();
				checkboxes.each(function( index ) {
				  valor.push((this).value);
				});
				console.log(valor);
				$('#asercionesToMerge').val(valor);
			}
							  
		});

	   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		    var target = $(e.target).attr("href");
		    sessionStorage.setItem("lastTabModulos", target);
		});

	   $('.nav-tabs a[href="'+sessionStorage.lastTabModulos+'"]').tab('show')

	});
  	
  </script>

  <style type="text/css">
  	
  	.table tbody tr > td.success {
	  background-color: #ffc34d !important;
	}

	.table tbody tr > td.error {
	  background-color: #f2dede !important;
	}

	.table tbody tr > td.warning {
	  background-color: #fcf8e3 !important;
	}

	.table tbody tr > td.info {
	  background-color: #d9edf7 !important;
	}

	.table tbody tr > td.danger {
	  background-color: #d9edf7 !important;
	}

	.table > thead > tr > td.sin_asignar,
	.table > tbody > tr > td.sin_asignar,
	.table > tfoot > tr > td.sin_asignar,
	.table > thead > tr > th.sin_asignar,
	.table > tbody > tr > th.sin_asignar,
	.table > tfoot > tr > th.sin_asignar,
	.table > thead > tr.sin_asignar > td,
	.table > tbody > tr.sin_asignar > td,
	.table > tfoot > tr.sin_asignar > td,
	.table > thead > tr.sin_asignar > th,
	.table > tbody > tr.sin_asignar > th,
	.table > tfoot > tr.sin_asignar > th {
	  background-color: #b1b1b1;
	}

	.table > thead > tr > td.sin_disenar,
	.table > tbody > tr > td.sin_disenar,
	.table > tfoot > tr > td.sin_disenar,
	.table > thead > tr > th.sin_disenar,
	.table > tbody > tr > th.sin_disenar,
	.table > tfoot > tr > th.sin_disenar,
	.table > thead > tr.sin_disenar > td,
	.table > tbody > tr.sin_disenar > td,
	.table > tfoot > tr.sin_disenar > td,
	.table > thead > tr.sin_disenar > th,
	.table > tbody > tr.sin_disenar > th,
	.table > tfoot > tr.sin_disenar > th {
	  background-color: #99ecff;
	}

	.table > thead > tr > td.disenada,
	.table > tbody > tr > td.disenada,
	.table > tfoot > tr > td.disenada,
	.table > thead > tr > th.disenada,
	.table > tbody > tr > th.disenada,
	.table > tfoot > tr > th.disenada,
	.table > thead > tr.disenada > td,
	.table > tbody > tr.disenada > td,
	.table > tfoot > tr.disenada > td,
	.table > thead > tr.disenada > th,
	.table > tbody > tr.disenada > th,
	.table > tfoot > tr.disenada > th {
	  background-color: #e6ffcc;
	}




  </style>

  <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
</head>
<body>
<div class="">
	<div class="jumbotron">
		<center>
			<h1>MODULO {{$modulo->nombre}}</h1>
			
		</center>
		
	</div>

	<div class="">	

		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#precondicionesTab">Precondiciones</a></li>
			<li><a data-toggle="tab" href="#asercionesTab">Aserciones</a></li>
			<li><a data-toggle="tab" href="#flujosTab">Flujos</a></li>
			<li><a data-toggle="tab" href="#opcionesTab">Opciones</a></li>
		</ul>

		<div class="tab-content">
			<div id="precondicionesTab" class="tab-pane fade in active">
				<br>
				<form method="post" action="/mergePrecondiciones" id="formMergePrecondiciones">
				{{csrf_field()}}
				<input type="hidden" id="precondicionesToMerge" name="precondicionesToMerge" value="123">
			
					
				<!-- 

				INICIO PRECONDICIONES

				-->
				<div class="table-responsive">

					<table class="table table-bordered table-responsive header-fixed " >
						<thead>
							<tr>

								<th><i>N</i></th>
								<th>Keywords</th>
								<th>Funcionalidad</th>
								<th>Variable</th>
								<th>Descripción</th>
								@foreach($escenarios as $escenario)

								<th>
									<a href="{{url('/escenario',$escenario->id)}}">
										Escenario {{$escenario->numero}}
									</a>
								
								</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach($precondiciones as $index=>$precondicion)
								@if($precondicion->estado=='sin_asignar')
								<tr class="sin_asignar">								
								@endif
								@if($precondicion->estado=='sin_disenar')
								<tr class="sin_disenar">								
								@endif
								@if($precondicion->estado=='disenada')
								<tr class="disenada">								
								@endif
								@if($precondicion->estado=='testeada')
								<tr>								
								@endif

							
									<th scope="row">
										<div class="checkbox">
										  <label><input class="precondicion-checkbox" type="checkbox" value="{{$precondicion->id}}"><b>
										  	<a href="{{ URL::to('/precondicion',$precondicion->id) }}">{{$index+1}}</a>
										  </b>
										  </label>
										</div>									
									</th>
									<td>
										
										@foreach($precondicion->keywords()->get() as $indexKeyword=>$keyword)
										<!-- Trigger the modal with a button -->
										<a  class="boton-editar-keyword" data-toggle="modal" data-target="#modalVerKeyword" data-keyword="{{$keyword->id}}">{{$keyword->nombre}}</a><br>
										@endforeach
										<button type="button" class="btn btn-default btn-xs boton-crear-keyword" data-toggle="modal" data-target="#modalCreacionKeywords" data-tipo="precondicion" data-id="{{$precondicion->id}}"><span class="glyphicon glyphicon-plus"></span> </button>
										<button type="button" class="btn btn-default btn-xs boton-asociar-keyword" data-toggle="modal" data-target="#modalAsociacionKeywords" data-tipo="precondicion" data-id="{{$precondicion->id}}"><span class="glyphicon glyphicon-search"></span></button>
										
									</td>

									<td>
										{{$precondicion->objeto}}
										
									</td>

									<td>{{$precondicion->variable}}</td>
									<td>
										<pre style="width: 250px; height: 150px; overflow-x: scroll; white-space: pre-wrap;">{{trim($precondicion->descripcion_formateada)}}</pre>

										
									</td>
									@foreach($escenarios as $escenario)

										@if($escenario->esMiPrecondicion($precondicion))
											<td class="success"></td>
										@else
											<td ></td>
										@endif
									
									@endforeach
								</tr>

							@endforeach
							
					
						</tbody>
					</table>



				</div>

				<center>
					<button type="submit" class="btn btn-info btn-lg " style="margin: 10px" id="botonMergePrecondiciones"> 
	                  Merge Precondiciones
	                  <span class="glyphicon glyphicon-random"></span> 
	                </button>
	                <div class="clearfix"></div>	                
					
				</center>

				<script type="text/javascript">
		    		$( "#botonMergePrecondiciones" ).click(function( event ) {
					  event.preventDefault();
					  if(confirm('Esta accion no se puede deshacer¿Esta seguro de que desea proseguir?'))
					  	$('#formMergePrecondiciones').submit();
					  
					});
		    		
		    	</script>
				</form>

				<!--


				FIN PRECONDICIONES

				-->



				
			</div>

			<div id="asercionesTab" class="tab-pane fade">	
				<br>	

				<form method="post" action="/mergeAserciones" id="formMergeAserciones">
				{{csrf_field()}}
				<input type="hidden" id="asercionesToMerge" name="asercionesToMerge" value="123">	

				<!-- 

				INICIO ASERCIONES

				-->

				<div class="table-responsive">

					<table class="table table-bordered table-responsive header-fixed" >
						<thead>
							<tr>

								<th><i>N</i></th>
								<th>Keywords</th>
								<th>Funcionalidad</th>
								<th>Variable</th>
								<th>Descripción</th>
								@foreach($escenarios as $escenario)

								
								<th>
									<a href="{{url('/escenario',$escenario->id)}}">
										Escenario {{$escenario->numero}}
									</a>
								
								</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach($aserciones as $index=>$asercion)
								@if($asercion->estado=='sin_asignar')
								<tr class="sin_asignar">								
								@endif
								@if($asercion->estado=='sin_disenar')
								<tr class="sin_disenar">								
								@endif
								@if($asercion->estado=='disenada')
								<tr class="disenada">								
								@endif
								@if($asercion->estado=='testeada')
								<tr>								
								@endif
									<td scope="row">
										<div class="checkbox">
										  <label><input class="asercion-checkbox" type="checkbox" value="{{$asercion->id}}">
										  <b>
										  	<a href="{{ URL::to('/asercion',$asercion->id) }}">{{$index+1}}</a>
										  </b>
										  </label>
										</div>									
									</td>
									<td>
										
										@foreach($asercion->keywords()->get() as $indexKeyword=>$keyword)
										<a class="boton-editar-keyword" data-toggle="modal" data-target="#modalVerKeyword" data-keyword="{{$keyword->id}}">{{$keyword->nombre}}</a><br>
										@endforeach
										<button id="botonAgregarKeyword" type="button" class="btn btn-default btn-xs boton-crear-keyword" data-toggle="modal" data-target="#modalCreacionKeywords" data-tipo="asercion" data-id="{{$asercion->id}}"><span class="glyphicon glyphicon-plus"></span> </button>
										<button type="button" class="btn btn-default btn-xs boton-asociar-keyword" data-toggle="modal" data-target="#modalAsociacionKeywords" data-tipo="asercion" data-id="{{$asercion->id}}"><span class="glyphicon glyphicon-search"></span></button>
										
									</td>
									<td>
										{{$asercion->objeto}}
									</td>
									<td>{{$asercion->variable}}</td>
									<td>
										<pre style="width: 250px; height: 150px;white-space: pre-wrap;">{{$asercion->descripcion_formateada}}</pre>

										
									</td>
									@foreach($escenarios as $escenario)

										@if($escenario->esMiAsercion($asercion))
											<td class="success"></td>
										@else
											<td ></td>
										@endif
									
									@endforeach
								</tr>

							@endforeach
							
					
						</tbody>
					</table>

				</div>

				<center>
					<button type="submit" class="btn btn-info btn-lg " style="margin: 10px" id="botonMergeAserciones" > 
	                  Merge Aserciones
	                  <span class="glyphicon glyphicon-random"></span> 
	                </button>
	                <div class="clearfix"></div>
					
				</center>

				<script type="text/javascript">
		    		$( "#botonMergeAserciones" ).click(function( event ) {
					  event.preventDefault();
					  if(confirm('Esta accion no se puede deshacer¿Esta seguro de que desea proseguir?'))
					  	$('#formMergeAserciones').submit();
					 
					  
					  
					});
		    		
		    	</script>

				</form>

				

				  <!-- 

				FIN ASERCIONES

				-->
			</div>	

			<div id="flujosTab" class="tab-pane fade">
			<br>
		

				<ul class="list-group">	
					@foreach($escenarios as $escenario)
					<li class="list-group-item"> 
						<div class="">
							<div class="row">
								<div class="col-md-2">
									<h2>Escenario {{$escenario->numero}}</h2>									
								</div>
								<form method="post" action="/editarFlujo">
									{{csrf_field()}}
									<div class="col-md-9">

										<input type="hidden" name="escenario_id" value="{{$escenario->id}}">					

										<label class="control-label " for="estado">Flujo Crudo</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-align-left"></span></span>
											<textarea rows="5" class="form-control"  name="flujo_crudo" placeholder="Flujo Crudo" aria-describedby="basic-addon1" >{{is_null($escenario->flujo)?"":$escenario->flujo->flujo_crudo}}</textarea>
											
										</div> <br> 

										<label class="control-label " for="estado">Flujo Procesado</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-indent-left"></span></span>
											<textarea rows="5" class="form-control"  name="flujo_procesado" placeholder="Flujo Procesado" aria-describedby="basic-addon1" >{{is_null($escenario->flujo)?"":$escenario->flujo->flujo_procesado}}</textarea>
											
										</div> <br> 

										<label class="control-label " for="estado">Dataset</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-usd"></span></span>
											<textarea rows="5" class="form-control"  name="dataset" placeholder="Dataset" aria-describedby="basic-addon1"  >{{is_null($escenario->flujo)?"":$escenario->flujo->dataset}}</textarea>
											
										</div> <br> 

										<button type="submit" class="btn btn-success pull-right" name="guardar" > 
						                  Guardar
						                  <span class="glyphicon glyphicon-floppy-disk"></span> 
						                </button>

						                <button type="submit" class="btn btn-info pull-right" name="actualizar" style="margin-right: 10px"> 
						                  Actualizar
						                  <span class="glyphicon glyphicon-refresh"></span> 
						                </button>

									</div>
									
										
								</form>
								
							</div>
						</div>
					</li>
					@endforeach		 
				</ul>
				
			</div>		

			<div id="opcionesTab" class="tab-pane fade">	
				 <br>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Configuración</div>
						  <div class="panel-body">
						  	
						    <form action="/eliminarModulo" method="post" id="formEliminar">

						    	{{csrf_field()}}
						    	<input type="hidden" name="idModulo" value="{{$modulo->id}}">
						    	<button type="submit" id="botonEliminar" class="btn btn-info"  style="display: none;" > 
						    		Eliminar Modulo
						    		<span class="glyphicon glyphicon-trash"></span> 
						    	</button>
						    	<script type="text/javascript">
						    		$( "#botonEliminar" ).click(function( event ) {
									  event.preventDefault();
									  if(confirm('¿Esta seguro de las concecuencias que traera esto?'))
									  	$('#formEliminar').submit();
									 
									  
									  
									});
						    		
						    	</script>

						    	
						    </form>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>


		

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

		<!-- Form escondido para poder obtener keywords de forma asincrona -->

		<form id="formObtenerKeyword">
			{{csrf_field()}} 
			<input type="hidden" class="inputIdModalEditarKeyword" name="id">      		
      	</form>



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

		<!-- Inicio Modal Asociar keywords -->

		<div id="modalAsociacionKeywords" class="modal fade" role="dialog">
      	<div class="modal-dialog">

      		<!-- Modal content-->
      		<form method="post" action="/asociarOtrosKeywords">
	      		<div class="modal-content">

	      			<form method="post" action="/asociarKeyword">

	      				<div class="modal-header">
	      					<button type="button" class="close" data-dismiss="modal">&times;</button>
	      					<h4 class="modal-title">Buscar Keyword</h4>
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

      	<!-- Fin Modal Asociar keywords -->

      

      	</div>
      </div>

		<div class="row" style="margin: 10px">

			<div class="col-md-6 col-md-offset-3">
				<center>
					<div class="links">     
						<a href="{{ url('/') }}">Home</a> 
				        <a href="{{ url('/modulos') }}">Modulos</a>   
				        <!-- 
				        <a href="{{ url('/upload') }}">Cargar Documentos</a>             
				        -->    
				    </div>
					
				</center>
			
			
		</div>
	</div>
	</div>

	 

</div>

</body>
</html>