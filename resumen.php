<?php
include("conect.php");
include("header.php");

$_SESSION['message'] = '';
$_SESSION['message_type'] = 'warning';

$query = "SELECT COUNT(*) FROM rutas";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_row($result);
echo' Hay un total de '.$row[0].' rutas.';
$query = "SELECT COUNT(*) FROM cimas";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_row($result);
echo' Hay un total de '.$row[0].' cimas.';
 mysqli_close($conn);
 
 include("footer.php");

 ?>