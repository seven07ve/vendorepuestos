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
		$name = $carpeta."/". $_FILES['images']['name'][$key];
		move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $carpeta."/". $_FILES['images']['name'][$key]);
		$update = mysql_query("UPDATE tienda_virtual SET foto3='".$_FILES['images']['name'][$key]."' WHERE id='$id'");
		$imagen= $carpeta."/".$imagen_actual;
 		unlink($imagen);
  	}
}
echo $name;
?>