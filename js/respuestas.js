$(document).ready(function(){
	$("input").click(function(event) {
		var clickId = event.target.id.split("_");
		
		/*si es el el boton de mostrar*/
		if (clickId[0] == 'btnresp'){
			var clickId = event.target.id.split("_");
			/*boton responder*/
			$("#btnresp_"+clickId[1]).fadeOut("slow");
			/*formulario*/
			$( "#cont-form"+clickId[1]).fadeIn( "slow" );
		}
		/*si es el boton de responder pregunta*/
		else if(clickId[0] == 'responder'){
			var respuesta = $('#respuesta'+clickId[1]).val().trim();
			var idProd = $('#id-prod'+clickId[1]).val();
			var idPreg = $('#id-preg'+clickId[1]).val();
			var email = $('#email'+clickId[1]).val();
			
			if(respuesta == ""){
				var msjrespuesta = '#msjrespuesta'+clickId[1];
				$(msjrespuesta).fadeIn(1000).replaceWith('<span id="msjrespuesta'+clickId[1]+'">Debe responder al cliente</span>');
				$(msjrespuesta).css({
					"color": "#FD6868",
					"font-weight": "bold",
					"display": "none"
				});
				$(msjrespuesta).fadeIn(1000);
				$(msjrespuesta).css({
					"display": "block"
				});
			}
			
			else{
				$('#mini-cargando'+clickId[1]).fadeIn(1000);
				/*guarda la pregunta*/
				var datos = 'respuesta='+respuesta+'&idprod='+idProd+'&idpreg='+idPreg+'&email='+email;
				$.ajax({
					url: "/../php/respuestas.php",
					type: "POST",
					data: datos,
					success: function(data){
						console.log("tt"+data);
						document.getElementById("cont-preg-resp"+clickId[1]).innerHTML = data;
						//$('#producto'+clickId[1]).css( "display", "none" );
					}
				});
				$('#mini-cargando'+clickId[1]).fadeOut(1000);
			}
			//para borrar mensajes de advertencia

			$('#respuesta'+clickId[1]).keyup(function(){
				$(msjrespuesta).fadeOut(1000);
			});
		}
	});
});
