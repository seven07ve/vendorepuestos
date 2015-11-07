<?php
include "../conexion.php";
session_start();
if(@$_GET["buscar"]==1)
{
	$id_menu=explode(",",$_SESSION["id_menu"]);
	$menu=$_GET["menu"];
	$id_submenu=explode(",",$_SESSION["id_submenu"]);
	if($id_menu[array_search($menu,$id_menu)]==$menu)
		$submenu=$id_submenu[array_search($menu,$id_menu)];
	else
		$submenu=0;	
	$submenu2=$_GET["submenu2"];		
	echo "<select name='id_submenu' class='form' onchange='cargar_submenu2(this.value,0);'>";
	if($_SESSION["administrador"]==1 || $submenu==0) 
		echo "<option value='0'>No aplica</option>";
	$sql_submenu=mysql_query("SELECT * FROM submenu WHERE id_menu=$menu");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		if($_SESSION["administrador"]==1 || $submenu==0 || in_array($resul_submenu["id"],$id_submenu)){
		echo "<option value='".$resul_submenu["id"]."'";
		if(($submenu==$resul_submenu["id"] && $_GET["submenu"]==0) || $_GET["submenu"]==$resul_submenu["id"]) echo " selected";
		echo ">".$resul_submenu["nombre"]."</option>";	
		}
	}	
	echo "</select>";
	if($_GET["submenu"]==0)
		echo "<script>cargar_submenu2('$submenu','$submenu2');</script>";
	else
		echo "<script>cargar_submenu2('$_GET[submenu]','$submenu2');</script>";
	return;
}
else if(@$_GET["buscar"]==2)
{
	$id_submenu=explode(",",$_SESSION["id_submenu"]);
	$submenu=$_GET["submenu"];
	$id_submenu2=explode(",",$_SESSION["id_submenu2"]);
	if($id_submenu[array_search($submenu,$id_submenu)]==$submenu)
		$submenu2=$id_submenu2[array_search($submenu,$id_submenu)];
	else
		$submenu2=0;		
	echo "<select name='id_submenu2' class='form'>";
	if($_SESSION["administrador"]==1 || $submenu2==0) 
		echo "<option value='0'>No aplica</option>";
	$sql_submenu=mysql_query("SELECT * FROM submenu2 WHERE id_submenu=$submenu");
	while($resul_submenu = mysql_fetch_array($sql_submenu))
	{
		if($_SESSION["administrador"]==1 || $submenu2==0 || in_array($resul_submenu["id"],$id_submenu2)){
		echo "<option value='".$resul_submenu["id"]."'";
		if($submenu2==$resul_submenu["id"] || $_GET["submenu2"]==$resul_submenu["id"]) echo " selected";
		echo ">".$resul_submenu["nombre"]."</option>";	
		}
	}	
	echo "</select>";
	return;
}
if(@$_GET["buscar"]==10)
{
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
	return;
}
if(@$_GET["buscar"]==20)
{
	echo "<select name='id_ciudadp' class='form'>";
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
	return;
}
?>