/*=============================================
CAPTURANDO LA RUTA DE MI CMS
=============================================*/

var ruta = $("#ruta").val();

/*=============================================
AGREGAR RED
=============================================*/

$(document).on("click", ".agregarRed", function(){

	var url = $("#url_red").val();
	var icono = $("#icono_red").val().split(",")[0];
	var color = $("#icono_red").val().split(",")[1];

	$(".listadoRed").append(`

		<div class="col-lg-12">
      
        <div class="input-group mb-3">
          
          <div class="input-group-prepend">
            
            <div class="input-group-text text-white" style="background:`+color+`">
              
                <i class="`+icono+`"></i>

            </div>

          </div>

          <input type="text" class="form-control" value="`+url+`">

          <div class="input-group-prepend">
            
            <div class="input-group-text" style="cursor:pointer">
              
                <span class="bg-danger px-2 rounded-circle eliminarRed" red="`+icono+`" url="`+url+`">&times;</span>

            </div>

          </div>

        </div>

      </div>

	`)

	//Actualizar el registro de la BD

	//convierto el string en un array con parse

	var listaRed = JSON.parse($("#listaRed").val());
	
	listaRed.push({

		 "url": url,
		 "icono": icono,
		 "background": color

	})

	//convierto el array en un string con stringify

	$("#listaRed").val(JSON.stringify(listaRed));

})

/*=============================================
ELIMINAR RED
=============================================*/

//selecciono el documento y el elemento que se va a eliminar
$(document).on("click", ".eliminarRed", function(){

	// se guarda en una variable el valor del input listaRed

	var listaRed = JSON.parse($("#listaRed").val());

	var red = $(this).attr("red");
	var url = $(this).attr("url");

	//recorro el array listaRed
	for(var i = 0; i < listaRed.length; i++){

		//si el valor de red y url es igual al valor de icono y url del array listaRed
		if(red == listaRed[i]["icono"] && url == listaRed[i]["url"]){
			
			//elimino el valor del array listaRed
			listaRed.splice(i, 1);
			
			//Remuevo el elemento del DOM
			$(this).parent().parent().parent().parent().remove();

			//convierto el string en un array
			$("#listaRed").val(JSON.stringify(listaRed));

		}

	}



})

/*=============================================
PREVISUALIZAR IMÁGENES TEMPORALES
=============================================*/
$("input[type='file']").change(function(){

	var imagen = this.files[0];
	var tipo = $(this).attr("name");
	
	/*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$("input[type='file']").val("");

    	notie.alert({

		    type: 3,
		    text: '¡La imagen debe estar en formato JPG o PNG!',
		    time: 7

		 })

    }else if(imagen["size"] > 2000000){

    	$("input[type='file']").val("");

    	notie.alert({

		    type: 3,
		    text: '¡La imagen no debe pesar más de 2MB!',
		    time: 7

		 })

    }else{

    	var datosImagen = new FileReader;
    	datosImagen.readAsDataURL(imagen);

    	$(datosImagen).on("load", function(event){

    		var rutaImagen = event.target.result;

    		$(".previsualizarImg_"+tipo).attr("src", rutaImagen);

    	})

    }


})

/*=============================================
SUMMERNOTE
=============================================*/

$(".summernote-sm").summernote({

	height: 300,
	callbacks: {

		onImageUpload: function(files){

			for(var i = 0; i < files.length; i++){

				upload_sm(files[i]);

			}

		}

	}

});

$(".summernote-smc").summernote({

	height: 300,
	callbacks: {

		onImageUpload: function(files){

			for(var i = 0; i < files.length; i++){

				upload_smc(files[i]);

			}

		}

	}

});

$(".summernote-articulos").summernote({

	height: 300,
	callbacks: {

		onImageUpload: function(files){

			for(var i = 0; i < files.length; i++){

				upload_articulos(files[i]);

			}

		}

	}

});

$(".summernote-editar-articulo").summernote({

	height: 300,
	callbacks: {

		onImageUpload: function(files){

			for(var i = 0; i < files.length; i++){

				upload_editar_articulo(files[i]);

			}

		}

	}

});

/*=============================================
SUBIR IMAGEN AL SERVIDOR
=============================================*/

function upload_sm(file){

	var datos = new FormData();	
	datos.append('file', file, file.name);
	datos.append("ruta", ruta);
	datos.append("carpeta", "blog");

	$.ajax({
		url: ruta+"/ajax/upload.php",
		method: "POST",
		data: datos,
		contentType: false,
		cache: false,
		processData: false,
		success: function (respuesta) {

			$('.summernote-sm').summernote("insertImage", respuesta,  function ($image) {
				$image.attr('class', 'img-fluid');
			  });  

		},
		error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
      }

	})

}

function upload_smc(file){

	var datos = new FormData();	
	datos.append('file', file, file.name);
	datos.append("ruta", ruta);
	datos.append("carpeta", "blog");

	$.ajax({
		url: ruta+"/ajax/upload.php",
		method: "POST",
		data: datos,
		contentType: false,
		cache: false,
		processData: false,
		success: function (respuesta) {

			$('.summernote-smc').summernote("insertImage", respuesta,  function ($image) {
				$image.attr('class', 'img-fluid');
			  });  
		},
		error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
      }

	})

}

function upload_articulos(file){

	var datos = new FormData();	
	datos.append('file', file, file.name);
	datos.append("ruta", ruta);
	datos.append("carpeta", "articulos");

	$.ajax({
		url: ruta+"/ajax/upload.php",
		method: "POST",
		data: datos,
		contentType: false,
		cache: false,
		processData: false,
		success: function (respuesta) {

			$('.summernote-articulos').summernote("insertImage", respuesta, function ($image) {
				$image.attr('class', 'img-fluid');
			  });  

		},
		error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
      }

	})

}

function upload_editar_articulo(file){

	var datos = new FormData();	
	datos.append('file', file, file.name);
	datos.append("ruta", ruta);
	datos.append("carpeta", "articulos");

	$.ajax({
		url: ruta+"/ajax/upload.php",
		method: "POST",
		data: datos,
		contentType: false,
		cache: false,
		processData: false,
		success: function (respuesta) {

			$('.summernote-editar-articulo').summernote("insertImage", respuesta,  function ($image) {
				$image.attr('class', 'img-fluid');
			  });  

		},
		error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
      }

	})

}

//Preguntar para Eliminar administrador

$(document).on("click", ".eliminarRegistro", function(){

	var action = $(this).attr("action"); 
  	var method = $(this).attr("method");
  	var pagina = $(this).attr("pagina");
  	//var token = $(this).children("[name='_token']").attr("value");
  	var token = $(this).attr("token");


  	swal({
  		 title: '¿Está seguro de eliminar este Administrador?',
  		 text: "¡Si no lo está puede cancelar la acción!",
  		 type: 'warning',
  		 showCancelButton: true,
  		 confirmButtonColor: '#3085d6',
  		 cancelButtonColor: '#d33',
  		 cancelButtonText: 'No, cancelar!',
  		 confirmButtonText: 'Si, eliminar!'
  	}).then(function(result){

  		if(result.value){

  			var datos = new FormData();
  			datos.append("_method", method);
  			datos.append("_token", token);

  			$.ajax({

  				url: action,
  				method: "POST",
  				data: datos,
  				cache: false,
  				contentType: false,
        		processData: false,
        		success:function(respuesta){

        			 if(respuesta == "ok"){

						console.log("Putas");

    			 		swal({
		                    type:"success",
		                    title: "¡El registro ha sido eliminado!",
		                    showConfirmButton: true,
		                    confirmButtonText: "Cerrar"
			                    
			             }).then(function(result){

			             	if(result.value){

			             		window.location = ruta+'/'+pagina; 

			             	}


			             })

        			 }

        		},
		        error: function (jqXHR, textStatus, errorThrown) {
		            console.error(textStatus + " " + errorThrown);
		        }

  			})

  		}

  	})

})

//Limpieza de rutas/links

function limpiarUrl(texto){

	var texto = texto.toLowerCase();
	texto = texto.replace(/[á]/g, 'a');
	texto = texto.replace(/[é]/g, 'e');
	texto = texto.replace(/[í]/g, 'i');
	texto = texto.replace(/[ó]/g, 'o');
	texto = texto.replace(/[ú]/g, 'u');
	texto = texto.replace(/[ñ]/g, 'n');
	texto = texto.replace(/ /g, '-');

	return texto;

}

$(document).on("keyup", ".inputRuta", function(){

	// Lo que se escriba en el input se limpiará con la función limpiarUrl
	$(this).val(limpiarUrl($(this).val()));

});

//Validar y evitar repetir ruta de categoría

$(document).on("change", ".inputRuta", function(){

	$(".alert").remove();
	//capturo los valores de la ruta de la categoría
	var valorRuta = $(this).val();
	var validarRuta = $(".validarRuta");

	//Recorro el array validarRuta para comparar si el valor de la ruta ya existe
	for(var i = 0; i < validarRuta.length; i++){

		if($(validarRuta[i]).html() == valorRuta){

			//Si el valor de la ruta ya existe, se mostrará un mensaje de alerta y se limpiará el input
			$(".inputRuta").val("");
			$(".inputRuta").parent().after('<div class="alert alert-danger">Esta ruta ya existe, por favor ingrese otra</div>');

		}

	}
});