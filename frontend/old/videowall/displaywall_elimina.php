<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}


$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";


$statmsg="&nbsp;";

if(isset($_POST[iddisplaywall])) {
  $iddisplaywall=$_POST[iddisplaywall]; $idvideowall=$_POST[idvideowall];
}


if(isset($_POST[annulla])) {
  $idvideowall=$_POST[annulla];
  echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='gestisci' value='$idvideowall'> </form>";
  echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
}


connetti_db();

$vid = db_query_value("SELECT * FROM displaywall  WHERE iddisplaywall='$iddisplaywall'");
list($id, $idvideowall, $iddisplaywall, $idvideo, $righe) = $vid;


if (isset($_POST[salva])) {
  if ($_POST['salva'] == 'salva') {
    $q = "DELETE FROM displaywall WHERE iddisplaywall='$iddisplaywall'";
    $res = mysql_query($q);
    if($res) {
      echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='gestisci' value='$idvideowall'> </form>
      <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
    }
    else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();
    }
  }
}

?>
<html>

<head>
<?php include($path . "/sestante/srv/head.php"); ?>
<title> Edit Video </title>
<style>
td { vertical-align:top; }
td.right { text-align:right;}
input.center{width:200px;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>
<body>
<?php include($path . "/sestante/srv/header.php"); ?>

<?php
echo "<p class='titolo'>Eliminazione del Display n.$iddisplaywall nel VideoWall n.$idvideowall</p>";
if($logged) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right'>Num. VideoWall:</td><td><input class='lcd' type='text' readonly value='$idvideowall'></td></tr>";
echo "<tr><td class='right'>Num. DisplayWall</td><td><input class='lcd' type='text' readonly value='$iddisplaywall'></td></tr>";
echo "<tr><td class='right'>Id Video</td><td><input class='lcd' type='text' readonly value='$idvideo'></td></tr>";
echo "<tr><td class='right'>Righe</td><td><input class='lcd' type='text' readonly value='$righe'></td></tr>";
echo "<input type='hidden' name='iddisplaywall' value='$iddisplaywall'>";
echo "</td> </tr></table>";
echo "<div id='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons' style='border:0;'><tr style='border:0;'>";
echo "<td style='border:0; padding:0;'>";
echo "<td><button class='action red' style='' type='submit' name='salva' value='salva'>Elimina</button>";
echo "<button class='action green' style='' type='submit' name='annulla' value='$idvideowall'>Annulla</button>";
echo "</td></form></tr></table>";
// fine bottoni

}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='edit' value='$iddisplaywall'>";
echo "<input type='hidden' name='idvideowall' value='$idvideowall'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
}

/*
echo "<pre> ---- $idvwall -----";
print_r($_POST);
echo "</pre>";
*/


?>

<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

