<?php
session_start();
$logged=false;
$is_admin=false;
if(isset($_SESSION['sess_username'])) { $logged=true;}
if(isset($_SESSION['sess_is_admin'])) { $is_admin=$_SESSION['sess_is_admin'];}

$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/sestante/srv/config.php");
include($path."/sestante/srv/db_helper.php");
include "$path/sestante/srv/doctype.php";

connetti_db();

if(isset($_POST['touchid'])) {
  $id = $_POST['touchid'];
  list($descrizione, $ip) = db_query_value("SELECT descrizione, ip FROM touch WHERE id='$id'");
}


$statmsg = '';
if (isset($_POST) && isset($_POST['operazione']) && ($_POST['operazione'] == 'elimina')) {
  $q = "DELETE FROM touch WHERE id='$id'";
  $res = mysql_query($q);
  if($res) { header("Location: touch.php");}
  else {$statmsg=" ERRORE ".mysql_errno()."---".mysql_error();}
}
?>


<html>
<head>
	<?php include($path . "/sestante/srv/head.php"); ?>
	<title> Elimina Touchscreen </title>
<style>
td { vertical-align:top;}
td.right { text-align:right;}
textarea {resize:none; width:200px; }
input.center{width:200px;}
div.help {width:400px; word-wrap: break-word;}
#stato {margin:0 0 0 50px; color:red;}
</style>
</head>
<body>

<?php
include "$path/sestante/srv/header.php";
echo "<p class=titolo>Eliminazione dell touchscreen</p>";
if($logged) {
  if ($is_admin) {
    echo "<table class=tabella cellpadding='3' RULES=ROWS FRAME=BOX>";
    echo "  <form method='post'>";
    echo "    <tr>"; 
    echo "      <td class='right' >id:</td>";
    echo "      <td>";
    echo "        <input class='lcd center' readonly type='text' name='id' value='$id'>";
    echo "      </td>";
    echo "    </tr>";
    echo "    <tr>"; 
    echo "      <td class='right' >descrizione:</td>";
    echo "      <td>";
    echo "        <input class='lcd center' readonly type='text' name='descrizione' value='$descrizione'>";
    echo "      </td>";
    echo "    </tr>";
    echo "    <tr>";
    echo "      <td class='right' > ip: </td>";
    echo "      <td>";
    echo "        <input class='lcd center' readonly type='text' name='ip' value='$ip'>";
    echo "        <input type='hidden' name='touchid' value='$id'>";
    echo "        <input type='hidden' name='operazione' value='elimina'>";
    echo "      </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<div id='stato'>$statmsg</div>";

    // bottoni logged
    echo "<table class='buttons'>";
    echo "<tr>";
    echo "<td>";
    echo "<button class='action red' type='submit' name='elimina' value='elimina'>Elimina</button>";
    echo "<button class='action green' type='button' onClick=\"window.location.href='/touch/touch.php'\">Annulla</button>";
    echo "</td>";
    echo "</tr>";
    echo "</form>";
    echo "</table><br><br>";
    //fine bottoni logged
  } else {
    echo "<div class='alert'> Questa funzione &egrave; riservata agli utenti amministratori.</div>";
  }
}
else{
  $phpfile= $_SERVER['PHP_SELF'];
  echo "<div class='alert'> Per accedere a questa funzione e' necessario autenticarsi</div>";
  // bottoni not logged
  echo "<table class='buttons'><tr>";
  echo "<form method='POST' action='/utenti/login.php'>";
  echo "<input type='hidden' name='userid' value='$id'>";
  echo "<td><button class='action green' type'submit' name='file' value='$phpfile' autofocus >Login</button>";
  echo "</td></form>";
  echo "<form>";
  echo "<td><button class='action green' type='button' onClick=\"window.location.href='/touch/touch.php'\">Annulla</button>";
  echo "</td></form></tr></table><br>";
  // fine bottoni not logged
}

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

include "$path/sestante/srv/footer.php";

?>

</body>
</html>

