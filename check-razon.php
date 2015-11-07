<?php
include("conexion.php");
$nombre=$_REQUEST['nombre_razon'];

$query = sprintf("SELECT * FROM tienda_virtual WHERE razon_social='%s'", mysql_real_escape_string($nombre));
$busq = mysql_query($query);
$mensaje = 0;
//si hay lo indica
if (mysql_num_rows($busq) >= 1){
	$mensaje = 1;
}
echo $mensaje;
?>