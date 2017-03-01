<!DOCTYPE html>
<html>
<head>
	<title>Precondicion {{$precondicion->objeto}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
       
        <h3 class="text-muted"><i>PRECONDICIÓN</i> </h3>   

      </div>

      <div class="jumbotron">
      	<center>
      		
        <h1 class="display-3"> VARIABLE {{$precondicion->variable}}</h1>       
      	</center>
       
      </div>

      <div class="panel panel-default">
	      	<div class="panel-heading">
				<h3 class="panel-title">Información</h3>
			</div>
			<form action="/editarPrecondicion" method="post" class="form-horizontal">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
					
						
							{{csrf_field()}}
							<input type="hidden" name="id" value="{{$precondicion->id}}">

							<label class="control-label col-sm-3 " for="estado">Id</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1">#</span>
								<input class="form-control" placeholder="Id" aria-describedby="basic-addon1" value="{{$precondicion->id}}" disabled> 
							</div> <br> 

							<label class="control-label col-sm-3 " for="estado">Variable</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<input class="form-control" name="variable" placeholder="Variable" aria-describedby="basic-addon1" value="{{$precondicion->variable}}"> 
							</div> <br> 

							<label class="control-label col-sm-3 " for="objeto">Objeto</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<input class="form-control" name="objeto" placeholder="Objeto" aria-describedby="basic-addon1" value="{{$precondicion->objeto}}"> 
							</div> <br> 

							<label class="control-label col-sm-3 " for="ruta">Ruta</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control"  name="ruta" placeholder="Ruta" aria-describedby="basic-addon1" >{{$precondicion->ruta}}</textarea>
								
							</div> <br> 
						   						

							<label class="control-label col-sm-4 " for="descripcion">Descripción en BD</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control" name="descripcion" placeholder="Descripción" aria-describedby="basic-addon1" >{{$precondicion->descripcion}}</textarea> 
							</div> <br> 


							<label class="control-label col-sm-4 " for="estado">Descripción que se muestra</label>

							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control" name="descripcion_formateada" placeholder="Descripción" aria-describedby="basic-addon1" >{{$precondicion->descripcion_formateada}}</textarea> 
							</div> <br> 
							<!-- 
							<div class="input-group"> 
								<input class="form-control" placeholder="Recipient's username" aria-describedby="basic-addon2"> 
								<span class="input-group-addon" id="basic-addon2">@example.com</span> 
							</div> <br> 
							<div class="input-group"> 
								<span class="input-group-addon">$</span> 
								<input class="form-control" aria-label="Amount (to the nearest dollar)"> 
								<span class="input-group-addon">.00</span> 
							</div> <br> 
							-->						
					</div>
					<div class="col-md-6">

							<div class="form-group"> 								    

								<label class="control-label col-sm-2 " for="estado">Estado</label>
								<div class="col-sm-10">

									<select class="form-control " name="estado">

										@foreach($estados as $index=>$estado)
										@if($precondicion->estado==$index)
										<option value="{{$index}}" selected>{{$estado}}</option>
										@else
										<option value="{{$index}}">{{$estado}}</option>
										@endif

										@endforeach							    

									</select>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>Keywords</strong>
								</div>
								<div class="panel-body">
									
									
								</div>
							</div>
					</div>
					<div class="col-sm-10 col-md-offset-1" >
						<div class="alert alert-warning" style="margin: 10px">
						  <strong>Ojo!</strong> La base de datos reconoce las precondiciones por su <i>variable</i> y su <i> descripción</i>, modificar estas podría llevar a inconsistencias en los datos. Usar con cuidado
						</div>
					</div>
				</div>

			</div>
			<div class="panel-footer">

				<button type="submit" class="btn btn-default btn-lg pull-right" > 
		    		Guardar
		    		<span class="glyphicon glyphicon-floppy-disk"></span> 
		    	</button>

				<div class="clearfix"></div>
			</div>

			</form>
		</div>



      <footer class="footer">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
			<center>
				<div class="links">     
					<a href="{{ url('/') }}">Home</a> 
			        <a href="{{ url('/modulos') }}">Modulos</a>       
			        <a href="{{ url('/upload') }}">Cargar Documentos</a>             
			    </div>
				
			</center>

				
			</div>
		</div>
      </footer>

    </div> 

</body>
</html>