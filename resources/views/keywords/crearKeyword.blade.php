<!DOCTYPE html>
<html>
<head>
	<title>Crear keyword</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link href="{{ URL::asset('css/bootstrap-tokenfield.min.css') }}" media="all" rel="stylesheet" type="text/css" />
  	<link href="{{ URL::asset('css/tokenfield-typeahead.min.css') }}" media="all" rel="stylesheet" type="text/css" />
  	<script src="{{ URL::asset('js/bootstrap-tokenfield.js') }}" type="text/javascript"></script>

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
      			    <h3 class="text-muted"><i>KEYWORD</i> </h3> 
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
      		
        <h1 class="display-3"> CREAR KEYWORD</h1> 
        @if(isset($precondicion))
        <h2>para precondición {{$precondicion->variable}}</h2>
        @endif      

        @if(isset($asercion))
        <h2>para aserción {{$asercion->variable}}</h2>
        @endif  
      	</center>
       
      </div>
      <form method="post" action="/crearKeyword" id="formCrearKeyword">
	      <div class="panel panel-default">
	      	
	      		<div class="panel-heading"><strong>Parametros</strong> </div>
		      	<div class="panel-body">
		      	 {{csrf_field()}}
              @if(isset($precondicion))
							<input type="hidden" name="idObjeto" value="{{$precondicion->id}}">
              <input type="hidden" name="tipo" value="precondicion">
              @endif
              @if(isset($asercion))
              <input type="hidden" name="idObjeto" value="{{$asercion->id}}">
              <input type="hidden" name="tipo" value="asercion">
              @endif

              <div class="form-group">
                <label class="control-label" for="nombre">Nombre *</label>
              
                <div class="input-group" id="inputGroupNombre"> 
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
                  <input class="form-control" id="nombreInput" oninput="nombreInputFunction();" name="nombre" placeholder="Nombre del keyword" aria-describedby="basic-addon1" required> 
                  <span class="glyphicon glyphicon-warning-sign form-control-feedback" id="spanWarning" style="display: none"></span>
                </div> <br>
                <p class="text-danger" id="textoAlerta" style="display: none"><b>El nombre de keyword ya existe</b> </p>
              

                <script type="text/javascript">
                  var request= new XMLHttpRequest();
                  var form = document.getElementById('formCrearKeyword');

                  function nombreInputFunction(){

                    valor= $('#nombreInput').val();
                    var formdata = new FormData(form);            

                    request.open('post','/validarNombreKeyword');
                    request.addEventListener("load",transferComplete);
                    request.send(formdata);                    

                  }

                  function transferComplete(data){                    

                    if(data.currentTarget.response=='false'){
                      $('#nombreInput').addClass('has-warning');
                      $('#inputGroupNombre').addClass('has-warning');
                      $('#spanWarning').show();
                      $('#textoAlerta').show();
                      $('#botonCrearYAsociar').prop( "disabled", true );

                    }else{
                      $('#nombreInput').removeClass('has-warning');
                      $('#inputGroupNombre').removeClass('has-warning');
                      $('#spanWarning').hide();
                      $('#textoAlerta').hide();
                      $('#botonCrearYAsociar').prop( "disabled", false );
                    }                   
                              
                   
                  }
                </script>
                

                <label class="control-label " for="argumentos">Argumentos *</label>
                
                <div class="input-group"> 
                  <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-pencil"></span></span>
                  <input class="form-control"  id="tokenfield" name="argumentos" placeholder="Argumentos" aria-describedby="basic-addon2"> 
                </div> 
                
                <script type="text/javascript">
                  $('#tokenfield').tokenfield({
                    delimiter:[' ','|',',']
                  });                
                </script>

                <label class="control-label" for="source">Source</label>
              
                <div class="input-group"> 
                  <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-pencil"></span></span>
                  <textarea class="form-control"   id="sourceInput" name="source" placeholder="Código Fuente del Keyword (Opcional)" aria-describedby="basic-addon3" ></textarea>            
                </div> <br>
                
              </div>


              <div class="alert alert-info">
                <strong>Nota:</strong> puede ingresar los argumentos con el formato <i>"${}"</i> o sin el. <b>Separados por espacios</b>
              </div>

		      	</div>
		      	<div class="panel-footer">
		      		<button type="submit" class="btn btn-default btn-lg pull-right" id="botonCrearYAsociar" > 
					    		Crear y Asociar
					    		<span class="glyphicon glyphicon-floppy-saved"></span> 
					    	</button>
					 <div class="clearfix"></div>
		      	</div>	      		
	      	
	      </div>
      </form>



      <footer class="footer">
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
			<center>
				<div class="links">     
					<a href="{{ url('/') }}">Home</a> 		
          <!-- 
			    <a href="{{ url('/upload') }}">Cargar Documentos</a>             
          -->    
			   </div>
				
			</center>

				
			</div>
		</div>
      </footer>

    </div> 

</body>
</html>