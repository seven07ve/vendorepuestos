<html>
<head>
<link href="cascadas.css" rel="stylesheet" type="text/css">
</head>
<body>
  <table>
     <tr>
	   <?php 
	   include("conexion.php");
	   include("funciones.php");
	   $idc=$_GET["idc"];
	   
             $mar=mysql_query("SELECT * FROM menu WHERE id_categoria='$idc' ORDER BY orden ASC, nombre ASC");
	         while($dmar=mysql_fetch_array($mar))
			 {				   
			   if($dmar["logo"]!="")
			   {?>
    		   <td><a href="/vista_nivel3/<?=limpiar_cadena(cual_categoria($idc));?>/<?=$idc?>/<?=$dmar['id']?>/0/0/1" target="_parent"><img src="/imagenes_logos/<?=$dmar["logo"]?>" border="0" alt="<?=strtoupper($dmar["nombre"]);?>"></a></td>
	  <?php }  }?>  				   
	 </tr>
  </table>
</body>
</html>