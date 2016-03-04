<?
include("conexion.php");
session_start();
include("funciones.php");
if(isset($_GET["tr"]))
{
	$id = cual_id_tr($_GET["tr"]);
	if($id!="")
	{
		$redirect = "/".$_GET["tr"]."/".$id."/0/0/1";?>
        <script language="javascript">window.location="<?=$redirect?>";</script>
	<? }
	else
	{
		$redirect = "/inicio/";
		?>
        <script language="javascript">alert("La TR indicada No Existe"); window.location="<?=$redirect?>";</script>
	<?
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Document</title>
</head>

<body>
</body>
</html>
