<?php
	function layoutMail($titulo,$contenido){
		$cuerpo = '<div style="width:750px; font-family:\'Oswald\', sans-serif; background-color:#E4E4E3; padding:50px; color:#262626;">
		<img src="www.vendorepuestos.com.ve/imagenes/cabecera-peq.jpg" width="750" height="112" alt=""/>
		<div style="width:700px; font-size:20px; padding:30px;">
			<div style="text-align:center;  font-weight:bold;">
			'.$titulo.'
			</div><br><br>
			'.$contenido.'<br><br>
			<span style="color:#69A02A;"> vendorepuestos.com.ve.</span>
		</div></div>';
		return $cuerpo;
	}
?>