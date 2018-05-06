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
include "$path/sestante/srv/doctype.php";

if (isset($_POST['annulla'])) {
  $idascensore = $_POST['annulla'];
  $percorso = $_POST['percorso'];
  echo "<form id='nobutton' action='ascensori.php' method='POST'>";
  echo "  <input type='hidden' name='percorso' value='$percorso'>"; 
  echo "</form>";
  echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
}

if (isset($_POST["idascensore"])) {
  $idascensore = $_POST["idascensore"];
  $percorso = $_POST["percorso"];
} else if (isset($_GET["idascensore"])) {
  $idascensore = $_GET["idascensore"];
}

if (isset($_POST['page'])) {
  $page = $_POST['page'];
} else {
  $page = 0;
}


echo "<HTML><HEAD>";
include "$path/sestante/srv/head.php";
echo "</HEAD><BODY>";


include($path . "/sestante/srv/header.php");
echo "<p class='titolo'> Test del Display Ascensore n.{$idascensore} </p>";
echo "<form method='POST' style='display: table-cell'>";
echo "  <div>";
echo "    <button class='action green' type='submit' name='annulla' value='$idascensore' style='margin:0 0 0 50px; height:40px; font-size:30px;' autofocus >Chiudi</button>";
echo "    <input type='hidden' name='percorso' value='$percorso'>";
echo "  </div>";
echo "</form>";

echo "<form method='POST' style='display: table-cell'>";
echo "  <div>";
echo "    <button class='action green' type='submit' name='idascensore' value='$idascensore' style='margin:0 0 0 50px; height:40px; font-size:30px;' autofocus >Pagina 1</button>";
echo "    <input type='hidden' name='percorso' value='$percorso'>";
echo "    <input type='hidden' name='page' value='0'>";
echo "  </div>";
echo "</form>";

echo "<form method='POST' style='display: table-cell'>";
echo "  <div>";
echo "    <button class='action green' type='submit' name='idascensore' value='$idascensore' style='margin:0 0 0 50px; height:40px; font-size:30px;' autofocus >Pagina 2</button>";
echo "    <input type='hidden' name='percorso' value='$percorso'>";
echo "    <input type='hidden' name='page' value='1'>";
echo "  </div>";
echo "</form>";


echo "<div style=\"margin: 10px 0 0 50px; height:600px; overflow-y:scroll;\">";
$negativo = isset($_POST['negativo']);
include "$path/sestante/ascensori/render_ascensore_table.php";
echo "</div>";

?>
