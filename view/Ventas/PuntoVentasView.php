<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Punto Ventas</title>
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
        <li class="active">Punto de Vetas</li>
      </ol>
    </section>   



	<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Facturar Venta</h4>  
          <div class="box-tools pull-right">
            
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
			 
			
											 <select name="perecedero_productos" id="perecedero_productos"  class="form-control" >
												<option value="FALSE" selected="selected">NO</option>
												<option value="TRUE">SI</option>
											  </select> 
											  
											   <select name="perecedero_productos" id="perecedero_productos"  class="form-control" >
												<option value="FALSE" selected="selected">NO</option>
												<option value="TRUE">SI</option>
											  </select> 
											  
			 
			
			
			 
			  
          </div>
        </div>
        
        <div class="box-body">

        <div class="row">
          <div class="col-md-6">
          <div class="input-group">
    <input type="text" class="form-control" placeholder="Buscar" id="txt-cliente-busqueda">
    <input type="hidden" id="hdn_id_cliente" value="0">
    <div class="input-group-btn">
      <button class="btn btn-default" type="button" id="btn-buscar-cliente">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
    <br>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div id="dv-datos-cliente">

            </div>            
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="main-ventas">
            <div class="" style="background-color: #000000; text-align: center; height: 60px;" >
					<label for="codigo_productos" class="control-label" style="color:#008000; font-size: 40px;">$ <span id="total_factura">0.00</span></label>
				 </div>   
            </div>
            <hr>
            <div class="main-productos">

            <div id="div_ventas" class="letrasize11">
                   	<table id="tblventas" class="table table-striped table-bordered">
                			<thead>
                		    <tr class="danger">
                					<th>nombre</th>
                    				<th>cantidad</th>
                    				<th>precio U</th>
                            <th>Iva</th>
                    				<th>Total</th>
                            <th>Opciones</th>
                    			</tr>                    				
                			</thead>  
                			<tbody>
                				
                			</tbody>                  			
                			<tfoot>
                      <tr class="info">
                					<th>TOTAL:</th>
                    				<th></th>
                    				<th></th>
                            <th></th>
                    				<th><input type="text" class="form-control" value="0" id="txt-total-punto-venta" /></th>
                            <th></th>
                    			</tr>
                			</tfoot>
                		</table>
            		</div>

            </div>
         
          </div>

          <div class="col-md-6">
            <div class="detalle-ventas">
            <div class="form-group">
                                                  <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value=""  placeholder="BUSQUE UN PRODUCTO AQUI..">
                                                  <input type="hidden" id="hdn_productos" value="0" >
                                                  
                                </div> 
            </div>
              <hr>
            <div class="detalle-productos">
           

                            
            </div>
         
          </div>
        </div>
        	
			 <div class="col-lg-12 col-xs-12 col-md-12">
			 
				
				
			</div>
			 
  					<a class="btn btn-info" onclick="generar_factura(this)" title="Factura" href="#" role="button" target="_blank"><i class="glyphicon glyphicon-list-alt"></i> Imprimir Factura</a>
	
			 
            <div class="row" style="margin-top:80px;">
                               <div class="col-lg-12 col-xs-12 col-md-12">
                    		   
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
                    				<th>S. Min</th>
									<th>Stock</th>
                    				<th>P. Compra</th>
                    				<th>P. Venta</th>
									<th>P. Venta Mayoreo</th>
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
	<script src="view/Ventas/js/PuntoVentas.js?0.12"></script>  
	  
      
   	
  </body>
</html>   

