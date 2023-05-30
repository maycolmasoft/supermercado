<?php
class ComprasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
   public function index(){
	    
	    session_start();
	    
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        
	        $usuarios= new UsuariosModel();
	        
	        $nombre_controladores = "Compras";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	       
	        if (!empty($resultPer))
	        {
	            
	            $this->view_Compras("Compras",array(
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
    
    
	public function CargarEstadoFactura(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    $query1="select id_estado_factura , nombre_estado_factura from estado_factura order by id_estado_factura  asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	    }
	}
  
    public function CargarTipoComprobante(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    $query1="select id_tipo_comprobante , nombre_tipo_comprobante  from tipo_comprobante order by id_tipo_comprobante asc";
	    $preguntas  = $usuarios->enviaquery($query1);
	    
	    if(!empty($preguntas)){
	        echo json_encode(array('data'=>$preguntas));
	        exit();
	    }
	}
  
  
	public function CargarTipoPago(){
	    
	    session_start();
	    
	    $usuarios= new UsuariosModel();
	    
	    
	    $query1="select id_tipo_pago , nombre_tipo_pago from tipo_pago order by id_tipo_pago asc";
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
  
  
  public function jsonget_proveedores(){

        $db = new UsuariosModel();

        $term = ( isset($_GET['term']) ) ? $_GET['term'] : "";
        $where   = ( empty($term) ) ? "" : " AND razon_social_proveedores ILIKE '%$term%'";

        $qUsuario = " SELECT id_proveedores, razon_social_proveedores FROM proveedores  WHERE 1 = 1  $where ORDER BY id_proveedores asc";
        $rsUsuario   = $db->enviaquery( $qUsuario );

        $respuesta  = [];

        foreach ($rsUsuario as $res ) {
            $fila   = [];
            $fila['id'] = $res->id_proveedores;
            $fila['text'] = $res->razon_social_proveedores;

            array_push($respuesta,$fila);
        }

        echo json_encode( $respuesta );

    }
  
  
  
  
	public function RegistrarCompra(){
	    
	    $usuarios       = new UsuariosModel();
		$productos       = new ProductosModel();
	    $respuesta         = array();
	    $error             = "";
	    $_cab_error        = "";
	    $_det_error       = "";
		$_error_cabeza = false;
	    $_error_detalle = false;
		 
	    if( !isset($_SESSION) ){
	        session_start();
	    }
	    
	    
	    /**
	     ****************************************************** validar las variables a procesar ****************************************************
	     **/
	    try {
	        
			$datos_1                            = json_decode($_POST['lista_productos']);
	        $id_proveedores  					= $_POST['id_proveedores'];
	        $id_tipo_comprobante      			= $_POST['id_tipo_comprobante'];
	        $fecha_compra_cabeza     			= $_POST['fecha_compra_cabeza'];
			$id_tipo_pago  				        = $_POST['id_tipo_pago'];
	        $numero_comprobante_cabeza          = $_POST['numero_comprobante_cabeza'];
			
			$subtotal     			= $_POST['subtotal'];
			$iva  				    = $_POST['iva'];
	        $total                  = $_POST['total'];
	      
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
	        
	        // inserto cabecera compra
			$funcion = "ins_compra_cabeza";
	        $parametros = "'$id_proveedores','1','$id_tipo_comprobante','$numero_comprobante_cabeza','$fecha_compra_cabeza','0.00','0.00','1','$iva','1','0.00','$total','$id_usuarios','$id_tipo_pago'";
	        $_queryInsercionCabeza = $usuarios->getconsultaPG($funcion, $parametros);
	        $resultado_cabeza = $usuarios->llamarconsultaPG($_queryInsercionCabeza);
	        
	        // valido si existe error en la cabecera
	        $_cab_error = pg_last_error();
	        if(!empty($_cab_error)){ $_error_cabeza = true;}
	        
	        if( $_error_cabeza ){ throw new Exception("Error Insertando Cabecera, vuelva a intentar."); }
	        
	        $_id_compra_cabeza=$resultado_cabeza[0];
	        
	        if($_id_compra_cabeza>0){}else{throw new Exception("Error Recuperando Cabecera Compra");}
	        
			
			  // inserto cabecera inventario
			$funcion_inv = "ins_inventario_cabeza";
	        $parametros_inv = "'1','$id_usuarios','$fecha_compra_cabeza','0','0.00','0.00','$iva','0.00','$total','$_id_compra_cabeza','8','1'";
	        $_queryInsercionCabeza_inv = $usuarios->getconsultaPG($funcion_inv, $parametros_inv);
	        $resultado_cabeza_inv = $usuarios->llamarconsultaPG($_queryInsercionCabeza_inv);
	        
			
	        // valido si existe error en la cabecera del inventario
	        $_cab_error = pg_last_error();
	        if(!empty($_cab_error)){ $_error_cabeza = true;}
	        
	        if( $_error_cabeza ){ throw new Exception("Error Insertando Cabecera, vuelva a intentar."); }
	        
	        $_id_inventario_cabeza=$resultado_cabeza_inv[0];
	        
	        if($_id_inventario_cabeza>0){}else{throw new Exception("Error Recuperando Cabecera Inventario");}
	        
		     
	        // inserto detalle
		    $funcion_d ="ins_compra_detalle";
			$funcion_d_inv ="ins_inventario_detalle";
			$subototal_coniva=0;
			$subototal_siniva=0;
			$cantidad_productos=0;
			$_saldo_final_inventario=0;
	        foreach ($datos_1 as $data){
	            
	            $id_productos   = $data->id_productos;
	            $cantidad       = $data->cantidad;
	            $precio_unitario       = $data->precio_unitario;
	            $iva_t            = $data->iva;
				$total          = $data->total;
	            
				if($iva_t==0.00){
					$subototal_siniva=$subototal_siniva+($precio_unitario*$cantidad);
				}else{
					$subototal_coniva=$subototal_coniva+($precio_unitario*$cantidad);
				}
				$cantidad_productos = $cantidad_productos+$cantidad;
				
	            // inserto detalle compra
	            $parametrosDetalle = "'$_id_compra_cabeza','$id_productos','$cantidad','$precio_unitario','$iva_t', '$total'";
	            $_queryInsercionDetalle = $usuarios->getconsultaPG($funcion_d, $parametrosDetalle);
	            $resultado_detalle = $usuarios->llamarconsultaPG($_queryInsercionDetalle);
	            
	
	            $saldo_ini = $this->DevuelveInvSaldoProductos($id_productos);
			    $_saldo_final_inventario = $saldo_ini + $cantidad;
				  // inserto detalle inventario
	            $parametrosDetalle_inv = "'$_id_inventario_cabeza','$id_productos','$cantidad','$saldo_ini','$cantidad','0.00','$_saldo_final_inventario','1'";
	            $_queryInsercionDetalle_inv = $usuarios->getconsultaPG($funcion_d_inv, $parametrosDetalle_inv);
	            $resultado_detalle_inv = $usuarios->llamarconsultaPG($_queryInsercionDetalle_inv);
	            
	            // valido si existe 
	            $_det_error = pg_last_error();
	            if(!empty($_det_error)){ $_error_detalle = true; break;}
	               
	        }
			
			$colval = "
					cantidad_productos='$cantidad_productos',
					subtotal_coniva_inventario_cabeza='$subototal_coniva',
					subtotal_siniva_inventario_cabeza='$subototal_siniva'";
                 	$tabla = "inventario_cabeza";
		    		$where = "id_inventario_cabeza = '$_id_inventario_cabeza'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
			
			$colval_inv = "
					subtotal_coniva_compra_cabeza='$subototal_coniva',
					subtotal_siniva_compra_cabeza='$subototal_siniva'";
                 	$tabla_inv = "compra_cabeza";
		    		$where_inv = "id_compra_cabeza = '$_id_compra_cabeza'";
		    		$resultado_inv=$usuarios->UpdateBy($colval_inv, $tabla_inv, $where_inv);
			
		 
	        if( $_error_detalle ){ throw new Exception("Error Insertando Detalle, vuelva a intentar."); }
	       
			$respuesta['mensaje']   = "Compra Registrado Correctamente";
			 
	        $respuesta['respuesta'] = 1;
	        echo json_encode( $respuesta );
	        $usuarios->endTran('COMMIT');
	        
	    } catch (Exception $ex) {
	        $usuarios->endTran();
	        echo '<message> Error Insertando Compra \n'.$ex->getMessage().' <message>';
	    }
	    
	}
	
	
	
	
    
    public function DevuelveInvSaldoProductos($_id_productos){
        
        $resultado = "";
        $usuarios = new UsuariosModel();
        
        $columnas = "saldo_final_inventario as saldo";
        $tablas = "inventario_detalle";
        $where= " id_productos='$_id_productos' and id_estado =1 order by id_inventario_detalle desc limit 1";
        $resultSet= $usuarios->getCondicionesValorMayor($columnas, $tablas, $where);
        
        $i=count($resultSet);
         
            if($i>0)
            {
                foreach ($resultSet as $res)
                {
                    $resultado = $res->saldo;
                }
            }else{
                $resultado =0;
            }
            
        return $resultado;
        
    }
    
	
	
	
	public function autompleteProductos(){
	    
	    $db = new ModeloModel();
	    
	    if(isset($_GET['term'])){
	        
	        $codigo_productos = $_GET['term'];
	        	        
	        $columnas = "aa.id_productos
			, aa.nombre_productos
			, aa.codigo_productos
			, round(( aa.precio_venta_productos - ( aa.precio_venta_productos * bb.porcentaje_iva ) ),2) precio_unitario_producto
			, round(( aa.precio_venta_productos * bb.porcentaje_iva ),2) iva_producto
			, aa.precio_venta_productos,
			bb.nombre_iva
			";
	        $tablas = " public.productos aa
			inner join public.iva bb on bb.id_iva = aa.id_iva";
	        $where = "(aa.codigo_productos ILIKE '$codigo_productos%' OR aa.nombre_productos ILIKE '%$codigo_productos%')";
	        $id = "aa.nombre_productos ";
	        $limit = "LIMIT 10";
			
	        $rsProductos = $db->getCondicionesPag($columnas,$tablas,$where,$id,$limit);
	        
	        $respuesta = array();
	        
	        if(!empty($rsProductos) ){
	            
	            foreach ($rsProductos as $res){
	                
	                $clss_producto = new stdClass;
	                $clss_producto->id = $res->id_productos;
	                $clss_producto->value = $res->codigo_productos;
	                $clss_producto->label = $res->codigo_productos.' | '.$res->nombre_productos;
	                $clss_producto->nombre = $res->nombre_productos;
					$clss_producto->precio = $res->precio_unitario_producto;
					$clss_producto->iva = $res->nombre_iva;
					$clss_producto->valor_iva = $res->iva_producto;
					$clss_producto->total = $res->precio_unitario_producto;
	                
	                $respuesta[] = $clss_producto;
	            }
	            
	            echo json_encode($respuesta);
	            
	        }else{
	            
	            echo '[{"id":"","value":"Producto no Encontrado"}]';
	        }
	        
	    }
	}
	
	
	
	
	public function actualizarCantidad(){

		$db = new ModeloModel();
	    
		$respuesta	= [];

		$cantidad	= $_POST['cantidad'];
		$identificador	= $_POST['identificador'];
					
		$columnas = "aa.id_productos
		, aa.nombre_productos
		, aa.codigo_productos
		, round(( aa.precio_venta_productos - ( aa.precio_venta_productos * bb.porcentaje_iva ) ),2) precio_unitario_producto
		, round(( aa.precio_venta_productos * bb.porcentaje_iva ),2) iva_producto
		, aa.precio_venta_productos,
		bb.nombre_iva";
		$tablas = " public.productos aa
		inner join public.iva bb on bb.id_iva = aa.id_iva";
		$where = "aa.id_productos = '$identificador' ";
		$id = "aa.codigo_productos ";
		$limit = "LIMIT 1";
		
		$rsProductos = $db->getCondicionesPag($columnas,$tablas,$where,$id,$limit);
				
		if(!empty($rsProductos) ){

			$data	= [];
			
			foreach ($rsProductos as $res){
				
				$clss_producto = new stdClass;
				$clss_producto->id = $res->id_productos;
				$clss_producto->nombre = $res->nombre_productos;
				$clss_producto->precio = $res->precio_unitario_producto;
				$clss_producto->iva = $res->nombre_iva;
				$clss_producto->valor_iva = ($res->iva_producto) * $cantidad;
				$clss_producto->total = ($res->precio_unitario_producto) * $cantidad;
				
				$data[] = $clss_producto;
			}
			
			$respuesta['estatus'] = "OK";
			$respuesta['data'] = $data;
			
		}else{
			
			$respuesta['estatus'] = "ERROR";
			$respuesta['data'] = [];
		}

		echo json_encode($respuesta);
	      
	}
	
}
?>
