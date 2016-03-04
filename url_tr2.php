<?
include("conexion.php");
session_start();
include("funciones.php");
$nombre = $_GET["ntr"];
$ver_tienda = mysql_query("SELECT * FROM tienda_virtual WHERE nombre_oficial='".$nombre."'");
$vt = mysql_fetch_array($ver_tienda);
$id = limpiar_cadena($vt["id"]);
if($id!="")
	{
		$redirect = "/".$_GET["ntr"]."/".$id."/0/0/1";
        echo '<script language="javascript">window.location="'.$redirect.'";</script>';
	}
	else
	{
		$redirect = "/inicio/";
        echo '<script language="javascript">window.location="'.$redirect.'";</script>';
	}
?>
<script language="javascript">window.location="<?=$redirect?>";</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
