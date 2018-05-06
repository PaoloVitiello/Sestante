<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

if(!empty($_POST['percorso'])) { 
  $percorso=$_POST['percorso'];
}


connetti_db();

$statmsg = '';
if (!empty($_POST['salva'])) {
    $q = "INSERT INTO ascensori (idvideo, piano, percorso, descrizione, dimensione_font, spegnimento) 
          VALUES 	(\"$_POST[idvideo]\",
					\"$_POST[piano]\",
					\"$_POST[percorso]\",
					\"$_POST[descrizione]\",
					\"$_POST[dimensione_font]\",
                                        \"$_POST[spegnimento]\") ";
  $res = mysql_query($q);
//  if($res) { header( "Location:videowall.php?idvideowall=$idvideowall" );}
    if($res) {
    echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$percorso'> </form>
		  <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
		  }

  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Edit Video </title>
<!--
<style>
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:40px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px; color:red}
table.bottom {margin:10px 0 30px 50px; border:0; padding:0;}
table.bottom td {border:0; margin:0; padding:0;}
</style>
-->
</head>
<body>
<?php include($path . "/sestante/srv/header.php"); ?>

<?php

$regid="[0-9]{4}";
$helpid=" L' \"id\" di ciascun video e' composte da quattro cifre da 0000 a 9999";
$regfont="[1-9]|[1-9][0-9]";
$helpfont="La dimensione del font e' composto da due cifre da 01 a 99";
$regpiano="-?([0-9]|[1-9][0-9])";
$helppiano= "Il piano è un numero di massimo due cifre, preceduto opzionalmente dal meno.";
$helpercorso = "Il percorso e' una singola parola senza spazi";
$helpdesc="Descrizione estesa del display, posizione";
$regspegnimento = "[sn]";
$helpspegnimento = "Switch per lo spegnimento notturno [s/n]";

echo "<p class='titolo'>Creazione Nuovi Display Ascensori nel percorso $percorso</p>";
if($logged) {
  echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX> <form method='post'>";

  echo "<tr><td class='right' > IdVideo: </td><td><input class='center' type='text' name='idvideo' value='0000'  pattern='$regid' required='required'></td><td><div class='help' >$helpid</div></td> </tr>";

  echo "<tr><td class=right > Piano: </td><td><input class='center' type='text' name='piano' value='4' pattern='$regpiano'></td><td><div class='help' >$helppiano</div></td> </tr>"; 

  echo "<tr><td class=right > Percorso: </td><td><input class='center' type='text' name='percorso' value='$percorso' required='required'></td><td><div class='help' >$helpercorso</div></td> </tr>"; 

  echo "<tr><td class=right > Descrizione: </td><td><input class='center' type='text' name='descrizione' value='Display'></td><td><div class='help' >$helpdesc</div></td> </tr>"; 

  echo "<tr><td class=right > Dimensione font: </td><td><input class='center' type='text' name='dimensione_font' value='33' pattern='$regfont'></td><td><div class='help' >$helpfont</div></td> </tr>"; 

  echo "<tr><td class=right > Spegnimento: </td><td><input class='center' type='text' name='spegnimento' value='n' pattern='$regspegnimento'></td><td><div class='help' >$helpspegnimento</div></td> </tr>"; 

  echo "<input type='hidden' name='percorso' value='$percorso'>";
  echo "</table>";
  echo "<div id='stato'>$statmsg</div>";
// Bottoni Logged
  echo "<table class='buttons'><tr>";
  echo "<td><button class='action red' type='submit' name='salva' value='salva'> Salva </button>&nbsp;</form></td>";
  echo "<td><form method='POST' action='ascensori.php'>&nbsp;<button class='action green' type='submit' name='gestisci' value='$percorso'>Annnulla</button></td></form>";
  echo"</tr></table>";
// Fine bottoni Logged

} else {

  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  // Bottoni Not Logged
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/sestante/utenti/login.php'>";
  echo "<td><input type='hidden' name='percorso' value='$percorso'>";
  echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><button class='action green' type='button' onClick=\"window.location.href='/ascensori/ascensori.php'\">Annulla</button>";
  echo "</td></form></tr></table>";
// Fine Bottoni Not Logged
}


/*
echo "<pre> ---- $idvideowall -----";
print_r($_POST);
echo "</pre>";
*/

?>
	<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

