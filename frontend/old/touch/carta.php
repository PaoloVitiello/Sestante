<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once($path."/sestante/srv/config.php");
include_once($path."/sestante/srv/db_helper.php");

connetti_db();


if(isset($_GET['id']) && isset($_GET['stato'])) {
  $id = $_GET['id'];
  $stato = $_GET['stato'];
  $q = "UPDATE touch SET carta='$stato' WHERE id=$id";
  mysql_query($q);
}

// go back home!

?>