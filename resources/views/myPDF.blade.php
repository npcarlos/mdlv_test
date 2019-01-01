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
			padding-left, : 50px;
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
					Cuenta de Cobro N°: 123465
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
						<td class="contenidoTabla">03</td>
						<td class="contenidoTabla">Ene</td>
						<td class="contenidoTabla">2019</td>
						<td class="contenidoTabla" colspan="5">Nombre del cliente</td>
						<td class="contenidoTabla" colspan="2">NIT</td>
						<td class="contenidoTabla" colspan="2">123456798132</td>
					</tr><tr>
						<td class="encabezadoTabla" colspan="2">Ciudad</td>
						<td class="encabezadoTabla" colspan="8">Dirección</td>
						<td class="encabezadoTabla" colspan="2">Teléfono</td>
					</tr>
					<tr>
						<td class="contenidoTabla" colspan="2">Bogotá</td>
						<td class="contenidoTabla" colspan="8">Calle 1 # 1 - 1</td>
						<td class="contenidoTabla" colspan="2">765431</td>
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
						<td class="contenidoTabla" colspan="4">Representante legal</td>
						<td class="contenidoTabla" colspan="2">Identificación</td>
					</tr><tr>
						<td class="encabezadoTabla">Ciudad</td>
						<td class="encabezadoTabla" colspan="3">Dirección</td>
						<td class="encabezadoTabla" colspan="2">Teléfono</td>
					</tr>
					<tr>
						<td class="contenidoTabla">Bogotá</td>
						<td class="contenidoTabla" colspan="3">Calle 1 # 1 - 1</td>
						<td class="contenidoTabla" colspan="2">765431</td>
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
					<tr>
						<td class="contenidoTabla">1</td>
						<td class="contenidoTabla producto" colspan="7">Producto 1 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">2</td>
						<td class="contenidoTabla producto" colspan="7">Producto 2 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">3</td>
						<td class="contenidoTabla producto" colspan="7">Producto 3 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">1</td>
						<td class="contenidoTabla producto" colspan="7">Producto 1 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">2</td>
						<td class="contenidoTabla producto" colspan="7">Producto 2 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">3</td>
						<td class="contenidoTabla producto" colspan="7">Producto 3 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">1</td>
						<td class="contenidoTabla producto" colspan="7">Producto 1 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">2</td>
						<td class="contenidoTabla producto" colspan="7">Producto 2 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
					<tr>
						<td class="contenidoTabla">3</td>
						<td class="contenidoTabla producto" colspan="7">Producto 3 (XX ml)</td>
						<td class="contenidoTabla" colspan="1">100</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
						<td class="contenidoTabla" colspan="1">$1.000.000</td>
					</tr>
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
					Total: $10.0000.000 (m/cte)
					</p>
				</div>
		</div>
	</div>
</body>
</html>