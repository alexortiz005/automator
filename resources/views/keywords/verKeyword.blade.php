<!DOCTYPE html>
<html>
<head>
	<title>Ver keyword</title>
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

    <h1 class="display-3"> KEYWORD </h1>       
    <h2>{{$keyword->nombre}}</h2>
  </center>

</div>



<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse"  href="#parametros"><strong>Parametros</strong></a>
      </h4>
    </div>
    <div id="parametros" class="panel-collapse collapse ">
      <form method="post" action="/editarKeyword" id="formEditarKeyword">
        <div class="panel-body">
          {{csrf_field()}}  

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

                <input type="hidden" name="id" value="{{$keyword->id}}">
                <label class="control-label " for="estado">Id en BD</label>

                <div class="input-group"> 
                  <span class="input-group-addon" id="basic-addon1">#</span>
                  <input class="form-control" name="id" placeholder="Id" aria-describedby="basic-addon1" value="{{$keyword->id}}" disabled>
                </div> <br> 
                <label class="control-label" for="nombre">Nombre *</label>

                <div class="input-group" id="inputGroupNombre"> 
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-pencil"></span></span>
                  <input class="form-control" id="nombreInput" oninput="nombreInputFunction();" name="nombre" placeholder="Nombre del keyword" aria-describedby="basic-addon1" value="{{$keyword->nombre}}" required> 
                  <span class="glyphicon glyphicon-warning-sign form-control-feedback" id="spanWarning" style="display: none"></span>
                </div>

                <p class="text-danger" id="textoAlerta" style="display: none"><b>El nombre de keyword ya existe</b> </p>
                 <br>

                <label class="control-label " for="argumentos">Argumentos *</label>

                <div class="input-group"> 
                  <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-pencil"></span></span>
                  <input class="form-control"  id="tokenfield" name="argumentos" placeholder="Argumentos" aria-describedby="basic-addon2" required>
                </div>
                <p class="text-info"><strong><small>Debe ingresar al menos un argumento</small> </strong> </p>
                

                <script type="text/javascript">

                  var request= new XMLHttpRequest();
                  var form = document.getElementById('formEditarKeyword');


                  $('#tokenfield').tokenfield({
                    delimiter:[' ','|',',']
                  }); 

                  $('#tokenfield').tokenfield('setTokens', [
                   @foreach($argumentosKeyword as $index=>$argumento)
                   '{{$argumento->nombre}}',                                    
                   @endforeach
                   ]); 

                  function nombreInputFunction(){

                    valor= $('#nombreInput').val();
                    var formdata = new FormData(form);            

                    request.open('post','/validarNombreKeyword');
                    request.addEventListener("load",transferComplete);
                    request.send(formdata);                    

                  }

                  function transferComplete(data){      

                    console.log(data.currentTarget.response);             

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

                 <label class="control-label" for="source">Source</label>

                 <div class="input-group"> 
                  <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-pencil"></span></span>
                  <textarea class="form-control"   id="sourceInput" name="source" placeholder="Código Fuente del Keyword (Opcional)" aria-describedby="basic-addon3" >{{$keyword->source}}</textarea>            
                </div> <br>
                <div class="alert alert-info">
                  <strong>Nota:</strong> puede ingresar los argumentos con el formato <i>"${}"</i> o sin el. <b>Separados por espacios</b>
                </div>

                <button type="submit" class="btn btn-success pull-right" > 
                  Guardar
                  <span class="glyphicon glyphicon-floppy-disk"></span> 
                </button>
                <div class="clearfix"></div>

              </div>
            </div>
          </div>     
        </div>
        </div>
      </form>
    </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse"  href="#tests"><strong> Tests</strong> </a>
      </h4>
    </div>
    <div id="tests" class="panel-collapse collapse">


      <div class="panel-body">
        <form method="post" action="/editarTests">
          <input type="hidden" name="idKeyword" value="{{$keyword->id}}">
          {{csrf_field()}}  
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Exitoso</span>
              <input id="exitoso" type="text" class="form-control" name="exitoso" placeholder="Argumentos necesarios para generar un test exitoso" value="">
            </div><br>

            <script type="text/javascript">
              $('#exitoso').tokenfield({
                      delimiter:' ',
                      limit: {{sizeof($argumentosKeyword )}}
                    }); 

              @if(!is_null($tests['testExitoso']))
                $('#exitoso').tokenfield('setTokens', [
                     @foreach($tests['testExitoso']->argumentos as $index=>$argumento)
                     '{{$argumento->nombre}}',                                    
                     @endforeach
                     ]); 

              @endif

              
              
            </script>


            <div class="input-group">
              <span class="input-group-addon">Errado</span>
              <input id="errado" type="text" class="form-control" name="errado" placeholder="Argumentos necesarios para generar un test errado" value="">
            </div> <br>

            <script type="text/javascript">
              $('#errado').tokenfield({
                      delimiter:' ',
                      limit: {{sizeof($argumentosKeyword )}}
                    }); 

              @if(!is_null($tests['testErrado']))
                $('#errado').tokenfield('setTokens', [
                     @foreach($tests['testErrado']->argumentos as $index=>$argumento)
                     '{{$argumento->nombre}}',                                    
                     @endforeach
                     ]); 

              @endif
              
            </script>


            <div class="input-group">
              <span class="input-group-addon">Inexistente</span>
              <input id="inexistente" type="text" class="form-control" name="inexistente" placeholder="Argumentos necesarios para generar un test inexistente" value="">
            </div>  


             <script type="text/javascript">
              $('#inexistente').tokenfield({
                      delimiter:' ',
                      limit: {{sizeof($argumentosKeyword )}}
                    }); 



              @if(!is_null($tests['testInexistente']))
                $('#inexistente').tokenfield('setTokens', [
                     @foreach($tests['testInexistente']->argumentos as $index=>$argumento)
                     '{{$argumento->nombre}}',                                    
                     @endforeach
                     ]); 

              @endif 
              
            </script>                      
          </div>




          <div class="col-md-12">
           <br>
            <button type="submit" class="btn btn-success pull-right" > 
              Guardar
              <span class="glyphicon glyphicon-floppy-disk"></span> 
            </button>
          </div>
          
        </div>          
        </form>
      </div>
      
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse"  href="#collapse3"><strong>Opciones</strong> </a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">



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