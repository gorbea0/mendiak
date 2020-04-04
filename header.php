<!--  header.php -->

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
   
    <title>Proyecto final Ilerna</title>

    <!-- Aqui cargamos la libreria CSS de Bootstrap 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
      
     <!-- Aqui cargamos la libreria CSS para las tablas -->  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
       
    <!-- cargamos los iconos de Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	
	
	<!-- cargamos los estilos para los mapas -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>      

		
	<style>
     body{margin:20px;
	 padding:3;}
	 
	 
	 
    </style>	 

  </head>

  <body>

	
<nav class="navbar navbar-expand-lg  bg-light">     <!-- barra de navegación superior -->
  

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	
	 <li class="nav-item active">
       <button type="button" class="btn btn-primary btn-sm-9" data-toggle="modal" data-target="#sigin">
	    Sig in
       </button>
     </li>
	
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Inicio </a>
      </li>
      
      <li class="nav-item dropdown">     <!-- menu superior desplegable  --> 
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menú </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="add_monte.php">Añadir monte</a>
          <a class="dropdown-item" href="seleccion_zona.php">Ver todos los puntos</a>
          <a class="dropdown-item" href="busca.php">Buscar monte</a>
		  <a class="dropdown-item" href="sube_track.php">Subir tracks</a>
		  <a class="dropdown-item" href="resumen.php">Resumen</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="ign.php">Mapa IGN</a>
		  <a class="dropdown-item" href="suunto.php">Mapa Suunto</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="buscador_aikido.php">Aikido</a>
        </div>
      </li>     <!-- fin menu superior desplegable  --> 
	 <li class="nav-item active">
        Oscar Unzueta  Proyecto fin de estudios Ilerna
     </li>
	  
    </ul>
  </div>
</nav>  <!-- fin de barra superior navegacion  -->



<body>
<!-- ventana modal para hacer login -->    
<div class="modal fade" id="sigin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">cerrar</h4>
			</div>
<div class="modal-body">			
	<div class="container-fluid">     
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Logueate</h5>
            <form class="form-signin" action="index.php" method="POST">
              <div class="form-label-group">
                <input type="text" id="usuario" class="form-control" placeholder="Usuario" required autofocus>
                <label for="inputEmail">Usuario</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="password" class="form-control" placeholder="Contraseña" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Recordar password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <hr class="my-4">

            </form>  <!--  fin formulario de login -->
          </div>
        </div>
      </div>
    </div>    <!--  fin row -->
  </div>  
</body>							
				
</div>
</div>
</div>
</div><!--  fin ventana login -->

<?php
//inicialización variables
$ruta_fotos='/proyectoIlerna/img/fotocima/';
$ruta_track='/proyectoIlerna/tracks/';
?>


