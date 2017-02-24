<!DOCTYPE html>
<html>
<head>
	<title>Cargar documentos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


<link href="{{ URL::asset('css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="{{ URL::asset('js/plugins/purify.min.js') }}" type="text/javascript"></script>

<!-- the main fileinput plugin file -->
<script src="{{ URL::asset('/js/fileinput.min.js') }}"></script>
<!-- bootstrap.js below is needed if you wish to zoom and view file content 
     in a larger detailed modal dialog -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>

<!-- optionally if you need translation for your language then include 
    locale file as mentioned below -->
<script src="{{ URL::asset('js/locales/es.js') }}"></script>

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
		<center><h1>Carga de Escenarios</h1></center>
	</div>


	<div class="col-md-10 col-md-offset-1">

		<div class="panel panel-default">
		  <div class="panel-heading">Subir Archivos</div>
		  <div class="panel-body">
		  	<form id="upload" action="/subir" enctype="multipart/form-data" method="post">

				{{csrf_field()}}		
				
				<input id="input-id" type="file"  name="file[]" accept=".docx" multiple>
		

				<script type="text/javascript">

					$("#input-id").fileinput({
						language: "es"						
					});
				
					var form = document.getElementById('upload');
					var request= new XMLHttpRequest();

					form.addEventListener('submit',function(e){
						$("#successAlert").hide();
						$("#errorAlert").hide();
						e.preventDefault();
						var formdata = new FormData(form);

						request.open('post','/subir');
						request.addEventListener("load",transferComplete);
						request.send(formdata);

					});

					function transferComplete(data){

						$("#errorAlert").html("<strong>Se han presentado los siguientes inconvenientes:</strong> <br>");

						response= JSON.parse(data.currentTarget.response);
					
						if(response.errors.length>0){

							response.errors.forEach( function(value, key){	

								$("#errorAlert").append(value.message);
								$("#errorAlert").append("<br>");
							    
							});		

							$("#errorAlert").show();
							$("#successAlert").hide();

						}else{

							

							$("#errorAlert").hide();
							$("#successAlert").show();

						}
					
						if(response.success){							

						}else{

						}
					}
					
				</script> 

				<div class="row">
					

					<div  class="col-md-8 col-md-offset-2" id="botonesDescarga" hidden>
						asdasd
					</div> 
				</div>
			</form>
		  </div>
		</div>

		<div class="alert alert-danger alert-dismissable" id="errorAlert" hidden>
		  
		</div>

		<div class="alert alert-success alert-dismissable" id="successAlert" hidden>
		  <strong>La carga se realizo sin inconvenientes</strong> <br>
		</div>
		
	</div>

	<div class="row">

		<div class="col-md-4 col-md-offset-4">
			<center>
				<div class="links">     
					<a href="{{ url('/') }}">Home</a> 
			        <a href="{{ url('/modulos') }}">Modulos</a>                   
			    </div>
				
			</center>
			
			
		</div>
	</div>

	

		
</div>


</body>
</html>