<!DOCTYPE html>
<html>
<head>
	<title>MODULO {{$modulo->nombre}}</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
<div class="container">
	<div class="jumbotron">
		<center>
			<h1>MODULO {{$modulo->nombre}}</h1>
			
		</center>
		
	</div>

	<div class="container">	

		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#precondicionesTab">Precondiciones</a></li>
			<li><a data-toggle="tab" href="#asercionesTab">Aserciones</a></li>
			<li><a data-toggle="tab" href="#opcionesTab">Opciones</a></li>
		</ul>

		<div class="tab-content">
			<div id="precondicionesTab" class="tab-pane fade in active">
			<br>
			
					
				<!-- 

				INICIO PRECONDICIONES

				-->
				<div class="table-responsive">

					<table class="table table-bordered table-responsive header-fixed " >
						<thead>
							<tr>

								<th><i>N</i></th>
								<th>Funcionalidad</th>
								<th>Variable</th>
								<th>Descripción</th>
								@foreach($escenarios as $escenario)

								<th>Escenario {{$escenario->numero}}</th>
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

							
									<th scope="row">{{$index+1}}</th>
									<td>
										<a href="{{ URL::to('/precondicion',$precondicion->id) }}">{{$precondicion->objeto}}</a>
										
									</td>
									<td>{{$precondicion->variable}}</td>
									<td>
										<div style="width: 150px; height: 100px; overflow: scroll">
										 	{{$precondicion->descripcion_formateada}}
										</div>

										
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

				<!--


				FIN PRECONDICIONES

				-->



				
			</div>

			<div id="asercionesTab" class="tab-pane fade">	
				<br>		

				<!-- 

				INICIO ASERCIONES

				-->

				<div class="table-responsive">

					<table class="table table-bordered table-responsive header-fixed table-hover" >
						<thead>
							<tr>

								<th><i>N</i></th>
								<th>Funcionalidad</th>
								<th>Variable</th>
								<th>Descripción</th>
								@foreach($escenarios as $escenario)

								<th>Escenario {{$escenario->numero}}</th>
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
									<th scope="row">{{$index+1}}</th>
									<td>
										<a href="{{ URL::to('/asercion',$asercion->id) }}">{{$asercion->objeto}}</a>
									</td>
									<td>{{$asercion->variable}}</td>
									<td>
										<div style="width: 150px; height: 100px; overflow: scroll">
										 	{{$asercion->descripcion}}
										</div>

										
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

				

				  <!-- 

				FIN ASERCIONES

				-->
			</div>		

			<div id="opcionesTab" class="tab-pane fade">	
				 <br>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Configuración</div>
						  <div class="panel-body">
						  	
						    <form action="/eliminarModulo" method="post">

						    	{{csrf_field()}}
						    	<input type="hidden" name="idModulo" value="{{$modulo->id}}">
						    	<button type="submit" class="btn btn-info" > 
						    		Eliminar Modulo
						    		<span class="glyphicon glyphicon-trash"></span> 
						    	</button>

						    	
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