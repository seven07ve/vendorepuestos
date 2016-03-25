<?php
function preguntas(){
	$id = $_SESSION["userid"];
	$busqueda = mysql_query("SELECT * FROM productos, preguntas WHERE  productos.id_usuario_tienda='".$id."' AND preguntas.id_producto=productos.id");
	$total = mysql_num_rows($busqueda);
	//$result=mysql_fetch_array(mysql_query("SELECT * FROM menu WHERE id=$id"));
	return $total;
?>