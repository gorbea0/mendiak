<!-- sube tracks    -->
<?php
include("conect.php");

include("header.php");


if (isset($_POST['update'])) {
 
   // guardar track en la carpeta correspondiente
  $max_long=1024*1024;	
  $ruta_origen = $_FILES['track']['tmp_name'];
  // $ruta_final = $_SERVER['DOCUMENT_ROOT'].'/proyectoIlerna/tracks/'.$_FILES['track']['name'];
  $ruta_final = $_SERVER['DOCUMENT_ROOT'].$ruta_track.$_FILES['track']['name'];
	 if ( $_FILES['track']['size']< $max_long && $_FILES['track']['size']>0 ) {
          echo 'Peso correcto';
		  
          if( move_uploaded_file ( $ruta_origen, $ruta_final ) ) {
               echo 'Fichero guardado correctamente';    
            }
        }
	
  $_SESSION['message'] = 'Actualizado correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}


?>

<h3>Subida de tracks al servidor.</h3>


<div class="container p-4">
  <div class="row">
    <div class="col-md-12 mx-auto">
	  <div class="row">   <!-- row -->
        <form action="sube_track.php" method="POST"  enctype="multipart/form-data">

			Track
			<input type="file" name="track" class="form-control"  >
			
       </div>
        <button class="btn-success" type="submit" name="update">Actualizar</button>
		<button class="btn-success" name="cancelar"><a href="index.php">Cancelar</a></button>
        </form>
     </div>  <!-- fin de row  -->
	</div>  
  </div>
</div>


<?php include('footer.php'); ?>
