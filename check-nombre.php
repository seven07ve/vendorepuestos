<?php
include("conexion.php");
$nombre=$_REQUEST['nombre_oficial'];

$query = sprintf("SELECT * FROM tienda_virtual WHERE nombre_oficial='%s'", mysql_real_escape_string($nombre));
$busq = mysql_query($query);
//si hay lo indica
$mensaje = 0;
if (mysql_num_rows($busq) >= 1){
	$mensaje = 1;
}
echo $mensaje;
?>