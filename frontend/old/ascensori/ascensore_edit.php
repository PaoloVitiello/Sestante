<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";




if (isset($_POST['annulla'])) {
  $idascensore = $_POST['annulla'];
  $percorso = $_POST['percorso'];
  echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$percorso'> </form>";
  echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
  exit();
}

connetti_db();

if(isset($_POST['edit'])) {
  $idascensore = $_POST['edit'];
  $percorso = $_POST['percorso'];
  $disp = db_query_value("SELECT idvideo, piano, percorso, descrizione, dimensione_font, spegnimento, paginazione
                          FROM ascensori WHERE id='$idascensore' ");
  list($idvideo, $piano, $percorso, $descrizione, $dimensione_font, $spegnimento, $paginazione) = $disp;
}

$statmsg = '';

if (isset($_POST['salva'])) {
  $idascensore = $_POST['idascensore'];
  $q = "UPDATE ascensori SET 
          idvideo         = '$_POST[idvideo]',
          piano           = '$_POST[piano]',
          percorso        = '$_POST[percorso]',
          descrizione     = '$_POST[descrizione]',
          dimensione_font = '$_POST[dimensione_font]',
          spegnimento     = '$_POST[spegnimento]',
          paginazione     = '$_POST[paginazione]'
          WHERE id = '$_POST[salva]'";
  
  $res = mysql_query($q);

  if($res) {
    echo "<form id='nobutton' action='ascensori.php' method='POST'> <input type='hidden' name='percorso' value='$_POST[percorso]'> </form>";
    echo "<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
  } else {
    $statmsg=" ERRORE ".mysql_errno()."---".mysql_error();
  }
}


/*
echo "<pre> -- $idvideowall ---";
print_r($_POST);
echo "</pre>";
*/

?>



<html>
<head>
<?php include($path . "/sestante/srv/head.php"); ?>
<style>
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input{padding:0 0 0 4px;}
input.center{width:40px;}
div.help {width:400px; word-wrap: break-word; padding:0 0 0 4px; display:inline-block;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>
<body>

<?php 
include($path . "/sestante/srv/header.php");
	
$regid="[0-9]{4}";
$helpid=" L' \"id\" di ciascun video e' composte da quattro cifre da 0000 a 9999";
$regfont="[1-9]|[1-9][0-9]";
$helpfont="La dimensione del font e' composto da due cifre da 01 a 99";
$regpiano="-?([0-9]|[1-9][0-9])";
$regspegnimento="[sn]";
$regpaginazione="[0-9]+";
$helppiano= "Il piano è un numero di massimo due cifre, preceduto opzionalmente dal meno.";
$helpercorso = "Il percorso e' una singola parola senza spazi";
$helpdesc="Descrizione estesa del display, posizione";
$helpspegnimento='Switch per lo spegnimento notturno [s/n]';
$helppaginazione='Inserire il piano di inizio della seconda pagina, lasciare il campo vuoto se seconda pagina non necessaria';


echo "<div class='contenuto'>";
echo "<p class=titolo>Modifica del Video Ascensore n.$idascensore del Percorso $percorso</p>";


if($logged==true) {
  echo "<form method='post'>";
  echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";

  echo "<tr>";
  echo "<td class='right' > Id Video: </td>";
  echo "<td><input style='width:40px;' class='center' type='text' name='idvideo' value='$idvideo' required='required' pattern='$regid' ></td>";
  echo "<td><div class='help' >$helpid</div></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td class='right' > Piano: </td>";
  echo "<td><input style='width:20px;' class='center' type='text' name='piano' value='$piano' required='required' pattern='$regpiano'></td>";
  echo "<td><div class='help'>$helppiano</div></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td class='right' > Percorso: </td>";
  echo "<td><input style='width:60px;' class='center' type='text' name='percorso' value='$percorso' required='required'></td>";
  echo "<td><div class='help'>$helpercorso</div></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td class='right' > Descrizione: </td>";
  echo "<td><input style='width:150px;' class='center' type='text' name='descrizione' value='$descrizione' required='required'></td>";
  echo "<td><div class='help'>$helpdesc</div></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td class='right' > Dimensione font: </td>";
  echo "<td><input style='width:20px;' class='center' type='text' name='dimensione_font' value='$dimensione_font' required='required' pattern='$regfont'></td>";
  echo "<td><div class='help'>$helpfont</div></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td class='right' > Spegnimento: </td>";
  echo "<td><input style='width:20px;' class='center' type='text' name='spegnimento' value='$spegnimento' required='required' pattern='$regspegnimento'></td>";
  echo "<td><div class='help'>$helpspegnimento</div></td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td class='right' > Paginazione: </td>";
  echo "<td><input style='width:20px;' class='center' type='text' name='paginazione' value='$paginazione' pattern='$regpaginazione'></td>";
  echo "<td><div class='help'>$helppaginazione</div></td>";
  echo "</tr>";

  echo "</table>";

// buttons logged
  echo "<table class='buttons'>";
  echo " <tr>";
  echo "  <td>";
  echo "   <button class='action red' type='submit' name='salva' value='$idascensore'>Salva</button>";
  echo "   <button class='action green' type='submit' name='annulla' value='$idascensore'>Annulla</button>";
  echo "  </td>";
  echo " </tr>";
  echo "</table>";

  echo "</form>";
// end button logged

} else { 
  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/utenti/login.php'>";
  echo "<td><input type='percorso' name='edit' value='$percorso'>";
  echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><input type='percorso' name='edit' value='$percorso'>";
  echo "<button class='action green' type='button' onClick=\"window.location.href='/sestante/ascensori/ascensori.php'\">Annulla</button>";
  echo "</td></form></tr></table><br>";
}

?>

<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

