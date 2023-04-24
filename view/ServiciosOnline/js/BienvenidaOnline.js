
$(document).ready(function(){

	//load_propaganda_actualizacion();
	cargarDatos();
	//load_cuenta_individual();
	//load_cuenta_desembolsar();
	//load_creditos();
	
	init();
	
	
}); 
	


var f=new Date();
var dia = f.getDate();
var hora = f.getHours();
var minutos = f.getMinutes();
var meses = new Array ("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");


var fecha_actual;



function cargarDatos(){
	    

	//var tiempo = tiempo || 1000;
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ServiciosOnline&action=cargarDatos",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.participes)){
			
			var array = datos.participes[0];		
			//$("#fecha_nacimiento").html(array.fecha_nacimiento_participes);
			$("#estado").html(array.nombre_estado_participes);
			$("#contacto").html(array.celular_participes+'<br>'+array.correo_participes);
			$("#fecha_actual").html(dia + " de " + meses[f.getMonth()] + " del " + f.getFullYear());
			
			//$("html, body").animate({ scrollTop: $(cedula_usuarios).offset().top-120 }, tiempo);	
			
		}
		
         if(!jQuery.isEmptyObject(datos.usuarios)){
			
			var array1 = datos.usuarios[0];		
			let date = new Date(array1.creado);

			$("#dia").html(diasSemana[date.getDay()]);
			$("#acceso").html(array1.creado);
			
		}
		
         if(!jQuery.isEmptyObject(datos.fecha)){
 			
        	
 			var array2 = datos.fecha[0];		

			//alert(array2.edad);
			$("#años").html(array2.años);
			$("#mes_dias").html(array2.meses+' y '+array2.dias);
 				
 		}
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		//$("#divLoaderPage").removeClass("loader")
		
	})
	
}

	

//variable de vista creditos
var view	= view || {};
view.txt_busqueda	= $("#tbl_listado_creditos");
//variable para dataTable
var viewTable = viewTable || {};

viewTable.tabla  = $("#tbl_listado_creditos");
viewTable.nombre = 'tbl_listado_creditos';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable.contenedor = $("#div_listado_creditos");


//variable de vista cuenta individual
var view1	= view1 || {};
view1.txt_busqueda1	= $("#tbl_listado_cuenta_individual");
//variable para dataTable
var viewTable1 = viewTable1 || {};

viewTable1.tabla  = $("#tbl_listado_cuenta_individual");
viewTable1.nombre = 'tbl_listado_cuenta_individual';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable1.contenedor = $("#div_listado_cuenta_individual");




//variable de vista modal creditos
var view2	= view2 || {};
view2.txt_busqueda2	= $("#tbl_detalle_modal_creditos");
//variable para dataTable
var viewTable2 = viewTable2 || {};

viewTable2.tabla  = $("#tbl_detalle_modal_creditos");
viewTable2.nombre = 'tbl_detalle_modal_creditos';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable2.contenedor = $("#div_detalle_modal_creditos");




//variable de vista modal cuenta individual
var view3	= view3 || {};
view3.txt_busqueda3	= $("#tbl_detalle_modal_cuenta_individual");
view3.params_personales = function(){
	return {id_participes: view.id_participes,
		id_contribucion_tipo: $('#id_contribucion_tipo_personales').length ? $('#id_contribucion_tipo_personales').val() : 0
	};
}



//variable para dataTable
var viewTable3 = viewTable3 || {};

viewTable3.tabla  = $("#tbl_detalle_modal_cuenta_individual");
viewTable3.nombre = 'tbl_detalle_modal_cuenta_individual';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable3.contenedor = $("div_detalle_modal_cuenta_individual");





//variable de vista modal cuenta desembolsar
var view4	= view4 || {};
view4.txt_busqueda4	= $("#tbl_detalle_modal_cuenta_desembolsar");
view4.params_patronales = function(){
	return {id_participes: view.id_participes,
		id_contribucion_tipo: $('#id_contribucion_tipo_patronales').length ? $('#id_contribucion_tipo_patronales').val() : 0
	};
}



//variable para dataTable
var viewTable4 = viewTable4 || {};

viewTable4.tabla  = $("#tbl_detalle_modal_cuenta_desembolsar");
viewTable4.nombre = 'tbl_detalle_modal_cuenta_desembolsar';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable4.contenedor = $("div_detalle_modal_cuenta_desembolsar");




//variable de vista cuenta individual
var view5	= view5 || {};
view5.txt_busqueda5	= $("#tbl_listado_cuenta_desembolsar");
//variable para dataTable
var viewTable5 = viewTable5 || {};

viewTable5.tabla  = $("#tbl_listado_cuenta_desembolsar");
viewTable5.nombre = 'tbl_listado_cuenta_desembolsar';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable5.contenedor = $("#div_listado_cuenta_desembolsar");




function init(){
	
	
try {
	
	
	iniciar_eventos_creditos();	
	iniciar_eventos_cuenta_individual();
	
	
	
		$('#div_detalle_modal_cuenta_individual').on('change','#id_contribucion_tipo_personales',function(){
			viewTable3.tabla.ajax.reload();			
			
		});
		
		$('#div_detalle_modal_cuenta_desembolsar').on('change','#id_contribucion_tipo_patronales',function(){
			viewTable4.tabla.ajax.reload();			
		});	
		
		$('#accordion').on('shown.bs.collapse', function (e) { 
			
			viewTable1.tabla.ajax.reload(); 
			viewTable5.tabla.ajax.reload(); 
			viewTable.tabla.ajax.reload();
		});
		
		
       
		
		
		
	} catch (e) {
		// TODO: handle exception
		console.log("ERROR AL IMPLEMENTAR PLUGIN DE FILEUPLOAD");
	}
	
	
	
}

var iniciar_eventos_creditos = function(){
	
	viewTable.contenedor.tooltip({
	    selector: 'a.showpdf',
	    trigger: 'hover',
	    html: true,
        delay: {"show": 500, "hide": 0},
        placement:"left"
	});
		
}

var iniciar_eventos_cuenta_individual = function(){
	
	viewTable1.contenedor.tooltip({
	    selector: 'a.showpdf',
	    trigger: 'hover',
	    html: true,
        delay: {"show": 500, "hide": 0},
        placement:"left"
	});
		
}

/********************************************************** EMPIEZA PROCEOSOS CON DATATABLE *************************************************/

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

var load_creditos	= function(){
	
	var dataSend = { 'input_search': view.txt_busqueda.val()};
	
	viewTable.tabla	=  $( '#'+viewTable.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=ServiciosOnline&action=dtCargarCreditos',
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
	    	{ data: 'numero', orderable: false },
    		{ data: 'nombre', orderable: false},
    		{ data: 'valor', orderable: false },
    		{ data: 'saldo', orderable: false},
    		{ data: 'plazo', orderable: false },
    		{ data: 'fec_con', orderable: false },
    		{ data: 'fec_final', orderable: false },
    		{ data: 'opciones', orderable: false }
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,1 ] }
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
             {extend: 'excel', title: 'Lista Créditos Activos'},
             {extend: 'pdf', title: 'Lista Créditos Activos'},

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




var load_cuenta_individual	= function(){
	
	var dataSend = { 'input_search': view1.txt_busqueda1.val()};
	
	viewTable1.tabla	=  $( '#'+viewTable1.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=ServiciosOnline&action=dtCargarCuentaIndividual',
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
	    	{ data: 'fecha', orderable: false },
    		{ data: 'valor_personal', orderable: false},
    		{ data: 'valor_personal', orderable: false },
    		{ data: 'opciones', orderable: false }
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,1 ] }
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
             {extend: 'excel', title: 'Resúmen Captaciones'},
             {extend: 'pdf', title: 'Resúmen Captaciones'},

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



var mostrar_detalle_modal_cuenta_individual = function(a){
	
	
	var element = $(a);
	
	let $link = $(a);	
	
	var id_participes	= $link.data("id_participes");
		
	if( id_participes <= 0 || id_participes == "" || id_participes == undefined ){
		return false;
	}	
		
	view.id_participes = id_participes;
	
	if( element.length )
	{			
		//$("#hdnid_cabeza_descuentos").val(id_cabeza_descuentos);
		var modaledit = $("#mod_mostrar_detalle_cuenta_individual");	
		modaledit.modal();
		listar_detalle_modal_cuenta_individual();
		
	}	
	
}






var listar_detalle_modal_cuenta_individual = function(){
	
	
		viewTable3.tabla	=  $( '#'+viewTable3.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=ServiciosOnline&action=dtMostrarDetallesCuentaIndividualModal',
	        'data': function ( d ) {
	            return $.extend( {}, d, view3.params_personales() );
	            },
            'dataSrc': function ( json ) {      
            	
            	
                var respuesta = json.totales;  
            	
            	//para modificar valores de footer
            	var columnatotal	= $(viewTable3.tabla.column(13).footer());            	
            	columnatotal.html(respuesta.total);
            	
            	//retormamos valores que se llena en el body
                return json.data;
            	
            	
                
              }
	    },	
	    'lengthMenu': [ [-1, 10, 25, 50], [ "All", 10, 25, 50] ],
	    'order': [[ 0, "desc" ]],
	    'columns': [	    	    
	    		{ data: 'anio', orderable: false},
	    		{ data: 'enero', orderable: false},
	    		{ data: 'febrero', orderable: false},
	    		{ data: 'marzo', orderable: false},
	    		{ data: 'abril', orderable: false},
	    		{ data: 'mayo', orderable: false},
	    		{ data: 'junio', orderable: false},
	    		{ data: 'julio', orderable: false},
	    		{ data: 'agosto', orderable: false},
	    		{ data: 'septiembre', orderable: false},
	    		{ data: 'octubre', orderable: false},
	    		{ data: 'noviembre', orderable: false},
	    		{ data: 'diciembre', orderable: false},
	    		{ data: 'acumulado', orderable: false}
	    		/*{ data: 'total', orderable: false}*/
	    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13 ] }
	      ],
		'scrollY': "40vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },
        
        dom: "<'row'<'col-sm-6'<'box-tools pull-left'B>>><'row'<'col-sm-6'l><'col-sm-6' <'tag_personales'> >><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'<'#colvis'>p>>",
        /*buttons: [
        	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-3x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' },
        	{
                 "text": '<span class="fa fa-file-pdf-o fa-3x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm',
	              "action": function ( e, dt, node, config ) {
					let str_contribucion_tipo = '';
					
					if( $("#id_contribucion_tipo_personales").val() != 0 ){						
						str_contribucion_tipo	= '&id_contribucion_tipo='+$("#id_contribucion_tipo_personales").val();
					}
                    window.open('index.php?controller=ServiciosOnline&action=reporte_cuenta_individual&id_participes='+view.id_participes+str_contribucion_tipo, '_blank');
                }
            }
		
		],*/
        
        buttons: [
            //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
            
            	 { extend: 'copy'},
                 {extend: 'csv'},
                 {extend: 'excel', title: 'Detalle Captaciones'},
                 {extend: 'pdf', title: 'Detalle Captaciones', orientation: 'landscape'},

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
	
	/* PARA DIBUJAR BUSCADOR DE TIPO SELECT */
	$('.tag_personales').html("<div class=\"row\"><div class=\"form-group\"><label for=\"id_contribucion_tipo_personales\" class=\"control-label\">Filtrar por Rubros de Cuenta Individual: </label><select class =\"form-control\" id =\"id_contribucion_tipo_personales\"  ><option>aportacion personal</option><option>2</option></select></div></div>");
	
	/* AQUI PONER EL NOMBRE DE ELEMENTO GENERADO */
	fn_listar_contribucion_tipo("id_contribucion_tipo_personales");

} 




var mostrar_detalle_modal_creditos = function(a){
	
	
	var element = $(a);
	
	let $link = $(a);	
	
	var id_creditos	= $link.data("id_creditos");
		
	if( id_creditos <= 0 || id_creditos == "" || id_creditos == undefined ){
		return false;
	}	
		
	view.id_creditos = id_creditos;
	
	if( element.length )
	{			
		//$("#hdnid_cabeza_descuentos").val(id_cabeza_descuentos);
		var modaledit = $("#mod_mostrar_detalle_creditos");	
		modaledit.modal();
		listar_detalle_modal_creditos(id_creditos);
		
	}	
	
}






var listar_detalle_modal_creditos = function(id_creditos){
	

	var dataSend = { 'input_search': view2.txt_busqueda2.val(), 'id_creditos': id_creditos};
		
	viewTable2.tabla	=  $( '#'+viewTable2.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=ServiciosOnline&action=dtMostrarDetallesCreditosModal',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {   
            	
                var respuesta = json.totales;  
            	
            	//para modificar valores de footer
            	var capital	= $(viewTable2.tabla.column(2).footer());            	
            	capital.html(respuesta.total_capital);
            	var interes	= $(viewTable2.tabla.column(3).footer());            	
            	interes.html(respuesta.total_interes);
            	var seguro	= $(viewTable2.tabla.column(4).footer());            	
            	seguro.html(respuesta.total_seguro);
            	var mora	= $(viewTable2.tabla.column(5).footer());            	
            	mora.html(respuesta.total_mora);
            	var total_total	= $(viewTable2.tabla.column(6).footer());            	
            	total_total.html(respuesta.total_total);
            	
            	//retormamos valores que se llena en el body
                return json.data;
            	
              }
	    },	
	    'lengthMenu': [ [-1, 8, 10, 25, 50], ["All", 8, 10, 25, 50] ],
	    'order': [[ 0, "asc" ]],
	    'columns': [	    	    
	    		{ data: 'numero_pago', orderable: true},
	    		{ data: 'fecha', orderable: true},
	    		{ data: 'capital', orderable: false },
	    		{ data: 'interes', orderable: false },
	    		{ data: 'seguro', orderable: false },
	    		{ data: 'mora', orderable: false },
	    		{ data: 'total', orderable: false},
	    		{ data: 'saldo', orderable: false },
	    		{ data: 'balance', orderable: false },
	    		{ data: 'estado', orderable: false }
	          
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,1 ] }
	      ],
		'scrollY': "40vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },
        dom: '<"html5buttons">lfrtipB',
        buttons: [
        //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
        
        	 { extend: 'copy'},
             {extend: 'csv'},
             {extend: 'excel', title: 'Tabla Amortización'},
             {extend: 'pdf', title: 'Tabla Amortización', orientation: 'landscape'},

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





var fn_listar_contribucion_tipo	= function(a){
	
	var elemento = $('#'+a);
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ServiciosOnline&action=getcontribucion_tipo",
		type:"POST",
		dataType:"json",
		data:{id_participes:view.id_participes}
	}).done(function(datos){		
		
		elemento.empty();
		elemento.append("<option value='0' >--Todos--</option>");
		
		$.each(datos.data, function(index, value) {
			elemento.append("<option value= " +value.id_contribucion_tipo +" >" + value.nombre_contribucion_tipo  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		elemento.empty();
	})	
}






// DESDE AQUI MAYCOL FALTA












var load_cuenta_desembolsar	= function(){
	
	var dataSend = { 'input_search': view5.txt_busqueda5.val()};
	
	viewTable5.tabla	=  $( '#'+viewTable5.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=ServiciosOnline&action=dtCargarCuentaDesembolsar',
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
	    	{ data: 'fecha', orderable: false },
    		{ data: 'valor_personal', orderable: false},
    		{ data: 'valor_patronal', orderable: false },
    		{ data: 'saldo', orderable: false},
    		{ data: 'retencion', orderable: false },
    		{ data: 'total', orderable: false },
    		{ data: 'opciones', orderable: false }
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,1 ] }
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
             {extend: 'excel', title: 'Resúmen Cuenta Desembolsar'},
             {extend: 'pdf', title: 'Resúmen Cuenta Desembolsar'},

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



var mostrar_detalle_modal_cuenta_desembolsar = function(a){
	
	
	var element = $(a);
	
	let $link = $(a);	
	
	var id_participes	= $link.data("id_participes");
		
	if( id_participes <= 0 || id_participes == "" || id_participes == undefined ){
		return false;
	}	
		
	view.id_participes = id_participes;
	
	if( element.length )
	{			
		//$("#hdnid_cabeza_descuentos").val(id_cabeza_descuentos);
		var modaledit = $("#mod_mostrar_detalle_cuenta_desembolsar");	
		modaledit.modal();
		listar_detalle_modal_cuenta_desembolsar();
		
	}	
	
}






var listar_detalle_modal_cuenta_desembolsar = function(){
	
	
		viewTable4.tabla	=  $( '#'+viewTable4.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=ServiciosOnline&action=dtMostrarDetallesCuentaDesembolsarModal',
	        'data': function ( d ) {
	            return $.extend( {}, d, view4.params_patronales() );
	            },
            'dataSrc': function ( json ) {      
            	
            	
                var respuesta = json.totales;  
            	
            	//para modificar valores de footer
            	var columnatotal	= $(viewTable4.tabla.column(13).footer());            	
            	columnatotal.html(respuesta.total);
            	
            	//retormamos valores que se llena en el body
                return json.data;
            	
            	
                
              }
	    },	
	    'lengthMenu': [ [-1, 10, 25, 50], [ "All", 10, 25, 50] ],
	    'order': [[ 0, "desc" ]],
	    'columns': [	    	    
	    		{ data: 'anio', orderable: false},
	    		{ data: 'enero', orderable: false},
	    		{ data: 'febrero', orderable: false},
	    		{ data: 'marzo', orderable: false},
	    		{ data: 'abril', orderable: false},
	    		{ data: 'mayo', orderable: false},
	    		{ data: 'junio', orderable: false},
	    		{ data: 'julio', orderable: false},
	    		{ data: 'agosto', orderable: false},
	    		{ data: 'septiembre', orderable: false},
	    		{ data: 'octubre', orderable: false},
	    		{ data: 'noviembre', orderable: false},
	    		{ data: 'diciembre', orderable: false},
	    		{ data: 'acumulado', orderable: false}
	    		/*{ data: 'total', orderable: false}*/
	    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13 ] }
	      ],
		'scrollY': "40vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },
        dom: "<'row'<'col-sm-6'<'box-tools pull-left'B>>><'row'<'col-sm-6'l><'col-sm-6' <'tag_patronales'> >><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'<'#colvis'>p>>",
       /* buttons: [
        	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-3x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' },
        	{
                 "text": '<span class="fa fa-file-pdf-o fa-3x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm',
	              "action": function ( e, dt, node, config ) {
					let str_contribucion_tipo = '';
					
					if( $("#id_contribucion_tipo_patronales").val() != 0 ){						
						str_contribucion_tipo	= '&id_contribucion_tipo='+$("#id_contribucion_tipo_patronales").val();
					}
                    window.open('index.php?controller=ServiciosOnline&action=reporte_cuenta_desembolsar&id_participes='+view.id_participes+str_contribucion_tipo, '_blank');
                }
            }
		
		],*/
        
        buttons: [
            //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
            
            	 { extend: 'copy'},
                 {extend: 'csv'},
                 {extend: 'excel', title: 'Detalle Cuenta por Desembolsar'},
                 {extend: 'pdf', title: 'Detalle Cuenta por Desembolsar', orientation: 'landscape'},

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
	
	/* PARA DIBUJAR BUSCADOR DE TIPO SELECT */
	$('.tag_patronales').html("<div class=\"row\"><div class=\"form-group\"><label for=\"id_contribucion_tipo_patronales\" class=\"control-label\">Filtrar por Rubros de Cuenta Desembolsar: </label><select class =\"form-control\" id =\"id_contribucion_tipo_patronales\"  ><option>aportacion patronal</option><option>2</option></select></div></div>");
	
	/* AQUI PONER EL NOMBRE DE ELEMENTO GENERADO */
	fn_listar_contribucion_tipo_patronal("id_contribucion_tipo_patronales");

} 




var fn_listar_contribucion_tipo_patronal	= function(a){
	
	var elemento = $('#'+a);
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ServiciosOnline&action=getcontribucion_tipo_patronales",
		type:"POST",
		dataType:"json",
		data:{id_participes:view.id_participes}
	}).done(function(datos){		
		
		elemento.empty();
		elemento.append("<option value='0' >--Todos--</option>");
		
		$.each(datos.data, function(index, value) {
			elemento.append("<option value= " +value.id_contribucion_tipo +" >" + value.nombre_contribucion_tipo  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		elemento.empty();
	})	
}





function load_propaganda_actualizacion(){
	 
   $.ajax({
			url: 'index.php?controller=ServiciosOnline&action=propaganda_actualizacion_datos',
			type: 'POST',
			//data_type:json
			data: {action:'ajax'},
			success: function(D){

				if (D.trim()=="NO"){
					
					$("#mostrarmodal_propaganda").modal("show");
					
				}else
				{
					
					swal({
	              		  title: "Estimados Participes",
	              		  text: "En unos días podrán consultar sus créditos, tabla de amortización y garantías reales.",
	              		  icon: "warning",
	              		  button: "Aceptar",
	              		});
					
				}
				
			}
	 });

  
 
}





	

			$("#id_entidad_patronal").change(function(){
			
	            // obtenemos el combo de resultado combo 2
	           var $id_entidad_patronal_coordinaciones = $("#id_entidad_patronal_coordinaciones");
	       	

	            // lo vaciamos
	           var id_entidad_patronal = $(this).val();

	          
	          
	            if(id_entidad_patronal != 0)
	            {
	            	 $id_entidad_patronal_coordinaciones.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_entidad_patronal:$(this).val()
	                  };
	             
	            	
	         	   $.post("index.php?controller=ServiciosOnline&action=devuelveCordinacion", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_entidad_patronal_coordinaciones.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_entidad_patronal_coordinaciones.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_entidad_patronal_coordinaciones.append("<option value= " +value.id_entidad_patronal_coordinaciones +" >" + value.nombre_entidad_patronal_coordinaciones  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_entidad_patronal_coordinaciones=$("#id_entidad_patronal_coordinaciones");
	            	id_entidad_patronal_coordinaciones.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		
		 
		 
      $("#id_estado_civil_participes").click(function() {
			
          var id_estado_civil_datos_personales = $(this).val();
			
          if(id_estado_civil_datos_personales == 1 || id_estado_civil_datos_personales == 4 || id_estado_civil_datos_personales == 3)
          {
        	  if(id_estado_civil_datos_personales == 0 )
              {
           	   
              }else{
            	  $("#numero_cedula_conyuge").val("");
            	  $("#apellidos_conyuge").val("");
            	  $("#nombres_conyuge").val("");
            	  
              }
          }
       	
         
         
	    });
	    
	    $("#id_estado_civil_participes").change(function() {
			
              
              var id_estado_civil_datos_personales = $(this).val();
				
              
              if(id_estado_civil_datos_personales == 1 || id_estado_civil_datos_personales == 4 || id_estado_civil_datos_personales == 3)
              {
            	  if(id_estado_civil_datos_personales == 0 )
                  {
               	   
                  }else{
                	  $("#numero_cedula_conyuge").val("");
                	  $("#apellidos_conyuge").val("");
                	  $("#nombres_conyuge").val("");
                	  
                  }
              	   
              }
           	
             
              
              
		    });
		
		
		
		
		
		function seleccion()
		{
		
		var combo = document.getElementById("id_entidad_patronal_coordinaciones");
		var selected = combo.options[combo.selectedIndex].text;
		
		
              if(selected == 'OTRA')
              {
           	   $("#div_otra").fadeIn("slow");
              }
           	  else
              {

				    if(selected=='--Seleccione--'){

						   $("#div_otra").fadeOut("slow");
					}else{
						   $("#nombre_otra_coordinacion").val("");
			               $("#div_otra").fadeOut("slow");
					}

              }
		
		}
