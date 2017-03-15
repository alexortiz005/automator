<!DOCTYPE html>
<html>
<head>
	<title>Modulos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        <!-- Styles -->


</head>
<body>
<div class="container">

	<div class="jumbotron">
		<center><h1>Modulos de Automatización</h1></center>
	</div>


	<div class="col-md-6 col-md-offset-3">

		<div class="panel panel-default">
		  <div class="panel-heading">Lista de Modulos</div>
		  <div class="panel-body">

		  	@foreach($modulos as $index=>$modulo)

		  		<a href="{{ URL::to('/modulo',$modulo->id) }}" class="btn btn-default" role="button">{{$modulo->nombre}}</a>		  		

		  		

		  	@endforeach
		  
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