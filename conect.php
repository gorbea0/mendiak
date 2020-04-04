<!-- conect.php   conecta con la base de datos -->

<?php
session_start();

$conn = mysqli_connect(
  'localhost',     // nombre servidor de la base datos
  'root',          // nombre del usuario de la base de datos
  'root',          // contraseña de la base de datos
  'proyecto'       // nombre de la base de datos
) or die(mysqli_erro($mysqli));

?>
