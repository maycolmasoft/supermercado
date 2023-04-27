<?php
class TipoProductosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
   public function index(){
       session_start();
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        $db= new ModeloModel();
	        $nombre_controladores = "TipoProductos";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $db->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        if (!empty($resultPer))
	        {
	            $this->view_Administracion("TipoProductos",array(
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
    
    
	public function Registrar(){
	    
	    $db       = new ModeloModel();
	    $respuesta         = array();
	    $_det_error       = "";
	    
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    /**
	     ****************************************************** validar las variables a procesar ****************************************************
	     **/
	    try {
	        
	        $_id_tipo_productos          = $_POST['id_tipo_productos'];
	        $_nombre_tipo_productos      = $_POST['nombre_tipo_productos'];
	        
	        
	    }catch (Exception $e) {
	        echo "<message>".$e->getMessage()."<message>";
	        exit();
	    }
	    
	    
	    /**
	     ****************************************************** insercion del archivo en tabla ***********************************************************
	     **/
	    
	    try{
	        $db->beginTran();
	        
	        $respuesta = array();
	        
	        
	        if($_id_tipo_productos > 0){
	            
	                
	                $colval = "nombre_tipo_productos='$_nombre_tipo_productos'";
	                $tabla = "tipo_productos";
	                $where = "id_tipo_productos = '$_id_tipo_productos'";
	                $resultado=$db->UpdateBy($colval, $tabla, $where);
	                $respuesta['mensaje']   = "Datos Actualizados Correctamente";
	            
	        }else{
	                
	                $funcion = "ins_tipo_productos";
	                $parametros = "'$_nombre_tipo_productos'";
	                $query= $db->getconsultaPG($funcion, $parametros);
	                $resultado = $db->llamarconsultaPG($query);
	                $respuesta['mensaje']   = "Datos Registrados Correctamente";
	                
	            }
	            
	            
	        
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("Error Insertando"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_tipo_productos']= 1;
	        echo json_encode( $respuesta );
	        $db->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $db->endTran();
	        echo '<message> Error Insertando\n'.$ex->getMessage().' <message>';
	    }
	    
	}
	
  
  
  
  
    
	public function Editar(){
	    
	    session_start();
	    
	    $db = new ModeloModel();
	    
	    
	    $id_tipo_productos = (isset($_POST['id_tipo_productos'])) ? $_POST['id_tipo_productos'] : 0;
	    
	    if($id_tipo_productos > 0 ){
	        
	    $query="SELECT id_tipo_productos, nombre_tipo_productos
				FROM tipo_productos
				WHERE id_tipo_productos='$id_tipo_productos'";
	    $resultado = $db->enviaquery($query);
	    
	    if(!empty($resultado)){
	        echo json_encode(array('data'=>$resultado));
	    exit();
	    
	    }
	    
	    }
	}
  
  public function Eliminar(){
	    
	    session_start();
	    
	    $db = new ModeloModel();
	    
	    
	    $id_tipo_productos = (isset($_POST['id_tipo_productos'])) ? $_POST['id_tipo_productos'] : 0;
	    
	    if($id_tipo_productos > 0 ){
	        
	    $query="delete FROM tipo_productos
				WHERE id_tipo_productos='$id_tipo_productos'";
	    $resultado  = $db->enviaquery($query);
	    
	    echo json_encode(array('data'=>1));
	    exit();
	        
	    
	    }
	}
  
   
	public function Mostrar(){
	    
	    if( !isset( $_SESSION ) ){
	        session_start();
	    }
	    
	    
	    try{
	        
	        ob_start();
	        
	        $db = new ModeloModel();
	        
	        //dato que viene de parte del plugin DataTable
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	        
	        $columnas = "id_tipo_productos, nombre_tipo_productos";
	        $tablas   = "tipo_productos";
	        $where   = "1=1";
	        
	        if( strlen( $searchDataTable ) > 0 ){
	            $where  .= " AND nombre_tipo_productos ILIKE  '%".$searchDataTable."%' ";
	        }
	        
	        $rsCantidad    = $db ->getCantidad("*", $tablas, $where);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	   
	        $columns = array(
	            0 => 'id_tipo_productos',
	            1 => 'nombre_tipo_productos'
	        );
	        
	        $orderby   = $columns[$requestData['order'][0]['column']];
	        $orderdir  = $requestData['order'][0]['dir'];
	        $orderdir  = strtoupper($orderdir);
	        $per_page  = $requestData['length'];
	        $offset    = $requestData['start'];
	        
	        $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
	        
	        $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
	        
	        $resultSet = $db->getCondicionesSinOrden($columnas, $tablas, $where, $limit);
	       
	        $data = array();
	        $dataFila = array();
	        $numfila =0;
	        
	        
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
	            $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="Editar(this)" id="" data-id_tipo_productos="'.$res->id_tipo_productos.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Editar"> <i class="text-yellow fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                              <span >
                                <a onclick="Eliminar(this)" id="" data-id_tipo_productos="'.$res->id_tipo_productos.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar"> <i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                           
                            </div>';
	            
				
	            $numfila++;
	            $dataFila['numfila'] = $numfila;
	            $dataFila['nombre_tipo_productos']       = $res->nombre_tipo_productos;
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
