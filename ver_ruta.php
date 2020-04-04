<!-- ver_ruta.php   ver los datos de la ruta y el mapa sin poder alterarlos -->

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.0/dist/leaflet.css" />


<link rel="stylesheet" href="css/L.Control.MousePosition.css" />

<style>
#map { height: 800px;
width: 99%;
box-shadow: 6px 6px 6px 6px;
 }
</style>

<?php
include("conect.php");
include("header.php");
$coord[0][0]="42.79371";  // inicializo para el centrado del mapa por si nu hubiera ningún marcados
$coord[0][1]="-2.755";
$_SESSION['message'] = '';
$_SESSION['message_type'] = 'warning';
if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM rutas WHERE id=$id order by fecha desc";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
	$fecha = $row['fecha'];
	$inicio = $row['inicio'];
	$calificacion = $row['calificacion'];
	$Km = $row['Km'];
	$dificultad = $row['dificultad'];
	$region = $row['region'];
	$usuario = $row['usuario'];
	$tipo=$row['tipo'];
	$observaciones_ruta = $row['observaciones_ruta'];
	$fecha_original=$fecha;
	$fecha_ingles = strtotime($fecha);
    $fecha = date('Y-m-d',$fecha_ingles);
  }
  
    $query= "select coordenadas, nombre, altitud, provincia, region, pais, dificultad, calificacion, observaciones_cima, 
    foto from cimas a, chinchetas b where a.id_cima=b.cima and ruta='$id'";

    $result = mysqli_query($conn, $query);
  
    echo '<div class="container">
    <h2>Montes de la ruta</h2>
    <p>Este es el listado de las cimas alcanzadas en esta ruta nº'.$id.'</p>            
    <table class="table table-hover">
    <thead>';
    echo "<th> Cima </th>";
    echo "<th> Altitud </th>";
    echo "<th> Provincia </th>";
    echo "<th> Región </th>";
    echo "<th> País </th>";
    echo "<th> Dificultad </th>";
    echo "<th> Calificación </th>";
    echo "<th> Notas </th>";
    echo "<th> Foto </th>";
    echo "</thead>";
  
    $x=0;
    while($fila=mysqli_fetch_row($result)){
	 
	  echo "<tr>";
	 
	  $monte[$x][1]=$fila[1]; echo "<td> " . $fila[1] . "</td>";  //nombre
      $monte[$x][2]=$fila[2]; echo "<td> " . $fila[2] . "</td>";   //altitud
	  $monte[$x][3]=$fila[3]; echo "<td> " . $fila[3] . "</td>";   // provincia
	  $monte[$x][4]=$fila[4]; echo "<td> " . $fila[4] . "</td>";   // region
	  $monte[$x][5]=$fila[5]; echo "<td> " . $fila[5]. "</td>";    // pais
	  $monte[$x][6]=$fila[6]; echo "<td> " . $fila[6] . "</td>";   //dificultad
	  $monte[$x][7]=$fila[7]; echo "<td> " . $fila[7] . "</td>";   //calificacion
	  $monte[$x][8]=$fila[8]; echo "<td> " . $fila[8]. "</td>";    //observaciones
	  $monte[$x][9]=$fila[9];
	  if ($_SESSION['rol'] <> 'all') { echo "<td> foto no autorizada</td>";}else {
	  echo "<td> " ."<a href='". $fila[9]. "'>foto</a></td>";  //foto
	  }
	  
	  $coord[$x]=explode(",",$fila[0]);  //coordenadas geograficas separadas en lat long
	 
	  $x=$x+1;
	  echo "</tr>";
    }
   echo "</table>";
   $total_cimas=mysqli_num_rows($result);
   echo $total_cimas." registros."; 
   mysqli_close($conn);
}


// Abrimos la carpeta de tracks
$path= "tracks/";
$directorio = opendir($path);
$total_tracks=0;
 // Leemos todos los ficheros de la carpeta, los tracks
while ($elemento = readdir($directorio)){
 if( $elemento != "." && $elemento != "..")	{	    
  if (substr($elemento, 0, 10)==$fecha_original){   $track_name[$total_tracks]="tracks/".$elemento;   $total_tracks=$total_tracks+1;  }
   }       
 }


?>


<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Datos de la ruta
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">  <!-- primer grupo  -->
	   <div class="form-group row">
         <label for="inicio" class="col-sm-2 col-form-label">Inicio</label>
         <div class="col-sm-5"><input type="text" class="form-control" name="inicio" value="<?php echo $inicio; ?>"  disabled > </div>
       </div>	
	   <div class="form-group row">
         <label for="Longitud ruta Km" class="col-sm-2 col-form-label">Longitud ruta en Km</label>
         <div class="col-sm-3"><input type="number" class="form-control" name="Km" value="<?php echo $Km; ?>"  disabled > </div>
       </div>
	   <div class="form-group row">
         <label for="Calificación" class="col-sm-2 col-form-label">Calificación</label>
         <div class="col-sm-2"><input type="number" class="form-control" name="calificacion" value="<?php echo $calificacion; ?>"  disabled > </div>
       </div>
       <div class="form-group row">
         <label for="Dificultad" class="col-sm-2 col-form-label">Dificultad</label>
         <div class="col-sm-2"><input type="number" class="form-control" name="dificultad" value="<?php echo $dificultad; ?>"  disabled > </div>
       </div>
    </div>
  </div>   <!-- fin del primer grupo -->
  
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Más datos de la ruta
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">  <!-- segundo grupo -->
      <div class="card-body">
         <div class="form-group row">
           <label for="region" class="col-sm-2 col-form-label">Región</label>
           <div class="col-sm-5"><input type="text" class="form-control" name="region" value="<?php echo $region; ?>"  disabled> </div>
         </div>
         <div class="form-group row">
           <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
           <div class="col-sm-5"><input type="text" class="form-control" name="tipo" value="<?php echo $tipo; ?>"  disabled > </div>
         </div>
		 <div class="form-group row">
           <label for="track" class="col-sm-2 col-form-label">Track</label>

		   <div id="mytrack">  </div>
		<?php
		if ($total_tracks>0){
		for ($i=0;$i<$total_tracks;$i++){
		echo $track_name[$i]."<p><a href='". $track_name[$i]."'>.....download</a><p>";
		}
		}
		else echo "No hay registros de track para esta ruta";
		?>
		 
         </div>
		 <div class="form-group row">
           <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
           <div class="col-sm-3"><input type="number" class="form-control" name="usuario" value="<?php echo $usuario; ?>"  disabled> </div>
         </div>
         <div class="form-group row">
           <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
           <div class="col-sm-3"><input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>"  disabled> </div>
         </div>
      </div>
    </div>   <!-- fin de segundo grupo   -->
  
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Otros datos
		<button class="btn-success" name="cancelar"><a href="index.php">Volver</a></button>
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">   <!-- tercer grupo  -->
      <div class="card-body">
        <div class="form-group">
		   Notas
          <textarea name="observaciones_ruta" class="form-control" cols="30"  disabled rows="10"><?php echo $observaciones_ruta;?></textarea>
        </div>          
      </div>
    </div>     <!-- fin de tercer grupo -->
  </div>
</div>
</div>
<?php
 // muestra las coordenadas de las cimas en pantalla
for ($x=0;$x<$total_cimas;$x++){
echo $coord[$x][0].",". $coord[$x][1]."    /  ";}
echo "total ".$total_tracks." track"; 
?>

<div id="map">mapa</div>

<!-- Aqui cargamos las librerias Leaflet para gestionar los mapas -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin="">
</script>

<!-- Aqui cargamos las librerias Leaflet via cdn para gestionar los tracks -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.4.0/gpx.min.js"></script>


<!-- Aqui cargamos las librerias Leaflet para gestionar las búsquedas de topónimos -->
<script src="js/leaflet-search.js"> </script>



<!-- Aqui cargamos las librerias Leaflet para mostrar coordenadas de la posición del cursor -->
<script src="js/L.Control.MousePosition.js"> </script>



<script>

// Creo objeto mapa
var map = L.map('map').setView([<?php echo $coord[0][0].",". $coord[0][1] ?>], 13);
 L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoiZ29yYmVhMCIsImEiOiJjazdub2NxdTQwMDVzM21xa2cwNXE1OGRlIn0.whWMRIuAWE1WrP9ce4R6UQ'
}).addTo(map);

L.control.scale().addTo(map);   // añado escala al mapa


if (<?php echo $total_cimas ?>>0){
	
var monte = new Array(<?php echo json_encode($monte); ?>);

var list = new Array(<?php echo json_encode($coord); ?>);

var marker;

for (var i = 0; i < <?php echo $total_cimas ?>; i++) {
  marker = new L.marker([list[0][i][0],list[0][i][1]])     
    .bindPopup(monte[0][i][1])
    .addTo(map);
} // fin del for

} // fin del if


//TRACKS

if (<?php echo $total_tracks?> >0){
  var mistrack = <?php echo json_encode($track_name); ?>;

  mistrack=mistrack.toString();

  var track = mistrack.split(',');

  for (var i = 0; i < <?php echo $total_tracks ?>; i++) {

	  url=track[i].toString();

	  new L.GPX(url, {
	   async: true,
	   marker_options: {
		 startIconUrl: 'css/icon/pin-icon-start.png',
		 endIconUrl: 'css/icon/pin-icon-end.png',
		 shadowUrl: 'css/icon/pin-shadow.png',
		 wptIconUrl: 'css/icon/pin-icon-wpt.png'
					   }
	                }).on('loaded', function(e) {
	   map.fitBounds(e.target.getBounds());
	                                            }).addTo(map);

	                                                    }  //fin del for
} else alert( "No hay tracks asociados a esta ruta.");







	//muestra las coordenadas del cursor	
L.control.mousePosition({position: 'bottomright'}).addTo(map);



</script>





<?php include('footer.php'); ?>
