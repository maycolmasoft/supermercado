<?php
class LineaProductosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
   public function index(){
       
	    session_start();
	    
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        
	        $usuarios= new LineaProductosModel();
	        
	        $nombre_controladores = "LineaProductos";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	       
	        if (!empty($resultPer))
	        {
	            
	            $this->view_Administracion("LineaProductos",array(
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
    
    
	public function RegistrarLineaProductos(){
	    
	    $usuarios       = new LineaProductosModel();
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
	        
	        $_id_linea_productos          = $_POST['id_linea_productos'];
	        $_nombre_linea_productos      = $_POST['nombre_linea_productos'];
	        
	        
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
	        
	        
	        if($_id_linea_productos > 0){
	            
	                
	                $colval = "nombre_linea_productos='$_nombre_linea_productos'";
	                $tabla = "linea_productos";
	                $where = "id_linea_productos = '$_id_linea_productos'";
	                $resultado=$usuarios->UpdateBy($colval, $tabla, $where);
	            
	               $respuesta['mensaje']   = "Linea Productos Actualizada Correctamente";
	            
	        }else{
	                
	                $funcion = "ins_linea_productos";
	                $parametros = "'$_nombre_linea_productos'";
	                $query= $usuarios->getconsultaPG($funcion, $parametros);
	                $resultado= $usuarios->llamarconsultaPG($query);
	                
	                $respuesta['mensaje']   = "Linea Productos Registrada Correctamente";
	                
	            }
	            
	            
	        
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("Error Insertando Linea Productos"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_linea_productos']= 1;
	        echo json_encode( $respuesta );
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message> Error Insertando Linea Productos\n'.$ex->getMessage().' <message>';
	    }
	    
	}
	
  
  
  
  
    
	public function DataEditar(){
	    
	    session_start();
	    
	    $usuarios= new LineaProductosModel();
	    
	    
	    $id_linea_productos = (isset($_POST['id_linea_productos'])) ? $_POST['id_linea_productos'] : 0;
	    
	    if($id_linea_productos > 0 ){
	        
	    $query1="SELECT id_linea_productos, nombre_linea_productos
				FROM linea_productos
				WHERE id_linea_productos='$id_linea_productos'";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	    exit();
	    
	    }
	    
	    }
	}
  
  public function DataEliminar(){
	    
	    session_start();
	    
	    $usuarios= new LineaProductosModel();
	    
	    
	    $id_linea_productos = (isset($_POST['id_linea_productos'])) ? $_POST['id_linea_productos'] : 0;
	    
	    if($id_linea_productos > 0 ){
	        
	    $query1="delete FROM linea_productos
				WHERE id_linea_productos='$id_linea_productos'";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    echo json_encode(array('data'=>1));
	    exit();
	    
	    
	    }
	}
  
   
	public function dtMostrar_LineaProductos(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    
	    try{
	        
	        ob_start();
	        
	        $usuarios = new LineaProductosModel();
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        
	        $columnas1 = "id_linea_productos, nombre_linea_productos";
	        $tablas1   = "linea_productos";
	        $where1    = "1=1";
	        $id        = "id_linea_productos";
	        
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            
	            $where1    .= " AND nombre_linea_productos ILIKE  '%".$searchDataTable."%' ";
	            
	        }
	        
	        $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
	        
	        // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
	        $columns = array(
	            0 => 'id_linea_productos',
	            1 => 'nombre_linea_productos'
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
	        
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
	            $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="editar(this)" id="" data-id_linea_productos="'.$res->id_linea_productos.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Editar"> <i class="text-yellow fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                              <span >
                                <a onclick="eliminar(this)" id="" data-id_linea_productos="'.$res->id_linea_productos.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar"> <i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                           
                            </div>';
	            
				
		       
				
	            $dataFila['id_linea_productos']       = $res->id_linea_productos;
	            $dataFila['nombre_linea_productos']       = $res->nombre_linea_productos;
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
	
  
  
  
  
	

	
	
	

	
	
}
?>
