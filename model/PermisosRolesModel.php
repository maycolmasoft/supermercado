<?php
class PermisosRolesModel extends ModeloBase{
	
	private $table;
	private $where;
	private $funcion;
	private $parametros;
	
	public function getWhere() {
		return $this->where;
	}
	
	public function setWhere($where) {
		$this->where = $where;
	}
	
	public function getFuncion() {
		return $this->funcion;
	}
	
	
	public function setFuncion($funcion) {
		$this->funcion = $funcion;
	}
	
	
	
	public function getParametros() {
		return $this->parametros;
	}
	
	
	public function setParametros($parametros) {
		$this->parametros = $parametros;
	}
	
	
	
	
	public function __construct(){
		$this->table="permisos_rol";
		
		parent::__construct($this->table);
	}
	

	public function Insert(){
		
		$query = "SELECT ".$this->funcion."(".$this->parametros.")";
		
		$resultado=$this->enviarFuncion($query);
			
			
		return  $resultado;
	}
	
	
	
}
?>