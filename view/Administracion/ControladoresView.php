<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>supermercado</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    
 
   <?php include("view/modulos/links_css.php"); ?>
  			        
    </head>
    <body class="hold-transition skin-black-light fixed sidebar-mini"  >
    

       <script>
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var nombre_controladores = $("#nombre_controladores").val();
		    	var id_modulos = $("#id_modulos").val();
		    	
		    	
		    	
		    	if (nombre_controladores == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca Un Controlador");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}   

		     	if (id_modulos == "")
		    	{
			    	
		    		$("#mensaje_id_modulos").text("Introduzca Un Modulo");
		    		$("#mensaje_id_modulos").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_modulos").fadeOut("slow"); //Muestra mensaje de error
		            
		    	}
			}); 


		        $( "##mensaje_nombres" ).focus(function() {
				  $("##mensaje_nombres").fadeOut("slow");
			    });
		        $( "#mensaje_id_modulos" ).focus(function() {
					  $("#mensaje_id_modulos").fadeOut("slow");
				    });   		      
				    
		}); 


		    mensaje_id_modulos

	</script>

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
        <li class="active">Controladores</li>
      </ol>
    </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Controladores</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
                  <div class="box-body">

						<form action="<?php echo $helper->url("Controladores","InsertaControladores"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
                              <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
             						 <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		   						 
                                                              <label for="nombre_controladores" class="control-label">Nombres Controladores</label>
                                                              <input type="text" class="form-control" id="nombre_controladores" name="nombre_controladores" value="<?php echo $resEdit->nombre_controladores; ?>"  placeholder="Nombre Controlador" required/>
                                                               <input type="hidden" name="id_controladores" id="id_controladores" value="<?php echo $resEdit->id_controladores; ?>" class="form-control"/>
					                                          <div id="mensaje_nombres" class="errores"></div>
					                                          				                                          
                            								
                            					                                          
                                        </div>
                            		  </div>
                        				    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                       
                                                          <label for="id_modulos" class="control-label">Modulo</label>
                                                          <select name="id_modulos" id="id_modulos"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultMod as $resMod) {?>
				 												<option value="<?php echo $resMod->id_modulos; ?>" <?php if ($resMod->id_modulos == $resEdit->id_modulos )  echo  ' selected="selected" '  ;  ?> ><?php echo $resMod->nombre_modulos; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										  <div id="mensaje_id_modulos" class="errores"></div>
                                    </div>
                                    </div>
                        		</div>	
         
							    
							     <?php } } else {?>
							    
							    
							    	 <div class="row">
                        		    <div class="col-xs-12 col-md-3 col-md-3 ">
                            		    <div class="form-group">
                            		    					  
                                                              <label for="nombre_controladores" class="control-label">Nombres Controladores</label>
                                                              <input  type="text" class="form-control" id="nombre_controladores" name="nombre_controladores" value=""  placeholder="Nombre Controlador" required/>
                                                              <div id="mensaje_nombres" class="errores"></div>
                                                              	
                                                              
                                        </div>
                            		  </div>
                        		 
								    <div class="col-xs-12 col-md-3 col-md-3">
                        		    <div class="form-group">
                                                          <label for="id_modulos" class="control-label">Modulos</label>
                                                          <select name="id_modulos" id="id_modulos"  class="form-control">
                                                            <option value="0" selected="selected">--Seleccione--</option>
																<?php foreach($resultMod as $resMod) {?>
				 												<option value="<?php echo $resMod->id_modulos; ?>"  ><?php echo $resMod->nombre_modulos; ?> </option>
													            <?php } ?>
								    					  </select>
		   		   										   <div id="mensaje_id_modulos" class="errores"></div>
                                    </div>
                                    </div>
                      	   	</div>	
							   
										               	
							     <?php } ?>
					                		        
                           		<div class="row">
                    			    <div class="col-xs-12 col-md-4 col-md-4 " style="margin-top:15px;  text-align: center; ">
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
          <h3 class="box-title">Listado de Controladores Registrados</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
        <div class="box-body">
        
        
       <div class="ibox-content">  
      <div class="table-responsive">
        
		<table  class="table table-striped table-bordered table-hover dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre Controlador</th>
                          <th>Nombre Modulos</th>
                          <th>Editar</th>
                          <th>Borrar</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php $i=0;?>
    						<?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
    						<?php $i++;?>
            	        		<tr>
            	                   <td > <?php echo $i; ?>  </td>
            		               <td > <?php echo $res->nombre_controladores; ?>     </td> 
            		               <td > <?php echo $res->nombre_modulos; ?>     </td> 
            		               
            		               <td>
            			           
            			           		<div class="right">
            			                    <a href="<?php echo $helper->url("Controladores","index"); ?>&id_controladores=<?php echo $res->id_controladores; ?>" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class='glyphicon glyphicon-edit'></i></a>
            			                </div>
            			            
            			             </td>
            			             <td>   
            			                	<div class="right">
            			                    <a href="<?php echo $helper->url("Controladores","borrarId"); ?>&id_controladores=<?php echo $res->id_controladores; ?>" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
            			                </div>
            			              
            		               </td>
            		    		</tr>
            		        <?php } } ?>
                    
                    </tbody>
                    </table>
       
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
	
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>  
   <script src="view/Administracion/js/Controladores.js?1.0"></script> 
       
       

 	
	
	
  </body>
</html>   

