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
            <li class="active">Consulta Encuestas</li>
          </ol>
        </section>


     <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Encuestas Registradas</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
     										<div id="div_mostrar" class="letrasize11">
                                	
                                    		<table id="tbl_mostrar" class="table table-striped table-bordered">
                                    			<thead>
                                    				<tr class="danger">
                                    				    <th>#</th>
                                        				<th>Usuario</th>
                                        				<th>Nombre Local</th>
                                        				<th>Nombre Contacto</th>
                                        				<th>Provincia</th>
                                        				<th>Ciudad</th>
                                        				<th>Latitud</th>
                                        				<th>Longitud</th>
                                        				<th>Fecha</th>
                                        				<th></th>
                                        			</tr>                    				
                                    			</thead>                    			
                                    			<tfoot>
                                    				<tr>
                                    				</tr>
                                    			</tfoot>
                                    		</table>
                                		</div>
     
     </div>
     </div>
     </section>
     
       <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">Censos Registrados</h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
     										<div id="div_mostrar1" class="letrasize11">
                                	
                                    		<table id="tbl_mostrar1" class="table table-striped table-bordered">
                                    			<thead>
                                    				<tr class="danger">
                                    				    <th>#</th>
                                        				<th>Usuario</th>
                                        				<th>Nombre Local</th>
                                        				<th>Nombre Contacto</th>
                                        				<th>Provincia</th>
                                        				<th>Ciudad</th>
                                        			    <th>Latitud</th>
                                        				<th>Longitud</th>
                                        				<th>Fecha</th>
                                        				<th></th>
                                        			</tr>                    				
                                    			</thead>                    			
                                    			<tfoot>
                                    				<tr>
                                    				</tr>
                                    			</tfoot>
                                    		</table>
                                		</div>
     
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
    <script src="view/ServiciosOnline/js/ConsultaEncuestaOnline.js?0.02"></script>       
    
    
     
    
  </body>
</html>
