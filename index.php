<!--  index.php  -->

<?php include("conect.php"); ?>

<?php include('header.php'); ?>

<div class="modal fade" id="addruta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> <!-- ventana modal para añadir ruta -->
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Cerrar</h4>
			</div>
		    <div class="modal-body">	
			  <div class="card card-header"> Introducción nueva ruta </div>
              <div class="card card-body">
                <form action="guardar.php" method="POST" id="form_ruta"  >
                   <div class="form-group">
                   <input type="text" name="inicio" class="form-control" placeholder="localidad inicio de la ruta" autofocus>
			       <input type="number" name="Km" class="form-control" placeholder="Km ruta" max="3000" >
			       <input type="number" name="calificacion" class="form-control" class="number" max="5" placeholder="calificacion" >
			       <input type="number" name="dificultad" class="form-control" placeholder="dificultad" max="5" >
			       <input type="text" name="region" class="form-control" placeholder="region" >
			       <input type="text" name="tipo" class="form-control" placeholder="tipo" >		
			       <input type="number" name="usuario" class="form-control" placeholder="usuario" max="99">			
			       <input type="date" name="fecha"   class="form-control" placeholder="fecha" required>			
                   </div>
                   <div class="form-group"><textarea name="observaciones_ruta" rows="2" class="form-control" placeholder="Escribe aqui relato"></textarea>
		     
                   <input type="submit" name="guardaruta" class="btn btn-success btn-block" value="Guardar ruta">  
		           </div>		  
                </form>			
           </div>	<!-- fin de card body -->			
		 </div>
		</div>
	</div>
</div>     <!-- fin ventana modal para añadir ruta -->

<div> mensaje: <?php echo $_SESSION['message'];   ?></div>

<main class="container p-4">





  <div class="row">    
    <div class="col-md-8">   <!-- Tabla de rutas -->      
      <table id="mitabla" class="display mitabla"> <!--class="table table-bordered""table table-striped table-bordered"> -->
        <thead>
          <tr>
            <th>Km</th>
            <th>fecha</th>
            <th>inicio</th>
            <th>calificación</th>
	        <th>dificultad</th>
            <th>región</th>
           
			
            <th>tipo</th>
		    <th>usuario</th>
            <th>observaciones</th>
			<th></th>
			<th></th>
		    <th></th>
            <th></th>
			<th>        
			<!-- acceso al formulario modal para añadir ruta -->
             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addruta">
	           Añadir ruta  
			 </button> 
			</th>
		  
		  </tr>
		</thead>
        <tbody>

          <?php
          $query = "SELECT * FROM rutas ORDER BY fecha desc";
          $result = mysqli_query($conn, $query); 
         
          while($row = mysqli_fetch_assoc($result)) { 
		  $fecha=date_create($row['fecha']);
		  $fecha=date_format($fecha,'d/m/Y');	  
		  ?>
          <tr>
            <td><?php echo $row['Km']; ?></td>
            <td><?php echo $fecha; ?></td>
            <td><?php echo $row['inicio']; ?></td>
            <td><?php echo $row['calificacion']; ?></td>
            <td><?php echo $row['dificultad']; ?></td>
            <td><?php echo $row['region']; ?></td>
           
            <td><?php echo $row['tipo']; ?></td>
            <td><?php echo $row['usuario']; ?></td>
		    <td><?php echo $row['observaciones_ruta']; ?></td>
      
            <td> <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary"  data-toggle="tooltip" title="Editar esta ruta" > <i class="far fa-edit"></i></a></td>
            <td> <a href="ver_ruta.php?id=<?php echo $row['id']?>" class="btn btn-primary" data-toggle="tooltip" title="Ver esta ruta" > <i class="far fa-eye"></i></a></td>
            <td> <a href="cima.php?id=<?php echo $row['id']?>"     class="btn btn-primary"   data-toggle="tooltip" title="Añadir un monte a esta ruta">  <i class="fa fa-flag"></i></a></td>
            <td> <p class="btn btn-danger" onclick="confirmar(<?php echo $row['id']?>);"   data-toggle="tooltip" title="Borrar esta ruta"> <i class="fas fa-trash-alt"></i></p></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>     <!-- Fin de Tabla de rutas -->		
  </div>
</main>




<script>
//confirmar el borrado
function confirmar(x){
	c=confirm("seguro que quieres borrar?");
	if (c == true) {window.location.href='borrar.php?id='+x;}
	
}

/*
$('#mifecha .input-group.date').datepicker({
    maxViewMode: 3,
    todayBtn: "linked",
    language: "es",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true
});

*/

</script>

<?php include('footer.php'); ?>
