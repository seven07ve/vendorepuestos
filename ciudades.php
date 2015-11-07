<?php
include("conexion.php");

	echo "<select name='id_ciudad' class='form'>";
	if($_GET["ciu"]==0) 
		echo "<option value='0'>Seleccione</option>";
	$sql_submenu=mysql_query("SELECT * FROM ciudad WHERE id_estado='".$_GET["edo"]."'");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		echo "<option value='".$resul_submenu["id"]."'";
		if($_GET["ciu"]==$resul_submenu["id"]) echo " selected";
		echo ">".utf8_encode($resul_submenu["nombre"])."</option>";	
	}	
	echo "</select>";
?>