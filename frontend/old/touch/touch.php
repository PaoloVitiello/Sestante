<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true; $username=$_SESSION['sess_username']; }
if(isset($_SESSION['sess_is_admin'])) { $is_admin=$_SESSION['sess_is_admin']; }

$path=$_SERVER["DOCUMENT_ROOT"];
include "$path/sestante/srv/config.php";
include "$path/sestante/srv/db_helper.php";
include "$path/sestante/srv/login_check.php";
include "$path/sestante/srv/doctype.php";


echo "<HTML><HEAD>";
include "$path/sestante/srv/head.php";

?>

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

  function pinger(touchid) {
    var url = "../touch/remote.php?idtouch=" + touchid + "&op=ping";
    https[touchid] = new XMLHttpRequest();
    https[touchid].onreadystatechange = function() {
      if (https[touchid].readyState==4 && https[touchid].status==200)
	{
	  var ping_element = document.getElementById('ping-status-' + touchid);
	  if(https[touchid].responseText.match("pong")) {
	    ping_element.className = 'green';
	  } else {
	    ping_element.className = 'red';
	  }
	}
      if (https[touchid].readyState==4)   setTimeout(function() {pinger(touchid);}, pinger_tick);
    };
    https[touchid].open( "GET", url, true );
    https[touchid].send( null );
  }

</script>


<?php
echo "</HEAD><BODY>";
include "$path/sestante/srv/header.php";
echo
"<!-- Content Start -->
<p class='titolo'>Gestione Touchscreen</p>";


//echo "<div class='contenuto'>";

if ($logged) {
  if ($is_admin) {

    connetti_db();
    $q = "SELECT id, descrizione, ip, carta FROM touch ORDER BY id";
    $touchs = db_query_list($q);
    

    echo "<table class='tabella'>";
    echo "<tr style='background-color:silver; font-weight:bold; text-align:center;'>";
    echo "<td>id</td> <td>ping</td> <td>descrizione</td> <td>host</td> <td>carta</td> <td colspan='2'>Azione</td> <td>Gestione</td>";
    echo "</tr>";

    foreach ($touchs as $touch) {
      list($touchid, $descrizione, $ip, $carta) = $touch;
      echo "<tr>";
      echo "<td style='padding:10px;'>$touchid</td>"; 
      echo "<td id='ping-status-$touchid' class='orange'>&nbsp;</td>";
      echo "<td style='padding:10px;'>$descrizione</td>";
      echo "<td style='padding:10px;'>$ip</td>";
      
      if($carta) {
	$col = 'green';
      } else {
	$col = 'red';
      }
	echo "<td style='color:$col; font-size:30px; text-align:center;'>&bull;</td>";

      
      echo " <form method='POST' action='touch_edit.php'>";
      echo "  <input type='hidden' name='touchid' value='$touchid'>";
      echo "  <td>";
      echo "   <button class='action orange' type='submit' name='file' value='touch.php'>Modifica</button>";
      echo "  </td>";
      echo " </form>";

      echo " <form method='POST' action='touch_elimina.php'>";
      echo "  <input type='hidden' name='touchid' value='$touchid'>";
      echo "  <td>";
      echo "  <button class='action red' type ='submit' name='file' value='touch.php'>Elimina</button>";
      echo "  </td>";
      echo " </form>";

      echo "<td>";
      echo "<button class='action red' onclick='httpGet(\"../touch/remote.php?idtouch=$touchid&op=reboot\")'>Reboot</button>";
      echo "</td>";

      echo "</tr>";
      echo "<script>setTimeout(function () {pinger('$touchid');}, 100);</script>";
    }

    echo "</table>";
    echo "<div class='generic'><button class='action orange' id='crea' type='button' onClick=\"location.href='touch_crea.php'\">";
    echo "Crea Nuovo Touchscreen";
    echo "</button></div><br><br>";

  } else {

    echo "<div class='alert'>";
    echo "La gestione utenti &egrave; riservata agli utenti amministratori.";
    echo "</div><br>";
    echo "<div class='generic'><button class='action green' type='button' onClick=\"window.location.href='/sestante/home/home.php'\">Annulla</button></div><br>";

  }
}
else {
  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/utenti/login.php'>";
  echo "<td><input type='hidden' name='user' value='$username'>";
  echo "<td><input type='hidden' name='level' value='$level'>";
  echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><button class='action green' type='button' onClick=\"location.href='/sestante/home/home.php'\">Annulla</button>";
  echo "</td></form></tr></table><br>";
  }
//echo "</div> <!-- Content End -->";
include "$path/sestante/srv/footer.php";
echo "</BODY></HTML>";
?>