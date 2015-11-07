<?
session_start();
require("../conexion.php");
include("../funciones.php");

include "biff.php";
$myxls = new BiffWriter();
$myxls->xlsSetFont('Arial', 10, FONT_NORMAL);//FONT_BOLD
			
$myxls->xlsSetColWidth(0, 0, 10);
$myxls->xlsSetColWidth(1, 1, 15);
$myxls->xlsSetColWidth(2, 2, 15);		
$myxls->xlsSetColWidth(3, 3, 15);
$myxls->xlsSetColWidth(4, 4, 15);
$myxls->xlsSetColWidth(5, 5, 15);
$myxls->xlsSetColWidth(6, 6, 15);
$myxls->xlsSetColWidth(7, 7, 15);
$myxls->xlsSetColWidth(8, 8, 15);
		
$myxls->xlsWriteText(0,0,"Nombre");
$myxls->xlsWriteText(0,1,"Apellido");
$myxls->xlsWriteText(0,2,"Cédula");
$myxls->xlsWriteText(0,3,"Teléfono");
$myxls->xlsWriteText(0,4,"Ciudad");
$myxls->xlsWriteText(0,5,"Correo");
$myxls->xlsWriteText(0,6,"Tipo de Usuario");
$myxls->xlsWriteText(0,7,"Estado");

$j = 1 ;
$pu = mysql_query("SELECT * FROM registro WHERE boletines=1 ORDER BY nombre, apellido");
while($vp = mysql_fetch_array($pu))
{
	$nombre = (string)$vp["nombre"];$myxls->xlsWriteText($j,0,$nombre);	
	$apellido = (string)$vp["apellido"];$myxls->xlsWriteText($j,1,$apellido);
	$cedula = (string)$vp["cedula"];$myxls->xlsWriteText($j,2,$cedula);
	$telefono = (string)$vp["telefono"];$myxls->xlsWriteText($j,3,$telefono);
	$ciudad = (string)$vp["ciudad"];$myxls->xlsWriteText($j,4,$ciudad);
	$correo = (string)$vp["correo"];$myxls->xlsWriteText($j,5,$correo);
	$tipo_usuario = (string)cual_tipo_usuario($vp["id_tipo_usuario"]);$myxls->xlsWriteText($j,6,$tipo_usuario);
	$estado = (string)cual_estado($vp["activo"]);$myxls->xlsWriteText($j,7,$estado);
	$j++;
}
	$myxls->xlsParse(); 
?>