<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte {{ $proyecto->codigo }}</title>
</head>
<body style="padding: 5px;">
	
	<p style="text-align: center;color: #069D8F;">
		<b>REPORTE FOTOGRÁFICO</b>
	</p>

	<table style="width: 100%;border: solid 1px #069D8F;border-radius: 5px;" cellpadding="3">
		<tr>
			<td style="width: 20%;border-right: 1px solid #069D8F;">
				<b>PROYECTO</b>
			</td>
			<td style="width: 80%;text-align: center;">
				{{ $proyecto->proyecto }}
			</td>
		</tr>
	</table>

<br>
	<table style="width: 100%;">
		<tr>
			<td style="width: 50%;padding-right: 5px;">
				
				<table style="width: 100%;border: solid 1px #069D8F;border-radius: 5px;" cellpadding="3">
					<tr>
						<td style="width: 20%;border-right: 1px solid #069D8F;">
							<b>ESTACION</b>
						</td>
						<td style="width: 30%;text-align: center;">
							{{ $estacion->estacion }}
						</td>
					</tr>
					<tr>
						<td style="width: 20%;border-right: 1px solid #069D8F;">
							<b>PROVINCIA</b>
						</td>
						<td style="width: 30%;text-align: center;">
							{{ $lugar->Provincia }}
						</td>
					</tr>

					<tr>
						<td style="width: 20%;border-right: 1px solid #069D8F;">
							<b>TIPO TRABAJO</b>
						</td>
						<td style="width: 30%;text-align: center;">
							{{ $proyecto->tipo }}
						</td>
					</tr>

				</table>

			</td>
			<td style="width: 50%;padding-left: 5px;">
				
				<table style="width: 100%;border: solid 1px #069D8F;border-radius: 5px;" cellpadding="3">
					<tr>
						<td style="width: 20%;border-right: 1px solid #069D8F;">
							<b>DISTRITO</b>
						</td>
						<td style="width: 30%;text-align: center;">
							{{ $lugar->Distrito }}
						</td>
					</tr>
					<tr>
						<td style="width: 20%;border-right: 1px solid #069D8F;">
							<b>SUCURSAL</b>
						</td>
						<td style="width: 30%;text-align: center;">
							{{ $lugar->Departamento }}
						</td>
					</tr>
					<tr>
						<td style="width: 20%;border-right: 1px solid #069D8F;">
							<b>FECHA</b>
						</td>
						<td style="width: 30%;text-align: center;">
							<?php 
							$fp=date_create($proyecto->fecha);
							$dtmes=date_format($fp,'m');
							$dtanio=date_format($fp,'Y');
							$txtmes='';
							if ($dtmes==1) { $txtmes='ENERO'; }
							if ($dtmes==2) { $txtmes='FEBRERO'; }
							if ($dtmes==3) { $txtmes='MARZO'; }
							if ($dtmes==4) { $txtmes='ABRIL'; }
							if ($dtmes==5) { $txtmes='MAYO'; }
							if ($dtmes==6) { $txtmes='JUNIO'; }
							if ($dtmes==7) { $txtmes='JULIO'; }
							if ($dtmes==8) { $txtmes='AGOSTO'; }
							if ($dtmes==9) { $txtmes='SETIEMBRE'; }
							if ($dtmes==10) { $txtmes='OCTUBRE'; }
							if ($dtmes==11) { $txtmes='NOVIEMBRE'; }
							if ($dtmes==12) { $txtmes='DICIEMBRE'; }
							?>
							{{ $txtmes }} {{ $dtanio }}
						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>


		<br>

<table style="width: 100%;border: solid 1px #069D8F;border-radius: 5px;" cellpadding="3">
	
		<?php $x=1; ?>
		@foreach($fotos as $foto)

		
			@if($x % 2!=0)
			<tr>
			<td style="width: 50%;border-bottom: solid 1px #069D8F;">
			<table style="width: 100%;">
				<tr>
					<td style="width: 100%;align-items: unset;text-align: center;">
						<img src="https://d1em21hfk2hbmw.cloudfront.net/images/{{$foto->ruta}}" style="width: 200px;">
					</td>
			    </tr>
				<tr>
					<td style="width: 100%;text-align: center;">
						{{ $foto->titulofoto }}
					</td>
				</tr>
			</table>
			</td>
			@endif
		
			@if($x % 2==0)
			<td style="width: 50%;border-bottom: solid 1px #069D8F;">
			<table style="width: 100%;">
				<tr>
					<td style="width: 100%;align-items: unset;text-align: center;">
						<img src="https://d1em21hfk2hbmw.cloudfront.net/images/{{$foto->ruta}}" style="width: 200px;">
					</td>
			    </tr>
				<tr>
					<td style="width: 100%;text-align: center;">
						{{ $foto->titulofoto }}
					</td>
				</tr>
			</table>
			</td>
			</tr>
			@endif
		
		<?php $x++; ?>
		@endforeach
	
</table>


</body>
</html>
