<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @section('head')
    	@show
</head>
<body>
<div class="container">

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-master" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Automator</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="navbar-master">
	    	<ul class="nav navbar-nav">
	    		   <li><a href="/">Home</a></li>
	    	</ul>
	    
	      <ul class="nav navbar-nav navbar-right">

	      	<li><a href="/argumentos">Argumentos</a></li>	     
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Modulos <span class="caret"></span></a>
	          <ul class="dropdown-menu">
    			<li><a href="{{ URL::to('/modulos') }}"> TODOS LOS MODULOS</a></li>
	          	<li role="separator" class="divider"></li>
	            @foreach($modulos as $index=>$modulo)
	            <li><a href="{{ URL::to('/modulo',$modulo->id) }}">{{$modulo->nombre}}</a></li> 
	            @endforeach
	            
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	
	<div class="jumbotron">
		@yield('jumbotron')	
	</div>

	<div class="row">
		@section('body')
			@show		
	</div>

	
</div>
@yield('footer')



</body>
</html>