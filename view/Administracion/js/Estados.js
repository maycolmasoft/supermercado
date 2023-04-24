$(document).ready( function (){
        		   
  cargaTablaBd();
  consultaEstados();
        		   
});

$("#nombre_estado").on("keyup",function(){
	
	$("#nombre_estado").val($("#nombre_estado").val().toUpperCase());
		
}).on("focus",function(){
	
	$("#mensaje_nombre_estado").fadeOut("slow");
})
	
$("#nombre_tabla").focus( function(){
	$("#mensaje_nombre_tabla").fadeOut("slow");
});


/**
 * dc 2019-04-15
 * desc: funcion para insertar estado 
 * @param event
 * @returns
 */
$("#frm_estados").on("submit",function(event){
	
	var estadoNombre = $("#nombre_estado").val();
	var estadoTabla = $("#nombre_tabla").val();
	var estadoId = $("#id_estado").val();
	
	if( estadoNombre.length == 0 ){
		$("#mensaje_nombre_estado").text("Ingrese un Nombre").fadeIn("slow");
		return false;
	}
	
	if( estadoTabla == 0 ){
		$("#mensaje_nombre_tabla").text("Ingrese un Nombre").fadeIn("slow");
		return false;
	}
	
	var parametros = {
			
			nombre_estado:estadoNombre,
			tabla_estado:estadoTabla,
			id_estado:estadoId
	}
	
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Estados&action=InsertEstado",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		if(datos.value == 1){
			
			swal({
        		  title: "Estados",
        		  text: "Estado Registrado Correctamente",
        		  icon: "success",
        		  button: "Aceptar",
        		});
		}
		
		if(datos.value == 0){
			
			swal({
        		  title: "Estados",
        		  text: "Estado Actualizado",
        		  icon: "success",
        		  button: "Aceptar",
        		});
		}
		
		$("#nombre_estado").val("");
		$("#nombre_tabla").val(0);
		$("#id_estado").val(0);
		
	}).fail(function(xhr,status,error){
	   var err = xhr.responseText
	   console.log(err)
    }).always(function(){
	   $("#divLoaderPage").removeClass("loader")
	   consultaEstados();
    })
	
	event.preventDefault();
})

/**
 * dc 2019-04-15
 * desc:funcion que consulta listado de estados
 * @param pagina
 * @returns
 */
function consultaEstados(pagina = 1){

   var buscador=$("#search_estados").val();
	   
	   var con_datos={
			   	peticion:'ajax',
				  page:pagina,				  
				  search: buscador
				  };
	   
	   $.ajax({
		   beforeSend : function(){$("#divLoaderPage").addClass("loader")},
		   url : "index.php?controller=Estados&action=consultaEstados",
		   type: 'POST',
		   data: con_datos
	   }).done(function(datos){
		   
		   $("#estados_registrados").html(datos);
		   
	   }).fail(function(xhr,status,error){
		   var err = xhr.responseText
		   console.log(err)
	   }).always(function(){
		   $("#divLoaderPage").removeClass("loader")
	   })
	   
}

/**
 * dc 2019-04-15
 * desc: lista tablas que hay en la BD
 * @returns
 */
function cargaTablaBd(){
	
	 $.ajax({
		   beforeSend : function(){},
		   url : "index.php?controller=Estados&action=cargaTablasBd",
		   type: 'POST',
		   dataType: "json",
		   data: null
	   }).done(function(datos){
		   
		   $("#nombre_tabla").empty();
		   $("#nombre_tabla").append("<option value='0' >--Seleccione--</option>");
		   $.each(datos.data, function(i, item) {
			    //console.log(item);
			    $("#nombre_tabla").append("<option value= " +item.table_name +" >" + item.table_name  + "</option>");
			});
         
	   }).fail(function(xhr,status,error){
		   console.log('revisar carga de Tablas')
		   $("#nombre_tabla").empty();
		   $("#nombre_tabla").append("<option value='0' >--Seleccione--</option>");
	   }).always(function(){
		  
	   })
	
}
/***
 * desc editar un estado 
 * dc 2019-04-15
 * @param id
 * @returns
 */
function editEstado(id){
	
	var tiempo = tiempo || 1000;
	
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Estados&action=editEstado",
		type:"POST",
		dataType:"json",
		data:{id_estado:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];
			
			$("#nombre_estado").val(array.nombre_estado);
			$("#nombre_tabla").val(array.tabla_estado);
			$("#id_estado").val(array.id_estado);
			
			$("html, body").animate({ scrollTop: $(nombre_estado).offset().top-120 }, tiempo);			
		}
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaEstados();
	})
	
	return false;
	
}

/***
 * desc: funcion para eliminar estados
 * dc 2019-04-15
 */
function delEstado(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Estados&action=delEstados",
		type:"POST",
		dataType:"json",
		data:{id_estado:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Estados",
		  		  text: "Estado eliminado",
		  		  icon: "success",
		  		  button: "Aceptar",
		  		});
					
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		swal({
	  		  title: "Estados",
	  		  text: "Error al eliminar estado",
	  		  icon: "error",
	  		  button: "Aceptar",
	  		});
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaEstados();
	})
	
	return false;
}