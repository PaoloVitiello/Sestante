

<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include($path."/video/funzioni_video.php");
include "$path/sestante/srv/doctype.php";

//$titolo = array('edit' => "Modifica video", 'crea' => "Crea nuovo video");

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

function imposta_orario() {
  $start = db_query_value("select Valore from sistema where Parametro='PersistenzaStart'");
  $end = db_query_value("select Valore from sistema where Parametro='PersistenzaEnd'");
  list($hh,$mm) = explode(':', $start);
  list($hhend,$mmend) = explode(':', $end);
  setup_cron_job($hh,$mm, $hhend, $mmend);
}


connetti_db();

if (isset($_POST['salva'])) {
   $q = "UPDATE sistema SET Valore = '$_POST[Valore]'  WHERE id = '$_POST[db_id]'";
   $res = mysql_query($q);
   imposta_orario();
   header("Location: /sistema/sistema.php");
}

if (isset($_POST['edit'])) {
  $id=$_POST['edit'];
  $query="SELECT * FROM sistema WHERE Id=$id";
  $result = mysql_query($query);
  while ($riga = mysql_fetch_assoc($result)){
    $db_id = $riga['Id'];
    $parametro = $riga['Parametro'];
    $valore = $riga['Valore'];
    $descrizione = $riga['Descrizione'];
    $pattern = $riga['Pattern'];
    }
  $button_lbl = 'Modifica';
  }

echo "<html><head>";
include($path . "/sestante/srv/head.php");
echo "<title>$titolo[$op]</title>";
echo "<style>
	table { border-collapse:collapse; margin:50px;}
	table tr td { border: solid 1px black; padding:4px;}
	td.right { text-align:right;}
	th {border:0;}
	</style></head><body>";
include($path . "/sestante/srv/header.php");
echo "<!-- Content Start -->";
echo "<p class='titolo'>Modifica Valore</p>";
if($logged) {
echo "<table>";
echo "<tr style='background-color:silver; font-wheight:bold;'><td> Parametro </td><td> Valore </td><td> Descrizione </td><tr>";
echo "<form method='post'>";
echo "<tr><td class='right'>$parametro</td><td><input type='text' name='Valore' value='$valore' autofocus pattern='$pattern'></td><td>$descrizione</td></tr>";
echo "<input type='hidden' name='db_id' value='$db_id'>";
echo "</table>";
// bottoni logged
echo "<table class='buttons'><tr>";
echo "<td><button class='action orange' type='submit' name='salva' value='salva'>Salva</button>";
echo "<button class='action green' type='button' onClick=\"window.location.href='sistema.php'\">Annulla</button>";
echo "</td></tr>";
echo "</form></table>";
//fine bottoni logged
}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
// bottoni not logged
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<input type='hidden' name='edit' value='$db_id'>";
echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/sistema/sistema.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
// fine bottoni not logged
}
echo "<!-- Content End -->";
include($path . "/sestante/srv/footer.php");

?>
