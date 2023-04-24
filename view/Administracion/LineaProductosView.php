<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Linea Productos</title>
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
        <li class="active">LineaProductos</li>
      </ol>
    </section>   



	<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Registrar Linea Productos</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        	
			  		   
            <div class="row">
             					  
         				
                                    
                                    
                              
                                
                               <div class="col-lg-4 col-xs-12 col-md-4">
                    		   <div class="form-group">
                                                  <label for="nombre_linea_productos" class="control-label">Nombre Línea Productos:</label>
                                                  <input type="text" class="form-control" id="nombre_linea_productos" name="nombre_linea_productos" value=""  placeholder="Nombre Línea Productos..">
                                                  
                                </div>
                                </div>
								
							
                    			
                    	
                                   
                                    
            </div>        		   
                    	      

			
			<div class="row">
           
	                          
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="button" name="Guardar" class="btn btn-success" onclick="RegistrarLineaProductos()"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <a class="btn btn-primary" href="<?php  echo $helper->url("LineaProductos","index"); ?>"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
                                
                                </div>
                    		    </div>
                    
	          </div>
        
        	
        	
        
      </div>
     </section>






     	
    <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="text-info">Consultar Línea Productos Registrados</h4>  
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
                					<th>Id</th>
                    				<th>Nombre Línea Productos</th>
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
     

	 
    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
    <script src="view/Administracion/js/LineaProductos.js?0.13"></script>  
	  
      
   	
  </body>
</html>   

