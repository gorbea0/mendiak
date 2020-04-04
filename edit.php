<!-- edit.php   editar los datos de la ruta-->


<?php  //hay que poner esto al principio para que funcione el redireccionamiento del header location
ob_start();
?>


<?php
include("conect.php");
include("header.php");

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM rutas WHERE id=$id";
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
	$observaciones_ruta = $row['observaciones_ruta'];
	$fecha = strtotime($fecha);
    $fecha = date('Y-m-d',$fecha);
  }
  
   $query="SELECT cima, ruta from chinchetas where ruta ='".$id."' order by cima";
   $result= mysqli_query($conn, $query);
   echo 'Cimas actuales en esta ruta: ';
    while($row = mysqli_fetch_assoc($result)) { 
	 echo $row['cima'].' , '; 
	}
  
  
  
  
}


if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $inicio= $_POST['inicio'];
  $observaciones_ruta = $_POST['observaciones_ruta'];
  $Km = $_POST['Km'];
  $calificacion = $_POST['calificacion'];
  $dificultad = $_POST['dificultad'];
  $region = $_POST['region'];
  $track = $_POST['track'];
  $tipo = $_POST['tipo'];
  $usuario = $_POST['usuario'];
  $fecha=$_POST['fecha'];
 
 
 // guardar track en la carpeta correspondiente
	if ($_FILES['track']['size']>0){
		alert ("DDD");
    $ruta_origen = $_FILES['track']['tmp_name'];
   // $ruta_final = $_SERVER['DOCUMENT_ROOT'].'/proyectoIlerna/tracks/'.$_FILES['track']['name'];
    $ruta_final = $_SERVER['DOCUMENT_ROOT'].$ruta_track.$_FILES['track']['name'];
	 if ( $_FILES['track']['size']< $max_long ) {
          echo 'Peso correcto';
          if( move_uploaded_file ( $ruta_origen, $ruta_final ) ) {
               echo 'Fichero guardado correctamente';
            }
        }
    }
  $query = "UPDATE rutas set inicio = '$inicio', fecha='$fecha', observaciones_ruta = '$observaciones_ruta' , Km='$Km' ,
  calificacion='$calificacion', dificultad='$dificultad', region='$region', track='$track', tipo='$tipo', usuario='$usuario',
  track='$ruta_final' WHERE id=$id";
  mysqli_query($conn, $query);
  mysqli_close($conn);
  $_SESSION['message'] = 'Actualizado correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>

<div class="card">
  <div class="card-header">
   Edición de datos de ruta
  </div>
  <div class="card-body">
    <h5 class="card-title">Datos ruta</h5>
	<div class="row">   <!-- row -->
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST"  enctype="multipart/form-data" >
        <div class="form-group">	
		 <div class="form-group row">
         <label for="inicio" class="col-sm-2 col-form-label">Inicio</label>
         <div class="col-sm-5"><input type="text" class="form-control" name="inicio" value="<?php echo $inicio; ?>" > </div>
         </div>
		
		 <div class="form-group row">
         <label for="Longitud ruta Km" class="col-sm-2 col-form-label">Longitud ruta en Km</label>
         <div class="col-sm-2"><input type="number" class="form-control" name="Km" value="<?php echo $Km; ?>" > </div>
         </div>	
		 <div class="form-group row">
         <label for="Calificación" class="col-sm-2 col-form-label">Calificación</label>
         <div class="col-sm-2"><input type="number"max="5"  class="form-control" name="calificacion" value="<?php echo $calificacion; ?>" > </div>
         </div>
      
         <div class="form-group row">
         <label for="Dificultad" class="col-sm-2 col-form-label">Dificultad</label>
         <div class="col-sm-2"><input type="number"max="5"  class="form-control" name="dificultad" value="<?php echo $dificultad; ?>" > </div>
         </div>

         <div class="form-group row">
         <label for="region" class="col-sm-2 col-form-label">Región</label>
         <div class="col-sm-5"><input type="text" class="form-control" name="region" value="<?php echo $region; ?>" > </div>
         </div>
         <div class="form-group row">
         <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
         <div class="col-sm-5"><input type="text" class="form-control" name="tipo" value="<?php echo $tipo; ?>" > </div>
         </div>
		
		 <div class="form-group row">
         <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
         <div class="col-sm-3"><input type="number" class="form-control" name="usuario" value="<?php echo $usuario; ?>" > </div>
         </div>
         <div class="form-group row">
         <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
		<!--date_format(date_create($fecha),'d/m/Y'); -->
		 
         <div class="col-sm-3"><input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>" > </div>
         </div>
	    </div>	  <!--  fin de primer form group -->
        <div class="form-group">
		  <input type="file" name="track" class="form-control"  >
		   Observaciones
          <textarea name="observaciones_ruta" class="form-control" cols="20" rows="10"><?php echo $observaciones_ruta;?></textarea>
        </div>  <!--  fin de segundo form group -->
        <button class="btn-success" name="update">Actualizar</button>
		<button class="btn-success" name="cancelar"><a href="index.php">Cancelar</a></button>
      </form>
      </div>
    </div>    <!-- fin de  row -->
  </div>   <!-- fin de card body -->
</div> 
 
	
<?php include('footer.php'); ?>

<?php    //hay que poner esto al final del todo para que funcione el redireccionamiento del header location
ob_end_flush();
?>
