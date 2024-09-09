<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body style="padding: 5px">
	<p style="text-align: center;color: #069D8F;">
		<b>REPORTE FOTOGRÁFICO</b>
	</p>






	
		@foreach($fotos as $foto)
 	<img src="https://alfacdn.s3.amazonaws.com/images/{{$foto->ruta}}" style="max-width: 200px;height: 200px;max-height: 200px;width: 200px;">
		@endforeach
	



</body>
</html>