<!DOCTYPE html>
<html>
<head>
	<title>Escenario {{$escenario->numero}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

	<div class="container col-md-8 col-md-offset-2">
		<div class="header clearfix">
			<div class="row">
				<div class="col-md-3">
				<h3 class="text-muted"><i>ESCENARIO</i> </h3> 
				</div>

				<div class="col-md-3 pull-right" style="margin: 10px">

					<div class="dropdown pull-right">
						<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Modulos
							<span class="caret"></span></button>
							<ul class="dropdown-menu">

								@foreach($modulos as $index=>$modulo)
								<li><a href="{{ URL::to('/modulo',$modulo->id) }}">{{$modulo->nombre}}</a></li>	
								@endforeach				      

							</ul>
						</div>

					</div>

				</div>
		<div class="jumbotron">
			<center>
				<h2> <a href="{{url('modulo',$modulo->id)}}">MODULO {{$modulo->nombre}}</a></h2>
				<h1>ESCENARIO {{$escenario->numero}}</h1>
				
			</center>
		</div>
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><b>Información</b></a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">

						<form method="post" action="/editarEscenario">

							<label class="control-label  " for="estado">Id en BD</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1">#</span>
								<input class="form-control" name="id" placeholder="Id" aria-describedby="basic-addon1" value="{{$escenario->id}}" disabled> 
							</div> <br> 

							<label class="control-label " for="descripcion">Descripción</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control"  name="descripcion" placeholder="Descripción" aria-describedby="basic-addon1" >{{$escenario->descripcion}}</textarea>
								
							</div> <br> 

							<button type="submit" class="btn btn-success btn-lg pull-right" > 
								Guardar
								<span class="glyphicon glyphicon-floppy-disk"></span> 
							</button>
						</form>

					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><b>Orquestación <i>(Robot Framework)</i> </b></a>
					</h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="comment">Precondiciones</label>

<textarea class="form-control" rows="5" id="comment">PrecondicionesEscenario Test {{$escenario->numero}}
    [Arguments]@foreach($argumentos_precondiciones as $argumento)    {{'${'.$argumento.'}'}}@endforeach

@foreach($precondiciones_testeadas as $precondicion)
@foreach($precondicion->keywords as $keyword)
    {{$keyword->nombre}}@foreach($keyword->argumentos as $argumento)    {{'${'.$argumento->nombre.'}'}}@endforeach

@endforeach
@endforeach
</textarea>
<br>

								<label for="comment">Aserciones</label>
<textarea class="form-control" rows="5" id="comment">AsercionesEscenario Test {{$escenario->numero}}
    [Arguments]@foreach($argumentos_aserciones as $argumento)    {{'${'.$argumento.'}'}}@endforeach

@foreach($aserciones_testeadas as $asercion)
@foreach($asercion->keywords as $keyword)
    {{$keyword->nombre}}@foreach($keyword->argumentos as $argumento)    {{'${'.$argumento->nombre.'}'}}@endforeach

@endforeach
@endforeach
</textarea>
<br>

								<label for="comment">Tests Unitarios Precondiciones</label>
<textarea class="form-control" rows="5" id="comment">
@foreach($precondiciones_testeadas as $precondicion)
@foreach($precondicion->keywords as $keyword)
@foreach($keyword->tests as $test)
{{$test->nombre}}
@if($test->tipo=='exitoso')
    ${estatus}=    Run Keyword And Return Status    {{$keyword->nombre}}@foreach($test->argumentos as $argumento)    {{$argumento->nombre}}@endforeach

    should be true    '${estatus}'=='True'
@else
    ${estatus}=    Run Keyword And Return Status    {{$keyword->nombre}}@foreach($test->argumentos as $argumento)    {{$argumento->nombre}}@endforeach
    
    should be true    '${estatus}'=='False'
@endif

@endforeach
@endforeach
@endforeach
</textarea>
<br>

<label for="comment">Tests Unitarios Aserciones</label>
<textarea class="form-control" rows="5" id="comment">
@foreach($aserciones_testeadas as $asercion)
@foreach($asercion->keywords as $keyword)
@foreach($keyword->tests as $test)
{{$test->nombre}}
@if($test->tipo=='exitoso')
    ${estatus}=    Run Keyword And Return Status    {{$keyword->nombre}}@foreach($test->argumentos as $argumento)    {{$argumento->nombre}}@endforeach
    
    should be true    '${estatus}'=='True'
@else
    ${estatus}=    Run Keyword And Return Status    {{$keyword->nombre}}@foreach($test->argumentos as $argumento)    {{$argumento->nombre}}@endforeach
    
    should be true    '${estatus}'=='False'
@endif

@endforeach
@endforeach
@endforeach
</textarea>
								
								
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><b>Opciones</b></a>
					</h4>
				</div>
				<div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">

					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
			<center>
				<div class="links">     
					<a href="{{ url('/') }}">Home</a> 			   
			        <a href="{{ url('/upload') }}">Cargar Documentos</a>             
			    </div>
				
			</center>

				
			</div>
		</div>
      </footer>

</body>
</html>