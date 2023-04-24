
$(document).ready(function(){ 	 
	
	load_mostrar();
	load_mostrar1();
	
});

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





//variable de vista cuenta individual
var view1	= view1 || {};
view1.txt_busqueda1	= $("#tbl_mostrar");
//variable para dataTable
var viewTable1 = viewTable1 || {};

viewTable1.tabla  = $("#tbl_mostrar");
viewTable1.nombre = 'tbl_mostrar';
viewTable1.contenedor = $("#div_mostrar");

//variable de vista cuenta individual
var view2	= view2 || {};
view2.txt_busqueda1	= $("#tbl_mostrar1");
//variable para dataTable
var viewTable2 = viewTable2 || {};

viewTable2.tabla  = $("#tbl_mostrar1");
viewTable2.nombre = 'tbl_mostrar1';
viewTable2.contenedor = $("#div_mostrar1");




var load_mostrar	= function(){
	
	var dataSend = { 'input_search': view1.txt_busqueda1.val()};
	
	viewTable1.tabla	=  $( '#'+viewTable1.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Encuesta&action=excel',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'lengthMenu': [ [-1], ["All"] ],
	    'order': [[ 0, "asc" ]],
	    'columns': [	   
	    	
	    	{ data: 'numero', orderable: true },
    		{ data: 'ciudad', orderable: false },
    		{ data: 'provincia', orderable: false},
    		{ data: 'local', orderable: false},
    		{ data: 'contacto', orderable: false},
    		{ data: 'calle_1', orderable: false},
    		{ data: 'num_calle', orderable: false},
    		{ data: 'calle_2', orderable: false},
    		{ data: 'referencia', orderable: false},
    		{ data: 'latitud', orderable: false},
    		{ data: 'longitud', orderable: false},
    		
    		{ data: 'p1', orderable: false},
    		{ data: 'p2', orderable: false},
    		{ data: 'p3', orderable: false},
    		{ data: 'p4', orderable: false},
    		{ data: 'p5', orderable: false},
    		{ data: 'p6', orderable: false},
    		{ data: 'p7', orderable: false},
    		{ data: 'p8', orderable: false},
    		{ data: 'p9', orderable: false},
    		{ data: 'p10', orderable: false},
    		{ data: 'p11', orderable: false},
    		{ data: 'p12', orderable: false},
    		{ data: 'p13', orderable: false},
    		{ data: 'p14', orderable: false},
    		{ data: 'p15', orderable: false},
    		{ data: 'p16', orderable: false},
    		{ data: 'p17', orderable: false},
    		{ data: 'p18', orderable: false},
    		{ data: 'p19', orderable: false},
    		{ data: 'p20', orderable: false},
			{ data: 'p21', orderable: false},
    		{ data: 'p22', orderable: false}
    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0 ] },
	      ],
	      
		/*'scrollY': "40vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },*/
	      
	      sScrollY: "40vh",
	        sScrollX: " 100% ",
	        sScrollXInner:" 200% ",
	        bScrollCollapse: true,
	      
	      
        //dom: "<'row'<'col-sm-6'<'box-tools pull-right'B>>><'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'<'#colvis'>p>>",
        dom: '<"html5buttons">lrtipB',
        buttons: [
        //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
        
        	 { extend: 'copy'},
             {extend: 'csv'},
             {extend: 'excel', title: 'Lista de Encuestas'},
             {extend: 'pdf', title: 'Lista de Encuestas'},

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

var load_mostrar1	= function(){
	
	var dataSend = { 'input_search': view2.txt_busqueda1.val()};
	
	viewTable2.tabla	=  $( '#'+viewTable2.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Encuesta&action=excel1',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'lengthMenu': [ [-1], ["All"] ],
	    'order': [[ 0, "asc" ]],
	    'columns': [	   
	    	
	    	{ data: 'numero', orderable: true },
    		{ data: 'ciudad', orderable: false },
    		{ data: 'provincia', orderable: false},
    		{ data: 'local', orderable: false},
    		{ data: 'contacto', orderable: false},
    		{ data: 'calle_1', orderable: false},
    		{ data: 'num_calle', orderable: false},
    		{ data: 'calle_2', orderable: false},
    		{ data: 'referencia', orderable: false},
    		{ data: 'latitud', orderable: false},
    		{ data: 'longitud', orderable: false},
    	
	    	
    		{ data: 'p23', orderable: false },
    		{ data: 'p24', orderable: false },
    		{ data: 'p25', orderable: false },
    		{ data: 'p26', orderable: false },
    		{ data: 'p27', orderable: false },
    		{ data: 'p28', orderable: false },
    		{ data: 'p29', orderable: false },
    		{ data: 'p30', orderable: false },
    		{ data: 'p31', orderable: false },
			{ data: 'p32', orderable: false },
			{ data: 'p33', orderable: false },
    		{ data: 'p34', orderable: false },
    		{ data: 'p35', orderable: false },
    		{ data: 'p36', orderable: false },
    		{ data: 'p37', orderable: false }
    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0] },
	      ],
	      
		/*'scrollY': "40vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },*/
	      sScrollY: "40vh",
	        sScrollX: " 100% ",
	        sScrollXInner:" 200% ",
	        bScrollCollapse: true,
	      
	      
        //dom: "<'row'<'col-sm-6'<'box-tools pull-right'B>>><'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'<'#colvis'>p>>",
        dom: '<"html5buttons">lrtipB',
        buttons: [
        //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
        
        	 { extend: 'copy'},
             {extend: 'csv'},
             {extend: 'excel', title: 'Lista de Censos'},
             {extend: 'pdf', title: 'Lista de Censos'},

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





