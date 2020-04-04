<!-- ver_todo.php  ver todos los waypoints sobre el mapa o al menos los de las zonas elegidas -->
<!-- LLegan las zonas a presentar de la página seleccion_zona.php -->

<?php
include("conect.php");
include("header.php");
$_SESSION['message'] = '';
$_SESSION['message_type'] = 'warning';  
$query= "select * from cimas order by provincia";

$result = mysqli_query($conn, $query);
mysqli_close($conn);   
$x=0;
  while($fila=mysqli_fetch_row($result)){
      $monte[$x][0]=$fila[0];  // id
      $monte[$x][1]=$fila[1];  // nombre
      $monte[$x][2]=$fila[2];  // altitud
	  $monte[$x][3]=$fila[3];   // provincia
	  $monte[$x][4]=$fila[4];   // region
	  $monte[$x][5]=$fila[5];  // pais 
	  $coord[$x]=explode(",",$fila[6]);  //coordenadas geograficas separadas en lat long
	  $x=$x+1;    	
   }
   
 $total_cimas=mysqli_num_rows($result);
 echo $total_cimas." registros."; 
  
 foreach($_POST['zona'] as $selected){    // en el array zona se reciben los nombres de las zonas elegidas
  echo $selected." / ";// Imprime resultados
 }

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.0/dist/leaflet.css" />
<link rel="stylesheet" href="css/leaflet-search.css" />
<link rel="stylesheet" href="css/style_search.css" />
<link rel="stylesheet" href="css/L.Control.MousePosition.css" />

<!--
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css"/>
   <link rel="stylesheet" href="css/Leaflet_files_style.css" />
-->   
   
<style>

#mapa { height: 750px;
width: 99%;
box-shadow: 6px 6px 6px 6px;
 }
 
 
.search-input {
	font-family:Courier
}
.search-input,
.leaflet-control-search {
	max-width:400px;
}


</style>


<div id="mapa">mapa</div>


<!-- Aqui cargamos las librerias Leaflet para gestionar los mapas -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin="">
</script>

<!-- Aqui cargamos las librerias Leaflet para gestionar las búsquedas de topónimos -->
<script src="js/leaflet-search.js"> </script>

<!-- Aqui cargamos las librerias Leaflet para mostrar coordenadas de la posición del cursor -->
<script src="js/L.Control.MousePosition.js"> </script>

<!-- Librerías para subir tracks por el usuario -->
<script src="https://unpkg.com/togeojson@0.16.0"></script>
<script src="https://unpkg.com/leaflet-filelayer@1.2.0"></script>



<!-- <script> src="js/leaflet-search-geocoder.js"  </script>  -->

<script>

var map = L.map('mapa').setView([<?php echo $coord[0][0].",". $coord[0][1] ?>], 6);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoiZ29yYmVhMCIsImEiOiJjazdub2NxdTQwMDVzM21xa2cwNXE1OGRlIn0.whWMRIuAWE1WrP9ce4R6UQ'
	
}).addTo(map);

L.control.scale().addTo(map);


var monte = new Array(<?php echo json_encode($monte); ?>);


var list = new Array(<?php echo json_encode($coord); ?>);


for (var i = 0; i < <?php echo $total_cimas ?>; i++) {
	
 if (monte[0][i][3]=="<?php echo $_POST['zona'][0] ?>" || monte[0][i][3]=="<?php echo $_POST['zona'][1] ?>" || monte[0][i][3]=="<?php echo $_POST['zona'][2] ?>"|| monte[0][i][3]=="<?php echo $_POST['zona'][3] ?>"){
  waypoint= new L.marker([list[0][i][0],list[0][i][1]])     
    .bindPopup(monte[0][i][1])
    .addTo(map);
 } // fin del if
}  // fin del for


	
//muestra las coordenadas del cursor	
L.control.mousePosition({position: 'bottomright'}).addTo(map);


//barra de busqueda
map.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));	//base layer
	
map.addControl( new L.Control.Search({
		url: 'https://nominatim.openstreetmap.org/search?format=json&q={s}',
		jsonpParam: 'json_callback',
		propertyName: 'display_name',
		propertyLoc: ['lat','lon'],
		marker: L.circleMarker([0,0],{radius:30}),
		autoCollapse: true,
		autoType: false,
		minLength: 2
	}) );


// Subir files Leaflet	
var control = L.Control.fileLayerLoad();
   control.loader.on('data:loaded', function (event) {
        // event.layer gives you access to the layers you just uploaded!

        // Add to map layer switcher
        layerswitcher.addOverlay(event.layer, event.filename);
    });
var control = L.Control.fileLayerLoad();
    control.loader.on('data:error', function (error) {
        // Do something usefull with the error!
        console,error(error);
    });
	
	
	(function (window) {
    'use strict';

   

    window.addEventListener('load', function () {
        initMap();
    });
}(window));
	
	
	

	
	
</script>



<?php include('footer.php'); ?>
