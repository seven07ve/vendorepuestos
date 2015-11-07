<?php
include("conexion.php");
$rif=$_REQUEST['num_rif'];

if(!preg_match("/^[JVEG]{1}/", substr($rif, 0, 1))){
	$mensaje = "1";
	/*echo '<span style="color:#FD6868; font-weight:bold" onmousemove="document.form1.rif.value = \'\'; document.form1.rif.style.background = \'#FFE0E0\'; document.form1.rif.style.color = \'#000\';">Debe ser una de las siguientes opciones: J, V, E, G<br></span>';*/
}

elseif(strlen($rif) >= 2 && !(strlen($rif) >= 4 && strpos($rif, "-", 3))){
	$mensaje = "2";
	/*$mensaje = '<span style="color:#FD6868; font-weight:bold">Los siguientes solo deben ser números, con un guión (-) que precede al último número.</span>';*/
	
}
if (strlen($rif) >= 4 && strpos($rif, "-", 3)){
	$mensaje =  "3";
}

$query = "SELECT * FROM tienda_virtual WHERE rif='".$rif."'";
$busq = mysql_query($query);
//si hay lo indica
if (mysql_num_rows($busq) >= 1){
	$mensaje = "4";
	/*echo '<span name="alertrif" style="color:#F00; font-weight:bold; margin-left: 5px;" onmousemove="document.form1.rif.value = \'\';"><br>El rif ya Existe<hr style="opacity:0;" /></span>';  */
}
echo $mensaje;
return;
?>