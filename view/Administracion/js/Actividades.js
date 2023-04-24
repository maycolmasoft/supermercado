$(document).ready( function (){
        		   
  load_actividades(1);
        		   
});



$( "#desde" ).focus(function() {
	  $("#mensaje_desde").fadeOut("slow");
  });
	
$( "#hasta" ).focus(function() {
$("#mensaje_hasta").fadeOut("slow");
});


$("#frm_actividades").on("submit",function(event){
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
	var desde = $("#desde").val();
	var hasta = $("#hasta").val();
	
	if(desde > hasta){

		$("#mensaje_desde").text("Fecha desde no puede ser mayor a hasta");
		$("#mensaje_desde").fadeIn("slow"); //Muestra mensaje de error
        return false;
        
	}else{
		
		$("#mensaje_desde").fadeOut("slow"); //Muestra mensaje de error
		
		
	} 

	if(hasta < desde){

		$("#mensaje_hasta").text("Fecha hasta no puede ser menor a desde");
		$("#mensaje_hasta").fadeIn("slow"); //Muestra mensaje de error
        return false;
        
	}else{
		
		$("#mensaje_hasta").fadeOut("slow"); //Muestra mensaje de error
		
	} 
	
	load_actividades();
	event.preventDefault();
})

function load_actividades(pagina = 1){

   var buscador=$("#search").val();
   var desde=$("#desde").val();
   var hasta=$("#hasta").val();
	   
	   var con_datos={
			   	peticion:'ajax',
				  page:pagina,
				  desde:desde,
				  hasta:hasta,
				  search: buscador
				  };
	   
	   $.ajax({
		   beforeSend : function(){$("#divLoaderPage").addClass("loader")},
		   url : "index.php?controller=Actividades&action=search_actividades",
		   type: 'POST',
		   data: con_datos
	   }).done(function(datos){
		   
		   $("#actividades_registrados").html(datos);
		   $("#tabla_actividades").tablesorter(); 
           $("#load_registrados").html("");
           
	   }).fail(function(xhr,status,error){
		   var err = xhr.responseText
		   console.log(err)
	   }).always(function(){
		   $("#divLoaderPage").removeClass("loader")
	   })
	   
}