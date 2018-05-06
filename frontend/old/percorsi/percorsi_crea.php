<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";


connetti_db();

$statmsg = "";
if (isset($_POST['operazione'])) {
  $q = NULL;
  if ($_POST['operazione'] == 'edit') {
    $q = "INSERT into percorsi SET 
	                       attivo = '$_POST[attivo]',
	                       videowall = '$_POST[videowall]',
	                       ascensori = '$_POST[ascensori]',
                               touch =  '$_POST[touch]',
                           reparto = '$_POST[reparto]',
                           reparto_esteso = '$_POST[reparto_esteso]',
                           edificio = '$_POST[edificio]',
                           stanza = '$_POST[stanza]',
                           piano = '$_POST[piano]',
                           percorso = '$_POST[percorso]',
                           dataagg = '$_POST[dataagg]'
						   ";
  }
  
  $res = mysql_query($q);
  if($res) { header("Location: percorsi.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}

?>


<html>
<head>
<?php include($path . "/sestante/srv/head.php"); ?>
<title>Crea Nuovo Reparto</title>
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

<?php 
include($path . "/sestante/srv/header.php");
$regAttivo="[sn]";
$regIp="([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])";
$regId="[0-9]{4}";

$help_attivo=" I valori ammessi sono 's' o 'n'";
$help_videowall = $help_attivo;
$help_ascensori = $help_attivo;
$help_touch = $help_attivo;
$help_reparto = "Nome esteso del reparto";
$help_edificio = "L'edificio e' composto da una o due lettere maiuscole";
$help_piano = "Il piano e' un numero di massimo due cifre e puo' essere preceduto dal segno meno";
$help_stanza = "La stanza e' composta da un massimo di 6 caratteri alfanumerici";
$help_percorso = "Il percorso e' identificato da una singola parola, senza spazi";
$help_data_agg = "Data dell'ultimo aggiornamento";


echo "<p class='titolo'>Crea Nuovo Reparto</p>";
if($logged) {
echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post' id='formpercorso'>";

echo "<tr>"; 
echo "  <td class='right'> Attivo: </td>"; 
echo "  <td> <input style='width:20px;' class='center' type='text' name='attivo' required='required' value='' pattern='$regAttivo' autofocus> </td>"; 
echo "  <td> <div class='help'>$help_attivo</div> </td>"; 
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Videowall: </td>";
echo "<td><input style='width:20px;' class='center' type='text' name='videowall' value=''</td>";
echo "<td><div class='help'>$help_videowall</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Ascensori: </td>";
echo "<td><input style='width:20px;' class='center' type='text' name='ascensori' value=''</td>";
echo "<td><div class='help'>$help_ascensori</div></td>"; 
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Touch: </td>";
echo "<td><input style='width:20px;' class='center' type='text' name='touch' value=''</td>";
echo "<td><div class='help'>$help_touch</div></td>"; 
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Reparto: </td>";
echo "<td><input style='width:400px;' class='center' type='text' name='reparto' value=''</td>";
echo "<td><div class='help'>$help_reparto</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Reparto esteso: </td>";
echo "<td><input style='width:400px;' class='center' type='text' name='reparto_esteso' value=''</td>";
echo "<td><div class='help'>$help_reparto</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Edificio: </td>";
echo "<td><input style='width:40px;' class='center' type='text' name='edificio' value=''</td>";
echo "<td><div class='help'>$help_edificio</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Piano: </td>";
echo "<td><input style='width:20px;' class='center' type='text' name='piano' value=''</td>";
echo "<td><div class='help'>$help_piano</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Stanza: </td>";
echo "<td><input style='width:100px;' class='center' type='text' name='stanza' value=''</td>";
echo "<td><div class='help'>$help_stanza</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Percorso: </td>";
echo "<td><input style='width:100px;' class='center' type='text' name='percorso' value=''</td>";
echo "<td><div class='help'>$help_percorso</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td class='right'> Data Agg.: </td>";
echo "<td><input style='width:60px;' class='center' type='text' name='dataagg' value=''</td>";
echo "<td><div class='help'>$help_data_agg</div></td>";
echo "</tr>";

echo "</table>";
echo " <div id='stato'>$statmsg</div>";
// area bottoni
echo "<table class='buttons'><tr>";
echo "<td><button class='action red' type='submit' name='operazione' value='edit' >Salva</button>";
echo "<button class='action green' type='button' onClick=\"window.location.href='percorsi.php'\">Annulla</button>";
echo "</td></tr></form></table>";
// fine bottoni
}
else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'><td>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='percorsi.php'\">Annulla</button>";
echo "</td></form></tr></table><br><br>";
}
include "$path/srv/footer.php"
?>

</body>
</html>

