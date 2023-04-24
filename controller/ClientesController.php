<?php
class ClientesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
   public function index(){
	    
	    session_start();
	    
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        
	        $usuarios= new UsuariosModel();
	        
	        $nombre_controladores = "Clientes";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	       
	        if (!empty($resultPer))
	        {
	            
	            $this->view_Administracion("Clientes",array(
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
    
    
	public function CargarTipoIdentificacion(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $query1="select id_tipo_identificacion , nombre_tipo_identificacion  from tipo_identificacion order by id_tipo_identificacion asc";
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
  
    
	public function DataEditar(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $id_clientes = (isset($_POST['id_clientes'])) ? $_POST['id_clientes'] : 0;
	    
	    if($id_clientes > 0 ){
	        
	    $query1="SELECT id_clientes, razon_social_clientes, id_tipo_identificacion, identificacion_clientes, direccion_clientes, celular_clientes, correo_clientes, id_estado, fotografia_clientes, creado, modificado, id_usuarios, valor_limite_credito
				FROM public.clientes
				WHERE id_clientes='$id_clientes'";
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
	    
	    
	    $id_clientes = (isset($_POST['id_clientes'])) ? $_POST['id_clientes'] : 0;
	    
	    if($id_clientes > 0 ){
	        
	    $query1="UPDATE clientes SET id_estado=2
				WHERE id_clientes='$id_clientes'";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    echo json_encode(array('data'=>1));
	    exit();
	    
	    
	    }
	}
  
   
	public function dtMostrar_Clientes(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new UsuariosModel();
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "a.id_clientes , b.nombre_tipo_identificacion , a.identificacion_clientes , a.razon_social_clientes , a.celular_clientes , a.correo_clientes, a.direccion_clientes , c.nombre_estado, c.id_estado , d.usuario_usuarios";
	        $tablas1   = "clientes a
							inner join tipo_identificacion b on a.id_tipo_identificacion = b.id_tipo_identificacion 
							inner join estado c on a.id_estado =c.id_estado 
							inner join usuarios d on a.id_usuarios =d.id_usuarios";
	        $where1    = "1=1";
	        $id        = "a.id_clientes";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND a.identificacion_clientes ILIKE  '%".$searchDataTable."%' ";
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => 'b.nombre_tipo_identificacion',
	            1 => 'a.identificacion_clientes',
	            2 => 'a.razon_social_clientes',
	            3 => 'a.correo_clientes',
	            4 => 'a.celular_clientes',
	            5 => 'c.nombre_estado',
	            6 => 'd.usuario_usuarios'
	            
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
	        
	        $estado="";
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
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
	            
				
				if($res->id_estado==1){$estado = '<span class="badge bg-green" style="font-size: 12px;">'.$res->nombre_estado.'</span>';}
                if($res->id_estado==2){$estado = '<span class="badge bg-red" style="font-size: 12px;">'.$res->nombre_estado.'</span>';}
               
				
	            $dataFila['nombre_tipo_identificacion']       = $res->nombre_tipo_identificacion;
	            $dataFila['identificacion_clientes']       = $res->identificacion_clientes;
	            $dataFila['razon_social_clientes']       = $res->razon_social_clientes;
	            
	           // if($res->estado_g42_cabeza=='t'){$estado="ACEPTADO";}else{$estado="ANULADO";}
	            $dataFila['correo_clientes']       = $res->correo_clientes;
	            $dataFila['celular_clientes']       = $res->celular_clientes;
	            $dataFila['nombre_estado']       = $estado;
	            $dataFila['usuario_usuarios']       = $res->usuario_usuarios;
	           
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
	
  
  
  
  
	public function RegistrarClientes(){
	    
	    $usuarios       = new UsuariosModel();
		$clientes       = new ClientesModel();
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
	        
	        $_id_clientes  = $_POST['id_clientes'];
	        $_id_tipo_identificacion      = $_POST['id_tipo_identificacion'];
	        $_identificacion_clientes     = $_POST['identificacion_clientes'];
			$_razon_social_clientes  = $_POST['razon_social_clientes'];
	        $_celular_clientes       = $_POST['celular_clientes'];
	        $_correo_clientes     = $_POST['correo_clientes'];
			$_direccion_clientes  = $_POST['direccion_clientes'];
	        $_valor_limite_credito       = $_POST['valor_limite_credito'];
	        $_id_estado     = $_POST['id_estado'];
			
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
	        
			
		    if($_id_clientes > 0){
		    	
		        if (isset($_FILES['fotografia_clientes']['tmp_name'])!="")
		        {
		            
		            $directorio = $_SERVER['DOCUMENT_ROOT'].'/supermercado/fotografia_clientes/';
		            
		            $nombre = $_FILES['fotografia_clientes']['name'];
		            $tipo = $_FILES['fotografia_clientes']['type'];
		            $tamano = $_FILES['fotografia_clientes']['size'];
		            
		            move_uploaded_file($_FILES['fotografia_clientes']['tmp_name'],$directorio.$nombre);
		            $data = file_get_contents($directorio.$nombre);
		            $_fotografia_clientes = pg_escape_bytea($data);
		        
		        	$colval = "id_tipo_identificacion='$_id_tipo_identificacion',
		    		identificacion_clientes= '$_identificacion_clientes',
		    		razon_social_clientes = '$_razon_social_clientes',
		    		celular_clientes = '$_celular_clientes',
		    		correo_clientes = '$_correo_clientes',
		    		direccion_clientes='$_direccion_clientes',
		    		id_estado='$_id_estado',
                    fotografia_clientes='$_fotografia_clientes',
					valor_limite_credito='$_valor_limite_credito',
					id_usuarios='$_id_usuarios'";
		    		$tabla = "clientes";
		    		$where = "id_clientes = '$_id_clientes'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    		 
		        }
		   
		        else {
		            
		            $colval = "id_tipo_identificacion='$_id_tipo_identificacion',
		    		identificacion_clientes= '$_identificacion_clientes',
		    		razon_social_clientes = '$_razon_social_clientes',
		    		celular_clientes = '$_celular_clientes',
		    		correo_clientes = '$_correo_clientes',
		    		direccion_clientes='$_direccion_clientes',
		    		id_estado='$_id_estado',
					valor_limite_credito='$_valor_limite_credito',
					id_usuarios='$_id_usuarios'";
		            $tabla = "clientes";
		            $where = "id_clientes = '$_id_clientes'";
		            $resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		            
		    		 
		        }
		    		
				$respuesta['mensaje']   = "Cliente Actualizado Correctamente";
		    	
		    }else{
		        
		        if (isset($_FILES['fotografia_clientes']['tmp_name'])!="")
		        {
		            
		            $directorio = $_SERVER['DOCUMENT_ROOT'].'/supermercado/fotografia_clientes/';
		            
		            $nombre = $_FILES['fotografia_clientes']['name'];
		            $tipo = $_FILES['fotografia_clientes']['type'];
		            $tamano = $_FILES['fotografia_clientes']['size'];
		            
		            move_uploaded_file($_FILES['fotografia_clientes']['tmp_name'],$directorio.$nombre);
		            $data = file_get_contents($directorio.$nombre);
		            $_fotografia_clientes = pg_escape_bytea($data);
		            
		            
		    		$funcion = "ins_clientes";
		    		$parametros = "'$_razon_social_clientes',
									'$_id_tipo_identificacion',
									'$_identificacion_clientes',
									'$_direccion_clientes',
									'$_celular_clientes',
									'$_correo_clientes',
									'$_id_estado',
									'$_fotografia_clientes',
									'$_id_usuarios',
									'$_valor_limite_credito'";
		    		$_queryInsercionDetalle = $usuarios->getconsultaPG($funcion, $parametros);
		    		$resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
		    		 
					$respuesta['mensaje']   = "Cliente Registrado Correctamente";
			
		        }
		        
		        
		        else {
		            
		            
		            $_fotografia_clientes="";
		            
		            $directorio = dirname(__FILE__).'\..\view\images\usuario.jpg';
		            
		            if( is_file( $directorio )){
		                $data = file_get_contents($directorio);
		                $_fotografia_clientes = pg_escape_bytea($data);
		            }  
		            
		            $where_TO = "identificacion_clientes = '$_identificacion_clientes'";
		            $result=$clientes->getBy($where_TO);
		            
		            if ( !empty($result) )
		            {
		                
		                $colval = "id_tipo_identificacion='$_id_tipo_identificacion',
    		    		identificacion_clientes= '$_identificacion_clientes',
    		    		razon_social_clientes = '$_razon_social_clientes',
    		    		celular_clientes = '$_celular_clientes',
    		    		correo_clientes = '$_correo_clientes',
    		    		valor_limite_credito='$_valor_limite_credito',
    		    		direccion_clientes='$_direccion_clientes',
		    		    id_estado='$_id_estado',
						id_usuarios='$_id_usuarios'";
		                $tabla = "clientes";
		                $where = "identificacion_clientes = '$_identificacion_clientes'";
		                $resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		            
					$respuesta['mensaje']   = "Cliente Actualizado Correctamente";
		            
		            }
		                
		            else{
		                 
		                
		                
		               $funcion = "ins_clientes";
		               $parametros = "'$_razon_social_clientes',
									'$_id_tipo_identificacion',
									'$_identificacion_clientes',
									'$_direccion_clientes',
									'$_celular_clientes',
									'$_correo_clientes',
									'$_id_estado',
									'$_fotografia_clientes',
									'$_id_usuarios',
									'$_valor_limite_credito'";
		            $_queryInsercionDetalle = $clientes->getconsultaPG($funcion, $parametros);
		    		$resultado= $usuarios->llamarconsultaPG($_queryInsercionDetalle);
					
					$respuesta['mensaje']   = "Cliente Registrado Correctamente";
		            }
		            
		            
		        }
			
	        }
			
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("Error Insertando Cliente"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_clientes']= 1;
	        echo json_encode( $respuesta );
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message> Error Insertando Cliente \n'.$ex->getMessage().' <message>';
	    }
	    
	}
	
  

	public function AutocompleteCedula(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		$clientes = new ClientesModel();
		$identificacion_clientes = $_GET['term'];
			
		$resultSet=$clientes->getBy("identificacion_clientes ILIKE '$identificacion_clientes%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_identificacion_clientes[] = $res->identificacion_clientes;
			}
			echo json_encode($_identificacion_clientes);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveNombres(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		$clientes = new ClientesModel();
		$identificacion_clientes = $_POST['identificacion_clientes'];
		$resultSet=$clientes->getBy("identificacion_clientes = '$identificacion_clientes'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->razon_social_clientes = $resultSet[0]->razon_social_clientes;
		    $respuesta->id_tipo_identificacion = $resultSet[0]->id_tipo_identificacion;
			$respuesta->identificacion_clientes = $resultSet[0]->identificacion_clientes;
			$respuesta->direccion_clientes = $resultSet[0]->direccion_clientes;
			$respuesta->celular_clientes = $resultSet[0]->celular_clientes;
			$respuesta->correo_clientes = $resultSet[0]->correo_clientes;
			$respuesta->id_estado = $resultSet[0]->id_estado;
			$respuesta->id_clientes = $resultSet[0]->id_clientes;
			$respuesta->valor_limite_credito = $resultSet[0]->valor_limite_credito;
			
			echo json_encode($respuesta);
		}
			
	}
	
	
	
}
?>
