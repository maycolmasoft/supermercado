$(document).ready(function(){
	consultaEntidades();
})

$("#Guardar").on("click",function(event){
	
	let _ruc_entidades = document.getElementById('ruc_entidades').value;
	let _nombre_entidades = document.getElementById('nombre_entidades').value;
	let _telefono_entidades = document.getElementById('telefono_entidades').value;
	var _direccion_entidades = document.getElementById('direccion_entidades').value;
	var _ciudad_entidades = document.getElementById('ciudad_entidades').value;
	let _razon_social_entidades = document.getElementById('razon_social_entidades').value;
	let _contribuyente_especial_entidades = document.getElementById('contribuyente_especial_entidades').value;
	let _obligado_contabilidad_entidades = document.getElementById('obligado_contabilidad_entidades').value;
	var _id_entidades = document.getElementById('id_entidades').value;
	
	let $_ruc_entidades 	= $("#ruc_entidades"),
	$_nombre_entidades 	= $("#nombre_entidades"),
	$_telefono_entidades 	= $("#telefono_entidades"),
	$_direccion_entidades 	= $("#direccion_entidades"),
	$_ciudad_entidades 	= $("#ciudad_entidades"),
	$_razon_social_entidades 	= $("#razon_social_entidades"),
	$_contribuyente_especial_entidades 	= $("#contribuyente_especial_entidades"),
	$_obligado_contabilidad_entidades 	= $("#obligado_contabilidad_entidades");
	
	if($_ruc_entidades.val() == "" ){
		$_ruc_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_nombre_entidades.val() == "" ){
		$_nombre_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_telefono_entidades.val() == "" ){
		$_telefono_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_direccion_entidades.val() == "" ){
		$_direccion_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_razon_social_entidades.val() == "" ){
		$_razon_social_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_ciudad_entidades.val() == "" ){
		$_ciudad_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	if($_contribuyente_especial_entidades.val() == "" ){
		$_contribuyente_especial_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_obligado_contabilidad_entidades.val() == "" ){
		$_obligado_contabilidad_entidades.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	var parametros = {ruc_entidades:_ruc_entidades,
			nombre_entidades:_nombre_entidades,
			telefono_entidades:_telefono_entidades,
			direccion_entidades:_direccion_entidades,
			ciudad_entidades:_ciudad_entidades,
			razon_social_entidades:_razon_social_entidades,
			contribuyente_especial_entidades:_contribuyente_especial_entidades,
			obligado_contabilidad_entidades:_obligado_contabilidad_entidades,
			id_entidades:_id_entidades}
	
		
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=Entidades&action=InsertaEntidades",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Entidad Ingresada",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		
		consultaEntidades();
	})

	event.preventDefault()
})



function editEntidades(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Entidades&action=editEntidades",
		type:"POST",
		dataType:"json",
		data:{id_entidades:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];	
			
			$("#ruc_entidades").val(array.ruc_entidades);
			$("#nombre_entidades").val(array.nombre_entidades);
			$("#telefono_entidades").val(array.telefono_entidades);			
			$("#direccion_entidades").val(array.direccion_entidades);			
			$("#ciudad_entidades").val(array.ciudad_entidades);			
			$("#razon_social_entidades").val(array.razon_social_entidades);	
			$("#contribuyente_especial_entidades").val(array.contribuyente_especial_entidades);	
			$("#obligado_contabilidad_entidades").val(array.obligado_contabilidad_entidades);			
			$("#id_entidades").val(array.id_entidades);
			$("html, body").animate({ scrollTop: $(nombre_entidades).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaEntidades();
	})
	
	return false;
	
}

function delEntidades(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Entidades&action=delEntidades",
		type:"POST",
		dataType:"json",
		data:{id_entidades:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Entidades",
		  		  text: "Registro Eliminado",
		  		  icon: "success",
		  		  button: "Aceptar",
		  		});
					
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaEntidades();
	})
	
	return false;
}

function consultaEntidades(_page = 1){
	
	var buscador = $("#buscador").val();
	
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Entidades&action=consultaEntidades",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#entidades_registradas").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



