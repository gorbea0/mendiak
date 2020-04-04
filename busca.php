<!-- busca.php  encuentra montes y da el listado de las ocurrencias con las distintas rutas en las que se encuentra-->

<?php

include("header.php");
?>

<h3>Búsqueda de puntos de montes.</h3>
<form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
    <input id="buscar" name="buscar" type="search" placeholder="" autofocus >
    <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
</form>


<?php

//Variable que contendrá el número de resgistros encontrados
$registros = '';

if($_POST['buscar']){	
  $busqueda = addslashes(trim($_POST['buscar']));

  include("conect.php");

  //Consult para la base de datos, se utiliza un comparador LIKE para acceder a todo lo que contenga la cadena a buscar
 $query=   "SELECT a.nombre, a.altitud, a.provincia, a.region, b.ruta, a.id_cima, a.coordenadas FROM cimas a left join chinchetas b on a.id_cima=b.cima
 where a.nombre like '%".$busqueda."%' order by provincia, nombre";
  $res = mysqli_query($conn,$query); 
  mysqli_close($conn);
 //Si hay resultados...
  if (mysqli_num_rows($res) > 0)
  { 
	     // Se recoge el número de resultados
		// $registros = '<p>HEMOS ENCONTRADO ' . mysqli_num_rows($resultado) . ' registros </p>';
	    echo "<table class='table table-hover' > <thead>";
	    echo "<th>ruta</th><th> Id cima </th><th> nombre </th> <th> altitud </th> <th> provincia </th> <th> región </th> <th> link ruta </th><th>link Mendikat </th> <th>link Wikiloc</th></thead>";		
				
	    while($fila = mysqli_fetch_row($res)){ 	 
		echo "<tr>";
		echo "<td> " . $fila[4] . "</td>";    // Id ruta
		echo "<td> " . $fila[5] . "</td>";    // Id cima
		echo "<td> " . $fila[0] . "</td>";    // nombre
		echo "<td> " . $fila[1] . "</td>";    // altitud
		echo "<td> " . $fila[2] . "</td>";    //  provincia
		echo "<td> " . $fila[3] . "</td>";    // region
		echo "<td> " . '<a href="ver_ruta.php?id='.$fila[4].' "> PINCHA <a/>'. "</td>";
		echo "<td> " . '<a href="mendikat.php?id='.$fila[0].' "> PINCHA <a/>'. "</td>";
		//echo "<td> " . '<a href="https://www.mendikat.net/es/com/search/?q='.$fila[0].'"> PINCHA <a/>'. "</td>"; 
		echo "<td> " . '<a href="wikiloc.php?id='.$fila[0].' "> PINCHA <a/>'. "</td>";
		//echo "<td> " . '<a href="https://es.wikiloc.com/wikiloc/map.do?sw=-89.999%2C-179.999&ne=89.999%2C179.999&q='.$fila[4].' &fitMapToTrails=1&page=1"> PINCHA <a/>'. "</td>";
		echo "</tr>";	
	    } echo"</table>";
	  
   }else{   echo "No hay resultados";	  }
 
}

include('footer.php');

?>




