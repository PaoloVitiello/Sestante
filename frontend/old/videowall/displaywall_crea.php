<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

if(!empty($_POST['idvideowall'])) { $idvideowall=$_POST[idvideowall];}


connetti_db();
/*
$vid = db_query_value("SELECT idvideo, ip, descrizione, id 
                       FROM video WHERE idvideo='$id'");
list($idvideo, $ip, $descrizione, $db_id) = $vid;
*/

if (!empty($_POST['salva'])) {
/*
echo "<pre> ---- $idvideowall -----";
print_r($_POST);
echo "</pre>";
*/
    $q = "INSERT INTO displaywall (idvideowall, iddisplaywall, idvideo, righe) 
          VALUES 	(\"$_POST[idvideowall]\",
					\"$_POST[iddisplaywall]\",
					\"$_POST[idvideo]\",
					\"$_POST[righe]\") ";
  $res = mysql_query($q);
//  if($res) { header( "Location:videowall.php?idvideowall=$idvideowall" );}
    if($res) {
    echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='gestisci' value='$idvideowall'> </form>
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
	$idvwall=$_POST['idvideowall'];
	$regdisp="[1-9]|[1-9][0-9]";
	$helpdisp="Il numero progressivo di ciascun display e' composte da due cifre da 01 a 99";
	$regid="[0-9]{4}";
	$helpid=" L' \"id\" di ciascun video e' composte da quattro cifre da 0000 a 9999";
	$regrig="[1-9]|[1-9][0-9]";
	$helprig="Il numero di righe e' composte da due cifre da 01 a 99";

	echo "<p class='titolo'>Creazione Nuovi Display nel Videowall n.$idvideowall</p>";
if($logged) {
	echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX> <form method='post'><tr><td class='right'> Num. Display: </td><td><input class='center' type='text' name='iddisplaywall' value='1' pattern='$regdisp' autofocus ></td><td><div class='help' >$helpdisp</div></td></tr>";
	echo "<tr><td class='right' > IdVideo: </td><td><input class='center' type='text' name='idvideo' value='0000'  pattern='$regid'></td><td><div class='help' >$helpid</div></td> </tr>";
	echo "<tr><td class=right > Righe: </td><td><input class='center' type='text' name='righe' value='1'   pattern='$regrig'></td><td><div class='help' >$helprig</div></td> </tr>"; 
	echo "<input type='hidden' name='idvideowall' value='$idvideowall'>";
    echo "</table>";
	echo "<div id='stato'>$statmsg</div>";
// Bottoni Logged
	echo "<table class='buttons'><tr>";
	echo "<td><button class='action red' type='submit' name='salva' value='salva'> Salva </button>&nbsp;</form></td>";
	echo "<td><form method='POST' action='videowall.php'>&nbsp;<button class='action green' type='submit' name='gestisci' value='$idvideowall'>Annnulla</button></td></form>";
	echo"</tr></table>";
// Fine bottoni Logged
}
else{
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
// Bottoni Not Logged
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='idvideowall' value='$idvideowall'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
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

