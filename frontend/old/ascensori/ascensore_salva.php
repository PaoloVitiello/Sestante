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

if(isset($_POST['idascensore'])) {
  $idascensore = $_POST['idascensore'];
  $percorso = $_POST['percorso'];
} else {
  // errore!
}

connetti_db();

list($idvideo, $paginazione) = db_query_value("SELECT idvideo, paginazione FROM ascensori WHERE id='$idascensore'");

if(isset($_POST['annulla'])) {
  $percorso=$_POST['annulla'];
  echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$percorso'> </form>";
  echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
  exit();
}

if (isset($_POST['salva'])) {
  $idvideo = $_POST['salva'];
  $idascensore = $_POST['idascensore'];
  $percorso = $_POST['percorso'];

  $vid = db_query_value("UPDATE video SET generatore='http://localhost/ascensori/render_ascensore_html.php?idascensore=$idascensore'  WHERE idvideo='$idvideo'");
  $vid = db_query_value("UPDATE video SET generatore2='http://localhost/ascensori/render_ascensore_html.php?idascensore=$idascensore&negativo=true'  WHERE idvideo='$idvideo'");

  if ($paginazione !== "") {
    $vid = db_query_value("UPDATE video 
                             SET generatore3='http://localhost/ascensori/render_ascensore_html.php?idascensore=$idascensore&page=1'
                             WHERE idvideo='$idvideo'");
    $vid = db_query_value("UPDATE video 
                             SET generatore4='http://localhost/ascensori/render_ascensore_html.php?idascensore=$idascensore&negativo=true&page=1'
                             WHERE idvideo='$idvideo'");
  }

//list($id, $idvideowall, $iddisplaywall, $idvideo, $righe) = $vid;

generate_image($idvideo);
send_image($idvideo);
// chiamate di sistema per generare singolo video positivo e negativo con parametro POST negativo=vero

echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$percorso'> </form>
      <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
}



$vid = db_query_value("SELECT idvideo, piano, descrizione FROM ascensori  WHERE id='$idascensore'");
list($idvideo, $piano, $descrizione) = $vid;


echo "<html><head>";
include "$path/sestante/srv/head.php";
echo "<title> Salva Video </title>";
echo "	
	<style>
	td { vertical-align:top; }
	td.right { text-align:right;}
	input.center{width:200px;}
	</style>
	";
echo "</head><body>";
include "$path/sestante/srv/header.php";
echo "<p class='titolo'>Salva il Video Ascensore id: $idvideo</p>";
if($logged) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right'>Id Video</td><td><input class='lcd' type='text' name='idvideo' readonly value='$idvideo'></td></tr>";
echo "<tr><td class='right'>Piano</td><td><input class='lcd' type='text' readonly value='$piano'></td></tr>";
echo "<tr><td class='right'>Descrizione</td><td><input class='lcd' type='text' readonly value='$descrizione'></td></tr>";
echo "</td> </tr></table>";
echo "<div class='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons' style='border:0;'><tr style='border:0;'>";
echo "<td style='border:0; padding:0;'>";
echo "<td>
<input type='hidden' name='percorso' value='$percorso'>
<input type='hidden' name='idascensore' value='$idascensore'>
<button class='action orange' type='submit' name='salva' value='$idvideo'>Salva</button>";
echo "<button class='action green' type='submit' name='annulla' value='$percorso'>Annulla</button>";
echo "</td></form></tr></table>";
// fine bottoni


}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='idascensore' value='$idascensore'>";
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

