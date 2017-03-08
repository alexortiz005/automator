<!DOCTYPE html>
<html>
<head>
	<title>MODULO {{$modulo->nombre}}</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">

  	$(function() {


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

	.table-hover tbody tr:hover > td.success {
	  background-color: #d0e9c6 !important;
	}

	.table-hover tbody tr:hover > td.error {
	  background-color: #ebcccc !important;
	}

	.table-hover tbody tr:hover > td.warning {
	  background-color: #faf2cc !important;
	}

	.table-hover tbody tr:hover > td.info {
	  background-color: #c4e3f3 !important;
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
								<tr class="danger">								
								@endif
								@if($precondicion->estado=='sin_disenar')
								<tr class="warning">								
								@endif
								@if($precondicion->estado=='disenada')
								<tr class="success">								
								@endif
								@if($precondicion->estado=='testeada')
								<tr>								
								@endif

							
									<th scope="row">
										<div class="checkbox">
										  <label><input class="precondicion-checkbox" type="checkbox" value="{{$precondicion->id}}"><b>{{$index+1}}</b></label>
										</div>									
									</th>
									<td>
										
										@foreach($precondicion->keywords()->get() as $indexKeyword=>$keyword)
										<a href="{{url('/keyword',$keyword->id)}}">{{$keyword->nombre}} </a> <br>
										@endforeach
										
									</td>

									<td>
										<a href="{{ URL::to('/precondicion',$precondicion->id) }}">{{$precondicion->objeto}}</a>
									</td>

									<td>{{$precondicion->variable}}</td>
									<td>
										<pre style="width: 250px; height: 150px; overflow-x: scroll; word-wrap: break-word;">{{trim($precondicion->descripcion_formateada)}}</pre>

										
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
								<tr class="danger">								
								@endif
								@if($asercion->estado=='sin_disenar')
								<tr class="warning">								
								@endif
								@if($asercion->estado=='disenada')
								<tr class="success">								
								@endif
								@if($asercion->estado=='testeada')
								<tr>								
								@endif
									<td scope="row">
										<div class="checkbox">
										  <label><input class="asercion-checkbox" type="checkbox" value="{{$asercion->id}}"><b>{{$index+1}}</b></label>
										</div>									
									</td>
									<td>
										
										@foreach($asercion->keywords()->get() as $indexKeyword=>$keyword)
										<a href="{{url('/keyword',$keyword->id)}}">{{$keyword->nombre}} </a> <br>
										@endforeach
										
									</td>
									<td>
										<a href="{{ URL::to('/asercion',$asercion->id) }}">{{$asercion->objeto}}</a>
									</td>
									<td>{{$asercion->variable}}</td>
									<td>
										<pre style="width: 250px; height: 150px; overflow-x: scroll">{{$asercion->descripcion_formateada}}</pre>

										
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

										<button type="submit" class="btn btn-success pull-right" name="guardar" style="display: none"> 
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
						    	<button type="submit" id="botonEliminar" class="btn btn-info" > 
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

		<div class="row" style="margin: 10px">

			<div class="col-md-6 col-md-offset-3">
				<center>
					<div class="links">     
						<a href="{{ url('/') }}">Home</a> 
				        <a href="{{ url('/modulos') }}">Modulos</a>       
				        <a href="{{ url('/upload') }}">Cargar Documentos</a>             
				    </div>
					
				</center>
			
			
		</div>
	</div>
	</div>

	 

</div>

</body>
</html>