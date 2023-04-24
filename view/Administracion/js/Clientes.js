
     
$(document).ready( function (){
   init_controles();
   CargarTipoIdentificacion();
   CargarEstado();
   Load_Clientes();
   $(".cantidades").inputmask();
});




function CargarTipoIdentificacion(){
		
	let $ddlPeriodo = $("#id_tipo_identificacion");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Clientes&action=CargarTipoIdentificacion",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_tipo_identificacion +" >" + value.nombre_tipo_identificacion  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}



function CargarEstado(){
		
	let $ddlPeriodo = $("#id_estado");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Clientes&action=CargarEstado",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  //$ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_estado +" >" + value.nombre_estado  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}

function init_controles(){
	try {
		
		 $("#fotografia_clientes").fileinput({			
		 	showPreview: false,
	        showUpload: false,
	        elErrorContainer: '#errorImagen',
	        allowedFileExtensions: ["png","jpg","jpeg"],
	        language: 'esp' 
		 });
		
	} catch (e) {
		// TODO: handle exception
		console.log("ERROR AL IMPLEMENTAR PLUGIN DE FILEUPLOAD");
	}
}


function fnBeforeAction(mensaje){

	swal({
        title: "PROCESANDO",
        text: mensaje,
        icon: "view/images/ajax-loader.gif",        
      })
}


function RegistrarClientes(){
	
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	
	let $id_clientes  = $("#id_clientes");
	let $id_tipo_identificacion  = $("#id_tipo_identificacion");
	let $identificacion_clientes = $("#identificacion_clientes");
	let $razon_social_clientes   = $("#razon_social_clientes");
	let $celular_clientes    = $("#celular_clientes");
	let $correo_clientes     = $("#correo_clientes");
	let $direccion_clientes  = $("#direccion_clientes");
	let $valor_limite_credito = $("#valor_limite_credito");
	let $id_estado           = $("#id_estado");
	
	var tiempo = tiempo || 1000;
	var contador=0;
		    	
	var suma = 0;      
	var residuo = 0;      
	var pri = false;      
	var pub = false;            
	var nat = false;      
	var numeroProvincias = 22;                  
	var modulo = 11;
				
	/* Verifico que el campo no contenga letras */                  
	var ok=1;


	for (i=0; i<$identificacion_clientes.val().length && ok==1 ; i++){
		var n = parseInt($identificacion_clientes.val().charAt(i));
		if (isNaN(n)) ok=0;
	 }


	/* Los primeros dos digitos corresponden al codigo de la provincia */
	provincia = $identificacion_clientes.val().substr(0,2);


	/* Aqui almacenamos los digitos de la cedula en variables. */
	d1  = $identificacion_clientes.val().substr(0,1);         
	d2  = $identificacion_clientes.val().substr(1,1);         
	d3  = $identificacion_clientes.val().substr(2,1);         
	d4  = $identificacion_clientes.val().substr(3,1);         
	d5  = $identificacion_clientes.val().substr(4,1);         
	d6  = $identificacion_clientes.val().substr(5,1);         
	d7  = $identificacion_clientes.val().substr(6,1);         
	d8  = $identificacion_clientes.val().substr(7,1);         
	d9  = $identificacion_clientes.val().substr(8,1);         
	d10 = $identificacion_clientes.val().substr(9,1);                
	   
	/* El tercer digito es: */                           
	/* 9 para sociedades privadas y extranjeros   */         
	/* 6 para sociedades publicas */         
	/* menor que 6 (0,1,2,3,4,5) para personas naturales */ 


	/* Solo para personas naturales (modulo 10) */         
	if (d3 < 6){           
	   nat = true;            
	   p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
	   p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
	   p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
	   p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
	   p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
	   p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
	   p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
	   p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
	   p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
	   modulo = 10;
	}         
	/* Solo para sociedades publicas (modulo 11) */                  
	/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
	else if(d3 == 6){           
	   pub = true;             
	   p1 = d1 * 3;
	   p2 = d2 * 2;
	   p3 = d3 * 7;
	   p4 = d4 * 6;
	   p5 = d5 * 5;
	   p6 = d6 * 4;
	   p7 = d7 * 3;
	   p8 = d8 * 2;            
	   p9 = 0;            
	}         
	   
	/* Solo para entidades privadas (modulo 11) */         
	else if(d3 == 9) {           
	   pri = true;                                   
	   p1 = d1 * 4;
	   p2 = d2 * 3;
	   p3 = d3 * 2;
	   p4 = d4 * 7;
	   p5 = d5 * 6;
	   p6 = d6 * 5;
	   p7 = d7 * 4;
	   p8 = d8 * 3;
	   p9 = d9 * 2;            
	}
			  
	suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
	residuo = suma % modulo;                                         
	/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
	digitoVerificador = residuo==0 ? 0: modulo - residuo; 


   if($id_clientes.val()==""){
		$id_tipo_identificacion.notify("Error Vuelva a Intentarlo",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_identificacion).offset().top-120 }, tiempo);
		
		return false;
		
	}
		
	if ($id_tipo_identificacion.val() == 0)
	{
		$id_tipo_identificacion.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_identificacion).offset().top-120 }, tiempo);
		
		return false;
		
	}


		
		if ($identificacion_clientes.val()=="")
		{
			$identificacion_clientes.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
			
			return false;
			
		}
		else 
		{


			if($id_tipo_identificacion.val()==1){


				if (ok==0){
					
					$identificacion_clientes.notify("Ingrese solo números",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
					
					return false;
				}
				
				
				if($identificacion_clientes.val().length==10){

					
				}else{
					
					$identificacion_clientes.notify("Ingrese 10 Dígitos",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
					
					return false;
					
				}


				if (provincia < 1 || provincia > numeroProvincias){           
					
					$identificacion_clientes.notify("El código de la provincia (dos primeros dígitos) es inválido",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
					
					return false;
					
				  }



				if (d3==7 || d3==8){           
					
					$identificacion_clientes.notify("El tercer dígito ingresado es inválido",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
					
					return false;
				  }
				



				if(nat == true){         
					 if (digitoVerificador != d10){    

						$identificacion_clientes.notify("El número de cédula de la persona natural es incorrecto.",{ position:"buttom left", autoHideDelay: 2000});
						$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
						
						return false;

					 }

				 }

			}else{


				 if (ok==0){
						
						$identificacion_clientes.notify("Ingrese solo números",{ position:"buttom left", autoHideDelay: 2000});
						$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
						
						return false;
				  }

				

				if($identificacion_clientes.val().length >=13){

					
				}else{
					
					$identificacion_clientes.notify("Ingrese 13 Digitos",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
						
					return false;
					
				}



				if (provincia < 1 || provincia > numeroProvincias){           
					
					$identificacion_clientes.notify("El código de la provincia (dos primeros dígitos) es inválido",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
						
					return false;

				}



				if (d3==7 || d3==8){           

					$identificacion_clientes.notify("El tercer dígito ingresado es inválido",{ position:"buttom left", autoHideDelay: 2000});
					$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
						
					return false;

					
				}


				  if (pub==true){      


						 /* El ruc de las empresas del sector publico terminan con 0001*/         
					 if ( $identificacion_clientes.val().substr(9,4) != '0001' ){                    

						$identificacion_clientes.notify("El ruc de la empresa del sector público debe terminar con 0001",{ position:"buttom left", autoHideDelay: 2000});
						$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
							
						return false;


					 }
						   
					if (digitoVerificador != d9){     

						$identificacion_clientes.notify("El ruc de la empresa del sector público es incorrecto.",{ position:"buttom left", autoHideDelay: 2000});
						$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
							
						return false;
					
					}                

				 }

						   

				   if(pri == true){    
					   if ( $identificacion_clientes.val().substr(10,3) != '001' ){   

							$identificacion_clientes.notify("El ruc de la empresa del sector privado debe terminar con 001",{ position:"buttom left", autoHideDelay: 2000});
							$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
								
							return false;
							
						 }
							  
						 if (digitoVerificador != d10){                          

							$identificacion_clientes.notify("El ruc de la empresa del sector privado es incorrecto",{ position:"buttom left", autoHideDelay: 2000});
							$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
								
							return false;

						 }       
						 
					  } 


				if(nat == true){         

					if ($identificacion_clientes.val().length >10 && $identificacion_clientes.val().substr(10,3) != '001' ){                    
					 
					        $identificacion_clientes.notify("El ruc de la persona natural debe terminar con 001.",{ position:"buttom left", autoHideDelay: 2000});
							$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
								
							return false;
					 	
					 }else{
						 
						 if($identificacion_clientes.val().length >13){
								
							$identificacion_clientes.notify("El ruc de la persona natural es incorrecto.",{ position:"buttom left", autoHideDelay: 2000});
							$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
								
							return false;

						
						 }

					
						 if (digitoVerificador != d10){    

								$identificacion_clientes.notify("El ruc de la persona natural es incorrecto.",{ position:"buttom left", autoHideDelay: 2000});
								$("html, body").animate({ scrollTop: $($identificacion_clientes).offset().top-120 }, tiempo);
									
								return false;
	 
						 }


				 }


			}


		}    
	}
	
	
	
	if ($razon_social_clientes.val() == ""){    

		$razon_social_clientes.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($razon_social_clientes).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($celular_clientes.val()== ""){    

		$celular_clientes.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($celular_clientes).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($celular_clientes.val().length != 10){    

		$celular_clientes.notify("Ingrese 10 Dígitos",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($celular_clientes).offset().top-120 }, tiempo);
			
		return false;

	}
	
		
	if ($correo_clientes.val() == "")
   	{
		$("#correo_clientes").notify("Ingrese correo",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($correo_clientes).offset().top-120 }, tiempo);
			return false;
    }
   	else if (regex.test($('#correo_clientes').val()))
   	{
   		   
   	}else{
		$("#correo_clientes").notify("Ingrese correo valido",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($correo_clientes).offset().top-120 }, tiempo);
			return false;
    }
	
	if ($direccion_clientes.val()== ""){    

		$direccion_clientes.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($direccion_clientes).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($valor_limite_credito.val() == ""){    

		$valor_limite_credito.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($valor_limite_credito).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($valor_limite_credito.val() < 0 ){    

		$valor_limite_credito.notify("Valor debe ser mayor o igual a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($valor_limite_credito).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_estado.val() == 0 ){    

		$id_estado.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_estado).offset().top-120 }, tiempo);
			
		return false;

	}
	
	// para validar la foto obligatoria
	/*var inarchivo = $("#fotografia_clientes");
	if( inarchivo[0].files.length == 0){
		inarchivo.closest('div.file-input').notify("Seleccione un archivo",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}*/
		
	var parametros = new FormData();
	
	parametros.append('id_clientes',$id_clientes.val()); 
	parametros.append('id_tipo_identificacion',$id_tipo_identificacion.val());
	parametros.append('identificacion_clientes',$identificacion_clientes.val());
	
	parametros.append('razon_social_clientes',$razon_social_clientes.val()); 
	parametros.append('celular_clientes',$celular_clientes.val());
	parametros.append('correo_clientes',$correo_clientes.val());
	
	parametros.append('direccion_clientes',$direccion_clientes.val()); 
	parametros.append('valor_limite_credito',$valor_limite_credito.val());
	parametros.append('id_estado',$id_estado.val());
	
    parametros.append('fotografia_clientes', $('#fotografia_clientes')[0].files[0]); 
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Clientes&action=RegistrarClientes",
		type:"POST",
		dataType:"json",
		data:parametros,		
		contentType: false, 
        processData: false  
   }).done(function(x){
		swal.close();
		if( x.dataerror != undefined && x.dataerror != "" ){
			
			let modalErrores = $("#mod_archivo_errores");			
			let arrayErrores = x.dataerror;
			let cantidadRegistros		= arrayErrores.length;
			let tblErrores = $("#tbl_archivo_error");
			
			tblErrores.find("tbody").empty();
			$.each( arrayErrores , function(index, value) {
				
				//value error.linea.cantidad vienen del array formado en controlador
				
				let repeticiones = isNaN(value.cantidad) ? 0 : value.cantidad;
				
				let $filaLineas = "<tr><td>" + (index + 1) +"</td><td>" +value.linea +"</td><td>" 
					+value.error +"</td><td>" + repeticiones +"</td></tr>";
				tblErrores.find("tbody").append($filaLineas);	
	  		});
			modalErrores.find('.modal-title').text(x.cabecera);
			modalErrores.modal("show");
			
			
			
			
			setTimeout(function(){ 
				if ( ! $.fn.DataTable.isDataTable( "#tbl_archivo_error" ) ) {
					$('#tbl_archivo_error').DataTable({
					"scrollX": true,
					"scrollY": 200,
					"ordering":false,
					"searching":false,
					"info":false
					})
				}
			},1000);		
			
		
		}
		
		if( x.respuesta != undefined && x.respuesta != ""){
			
			swal( {
				 title:"NOTIFICACIÓN",
				 dangerMode: false,
				 text: x.mensaje,
				 icon: "success"
				});
			
			Load_Clientes();
			cleanInputs();			
		}
		//console.log(x);
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		//swal.close();
		console.log(err);
		var mensaje = /<message>(.*?)<message>/.exec(err.replace(/\n/g,"|"))
		 	if( mensaje !== null ){
			 var resmsg = mensaje[1];
			 swal( {
				 title:"Error",
				 dangerMode: true,
				 text: resmsg.replace("|","\n"),
				 icon: "error"
				})
		 	}
	})	
	
	event.preventDefault();

	
}




var editar = function(a){
	
	
	var element = $(a);
	
	let $link = $(a);	
	
	var id_clientes	= $link.data("id_clientes");
		
	if( id_clientes <= 0 || id_clientes == "" || id_clientes == undefined ){
		return false;
	}	
		
		
		
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Clientes&action=DataEditar",
		type:"POST",
		dataType:"json",
		data:{id_clientes:id_clientes}
	}).done(function(datos){
		swal.close();
		 $.each(datos.data, function(index, value) {
         	
			
			    $('#id_clientes').val(value.id_clientes);
				$('#razon_social_clientes').val(value.razon_social_clientes);
				$('#id_tipo_identificacion').val(value.id_tipo_identificacion);
				$('#identificacion_clientes').val(value.identificacion_clientes);
				$('#direccion_clientes').val(value.direccion_clientes);
				$('#celular_clientes').val(value.celular_clientes);
				$('#correo_clientes').val(value.correo_clientes);
				$('#id_estado').val(value.id_estado);
				$('#valor_limite_credito').val(value.valor_limite_credito);
			
		});
		
		swal({
					title: 'NOTIFICACIÓN',
					text: 'Datos Cargados Correctamente',
					icon: 'success',
					timer: 2000,
					buttons: false,
			})
		
	}).fail(function(xhr,status,error){
		
		swal.close();
		
		        $('#razon_social_clientes').val("");
				$('#id_tipo_identificacion').val("0");
				$('#identificacion_clientes').val("");
				$('#direccion_clientes').val("");
				$('#celular_clientes').val("");
				$('#correo_clientes').val("");
		        $("#id_clientes").val("0");
		        $("#id_estado").val("1");
				$("#valor_limite_credito").val("0.00");
				$("#fotografia_clientes").fileinput('clear');
		
	}).always(function(){
		
	})	
	
}
	

var eliminar = function(a){
	
	
	var element = $(a);
	let $link = $(a);	
	var id_clientes	= $link.data("id_clientes");
	
	if( id_clientes <= 0 || id_clientes == "" || id_clientes == undefined ){
		return false;
	}	
	
	swal({title:"NOTIFICACIÓN",text:"Esta seguro de eliminar el cliente",icon:"info",buttons: true,
		  closeOnClickOutside: false,
		  closeOnEsc: false})
	.then((isConfirm) => {
		if (isConfirm)
		{
				$.ajax({
					beforeSend:fnBeforeAction('Estamos procesado la información'),
					url:"index.php?controller=Clientes&action=DataEliminar",
					type:"POST",
					dataType:"json",
					data:{id_clientes:id_clientes}
				}).done(function(datos){
					swal.close();
					 
					 if(datos.data==1){
						swal({
								title: 'NOTIFICACIÓN',
								text: 'Datos Eliminados Correctamente',
								icon: 'success',
								timer: 2000,
								buttons: false,
						})
					 }
					
				}).fail(function(xhr,status,error){
					
					swal.close();
					
							$('#razon_social_clientes').val("");
							$('#id_tipo_identificacion').val("0");
							$('#identificacion_clientes').val("");
							$('#direccion_clientes').val("");
							$('#celular_clientes').val("");
							$('#correo_clientes').val("");
							$("#id_clientes").val("0");
							$("#id_estado").val("1");
							$("#valor_limite_credito").val("0.00");
							$("#fotografia_clientes").fileinput('clear');
					
				}).always(function(){
					Load_Clientes();
				})	
		   
		}
	});
		
	
}


function cleanInputs(){
	
	            $('#razon_social_clientes').val("");
				$('#id_tipo_identificacion').val("0");
				$('#identificacion_clientes').val("");
				$('#direccion_clientes').val("");
				$('#celular_clientes').val("");
				$('#correo_clientes').val("");
		        $("#id_clientes").val("0");
		        $("#id_estado").val("1");
				$("#valor_limite_credito").val("0.00");
				$("#fotografia_clientes").fileinput('clear');
				
}


var viewTabla = viewTabla || {};

viewTabla.txt_busqueda	= $("#tbllistado");
viewTabla.tabla  = null;
viewTabla.nombre = 'tbllistado';
viewTabla.contenedor = $("#div_listado");





var idioma_espanol = {
	    "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla &#128543; ",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
}


var Load_Clientes	= function(){
	
	var dataSend = { 'input_search': viewTabla.txt_busqueda.val()};
	
	viewTabla.tabla	=  $( '#'+viewTabla.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Clientes&action=dtMostrar_Clientes',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
	    'order': [[ 2, "asc" ]],
	    'columns': [	    	    
	    	
	    	{ data: 'nombre_tipo_identificacion'},
    		{ data: 'identificacion_clientes'},
    		{ data: 'razon_social_clientes' },
    		{ data: 'correo_clientes'},
    		{ data: 'celular_clientes' },
    		{ data: 'nombre_estado' },
    		{ data: 'usuario_usuarios'},
    		{ data: 'opciones', orderable: false }
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 7 ] }
	      ],
		'scrollY': "40vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },
		
        //dom: "<'row'<'col-sm-6'<'box-tools pull-right'B>>><'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'<'#colvis'>p>>",
        dom: '<"html5buttons">lfrtipB',
        buttons: [
        //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
        
        	 { extend: 'copy'},
             {extend: 'csv'},
             {extend: 'excel', title: 'Lista Clientes'},
             {extend: 'pdf', title: 'Lista Clientes'},

             {extend: 'print',
              customize: function (win){
                     $(win.document.body).addClass('white-bg');
                     $(win.document.body).css('font-size', '10px');

                     $(win.document.body).find('table')
                             .addClass('compact')
                             .css('font-size', 'inherit');
             }
             }
       ],
         
        'language':idioma_espanol
	 });
		
}

        
        
        
        
          

$(document).ready( function (){

	if($("#id_clientes").val() > 0){
		
	}else{

		$( "#identificacion_clientes" ).autocomplete({
			source: "index.php?controller=Clientes&action=AutocompleteCedula",
			minLength: 4
		});

		$("#identificacion_clientes").focusout(function(){
			$.ajax({
				url:'index.php?controller=Clientes&action=AutocompleteDevuelveNombres',
				type:'POST',
				dataType:'json',
				data:{identificacion_clientes:$('#identificacion_clientes').val()}
			}).done(function(respuesta){

				$('#id_clientes').val(respuesta.id_clientes);
				$('#razon_social_clientes').val(respuesta.razon_social_clientes);
				$('#id_tipo_identificacion').val(respuesta.id_tipo_identificacion);
				$('#identificacion_clientes').val(respuesta.identificacion_clientes);
				$('#direccion_clientes').val(respuesta.direccion_clientes);
				$('#celular_clientes').val(respuesta.celular_clientes);
				$('#correo_clientes').val(respuesta.correo_clientes);
				$('#id_estado').val(respuesta.id_estado);
				$('#valor_limite_credito').val(respuesta.valor_limite_credito);
				
			
			}).fail(function(respuesta) {

				$('#razon_social_clientes').val("");
				$('#direccion_clientes').val("");
				$('#celular_clientes').val("");
				$('#correo_clientes').val("");
				$('#id_estado').val("1");
				$('#id_clientes').val("0");
				$('#valor_limite_credito').val("0.00");
			    $("#fotografia_clientes").fileinput('clear');
				
			  });
			 
			
		});  
	}
});		    		
		


		   