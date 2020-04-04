<!--  footer.php -->

<!-- Aqui cargamos la libreria Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Aqui cargamos las librerias Bootstrap 4 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
 
<script src="js/bootstrap-datepicker.min.js"></script>
 
 
<!-- Aqui cargamos las librerias Datatable -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


</body>

<script>
$(document).ready(function() {
    $('.mitabla').DataTable( {
 "columns": [
    { "orderable": false, "searchable": false },
    null,
    null,
    null,
    null,
	null,
    null,
 
    null,
	{ "orderable": false, "searchable": false },
    { "orderable": false, "searchable": false },
    { "orderable": false, "searchable": false },
   { "orderable": false, "searchable": false },
	{ "orderable": false, "searchable": false }
  ],
	
  "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "All"]],
		
      "language": {
              search:         "Buscar:",
			  info:           "vemos de _START_ a _END_ de _TOTAL_ ",
              infoEmpty:      "",
              infoFiltered:   "(Filtrado elementos del total  _MAX_)",
              infoPostFix:    "",
			  lengthMenu:    "Mostrar _MENU_ elementos",
			  zeroRecords:    "No hay registros que cumplan el filtro propuesto",
              emptyTable:     "Tabla vacia",
			  
			  paginate: {
                first:      "Primero",
                previous:   "Previo",
                next:       "Siguiente",
                last:       "Ultimo"
				
            },
        }  			     
    } );
} );




</script>


</html>
