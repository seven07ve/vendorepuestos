<?
session_start();
include "../conexion.php";
$action="";
if(isset($_POST["action"])) $action=$_POST["action"];
if($action==1)
{     
      $login=$_POST["login"];
	  $password=$_POST["pass"];
	  $sentencia=mysql_query("select * from admin where usuario='$login'");
	  $resul=mysql_fetch_array($sentencia);  
	  $ban=0;
	  if($resul["usuario"]==$login && $resul["contrasena"]==$password) //si encuentra al usuario en la base de datos inicia la sesión
	  {       $ban=1;
	  		  $_SESSION['id_usuario']=$resul["id"];	
			  $_SESSION['admin']=$login;
			  $_SESSION['nombre_admin']=$resul["nombre"];
			  
			  echo"<meta http-equiv='refresh' content='0;URL=index.php'>";
	  }
	   if($ban==0)
 	   		echo "<meta http-equiv='refresh' content='0;URL=index.php?nouser=1'>"; 	  
}
$nouser=""; 
if(isset($_GET["nouser"])) $nouser=$_GET["nouser"];
if($nouser==1)//si no existe el usuario
{  echo "<script>
		alert('El usuario no existe o la contraseña es incorrecta');	
	</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script language="javascript">
function validar(forma)
{
	if(forma.login.value=="")
	{   alert("Debe ingresar el usuario");
	    forma.login.focus();
		return false;
	}
	if(forma.pass.value=="")
	{  alert("Debe ingresar la clave");
	   forma.pass.focus();
	   return false;			
	}
	
   return true;
}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Inicio</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="98%" align="center" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <!-- Contenido -->
        <table border="0" align="left" cellpadding="0" cellspacing="12">
          <tr>
            <td width="280" align="center" valign="top" bgcolor="#FFFFFF"><a href="javascript:;"><img src="imagenes/logo_vendorepuestos.jpg" width="350" height="49" border="0" /></a></td>
            <td width="1" rowspan="2" bgcolor="#FF0000"></td>
            <td width="344" rowspan="2" valign="top" class="texto"><? if(!isset($_SESSION["admin"]))
		{
		?>
                <form id="form1" name="form1" method="post" action="index.php" onsubmit="return validar(this);">
                  <table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td class="textobold">Usuario: </td>
                      <td><input name="login" type="text" class="form" size="30" /></td>
                    </tr>
                    <tr>
                      <td class="textobold">Clave: </td>
                      <td><input name="pass" type="password" class="form" size="30" /></td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td align="right"><input type="hidden" name="action" value="1" />
                          <input type="submit" name="button" id="button" class="form2" value="Enviar" /></td>
                    </tr>
                  </table>
                </form>
              <? }
		  else
		{
			echo "Seleccione una opción del menú";
		}?>
            </td>
          </tr>
          <tr>
            <td valign="top" class="texto12">Bienvenido al Administrador de Contenido de VendoRepuestos</td>
          </tr>
        </table>
        <!-- Termina Contenido --></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td height="1" bgcolor="#666666"></td>
  </tr>
  <tr>
    <td bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php mysql_close($db);?>
