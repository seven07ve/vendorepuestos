<?php 
session_start();
if (!isset($_SESSION['admin'])) {
 	header("Location: index.php");
 	exit;
} 
include "../conexion.php";
$action="";
if(isset($_POST["action"])) $action=$_POST["action"];
	
if($action=="ordenar"){
	$N0_lst = $_POST[N0_lst] ;
	$a = explode(',', $N0_lst);
	$result = count($a);
	for ($i=1;$i <= $result;$i++)
	{
		mysql_query("UPDATE menu SET orden = $i WHERE id = " . $a[$i-1] );
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="cascadas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/prototype.js"></script>
<script language="javascript">
<!--
function moveModule(o_col, d_col) 
{
  o_sl = document.fm[o_col].selectedIndex;
  d_sl = document.fm[d_col].length;
  if (o_sl != -1 && document.fm[o_col].options[o_sl].value > "") {
    oText = document.fm[o_col].options[o_sl].text;
    oValue = document.fm[o_col].options[o_sl].value;
    document.fm[o_col].options[o_sl] = null;
    document.fm[d_col].options[d_sl] = new Option (oText, oValue, false, true);
  } else {
    alert("Please select a module first");
  }
}  

function orderModule(down, col) 
{
  sl = document.fm[col].selectedIndex;
  if (sl != -1 && document.fm[col].options[sl].value > "") {
    oText = document.fm[col].options[sl].text;
    oValue = document.fm[col].options[sl].value;
    if (document.fm[col].options[sl].value > "" && sl > 0 && down == 0) {
      document.fm[col].options[sl].text = document.fm[col].options[sl-1].text;
      document.fm[col].options[sl].value = document.fm[col].options[sl-1].value;
      document.fm[col].options[sl-1].text = oText;
      document.fm[col].options[sl-1].value = oValue;
      document.fm[col].selectedIndex--;
    } else if (sl < document.fm[col].length-1 && document.fm[col].options[sl+1].value > "" && down == 1) {
      document.fm[col].options[sl].text = document.fm[col].options[sl+1].text;
      document.fm[col].options[sl].value = document.fm[col].options[sl+1].value;
      document.fm[col].options[sl+1].text = oText;
      document.fm[col].options[sl+1].value = oValue;
      document.fm[col].selectedIndex++;
    }
  } else {
    alert("Please select a module first");
  }
}

function xMod(col) 
{
  req = "";
  sl = document.fm[col].selectedIndex;
  if (sl != -1 && document.fm[col].options[sl].value > "") {
    if (req.indexOf(document.fm[col].options[sl].value) > -1) {
      alert ("You may not delete a required corporate module.");
    } else {
      if (confirm("This will delete the selected module.")) {
        if (document.fm[col].options[sl].value!=".none") {
          if (document.fm[col].length==1) {
            document.fm[col].options[0].text="";
            document.fm[col].options[0].value=".none";
          } else {
            document.fm[col].options[sl]=null; 
          } 
        } else {
          alert("Please select a module first");
        }
      }
    }
  }
}

function doSub() 
{
  layout = "N0.W0";
  for (i=0; i < layout.length; i++) {
    if (layout.substr(i,1) == 'N' || layout.substr(i,1) == 'W') {
      col = layout.substr(i,2); 
      document.fm[col + "_lst"].value = makeList(col);
    }
  }
  return true;
}

function makeList(col) 
{
  val = "";
  for (j=0; j<document.fm[col].length; j++) {
    if (val > "") { val += ","; }
    if (document.fm[col].options[j].value > "") val += document.fm[col].options[j].value;
  } 
  return val;
}

function sub_layout(layout) {
  document.fm['.commit'][0].value="";
  document.fm['.layout'].value=layout;
  doSub();
  document.fm.submit();
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body>
<? include("includes/header.php"); ?>
<table width="100%" height="" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" bgcolor="#333333"><img src="imagenes/titu_secciones.jpg" width="120" height="30" /></td>
    <td align="right" bgcolor="#333333" class="encuentra_en">UD. Se encuentra en: <strong>Opciones menú</strong> <strong>nivel 1</strong></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="leftCol"><? include("includes/menu.php");?></td>
    <td valign="top">
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
        <!-- Contenido -->
        
        <!-- SUBMENU -->
        <!-- FINAL SUBMENU -->
<table border="0" cellspacing="0" cellpadding="0" class="tabla_resultados">
<tr>
  <td class="tabla_titulo" nowrap="nowrap">Categorias</td>
</tr>
<tr>
  <td><select name="idc" onchange="MM_jumpMenu('parent',this,0)">
        <option value="ordenar_menu.php" selected>Seleccione</option>
		 <? 
	  $ver_cat = mysql_query("SELECT * FROM categoria ORDER BY nombre ASC");
	  while($vc = mysql_fetch_array($ver_cat))
	  { ?>
        <option value="ordenar_menu.php?idc=<?=$vc["id"];?>" <? if($_GET["idc"]==$vc["id"]){?> selected="selected"<? }?>><?=$vc["nombre"];?></option>
       <? }?>
      </select></td>
</tr>
<tr>
<td class="tabla_titulo" nowrap="nowrap"> Opciones Menu <a href="ordenar_menu.php"></a></td>
</tr>
<tr>
<td>
<form  method="post" action="?idc=<?=$_GET["idc"];?>" name="fm" id="fm" onSubmit="return doSub();">
            <input type="hidden" name=".page" value="p1">
            <input type="hidden" name=".src" value="my">
            <input type="hidden" name=".partner" value="">
            <input type="hidden" name=".done" value="http://my.yahoo.com/p/d.html">
            <input type="hidden" name=".no_js" value="">
            <input type="hidden" name=".layout" value="">
            <input type="hidden" name=".commit" value="1" />
            <input type="hidden" name="N0_lst" />
<?php 
$sql = "SELECT * FROM menu WHERE id_categoria='$_GET[idc]' ORDER BY orden ASC";
$res = mysql_query($sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
<tr>
<td nowrap="nowrap">
	<select name="N0" size="20" class="form" >
  	<?php while($resul = mysql_fetch_array($res)){?>
    	<option value="<?=$resul["id"] ?>"><?=$resul["nombre"]?></option>
  	<?php }?>
  </select>  </td> 
<td nowrap="nowrap"><a href="javascript:orderModule(0,'N0');"> <img src="imagenes/flecha_arriba.gif" width="16" height="16" border="0" alt="Up" vspace="2" /></a> <br />
                        <a href="javascript:orderModule(1,'N0');"><img src="imagenes/flecha_abajo.gif" width="16" height="16" border="0" alt="Down" vspace="2" /></a></td>
</tr>
<tr>
  <td colspan="2" nowrap="nowrap"><input type="hidden" name="action" value="ordenar" />    <input name="submit" type="submit" class="form" value="GUARDAR" /></td>
  </tr> 
</table>
</form>
</td>
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