<?php
class ProveedoresController extends ControladorBase{
    public function __construct() {
        parent::__construct();
    }
   public function index(){
	    session_start();
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        $db = new ModeloModel();
	        $nombre_controladores = "Proveedores";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $db->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        if (!empty($resultPer))
	        {
	            $this->view_Administracion("Proveedores",array(
	                ""=>""
	            ));
	        }else{
	            $this->view("Error",array(
	                "resultado"=>"No tiene permisos para acceder a este formulario"
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
	    $db= new ModeloModel();
	    $query = "select id_tipo_identificacion , nombre_tipo_identificacion  from tipo_identificacion order by id_tipo_identificacion asc";
	    $resultado = $db->enviaquery($query);
	    if(!empty($resultado)){
	        echo json_encode(array('data'=>$resultado));
	        exit();
	        
	    }
	}
  
   public function CargarEstado(){
	    session_start();
	    $db = new ModeloModel();
	    $query="select id_estado , nombre_estado  from estado where tabla_estado ='PROVEEDORES' order by id_estado asc";
	    $resultado = $db->enviaquery($query);
	    if(!empty($resultado)){
	        echo json_encode(array('data'=>$resultado));
	        exit();
	        
	    }
	}
  
	public function Registrar(){
	    
	    $db                = new ModeloModel();
	    $respuesta         = array();
	    $_det_error        = "";
	    
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    try {
	        
	        $_id_proveedores                   = $_POST['id_proveedores'];
	        $_razon_social_proveedores         = $_POST['razon_social_proveedores'];
	        $_id_tipo_identificacion           = $_POST['id_tipo_identificacion'];
	        $_identificacion_proveedores       = $_POST['identificacion_proveedores'];
	        $_direccion_proveedores            = $_POST['direccion_proveedores'];
	        $_celular_proveedores              = $_POST['celular_proveedores'];
	        $_correo_proveedores               = $_POST['correo_proveedores'];
	        $_id_estado                        = $_POST['id_estado'];
	        $_id_usuarios                      = $_SESSION['id_usuarios'];
	        
	    }catch (Exception $e) {
	        echo "<message>".$e->getMessage()."<message>";
	        exit();
	    }
	    
	   try{
	        $db->beginTran();
	        
	        $respuesta = array();
	        
	        
	        if($_id_proveedores > 0){
	            
	            if (isset($_FILES['fotografia_proveedores']['tmp_name'])!="")
	            {
	                
	                $directorio = $_SERVER['DOCUMENT_ROOT'].'/supermercado/fotografia_proveedores/';
	                $nombre = $_FILES['fotografia_proveedores']['name'];
	                
	                move_uploaded_file($_FILES['fotografia_proveedores']['tmp_name'],$directorio.$nombre);
	                $data = file_get_contents($directorio.$nombre);
	                $_fotografia_proveedores = pg_escape_bytea($data);
	                
	                $colval = "
                    razon_social_proveedores                    ='$_razon_social_proveedores',
                    id_tipo_identificacion                      ='$_id_tipo_identificacion',
		    		identificacion_proveedores                  ='$_identificacion_proveedores',
		    		direccion_proveedores                       ='$_direccion_proveedores',
		    		celular_proveedores                         ='$_celular_proveedores',
		    		correo_proveedores                          ='$_correo_proveedores',
		    		id_estado                                   ='$_id_estado',
                    fotografia_proveedores                      ='$_fotografia_proveedores',
					id_usuarios                                 ='$_id_usuarios'
                    ";
	                $tabla = "proveedores";
	                $where = "id_proveedores = '$_id_proveedores'";
	                $resultado=$db->UpdateBy($colval, $tabla, $where);
	                
	            }
	            
	            else {
	                
	                $colval = "
                    razon_social_proveedores                    ='$_razon_social_proveedores',
                    id_tipo_identificacion                      ='$_id_tipo_identificacion',
		    		identificacion_proveedores                  ='$_identificacion_proveedores',
		    		direccion_proveedores                       ='$_direccion_proveedores',
		    		celular_proveedores                         ='$_celular_proveedores',
		    		correo_proveedores                          ='$_correo_proveedores',
		    		id_estado                                   ='$_id_estado',
                    id_usuarios                                 ='$_id_usuarios'
                    ";
	                $tabla = "proveedores";
	                $where = "id_proveedores = '$_id_proveedores'";
	                $resultado=$db->UpdateBy($colval, $tabla, $where);
	                
	                
	            }
	            
	            $respuesta['mensaje']   = "Datos Actualizados Correctamente";
	            
	        }else{
	            
	            if (isset($_FILES['fotografia_proveedores']['tmp_name'])!="")
	            {
	                
	                $directorio = $_SERVER['DOCUMENT_ROOT'].'/supermercado/fotografia_proveedores/';
	                
	                $nombre = $_FILES['fotografia_proveedores']['name'];
	                
	                move_uploaded_file($_FILES['fotografia_proveedores']['tmp_name'],$directorio.$nombre);
	                $data = file_get_contents($directorio.$nombre);
	                $_fotografia_proveedores = pg_escape_bytea($data);
	                
	                $funcion = "ins_proveedores";
	                $parametros = "'$_razon_social_proveedores',
									'$_id_tipo_identificacion',
									'$_identificacion_proveedores',
									'$_direccion_proveedores',
									'$_celular_proveedores',
									'$_correo_proveedores',
									'$_id_estado',
									'$_fotografia_proveedores',
									'$_id_usuarios'";
	                $_query = $db->getconsultaPG($funcion, $parametros);
	                $resultado= $db->llamarconsultaPG($_query);
	                
	                $respuesta['mensaje']   = "Datos Registrados Correctamente";
	                
	            }
	            
	            
	            else {
	            
	                $_fotografia_proveedores="";
	                
	                $directorio = dirname(__FILE__).'\..\view\images\usuario.jpg';
	                
	                if( is_file( $directorio )){
	                    $data = file_get_contents($directorio);
	                    $_fotografia_proveedores = pg_escape_bytea($data);
	                }
	                $where_to = "identificacion_proveedores = '$_identificacion_proveedores'";
	                $resultado =$db->getBy($where_to);
	                
	                if ( !empty($resultado))
	                {
	                    
	                    $colval = "
                        razon_social_proveedores                    ='$_razon_social_proveedores',
                        id_tipo_identificacion                      ='$_id_tipo_identificacion',
    		    		identificacion_proveedores                  ='$_identificacion_proveedores',
    		    		direccion_proveedores                       ='$_direccion_proveedores',
    		    		celular_proveedores                         ='$_celular_proveedores',
    		    		correo_proveedores                          ='$_correo_proveedores',
    		      	    id_estado                                   ='$_id_estado',
						id_usuarios                                 ='$_id_usuarios'
                        ";
	                    $tabla = "proveedores";
	                    $where = "identificacion_proveedores = '$_identificacion_proveedores'";
	                    $resultado=$db->UpdateBy($colval, $tabla, $where);
	                    
	                    $respuesta['mensaje']   = "Datos Actualizados Correctamente";
	                    
	                }
	                
	                else{
	                   
	                    $funcion = "ins_proveedores";
	                    $parametros = "'$_razon_social_proveedores',
									'$_id_tipo_identificacion',
									'$_identificacion_proveedores',
									'$_direccion_proveedores',
									'$_celular_proveedores',
									'$_correo_proveedores',
									'$_id_estado',
									'$_fotografia_proveedores',
									'$_id_usuarios'";
	                    $_query = $db->getconsultaPG($funcion, $parametros);
	                    $resultado= $db->llamarconsultaPG($_query);
	                    
	                    $respuesta['mensaje']   = "Datos Registrados Correctamente";
	                }
	                
	                
	            }
	            
	        }
	        die();
	        
	        $_det_error = pg_last_error();
	        if( !empty($_det_error) ){ throw new Exception("Error Insertando"); }
	        
	        
	        $respuesta['respuesta'] = 1;
	        $respuesta['id_proveedores']= 1;
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
	    
	    
	    $id_proveedores = (isset($_POST['id_proveedores'])) ? $_POST['id_proveedores'] : 0;
	    
	    if($id_proveedores > 0 ){
	        
	    $query="SELECT id_proveedores,
                razon_social_proveedores,
                id_tipo_identificacion, 
                identificacion_proveedores,   
                direccion_proveedores, 
                celular_proveedores, 
                correo_proveedores, 
                id_estado, 
                fotografia_proveedores, 
                id_usuarios 
                FROM public.proveedores
				WHERE id_proveedores='$id_proveedores'";
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
	    $id_proveedores = (isset($_POST['id_proveedores'])) ? $_POST['id_proveedores'] : 0;
	    if($id_proveedores > 0 ){
	    $query="UPDATE proveedores SET id_estado= 2
				WHERE id_proveedores='$id_proveedores'";
	    $resultado = $db->enviaquery($query);
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
	        $requestData = $_REQUEST;
	        $searchDataTable   = $requestData['search']['value'];
	         $columnas = "a.id_proveedores,
                          a.razon_social_proveedores,
                          b.nombre_tipo_identificacion,
                          a.identificacion_proveedores,
                          a.direccion_proveedores,
                          a.celular_proveedores,
                          a.correo_proveedores, 
                          c.nombre_estado,
                          c.id_estado,
                          d.usuario_usuarios";
	         $tablas   = "proveedores a
							inner join tipo_identificacion b on a.id_tipo_identificacion = b.id_tipo_identificacion 
							inner join estado c on a.id_estado =c.id_estado 
							inner join usuarios d on a.id_usuarios =d.id_usuarios";
	        $where     = "1=1";
	        if( strlen( $searchDataTable ) > 0 ){
	            $where    .= " AND a.identificacion_proveedores ILIKE  '%".$searchDataTable."%' ";
	        }
	        $rsCantidad    = $db->getCantidad("*", $tablas, $where);
	        $cantidadBusqueda = (int)$rsCantidad[0]->total;
	        
	        $columns = array(
	            0 => 'b.razon_social_proveedores',
	            1 => 'b.nombre_tipo_identificacion',
	            2 => 'a.identificacion_proveedores',
	            3 => 'a.direccion_proveedores',
	            4 => 'a.celular_proveedores',
	            5 => 'a.correo_proveedores',
	            6 => 'c.nombre_estado',
	            7 => 'd.usuario_usuarios'
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
	        
	        $estado="";
	        foreach ( $resultSet as $res){
	            
	            $opciones="";
	            $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="Editar(this)" id="" data-id_proveedores="'.$res->id_proveedores.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Editar"> <i class="text-yellow fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                              <span >
                                <a onclick="Eliminar(this)" id="" data-id_proveedores="'.$res->id_proveedores.'" href="#" class=" no-padding btn btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar"> <i class=" text-red fa fa-trash fa-2x" aria-hidden="true" ></i>
	                           </a>
                            </span>
                           
                            </div>';
	            
				
				if($res->id_estado==1){$estado = '<span class="badge bg-green" style="font-size: 12px;">'.$res->nombre_estado.'</span>';}
                if($res->id_estado==2){$estado = '<span class="badge bg-red" style="font-size: 12px;">'.$res->nombre_estado.'</span>';}
           
                $dataFila['razon_social_proveedores']           = $res->razon_social_proveedores;
                $dataFila['nombre_tipo_identificacion']         = $res->nombre_tipo_identificacion;
                $dataFila['identificacion_proveedores']         = $res->identificacion_proveedores;
                $dataFila['direccion_proveedores']              = $res->direccion_proveedores;
	            $dataFila['celular_proveedores']                = $res->celular_proveedores;
                $dataFila['correo_proveedores']                 = $res->correo_proveedores;
	            $dataFila['nombre_estado']                      = $estado;
	            $dataFila['usuario_usuarios']                   = $res->usuario_usuarios;
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
	
  
	public function AutocompleteCedula(){
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$db = new ModeloModel();
		$identificacion_proveedores = $_GET['term'];
		$resultSet=$db->getBy("identificacion_proveedores ILIKE '$identificacion_proveedores%'");
		if(!empty($resultSet)){
			foreach ($resultSet as $res){
			    $_identificacion_proveedores[] = $res->identificacion_proveedores;
			}
			echo json_encode($_identificacion_proveedores);
		}
	}
	
	
	public function AutocompleteNombres(){
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$db = new ModeloModel();
		$identificacion_proveedores = $_POST['identificacion_proveedores'];
		$resultSet=$db->getBy("identificacion_proveedores = '$identificacion_proveedores'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
		    
		    $respuesta->razon_social_proveedores = $resultSet[0]->razon_social_proveedores;
		    $respuesta->nombre_tipo_identificacion = $resultSet[0]->nombre_tipo_identificacion;
		    $respuesta->identificacion_proveedores = $resultSet[0]->identificacion_proveedores;
		    $respuesta->direccion_proveedores = $resultSet[0]->direccion_proveedores;
		    $respuesta->celular_proveedores = $resultSet[0]->celular_proveedores;
		    $respuesta->correo_proveedores = $resultSet[0]->correo_proveedores;
			$respuesta->id_estado = $resultSet[0]->id_estado;
			$respuesta->id_proveedores = $resultSet[0]->id_proveedores;
			
			echo json_encode($respuesta);
		}
			
	}
	
	
	
}
?>
