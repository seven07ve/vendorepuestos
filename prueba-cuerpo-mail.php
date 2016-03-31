<!DOCTYPE html>
<html lang="">
<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title></title>
				<link rel="stylesheet" href="">
</head>

<body>
<?php
	include("conexion.php");
	include("php/funciones_mail.php");
	
	$ver_tienda = mysql_query("SELECT * FROM productos, tienda_virtual WHERE productos.id='8609' AND productos.id_usuario_tienda=tienda_virtual.id");
	$vt = mysql_fetch_array($ver_tienda);
	$email = $vt["email"];
	$nombre = $vt["nombre_oficial"];
	$texto = 'Te han hecho una pregunta <a href="http://vendorepuestos.dev/iniciar_sesion/">Ver pregunta</a>';
	
	echo layoutMail($email, $texto);
?>
	
</body>
</html>
