<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}


$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include ("$path/sestante/srv/doctype.php");

 
/*
echo "<pre> ---- $idvwall -----";
print_r($_POST);
echo "</pre>";
*/
 
 if(isset($_POST[annulla])) {
   $idvideowall=$_POST[annulla];
   echo "<form id='nobutton' action='videowall.php' method='POST'></form>
		  <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
		  }

if (isset($_POST['edit'])) { $numwall=$_POST['edit'];}

$statmsg="&nbsp;";
connetti_db();

$vid = db_query_value("SELECT * FROM videowall WHERE numero_videowall='$numwall'");
list($idd,
     $numero_videowall,
     $larghezza_display,
     $altezza_display,
     $dimensioni_font,
     $altezza_riga,
     $larghezza_reparto,
     $larghezza_edificio,
     $larghezza_piano,
     $larghezza_stanza,
     $colore_sfondo,
     $sfondo_riga_pari,
     $sfondo_riga_dispari,
     $colore_riga,
     $colore_colonna_edificio,
     $sfondo_colonna_edificio,
     $colore_colonna_piano,
     $sfondo_colonna_piano,
     $colore_colonna_stanza,
     $sfondo_colonna_stanza) = $vid;

if (isset($_POST['salva'])) {
  $q = NULL;
  if ($_POST['salva'] == 'salva') {
    $q = "UPDATE videowall SET
	larghezza_display = '$_POST[larghezza_display]',
	altezza_display = '$_POST[altezza_display]',
	dimensioni_font = '$_POST[dimensioni_font]',
        altezza_riga = '$_POST[altezza_riga]',
	larghezza_reparto = '$_POST[larghezza_reparto]',
	larghezza_edificio = '$_POST[larghezza_edificio]',
	larghezza_piano = '$_POST[larghezza_piano]',
	larghezza_stanza = '$_POST[larghezza_stanza]',
        colore_sfondo = '$_POST[colore_sfondo]',
        sfondo_riga_pari = '$_POST[sfondo_riga_pari]',
        sfondo_riga_dispari = '$_POST[sfondo_riga_dispari]',
        colore_riga = '$_POST[colore_riga]',
        colore_colonna_edificio = '$_POST[colore_colonna_edificio]',
        sfondo_colonna_edificio = '$_POST[sfondo_colonna_edificio]',
        colore_colonna_piano = '$_POST[colore_colonna_piano]',
        sfondo_colonna_piano = '$_POST[sfondo_colonna_piano]',
        colore_colonna_stanza = '$_POST[colore_colonna_stanza]',
        sfondo_colonna_stanza = '$_POST[sfondo_colonna_stanza]'
     WHERE numero_videowall = '$_POST[numwall]'";
  echo $q;
  $res = mysql_query($q);
  
  if($res) { header("Location: videowall.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
  }
}


?>

<html>

<head>
<?php include($path . "/sestante/srv/head.php"); ?>
<title> Modifica Reparto </title>
<style>
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input{padding:0 0 0 4px;}
input.center{width:40px;}
div.help {width:400px; word-wrap: break-word; padding:0 0 0 4px;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>

<body>


<script type="text/javascript" src="/srv/jscolor/jscolor.js"></script>

<?php 
include($path . "/sestante/srv/header.php");
$regdisp="^([1-9][0-9][0-9]|[1-2][0-9][0-9][0-9])$";
$helpdisp=" Il campo e' composto dalle cifre da \"100\" a \"2999\"";
$regfont="[1-9][0-9]";
$helpfont="Il campo e' composto da due cifre da \"10\" a \"99\". Le dimensioni del font determinano l'altezza delle righe del VideoWall e quindi il totale delle righe che possono essere visualizzate ";
$regpix="[1-9][0-9]|[1-9][0-9][0-9]";
$helppix="Il campo e' composto da tre cifre da \"10\" a \"999\"";
$regcolor="([0-9A-F]{6})";
$helpcolor=" Il campo e' di sei caratteri da 000000 a FFFFFF in formato standard";


//echo "<div class='contenuto'>";
echo "<p class=titolo>Modifica Videowall n.$numero_videowall</p>";
if($logged==true) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<tr><td class='right'>Larghezza Display (px):</td><td><input style='width:40px;' class='center' type='text' name='larghezza_display' value='$larghezza_display' autofocus required='required' pattern='$regdisp'></td><td><div class='help'>$helpdisp</div></td></tr>";
echo "<tr><td class='right'>Altezza Display (px):</td><td><input style='width:40px;' class='center' type='text' name='altezza_display' value='$altezza_display'  required='required' pattern='$regdisp'></td><td><div class='help'>$helpdisp</div></td></tr>";
echo "<tr><td class='right'>Dimensioni Font (px):</td><td><input style='width:40px;' class='center' type='text' name='dimensioni_font' value='$dimensioni_font' required='required' pattern='$regfont'></td><td><div class='help'>$helpfont</div></td></tr>";
echo "<tr><td class='right'>Altezza riga (px):</td><td><input style='width:40px;' class='center' type='text' name='altezza_riga' value='$altezza_riga' required='required' pattern='$regpix'></td><td><div class='help'>$helppix</div></td></tr>";
echo "<tr><td class='right'>Larghezza Reparto (px):</td><td><input style='width:40px;' class='center' type='text' name='larghezza_reparto' value='$larghezza_reparto' required='required' pattern='$regpix'></td><td><div class='help'>$helppix</div></td></tr>";
echo "<tr><td class='right'>Larghezza Edificio (px):</td><td><input style='width:40px;' class='center' type='text' name='larghezza_edificio' value='$larghezza_edificio' required='required' pattern='$regpix'></td><td><div class='help'>$helppix</div></td></tr>";
echo "<tr><td class='right'>Larghezza Piano (px):</td><td><input style='width:40px;' class='center' type='text' name='larghezza_piano' value='$larghezza_piano' required='required' pattern='$regpix'></td><td><div class='help'>$helppix</div></td></tr>";
echo "<tr><td class='right'>Larghezza Stanza (px):</td><td><input style='width:40px;' class='center' type='text' name='larghezza_stanza' value='$larghezza_stanza' required='required' pattern='$regpix'></td><td><div class='help'>$helppix</div></td></tr>";
echo "<tr><td class='right'>Colore Sfondo:</td><td><input style='width:80px;' class='color center' type='text' name='colore_sfondo' value='$colore_sfondo' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";
echo "<tr><td class='right'>Sfondo Righe pari:</td><td><input style='width:80px;' class='color center' type='text' name='sfondo_riga_pari' value='$sfondo_riga_pari' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";
echo "<tr><td class='right'>Sfondo Righe dispari:</td><td><input style='width:80px;' class='color center' type='text' name='sfondo_riga_dispari' value='$sfondo_riga_dispari' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";
echo "<tr><td class='right'>Colore Riga:</td><td><input style='width:80px;' class='color center' type='text' name='colore_riga' value='$colore_riga' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";

echo "<tr><td class='right'>Colore Edificio:</td><td><input style='width:80px;' class='color center' type='text' name='colore_colonna_edificio' value='$colore_colonna_edificio' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";
echo "<tr><td class='right'>Sfondo Edificio:</td><td><input style='width:80px;' class='color center' type='text' name='sfondo_colonna_edificio' value='$sfondo_colonna_edificio' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";

echo "<tr><td class='right'>Colore Piano:</td><td><input style='width:80px;' class='color center' type='text' name='colore_colonna_piano' value='$colore_colonna_piano' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";
echo "<tr><td class='right'>Sfondo Piano:</td><td><input style='width:80px;' class='color center' type='text' name='sfondo_colonna_piano' value='$sfondo_colonna_piano' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";

echo "<tr><td class='right'>Colore Stanza:</td><td><input style='width:80px;' class='color center' type='text' name='colore_colonna_stanza' value='$colore_colonna_stanza' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";
echo "<tr><td class='right'>Sfondo Stanza:</td><td><input style='width:80px;' class='color center' type='text' name='sfondo_colonna_stanza' value='$sfondo_colonna_stanza' required='required' pattern='$regcolor'></td><td><div class='help'>$helpcolor</div></td></tr>";

echo "<input type='hidden' name='numwall' value='$numwall'>";
echo "<input type='hidden' name='operazione' value='edit'>";
echo "</table><div id='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons'><tr>";
echo "<td><button class='action red' type='submit' name='salva' value='salva'>Salva</button>";
echo "<button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
echo "</td></tr></form></table>";
// fine bottoni
}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='edit' value='$numwall'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
}
include "$path/srv/footer.php"
?>

</body>
</html>

