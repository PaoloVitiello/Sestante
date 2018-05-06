<?php
error_reporting(E_ALL | E_STRICT);  
ini_set('display_errors',1);  
ini_set('display_startup_errors',1);  
ini_set('log_errors',1);  
ini_set('log_errors_max_len',0);  
ini_set('ignore_repeated_errors',0);  
ini_set('ignore_repeated_source',0);  
ini_set('report_memleaks',1);  
ini_set('track_errors',1);  
ini_set('error_log','/percorso/file/php_error.log');
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
//include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

if(isset($_POST['annulla'])) {
    $idvideowall=$_POST['annulla'];
    echo "<form id='nobutton' action='videowall.php' method='POST'><input type='hidden' name='gestisci' value='$idvideowall'></form>
		  <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
		  }

if(isset($_POST["idvideo"])) {$idvideo=$_POST["idvideo"]; $displaywall=$_POST["displaywall"]; $idvideowall=$_POST["idvideowall"];}
  
  
  echo "<HTML><HEAD>";
  include "$path/sestante/srv/head.php";
  echo "</HEAD><BODY>";

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

  include($path . "/sestante/srv/header.php");
  echo "<p class='titolo'> Test del VideoWall n.{$idvideowall}, &nbsp; Display n.$displaywall </p>";
  echo "<form method='POST'><div><button class='action green' type='submit' name='annulla' value='$idvideowall' style='margin:0 0 0 50px; height:40px; font-size:30px;' autofocus >Chiudi</button></form></div>";
  echo "<div style=\"margin: 10px 0 0 50px; height:600px; overflow-y:scroll;\">";
  if(isset($_POST["negativo"])) {$negativo=true;} else {$negativo=false;}
  include "$path/sestante/videowall/creaimg.php";
  echo "</div>";
  
  
  ?>
