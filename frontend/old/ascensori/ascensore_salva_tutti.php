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

if(isset($_POST['percorso'])) {
  $percorso = $_POST['percorso'];
} else {
  // errore!
}

connetti_db();

$idascensori = db_query_list("SELECT id FROM ascensori WHERE percorso='$percorso'");

if(isset($_POST['annulla'])) {
  $percorso=$_POST['annulla'];
  echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$percorso'> </form>";
  echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
  exit();
}

if (isset($_POST['salva'])) {
  $percorso = $_POST['salva'];
  $idascensori = db_query_list("SELECT id FROM ascensori WHERE percorso='$percorso'");
  
  foreach($idascensori as $idascensore) {
    list($idvideo, $paginazione) = db_query_value("SELECT idvideo, paginazione FROM ascensori WHERE id=$idascensore");
    $vid = db_query_value("UPDATE video 
                           SET generatore='http://localhost/ascensori/render_ascensore_html.php?idascensore=$idascensore'
                           WHERE idvideo='$idvideo'");
    $vid = db_query_value("UPDATE video 
                           SET generatore2='http://localhost/ascensori/render_ascensore_html.php?idascensore=$idascensore&negativo=true'
                           WHERE idvideo='$idvideo'");
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
  }
echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$percorso'> </form>
      <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
}



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
echo "<p class='titolo'>Salva i Video del percorso: $percorso</p>";
if($logged) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
foreach($idascensori as $idascensore) {
  $idvideo = db_query_value("SELECT idvideo FROM ascensori WHERE id=$idascensore");
  echo "<tr><td class='right'>Id Video</td><td><input class='lcd' type='text' name='idvideo' readonly value='$idvideo'></td></tr>";
}
echo "</td> </tr></table>";
echo "<div class='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons' style='border:0;'><tr style='border:0;'>";
echo "<td style='border:0; padding:0;'>";
echo "<td>
<input type='hidden' name='percorso' value='$percorso'>
<button class='action orange' type='submit' name='salva' value='$percorso'>Salva</button>";
echo "<button class='action green' type='submit' name='annulla' value='$percorso'>Annulla</button>";
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

