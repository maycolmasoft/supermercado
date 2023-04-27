<?php
class ModeloModel extends ModeloBase{
    private $table = "usuarios";
    private $where;
    private $funcion;
    private $parametros;
    
    public function getTable() {
        return $this->table;
    }
    
    public function setTable($table) {
        $this->table = $table;
    }
	
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
	    
	    parent::__construct($this->getTable());
	}
	
    public function Insert(){
    
    	$query = "SELECT ".$this->funcion."(".$this->parametros.")";
    
    	$resultado=$this->enviarFuncion($query);
    		
    		
    	return  $resultado;
    }
    
    public function llamafuncion(){
        
        $query = "SELECT ".$this->funcion."(".$this->parametros.")";
        $resultado = null;
        
        $resultado=$this->llamarconsulta($query);
        
        return  $resultado;
    }
    
    public function llamafuncionPG(){
        
        $query = "SELECT ".$this->funcion."(".$this->parametros.")";
        $resultado = null;
        
        $resultado=$this->llamarconsultaPG($query);
        
        return  $resultado;
    }
}
?>
