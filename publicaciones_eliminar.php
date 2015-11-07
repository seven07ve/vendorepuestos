<? 
include("conexion.php");
session_start();
include("funciones.php");

if(!isset($_SESSION["userid"]))
{?>
<script language="javascript">alert("Debe Iniciar Sesion"); window.location="/iniciar_sesion/";</script>
<? }

$carpeta = cual_nombre_carpeta($_SESSION["userid"]);
$idp = $_GET["idp"];

//eliminar fotos
$ver_fot = mysql_query("SELECT foto1, foto2, foto3 FROM productos WHERE id='$idp'");
$vf = mysql_fetch_array($ver_fot);
@unlink($carpeta."/productos/".$vf["foto1"]);
@unlink($carpeta."/productos/".$vf["foto2"]);
@unlink($carpeta."/productos/".$vf["foto3"]);

$sql_tienda = mysql_query("DELETE FROM productos WHERE id='$idp'");	?>
<script language="javascript">alert("Articulo Eliminado Exitosamente!"); window.location="/articulos_activos/<?=limpiar_cadena($carpeta);?>/1";</script>
