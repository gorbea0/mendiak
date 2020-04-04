
<?php
include("header.php");
if  (isset($_GET['id'])) {
  $id = $_GET['id'];
}
?>


<div>
 
<embed frameborder="0" height="1500" id="iframe" scrolling="yes" src="<?php echo 'https://www.mendikat.net/es/com/search/?q='.$id ?>" type="text/html" width="100%"></embed>

</div>
<?php
include("footer.php");
?>