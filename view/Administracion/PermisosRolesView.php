    
    <!DOCTYPE HTML>
	<html lang="es">
    <head>
    <style>

    
ul, #PermisosList {
  list-style-type: none;
}

#PermisosList {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
  display: inline-block;

}
div.l1 {

  float: left;
 }

.nested {
  display: none;
}

.active {
  display: block;
}

</style>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>supermercado</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
  
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
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permisos Roles</li>
      </ol>
    </section>



    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Permisos</h3>
          <div class="box-tools pull-right">
          
            
          </div>
        </div>
        
        <div class="box-body">
        
      
                        
        <label for="id_rol" class="control-label">Roles</label>
        <br>
        <div class ="l1">
        
             <select name="id_rol" id="id_rol"  class="form-control" onchange="Rol_seleccionado()">
                <option value="0" selected="selected">--Seleccione--</option>
					<?php foreach($resultRol as $res) {?>
					<option value="<?php echo $res->nombre_rol; ?>"><?php echo $res->nombre_rol; ?></option>
		            <?php } ?>
			  
			  </select>
			  </div>
			  <button type="button" id="btUpdate" name="btUpdate" class="btn btn-info">Subir Cambios</button>
			  
			  
			  <div id="mensaje_id_grupos" class="errores"></div>
			  <div id="arbol_roles"></div>
			  
			  
			  
	   </div>
        
        
      </div>
    </section>
    
    
    
     
    
  </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>  
   <script src="view/Administracion/js/PermisoRoles.js?1.6"></script> 
	
	
  </body>
</html>   



