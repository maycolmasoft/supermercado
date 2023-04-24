<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ENCUESTA</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    
  <link rel="stylesheet" href="view/bootstrap/bower_components/font-awesome/css/font-awesome.min.css">
   
    
   <?php include("view/modulos/links_css.php"); ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
    <style type="text/css">
    
    .letrasize11{
        font-size: 12px;
       }
    
    </style>
    
    
  </head>

  <body class="hold-transition skin-black-light fixed sidebar-mini">
    
	
	
	

     <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    <div class="wrapper">

  <header class="main-header">
  
      <?php include("view/modulos/logo.php"); ?>
      <?php include("view/modulos/head.php"); ?>	
    
  </header>

   <aside class="main-sidebar">
    <section class="sidebar">
     <?php include("view/modulos/menu_profile.php"); ?>
      <br>
     <?php include("view/modulos/menu.php"); ?>
    </section>
  </aside>

        <div class="content-wrapper">


	

        <section class="content-header">
          <h1>
            
            <small><?php echo $fecha; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Encuesta</li>
          </ol>
        </section>




    <section class="content">
     
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Encuesta</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
                        
               
                           
                           
                           
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> Datos Principales del local
	         </div>
	         <div class="panel-body">
	         
	                       <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	   <label for="id_tipo_encuestas" class="control-label">Tipo Encuesta:</label>
                                      <select  class="form-control" id="id_tipo_encuestas" name="id_tipo_encuestas">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
	                     
                         	<div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="razon_social" class="control-label">Nombre Local:</label>
                                      <input type="text" class="form-control" id="razon_social" name="razon_social" value="" placeholder="razón social..">
                                </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="nombre_contacto" class="control-label">Nombre Contacto:</label>
                                      <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="" placeholder="datos administrador..">
                                 </div>
                             </div>
                          
                          <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_provincias" class="control-label">Provincia:</label>
                                                          <select name="id_provincias" id="id_provincias"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                       
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_cantones" class="control-label">Ciudad:</label>
                                                          <select name="id_cantones" id="id_cantones"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                          </select> 
                                                          
                                </div>
                    		    </div>
                    		    
                    		    <div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="calle_principal" class="control-label">Calle Principal:</label>
                                      <input type="text" class="form-control" id="calle_principal" name="calle_principal" value="" placeholder="calle principal..">
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="calle_secundaria" class="control-label">Calle Secundaria:</label>
                                      <input type="text" class="form-control" id="calle_secundaria" name="calle_secundaria" value="" placeholder="calle secundaria..">
                                 </div>
                             </div>
                                
                                 <div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="numero_calle" class="control-label">Número Calle:</label>
                                      <input type="text" class="form-control" id="numero_calle" name="numero_calle" value="" placeholder="número calle..">
                                     
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-6 col-lg-6">
                             	<div class="form-group">
                                	 <label for="referencia_ubicacion" class="control-label">Referencia Ubicación:</label>
                                      <input type="text" class="form-control" id="referencia_ubicacion" name="referencia_ubicacion" value="" placeholder="referencia..">
                                      
                                 </div>
                             </div>
	         
	         </div>
	         </div>
	         
	         
	         
	         <!-- DESDE AQUI PARA ENCUESTA MARKET SHARE -->
	         <div  id="div_encuesta_2" style="display: none;">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_1" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_1" name="id_pregunta_1" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_1" name="id_preguntas_encuestas_detalle_1" onchange="seleccion(1);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                             <div  id="div_otros_1" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_1" name="nombre_otros_1" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                            
                            <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(1)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_1" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marca</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                            
              </div>
              </div>
	           
			   
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_2" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_2" name="id_pregunta_2" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_2" name="id_preguntas_encuestas_detalle_2" onchange="seleccion(2);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                             <div  id="div_otros_2" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_2" name="nombre_otros_2" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                            
                            <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(2)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_2" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Tipo</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                            
              </div>
              </div> 
			   
			   
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_3" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            
                           <div class="col-xs-12 col-md-6 col-lg-6 ">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_3" name="id_pregunta_3" value="" >
                                	 <textarea class="form-control" id="respuesta_pregunta_3" name="respuesta_pregunta_3" rows="6" placeholder="Detalle por cada marca.."></textarea>
                                </div>
                            </div>
                            
              </div>
              </div> 
              
              
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_4" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            
                            <div class="col-xs-12 col-md-3 col-lg-3 ">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_4" name="id_pregunta_4" value="" >
                                	  <textarea class="form-control" id="respuesta_pregunta_4" name="respuesta_pregunta_4" rows="6" placeholder="Detalle por cada marca.."></textarea>
                            
                                </div>
                            </div>
                            
              </div>
              </div> 
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_5" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_5" name="id_pregunta_5" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_5" name="id_preguntas_encuestas_detalle_5" onchange="seleccion(5);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_5" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_5" name="nombre_otros_5" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(5)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_5" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Frecuencia de Venta</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_6" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            
                           <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_6" name="id_pregunta_6" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_6" name="id_preguntas_encuestas_detalle_6" onchange="seleccion(6);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                             <div  id="div_otros_6" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_6" name="nombre_otros_6" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                             
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(6)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_6" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Presentación mas Vendidas</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                             
              </div>
              </div> 
	           
			   
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_7" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            
                           <div class="col-xs-12 col-md-6 col-lg-6 ">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_7" name="id_pregunta_7" value="" >
                                	 <textarea class="form-control" id="respuesta_pregunta_7" name="respuesta_pregunta_7" rows="6" placeholder="Detalle por cada marca.."></textarea>
                                </div>
                            </div>
                            
              </div>
              </div> 
			   
			   
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i> <label id="nombre_pregunta_8" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                              <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_8" name="id_pregunta_8" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_8" name="id_preguntas_encuestas_detalle_8" onchange="seleccion(8);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_8" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_8" name="nombre_otros_8" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                             
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(8)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_8" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Proveedor</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
             
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_9" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                             <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_9" name="id_pregunta_9" value="" >
                                     
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_9" name="id_preguntas_encuestas_detalle_9" onchange="seleccion(9);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>  
                            
                            
                             <div  id="div_otros_9" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_9" name="nombre_otros_9" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(9)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_9" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Quién le Compra</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_10" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_10" name="id_pregunta_10" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_10" name="id_preguntas_encuestas_detalle_10" onchange="seleccion(10);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
                           
                             <div  id="div_otros_10" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_10" name="nombre_otros_10" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                             
                               <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(10)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_10" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Factor Decisivo</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
              </div>
              </div> 
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_11" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_11" name="id_pregunta_11" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_11" name="id_preguntas_encuestas_detalle_11" onchange="seleccion(11);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
                           
                             <div  id="div_otros_11" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_11" name="nombre_otros_11" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                             
                           
                               <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(11)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_11" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Proveedor PDV</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
              </div>
              </div> 
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_12" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_12" name="id_pregunta_12" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_12" name="id_preguntas_encuestas_detalle_12" onchange="seleccion(12);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                             <div  id="div_otros_12" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_12" name="nombre_otros_12" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(12)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_12" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marcas Promotoras</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
			  
			  <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_13" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_13" name="id_pregunta_13" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_13" name="id_preguntas_encuestas_detalle_13" onchange="seleccion(13);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                             <div  id="div_otros_13" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_13" name="nombre_otros_13" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(13)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_13" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marcas Mayor Ganancia</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_14" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_14" name="id_pregunta_14" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_14" name="id_preguntas_encuestas_detalle_14" onchange="seleccion(14);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                             <div  id="div_otros_14" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_14" name="nombre_otros_14" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(14)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_14" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marcas Mejor Calidad</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_15" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_15" name="id_pregunta_15" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_15" name="id_preguntas_encuestas_detalle_15">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div> 
              
              
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_16" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_16" name="id_pregunta_16" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_16" name="id_preguntas_encuestas_detalle_16">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_17" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_17" name="id_pregunta_17" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_17" name="id_preguntas_encuestas_detalle_17">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
              
              
               <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_18" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_18" name="id_pregunta_18" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_18" name="id_preguntas_encuestas_detalle_18">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
              
              
               <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_19" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_19" name="id_pregunta_19" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_19" name="id_preguntas_encuestas_detalle_19">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_20" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_20" name="id_pregunta_20" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_20" name="id_preguntas_encuestas_detalle_20">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
			  
			  
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_21" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_21" name="id_pregunta_21" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_21" name="id_preguntas_encuestas_detalle_21">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
			  
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_22" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_22" name="id_pregunta_22" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_22" name="id_preguntas_encuestas_detalle_22">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
              
                        <div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="button" id="Guardar" name="Guardar" class="btn btn-success" onclick="ProcesarMarketShare()">REGISTRAR</button>
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("Encuesta","index"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
              
               
	         </div>
              <!-- TERMINA ENCUESTA MARKET SHARE -->
              
              
              
              
               <!-- DESDE AQUI PARA CENSO -->
	         <div  id="div_encuesta_1" style="display: none;">
              
            
              
            
             
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_23" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_23" name="id_pregunta_23" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_23" name="id_preguntas_encuestas_detalle_23" onchange="seleccion(23);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                            
                            
                             <div  id="div_otros_23" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_23" name="nombre_otros_23" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(23)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_23" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marcas</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
            
            
            
            <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_24" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_24" name="id_pregunta_24" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_24" name="id_preguntas_encuestas_detalle_24" onchange="seleccion(24);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_24" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_24" name="nombre_otros_24" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(24)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_24" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Tipo</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
            
            
            
            
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_25" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_25" name="id_pregunta_25" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_25" name="id_preguntas_encuestas_detalle_25">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
            
             
               
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_26" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_26" name="id_pregunta_26" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_26" name="id_preguntas_encuestas_detalle_26" onchange="seleccion(26);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                               <div  id="div_otros_26" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_26" name="nombre_otros_26" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(26)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_26" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Mas Vende</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
              
               
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_27" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_27" name="id_pregunta_27" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_27" name="id_preguntas_encuestas_detalle_27" onchange="seleccion(27);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                               <div  id="div_otros_27" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_27" name="nombre_otros_27" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                            
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(27)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_27" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Publico Objetivo</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_28" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_28" name="id_pregunta_28" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_28" name="id_preguntas_encuestas_detalle_28" onchange="seleccion(28);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_28" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_28" name="nombre_otros_28" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(28)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_28" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marca Competencia</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
               
              
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_29" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_29" name="id_pregunta_29" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_29" name="id_preguntas_encuestas_detalle_29">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
          
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_30" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_30" name="id_pregunta_30" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_30" name="id_preguntas_encuestas_detalle_30" onchange="seleccion(30);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_30" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_30" name="nombre_otros_30" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(30)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_30" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Presentación más Vendida</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_31" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_31" name="id_pregunta_31" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_31" name="id_preguntas_encuestas_detalle_31" onchange="seleccion(31);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_31" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_31" name="nombre_otros_31" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(31)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_31" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Público Objetivo</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
               <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_32" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_32" name="id_pregunta_32" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_32" name="id_preguntas_encuestas_detalle_32" onchange="seleccion(32);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_32" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_32" name="nombre_otros_32" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(32)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_32" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marca mas Vendida</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
              
			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_33" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_33" name="id_pregunta_33" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_33" name="id_preguntas_encuestas_detalle_33">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
          
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_34" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_34" name="id_pregunta_34" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_34" name="id_preguntas_encuestas_detalle_34" onchange="seleccion(34);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_34" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_34" name="nombre_otros_34" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(34)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_34" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Presentación más Vendida</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
              
              
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_35" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_35" name="id_pregunta_35" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_35" name="id_preguntas_encuestas_detalle_35" onchange="seleccion(35);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_35" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_35" name="nombre_otros_35" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(35)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_35" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Público Objetivo</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
               <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_36" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_36" name="id_pregunta_36" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_36" name="id_preguntas_encuestas_detalle_36" onchange="seleccion(36);">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                            
                             <div  id="div_otros_36" style="display: none;">
							   
							    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group-sm">
                                                      <input type="text" class="form-control" id="nombre_otros_36" name="nombre_otros_36" value="" placeholder="¿Cúal?..">
                                                      
                                </div>
            					</div>
							   
                             </div>
                             
                                <div class="col-xs-6 col-md-3 col-lg-3">
                             	<button class="btn btn-warning btn-sm " onclick="agregar(36)">
                                        	<span class=" text-warning" >
                                              <i class="fa fa-plus"></i>
                                            </span> &nbsp; &nbsp;
                                            AÑADIR FILA
							   </button>
                            </div>
                           
                           
                           <div class="col-xs-12 col-md-6 col-lg-6" style="min-height: 50px; max-height: 350px">
                        		<table id="md_tbl_respuestas_36" class="table order-list">
                                    <thead>
                                        <tr class="table-secondary" >
                                			<th style="text-align: left;  font-size: 10px;">Marca mas Vendida</th>
                                			<th></th>
                                		</tr>
                                    </thead>
                                    <tbody style="text-align: left;  font-size: 10px;">
                                        
                                    </tbody>
                                </table>
                            </div>
                           
              </div>
              </div> 
              
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <i class='glyphicon glyphicon-tasks'></i>  <label id="nombre_pregunta_37" class="control-label"></label>
	         </div>
	         <div class="panel-body">
	                        
                            <div class="col-xs-12 col-md-3 col-lg-3">
                            	<div class="form-group-sm">
                                	 <input type="hidden" class="form-control" id="id_pregunta_37" name="id_pregunta_37" value="" >
                                      
                                      <select  class="form-control" id="id_preguntas_encuestas_detalle_37" name="id_preguntas_encuestas_detalle_37">
                                      	<option value="0">--Seleccione--</option>
                                      </select>  
                                </div>
                            </div>
                           
              </div>
              </div>
              
              
              
              
              
              
              
                        <div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="button" id="Guardar" name="Guardar" class="btn btn-success" onclick="ProcesarCenso()">REGISTRAR</button>
            	                  <a class="btn btn-danger" href="<?php  echo $helper->url("Encuesta","index"); ?>">CANCELAR</a>
        	                    </div>
    	        		    </div>
    	        		    
            		    </div>
              
             </div>
              <!-- TERMINA CENSO -->
                      
                          
            
            </div>
            </div>
     

   </section>
            
         



   
  </div>
 
 
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   
    <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
    <script src="view/ServiciosOnline/js/EncuestaOnline.js?0.41"></script>       
    
    
     
    
  </body>
</html>
