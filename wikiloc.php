
<?php
include("header.php");
if  (isset($_GET['id'])) {
  $id = $_GET['id'];
}
?>


<div>
 
<embed frameborder="0" height="1500" id="iframe" scrolling="yes" src="<?php echo 'https://es.wikiloc.com/wikiloc/map.do?sw=-89.999%2C-179.999&ne=89.999%2C179.999&q='.$id.' &fitMapToTrails=1&page=1' ?>" type="text/html" width="100%"></embed>

</div>
<?php
include("footer.php");
?>