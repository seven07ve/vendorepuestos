<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
include "../funciones.php";
if(isset($_GET['estado'])){
	$id = $_GET["id"];
	if($_GET["estado"]==1) 
	{
		$estado=0;
		$mensaje="Desactivar";
	}
	else 
	{
		$estado=1;
		$mensaje="Activar";
	}
	$usuario=mysql_fetch_array(mysql_query("SELECT * FROM registro WHERE id=$id"));
	$nombre=$usuario["nombre"]." ".$usuario["apellido"];
	$update = mysql_query("UPDATE registro SET activo=$estado WHERE id=$id");
	$insert_log=mysql_query("INSERT INTO log (id_admin,id_modulo,id_accion,fecha,ip,id_registro,descripcion) VALUES (".$_SESSION['id_usuario'].",25,2,NOW(),'".$_SERVER['REMOTE_ADDR']."',$id,'$mensaje usuario - $nombre')");	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
	function cambiar_status(_id, _status){
		if(confirm('Esta seguro que desea actualizar el estado del usuario?')){
			window.location.href='admin_usuarios_registrados.php?estado='+_status+'&id=' + _id;		
		}
	}
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Usuarios Registrados</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
            <p>
              <!-- Contenido -->
              
              <!-- SUBMENU -->
              <!-- FINAL SUBMENU -->
            </p>
            <form action="admin_usuarios_registrados.php" method="post" name="form1">
            <table width="1039" border="0" cellpadding="0" cellspacing="0" class="tabla_resultados">
              <tr>
                <td nowrap="nowrap" class="tabla_titulo"> Buscar<a href="export.php"></a></td>
                <td nowrap="nowrap" class="tabla_titulo" align="right"><a href="export.php">Exportar listado de usuarios</a></td>
              </tr>
              
              <tr>
                <td width="193" class="desc"> Tipo de Usuario:&nbsp;</td>
                <td width="844" class="campo"><select class="form" name="tipo_usuario">
                    <option value="0">Todos</option>
                    <?php 
						$sql_admin=mysql_query("SELECT * FROM tipo_usuario ORDER BY descripcion");
						while($admin=mysql_fetch_array($sql_admin))
						{
						?>
                    <option value="<?=$admin["id"]?>">
                      <?=$admin["descripcion"]?>
                    </option>
                    <?php 
						}
						?>
                  </select>                </td>
              </tr>
              <tr>
                <td colspan="2" class="tabla_botones"><input type="hidden" name="buscar" value="1"/>
                    <img src="imagenes/cancelar.png" style="cursor:pointer;" onclick="document.form1.reset();"/>
                    <input type="image" src="imagenes/buscar.png" name="buscar" value="Enviar" /></td>
              </tr>
            </table>
            </form>
            <br />
            <table border="0" width="1039" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Usuarios Registrados</td>
</tr>
<tr>
<td>
<?php 
if($_POST["buscar"]==1)
{
	$sql = "SELECT * FROM registro";
	if(isset($_POST["tipo_usuario"]) && $_POST["tipo_usuario"]!=0) $sql.=" WHERE id_tipo_usuario=".$_POST["tipo_usuario"]."";
	$sql.=" ORDER BY nombre, apellido";
	$_SESSION["_pagi_sql3"]=$sql;
}
else if($_SESSION["_pagi_sql3"]=="") 
{
	$_SESSION["_pagi_sql3"]="SELECT * FROM registro ORDER BY nombre, apellido";
}
$_pagi_sql=$_SESSION["_pagi_sql3"];
$_pagi_cuantos=10;
include("../paginar_admini.inc.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <th nowrap="nowrap" width="190">Nombre</th>
    <th width="71" nowrap="nowrap">Correo</th>
    <th width="71" nowrap="nowrap">Tipo de Usuario</th>
    <th width="20" nowrap="nowrap">C&eacute;dula</th>
    <th width="20" nowrap="nowrap">Tel&eacute;fono</th>
    <th width="20" nowrap="nowrap">Ciudad</th>
    <th width="20" nowrap="nowrap">Estado</th>
  </tr>
  <?php while($resul = mysql_fetch_array($_pagi_result)){?>
   <tr>
    <td nowrap="nowrap"><?=$resul["nombre"]." ".$resul["apellido"]?></td>
    <td nowrap="nowrap"><?=$resul["correo"]?></td>
    <td nowrap="nowrap" align="center"><?=cual_tipo_usuario($resul["id_tipo_usuario"])?></td>
    <td nowrap="nowrap"><?=$resul["cedula"]?></td>
    <td nowrap="nowrap"><?=$resul["telefono"]?></td>
    <td nowrap="nowrap"><?=$resul["ciudad"]?></td>
    <td nowrap="nowrap" align="center"><a href="javascript:cambiar_status(<?=$resul["id"]?>,<?=$resul["activo"]?>)"><?php if($resul["activo"]==1) echo "Desactivar"; else echo "Activar";?></a></td>
  </tr> 
  <?php }?>
</table></td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="6"></td>
                </tr>
                <tr>
                  <td class="texto"><? echo $_pagi_navegacion;?></td>
                </tr>
                <tr>
                  <td height="6"></td>
                </tr>
              </table>
          <!-- Termina Contenido -->        </td>
      </tr>
    </table>    </td>
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