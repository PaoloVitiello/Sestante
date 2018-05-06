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

$path=$_SERVER["DOCUMENT_ROOT"];
include "$path/sestante/srv/config.php";
include "$path/sestante/srv/db_helper.php";
include "$path/sestante/srv/login_check.php";
include "$path/sestante/srv/doctype.php";

if (isset($_POST['editdisp'])) {
  $idascensore=$_POST['editdisp'];
  $percorso = $_POST['percorso'];
    echo "<form id='nobutton' action='ascensore_edit.php' method='POST'>
        <input type='hidden' name='percorso' value='$percorso'> 
	<input type='hidden' name='edit' value='$idascensore'> </form>
    <script>document.getElementById('nobutton').submit();</script>";
}

connetti_db();
$percorsi = db_query_list("SELECT DISTINCT percorso 
                           FROM ascensori 
                         UNION 
                           SELECT DISTINCT percorso 
                           FROM percorsi");
?>

<HTML>
<HEAD>
<?php include "$path/sestante/srv/head.php"; ?>

<script>

var pinger_tick = 10000;
var https = new Object();

function httpGet(theUrl)
{
    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

  function pinger(idvideo) {
    var url = "../video/remote.php?idvideo=" + idvideo + "&op=ping";
    https[idvideo] = new XMLHttpRequest();
    https[idvideo].onreadystatechange = function() {
      if (https[idvideo].readyState==4 && https[idvideo].status==200)
	{
	  var ping_element = document.getElementById('ping-status-' + idvideo);
	  if(https[idvideo].responseText.match("pong")) {
	    ping_element.className = 'green';
	  } else {
	    ping_element.className = 'red';
	  }
	}
      if (https[idvideo].readyState==4)   setTimeout(function() {pinger(idvideo);}, pinger_tick);
    };
    https[idvideo].open( "GET", url, true );
    https[idvideo].send( null );
  }

</script>

</HEAD>
<BODY>
<?php include "$path/sestante/srv/header.php"; ?>
<!-- Content Start -->

<div style="margin:50px 50px 30px 50px; font-size:30px;">
Percorsi
</div>
  
<?php

echo "<ul style='margin:20px; font-size: 20px'>";
foreach ($percorsi as $percorso) {
  $percorso = trim(strtolower($percorso));
  if ($percorso) {
    echo "<li style='display: inline; margin-left: 20px;'><a href='?percorso=$percorso'>$percorso</a></li>";
  }
}
echo "</ul>";

$percorso = '';
if (isset($_GET['percorso'])) {
  $percorso = $_GET['percorso']; 
}
if (isset($_POST['percorso'])) {
  $percorso = $_POST['percorso']; 
}


if ($percorso) {

  echo "<div style='margin:50px; font-size:30px;'>";
  echo "Percorso $percorso";
  echo "</div>";

  $q = "SELECT id, idvideo, piano, percorso, descrizione, dimensione_font, spegnimento, paginazione
        FROM ascensori
        WHERE percorso='$percorso'
        ORDER BY piano";
  $ascensori = db_query_list($q);
  //echo "<pre>"; print_r($ascensori); echo "</pre>";

  echo "<table class='tabella'>";
  echo "<tr style=\"font-weight:bold; text-align:center; background-color:silver;\">";
  echo " <td>Id Video</td>";
  echo " <td>ping</td>";
  echo " <td>Piano</td>";
  echo " <td>Percorso</td>";
  echo " <td>Descrizione</td>";
  echo " <td>Dim. font</td>";
  echo " <td>Spegn.</td>";
  echo " <td>Pagin.</td>";
  echo " <td colspan='4'>Azione</td>"; 
  echo " <td colspan='3'>Gestione</td>";
  echo "</tr>";

  foreach($ascensori as $ascensore) {
    list($id, $idvideo, $piano, $percorso, $descrizione, $font, $spegnimento, $paginazione) = $ascensore;
    
    echo "<tr style=\"height:auto; background-color:white;\">";
    echo "<td >$idvideo</td>";
    echo "<td id='ping-status-$idvideo' class='orange'>&nbsp;</td>";
    echo "<td >$piano</td>";
    echo "<td >$percorso</td>";
    echo "<td width='200px'>$descrizione</td>";
    echo "<td >$font</td>";
    echo "<td >$spegnimento</td>";
    echo "<td >$paginazione</td>";

    echo "<td>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='percorso' value='$percorso'>";
    echo "<button class='action orange' type='submit' name='editdisp' value='$id'>Modifica</button>";
    echo "</form>";
    echo "</td>";

    echo "<td>";
    echo "<form method='POST' action='ascensore_elimina.php'>";
    echo "<input type='hidden' name='percorso' value='$percorso'>";
    echo "<button class='action red' type ='submit' name='idascensore' value='$id'>Elimina</button>";
    echo "</form>";
    echo "</td>";

    echo "<td>";
    echo "<form method='POST' action='ascensore_preview.php'>";
    echo "<input type='hidden' name='idascensore' value='$id'>";
    echo "<button class='action green' type='submit' name='percorso' value='$percorso' >Test</button>";
    echo "</form>";
    echo "</td>";

    echo "<td>";
    echo "<form method='POST' action='ascensore_salva.php'>";
    echo "<input type='hidden' name='percorso' value='$percorso'>";
    echo "<button class='action orange' type=submit' name='idascensore' value='$id'>Salva</button>";
    echo "</form>";
    echo "</td>";


    echo "<td>";
    echo "<button class='action red' onclick='httpGet(\"../video/remote.php?idvideo=$idvideo&op=reboot\")'>Reboot</button>";
    echo "</td>";

    echo "<td>";
    echo "<button class='action green' onclick='httpGet(\"../video/remote.php?idvideo=$idvideo&op=video_on\")'>Monitor ON</button>";
    echo "</td>";

    echo "<td>";
    echo "<button class='action orange' onclick='httpGet(\"../video/remote.php?idvideo=$idvideo&op=video_off\")'>Monitor OFF</button>";
    echo "</td>";

    echo "</tr>";

    echo "<script>setTimeout(function () {pinger('$idvideo');}, 100);</script>";
  }

  echo "</table>";
  echo "<table class='buttons'>";
  echo "<tr>";
  echo "<form method='POST' action='ascensore_crea.php'>";
  echo "<td>";
  echo "<button class='action orange' type='submit' name='percorso' value='$percorso'>Crea Nuovo Display Ascensore</button>";
  echo "</td>";
  echo "</form>";

  echo "<form method='POST' action='ascensore_salva_tutti.php'>";
  echo "<td>";
  echo "<button class='action orange' type='submit' name='percorso' value='$percorso'>Salva tutti display del percorso</button>";
  echo "</td>";
  echo "</form>";


  echo"</tr>";
  echo "</table>";

  echo "<br>";
}

?>


<!-- Content End -->
<?php include "$path/sestante/srv/footer.php"; ?>
</BODY>
</HTML>
