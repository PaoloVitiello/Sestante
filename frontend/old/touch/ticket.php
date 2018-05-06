<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once($path."/sestante/srv/config.php");
include_once($path."/sestante/srv/db_helper.php");

connetti_db();

include_once("funzioni_touch.php");
// include db_helper.php, config.php
// importa $path, $path_img


if(isset($_GET['id'])) {
  $id = $_GET['id'];
  print_ticket($_SERVER['REMOTE_ADDR'], $id);
}

// go back home!

?>