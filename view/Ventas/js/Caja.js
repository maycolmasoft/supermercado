var total=0.00;

     
$(document).ready( function (){
   VerificarCaja();
   CargarTipoTransaccion();
   dtMostrar_Detalle();
   dtMostrar_Resumen();
   $(".cantidades").inputmask();
});




function CargarTipoTransaccion(){
		
	let $ddlPeriodo = $("#id_tipo_transaccion");
	
	$.ajax({
		  beforeSend:function(){},
		  url:"index.php?controller=Caja&action=CargarTipoTransaccion",
		  type:"POST",
		  dataType:"json",
		  data:null
	}).done(function(datos){           
		
	  $ddlPeriodo.empty();
	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
		  $.each(datos.data, function(index, value) {
			$ddlPeriodo.append("<option value= " +value.id_tipo_transaccion +" >" + value.nombre_tipo_transaccion  + "</option>"); 
		  });
		  
	}).fail(function(xhr,status,error){
		  var err = xhr.responseText
		  console.log(err)
		  $ddlPeriodo.empty();
		  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
		  
	})
   
}

<<<<<<< Updated upstream


=======
>>>>>>> Stashed changes
$("#movimiento").change(function() {
      
	 var movimiento = $(this).val();
	  
	  if(movimiento==1){
		  
		  $('#monto_caja').val("0.00");
		  $('#monto_caja').attr('disabled', false);
		  
	  }else if(movimiento==2){
		  $('#monto_caja').val("0.00");
		  $('#monto_caja').val(total);
		  $('#monto_caja').attr('disabled', true);
	  }else{
		  
		  $('#monto_caja').val("0.00");
		  $('#monto_caja').attr('disabled', false);
	  }
 });


function VerificarCaja(){

    var fechaActual = "";

	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=Caja&action=VerificarCaja",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.fechaActual)){
			
			var array = datos.fechaActual[0];		
			
		    fechaActual = array.fecha;
		}
		
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			
			if (array.id==1){
			
				$("#verificar").html("Fecha de Caja: "+fechaActual+" - <span class='badge bg-green' style='font-size: 12px;'>ABIERTA</span>");	
				$("#div_agregar_movimientos").fadeIn("slow");
				
				
			}else if (array.id==2){
				
				$("#verificar").html("Fecha de Caja: "+fechaActual+" - <span class='badge bg-red' style='font-size: 12px;'>CERRADA</span>");
				$("#div_agregar_movimientos").fadeOut("slow");
				
			}else{
				
				$("#verificar").html("Fecha de Caja: "+fechaActual+" - <span class='badge bg-yellow' style='font-size: 12px;'>SIN APERTURAR</span>");
				$("#div_agregar_movimientos").fadeOut("slow");
			}
			
		}
		
        
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
	})
	
}


function fnBeforeAction(mensaje){

	swal({
        title: "PROCESANDO",
        text: mensaje,
        icon: "view/images/ajax-loader.gif",        
      })
}


function RegistrarCaja(){
	
	
	let $movimiento  = $("#movimiento");
	let $monto_caja  = $("#monto_caja");
	
	var tiempo = tiempo || 1000;
	
	
	
	if ($movimiento.val() == 0){    

		$movimiento.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($movimiento).offset().top-120 }, tiempo);
			
		return false;

	}
		
	if ($monto_caja.val() == ""){    

		$monto_caja.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($monto_caja).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($monto_caja.val() <= 0 ){    

		$monto_caja.notify("Valor debe ser mayor o igual a 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($monto_caja).offset().top-120 }, tiempo);
			
		return false;

	}
	
	
	
	var parametros = new FormData();
	
	parametros.append('movimiento',$movimiento.val()); 
	parametros.append('monto_caja',$monto_caja.val());
	
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Caja&action=RegistrarCaja",
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
			VerificarCaja();
			dtMostrar_Detalle();
			dtMostrar_Resumen();
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
	            
				$('#movimiento').val("0");
				$('#monto_caja').val("0.00");
				
}

function cleanInputsDetalle(){
	            
				$('#id_tipo_transaccion').val("0");
				$('#valor_transaccion').val("0.00");
				$('#descripcion_transaccion').val("");
				
}	
	
	

function Agregar(){
	
	
	let $id_tipo_transaccion  = $("#id_tipo_transaccion");
	let $valor_transaccion  = $("#valor_transaccion");
	let $descripcion_transaccion  = $("#descripcion_transaccion");
	
	var tiempo = tiempo || 1000;
	
	
	
	if ($id_tipo_transaccion.val() == 0){    

		$id_tipo_transaccion.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_transaccion).offset().top-120 }, tiempo);
			
		return false;

	}
		
		
	if ($valor_transaccion.val() == ""){    

		$valor_transaccion.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($valor_transaccion).offset().top-120 }, tiempo);
			
		return false;

	}
	
	if ($valor_transaccion.val() == 0 ){    

		$valor_transaccion.notify("Valor debe ser diferente de 0",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($valor_transaccion).offset().top-120 }, tiempo);
			
		return false;

	}
		
	if($id_tipo_transaccion.val() == 6 || $id_tipo_transaccion.val() == 7 || $id_tipo_transaccion.val() == 10){
		
		if ($valor_transaccion.val() >= 0 ){    

		$valor_transaccion.notify("Valor debe ser diferente en negativo",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($valor_transaccion).offset().top-120 }, tiempo);
			
		return false;

	    }
		
	}else{
		
		if ($valor_transaccion.val() <= 0 ){    

		$valor_transaccion.notify("Valor debe ser diferente en positivo",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($valor_transaccion).offset().top-120 }, tiempo);
			
		return false;

	    }
		
	}	
		
		
		
	
	if ($descripcion_transaccion.val() == ""){    

		$descripcion_transaccion.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($descripcion_transaccion).offset().top-120 }, tiempo);
			
		return false;

	}
	
	var parametros = new FormData();
	
	parametros.append('id_tipo_transaccion',$id_tipo_transaccion.val()); 
	parametros.append('valor_transaccion',$valor_transaccion.val());
	parametros.append('descripcion_transaccion',$descripcion_transaccion.val());
	
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Caja&action=Agregar",
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
			
			dtMostrar_Detalle();
			dtMostrar_Resumen();
			cleanInputsDetalle();		
			
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
	
	
	
var viewTabla = viewTabla || {};

viewTabla.txt_busqueda	= $("#tbllistado");
viewTabla.tabla  = null;
viewTabla.nombre = 'tbllistado';
viewTabla.contenedor = $("#div_listado");


var viewTabla_1 = viewTabla_1 || {};

viewTabla_1.txt_busqueda	= $("#tbllistado_1");
viewTabla_1.tabla  = null;
viewTabla_1.nombre = 'tbllistado_1';
viewTabla_1.contenedor = $("#div_listado_1");



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


var dtMostrar_Detalle	= function(){
	
	var dataSend = { 'input_search': viewTabla.txt_busqueda.val()};
	
	viewTabla.tabla	=  $( '#'+viewTabla.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Caja&action=dtMostrar_Detalle',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
				
				
				var respuesta = json.totales;  
            	
            	//para modificar valores de footer
            	var columnatotal	= $(viewTabla.tabla.column(1).footer());            	
            	columnatotal.html(respuesta.total);
            	
            	//retormamos valores que se llena en el body
                return json.data;
            	
				
              }
	    },	
	    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
	    'order': [[ 3, "asc" ]],
	    'columns': [	    	    
	    	
	    	{ data: 'nombre_tipo_transaccion'},
    		{ data: 'valor_transaccion'},
    		{ data: 'descripcion_transaccion' },
    		{ data: 'creado'}
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 3 ] }
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
             {extend: 'excel', title: 'Lista Movimientos'},
             {extend: 'pdf', title: 'Lista Movimientos'},

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

        
        


var dtMostrar_Resumen	= function(){
	
	var dataSend = { 'input_search': viewTabla_1.txt_busqueda.val()};
	
	viewTabla_1.tabla	=  $( '#'+viewTabla_1.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Caja&action=dtMostrar_Resumen',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                	
				var respuesta = json.totales;  
            	total = respuesta.total_imprimir;
            	
            	//para modificar valores de footer
            	var columnatotal	= $(viewTabla_1.tabla.column(1).footer());            	
            	columnatotal.html(respuesta.total);
            	
            	//retormamos valores que se llena en el body
                return json.data;
              }
	    },	
	    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
	    'order': [[ 0, "asc" ]],
	    'columns': [	    	    
	    	
	    	{ data: 'nombre_tipo_transaccion'},
    		{ data: 'valor_transaccion'}
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0 ] }
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
             {extend: 'excel', title: 'Lista Movimientos'},
             {extend: 'pdf', title: 'Lista Movimientos'},

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
        
        
          
		


		   