@extends('layouts.master')

@section('title','MODULO '.$modulo->nombre)

@section('head')

	<link href="{{ URL::asset('css/bootstrap-tokenfield.min.css') }}" media="all" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('css/tokenfield-typeahead.min.css') }}" media="all" rel="stylesheet" type="text/css" />
  	<script src="{{ URL::asset('js/bootstrap-tokenfield.js') }}" type="text/javascript"></script>


  <script type="text/javascript">


  	$(function() {

  		$( ".container" ).removeClass( "container" );

  		var request= new XMLHttpRequest();
		var formEditarKeyword = document.getElementById('formEditarKeyword');
		var formObtenerKeyword = document.getElementById('formObtenerKeyword');
		var formAsociarObjeto = document.getElementById('formAsociarObjeto');

		$('.especialCell').on('contextmenu', function(e){

			data= $(this).data();

			var formData = new FormData();

			formData.append("_token",'{{csrf_token()}}');
			formData.append("tipo",data.tipo);
			formData.append("idEscenario",data.idescenario);
			formData.append("idObjeto",data.idobjeto);


  			request.open('post','/toggleAsociacion');
            request.addEventListener("load",transferCompleteClickDerechoTabla);
            request.send(formData); 

			$(this).toggleClass( "success" );
		 	return false;
		});


  		function transferCompleteClickDerechoTabla(data){

  			response= JSON.parse(data.currentTarget.response);
  			paintCell= response.paintCell;

  		}	

  		$('.botonCrearObjeto').click(function(evt) {  	
  			$('#modalCrearObjetoHeader').html('Crear '+(this).dataset.tipo);	
  			$('#inputTipoObjetoACrear').val((this).dataset.tipo);  	
  		});

  		$('.botonAsociarObjeto').click(function(evt) {  
  			$('#modalAsociarObjetoHeader').html('Asociar '+(this).dataset.tipo);				
  			$('#inputTipoObjetoAAsociar').val((this).dataset.tipo);  	
  		});

  		$('.botonCrearKeyword').click(function(evt) {  			
  			$('#idObjetoCrearKeyword').val((this).dataset.id);
  			$('#tipoObjetoCrearKeyword').val((this).dataset.tipo);  	
  		});

  		$('.botonAsociarKeyword').click(function(evt) {  			
  			$('#idObjetoAsociarKeyword').val((this).dataset.id);
  			$('#tipoObjetoAsociarKeyword').val((this).dataset.tipo);  	
  		});

  		$('.botonEditarKeyword').click(function(evt) {
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

  		//codigo para hacer merge a lass precondiciones y aserciones


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

		//codigo para que muestre el ultimo tab de la vista modulos en caso que el usuario recargue

	   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		    var target = $(e.target).attr("href");
		    sessionStorage.setItem("lastTabModulos", target);
		});


	   $('.nav-tabs a[href="'+sessionStorage.lastTabModulos+'"]').tab('show');

	});
  	
  </script>


<link href="{{ URL::asset('css/verModulo.css') }}" media="all" rel="stylesheet" type="text/css" />


@endsection

@section('jumbotron')

<center><h1>MODULO {{$modulo->nombre}}</h1></center>

@endsection

@section('body')

	<div class="col-md-12">	

		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#precondicionesTab">Precondiciones</a></li>
			<li><a data-toggle="tab" href="#asercionesTab">Aserciones</a></li>
			<li><a data-toggle="tab" href="#flujosTab">Flujos</a></li>
			<li><a data-toggle="tab" href="#testsTab">Tests</a></li>
			<li><a data-toggle="tab" href="#opcionesTab">Opciones</a></li>
		</ul>

		<div class="tab-content">
			<div id="precondicionesTab" class="tab-pane fade in active">

				<div class="row" style="margin: 10px" > 

					<button type="button" class="botonCrearObjeto btn btn-default btn-lg col-md-1" data-tipo='precondicion' data-toggle="modal" data-target="#modalCrearObjeto"> 
						<span class="glyphicon glyphicon-plus"></span> 
					</button>

					<button type="button" class="botonAsociarObjeto btn btn-default btn-lg col-md-1" style="margin-left: 10px" data-tipo='precondicion' data-toggle="modal" data-target="#modalAsociarObjeto"> 
						<span class="glyphicon glyphicon-search"></span> 
					</button>

				</div>


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
										<a  class="botonEditarKeyword" data-toggle="modal" data-target="#modalVerKeyword" data-keyword="{{$keyword->id}}">{{$keyword->nombre}}</a><br>
										@endforeach
										<button type="button" class="btn btn-default btn-xs botonCrearKeyword" data-toggle="modal" data-target="#modalCreacionKeywords" data-tipo="precondicion" data-id="{{$precondicion->id}}"><span class="glyphicon glyphicon-plus"></span> </button>
										<button type="button" class="btn btn-default btn-xs botonAsociarKeyword" data-toggle="modal" data-target="#modalAsociacionKeywords" data-tipo="precondicion" data-id="{{$precondicion->id}}"><span class="glyphicon glyphicon-search"></span></button>
										
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
											<td data-tipo='precondicion' data-idObjeto='{{$precondicion->id}}' data-idEscenario='{{$escenario->id}}' class="success especialCell"></td>
										@else
											<td  data-tipo='precondicion' data-idObjeto='{{$precondicion->id}}' data-idEscenario='{{$escenario->id}}' class="especialCell" ></td>
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

				<div class="row" style="margin: 10px" > 

					<button type="button" class="botonCrearObjeto btn btn-default btn-lg col-md-1" data-tipo='asercion' data-toggle="modal" data-target="#modalCrearObjeto"> 
						<span class="glyphicon glyphicon-plus"></span> 
					</button>

					<button type="button" class="botonAsociarObjeto btn btn-default btn-lg col-md-1" style="margin-left: 10px" data-tipo='asercion' data-toggle="modal" data-target="#modalAsociarObjeto"> 
						<span class="glyphicon glyphicon-search"></span> 
					</button>

				</div>

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
										<a class="botonEditarKeyword" data-toggle="modal" data-target="#modalVerKeyword" data-keyword="{{$keyword->id}}">{{$keyword->nombre}}</a><br>
										@endforeach
										<button id="botonAgregarKeyword" type="button" class="btn btn-default btn-xs botonCrearKeyword" data-toggle="modal" data-target="#modalCreacionKeywords" data-tipo="asercion" data-id="{{$asercion->id}}"><span class="glyphicon glyphicon-plus"></span> </button>
										<button type="button" class="btn btn-default btn-xs botonAsociarKeyword" data-toggle="modal" data-target="#modalAsociacionKeywords" data-tipo="asercion" data-id="{{$asercion->id}}"><span class="glyphicon glyphicon-search"></span></button>
										
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
											<td data-tipo='asercion' data-idObjeto='{{$asercion->id}}' data-idEscenario='{{$escenario->id}}' class="success especialCell"></td>
										@else
											<td  data-tipo='asercion' data-idObjeto='{{$asercion->id}}' data-idEscenario='{{$escenario->id}}' class="especialCell"></td>
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

			<!-- Form escondido para poder obtener keywords de forma asincrona -->

			<form id="formObtenerKeyword">
				{{csrf_field()}} 
				<input type="hidden" class="inputIdModalEditarKeyword" name="id">      		
	      	</form>

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
											<textarea rows="5" class="form-control"  name="flujo_procesado" placeholder="Flujo Procesado" aria-describedby="basic-addon1" readonly="readonly">{{is_null($escenario->flujo)?"":$escenario->flujo->flujo_procesado}}</textarea>
											
										</div> <br> 

										<label class="control-label " for="estado">Dataset</label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-usd"></span></span>
											<textarea rows="5" class="form-control"  name="dataset" placeholder="Dataset" aria-describedby="basic-addon1" readonly="readonly" >{{is_null($escenario->flujo)?"":$escenario->flujo->formatedDataset()}}</textarea>
											
										</div> <br> 

						                <button type="submit" class="btn btn-success pull-right" name="actualizar" style="margin-right: 10px"> 
						                  Guardar y Actualizar
						                  <span class="glyphicon glyphicon-floppy-disk"></span> 
						                </button>

									</div>
									
										
								</form>
								
							</div>
						</div>
					</li>
					@endforeach		 
				</ul>
				
			</div>		

			<div id="testsTab" class="tab-pane fade">
				<br>
				<ul class="list-group">

					<li class="list-group-item">
						<div class="row">
							<div class="col-md-2">
								<h3>Tests Unitarios Precondiciones</h3>									
							</div>
							<div class=" col-md-9">

										<label class="control-label " for="estado"></label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-align-left"></span></span>
											<textarea rows="10" class="form-control"  name="flujo_crudo" placeholder="Tests Unitarios Precondiciones" aria-describedby="basic-addon1" readonly="readonly">{{$modulo->formatedTestPrecondiciones()}}</textarea>
											
										</div> <br> 

							</div>
							
						</div> 
					</li>

					<li class="list-group-item">
						<div class="row">
							<div class="col-md-2">
								<h3>Tests Unitarios Aserciones</h3>									
							</div>
							<div class=" col-md-9">

										<label class="control-label " for="estado"></label>

										<div class="input-group"> 
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-align-left"></span></span>
											<textarea rows="10" class="form-control"  name="flujo_crudo" placeholder="Tests Unitarios Aserciones" aria-describedby="basic-addon1" readonly="readonly">{{$modulo->formatedTestAserciones()}}</textarea>
											
										</div> <br> 

							</div>
							
						</div> 
					</li>

					
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

		@include('layouts.modals.modalCrearObjeto')

		@include('layouts.modals.modalAsociarObjeto')

		@include('layouts.modals.modalVerKeyword')		

		@include('layouts.modals.modalCreacionKeywords')

		@include('layouts.modals.modalAsociacionKeywords')


	</div>


@endsection