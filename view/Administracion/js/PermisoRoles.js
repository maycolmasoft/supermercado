function Rol_seleccionado()
{
var rolsel=$("#id_rol").val();
$.ajax({
    url: 'index.php?controller=PermisosRoles&action=Cargar_arbol',
    type: 'POST',
    dataType: 'text',
    data: {selected_rol: rolsel},
})
.done(function(data) {
	$("#arbol_roles").html(data);
	var toggler = document.getElementsByClassName("caret");
	var i;
	for (i = 0; i < toggler.length; i++) {
	  toggler[i].addEventListener("click", function() {
		  
		     this.parentElement.querySelector(".nested").classList.toggle("active");
		 });
	}
	RevisaCheck();
	RevisaControladores();
	
})
.fail(function() {
    console.log("error");
});
}



function RevisaModulos(nombreModulo)
{
	var m = document.getElementsByClassName("sup");
	for(var i=0; i<m.length; i++)
	{
		var l=$("#permlist"+(i+1)+"1 li").length;
		var c=$("#contlist"+(i+1)+" li").length;
		var cc= c/(l+1);
		if (m[i].checked && (m[i].value == nombreModulo || nombreModulo==""))
			{
		for (var j=1; j<=cc; j++)
			{
			var nomcont = "cont"+(i+1)+j;
			var x=document.getElementsByClassName(nomcont);
			x[0].checked=true;
			}
		}
		else
			{
			if (!m[i].checked && (m[i].value == nombreModulo || nombreModulo==""))
				{
			for (var j=1; j<=cc; j++)
			{
			var nomcont = "cont"+(i+1)+j;
			var x=document.getElementsByClassName(nomcont);
			x[0].checked=false;
			}
				}
			}
	
	}
	RevisaControladores("");
	
}



function RevisaControladores(nombreControlador)
{
		
	var m = document.getElementsByClassName("sup");
	for(var i=0; i<m.length; i++)
		{
		var cantcontrol=0;
		var l=$("#permlist"+(i+1)+"1 li").length;
		var c=$("#contlist"+(i+1)+" li").length;
		var cc= c/(l+1);
		
		for (var j=1; j<=cc; j++)
		 {
		 
		 var nomcont = "cont"+(i+1)+j;
		 var nomperm = "permck"+(i+1)+j;
		 var x=document.getElementsByClassName(nomcont);
		 
		 var x1=document.getElementsByClassName(nomperm);
		 if (x[0].checked) cantcontrol++;
		 if (x[0].checked && x[0].value==nombreControlador)
			 {
			 for(var k=0; k<x1.length; k++)
				{
				 x1[k].checked=true;
				}
			 
			 }
		 else
			 {
			 if (!x[0].checked && (x[0].value==nombreControlador || nombreControlador=="" ))
				 {
			 for(var k=0; k<x1.length; k++)
				{
				 x1[k].checked=false;
				}
				 }
			 if (x[0].checked &&  nombreControlador=="" )
				 {
				 for(var k=0; k<x1.length; k++)
					{
					 x1[k].checked=true;
					}
				 }
			 }
			 }
		 if (cantcontrol>0) m[i].checked=true;
		 else m[i].checked=false;
		}
	}


function RevisaCheck()
{ 
	var m = document.getElementsByClassName("sup");
	for(var i=0; i<m.length; i++)
	{
		
		var l=$("#permlist"+(i+1)+"1 li").length;
		var c=$("#contlist"+(i+1)+" li").length;
		var cc= c/(l+1);
		for (var j=1; j<=cc; j++)
			{
			var cantcontrol=0;
			var nomcont = "cont"+(i+1)+j;
			var nomperm = "permck"+(i+1)+j;
 			var x=document.getElementsByClassName(nomcont);
 			var x1=document.getElementsByClassName(nomperm);
 			for(var k=0; k<l; k++)
 				{
 				if (x1[k].checked) cantcontrol++;
 				}
 			if (cantcontrol>0) x[0].checked=true;
 			else x[0].checked=false;
 	
			}
		}
	
	RevisaControladores("s");

}

function MandarDatos()
{
	var rolsel=$("#id_rol").val();
	var mod;
	var contr;
	var pver;
	var pedit;
	var psave;
	var pborrar;
	
	var Arreglo =[];
	var m = document.getElementsByClassName("sup");
	for(var i=0; i<m.length; i++)
	{
		
		if (m[i].checked)
			{
			mod=m[i].value;
			var l=$("#permlist"+(i+1)+"1 li").length;
			var c=$("#contlist"+(i+1)+" li").length;
			var cc= c/(l+1);
			for (var j=1; j<=cc; j++)
			{
				var nomcont = "cont"+(i+1)+j;
				var nomperm = "permck"+(i+1)+j;
				var x=document.getElementsByClassName(nomcont);
	 			var x1=document.getElementsByClassName(nomperm);
	 			if (x[0].checked)
	 				{
	 				contr=x[0].value;
	 				for(var k=0; k<l; k++)
	 				{
	 				if (x1[k].checked && x1[k].value=="ver") pver="t";
	 				else
	 				{
	 					if (!x1[k].checked && x1[k].value=="ver") pver="f";
	 					else
	 					{
	 						if (x1[k].checked && x1[k].value=="guardar") psave="t";
	 						else
	 							{
	 							if (!x1[k].checked && x1[k].value=="guardar") psave="f";
	 							else
	 								{
	 								if (x1[k].checked && x1[k].value=="editar") pedit="t";
	 								else
	 									{
	 									if (!x1[k].checked && x1[k].value=="editar") pedit="f";
	 									else
	 										{
	 										if (x1[k].checked && x1[k].value=="borrar") pborrar="t";
	 										else
	 											{
	 											if (!x1[k].checked && x1[k].value=="borrar") pborrar="f";
	 											}
	 										}
	 									}
	 								}
	 							}
	 					}
	 				}
	 				
	 				}
	 				Arreglo.push([mod,contr,pver, psave, pedit, pborrar]);	
	 		   }
			}
			
			
			}
		
	}

	if(Arreglo.length>0)
		{
	$.ajax({
		url: 'index.php?controller=PermisosRoles&action=ActualizarPermisos',
        type: 'POST',
        data: {
        	nombre_rol:rolsel,
        	condiciones_permisos:Arreglo},
        success: function (data){
        	$("#id_rol").val("0");
        	$("#arbol_roles").html(data);
        },
        error: function (){
        	console.log("fracaso");
        }
	});}
}



$("#btUpdate").click(function() 
			{	    					    
	
	MandarDatos();
	
	
			});

