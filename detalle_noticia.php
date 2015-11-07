<? 
include("conexion.php");
session_start();
include("funciones.php");
$id = $_GET['id'];	
$sql = "SELECT * FROM noticias WHERE id=$id";
$res = mysql_query($sql);
$resul= mysql_fetch_array($res);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Vendorepuestos.com.ve ::.</title>
<link href="/cascadas.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("includes/header.php"); ?>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    <div class="titulo_categoria" style="height:30px;">Noticias &raquo; <?=$resul["titulo"]?></div><br /></td>
  </tr>
  <tr>
    <td valign="top">
      <table width="960" border="0" align="center" cellpadding="0" cellspacing="6" style="border-radius: 10px;border: 1px solid #D3D3D3;">
        <tr>
          <td height="150"><p><b><?=$resul["sumario"]?></b></p><img src="/imagenes_noticias/<?=$resul["foto"]?>" width="255" hspace="5" vspace="5" align="left" /><p><?=$resul["texto"]?></p></td></tr></table>
</td>
  </tr>
</table>
<?php include("includes/footer.php"); ?>
</body>
</html>
