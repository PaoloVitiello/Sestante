<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

$id = $_GET['id'] or '';

connetti_db();
$vid = db_query_value("SELECT id, attivo, reparto, percorso, categoria, edificio, piano, stanza, dataagg FROM percorsi WHERE id='$id'");
list($id, $attivo, $reparto, $percorso, $tipo, $edificio, $piano, $stanza, $dataagg) = $vid;


if (isset($_POST['operazione']) && ($_POST['operazione'] == 'elimina')) {
  $q = "DELETE FROM percorsi WHERE Id='$id'";
  $res = mysql_query($q);
  if($res) { header("Location: percorsi.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Elimina percorso </title>
<style>
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:200px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px;}
</style>
</head>
<body>
<?php include "$path/sestante/srv/header.php";
echo "<p class=titolo>Eliminazione del Percorso</p>";
if($logged) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right' > Attivo: </td><td><input class='lcd center' readonly type='text' name='attivo' value='$attivo'/td></tr>";
echo "<tr><td class='right' > Reparto: </td><td><input class='lcd center' readonly type='text' name='ip' value='$reparto'</td></tr>";
echo "<tr><td class='right' > Edificio: </td><td><input class='lcd center' readonly type='text' name='ip' value='$edificio'></td></tr>";
echo "<tr><td class='right' > Piano: </td><td><input class='lcd center' readonly type='text' name='ip' value='$piano'</td></tr>";
echo "<tr><td class='right' > Stanza: </td><td><input class='lcd center' readonly type='text' name='ip' value='$stanza'</td></tr>";
echo "<tr><td class='right' > Data Agg.: </td><td><input class='lcd center' readonly type='text' name='ip' value='$dataagg'</td></tr>";
echo "<input type='hidden' name='db_id' value='$db_id'>";
//echo "<input type='hidden' name='operazione' value='elimina'>";
//echo "<tr><td></td><td><button class='action red' type='submit'>Elimina</button>&nbsp;&nbsp; <button class='action green' type='button' onclick=\"location.href='percorsi.php';\">Annulla</button></td> </tr>";
echo "</table> <div id='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons'><tr>";
echo "<td><button class='action red' type='submit' name='operazione' value='elimina' >Elimina</button>";
echo "<button class='action green' type='button' onClick=\"window.location.href='percorsi.php'\">Annulla</button>";
echo "</td></tr></form></table>";
// fine bottoni
}
else{
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'><td>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='percorsi.php'\">Annulla</button>";
echo "</td></form></tr></table>";
}
?>
    <p id="debug"></p>
	</table>
    <div id='stato'><?php echo $statmsg;?></div>
	<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

