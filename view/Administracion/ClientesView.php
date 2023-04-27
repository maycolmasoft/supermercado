<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clientes</title>
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
        <li class="active">Clientes</li>
      </ol>
    </section>   



	<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Registrar Clientes</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        	
			  		   
            <div class="row">
             					  
         					   <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                  <label for="id_tipo_identificacion" class="control-label">Tipo Identificación:</label>
                                                  <select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" >
													<option value="0" selected="selected">--Seleccione--</option>
                								  </select> 
                                                  
                                </div>
                                </div>
                                    
                                    
                               <div class="col-lg-2 col-xs-12 col-md-2">
                    		   <div class="form-group">
                                                  <label for="identificacion_clientes" class="control-label">Identificación:</label>
                                                  <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="0" >
                                                  <input type="number" class="form-control" id="identificacion_clientes" name="identificacion_clientes" value=""  placeholder="identificación..">
                                                  
                                </div>
                                </div>
                                
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="razon_social_clientes" class="control-label">Razón Social:</label>
                                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value=""  placeholder="razón social..">
                                                  
                                </div>
                                </div>
								
								<div class="col-lg-2 col-xs-12 col-md-2">
                                <div class="form-group">
                                                      <label for="celular_clientes" class="control-label">Celular:</label>
                                                      <input type="number" class="form-control" id="celular_clientes" name="celular_clientes" value=""  placeholder="celular..">
                                                     
                                </div>
                                </div>
                    			
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="correo_clientes" class="control-label">Correo:</label>
                                                      <input type="email" class="form-control" id="correo_clientes" name="correo_clientes" value="" placeholder="email..">
                                                     
                                </div>
                    		    </div>
                                   
                                    
            </div>        		   
                    	      
                    			
           <div class="row">
                    		  
                            	    
                        	   
                                    
                                <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="direccion_clientes" class="control-label">Barrio y/o sector:</label>
                                                      <input type="text" class="form-control" id="direccion_clientes" name="direccion_clientes" value="" placeholder="nombre barrio..">
                                                      
                                </div>
                                </div>
                               
							    <div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="valor_limite_credito" class="control-label">Límite Crédito</label>
                                	 <input type="text" class="form-control cantidades" id="valor_limite_credito" name="valor_limite_credito" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
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
                    		       
								<div class="col-lg-4 col-xs-12 col-md-4">
                        		<div class="form-group">
                                                          <label for="fotografia_clientes" class="control-label">Fotografía:</label>
                                                          <input type="file" class="form-control" id="fotografia_clientes" name="fotografia_clientes" value="">
                                                          <div id="errorImagen"></div>
                                </div>
                        		</div>
                    			            
              </div>
                    	           	
                
            
			
			<div class="row">
           
	                          
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="button" name="Guardar" class="btn btn-success" onclick="RegistrarClientes()"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a class="btn btn-primary" href="<?php  echo $helper->url("Clientes","index"); ?>"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
                                
                                </div>
                    		    </div>
                    
	          </div>
        
        	
        	
        
      </div>
     </section>






     	
    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="text-info">Consultar Clientes Registrados</h4>  
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
                					<th>Tipo Identificación</th>
                    				<th>Identificación</th>
                    				<th>Razón Social</th>
                    				<th>Correo</th>
                    				<th>Celular</th>
                    				<th>Estado</th>
                    				<th>Usuario</th>
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
	<script src="view/Administracion/js/Clientes.js?0.10"></script>  
	  
      
   	
  </body>
</html>   

