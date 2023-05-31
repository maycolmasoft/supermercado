<!DOCTYPE HTML>
<html lang="es">
  <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Compras</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="view/bootstrap/bower_components/select2/dist/css/select2.min.css">
 
   <?php include("view/modulos/links_css.php"); ?>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">	  
	 
	  <style>
        div.imgtr{
          position:absolute;
          opacity:0.75;
          width:100%;
          text-align: center;
          padding: 1em 0;
        }
     </style>
	 
	 
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
        <li class="active">Compras</li>
      </ol>
    </section>   



	<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Compras</h4>  
          <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
	      </div>
        </div>
        
        <div class="box-body">
      

        <div class="row">
          <div class="col-md-7">
           
            <div class="main-productos">

				<div class="detalle-ventas">
									<div class="form-group">
													  <input type="text" class="form-control" id="codigo_productos" name="codigo_productos" value=""  placeholder="Busque un producto aqui..">
													  <input type="hidden" id="hdn_productos" value="0" >
													  
									</div> 
				</div>
				<hr>



            <div id="div_ventas" class="letrasize11">
                   	<table id="tblventas" class="table table-striped table-bordered">
                			<thead>
                		    <tr class="danger">
                					<th>Producto</th>
                    				<th>Cantidad</th>
                    				<th>Precio U</th>
                                    <th>Iva</th>
                    				<th>Total</th>
                                    <th></th>
                    			</tr>                    				
                			</thead>  
                			<tbody>
                				
                			</tbody>                  			
                			<tfoot>
							    <tr>
                					<th></th>
                    				<th></th>
                    				<th></th>
									<th>Subtotal:</th>
                    				<th><input type="number" class="form-control text-right" value="0.00" id="txt-subtotal-punto-venta" disabled/></th>
                                    <th></th>
                    			</tr>
								<tr>
                					<th></th>
                    				<th></th>
                    				<th></th>
									<th>Iva 12%:</th>
                    				<th><input type="number" class="form-control text-right" value="0.00" id="txt-iva-punto-venta" disabled/></th>
                                    <th></th>
                    			</tr>
                                <tr>
                					<th></th>
                    				<th></th>
                    				<th></th>
									<th>TOTAL:</th>
                    				<th><input type="number" class="form-control text-right" value="0.00" id="txt-total-punto-venta" disabled/></th>
                                    <th></th>
                    			</tr>
								
								
								
                			</tfoot>
                		</table>
            		</div>

            </div>
         
          </div>

          <div class="col-md-5">
         
            <div class="main-ventas">
            <div class="" style="background-color: #000000; text-align: center; height: 60px;" >
					<label for="codigo_productos" class="control-label" style="color:#008000; font-size: 40px;">$ <span id="total_factura">0.00</span></label>
				 </div>   
            </div>
            <hr>
         
				 <div class="row">
						<div class="col-lg-12 col-xs-12 col-md-12">
						<div class="form-group">
												  <label for="id_proveedores" class="control-label">Proveedor:</label>
												  <select name="id_proveedores" id="id_proveedores"  class="form-control" >
													<option value="0" selected="selected">--Seleccione--</option>
												  </select> 
												  
						</div>
						</div>
						
				  </div>		
						
				
				   <div class="row">
						
						<div class="col-lg-6 col-xs-12 col-md-6">
						<div class="form-group">
												  <label for="id_tipo_comprobante" class="control-label">Tipo Comprobante:</label>
												  <select name="id_tipo_comprobante" id="id_tipo_comprobante"  class="form-control" >
													<option value="0" selected="selected">--Seleccione--</option>
												  </select> 
												  
						</div>
						</div>
						
						
						<div class="col-xs-12 col-md-6 col-lg-6 ">
							<div class="form-group">
									<label for="fecha_compra_cabeza" class="control-label">Fecha Comprobante:</label>
									<input type="date" class="form-control" id="fecha_compra_cabeza" name="fecha_compra_cabeza" value="">
									
							</div>                            	
						 </div> 
						
				   </div>	
				
				
				   <div class="row">
						
						<div class="col-lg-6 col-xs-12 col-md-6">
						<div class="form-group">
												  <label for="id_tipo_pago" class="control-label">Tipo Pago:</label>
												  <select name="id_tipo_pago" id="id_tipo_pago"  class="form-control" >
													<option value="0" selected="selected">--Seleccione--</option>
												  </select> 
												  
						</div>
						</div>
						
						
						<div class="col-xs-12 col-md-6 col-lg-6 ">
							<div class="form-group">
									<label for="numero_comprobante_cabeza" class="control-label">Número Comprobante:</label>
									<input type="text" class="form-control" id="numero_comprobante_cabeza" name="numero_comprobante_cabeza" value="" placeholder="numero..">
									
							</div>                            	
						 </div> 
						
				   </div>	
				   
				   
				   <div class="row">
           
	                          
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="button" name="Guardar" class="btn btn-success" onclick="RegistrarCompra()"><i class="glyphicon glyphicon-floppy-saved"> Guardar Compra</i></button>
                                					  <a class="btn btn-primary" href="<?php  echo $helper->url("Compras","index"); ?>"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
                                
                                </div>
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
	
    <script src="view/bootstrap/bower_components/select2/dist/js/select2.full.min.js"></script>
	  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
	<script src="view/Compras/js/Compras.js?0.04"></script>  
	  
      
   	
  </body>
</html>   

