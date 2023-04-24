
function fnvalidaCedula(Objeto,){
	let txtcedula = $("#"+Objeto);
	
	if (txtcedula.val() == ""){
		return false;
	}
	
	let tipoIdentificacion="";
	
	tipoIdentificacion = ( txtcedula.val().length <= 10 ) ? "C" : "R";
	
	
	//variables de inicio
	var digitoVerificador = null;
	var suma = 0;      
    var residuo = 0;      
    var pri = false;      
    var pub = false;            
    var nat = false;      
    var numeroProvincias = 22;                  
    var modulo = 11;
                
    /* Verifico que el campo no contenga letras */                  
    var ok=1;


    for (i=0; i < txtcedula.val().length && ok==1 ; i++){
        var n = parseInt(txtcedula.val().charAt(i));
        if (isNaN(n)) ok=0;
     }
    
    if (ok==0){
    	console.log("Cedula solo debe contener números");
		return false;
		
     }



	/* Los primeros dos digitos corresponden al codigo de la provincia */
    provincia = txtcedula.val().substr(0,2);

    /* Aqui almacenamos los digitos de la cedula en variables. */
    d1  = txtcedula.val().substr(0,1);         
    d2  = txtcedula.val().substr(1,1);         
    d3  = txtcedula.val().substr(2,1);         
    d4  = txtcedula.val().substr(3,1);         
    d5  = txtcedula.val().substr(4,1);         
    d6  = txtcedula.val().substr(5,1);         
    d7  = txtcedula.val().substr(6,1);         
    d8  = txtcedula.val().substr(7,1);         
    d9  = txtcedula.val().substr(8,1);         
    d10 = txtcedula.val().substr(9,1); 
    
    /* El tercer digito es: */                           
    /* 9 para sociedades privadas y extranjeros   */         
    /* 6 para sociedades publicas */         
    /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 
    
    /* Solo para personas naturales (modulo 10) */         
    if (d3 < 6){           
       nat = true;            
       p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
       p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
       p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
       p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
       p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
       p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
       p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
       p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
       p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
       modulo = 10;
    }else if(d3 == 6){    
    	/* Solo para sociedades publicas (modulo 11) */                  
        /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
       pub = true;             
       p1 = d1 * 3;
       p2 = d2 * 2;
       p3 = d3 * 7;
       p4 = d4 * 6;
       p5 = d5 * 5;
       p6 = d6 * 4;
       p7 = d7 * 3;
       p8 = d8 * 2;            
       p9 = 0;            
    }else if(d3 == 9) { 
    	/* Solo para entidades privadas (modulo 11) */  
        pri = true;                                   
        p1 = d1 * 4;
        p2 = d2 * 3;
        p3 = d3 * 2;
        p4 = d4 * 7;
        p5 = d5 * 6;
        p6 = d6 * 5;
        p7 = d7 * 4;
        p8 = d8 * 3;
        p9 = d9 * 2;            
     }
    
    suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
    residuo = suma % modulo;                                         
    /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
    digitoVerificador = residuo==0 ? 0: modulo - residuo;
    
    //para validar provincias     
    if (provincia < 1 || provincia > numeroProvincias){
    	console.log("El código de la provincia (dos primeros dígitos) es inválido");
		return false;		
      }
    
    //validar deacuerdo al tipo de persona    
    if( tipoIdentificacion == "C" && nat == true){
    	//tipo persona natural con cedula
    	 if(txtcedula.val().length != 10){
    			console.log("Ingrese 10 Digitos");
    			return false;
    			
    		}
    	 
    	 if (d3==7 || d3==8){           
    	    	console.log("El tercer dígito ingresado es inválido");
    	    	return false;
    	    }
    	     	 
    		 
         if (digitoVerificador != d10){ 
        	 
        	console.log("El número de cédula de la persona natural es incorrecto.");
 	    	return false;
         } 

	    return true; 
    	 
    }else if(tipoIdentificacion == "R"){
    	//para ruc
    	if(txtcedula.val().length < 13){
			console.log("Ingrese 13 Digitos");
			return false;
			
		}
    	
    	if(pub==true ){    		
    		//tipo ruc publico			
			
			/* El ruc de las empresas del sector publico terminan con 0001*/         
			if ( txtcedula.val().substr(9,4) != '0001' ){  
				console.log("El ruc de la empresa del sector público debe terminar con 0001");
				return false;
			}
			       
			if (digitoVerificador != d9){  
				console.log("El ruc de la empresa del sector público es incorrecto.");
				return false;
				
			}
			
			return true; 
    	}else if(pri == true){
    		//tipo ruc privado
    		if ( txtcedula.val().substr(10,3) != '001' ){ 
    			console.log("El ruc de la empresa del sector privado debe terminar con 001.");
				return false;
    		}
    		
    		if (digitoVerificador != d10){
    			console.log("El ruc de la empresa del sector privado es incorrecto");
				return false;
    		}
    		
    		return true; 
    			
    	}else if(nat == true){
    		//tipo ruc natural
    		if( txtcedula.val().length >10 && txtcedula.val().substr(10,3) != '001' ){ 
    			console.log("El ruc de la persona natural debe terminar con 001.");
				return false;
				
	         }else{
	        	 
	        	 if(txtcedula.val().length >13){
	        		console.log("El ruc de la persona natural es incorrecto.");
	 				return false;	        		
		         }
		     }
    		
	         if (digitoVerificador != d10){    
	        	console.log("El ruc de la persona natural es incorrecto.");
	 			return false;	        	 
	         }
	         
	         return true;   
    	}
    	
    }else{
    
    	console.log("Ingrese tipo identificacion");
		return false;
    }
   	
    return false;
    
}   
    
    

		    
