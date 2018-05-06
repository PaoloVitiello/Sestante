<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

connetti_db();
$wall = db_query_value("SELECT * FROM videowall WHERE idvideowall='$idvideowall'");
list($idvideo, $ip, $descrizione, $db_id) = $wall;

if(isset($_POST[salva])) {

    $q = "INSERT INTO videowall (
	numero_videowall,
	larghezza_display,
	altezza_display,
	dimensioni_font,
	larghezza_reparto,
	larghezza_edificio,
	larghezza_piano,
	larghezza_stanza,
	colore_sfondo,
        sfondo_riga_pari,
        sfondo_riga_dispari,
        colore_riga,
        colore_colonna_edificio,
        sfondo_colonna_edificio,
        colore_colonna_piano,
        sfondo_colonna_piano,
        colore_colonna_stanza,
        sfondo_colonna_stanza)
    VALUES (
	\"$_POST[numero_videowall]\",
	\"$_POST[larghezza_display]\",
    \"$_POST[altezza_display]\",
    \"$_POST[dimensioni_font]\",
    \"$_POST[larghezza_reparto]\",
    \"$_POST[larghezza_edificio]\",
    \"$_POST[larghezza_piano]\",
    \"$_POST[larghezza_stanza]\",
    \"$_POST[colore_sfondo]\",
        \"$_POST[sfondo_riga_pari]\",
        \"$_POST[sfondo_riga_dispari]\",
        \"$_POST[colore_riga]\",
        \"$_POST[colore_colonna_edificio]\",
        \"$_POST[sfondo_colonna_edificio]\",
        \"$_POST[colore_colonna_piano]\",
        \"$_POST[sfondo_colonna_piano]\",
        \"$_POST[colore_colonna_stanza]\",
        \"$_POST[sfondo_colonna_stanza]\"
	) ";


	$res = mysql_query($q);
  if($res) { header("Location:videowall.php");}
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
#stato {margin:0 0 0 50px; color:red}
</style>
</head>
<body>
<script type="text/javascript" src="/srv/jscolor/jscolor.js"></script>

	<?php include($path . "/sestante/srv/header.php"); ?>

	<?php 

        connetti_db();
        $next_numero = db_query_value("SELECT MAX(numero_videowall)+1 FROM videowall");
        if (!$next_numero) { $next_numero = 1; };

        $regNum="[0-9]{1,2}";
        $helpnum="Il numero del videowall deve essere compreso tra 1 e 99";

	$regcolor="([0-9A-F]{6})";
        $helpcolor=" Il campo e' di sei caratteri da 000000 a FFFFFF in formato standard";

        $regdisp="^([1-9][0-9][0-9]|[1-2][0-9][0-9][0-9])$";
        $helpdisp=" Il campo e' composto dalle cifre da \"100\" a \"2999\"";

        $regfont="[1-9][0-9]";
        $helpfont="Il campo e' composto da due cifre da \"10\" a \"99\". Le dimensioni del font determinano l'altezza delle righe del VideoWall e quindi il totale delle righe che possono essere visualizzate ";

        $regpix="[1-9][0-9]|[1-9][0-9][0-9]";
        $helppix="Il campo e' composto da tre cifre da \"10\" a \"999\"";

	echo "<p class=titolo>Creazione Nuovo VideoWall</p>";
	
if($logged) {
	echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
	echo "<form method='post'>";
	echo "<tr><td class='right' > Num. VideoWall: </td><td><input style='width:30px;' class='center' type='text' name='numero_videowall' value='$next_numero' autofocus pattern='$regNum'></td><td><div class='help' >$helpnum</div></td></tr>";
	echo "<tr><td class='right' > Largh. Display (px): </td><td><input style='width:50px;' 'class='center' type='text' name='larghezza_display' value='1080' pattern='$regdisp'></td><td><div class='help' >$helpdisp</div></td></tr>";
	echo "<tr><td class='right' > Alt. Display (px): </td><td><input style='width:50px; class='center' type='text' name='altezza_display' value='1920' pattern='$regdisp'> </td><td><div class='help' >$helpdisp</div></td>";
	echo "<tr><td class='right' > Font (px): </td><td><input style='width:40px;' class='center' type='text' name='dimensioni_font' value='33' pattern='$regfont' ></td><td><div class='help' >$helpfont</div></td>";
	echo "<tr><td class='right' > Largh. Reparto (px): </td><td><input style='width:40px;' class='center' name='larghezza_reparto' type='text' value='770' pattern='$regpix'></td><td><div class='help' >$helppix</div></td>";
	echo "<tr><td class='right' > Largh. Edificio (px): </td><td><input style='width:40px;' class='center' name='larghezza_edificio' type='text' value='80' pattern='$regpix'></td><td><div class='help' >$helppix</div></td>";
	echo "<tr><td class='right' > Largh. Piano (px): </td><td><input style='width:40px; class='center' type='text' name='larghezza_piano' value='50' pattern='$regpix'></td><td><div class='help' >$helppix</div></td>";
	echo "<tr><td class='right' > Largh. Stanza (px): </td><td><input style='width:40px;' class='center' type='text' name='larghezza_stanza' value='180' pattern='$regpix'></td><td><div class='help' >$helppix</div></td>";

	echo "<tr><td class='right' > Colore Sfondo: </td><td><input style='width:100px;' class='color center' type='text' name='colore_sfondo' value='FFFFFF'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Colore Sfondo righe pari: </td><td><input style='width:100px;' class='color center' type='text' name='sfondo_riga_pari' value='FFFFFF'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Colore Sfondo righe dispari: </td><td><input style='width:100px;' class='color center' type='text' name='sfondo_riga_dispari' value='FFFFFF'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Colore Riga: </td><td><input style='width:100px;' class='color center' type='text' name='colore_riga' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Colore Edificio: </td><td><input style='width:100px;' class='color center' type='text' name='colore_colonna_edificio' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Sfondo Edificio: </td><td><input style='width:100px;' class='color center' type='text' name='sfondo_colonna_edificio' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Colore Piano: </td><td><input style='width:100px;' class='color center' type='text' name='colore_colonna_piano' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Sfondo Piano: </td><td><input style='width:100px;' class='color center' type='text' name='sfondo_colonna_piano' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Colore Stanza: </td><td><input style='width:100px;' class='color center' type='text' name='colore_colonna_stanza' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";
	echo "<tr><td class='right' > Sfondo Stanza: </td><td><input style='width:100px;' class='color center' type='text' name='sfondo_colonna_stanza' value='000000'  pattern='$regcolor'></td><td><div class='help' >$helpcolor</div></td>";

	echo "<input type='hidden' name='db_id' value='$db_id'>";
	echo "<input type='hidden' name='operazione' value='$op'>";
	echo "<tr><td></td><td>
	<button type='submit' class='action red' name='salva' value='salva'> Salva </button> &nbsp;&nbsp; 
	<button type='button' class='action green' onclick=\"location.href='videowall.php';\">Annulla</button></td></tr>
	</form>	</table>
    <div id='stato'>$statmsg</div>";
}
else { 
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
echo "</td></form></tr></table>";
}
	
?>

	
	<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

