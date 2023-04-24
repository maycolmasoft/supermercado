<?php
class GeoposicionamientoController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    
    public function index_report(){
	
		session_start();
		if (isset(  $_SESSION['id_usuarios']) )
		{
		    
		    $usuarios = new UsuariosModel();
		    
		    $query = "select a.razon_social, a.latitud, a.logitud, b.usuario_usuarios, ('Ciudad: '||d.nombre_cantones||' Calle: '||a.calle_principal||' y '||a.calle_secundaria) as direccion  from encuentas_cabeza a
    		    inner join usuarios b on a.id_usuarios=b.id_usuarios
    		    inner join core_provincias c on a.id_provincias=c.id_provincias
    		    inner join cantones d on a.id_cantones=d.id_cantones
    		    where 1=1
    		    order by a.id_encuentas_cabeza";
		    $resultSet  = $usuarios->enviaquery($query);
		    
		    $this->view_ServiciosOnline("Geoposicionamiento",array(
							"resultSet" =>$resultSet
			));
				
			
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	public function cargar_geoposicionamiento(){
	    
    	session_start();
    	
    	$usuarios = new UsuariosModel();
    	
    	$query = "select a.razon_social, a.latitud, a.logitud, b.usuario_usuarios, ('Ciudad: '||d.nombre_cantones||' Calle: '||a.calle_principal) as direccion  from encuentas_cabeza a
    		    inner join usuarios b on a.id_usuarios=b.id_usuarios
    		    inner join core_provincias c on a.id_provincias=c.id_provincias
    		    inner join cantones d on a.id_cantones=d.id_cantones
    		    where 1=1
    		    order by a.id_encuentas_cabeza";
    	$resultSet  = $usuarios->enviaquery($query);
    	
    	if(!empty($resultSet) && count($resultSet)>0){
    	    
    	    echo json_encode(array('resultSet'=>$resultSet));
    	    
    	}
	
   }
	
	
	
	
	
}
?>
