<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path=$_SERVER["DOCUMENT_ROOT"];
include "$path/sestante/srv/config.php";
include "$path/srv/login_check.php";
include "$path/sestante/srv/doctype.php";


?>

<script>

var button;
var progressbar;
var timerID;

function start() {
    button = document.getElementById("start");
    save_button = document.getElementById("start_save");
    progressbar = document.getElementById("bar");
    save_progressbar = document.getElementById("savebar");
    timerID = setInterval(leggi_progresso, 1000);
}



var start_invio_httpreq;
function start_invio()
{
  var url = "/video/send_all_images_async.php";
  start_invio_httpreq = new XMLHttpRequest();
  start_invio_httpreq.onreadystatechange = callback_start_invio;
  start_invio_httpreq.open("GET", url, true);
  start_invio_httpreq.send();
}
function callback_start_invio()
{
  if (start_invio_httpreq.readyState == 4 && start_invio_httpreq.status == 200) {
    button.disabled = true;
  } else {
    button.disabled = false;
  }
}


var start_save_httpreq;
function start_save()
{
  var url = "/video/save_all_images_async.php";
  start_save_httpreq = new XMLHttpRequest();
  start_save_httpreq.onreadystatechange = callback_save_invio;
  start_save_httpreq.open("GET", url, true);
  start_save_httpreq.send();
}
function callback_save_invio()
{
  if (start_save_httpreq.readyState == 4 && start_save_httpreq.status == 200) {
    button.disabled = true;
  } else {
    button.disabled = false;
  }
}


var progress_httpreq;
var progress_save_httpreq;
function leggi_progresso()
{
  var url = "/video/status_invio.php";
  progress_httpreq = new XMLHttpRequest();
  progress_httpreq.onreadystatechange = callback_progresso;
  progress_httpreq.open("GET", url, true);
  progress_httpreq.send();

  var url = "/video/status_save.php";
  progress_save_httpreq = new XMLHttpRequest();
  progress_save_httpreq.onreadystatechange = callback_progresso_save;
  progress_save_httpreq.open("GET", url, true);
  progress_save_httpreq.send();

}
function callback_progresso()
{
  if (progress_httpreq.readyState == 4 && progress_httpreq.status == 200) {
    var progresso = JSON.parse(progress_httpreq.response);
    if (progresso.timestamp == 0) {
      progressbar.value = 0;
      button.disabled = false;
    } else {
      progressbar.max = progresso.totale;
      progressbar.value = progresso.progresso;
      button.disabled = !(progresso.totale == progresso.progresso);
    }
  } else {
    //controllare stato errore
    //button.disabled = false;
  }
}

function callback_progresso_save()
{
  if (progress_save_httpreq.readyState == 4 && progress_save_httpreq.status == 200) {
    var progresso = JSON.parse(progress_save_httpreq.response);
    if (progresso.timestamp == 0) {
      save_progressbar.value = 0;
      save_button.disabled = false;
    } else {
      save_progressbar.max = progresso.totale;
      save_progressbar.value = progresso.progresso;
      save_button.disabled = !(progresso.totale == progresso.progresso);
    }
  } else {
    //controllare stato errore
    //button.disabled = false;
  }
}


</script>

<?php
echo "<HTML><HEAD>"; 
include "$path/sestante/srv/head.php";
echo "<style>";
echo "progress {-webkit-appearance: none;}";
echo "progress::-webkit-progress-value { background:gray; }";
echo "progress::-webkit-progress-bar { 	background-image: url('/img/barre.gif'); border: solid 1px gray;}";
echo "</style>";
echo "</HEAD><BODY onload='start()'>";
include "$path/sestante/srv/header.php";
echo "<!-- Content Start -->";
echo "<p class='titolo'> Stato di Avanzamento dell'Aggiornamento dei Video</p>";
echo "<div class='contenuto'><br><br>";

echo "<progress id='savebar' value='0' style='width:800px;'></progress><br><br>";
if($logged) {
	echo "<button id='start_save' class='action red' name='salva' value='salva' onclick='start_save()'> Salva tutti i video </button>";
}


echo "<br><br><br><br>";

echo "<progress id='bar' value='0' style='width:800px;'></progress><br><br>";
if($logged) {
	echo "<button id='start' class='action red' name='aggiorna' value='aggiorna' onclick='start_invio()'> Aggiorna tutti i video </button>";
}
echo "</div><br><br>";

if(!$logged) {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
// bottoni not logged
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<input type='hidden' name='edit' value='$db_id'>";
echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/sestante/home/home.php'\">Annulla</button>";
echo "</td></form></tr></table><br><br>";
// fine bottoni not logged
}
echo "<!-- Content End -->";
include "$path/sestante/srv/footer.php";
?>
</BODY>
</HTML>
