<?php
session_start();
$logged=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";




if(isset($_POST['annulla'])) {
$idvideowall=$_POST[annulla];
echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='idvideowall' value='$idvideowall'> </form>
<script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
}

connetti_db();

if(isset($_POST['edit'])) {
$iddisplaywall=$_POST[edit];
$idvideowall=$_POST[idvideowall];
$disp = db_query_value("SELECT * FROM displaywall WHERE iddisplaywall='$iddisplaywall' ");
list($id, $idvideowall, $iddisplaywall, $idvideo, $righe) = $disp;
}
/*
if(isset($_POST['var1'])) {
$idvideowall=$_POST['var2'];
$iddisplaywall=$_POST['var3'];
$disp = db_query_value("SELECT * FROM displaywall WHERE iddisplaywall='$iddisplaywall' ");
list($id, $idvideowall, $iddisplaywall, $idvideo, $righe) = $disp;
}
*/

if (isset($_POST['salva'])) {
$idvideowall=$_POST[idvideowall];
  $q = NULL;
    $q = "UPDATE displaywall SET iddisplaywall = '$_POST[iddisplaywall]',
                           idvideo = '$_POST[idvideo]',
                           righe = '$_POST[righe]'
          WHERE iddisplaywall = '$_POST[salva]'";
  
  $res = mysql_query($q);
//  if($res) { header("Location:videowall.php?idvideowall=$idvideowall");}
  if($res) {
    echo "<form id='nobutton' action='videowall.php' method='POST'> <input type='hidden' name='gestisci' value='$idvideowall'> </form>
		  <script type='text/javascript'> document.getElementById('nobutton').submit(); </script>";
		  }

  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
  
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
/*
echo "<form id='nobutton' action='/utenti/login.php' method='POST'>
      <input type='hidden' name='var1' value='/videowall/displaywall_edit.php'>
	  <input type='hidden' name='var2' value='$idvideowall'>
	  <input type='hidden' name='var3' value='$iddisplaywall'></form>";
echo "<form id='nobutton2' action='/videowall/videowall.php' method='POST'>
<input type='hidden' name='idvideowall' value='$idvideowall'>
</form>";

if($logged==false) { 
echo "<script>if(window.confirm('Per accedere a questa funzione  occorre eseguire il login.\\n \\n Vuoi eseguire il login?')){ document.getElementById('nobutton').submit();}</script>";
}
*/	


	$regIp="([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])";
	$regid="[0-9]{4}";
	$helpid=" L' \"Id\" di ciascun video e' composte da quattro cifre da \"0000\" a \"9999\".";
	$regdisp="^([1-9]|[1-9][0-9])$";
	$helpdisp=" Il campo e' composto da due cifre da \"1\" a \"99\".";
	$regrighe="[1-9]?[0-9]";
	$helprighe=" Il campo e' composto da una o due cifre da \"0\" a \"99\". Il numero di righe visualizzabili dipende dalle dimensioni(px) del display e dalle dimensioni(px) del font impostate nel VideoWall e dal testo contenuto nelle righe.";

	echo "<div class='contenuto'>";
	echo "<p class=titolo>Modifica del Videowall n.$idvideowall &nbsp; Display n.$iddisplaywall</p>";
/*if($logged==false){ echo "<p class=titolo>Per accedere a questa funzione occorre eseguire il  <a href='/utenti/login.php'>Login</a></p>";}
*/

if($logged==true) {
	echo "<form method='post'>";
	echo "<table class='tabella' cellpadding='3' RULES=ROWS FRAME=BOX>";
	echo "<tr><td class='right'> Num. Display: </td><td><input style='width:20px;' class='center' type='text' name='iddisplaywall' value='$iddisplaywall' autofocus required='required' pattern='$regdisp' ></td><td><div class='help' >$helpdisp</div></td></tr>";
	echo "<tr><td class='right' > Id Video: </td><td><input style='width:40px;' class='center' type='text' name='idvideo' value='$idvideo' required='required' pattern='$regid' ><td><div class='help' >$helpid</div></td> </tr>";
	echo "<tr><td class='right' > Righe: </td><td><input style='width:20px;' class='center' type='text' name='righe' value='$righe' required='required' pattern='$regrighe'></td><td><div class='help'>$helprighe</div></td></tr> ";
	echo "<input type='hidden' name='idvideowall' value='$idvideowall'>";
	echo "</table>";
// buttons logged
	echo "<table class='buttons'><tr>";
	echo "<td><button class='action red' type='submit' name='salva' value='$iddisplaywall'>Salva</button>";
    echo "<button class='action green' type='submit' name='annulla' value='$idvideowall'>Annulla</button>";
	echo "</td></form></tr></table>";
// end button logged
}
else { 
$phpfile= $_SERVER['PHP_SELF'];
echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
echo "<table class='buttons'><tr>";
echo "<form method='POST' action='/utenti/login.php'>";
echo "<td><input type='hidden' name='edit' value='$iddisplaywall'>";
echo "<input type='hidden' name='idvideowall' value='$idvideowall'>";
echo "<button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
echo "</td></form>";
echo "<form>";
echo "<td><button class='action green' type='button' onClick=\"window.location.href='/videowall/videowall.php'\">Annulla</button>";
echo "</td></form></tr></table><br>";
}



/*
echo "<pre> -- $iddisplaywall ---";
print_r($_POST);
echo "</pre>";
*/

?>

	<?php include($path . "/sestante/srv/footer.php");  ?>

</body>
</html>

