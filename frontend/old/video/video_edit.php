<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

$descrizione='';
connetti_db();

if(isset($_POST['idvideo'])) {$id=$_POST['idvideo'];}

$vid = db_query_value("SELECT idvideo, ip, descrizione, generatore, id 
                       FROM video WHERE idvideo='$id'");
list($idvideo, $ip, $descrizione, $generatore, $db_id) = $vid;

if (isset($_POST['salva'])) {
  if ($_POST['operazione'] == 'edit') {
  $q = NULL;
    $q = "UPDATE video SET idvideo = '$_POST[idvideo]',
                           ip = '$_POST[ip]',
                           descrizione = '$_POST[descrizione]',
                           generatore = '$_POST[generatore]'
          WHERE id = '$_POST[db_id]'";
  }
  echo "<script> alert('ok'); </script>";
  $res = mysql_query($q);
  if($res) { header("Location: video.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Edit Video </title>
<style>
#modifica {margin: 0 0 20px 50px; border: solid 1px black; padding:4px;}
#titolo { margin:50px; font-size: 30px;}
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:200px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>
<body>

<?php include($path . "/sestante/srv/header.php"); ?>

<?php
  //$regIp="([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])";
$regIp="^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$";
$regId="[0-9]{4}";
$helpid=" L' \"id\" di ciascun video e' composte da quattro cifre da 0000 a 9999";
$helpip=" Inserire indirizzo IP o nome host del video, max 253 caratteri";
$helpdes="Il campo descrizione deve contenere testo informativo che indichi posizione e funzione del video e/o altre caratteristiche a discrezione dell'amministratore di sistema";
echo "<p class='titolo'>Modifica dei Video</p>";
if($logged) {
echo "<table id='modifica' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right' > idvideo: </td><td><input class='center' type='text' name='idvideo' value='$idvideo' pattern='$regId' autofocus >";
echo "</td><td><div class='help' >$helpid</div></td></tr>";
echo "<tr><td class='right' > ip: </td><td><input class='center' type='text' name='ip' value='$ip' pattern='$regIp'>";
echo "</td><td><div class='help' >$helpip</div></td> </tr>";
echo "<tr><td class='right' > descrizione: </td><td><textarea name='descrizione' rows='5'>$descrizione</textarea><td><div class='help'>$helpdes</div></td>";
echo "<input type='hidden' name='db_id' value='$db_id'>";
echo "<input type='hidden' name='operazione' value='edit'>";
echo "</table>";
echo "<div id='stato'>$statmsg</div>";

// bottoni logged
echo "<table class='buttons'><tr>";
echo "<td><button class='action orange' type='submit' name='salva' value='salva'>Salva</button>";
echo "<button class='action green' type='button' onClick=\"window.location.href='/sestante/video/video.php'\">Annulla</button>";
echo "</td></tr></form></table>";
//fine bottoni logged
}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
// bottoni not logged
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<input type='hidden' name='idvideo' value='$idvideo'>";
echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/sestante/video/video.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
// fine bottoni not logged
}

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

include "$path/sestante/srv/footer.php";
?>

</body>
</html>

