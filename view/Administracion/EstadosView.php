    <!DOCTYPE HTML>
	<html lang="es">
    <head>
    
    <script lang=javascript src="view/Contable/FuncionesJS/xlsx.full.min.js"></script>
    <script lang=javascript src="view/Contable/FuncionesJS/FileSaver.min.js"></script>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>supermercado</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    
    <style type="text/css">
 	  .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('view/images/ajax-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
        }
 	  
 	</style>
  
    <?php include("view/modulos/links_css.php"); ?>		
  	    
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
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Contabilidad</a></li>
        <li class="active">Activos Fijos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Estados</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
          
        
        <form id="frm_estados" action="<?php echo $helper->url("Estados","Index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
           		    
                    		   
		 <div class="row">
		    
		   <div class="col-xs-12 col-md-3 col-md-3 ">
		    <div class="form-group">
                  <label for="nombre_estado" class="control-label">Nombre del Estado:</label>
                  <input type="text" class="form-control" id="nombre_estado" name="nombre_estado" value=""  placeholder="nombre...">
                  <input type="hidden" name="id_estado" id="id_estado" value="0" class="form-control"/>
                   <div id="mensaje_nombre_estado" class="errores"></div>
            </div>
		    </div> 
           
		    <div class="col-xs-12 col-md-3 col-md-3">
		    <div class="form-group">
		    
              <label for="nombre_tabla" class="control-label">Nombre de la tabla:</label>
              <select name="nombre_tabla" id="nombre_tabla"  class="form-control">
                <option value="0" selected="selected">--Seleccione--</option>						
		       </select>
			   <div id="mensaje_nombre_tabla" class="errores"></div>
				   
            </div>
            </div>
		   
		  </div>
		  
		  <div id="divLoaderPage" ></div>
            
		    <br>  
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; ">
		    <div class="form-group">
            	<button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
		    </div>
		    </div>
                    		        		  
          </form>
          
        </div>
        
        
      </div>
    </section>
    
    <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Estados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
           <div class="nav-tabs-custom">
            
            
            <div class="col-md-5 col-lg-12 col-xs-5">
            <div class="tab-content">
            
            <br>
              <div class="tab-pane active" id="estados">
              
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_estados" name="search_estados" onkeyup="consultaEstados(1)" placeholder="search.."/>
						
					</div>
					<div id="estados_registrados"></div>	
                </div>
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

    <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
	<script src="view/Administracion/js/Estados.js?0.2"></script> 


  </body>
</html>   

 