<!-- add_monte.php   añadir monte -->


<?php  //hay que poner esto al principio para que funcione el redireccionamiento del header location
ob_start();
?>


<?php
include("conect.php");

include("header.php");
if  (isset($_GET['id'])) {
  $id = $_GET['id'];
}

if (isset($_POST['update'])) {
  $nombre = $_POST['nombre'];  //en base de datos gestiona nombres unicos
  $altitud= $_POST['altitud'];
  $provincia= $_POST['provincia'];
  $region= $_POST['region'];
  $pais=  $_POST['pais'];
  $coordenadas=$_POST['coordenadas'];

  $query = "INSERT INTO cimas (nombre, altitud, provincia, region, pais, coordenadas) VALUES
  ('$nombre', '$altitud', '$provincia', '$region', '$pais', '$coordenadas')";
  $result=mysqli_query($conn, $query);
  if(!$result) {
    die("Atención: problema al usar la base de datos. No se ha podido insertar el registro. Revisa que el nombre no esté ya metido.");
   }  

  mysqli_close($conn);
  $_SESSION['message'] = 'Añadido correctamente el monte '.$nombre;
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
 
}

?>

<div class="container p-4">
  <div class="row">
  <div class="col-md-12 mx-auto">
	  <div class="row">   <!-- inicio row --> 
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
        <div class="form-group">
		  Añadir nuevo monte<?php echo $_GET['id']; ?>
		 <div class="form-group row">
         <label for="nombre" class="col-sm-6 col-form-label">Nombre</label>
         <div class="col-sm-10"><input type="text" class="form-control" name="nombre" required> </div>
         </div>
		 <div class="form-group row">
         <label for="altitud" class="col-sm-2 col-form-label">Altitud</label>
         <div class="col-sm-10"><input type="number" max="8848" class="form-control" name="altitud"  > </div>
         </div>
         <div class="form-group row">
         <label for="provincia" class="col-sm-4 col-form-label">Provincia</label>
         <div class="col-sm-10"><input type="text"  class="form-control" name="provincia"> </div>
         </div>
		  <div class="form-group row">
         <label for="region" class="col-sm-2 col-form-label">Región</label>
         <div class="col-sm-10"><input type="text" class="form-control" name="region"> </div>
         </div>
		 <div class="form-group row">
         <label for="pais" class="col-sm-2 col-form-label">Pais</label>
         <div class="col-sm-10"><input type="text"  class="form-control" name="pais"> </div>
         </div>
		 <div class="form-group row">
         <label for="coordenadas" class="col-sm-2 col-form-label">Coord</label>

         <div class="col-sm-10"><input type="text"  class="form-control" name="coordenadas" title="latitud,longitud"  pattern="[-]?[0-9]*[.][0-9]*[,][-]?[0-9]*[.][0-9]*"> </div>
         </div>
	    </div>	
        <button class="btn-success" name="update">Añadir</button>
		<button class="btn-success" name="cancelar"><a href="index.php">Cancelar</a></button>
     </form>
     </div>  <!-- fin de row -->
  </div>  
  </div>
  </div>


<?php include('footer.php'); ?>

<?php    //hay que poner esto al final del todo para que funcione el redireccionamiento del header location
ob_end_flush();
?>