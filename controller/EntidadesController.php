<?php

class EntidadesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $entidades = new EntidadesModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("Usuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "Entidades";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso"
                
            ));
            exit();
        }
        
        
        $cedula_usuarios = $_SESSION['cedula_usuarios'];
        
        $col1 =" id_empleados, nombres_empleados";
        $tab1 = " empleados";
        $whe1 = " numero_cedula_empleados = '$cedula_usuarios'";
        $rsEmpleados    = $entidades->getCondicionesSinOrden( $col1, $tab1, $whe1, "");
        $desde = '8:00:00';
        $hasta = '16:45:00';
        
        
        $this->view("Entidades",array(
            "resultSet"=>"", "rsEmpleados"=>$rsEmpleados, "desde"=>$desde, "hasta"=>$hasta
            
        ));
        
        
    }
    
    
    public function InsertaEntidades(){
         session_start();
        
         $entidades = new EntidadesModel();
           
            $_ruc_entidades = (isset($_POST["ruc_entidades"])) ? $_POST["ruc_entidades"] : "" ;
            $_nombre_entidades = (isset($_POST["nombre_entidades"])) ? $_POST["nombre_entidades"] : "" ;
            $_telefono_entidades = (isset($_POST["telefono_entidades"])) ? $_POST["telefono_entidades"] : "" ;
            $_direccion_entidades = (isset($_POST["direccion_entidades"])) ? $_POST["direccion_entidades"] : "" ;
            $_ciudad_entidades = (isset($_POST["ciudad_entidades"])) ? $_POST["ciudad_entidades"] : "" ;
            $_razon_social_entidades = (isset($_POST["razon_social_entidades"])) ? $_POST["razon_social_entidades"] : "" ;
            $_contribuyente_especial_entidades = (isset($_POST["contribuyente_especial_entidades"])) ? $_POST["contribuyente_especial_entidades"] : "" ;
            $_obligado_contabilidad_entidades = (isset($_POST["obligado_contabilidad_entidades"])) ? $_POST["obligado_contabilidad_entidades"] : "" ;
            $_id_entidades = (isset($_POST["id_entidades"])) ? $_POST["id_entidades"] : 0 ;
            
            $funcion = "ins_entidades";
            $respuesta = 0 ;
            $mensaje = "";
            
             
            if($_id_entidades == 0){
                
                $parametros = "'$_ruc_entidades',
                               '$_nombre_entidades',
                               '$_telefono_entidades',
                               '$_direccion_entidades',
                               '$_ciudad_entidades',
                               '$_razon_social_entidades',
                               '$_contribuyente_especial_entidades',
                               '$_obligado_contabilidad_entidades',
                               '$_id_entidades'";
                                $entidades->setFuncion($funcion);
                                $entidades->setParametros($parametros);
                
                //echo "SELECT ". $funcion." ( ".$parametros." )"; die();
                                $resultado = $entidades->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Ingresado Correctamente";
                }
                
              
                
            }elseif ($_id_entidades > 0){
                
                $parametros = "'$_ruc_entidades',
                               '$_nombre_entidades',
                               '$_telefono_entidades',
                               '$_direccion_entidades',
                               '$_ciudad_entidades',
                               '$_razon_social_entidades',
                               '$_contribuyente_especial_entidades',
                               '$_obligado_contabilidad_entidades',
                               '$_id_entidades'";
                                $entidades->setFuncion($funcion);
                                $entidades->setParametros($parametros);
                                $resultado = $entidades->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Actualizado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar";
            exit();
            
       
        
    }
    
    
    public function editEntidades(){
        
        session_start();
        $entidades = new EntidadesModel();
        $nombre_controladores = "Entidades";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer))
        {
            
            
            if(isset($_POST["id_entidades"])){
                
                $id_entidades = (int)$_POST["id_entidades"];
                
                $query = "SELECT * FROM entidades a WHERE a.id_entidades = $id_entidades";
                
                $resultado  = $entidades->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
            
        }
        else
        {
            echo "No Tiene Permisos Editar";
        }
        
    }
    
    
    public function delEntidades(){
        
        session_start();
        $entidades = new EntidadesModel();
        $nombre_controladores = "Entidades";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $entidades->getPermisosBorrar("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            if(isset($_POST["id_entidades"])){
                
                $id_entidades = (int)$_POST["id_entidades"];
                
                $resultado  = $entidades->eliminarBy("id_entidades ",$id_entidades);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
            
        }else{
            
            echo "No Tiene Permisos Eliminar";
        }
        
        
        
    }
    
    
    public function consultaEntidades(){
        
        session_start();
         
        $entidades = new EntidadesModel();
        
        
        $where_to="";
        $columnas ="a.id_entidades,
                    a.ruc_entidades,
                    a.nombre_entidades,
                    a.telefono_entidades,
                    a.direccion_entidades,
                    a.ciudad_entidades,
                    a.logo_entidades,
                    a.razon_social_entidades,
                    a.contribuyente_especial_entidades,
                    a.obligado_contabilidad_entidades";
        $tablas  = "entidades a";
        $where   = "1 = 1";
        $id      = "a.id_entidades";

        
        
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        if($action == 'ajax')
        {
            
            
            if(!empty($search)){
                $where.=" AND (a.ruc_entidades ILIKE '".$search."%' OR a.nombre_entidades ILIKE '".$search."%' OR a.telefono_entidades ILIKE '".$search."%' OR a.direccion_entidades ILIKE '".$search."%' OR a.ciudad_entidades ILIKE '".$search."%' OR a.razon_social_entidades ILIKE '".$search."%')";
            }
            
            
            
            
            
            $where_to=$where;
            $html="";
            $resultSet=$entidades->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 10; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$entidades->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
                $html.='<div class="pull-left" style="margin-left:15px;">';
                $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                $html.='</div>';
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:400px; overflow-y:scroll;">';
                $html.= "<table id='tabla_entidades' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: center;  font-size: 10px;">#</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Ruc</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Nombre</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Télefono</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Dirección</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Ciudad</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Razón Social</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Contribuyente Especial</th>';
                $html.='<th style="text-align: center;  font-size: 10px;">Obligado a llevar Contabilidad</th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
             
                foreach ($resultSet as $res)
                {
                  
                    $i++;
                    $html.='<tr>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$i.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->ruc_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->nombre_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->telefono_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->direccion_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->ciudad_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->razon_social_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->contribuyente_especial_entidades.'</td>';
                    $html.='<td style="text-align: center; font-size: 10px;">'.$res->obligado_contabilidad_entidades.'</td>';
                    
                    
                    /*comentario up */
                    
                    $html.='<td style="font-size: 18px;">
                            <a onclick="editEntidades('.$res->id_entidades.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 18px;">
                            <a onclick="delEntidades('.$res->id_entidades.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaEntidades").'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay registros...</b>';
                $html.='</div>';
                $html.='</div>';
            }
            
            
            echo $html;
            
        }
        
        
    }
    public function paginate($reload, $page, $tpages, $adjacents, $funcion = "") {
        
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
    
   
}
?>