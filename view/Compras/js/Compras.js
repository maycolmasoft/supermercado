
 var $ddlProveedores = $("#id_proveedores");
     
$(document).ready( function (){
   
     CargarTipoComprobante();
	 CargarTipoPago();
  
			   $(".cantidades").inputmask();

			   $("#tblventas").on("click", ".mdbtnRemoveFila", function (event) {
					
					let id_distribucion	= $(this).closest("tr").attr('id').split('_')[1];
					let fila	= $(this).closest("tr");
					
					if( !isNaN( id_distribucion ) &&  id_distribucion > 0 ){		
						
						fila.remove();
						
					}else{
						fila.remove();  
					}
					
					let total_venta = totalizar_venta();
					let iva_venta = totalizar_iva();
					cambiar_valor_total( total_venta, iva_venta );
					
				});
				
				function formatState (state) {
					if (!state.id) {
					  return state.text;
					}
					var $state = $('<span>' + ' ' + state.text + '</span>');
					return $state;
				};


			   $ddlProveedores.select2({
					ajax: {
						url: 'index.php?controller=Compras&action=jsonget_proveedores',
						dataType: 'json',
						data: function (params) {
							var query = {
							  term: params.term,
							  type: 'public'
							}		  
							// Query parameters will be ?search=[term]&type=public
							return query;
						},
						processResults: function (data) {
							// Transforms the top-level key of the response object from 'items' to 'results'
							return {
							  results: data
							};
						},
					},
					templateResult: formatState,
					templateSelection: formatState
				});
				
				
				$("#tblventas").on("keyup", "input:text[name='mod_venta_cantidad']", function (event) {
					cambiar_valor_parcial( $(this) )
				});

});






function CargarTipoComprobante(){
		
	let $ddlPeriodo = $("#id_tipo_comprobante");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Compras&action=CargarTipoComprobante",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_tipo_comprobante +" >" + value.nombre_tipo_comprobante  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}




function CargarTipoPago(){
		
	let $ddlPeriodo = $("#id_tipo_pago");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Compras&action=CargarTipoPago",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_tipo_pago +" >" + value.nombre_tipo_pago  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}







function fnBeforeAction(mensaje){

	swal({
        title: "PROCESANDO",
        text: mensaje,
        icon: "view/images/ajax-loader.gif",        
      })
}


function RegistrarCompra(){
	
	
	let $id_proveedores  = $("#id_proveedores");
	let $id_tipo_comprobante  = $("#id_tipo_comprobante");
	let $fecha_compra_cabeza = $("#fecha_compra_cabeza");
	let $id_tipo_pago   = $("#id_tipo_pago");
	let $numero_comprobante_cabeza    = $("#numero_comprobante_cabeza");
	let $subtotal    = $("#txt-subtotal-punto-venta");
	let $iva    = $("#txt-iva-punto-venta");
	let $total    = $("#txt-total-punto-venta");
	
	
	var tiempo = tiempo || 1000;
	
	
	
	if ($id_proveedores.val() == 0){    

		$id_proveedores.notify("Seleccione Proveedor",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_proveedores).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_tipo_comprobante.val()== 0){    

		$id_tipo_comprobante.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_comprobante).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($fecha_compra_cabeza.val()== ""){    

		$fecha_compra_cabeza.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($fecha_compra_cabeza).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($id_tipo_pago.val()== 0){    

		$id_tipo_pago.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_pago).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($numero_comprobante_cabeza.val()== ""){    

		$numero_comprobante_cabeza.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($numero_comprobante_cabeza).offset().top-120 }, tiempo);
			
		return false;

	}
	
	
	var filas = $("#tblventas tbody tr");
	
	if( filas.length )
	{
		var data	= [];
		var boleanValidacion = 1;
		filas.each(function(){
			
			var _id_productos	= $(this).find("input:hidden[name='mod_venta_id_productos']").val(),
				_cantidad	= $(this).find("input:text[name='mod_venta_cantidad']").val(),
				_precio_unitario 	= $(this).find("input:text[name='mod_venta_punitario']").val(),
				_iva	= $(this).find("input:hidden[name='mod_venta_iva_valor']").val(),
				_total 	= $(this).find("input:text[name='mod_venta_ptotal']").val();

             // console.log(_id_productos +' '+ _cantidad +' '+ _precio_unitario +' '+ _iva +' '+ _total);

			item = {};
		
			if( !isNaN( _id_productos ) && !isNaN( _cantidad ) && !isNaN( decimal(_total) ) && !isNaN( decimal(_iva) ) )
			{
			
		        item ["id_productos"]		= _id_productos;
		        item ["cantidad"]	= _cantidad;
		        item ['precio_unitario']	= _precio_unitario;
				item ["iva"]	= _iva;
		        item ['total']	= _total;
		        
		        data.push(item);
			}else
			{			
				boleanValidacion = 0; return false;
			}
		})
		
		if( !boleanValidacion )
		{
			filas.closest('table').notify("Datos Ingresados no Validos. Revisar valores",{ position:"top center"});
			return false;					
		}
		sdata 	= JSON.stringify(data); 
		
	}else{
		
		$("#tblventas").notify("Ingrese Productos",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $("#tblventas").offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	var sdata 	= JSON.stringify(data); 
	
	var parametros = new FormData();
	
	parametros.append('lista_productos', sdata);
	parametros.append('id_proveedores',$id_proveedores.val()); 
	parametros.append('id_tipo_comprobante',$id_tipo_comprobante.val());
	parametros.append('fecha_compra_cabeza',$fecha_compra_cabeza.val());
	parametros.append('id_tipo_pago',$id_tipo_pago.val());
	parametros.append('numero_comprobante_cabeza',$numero_comprobante_cabeza.val());
	
	parametros.append('subtotal',$subtotal.val());
	parametros.append('iva',$iva.val());
	parametros.append('total',$total.val());
	
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Compras&action=RegistrarCompra",
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



function cleanInputs(){
	
	            
				$("#tblventas tbody").html(''); 
				
				let $ddlPeriodo = $("#id_proveedores");
				$ddlPeriodo.empty();
		        $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
				
				$('#id_proveedores').val("0");
				$('#id_tipo_comprobante').val("0");
				$('#fecha_compra_cabeza').val("");
				$('#id_tipo_pago').val("0");
				$('#numero_comprobante_cabeza').val("");
				
				$("#txt-subtotal-punto-venta").val(  decimal(0.00));
				$("#txt-iva-punto-venta").val( decimal(0.00));
				$("#txt-total-punto-venta").val( decimal(0.00));
				$("#total_factura").html( decimal(0.00));
				
				
			
}



$("#codigo_productos").on("focus",function(e) {
	
	let _elemento = $(this);
	
    if ( !_elemento.data("autocomplete") ) {
    	    	
    	_elemento.autocomplete({
    		minLength: 2,    	    
    		source:function (request, response) {
    			$.ajax({
    				url:"index.php?controller=Compras&action=autompleteProductos",
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
					let fila	= devuelveHtmlFila( ui.item.nombre, cantidadtabla, ui.item.precio, ui.item.id, ui.item.iva, ui.item.total, ui.item.valor_iva);
					agrega_fila_tabla_ventas( fila, 1); 
				}else{
					
					$.each( $("#tblventas").find('tbody tr'), function(i,v){
						let element = $(this);
						let fila = element.find("input:hidden[name='mod_venta_id_productos']");
						
						
						
						if( fila.val() == ui.item.id ){							
						
						
							if(element.find("input:text[name='mod_venta_cantidad']").length ){
								let total = ui.item.total * cantidadtabla;
								let iva = ui.item.valor_iva * cantidadtabla;
								console.log( 'total --> ' + total + ' * ' + cantidadtabla);
								element.find("input:text[name='mod_venta_cantidad']").val( cantidadtabla ); 
								element.find("input:hidden[name='mod_venta_iva_valor']").val( iva ); 
								element.find("input:text[name='mod_venta_ptotal']").val( total );
							}
						}
					});
				}				 
    			    			    			
    			$("#hdn_productos").val( ui.item.id );
				let total_venta = totalizar_venta();
				let iva_venta = totalizar_iva();
				cambiar_valor_total( total_venta, iva_venta );
    			   	     
     	    },
     	   appendTo: "",
     	   change: function(event,ui){
     		   
     		   	if( ui.item == null ){
     				_elemento.val('');
     			 	$("#hdn_productos").val( 0 );
     			 
     		   }else{
				   
				   $("#codigo_productos").val("");
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

var cambiar_valor_parcial = function( pelement ){

	if (pelement.length == 0) return false;

	let fila = pelement.closest('tr');
	let fidentificador = fila.find("input:hidden[name='mod_venta_id_productos']").val();
	let fcantidad = fila.find("input:text[name='mod_venta_cantidad']").val();

	$.ajax({
		url:"index.php?controller=Compras&action=actualizarCantidad",
		dataType:"json",
		type:"POST",
		data:{ 'identificador': fidentificador,'cantidad': fcantidad},
		beforeSend: function(){ loading_fila( pelement ) },
		complete: function(){ unloading_fila( pelement ) }
	}).done(function(x){
		
		if( x.estatus != undefined && x.estatus == "OK"){

			let detalle = x.data[0];

			fila.find("input:text[name='mod_venta_cantidad']").val( fcantidad ); 
			fila.find("input:text[name='mod_venta_punitario']").val( decimal(detalle.precio) );
			fila.find("input:text[name='mod_venta_iva']").val( detalle.iva ); 
			fila.find("input:hidden[name='mod_venta_iva_valor']").val( decimal(detalle.valor_iva) ); 
			fila.find("input:text[name='mod_venta_ptotal']").val( decimal(detalle.total) );

			let total_venta = totalizar_venta();
			let iva_venta = totalizar_iva();
			cambiar_valor_total( total_venta, iva_venta);
			
		}else{
			//poner en cero o dejar como esta
		}
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
	})
		
}


var totalizar_venta	= function(){
	let suma = 0;
	$.each( $("#tblventas tbody").find('tr'), function(i,v){ 
		let fila = $(this);
		let columna = fila.find('td:eq(4)');
		let element = columna.find("input:text[name='mod_venta_ptotal']");		
		if( element.length > 0 ){
			suma += ( isNaN( element.val() ) ) ? 0 : parseFloat( element.val() );
		}else{
			suma	+= 0;
		}
	});

	return suma;
}



var totalizar_iva	= function(){
	let suma = 0;
	$.each( $("#tblventas tbody").find('tr'), function(i,v){ 
		let fila = $(this);
		let columna = fila.find('td:eq(3)');
		let element = columna.find("input:hidden[name='mod_venta_iva_valor']");		
		if( element.length > 0 ){
			suma += ( isNaN( element.val() ) ) ? 0 : parseFloat( element.val() );
		}else{
			suma	+= 0;
		}
	});

	return suma;
}


var cambiar_valor_total	= function( pvalor, piva ){

  

	$("#txt-subtotal-punto-venta").val(  decimal(pvalor));
	$("#txt-iva-punto-venta").val( decimal(piva));
	$("#txt-total-punto-venta").val( decimal(pvalor+piva));
	$("#total_factura").html( decimal(pvalor+piva));
	
}

function decimal(x) {
  return Number.parseFloat(x).toFixed(2);
}


var loading_fila	= function( pelement ){

	let fila = pelement.closest('tr');
	fila.append( $('<div>').prop({className: 'imgtr'}).html( '<img src="view/images/ajax-loader.gif" alt="loading" />') );
	let imagen = fila.find('div.imgtr').position({
		of: fila,
		my: 'left top',
		at: 'left top',
		offset: '50 50'
	  });
	  
}

var unloading_fila	= function( pelement ){

	let fila = pelement.closest('tr');
	fila.find('div.imgtr').remove();

}

var devuelveHtmlFila	= function(p_nombre = '', p_cantidad = 0,  p_precio_unitario = 0, p_id_productos = 0, p_iva = 0, p_total = 0,  p_valor_iva=0){
	
	let cols = "";
    
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" class="form-control input-sm pventa" name="mod_venta_nombre" value="'+ p_nombre +'" disabled>';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" class="form-control input-sm" name="mod_venta_cantidad" value="'+ p_cantidad +'">';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" style="border: 0;" class="form-control input-sm" value="'+ decimal(p_precio_unitario) +'" name="mod_venta_punitario" disabled>';
    cols += '<input type="hidden" name="mod_venta_id_productos" value="'+ p_id_productos +'" >';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" style="border: 0;" class="form-control input-sm" value="'+ p_iva +'" name="mod_venta_iva" disabled>';
	 cols += '<input type="hidden" name="mod_venta_iva_valor" value="'+ decimal(p_valor_iva) +'" >';
    cols += '</td>';
    cols += '<td style="font-size: 12px;">';
    cols += '<input type="text" class="form-control input-sm text-right " name="mod_venta_ptotal" value="'+ decimal(p_total) +'" disabled>';
    cols += '</td>';
    cols += '<td><button type="button" class="mdbtnRemoveFila form-control btn btn-sm "  value=""><i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i></button></td>';
    
    return cols;
}
		


		   