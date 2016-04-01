<?php
include("../conexion.php");
//include("funciones_mail.php");
include("funciones_mail.php");
$respuesta = $_REQUEST["respuesta"];
$id_prod = $_REQUEST["idprod"];
$id_preg = $_REQUEST["idpreg"];
/*correo cliente*/
$email = $_REQUEST["email"];

/*si ya tiene una respuesta*/
$busq_preg = mysql_query("SELECT * FROM preguntas WHERE id_preg='$id_preg'");
while($pre=mysql_fetch_array($busq_preg)){
	$resp =$pre["id_resp"];
	$borrar_resp = mysql_query("DELETE FROM respuestas WHERE id_resp='$resp'");
}
/*guarda la respuesta*/
$sentencia = "INSERT INTO respuestas (respuesta) VALUES ('%s')";
$sent_trat = sprintf($sentencia, $respuesta);
$insertar = mysql_query($sent_trat);
//guarda el numero de la ultima id creada por autoincremento
$id_resp = mysql_insert_id();
if ($id_preg == 0){
	$mensaje = 'No se pudo guardar la respuesta';
}
elseif($id_preg == false){
	$mensaje = 'No se estableció una conexión MySQL';
}
else{
	/*actualiza la tabla preguntas*/
	$sent_act = "UPDATE preguntas SET id_resp='%d', status='2'  WHERE id_preg='$id_preg'";
	$act_trat = sprintf($sent_act, $id_resp);
	$act_pregunta = mysql_query($act_trat);
	/*pergunta al vendedor con respuesta*/
	$lista_preg = mysql_query("SELECT * FROM preguntas WHERE id_preg='$id_preg'");
			/*cont preguntas y respuestas*/
//	echo '<div id="cont-preg-resp" class="cont-preg-resp">';
	//$mensaje = $act_trat;
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
				$mensaje .= '<div class="resp">
                		<img src="/imagenes/ico-respuesta.jpg" width="20" height="20" hspace="5"/>'.$cont_resp["respuesta"].'
                	</div>';
		}
	}
//	echo '</div>';
}
/*-------------   enviar el correo al cliente del producto     ------------------------*/
//busca nombre del articilo
$ver_tienda = mysql_query("SELECT * FROM productos WHERE productos.id='$id_prod'");
$vt = mysql_fetch_array($ver_tienda);
$titulo = $vt["titulo"];
//titulo del email
$tit_mail = "Respuesta";
//contenido del email
$texto = 'Han respondido tu pregunta <a href="http://vendorepuestos.dev/articulo/'.$titulo.'/'.$id_prod.'">Ver respuesta</a>';
//crea el cuerpo del correo
$cuerpo = layoutMail($tit_mail, $texto);

$subject = "Respondierón tu pregunta";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; utf-8\n";
$headers .= "X-Priority: 1\n";
$headers .= "From: administracion@vendorepuestos.com.ve\r\n";
$send_mail = mail($email, $subject, $cuerpo, $headers);


echo $mensaje;
return;
?>