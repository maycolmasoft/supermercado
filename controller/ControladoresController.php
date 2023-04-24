<?php

class ControladoresController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

	public function index(){
	
	    session_start();
	    
		$controladores = new ControladoresModel();
		
		$columnas="controladores.id_controladores, 
                  controladores.nombre_controladores, 
                  modulos.id_modulos, 
                  modulos.nombre_modulos, 
                  controladores.creado, 
                  controladores.modificado";
		$tablas="public.controladores, 
                 public.modulos";
		$where="modulos.id_modulos = controladores.id_modulos";
		$id="controladores.id_controladores";
		$resultSet=$controladores->getCondiciones($columnas, $tablas, $where, $id);
		
		
		$resultEdit = "";
		$modulos = new ModulosModel();
		$resultMod=$modulos->getAll("nombre_modulos");
		
		if (isset($_SESSION['nombre_usuarios']))
		{
			$controladores = new ControladoresModel();
			//NOTIFICACIONES
			//$controladores->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "Controladores";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $controladores->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				if (isset ($_GET["id_controladores"]))
				{
					
					$nombre_controladores = "Controladores";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $controladores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_controladores = $_GET["id_controladores"];
						$columnas = " id_controladores, nombre_controladores, id_modulos";
						$tablas   = "controladores";
						$where    = "id_controladores = '$_id_controladores' "; 
						$id       = "nombre_controladores";
							
						$resultEdit = $controladores->getCondiciones($columnas ,$tablas ,$where, $id);
					
					}
					else
					{
					    $this->view_Administracion("Error",array(
								"resultado"=>"No tiene Permisos de Editar Controladores"
					
						));
					
					
					}
					
				}
				
				
				$this->view_Administracion("Controladores",array(
				    "resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMod" =>$resultMod
			
				));
		
			}
			else
			{
			    $this->view_Administracion("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Controladores"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaControladores(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();
		$controladores=new ControladoresModel();
		$modulos = new ModulosModel();
		$resultMod=$modulos->getAll("nombre_modulos");
		
		
		$nombre_controladores = "Controladores";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		if (!empty($resultPer))
		{
			$resultado = null;
			
			$controladores=new ControladoresModel();
		
			if (isset ($_POST["nombre_controladores"]) )
				
			{
				
				
				
				$_nombre_controladores = $_POST["nombre_controladores"];
				$_id_controladores = $_POST["id_controladores"];
				$_id_modulos = $_POST["id_modulos"];
				
				if($_id_controladores>0) 
				{
					
					$colval = " nombre_controladores = '$_nombre_controladores', id_modulos = '$_id_modulos'   ";
					$tabla = "controladores";
					$where = "id_controladores = '$_id_controladores'    ";
					
					$resultado=$controladores->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_controladores";
				$parametros = " '$_nombre_controladores', '$_id_modulos'  ";
				$controladores->setFuncion($funcion);
				$controladores->setParametros($parametros);
				$resultado=$controladores->Insert();
				
			 }
		
			}
			$this->redirect("Controladores", "index");

		}
		else
		{
		    $this->view_Administracion("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Controladores"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
			
		if (isset($_SESSION["id_usuarios"]))
		{
			if(isset($_GET["id_controladores"]))
			{
				$id_controladores=(int)$_GET["id_controladores"];
				
				$controladores=new ControladoresModel();
				
				$controladores->deleteBy(" id_controladores",$id_controladores);
				
			}
			
			$this->redirect("Controladores", "index");
			
			
		}
		else
		{
		    
		    $this->redirect("Usuarios", "cerrar_sesion");
		    
		    
		}
				
	}
	
	
	
	
	
	
	
		
}
?>