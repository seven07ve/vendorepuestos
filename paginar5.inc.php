<?php
  
//Antes de incluir este script vía include() se debe haber definido una variable $_pagi_sql
//que contenga una sentencia sql válida

if(empty($_pagi_sql)){
	//Si no se definió $_pagi_sql... error!
	die("<b>Error paginación : </b>No se ha definido la variable \$_pagi_sql");
}

if(empty($_pagi_cuantos)){
	//Si no se ha especificado la cantidad de registros por página
	//$_pagi_cuantos será por defecto 20
	$_pagi_cuantos = 24;
}

if (empty($_GET['pg'])){
	//Si no se ha hecho click a ninguna página específica
	//O sea si es la primera vez que se ejecuta el script
    //$_pagi_actual es la pagina actual-->será por defecto la primera.
	$_pagi_actual = 1;
}
elseif(isset($_POST["pg"]))
{
		$_pagi_actual=$_POST["pg"]; 
}
else
{
	//Si se "pidió" una página específica:
	//La página actual será la que se pidió.
    $_pagi_actual = $_GET['pg'];
}

$_pagi_result2 = mysql_query($_pagi_sql) or die ("Error en la consulta de conteo de registros. Mysql dijo: <b>".mysql_error()."</b>");
$_pagi_totalReg = mysql_num_rows($_pagi_result2);//total de registros

//Calculamos el número de páginas (saldrá un decimal)
//con ceil() redondeamos y $_pagi_totyalPags será el número total (entero) de páginas que tendremos
$_pagi_totalPags = ceil($_pagi_totalReg / $_pagi_cuantos);


//Creamos la navegación a páginas específicas. Una línea tipo: <<anterior 1 2 3 4 siguiente>>

//La idea es pasar también en los enlaces las variables hayan llegado por url.
$_pagi_enlace = substr($_SERVER['REDIRECT_URL'],0,-2);
/*$_pagi_query_string = "/";
if(isset($_GET)){
	//Si ya se han pasado variables por url, escribimos el query string concatenando
	//los elementos del array $_GET excepto la variable $_GET['pg'] si es que existe.
	$_pagi_variables = $_GET;
	foreach($_pagi_variables as $_pagi_clave => $_pagi_valor){
		if($_pagi_clave != 'pg'){
			$_pagi_query_string .= $_pagi_clave."=".$_pagi_valor."&";
		}
	}
}*/

//Añadimos el query string a la url.
//$_pagi_enlace .= $_pagi_query_string;

//La variable $_pagi_navegacion contendrá los enlaces a las páginas.
$_pagi_navegacion = '';

if ($_pagi_actual != 1){
	//Si no estamos en la página 1. Ponemos el enlace "anterior"
	$_pagi_url = $_pagi_actual - 1;//será el número de página al que enlazamos
	$_pagi_navegacion .= "<a href='".$_pagi_enlace."/".$_pagi_url."' class=\"pag\">&laquo; Anterior</a>&nbsp;";
}

//Enlaces a números de página:
for ($_pagi_i = 1; $_pagi_i<=$_pagi_totalPags; $_pagi_i++){//Desde página 1 hasta última página ($_pagi_totalPags)
    if ($_pagi_i == $_pagi_actual) {
		//Si el número de página es la actual ($_pagi_actual). Se escribe el número, pero sin enlace y en negrita.
        $_pagi_navegacion .= "<span class=\"pag_actual\">$_pagi_i &nbsp;&nbsp;</span>";
    }else{
		//Si es cualquier otro. Se escibe el enlace a dicho número de página.
        $_pagi_navegacion .= "<a href='".$_pagi_enlace."/".$_pagi_i."' class=\"pag\">".$_pagi_i."</a>&nbsp;&nbsp;";
    }
}

if ($_pagi_actual < $_pagi_totalPags){
	//Si no estamos en la última página. Ponemos el enlace "Siguiente"
    $_pagi_url = $_pagi_actual + 1;//será el número de página al que enlazamos
    $_pagi_navegacion .= "<a href='".$_pagi_enlace."/".$_pagi_url."' class=\"pag\">Siguiente &raquo;</a>";
}
//Hasta acá hemos completado la "barra de navegación"

//Calculamos desde qué registro se mostrará en esta página
//Recordemos que el conteo empieza desde CERO.
$_pagi_inicial = ($_pagi_actual-1) * $_pagi_cuantos;

//Consulta SQL. Devuelve $cantidad registros empezando desde $_pagi_inicial
$_pagi_sqlLim = $_pagi_sql." LIMIT $_pagi_inicial,$_pagi_cuantos";
$_pagi_result = mysql_query($_pagi_sqlLim) or die ("Error en la consulta limitada. Mysql dijo: <b>".mysql_error()."</b>");

//A partir de aquí quedan disponibles dos variables:
//$_pagi_navegacion : que contiene los enlaces para navegar por las páginas
//$_pagi_result : que contiene el id del resultado de la consulta a la BD para los registros de la página actual.
?>