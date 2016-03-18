<?php
include("../conexion.php");
$email = $_REQUEST["email"];
$pregunta = $_REQUEST["pregunta"];
$id_prod = $_REQUEST["idprod"];

/*guarda la pregunta*/
$sentencia = "INSERT INTO preguntas (pregunta, email, id_producto) VALUES ('%s', '%s', '%d')";
$sent_trat = sprintf($sentencia, $pregunta, $email, $id_prod);
$insertar = mysql_query($sent_trat);
//guarda el numero de la ultima id creada por autoincremento
$id_preg = mysql_insert_id();
if ($id_preg == 0){
	$mensaje = 'No se pudo guardar la pregunta';
}
elseif($id_preg == false){
	$mensaje = 'No se estableció una conexión MySQL';
}
else{
	/*perguntas al vendedor*/
	$lista_preg = mysql_query("SELECT * FROM preguntas WHERE id_producto='$id_prod' ORDER BY id_preg DESC");
			/*cont preguntas y respuestas*/
//	echo '<div id="cont-preg-resp" class="cont-preg-resp">';
	$mensaje = "";
	while($row=mysql_fetch_array($lista_preg)){
		/*pregunta*/
		$mensaje .= '<div class="preg">
                		<img src="/imagenes/ico-pregunta.jpg" width="20" height="20" hspace="5"/>
						'.$row["pregunta"].'
                	</div>';
		/*revisa si hay respuesta*/
		if ($row["status"] == 2){
				$respuesta = mysql_query("SELECT * FROM respuestas WHERE id_resp='".$row["id_resp"]."'");
				$cont_resp = mysql_fetch_array($respuesta);
			/*respuesta*/
				$mensaje . '<div class="resp">
                		<img src="/imagenes/ico-respuesta.jpg" width="20" height="20" hspace="5"/>'.$cont_resp["respuesta"].'
                	</div>';
		}
	}
//	echo '</div>';
}
echo $mensaje;
return;
?>