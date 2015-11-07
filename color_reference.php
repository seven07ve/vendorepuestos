<html>
<head>
	<title></title>
</head>

<center>

<?
$target = $_GET[target] ;
switch ($target) 
{
case "titulo":
   $texto =  "color_titulo";
   break;
case "fondo":
   $texto =  "color_fondo";
   break;
case "contenido":
   $texto =  "color_contenido";
   break;
}

$arreglo = Array('00','20','40','60','80','a0','c0','ff');
for ($i = 0; $i < 8; $i++) 
	{
	echo "<table border=1 cellpadding=8>" ;
	for ($j = 0; $j < 8; $j++) 
		{
		echo "<tr>" ;
		for ($k = 0; $k < 8; $k++)
		{
		echo '<td bgcolor="#'.$arreglo[$i].$arreglo[$j].$arreglo[$k].'">';
		echo '<tt><a href="#" onClick="opener.document.form1.'.$texto.'.value=\''.$arreglo[$i].$arreglo[$j].$arreglo[$k].'\';window.close();"><font color="#'.$arreglo[7-$i].$arreglo[7-$j].$arreglo[7-$k].'"> ' ;
		echo $arreglo[$i].$arreglo[$j].$arreglo[$k].' </font></a></tt></td>' ;
		}
	echo "</tr>"; 
	}
	echo "</table><br>" ;
}
?>

</center>
