<?php
function moneda($numero)
{
	return "$ ".number_format($numero, 0, ',','.');
}

function mes($numero)
{
	$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
	echo $meses[$numero - 1];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Recibo</title>
	 <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="css/bootstrap.3.3.7.css">

    <!-- Font Awesome >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	-->
	<style>
		
		table
		{
			 border-collapse: collapse;
			 table-layout: fixed;
			 font-size:11px;
		}
		.encabezadoTabla
		{
			background: #c4c4c4;
			border: 1px solid #ccc;
			text-align: center;
			font-weight: bold;
			font-size:12px;
		}	
		td{
			border-collapse: collapse;
			border: 1px solid #ccc;
			width: 12%;
			text-align: center;
			padding: 4px;
		}
		.producto
		{
			text-align: left;
		}
		.blanco 
		{
			border: none;
		}
		.content
		{
			padding-left: 50px;
			padding-right: 50px	
		}
		.titulo
		{
			text-align: center;
			padding-top:25px;
			padding-bottom:15px;
		}
		.debeA
		{
			text-align: center;
			padding-top:25px;
			padding-bottom:15px;
		}
		.total
		{
			text-align: right;
			padding-top:25px;
			padding-bottom:15px;
		}
		.logo
		{
			width: 350px;
			padding-top: 20px;
		}
		.firma
		{
			border: none;
			border-top: 1px solid #ccc;
			text-align: left;
		}
	</style>
</head>
<body>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<img width="350px" src="img/logos/logoHorizontal.png" />
			</div>
		</div>
		<div class="row">
			<h3 class="titulo">
					Cuenta de Cobro N°: {{$order['id']}}
			</h3>
		</div>
		<div class="content">
			<div class="row">
				<table width="100%">
					<tr>
						<td class="encabezadoTabla" colspan="3">Fecha</td>
						<td class="encabezadoTabla" colspan="5">Nombre</td>
						<td class="encabezadoTabla" colspan="2">Tipo Doc</td>
						<td class="encabezadoTabla" colspan="2">Número Doc</td>
					</tr>
					<tr>
						<td class="contenidoTabla">{{$order->created_at->format('d')}}</td>
						<td class="contenidoTabla">{{mes($order->created_at->format('m'))}}</td>
						<td class="contenidoTabla">{{$order->created_at->format('Y')}}</td>
						<td class="contenidoTabla" colspan="5">{{$order->customer->name}}</td>
						<td class="contenidoTabla" colspan="2">{{$order->customer->documentType->name}}</td>
						<td class="contenidoTabla" colspan="2">{{$order->customer->document_number}}</td>
					</tr><tr>
						<td class="encabezadoTabla" colspan="2">Ciudad</td>
						<td class="encabezadoTabla" colspan="8">Dirección</td>
						<td class="encabezadoTabla" colspan="2">Teléfono</td>
					</tr>
					<tr>
						<td class="contenidoTabla" colspan="2">Bogotá D.C.</td>
						<td class="contenidoTabla" colspan="8">{{$order->customer->address}}</td>
						<td class="contenidoTabla" colspan="2">{{$order->customer->phone}}</td>
					</tr>
					<tr class="blanco">
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						
					</tr>
				</table>
			</div>
			<div class="row">
				<p class="debeA">
					Debe a 
				</p>
			</div>
			<div class="row">
				<table width="100%">
					<tr>
						<td class="encabezadoTabla" colspan="4">Nombre</td>
						<td class="encabezadoTabla" colspan="2">CC/NIT</td>
					</tr>
					<tr>
						<td class="contenidoTabla" colspan="4">Paola Navarrete</td>
						<td class="contenidoTabla" colspan="2">52.969.206</td>
					</tr><tr>
						<td class="encabezadoTabla">Ciudad</td>
						<td class="encabezadoTabla" colspan="3">Dirección</td>
						<td class="encabezadoTabla" colspan="2">Teléfono</td>
					</tr>
					<tr>
						<td class="contenidoTabla">Bogotá D.C.</td>
						<td class="contenidoTabla" colspan="3">AK 45 #128D - 40</td>
						<td class="contenidoTabla" colspan="2">310 771 05 35</td>
					</tr>
					<tr>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						
					</tr>
				</table>
			</div>
			<br>
			<br>
			<div class="row">
				<table width="100%">
					<tr>
						<td class="encabezadoTabla" colspan="1">N°</td>
						<td class="encabezadoTabla" colspan="7">Producto</td>
						<td class="encabezadoTabla" colspan="1">Cantidad</td>
						<td class="encabezadoTabla" colspan="1">Valor unit.</td>
						<td class="encabezadoTabla" colspan="1">Subtotal</td>
					</tr>
					@foreach($order['orderItems'] as $item)
						<tr>
							<td class="contenidoTabla">{{$loop->iteration}}</td>
							<td class="contenidoTabla producto" colspan="7">{{$item['presentation']['formal_name']}} ({{$item['presentation']['measurement']}})</td>
							<td class="contenidoTabla" colspan="1">{{$item['quantity']}}</td>
							<?php
								$item['single_price'] = $item['presentation']['wholesale_price'];
								$item['total_price'] = $item['quantity'] * $item['presentation']['wholesale_price'];
							?>
							<td class="contenidoTabla" colspan="1">{{moneda($item['single_price'])}}</td>
							<td class="contenidoTabla" colspan="1">{{moneda($item['total_price'])}}</td>
						</tr>
					@endforeach
					
					<tr>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						<td class="blanco"></td>
						
					</tr>
				</table>
			</div>
			<div class="row">
				<p class="total">
					<?php
						$total = 0;
						foreach ($order['orderItems'] as $item) 
						{
							$total += $item['total_price'];
						}
					?>
					
					Total: {{moneda($total)}} (m/cte)
				</p>
			</div>
			<div class="row">
				<table width="100%">
					<tr>
						<td class="blanco" style="text-align:left;">
							Aceptado por:
						</td>
						<td class="blanco"></td>
						<td class="blanco" style="text-align:left;">
							Entregado por:
						</td>
					</tr>
				</table>
			</div>
			<br>
			<br>
			<div class="row">
				<table width="100%">	
					<tr>
						<td class="firma">
							Nombre:<br>
							CC:<br>
							Fecha:
						</td>
						<td class="blanco"></td>
						<td class="firma">
							Nombre:<br>
							CC:<br>
							Fecha:
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
</body>
</html>