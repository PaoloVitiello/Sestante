

<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";


$statmsg="&nbsp;";

if(isset($_POST[idvideowall])) { $idvideowall=$_POST[idvideowall];}

connetti_db();

$vid = db_query_value("SELECT * FROM videowall  WHERE numero_videowall='$idvideowall'");
list($id, $id_wall, $lar_disp, $alt_disp, $dim_font, $lar_rep, $lar_edif, $lar_pia, $lar_sta, $col_sfo, $sfo_testa, $col_testa, $sfo_riga, $col_riga) = $vid;


if (isset($_POST[elimina])) {
$idvideowall=$_POST['elimina'];
$q = "DELETE FROM videowall WHERE numero_videowall='$idvideowall'";
$res = mysql_query($q);

if($res) {
  echo "<form id='nobutton' action='videowall.php' method='POST'></form>
  <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
  }
else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}

echo "<html><head>";
include "$path/sestante/srv/head.php";
echo "<title> Edit Video </title>";
?>
<style>
#modifica {margin-left:50px; border: solid 1px black; padding:4px;}
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

<?php
include "$path/sestante/srv/header.php";
echo "<p class='titolo'>Eliminazione del VideoWall n.$id_wall </p>";
if($logged==true) {
echo "<table id='modifica' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right'>Num. VideoWall:</td><td><input class='lcd' type='text' readonly value='$id_wall'></td></tr>";
echo "<tr><td class='right'>Larghezza  Display (px):</td><td><input class='lcd' type='text' readonly value='$lar_disp'></td></tr>";
echo "<tr><td class='right'>Altezzza Display (px):</td><td><input class='lcd' type='text' readonly value='$alt_disp'></td></tr>";
echo "<tr><td class='right'>Dimensioni Font (px):</td><td><input class='lcd' type='text' readonly value='$dim_font'></td></tr>";
echo "<tr><td class='right'>Larghezza Reparto (px):</td><td><input class='lcd' type='text' readonly value='$lar_rep'></td></tr>";
echo "<tr><td class='right'>Larghezza Edificio (px):</td><td><input class='lcd' type='text' readonly value='$lar_edif'></td></tr>";
echo "<tr><td class='right'>Larghezza Piano (px):</td><td><input class='lcd' type='text' readonly value='$lar_pia'></td></tr>";
echo "<tr><td class='right'>Larghezza Stanza (px):</td><td><input class='lcd' type='text' readonly value='$lar_sta'></td></tr>";
echo "<tr><td class='right'>Colore di Sfondo:</td><td><input class='lcd' type='text' readonly value='$col_sfo'></td></tr>";
echo "<tr><td class='right'>Sfondo Testata:</td><td><input class='lcd' type='text' readonly value='$sfo_testa'></td></tr>";
echo "<tr><td class='right'>Colore Testata:</td><td><input class='lcd' type='text' readonly value='$col_testa'></td></tr>";
echo "<tr><td class='right'>Sfondo Riga:</td><td><input class='lcd' type='text' readonly value='$sfo_riga'></td></tr>";
echo "<tr><td class='right'>Colore Riga:VideoWall:</td><td><input class='lcd' type='text' readonly value='$col_riga'></td></tr>";
echo "</table>";
echo "<input type='hidden' name='iddisplaywall' value='$iddisplaywall'>";
echo "<div id='stato'>$statmsg</div>";
echo "<table class='buttons'><tr>";
echo "<td><button class='action red' type='submit' name='elimina' value='$idvideowall' >Elimina</button>";
echo "<button class='action green'type='button' onclick=\"location.href='videowall.php?idvideowall=$idvideowall';\">Annulla</button>";
echo "</td></form></tr></table>";
}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='idvideowall' value='$idvideowall'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
echo "</td></form></tr></table>";
}

include "$path/sestante/srv/footer.php";

/*
echo "<pre>";
print_r($_POST);
echo "</pre><script> alert('OK'); </script>";
*/

?>

</body>
</html>

