

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

if(isset($_POST['idvideo'])) {$id=$_POST['idvideo'];}

connetti_db();
$vid = db_query_value("SELECT idvideo, ip, descrizione, generatore, id 
                       FROM video WHERE idvideo='$id'");
list($idvideo, $ip, $descrizione, $generatore, $db_id) = $vid;

if (isset($_POST) && ($_POST['operazione'] == 'elimina')) {
  $q = "DELETE FROM video WHERE idvideo='$id'";
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
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:200px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>
<body>

<?php
include "$path/sestante/srv/header.php";
echo "<p class=titolo>Eliminazione dei Video</p>";
if($logged) {
echo "<table class=tabella cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right' > idvideo: </td><td><input class='lcd center' readonly type='text' name='idvideo' value='$idvideo'>";
echo "</td></tr>";
echo "<tr><td class='right' >ip:</td><td><input class='lcd center' readonly type='text' name='ip' value='$ip'>";
echo "</td></tr>";
echo "<tr><td class='right' > descrizione: </td><td><textarea class='lcd' readonly name='descrizione' rows='5'>$descrizione</textarea>";
echo "<input type='hidden' name='db_id' value='$db_id'>";
echo "<input type='hidden' name='operazione' value='elimina'>";
echo "</table>  <div id='stato'>$statmsg</div>";

// bottoni logged
echo "<table class='buttons'><tr>";
echo "<td><button class='action red' type='submit' name='elimina' value='elimina'>Elimina</button>";
echo "<button class='action green' type='button' onClick=\"window.location.href='/sestante/video/video.php'\">Annulla</button>";
echo "</td></tr></form></table>";
//fine bottoni logged
}
else{
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

