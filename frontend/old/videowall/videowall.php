<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

error_reporting(E_ALL | E_STRICT);  
ini_set('display_errors',1);  
ini_set('display_startup_errors',1);  
ini_set('log_errors',1);  
ini_set('log_errors_max_len',0);  
ini_set('ignore_repeated_errors',0);  
ini_set('ignore_repeated_source',0);  
ini_set('report_memleaks',1);  
ini_set('track_errors',1);  
ini_set('error_log','/percorso/file/php_error.log');
  $path=$_SERVER["DOCUMENT_ROOT"];
  include "$path/sestante/srv/config.php";
  include "$path/sestante/srv/db_helper.php";

if (isset($_POST['editdisp'])) {
  $iddisplaywall=$_POST['editdisp'];
    echo "<form id='nobutton' action='displaywall_edit.php' method='POST'>
	<input type='hidden' name='edit' value='$iddisplaywall'> </form>
	<input type='hidden' name='idvideowall' value='$idvideowall'> </form>
    <script>document.getElementById('nobutton').submit();</script>";
  }

  
  $statmsg="&nbsp;";
  connetti_db();
  
  if (isset($_POST['db_id'])) {  $idvwall=$_POST[db_id];}
  
  $vid = db_query_value("SELECT * FROM videowall WHERE numero_videowall='$idvwall'");
  list($id, $numero_videowall) = $vid;

  $query = 'select * from videowall ORDER BY numero_videowall';
  $result = mysql_query($query);
  $row=array();

  while ($riga = mysql_fetch_assoc($result)){
	$row[]=$riga;
    }

	if ((isset($_POST['operazione'])) && ($_POST['operazione'] == 'edit')) {
  $q = "DELETE FROM videowall WHERE numero_videowall='$numero_videowall'";
  $res = mysql_query($q);
    if($res) { header("Location: videowall.php");}
    else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
  }

  include "$path/sestante/srv/doctype.php";
?>
<HTML>
<HEAD>
<?php include "$path/sestante/srv/head.php"; ?>

<script>

var pinger_tick = 10000;
var https = new Object();

function httpGet(theUrl)
{
    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}


  function pinger(idvideo) {
    var url = "../video/remote.php?idvideo=" + idvideo + "&op=ping";
    https[idvideo] = new XMLHttpRequest();
    https[idvideo].onreadystatechange = function() {
      if (https[idvideo].readyState==4 && https[idvideo].status==200)
	{
	  var ping_element = document.getElementById('ping-status-' + idvideo);
	  if(https[idvideo].responseText.match("pong")) {
	    ping_element.className = 'green';
	  } else {
	    ping_element.className = 'red';
	  }
	}
      if (https[idvideo].readyState==4)   setTimeout(function() {pinger(idvideo);}, pinger_tick);
    };
    https[idvideo].open( "GET", url, true );
    https[idvideo].send( null );
  }

</script>

</HEAD>
<BODY>
<?php include "$path/sestante/srv/header.php"; ?>
<!-- Content Start -->
<p class="titolo">Gestione dei Videowall</p>

<?php
	echo "<table class='tabella videowall'>";
	echo "<tr style='font-weight:bold; text-align:center; background-color:silver;'>";
	echo "<td>N.</td><td>Largh. (px)</td><td>Alt. (px)</td><td>Font (px)</td><td>Alt. riga (px)</td><td>Largh. Reparto (px)</td><td>Largh. Edificio (px)</td><td>Largh. Piano (px)</td><td>Largh. Stanza (px)</td>";
	echo" </td><td>Colore Sfondo</td></td><td>Sfondo righe pari</td><td>Sfondo righe dispari</td><td>Colore Riga</td><td>Colore Edificio</td><td>Sfondo Edificio</td><td>Colore Piano</td><td>Sfondo Piano</td><td>Colore Stanza</td><td>Sfondo Stanza</td><td colspan=\"3\">Azione</td>";
	echo "</tr>";

foreach($row as $value ) {
	extract($value);
	echo "<tr style='height:auto; background-color:white;' >";
	echo "<td width='20'>$numero_videowall </td>
	<td width='20'>$larghezza_display </td>
	<td width='20'>$altezza_display </td>
	<td width='20'>$dimensioni_font </td>
	<td width='20'>$altezza_riga </td>
	<td width='20'>$larghezza_reparto </td>
	<td width='20'>$larghezza_edificio </td>
	<td width='35'>$larghezza_piano </td>
	<td width='35'>$larghezza_stanza </td>
	<td width='35'>$colore_sfondo </td>
	<td width='35'>$sfondo_riga_pari </td>
	<td width='35'>$sfondo_riga_dispari </td>
	<td width='35'>$colore_riga </td>
	<td width='35'>$colore_colonna_edificio </td>
	<td width='35'>$sfondo_colonna_edificio</td>
	<td width='35'>$colore_colonna_piano</td>
	<td width='35'>$sfondo_colonna_piano</td>
	<td width='35'>$colore_colonna_stanza</td>
	<td width='35'>$sfondo_colonna_stanza </td>";
	echo "<form method='POST'action='videowall_edit.php'> <td> <input type='hidden' name='edit' value='$numero_videowall'>
	<button class='action orange' type='submit' >Modifica</button></td></form>";
/*    echo "<form method='POST' action='videowall_elimina.php'> <td> <button class='action red' type='submit' name='idvideowall' value='$numero_videowall'>Elimina</button></td></form>"; */
/*    echo "<form method='POST'> <td><button class='action green' type='submit' name='idvideowall' value='$numero_videowall'>Gestisci</button></td>"; */
	echo "</td></form>";
    	
	echo "</tr>";
	}
echo "</table>";

echo "<table class='buttons'><tr>";
/* echo "<form method='POST' action='videowall_crea.php'><td><button class='action orange' type='submit' name='dispcrea' value'crea' >Crea Nuovo VideoWall</button></td></form>"; */
echo"</tr></table>";


if(isset($_POST["edit"])) { header("Location: videowall_edit.php"); }
if(isset($_POST["elimina"])) { $idvwall=$_POST["numwall"];
echo "<p class='titolo'>Eliminazione del Videowall n.$idvwall </p>";
echo "<table id='modifica' cellpadding='3' RULES=ROWS FRAME=BOX>";
echo "<form method='post'>";
echo "<input type='hidden' name='db_id' value='$idvwall'>";
echo "<input type='hidden' name='operazione' value='elimina'>";
echo "<tr style='border:0'><td style='border:0'><button class='action red' type='submit'>Elimina</button>&nbsp;&nbsp; <button class='action green' type='button' onclick=\"location.href='videowall.php';\">Annulla</button></td> </tr>";
echo "</form></table>";
echo "<div id='stato'>$statmsg</div>";
}

$idvideowall="1";
if(isset($_POST['idvideowall'])) { $idvideowall=$_POST['idvideowall']; }
	$query = "select * from displaywall where idvideowall='$idvideowall'";
	$result = mysql_query($query);
	$row=array();
	while ($riga = mysql_fetch_assoc($result)){ $row[]=$riga;  }
echo "<br>";
echo "<p class='titolo'>Gestione del Videowall n.$idvideowall</p>";
echo "<table class='tabella'>";
echo "<tr style=\"font-weight:bold; text-align:center; background-color:silver;\">";
echo "<td>ping</td><td>N. Video Wall</td><td>N. Display Wall</td><td>Id Video</td><td>N. Righe</td><td colspan='4' >Azione</td><td colspan='3'>Gestione</td>";
echo "</tr>";

foreach($row as $value ) {
extract($value);
echo "<tr style=\"height:auto; background-color:white;\">";
echo "<td id='ping-status-$idvideo' class='orange'>&nbsp;</td>";
echo "<td width=\"20\">$idvideowall</td>";
echo "<td width=\"20\">$iddisplaywall</td>";
echo "<td width=\"20\">$idvideo</td>";
echo "<td width=\"20\">$righe</td>";
echo "<form method='POST'> <td>
<input type='hidden' name='idvideowall' value='$idvideowall'>
<button class='action orange' type='submit' name='editdisp' value='$iddisplaywall'>Modifica</button></td></form>";
echo "<form method='POST' action='displaywall_elimina.php'><td>
<input type='hidden' name='idvideowall' value='$idvideowall'>
<button class='action red' type ='submit' name='iddisplaywall' value='$iddisplaywall'>Elimina</button></td></form>";
echo "<form method='POST' action='creavw.php'><td>
<input type='hidden' name='idvideo' value='$idvideo'>
<input type='hidden' name='idvideowall' value='$idvideowall'>
<button class='action green' type='submit' name='displaywall' value='$iddisplaywall' >Test</button></td></form>";
echo "<form method='POST' action='displaywall_salva.php'><td>
<input type='hidden' name='idvideowall' value='$idvideowall'>
<button class='action orange' type=submit' name='idvideo' value='$idvideo'>Salva</button></td></form>";
    echo "<td>";
    echo "<button class='action red' onclick='httpGet(\"../video/remote.php?idvideo=$idvideo&op=reboot\")'>Reboot</button>";
    echo "</td>";

    echo "<td>";
    echo "<button class='action green' onclick='httpGet(\"../video/remote.php?idvideo=$idvideo&op=video_on\")'>Monitor ON</button>";
    echo "</td>";

    echo "<td>";
    echo "<button class='action orange' onclick='httpGet(\"../video/remote.php?idvideo=$idvideo&op=video_off\")'>Monitor OFF</button>";
    echo "</td>";	

echo "</tr>";
echo "<script>setTimeout(function () {pinger('$idvideo');}, 100);</script>";
}

echo "</table>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='displaywall_crea.php'><td><button class='action orange' type='submit' name='idvideowall' value='$idvideowall'>Crea Nuovo Displaywall</button></td></form>";

  echo "<form method='POST' action='displaywall_salva_tutti.php'>";
  echo "<td>";
  echo "<button class='action orange' type='submit' name='idvideowall' value='$idvideowall'>Salva tutti display del videowall</button>";
  echo "</td>";
  echo "</form>";

echo"</tr></table><br>";

/*
echo "<pre>";
print_r($row);
echo "</pre>";
*/

?>

<!-- Content End -->
<?php include "$path/sestante/srv/footer.php"; ?>
</BODY>
</HTML>
