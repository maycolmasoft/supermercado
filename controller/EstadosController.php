<?php

class EstadosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$estados=new EstadoModel();
					//Conseguimos todos los usuarios
     	$resultEdit = "";
	
		session_start();
        
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "Estados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $estados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				$this->view_Administracion("Estados",array(
				    "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
			    $this->view_Administracion("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Grupos"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	
	/***
	 * return jason,
	 * desc: insertar un estado 
	 */
	public function InsertEstado(){
			
		session_start();
		$estado = new EstadoModel();
		
		$nombre_controladores = "Estados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $estado->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer)){		
		
		    $_nombreEstado = (isset($_POST['nombre_estado'])) ? $_POST['nombre_estado'] : '';
		    $_tablaEstado = (isset($_POST['tabla_estado'])) ? $_POST['tabla_estado'] : '';
		    
		    $_id_estado = (isset($_POST['id_estado'])) ? $_POST['id_estado'] : '0';
		
			$funcion = "ins_estado";			
			$parametros = "'$_nombreEstado','$_tablaEstado',$_id_estado";
			
			$estado->setFuncion($funcion);
			$estado->setParametros($parametros);
						
			$resultado = $estado->llamafuncion();
			
			$respuesta = -1;
			
			if(!empty($resultado) && count($resultado) > 0 ){
			    
			    foreach ($resultado[0] as $k => $v){
			        
			        $respuesta = $v;
			        
			    }
			}
			
			echo json_encode(array('value' => $respuesta));

		}else{
		    
		   echo "no tiene permisos Insertar";
		
		}
		
	}
	
	public function borrarId()
	{
	    
	    session_start();
	    $grupos=new EstadoModel();
	    $nombre_controladores = "Grupos";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $grupos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer))
	    {
	        if(isset($_GET["id_grupos"]))
	        {
	            $id_grupos=(int)$_GET["id_grupos"];
	            
	            
	            
	            $grupos->deleteBy(" id_grupos",$id_grupos);
	            
	        }
	        
	        $this->redirect("Grupos", "index");
	        
	        
	    }
	    else
	    {
	        $this->view_Inventario("Error",array(
	            "resultado"=>"No tiene Permisos de Borrar Grupos"
	            
	        ));
	    }
	    
	}
	


	
	
	/**
	 * mod: admin
	 * title: cargar tablas de BD
	 * ajax: si
	 * dc:2019-04-15
	 */	
	public function cargaTablasBd(){
	    
	    $estados = null;
	    $estados = new EstadoModel();
	    
	    $query = " SELECT table_name FROM information_schema.tables 
            WHERE table_catalog = 'erp_riesgosapremci' AND table_schema = 'public' AND table_type = 'BASE TABLE'
            ORDER BY table_name";
	    
	    $resulset = $estados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
            echo json_encode(array('data'=>$resulset));
	       
	    }
	}
	
	/***
	 * return:html
	 * desc: traer datos de estados
	 * dc 2019-04-15
	 */
	public function consultaEstados(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $estados = new EstadoModel();
	    
	    $where_to="";
	    $columnas  = " id_estado, nombre_estado, tabla_estado, DATE(creado) creado";
	    
	    $tablas    = "public.estado";
	    
	    $where     = " 1 = 1";
	    
	    $id        = "estado.tabla_estado";
	    
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    if($action == 'ajax')
	    {	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND ( nombre_estado ILIKE '".$search."%' OR tabla_estado ILIKE '".$search."%' )";
	            
	            $where_to=$where.$where1;
	            
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet = $estados->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$estados->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        if($cantidadResult > 0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:400px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_estados' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Nombre Estado</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Tabla </th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Creado</th>';
	            
	            if($id_rol==1){
	                
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	                
	            }
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 14px;">'.$i.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->nombre_estado.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->tabla_estado.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->creado.'</td>';
	                
	                if($id_rol==1){
	                    
	                    $html.='<td style="font-size: 18px;">
                                <a onclick="editEstado('.$res->id_estado.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
	                    $html.='<td style="font-size: 18px;">
                                <a onclick="delEstado('.$res->id_estado.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
	                    
	                }
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaEstados").'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados registrados...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        
	    }
	}
	
	public function paginate($reload, $page, $tpages, $adjacents, $funcion) {
	    
	    
	    $prevlabel = "&lsaquo; Prev";
	    $nextlabel = "Next &rsaquo;";
	    $out = '<ul class="pagination pagination-large">';
	    
	    // previous label
	    
	    if($page==1) {
	        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	    } else if($page==2) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(1)'>$prevlabel</a></span></li>";
	    }else {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page-1).")'>$prevlabel</a></span></li>";
	        
	    }
	    
	    // first label
	    if($page>($adjacents+1)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>1</a></li>";
	    }
	    // interval
	    if($page>($adjacents+2)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // pages
	    
	    $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	    $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	    for($i=$pmin; $i<=$pmax; $i++) {
	        if($i==$page) {
	            $out.= "<li class='active'><a>$i</a></li>";
	        }else if($i==1) {
	            $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>$i</a></li>";
	        }else {
	            $out.= "<li><a href='javascript:void(0);' onclick='$funcion(".$i.")'>$i</a></li>";
	        }
	    }
	    
	    // interval
	    
	    if($page<($tpages-$adjacents-1)) {
	        $out.= "<li><a>...</a></li>";
	    }
	    
	    // last
	    
	    if($page<($tpages-$adjacents)) {
	        $out.= "<li><a href='javascript:void(0);' onclick='$funcion($tpages)'>$tpages</a></li>";
	    }
	    
	    // next
	    
	    if($page<$tpages) {
	        $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page+1).")'>$nextlabel</a></span></li>";
	    }else {
	        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	    }
	    
	    $out.= "</ul>";
	    return $out;
	    
	}
	
	public function editEstado(){
	    
	    session_start();
	    $estados = new EstadoModel();
	    $nombre_controladores = "Estados";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $estados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer))
	    {
	        
	        
	        if(isset($_POST["id_estado"])){
	            
	            $id_estado = (int)$_POST["id_estado"];
	            
	            $query = "SELECT * FROM estado WHERE id_estado = $id_estado";
	            
	            $resultado  = $estados->enviaquery($query);
	            
	            echo json_encode(array('data'=>$resultado));
	            
	        }
	        
	        
	    }
	    else
	    {
	        echo "Usuario no tiene permisos-Editar";
	    }
	    
	}
	
	/***
	 * return: json
	 * title: delEstados
	 * fcha: 2019-04-15
	 */
	public function delEstados(){
	    
	    session_start();
	    $estado = new EstadoModel();
	    $nombre_controladores = "Estados";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $estado->getPermisosBorrar("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer)){
	        
	        if(isset($_POST["id_estado"])){
	            
	            $id_tipo = (int)$_POST["id_estado"];
	            
	            $resultado  = $estado->eliminarBy(" id_estado ",$id_tipo);
	            
	            if( $resultado > 0 ){
	                
	                echo json_encode(array('data'=>$resultado));
	                
	            }else{
	                
	                echo $resultado;
	            }
	            
	            
	            
	        }
	        
	        
	    }else{
	        
	        echo "Usuario no tiene permisos-Eliminar";
	    }
	    
	    
	    
	}
	
	
}
?>