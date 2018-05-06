<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

//TODO sanitize parameters
$op = $_GET['op'] or '';
$id = $_GET['id'] or '';

if(isset($_POST['file'])) {
$id=$_POST['id'];
}

connetti_db();

$query = "SELECT * from videowall WHERE numero_videowall='1'";
$result = mysql_query($query);
$row=array();
while ($riga = mysql_fetch_assoc($result)){
	$row[]=$riga;
    }

	
$vid = db_query_value("SELECT id, attivo, reparto, reparto_esteso, 
                              percorso, categoria, edificio, piano, 
                              stanza, dataagg, ascensori, videowall, 
                              touch, telefono, orario, orario2
                       FROM percorsi WHERE id='$id'");
list($id_percorso, $attivo, $reparto, $reparto_esteso, $percorso, 
     $categoria, $edificio, $piano, $stanza, $dataagg, $ascensori,
     $videowall, $touch, $telefono, $orario, $orario2) = $vid;

if (!empty($_POST)) {
  $q = NULL;
  if ($_POST['operazione'] == 'edit') {
  $Qattivo = mysql_real_escape_string($_POST['attivo']);
  $Qascensori = mysql_real_escape_string($_POST['ascensori']);
  $Qvideowall = mysql_real_escape_string($_POST['videowall']);
  $Qtouch = mysql_real_escape_string($_POST['touch']);
  $Qreparto = mysql_real_escape_string($_POST['reparto']);
  $Qreparto_esteso = mysql_real_escape_string($_POST['reparto_esteso']);
  $Qedificio = mysql_real_escape_string($_POST['edificio']);
  $Qstanza = mysql_real_escape_string($_POST['stanza']);
  $Qpiano = mysql_real_escape_string($_POST['piano']);
  $Qpercorso = mysql_real_escape_string($_POST['percorso']);
  $Qdataagg = mysql_real_escape_string($_POST['dataagg']);
  $Qtelefono = mysql_real_escape_string($_POST['telefono']);
  $Qorario = mysql_real_escape_string($_POST['orario']);
  $Qorario2 = mysql_real_escape_string($_POST['orario2']);
    $q = "UPDATE percorsi SET attivo = '$Qattivo',
                           ascensori = '$Qascensori',
                           videowall = '$Qvideowall',
                           touch     = '$Qtouch',
                           reparto = '$Qreparto',
                           reparto_esteso = '$Qreparto_esteso',
                           edificio = '$Qedificio',
                           stanza = '$Qstanza',
                           piano = '$Qpiano',
                           percorso = '$Qpercorso',
                           dataagg = '$Qdataagg',
                           telefono = '$Qtelefono',
                           orario = '$Qorario',
                           orario2 = '$Qorario2'
          WHERE id = '$_POST[db_id]'";
        $res = mysql_query($q);
	if($res) { 
	  $url = 'percorsi.php?';
	  if (isset($_POST['flt_id'])) $url .= '&flt_id='. urlencode($_POST['flt_id']);
	  if (isset($_POST['flt_attivo'])) $url .= '&flt_attivo='. urlencode($_POST['flt_attivo']);
	  if (isset($_POST['flt_videowall'])) $url .= '&flt_videowall='. urlencode($_POST['flt_videowall']);
	  if (isset($_POST['flt_ascensori'])) $url .= '&flt_ascensori='. urlencode($_POST['flt_ascensori']);
	  if (isset($_POST['flt_touch'])) $url .= '&flt_touch='. urlencode($_POST['flt_touch']);
	  if (isset($_POST['flt_reparto'])) $url .= '&flt_reparto='. urlencode($_POST['flt_reparto']);
	  if (isset($_POST['flt_repartoesteso'])) $url .= '&flt_repartoesteso='. urlencode($_POST['flt_repartoesteso']);
	  if (isset($_POST['flt_edificio'])) $url .= '&flt_edificio='. urlencode($_POST['flt_edificio']);
	  if (isset($_POST['flt_piano'])) $url .= '&flt_piano='. urlencode($_POST['flt_piano']);
	  if (isset($_POST['flt_stanza'])) $url .= '&flt_stanza='. urlencode($_POST['flt_stanza']);
	  if (isset($_POST['flt_percorso'])) $url .= '&flt_percorso='. urlencode($_POST['flt_percorso']);

	  header("Location: $url");
        }
	else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
	}
}
/*
echo "<pre>";
print_r($row);
echo "</pre>";
*/
?>


<html>
<head>
<?php include($path . "/sestante/srv/head.php"); ?>
<title> Modifica Reparto </title>
<style>
td { vertical-align:top;}
td.right { text-align:right;}
input{padding:0 0 0 4px;}
input.center{width:40px;}
div.help {width:400px; word-wrap: break-word; padding:0 0 0 4px;}
#stato {margin:0 0 0 50px; color:red;}
</style>


</head>
<body>

<script>
function copy(testo) {
document.getElementById('dest').innerHTML=decodeURI(testo);
}
</script>

	<?php 
	include($path . "/sestante/srv/header.php");
	$regatt="[sn]";
	$helpatt="I valori accettati sono \"s\" o \"n\"";
	$helprep="Accertarsi sul display che il nome del reparto sia di lunghezza adatta alla completa visualizzazione";
	$regedi="[A-Z]{1,2}";
	$helpedi="Gli edifici devono essere inseriti con un massimo di due lettere maiuscole da 'A' a 'Z'";
	$regpia="(-?[1-9]?[0-9])";
	$helppia="I piani devono essere inseriti con un numero compreso tra '-9' e '99' ";
	$helpsta="Le stanze devono essere inserite ciascuna come una parola, senza spazi. Possono essre inserite piu' stanze separate da uno spazio, ma sara' comunque visualizzata solo la prima stanza";
	$help_percorso = "I perscorsi sono indicati da una singola parola, senza spazi.";

    echo  "<p class=titolo>Modifica Reparto</p>";
	if($logged==true) {
	foreach($row as $value ) {
	extract($value);
	$reparto_encoded=htmlspecialchars($reparto,ENT_QUOTES);
	$reparto_esteso_encoded=htmlspecialchars($reparto_esteso,ENT_QUOTES);

	echo "<table style='table-layout:fixed; display:block; border:solid 1px;; width:{$larghezza_reparto}px; margin:50px; font-family:Montserrat; font-size:{$dimensioni_font}px;' cellspacing='0'>";
	echo "<tr style='height:40px; width:{$larghezza_reparto}px;' >";
	echo "<td id='dest' class='lcd' style='width:{$larghezza_reparto}px;'>$reparto_encoded</td></tr></table>";
	}
	echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
	echo "<form method='post' id='formpercorso'>";

	echo "<tr><td class='right'> Attivo: </td><td><input style='width:20px;' class='center' type='text' name='attivo' value='$attivo' pattern='$regatt' autofocus ></td>
		<td><div class='help'> $helpatt </div></td></tr>";

	echo "<tr><td class='right'> Videowall: </td><td><input style='width:20px;' class='center' type='text' name='videowall' value='$videowall' pattern='$regatt'></td>
		<td><div class='help'> $helpatt </div></td></tr>";

	echo "<tr><td class='right'> Ascensori: </td><td><input style='width:20px;' class='center' type='text' name='ascensori' value='$ascensori' pattern='$regatt'></td>
		<td><div class='help'> $helpatt </div></td></tr>";

	echo "<tr><td class='right'> Touchscreen: </td><td><input style='width:20px;' class='center' type='text' name='touch' value='$touch' pattern='$regatt'></td>
		<td><div class='help'> $helpatt </div></td></tr>";


	echo "<tr><td class='right'> Reparto: </td><td><input id='source' style='width:600px;' class='center' type='text' name='reparto' value='$reparto_encoded' onkeyup='copy(encodeURI(this.value))'></td><td><div class='help' > $helprep </div></td></tr>";
	echo "<tr><td class='right'> Reparto esteso: </td><td><input id='source' style='width:600px;' class='center' type='text' name='reparto_esteso' value='$reparto_esteso_encoded'></td><td><div class='help' > $helprep </div></td></tr>";


	echo "<tr><td class='right'> Edificio: </td><td><input style='width:40px;' class='center' type='text' name='edificio' value='$edificio' pattern='$regedi' ></td><td><div class='help'>$helpedi<div></td></tr>";
	echo "<tr><td class='right' > Piano: </td><td><input style='width:20px;' class='center' type='text' name='piano' value='$piano' pattern='$regpia'></td><td><div class='help' >$helppia</div></td></tr>";

	echo "<tr><td class='right' > Stanza: </td><td><input style='width:200px;' class='center' type='text' name='stanza' value='$stanza'></td><td><div class='help' >$helpsta</div></td></tr> "; 

	echo "<tr><td class='right' > Percorso: </td><td><input style='width:200px;' class='center' type='text' name='percorso' value='$percorso'></td><td><div class='help' >$help_percorso</div></td></tr>"; 

	echo "<tr><td class='right'> Telefono: </td>";
	echo "<td><textarea rows=4 cols=30 name='telefono' form='formpercorso'>$telefono</textarea></td>";
	echo "<td>Numero di telefono del reparto.</td></tr>";

	echo "<tr><td class='right'> Orario: </td>";
	//echo "<td><input style='width:400px;' class='center' type='text' name='orario' value='$orario'></td>";
	echo "<td> <textarea rows=4 cols=30 name='orario' form='formpercorso'>$orario</textarea>";
	echo "     <textarea rows=4 cols=30 name='orario2' form='formpercorso'>$orario2</textarea> </td>";
	echo "<td>Orari del reparto. Due colonne. </td></tr>";
	  

	echo "<tr><td>";
	echo "<input type='hidden' name='db_id' value='$id_percorso'>";
	echo "<input type='hidden' name='operazione' value='edit'>"; 

	$annulla_path = "percorsi.php?";
	if (isset($_GET['flt_id'])) {
	  echo "<input type='hidden' name='flt_id' value='$_GET[flt_id]'>";
	  $annulla_path .= "&flt_id=$_GET[flt_id]";
	}
	if (isset($_GET['flt_attivo'])) {
	  echo "<input type='hidden' name='flt_attivo' value='$_GET[flt_attivo]'>";
	  $annulla_path .= "&flt_attivo=$_GET[flt_attivo]";
	}
	if (isset($_GET['flt_videowall'])) {
	  echo "<input type='hidden' name='flt_videowall' value='$_GET[flt_videowall]'>";
	  $annulla_path .= "&flt_videowall=$_GET[flt_videowall]";
	}
	if (isset($_GET['flt_ascensori'])) {
	  echo "<input type='hidden' name='flt_ascensori' value='$_GET[flt_ascensori]'>";
	  $annulla_path .= "&flt_ascensori=$_GET[flt_ascensori]";
	}
	if (isset($_GET['flt_touch'])) {
	  echo "<input type='hidden' name='flt_touch' value='$_GET[flt_touch]'>";
	  $annulla_path .= "&flt_touch=$_GET[flt_touch]";
	}
	if (isset($_GET['flt_reparto'])) {
	  echo "<input type='hidden' name='flt_reparto' value='$_GET[flt_reparto]'>";
	  $annulla_path .= "&flt_reparto=$_GET[flt_reparto]";
	}
	if (isset($_GET['flt_repartoesteso'])) {
	  echo "<input type='hidden' name='flt_repartoesteso' value='$_GET[flt_repartoesteso]'>";
	  $annulla_path .= "&flt_repartoesteso=$_GET[flt_repartoesteso]";
	}
	if (isset($_GET['flt_edificio'])) {
	  echo "<input type='hidden' name='flt_edificio' value='$_GET[flt_edificio]'>";
	  $annulla_path .= "&flt_edificio=$_GET[flt_edificio]";
	}
	if (isset($_GET['flt_piano'])) {
	  echo "<input type='hidden' name='flt_piano' value='$_GET[flt_piano]'>";
	  $annulla_path .= "&flt_piano=$_GET[flt_piano]";
	}
	if (isset($_GET['flt_stanza'])) {
	  echo "<input type='hidden' name='flt_stanza' value='$_GET[flt_stanza]'>";
	  $annulla_path .= "&flt_stanza=$_GET[flt_stanza]";
	}
	if (isset($_GET['flt_percorso'])) {
	  echo "<input type='hidden' name='flt_percorso' value='$_GET[flt_percorso]'>";
	  $annulla_path .= "&flt_percorso=$_GET[flt_percorso]";
	}
	echo "</td>";
	echo "<td><button class='action red' type='submit'>Salva</button></form> &nbsp;&nbsp; <button class='action green' type='text' onclick=\"location.href='{$annulla_path}';\">Annulla</button></td></tr>";
	echo "</table>";
    echo "<div id='stato'> $statmsg </div>";
	}
	else {
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='id' value='$id_percorso'>";
echo "<td><input type='hidden' name='numero_videowall' value='1'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"location.href='percorsi.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
}

	include "$path/sestante/srv/footer.php";
    echo "</body></html>";
	?>


