<!DOCTYPE html>
<html>
<head>
	<title>Modulos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>




</head>
<body>
<div class="container">

	<div class="jumbotron">
		<center><h1>Modulos de Automatización</h1></center>
	</div>


	<div class="col-md-10 col-md-offset-1">

		<div class="panel panel-default">
		  <div class="panel-heading">Lista de Modulos</div>
		  <div class="panel-body">

		  <table id="table_modulos" class="table table-striped table-bordered dt-responsive nowrap">
			    <thead>
			        <tr>
			            <th>Modulo</th>
			            <th>Precondiciones</th>
			            <th>Aserciones</th>
			            <th>Escenarios</th>
			            <th>Flujos</th>
			        </tr>
			    </thead>
			    <tbody>
			    @foreach($modulos as $index=>$modulo)
			     <tr>
			            <td>
			            	<a href="{{ URL::to('/modulo',$modulo->id) }}" >{{$modulo->nombre}}</a> 
			            </td>
			            <td>
				            <div  data-html="true" data-trigger="hover" data-toggle="popover" title="Precondiciones" 
				            data-content="{{nl2br($modulo->infoPrecondiciones())}}"
				            >{{sizeof($modulo->precondiciones)}}
				            </div>			            
			            </td>
			            <td>
			           		<div  data-html="true" data-trigger="hover" data-toggle="popover" title="Aserciones" 
				            data-content="{{nl2br($modulo->infoAserciones())}}"
				            >{{sizeof($modulo->aserciones)}}
				            </div>	
			            </td>
			            <td>{{sizeof($modulo->escenarios)}}</td>
			            <td>{{sizeof($modulo->flujos())}}</td>
			     </tr>
		  	

		  		@endforeach
			       

			    </tbody>
			</table>

			<script type="text/javascript">
				$(document).ready( function () {

					$('[data-toggle="popover"]').popover();   

				    $('#table_modulos').DataTable( {
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
		</div>
	
	</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-4">

			<center>

            <a class="btn btn-default" role="button" href="{{ url('/') }}">Home</a> 
                <!-- 
                <a href="{{ url('/upload') }}">Cargar Escenarios</a>                       
                -->
                
            </center>
				
		
		</div>
	</div>

	

		
</div>


</body>
</html>