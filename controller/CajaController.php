<?php
class CajaController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
   public function index(){
	    
	    session_start();
	    
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        
	        $usuarios= new UsuariosModel();
	        
	        $nombre_controladores = "Caja";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	       
	        if (!empty($resultPer))
	        {
	            
	            $this->view_Ventas("Caja",array(
	                ""=>""
	            ));
	            
	        }else{
	            	            
	            $this->view("Error",array(
	                "resultado"=>"No tiene Permisos"
	                
	            ));
	            exit();
	        }	        
	        
	    }
	    else
	    {
	        
	        $this->redirect("Usuarios","sesion_caducada");
	    }
	    
	}
    
    
	
	public function CargarTipoTransaccion(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $query1="select id_tipo_transaccion , nombre_tipo_transaccion , tipo_operacion_transaccion from tipo_transaccion WHERE id_tipo_transaccion not in (2,3) order by id_tipo_transaccion asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	        
	    }
	}
	
	
	public function VerificarCaja(){
	    
	    session_start();
	    $usuarios = new UsuariosModel();
	    
	    
	    if(isset($_SESSION["id_usuarios"])){
	        
	        $id_usuarios = $_SESSION["id_usuarios"];
	       
	        date_default_timezone_set('America/Guayaquil');
	        $fechaActual = date('Y-m-d');
	        $fecha = array(['fecha' => $fechaActual]);
	        
	        $query="select 1 as id from movimientos_caja_cabeza where id_usuarios ='$id_usuarios' and date(fecha_apertura_caja_cabeza)='$fechaActual' and date(fecha_cierre_caja_cabeza) is null";
	        $abierto  = $usuarios->enviaquery($query);
	        
	        $query1="select 2 as id from movimientos_caja_cabeza where id_usuarios ='$id_usuarios' and date(fecha_apertura_caja_cabeza)='$fechaActual' and date(fecha_cierre_caja_cabeza) is not null";
	        $cerrado  = $usuarios->enviaquery($query1);
	        
	        if(!empty($abierto) && empty($cerrado)){
	            
	            echo json_encode(array('data'=>$abierto, 'fechaActual'=>$fecha));
	            exit();
	            
	        }elseif (!empty($abierto) && !empty($cerrado)){
	            
	            echo json_encode(array('data'=>$cerrado, 'fechaActual'=>$fecha));
	            exit();
	            
	        }else{
	            
	            $sin_apertura = array(['id' => 3]);
	            
	            echo json_encode(array('data'=>$sin_apertura, 'fechaActual'=>$fecha));
	            exit();
	        }
	        
	    }
	    
	}
	
	
   
	public function dtMostrar_Detalle(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        $id_usuarios = $_SESSION["id_usuarios"];
	        
	        date_default_timezone_set('America/Guayaquil');
	        $fechaActual = date('Y-m-d');
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "b.id_movimientos_caja_detalle, c.nombre_tipo_transaccion, b.valor_transaccion , b.descripcion_transaccion, to_char(b.creado,'DD-MM-YYYY HH24:MI') as creado";
	        $tablas1   = "movimientos_caja_cabeza a 
					    inner join movimientos_caja_detalle b on a.id_movimientos_caja_cabeza =b.id_movimientos_caja_cabeza 
					    inner join tipo_transaccion c on b.id_tipo_transaccion =c.id_tipo_transaccion";
	        $where1    = "a.id_usuarios = '$id_usuarios' and date(a.fecha_apertura_caja_cabeza)='$fechaActual'";
	        $id        = "b.id_movimientos_caja_detalle";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND (c.nombre_tipo_transaccion ILIKE  '%".$searchDataTable."%' or b.descripcion_transaccion ILIKE  '%".$searchDataTable."%')";
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => 'c.nombre_tipo_transaccion',
	            1 => 'b.valor_transaccion',
	            2 => 'b.descripcion_transaccion',
	            3 => 'creado'
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
	        
	       
	        /** crear el array data que contiene columnas en plugins **/
	        $data = array();
	        $dataFila = array();
	        
	        $valores="";
	        $total=0;
	        foreach ( $resultSet as $res){
	            
	            /*  $opciones="";
	            $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="editar(this)" id="" data-id_clientes="'.$res->id_clientes.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Editar"> <i class="text-yellow fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                              <span >
                                <a onclick="eliminar(this)" id="" data-id_clientes="'.$res->id_clientes.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar"> <i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                           
                            </div>';
	            */
				
	            $total=  $total+$res->valor_transaccion;
	            $totales = array();
	            $totales['total']      = '<span class="badge bg-yellow" style="font-size: 16px;">'.'<b>'.'$ '.number_format($total, 2, ".", ",").'</b>'.'</span>';
	            $totales['total_imprimir']      = number_format($total, 2, ".", ",");

	            
	            if($res->valor_transaccion>=0){$valores = '<span class="badge bg-green" style="font-size: 12px;">'.$res->valor_transaccion.'</span>';}
	            if($res->valor_transaccion<0){$valores = '<span class="badge bg-red" style="font-size: 12px;">'.$res->valor_transaccion.'</span>';}
               
	            $dataFila['nombre_tipo_transaccion']       = '<b>'.$res->nombre_tipo_transaccion.'</b>';
                $dataFila['valor_transaccion']             = $valores;
                $dataFila['descripcion_transaccion']       = $res->descripcion_transaccion;
                $dataFila['creado']                        = $res->creado;
	           
	           // $dataFila['opciones'] = $opciones;
	            
	            
	            $data[] = $dataFila;
	            
	            
	        }
	        
	        
	        $salida = ob_get_clean();
	        
	        if( !empty($salida) )
	            throw new Exception($salida);
	            
	            $json_data = array(
	                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	                "recordsTotal" => intval($cantidadBusqueda),  // total number of records
	                "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
	                "data" => $data,
	                "totales" =>$totales
	            );
	            
	    } catch (Exception $e) {
	        
	        $json_data = array(
	            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	            "recordsTotal" => intval("0"),  // total number of records
	            "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
	            "data" => array(),   // total data array
	            "buffer" => error_get_last(),
	            "ERRORDATATABLE" => $e->getMessage()
	        );
	    }
	    
	    
	    echo json_encode($json_data);
	    
	    
	    
	}
	
  
  
	
	
	public function dtMostrar_Resumen(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        $id_usuarios = $_SESSION["id_usuarios"];
	        
	        date_default_timezone_set('America/Guayaquil');
	        $fechaActual = date('Y-m-d');
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "c.nombre_tipo_transaccion , SUM(b.valor_transaccion) as valor_transaccion";
	        $tablas1   = "movimientos_caja_cabeza a
					    inner join movimientos_caja_detalle b on a.id_movimientos_caja_cabeza =b.id_movimientos_caja_cabeza
					    inner join tipo_transaccion c on b.id_tipo_transaccion =c.id_tipo_transaccion";
	        $where1    = "a.id_usuarios = '$id_usuarios' and date(a.fecha_apertura_caja_cabeza)='$fechaActual'";
	        $id        = "c.nombre_tipo_transaccion";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND c.nombre_tipo_transaccion ILIKE  '%".$searchDataTable."%'";
	            
	        }
	        
	        
	        
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => 'c.nombre_tipo_transaccion',
	            1 => 'b.valor_transaccion'
	           
	        );
	        
	        $orderby   = $columns[$requestData['order'][0]['column']];
	        $orderdir  = $requestData['order'][0]['dir'];
	        $orderdir  = strtoupper($orderdir);
	        /**PAGINACION QUE VIEN DESDE DATATABLE**/
	        $per_page  = $requestData['length'];
	        $offset    = $requestData['start'];
	        
	        //para validar que consulte todos
	        $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
	        
	        $limit = "GROUP BY c.nombre_tipo_transaccion ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
	        
	        $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
	        
	        
	        /** crear el array data que contiene columnas en plugins **/
	        $data = array();
	        $dataFila = array();
	        
	        $valores="";
	        $total=0;
	        foreach ( $resultSet as $res){
	            
	            /*  $opciones="";
	             $opciones = '<div class="pull-right ">
	             <span >
	             <a onclick="editar(this)" id="" data-id_clientes="'.$res->id_clientes.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Editar"> <i class="text-yellow fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
	             </a>
	             </span>
	             <span >
	             <a onclick="eliminar(this)" id="" data-id_clientes="'.$res->id_clientes.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar"> <i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i>
	             </a>
	             </span>
	             
	             </div>';
	             */
	            
	            $total=  $total+$res->valor_transaccion;
	            $totales = array();
	            $totales['total']      = '<span class="badge bg-yellow" style="font-size: 16px;">'.'<b>'.'$ '.number_format($total, 2, ".", ",").'</b>'.'</span>';
	            $totales['total_imprimir']      = number_format($total, 2, ".", ",");
	            
	            
	            if($res->valor_transaccion>=0){$valores = '<span class="badge bg-green" style="font-size: 12px;">'.$res->valor_transaccion.'</span>';}
	            if($res->valor_transaccion<0){$valores = '<span class="badge bg-red" style="font-size: 12px;">'.$res->valor_transaccion.'</span>';}
	            
	            $dataFila['nombre_tipo_transaccion']       = '<b>'.$res->nombre_tipo_transaccion.'</b>';
	            $dataFila['valor_transaccion']             = $valores;
	            
	            // $dataFila['opciones'] = $opciones;
	            
	            
	            $data[] = $dataFila;
	            
	            
	        }
	        
	        
	        $salida = ob_get_clean();
	        
	        if( !empty($salida) )
	            throw new Exception($salida);
	            
	            $json_data = array(
	                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	                "recordsTotal" => intval($cantidadBusqueda),  // total number of records
	                "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
	                "data" => $data,
	                "totales" =>$totales
	            );
	            
	    } catch (Exception $e) {
	        
	        $json_data = array(
	            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	            "recordsTotal" => intval("0"),  // total number of records
	            "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
	            "data" => array(),   // total data array
	            "buffer" => error_get_last(),
	            "ERRORDATATABLE" => $e->getMessage()
	        );
	    }
	    
	    
	    echo json_encode($json_data);
	    
	    
	    
	}
	
  
	public function RegistrarCaja(){
	    
	    $usuarios       = new UsuariosModel();
		$respuesta         = array();
	    $_det_error       = "";
		 
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    
	    
	    date_default_timezone_set('America/Guayaquil');
	    $fechaActual = date('Y-m-d H:i:s');
	    
	    
	    /**
	     ****************************************************** validar las variables a procesar ****************************************************
	     **/
	    try {
	        
	        $movimiento      = $_POST['movimiento'];
	        $monto_caja      = $_POST['monto_caja'];
	      
	        $_usuario_usuarios  = $_SESSION['usuario_usuarios'];
	        $_id_usuarios       = $_SESSION['id_usuarios'];
	        
	        
	        
	    }catch (Exception $e) {
	        echo "<message>".$e->getMessage()."<message>";
	        exit();
	    }
	    
	    
	    /**
	     ****************************************************** insercion del archivo en tabla ***********************************************************
	     **/
	    
	    try{
	        $usuarios->beginTran();
	        
	        $respuesta = array();
	        
	        //para abrir la caja
	        if($movimiento==1){
	            
	            $funcion = "ins_movimientos_caja_abrir";
	            $parametros = "'$_id_usuarios','$fechaActual','$monto_caja'";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion, $parametros);
	            $resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            $respuesta['mensaje']   = "Caja Abierta Correctamente";
	            
	        }else{
	        //para cerrar la caja    
	            $funcion = "ins_movimientos_caja_cerrar";
	            $parametros = "'$_id_usuarios','$fechaActual','$monto_caja'";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion, $parametros);
	            $resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	            if($resultado[0] == 0){
	                
	                throw new Exception("No se puede Cerrar - Primero Aperture la Caja."); 
	                
	            }else{
	                $respuesta['mensaje']   = "Caja Cerrada Correctamente";
	            }
	            
	        }
	        		
			
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("Error Abriendo - Cerrando Caja"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        echo json_encode( $respuesta );
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message>'.$ex->getMessage().' <message>';
	    }
	    
	}
	
	
	public function Agregar(){
	    
	    $usuarios       = new UsuariosModel();
	    $respuesta         = array();
	    $_det_error       = "";
	    
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    
	    
	    date_default_timezone_set('America/Guayaquil');
	    $fechaActual = date('Y-m-d H:i:s');
	    
	    
	    /**
	     ****************************************************** validar las variables a procesar ****************************************************
	     **/
	    try {
	        
	        $id_tipo_transaccion      = $_POST['id_tipo_transaccion'];
	        $valor_transaccion      = $_POST['valor_transaccion'];
	        $descripcion_transaccion      = $_POST['descripcion_transaccion'];
	        
	        $_usuario_usuarios  = $_SESSION['usuario_usuarios'];
	        $_id_usuarios       = $_SESSION['id_usuarios'];
	       
	        
	        
	    }catch (Exception $e) {
	        echo "<message>".$e->getMessage()."<message>";
	        exit();
	    }
	    
	    
	    /**
	     ****************************************************** insercion del archivo en tabla ***********************************************************
	     **/
	    
	    try{
	        $usuarios->beginTran();
	        
	        $respuesta = array();
	        
	        
            //para cerrar la caja
            $funcion = "ins_movimientos_caja_detalle";
            $parametros = "'$id_tipo_transaccion','$valor_transaccion','$descripcion_transaccion', '$_id_usuarios', '$fechaActual'";
            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion, $parametros);
            $resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
            
            if($resultado[0] == 0){
                
                throw new Exception("No se puede Agregar Detalle - No existe Apertura");
                
            }else{
                $respuesta['mensaje']   = "Movimiento Agregado Correctamente";
            }
        
	        
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("No se puede Agregar Detalle - No existe Apertura"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        echo json_encode( $respuesta );
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message>'.$ex->getMessage().' <message>';
	    }
	    
	}

	
	
	
}
?>
