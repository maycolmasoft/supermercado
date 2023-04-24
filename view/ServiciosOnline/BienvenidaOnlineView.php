<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>supermercado</title>
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
            <li><a href="<?php echo $helper->url("ServiciosOnline","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Panel Informativo</li>
          </ol>
        </section>




    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Estado Actual</span>
              <span class="info-box-number" id="estado"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description" id="fecha_actual">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Datos Contacto</span>
              <span class="info-box-number"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description" id="contacto">
                  
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ultimo Acceso</span>
              <span class="info-box-number"  id ="dia"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description" id="acceso">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Recomendar</span>
              <span class="info-box-number" id="afiliacion">Nueva Afiliación</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
             
                  <span class="progress-description" id="aqui_afiliacion">
                     <a href='index.php?controller=ServiciosOnline&action=index2'>Leer Mas<i class='fa fa-arrow-circle-right'></i></a>
			      </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        
       <!--  <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Edad</span>
              <span class="info-box-number" id="años"></span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description" id="mes_dias">
                    
                  </span>
            </div>
          
          </div>
         
        </div>
        
        -->
        
        
        <!-- /.col -->
      </div>

   </section>
            
          <section class="content">
          <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>CONSULTA DE INFORMES GENERADOS</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
         
              <div class="box-group" id="accordion1">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-default">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion1" href="#collapseFour" class="collapsed">Estados Financieros</a>
                     
                    </h4>
                  </div>
                  <div id="collapseFour" class="panel-collapse collapse">
                    <div class="box-body">
                      
                      
                      
                      
                      
              <table id="example1" class="table table-striped table-bordered">
                <thead class="letrasize11">
                <tr class="danger">
                  <th>Año</th>
                  <th>Enero</th>
                  <th>Febrero</th>
                  <th>Marzo</th>
                  <th>Abril</th>
                  <th>Mayo</th>
                  <th>Junio</th>
                  <th>Julio</th>
                  <th>Agosto</th>
                  <th>Septiembre</th>
                  <th>Octubre</th>
                  <th>Noviembre</th>
                  <th>Diciembre</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>2021</td>
                  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=estado_ene_2021" target="_blank" title="Visualizar"><i class="glyphicon glyphicon-file"></i></a></td>
                  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=estado_feb_2021" target="_blank" title="Visualizar"><i class="glyphicon glyphicon-file"></i></a></td>
                  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=estado_mar_2021" target="_blank" title="Visualizar"><i class="glyphicon glyphicon-file"></i></a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
				<tr>
                  <td>2020</td>
				  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=estado_dic_2020" target="_blank" title="Visualizar"><i class="glyphicon glyphicon-file"></i></a></td>
                 
                </tr>

                <tr>
                  <td>2019</td>
				  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=estado_dic_2019" target="_blank" title="Visualizar"><i class="glyphicon glyphicon-file"></i></a></td>
				  
                </tr>
                <tr>
                  <td>2018</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=estado_dic_2018" target="_blank" title="Visualizar"><i class="glyphicon glyphicon-file"></i></a></td>
				  
                </tr>


			   </tbody>
                <tfoot>
                </tfoot>
              </table>
            
                      
                      
                      
                      
                      
                    
                    </div>
                  </div>
                </div>
                <div class="panel box box-default">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion1" href="#collapseFive" class="collapsed">Reglamentos</a>
                    </h4>
                  </div>
                  <div id="collapseFive" class="panel-collapse collapse">
                    <div class="box-body">
                      
                      
                      
                                
              <table id="example3" class="table table-striped table-bordered">
                <thead class="letrasize11">
               <tr class="danger">
                  <th>Reglamento</th>
                  <th>Visualizar</th>
                 
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
                <div class="panel box box-default">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion1" href="#collapseSix" class="collapsed">Auditorias</a>
                    </h4>
                  </div>
                  <div id="collapseSix" class="panel-collapse collapse">
                    <div class="box-body">
                     
                                  
                      
              <table id="example2" class="table table-striped table-bordered">
                <thead class="letrasize11">
               <tr class="danger">
                  <th>Año</th>
                  <th>Empresa</th>
                  <th>Informe</th>
                  <th>Informe</th>
                  <th>Informe</th>
                  <th>Informe</th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                  <td>2019</td>
                  <td>Freire Hidalgo Auditores S.A</td>
                  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=dic_2019_1" target="_blank" title="Informe del auditor independiente, Primer Semestre año 2019"><i class="glyphicon glyphicon-file"></i></a></td>
                  <td><a class="btn btn-default" href="index.php?controller=ServiciosOnline&action=attachment&fec=dic_2019_2" target="_blank" title="Informe del auditor independiente 31-12-2019"><i class="glyphicon glyphicon-file"></i></a></td>
                  <td></td>
				  <td></td>
                 </tr>
                
                
                 </tbody>
                <tfoot>
                </tfoot>
              </table>
            
                      
                      
                    </div>
                  </div>
                </div>
              </div>
           
            
            </div>
            </div>
            </div>
            
            
            
            
            </div>
            </section>
            




   
  </div>
 
 
 <!-- INI MODAL CUENTA INDIVIDUAL -->
 
  <div class="modal fade" id="mod_mostrar_detalle_cuenta_individual" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog   modal-lg " role="document" >
        <div class="modal-content">
          <div class="modal-header bg-primary color-palette">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" align="center">DETALLE CAPTACIONES</h4>
          </div>
          <div class="modal-body" >
          	<div class="box-body no-padding">
          		<div class="row">
          		
          		</div>
          		<br>
              	<div id="div_detalle_modal_cuenta_individual" class="letrasize11">
                		<table id="tbl_detalle_modal_cuenta_individual" class="table table-striped table-bordered" >
          		        	<thead >
                        	    <tr class="danger" >
                        	    	<th >Año</th>
                        			<th >Enero</th>
                        			<th >Febrero</th>
                        			<th >Marzo</th>
                        			<th >Abril</th>
                        			<th >Mayo</th>
                        			<th >Junio</th>
                        			<th >Julio</th>
                        			<th >Agosto</th>
                        			<th >Septiembre</th>
                        			<th >Octubre</th>
                        			<th >Noviembre</th>
                        			<th >Diciembre</th>
                        			<th >Acumulado</th>
                        			
                       		</tr>
                        	</thead>        
                           <tfoot>
                        		<tr>
                        			<td colspan="12"><b>TOTALES ..</b></td> 
                        			<td ><b>TOTAL</b></td> 
                        			<td ><b>..</b></td>
                    			</tr>
                			</tfoot>
                        </table>            	
                
                	</div>
          		
            	
          	</div>
          	
          
          </div>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
<!-- END MODAL CUENTA INDIVIDUAL -->
 

 
 <!-- INI MODAL CUENTA DESEMBOLSAR -->
 
  <div class="modal fade" id="mod_mostrar_detalle_cuenta_desembolsar" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog   modal-lg " role="document" >
        <div class="modal-content">
          <div class="modal-header bg-primary color-palette">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" align="center">DETALLE CUENTA POR DESEMBOLSAR</h4>
          </div>
          <div class="modal-body" >
          	<div class="box-body no-padding">
          		<div class="row">
          		
          		</div>
          		<br>
              	<div id="div_detalle_modal_cuenta_desembolsar" class="letrasize11">
                		<table id="tbl_detalle_modal_cuenta_desembolsar" class="table table-striped table-bordered" >
          		        	<thead >
                        	    <tr class="danger" >
                        	    	<th >Año</th>
                        			<th >Enero</th>
                        			<th >Febrero</th>
                        			<th >Marzo</th>
                        			<th >Abril</th>
                        			<th >Mayo</th>
                        			<th >Junio</th>
                        			<th >Julio</th>
                        			<th >Agosto</th>
                        			<th >Septiembre</th>
                        			<th >Octubre</th>
                        			<th >Noviembre</th>
                        			<th >Diciembre</th>
                        			<th >Acumulado</th>
                        			
                       		</tr>
                        	</thead>        
                           <tfoot>
                        		<tr>
                        			<td colspan="12"><b>TOTALES ..</b></td> 
                        			<td ><b>TOTAL</b></td> 
                        			<td ><b>..</b></td>
                    			</tr>
                			</tfoot>
                        </table>            	
                
                	</div>
          		
            	
          	</div>
          	
          
          </div>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
<!-- END MODAL CUENTA INDIVIDUAL -->



 <!-- INI MODAL CREDITOS -->
 
  <div class="modal fade" id="mod_mostrar_detalle_creditos" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog   modal-lg " role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary color-palette">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" align="center">TABLA AMORTIZACIÓN CRÉDITO</h4>
          </div>
          <div class="modal-body" >
          	<div class="box-body no-padding">
          		
          		
          			                 <div id="div_detalle_modal_creditos" class="letrasize11">
                                	
                                    		<table id="tbl_detalle_modal_creditos" class="table table-striped table-bordered">
                                    			<thead>
                                    				<tr class="danger">
                                        				<th>Pago</th>
                                        				<th>Fecha</th>
                                        				<th>Capital</th>
                                        				<th>Interes</th>
                                        				<th>Seg. Desgrav.</th>
                                        				<th>Mora</th>
                                        				<th>Cuota</th>
                                        				<th>Saldo Cuota</th>
                                        				<th>Saldo Capital</th>
                                        				<th>Estado</th>
                                    				</tr>                    				
                                    			</thead>                    			
                                    			 <tfoot>
                                            		<tr>
                                            			<td><b>TOTALES ..</b></td> 
                                            			<td ><b></b></td> 
                                            			<td ><b></b></td> 
                                            			<td ><b></b></td>
                                            			<td ><b></b></td>
                                            			<td ><b></b></td>
                                            			<td ><b></b></td>
                                            			<td ><b></b></td>
                                            			<td ><b></b></td>
                                            			<td ><b></b></td>
                                        			</tr>
                                    			</tfoot>
                                    		</table>
                                    		 
                                		</div>
          		           	
          	</div>
          	
          
          </div>
          
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
<!-- END MODAL CUENTA INDIVIDUAL -->
 
 
 
 
 
 
 
     
          <!-- INICIA ACTIUALIZACION DE PROPOGANDA -->
      
	    
 
	    
       <div class="modal fade" id="mostrarmodal_propaganda" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
         
              <h3 style="margin-left: 15px;"><strong>Actualiza tu Información.</strong></h3>
           </div>
           <div class="modal-body">
         <div class="box-body no-padding">
		             <form id="frm_act_participes" action="" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		 	  <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
              		 	 <div class="row">
                         	<div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="cedula_usuarios" class="control-label">Cedula:</label>
                                    <input type="text" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>"  placeholder="ci-ruc.." readonly>
                                    <input type="hidden" class="form-control" id="id_usuarios" name="id_usuarios" value="<?php echo $resEdit->id_usuarios; ?>" >
                                    <div id="mensaje_cedula_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="nombre_usuarios" class="control-label">Nombres:</label>
                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" placeholder="nombres..">
                                      <div id="mensaje_nombre_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="apellidos_usuarios" class="control-label">Apellidos:</label>
                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="apellidos_usuarios" name="apellidos_usuarios" value="<?php echo $resEdit->apellidos_usuarios; ?>" placeholder="apellidos..">
                                      <div id="mensaje_apellido_usuarios" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="usuario_usuarios" class="control-label">Nombre para Perfil:</label>
                                    <input style="text-transform: uppercase;" type="text" class="form-control" id="usuario_usuarios" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>"  placeholder="usuario..." >
                                    <div id="mensaje_usuario_usuarios" class="errores"></div>
                                 </div>
                             </div> 
                          </div>
                          
                          <div class="row">
                          
                          
                          	<div class="col-xs-6 col-md-3 col-lg-3 ">
                          		<div class="form-group">
                             		 	<label for="fecha_nacimiento_usuarios" class="control-label">Fecha Nacimiento:</label>
                                        <input type="text" class="form-control" id="fecha_nacimiento_usuarios" name="fecha_nacimiento_usuarios" value="<?php echo $resEdit->fecha_nacimiento_usuarios ?>"  data-fechaactual="<?php echo date('Y/m/d');?>" >
                                        <div id="mensaje_fecha_nacimiento_usuarios" class="errores"></div>
                                       
                                </div>                            	
                             </div> 
                            
                             <div class="col-lg-3 col-xs-6 col-md-3">
                             
                                 <div class="form-group">
                                    <label for="celular_usuarios" class="control-label">Celular:</label>
                                    <input type="text" id="celular_usuarios" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>" class="form-control" data-inputmask='"mask": "999-999-9999","clearIncomplete" : true' data-mask>
                                    <div id="mensaje_celular_usuarios" class="errores"></div>
                                    
                                  </div>
                    		    
                             </div>
                             
                             <div class="col-lg-3 col-xs-6 col-md-3">
                             	<div class="form-group">
                                    <label for="telefono_usuarios" class="control-label">Telefono:</label>                                        
                                    <input type="text" class="form-control"  id="telefono_usuarios" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>"  data-inputmask='"mask": "(99) 9999-999","clearIncomplete" : true' data-mask>
                                       
                                  </div>
                    		   
                    	    </div>
                    	    
                    	    
                    	    <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="correo_usuarios" class="control-label">Correo:</label>
                                          <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" placeholder="email..">
                                          <div id="mensaje_correo_usuarios" class="errores"></div>
                                    </div>
                    		    </div>
                                
                        	                            
                          </div>
                          
                          <div class="row">
                		       
                		       <div class="col-xs-6 col-md-3 col-lg-3">
                        		<div class="form-group">
                                  <label for="clave_usuarios" class="control-label">Password:</label>
                                  <input type="password" class="form-control caducaclave" id="clave_usuarios" name="clave_usuarios" value="<?php echo $resEdit->clave_n_claves; ?>" placeholder="(clave..)" maxlength="8" readonly>
                                  <div id="mensaje_clave_usuarios" class="errores"></div>
                                </div>
                            	</div>
                            		    
                    		    <div class="col-lg-3 col-xs-6 col-md-3">
                    		    <div class="form-group">
                                      <label for="clave_usuarios_r" class="control-label">Repita Password:</label>
                                      <input type="password" class="form-control" id="clave_usuarios_r" name="clave_usuarios_r" value="<?php echo $resEdit->clave_n_claves; ?>" placeholder="(clave..)" maxlength="8" readonly>
                                      <div id="mensaje_clave_usuarios_r" class="errores"></div>
                                </div>
                                </div>
                    			
								<div class="col-xs-12 col-lg-3 col-md-3">                                  
                        		   <div class="form-group">
                        		   <br>
                        		   	  <input type="hidden" class="form-control" id="codigo_clave" name="codigo_clave" value="<?php echo $resEdit->clave_n_claves; ?>" >
                                      <label for="cambiar_clave" class="control-label">Cambiar Clave: </label> &nbsp;&nbsp;
                                      <input type="checkbox"  id="cambiar_clave" name="cambiar_clave" value="1"   /> <br>
                                      <!--<label for="caduca_clave" class="control-label">Caduca  Clave: </label> &nbsp;&nbsp; &nbsp;-->
                                      <input type="hidden"  id="caduca_clave" name="caduca_clave" value="1" <?php  if($resEdit->caduca_claves=='t'){echo 'checked="checked" ';} ?>  />
                                    </div>
                                 </div> 
                                 
                                 
                    		    
                    		    <div class="col-xs-12 col-md-3 col-lg-3">
                        		   <div class="form-group">
                                      <label for="id_estado" class="control-label">Estado:</label>
                                      <select name="id_estado" id="id_estado"  class="form-control" readonly>
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php  foreach($resEstado as $res) {?>
    										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_estados" class="errores"></div>
                                    </div>
                                  </div>
                    		    
                    		   
                        	</div>
                        	
                        	
                    		
                    		<div class="row"> 
                    		
                    			<div class="col-xs-12 col-lg-3 col-md-3">
                        		   <div class="form-group">
                                      <label for="id_rol_principal" class="control-label">Rol :</label>
                                      <select name="id_rol_principal" id="id_rol_principal"  class="form-control" readonly>
                                      <option value="0" selected="selected">--Seleccione--</option>
    									<?php foreach($resultRol as $res) {?>
    										<option value="<?php echo $res->id_rol; ?>" <?php if ($res->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_rol; ?> </option>
    							        <?php } ?>
    								   </select> 
                                      <div id="mensaje_id_rol_principal" class="errores"></div>
                                    </div>
                                 </div> 
                                 
                                 
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_genero_participes" class="control-label">Género:</label>
                                                       <select name="id_genero_participes" id="id_genero_participes"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultGen as $res) {?>
                        										<option value="<?php echo $res->id_genero_participes; ?>"><?php echo $res->nombre_genero_participes; ?> </option>
                        							        <?php } ?>
                        							   </select> 
                                                      <div id="mensaje_id_genero_participes" class="errores"></div>
                                </div>
                                </div>
							
							    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_estado_civil_participes" class="control-label">Estado Civil:</label>
                                                      <select name="id_estado_civil_participes" id="id_estado_civil_participes"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultCivil as $res) {?>
                        										<option value="<?php echo $res->id_estado_civil_participes; ?>"><?php echo $res->nombre_estado_civil_participes; ?> </option>
                        							        <?php } ?>
                        							  </select> 
                                                      <div id="mensaje_id_estado_civil_participes" class="errores"></div>
                                </div>
                                </div>
								
								
								<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="numero_cedula_conyuge" class="control-label">Cédula Conyuge:</label>
                                                      <input type="text" class="form-control" id="numero_cedula_conyuge" name="numero_cedula_conyuge" value="" placeholder="número cédula..">
                                                      <div id="mensaje_numero_cedula_conyuge" class="errores"></div>
                                </div>
            					</div>  
            					
            					<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="apellidos_conyuge" class="control-label">Apellidos Conyuge:</label>
                                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="apellidos_conyuge" name="apellidos_conyuge" value="" placeholder="apellidos..">
                                                      <div id="mensaje_apellidos_conyuge" class="errores"></div>
                                </div>
            					</div>   
                    		   
            					<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="nombres_conyuge" class="control-label">Nombres Conyuge:</label>
                                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="nombres_conyuge" name="nombres_conyuge" value="" placeholder="nombres..">
                                                      <div id="mensaje_nombres_conyuge" class="errores"></div>
                                </div>
            					</div>  
								
								
                    			
								<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_entidad_patronal" class="control-label">Dirección:</label>
                                                          <select name="id_entidad_patronal" id="id_entidad_patronal"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEnt as $res) {?>
                        										<option value="<?php echo $res->id_entidad_patronal; ?>" ><?php echo $res->nombre_entidad_patronal; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_entidad_patronal" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_entidad_patronal_coordinaciones" class="control-label">Cordinación:</label>
                                                          <select name="id_entidad_patronal_coordinaciones" id="id_entidad_patronal_coordinaciones" onchange="seleccion();" class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        							      
                        							      <?php foreach($resultCor as $res) {?>
                        										<option value="<?php echo $res->id_entidad_patronal_coordinaciones; ?>"  ><?php echo $res->nombre_entidad_patronal_coordinaciones; ?> </option>
                        							        <?php } ?>
                        							     
                        							      </select> 
                                                          <div id="mensaje_id_entidad_patronal_coordinaciones" class="errores"></div>
                                </div>
                    		    </div>
                    		   
							   
							   <div id="div_otra" style="display: none;">
							   
							    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="nombre_otra_coordinacion" class="control-label">Nombre Otra Coordinación:</label>
                                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="nombre_otra_coordinacion" name="nombre_otra_coordinacion" value="" placeholder="nombre otra coordinación..">
                                                      <div id="mensaje_nombre_otra_coordinacion" class="errores"></div>
                                </div>
            					</div>
							   
                               </div>
							   
                            </div>
							     
								 
							<div class="row">	 
                              <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="fotografia_usuarios" class="control-label">Fotografía:</label>
                                          <input type="file" class="form-control" id="fotografia_usuarios" name="fotografia_usuarios" accept="image/png, .jpeg, .jpg" />
                                          <div id="mensaje_fotografia_usuario" class="errores"></div>
                                    </div>
                    		    </div>
                              
							  
							   <div class="col-lg-offset-3 col-md-offset-3 col-xs-12 col-lg-3 col-md-3 ">
                                 	<div class="form-group">                                 		
                                 		<?php if(isset($resultEdit)){ 
                                 		    $imdata=base64_encode(pg_unescape_bytea($resultEdit[0]->fotografia_usuarios));
                                 		    ?>
                                 		<img class="img-rounded" width="100" height="100" alt="<?php echo $resultEdit[0]->usuario_usuarios;?>" src="data:image/jpg;base64,<?php echo $imdata;?>">
                                 		<?php }?>                                		    
                    
                                 	</div>
                                 </div>
								
							</div>  
                                
                      <?php } } ?>                     
                     
                     	<div class="row">
            			    <div class="col-xs-12 col-md-12 col-md-12 " style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">ACTUALIZAR</button>
            	                </div>
    	        		    </div>
    	        		    
            		    </div>
          		 	
          		 	</form>
    
		 
		 
		 
		 
		 
          </div>
          </div>
          </div>
	     </div>
	    </div>
	   
	  
          
          <!-- TERMINA ACTUALIZACION DE PROPAGANDA  -->
          
          
          
 
 
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
  <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="view/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   
    <script src="view/ServiciosOnline/js/BienvenidaOnline.js?0.46"></script>       
    <script src="view/Administracion/js/Usuarios.js?4.5"></script>       
 	
	
  </body>
</html>
