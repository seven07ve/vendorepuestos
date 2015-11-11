$(document).ready(function() {    
    $('#rif').keyup(function(){

        /*$('#circulo').html('<img src="loader.gif" alt="" />').fadeOut(500);*/

        var rif = $(this).val();
        rif = rif.toUpperCase();

        var cp = rif.length;
	if (rif.length == 1){
		document.form1.rif.value= rif + '-';
		rif = document.form1.rif.value;
	}
	if (rif == '--'){
		document.form1.rif.value= '';
	}
	if (rif.length > 2){
		var iniRif = rif.substring(0,2);
		var finRif = rif.substring(2,12);
		if(isNaN(finRif)){
			//para extraer la ultima entrada
			var ini = finRif.length -1;
			var fin = finRif.length;
			var entrada = finRif.substring(ini,fin);
			//si viene el ultimo guion se sale para que no lo borre
			if (entrada == "-" && finRif.indexOf("-") == ini){
			}
			//check que el ultimo sea un numero
			else if (fin-1 == (finRif.indexOf("-") + 1)){
				if (isNaN(entrada)){
					var rest = finRif.length - 1;
					finRif = finRif.substring(0,rest);
				}
			}
			//elimina lo que no sea numero
			else{
				var rest = finRif.length - 1;
				finRif = finRif.substring(0,rest);
			}
		}
		document.form1.rif.value = iniRif + finRif;
		rif = document.form1.rif.value;
	}   
        var dataString = 'num_rif='+rif;

        $.ajax({
            type: "POST",
            url: '/check-rif.php',
/*            url: 'http://vendorepuestos.com.ve/check-rif.php',*/
            /*url: "check_username_availablity.php",*/
            data: dataString,
            success: function(data) {
            	var resp = data;
                /*$('#Info').fadeIn(0).html(resp);*/
                if (resp == 1){
                	$('#Info').css({
                		"color": "#FD6868",
                		"font-weight": "bold",
                		"background-color" : "#FED8D8",
                		"display": "block"
                	});
                	$('#Info').fadeIn(0).html("Debe ser una de las siguientes opciones: J, V, E, G.<br>");
                	$('#rif').val("");
               } 	
                else if (resp == 2){
                	$('#Info').css({
                		"color": "#69A02A",
                		"font-weight": "bold",
                		"background-color" : "#E3FCC7",
                		"display": "block"
                	});
                	$('#Info').fadeIn(0).html("Los siguientes solo deben ser n&uacute;meros, con un gui&oacute;n (-) que precede al &uacute;ltimo n&uacute;mero.<br>");
                }
                else if (resp == 3){
                	$('#Info').css({
                		"color": "#253513",
                		"font-weight": "bold",
                		"background-color" : "#FFF",
                		"display": "none",
                		"padding": "0px"
                		
                	});
                	$('#Info').fadeIn(0).html("");
                }
                else if (resp == 4){
                	$('#Info').css({
                		"color": "#FF0000",
                		"font-weight": "bold",
                		"background-color" : "#FCBDBD",
                		"display": "block"

                	});
                	$('#Info').fadeIn(0).html("El rif ya Existe.<br>");
                	$('#rif').val("");
                }
/*                	document.getElementById("Info").style.fontWeight = "bold";
                	document.getElementById("Info").style.color = "#FD6868";*/
                
                /*document.getElementById("rif").value = "";*/
            }
        });
    });              
});

$(document).ready(function(){
	$('#nombre_oficial').blur(function(){
		var nomb = $(this).val();
		var dataString = 'nombre_oficial='+nomb;
		$.ajax({
			type: "POST",
			url: '/check-nombre.php',
/*			url: 'http://vendorepuestos.com.ve/check-nombre.php',*/
			data: dataString,
			success: function(data){
				var resp = data;
				if (resp == 1){
					$('#comprobar_nombre').css({
						"color": "#FF0000",
						"font-weight": "bold",
						"background-color" : "#FCBDBD",
						"display": "block"
					});
					$('#comprobar_nombre').fadeIn(0).html("Este nombre ya est&aacute; en uso. Seleccione otro nombre.");
					$("#nombre_oficial").val("");
					$("#nombre_oficial").focus();
				}
				if (resp == 0){
					$("#comprobar_nombre").css({
						"display": "none"
					});
				}
			}
		});
	});
});
$(document).ready(function(){
	$('#razon_social').blur(function(){
		var razon = $(this).val();
		var dataString = 'nombre_razon='+razon;
		$.ajax({
			type: "POST",
			url: '/check-razon.php',
/*			url: 'http://vendorepuestos.com.ve/check-razon.php',*/
			data: dataString,
			success: function(data){
				var resp = data;
				if (resp == 1){
					$("#comprobar_razon").css({
						"color": "#FF0000",
						"font-weight": "bold",
						"background-color" : "#FCBDBD",
						"display": "block"
					});
					$('#comprobar_razon').fadeIn(0).html("La raz&oacute;n social ya existe. Compruebe si ya tiene una cuenta con nosotros.");
					$("#razon_social").val("");
					$("#razon_social").focus();
				}
				if (resp == 0){
					$("#comprobar_razon").css({
						"display": "none"
					});
				}
			}
		});
	});
});
$(document).ready(function(){
	$('#id_estado').change(function(){
		/*alert( "Handler for .change() called." );*/
		var estado = 'buscar=10&edo='+$(this).val()+'&ciu=0';
		console.log(estado);
		$.ajax({
			type: "GET",
			url: '/admini/funciones_ajax.php',
/*			url: 'http://vendorepuestos.com.ve/admini/funciones_ajax.php',*/
			data: estado,
			success: function(transport){
				/*$('#ciu').fadeIn(0).html("hola");*/
				var res = transport;
				$('#ciu').fadeIn(0).html(res);
			}
		});
	});
});
$(document).ready(function(){
	$('#usuario').blur(function(){
		var razon = $(this).val();
		var dataString = 'nombre_usuario='+razon;
		$.ajax({
			type: "POST",
			url: '/check-usuario.php',
/*			url: 'http://vendorepuestos.com.ve/check-usuario.php',*/
			data: dataString,
			success: function(data){
				var resp = data;
				if (resp == 1){
					$("#comprobar_usuario").css({
						"color": "#FF0000",
						"font-weight": "bold",
						"background-color" : "#FCBDBD",
						"display": "block"
					});
					$('#comprobar_usuario').fadeIn(0).html("El usuario ya existe. Pruebe con otro nombre de usuario.");
					$("#usuario").val("");
					$("#usuario").focus();
				}
				if (resp == 0){
					$("#comprobar_usuario").css({
						"display": "none"
					});
				}
			}
		});
	});
});

function cambiar(elemId){
	var img = document.getElementById(elemId);
	img.src = "http://vendorepuestos.com.ve/imagenes/camera-ok.png";
}