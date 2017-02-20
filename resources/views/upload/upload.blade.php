<!DOCTYPE html>
<html>
<head>
	<title>Subir docx</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="jumbotron">
		<center><h1>Carga de Archivos</h1></center>
		<form action="/subir" enctype="multipart/form-data" method="post">

			{{csrf_field()}}		
			<input type="file" name="archivoWord" accept=".odt,.rtf,.docx">
			 <button class="btn btn-primary" style="margin-top: 5px"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> Subir</button>
        
			
		</form>
	</div>
</div>


</body>
</html>