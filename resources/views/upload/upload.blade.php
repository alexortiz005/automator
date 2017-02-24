<!DOCTYPE html>
<html>
<head>
	<title>Subir docx</title>
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
		<center><h1>Carga de Escenarios</h1></center>
	</div>


	<div class="col-md-6 col-md-offset-3">

		<div class="panel panel-default">
		  <div class="panel-heading">Subir Archivos</div>
		  <div class="panel-body">
		  	<form id="upload" action="/subir" enctype="multipart/form-data" method="post">

				{{csrf_field()}}		
				
				<input type="file"  name="file[]" accept=".docx" multiple>
				<input type="submit">

				<script type="text/javascript">
				
					var form = document.getElementById('upload');
					var request= new XMLHttpRequest();

					form.addEventListener('submit',function(e){
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
			<div class="links">     
				<a href="{{ url('/') }}">Home</a> 
		        <a href="{{ url('/modulos') }}">Modulos</a>                   
		    </div>
			
		</div>
	</div>

	

		
</div>


</body>
</html>