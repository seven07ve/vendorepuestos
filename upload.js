/*(function () {*/
	/*var input = document.getElementById("file-input"),*/
	
	
	/*esto se para hacer una lista de imagenes con li*/
	function showUploadedItem (source) {

/*		var list = document.getElementById("image-list"),
			li   = document.createElement("li"),
			img  = document.createElement("img");
		img.src = source;
		li.appendChild(img);
		list.appendChild(li);*/
		
	}


function montar(evento,inputId,imgId){
      evento.preventDefault();

      carga(evento,inputId,imgId);
}	

function mostrar(inputId,borrar){
	if($("#img-"+inputId).val() == ""){
		/*console.log("#img-"+inputId);*/
	}
	else{
		$("#"+borrar).css("display", "inline-block");
		$("#"+inputId).attr("disabled", "disabled");
		console.log(inputId);
	}
}

function borrar(inputId,imgId){
	var hiddenInputId = "#img-"+inputId;
	var deleteimg = $(hiddenInputId).val();
	datos = 'nom_img='+deleteimg;
	$.ajax({
		url: "/delete-uploaded.php",
		type: "POST",
		data: datos,
		success: function (msj){
			$(inputId).val("");
			$(hiddenInputId).val("");
			/*$(imgId).attr("src", "/images/camera.png")*/
			$("#"+inputId).removeAttr("disabled");
			/*$("#file-input").attr("class", "");*/
		}
	});
}

	/*input.addEventListener("change", function (evt){*/
	/*function carga(evt,inputId,imgId,actualizar,dir){*/
	function carga(evt,pas){
		var inputId = pas["idObj"];
		var imgId = pas["idImg"];
		var  actualizar = pas["tipo"];
		var dir = pas["dir"];
		console.log(pas["idObj"]);
		console.log(pas["idImg"]);
		console.log(pas["tipo"]);
		console.log(pas["dir"]);
		var input = document.getElementById(inputId);
		
		formdata = false;
		
		if (window.FormData) {
		formdata = new FormData();
		}
		
		/*document.getElementById("response").innerHTML = "Uploading . . ."*/
		var i = 0, len =input.files.length, img, reader, file;
		
		console.log("len"+len);
		for ( ; i < len; i++) {
			/*console.log(i);*/
			file = input.files[i];

			console.log("hola"+file.type);	
				/*console.log(file);*/
			if (!!file.type.match(/image.*/)) {
				if (window.FileReader) {
					reader = new FileReader();
					reader.onloadend = function(e){
						console.log("test"+e.target.result);
						showUploadedItem(e.target.result,file.fileName);
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("images[]",file);
				}
			}
		}
		if (formdata) {
			/*si hay imagen*/
			if (len == 1){
			$(imgId).attr("class", "loader");
			$(imgId).attr("src", "../images/cargando.fw.png");
			console.log(len);
			$.ajax({
				url: "/"+dir,
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res){
					/*document.getElementById("response").innerHTML = res;*/
					/*$("#subir").css("display", "none");*/
					/*console.log(imgId);*/

					/*var inp = document.createElement("input");*/
					var inp = document.getElementById("img-"+inputId);
					var resp = res;
					if (res.length > 50){

					}
					else{
						if (actualizar == "actualizar"){
							var imgAct = "#imgactual-"+inputId
							console.log(imgAct);
							$(imgId).attr("class", "");
							if (inputId == "file-input"){
								$(imgId).attr("src", "../images/camera2.png");
							}
							else{
								$(imgId).attr("src", "../images/camera.png");
							}
							$(imgAct).attr("src", "/"+res);
						}
						else{
							$(imgId).attr("src", "/uploads-temp/"+res);
							$(imgId).attr("class", "");
							$(inp).attr("value", res);
						}
					}
					/*$(inp).attr("id", "img-"+inputId);*/
					/*$(".image-upload").append(inp);*/
				}
			});
			}
		}
	}/*,false);*/
/*}());*/
