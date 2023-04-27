$(document).ready( function (){
   Mostrar();
});

function antes_de_accion(mensaje){

	swal({
        title: "PROCESANDO",
        text: mensaje,
        icon: "view/images/ajax-loader.gif",        
      })
}


function LimpiarCampos(){
	
	            $('#id_tipo_productos').val("");
				$('#nombre_tipo_productos').val("");
				
}

function Registrar(){
	
	
	let $id_tipo_productos = $("#id_tipo_productos");
	let $nombre_tipo_productos = $("#nombre_tipo_productos");
	
	if ($nombre_tipo_productos.val() == ""){    

		$nombre_tipo_productos.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($nombre_tipo_productos).offset().top-120 }, tiempo);
			
		return false;

	}
	
	
		
	var parametros = new FormData();
	
	parametros.append('id_tipo_productos',$id_tipo_productos.val()); 
	parametros.append('nombre_tipo_productos',$nombre_tipo_productos.val());
	
	$.ajax({
		beforeSend:antes_de_accion('Estamos procesado la información'),
		url:"index.php?controller=TipoProductos&action=Registrar",
		type:"POST",
		dataType:"json",
		data:parametros,		
		contentType: false, 
        processData: false  
   }).done(function(x){
		
		if( x.respuesta != undefined && x.respuesta != ""){
			
			swal( {
				 title:"NOTIFICACIÓN",
				 dangerMode: false,
				 text: x.mensaje,
				 icon: "success"
				});
			Mostrar();
			LimpiarCampos();			
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




var Editar = function(a){
	
	
	var element = $(a);
	let $link = $(a);	
	var id_tipo_productos	= $link.data("id_tipo_productos");
	if( id_tipo_productos <= 0 || id_tipo_productos == "" || id_tipo_productos == undefined ){
		return false;
	}	
	$.ajax({
		beforeSend:antes_de_accion('Estamos procesado la información'),
		url:"index.php?controller=TipoProductos&action=Editar",
		type:"POST",
		dataType:"json",
		data:{id_tipo_productos:id_tipo_productos}
	}).done(function(datos){
		swal.close();
		 $.each(datos.data, function(index, value) {
         	
			
			    $('#id_tipo_productos').val(value.id_tipo_productos);
				$('#nombre_tipo_productos').val(value.nombre_tipo_productos);
			
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
		
		        Mostrar();
		   		LimpiarCampos();
		
	}).always(function(){
	})
	
}
	

var Eliminar = function(a){
	
	
	var element = $(a);
	let $link = $(a);	
	var id_tipo_productos	= $link.data("id_tipo_productos");
	
	if( id_tipo_productos <= 0 || id_tipo_productos == "" || id_tipo_productos == undefined ){
		return false;
	}	
	
	swal({title:"NOTIFICACIÓN",text:"Esta seguro de eliminar el cliente",icon:"info",buttons: true,
		  closeOnClickOutside: false,
		  closeOnEsc: false})
	.then((isConfirm) => {
		if (isConfirm)
		{
				$.ajax({
					beforeSend:antes_de_accion('Estamos procesado la información'),
					url:"index.php?controller=TipoProductos&action=Eliminar",
					type:"POST",
					dataType:"json",
					data:{id_tipo_productos:id_tipo_productos}
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
					
						
					
				}).always(function(){
				})	
		  				 Mostrar();
		   				 LimpiarCampos();
	
		}
	});
	
		 				 
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


var Mostrar	= function(){
	
	var dataSend = { 'input_search': viewTabla.txt_busqueda.val()};
	
	viewTabla.tabla	=  $( '#'+viewTabla.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=TipoProductos&action=Mostrar',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
	    'pageLength': -1,
	    'order': [[ 1, "asc" ]],
	    'columns': [	    	    
	    	
	    	{ data: 'numfila', orderable: true},
    		{ data: 'nombre_tipo_productos'},
    		{ data: 'opciones'}
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 2 ] }
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
             {extend: 'excel', title: 'Datos Registrados'},
             {extend: 'pdf', title: 'Datos Registrados'},

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


		   