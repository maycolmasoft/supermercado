
     
$(document).ready( function (){
   init_controles();
   CargarTipoProductos();
   CargarPresentacion();
   CargarEstado();
   CargarIva();
   Load_Productos();
   inicia_tabla_ventas();
   $(".cantidades").inputmask();

   $("#tblventas").on("click", ".mdbtnRemoveFila", function (event) {
		
	let id_distribucion	= $(this).closest("tr").attr('id').split('_')[1];
	let fila	= $(this).closest("tr");
	
	if( !isNaN( id_distribucion ) &&  id_distribucion > 0 ){		
		
		fila.remove();
		
	}else{
		fila.remove();  
	}
	
	
});

});

$("#btn-buscar-cliente").on('click', function(){

	$.ajax({
		url:"index.php?controller=PuntoVentas&action=jsonget_cliente",
		dataType:'json',
		type:"POST",
		data:{ 'cedula': $("#txt-cliente-busqueda").val() }
	}).done( function(x){

		if( x.estatus != undefined && x.estatus == 'OK' ){
			$("#dv-datos-cliente").html('');			
			let data	= x.data[0];
			$("#hdn_id_cliente").val( data.id_clientes);
			let tagcliente = $('<ul>');
			tagcliente.append( '<li>'+data.nombre_tipo_identificacion+' : '+data.identificacion_clientes+'</li>' );	
			tagcliente.append( '<li> RAZON SOCIAL : '+data.razon_social_clientes+'</li>' );	
			tagcliente.append( '<li> DIRECCION : '+data.direccion_clientes+'</li>' );
			tagcliente.append( '<li> CELULAR : '+data.celular_clientes+'</li>' );
			tagcliente.append( '<li> CORREO : '+data.correo_clientes+'</li>' );	

			$("#dv-datos-cliente").html(tagcliente);
		}else{
			swal({
				title: "MENSAJE",
				text: "cliente no registrado",
				icon: "warning",        
			  })
		} 

		/*select  
	aa.id_clientes
	, aa.razon_social_clientes
	, aa.identificacion_clientes
	, aa.direccion_clientes
	, aa.celular_clientes
	, aa.correo_clientes
	, bb.nombre_tipo_identificacion
from clientes aa
inner join tipo_identificacion bb on bb.id_tipo_identificacion = aa.id_tipo_identificacion
where 1 = 1
and aa.identificacion_clientes = '1750402859'*/

	}).fail( function(xhr,error,status){
		console.log( xhr.responseText );
	})
});




function CargarTipoProductos(){
		
	let $ddlPeriodo = $("#id_tipo_productos");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Productos&action=CargarTipoProductos",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_tipo_productos +" >" + value.nombre_tipo_productos  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}




function CargarMarca(id_tipo_productos){
      
	  let $ddlPeriodoEleccion = $("#id_marca_productos");
      
      $.ajax({
            beforeSend:function(){},
            url:"index.php?controller=Productos&action=CargarMarca",
            type:"POST",
            dataType:"json",
			async: false,
            data:{id_tipo_productos:id_tipo_productos}
      }).done(function(datos){           
            
    	  $ddlPeriodoEleccion.empty();
    	  $ddlPeriodoEleccion.append("<option value='0' >--Seleccione--</option>");
            
            $.each(datos.data, function(index, value) {
            	$ddlPeriodoEleccion.append("<option value= " +value.id_marca_productos +" >" + value.nombre_marca_productos  + "</option>");     
            });
            
      }).fail(function(xhr,status,error){
            var err = xhr.responseText
            console.log(err)
            $ddlPeriodoEleccion.empty();
            $ddlPeriodoEleccion.append("<option value='0' >--Seleccione--</option>");
            
      })
      
}


function CargarPresentacion(){
		
	let $ddlPeriodo = $("#id_presentacion_productos");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Productos&action=CargarPresentacion",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_presentacion_productos +" >" + value.nombre_presentacion_productos  + "</option>"); 
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
		  url:"index.php?controller=Productos&action=CargarEstado",
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


function CargarIva(){
		
	let $ddlPeriodo = $("#id_iva");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Productos&action=CargarIva",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  //$ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_iva +" >" + value.nombre_iva  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}



$("#id_tipo_productos").change(function() {
      
	 var id_tipo_productos = $(this).val();
	  let $ddlPeriodoEleccion = $("#id_marca_productos");
	  $ddlPeriodoEleccion.empty();
	  $ddlPeriodoEleccion.append("<option value='0' >--Seleccione--</option>");
	  CargarMarca(id_tipo_productos);

 });


function init_controles(){
	try {
		
		 $("#imagen_productos").fileinput({			
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


function RegistrarProductos(){
	
	
	let $id_productos  = $("#id_productos");
	let $codigo_productos  = $("#codigo_productos");
	let $nombre_productos = $("#nombre_productos");
	let $stock_productos   = $("#stock_productos");
	let $precio_compra_productos    = $("#precio_compra_productos");
	let $precio_venta_productos     = $("#precio_venta_productos");
	let $precio_venta_mayoreo_productos  = $("#precio_venta_mayoreo_productos");
	let $stock_min_venta_mayoreo_productos = $("#stock_min_venta_mayoreo_productos");
	let $id_tipo_productos           = $("#id_tipo_productos");
	let $id_marca_productos           = $("#id_marca_productos");
	let $id_presentacion_productos           = $("#id_presentacion_productos");
	let $id_iva           = $("#id_iva");
	let $id_estado           = $("#id_estado");
	let $perecedero_productos           = $("#perecedero_productos");
	let $inventariable_productos           = $("#inventariable_productos");
	
	var tiempo = tiempo || 1000;
	
	
	
	if ($id_productos.val() == ""){    

		$codigo_productos.notify("Error Vuelva a Intentarlo",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($codigo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($codigo_productos.val()== ""){    

		$codigo_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($codigo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($nombre_productos.val()== ""){    

		$nombre_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($nombre_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($stock_productos.val() == ""){    

		$stock_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($stock_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($stock_productos.val() < 0 ){    

		$stock_productos.notify("Valor debe ser mayor o igual a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($stock_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	
	if ($precio_compra_productos.val() == ""){    

		$precio_compra_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($precio_compra_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($precio_compra_productos.val() <= 0 ){    

		$precio_compra_productos.notify("Valor debe ser mayor a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($precio_compra_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($precio_venta_productos.val() == ""){    

		$precio_venta_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($precio_venta_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($precio_venta_productos.val() <= 0 ){    

		$precio_venta_productos.notify("Valor debe ser mayor a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($precio_venta_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($precio_venta_mayoreo_productos.val() == ""){    

		$precio_venta_mayoreo_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($precio_venta_mayoreo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($precio_venta_mayoreo_productos.val() <= 0 ){    

		$precio_venta_mayoreo_productos.notify("Valor debe ser mayor a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($precio_venta_mayoreo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($stock_min_venta_mayoreo_productos.val() == ""){    

		$stock_min_venta_mayoreo_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($stock_min_venta_mayoreo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($stock_min_venta_mayoreo_productos.val() <= 0 ){    

		$stock_min_venta_mayoreo_productos.notify("Valor debe ser mayor a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($stock_min_venta_mayoreo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_tipo_productos.val() == 0 ){    

		$id_tipo_productos.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_marca_productos.val() == 0 ){    

		$id_marca_productos.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_marca_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_presentacion_productos.val() == 0 ){    

		$id_presentacion_productos.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_presentacion_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_iva.val() == 0 ){    

		$id_iva.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_iva).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_estado.val() == 0 ){    

		$id_estado.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_estado).offset().top-120 }, tiempo);
			
		return false;

	}
	
	
	var parametros = new FormData();
	
	parametros.append('id_productos',$id_productos.val()); 
	parametros.append('codigo_productos',$codigo_productos.val());
	parametros.append('nombre_productos',$nombre_productos.val());
	
	parametros.append('stock_productos',$stock_productos.val()); 
	parametros.append('precio_compra_productos',$precio_compra_productos.val());
	parametros.append('precio_venta_productos',$precio_venta_productos.val());
	
	parametros.append('precio_venta_mayoreo_productos',$precio_venta_mayoreo_productos.val()); 
	parametros.append('stock_min_venta_mayoreo_productos',$stock_min_venta_mayoreo_productos.val());
	parametros.append('id_tipo_productos',$id_tipo_productos.val());
	
	parametros.append('id_marca_productos',$id_marca_productos.val());
	parametros.append('id_presentacion_productos',$id_presentacion_productos.val());
	parametros.append('id_iva',$id_iva.val());
	parametros.append('id_estado',$id_estado.val());
	parametros.append('perecedero_productos',$perecedero_productos.val());
	parametros.append('inventariable_productos',$inventariable_productos.val());
    parametros.append('imagen_productos', $('#imagen_productos')[0].files[0]); 
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Productos&action=RegistrarProductos",
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
			
			Load_Productos();
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
	
	var id_productos	= $link.data("id_productos");
		
	if( id_productos <= 0 || id_productos == "" || id_productos == undefined ){
		return false;
	}	
		
		
		
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Productos&action=DataEditar",
		type:"POST",
		dataType:"json",
		data:{id_productos:id_productos}
	}).done(function(datos){
		swal.close();
		
		$.each(datos.data, function(index, value) {
         	
				$('#id_productos').val(value.id_productos);
				$('#nombre_productos').val(value.nombre_productos);
				$('#codigo_productos').val(value.codigo_productos);
				$('#stock_productos').val(value.stock_productos);
				$('#precio_compra_productos').val(value.precio_compra_productos);
				$('#precio_venta_productos').val(value.precio_venta_productos);
				$('#precio_venta_mayoreo_productos').val(value.precio_venta_mayoreo_productos);
				$('#stock_min_venta_mayoreo_productos').val(value.stock_min_venta_mayoreo_productos);
			    
				CargarMarca(value.id_tipo_productos);
				
				$('#id_tipo_productos').val(value.id_tipo_productos);
				
				$('#id_marca_productos').val(value.id_marca_productos);
				$('#id_presentacion_productos').val(value.id_presentacion_productos);
				$('#id_estado').val(value.id_estado);
				$('#id_iva').val(value.id_iva);
				
				if(value.perecedero_productos=='t'){
					
					$('#perecedero_productos').val('TRUE');
				}else{
					$('#perecedero_productos').val('FALSE');
					
				}
				
				if(value.inventariable_productos=='t'){
					
					$('#inventariable_productos').val('TRUE');
				}else{
					$('#inventariable_productos').val('FALSE');
					
				}
				
				$('#stock_productos').attr('disabled', true);
			
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
		
		       $('#id_productos').val("0");
				$('#nombre_productos').val("");
				$('#codigo_productos').val("");
				$('#stock_productos').val("0.00");
				$('#precio_compra_productos').val("0.00");
				$('#precio_venta_productos').val("0.00");
				$('#precio_venta_mayoreo_productos').val("0.00");
				$('#stock_min_venta_mayoreo_productos').val("0.00");
				$('#id_tipo_productos').val("0");
				$('#id_marca_productos').val("0");
				$('#id_presentacion_productos').val("0");
				$('#id_estado').val("1");
				$('#id_iva').val("1");
				$('#perecedero_productos').val("FALSE");
				$('#inventariable_productos').val("TRUE");
				$("#imagen_productos").fileinput('clear');
				
				$('#stock_productos').attr('disabled', false);
		
	}).always(function(){
		
	})	
	
}
	

var eliminar = function(a){
	
	
	var element = $(a);
	let $link = $(a);	
	var id_productos	= $link.data("id_productos");
	
	if( id_productos <= 0 || id_productos == "" || id_productos == undefined ){
		return false;
	}	
	
	swal({title:"NOTIFICACIÓN",text:"Esta seguro de eliminar el producto",icon:"info",buttons: true,
		  closeOnClickOutside: false,
		  closeOnEsc: false})
	.then((isConfirm) => {
		if (isConfirm)
		{
				$.ajax({
					beforeSend:fnBeforeAction('Estamos procesado la información'),
					url:"index.php?controller=Productos&action=DataEliminar",
					type:"POST",
					dataType:"json",
					data:{id_productos:id_productos}
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
					
							$('#id_productos').val("0");
							$('#nombre_productos').val("");
							$('#codigo_productos').val("");
							$('#stock_productos').val("0.00");
							$('#precio_compra_productos').val("0.00");
							$('#precio_venta_productos').val("0.00");
							$('#precio_venta_mayoreo_productos').val("0.00");
							$('#stock_min_venta_mayoreo_productos').val("0.00");
							$('#id_tipo_productos').val("0");
							$('#id_marca_productos').val("0");
							$('#id_presentacion_productos').val("0");
							$('#id_estado').val("1");
							$('#id_iva').val("1");
							$('#perecedero_productos').val("FALSE");
							$('#inventariable_productos').val("TRUE");
							$("#imagen_productos").fileinput('clear');
							$('#stock_productos').attr('disabled', false);
					
				}).always(function(){
					Load_Productos();
					$('#stock_productos').attr('disabled', false);
				})	
		   
		}
	});
		
	
}


function cleanInputs(){
	
	            
				$('#id_productos').val("0");
				$('#nombre_productos').val("");
				$('#codigo_productos').val("");
				$('#stock_productos').val("0.00");
				$('#precio_compra_productos').val("0.00");
				$('#precio_venta_productos').val("0.00");
				$('#precio_venta_mayoreo_productos').val("0.00");
				$('#stock_min_venta_mayoreo_productos').val("0.00");
				$('#id_tipo_productos').val("0");
				$('#id_marca_productos').val("0");
				$('#id_presentacion_productos').val("0");
				$('#id_estado').val("1");
				$('#id_iva').val("1");
				$('#perecedero_productos').val("FALSE");
				$('#inventariable_productos').val("TRUE");
				$("#imagen_productos").fileinput('clear');
				
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


var Load_Productos	= function(){
	
	var dataSend = { 'input_search': viewTabla.txt_busqueda.val()};
	
	viewTabla.tabla	=  $( '#'+viewTabla.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Productos&action=dtMostrar_Productos',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
	    'order': [[ 0, "asc" ]],
	    'columns': [	    	    
	    	
	    	{ data: 'codigo_productos'},
    		{ data: 'nombre_productos'},
    		{ data: 'nombre_marca_productos' },
    		{ data: 'nombre_presentacion_productos'},
    		{ data: 'stock_min_venta_mayoreo_productos' },
    		{ data: 'stock_productos' },
    		{ data: 'precio_compra_productos'},
			{ data: 'precio_venta_productos'},
    		{ data: 'precio_venta_mayoreo_productos' },
			{ data: 'nombre_estado' },
    		{ data: 'opciones', orderable: false }
    		    		
						
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 10 ] }
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
             {extend: 'excel', title: 'Lista Productos'},
             {extend: 'pdf', title: 'Lista Productos'},

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

	if($("#id_productos").val() > 0){
		
	}else{

		$( "#codigo_productos" ).autocomplete({
			source: "index.php?controller=Productos&action=AutocompleteCodigo",
			minLength: 4
		});

		$("#codigo_productos").focusout(function(){
			$.ajax({
				url:'index.php?controller=Productos&action=AutocompleteDevuelveDatos',
				type:'POST',
				dataType:'json',
				data:{codigo_productos:$('#codigo_productos').val()}
			}).done(function(respuesta){

				$('#id_productos').val(respuesta.id_productos);
				$('#nombre_productos').val(respuesta.nombre_productos);
				$('#codigo_productos').val(respuesta.codigo_productos);
				$('#stock_productos').val(respuesta.stock_productos);
				$('#precio_compra_productos').val(respuesta.precio_compra_productos);
				$('#precio_venta_productos').val(respuesta.precio_venta_productos);
				$('#precio_venta_mayoreo_productos').val(respuesta.precio_venta_mayoreo_productos);
				$('#stock_min_venta_mayoreo_productos').val(respuesta.stock_min_venta_mayoreo_productos);
				CargarMarca(respuesta.id_tipo_productos);
				$('#id_tipo_productos').val(respuesta.id_tipo_productos);
				$('#id_marca_productos').val(respuesta.id_marca_productos);
				$('#id_presentacion_productos').val(respuesta.id_presentacion_productos);
				$('#id_estado').val(respuesta.id_estado);
				$('#id_iva').val(respuesta.id_iva);
				$('#perecedero_productos').val(respuesta.perecedero_productos);
				$('#inventariable_productos').val(respuesta.inventariable_productos);
				
				
				$('#stock_productos').attr('disabled', true);
				
				
			
			}).fail(function(respuesta) {

                $('#id_productos').val("0");
				$('#nombre_productos').val("");
				$('#stock_productos').val("0.00");
				$('#precio_compra_productos').val("0.00");
				$('#precio_venta_productos').val("0.00");
				$('#precio_venta_mayoreo_productos').val("0.00");
				$('#stock_min_venta_mayoreo_productos').val("0.00");
				$('#id_tipo_productos').val("0");
				$('#id_marca_productos').val("0");
				$('#id_presentacion_productos').val("0");
				$('#id_estado').val("1");
				$('#id_iva').val("1");
				$('#perecedero_productos').val("FALSE");
				$('#inventariable_productos').val("TRUE");
			    $("#imagen_productos").fileinput('clear');
				
				$('#stock_productos').attr('disabled', false);
				
			  });
			 
			
		});  
	}
});		


$("#codigo_productos").on("focus",function(e) {
	
	let _elemento = $(this);
	
    if ( !_elemento.data("autocomplete") ) {
    	    	
    	_elemento.autocomplete({
    		minLength: 2,    	    
    		source:function (request, response) {
    			$.ajax({
    				url:"index.php?controller=PuntoVentas&action=autompleteProductos",
    				dataType:"json",
    				type:"GET",
    				data:{term:request.term},
    			}).done(function(x){
    				
    				response(x); 
    				
    			}).fail(function(xhr,status,error){
    				var err = xhr.responseText
    				console.log(err)
    			})
    		},
    		select: function (event, ui) {
     	       	// Set selection
    			
    			if(ui.item.id == ''){
    				 _elemento.notify("Producto no Encontrado",{ position:"top center"});    				 
    				 return;
    			}

				let cantidadtabla = 0;
				let nuevo = 1; //1--si 0--no

				$.each( $("#tblventas").find('tbody tr'), function(i,v){
					let element = $(this);
					let fila = element.find("input:hidden[name='mod_venta_id_productos']");
					if( fila.val() == ui.item.id ){
						nuevo = 0;
						cantidadtabla = element.find("input:text[name='mod_venta_cantidad']").length ? element.find("input:text[name='mod_venta_cantidad']").val() : 0;
					}else{
						nuevo = 1;
					}
				});

				cantidadtabla++;

				if( nuevo == 1 ){
					let fila	= devuelveHtmlFila( ui.item.nombre, cantidadtabla, 15.5, ui.item.id, 0.87, 16.37);
					agrega_fila_tabla_ventas( fila, 1); 
				}else{
					$.each( $("#tblventas").find('tbody tr'), function(i,v){
						let element = $(this);
						let fila = element.find("input:hidden[name='mod_venta_id_productos']");
						if( fila.val() == ui.item.id ){
							if(element.find("input:text[name='mod_venta_cantidad']").length ){
								element.find("input:text[name='mod_venta_cantidad']").val( cantidadtabla );
							}
						}
					});
				}				 
    			    			    			
    			$("#hdn_productos").val( ui.item.id );
    			     	     
     	    },
     	   appendTo: "",
     	   change: function(event,ui){
     		   
     		   	if( ui.item == null ){
     			   
     				_elemento.notify("Producto no Encontrado",{ position:"top center"});
     				_elemento.val('');
     			 	$("#hdn_productos").val( 0 );
     			 
     		   }
     	   }
    	
    	})
    }
    
})

var agrega_fila_tabla_ventas	= function( pfila = "", pidentificador = 0 ){
	
	let newRow = $('<tr id="tr_'+pidentificador+'">');
    let columnas	= pfila;
    newRow.append(columnas);    
    $("#tblventas tbody").append(newRow);    
	
}

var inicia_tabla_ventas	= function(  ){
	
	let newRow = $('<tr id="tr_0">');
    let columnas	= devuelveHtmlFila('', 0, 0, 0, 0,0);
    newRow.append(columnas);    
    $("#tblventas tbody").append(newRow);    
	
}

var devuelveHtmlFila	= function(p_nombre = '', p_cantidad = 0,  p_precio_unitario = 0, p_id_productos = 0, p_iva = 0, p_total = 0 ){
	
	let cols = "";
    
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" class="form-control input-sm pventa" name="mod_venta_nombre" value="'+ p_nombre +'">';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" class="form-control input-sm p_cantidad p_cantidad_autocomplete" name="mod_venta_cantidad" value="'+ p_cantidad +'">';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" style="border: 0;" class="form-control input-sm" value="'+ p_precio_unitario +'" name="mod_venta_punitario">';
    cols += '<input type="hidden" name="mod_venta_id_productos" value="'+ p_id_productos +'" >';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    //cols += devuelveHtmlSelectMdDistribucion( p_tipo );
	cols += '<input type="text" style="border: 0;" class="form-control input-sm" value="'+ p_iva +'" name="mod_venta_iva">';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="number" class="form-control input-sm text-right " name="mod_venta_ptotal" value="'+ p_total +'">';
    cols += '</td>';
    cols += '<td><input type="button" class="mdbtnRemoveFila form-control btn btn-sm btn-danger "  value="Delete"></td>';
    
    return cols;
}
		


		   