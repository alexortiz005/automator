<!DOCTYPE html>
<html>
<head>
	<title>Modulos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
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
		<center><h1>Modulos de Automatización</h1></center>
	</div>


	<div class="col-md-6 col-md-offset-3">

		<div class="panel panel-default">
		  <div class="panel-heading">Lista de Modulos</div>
		  <div class="panel-body">

		  	@foreach($modulos as $index=>$modulo)

		  		<a href="{{ URL::to('/ver',$modulo->id) }}" class="btn btn-default" role="button">{{$modulo->nombre}}</a>		  		

		  		

		  	@endforeach
		  
		  </div>
		</div>
	
	</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-4">

			<div class="links">
				<a href="{{ url('/') }}">Home</a> 
		        <a href="{{ url('/upload') }}">Cargar Escenarios</a>                       
		    </div>
			
		</div>
	</div>

	

		
</div>


</body>
</html>