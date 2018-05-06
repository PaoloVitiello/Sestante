<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
//include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

if(isset($_GET["idvideo"])) {$idvideo=$_GET["idvideo"]; }
if(isset($_GET["negativo"])) {$negativo=$_GET["negativo"]=='true'; }
  
  
  echo "<HTML><HEAD>";
  include "$path/sestante/srv/head.php";
  echo "</HEAD><BODY>";

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

//  include($path . "/sestante/srv/header.php");
//  echo "<p class='titolo'> Test del VideoWall n.{$idvideowall}, &nbsp; Display n.$displaywall </p>";
//  echo "<form method='POST'><div><button class='action green' type='submit' name='annulla' value='$idvideowall' style='margin:0 0 0 50px; height:40px; font-size:30px;' autofocus >Chiudi</button></form></div>";
//  echo "<div style=\"margin: 10px 0 0 50px; height:600px; overflow-y:scroll;\">";
//  if(isset($_POST["negativo"])) {$negativo=true;}
  include "$path/sestante/videowall/creaimg.php";
//  echo "</div>";
  ?>
