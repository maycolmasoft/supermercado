$(document).ready(function(){
	
	consultaInverEmisores();
	
})

$("#Guardar").on("click",function(event){
	
	let _ruc_emisores = document.getElementById('ruc_emisores').value;
	let _nombre_emisores = document.getElementById('nombre_emisores').value;
	var _id_emisores = document.getElementById('id_emisores').value;
	
	let $_ruc_emisores 	= $("#ruc_emisores"),
	$_nombre_emisores 	= $("#nombre_emisores");
	
	if($_ruc_emisores.val() == "" ){
		$_ruc_emisores.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	if($_nombre_emisores.val() == "" ){
		$_nombre_emisores.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		return false;
	}
	
	var parametros = {ruc_emisores:_ruc_emisores,
			nombre_emisores:_nombre_emisores,
			id_emisores:_id_emisores}
	
		
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=InverEmisores&action=InsertaInverEmisores",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Registro Ingresado",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		
		consultaInverEmisores();
		
	})

	event.preventDefault()
})


function editInverEmisores(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=InverEmisores&action=editInverEmisores",
		type:"POST",
		dataType:"json",
		data:{id_emisores:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];	
			
			$("#ruc_emisores").val(array.ruc_emisores);
			$("#nombre_emisores").val(array.nombre_emisores);
			$("#id_emisores").val(array.id_emisores);
			$("html, body").animate({ scrollTop: $(nombre_emisores).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaInverEmisores();
	})
	
	return false;
	
}

function delInverEmisores(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=InverEmisores&action=delInverEmisores",
		type:"POST",
		dataType:"json",
		data:{id_emisores:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Formulario",
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
		consultaInverEmisores();
	})
	
	return false;
}

function consultaInverEmisores(_page = 1){
	
	var buscador = $("#buscador").val();
	
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=InverEmisores&action=consultaInverEmisores",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#inver_emisores_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



