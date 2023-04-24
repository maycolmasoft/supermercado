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
    
    
    
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBe-ifv_oYGMq-0yieYQK0CnqW8gKscBgM"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
       
   
   
   
    <style type="text/css">
		    #mymap {
		      border:1px solid red;
		   
		      height: 600px;
		        width: 100%;
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


    
    
     
      <?php
       
     
      $marcadores ="";
      
        if (!empty($resultSet)) { 
        
            
        	$marcadores="[";
        	
        	foreach($resultSet as $res) {
        	
        		$marcadores.="['";
        		$marcadores.=$res->razon_social."',".$res->latitud.",".$res->logitud.",'".$res->usuario_usuarios."','".$res->direccion."'],";
        	
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
        zoom: 16,
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
        '<h5 id="firstHeading" class="firstHeading"><b>Local: </b>'+marcadores[i][0]+'</h5>'+
        '<div id="bodyContent">'+
        '<p><b>Usuario: </b>'+marcadores[i][3]+', '+marcadores[i][4]+'.</p>'+
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
     

	
              
            
         
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   
       
      
  </body>
</html>
