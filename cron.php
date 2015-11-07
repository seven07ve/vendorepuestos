<?php
$para = 'jheancg@gmail.com';

$asunto = 'Correo de prueba de cron Decogres';
$cuerpo='Cron prueba';
//para el envío en formato HTML
$headers  = "MIME-Version: 1.0\r\n";
//						   "text/html; charset=utf-8"
$headers .= "Content-type: text/html; charset=utf-8\r\n";
//dirección del remitente
$headers .= "From: Vendorepuestos atencion@vendorepuestos.com.ve\r\n";
mail($para,$asunto,$cuerpo,$headers);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Ejemplo de HTML5" />
	<meta name="keywords" content="HTML5, CSS3, Javascript" />
	<title>Página</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
</body>
</html>