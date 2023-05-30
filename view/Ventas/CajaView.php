<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Caja</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
 
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
        <li class="active">Administrar Caja</li>
      </ol>
    </section>   



	<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Administrar Caja</h4>  <span  class="text-info" id="verificar"></span>
          <div class="box-tools pull-right">
            
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
			
          </div>
        </div>
        
        <div class="box-body">
        	
			   <div class="row">
                    		  
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="movimiento" class="control-label">Aperturar - Cerrar:</label>
                                                          <select name="movimiento" id="movimiento"  class="form-control" >
															<option value="0" selected="selected">--Seleccione--</option>														
														    <option value="1">Abrir Caja</option>
														    <option value="2">Cerrar Caja</option>
														  </select> 
                                                          
                                </div>
                    		    </div> 
                    		  
                    		   
							    <div class="col-xs-12 col-md-2 col-lg-2 ">
                            	<div class="form-group">
                                	 <label for="monto_caja" class="control-label">Monto:</label>
                                	 <input type="text" class="form-control cantidades" id="monto_caja" name="monto_caja" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
								</div>
                                </div>
                                
                                <div class="col-xs-12 col-md-2 col-lg-2" style="text-align: center; margin-top:25px">
                    		    <div class="form-group">
                                                      <button type="button" name="Guardar" class="btn btn-success" onclick="RegistrarCaja()"><i class="glyphicon glyphicon-floppy-saved"> Procesar</i></button>
                                					  <a class="btn btn-primary" href="<?php  echo $helper->url("Caja","index"); ?>"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
                                
                                </div>
                    		    </div>
             					            
              </div>
            
      </div>  
        
      </div>
     </section>



     <div  id="div_agregar_movimientos" style="display: none;">
							   
        	<section class="content">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h4 class="text-info">Agregar Movimientos</h4>
                  <div class="box-tools pull-right">
                    
        			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
        			
                  </div>
                </div>
                
                <div class="box-body">
                	
        			   <div class="row">
                            		  
                            		    <div class="col-lg-2 col-xs-12 col-md-2">
                            		    <div class="form-group">
                                                                  <label for="id_tipo_transaccion" class="control-label">Tipo Transacción:</label>
                                                                  <select name="id_tipo_transaccion" id="id_tipo_transaccion"  class="form-control" >
        															<option value="0" selected="selected">--Seleccione--</option>														
        														  </select> 
                                                                  
                                        </div>
                            		    </div> 
                            		  
                            		   
        							    <div class="col-xs-12 col-md-2 col-lg-2 ">
                                    	<div class="form-group">
                                        	 <label for="valor_transaccion" class="control-label">Valor Transacción:</label>
                                        	 <input type="text" class="form-control cantidades" id="valor_transaccion" name="valor_transaccion" value='0.00' data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
        								</div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-md-4 col-lg-4 ">
                                    	<div class="form-group">
                                        	 <label for="descripcion_transaccion" class="control-label">Descripción:</label>
                                        	 <input type="text" class="form-control" id="descripcion_transaccion" name="descripcion_transaccion" value='' placeholder="descripcion..">
        								</div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-md-2 col-lg-2" style="text-align: center; margin-top:25px">
                            		    <div class="form-group">
                                                              <button type="button" name="Guardar" class="btn btn-success" onclick="Agregar()"><i class="glyphicon glyphicon-floppy-saved"> Agregar</i></button>
                                        </div>
                            		    </div>
                     					            
                      </div>
                    
              </div>  
                
              </div>
             </section>						   
							   
     

     	
    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="text-info">Consultar Movimientos Detallados de la Caja</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        	<div class="row">
     			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     				<div id="div_listado" class="letrasize11">
                   	<table id="tbllistado" class="table">
                			<thead>
                		    <tr class="danger">
                					<th>Transacción</th>
                    				<th>Valor</th>
                    				<th>Descripción</th>
                    				<th>Fecha</th>
                    				
							</tr>                    				
                			</thead>  
                			<tbody>
                				
                			</tbody>                  			
                			<tfoot>
                				<tr>
                        			<td style="text-align: right;"><b>TOTAL EFECTIVO EN CAJA</b></td> 
                        			<td ><b>..</b></td>
                        			<td ><b></b></td>
                        			<td ><b></b></td>
                    			</tr>
                			</tfoot>
                		</table>
            		</div>
     			</div>
     		</div>
             		
        </div>
        
       </div>
      </section>
     
	 
	  <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="text-info">Consultar Movimientos Resumidos de la Caja</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        	<div class="row">
     			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     				<div id="div_listado_1" class="letrasize11">
                   	<table id="tbllistado_1" class="table">
                			<thead>
                		    <tr class="danger">
                					<th>Transacción</th>
                    				<th>Valor</th>
                    		</tr>                    				
                			</thead>  
                			<tbody>
                				
                			</tbody>                  			
                			<tfoot>
                				<tr>
                        			<td style="text-align: right;"><b>TOTAL EFECTIVO EN CAJA</b></td> 
									<td><b>..</b></td>
                    			</tr>
                			</tfoot>
                		</table>
            		</div>
     			</div>
     		</div>
             		
        </div>
        
       </div>
      </section>
	 
	 </div>
	 
	 
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
	<script src="view/Ventas/js/Caja.js?0.05"></script>  
	  
      
   	
  </body>
</html>   

