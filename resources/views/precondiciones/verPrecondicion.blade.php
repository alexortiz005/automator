<!DOCTYPE html>
<html>
<head>
	<title>Precondicion {{$precondicion->objeto}}</title>
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
      			    <h3 class="text-muted"><i>PRECONDICIÓN</i> </h3> 
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
       
      


      </div>

      <div class="jumbotron">
      	<center>
      		
        <h1 class="display-3"> VARIABLE {{$precondicion->variable}}</h1>       
      	</center>
       
      </div>

      <div class="panel-group" id="accordion">
      	<div class="panel panel-default">
      		<div class="panel-heading">
      			<h4 class="panel-title">
      				<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
      					<strong>Información</strong></a>
      				</h4>
      			</div>
      			<div id="collapse1" class="panel-collapse collapse ">
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
						   						

							<label class="control-label col-sm-3 " for="descripcion">Descripción en BD</label>
							
							<div class="input-group"> 
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control" name="descripcion" placeholder="Descripción" aria-describedby="basic-addon1" >{{$precondicion->descripcion}}</textarea> 
							</div> <br> 


							<label class="control-label col-sm-3 " for="estado">Descripción a mostrar</label>

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

							<div class="alert alert-warning">
							  <strong>Ojo!</strong> La base de datos reconoce las precondiciones por su <i>variable</i> y su <i> descripción</i>, modificar estas podría llevar a inconsistencias en los datos. Usar con cuidado
							</div>
							<button type="submit" class="btn btn-default btn-lg pull-right" > 
					    		Guardar
					    		<span class="glyphicon glyphicon-floppy-disk"></span> 
					    	</button>
							
					</div>					
				</div>


				<div class="clearfix"></div>

			</div>
			

			</form>
      				</div>
      			</div>
      			<div class="panel panel-default">
      				<div class="panel-heading">
      					<h4 class="panel-title">
      						<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
      							<strong>Keywords</strong></a>
      					</h4>
      				</div>
      				<div id="collapse2" class="panel-collapse collapse">
      					<div class="panel-body">
      						<div class="row" style="overflow: scroll; overflow-y: hidden;">     							
	      						

	      						@if(sizeof($keywords)==0)

	      							<div class="col-md-12" style="margin: 10px">
	      								<p class="text-muted"><i> La precondición no tiene Keywords asociados.</i></p>
	      								
	      							</div>	      							

	      						@else

	      							<div class="col-md-12" style="margin: 10px" >
	      							<table class="table table-bordered table-responsive" >
								    <thead>
								      <tr>
								      	<th><center><span class="glyphicon glyphicon-cog"></center></th>
								        <th>Keyword</th>
								        <th colspan="{{$maxNumeroArgumentos}}">Argumentos</th>								   
								      </tr>
								    </thead>
								    <tbody>
								    	@foreach($keywords as $indexKeyword=>$keyword)
								    		 <tr>
								    		 	<td>
								    		 		<a href="{{url('/desasociarKeyword',['precondicion',$keyword->id,$precondicion->id])}}" class="btn btn-default col-md-12" role="button"><span class="glyphicon glyphicon-remove"></span> </a>
										        
										        
										        </td>
										        <td>
										        	<a href="{{url('/keyword',$keyword->id)}}">{{$keyword->nombre}}</a>
										        
										        </td>
										        @foreach($keyword->argumentos()->get() as $indexArgumento=>$argumento)


												        <td> {{'${'.$argumento->nombre.'}'}}</td>
												        
												   
			      								@endforeach

			      								@for ($i = 0; $i < $maxNumeroArgumentos-sizeof($keyword->argumentos()->get()); $i++)
												     <td class="warning"> </td>
												@endfor
										        
										      </tr>
	      								@endforeach
								     
								    
								    </tbody>
								  </table>
	      									
	      						  
	      							
	      							</div>	
	      						@endif

	      						<div class="col-md-6">
	      							<form method="post" action="/vistaCrearKeyword">
	      								{{csrf_field()}}
	      								<input type="hidden" name="tipo" value="precondicion">
				      					<input type="hidden" name="idPrecondicion" value="{{$precondicion->id}}">
			      						<button type="submit" class="btn btn-default btn-sm" > 					    		
								    		<span class="glyphicon glyphicon-plus"></span> 
								    	</button>
								    	<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-search"></span></button>
			      						
			      					</form>

			      					

									      							
	      						</div>		      					
	      					</div>
      							
      					</div>
      				</div>
      			</div>
      					
      		</div>
      <!-- Modal -->

      <div id="myModal" class="modal fade" role="dialog">
      	<div class="modal-dialog">

      		<!-- Modal content-->
      		<div class="modal-content">

      			<form method="post" action="/asociarKeyword">

      				<div class="modal-header">
      					<button type="button" class="close" data-dismiss="modal">&times;</button>
      					<h4 class="modal-title">Buscar Keyword</h4>
      				</div>
      				<div class="modal-body">
      					<p>Some text in the modal.</p>
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

    </div> 

</body>
</html>