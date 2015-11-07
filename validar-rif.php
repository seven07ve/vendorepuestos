<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Ejemplo de HTML5" />
	<meta name="keywords" content="HTML5, CSS3, Javascript" />
	<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
function comprobar(nick)   
 {	
	//var url = 'http://vendorepuestos.com.ve/check-rif.php';
	var url = 'check-rif.php';
	//var pars='nickname=seven';   
	var rif = document.form1.rif.value.toUpperCase();
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
	var pars = 'num_rif=' + rif;
	var myAjax = new Ajax.Updater( 'comprobar_mensaje', url, { method: 'get', parameters: pars});
	var text = document.getElementsById("comprobar_mensaje");
	text.src = '#CCC';
	//alert(text.style);
 }
</script>
<title>Página</title>
</head>
<body>
	<form name="form1" action="#" onSubmit="return check(this);">
		 <input id="las" name="rif" type="text" class="form" placeholder="J-xxxxxxxx-x" size="20" maxlength="12" autocomplete="off" onkeyup="comprobar(this.value);" /><span id="comprobar_mensaje"></span><br>		
		 <input name="" type="submit"  value="Submit"/>
	</form>
</body>

</html>