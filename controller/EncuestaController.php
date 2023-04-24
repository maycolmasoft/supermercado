<?php

class EncuestaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	
	
	public function index(){
	    
	    session_start();
	    
	    $this->view_ServiciosOnline("EncuestaOnline",array(
	        ""=>""
	        
	    ));
	    
	    
	    
	}
	
	public function CargarTipoEncuesta(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $query1="select id_tipo_encuestas, nombre_tipo_encuestas from tipo_encuestas order by id_tipo_encuestas asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	        
	    }
	}
	
	
	public function CargarPreguntas(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $id_tipo_encuestas = (isset($_POST['id_tipo_encuestas'])) ? $_POST['id_tipo_encuestas'] : 0;
	    
	    if($id_tipo_encuestas > 0 ){
	        
	    $query1="select id_preguntas_encuestas_cabeza, nombre_preguntas_encuestas_cabeza from preguntas_encuestas_cabeza
                 where id_tipo_encuestas='$id_tipo_encuestas'
                order by id_preguntas_encuestas_cabeza asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('preguntas'=>$preguntas));
	    exit();
	    
	    }
	    
	    }
	}
	
	
	public function CargarPreguntasDetalle(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $id_preguntas_encuestas_cabeza = (isset($_POST['id_preguntas_encuestas_cabeza'])) ? $_POST['id_preguntas_encuestas_cabeza'] : 0;
	    
	    if($id_preguntas_encuestas_cabeza > 0 ){
	        
	        $columnas="id_preguntas_encuestas_detalle, opciones_preguntas_detalle";
	        $tabla = "preguntas_encuestas_detalle";
	        $where = "id_preguntas_encuestas_cabeza='$id_preguntas_encuestas_cabeza'";
	        $id="id_preguntas_encuestas_detalle";
	        $resulset = $usuarios->getCondiciones($columnas,$tabla,$where,$id);
	        
	        if(!empty($resulset) && count($resulset)>0){
	            
	            echo json_encode(array('data'=>$resulset));
	            
	        }
	    }
	    
	}
	
	
	
	
	
	public function cargaProvincias(){
	    
	    $usuarios= new UsuariosModel();
	    
	    $columnas="id_provincias, nombre_provincias";
	    $tabla = "core_provincias";
	    $where = "id_provincias not in (25)";
	    $id="id_provincias";
	    $resulset = $usuarios->getCondiciones($columnas,$tabla,$where,$id);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	
	
	
	public function cargaCantones(){
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $id_provincias = (isset($_POST['id_provincias'])) ? $_POST['id_provincias'] : 0;
	    
	    if($id_provincias > 0){
	        
	        $columnas="id_cantones, nombre_cantones";
	        $tabla = "cantones";
	        $where = "id_provincias='$id_provincias'";
	        $id="id_cantones";
	        $resulset = $usuarios->getCondiciones($columnas,$tabla,$where,$id);
	        
	        if(!empty($resulset) && count($resulset)>0){
	            
	            echo json_encode(array('data'=>$resulset));
	            
	        }
	    }
	    
	}
	
	
	
	
	
	public function procesar() {
	    
	    $usuarios= new UsuariosModel();
	    
	    $respuesta         = array();
	    $error             = "";
	    $_cab_error        = "";
	    $_det_error       = "";
	    
	    
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    
	    try {
	        
	        $usuarios->beginTran();
	        
	        $_identificador_consecutivos=0;
	        $funcion = "ins_encuesta_cabeza";
	        $funcion_d = "ins_encuesta_detalle";
	        $parametros = "";
	        $parametrosDetalle = "";
	        $_error_cabeza = false;
	        $_error_detalle = false;
	        
	        
	        //datos de consecutivo
	        $col4  = " LPAD( valor_consecutivos::TEXT,espacio_consecutivos,'0') secuencial";
	        $tab4  = " consecutivos";
	        $whe4  = " id_entidades=2
               AND nombre_consecutivos = 'ENCUESTAS'";
	        $id4   = " creado";
	        $resultConsecutivos   = $usuarios->getCondiciones($col4, $tab4, $whe4, $id4);
	        $_identificador_consecutivos=$resultConsecutivos[0]->secuencial;
	        
	        
	        
	        $_id_usuarios = $_SESSION["id_usuarios"];
	        
	        $datos_1     = json_decode($_POST['lista_detalle_1']);
	        $datos_2     = json_decode($_POST['lista_detalle_2']);
	        $datos_5     = json_decode($_POST['lista_detalle_5']);
	        $datos_6     = json_decode($_POST['lista_detalle_6']);
	        $datos_8     = json_decode($_POST['lista_detalle_8']);
	        $datos_9     = json_decode($_POST['lista_detalle_9']);
	        $datos_10     = json_decode($_POST['lista_detalle_10']);
	        
	        $datos_11     = json_decode($_POST['lista_detalle_11']);
	        $datos_12     = json_decode($_POST['lista_detalle_12']);
	        
	        $datos_13     = json_decode($_POST['lista_detalle_13']);
	        $datos_14     = json_decode($_POST['lista_detalle_14']);
	        
			
			
			
			
			
	        
	        $_id_tipo_encuestas = (isset($_POST['id_tipo_encuestas'])) ? $_POST['id_tipo_encuestas'] : 0;
	        $_razon_social = (isset($_POST['razon_social'])) ? $_POST['razon_social'] : '';
	        $_nombre_contacto = (isset($_POST['nombre_contacto'])) ? $_POST['nombre_contacto'] : '';
	        $_id_provincias = (isset($_POST['id_provincias'])) ? $_POST['id_provincias'] : 0;
	        $_id_cantones = (isset($_POST['id_cantones'])) ? $_POST['id_cantones'] : 0;
	        
	        $_calle_principal = (isset($_POST['calle_principal'])) ? $_POST['calle_principal'] : '';
	        $_calle_secundaria = (isset($_POST['calle_secundaria'])) ? $_POST['calle_secundaria'] : '';
	        $_numero_calle = (isset($_POST['numero_calle'])) ? $_POST['numero_calle'] : '';
	        $_referencia_ubicacion = (isset($_POST['referencia_ubicacion'])) ? $_POST['referencia_ubicacion'] : '';
	        
	        
	        $_id_pregunta_1 = (isset($_POST['id_pregunta_1'])) ? $_POST['id_pregunta_1'] : 0;
	        $_id_pregunta_2 = (isset($_POST['id_pregunta_2'])) ? $_POST['id_pregunta_2'] : 0;
	        $_id_pregunta_3 = (isset($_POST['id_pregunta_3'])) ? $_POST['id_pregunta_3'] : 0;
	        $_respuesta_pregunta_3 = (isset($_POST['respuesta_pregunta_3'])) ? $_POST['respuesta_pregunta_3'] : 0;
	        
	        $_id_pregunta_4 = (isset($_POST['id_pregunta_4'])) ? $_POST['id_pregunta_4'] : 0;
            $_respuesta_pregunta_4 = (isset($_POST['respuesta_pregunta_4'])) ? $_POST['respuesta_pregunta_4'] : 0;
	       	       
		    $_id_pregunta_5 = (isset($_POST['id_pregunta_5'])) ? $_POST['id_pregunta_5'] : 0;
	        $_id_pregunta_6 = (isset($_POST['id_pregunta_6'])) ? $_POST['id_pregunta_6'] : 0;
	        $_id_pregunta_7 = (isset($_POST['id_pregunta_7'])) ? $_POST['id_pregunta_7'] : 0;
			$_respuesta_pregunta_7 = (isset($_POST['respuesta_pregunta_7'])) ? $_POST['respuesta_pregunta_7'] : 0;
	      
		    $_id_pregunta_8 = (isset($_POST['id_pregunta_8'])) ? $_POST['id_pregunta_8'] : 0;
	        $_id_pregunta_9 = (isset($_POST['id_pregunta_9'])) ? $_POST['id_pregunta_9'] : 0;
	        $_id_pregunta_10 = (isset($_POST['id_pregunta_10'])) ? $_POST['id_pregunta_10'] : 0;
	        
	        $_id_pregunta_11 = (isset($_POST['id_pregunta_11'])) ? $_POST['id_pregunta_11'] : 0;
	        $_id_pregunta_12 = (isset($_POST['id_pregunta_12'])) ? $_POST['id_pregunta_12'] : 0;
	        
			$_id_pregunta_13 = (isset($_POST['id_pregunta_13'])) ? $_POST['id_pregunta_13'] : 0;
	        $_id_pregunta_14 = (isset($_POST['id_pregunta_14'])) ? $_POST['id_pregunta_14'] : 0;
	        
			
	        
	        $_id_pregunta_15 = (isset($_POST['id_pregunta_15'])) ? $_POST['id_pregunta_15'] : 0;
	        $_id_preguntas_encuestas_detalle_15 = (isset($_POST['id_preguntas_encuestas_detalle_15'])) ? $_POST['id_preguntas_encuestas_detalle_15'] : 0;
	        
	        $_id_pregunta_16 = (isset($_POST['id_pregunta_16'])) ? $_POST['id_pregunta_16'] : 0;
	        $_id_preguntas_encuestas_detalle_16 = (isset($_POST['id_preguntas_encuestas_detalle_16'])) ? $_POST['id_preguntas_encuestas_detalle_16'] : 0;
	        $_id_pregunta_17 = (isset($_POST['id_pregunta_17'])) ? $_POST['id_pregunta_17'] : 0;
	        $_id_preguntas_encuestas_detalle_17 = (isset($_POST['id_preguntas_encuestas_detalle_17'])) ? $_POST['id_preguntas_encuestas_detalle_17'] : 0;
	        
	        $_id_pregunta_18 = (isset($_POST['id_pregunta_18'])) ? $_POST['id_pregunta_18'] : 0;
	        $_id_preguntas_encuestas_detalle_18 = (isset($_POST['id_preguntas_encuestas_detalle_18'])) ? $_POST['id_preguntas_encuestas_detalle_18'] : 0;
	        
	        $_id_pregunta_19 = (isset($_POST['id_pregunta_19'])) ? $_POST['id_pregunta_19'] : 0;
	        $_id_preguntas_encuestas_detalle_19 = (isset($_POST['id_preguntas_encuestas_detalle_19'])) ? $_POST['id_preguntas_encuestas_detalle_19'] : 0;
	        
	        $_id_pregunta_20 = (isset($_POST['id_pregunta_20'])) ? $_POST['id_pregunta_20'] : 0;
	        $_id_preguntas_encuestas_detalle_20 = (isset($_POST['id_preguntas_encuestas_detalle_20'])) ? $_POST['id_preguntas_encuestas_detalle_20'] : 0;
	        
			$_id_pregunta_21 = (isset($_POST['id_pregunta_21'])) ? $_POST['id_pregunta_21'] : 0;
	        $_id_preguntas_encuestas_detalle_21 = (isset($_POST['id_preguntas_encuestas_detalle_21'])) ? $_POST['id_preguntas_encuestas_detalle_21'] : 0;
	        
			$_id_pregunta_22 = (isset($_POST['id_pregunta_22'])) ? $_POST['id_pregunta_22'] : 0;
	        $_id_preguntas_encuestas_detalle_22 = (isset($_POST['id_preguntas_encuestas_detalle_22'])) ? $_POST['id_preguntas_encuestas_detalle_22'] : 0;
	        
			
	        $_lng = (isset($_POST['lng'])) ? $_POST['lng'] : '';
	        $_lat = (isset($_POST['lat'])) ? $_POST['lat'] : '';
	        
	        
	        $address = urlencode($_calle_principal.', '.$_calle_secundaria.', '.'Ecuador');
	        $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyASrmq96I1ElzSomrRqT7OAbAfl5Rd2G2E";
	        $geocodeResponseData = file_get_contents($googleMapUrl);
	        $responseData = json_decode($geocodeResponseData, true);
	        
	        
	        if($responseData['status']=='OK') {
	            
	            $_lat = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
	            $_lng = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
	            $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
	            
	        }
	        
	        
	        if( !empty(error_get_last())){ throw new Exception('Variables no recibidas'); }
	        
	        
	        
	        // inserto cabecera
	        $parametros = "'$_id_usuarios','$_identificador_consecutivos','$_razon_social','$_nombre_contacto','$_id_provincias','$_id_cantones','$_calle_principal','$_calle_secundaria','$_numero_calle','$_referencia_ubicacion','','$_lat','$_lng','$_id_tipo_encuestas'";
	        $_queryInsercionCabeza = $usuarios->getconsultaPG($funcion, $parametros);
	        $resultado_cabeza = $usuarios->llamarconsultaPG($_queryInsercionCabeza);
	        
	        // valido si existe error en la cabecera
	        $_cab_error = pg_last_error();
	        if(!empty($_cab_error)){ $_error_cabeza = true;}
	        
	        if( $_error_cabeza ){ throw new Exception("Error Insertando Cabecera, vuelva a intentar."); }
	        
	        
	        $_id_encuentas_cabeza=$resultado_cabeza[0];
	        
	        if($_id_encuentas_cabeza>0){}else{throw new Exception("Error Recuperando Cabecera");}
	        
	       
	        
	      // inserto pregunta 1
	        foreach ($datos_1 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 1
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe 
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	               
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
			// inserto pregunta 2
	        foreach ($datos_2 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 2
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe 
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	               
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			
			
			
	       
	        // inserto detalle preg 3
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_3',null,'$_respuesta_pregunta_3','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto detalle preg 4
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_4',null,'$_respuesta_pregunta_4','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	         
	        
	        // inserto pregunta 5
	        foreach ($datos_5 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 5
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        
	        // inserto pregunta 6
	        foreach ($datos_6 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 6
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	          // inserto detalle preg 7
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_7',null,'$_respuesta_pregunta_7','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	         
	        
	        
	        
	        // inserto pregunta 8
	        foreach ($datos_8 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 8
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        
	        // inserto pregunta 9
	        foreach ($datos_9 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 9
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        
	        // inserto pregunta 10
	        foreach ($datos_10 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 10
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto pregunta 11
	        foreach ($datos_11 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 11
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto pregunta 12
	        foreach ($datos_12 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 12
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto pregunta 13
	        foreach ($datos_13 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 13
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			
			 // inserto pregunta 14
	        foreach ($datos_14 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 14
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	      
	        
	        // inserto detalle preg 15
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_15','$_id_preguntas_encuestas_detalle_15','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto detalle preg 16
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_16','$_id_preguntas_encuestas_detalle_16','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto detalle preg 17
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_17','$_id_preguntas_encuestas_detalle_17','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto detalle preg 18
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_18','$_id_preguntas_encuestas_detalle_18','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto detalle preg 19
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_19','$_id_preguntas_encuestas_detalle_19','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto detalle preg 20
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_20','$_id_preguntas_encuestas_detalle_20','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			// inserto detalle preg 21
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_21','$_id_preguntas_encuestas_detalle_21','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			// inserto detalle preg 22
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_22','$_id_preguntas_encuestas_detalle_22','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			
			
			
	        
	        //actualizar el codigo de retencion
	        $_actCol = " valor_consecutivos = valor_consecutivos + 1, numero_consecutivos = LPAD( ( valor_consecutivos + 1)::TEXT,espacio_consecutivos,'0')";
	        $_actTab = " consecutivos ";
	        $_actWhe = " nombre_consecutivos = 'ENCUESTAS' ";
	        $resultadoAct =  $usuarios->ActualizarBy($_actCol, $_actTab, $_actWhe);
	        
	        if( $resultadoAct == -1 ){
	            throw new Exception('Consecutivo no Actualizado');
	        }
	        
	        
	        
	        
	        $respuesta['mensaje']   = "Encuesta Registrada Correctamente";
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_archivo']= 1;
	        echo json_encode( $respuesta );
	        
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message> Error Insertar Respuestas \n'.$ex->getMessage().' <message>';
	        exit();
	    }
	    
	    
	}
	
	
	
	
	
	
	
	public function procesar1(){
	    
	    $usuarios= new UsuariosModel();
	    
	    $respuesta         = array();
	    $error             = "";
	    $_cab_error        = "";
	    $_det_error       = "";
	    
	    
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    
	    try {
	        
	        $usuarios->beginTran();
	        
	        $_identificador_consecutivos=0;
	        $funcion = "ins_encuesta_cabeza";
	        $funcion_d = "ins_encuesta_detalle";
	        $parametros = "";
	        $parametrosDetalle = "";
	        $_error_cabeza = false;
	        $_error_detalle = false;
	        
	        
	        //datos de consecutivo
	        $col4  = " LPAD( valor_consecutivos::TEXT,espacio_consecutivos,'0') secuencial";
	        $tab4  = " consecutivos";
	        $whe4  = " id_entidades=2
               AND nombre_consecutivos = 'CENSOS'";
	        $id4   = " creado";
	        $resultConsecutivos   = $usuarios->getCondiciones($col4, $tab4, $whe4, $id4);
	        $_identificador_consecutivos=$resultConsecutivos[0]->secuencial;
	        
	        
			
	        
	        $_id_usuarios = $_SESSION["id_usuarios"];
	        
	        $datos_23     = json_decode($_POST['lista_detalle_23']);
	        $datos_24     = json_decode($_POST['lista_detalle_24']);
	        $datos_26     = json_decode($_POST['lista_detalle_26']);
	        $datos_27     = json_decode($_POST['lista_detalle_27']);
	        $datos_28     = json_decode($_POST['lista_detalle_28']);
	        $datos_30     = json_decode($_POST['lista_detalle_30']);
	        $datos_31     = json_decode($_POST['lista_detalle_31']);
			$datos_32     = json_decode($_POST['lista_detalle_32']);
	        $datos_34     = json_decode($_POST['lista_detalle_34']);
	        $datos_35     = json_decode($_POST['lista_detalle_35']);
			$datos_36     = json_decode($_POST['lista_detalle_36']);
	            
	        $_id_tipo_encuestas = (isset($_POST['id_tipo_encuestas'])) ? $_POST['id_tipo_encuestas'] : 0;
	        $_razon_social = (isset($_POST['razon_social'])) ? $_POST['razon_social'] : '';
	        $_nombre_contacto = (isset($_POST['nombre_contacto'])) ? $_POST['nombre_contacto'] : '';
	        $_id_provincias = (isset($_POST['id_provincias'])) ? $_POST['id_provincias'] : 0;
	        $_id_cantones = (isset($_POST['id_cantones'])) ? $_POST['id_cantones'] : 0;
	        
	        $_calle_principal = (isset($_POST['calle_principal'])) ? $_POST['calle_principal'] : '';
	        $_calle_secundaria = (isset($_POST['calle_secundaria'])) ? $_POST['calle_secundaria'] : '';
	        $_numero_calle = (isset($_POST['numero_calle'])) ? $_POST['numero_calle'] : '';
	        $_referencia_ubicacion = (isset($_POST['referencia_ubicacion'])) ? $_POST['referencia_ubicacion'] : '';
	        
	        $_id_pregunta_23 = (isset($_POST['id_pregunta_23'])) ? $_POST['id_pregunta_23'] : 0;
	       
	        $_id_pregunta_24 = (isset($_POST['id_pregunta_24'])) ? $_POST['id_pregunta_24'] : 0;
	        $_id_pregunta_25 = (isset($_POST['id_pregunta_25'])) ? $_POST['id_pregunta_25'] : 0;
	        $_id_preguntas_encuestas_detalle_25 = (isset($_POST['id_preguntas_encuestas_detalle_25'])) ? $_POST['id_preguntas_encuestas_detalle_25'] : 0;
	        
	        $_id_pregunta_26 = (isset($_POST['id_pregunta_26'])) ? $_POST['id_pregunta_26'] : 0;
	        $_id_pregunta_27 = (isset($_POST['id_pregunta_27'])) ? $_POST['id_pregunta_27'] : 0;
	        $_id_pregunta_28 = (isset($_POST['id_pregunta_28'])) ? $_POST['id_pregunta_28'] : 0;
	        $_id_pregunta_29 = (isset($_POST['id_pregunta_29'])) ? $_POST['id_pregunta_29'] : 0;
	        $_id_preguntas_encuestas_detalle_29 = (isset($_POST['id_preguntas_encuestas_detalle_29'])) ? $_POST['id_preguntas_encuestas_detalle_29'] : 0;
	      
	        $_id_pregunta_30 = (isset($_POST['id_pregunta_30'])) ? $_POST['id_pregunta_30'] : 0;
	        $_id_pregunta_31 = (isset($_POST['id_pregunta_31'])) ? $_POST['id_pregunta_31'] : 0;
			$_id_pregunta_32 = (isset($_POST['id_pregunta_32'])) ? $_POST['id_pregunta_32'] : 0;
	      

            $_id_pregunta_33 = (isset($_POST['id_pregunta_33'])) ? $_POST['id_pregunta_33'] : 0;
	        $_id_preguntas_encuestas_detalle_33 = (isset($_POST['id_preguntas_encuestas_detalle_33'])) ? $_POST['id_preguntas_encuestas_detalle_33'] : 0;
	      
	        $_id_pregunta_34 = (isset($_POST['id_pregunta_34'])) ? $_POST['id_pregunta_34'] : 0;
	        $_id_pregunta_35 = (isset($_POST['id_pregunta_35'])) ? $_POST['id_pregunta_35'] : 0;
			$_id_pregunta_36 = (isset($_POST['id_pregunta_36'])) ? $_POST['id_pregunta_36'] : 0;
	      
            $_id_pregunta_37 = (isset($_POST['id_pregunta_37'])) ? $_POST['id_pregunta_37'] : 0;
	        $_id_preguntas_encuestas_detalle_37 = (isset($_POST['id_preguntas_encuestas_detalle_37'])) ? $_POST['id_preguntas_encuestas_detalle_37'] : 0;
	      
		  
	        $_lng = (isset($_POST['lng'])) ? $_POST['lng'] : '';
	        $_lat = (isset($_POST['lat'])) ? $_POST['lat'] : '';
	        
	        
	        $address = urlencode($_calle_principal.', '.$_calle_secundaria.', '.'Ecuador');
	        $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyASrmq96I1ElzSomrRqT7OAbAfl5Rd2G2E";
	        $geocodeResponseData = file_get_contents($googleMapUrl);
	        $responseData = json_decode($geocodeResponseData, true);
	        
	        
	        if($responseData['status']=='OK') {
	            
	            $_lat = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
	            $_lng = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
	            $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
	            
	        }
	        
	        
	        if( !empty(error_get_last())){ throw new Exception('Variables no recibidas'); }
	        
	        
	        // inserto cabecera
	        $parametros = "'$_id_usuarios','$_identificador_consecutivos','$_razon_social','$_nombre_contacto','$_id_provincias','$_id_cantones','$_calle_principal','$_calle_secundaria','$_numero_calle','$_referencia_ubicacion','','$_lat','$_lng','$_id_tipo_encuestas'";
	        $_queryInsercionCabeza = $usuarios->getconsultaPG($funcion, $parametros);
	        $resultado_cabeza = $usuarios->llamarconsultaPG($_queryInsercionCabeza);
	        
	        // valido si existe error en la cabecera
	        $_cab_error = pg_last_error();
	        if(!empty($_cab_error)){ $_error_cabeza = true;}
	        
	        if( $_error_cabeza ){ throw new Exception("Error Insertando Cabecera, vuelva a intentar."); }
	        
	        
	        $_id_encuentas_cabeza=$resultado_cabeza[0];
	        
	        if($_id_encuentas_cabeza>0){}else{throw new Exception("Error Recuperando Cabecera");}
	        
	        
	       
	        
	        // inserto pregunta 23
	        foreach ($datos_23 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 23
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        // inserto pregunta 24
	        foreach ($datos_24 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 24
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        // inserto detalle preg 25
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_25','$_id_preguntas_encuestas_detalle_25','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        
	        // inserto pregunta 26
	        foreach ($datos_26 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 26
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        
	        // inserto pregunta 27
	        foreach ($datos_27 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 27
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        
	        // inserto pregunta 28
	        foreach ($datos_28 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 28
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	         // inserto detalle preg 29
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_29','$_id_preguntas_encuestas_detalle_29','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto pregunta 30
	        foreach ($datos_30 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 30
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        // inserto pregunta 31
	        foreach ($datos_31 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 31
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
			 // inserto pregunta 32
	        foreach ($datos_32 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 32
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			
			
			  
	         // inserto detalle preg 33
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_33','$_id_preguntas_encuestas_detalle_33','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        // inserto pregunta 34
	        foreach ($datos_34 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 34
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
	        
	        // inserto pregunta 35
	        foreach ($datos_35 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 35
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	        
			 // inserto pregunta 36
	        foreach ($datos_36 as $data){
	            
	            $id_pregunta   = $data->id_pregunta;
	            $id_preguntas_encuestas_detalle   = $data->id_preguntas_encuestas_detalle;
	            $respuesta_pregunta       = $data->respuesta_pregunta;
	            $nombre_otros = $data->nombre_otros;
	            
	            // inserto detalle preg 36
	            $parametrosDetalle = "'$_id_encuentas_cabeza','$id_pregunta','$id_preguntas_encuestas_detalle','$nombre_otros','$respuesta_pregunta', 0";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            // valido si existe
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	            
	        }
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
	          // inserto detalle preg 37
	        $parametrosDetalle = "'$_id_encuentas_cabeza','$_id_pregunta_37','$_id_preguntas_encuestas_detalle_37','','', 0";
	        $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	        $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	        
	        // valido si existe
	        $_det_error = pg_last_error();
	        if(!empty($_det_error)){ $_error_detalle = true;}
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	        
			
			
	        
	        //actualizar el codigo de retencion
	        $_actCol = " valor_consecutivos = valor_consecutivos + 1, numero_consecutivos = LPAD( ( valor_consecutivos + 1)::TEXT,espacio_consecutivos,'0')";
	        $_actTab = " consecutivos ";
	        $_actWhe = " nombre_consecutivos = 'CENSOS' ";
	        $resultadoAct =  $usuarios->ActualizarBy($_actCol, $_actTab, $_actWhe);
	        
	        if( $resultadoAct == -1 ){
	            throw new Exception('Consecutivo no Actualizado');
	        }
	        
	        
	        
	        
	        $respuesta['mensaje']   = "Censo Registrado Correctamente";
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_archivo']= 1;
	        echo json_encode( $respuesta );
	        
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message> Error Insertar Respuestas \n'.$ex->getMessage().' <message>';
	        exit();
	    }
	    
	    
	    
	}
	
	
	
	//para buscador
	
	
	
	public function index_search(){
	    
	    session_start();
	    
	    $this->view_ServiciosOnline("ConsultaEncuestaOnline",array(
	        ""=>""
	        
	    ));
	    
	    
	}
	
	
	
	public function index_excel(){
	    
	    session_start();
	    
	    $this->view_ServiciosOnline("ReporteEncuestaOnline",array(
	        ""=>""
	        
	    ));
	    
	    
	    
	}
	
	
	//desde aqui steven
	
	
	//////////////////////////////////////////////////// metodo para mostrar encuestas ////////////////////////////////////////////////////
	public function dtMostrar(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        $_id_usuarios = $_SESSION["id_usuarios"];
	        
	        
	        $query = "select b.id_entidades, b.nombre_entidades, b.codigo_entidades from usuarios a inner join entidades b on a.id_entidades=b.id_entidades and a.id_usuarios='$_id_usuarios' limit 1";
	        $resultado  = $usuarios->enviaquery($query);
	        
	        if(!empty($resultado)){
	            
	            $_id_entidades=  $resultado[0]->id_entidades;
	            $_nombre_entidad=  $resultado[0]->nombre_entidades;
	            $_codigo_entidades=  $resultado[0]->codigo_entidades;
	            
	        }else{
	            
	            throw new Exception("No existe Entidad");
	        }
	        
	        
	        
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "a.id_encuentas_cabeza, b.usuario_usuarios, a.numero_encuesta, a.razon_social, a.nombre_contacto, c.nombre_provincias, d.nombre_cantones, a.calle_principal, a.calle_secundaria, a.numero_calle, to_char(a.creado,'DD-MM-YYY HH24:MI') as creado, a.latitud, a.logitud";
	        $tablas1   = "encuentas_cabeza a
	        inner join usuarios b on a.id_usuarios=b.id_usuarios
	        inner join core_provincias c on a.id_provincias=c.id_provincias
	        inner join cantones d on a.id_cantones=d.id_cantones";
	        $where1    = "a.id_tipo_encuestas = 2";
	        
	        
	        $id        = "a.id_encuentas_cabeza";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND (a.numero_encuesta ILIKE  '%".$searchDataTable."%' or b.usuario_usuarios ILIKE  '%".$searchDataTable."%' OR a.razon_social ILIKE  '%".$searchDataTable."%' or a.nombre_contacto ILIKE  '%".$searchDataTable."%' or c.nombre_provincias ILIKE  '%".$searchDataTable."%' or d.nombre_cantones ILIKE  '%".$searchDataTable."%') ";
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => '1',
	            1 => '1',
	            2 => '1',
	            3 => '1',
	            4 => '1',
	            5 => '1',
	            6 => '1',
	            7 => '1'
	            
	            
	        );
	        
	        $orderby   = $columns[$requestData['order'][0]['column']];
	        $orderdir  = $requestData['order'][0]['dir'];
	        $orderdir  = strtoupper($orderdir);
	        /**PAGINACION QUE VIEN DESDE DATATABLE**/
	        $per_page  = $requestData['length'];
	        $offset    = $requestData['start'];
	        
	        //para validar que consulte todos
	        $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
	        
	        $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
	        
	        $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
	        
	        //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
	        $sql = "";
	        //$cantidadBusquedaFiltrada = sizeof($resultSet);
	        
	        /** crear el array data que contiene columnas en plugins **/
	        $data = array();
	        $dataFila = array();
	        
	        $estado="";
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
	            $opciones = '<div class="pull-left ">
                              <span >
                                <a href="index.php?controller=Encuesta&action=print&id='.$res->id_encuentas_cabeza.'" target="_blank" class=" no-padding btn btn-sm btn-default"  data-toggle="tooltip" data-placement="right" title="Ver"> <i class="fa  fa-file-text-o fa-2x fa-fw" aria-hidden="true" ></i>
	                           </a>
                            </span>
                            </div>';
	            
	            $dataFila['numero']       = $res->numero_encuesta;
	            $dataFila['usuario']       = $res->usuario_usuarios;
	            $dataFila['local']       =  $res->razon_social;
	            $dataFila['contacto']       =  $res->nombre_contacto;
	            $dataFila['provincia']       =  $res->nombre_provincias;
	            $dataFila['ciudad']       = $res->nombre_cantones;
	            $dataFila['latitud']       = $res->latitud;
	            $dataFila['longitud']       = $res->logitud;
	            $dataFila['fecha']       = $res->creado;
	            $dataFila['opciones'] = $opciones;
	            
	            
	            $data[] = $dataFila;
	            
	            
	        }
	        
	        
	        $salida = ob_get_clean();
	        
	        if( !empty($salida) )
	            throw new Exception($salida);
	            
	            $json_data = array(
	                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	                "recordsTotal" => intval($cantidadBusqueda),  // total number of records
	                "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
	                "data" => $data,   // total data array
	                "sql" => $sql
	            );
	            
	    } catch (Exception $e) {
	        
	        $json_data = array(
	            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	            "recordsTotal" => intval("0"),  // total number of records
	            "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
	            "data" => array(),   // total data array
	            "sql" => "",
	            "buffer" => error_get_last(),
	            "ERRORDATATABLE" => $e->getMessage()
	        );
	    }
	    
	    
	    echo json_encode($json_data);
	    
	    
	    
	}
	
	//////////////////////////////////////////////////// metodo para mostrar censos ////////////////////////////////////////////////////
	
	public function dtMostrar1(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        $_id_usuarios = $_SESSION["id_usuarios"];
	        
	        
	        $query = "select b.id_entidades, b.nombre_entidades, b.codigo_entidades from usuarios a inner join entidades b on a.id_entidades=b.id_entidades and a.id_usuarios='$_id_usuarios' limit 1";
	        $resultado  = $usuarios->enviaquery($query);
	        
	        if(!empty($resultado)){
	            
	            $_id_entidades=  $resultado[0]->id_entidades;
	            $_nombre_entidad=  $resultado[0]->nombre_entidades;
	            $_codigo_entidades=  $resultado[0]->codigo_entidades;
	            
	        }else{
	            
	            throw new Exception("No existe Entidad");
	        }
	        
	        
	        
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "a.id_encuentas_cabeza, b.usuario_usuarios, a.numero_encuesta, a.razon_social, a.nombre_contacto, c.nombre_provincias, d.nombre_cantones, a.calle_principal, a.calle_secundaria, a.numero_calle, to_char(a.creado,'DD-MM-YYY HH24:MI') as creado, a.latitud, a.logitud";
	        $tablas1   = "encuentas_cabeza a
	        inner join usuarios b on a.id_usuarios=b.id_usuarios
	        inner join core_provincias c on a.id_provincias=c.id_provincias
	        inner join cantones d on a.id_cantones=d.id_cantones";
	        $where1    = "a.id_tipo_encuestas = 1";
	        
	        
	        $id        = "a.id_encuentas_cabeza";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND (a.numero_encuesta ILIKE  '%".$searchDataTable."%' or b.usuario_usuarios ILIKE  '%".$searchDataTable."%' OR a.razon_social ILIKE  '%".$searchDataTable."%' or a.nombre_contacto ILIKE  '%".$searchDataTable."%' or c.nombre_provincias ILIKE  '%".$searchDataTable."%' or d.nombre_cantones ILIKE  '%".$searchDataTable."%') ";
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => '1',
	            1 => '1',
	            2 => '1',
	            3 => '1',
	            4 => '1',
	            5 => '1',
	            6 => '1',
	            7 => '1'
	            
	            
	        );
	        
	        $orderby   = $columns[$requestData['order'][0]['column']];
	        $orderdir  = $requestData['order'][0]['dir'];
	        $orderdir  = strtoupper($orderdir);
	        /**PAGINACION QUE VIEN DESDE DATATABLE**/
	        $per_page  = $requestData['length'];
	        $offset    = $requestData['start'];
	        
	        //para validar que consulte todos
	        $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
	        
	        $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
	        
	        $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
	        
	        //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
	        $sql = "";
	        //$cantidadBusquedaFiltrada = sizeof($resultSet);
	        
	        /** crear el array data que contiene columnas en plugins **/
	        $data = array();
	        $dataFila = array();
	        
	        $estado="";
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
	            $opciones = '<div class="pull-left ">
                              <span >
                                <a href="index.php?controller=Encuesta&action=print1&id='.$res->id_encuentas_cabeza.'" target="_blank" class=" no-padding btn btn-sm btn-default"  data-toggle="tooltip" data-placement="right" title="Ver"> <i class="fa  fa-file-text-o fa-2x fa-fw" aria-hidden="true" ></i>
	                           </a>
                            </span>
                            </div>';
	            
	            $dataFila['numero']       = $res->numero_encuesta;
	            $dataFila['usuario']       = $res->usuario_usuarios;
	            $dataFila['local']       =  $res->razon_social;
	            $dataFila['contacto']       =  $res->nombre_contacto;
	            $dataFila['provincia']       =  $res->nombre_provincias;
	            $dataFila['ciudad']       = $res->nombre_cantones;
	            $dataFila['latitud']       = $res->latitud;
	            $dataFila['longitud']       = $res->logitud;
	            $dataFila['fecha']       = $res->creado;
	            $dataFila['opciones'] = $opciones;
	            
	            
	            $data[] = $dataFila;
	            
	            
	        }
	        
	        
	        $salida = ob_get_clean();
	        
	        if( !empty($salida) )
	            throw new Exception($salida);
	            
	            $json_data = array(
	                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	                "recordsTotal" => intval($cantidadBusqueda),  // total number of records
	                "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
	                "data" => $data,   // total data array
	                "sql" => $sql
	            );
	            
	    } catch (Exception $e) {
	        
	        $json_data = array(
	            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	            "recordsTotal" => intval("0"),  // total number of records
	            "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
	            "data" => array(),   // total data array
	            "sql" => "",
	            "buffer" => error_get_last(),
	            "ERRORDATATABLE" => $e->getMessage()
	        );
	    }
	    
	    
	    echo json_encode($json_data);
	    
	    
	    
	}
	
	
	
	//////////////////////////////////////////////////// metodo para reporte de encuestas ////////////////////////////////////////////////////
	
	public function print()
	{
	    
	    session_start();
	    $usuarios= new UsuariosModel();
	    
	    
	    
	    $html="";
	    
	    
	    
	    $cedula_usuarios = $_SESSION["cedula_usuarios"];
	    $fechaactual = getdate();
	    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	    $fechaactual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
	    
	    $directorio = $_SERVER ['DOCUMENT_ROOT'] . '/webcapremci';
	    $dom=$directorio.'/view/dompdf/dompdf_config.inc.php';
	    $domLogo=$directorio.'/view/images/lcaprem.png';
	    $logo = '<img src="'.$domLogo.'" alt="Responsive image" width="200" height="50">';
	    
	    
	    
	    if(!empty($cedula_usuarios)){
	        
	        
	        if(isset($_GET["id"])){
	            
	            $id_encuestas=$_GET["id"];
	            
	            $columnas_encuestas_cabec ="a.id_encuentas_cabeza,
                                            a.numero_encuesta,
                                            a.razon_social,
                                            a.nombre_contacto,
                                            c.nombre_provincias,
                                            d.nombre_cantones,
                                            a.calle_principal,
                                            a.numero_calle,
                                            a.calle_secundaria,
                                            a.referencia_ubicacion,
                                            a.latitud,
                                            a.logitud,
                                            b.usuario_usuarios,
                                            to_char(a.creado, 'DD-MM-YYYY HH24:MI') as creado";
	            $tablas_encuestas_cabec="encuentas_cabeza a
                                        inner join usuarios b on a.id_usuarios =b.id_usuarios
                                        inner join core_provincias c on a.id_provincias =c.id_provincias
                                        inner join cantones d on a.id_cantones =d.id_cantones ";
	            $where_encuestas_cabec="a.id_tipo_encuestas =2 and a.id_encuentas_cabeza ='$id_encuestas'";
	            $id_encuestas_cabec="a.id_encuentas_cabeza";
	            $resultEncuestas_Cabec=$usuarios->getCondicionesDesc($columnas_encuestas_cabec, $tablas_encuestas_cabec, $where_encuestas_cabec, $id_encuestas_cabec);
	            
	            
	            
	            if(!empty($resultEncuestas_Cabec)){
	                
	                $_id_encuentas_cabeza=$resultEncuestas_Cabec[0]->id_encuentas_cabeza;
	                $_numero_encuesta=$resultEncuestas_Cabec[0]->numero_encuesta;
	                $_razon_social=$resultEncuestas_Cabec[0]->razon_social;
	                $_nombre_contacto=$resultEncuestas_Cabec[0]->nombre_contacto;
	                $_nombre_provincias=$resultEncuestas_Cabec[0]->nombre_provincias;
	                $_nombre_cantones=$resultEncuestas_Cabec[0]->nombre_cantones;
	                $_calle_principal=$resultEncuestas_Cabec[0]->calle_principal;
	                $_numero_calle=$resultEncuestas_Cabec[0]->numero_calle;
	                $_calle_secundaria=$resultEncuestas_Cabec[0]->calle_secundaria;
	                $_referencia_ubicacion=$resultEncuestas_Cabec[0]->referencia_ubicacion;
	                $_latitud=$resultEncuestas_Cabec[0]->latitud;
	                $_logitud=$resultEncuestas_Cabec[0]->logitud;
	                $_usuario_usuarios=$resultEncuestas_Cabec[0]->usuario_usuarios;
	                $_creado=$resultEncuestas_Cabec[0]->creado;
	                
	                
	                
	                
	                
	                
	                //aqui recuoerar todos los demas
	                
	                
	                if($_id_encuentas_cabeza > 0 && $_id_encuentas_cabeza > 0){
	                    
	                    
	                    // consulto primero las preguntas
	                    
	                    
	                    $query1="select a.id_preguntas_encuestas_cabeza, a.nombre_preguntas_encuestas_cabeza from preguntas_encuestas_cabeza a where a.id_tipo_encuestas =2 order by id_preguntas_encuestas_cabeza asc";
	                    $preguntas  = $usuarios->enviaquery($query1);
	                    
	                    
	                    if(!empty($preguntas)){
	                        
	                        
	                        
	                        
	                        $html.='<p style="text-align: right;"><hr style="height: 2px; background-color: black;"></p>';
	                        $html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
	                        $html.='<p style="text-align: center; font-size: 18px; margin-top:30px;"><b>ENCUESTA MARKET SHARE</b></p>';
	                        
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>No.:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Usuario:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Fecha:</b></th>';
	                        $html.= '</tr>';
	                        
	                        
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_numero_encuesta.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_usuario_usuarios.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_creado.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Nombre Local:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Nombre Contacto:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Provincia:</b></th>';
	                        $html.= '</tr>';
	                        
	                        
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_razon_social.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_nombre_contacto.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_nombre_provincias.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Ciudad:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Calle 1:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Número Calle:</b></th>';
	                        $html.= '</tr>';
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_nombre_cantones.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_calle_principal.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_numero_calle.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Calle 2:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Referencia:</b></th>';
	                        $html.= '</tr>';
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_calle_secundaria.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_referencia_ubicacion.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        
	                        
	                        
	                        
	                        
	                        
	                        foreach ($preguntas as $value) {
	                            
	                            $id_preguntas_encuestas_cabeza = $value->id_preguntas_encuestas_cabeza;
	                            $nombre_preguntas_encuestas_cabeza = $value->nombre_preguntas_encuestas_cabeza;
	                            
	                            
	                            
	                            $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas";
	                            $tablas_encuestas_detall="encuentas_detalle a
                                                left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
	                            $where_encuestas_detall="a.id_encuentas_cabeza ='$id_encuestas' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
	                            $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
	                            $resultSet=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	                            
	                            
	                            
	                            if (!empty($resultSet)){
	                                
	                                $respuesta="";
	                                $comentario="";
	                                $imprimir="";
	                               
	                                
	                                $numero = $id_preguntas_encuestas_cabeza;
	                                $pregunta =$nombre_preguntas_encuestas_cabeza;
	                                
	                                if($numero==1){
	                                
	                                $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                
	                                $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                $html.= '<tr>';
	                                $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                $html.= '</tr>';
	                                $html.= '<tr>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Intaco</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Imptek</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sika</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Chova</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Aditec</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impac</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Pintuco</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Wesco</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Unidas</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cóndor</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Latina</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Holcim</th>';
	                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                $html.='</tr>';
	                               
    	                              
	                                $html.= '<tr>';
	                                $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                $html.= '</tr>';
	                                $html.= '<tr>';
	                                
	                                
	                                
    	                                foreach ($resultSet as $res){
    	                                    
    	                                    $respuesta = $res->opciones_preguntas_detalle;
    	                                    $comentario = $res->respuestas_encuestas;
    	                                    
    	                                    if($respuesta=="OTROS"){
    	                                        $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
    	                                        
    	                                    }else{
    	                                        
    	                                        $imprimir='<b>'.$respuesta.'</b>';
    	                                    }
    	                                    
    	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
    	                                }
    	                               
    	                                
    	                           $html.='</tr>';
    	                           $html.='</table>';
    	                                
    	                                
	                                
	                                } elseif ($numero==2){
	                                    
	                                    $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                    $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                    $html.= '<tr>';
	                                    
	                                    foreach ($resultSet as $res){
	                                        
	                                        $respuesta = $res->opciones_preguntas_detalle;
	                                        $comentario = $res->respuestas_encuestas;
	                                        
	                                        $html.='<td  colspan="3" style="text-align: justify;  font-size: 12px;">'.$comentario.'</td>';
	                                        
	                                    }
	                                    
	                                    
	                                    $html.='</tr>';
	                                    $html.='</table>';
	                                    
	                                    
	                                    
	                                    
	                                    
	                                }elseif ($numero==3){
	                                    
	                                    $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                    $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                    $html.= '<tr>';
	                                    
	                                    
	                                    foreach ($resultSet as $res){
	                                        
	                                        $respuesta = $res->opciones_preguntas_detalle;
	                                        $comentario = $res->respuestas_encuestas;
	                                        
	                                        $html.='<td  colspan="3" style="text-align: justify;  font-size: 12px;">'.$comentario.'</td>';
	                                        
	                                    }
	                                    
	                                    $html.='</tr>';
	                                    $html.='</table>';
	                                
	                                
	                                }  elseif ($numero==4){
	                                    
	                                    $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                    
	                                    $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                    $html.= '<tr>';
	                                    $html.='<th colspan="6" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                    $html.= '</tr>';
	                                    $html.= '<tr>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Todos los días</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">5 veces a la semana</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">4 veces a la semana</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">3 veces a la semana</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">2 veces por semana</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">1 ves por semana</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cada 15 días</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cada mes</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                    $html.='</tr>';
	                                    
	                                    
	                                    $html.= '<tr>';
	                                    $html.='<th colspan="6" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                    $html.= '</tr>';
	                                    $html.= '<tr>';
	                                    
	                                    
	                                    
	                                    foreach ($resultSet as $res){
	                                        
	                                        $respuesta = $res->opciones_preguntas_detalle;
	                                        $comentario = $res->respuestas_encuestas;
	                                        
	                                        if($respuesta=="OTROS"){
	                                            $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                            
	                                        }else{
	                                            
	                                            $imprimir='<b>'.$respuesta.'</b>';
	                                        }
	                                        
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                    }
	                                    
	                                    
	                                    $html.='</tr>';
	                                    $html.='</table>';
	                                    
	                                    
	                                    
	                                    
	                                    
	                                } elseif ($numero==5){
	                                    
	                                    $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                    
	                                    $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                    $html.= '<tr>';
	                                    $html.='<th colspan="6" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                    $html.= '</tr>';
	                                    $html.= '<tr>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Tarro 1 Galón</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Tarro 2 Galónes</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cubetas 20kg</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cubetas 15kg</th>';
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                    $html.='</tr>';
	                                    
	                                    
	                                    $html.= '<tr>';
	                                    $html.='<th colspan="6" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                    $html.= '</tr>';
	                                    $html.= '<tr>';
	                                    
	                                    
	                                    
	                                    foreach ($resultSet as $res){
	                                        
	                                        $respuesta = $res->opciones_preguntas_detalle;
	                                        $comentario = $res->respuestas_encuestas;
	                                        
	                                        if($respuesta=="OTROS"){
	                                            $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                            
	                                        }else{
	                                            
	                                            $imprimir='<b>'.$respuesta.'</b>';
	                                        }
	                                        
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                    }
	                                    
	                                    
	                                    $html.='</tr>';
	                                    $html.='</table>';
	                                    
	                                    
	                                    
	                                    
	                                    
	                                }elseif ($numero==6){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="6" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">TRUJILLO</th>';
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">MEGAPROFER</th>';
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">KYWI</th>';
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">FERREMUNDO</th>';
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">PROMESA</th>';
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="6" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                        
	                                    }elseif ($numero==7){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="4" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">CONSTRUCTOR</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">USUARIO FINAL</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">INSTALADOR, MAESTRO DE OBRA</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="4" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                    }elseif ($numero==8){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="5" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">PRECIO</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">VARIEDAD EN EL PORTAFOLIO DE MARCA</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">RESPALDO, GARANTÍA DE MARCA</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">RECOMENDACIÓN DEL FERRETERO</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="5" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                    }elseif ($numero==9){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Intaco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Imptek</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sika</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Chova</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Aditec</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impac</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Pintuco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Wesco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Unidas</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cóndor</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Latina</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Holcim</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                    }elseif ($numero==10){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Intaco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Imptek</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sika</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Chova</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Aditec</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impac</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Pintuco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Wesco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Unidas</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cóndor</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Latina</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Holcim</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                    }elseif ($numero==11){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Intaco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Imptek</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sika</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Chova</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Aditec</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impac</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Pintuco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Wesco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Unidas</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cóndor</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Latina</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Holcim</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                    }elseif ($numero==12){
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>OPCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Intaco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Imptek</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sika</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Chova</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Aditec</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impac</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Pintuco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Wesco</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Unidas</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cóndor</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Latina</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Holcim</th>';
	                                        $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                        $html.='</tr>';
	                                        
	                                        
	                                        $html.= '<tr>';
	                                        $html.='<th colspan="11" style="text-align: center;  font-size: 10px; font-weight: normal;"><b>SELECCIONES</b></th>';
	                                        $html.= '</tr>';
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            if($respuesta=="OTROS"){
	                                                $imprimir='<b>'.$respuesta.' ('.$comentario.')</b>';
	                                                
	                                            }else{
	                                                
	                                                $imprimir='<b>'.$respuesta.'</b>';
	                                            }
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$imprimir.'</th>';
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                    }elseif ($numero==13){
	                                        
	                                       
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                          
	                                        
	                                            
	                                            if($respuesta=='1'){
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                                
	                                            }else{
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">1</th>';
	                                                
	                                            }
	                                            
	                                            if($respuesta=='2'){
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                                
	                                            }else{
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">2</th>';
	                                                
	                                            }
	                                            
	                                            
	                                            if($respuesta=='3'){
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                                
	                                            }else{
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">3</th>';
	                                                
	                                            }
	                                            
	                                            if($respuesta=='más de 3'){
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                                
	                                            }else{
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">más de 3</th>';
	                                                
	                                            }
	                                        
	                                            
	                                            if($respuesta=='Ninguna'){
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                                
	                                            }else{
	                                                
	                                                $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Ninguna</th>';
	                                                
	                                            }
	                                            
	                                        
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }elseif ($numero==14){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        if($respuesta=='1'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">1</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='2'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">2</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='3'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">3</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='más de 3'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">más de 3</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Ninguna'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Ninguna</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }elseif ($numero==15){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        if($respuesta=='Si'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Si</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='No'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">No</th>';
	                                            
	                                        }
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                    }elseif ($numero==16){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        if($respuesta=='Si'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Si</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='No'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">No</th>';
	                                            
	                                        }
	                                        
	                                        }
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                    }elseif ($numero==17){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        if($respuesta=='Si'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Si</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='No'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">No</th>';
	                                            
	                                        }
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                    }elseif ($numero==18){
	                                        
	                                        
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        if($respuesta=='1'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">1</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='2'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">2</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='más de 2'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">más de 2</th>';
	                                            
	                                        }
	                                        if($respuesta=='Ninguna'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Ninguna</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                        
	                                        
	                                    }elseif ($numero==19){
	                                        
	                                        
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        if($respuesta=='Si'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Si</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='No'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">No</th>';
	                                            
	                                        }
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                        
	                                        
	                                    }elseif ($numero==20){
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        foreach ($resultSet as $res){
	                                            
	                                            $respuesta = $res->opciones_preguntas_detalle;
	                                            $comentario = $res->respuestas_encuestas;
	                                            
	                                            
	                                            
	                                        
	                                        if($respuesta=='Grande'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Grande</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Mediana'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Mediana</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Pequeña'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Pequeña</th>';
	                                            
	                                        }
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                    }
	                                    
	                                    
	                                    
	                                    
	                                    
	                                
	                                
	                                
	                            }
	                            
	                            
	                            
	                            
	                            
	                        }}
	                        //termina foreach de preguntas
	                        
	                        
	                        
	                        
	                        
	                        
	                }
	                
	            }
	            
	            
	            $this->report("Encuestas",array( "resultSet"=>$html));
	            die();
	            
	            
	            
	            
	            
	            
	            
	            
	        }else{
	            
	            $this->redirect("Usuarios","sesion_caducada");
	            
	        }
	        
	        
	    }else{
	        
	        $this->redirect("Usuarios","sesion_caducada");
	        
	    }
	    
	}
	
	//////////////////////////////////////////////////// metodo para reporte de censos ////////////////////////////////////////////////////
	public function print1(){
	    
	    
	    
	    session_start();
	    $usuarios= new UsuariosModel();
	    
	    
	    
	    $html="";
	    
	    
	    
	    $cedula_usuarios = $_SESSION["cedula_usuarios"];
	    $fechaactual = getdate();
	    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	    $fechaactual=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
	    
	    $directorio = $_SERVER ['DOCUMENT_ROOT'] . '/webcapremci';
	    $dom=$directorio.'/view/dompdf/dompdf_config.inc.php';
	    $domLogo=$directorio.'/view/images/lcaprem.png';
	    $logo = '<img src="'.$domLogo.'" alt="Responsive image" width="200" height="50">';
	    
	    
	    
	    if(!empty($cedula_usuarios)){
	        
	        
	        if(isset($_GET["id"])){
	            
	            $id_encuestas=$_GET["id"];
	            
	            $columnas_encuestas_cabec ="a.id_encuentas_cabeza,
                                            a.numero_encuesta,
                                            a.razon_social,
                                            a.nombre_contacto,
                                            c.nombre_provincias,
                                            d.nombre_cantones,
                                            a.calle_principal,
                                            a.numero_calle,
                                            a.calle_secundaria,
                                            a.referencia_ubicacion,
                                            a.latitud,
                                            a.logitud,
                                            b.usuario_usuarios,
                                            to_char(a.creado, 'DD-MM-YYYY HH24:MI') as creado";
	            $tablas_encuestas_cabec="encuentas_cabeza a
                                        inner join usuarios b on a.id_usuarios =b.id_usuarios
                                        inner join core_provincias c on a.id_provincias =c.id_provincias
                                        inner join cantones d on a.id_cantones =d.id_cantones ";
	            $where_encuestas_cabec="a.id_tipo_encuestas =1 and a.id_encuentas_cabeza ='$id_encuestas'";
	            $id_encuestas_cabec="a.id_encuentas_cabeza";
	            $resultEncuestas_Cabec=$usuarios->getCondicionesDesc($columnas_encuestas_cabec, $tablas_encuestas_cabec, $where_encuestas_cabec, $id_encuestas_cabec);
	            
	            
	            
	            if(!empty($resultEncuestas_Cabec)){
	                
	                $_id_encuentas_cabeza=$resultEncuestas_Cabec[0]->id_encuentas_cabeza;
	                $_numero_encuesta=$resultEncuestas_Cabec[0]->numero_encuesta;
	                $_razon_social=$resultEncuestas_Cabec[0]->razon_social;
	                $_nombre_contacto=$resultEncuestas_Cabec[0]->nombre_contacto;
	                $_nombre_provincias=$resultEncuestas_Cabec[0]->nombre_provincias;
	                $_nombre_cantones=$resultEncuestas_Cabec[0]->nombre_cantones;
	                $_calle_principal=$resultEncuestas_Cabec[0]->calle_principal;
	                $_numero_calle=$resultEncuestas_Cabec[0]->numero_calle;
	                $_calle_secundaria=$resultEncuestas_Cabec[0]->calle_secundaria;
	                $_referencia_ubicacion=$resultEncuestas_Cabec[0]->referencia_ubicacion;
	                $_latitud=$resultEncuestas_Cabec[0]->latitud;
	                $_logitud=$resultEncuestas_Cabec[0]->logitud;
	                $_usuario_usuarios=$resultEncuestas_Cabec[0]->usuario_usuarios;
	                $_creado=$resultEncuestas_Cabec[0]->creado;
	                
	                
	                
	                
	                
	                
	                //aqui recuoerar todos los demas
	                
	                
	                if($_id_encuentas_cabeza > 0 && $_id_encuentas_cabeza > 0){
	                    
	                    
	                    // consulto primero las preguntas
	                    
	                    
	                    $query1="select a.id_preguntas_encuestas_cabeza, a.nombre_preguntas_encuestas_cabeza from preguntas_encuestas_cabeza a where a.id_tipo_encuestas =1 order by id_preguntas_encuestas_cabeza asc";
	                    $preguntas  = $usuarios->enviaquery($query1);
	                    
	                    
	                    if(!empty($preguntas)){
	                        
	                        
	                        
	                        
	                        $html.='<p style="text-align: right;"><hr style="height: 2px; background-color: black;"></p>';
	                        $html.='<p style="text-align: right; font-size: 13px;"><b>Impreso:</b> '.$fechaactual.'</p>';
	                        $html.='<p style="text-align: center; font-size: 18px; margin-top:30px;"><b>CENSO</b></p>';
	                        
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>No.:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Usuario:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Fecha:</b></th>';
	                        $html.= '</tr>';
	                        
	                        
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_numero_encuesta.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_usuario_usuarios.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_creado.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Nombre Local:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Nombre Contacto:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Provincia:</b></th>';
	                        $html.= '</tr>';
	                        
	                        
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_razon_social.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_nombre_contacto.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_nombre_provincias.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Ciudad:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Calle 1:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Número Calle:</b></th>';
	                        $html.= '</tr>';
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_nombre_cantones.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_calle_principal.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_numero_calle.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        
	                        $html.= "<table style='width: 100%; margin-top:20px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                        
	                        $html.= '<tr>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Calle 2:</b></th>';
	                        $html.='<th style="text-align: left;  font-size: 12px; font-weight: normal;"><b>Referencia:</b></th>';
	                        $html.= '</tr>';
	                        $html.= '<tr>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_calle_secundaria.'</td>';
	                        $html.='<td style="text-align: left;  font-size: 12px; font-weight: normal;">'.$_referencia_ubicacion.'</td>';
	                        $html.= '</tr>';
	                        $html.= "</table>";
	                        
	                        
	                        foreach ($preguntas as $value) {
	                            
	                            $id_preguntas_encuestas_cabeza = $value->id_preguntas_encuestas_cabeza;
	                            $nombre_preguntas_encuestas_cabeza = $value->nombre_preguntas_encuestas_cabeza;
	                            
	                            
	                            
	                            $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas";
	                            $tablas_encuestas_detall="encuentas_detalle a
                                                left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
	                            $where_encuestas_detall="a.id_encuentas_cabeza ='$id_encuestas' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
	                            $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
	                            $resultSet=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	                            
	                            
	                            if (!empty($resultSet)){
	                                
	                                $respuesta="";
	                                $comentario="";
	                                
	                                foreach ($resultSet as $res){
	                                    
	                                    $numero = $id_preguntas_encuestas_cabeza;
	                                    $pregunta =$nombre_preguntas_encuestas_cabeza;
	                                    $respuesta = $res->opciones_preguntas_detalle;
	                                    $comentario = $res->respuestas_encuestas;
	                                    
	                                    
	                                    if($numero==21){
	                                       
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='Si'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Si</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='No'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">No</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    } elseif ($numero==22){
	                                        
	                                        
	                                      
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='10x1m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">10x1m</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='10x5m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">10x5m</th>';
	                                            
	                                        }
	                                        if($respuesta=='20x5m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">20x5m</th>';
	                                            
	                                        }
	                                        if($respuesta=='50x5m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">50x5m</th>';
	                                            
	                                        }
	                                        if($respuesta=='10x10m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">10x10m</th>';
	                                            
	                                        }
	                                        if($respuesta=='20x10m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">20x10m</th>';
	                                            
	                                        }
	                                        if($respuesta=='50x10m'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">50x10m</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                    }
	                                    
	                                    elseif ($numero==23){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='CONSTRUCTOR'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">CONSTRUCTOR</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='USUARIO FINAL'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">USUARIO FINAL</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='INSTALADOR, MAESTRO DE OBRA'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">INSTALADOR, MAESTRO DE OBRA</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                        
	                                        
	                                    }
	                                    
	                                    elseif ($numero==24){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='Sika Multiseal - SIKA'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sika Multiseal - SIKA</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Adeplast cinta - Aditec'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Adeplast cinta - Aditec</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Banda Asfáltica - Wesco'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Banda Asfáltica - Wesco</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Gorilla Tape - Importado'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Gorilla Tape - Importado</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                        
	                                        
	                                        
	                                    }
	                                    
	                                    
	                                    
	                                    elseif ($numero==25){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='Si'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Si</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='No'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">No</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }elseif ($numero==26){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='SUPERACRYL 3 años - 5KG'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">SUPERACRYL 3 años - 5KG</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='SUPERACRYL 3 años - 25KG'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">SUPERACRYL 3 años - 25KG</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='SUPERACRYL 5 años - 5KG'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">SUPERACRYL 5 años - 5KG</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='SUPERACRYL 5 años - 25KG'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">SUPERACRYL 5 años - 25KG</th>';
	                                            
	                                        }
	                                        if($respuesta=='SUPERACRYL 10 años - 5KG'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">SUPERACRYL 10 años - 5KG</th>';
	                                            
	                                        }
	                                        if($respuesta=='SUPERACRYL 10 años - 25KG'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">SUPERACRYL 10 años - 25KG</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }elseif ($numero==27){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='CONSTRUCTOR'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">CONSTRUCTOR</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='USUARIO FINAL'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">USUARIO FINAL</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='INSTALADOR, MAESTRO DE OBRA'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">INSTALADOR, MAESTRO DE OBRA</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }
	                                    
	                                    elseif ($numero==28){
	                                        
	                                        
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='Sikafill - SIKA'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Sikafill - SIKA</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Adiforce 5 años  - Aditec'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Adiforce 5 años  - Aditec</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Adiforce 8 años - Aditec'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Adiforce 8 años - Aditec</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Elastocoat - Intaco'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Elastocoat - Intaco</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Impercoat 3 años - Pintuco'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impercoat 3 años - Pintuco</th>';
	                                            
	                                        }
	                                        if($respuesta=='Impercoat 5 años - Pintuco'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impercoat 5 años - Pintuco</th>';
	                                            
	                                        }
	                                        if($respuesta=='Impercoat 8 años - Pintuco'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Impercoat 8 años - Pintuco</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Permaseal - Wesco'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Permaseal - Wesco</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Aqua Stop - Condor'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Aqua Stop - Condor</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Montoacrilic - Montó'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Montoacrilic - Montó</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='GlacoFlex  - Holcim'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">GlacoFlex  - Holcim</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                        
	                                        
	                                    }
	                                    
	                                    
	                                    elseif ($numero==29){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        $html.='<td  colspan="3" style="text-align: justify;  font-size: 12px;">'.$comentario.'</td>';
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }elseif ($numero==30){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='Todos los días'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Todos los días</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='5 veces a la semana'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">5 veces a la semana</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='4 veces a la semana'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">4 veces a la semana</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='3 veces a la semana'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">3 veces a la semana</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='2 veces por semana'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">2 veces por semana</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='1 ves por semana'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">1 ves por semana</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Cada 15 días'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cada 15 días</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Cada mes'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cada mes</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }elseif ($numero==31){
	                                        
	                                        $html.= "<br><br><b style='font-size: 13px;'>$pregunta</b>";
	                                        
	                                        $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                        $html.= '<tr>';
	                                        
	                                        if($respuesta=='Tarro 1 Galón'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Tarro 1 Galón</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Tarro 2 Galónes'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Tarro 2 Galónes</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Cubetas 20kg'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cubetas 20kg</th>';
	                                            
	                                        }
	                                        
	                                        if($respuesta=='Cubetas 15kg'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.'</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">Cubetas 15kg</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        if($respuesta=='OTROS'){
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;"><b><u>'.$respuesta.' ('.$comentario.')</u></b></th>';
	                                            
	                                        }else{
	                                            
	                                            $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">OTROS</th>';
	                                            
	                                        }
	                                        
	                                        
	                                        $html.='</tr>';
	                                        $html.='</table>';
	                                        
	                                    }
	                                    
	                                }
	                                
	                                
	                            }else{
	                                
	                                
	                                
	                                $columnas_encuestas_detall ="opciones_preguntas_detalle";
	                                $tablas_encuestas_detall="preguntas_encuestas_detalle";
	                                $where_encuestas_detall="id_preguntas_encuestas_cabeza='$id_preguntas_encuestas_cabeza'";
	                                $id_encuestas_detall="id_preguntas_encuestas_detalle";
	                                $resultSet=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	                                
	                                
	                                $respuesta="";
	                                $comentario="";
	                                
	                             
	                                $html.= "<br><br><b style='font-size: 13px;'>$nombre_preguntas_encuestas_cabeza</b>";
	                                $html.= "<table style='width: 100%; margin-top:10px; border-top: 1px solid #999999; border-left: 1px solid #999999;'>";
	                                $html.= '<tr>';
	                                
	                                foreach ($resultSet as $res){
	                                    
	                                    $respuesta = $res->opciones_preguntas_detalle;
	                                   
	                                    $html.='<th style="text-align: center;  font-size: 10px; font-weight: normal;">'.$respuesta.'</th>';
	                                    
	                                }
	                                $html.='</tr>';
	                                $html.='</table>';
	                                
	                                
	                                
	                                
	                            }
	                            
	                            
	                            
	                            
	                            
	                        }}
	                        //termina foreach de preguntas
	                        
	                        
	                }
	                
	            }
	            
	            
	            $this->report("Encuestas",array( "resultSet"=>$html));
	            die();
	            
	            
	            
	        }else{
	            
	            $this->redirect("Usuarios","sesion_caducada");
	            
	        }
	        
	        
	    }else{
	        
	        $this->redirect("Usuarios","sesion_caducada");
	        
	    }
	    
	    
	}
	
	
	
	
	
	public function excel(){
	    
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        $_id_usuarios = $_SESSION["id_usuarios"];
	        
	        
	        $query = "select b.id_entidades, b.nombre_entidades, b.codigo_entidades from usuarios a inner join entidades b on a.id_entidades=b.id_entidades and a.id_usuarios='$_id_usuarios' limit 1";
	        $resultado  = $usuarios->enviaquery($query);
	        
	        if(!empty($resultado)){
	            
	            $_id_entidades=  $resultado[0]->id_entidades;
	            $_nombre_entidad=  $resultado[0]->nombre_entidades;
	            $_codigo_entidades=  $resultado[0]->codigo_entidades;
	            
	        }else{
	            
	            
	            
	            throw new Exception("No existe Entidad");
	        }
	        
	        
	        
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	       
	        $columnas1 = "a.id_encuentas_cabeza, b.usuario_usuarios, a.numero_encuesta, a.razon_social, a.nombre_contacto, c.nombre_provincias, d.nombre_cantones, a.calle_principal, a.calle_secundaria, a.numero_calle, a.referencia_ubicacion, to_char(a.creado,'DD-MM-YYY HH24:MI') as creado, a.latitud, a.logitud";
	        $tablas1   = "encuentas_cabeza a
	        inner join usuarios b on a.id_usuarios=b.id_usuarios
	        inner join core_provincias c on a.id_provincias=c.id_provincias
	        inner join cantones d on a.id_cantones=d.id_cantones";
	        $where1    = "a.id_tipo_encuestas = 2";
	        
	        
	        $id        = "a.id_encuentas_cabeza";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => '1',
	            1 => '1',
	            2 => '1',
	            3 => '1',
	            4 => '1',
	            5 => '1',
	            6 => '1',
	            7 => '1'
	            
	            
	        );
	        
	        $orderby   = $columns[$requestData['order'][0]['column']];
	        $orderdir  = $requestData['order'][0]['dir'];
	        $orderdir  = strtoupper($orderdir);
	        /**PAGINACION QUE VIEN DESDE DATATABLE**/
	        $per_page  = $requestData['length'];
	        $offset    = $requestData['start'];
	        
	        //para validar que consulte todos
	        $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
	        
	        $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
	        
	          
	        $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
	        
	        //var_dump( $resultSet );
	        
	        //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
	        $sql = "";
	        //$cantidadBusquedaFiltrada = sizeof($resultSet);
	        
	        /** crear el array data que contiene columnas en plugins **/
	        $data = array();
	        $dataFila = array();
	        
	        //consulto las preguntas de la encuesta
	        $query1="select a.id_preguntas_encuestas_cabeza, a.nombre_preguntas_encuestas_cabeza from preguntas_encuestas_cabeza a where a.id_tipo_encuestas =2 order by id_preguntas_encuestas_cabeza asc";
	        $preguntas  = $usuarios->enviaquery($query1);
	        
	        
	        $i=0;
	        foreach ( $resultSet as $res){
	            
	            $i++;
	            
	            $_id_encuentas_cabeza = $res->id_encuentas_cabeza;
	              
	            
	            $query_maxifilas="select count(id_preguntas_encuestas_cabeza) as filas
                                from encuentas_detalle
                                where id_encuentas_cabeza = '$_id_encuentas_cabeza'
                                group by id_preguntas_encuestas_cabeza
                                order by filas desc limit 1";
	            $maximo_filas  = $usuarios->enviaquery($query_maxifilas);
	            
	            
	            $numero_maximo_filas=0;
	            $numero_maximo_filas=$maximo_filas[0]->filas;
	            
	            //para consultar preguntas 
	            $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas, a.id_encuentas_cabeza, a.id_preguntas_encuestas_cabeza ";
	            $tablas_encuestas_detall="encuentas_detalle a
                                                left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
	            //$where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
	            $where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza'";
	            $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
	            
	            $rsRespuestasEncuesta=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	            
	            for( $i = 0; $i< $numero_maximo_filas; $i++){
	                
	                if( $i==0 ){	         
	                    
	                    
	                    
	                    $dataFila['ide']       = $res->id_encuentas_cabeza;
	                    $dataFila['numero']       = $res->numero_encuesta;
	                    $dataFila['ciudad']       = $res->nombre_cantones;
	                    $dataFila['provincia']       =  $res->nombre_provincias;
	                    $dataFila['local']       =  $res->razon_social;
	                    $dataFila['contacto']       =  $res->nombre_contacto;
	                    $dataFila['calle_1']       = $res->calle_principal;
	                    $dataFila['num_calle']       = $res->numero_calle;
	                    $dataFila['calle_2']       = $res->calle_secundaria;
	                    $dataFila['referencia']       = $res->referencia_ubicacion;	  
	                    $dataFila['latitud']       = $res->latitud;	  
	                    $dataFila['longitud']       = $res->logitud;	  
	                    
	                    
	                    
	                    
	                }else{	                    
	                    $dataFila['ide']       = $res->id_encuentas_cabeza;
	                    $dataFila['numero']       = "";
	                    $dataFila['ciudad']       = "";
	                    $dataFila['provincia']       =  "";
	                    $dataFila['local']       =  "";
	                    $dataFila['contacto']       =  "";
	                    $dataFila['calle_1']       = "";
	                    $dataFila['num_calle']       = "";
	                    $dataFila['calle_2']       = "";
	                    $dataFila['referencia']       = "";
	                    $dataFila['latitud']       = "";
	                    $dataFila['longitud']       = "";	  
	                   
	                }
	                
	               
	                foreach ($preguntas as $value) {
	                    
	                    $id_preguntas_encuestas_cabeza = $value->id_preguntas_encuestas_cabeza;
	                    
// 	                    $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas";
// 	                    $tablas_encuestas_detall="encuentas_detalle a
//                                                 left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
// 	                    $where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
// 	                    $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
// 	                    $rsRespuestasEncuesta=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);

	                    $rsPreguntaRespuestaCabeza = array_filter( $rsRespuestasEncuesta, function ($var) use ($_id_encuentas_cabeza,$id_preguntas_encuestas_cabeza) { return ($var->id_encuentas_cabeza == $_id_encuentas_cabeza && $var->id_preguntas_encuestas_cabeza == $id_preguntas_encuestas_cabeza ); });
	                    
	                    $arrayfiltrado = array();
	                    
	                    foreach ( $rsPreguntaRespuestaCabeza as $res ){	                        
	                        $arrayfiltrado[] = $res;                        
	                    }
	                   
	                    $index_pregunta    = 'p'.$id_preguntas_encuestas_cabeza;
	                    
	                    if( !empty($arrayfiltrado[$i])  ){
	                        	                        
	                        $dataFila[$index_pregunta] = $arrayfiltrado[$i]->opciones_preguntas_detalle;
	                        
	                        if( $arrayfiltrado[$i]->opciones_preguntas_detalle == 'OTROS' ){
	                            
	                            $dataFila[$index_pregunta] = $arrayfiltrado[$i]->opciones_preguntas_detalle." ( ".$arrayfiltrado[$i]->respuestas_encuestas." )";
	                            
	                        }else if( $id_preguntas_encuestas_cabeza == 3 || $id_preguntas_encuestas_cabeza == 4 || $id_preguntas_encuestas_cabeza == 7 ){
	                            
	                            $dataFila[$index_pregunta] = $arrayfiltrado[$i]->respuestas_encuestas;
	                        }
	                        
	                        
	                    }else{
	                        
	                        $dataFila[$index_pregunta] = '';
	                    }
	                    
	                    
	                }
	                
	                $data[]    = $dataFila;	                
	                
	            }
	            
	            	            
	        }
	        
	        
	        $salida = ob_get_clean();
	        
	        if( !empty($salida) )
	            throw new Exception($salida);
	            
	            $json_data = array(
	                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	                "recordsTotal" => intval($cantidadBusqueda),  // total number of records
	                "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
	                "data" => $data,   // total data array
	                "sql" => $sql
	            );
	            
	    } catch (Exception $e) {
	        
	        $json_data = array(
	            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	            "recordsTotal" => intval("0"),  // total number of records
	            "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
	            "data" => array(),   // total data array
	            "sql" => "",
	            "buffer" => error_get_last(),
	            "ERRORDATATABLE" => $e->getMessage()
	        );
	    }
	    
	    
	    echo json_encode($json_data);
	    
	    
	    
	    
	}
	
	
	
	
	public function excel1() {
	    
	    
	    
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        $_id_usuarios = $_SESSION["id_usuarios"];
	        
	        
	        $query = "select b.id_entidades, b.nombre_entidades, b.codigo_entidades from usuarios a inner join entidades b on a.id_entidades=b.id_entidades and a.id_usuarios='$_id_usuarios' limit 1";
	        $resultado  = $usuarios->enviaquery($query);
	        
	        if(!empty($resultado)){
	            
	            $_id_entidades=  $resultado[0]->id_entidades;
	            $_nombre_entidad=  $resultado[0]->nombre_entidades;
	            $_codigo_entidades=  $resultado[0]->codigo_entidades;
	            
	        }else{
	            
	            
	            
	            throw new Exception("No existe Entidad");
	        }
	        
	        
	        
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        $columnas1 = "a.id_encuentas_cabeza, b.usuario_usuarios, a.numero_encuesta, a.razon_social, a.nombre_contacto, c.nombre_provincias, d.nombre_cantones, a.calle_principal, a.calle_secundaria, a.numero_calle, a.referencia_ubicacion, to_char(a.creado,'DD-MM-YYY HH24:MI') as creado, a.latitud, a.logitud";
	        $tablas1   = "encuentas_cabeza a
	        inner join usuarios b on a.id_usuarios=b.id_usuarios
	        inner join core_provincias c on a.id_provincias=c.id_provincias
	        inner join cantones d on a.id_cantones=d.id_cantones";
	        $where1    = "a.id_tipo_encuestas = 1";
	        
	        
	        $id        = "a.id_encuentas_cabeza";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => '1',
	            1 => '1',
	            2 => '1',
	            3 => '1',
	            4 => '1',
	            5 => '1',
	            6 => '1',
	            7 => '1'
	            
	            
	        );
	        
	        $orderby   = $columns[$requestData['order'][0]['column']];
	        $orderdir  = $requestData['order'][0]['dir'];
	        $orderdir  = strtoupper($orderdir);
	        /**PAGINACION QUE VIEN DESDE DATATABLE**/
	        $per_page  = $requestData['length'];
	        $offset    = $requestData['start'];
	        
	        //para validar que consulte todos
	        $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
	        
	        $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
	        
	        
	        $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
	        
	        //var_dump( $resultSet );
	        
	        //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
	        $sql = "";
	        //$cantidadBusquedaFiltrada = sizeof($resultSet);
	        
	        /** crear el array data que contiene columnas en plugins **/
	        $data = array();
	        $dataFila = array();
	        
	        //consulto las preguntas de la encuesta
	        $query1="select a.id_preguntas_encuestas_cabeza, a.nombre_preguntas_encuestas_cabeza from preguntas_encuestas_cabeza a where a.id_tipo_encuestas =1 order by id_preguntas_encuestas_cabeza asc";
	        $preguntas  = $usuarios->enviaquery($query1);
	        
	        
	        $i=0;
	        foreach ( $resultSet as $res){
	            
	            $i++;
	            
	            $_id_encuentas_cabeza = $res->id_encuentas_cabeza;
	            
	            
	            $query_maxifilas="select count(id_preguntas_encuestas_cabeza) as filas
                                from encuentas_detalle
                                where id_encuentas_cabeza = '$_id_encuentas_cabeza'
                                group by id_preguntas_encuestas_cabeza
                                order by filas desc limit 1";
	            $maximo_filas  = $usuarios->enviaquery($query_maxifilas);
	            
	            
	            $numero_maximo_filas=0;
	            $numero_maximo_filas=$maximo_filas[0]->filas;
	            
	            //para consultar preguntas
	            $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas, a.id_encuentas_cabeza, a.id_preguntas_encuestas_cabeza ";
	            $tablas_encuestas_detall="encuentas_detalle a
                                                left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
	            //$where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
	            $where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza'";
	            $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
	            
	            $rsRespuestasEncuesta=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	            
	            for( $i = 0; $i< $numero_maximo_filas; $i++){
	                
	                if( $i==0 ){
	                    
	                    
	                    
	                    $dataFila['ide']       = $res->id_encuentas_cabeza;
	                    $dataFila['numero']       = $res->numero_encuesta;
	                    $dataFila['ciudad']       = $res->nombre_cantones;
	                    $dataFila['provincia']       =  $res->nombre_provincias;
	                    $dataFila['local']       =  $res->razon_social;
	                    $dataFila['contacto']       =  $res->nombre_contacto;
	                    $dataFila['calle_1']       = $res->calle_principal;
	                    $dataFila['num_calle']       = $res->numero_calle;
	                    $dataFila['calle_2']       = $res->calle_secundaria;
	                    $dataFila['referencia']       = $res->referencia_ubicacion;
	                    $dataFila['latitud']       = $res->latitud;
	                    $dataFila['longitud']       = $res->logitud;
	                    
	                    
	                    
	                    
	                }else{
	                    $dataFila['ide']       = $res->id_encuentas_cabeza;
	                    $dataFila['numero']       = "";
	                    $dataFila['ciudad']       = "";
	                    $dataFila['provincia']       =  "";
	                    $dataFila['local']       =  "";
	                    $dataFila['contacto']       =  "";
	                    $dataFila['calle_1']       = "";
	                    $dataFila['num_calle']       = "";
	                    $dataFila['calle_2']       = "";
	                    $dataFila['referencia']       = "";
	                    $dataFila['latitud']       = "";
	                    $dataFila['longitud']       = "";
	                    
	                }
	                
	                
	                foreach ($preguntas as $value) {
	                    
	                    $id_preguntas_encuestas_cabeza = $value->id_preguntas_encuestas_cabeza;
	                    
	                    // 	                    $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas";
	                    // 	                    $tablas_encuestas_detall="encuentas_detalle a
	                    //                                                 left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
	                    // 	                    $where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
	                    // 	                    $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
	                    // 	                    $rsRespuestasEncuesta=$usuarios->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	                    
	                    $rsPreguntaRespuestaCabeza = array_filter( $rsRespuestasEncuesta, function ($var) use ($_id_encuentas_cabeza,$id_preguntas_encuestas_cabeza) { return ($var->id_encuentas_cabeza == $_id_encuentas_cabeza && $var->id_preguntas_encuestas_cabeza == $id_preguntas_encuestas_cabeza ); });
	                    
	                    $arrayfiltrado = array();
	                    
	                    foreach ( $rsPreguntaRespuestaCabeza as $res ){
	                        $arrayfiltrado[] = $res;
	                    }
	                    
	                    $index_pregunta    = 'p'.$id_preguntas_encuestas_cabeza;
	                    
	                    if( !empty($arrayfiltrado[$i])  ){
	                        
	                        $dataFila[$index_pregunta] = $arrayfiltrado[$i]->opciones_preguntas_detalle;
	                        
	                        if( $arrayfiltrado[$i]->opciones_preguntas_detalle == 'OTROS' ){
	                            
	                            $dataFila[$index_pregunta] = $arrayfiltrado[$i]->opciones_preguntas_detalle." ( ".$arrayfiltrado[$i]->respuestas_encuestas." )";
	                            
	                        }/*else if( $id_preguntas_encuestas_cabeza == 29){
	                            
	                            $dataFila[$index_pregunta] = $arrayfiltrado[$i]->respuestas_encuestas;
	                        }*/
	                        
	                        
	                    }else{
	                        
	                        $dataFila[$index_pregunta] = '';
	                    }
	                    
	                    
	                }
	                
	                $data[]    = $dataFila;
	                
	            }
	            
	            
	        }
	        
	        
	        $salida = ob_get_clean();
	        
	        if( !empty($salida) )
	            throw new Exception($salida);
	            
	            $json_data = array(
	                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	                "recordsTotal" => intval($cantidadBusqueda),  // total number of records
	                "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
	                "data" => $data,   // total data array
	                "sql" => $sql
	            );
	            
	    } catch (Exception $e) {
	        
	        $json_data = array(
	            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	            "recordsTotal" => intval("0"),  // total number of records
	            "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
	            "data" => array(),   // total data array
	            "sql" => "",
	            "buffer" => error_get_last(),
	            "ERRORDATATABLE" => $e->getMessage()
	        );
	    }
	    
	    
	    echo json_encode($json_data);
	    
	    
	    
	    
	    
	}
	
	
	
	public function filtro(){
	    
	    $db = new UsuariosModel();
	    
	    $_id_encuentas_cabeza = 41;
	    
	    $columnas_encuestas_detall ="a.id_encuentas_detalle, c.opciones_preguntas_detalle, a.respuestas_encuestas, a.comentario_encuestas, a.id_encuentas_cabeza, a.id_preguntas_encuestas_cabeza ";
	    $tablas_encuestas_detall="encuentas_detalle a
                                                left join preguntas_encuestas_detalle c on a.id_preguntas_encuestas_detalle =c.id_preguntas_encuestas_detalle";
	    //$where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza' and a.id_preguntas_encuestas_cabeza ='$id_preguntas_encuestas_cabeza'";
	    $where_encuestas_detall="a.id_encuentas_cabeza ='$_id_encuentas_cabeza'";
	    $id_encuestas_detall="a.id_preguntas_encuestas_cabeza ,c.id_preguntas_encuestas_detalle";
	    
	    $rsRespuestasEncuesta=$db->getCondiciones($columnas_encuestas_detall, $tablas_encuestas_detall, $where_encuestas_detall, $id_encuestas_detall);
	    
	    echo "ID CABEZA","|| ID PREGUNTA  || ", "OPCIONES","\n";
	    
	    foreach ( $rsRespuestasEncuesta as $res ){
	        
	        echo $res->id_encuentas_cabeza,"|| ", $res->id_preguntas_encuestas_cabeza,  " || ", $res->opciones_preguntas_detalle, "|| \n";
	        
	    }
	    
	    $rsPreguntaRespuestaCabeza = array_filter( $rsRespuestasEncuesta, function ($var) { return ($var->id_encuentas_cabeza == '41' && $var->id_preguntas_encuestas_cabeza == 18 ); });
	    
	    echo "*************************************************************************\n";
	    
	    $arrayfiltrado = array();
	    
	    foreach ( $rsPreguntaRespuestaCabeza as $res ){
	        
	        $arrayfiltrado[] = $res;
	        
	        echo $res->id_encuentas_cabeza,"|| ", $res->id_preguntas_encuestas_cabeza,  " || ", $res->opciones_preguntas_detalle, "||\n ";
	        
	    }
	    
	    echo "************************\n";
	    
	    var_dump($arrayfiltrado);
	    
	    
	}
	
		
}
?>