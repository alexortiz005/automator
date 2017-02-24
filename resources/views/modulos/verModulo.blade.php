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
		</ul>

		<div class="tab-content">
			<div id="precondicionesTab" class="tab-pane fade in active">
			<br>
			
					
				<!-- 

				INICIO PRECONDICIONES

				-->
				<div class="table-responsive">

					<table class="table table-bordered table-responsive header-fixed" >
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
								<tr>
									<th scope="row">{{$index+1}}</th>
									<td>{{$precondicion->objeto}}</td>
									<td>{{$precondicion->variable}}</td>
									<td>
										<div style="width: 150px; height: 100px; overflow: scroll">
										 	{{$precondicion->descripcion}}
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

					<table class="table table-bordered table-responsive header-fixed" >
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
								<tr>
									<th scope="row">{{$index+1}}</th>
									<td>{{$asercion->objeto}}</td>
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
		</div>
	</div>

	 

</div>

</body>
</html>