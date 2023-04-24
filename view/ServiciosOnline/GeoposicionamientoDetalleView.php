<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Geoposicionamiento</title>
   <?php include("view/modulos/links.php"); ?>
   
		
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/vendors/table-sorter/themes/blue/style.css">
	
	
	
		    <!-- Bootstrap -->
    		<link href="view/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    		<!-- Font Awesome -->
		    <link href="view/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		    <!-- NProgress -->
		    <link href="view/vendors/nprogress/nprogress.css" rel="stylesheet">
		    
		   
		    <!-- Custom Theme Style -->
		    <link href="view/build/css/custom.min.css" rel="stylesheet">
				
			
			<!-- Datatables -->
		    <link href="view/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		 
		   	<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">	

			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script type="text/javascript" src="view/vendors/table-sorter/jquery.tablesorter.js"></script> 
    
    
    
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyDyu4jW-edLYPnTIBRqHtUxisvp3NRVBps"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
       
   
   
   
    <style type="text/css">
		    #mymap {
		      border:1px solid red;
		   
		      height: 600px;
		        width: 100%;
		    }
		  </style>
		  
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php include("view/modulos/logo.php"); ?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
			<?php include("view/modulos/menu_profile.php"); ?>
            <!-- /menu profile quick info -->

            <br />
			<?php include("view/modulos/menu.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php include("view/modulos/head.php"); ?>	
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
      
      
     
      <?php
       
     
      $marcadores ="";
      
        if (!empty($resultSet)) { 
        	
        	$marcadores="[";
        	
        	foreach($resultSet as $res) {
        	
        		$marcadores.="['";
        		$marcadores.=$res->razon_social_clientes."',".$res->lat.",".$res->lng.",'".$res->nombre_cantones."','".$res->formato_direccion_clientes."'],";
        	
         }
         
         $marcadores.="]";
         
         
        }else{ 
          
      	}
          
          
       ?>
     
     
     
       <script type="text/javascript">
    function initialize()  {
    	 
     /* var marcadores = [
				['Quito', -0.1804991, -78.46786299999997],
				['Cayambe', 0.0329091, -78.14970210000001],
				['Quinche', -0.1110111, -78.29494979999998],
				['Guayllabamba', -0.0626176, -78.35128320000001],
				['Carapungo', -0.09430799999999999, -78.4495799],
				['Guayaquil', -2.1709048, -79.9222866],
				['Loja', -4.008115300000001, -79.21077259999998],
				['Manta', -0.9674619999999999, -80.70916249999999],
				['Cuenca', -2.8996687, -79.0058219],
				['Malchingui', 0.0469617, -78.34782339999998],
				['Tabacundo', 0.0460669, -78.20630449999999],
				['Tababela', -0.133943, -78.35849710000002],
				
				
			
      ];*/
      var marcadores = <?php echo $marcadores;?>
     
      
      
      var map = new google.maps.Map(document.getElementById('mymap'), {
        zoom: 7,
        center: new google.maps.LatLng(-1.9438015, -77.99350960000004),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      
      
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map,
         // icon: 'view/images/icon_map.png'
        });
        var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h5 id="firstHeading" class="firstHeading">'+marcadores[i][0]+'</h5>'+
        '<div id="bodyContent">'+
        '<p><b>Cantón: </b>'+marcadores[i][3]+', <b>Parroquia:</b> '+marcadores[i][4]+'.</p>'+
        '</div>'+
        '</div>';
        
        var infowindow = new google.maps.InfoWindow({
         content: contentString,
         maxWidth: 150
         
         });
       
        infowindow.open(map, marker);
  
      }
    
    }
  
    google.maps.event.addDomListener(window, 'load', initialize);
    
    </script>
      
      
      
      
      
       <div style="padding-right: 15px; padding-left: 15px;">
             <div class="col-xs-12 col-md-12 col-lg-12">
             <div class="row">
      			<div id="mymap"></div>
      			
             </div>
		  </div>
		    </div>
      
      
      
      
          
        </div>
     

	
              
            
          </div>
          
          
             
          
           
          
        </div>
       
    
   
    
    <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    
    
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
   
   
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    
    
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    
    
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	
	<!-- codigo de las funciones -->
	
	<script src="view/js/jquery.blockUI.js"></script>
	
	
	
	
	
	 <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		    
	   			});

        	
        	   function pone_espera(){

        		   $.blockUI({ 
        				message: '<h4><img src="view/images/load.gif" /> Espere por favor, estamos procesando su requerimiento...</h4>',
        				css: { 
        		            border: 'none', 
        		            padding: '15px', 
        		            backgroundColor: '#000', 
        		            '-webkit-border-radius': '10px', 
        		            '-moz-border-radius': '10px', 
        		            opacity: .5, 
        		            color: '#fff',
        		           
        	        		}
        	    });
            	
		        setTimeout($.unblockUI, 500); 
		        
        	   }
        	   
        	   
        </script>
        
      
  </body>
</html>
