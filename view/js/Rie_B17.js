$(document).ready(function(){
	load_b17();
})

/*******************************************************************************
 * funcion para iniciar el formulario
 * 
 * @returns
 */
function init(){
	
	iniciar_eventos_datatable();	
}
/********************************************************** EMPIEZA PROCEOSOS CON DATATABLE *************************************************/

//variable de vista
var view	= view || {};
view.txt_busqueda	= $("#search_B17");
//variable para dataTable
var viewTable = viewTable || {};

viewTable.tabla  = null;
viewTable.nombre = 'tbl_listado_B17';
viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable.contenedor = $("#div_listado_B17");

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

var load_b17	= function(){
	
	var dataSend = { 'input_search': view.txt_busqueda.val() };
	
	viewTable.tabla	=  $( '#'+viewTable.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Rie_B17&action=dtListarB17',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'order': [[ 1, "desc" ]],
	    'columns': [	    	    
	    	{ data: 'numfila', orderable: false },
    		{ data: 'nombre_entidades'},
    		{ data: 'fecha_corte_b17_cabeza'},
    		{ data: 'total_registros_b17_cabeza' },
    		{ data: 'valor_cuadre_total' },
    		{ data: 'estado_b17_cabeza' },
    		{ data: 'opciones', orderable: false }
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: false, targets: [ 0,5,6 ] }
	      ],
		'scrollY': "80vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },
        'language':idioma_espanol
	 });
		
}

var iniciar_eventos_datatable = function(){
	
	viewTable.contenedor.tooltip({
	    selector: 'a.showpdf',
	    trigger: 'hover',
	    html: true,
        delay: {"show": 500, "hide": 0},
        placement:"left"
	});
		
}

viewTable.contenedor.on('click','a.showpdf',function(event){
	let enlace = $(this);
	let _url = "index.php?controller=Rpt_Rie_B17&action=RptB17&id_b17_cabeza="+enlace.data().id;
	
	if ( enlace.data().id ) {
		
		window.open(_url,"_blank");
		
	}
	
	event.preventDefault();
})






