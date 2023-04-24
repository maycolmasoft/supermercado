
// para encuesta
let data_1 = [];
let data_2 = [];
let data_5 = [];
let data_6 = [];
let data_8 = [];
let data_9 = [];
let data_10 = [];
let data_11 = [];
let data_12 = [];
let data_13 = [];
let data_14 = [];

//para censo	
let data_23 = [];
let data_24 = [];
let data_26 = [];
let data_27 = [];
let data_28 = [];
let data_30 = [];
let data_31 = [];
let data_32 = [];
let data_34 = [];
let data_35 = [];
let data_36 = [];

$(document).ready(function(){
	$(".cantidades").inputmask();
	cargarTipoEncuestas();
	cargaProvincias();
	
}); 
	



var view	= view || {};
view.lng="";
view.lat="";




var f=new Date();
var dia = f.getDate();
var hora = f.getHours();
var minutos = f.getMinutes();
var meses = new Array ("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");


var fecha_actual;



function cargarTipoEncuestas(){
	    
	let $ddlPeriodo = $("#id_tipo_encuestas");
    
    $.ajax({
          beforeSend:function(){},
          url:"index.php?controller=Encuesta&action=CargarTipoEncuesta",
          type:"POST",
          dataType:"json",
          data:null
    }).done(function(datos){           
    	
  	  $ddlPeriodo.empty();
  	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
          
          $.each(datos.data, function(index, value) {
          	$ddlPeriodo.append("<option value= " +value.id_tipo_encuestas +" >" + value.nombre_tipo_encuestas  + "</option>"); 
          });
          
    }).fail(function(xhr,status,error){
          var err = xhr.responseText
          console.log(err)
          $ddlPeriodo.empty();
          $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
          
    })
   
}



$("#id_tipo_encuestas").change(function() {
      
	  var id_tipo_encuestas = $(this).val();
	  
	  if(id_tipo_encuestas==1){
		  
		  cargarDatos(id_tipo_encuestas);
		  $("#div_encuesta_1").fadeIn("slow");
		  $("#div_encuesta_2").fadeOut("slow");
	  }else{
		  
		  
		  if(id_tipo_encuestas==0){
			  
			  $("#div_encuesta_1").fadeOut("slow");
			  $("#div_encuesta_2").fadeOut("slow");
			  
		  }else{
			  cargarDatos(id_tipo_encuestas);
			  $("#div_encuesta_1").fadeOut("slow");
			  $("#div_encuesta_2").fadeIn("slow");
		  }
		  
	  }
	 
	  
 });





function cargarDatos(id_tipo_encuestas){
	    

	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=Encuesta&action=CargarPreguntas",
		type:"POST",
		dataType:"json",
		data:{id_tipo_encuestas:id_tipo_encuestas}
	}).done(function(datos){
		
		 $.each(datos.preguntas, function(index, value) {
         	
			 if(id_tipo_encuestas==2){
			 // para encuesta market share
					 if(value.id_preguntas_encuestas_cabeza==1){
						 
						 $("#id_pregunta_1").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_1").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
						 
					 }else if(value.id_preguntas_encuestas_cabeza==2)
					 {
						 $("#id_pregunta_2").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_2").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
						
					 }else if(value.id_preguntas_encuestas_cabeza==3)
					 {
						 $("#id_pregunta_3").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_3").html(value.nombre_preguntas_encuestas_cabeza);
						
					 }else if(value.id_preguntas_encuestas_cabeza==4)
					 {
						 $("#id_pregunta_4").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_4").html(value.nombre_preguntas_encuestas_cabeza);
						 
					 }else if(value.id_preguntas_encuestas_cabeza==5)
					 {
						 $("#id_pregunta_5").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_5").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);
						
					 }else if(value.id_preguntas_encuestas_cabeza==6)
					 {
						 $("#id_pregunta_6").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_6").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);
						
					 }else if(value.id_preguntas_encuestas_cabeza==7)
					 {
						 $("#id_pregunta_7").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_7").html(value.nombre_preguntas_encuestas_cabeza);
						 
					 }else if(value.id_preguntas_encuestas_cabeza==8)
					 {
						 $("#id_pregunta_8").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_8").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==9)
					 {
						 $("#id_pregunta_9").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_9").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==10){
						 $("#id_pregunta_10").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_10").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==11){
						 $("#id_pregunta_11").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_11").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==12){
						 $("#id_pregunta_12").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_12").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==13){
						 $("#id_pregunta_13").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_13").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==14){
						 $("#id_pregunta_14").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_14").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==15){
						 $("#id_pregunta_15").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_15").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==16){
						 $("#id_pregunta_16").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_16").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==17){
						 $("#id_pregunta_17").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_17").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==18){
						 $("#id_pregunta_18").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_18").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==19){
						 $("#id_pregunta_19").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_19").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==20){
						 $("#id_pregunta_20").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_20").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else if(value.id_preguntas_encuestas_cabeza==21){
						 $("#id_pregunta_21").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_21").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }else{
						 $("#id_pregunta_22").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_22").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }
			 
			 
		 		}else{
		 			
		 			// para censo
		 			 if(value.id_preguntas_encuestas_cabeza==23)
					 {
						 $("#id_pregunta_23").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_23").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 } else if(value.id_preguntas_encuestas_cabeza==24)
					 {
						 $("#id_pregunta_24").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_24").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }
					 else if(value.id_preguntas_encuestas_cabeza==25)
					 {
						 $("#id_pregunta_25").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_25").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==26)
					 {
						 $("#id_pregunta_26").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_26").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==27)
					 {
						 $("#id_pregunta_27").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_27").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==28)
					 {
						 $("#id_pregunta_28").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_28").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==29)
					 {
						 $("#id_pregunta_29").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_29").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
						 
					 }else if(value.id_preguntas_encuestas_cabeza==30)
					 {
						 $("#id_pregunta_30").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_30").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==31)
					 {
						 $("#id_pregunta_31").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_31").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==32)
					 {
						 $("#id_pregunta_32").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_32").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==33)
					 {
						 $("#id_pregunta_33").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_33").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==34)
					 {
						 $("#id_pregunta_34").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_34").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==35)
					 {
						 $("#id_pregunta_35").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_35").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else if(value.id_preguntas_encuestas_cabeza==36)
					 {
						 $("#id_pregunta_36").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_36").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						 
					 }else {
						 
						 $("#id_pregunta_37").val(value.id_preguntas_encuestas_cabeza);
						 $("#nombre_pregunta_37").html(value.nombre_preguntas_encuestas_cabeza);
						 cargaDetallePreg(value.id_preguntas_encuestas_cabeza);	
						
					 }
		 			
		 			
		 		}
		 
		 });
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
	})
	
}




function cargaDetallePreg(id){
    
	let $ddlPeriodo = $("#id_preguntas_encuestas_detalle_"+id);
    
    $.ajax({
          beforeSend:function(){},
          url:"index.php?controller=Encuesta&action=CargarPreguntasDetalle",
          type:"POST",
          dataType:"json",
          data:{id_preguntas_encuestas_cabeza:id}
    }).done(function(datos){           
    	
    	
    	
  	  $ddlPeriodo.empty();
  	  $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
          
          $.each(datos.data, function(index, value) {
          	$ddlPeriodo.append("<option value= " +value.id_preguntas_encuestas_detalle +" >" + value.opciones_preguntas_detalle  + "</option>"); 
          });
          
    }).fail(function(xhr,status,error){
          var err = xhr.responseText
          console.log(err)
          $ddlPeriodo.empty();
          $ddlPeriodo.append("<option value='0' >--Seleccione--</option>");
          
    })
   
}






function seleccion(id)
{

var combo = document.getElementById("id_preguntas_encuestas_detalle_"+id);
var selected = combo.options[combo.selectedIndex].text;


      if(selected == 'OTROS')
      {
   	   $("#div_otros_"+id).fadeIn("slow");
      }
   	  else
      {

		    if(selected=='--Seleccione--'){

				   $("#div_otros_"+id).fadeOut("slow");
			}else{
				   $("#nombre_otros_"+id).val("");
	               $("#div_otros_"+id).fadeOut("slow");
			}

      }

}




function agregar(id){
	
	let $id_pregunta = $('#id_pregunta_'+id).val();
	let $id_preguntas_encuestas_detalle = $('#id_preguntas_encuestas_detalle_'+id).val();
	let $nombre_otros = $('#nombre_otros_'+id).val();
   
	if($nombre_otros===undefined){
		
		$nombre_otros="";
	}
	

	var combo = document.getElementById("id_preguntas_encuestas_detalle_"+id);
	var selected = combo.options[combo.selectedIndex].text;
	
	
	if($id_pregunta == "" && $id_pregunta.length ==0) {  
		$("#id_preguntas_encuestas_detalle_"+id).notify("No existe pregunta",{ position:"buttom left", autoHideDelay: 2000});
   	 return false;
       		
    } 
	
	
	if($id_pregunta==26){
		
		let $id_preguntas_encuestas_detalle_para_validar = $('#id_preguntas_encuestas_detalle_25').val();
		
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
		
		if($id_preguntas_encuestas_detalle_para_validar ==357) {  
			 
	    }else{
	    	$("#id_preguntas_encuestas_detalle_"+id).notify("No puede agregar detalle",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
	    	
	    } 
		
	}else if($id_pregunta==27){
		
		let $id_preguntas_encuestas_detalle_para_validar = $('#id_preguntas_encuestas_detalle_25').val();
		
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
		
		if($id_preguntas_encuestas_detalle_para_validar ==357) {  
			 
	    }else{
	    	$("#id_preguntas_encuestas_detalle_"+id).notify("No puede agregar detalle",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
	    	
	    } 
		
	}else if($id_pregunta==30){
		
		let $id_preguntas_encuestas_detalle_para_validar = $('#id_preguntas_encuestas_detalle_29').val();
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
		
		if($id_preguntas_encuestas_detalle_para_validar ==375) {  
			 
	    }else{
	    	$("#id_preguntas_encuestas_detalle_"+id).notify("No puede agregar detalle",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
	    	
	    } 
		
		
	}else if($id_pregunta==31){
		
		let $id_preguntas_encuestas_detalle_para_validar = $('#id_preguntas_encuestas_detalle_29').val();
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
		
		if($id_preguntas_encuestas_detalle_para_validar ==375) {  
			 
	    }else{
	    	$("#id_preguntas_encuestas_detalle_"+id).notify("No puede agregar detalle",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
	    	
	    } 
		
		
	}else if($id_pregunta==34){
		
		let $id_preguntas_encuestas_detalle_para_validar = $('#id_preguntas_encuestas_detalle_33').val();
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
		
		if($id_preguntas_encuestas_detalle_para_validar ==395) {  
			 
	    }else{
	    	$("#id_preguntas_encuestas_detalle_"+id).notify("No puede agregar detalle",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
	    	
	    } 
		
		
	}else if($id_pregunta==35){
		
		let $id_preguntas_encuestas_detalle_para_validar = $('#id_preguntas_encuestas_detalle_33').val();
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
		
		if($id_preguntas_encuestas_detalle_para_validar ==395) {  
			 
	    }else{
	    	$("#id_preguntas_encuestas_detalle_"+id).notify("No puede agregar detalle",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
	    	
	    } 
		
		
	}else{
		
		if($id_preguntas_encuestas_detalle ==0) {  
			$("#id_preguntas_encuestas_detalle_"+id).notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	   	 return false;
	    } 
	}
	

	if(selected == 'OTROS')
    {
	
		if($nombre_otros=="" && $nombre_otros.length ==0){
			
			$("#nombre_otros_"+id).notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		   	 return false;
			
		}
		
    }
	
	
	
    item = {}; 
	
	item ["id_pregunta"] 		= $id_pregunta;
    item ["id_preguntas_encuestas_detalle"]= $id_preguntas_encuestas_detalle;
    item ["respuesta_pregunta"]=selected;
    item ['nombre_otros'] 		= $nombre_otros;
      
  
    var validacion=false;
    
	
	
	
	
	
	
	
    if(id==1){
    	  $.each(data_1, function(index, value) {
        	  if(value.respuesta_pregunta==selected){
        		  
        		  validacion=true;
        		  return;
        	  }
          });
    	  
    	  if(!validacion){
    		  data_1.push(item);
    		  cargaTablaIndividual(id,data_1);
    	  }else{
    		  
    		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
    		  return false;
    	  }
    	  
    } else if (id==2){
   	 
   	 
   	 $.each(data_2, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_2.push(item);
  		  cargaTablaIndividual(id,data_2);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
   	 
   	 
   	 
   } else if (id==5){
  	 
  	 
  	 $.each(data_5, function(index, value) {
     	  if(value.respuesta_pregunta==selected){
     		  
     		  validacion=true;
     		  return;
     	  }
       });
 	  
 	  if(!validacion){
 		  data_5.push(item);
 		  cargaTablaIndividual(id,data_5);
 	  }else{
 		  
 		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
 		  return false;
 	  }
  	 
  	 
  	 
  }else if (id==6){
    	 
    	 
    	 $.each(data_6, function(index, value) {
       	  if(value.respuesta_pregunta==selected){
       		  
       		  validacion=true;
       		  return;
       	  }
         });
   	  
   	  if(!validacion){
   		  data_6.push(item);
   		  cargaTablaIndividual(id,data_6);
   	  }else{
   		  
   		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
   		  return false;
   	  }
    	 
    	 
    	 
    }else if (id==8){
    	 
      	 $.each(data_8, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_8.push(item);
     		  cargaTablaIndividual(id,data_8);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  }
     	  
    }else if (id==9){
    	 
      	 $.each(data_9, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_9.push(item);
     		  cargaTablaIndividual(id,data_9);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  }
    }else if (id==10){
    	 
      	 $.each(data_10, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_10.push(item);
     		  cargaTablaIndividual(id,data_10);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  }
     	  
    }else if (id==11){
    	 
      	 $.each(data_11, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_11.push(item);
     		  cargaTablaIndividual(id,data_11);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  } 
    	
    }else if (id==12){
    	 
      	 $.each(data_12, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_12.push(item);
     		  cargaTablaIndividual(id,data_12);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  }
     	  
     	 
    }else if (id==13){
    	 
      	 $.each(data_13, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_13.push(item);
     		  cargaTablaIndividual(id,data_13);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  }
     	  
     	 
    }else if (id==14){
    	 
      	 $.each(data_14, function(index, value) {
         	  if(value.respuesta_pregunta==selected){
         		  
         		  validacion=true;
         		  return;
         	  }
           });
     	  
     	  if(!validacion){
     		  data_14.push(item);
     		  cargaTablaIndividual(id,data_14);
     	  }else{
     		  
     		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
     		  return false;
     	  }
     	  
     	  //des qui para censo
		
		  
    }else if (id==23){
	   	 
   	 $.each(data_23, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_23.push(item);
  		  cargaTablaIndividual(id,data_23);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==24){
	   	 
   	 $.each(data_24, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_24.push(item);
  		  cargaTablaIndividual(id,data_24);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==26){
	   	 
   	 $.each(data_26, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_26.push(item);
  		  cargaTablaIndividual(id,data_26);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==27){
	   	 
   	 $.each(data_27, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_27.push(item);
  		  cargaTablaIndividual(id,data_27);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==28){
	   	 
   	 $.each(data_28, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_28.push(item);
  		  cargaTablaIndividual(id,data_28);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==30){
	   	 
   	 $.each(data_30, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_30.push(item);
  		  cargaTablaIndividual(id,data_30);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==31){
	   	 
   	 $.each(data_31, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_31.push(item);
  		  cargaTablaIndividual(id,data_31);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==32){
	   	 
   	 $.each(data_32, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_32.push(item);
  		  cargaTablaIndividual(id,data_32);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==34){
	   	 
   	 $.each(data_34, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_34.push(item);
  		  cargaTablaIndividual(id,data_34);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==35){
	   	 
   	 $.each(data_35, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_35.push(item);
  		  cargaTablaIndividual(id,data_35);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }else if (id==36){
	   	 
   	 $.each(data_36, function(index, value) {
      	  if(value.respuesta_pregunta==selected){
      		  
      		  validacion=true;
      		  return;
      	  }
        });
  	  
  	  if(!validacion){
  		  data_36.push(item);
  		  cargaTablaIndividual(id,data_36);
  	  }else{
  		  
  		  $("#id_preguntas_encuestas_detalle_"+id).notify("Ya se encuentra agregada",{ position:"buttom left", autoHideDelay: 2000});
  		  return false;
  	  }
 }
    
    //vacio
    cleanInputsIndividual(id);
	
}



function cleanInputsIndividual(id){
	
	$('#id_preguntas_encuestas_detalle_'+id).val(0);
	$('#nombre_otros_'+id).val("");
	
	
}



function cargaTablaIndividual(id, data){
    
	let $ddltabla = $("#md_tbl_respuestas_"+id+" tbody");
    
	    $ddltabla.empty();
	    
          $.each(data, function(index, value) {
        	  let $filaAportes = "<tr><td>" +value.respuesta_pregunta+"</td><td><button class='btn btn-danger btn-sm' onclick='quitarIndividual("+id+","+index+")' style='font-size:65%;'><i class='glyphicon glyphicon-trash'></i></button></td></tr>";
        	  $ddltabla.append($filaAportes);	
        	
        	  	
          });
   
}


function quitarIndividual(id, index){
	
	
    if(id==1){
    	 data_1.splice(index, 1);
    	 cargaTablaIndividual(id,data_1);
    }else if (id==2){
    	 data_2.splice(index, 1);
    	 cargaTablaIndividual(id,data_2);
    }else if (id==5){
    	 data_5.splice(index, 1);
    	 cargaTablaIndividual(id,data_5);
    }else if (id==6){
    	 data_6.splice(index, 1);
    	 cargaTablaIndividual(id,data_6);
    }else if (id==8){
    	 data_8.splice(index, 1);
    	 cargaTablaIndividual(id,data_8);
    }else if (id==9){
    	 data_9.splice(index, 1);
    	 cargaTablaIndividual(id,data_9);
    }else if (id==10){
    	 data_10.splice(index, 1);
    	 cargaTablaIndividual(id,data_10);
    }else if (id==11){
		 data_11.splice(index, 1);
		 cargaTablaIndividual(id,data_11);
	}else if (id==12){
		 data_12.splice(index, 1);
		 cargaTablaIndividual(id,data_12);
	}else if (id==13){
		 data_13.splice(index, 1);
		 cargaTablaIndividual(id,data_13);
	}else if (id==14){
		 data_14.splice(index, 1);
		 cargaTablaIndividual(id,data_14);
	}
    //desde aqui censos
    else if (id==23){
  	 data_23.splice(index, 1);
	 cargaTablaIndividual(id,data_23);
    }else if (id==24){
 	 data_24.splice(index, 1);
	 cargaTablaIndividual(id,data_24);
    }else if (id==26){
 	 data_26.splice(index, 1);
	 cargaTablaIndividual(id,data_26);
    }else if (id==27){
 	 data_27.splice(index, 1);
	 cargaTablaIndividual(id,data_27);
    }else if (id==28){
     data_28.splice(index, 1);
	 cargaTablaIndividual(id,data_28);
    }else if (id==30){
	 data_30.splice(index, 1);
	 cargaTablaIndividual(id,data_30);
    }else if (id==31){
	 data_31.splice(index, 1);
	 cargaTablaIndividual(id,data_31);
    }else if (id==32){
	 data_32.splice(index, 1);
	 cargaTablaIndividual(id,data_32);
    }else if (id==34){
	 data_34.splice(index, 1);
	 cargaTablaIndividual(id,data_34);
    }else if (id==35){
	 data_35.splice(index, 1);
	 cargaTablaIndividual(id,data_35);
    }else if (id==36){
	 data_36.splice(index, 1);
	 cargaTablaIndividual(id,data_36);
    }
    
	
    
}





function cargaProvincias(){
      
      let $id_provincias = $("#id_provincias");
      
      $.ajax({
            beforeSend:function(){},
            url:"index.php?controller=Encuesta&action=cargaProvincias",
            type:"POST",
            dataType:"json",
            data:null
      }).done(function(datos){           
            
    	  $id_provincias.empty();
    	  $id_provincias.append("<option value='0' >--Seleccione--</option>");
            
            $.each(datos.data, function(index, value) {
            	$id_provincias.append("<option value= " +value.id_provincias +" >" + value.nombre_provincias  + "</option>"); 
            });
            
      }).fail(function(xhr,status,error){
            var err = xhr.responseText
            console.log(err)
            $id_provincias.empty();
            $id_provincias.append("<option value='0' >--Seleccione--</option>");
            
      })
     
}





function cargaCantones(id_provincias){
      
	  let $id_cantones = $("#id_cantones");
      
      $.ajax({
            beforeSend:function(){},
            url:"index.php?controller=Encuesta&action=cargaCantones",
            type:"POST",
            dataType:"json",
            data:{id_provincias:id_provincias}
      }).done(function(datos){           
            
    	  $id_cantones.empty();
    	  $id_cantones.append("<option value='0' >--Seleccione--</option>");
            
            $.each(datos.data, function(index, value) {
            	$id_cantones.append("<option value= " +value.id_cantones +" >" + value.nombre_cantones  + "</option>");     
            });
            
      }).fail(function(xhr,status,error){
            var err = xhr.responseText
            console.log(err)
            $id_cantones.empty();
            $id_cantones.append("<option value='0' >--Seleccione--</option>");
            
      })
      
}




$("#id_provincias").change(function() {
      
	  var id_provincias = $(this).val();
	  let $ddlid_cantones = $("#id_cantones");
	  $ddlid_cantones.empty();
	  $ddlid_cantones.append("<option value='0' >--Seleccione--</option>");
	  cargaCantones(id_provincias);
	 
 });





function fnBeforeAction(mensaje){

	swal({
        title: "PROCESANDO",
        text: mensaje,
        icon: "view/images/ajax-loader.gif",        
      })
}


function ProcesarMarketShare(){
	
	let $id_tipo_encuestas	= $("#id_tipo_encuestas");
	let $razon_social	= $("#razon_social");
	let	$nombre_contacto 	= $("#nombre_contacto");
	let	$id_provincias	= $("#id_provincias");
	let	$id_cantones	= $("#id_cantones");
		
	let $calle_principal	= $("#calle_principal");
	let	$calle_secundaria 	= $("#calle_secundaria");
	let	$numero_calle	= $("#numero_calle");
	let	$referencia_ubicacion	= $("#referencia_ubicacion");
	
	
	let	$id_pregunta_1 	= $("#id_pregunta_1");
	let $md_tbl_respuestas_1 = $("#md_tbl_respuestas_1"); 
	
	let	$id_pregunta_2 	= $("#id_pregunta_2");
	let $md_tbl_respuestas_2 = $("#md_tbl_respuestas_2"); 
	
	let	$id_pregunta_3 	= $("#id_pregunta_3");
	let $respuesta_pregunta_3 = $("#respuesta_pregunta_3"); 
	
	let	$id_pregunta_4	= $("#id_pregunta_4");
	let $respuesta_pregunta_4 = $("#respuesta_pregunta_4"); 
	
	let	$id_pregunta_5	= $("#id_pregunta_5");
	let $md_tbl_respuestas_5 = $("#md_tbl_respuestas_5"); 
	
	let	$id_pregunta_6	= $("#id_pregunta_6");
	let $md_tbl_respuestas_6 = $("#md_tbl_respuestas_6"); 
	
	let	$id_pregunta_7	= $("#id_pregunta_7");
	let $respuesta_pregunta_7 = $("#respuesta_pregunta_7"); 
	
	let	$id_pregunta_8	= $("#id_pregunta_8");
	let $md_tbl_respuestas_8 = $("#md_tbl_respuestas_8"); 
	
	let	$id_pregunta_9	= $("#id_pregunta_9");
	let $md_tbl_respuestas_9 = $("#md_tbl_respuestas_9"); 
	
	let	$id_pregunta_10	= $("#id_pregunta_10");
	let $md_tbl_respuestas_10 = $("#md_tbl_respuestas_10"); 

	let	$id_pregunta_11	= $("#id_pregunta_11");
	let $md_tbl_respuestas_11 = $("#md_tbl_respuestas_11"); 
	
	let	$id_pregunta_12	= $("#id_pregunta_12");
	let $md_tbl_respuestas_12 = $("#md_tbl_respuestas_12"); 


	let	$id_pregunta_13	= $("#id_pregunta_13");
	let $md_tbl_respuestas_13 = $("#md_tbl_respuestas_13"); 
	
	let	$id_pregunta_14	= $("#id_pregunta_14");
	let $md_tbl_respuestas_14 = $("#md_tbl_respuestas_14"); 

	
	let	$id_pregunta_15	= $("#id_pregunta_15");
	let	$id_preguntas_encuestas_detalle_15	= $("#id_preguntas_encuestas_detalle_15");
	
	let	$id_pregunta_16 = $("#id_pregunta_16");
	let	$id_preguntas_encuestas_detalle_16	= $("#id_preguntas_encuestas_detalle_16");
	
	let	$id_pregunta_17	= $("#id_pregunta_17");
	let	$id_preguntas_encuestas_detalle_17	= $("#id_preguntas_encuestas_detalle_17");
	
	let	$id_pregunta_18	= $("#id_pregunta_18");
	let	$id_preguntas_encuestas_detalle_18	= $("#id_preguntas_encuestas_detalle_18");
	
	let	$id_pregunta_19	= $("#id_pregunta_19");
	let	$id_preguntas_encuestas_detalle_19	= $("#id_preguntas_encuestas_detalle_19");
	
	let	$id_pregunta_20	= $("#id_pregunta_20");
	let	$id_preguntas_encuestas_detalle_20	= $("#id_preguntas_encuestas_detalle_20");
	
	let	$id_pregunta_21	= $("#id_pregunta_21");
	let	$id_preguntas_encuestas_detalle_21	= $("#id_preguntas_encuestas_detalle_21");
	
	let	$id_pregunta_22	= $("#id_pregunta_22");
	let	$id_preguntas_encuestas_detalle_22	= $("#id_preguntas_encuestas_detalle_22");
	
	
    var tiempo = tiempo || 1000;
	 
    
    if($id_tipo_encuestas.val()==0){
    	$id_tipo_encuestas.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_encuestas).offset().top-120 }, tiempo);
 		
		return false;
    	
    }
    
	
	if($razon_social.val() == "" && $razon_social.val().length ==0  ){
		$razon_social.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($razon_social).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($nombre_contacto.val() == "" && $nombre_contacto.val().length ==0  ){
		$nombre_contacto.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($nombre_contacto).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_provincias.val() == 0  ){
		$id_provincias.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_provincias).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_cantones.val() == 0  ){
		$id_cantones.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_cantones).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($calle_principal.val() == "" && $calle_principal.val().length ==0  ){
		$calle_principal.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($calle_principal).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($calle_secundaria.val() == "" && $calle_secundaria.val().length ==0  ){
		$calle_secundaria.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($calle_secundaria).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($numero_calle.val() == "" && $numero_calle.val().length ==0  ){
		$numero_calle.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($numero_calle).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($referencia_ubicacion.val() == "" && $referencia_ubicacion.val().length ==0  ){
		$referencia_ubicacion.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($referencia_ubicacion).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	
	
	if(data_1.length == 0 ){
		$md_tbl_respuestas_1.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_1).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if(data_2.length == 0 ){
		$md_tbl_respuestas_2.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_2).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
		
       if($respuesta_pregunta_3.val() ==""){
			
			$respuesta_pregunta_3.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($respuesta_pregunta_3).offset().top-120 }, tiempo);
	 		return false;
		}
	
	
		if($respuesta_pregunta_4.val() ==""){
			
			$respuesta_pregunta_4.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($respuesta_pregunta_4).offset().top-120 }, tiempo);
	 		return false;
		}


	if(data_5.length == 0 ){
		$md_tbl_respuestas_5.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_5).offset().top-120 }, tiempo);
 		
		return false;
	}
   	
   	

	if(data_6.length == 0 ){
		$md_tbl_respuestas_6.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_6).offset().top-120 }, tiempo);
 		
		return false;
	}
   	
   	if($respuesta_pregunta_7.val() == ""){
			
			$respuesta_pregunta_7.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($respuesta_pregunta_7).offset().top-120 }, tiempo);
	 		return false;
		}
   	

	if(data_8.length == 0 ){
		$md_tbl_respuestas_8.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_8).offset().top-120 }, tiempo);
 		
		return false;
	}
	

	if(data_9.length == 0 ){
		$md_tbl_respuestas_9.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_9).offset().top-120 }, tiempo);
 		
		return false;
	}
	if(data_10.length == 0 ){
		$md_tbl_respuestas_10.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_10).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if(data_11.length == 0 ){
		$md_tbl_respuestas_11.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_11).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if(data_12.length == 0 ){
		$md_tbl_respuestas_12.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_12).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if(data_13.length == 0 ){
		$md_tbl_respuestas_13.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_13).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if(data_14.length == 0 ){
		$md_tbl_respuestas_14.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_14).offset().top-120 }, tiempo);
 		
		return false;
	}
	
   	
	
	if($id_preguntas_encuestas_detalle_15.val() == 0 ){
		$id_preguntas_encuestas_detalle_15.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_15).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_preguntas_encuestas_detalle_16.val() == 0 ){
		$id_preguntas_encuestas_detalle_16.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_16).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_preguntas_encuestas_detalle_17.val() == 0 ){
		$id_preguntas_encuestas_detalle_17.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_17).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_preguntas_encuestas_detalle_18.val() == 0 ){
		$id_preguntas_encuestas_detalle_18.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_18).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_preguntas_encuestas_detalle_19.val() == 0 ){
		$id_preguntas_encuestas_detalle_19.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_19).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($id_preguntas_encuestas_detalle_20.val() == 0 ){
		$id_preguntas_encuestas_detalle_20.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_20).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($id_preguntas_encuestas_detalle_21.val() == 0 ){
		$id_preguntas_encuestas_detalle_21.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_21).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($id_preguntas_encuestas_detalle_22.val() == 0 ){
		$id_preguntas_encuestas_detalle_22.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_22).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	

	
	var arrayDatos1;	
	var arrayDatos2;	
	var arrayDatos5;	
	var arrayDatos6;	
	var arrayDatos8;	
	var arrayDatos9;	
	var arrayDatos10;
	var arrayDatos11;	
	var arrayDatos12;
	var arrayDatos13;	
	var arrayDatos14;

	
	
	var parametros = new FormData();
	arrayDatos1 	= JSON.stringify(data_1);
	arrayDatos2 	= JSON.stringify(data_2);
	arrayDatos5 	= JSON.stringify(data_5);
	arrayDatos6 	= JSON.stringify(data_6);
	arrayDatos8 	= JSON.stringify(data_8);
	arrayDatos9 	= JSON.stringify(data_9);
	arrayDatos10 	= JSON.stringify(data_10);
	arrayDatos11 	= JSON.stringify(data_11);
	arrayDatos12 	= JSON.stringify(data_12);
	arrayDatos13 	= JSON.stringify(data_13);
	arrayDatos14 	= JSON.stringify(data_14);
	
	
	parametros.append('lista_detalle_1', arrayDatos1);
	parametros.append('lista_detalle_2', arrayDatos2);
	parametros.append('lista_detalle_5', arrayDatos5);
	parametros.append('lista_detalle_6', arrayDatos6);
	parametros.append('lista_detalle_8', arrayDatos8);
	parametros.append('lista_detalle_9', arrayDatos9);
	parametros.append('lista_detalle_10', arrayDatos10);
	parametros.append('lista_detalle_11', arrayDatos11);
	parametros.append('lista_detalle_12', arrayDatos12);
	
	parametros.append('lista_detalle_13', arrayDatos13);
	parametros.append('lista_detalle_14', arrayDatos14);
	parametros.append('id_tipo_encuestas',$id_tipo_encuestas.val()); 
	parametros.append('razon_social',$razon_social.val()); 
	parametros.append('nombre_contacto',$nombre_contacto.val());
	parametros.append('id_provincias',$id_provincias.val());
	parametros.append('id_cantones',$id_cantones.val());
	parametros.append('calle_principal',$calle_principal.val());
	parametros.append('calle_secundaria',$calle_secundaria.val());
	parametros.append('numero_calle',$numero_calle.val());
	parametros.append('referencia_ubicacion',$referencia_ubicacion.val());
	parametros.append('id_pregunta_1',$id_pregunta_1.val());
	parametros.append('id_pregunta_2',$id_pregunta_2.val());
	parametros.append('id_pregunta_3',$id_pregunta_3.val());
	parametros.append('respuesta_pregunta_3',$respuesta_pregunta_3.val());
	parametros.append('id_pregunta_4',$id_pregunta_4.val());
	parametros.append('respuesta_pregunta_4',$respuesta_pregunta_4.val());
	parametros.append('id_pregunta_5',$id_pregunta_5.val());
	parametros.append('id_pregunta_6',$id_pregunta_6.val());
	parametros.append('id_pregunta_7',$id_pregunta_7.val());
	parametros.append('respuesta_pregunta_7',$respuesta_pregunta_7.val());
	parametros.append('id_pregunta_8',$id_pregunta_8.val());
	parametros.append('id_pregunta_9',$id_pregunta_9.val());
	parametros.append('id_pregunta_10',$id_pregunta_10.val());
	parametros.append('id_pregunta_11',$id_pregunta_11.val());
	parametros.append('id_pregunta_12',$id_pregunta_12.val());
	parametros.append('id_pregunta_13',$id_pregunta_13.val());
	parametros.append('id_pregunta_14',$id_pregunta_14.val());
	
	
	parametros.append('id_pregunta_15',$id_pregunta_15.val());
	parametros.append('id_preguntas_encuestas_detalle_15',$id_preguntas_encuestas_detalle_15.val());

	parametros.append('id_pregunta_16',$id_pregunta_16.val());
	parametros.append('id_preguntas_encuestas_detalle_16',$id_preguntas_encuestas_detalle_16.val());

	parametros.append('id_pregunta_17',$id_pregunta_17.val());
	parametros.append('id_preguntas_encuestas_detalle_17',$id_preguntas_encuestas_detalle_17.val());

	parametros.append('id_pregunta_18',$id_pregunta_18.val());
	parametros.append('id_preguntas_encuestas_detalle_18',$id_preguntas_encuestas_detalle_18.val());

	parametros.append('id_pregunta_19',$id_pregunta_19.val());
	parametros.append('id_preguntas_encuestas_detalle_19',$id_preguntas_encuestas_detalle_19.val());

	parametros.append('id_pregunta_20',$id_pregunta_20.val());
	parametros.append('id_preguntas_encuestas_detalle_20',$id_preguntas_encuestas_detalle_20.val());
	
	parametros.append('id_pregunta_21',$id_pregunta_21.val());
	parametros.append('id_preguntas_encuestas_detalle_21',$id_preguntas_encuestas_detalle_21.val());
	
	parametros.append('id_pregunta_22',$id_pregunta_22.val());
	parametros.append('id_preguntas_encuestas_detalle_22',$id_preguntas_encuestas_detalle_22.val());
	
	
	parametros.append('lng',view.lng);
	parametros.append('lat',view.lat);
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Encuesta&action=procesar",
		type:"POST",
		dataType:"json",
		data:parametros,		
		contentType: false, 
        processData: false  
       


	}).done(function(x){
		swal.close();
		
		if( x.respuesta != undefined && x.respuesta != ""){
			
			swal( {
				 title:"ENCUESTA",
				 dangerMode: false,
				 text: "Encuesta Registrada Correctamente",
				 icon: "success"
				});
			
			cleanInputsEncuesta();			
		}
		
		
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




function cleanInputsEncuesta(){
	
	 view.lng="";
	 view.lat="";
	
		$('#razon_social').val("");
		$('#nombre_contacto').val("");
		$('#id_provincias').val(0);
		$('#id_cantones').val(0);
		$('#calle_principal').val("");
		$('#calle_secundaria').val("");
		$('#numero_calle').val("");
		$('#referencia_ubicacion').val("");
		 

	    $("#id_tipo_encuestas").val("0"); 
		$("#respuesta_pregunta_4").val("0"); 
		$("#respuesta_pregunta_3").val("0"); 
		$("#respuesta_pregunta_7").val("0"); 
		$("#id_preguntas_encuestas_detalle_13").val("0");
		$("#id_preguntas_encuestas_detalle_14").val("0");
		$("#id_preguntas_encuestas_detalle_15").val("0");
		$("#id_preguntas_encuestas_detalle_16").val("0");
		$("#id_preguntas_encuestas_detalle_17").val("0");
		$("#id_preguntas_encuestas_detalle_18").val("0");
		$("#id_preguntas_encuestas_detalle_19").val("0");
		$("#id_preguntas_encuestas_detalle_20").val("0");
		
		$("#id_preguntas_encuestas_detalle_21").val("0");
		
		$("#id_preguntas_encuestas_detalle_22").val("0");
		
		$("#div_encuesta_1").fadeOut("slow");
		$("#div_encuesta_2").fadeOut("slow");
	 
	 
	data_1.length=0;
	data_2.length=0;
	data_5.length=0;
	data_6.length=0;
	data_8.length=0;
	data_9.length=0;
	data_10.length=0;

	data_11.length=0;
	data_12.length=0;
	
	data_13.length=0;
	data_14.length=0;
	
	
	cargaTablaIndividual(1, data_1);
	cargaTablaIndividual(2, data_2);
	cargaTablaIndividual(5, data_5);
	cargaTablaIndividual(6, data_6);
	cargaTablaIndividual(8, data_8);
	cargaTablaIndividual(9, data_9);
	cargaTablaIndividual(10, data_10);

	cargaTablaIndividual(11, data_11);
	cargaTablaIndividual(12, data_12);
	cargaTablaIndividual(13, data_13);
	cargaTablaIndividual(14, data_14);
	
}




		
	



// insertada y vaciada para censo









function ProcesarCenso(){
	
	let $id_tipo_encuestas	= $("#id_tipo_encuestas");
	let $razon_social	= $("#razon_social");
	let	$nombre_contacto 	= $("#nombre_contacto");
	let	$id_provincias	= $("#id_provincias");
	let	$id_cantones	= $("#id_cantones");
		
	let $calle_principal	= $("#calle_principal");
	let	$calle_secundaria 	= $("#calle_secundaria");
	let	$numero_calle	= $("#numero_calle");
	let	$referencia_ubicacion	= $("#referencia_ubicacion");
	
	
	
	
	
	
	let	$id_pregunta_23	= $("#id_pregunta_23");
	let $md_tbl_respuestas_23 = $("#md_tbl_respuestas_23"); 
	
	let	$id_pregunta_24	= $("#id_pregunta_24");
	let $md_tbl_respuestas_24 = $("#md_tbl_respuestas_24"); 
	
	let	$id_pregunta_25	= $("#id_pregunta_25");
	let	$id_preguntas_encuestas_detalle_25	= $("#id_preguntas_encuestas_detalle_25");
	
	
	let	$id_pregunta_26	= $("#id_pregunta_26");
	let $md_tbl_respuestas_26 = $("#md_tbl_respuestas_26"); 
	
	let	$id_pregunta_27	= $("#id_pregunta_27");
	let $md_tbl_respuestas_27 = $("#md_tbl_respuestas_27"); 
	
	let	$id_pregunta_28	= $("#id_pregunta_28");
	let $md_tbl_respuestas_28 = $("#md_tbl_respuestas_28"); 
	
	let	$id_pregunta_29	= $("#id_pregunta_29");
	let	$id_preguntas_encuestas_detalle_29	= $("#id_preguntas_encuestas_detalle_29");
	
	let	$id_pregunta_30	= $("#id_pregunta_30");
	let $md_tbl_respuestas_30 = $("#md_tbl_respuestas_30"); 
	
	let	$id_pregunta_31	= $("#id_pregunta_31");
	let $md_tbl_respuestas_31 = $("#md_tbl_respuestas_31"); 
	
	let	$id_pregunta_32	= $("#id_pregunta_32");
	let $md_tbl_respuestas_32 = $("#md_tbl_respuestas_32"); 
	
	let	$id_pregunta_33	= $("#id_pregunta_33");
	let	$id_preguntas_encuestas_detalle_33	= $("#id_preguntas_encuestas_detalle_33");
	
	let	$id_pregunta_34	= $("#id_pregunta_34");
	let $md_tbl_respuestas_34 = $("#md_tbl_respuestas_34"); 
	
	let	$id_pregunta_35	= $("#id_pregunta_35");
	let $md_tbl_respuestas_35 = $("#md_tbl_respuestas_35"); 
	
	let	$id_pregunta_36	= $("#id_pregunta_36");
	let $md_tbl_respuestas_36 = $("#md_tbl_respuestas_36"); 
	
	
	let	$id_pregunta_37	= $("#id_pregunta_37");
	let	$id_preguntas_encuestas_detalle_37	= $("#id_preguntas_encuestas_detalle_37");
	
	
	
    var tiempo = tiempo || 1000;
	 
	
    
    if($id_tipo_encuestas.val()==0){
    	$id_tipo_encuestas.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_tipo_encuestas).offset().top-120 }, tiempo);
 		
		return false;
    	
    }
    
	if($razon_social.val() == "" && $razon_social.val().length ==0  ){
		$razon_social.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($razon_social).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($nombre_contacto.val() == "" && $nombre_contacto.val().length ==0  ){
		$nombre_contacto.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($nombre_contacto).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_provincias.val() == 0  ){
		$id_provincias.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_provincias).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($id_cantones.val() == 0  ){
		$id_cantones.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_cantones).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($calle_principal.val() == "" && $calle_principal.val().length ==0  ){
		$calle_principal.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($calle_principal).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($calle_secundaria.val() == "" && $calle_secundaria.val().length ==0  ){
		$calle_secundaria.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($calle_secundaria).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	if($numero_calle.val() == "" && $numero_calle.val().length ==0  ){
		$numero_calle.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($numero_calle).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($referencia_ubicacion.val() == "" && $referencia_ubicacion.val().length ==0  ){
		$referencia_ubicacion.notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($referencia_ubicacion).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	
	if(data_23.length == 0 ){
			$md_tbl_respuestas_23.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_23).offset().top-120 }, tiempo);
	 		
			return false;
		}
   	
	if(data_24.length == 0 ){
			$md_tbl_respuestas_24.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_24).offset().top-120 }, tiempo);
	 		
			return false;
		}
	
	
	//si es si
	
	if($id_preguntas_encuestas_detalle_25.val() == 0 ){
		$id_preguntas_encuestas_detalle_25.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_25).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	if($id_preguntas_encuestas_detalle_25.val()==357){
		

		if(data_26.length == 0 ){
			$md_tbl_respuestas_26.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_26).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
		if(data_27.length == 0 ){
			$md_tbl_respuestas_27.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_27).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
	}else{
		if(data_26.length == 0 ){
			
		}else{
			
			$md_tbl_respuestas_26.notify("Detalle debe ir vacio",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_26).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
		if(data_27.length == 0 ){
			
		}else{
			
			$md_tbl_respuestas_27.notify("Detalle debe ir vacio",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_27).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
	}
	
	
	if(data_28.length == 0 ){
		$md_tbl_respuestas_28.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_28).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
	
	
    // si es si la otra pregunta
	

	
	if($id_preguntas_encuestas_detalle_29.val() == 0 ){
		$id_preguntas_encuestas_detalle_29.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_29).offset().top-120 }, tiempo);
 		
		return false;
	}
   	
	
	
	if($id_preguntas_encuestas_detalle_29.val()==375){
		

		if(data_30.length == 0 ){
			$md_tbl_respuestas_30.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_30).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
		if(data_31.length == 0 ){
			$md_tbl_respuestas_31.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_31).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
	}else{
		if(data_30.length == 0 ){
			
		}else{
			
			$md_tbl_respuestas_30.notify("Detalle debe ir vacio",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_30).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
		if(data_31.length == 0 ){
			
		}else{
			
			$md_tbl_respuestas_31.notify("Detalle debe ir vacio",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_31).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
	}
	
	
	if(data_32.length == 0 ){
		$md_tbl_respuestas_32.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_32).offset().top-120 }, tiempo);
 		
		return false;
	}
	
	
    // si es si la otra pregunta
	

	
	if($id_preguntas_encuestas_detalle_33.val() == 0 ){
		$id_preguntas_encuestas_detalle_33.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_33).offset().top-120 }, tiempo);
 		
		return false;
	}
   	
	
	
	if($id_preguntas_encuestas_detalle_33.val()==395){
		

		if(data_34.length == 0 ){
			$md_tbl_respuestas_34.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_34).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
		if(data_35.length == 0 ){
			$md_tbl_respuestas_35.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_35).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
	}else{
		if(data_34.length == 0 ){
			
		}else{
			
			$md_tbl_respuestas_34.notify("Detalle debe ir vacio",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_34).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
		if(data_35.length == 0 ){
			
		}else{
			
			$md_tbl_respuestas_35.notify("Detalle debe ir vacio",{ position:"buttom left", autoHideDelay: 2000});
			$("html, body").animate({ scrollTop: $($md_tbl_respuestas_35).offset().top-120 }, tiempo);
	 		
			return false;
		}
		
		
	}
	
	
	
    if(data_36.length == 0 ){
   		$md_tbl_respuestas_36.notify("Ingrese Detalle",{ position:"buttom left", autoHideDelay: 2000});
   		$("html, body").animate({ scrollTop: $($md_tbl_respuestas_36).offset().top-120 }, tiempo);
    		
   		return false;
   	}
	
	if($id_preguntas_encuestas_detalle_37.val() == 0 ){
		$id_preguntas_encuestas_detalle_37.notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
		$("html, body").animate({ scrollTop: $($id_preguntas_encuestas_detalle_37).offset().top-120 }, tiempo);
 		
		return false;
	}
		
   
	

    
		
	var arrayDatos23;	
	var arrayDatos24;	
	var arrayDatos26;	
	var arrayDatos27;	
	var arrayDatos28;	
	
	var arrayDatos30;	
	var arrayDatos31;	
	var arrayDatos32;	
	var arrayDatos34;	
	var arrayDatos35;	
	var arrayDatos36;	
	
	
	var parametros = new FormData();
	arrayDatos23 	= JSON.stringify(data_23);
	arrayDatos24 	= JSON.stringify(data_24);
	arrayDatos26 	= JSON.stringify(data_26);
	arrayDatos27 	= JSON.stringify(data_27);
	arrayDatos28 	= JSON.stringify(data_28);
	arrayDatos30 	= JSON.stringify(data_30);
	arrayDatos31 	= JSON.stringify(data_31);
	arrayDatos32 	= JSON.stringify(data_32);
	
	arrayDatos34 	= JSON.stringify(data_34);
	arrayDatos35 	= JSON.stringify(data_35);
	arrayDatos36 	= JSON.stringify(data_36);
	
	
	
	parametros.append('lista_detalle_23', arrayDatos23);
	parametros.append('lista_detalle_24', arrayDatos24);
	parametros.append('lista_detalle_26', arrayDatos26);
	parametros.append('lista_detalle_27', arrayDatos27);
	
	parametros.append('lista_detalle_28', arrayDatos28);
	parametros.append('lista_detalle_30', arrayDatos30);
	parametros.append('lista_detalle_31', arrayDatos31);
	parametros.append('lista_detalle_32', arrayDatos32);
	
	parametros.append('lista_detalle_34', arrayDatos34);
	parametros.append('lista_detalle_35', arrayDatos35);
	parametros.append('lista_detalle_36', arrayDatos36);

	parametros.append('id_tipo_encuestas',$id_tipo_encuestas.val()); 
	parametros.append('razon_social',$razon_social.val()); 
	parametros.append('nombre_contacto',$nombre_contacto.val());
	parametros.append('id_provincias',$id_provincias.val());
	parametros.append('id_cantones',$id_cantones.val());
	parametros.append('calle_principal',$calle_principal.val());
	parametros.append('calle_secundaria',$calle_secundaria.val());
	parametros.append('numero_calle',$numero_calle.val());
	parametros.append('referencia_ubicacion',$referencia_ubicacion.val());
	
	
	parametros.append('id_pregunta_23',$id_pregunta_23.val());
	parametros.append('id_pregunta_24',$id_pregunta_24.val());
	parametros.append('id_pregunta_25',$id_pregunta_25.val());
	parametros.append('id_preguntas_encuestas_detalle_25',$id_preguntas_encuestas_detalle_25.val());
	parametros.append('id_pregunta_26',$id_pregunta_26.val());
	parametros.append('id_pregunta_27',$id_pregunta_27.val());
	
	
	parametros.append('id_pregunta_28',$id_pregunta_28.val());
	parametros.append('id_pregunta_29',$id_pregunta_29.val());
	parametros.append('id_preguntas_encuestas_detalle_29',$id_preguntas_encuestas_detalle_29.val());
	parametros.append('id_pregunta_30',$id_pregunta_30.val());
	parametros.append('id_pregunta_31',$id_pregunta_31.val());
	parametros.append('id_pregunta_32',$id_pregunta_32.val());
	
	parametros.append('id_pregunta_33',$id_pregunta_33.val());
	parametros.append('id_preguntas_encuestas_detalle_33',$id_preguntas_encuestas_detalle_33.val());
	parametros.append('id_pregunta_34',$id_pregunta_34.val());
	parametros.append('id_pregunta_35',$id_pregunta_35.val());
	parametros.append('id_pregunta_36',$id_pregunta_36.val());
	
	parametros.append('id_pregunta_37',$id_pregunta_37.val());
	parametros.append('id_preguntas_encuestas_detalle_37',$id_preguntas_encuestas_detalle_37.val());
	
	
	parametros.append('lng',view.lng);
	parametros.append('lat',view.lat);
	
	$.ajax({
		beforeSend:fnBeforeAction('Estamos procesado la información'),
		url:"index.php?controller=Encuesta&action=procesar1",
		type:"POST",
		dataType:"json",
		data:parametros,		
		contentType: false, 
        processData: false  

	}).done(function(x){
		swal.close();
		
		if( x.respuesta != undefined && x.respuesta != ""){
			
			swal( {
				 title:"CENSO",
				 dangerMode: false,
				 text: "Censo Registrado Correctamente",
				 icon: "success"
				});
			
			cleanInputsCenso();			
		}
		
		
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




function cleanInputsCenso(){
	
	 view.lng="";
	 view.lat="";
	/*
	    $('#razon_social').val("");
		$('#nombre_contacto').val("");
		$('#id_provincias').val(0);
		$('#id_cantones').val(0);
		$('#calle_principal').val("");
		$('#calle_secundaria').val("");
		$('#numero_calle').val("");
		$('#referencia_ubicacion').val("");
		*/
		
		
	 
	    $("#id_tipo_encuestas").val("0"); 
		
		$("#id_preguntas_encuestas_detalle_25").val("0");
		$("#id_preguntas_encuestas_detalle_29").val("0");
		
		$("#id_preguntas_encuestas_detalle_33").val("0");
		$("#id_preguntas_encuestas_detalle_37").val("0");
		
		
		$("#div_encuesta_1").fadeOut("slow");
		$("#div_encuesta_2").fadeOut("slow");
	 	
	 
	data_23.length=0;
	data_24.length=0;
	data_26.length=0;
	data_27.length=0;
	
	data_28.length=0;
	data_30.length=0;
	data_31.length=0;
	data_32.length=0;
	
	
	data_34.length=0;
	data_35.length=0;
	data_36.length=0;
	
	cargaTablaIndividual(23, data_23);
	cargaTablaIndividual(24, data_24);
	cargaTablaIndividual(26, data_26);
	cargaTablaIndividual(27, data_27);
	
	cargaTablaIndividual(28, data_28);
	cargaTablaIndividual(30, data_30);
	cargaTablaIndividual(31, data_31);
	cargaTablaIndividual(32, data_32);
	
	
	cargaTablaIndividual(34, data_34);
	cargaTablaIndividual(35, data_35);
	cargaTablaIndividual(36, data_36);
	
	
}





