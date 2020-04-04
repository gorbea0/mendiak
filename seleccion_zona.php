<!-- seleccion_zona.php   eleger las zonas a representar en el mapa envía datos a ver_todo.php-->

<?php include("header.php"); ?>

<div class="card card-header"> Elige zona a visualizar </div>
<div class="card card-body"  >

<form action="ver_todo.php"   method="POST">
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="Todo"   id="selectall" >
  <label class="form-check-label" > Todo</label>
  <input class="form-check-input" type="checkbox" value="Alava" id="Alava"  name="zona[]">
  <label class="form-check-label" > Alava </label>
  <input class="form-check-input" type="checkbox" value="Vizcaya" id="Vizcaya"   name="zona[]">
  <label class="form-check-label" > Vizcaya</label> 
  <input class="form-check-input" type="checkbox" value="Belluno" id="Belluno"  name="zona[]">
  <label class="form-check-label" > Belluno </label> 
   <input class="form-check-input" type="checkbox" value="Canazei" id="Canazei"  name="zona[]">
  <label class="form-check-label" > Canazei </label> 
  </div>
  <input type="submit" name="enviar" class="boton peque aceptar" value="enviar">
  <input type="button" name="limpiar" id="limpiar"  value="limpiar"> 
 <form>
 </div>
 </div>
 
 <?php include('footer.php'); ?>
 
 <script>
 $("#selectall").on("click", function() { 
 $("input[type=checkbox]").prop("checked", true);
 
});  
 $("#limpiar").on("click", function() { 
 $("input[type=checkbox]").prop("checked", false);
 
});  

 
 </script>
 
