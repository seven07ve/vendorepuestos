<?php
include("conexion.php");
session_start();
include("funciones.php");
if(!isset($_SESSION["userid"]))
{
	echo '<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>';
}
$sql = "SELECT * FROM tienda_virtual WHERE id='".$_SESSION["userid"]."'";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);
$carpeta = limpiar_cadena($resul["razon_social"]);
$id = $resul["id"];
$imagen_actual = $resul["foto3"];

foreach ($_FILES["images"]["error"] as $key => $error){
	if ($error == UPLOAD_ERR_OK){
		$resultado = mysql_query("SELECT * FROM tienda_virtual WHERE id='".$_SESSION["userid"]."' AND (logo='".$_FILES['images']['name'][$key]."' OR foto1='".$_FILES['images']['name'][$key]."' OR foto2='".$_FILES['images']['name'][$key]."' OR foto3='".$_FILES['images']['name'][$key]."')");
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas == 1){
			$dir = $carpeta."/1-". $_FILES['images']['name'][$key];
			$name = "1-".$_FILES['images']['name'][$key];
		}
		else{
			$dir = $carpeta."/". $_FILES['images']['name'][$key];
			$name = $_FILES['images']['name'][$key];
		}
		move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $dir);
		$update = mysql_query("UPDATE tienda_virtual SET foto3='".$name."' WHERE id='$id'");
		$imagen= $carpeta."/".$imagen_actual;
 		unlink($imagen);
  	}
}
echo $dir;
?>