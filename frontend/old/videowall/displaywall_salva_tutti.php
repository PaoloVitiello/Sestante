<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}


$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";
include "$path/sestante/video/funzioni_video.php";

$statmsg="&nbsp;";

if(isset($_POST['idvideowall'])) {
  $idvideowall = $_POST['idvideowall'];
} else {
  // errore!
}

connetti_db();

$idsdisplaywall = db_query_list("SELECT id FROM displaywall WHERE idvideowall='$idvideowall'");

if(isset($_POST['annulla'])) {
  $percorso=$_POST['annulla'];
  echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='idvideowall' value='$idvideowall'> </form>";
  echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
  exit();
}

if (isset($_POST['salva'])) {
  $idvideowall = $_POST['salva'];
  $idsdisplaywall = db_query_list("SELECT id FROM displaywall WHERE idvideowall='$idvideowall'");
  
  foreach($idsdisplaywall as $iddisplaywall) {
    $idvideo = db_query_value("SELECT idvideo FROM displaywall WHERE id=$iddisplaywall");
    $vid = db_query_value("UPDATE video SET generatore='http://localhost/videowall/render_videowall_html.php?idvideo=$idvideo'  WHERE idvideo='$idvideo'");
    $vid = db_query_value("UPDATE video SET generatore2='http://localhost/videowall/render_videowall_html.php?idvideo=$idvideo&negativo=true'  WHERE idvideo='$idvideo'");

//list($id, $idvideowall, $iddisplaywall, $idvideo, $righe) = $vid;

generate_image($idvideo);
send_image($idvideo);
// chiamate di sistema per generare singolo video positivo e negativo con parametro POST negativo=vero
  }
echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='idvideowall' value='$idvideowall'> </form>
      <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
}



echo "<html><head>";
include "$path/sestante/srv/head.php";
echo "<title> Salva VideoWall </title>";
echo "	
	<style>
	td { vertical-align:top; }
	td.right { text-align:right;}
	input.center{width:200px;}
	</style>
	";
echo "</head><body>";
include "$path/sestante/srv/header.php";
echo "<p class='titolo'>Salva il Videowall: $idvideowall</p>";
if($logged) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
foreach($idsdisplaywall as $iddisplaywall) {
  $idvideo = db_query_value("SELECT idvideo FROM displaywall WHERE id=$iddisplaywall");
  echo "<tr><td class='right'>Id Video</td><td><input class='lcd' type='text' name='idvideo' readonly value='$idvideo'></td></tr>";
}
echo "</td> </tr></table>";
echo "<div class='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons' style='border:0;'><tr style='border:0;'>";
echo "<td style='border:0; padding:0;'>";
echo "<td>
<input type='hidden' name='idvideowall' value='$idvideowall'>
<button class='action orange' type='submit' name='salva' value='$idvideowall'>Salva</button>";
echo "<button class='action green' type='submit' name='annulla' value='$idvideowall'>Annulla</button>";
echo "</td></form></tr></table>";
// fine bottoni


}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<input type='hidden' name='percorso' value='$percorso'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/ascensori/ascensori.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
}

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "<script> alert('OK'); </script";
*/

?>

<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

