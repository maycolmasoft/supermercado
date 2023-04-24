$(document).ready( function (){
        		   pone_espera();
        		   
	   			});

 $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_controladores = $("#nombre_rol").val();
		    	
		    	
		    	
		    	if (nombre_controladores == "")
		    	{
			    	
		    		$("#mensaje_nombre_rol").text("Introduzca Un Rol");
		    		$("#mensaje_nombre_rol").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre_rol").fadeOut("slow"); //Muestra mensaje de error
		            
				}   
  	
			}); 
 
 $( "##mensaje_nombre_rol" ).focus(function() {
	  $("##mensaje_nombre_rol").fadeOut("slow");
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