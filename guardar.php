<!-- guardar.php     guarda ruta-->


<?php

include('conect.php');

if (isset($_POST['guardaruta'])) {
  $Km = $_POST['Km'];
  $fecha = $_POST['fecha'];
  $inicio = $_POST['inicio'];
  $calificacion = $_POST['calificacion'];
  $dificultad = $_POST['dificultad'];
  $region = $_POST['region'];
 
  $tipo = $_POST['tipo'];  
  $usuario = $_POST['usuario'];
  $observaciones_ruta = $_POST['observaciones_ruta'];
  // modifico formato de fecha de acuerdo a lo que necesita mySQL
  $fecha = strtotime($fecha);
  $fecha = date('Y-m-d',$fecha);

  // proceso de track
  
  // guardar track en la carpeta correspondiente
  $max_long=1024*1024;	
  $ruta_origen = $_FILES['track']['tmp_name'];
  // $ruta_final = $_SERVER['DOCUMENT_ROOT'].'/proyectoIlerna/tracks/'.$_FILES['track']['name'];
  $ruta_final = $ruta_fotos.$_FILES['track']['name'];
	 if ( $_FILES['track']['size']< $max_long && $_FILES['track']['size']>0 ) {
          echo 'Peso correcto';
		  
          if( move_uploaded_file ( $ruta_origen, $ruta_final ) ) {
               echo 'Fichero guardado correctamente';    
            }
        }
	
  $query = "INSERT INTO rutas (Km, fecha, inicio, calificacion, dificultad, region, tipo, usuario, observaciones_ruta, track) VALUES 
                           ('$Km', '$fecha', '$inicio', '$calificacion', '$dificultad', '$region', '$tipo', '$usuario', '$observaciones_ruta', '$ruta_final')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Atención: problema al usar la base de datos.");
  }
  mysqli_close($conn);
  $_SESSION['message'] = 'Datos guardados en la BBDD';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>
