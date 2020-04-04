<!-- acceso.php  validacion de usuarios-->

<?php
include("conect.php");
if  (isset($_POST['usuario'])) {
  $user = $_POST['usuario'];
  $pass=$_POST['pass'];
  if ($user=='oskar' && $pass=='1234'){
  $_SESSION['rol'] = 'all';
  }
  header('Location: index.php');


?>