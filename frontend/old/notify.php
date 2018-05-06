<?php
if(isset($_GET['id'])) {
  $idvideo = $_GET['id'];
  header( "Location: /video/send_image.php?idvideo=$idvideo" ) ; 
}
?>
