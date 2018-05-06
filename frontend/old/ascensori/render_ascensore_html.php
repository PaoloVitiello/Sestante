<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
//include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

if(isset($_GET["idascensore"])) {$idascensore=$_GET["idascensore"]; }
if(isset($_GET["negativo"])) {$negativo=$_GET["negativo"]=='true'; }
if(isset($_GET["page"])) {$page=$_GET["page"];} else {$page=0;}
  
  
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
  include "$path/sestante/ascensori/render_ascensore_table.php";
//  echo "</div>";
  ?>
