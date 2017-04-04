@extends('layouts.master')

@section('title','Argumentos')

@section('head')
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>

@endsection

@section('jumbotron')

<center><h1>Argumentos</h1></center>

@endsection

@section('body')
<div class="col-md-12">

	<div class="panel panel-default">
		<div class="panel-heading"><strong>Argumentos</strong></div>
		<div class="panel-body">
			<form method="post" action="/unificarArgumentos">
			{{csrf_field()}}
				<div class="table-responsive">
					<table id="argumentos_table_id" class="display table table-bordered table-responsive header-fixed">
					    <thead>
					        <tr>
					        	<th></th>
					            <th>Argumento</th>
					             <th>Tipo</th>
					            <th>Keywords asociados</th>
					            <th>Tests Asociados</th>

					        </tr>
					    </thead>
					    <tbody>
						    @foreach($argumentos as $index=>$argumento)
						    	<tr>
						            <td>
						            	<center>
							            	<div class="checkbox" style="margin: 10px">
											  <input name="argumentos_ids[]"  class=" editor-active checkbox_argumento" type="checkbox" value="{{$argumento->id}}"> <strong>{{$index}}</strong>
											</div>
										</center>
						            						        
									</td>
						            <td>{{$argumento->nombre}}</td>
						             <td>{{$argumento->tipo}}</td>
						            <td>{{sizeof($argumento->keywords)}}</td>
						            <td>{{sizeof($argumento->tests)}}</td>
						        </tr>
								
							@endforeach
					        	        
					    </tbody>
					</table>
					
				</div>
				<center>
				<button type="button" class="btn btn-default btn-lg boton-crear-keyword" data-toggle="modal" data-target="#modalUnificarArgumentos">Unificar Argumentos <span class="glyphicon glyphicon-ok"></span></button>				
				</center>

				<div id="modalUnificarArgumentos" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Unificar Argumentos</h4>
				      </div>
				      <div class="modal-body">
				         <div class="form-group">
						    <label for="email">Nombre del nuevo argumento:</label>
						    <input name="nombre" class="form-control" required="required">
						  </div>
				      </div>
				      <div class="modal-footer">
				      	<button type="submit" class="btn btn-info">Unificar</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				
			</form>

		</div>
	</div>



	

	<script type="text/javascript">
		$(document).ready( function () {
		    $('#argumentos_table_id').DataTable( {
		        "language": {
		            "lengthMenu": "Mostrar _MENU_ entradas por página",
		            "zeroRecords": "No se ha encontrado nada - lo siento",
		            "info": "Mostrando pagina _PAGE_ de _PAGES_",
		            "infoEmpty": "No hay registros disponibles",
		            "infoFiltered": "(filtrado de _MAX_ registros totales)"
		        }
		    } );
		} );
	</script>
	
	
</div>

@endsection