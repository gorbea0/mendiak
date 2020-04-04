<!-- borrar.php -->

<?php

include("conect.php");

if(isset($_GET['id'])) {
		
  $id = $_GET['id'];
  $query = "DELETE FROM rutas WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Fallo de consulta BBDD.");
  }
  mysqli_close($conn);
  $_SESSION['message'] = 'Borrado correcto del id '.$id;
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}

?>
