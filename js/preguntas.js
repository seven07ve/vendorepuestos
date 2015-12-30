$(document).ready(function(){
	$('#preguntar').click(function () {
		var mail = $('#email').val();
		var consulta = $('#consulta').val().trim();
		console.log('ss'+consulta);
		if (mail == ""){
			$('#msjmail').replaceWith('<span id="msjmail">Debe colocar un correo para poder contactarle</span>');
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
	});
	//para borrar mensajes
	$('#email').keyup(function(){
		$('#msjmail').fadeOut(1000);
	});

	$('#consulta').keyup(function(){
		$('#msjconsulta').fadeOut(1000);
	});
});