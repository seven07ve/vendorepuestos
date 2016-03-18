$(document).ready(function(){
    $('#preguntar').click(function () {
        var mail = $('#email').val();
        var consulta = $('#consulta').val().trim();
		var idProd = $('#id-prod').val();
        //console.log('ss'+idProd);
/*		if((mail.indexOf ('@', 0) == -1) || (mail.indexOf ('.', 0) == -1) ||(mail.length < 5)){*/
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!expr.test(mail)){
            $('#msjmail').replaceWith('<span id="msjmail">Debe escribir una direcci&oacute;n de correo valida para poder contactarle</span>');
            $('#email').focus();
            $('#msjmail').append("");
            $('#msjmail').css({
                        "color": "#FD6868",
                        "font-weight": "bold",
                        "display": "none"
                    });
            $('#msjmail').fadeIn(1000);
            $('#msjmail').css({
                "display": "block"
                    });
        }
        else if(consulta == ""){
            $('#msjconsulta').fadeIn(1000).replaceWith('<span id="msjconsulta">Debe realizar la pregunta al vendedor</span>');
            $('#msjconsulta').css({
                "color": "#FD6868",
                "font-weight": "bold",
                "display": "none"
                    });
            $('#msjconsulta').fadeIn(1000);
            $('#msjconsulta').css({
                "display": "block"
            });
        }
        else{
            $('#mini-cargando').fadeIn(1000);
			/*guarda la pregunta*/
			var datos = 'email='+mail+'&pregunta='+consulta+'&idprod='+idProd;
			console.log("xx"+datos);
			$.ajax({
				url: "/../php/preguntas.php",
				type: "POST",
				data: datos,
				success: function(data){
					console.log("tt"+data);
					document.getElementById("cont-preg-resp").innerHTML = data;
					$('#email').val("");
					$('#consulta').val("");
				}
			});
            $('#mini-cargando').fadeOut(1000);
        }

    });
    //para borrar mensajes de advertencia
    $('#email').keyup(function(){
        $('#msjmail').fadeOut(1000);
    });

    $('#consulta').keyup(function(){
        $('#msjconsulta').fadeOut(1000);
    });
});
