<!-- cima.php   añadir una nueva cima a la base de datos se le pasa la ruta con el id-->

<?php  //hay que poner esto al principio para que funcione el redireccionamiento del header location
ob_start();
?>
<?php
include("conect.php");

include("header.php");
if  (isset($_GET['id'])) {
  $ruta = $_GET['id'];
// capturamos el id de la ruta

  $query="SELECT cima, ruta from chinchetas where ruta ='".$ruta."' order by cima";
  $result= mysqli_query($conn, $query);
  echo 'Cimas actuales en esta ruta: ';
   while($row = mysqli_fetch_assoc($result)) { 
    echo $row['cima'].' , '; 
   }

}

if (isset($_POST['update'])) {
       if  (isset($_GET['id'])) {$ruta = $_GET['id'];}
  $cima= $_POST['cima'];
  $dificultad= $_POST['dificultad'];
  $calificacion= $_POST['calificacion'];
  
  $observaciones_cima=$_POST['observaciones_cima'];
 
  // guardar foto en la carpeta correspondiente
				
  $max_long =1024*1024*6;
  $ruta_origen = $_FILES['foto']['tmp_name'];
  $ruta_final = $_SERVER['DOCUMENT_ROOT'].$ruta_fotos.$_FILES['foto']['name'];

  if ( $_FILES['foto']['size']< $max_long  && $_FILES['foto']['size']>0) {
          echo 'Peso correcto';
		   
          if( move_uploaded_file ( $ruta_origen, $ruta_final ) ) {
               echo 'Fichero guardado correctamente';    
            }
    }

  $query = "INSERT INTO chinchetas (cima, dificultad, calificacion, foto, observaciones_cima, ruta) VALUES
  ('$cima', '$dificultad', '$calificacion', '$ruta_final', '$observaciones_cima', '$ruta')";
   
  $result= mysqli_query($conn, $query);
   if(!$result) {
    die("Atención: problema al usar la base de datos. No se ha podido insertar el registro. Revisa que el punto a añadir exista realmente o bien que no hayas metido dos veces el mismo.");
   }  

  mysqli_close($conn);
  $_SESSION['message'] = 'Actualizado correctamente añadiendo punto '.$cima.' a la ruta '.$ruta;
  $_SESSION['message_type'] = 'warning';

 
  header('Location: index.php');
}



// BUSQUEDA

if($_POST['buscar']){	
  $busqueda = addslashes(trim($_POST['buscar']));
 // $query="select  nombre, altitud, provincia, region, pais, id_cima  from cimas WHERE (nombre like '%" .$busqueda. "%') order by provincia";

 $query=   "SELECT a.nombre, a.altitud, a.provincia, a.region, b.ruta, a.id_cima FROM cimas a left join chinchetas b on a.id_cima=b.cima
 where a.nombre like '%".$busqueda."%' order by provincia, nombre";
 
  $res = mysqli_query($conn,$query); 

 //Si hay resultados...
  if (mysqli_num_rows($res) > 0)
  { 
	    echo "<table class='table table-hover' > <thead>";
	    echo "<th> Id cima </th><th> nombre </th> <th> altitud </th> <th> provincia </th> <th> región </th><th>País </th></thead>";		
				
	    while($fila = mysqli_fetch_row($res)){ 	 
		echo "<tr>";
		echo "<td> " . $fila[5] . "</td>";    // Id cima
		echo "<td> " . $fila[0] . "</td>";    // nombre
		echo "<td> " . $fila[1]. "</td>";    // altitud
		echo "<td> " . $fila[2] . "</td>";    //  provincia
		echo "<td> " . $fila[3] . "</td>";    // region
        echo "<td> " . $fila[4] . "</td>";    // pais
		echo "</tr>";	
	    } echo"</table>";  
   }else{   echo "No hay resultados";	  }
 
}


?>

<h3>Búsqueda de puntos de montes.</h3>
<form id="buscador" name="buscador" method="post"  action="<?php  echo 'cima.php?id='.$ruta ?> "   "> 
    <input id="buscar" name="buscar" type="search" placeholder="" autofocus >
    <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
</form>

<div class="container p-4">
  <div class="row">
    <div class="col-md-12 mx-auto">
	  <div class="row">   <!-- row -->
        <form action="cima.php?id=<?php echo $ruta; ?>" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
			 Ruta <?php echo $ruta; ?>                                                                     
			 <div class="form-group row">
			 <label for="cima" class="col-sm-2 col-form-label">Cima</label>
			 <div class="col-sm-5"><input type="number" class="form-control" name="cima"  > </div>
			 </div>
			
			 <div class="form-group row">
			 <label for="Calificacion" class="col-sm-2 col-form-label">Calif.</label>
			 <div class="col-sm-4"><input type="number" max="5" class="form-control" name="calificacion"  > </div>
			 </div>
		  
			 <div class="form-group row">
			 <label for="Dificultad" class="col-sm-2 col-form-label">Dificultad</label>
			 <div class="col-sm-4"><input type="number" max="5" class="form-control" name="dificultad" > </div>
         </div>
		 
	    </div>	
        <div class="form-group">
			Foto
			<input type="file" name="foto" class="form-control"  >
			 Notas
			<textarea name="observaciones_cima" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <button class="btn-success" type="submit" name="update">Actualizar</button>
		<button class="btn-success" name="cancelar"><a href="index.php">Cancelar</a></button>
        </form>
     </div>  <!-- fin de row  -->
	</div>  
  </div>
</div>


<?php include('footer.php'); ?>

<?php    //hay que poner esto al final del todo para que funcione el redireccionamiento del header location
ob_end_flush();
?>