<?php
class ControladorBase{

    public function __construct() {
        require_once 'EntidadBase.php';
        require_once 'ModeloBase.php';
        
        //Incluir todos los modelos
        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }
    
    //Plugins y funcionalidades
    
    public function view($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor; 
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
    
        require_once 'view/'.$vista.'View.php';
    }
     public function view_ServiciosOnline($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/ServiciosOnline/'.$vista.'View.php';
    }
	
	
	 public function view_Memos($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Memos/'.$vista.'View.php';
    }
	
	
    public function view_Administracion($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Administracion/'.$vista.'View.php';
    }
    
	public function view_Almacen($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Almacen/'.$vista.'View.php';
    }
	
	public function view_Ventas($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Ventas/'.$vista.'View.php';
    }
	
	
    public function view_Credito($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Credito/'.$vista.'View.php';
    }
    
    public function view_Inventario($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Inventario/'.$vista.'View.php';
    }
    
    
    public function view_Recaudaciones($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Recaudaciones/'.$vista.'View.php';
    }
    
    public function view_Elecciones($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/elecciones/'.$vista.'View.php';
    }
  
    
    
    public function temp_report($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/reportes/template/'.$vista.'.html';
    }
    
    public function view_Core($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Core/'.$vista.'View.php';
    }
    
    public function view_Contable($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Contable/'.$vista.'View.php';
    }
    
    
    public function view_GestionDocumental($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/GestionDocumental/'.$vista.'View.php';
    }
    
    
    public function view_tesoreria($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Tesoreria/'.$vista.'View.php';
    }
    
    public function view_principal($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/principal/'.$vista.'View.php';
    }
    
    public function report($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'view/reportes/'.$vista.'Report.php';
    }
    
    public function afuera($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    	
    
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'http://localhost:3000/'.$vista;
    }
    
    
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }
    
    public function verReporte($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    
    	require_once 'view/reportes/'.$vista.'Rpt.php';
    }
    
    public function view_Activos($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Activos/'.$vista.'View.php';
    }

    
    public function view_tributario($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'view/tributario/'.$vista.'View.php';
    }
    
    public function view_Turnos($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/Turnos/'.$vista.'View.php';
    }
 
    
   
    
    public function view_Informativo($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'view/informativo/'.$vista.'View.php';
    }
    
    
    
    
    public function view_RiesgosAdministracion($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/riesgos/administracion/'.$vista.'View.php';
    }
    
    
    public function view_RiesgosProcesos($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/riesgos/procesos/'.$vista.'View.php';
    }
    
   
    
    public function view_RiesgosReportes($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
        
        require_once 'view/riesgos/reportes/'.$vista.'View.php';
    }
    
    
}
?>
