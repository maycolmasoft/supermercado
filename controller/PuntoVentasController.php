<?php
class PuntoVentasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
   public function index(){
	    
	    session_start();
	    
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        
	        $usuarios= new UsuariosModel();
	        
	        $nombre_controladores = "PuntoVentas";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	       
	        if (!empty($resultPer))
	        {
	            
	            $this->view_Ventas("PuntoVentas",array(
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
    
    
	public function CargarTipoProductos(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    $query1="select id_tipo_productos , nombre_tipo_productos  from tipo_productos order by id_tipo_productos  asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	    }
	}
  
    public function CargarMarca(){
	    
		session_start();
	    
	    $usuarios= new UsuariosModel();
		
	    $id_tipo_productos = (isset($_POST['id_tipo_productos'])) ? $_POST['id_tipo_productos'] : 0;
	    
	    if($id_tipo_productos > 0){
	        
	        $columnas="id_marca_productos , nombre_marca_productos";
	        $tabla = "marca_productos";
	        $where = "id_tipo_productos='$id_tipo_productos'";
	        $id="id_marca_productos";
	        $resulset = $usuarios->getCondiciones($columnas,$tabla,$where,$id);
	        
	        if(!empty($resulset) && count($resulset)>0){
	            
	            echo json_encode(array('data'=>$resulset));
	            
	        }
	    }
	    
	}
  
    public function CargarPresentacion(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    $query1="select id_presentacion_productos , nombre_presentacion_productos  from presentacion_productos order by id_presentacion_productos asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	    }
	}
  
  
	public function CargarEstado(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $query1="select id_estado , nombre_estado  from estado where tabla_estado ='USUARIOS' order by id_estado asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	        
	    }
	}
	
	public function CargarIva(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $query1="select id_iva , nombre_iva  from iva where id_estado =1 order by id_iva asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	        
	    }
	}
  
    
	public function DataEditar(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $id_productos = (isset($_POST['id_productos'])) ? $_POST['id_productos'] : 0;
	    
	    if($id_productos > 0 ){
	        
	    $query1="SELECT id_productos, nombre_productos, codigo_productos, stock_productos, precio_compra_productos, precio_venta_productos, precio_venta_mayoreo_productos, stock_min_venta_mayoreo_productos,
                imagen_productos, id_tipo_productos, id_marca_productos, id_presentacion_productos, id_estado, id_iva, perecedero_productos, inventariable_productos, creado, modificado, id_usuarios
				FROM public.productos
				WHERE id_productos='$id_productos'";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	    exit();
	    
	    }
	    
	    }
	}
  
  public function DataEliminar(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $id_productos = (isset($_POST['id_productos'])) ? $_POST['id_productos'] : 0;
	    
	    if($id_productos > 0 ){
	        
	    $query1="UPDATE productos SET id_estado=2
				WHERE id_productos='$id_productos'";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    echo json_encode(array('data'=>1));
	    exit();
	    
	    
	    }
	}
  
   
	public function dtMostrar_Productos(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "a.id_productos , a.codigo_productos , a.nombre_productos, b.nombre_marca_productos , d.nombre_presentacion_productos , a.stock_min_venta_mayoreo_productos , a.stock_productos , 
			a.precio_compra_productos , a.precio_venta_productos , f.nombre_iva , e.id_estado, e.nombre_estado, g.nombre_usuarios, a.precio_venta_mayoreo_productos ";
	        $tablas1   = "productos a
						inner join marca_productos b on a.id_marca_productos =b.id_marca_productos 
						inner join tipo_productos c on a.id_tipo_productos =c.id_tipo_productos 
						inner join presentacion_productos d on a.id_presentacion_productos =d.id_presentacion_productos 
						inner join estado e ON a.id_estado =e.id_estado 
						inner join iva f on a.id_iva =f.id_iva
						inner join usuarios g on a.id_usuarios =g.id_usuarios";
	        $where1    = "1=1";
	        $id        = "a.id_productos";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND (a.codigo_productos ILIKE  '%".$searchDataTable."%' or a.nombre_productos ILIKE  '%".$searchDataTable."%' or e.nombre_estado ILIKE  '%".$searchDataTable."%')";
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => 'a.codigo_productos',
	            1 => 'a.nombre_productos',
	            2 => 'b.nombre_marca_productos',
	            3 => 'd.nombre_presentacion_productos',
	            4 => 'a.stock_min_venta_mayoreo_productos',
	            5 => 'a.stock_productos',
	            6 => 'a.precio_compra_productos',
				7 => 'a.precio_venta_productos',
				8 => 'a.precio_venta_mayoreo_productos',
				9 => 'e.nombre_estado',
				
	            
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
	        
	        $limite="";
			$estado="";
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
	            $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="editar(this)" id="" data-id_productos="'.$res->id_productos.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Editar"> <i class="text-yellow fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                              <span >
                                <a onclick="eliminar(this)" id="" data-id_productos="'.$res->id_productos.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar"> <i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                           
                            </div>';
	            
				
				if($res->stock_productos <= $res->stock_min_venta_mayoreo_productos && $res->stock_productos > 0){
					$limite = '<span class="badge bg-yellow" style="font-size: 12px;">'.$res->stock_productos.' <b>Por Agotarse</b></span>';
				}else if($res->stock_productos <= 0.00){
					$limite = '<span class="badge bg-red" style="font-size: 12px;">'.$res->stock_productos.' <b>Agotado</b></span>';
				}
				else{
					$limite = '<span class="badge bg-green" style="font-size: 12px;">'.$res->stock_productos.'</span>';
				}
                
				if($res->id_estado==1){$estado = '<span class="badge bg-green" style="font-size: 12px;">'.$res->nombre_estado.'</span>';}
                if($res->id_estado==2){$estado = '<span class="badge bg-red" style="font-size: 12px;">'.$res->nombre_estado.'</span>';}
               
				
				
	            $dataFila['codigo_productos']       = $res->codigo_productos;
	            $dataFila['nombre_productos']       = $res->nombre_productos;
	            $dataFila['nombre_marca_productos']       = $res->nombre_marca_productos;
	            
	            $dataFila['nombre_presentacion_productos']       = $res->nombre_presentacion_productos;
	            $dataFila['stock_min_venta_mayoreo_productos']       = $res->stock_min_venta_mayoreo_productos;
	            $dataFila['stock_productos']       = $limite;
	            $dataFila['precio_compra_productos']       = $res->precio_compra_productos;
				$dataFila['precio_venta_productos']       = $res->precio_venta_productos;
				$dataFila['precio_venta_mayoreo_productos']       = $res->precio_venta_mayoreo_productos;
				$dataFila['nombre_estado']       = $estado;
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
	                "data" => $data
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
	
  
  
  
  
	public function RegistrarProductos(){
	    
	    $usuarios       = new UsuariosModel();
		$productos       = new ProductosModel();
	    $respuesta         = array();
	    $error             = "";
	    $_det_error       = "";
		 
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    
	    
	    /**
	     ****************************************************** validar las variables a procesar ****************************************************
	     **/
	    try {
	        
			
	        $id_productos  					= $_POST['id_productos'];
	        $codigo_productos      			= $_POST['codigo_productos'];
	        $nombre_productos     			= $_POST['nombre_productos'];
			$stock_productos  				= $_POST['stock_productos'];
	        $precio_compra_productos        = $_POST['precio_compra_productos'];
	        $precio_venta_productos     	= $_POST['precio_venta_productos'];
			$precio_venta_mayoreo_productos  = $_POST['precio_venta_mayoreo_productos'];
	        $stock_min_venta_mayoreo_productos       = $_POST['stock_min_venta_mayoreo_productos'];
	        $id_tipo_productos     			= $_POST['id_tipo_productos'];
			$id_marca_productos     		= $_POST['id_marca_productos'];
			$id_presentacion_productos      = $_POST['id_presentacion_productos'];
			$id_iva     					= $_POST['id_iva'];
			$id_estado     					= $_POST['id_estado'];
			$perecedero_productos     		= $_POST['perecedero_productos'];
			$inventariable_productos     	= $_POST['inventariable_productos'];
			
	        $_usuario_usuarios  = $_SESSION['usuario_usuarios'];
	        $id_usuarios       = $_SESSION['id_usuarios'];
	        
	        
	        
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
	        
			
		    if($id_productos > 0){
		    	
		        if (isset($_FILES['imagen_productos']['tmp_name'])!="")
		        {
		            
		            $directorio = $_SERVER['DOCUMENT_ROOT'].'/supermercado/imagen_productos/';
		            
		            $nombre = $_FILES['imagen_productos']['name'];
		            $tipo = $_FILES['imagen_productos']['type'];
		            $tamano = $_FILES['imagen_productos']['size'];
		            
		            move_uploaded_file($_FILES['imagen_productos']['tmp_name'],$directorio.$nombre);
		            $data = file_get_contents($directorio.$nombre);
		            $imagen_productos = pg_escape_bytea($data);
		        
				
		        	$colval = "
					codigo_productos='$codigo_productos',
					nombre_productos='$nombre_productos',
					precio_compra_productos='$precio_compra_productos',
					precio_venta_productos='$precio_venta_productos',
					precio_venta_mayoreo_productos='$precio_venta_mayoreo_productos',
					stock_min_venta_mayoreo_productos='$stock_min_venta_mayoreo_productos',
					id_tipo_productos='$id_tipo_productos',
					id_marca_productos='$id_marca_productos',
					id_presentacion_productos='$id_presentacion_productos',
					id_iva='$id_iva',
					id_estado='$id_estado',
					perecedero_productos='$perecedero_productos',
					inventariable_productos='$inventariable_productos',
					id_usuarios='$id_usuarios',
					imagen_productos='$imagen_productos'";
		    		$tabla = "productos";
		    		$where = "id_productos = '$id_productos'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    		 
		        }
		   
		        else {
		            
		           $colval = "
					codigo_productos='$codigo_productos',
					nombre_productos='$nombre_productos',
					precio_compra_productos='$precio_compra_productos',
					precio_venta_productos='$precio_venta_productos',
					precio_venta_mayoreo_productos='$precio_venta_mayoreo_productos',
					stock_min_venta_mayoreo_productos='$stock_min_venta_mayoreo_productos',
					id_tipo_productos='$id_tipo_productos',
					id_marca_productos='$id_marca_productos',
					id_presentacion_productos='$id_presentacion_productos',
					id_iva='$id_iva',
					id_estado='$id_estado',
					perecedero_productos='$perecedero_productos',
					inventariable_productos='$inventariable_productos',
					id_usuarios='$id_usuarios'";
		    		$tabla = "productos";
		    		$where = "id_productos = '$id_productos'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		            
		    		 
		        }
		    		
				$respuesta['mensaje']   = "Producto Actualizado Correctamente";
		    	
		    }else{
		        
		        if (isset($_FILES['imagen_productos']['tmp_name'])!="")
		        {
		            
		            $directorio = $_SERVER['DOCUMENT_ROOT'].'/supermercado/imagen_productos/';
		            
		            $nombre = $_FILES['imagen_productos']['name'];
		            $tipo = $_FILES['imagen_productos']['type'];
		            $tamano = $_FILES['imagen_productos']['size'];
		            
		            move_uploaded_file($_FILES['imagen_productos']['tmp_name'],$directorio.$nombre);
		            $data = file_get_contents($directorio.$nombre);
		            $imagen_productos = pg_escape_bytea($data);
		            
		    		$funcion = "ins_productos";
		    		$parametros = "'$nombre_productos',
									'$codigo_productos',
									'$stock_productos',
									'$precio_compra_productos',
									'$precio_venta_productos',
									'$precio_venta_mayoreo_productos',
									'$stock_min_venta_mayoreo_productos',
									'$imagen_productos',
									'$id_tipo_productos',
									'$id_marca_productos',
									'$id_presentacion_productos',
									'$id_estado',
									'$id_iva',
									'$perecedero_productos',
									'$inventariable_productos',
									'$id_usuarios'";
		    		$_queryInsercionDetalle = $usuarios->getconsultaPG($funcion, $parametros);
		    		$resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
		    		 
					$respuesta['mensaje']   = "Producto Registrado Correctamente";
			
		        }
		        
		        
		        else {
		            
		            
		            
		            
		            $where_TO = "codigo_productos = '$codigo_productos'";
		            $result=$productos->getBy($where_TO);
		            
		            if ( !empty($result) )
		            {
		                
		               $colval = "
							codigo_productos='$codigo_productos',
							nombre_productos='$nombre_productos',
							precio_compra_productos='$precio_compra_productos',
							precio_venta_productos='$precio_venta_productos',
							precio_venta_mayoreo_productos='$precio_venta_mayoreo_productos',
							stock_min_venta_mayoreo_productos='$stock_min_venta_mayoreo_productos',
							id_tipo_productos='$id_tipo_productos',
							id_marca_productos='$id_marca_productos',
							id_presentacion_productos='$id_presentacion_productos',
							id_iva='$id_iva',
							id_estado='$id_estado',
							perecedero_productos='$perecedero_productos',
							inventariable_productos='$inventariable_productos',
							id_usuarios='$id_usuarios'";
							$tabla = "productos";
							$where = "codigo_productos = '$codigo_productos'";
							$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		            
					$respuesta['mensaje']   = "Producto Actualizado Correctamente";
		            
		            }
		                
		            else{
		                 
		                
		                
		            $imagen_productos = "";
		            
		    		$funcion = "ins_productos";
		    		$parametros = "'$nombre_productos',
									'$codigo_productos',
									'$stock_productos',
									'$precio_compra_productos',
									'$precio_venta_productos',
									'$precio_venta_mayoreo_productos',
									'$stock_min_venta_mayoreo_productos',
									'$imagen_productos',
									'$id_tipo_productos',
									'$id_marca_productos',
									'$id_presentacion_productos',
									'$id_estado',
									'$id_iva',
									'$perecedero_productos',
									'$inventariable_productos',
									'$id_usuarios'";
		    		$_queryInsercionDetalle = $usuarios->getconsultaPG($funcion, $parametros);
		    		$resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
		    		 
					$respuesta['mensaje']   = "Producto Registrado Correctamente";
					   
		            }
		            
		        }
			
	        }
			
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("Error Insertando Producto"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_clientes']= 1;
	        echo json_encode( $respuesta );
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message> Error Insertando Producto \n'.$ex->getMessage().' <message>';
	    }
	    
	}
	
  

	public function AutocompleteCodigo(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		$productos = new ProductosModel();
		$codigo_productos = $_GET['term'];
			
		$resultSet=$productos->getBy("codigo_productos ILIKE '$codigo_productos%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_codigo_productos[] = $res->codigo_productos;
			}
			echo json_encode($_codigo_productos);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveDatos(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		$productos = new ProductosModel();
		$codigo_productos = $_POST['codigo_productos'];
		$resultSet=$productos->getBy("codigo_productos = '$codigo_productos'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->id_productos = $resultSet[0]->id_productos;
		    $respuesta->nombre_productos = $resultSet[0]->nombre_productos;
			$respuesta->codigo_productos = $resultSet[0]->codigo_productos;
			$respuesta->stock_productos = $resultSet[0]->stock_productos;
			$respuesta->precio_compra_productos = $resultSet[0]->precio_compra_productos;
			$respuesta->precio_venta_productos = $resultSet[0]->precio_venta_productos;
			$respuesta->precio_venta_mayoreo_productos = $resultSet[0]->precio_venta_mayoreo_productos;
			$respuesta->stock_min_venta_mayoreo_productos = $resultSet[0]->stock_min_venta_mayoreo_productos;
			$respuesta->id_tipo_productos = $resultSet[0]->id_tipo_productos;
			$respuesta->id_marca_productos = $resultSet[0]->id_marca_productos;
			$respuesta->id_presentacion_productos = $resultSet[0]->id_presentacion_productos;
			$respuesta->id_estado = $resultSet[0]->id_estado;
			$respuesta->id_iva = $resultSet[0]->id_iva;
			
			if($resultSet[0]->perecedero_productos=='t'){
				
				$respuesta->perecedero_productos='TRUE';
				
			}else{
				
				$respuesta->perecedero_productos='FALSE';
			}
			
			if($resultSet[0]->inventariable_productos=='t'){
				
				$respuesta->inventariable_productos='TRUE';
				
			}else{
				
				$respuesta->inventariable_productos='FALSE';
			}
			
			
			echo json_encode($respuesta);
		}
			
	}
	

	public function jsonget_cliente(){

		$db = new ModulosModel();
		$cedula = isset($_POST['cedula'])?$_POST['cedula']:""; 
		$respuesta	= [];
		$where	= ( empty($cedula) ) ? "" : " and aa.identificacion_clientes = '$cedula' ";
		$qCliente	= " select  
		aa.id_clientes
		, aa.razon_social_clientes
		, aa.identificacion_clientes
		, aa.direccion_clientes
		, aa.celular_clientes
		, aa.correo_clientes
		, bb.nombre_tipo_identificacion
	from clientes aa
	inner join tipo_identificacion bb on bb.id_tipo_identificacion = aa.id_tipo_identificacion
	where 1 = 1
	$where ";
		$rsCliente	= $db->enviaquery( $qCliente );
		if( empty( $rsCliente ) ){
			$respuesta['estatus'] = 'ERROR';
			$respuesta['mensaje'] = 'cliente no registrado';
		}else{
			$respuesta['estatus'] = 'OK';
			$respuesta['data'] = $rsCliente;
		}

		echo json_encode( $respuesta );

	}
	
	
}
?>
