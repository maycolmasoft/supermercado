<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Productos</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
 
   <?php include("view/modulos/links_css.php"); ?>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">	  
     <link rel="stylesheet" href="view/bootstrap/plugins/bootstrap_fileinput_v5.0.8-4/css/fileinput.min.css">
    </head>
    
    
    <body class="hold-transition skin-black-light fixed sidebar-mini"  >
    
     
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
        <li class="active">Productos</li>
      </ol>
    </section>   



	<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Registrar Productos</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        	
			  		   
            <div class="row">
             				       
                               <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                  <label for="codigo_productos" class="control-label">Código Barra:</label>
                                                  <input type="hidden" class="form-control" id="id_productos" name="id_productos" value="0" >
                                                  <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value=""  placeholder="codigo..">
                                                  
                                </div>
                                </div>
                                
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="nombre_productos" class="control-label">Nombre:</label>
                                                  <input type="text" class="form-control" id="nombre_productos" name="nombre_productos" value=""  placeholder="nombre..">
                                                  
                                </div>
                                </div>
								
								<div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="stock_productos" class="control-label">Stock Productos:</label>
                                	 <input type="text" class="form-control cantidades" id="stock_productos" name="stock_productos" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div>
								
								<div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="precio_marcado_productos_pvp" class="control-label">Precio Marcado PVP:</label>
                                	 <input type="text" class="form-control cantidades" id="precio_marcado_productos_pvp" name="precio_marcado_productos_pvp" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div> 
								
								<div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="precio_compra_productos" class="control-label">Precio Compra:</label>
                                	 <input type="text" class="form-control cantidades" id="precio_compra_productos" name="precio_compra_productos" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div>
								
								
								
                                   
                                    
            </div>        		   
                    	      
                    			
           <div class="row">
                    		  
                    		    <div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="precio_venta_productos" class="control-label">Precio Venta:</label>
                                	 <input type="text" class="form-control cantidades" id="precio_venta_productos" name="precio_venta_productos" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div>
                    		  
                            	<div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="precio_venta_mayoreo_productos" class="control-label">Precio Venta Mayoreo:</label>
                                	 <input type="text" class="form-control cantidades" id="precio_venta_mayoreo_productos" name="precio_venta_mayoreo_productos" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div> 
                        	   
							    <div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="stock_min_venta_mayoreo_productos" class="control-label">Stock Minimo:</label>
                                	 <input type="text" class="form-control cantidades" id="stock_min_venta_mayoreo_productos" name="stock_min_venta_mayoreo_productos" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div> 
                              
                                <div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="precio_venta_productos_xcaja" class="control-label">Precio Venta x Caja:</label>
                                	 <input type="text" class="form-control cantidades" id="precio_venta_productos_xcaja" name="precio_venta_productos_xcaja" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div> 
                                
                              
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_linea_productos" class="control-label">Linea:</label>
                                                          <select name="id_linea_productos" id="id_linea_productos"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>
                              
             					
             					
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_tipo_productos" class="control-label">Categoria:</label>
                                                          <select name="id_tipo_productos" id="id_tipo_productos"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>
                    		      
								    
              </div>
                    	           	
                
			           			
           <div class="row">
                    		  
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_marca_productos" class="control-label">Subcategoria:</label>
                                                          <select name="id_marca_productos" id="id_marca_productos"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>  
								   
								<div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_presentacion_productos" class="control-label">Presentación:</label>
                                                          <select name="id_presentacion_productos" id="id_presentacion_productos"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>  
                    		    
                    		    
                            	<div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_medida_productos" class="control-label">Medida:</label>
                                                          <select name="id_medida_productos" id="id_medida_productos"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>  
								   
								   
								<div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_iva" class="control-label">Iva:</label>
                                                          <select name="id_iva" id="id_iva"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>       
								   
								<div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_estado" class="control-label">Estado:</label>
                                                          <select name="id_estado" id="id_estado"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div>     
								
								<div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="perecedero_productos" class="control-label">Perecedero:</label>
                                                          <select name="perecedero_productos" id="perecedero_productos"  class="form-control" >
															<option value="FALSE" selected="selected">NO</option>
															<option value="TRUE">SI</option>
                        								  </select> 
                                                          
                                </div>
                    		    </div> 
								
                    			            
              </div>	
            
             <div class="row">
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="inventariable_productos" class="control-label">Inventariable:</label>
                                                          <select name="inventariable_productos" id="inventariable_productos"  class="form-control" >
															<option value="TRUE" selected="selected">SI</option>														
														    <option value="FALSE">NO</option>
														  </select> 
                                                          
                                </div>
                    		    </div>    
								   
								<div class="col-lg-4 col-xs-12 col-md-4">
                        		<div class="form-group">
                                                          <label for="imagen_productos" class="control-label">Imagen:</label>
                                                          <input type="file" class="form-control" id="imagen_productos" name="imagen_productos" value="">
                                                          <div id="errorImagen"></div>
                                </div>
                        		</div>
                        		
			 </div>	
            
			<div class="row">
           
	                          
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="button" name="Guardar" class="btn btn-success" onclick="RegistrarProductos()"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a class="btn btn-primary" href="<?php  echo $helper->url("Productos","index"); ?>"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
                                
                                </div>
                    		    </div>
                    
	          </div>
        
        	
        	
        
      </div>
      </div>
     </section>






     	
    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="text-info">Consultar Productos Registrados</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        
        	<div class="row">
     			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     			
     			
     			
            		<div id="div_listado" class="letrasize11">
                   	<table id="tbllistado" class="table table-striped table-bordered">
                			<thead>
                		    <tr class="danger">
                					<th>Código Barra</th>
                    				<th>Nombre</th>
                    				<th>Marca</th>
                    				<th>Presentación</th>
                    				<th>Medida</th>
                    				<th>S. Min</th>
									<th>Stock</th>
									<th>P. PVP</th>
                    				<th>P. Compra</th>
                    				<th>P. Venta</th>
									<th>P. Venta Mayoreo</th>
									<th>P. Venta x Caja</th>
									<th>Estado</th>
                    				<th>Opciones</th>
									
                    			</tr>                    				
                			</thead>  
                			<tbody>
                				
                			</tbody>                  			
                			<tfoot>
                				
                			</tfoot>
                		</table>
            		</div>
     			</div>
     		</div>
             		
        </div>
        
       </div>
      </section>
     
	 
	 
    <!-- MODAL PARA CONTROL DE ERRORES--> 
	<div class="modal fade" id="mod_archivo_errores" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog   modal-lg " role="document" >
        <div class="modal-content">
          <div class="modal-header bg-red color-palette">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" align="center"></h4>
          </div>
          <div class="modal-body" >
          	<div class="box-body no-padding">
          		<table id="tbl_archivo_error" class="table table-striped table-bordered table-sm " cellspacing="0"  width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Linea</th>
                      <th>Error</th>
                      <th>Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>  
          	</div>
          	
          
          </div>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
	</div>
	 
	 
	 
    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
    <script src="view/bootstrap/plugins/bootstrap_fileinput_v5.0.8-4/js/fileinput.min.js"></script> 
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
	<script src="view/Almacen/js/Productos.js?0.08"></script>  
	  
      
   	
  </body>
</html>   

