$(document).ready( function (){
        		   pone_espera();
        		   load_sesiones(1);
				});


$("#buscar").click(function() 
{
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
	var desde = $("#desde").val();
	var hasta = $("#hasta").val();
	
	if(desde > hasta){

		$("#mensaje_desde").text("Fecha desde no puede ser mayor a hasta");
		$("#mensaje_desde").fadeIn("slow"); //Muestra mensaje de error
        return false;
        
	}else 
	{
		$("#mensaje_desde").fadeOut("slow"); //Muestra mensaje de error
		 load_sesiones(1);
	} 

	if(hasta < desde){

		$("#mensaje_hasta").text("Fecha hasta no puede ser menor a desde");
		$("#mensaje_hasta").fadeIn("slow"); //Muestra mensaje de error
        return false;
        
	}else 
	{
		$("#mensaje_hasta").fadeOut("slow"); //Muestra mensaje de error
		 load_sesiones(1);
	} 

});

$( "#desde" ).focus(function() {
  $("#mensaje_desde").fadeOut("slow");
});

$( "#hasta" ).focus(function() {
	  $("#mensaje_hasta").fadeOut("slow");
  });

function pone_espera(){

	   $.blockUI({ 
			message: '<h4><img src="view/images/load.gif" /> Espere por favor, estamos procesando su requerimiento...</h4>',
			css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff',
	           
     		}
 });
	
 setTimeout($.unblockUI, 3000); 
 
}


function load_sesiones(pagina){


	   var search=$("#search").val();
	   var desde=$("#desde").val();
	   var hasta=$("#hasta").val();
    var con_datos={
				  action:'ajax',
				  page:pagina,
				  desde:desde,
				  hasta:hasta
				  };
  $("#load_registrados").fadeIn('slow');
     $.ajax({
               beforeSend: function(objeto){
                 $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
               },
               url: 'index.php?controller=Sesiones&action=search_sesiones&search='+search,
               type: 'POST',
               data: con_datos,
               success: function(x){
                 $("#sesiones_registrados").html(x);
               	 $("#tabla_sesiones").tablesorter(); 
                 $("#load_registrados").html("");
               },
              error: function(jqXHR,estado,error){
                $("#sesiones_registrados").html("Ocurrio un error al cargar la informacion de sesiones..."+estado+"    "+error);
              }
            });
	   }
